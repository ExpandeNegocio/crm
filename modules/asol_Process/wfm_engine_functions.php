<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

require_once("modules/asol_Task/executeTask_functions.php");
require_once("modules/asol_Process/generateQuery_wfm.php");
require_once("modules/asol_Process/___common_WFM/php/Basic_wfm.php");

function instanciate_processes__scheduled_sequential($scheduled_event_info) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $sugar_config;

	$event_id = $scheduled_event_info['event_id'];
	$alternative_database = $scheduled_event_info['alternative_database'];
	$trigger_module = $scheduled_event_info['trigger_module'];
	$object_ids = implode('${pipe}', $scheduled_event_info['object_ids']);
	$num_objects = count($scheduled_event_info['object_ids']);
	$iter_object = 0;

	$new_bean = wfm_utils::wfm_get_bean_variable_array($alternative_database, $trigger_module, $scheduled_event_info['object_ids'][$iter_object]);

	$current_user_id = Basic_wfm::getCreatedBy('asol_events', $event_id);
	$current_user_id = (!empty($current_user_id)) ? $current_user_id : '1';

	$trigger_event = null;
	$bean_ungreedy_count = null;
	$old_bean = null;
	//
	//$new_bean = null;
	$custom_variables = Array(
		'num_objects' => $num_objects,
		'iter_object' => $iter_object,
		'sugar_config' => $sugar_config
	);

	return instanciate_processes('scheduled', 'sequential', $event_id, $trigger_module, $trigger_event, $object_ids, $current_user_id, $bean_ungreedy_count, $old_bean, $new_bean, $custom_variables, $alternative_database);
}

function instanciate_processes__scheduled_parallel($event_id, $alternative_database, $trigger_module, $num_objects, $iter_object, $object_id) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $sugar_config;

	$bean_ungreedy_count = null;

	$trigger_event = null;

	$old_bean = null;
	$new_bean = wfm_utils::wfm_get_bean_variable_array($alternative_database, $trigger_module, $object_id);
	$custom_variables = Array(
		'num_objects' => $num_objects,
		'iter_object' => $iter_object,
		'sugar_config' => $sugar_config
	);

	$current_user_id = Basic_wfm::getCreatedBy('asol_events', $event_id);
	$current_user_id = (!empty($current_user_id)) ? $current_user_id : '1';

	return instanciate_processes('scheduled', 'parallel', $event_id, $trigger_module, $trigger_event, $object_id, $current_user_id, $bean_ungreedy_count, $old_bean, $new_bean, $custom_variables, $alternative_database);
}

function instanciate_processes__logic_hook($trigger_module, $trigger_event, $bean_id, $current_user_id, $bean_ungreedy_count, $old_bean, $new_bean, $server, $request, $current_user_array, $env) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $sugar_config;

	$alternative_database = '-1';

	$current_user_id = (!empty($current_user_id)) ? $current_user_id : '1';

	$scheduled_type = null;
	$event_id = null;

	$num_objects = 1;
	$iter_object = 0;

	$custom_variables = Array(
		'num_objects' => $num_objects,
		'iter_object' => $iter_object,
		'bean_ungreedy_count' => $bean_ungreedy_count,
		'server' => $server,
		'request' => $request,
		'trigger_event' => $trigger_event,
		'current_user' => $current_user_array,
		'env' => $env,
		'modified_new_bean' => $new_bean,
		'sugar_config' => $sugar_config,
		'GLOBAL_CVARS' => Array()
	);

	return instanciate_processes('logic_hook', $scheduled_type, $event_id, $trigger_module, $trigger_event, $bean_id, $current_user_id, $bean_ungreedy_count, $old_bean, $new_bean, $custom_variables, $alternative_database);
}

function instanciate_processes($execution_type, $scheduled_type, $event_id, $trigger_module, $trigger_event, $object_ids, $current_user_id, $bean_ungreedy_count, $old_bean, $new_bean, $custom_variables, $alternative_database) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$working_node_ids = Array();

	global $db, $sugar_config, $app_list_strings;

	$object_ids_array = explode('${pipe}', $object_ids);
	$object_id = $object_ids_array[$custom_variables['iter_object']];

	// asol_domains
	$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
	if ($isDomainsInstalled) {
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
	}

	// Get wfm-events
	switch ($execution_type) {

		case 'logic_hook':

			// asol_domains
			$parent_asol_domain_ids = ($isDomainsInstalled) ? ("," . wfm_domains_utils::wfm_getParentDomains_string($new_bean['asol_domain_id'])) . ",''" : '';
			//$asol_domains_query_1 = ($isDomainsInstalled) ? " AND ((asol_process.asol_domain_id IN ('{$new_bean['asol_domain_id']}' {$parent_asol_domain_ids})) OR (asol_process.asol_domain_id IS NULL))" : '';
			$asol_domains_published_query = ($isDomainsInstalled) ? asol_manageDomains::getExtendedPublishingDomainsWhereQuery('asol_process', $new_bean['asol_domain_id']). ")" : "";

			$sql = "
				SELECT asol_events.*
				FROM asol_events
				INNER JOIN asol_proces_asol_events_c ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_events.id AND asol_proces_asol_events_c.deleted = 0)
				INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
				WHERE (asol_process.status = 'active' AND asol_process.trigger_module = '{$trigger_module}' AND asol_events.trigger_event = '{$trigger_event}' AND asol_events.trigger_type = 'logic_hook' AND asol_events.deleted = 0) {$asol_domains_published_query}							  
		    	ORDER BY
					CASE asol_events.type
						WHEN 'initialize' THEN 1
					    WHEN 'start' THEN 2
					    WHEN 'intermediate' THEN 3
					    WHEN 'cancel' THEN 4
					    ELSE 5
					END
			";
			$event_query = $db->query($sql);
			wfm_utils::wfm_log('debug', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
			$events = Array();
			while ($event_row = $db->fetchByAssoc($event_query)) {
				$events[] = $event_row;
			}
			wfm_utils::wfm_log('debug', '$events=['.var_export($events, true).']', __FILE__, __METHOD__, __LINE__);

			// Check conditions for each wfm-event.
			$events_apply = Array();
			foreach ($events as $event) {
				wfm_utils::wfm_log('debug', "Check appliesConditions for wfm-event=[name=[{$event['name']}], id=[{$event['id']}]]", __FILE__, __METHOD__, __LINE__);
				if (appliesConditions($trigger_module, $object_ids, $event['conditions'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database)) {
					wfm_utils::wfm_log('debug', "The wfm-event=[name=[{$event['name']}], id=[{$event['id']}]] Applies conditions=[{$event['conditions']}]", __FILE__, __METHOD__, __LINE__);
					$events_apply[] = $event['id'];
				} else {
					wfm_utils::wfm_log('debug', "The wfm-event=[name=[{$event['name']}], id=[{$event['id']}]] does NOT Applies conditions=[{$event['conditions']}]", __FILE__, __METHOD__, __LINE__);
				}
			}

			break;

		case 'scheduled':

			$events_apply[] = $event_id;
			break;
	}
	$log_level = (count($events_apply) > 0) ? 'asol' : 'debug';
	wfm_utils::wfm_log($log_level, '$events_apply=['.var_export($events_apply, true).']', __FILE__, __METHOD__, __LINE__);

	// For each wfm-event, we get its wfm-activities
	$activities = Array(); // [0->[event_idX, activity_id0],..., ]
	foreach ($events_apply as $event_apply) {
		$activity_query = $db->query("
			SELECT asol_event87f4_events_ida AS event_id, asol_event8042ctivity_idb AS activity_id 
			FROM asol_eventssol_activity_c
			WHERE asol_event87f4_events_ida = '{$event_apply}' AND deleted = 0
		");
		while ($activity_row = $db->fetchByAssoc($activity_query)) {
			$activities[] = $activity_row;
		}
	}
	wfm_utils::wfm_log('debug', '$activities=['.var_export($activities, true).']', __FILE__, __METHOD__, __LINE__);

	// Get wfm-activity info (wfm-process, wfm-event, wfm-activity, activity_conditions)
	// Filter by wfm-process status=active

	// asol_domains
	$asol_domains_query = ($isDomainsInstalled) ? ', asol_process.asol_domain_id AS asol_domain_id' : '';

	$activities_info = Array(); // [0->[process_idZY, event_idX, activity_id0, activity_conditions], ... , n->[process_idYX, event_idZX, activity_idn, activity_conditions]] <- This activities are all that applies all conditions.(!!!!!ojo dos eventos que referencien una misma actividad)
	foreach ($activities as $activity) {

		$activities_info_query = $db->query("
			SELECT asol_proces_asol_events_c.asol_proce6f14process_ida AS process_id, asol_process.name AS process_name, asol_proces_asol_events_c.asol_procea8ca_events_idb AS event_id, asol_events.name AS event_name, asol_events.type AS event_type, asol_events.trigger_type AS event_trigger_type, asol_events.scheduled_type AS event_scheduled_type, asol_events.conditions AS event_conditions, asol_activity.id AS activity_id, asol_activity.name AS activity_name, asol_activity.conditions AS activity_conditions {$asol_domains_query} 
			FROM asol_activity
			INNER JOIN asol_eventssol_activity_c ON (asol_eventssol_activity_c.asol_event8042ctivity_idb = asol_activity.id AND asol_eventssol_activity_c.deleted = 0)
			INNER JOIN asol_events ON (asol_events.id = asol_eventssol_activity_c.asol_event87f4_events_ida AND asol_events.deleted = 0)
			INNER JOIN asol_proces_asol_events_c ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_events.id AND asol_proces_asol_events_c.deleted = 0)
			INNER JOIN asol_process ON (asol_process.id = asol_proces_asol_events_c.asol_proce6f14process_ida AND asol_process.deleted = 0)
			WHERE asol_activity.id = '{$activity['activity_id']}'
	    ");
		$activities_info_row = $db->fetchByAssoc($activities_info_query);

		if ($activities_info_query->num_rows > 0) {
			$activities_info[] = $activities_info_row;
		}
	}
	wfm_utils::wfm_log('debug', '$activities_info=['.var_export($activities_info, true).']', __FILE__, __METHOD__, __LINE__);

	// Filter the wfm-activities by their conditions

	switch ($execution_type) {
		case 'logic_hook':
			$activities_apply = getActivities_appliesCondition($activities_info, $trigger_module, $object_ids, $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);
			break;
		case 'scheduled':
			switch ($scheduled_type) {
				case 'sequential':
					$activities_apply = $activities_info;
					break;
				case 'parallel':
					$activities_apply = getActivities_appliesCondition($activities_info, $trigger_module, $object_ids, $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);
					break;
			}
			break;
	}
	$log_level = (count($activities_apply) > 0) ? 'asol' : 'debug';
	wfm_utils::wfm_log($log_level, '$activities_apply=['.var_export($activities_apply, true).']', __FILE__, __METHOD__, __LINE__);

	/*********************************************************************
	 * ADD FLOW TO WORKING MEMORY.
	 * asol_processinstances	1--------->n	asol_workingnodes
	 *********************************************************************/

	$activity_initialize = null;

	$alreadyStoredProcesses_by_startEvent = Array(); //[process_id] => 'process_instance_id'
	$alreadyStoredProcesses_by_scheduled = Array(); //[process_id] => 'process_instance_id'

	$already_stored_activities__event_duplicity = Array(); // Contains the activities that have already been stored in asol_workingnodes. <- Two or more events can link one activity; we do not want to execute the same activity twice or more times, just once.

	/**
	 * Example $activities_apply
	 * P1	E1					A1(*event-duplicity)
	 * P1	E1					A2
	 * P1	E2					A3
	 * P1	E2					A1(*event-duplicity)
	 * P1	E3(intermediate)	A4
	 * P2	E4					A5
	 */

	$array_InsertQuery = Array();

	$date_entered = gmdate('Y-m-d H:i:s');
	$date_modified = $date_entered;

	foreach ($activities_apply as $activity) {

		// asol_domains
		$activity['asol_domain_id'] = (!empty($activity['asol_domain_id'])) ? $activity['asol_domain_id'] : "''";
		$asol_domains_query_1 = ($isDomainsInstalled) ? ', asol_domain_id' : '';
		$asol_domains_query_2 = ($isDomainsInstalled) ? ", {$activity['asol_domain_id']}" : '';

		switch ($execution_type) {

			case 'logic_hook':

				// Event duplicity
				if (!(in_array($activity['activity_id'], $already_stored_activities__event_duplicity))) {
					$already_stored_activities__event_duplicity[] = $activity['activity_id'];
				} else {
					wfm_utils::wfm_log('asol', "Event duplicity: wfm-activity=[name=[{$activity['activity_name']}], id=[{$activity['activity_id']}]] must not be executed more than once", __FILE__, __METHOD__, __LINE__);
					continue;
				}

				// Set priority
				$priority = $app_list_strings['wfm_working_node_priority'][$activity['event_trigger_type']][$activity['event_type']];

				// Bifurcate by event_type:
				// 0.- initialize
				// 1.- start
				// 2.- intermediate and cancel
				switch ($activity['event_type']) {

					case 'initialize':
						$activity_initialize = $activity; // Events are sorted by type, so this will work.
						break;
							
					case 'start':

						// Check if already instanciated process (only care about $activities_apply, not the database process-instances)
						if (array_key_exists($activity['process_id'], $alreadyStoredProcesses_by_startEvent)) {
							$id1 = $alreadyStoredProcesses_by_startEvent[$activity['process_id']];
						} else {
							// Add process-instance
							$id1 = create_guid();
							$name1 = "p_i_".$id1;
							$parent_process_instance_id = 'null';
							$created_by = $current_user_id;
							$modified_user_id = $current_user_id;
							$assigned_user_id = $current_user_id;

							$array_InsertQuery[] = "
								INSERT INTO asol_processinstances (id, name, date_entered, date_modified, asol_process_id_c, asol_processinstances_id_c, bean_ungreedy_count, created_by, modified_user_id, assigned_user_id {$asol_domains_query_1})
								VALUES ('{$id1}', '{$name1}', '{$date_entered}', '{$date_modified}', '{$activity['process_id']}', {$parent_process_instance_id}, {$bean_ungreedy_count}, '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}' {$asol_domains_query_2})
						    ";
							// Store process
							$alreadyStoredProcesses_by_startEvent[$activity['process_id']] = $id1;

							// Manage initialize-event
							if ($activity_initialize != null) {// Check if this WorkFlow has initialize event
								if (count(getArrayProcessInstanceIds($activity['process_id'], null)) == 0) {// Check if this process has already been instanciated

									// Add working-node type=initialize
									$id2 = create_guid();
									$working_node_ids[] = $id2;
									$name2 = "w_n_".$id2;
									$type = $activity_initialize['event_type'];
									$event = $activity_initialize['event_id'];
									$current_activity = $activity_initialize['activity_id'];
									$current_task = 'null';
									$delay_wakeup_time = '0000-00-00 00:00:00';
									$created_by = $current_user_id;
									$modified_user_id = $current_user_id;
									$assigned_user_id = $current_user_id;
									$status = 'not_started';
									$old_bean_to_db = base64_encode(serialize($old_bean));
									$new_bean_to_db = base64_encode(serialize($new_bean));
									$custom_variables_to_db = base64_encode(serialize($custom_variables));

									$array_InsertQuery[] = "
										INSERT INTO asol_workingnodes 
													(id      , name      , type     , asol_processinstances_id_c, priority   , date_entered     , date_modified     , asol_events_id_c, asol_activity_id_c   , object_ids     , iter_object                       , parent_type        , parent_id     , asol_task_id_c , delay_wakeup_time     , created_by     , modified_user_id     , assigned_user_id     , status     , old_bean           , new_bean           , custom_variables            {$asol_domains_query_1})
										VALUES 		('{$id2}', '{$name2}', '{$type}', '{$id1}'                  , {$priority}, '{$date_entered}', '{$date_modified}', '{$event}'      , '{$current_activity}', '{$object_ids}', {$custom_variables['iter_object']}, '{$trigger_module}', '{$object_id}', {$current_task}, '{$delay_wakeup_time}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}', '{$status}', '{$old_bean_to_db}', '{$new_bean_to_db}', '{$custom_variables_to_db}' {$asol_domains_query_2})
								    ";
								}
							}
						}

						// Add working-node
						$id2 = create_guid();
						$working_node_ids[] = $id2;
						$name2 = "w_n_".$id2;
						$type = $activity['event_type'];
						$event = $activity['event_id'];
						$current_activity = $activity['activity_id'];
						$current_task = 'null';
						$delay_wakeup_time = '0000-00-00 00:00:00';
						$created_by = $current_user_id;
						$modified_user_id = $current_user_id;
						$assigned_user_id = $current_user_id;
						$status = 'not_started';
						$old_bean_to_db = base64_encode(serialize($old_bean));
						$new_bean_to_db = base64_encode(serialize($new_bean));
						$custom_variables_to_db = base64_encode(serialize($custom_variables));

						$array_InsertQuery[] = "
							INSERT INTO asol_workingnodes 
										(id      , name      , type     , asol_processinstances_id_c, priority   , date_entered     , date_modified     , asol_events_id_c, asol_activity_id_c   , object_ids     , iter_object                       , parent_type        , parent_id     , asol_task_id_c , delay_wakeup_time     , created_by     , modified_user_id     , assigned_user_id     , status     , old_bean           , new_bean           , custom_variables            {$asol_domains_query_1})
							VALUES 		('{$id2}', '{$name2}', '{$type}', '{$id1}'                  , {$priority}, '{$date_entered}', '{$date_modified}', '{$event}'      , '{$current_activity}', '{$object_ids}', {$custom_variables['iter_object']}, '{$trigger_module}', '{$object_id}', {$current_task}, '{$delay_wakeup_time}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}', '{$status}', '{$old_bean_to_db}', '{$new_bean_to_db}', '{$custom_variables_to_db}' {$asol_domains_query_2})
					   	";

						break;

					case 'intermediate':
					case 'cancel':

						foreach (getArrayProcessInstanceIds($activity['process_id'], $object_ids) as $process_instance_id) {
							// Add working-node
							$id2 = create_guid();
							$working_node_ids[] = $id2;
							$name2 = "w_n_".$id2;
							$type = $activity['event_type'];
							$event = $activity['event_id'];
							$current_activity = $activity['activity_id'];
							$current_task = 'null';
							$delay_wakeup_time = '0000-00-00 00:00:00';
							$created_by = $current_user_id;
							$modified_user_id = $current_user_id;
							$assigned_user_id = $current_user_id;
							$status = 'not_started';
							$old_bean_to_db = base64_encode(serialize($old_bean));
							$new_bean_to_db = base64_encode(serialize($new_bean));
							$custom_variables_to_db = base64_encode(serialize($custom_variables));

							$array_InsertQuery[] = "
								INSERT INTO asol_workingnodes 
											(id      , name      , type     , asol_processinstances_id_c, priority   , date_entered     , date_modified     , asol_events_id_c, asol_activity_id_c   , object_ids     , iter_object                       , parent_type        , parent_id     , asol_task_id_c , delay_wakeup_time     , created_by     , modified_user_id     , assigned_user_id     , status     , old_bean           , new_bean           , custom_variables            {$asol_domains_query_1})
								VALUES 		('{$id2}', '{$name2}', '{$type}', '{$process_instance_id}'  , {$priority}, '{$date_entered}', '{$date_modified}', '{$event}'      , '{$current_activity}', '{$object_ids}', {$custom_variables['iter_object']}, '{$trigger_module}', '{$object_id}', {$current_task}, '{$delay_wakeup_time}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}', '{$status}', '{$old_bean_to_db}', '{$new_bean_to_db}', '{$custom_variables_to_db}' {$asol_domains_query_2})
						    ";
						}
				}
				break;

			case 'scheduled':

				// Set priority
				$priority = $app_list_strings['wfm_working_node_priority'][$activity['event_trigger_type']][$activity['event_scheduled_type']];

				// Check if already instanciated process (only care about $activities_apply, not the database process-instances)
				if (array_key_exists($activity['process_id'], $alreadyStoredProcesses_by_scheduled)) {
					$id1 = $alreadyStoredProcesses_by_scheduled[$activity['process_id']];
				} else {
					// Add process-instance
					$id1 = create_guid();
					$name1 = "p_i_".$id1;
					$parent_process_instance_id = 'null';
					$bean_ungreedy_count = 0;
					$created_by = $current_user_id;
					$modified_user_id = $current_user_id;
					$assigned_user_id = $current_user_id;

					$array_InsertQuery[] = "
						INSERT INTO asol_processinstances (id, name, date_entered, date_modified, asol_process_id_c, asol_processinstances_id_c, bean_ungreedy_count, created_by, modified_user_id, assigned_user_id {$asol_domains_query_1})
						VALUES ('{$id1}', '{$name1}', '{$date_entered}', '{$date_modified}', '{$activity['process_id']}', {$parent_process_instance_id}, {$bean_ungreedy_count}, '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}' {$asol_domains_query_2})
			   		";

					// Store process
					$alreadyStoredProcesses_by_scheduled[$activity['process_id']] = $id1;
				}
					
				// Add working-node
				$id2 = create_guid();
				$working_node_ids[] = $id2;
				$name2 = "w_n_".$id2;
				$type = "{$activity['event_trigger_type']}_{$activity['event_scheduled_type']}";
				$event = $activity['event_id'];
				$current_activity = $activity['activity_id'];
				$current_task = 'null';
				$delay_wakeup_time = '0000-00-00 00:00:00';
				$created_by = $current_user_id;
				$modified_user_id = $current_user_id;
				$assigned_user_id = $current_user_id;
				$status = 'not_started';
				$old_bean_to_db = '';
				$new_bean_to_db = base64_encode(serialize($new_bean));
				$custom_variables_to_db = base64_encode(serialize($custom_variables));

				$array_InsertQuery[] = "
					INSERT INTO asol_workingnodes 
								(id      , name      , type     , asol_processinstances_id_c, priority   , date_entered     , date_modified     , asol_events_id_c, asol_activity_id_c   , object_ids     , iter_object                       , parent_type        , parent_id     , asol_task_id_c , delay_wakeup_time     , created_by     , modified_user_id     , assigned_user_id     , status     , old_bean           , new_bean           , custom_variables            {$asol_domains_query_1})
					VALUES 		('{$id2}', '{$name2}', '{$type}', '{$id1}'                  , {$priority}, '{$date_entered}', '{$date_modified}', '{$event}'      , '{$current_activity}', '{$object_ids}', {$custom_variables['iter_object']}, '{$trigger_module}', '{$object_id}', {$current_task}, '{$delay_wakeup_time}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}', '{$status}', '{$old_bean_to_db}', '{$new_bean_to_db}', '{$custom_variables_to_db}' {$asol_domains_query_2})
			    ";
				break;
		}
	}

	// Insert queries into database
	foreach ($array_InsertQuery as $query) {
		$db->query($query);
	}

	wfm_utils::wfm_log('debug', '$array_InsertQuery=['.var_export($array_InsertQuery, true).']', __FILE__, __METHOD__, __LINE__);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);

	return $working_node_ids;
}

function getActivities_appliesCondition($activities_info, $trigger_module, $bean_id, $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database) {

	$activities_apply = Array();
	foreach ($activities_info as $activity_info) {
		wfm_utils::wfm_log('debug', "Check appliesConditions for wfm-activity=[name=[{$activity_info['activity_name']}], id=[{$activity_info['activity_id']}]]", __FILE__, __METHOD__, __LINE__);
		if (appliesConditions($trigger_module, $bean_id, $activity_info['activity_conditions'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database)) {
			wfm_utils::wfm_log('debug', "The wfm-activity=[name=[{$activity_info['activity_name']}], id=[{$activity_info['activity_id']}]] Applies conditions=[{$activity_info['activity_conditions']}]", __FILE__, __METHOD__, __LINE__);
			$activities_apply[] = $activity_info;
		} else {
			wfm_utils::wfm_log('debug', "The wfm-activity=[name=[{$activity_info['activity_name']}], id=[{$activity_info['activity_id']}]] does NOT Applies conditions=[{$activity_info['activity_conditions']}]", __FILE__, __METHOD__, __LINE__);
		}
	}

	return $activities_apply;
}

function getArrayProcessInstanceIds($process_id, $object_ids) {

	global $db;

	$processInstanceIds = Array();

	$sql = "
		SELECT asol_processinstances.id AS id
		FROM asol_processinstances 
		INNER JOIN asol_workingnodes ON asol_processinstances.id = asol_workingnodes.asol_processinstances_id_c
		WHERE asol_processinstances.asol_process_id_c = '{$process_id}'
	";
	$sql = ($object_ids == null) ? $sql : $sql." AND asol_workingnodes.object_ids = '{$object_ids}'";
	$process_instance_id__query = $db->query($sql);

	while ($process_instance_id__row = $db->fetchByAssoc($process_instance_id__query)) {
		$processInstanceIds[] = $process_instance_id__row['id'];
	}

	wfm_utils::wfm_log('debug', '$processInstanceIds=['.print_r($processInstanceIds, true).']', __FILE__, __METHOD__, __LINE__);

	return $processInstanceIds;
}

function continue_wfm_execution_through_curl() {

	global $sugar_config;

	$log = "\$WFM_MAX_working_nodes_executed_in_one_php_instance reached! => Continue through cURL";

	wfm_utils::wfm_log('asol', $log, __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_echo('crontab', "<font color='red'>".$log."</font>");

	//**********cURL***********//
	wfm_utils::wfm_log('asol', "********** cURL=[continue_wfm_execution_through_curl] **********", __FILE__, __METHOD__, __LINE__);

	$query_string = "entryPoint=wfm_engine&execution_type=crontab";
	wfm_utils::wfm_curl('post', null, $query_string, false, 1);
	//**********cURL***********//
}

function execute_WFM($working_node_ids_array = null) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db/*, $current_user*/, $sugar_config;

	$execution_counter = 0;
	$WFM_MAX_working_nodes_executed_in_one_php_instance = (isset($sugar_config['WFM_MAX_working_nodes_executed_in_one_php_instance'])) ? $sugar_config['WFM_MAX_working_nodes_executed_in_one_php_instance'] : 10;

	$specific_working_nodes = ($working_node_ids_array == null) ? '' : ' AND asol_workingnodes.id IN ('.wfm_utils::convertArrayToStringDB($working_node_ids_array). ')';

	do {

		if (($WFM_MAX_working_nodes_executed_in_one_php_instance != 'unlimited') && ($execution_counter >= $WFM_MAX_working_nodes_executed_in_one_php_instance)) {
			continue_wfm_execution_through_curl();
			break;
		}

		$delay_wakeup_time = gmdate('Y-m-d H:i:s');

		$sql = "
			SELECT *
			FROM asol_workingnodes
			WHERE (   status = 'not_started' OR  status = 'in_progress' OR ( (status = 'delayed_by_activity' OR status = 'delayed_by_task') AND delay_wakeup_time <= '{$delay_wakeup_time}')  ) {$specific_working_nodes} 
			ORDER BY priority ASC, date_modified ASC
			LIMIT 1
		";
		wfm_utils::wfm_log('debug', '$sql=['.var_export($sql, true).']', __FILE__, __METHOD__, __LINE__);
		$working_node_query = $db->query($sql); // status=executing means that a php-script is already executing this working_node, so do NOT execute it again
		$working_node_row = $db->fetchByAssoc($working_node_query);

		wfm_utils::wfm_log('debug', '$working_node_row=['.var_export($working_node_row, true).']', __FILE__, __METHOD__, __LINE__);

		if ($working_node_row != null) {

			// Manage Subprocess concurrence
			if ($working_node_row['type'] == 'subprocess_sequential') {

				$sql_executing = "
					SELECT *
					FROM asol_workingnodes
					WHERE status = 'executing' AND asol_events_id_c ='{$working_node_row['asol_events_id_c']}'
				";
				$query_executing = $db->query($sql_executing);

				if ($query_executing->num_rows > 0) { // If another working_node with the same event(subprocess_sequential) is being executed then make current working_node sleep for a while
					wfm_utils::putWorkingNodeToSleep($working_node_row);
					wfm_utils::wfm_log('debug', 'continue due to: subprocess concurrence', __FILE__, __METHOD__, __LINE__);
					continue;
				}

				usleep(rand(1000000, 2000000)); // TODO Improve -> Avoid that two o more working_node execute at the same time

				$sql_executing = "
					SELECT *
					FROM asol_workingnodes
					WHERE status = 'executing' AND asol_events_id_c ='{$working_node_row['asol_events_id_c']}'
				";
				$query_executing = $db->query($sql_executing);

				if ($query_executing->num_rows > 0) { // If another working_node with the same event(subprocess_sequential) is being executed then make current working_node sleep for a while
					wfm_utils::putWorkingNodeToSleep($working_node_row);
					wfm_utils::wfm_log('debug', 'continue due to: subprocess concurrence', __FILE__, __METHOD__, __LINE__);
					continue;
				}
			}

			$process_instance_query = $db->query("
				SELECT *
				FROM asol_processinstances
				WHERE id = '{$working_node_row['asol_processinstances_id_c']}'
		    ");
			$process_instance_row = $db->fetchByAssoc($process_instance_query);

			// Make sure no start-event is executed while initialize-event is being executed (within the same WorkFlow).
			$initialize_working_node = wfm_utils::getInitializeWorkingNode($process_instance_row['asol_process_id_c']);
			if ($initialize_working_node['status'] == 'executing') {
				//wfm_utils::putWorkingNodeToSleep($working_node_row);
				sleep(1);
				wfm_utils::wfm_log('debug', 'continue due to: initialize-event is being executed', __FILE__, __METHOD__, __LINE__);
				continue;
			}

			// Execute working_node
			execute_working_node($process_instance_row, $working_node_row);
			$execution_counter++;
		}

		wfm_utils::wfm_log('debug', "Inside do-while \$execution_counter=[{$execution_counter}]", __FILE__, __METHOD__, __LINE__);

	} while (($working_node_row != null));

	$log = "Number of working-nodes executed=[{$execution_counter}]";
	wfm_utils::wfm_log('info', $log, __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_echo('crontab', $log);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
}

function execute_working_node($process_instance, $working_node) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);
	
	$logWorkingNode = $working_node;
	unset($logWorkingNode['custom_variables']);
	wfm_utils::wfm_log('asol_debug', 'Execute working_node=['.var_export($logWorkingNode, true).']', __FILE__, __METHOD__, __LINE__);

	$current_user_id = $working_node['created_by'];
	$alternative_database = wfm_utils::getAlternativeDatabase_fromProcessId($process_instance['asol_process_id_c']);
	$trigger_module = wfm_utils::getTriggerModule_fromProcessId($process_instance['asol_process_id_c']);
	$old_bean = unserialize(base64_decode($working_node['old_bean']));
	$new_bean = unserialize(base64_decode($working_node['new_bean']));
	$custom_variables = unserialize(base64_decode($working_node['custom_variables']));
	$custom_variables['GLOBAL_CVARS'] = wfm_utils::getGlobalCustomVariables($process_instance['asol_process_id_c']);
	wfm_utils::wfm_log('debug', 'GLOBAL_CVARS=['.var_export($custom_variables['GLOBAL_CVARS'], true).']', __FILE__, __METHOD__, __LINE__);
	//
	$object_ids = explode('${pipe}', $working_node['object_ids']);
	$scheduled_type = wfm_utils::getScheduledType_fromEventId($working_node['asol_events_id_c']);

	wfm_utils::wfm_log('asol', "\$trigger_module=[{$trigger_module}]", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('asol', '$working_node[\'iter_object\']=['.$working_node['iter_object'].']', __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('asol', '$object_ids[$working_node[\'iter_object\']]=['.$object_ids[$working_node['iter_object']].']', __FILE__, __METHOD__, __LINE__);

	global $db, $sugar_config;

	// Get activityDelay
	if (!(($scheduled_type == 'sequential') && ($working_node['iter_object'] != 0))) {// If scheduled_type=sequential -> only get activityDelay for the first object
		$activityDelay = getActivityDelay($working_node['asol_activity_id_c']);
		wfm_utils::wfm_log('asol', 'activityDelay=['.var_export($activityDelay, true).']'." for wfm-activity=[{$working_node['asol_activity_id_c']}]", __FILE__, __METHOD__, __LINE__);
	}

	if ((empty($working_node['asol_task_id_c'])) && ($activityDelay) && ($working_node['status'] != 'delayed_by_activity') && ($working_node['status'] != 'delayed_by_task')) {//////***** si la task es null AND si hay delay para la current_activity AND estado del nodo != delayed
		wfm_utils::wfm_log('debug', "inside if-si la task es null AND si hay delay para la current_activity AND estado del nodo != delayed", __FILE__, __METHOD__, __LINE__);

		$delay_wakeup_time = calculateWakeUpDelay($activityDelay);
		$date_modified = gmdate('Y-m-d H:i:s');

		$db->query("
						UPDATE asol_workingnodes
						SET status = 'delayed_by_activity', delay_wakeup_time = '{$delay_wakeup_time}', date_modified = '{$date_modified}' 
						WHERE id = '{$working_node['id']}'
				   ");
	} else {///////******* si la task no es null OR si no hay delay para la current_activity OR estado del nodo == delayed

		wfm_utils::wfm_log('debug', "inside else-si la task no es null OR si no hay delay para la current_activity OR estado del nodo == delayed", __FILE__, __METHOD__, __LINE__);

		// Initialize working_node at executing status
		$date_modified = gmdate('Y-m-d H:i:s');

		$sql = "
			UPDATE asol_workingnodes 
			SET status = 'executing', date_modified = '{$date_modified}' 
			WHERE id = '{$working_node['id']}' AND status != 'executing'
	    ";
		$db->query($sql);
		wfm_utils::checkAffectedRows('concurrence_error', $sql, __FILE__, __METHOD__, __LINE__);

		// Flag for wfm-task delay
		$working_node_is_delayed_by_task = ($working_node['status'] == 'delayed_by_task') ? true : false;
		//wfm_utils::wfm_log('debug', '$working_node_is_delayed_by_task=['.var_export($working_node_is_delayed_by_task, true).']', __FILE__, __METHOD__, __LINE__);

		$appliesConditions_flag = false;

		// Check conditions if trigger_type=scheduled and scheduled_type=sequential
		if ($scheduled_type == 'sequential') {
			$more_objects_to_check_appliesConditions = true; // check the first object

			// Check conditions for the current object
			$new_bean = wfm_utils::wfm_get_bean_variable_array($alternative_database, $trigger_module, $object_ids[$working_node['iter_object']]);

			$activity_query = $db->query("
											SELECT conditions, id, name
											FROM asol_activity
											WHERE id = '{$working_node['asol_activity_id_c']}'
										");
			$activity_row = $db->fetchByAssoc($activity_query);

			while ($more_objects_to_check_appliesConditions) {
				wfm_utils::wfm_log('debug', "Check appliesConditions for wfm-activity=[name=[{$activity_row['name']}], id=[{$activity_row['id']}]]", __FILE__, __METHOD__, __LINE__);
				$appliesConditions_flag = appliesConditions($trigger_module, $object_ids[$working_node['iter_object']], $activity_row['conditions'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);
				if ($appliesConditions_flag) {
					wfm_utils::wfm_log('debug', "The wfm-activity=[name=[{$activity_row['name']}], id=[{$activity_row['id']}]] Applies conditions=[{$activity_row['conditions']}]", __FILE__, __METHOD__, __LINE__);
					break;
				} else {
					wfm_utils::wfm_log('debug', "The wfm-activity=[name=[{$activity_row['name']}], id=[{$activity_row['id']}]] does NOT Applies conditions=[{$activity_row['conditions']}]", __FILE__, __METHOD__, __LINE__);
				}
				$more_objects_to_check_appliesConditions = updateIterObject($process_instance, $working_node, $alternative_database, $trigger_module, $new_bean, $custom_variables, true);
				$object_ids = explode('${pipe}', $working_node['object_ids']); // need to refresh object_ids
			}
		} else {
			$appliesConditions_flag = true;
		}

		if ($appliesConditions_flag) {

			// Get wfm-tasks to execute for current working_node activity
			$tasksQuery = $db->query("
										SELECT asol_task.* 
										FROM asol_task 
										LEFT JOIN asol_activity_asol_task_c 
										ON asol_activity_asol_task_c.asol_activf613ol_task_idb = asol_task.id AND asol_activity_asol_task_c.deleted = 0
										WHERE asol_activity_asol_task_c.asol_activ5b86ctivity_ida = '{$working_node['asol_activity_id_c']}' AND asol_task.deleted = 0
										ORDER BY asol_task.task_order
									 ");
			$tasks = Array();
			while ($rowTask = $db->fetchByAssoc($tasksQuery)) {
				$tasks[] = $rowTask;
			}

			// To allow that an activity can have no wfm-tasks. Otherwise, it will not clean the database correctly.
			if (empty($tasks)) {

				$nextTask = null;///+++ simulamos que acabamos de ejecutar la ultima task y por lo tanto ya no hay nada mas que ejecutar (para no duplicar código)
				$next_activities = getNextActivities_appliesConditions($scheduled_type, $working_node['asol_activity_id_c'], $nextTask, $trigger_module, $working_node['object_ids'], $process_instance['asol_processinstances_id_c'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);

				// Manage working_nodes -> Continue executing the WorkFlow
				manageWorkingNodes(null, $next_activities, $nextTask, $process_instance, $working_node, $executeResult, $current_user_id, $old_bean, $new_bean, $custom_variables);
			}

			// Remove tasks that has been already executed based on $working_node['current_task']. If current_task is 'null', the current task will be the first task of the current activity
			wfm_utils::wfm_log('debug', 'All tasks from current activity -> $tasks=['.var_export($tasks, true).']', __FILE__, __METHOD__, __LINE__);
			wfm_utils::wfm_log('debug', "\$working_node['asol_task_id_c']=[".var_export($working_node['asol_task_id_c'], true)."]", __FILE__, __METHOD__, __LINE__);

			if ( !(empty($working_node['asol_task_id_c'])) ) {
				$i=0;
				while ($tasks[$i]['id'] != $working_node['asol_task_id_c']) {
					$i++;
				}
				$tasks = array_slice($tasks, $i);
			}

			wfm_utils::wfm_log('debug', 'Execute the following tasks -> $tasks=['.var_export($tasks ,true).']', __FILE__, __METHOD__, __LINE__);

			// Execute obtained wfm-tasks
			foreach ($tasks as $keyT => $task) {

				wfm_utils::wfm_log('debug', 'Execute this wfm-task -> $task=['.var_export($task ,true).']', __FILE__, __METHOD__, __LINE__);

				// Calculate wfm-task delay
				if ($working_node_is_delayed_by_task) { // Do not re-calculate wakeup_delay_time for the task that was delayed(and its delay has already been expired)
					$taskDelayStartTime = false;
					$working_node_is_delayed_by_task = false;
				} else {
					$taskDelayStartTime = getTaskStartDelayTime($task['delay_type'], $task['delay'], $trigger_module, $object_ids[$working_node['iter_object']]);
				}

				wfm_utils::wfm_log('asol', '$taskDelayStartTime=['.var_export($taskDelayStartTime, true).']'." for wfm-task=[name=[{$task['name']}], id=[{$task['id']}]]", __FILE__, __METHOD__, __LINE__);

				if (!$taskDelayStartTime) { // If current wfm-task has no delay, execute it
					wfm_utils::wfm_log('asol', "The current wfm-task=[name=[{$task['name']}], id=[{$task['id']}]] has NO delay. Execute the wfm-task", __FILE__, __METHOD__, __LINE__);

					//$executeResult = Array();
					// If the task is a create_object or a modify object, it will return an array as this Array('object_id', 'object_module').
					// If the task is not successful, it will return 'false';else it will return 'true'.
					// If ($process_instance['asol_processinstances_id_c'] != null) -> it is a subprocess
					// A subprocess can not call another subprocess
					// You can not modify_object inside a subprocess
					if (     (($task['task_type'] != 'modify_object') && ($task['task_type'] != 'call_process') && ($process_instance['asol_processinstances_id_c'] != null))      || ($process_instance['asol_processinstances_id_c'] == null) ) {

						wfm_utils::wfm_log('debug', 'GLOBAL_CVARS=['.var_export($custom_variables['GLOBAL_CVARS'], true).']', __FILE__, __METHOD__, __LINE__);

						$executeResult = executeTask($task['id'], $task['task_type'], $task['task_implementation'], $alternative_database, $trigger_module, $object_ids[$working_node['iter_object']], $working_node['asol_processinstances_id_c'], $working_node['id'], $process_instance['bean_ungreedy_count'], $old_bean, $new_bean, $custom_variables, $current_user_id);	//Every task execution will return true if is succesful (an id if is a create or a modify object)
						wfm_utils::wfm_log('asol', '$executeResult=['.var_export($executeResult,true).']'." for wfm-task=[name=[{$task['name']}], id=[{$task['id']}]]", __FILE__, __METHOD__, __LINE__);

						// Manage create_object/modify_object
						switch ($task['task_type']) {
							case 'create_object':
								$custom_variables['created_object'] = $executeResult['created_object'];
								//break;
							case 'modify_object':
								$custom_variables['object_id'] = $executeResult['object_id'];
								$custom_variables['object_module'] = $executeResult['object_module'];
								break;
						}

						// Manage Global Custom Variables
						switch ($task['task_type']) {
							case 'php_custom':
							case 'add_custom_variables':
								// Update global_custom_variables in working_node-initialize
								wfm_utils::setGlobalCustomVariables($process_instance['asol_process_id_c'], $custom_variables['GLOBAL_CVARS']);
								break;
							case 'call_process': // Maybe a subprocess updated the global_custom_variables. So we need to reload them in order to have fresh data for the next_task.
								$custom_variables['GLOBAL_CVARS'] = wfm_utils::getGlobalCustomVariables($process_instance['asol_process_id_c']);
								break;
						}

						wfm_utils::wfm_log('debug', 'GLOBAL_CVARS=['.var_export($custom_variables['GLOBAL_CVARS'], true).']', __FILE__, __METHOD__, __LINE__);

						// If task_type=end then break the foreach execution in order to not execute the following tasks (there should not be following tasks).
						if ($task['task_type'] == "end") {
							wfm_utils::wfm_log('asol', "task_type=end´s break", __FILE__, __METHOD__, __LINE__);
							break;
						}
					}

					// Get next wfm-task
					$nextTask = (!empty($tasks[$keyT+1]['id'])) ? $tasks[$keyT+1]['id'] : null;

					// Manage iter_object
					if ($scheduled_type == 'sequential') {
						if ($nextTask == null) { // Check if there is no nextTask
							wfm_utils::wfm_log('debug', "If the last wfm-task has been executed for this object_id", __FILE__, __METHOD__, __LINE__);

							if ($more_objects_to_execute = updateIterObject($process_instance, $working_node, $alternative_database, $trigger_module, $new_bean, $custom_variables, false)) {
								break;
							}
						}
					}

					// Get next wfm-activity
					$next_activities = getNextActivities_appliesConditions($scheduled_type, $working_node['asol_activity_id_c'], $nextTask, $trigger_module, $working_node['object_ids'], $process_instance['asol_processinstances_id_c'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);

					// Manage Working Nodes -> Continue executing the WorkFlow
					if ($onHold = manageWorkingNodes($task, $next_activities, $nextTask, $process_instance, $working_node, $executeResult, $current_user_id, $old_bean, $new_bean, $custom_variables)) {
						break;
					}

				} else { // If current task has delay, update the node in the database with status delayed and the expected wakeup_time_delay
					wfm_utils::wfm_log('asol', "The current wfm-task=[name=[{$task['name']}], id=[{$task['id']}]] has delay, update the working_node in the database with status=delayed_by_task and the expected wakeup_time_delay. Do NOT execute the wfm-task", __FILE__, __METHOD__, __LINE__);

					$delay_wakeup_time = calculateWakeUpDelay($task['delay'], $taskDelayStartTime);
					$date_modified = gmdate('Y-m-d H:i:s');

					$db->query("
								UPDATE asol_workingnodes 
								SET status = 'delayed_by_task', delay_wakeup_time = '{$delay_wakeup_time}', date_modified = '{$date_modified}'
								WHERE id = '{$working_node['id']}'
						   ");
					break;
				}
			}
		} else { // Not even one object applied the conditions
			$nextTask = null;///+++ simulamos que acabamos de ejecutar la ultima task y por lo tanto ya no hay nada mas que ejecutar (para no duplicar código)
			$next_activities = getNextActivities_appliesConditions($scheduled_type, $working_node['asol_activity_id_c'], $nextTask, $trigger_module, $working_node['object_ids'], $process_instance['asol_processinstances_id_c'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database);

			// Manage working_nodes -> Continue executing the WorkFlow
			manageWorkingNodes(null, $next_activities, $nextTask, $process_instance, $working_node, $executeResult, $current_user_id, $old_bean, $new_bean, $custom_variables);
		}
	}

	// CLEAN DATABASE
	cleanDatabase($process_instance, $working_node);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
}

function updateIterObject($process_instance, &$working_node, $alternative_database, $trigger_module, &$new_bean, &$custom_variables, $remove_current_object) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$more_objects_to_execute = false;

	$object_ids = explode('${pipe}', $working_node['object_ids']);
	wfm_utils::wfm_log('debug', '$object_ids=['.var_export($object_ids, true).']', __FILE__, __METHOD__, __LINE__);
	if ($remove_current_object) {
		array_splice($object_ids, $working_node['iter_object'], 1);
		$working_node['object_ids'] = implode('${pipe}', $object_ids);
	} else {
		$working_node['iter_object']++;
	}

	wfm_utils::wfm_log('debug', '$working_node[\'iter_object\']=['.var_export($working_node['iter_object'], true).']', __FILE__, __METHOD__, __LINE__);

	if ($working_node['iter_object'] < count($object_ids)) { // Check if WFM has to execute another object_id for this wfm-activity
		wfm_utils::wfm_log('debug', "If there are still object_ids to execute -> change de object_id for the current wfm-activity", __FILE__, __METHOD__, __LINE__);

		updateIterObjectDB($process_instance, $working_node, $alternative_database, $trigger_module, $object_ids, $new_bean, $custom_variables, $remove_current_object);

		$more_objects_to_execute = true;
		//break;
	} elseif ($working_node['iter_object'] == count($object_ids)) {
		wfm_utils::wfm_log('debug', "If there are NO object_ids to execute -> change de object_id TO 0 for the current wfm-activity", __FILE__, __METHOD__, __LINE__);

		$working_node['iter_object'] = 0;
		updateIterObjectDB($process_instance, $working_node, $alternative_database, $trigger_module, $object_ids, $new_bean, $custom_variables, $remove_current_object);
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $more_objects_to_execute;
}

function updateIterObjectDB($process_instance, $working_node, $alternative_database, $trigger_module, $object_ids, &$new_bean, &$custom_variables, $remove_current_object) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $db;

	$current_task = 'null';
	$new_bean = wfm_utils::wfm_get_bean_variable_array($alternative_database, $trigger_module, $object_ids[$working_node['iter_object']]);

	$new_bean_to_db = base64_encode(serialize($new_bean));
	$custom_variables['iter_object'] = $working_node['iter_object'];
	$custom_variables_to_db = base64_encode(serialize($custom_variables));
	$date_modified = gmdate('Y-m-d H:i:s');

	$remove_current_object_query_string = ($remove_current_object) ? "object_ids = '{$working_node['object_ids']}', " : '';

	$db->query("
					UPDATE asol_workingnodes 
					SET status = 'in_progress', {$remove_current_object_query_string} iter_object = '{$working_node['iter_object']}', parent_type = '{$trigger_module}', parent_id = '{$object_ids[$working_node['iter_object']]}', asol_task_id_c = {$current_task}, new_bean = '{$new_bean_to_db}', custom_variables = '{$custom_variables_to_db}', date_modified = '{$date_modified}'
					WHERE id='{$working_node['id']}'
			   ");

}

function cleanDatabase($process_instance, $working_node) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	global $db;

	if ($working_node['type'] == 'initialize') {// If another process_instance has the same process_id => do not clean
		$sql = "
			SELECT id
			FROM asol_processinstances
			WHERE asol_process_id_c = '{$process_instance['asol_process_id_c']}'
		";
		$query = $db->query($sql);
		if ($query->num_rows >= 2) {
			return;
		}
	}

	$number_of_active_working_nodes__query_2 = $db->query("
																SELECT count(id) AS counter
																FROM asol_workingnodes
																WHERE status != 'terminated' AND asol_processinstances_id_c = '{$process_instance['id']}'
														");
	$number_of_active_working_nodes__row_2 = $db->fetchByAssoc($number_of_active_working_nodes__query_2);

	if ($number_of_active_working_nodes__row_2['counter'] == '0') {

		$db->query ("
						DELETE FROM asol_workingnodes
						WHERE status = 'terminated' AND asol_processinstances_id_c = '{$process_instance['id']}'
					");
		$db->query("
						DELETE FROM asol_processinstances
						WHERE id = '{$process_instance['id']}'
				   ");
		$db->query("
						DELETE FROM asol_onhold
						WHERE asol_processinstances_id_c = '{$process_instance['id']}'
				   ");
	}
}

function manageWorkingNodes($task, $next_activities, $nextTask, $process_instance, $working_node, $executeResult, $current_user_id, $old_bean, $new_bean, $custom_variables) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	// asol_domains
	$working_node['asol_domain_id'] = (!empty($working_node['asol_domain_id'])) ? $working_node['asol_domain_id'] : "''";
	$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
	$asol_domains_query_1 = ($isDomainsInstalled) ? ', asol_domain_id' : '';
	$asol_domains_query_2 = ($isDomainsInstalled) ? ", {$working_node['asol_domain_id']}" : '';

	global $db;

	if (count($next_activities) >= 2) { // This branch ends and two or more branchs are borne from the branch that is going to die.

		wfm_utils::wfm_log('debug', "count(next_activities)>=2", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', "This branch ends and two or more branchs are borne from the branch that is going to die", __FILE__, __METHOD__, __LINE__);

		// Terminate current working_node and add to DB the new working_nodes
		$date_modified = gmdate('Y-m-d H:i:s');

		$db->query("
						UPDATE asol_workingnodes 
						SET status = 'terminated', date_modified = '{$date_modified}'
						WHERE id = '{$working_node['id']}'
				   ");

		foreach ($next_activities as $next_activity_id) {

			$id3 = create_guid();
			$working_node_ids[] = $id3;//TODO
			$name3 = "w_n_".$id3;
			$type = $working_node['type'];
			$date_entered = gmdate("Y-m-d H:i:s");
			$date_modified = gmdate("Y-m-d H:i:s");
			$event = $working_node['asol_events_id_c'];
			$object_ids = $working_node['object_ids'];
			$iter_object = $working_node['iter_object'];
			$object_ids_array = explode('${pipe}', $object_ids);
			$object_id = $object_ids_array[$iter_object];
			$current_task = 'null';
			$delay_wakeup_time = '0000-00-00 00:00:00';
			$created_by = $current_user_id;
			$modified_user_id = $current_user_id;
			$assigned_user_id = $current_user_id;
			$status = 'not_started';
			$old_bean_to_db = base64_encode(serialize($old_bean));
			$new_bean_to_db = base64_encode(serialize($new_bean));
			$custom_variables_to_db = base64_encode(serialize($custom_variables));

			$db->query("
				INSERT INTO asol_workingnodes 
							(id      , name      , type     , asol_processinstances_id_c , priority                     , date_entered     , date_modified     , asol_events_id_c, asol_activity_id_c   , object_ids     , iter_object   , parent_type        , parent_id     , asol_task_id_c , delay_wakeup_time     , created_by     , modified_user_id     , assigned_user_id     , status     , old_bean           , new_bean           , custom_variables            {$asol_domains_query_1})
				VALUES      ('{$id3}', '{$name3}', '{$type}', '{$process_instance['id']}', '{$working_node['priority']}', '{$date_entered}', '{$date_modified}', '{$event}'      , '{$next_activity_id}', '{$object_ids}', {$iter_object}, '{$trigger_module}', '{$object_id}', {$current_task}, '{$delay_wakeup_time}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}', '{$status}', '{$old_bean_to_db}', '{$new_bean_to_db}', '{$custom_variables_to_db}' {$asol_domains_query_2})
		    ");
		}
	} elseif (count($next_activities) == 1) { // Follow with the same branch

		wfm_utils::wfm_log('debug', "count(next_activities)==1", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', "Follow with the same branch", __FILE__, __METHOD__, __LINE__);

		if ($nextTask != null) { // If there is another wfm-task

			$date_modified = gmdate('Y-m-d H:i:s');

			$db->query("
							UPDATE asol_workingnodes 
							SET asol_task_id_c = '{$nextTask}', date_modified = '{$date_modified}' 
							WHERE id = '{$working_node['id']}'
					   ");
		} else { // If the wfm-task executed is the last one

			$current_task = 'null';
			$date_modified = gmdate('Y-m-d H:i:s');

			$db->query("
							UPDATE asol_workingnodes 
							SET status = 'in_progress', asol_activity_id_c = '{$next_activities[0]}', asol_task_id_c = {$current_task}, date_modified = '{$date_modified}' 
							WHERE id = '{$working_node['id']}'
					   ");
		}

		// Update custom_variables
		$custom_variables_to_db = base64_encode(serialize($custom_variables));

		$date_modified = gmdate('Y-m-d H:i:s');

		$db->query("
						UPDATE asol_workingnodes 
						SET custom_variables = '{$custom_variables_to_db}', date_modified = '{$date_modified}' 
						WHERE id = '{$working_node['id']}'
				   ");

		// on_hold
		if ($task != null) { // task=null => no wfm-task or no object
			$on_hold_Result = checkUpdateOnHold($task['id'], $nextTask, $process_instance['id'], $working_node['priority'], $working_node['id'], $executeResult['object_id'], $executeResult['object_module']);////****para task ( task/call) de Sugar//*******en $executeResult vendra el object_id(bean_id) si fue una task create_object o modify_object(modify_object NOO!!)
			wfm_utils::wfm_log('asol', '$on_hold_Result=['.var_export($on_hold_Result, true).']', __FILE__, __METHOD__, __LINE__);

			if ($on_hold_Result) {

				$date_modified = gmdate('Y-m-d H:i:s');

				$db->query("
							UPDATE asol_workingnodes 
							SET status = 'held', date_modified = '{$date_modified}' 
							WHERE id = '{$working_node['id']}'
					   ");
				//break;
			}
		}
	} else { // There is no next_activity in this branch, the branch dies with no children
		wfm_utils::wfm_log('debug', "count(next_activities)==0", __FILE__, __METHOD__, __LINE__);
		wfm_utils::wfm_log('debug', "There is no next_activity in this branch, the branch dies with no children", __FILE__, __METHOD__, __LINE__);

		// End current working_node

		$date_modified = gmdate('Y-m-d H:i:s');

		$db->query("
						UPDATE asol_workingnodes 
						SET status = 'terminated', date_modified = '{$date_modified}' 
						WHERE id = '{$working_node['id']}'
				   ");
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $on_hold_Result;
}

function getActivityDelay($activity_id) { //This function just returns the delay field for a given activity_id
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	global $db;

	$activityDelayQuery = $db->query("
										SELECT delay 
										FROM asol_activity 
										WHERE id = '{$activity_id}' 
										LIMIT 1
									 ");
	$activityDelayRow = $db->fetchByAssoc($activityDelayQuery);

	$delay_array = explode(' - ',$activityDelayRow['delay']);
	if ($delay_array[1] == '0') {
		return false;
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $activityDelayRow['delay'];
}


function calculateWakeUpDelay($delay, $taskTime = false) {	// Calculates a wakeupDatetime based on current GMT Time and a given delay (e.g. 'hours - 5') //****** Either  it is a activity delay or it is a task delay. It is all done in the same function because the working node can be awaken by either activity delay or task delay.
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	$wakeUpDate = false;
	$delayArray = explode(" - ", $delay);

	if (!$taskTime) { //is Activity Delay
		if ($delayArray[1] != '0') {
			switch ($delayArray[0]) {
				case "minutes":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime(gmdate("H"), gmdate("i")+$delayArray[1], gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
					break;
				case "hours":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime(gmdate("H")+$delayArray[1], gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
					break;
				case "days":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime(gmdate("H"), gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d")+$delayArray[1], gmdate("Y")));
					break;
				case "weeks":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime(gmdate("H"), gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d")+($delayArray[1]*7), gmdate("Y")));
					break;
				case "months":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime(gmdate("H"), gmdate("i"), gmdate("s"), gmdate("m")+$delayArray[1], gmdate("d"), gmdate("Y")));
					break;
			}
		}
	} else { //is Task Delay
		if ($delayArray[1] != '0') {
			$dateTime = explode(" ", $taskTime);
			$date = explode("-", $dateTime[0]);
			$time = explode(":", $dateTime[1]);

			switch ($delayArray[0]) {
				case "minutes":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime($time[0], $time[1]+$delayArray[1], $time[2], $date[1], $date[2], $date[0]));
					break;
				case "hours":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime($time[0]+$delayArray[1], $time[1], $time[2], $date[1], $date[2], $date[0]));
					break;
				case "days":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime($time[0], $time[1], $time[2], $date[1], $date[2]+$delayArray[1], $date[0]));
					break;
				case "weeks":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime($time[0], $time[1], $time[2], $date[1], $date[2]+($delayArray[1]*7), $date[0]));
					break;
				case "months":
					$wakeUpDate  = date("Y-m-d H:i:s", mktime($time[0], $time[1], $time[2], $date[1]+$delayArray[1], $date[2], $date[0]));
					break;
			}
		}
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $wakeUpDate;
}

function getTaskStartDelayTime($delay_type, $delay, $trigger_module, $bean_id) { //This function returns a datetime based on a delay type and a delay (e.g. 'minutes - 8')
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	global $beanList, $beanFiles, $db;

	$taskDelayTime = false;
	$delayArray = explode (" - ", $delay);

	if (($delay_type != "no_delay") && ($delayArray[1] != '0')) {
		if ($delay_type == "on_finish_previous_task") { //Standard Delay ////////////********** ésto es para esperar por la anterior tarea //// si la anterior tarea es una sugar-task entonces habra que hacer lo de los logic hooks para saber cuando terminan las sugar-tasks
			$taskDelayTime = gmdate('Y-m-d H:i:s');
		} else if ($delay_type == "on_creation") {///////////////*********este type de delay_task es para en vez de tener de base de tiempos del delay a la tarea anterior... pues tener a cuando se creo el modulo que disparo el evento ... event_type = on_create (Account, Opportunities, etc...)

			// Get and retrieve the current record of the main module
			$class_name = $beanList[$trigger_module];
			require_once($beanFiles[$class_name]);
			$bean = new $class_name();
			$bean_table = $bean->table_name;

			$onCreationDelayQuery = $db->query("
													SELECT date_entered 
													FROM {$bean_table} 
													WHERE id = '{$bean_id}' 
													LIMIT 1
											   ");
			$onCreationDelayRow = $db->fetchByAssoc($onCreationDelayQuery);

			$taskDelayTime = $onCreationDelayRow['date_entered'];
		} else if ($delay_type == "on_modification") {

			// Get and retrieve the current record of the main module
			$class_name = $beanList[$trigger_module];
			require_once($beanFiles[$class_name]);
			$bean = new $class_name();
			$bean_table = $bean->table_name;

			$onModificationDelayQuery = $db->query("
														SELECT date_modified 
														FROM {$bean_table}
														WHERE id = '{$bean_id}' 
														LIMIT 1
												   ");
			$onModificationDelayRow = $db->fetchByAssoc($onModificationDelayQuery);

			$taskDelayTime = $onModificationDelayRow['date_modified'];
		}
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $taskDelayTime;
}

function getNextActivities_appliesConditions($scheduled_type, $current_activity, $nextTask, $trigger_module, $bean_id, $parent_process_instance_id, $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database) { //Return the next activities for a current activity and task. Checks if the returned activities applies the conditions for the context bean_id.

	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	global $db;
	$nextActivities = array();

	if ($nextTask != null) { ///*** Si la task es != null -> es que aun quedan tareas por ejecutar en esta actividad -> seguimos con la misma actividad
		return $nextActivities[] = $current_activity;
	} else {
		// Get from database the next activities for current_activity. Check if activities applies with the defined condition.
		$nextActivitiesQuery = $db->query("
												SELECT asol_activisol_activity_c.asol_activ9e2dctivity_idb AS activity_id, asol_activity.conditions
												FROM asol_activisol_activity_c
												LEFT JOIN asol_activity
												ON asol_activisol_activity_c.asol_activ9e2dctivity_idb = asol_activity.id AND asol_activity.deleted = 0
												WHERE asol_activisol_activity_c.asol_activ898activity_ida = '{$current_activity}' AND asol_activisol_activity_c.deleted = 0
										  ");
		while ($nextActivityRow = $db->fetchByAssoc($nextActivitiesQuery)) { // Check if next activities accept the start condition
			if ($parent_process_instance_id == null) { // trigger_type!=subprocess

				if ($scheduled_type == 'sequential') {
					$nextActivities[] = $nextActivityRow['activity_id'];
				} else { // parallel or trigger_type==logic_hook(scheduled_type=='')
					if (appliesConditions($trigger_module, $bean_id, $nextActivityRow['conditions'], $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database)) {
						$nextActivities[] = $nextActivityRow['activity_id'];
					}
				}
			} else { // trigger_type==subprocess
				$nextActivities[] = $nextActivityRow['activity_id'];
			}
		}
	}

	wfm_utils::wfm_log('asol', '$nextActivities=['.var_export($nextActivities, true)."] for wfm-activity=[{$current_activity}]", __FILE__, __METHOD__, __LINE__);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $nextActivities;
}

function checkUpdateOnHold($previous_task_id, $task_id, $process_instance_id, $priority, $working_node_id, $object_id, $object_module) { // Check if a activity must wait for the previous one to be manually closed and if it is, insert it into the on_hold DB table
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	global $db, $sugar_config;

	$isOnHold = false;

	if ($task_id != null) {
		$previousQuery = $db->query("
										SELECT task_type, task_implementation 
										FROM asol_task 
										WHERE id = '{$previous_task_id}' 
										LIMIT 1
									");
		$previousRow = $db->fetchByAssoc($previousQuery);
		//wfm_utils::wfm_log('debug', "\$previousRow['task_type']=".$previousRow['task_type'], __FILE__, __METHOD__, __LINE__);

		if ($previousRow['task_type'] == "create_object") {

			$impl_array = explode("\${mod}", $previousRow['task_implementation']);
			//wfm_utils::wfm_log('debug', "\$impl_array=".print_r($impl_array,true), __FILE__, __METHOD__, __LINE__);
			$impl_array_2 = explode("\${pipe}", $impl_array[1]);
			//wfm_utils::wfm_log('debug', "\$impl_array_2=".print_r($impl_array_2,true), __FILE__, __METHOD__, __LINE__);
			$impl_array_3 = explode("\${dp}", $impl_array_2[3]);
			//wfm_utils::wfm_log('debug', "\$impl_array_3=".print_r($impl_array_3,true), __FILE__, __METHOD__, __LINE__);

			if (  ( ($impl_array[0] == "Calls")&&($impl_array_3[1] != "Held") ) || ( ($impl_array[0] == "Tasks")&&($impl_array_3[1] != "Completed") )  ) {
				$currentQuery = $db->query("
												SELECT * 
												FROM asol_task 
												WHERE id = '{$task_id}' 
												LIMIT 1
										   ");
				$currentRow = $db->fetchByAssoc($currentQuery);
				//wfm_utils::wfm_log('debug', "\$currentRow['delay_type']=".$currentRow['delay_type'], __FILE__, __METHOD__, __LINE__);
					
				if ($currentRow['delay_type'] == "on_finish_previous_task") {

					$id4 = create_guid();
					$name4 = "o_h_".$id4;
					$date_entered = gmdate('Y-m-d H:i:s');
					$date_modified = gmdate('Y-m-d H:i:s');
					$current_user_id = $currentRow['created_by'];
					$created_by = $current_user_id;
					$modified_user_id = $current_user_id;
					$assigned_user_id = $current_user_id;

					// asol_domains
					$currentRow['asol_domain_id'] = (!empty($currentRow['asol_domain_id'])) ? $currentRow['asol_domain_id'] : "''";
					$isDomainsInstalled = wfm_domains_utils::wfm_isDomainsInstalled();
					$asol_domains_query_1 = ($isDomainsInstalled) ? ', asol_domain_id' : '';
					$asol_domains_query_2 = ($isDomainsInstalled) ? ", {$currentRow['asol_domain_id']}" : '';

					$db->query("
									INSERT INTO asol_onhold (id, name, date_entered, date_modified, parent_id, parent_type, asol_processinstances_id_c, asol_workingnodes_id_c, created_by, modified_user_id, assigned_user_id {$asol_domains_query_1})
									VALUES ('{$id4}', '{$name4}', '{$date_entered}', '{$date_modified}', '{$object_id}', '{$object_module}', '{$process_instance_id}', '{$working_node_id}', '{$created_by}', '{$modified_user_id}', '{$assigned_user_id}' {$asol_domains_query_2})
							   ");
					$isOnHold = true;
				}
			}
		}
	}

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $isOnHold;
	//Checks if a task needs to be held (only if the task is a create object task/call-sugar and the next task´s delay_type equals on_finish_previous_task)
	//If next task equals null --> nothing to be done
}

function stripslashes_deep($value) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $value;
}

function appliesConditions($trigger_module, $bean_id, $conditions, $current_user_id, $old_bean, $new_bean, $custom_variables, $alternative_database) { //Returns true or false if the given conditions applies for the module bean_id
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', '$new_bean=['.var_export($new_bean, true).']', __FILE__, __METHOD__, __LINE__);

	global /*$current_user,*/ $beanList, $beanFiles, $timedate, $db, $sugar_config;

	$aux = wfm_utils::wfm_getHourOffset_and_TimeZone($current_user_id);
	$hourOffset = $aux['hourOffset'];
	$userTZ = $aux['userTZ'];

	$conditions_array = explode('${pipe}', $conditions);
	$conditions_array = str_replace("&quot;", "&#34;", $conditions_array);
	$conditions_array = stripslashes_deep($conditions_array);
	wfm_utils::wfm_log('debug', '$conditions_array=['.var_export($conditions_array, true).']', __FILE__, __METHOD__, __LINE__);

	if (empty($conditions_array[0])) {
		$conditions_array = Array();
	}

	// In these array, it is going to be stored info about each condition
	$array_appliesCurrentCondition = Array();
	$array_parenthesis = Array();
	$array_logicalOperator = Array();

	foreach ($conditions_array as $condition) {

		$appliesCurrentCondition = null;

		$condition_array = explode('${dp}', $condition);
		wfm_utils::wfm_log('debug', '$condition_array=['.var_export($condition_array, true).']', __FILE__, __METHOD__, __LINE__);

		$fieldName_aux = $condition_array[0];
		$OldBean_NewBean_Changed = $condition_array[1];
		$isChanged = $condition_array[2];
		$operator = $condition_array[3];
		$Param1 = $condition_array[4];
		$Param2 = $condition_array[5];
		$fieldType = $condition_array[6];
		$keyRelated = $condition_array[7];
		$isRelated = $condition_array[8];
		$fieldIndex = $condition_array[9];// index of module_fields, not rowIndex
		$enum_operator = $condition_array[10];
		$enum_reference = $condition_array[11];
		$logical_parameters = $condition_array[12];

		// Get fieldName
		$fieldName_aux_array = explode('${comma}', $fieldName_aux);
		$fieldName = $fieldName_aux_array[0];

		switch ($fieldType) {
			case 'c_var':
				$customVariable_value = $custom_variables[$fieldName];
				$appliesCurrentCondition = check_condition_customVariable($condition, $customVariable_value, $hourOffset, $trigger_module, $current_user_id);
				break;
			case 'g_c_var':
				$customVariable_value = $custom_variables['GLOBAL_CVARS'][$fieldName];
				$appliesCurrentCondition = check_condition_customVariable($condition, $customVariable_value, $hourOffset, $trigger_module, $current_user_id);
				break;
			default:
				if ($isRelated == 'true') {
					$appliesCurrentCondition = check_condition_relatedField($condition, $hourOffset, $userTZ, $trigger_module, $bean_id, $alternative_database, $current_user_id);
				} else {
					// Check if custom_field
					$aux = explode('_cstm', $fieldName);
					if (count($aux) == 2) { // custom_field
						$aux2 = explode('.', $fieldName);
						$fieldName = $aux2[1];
					}

					switch ($OldBean_NewBean_Changed) {

						case 'changed':
							if ($isChanged == 'false') {
								$appliesCurrentCondition = ($new_bean[$fieldName] == $old_bean[$fieldName]) ? true : false;
							} else {
								$appliesCurrentCondition = ($new_bean[$fieldName] == $old_bean[$fieldName]) ? false : true;
							}
							break;

						case 'old_bean':
						case 'new_bean':

							$fieldValue = ${$OldBean_NewBean_Changed}[$fieldName];

							$appliesCurrentCondition = check_condition_notRelatedField($condition, $fieldValue, $hourOffset, $trigger_module, $current_user_id);

							break;
					}
				}
				break;
		}

		// Update arrays
		$array_appliesCurrentCondition[] = $appliesCurrentCondition;

		$logical_parameters_array = explode(':', $logical_parameters);
		$array_parenthesis[] = $logical_parameters_array[0];
		$array_logicalOperator[] = $logical_parameters_array[1];
	}

	wfm_utils::wfm_log('debug', "\$array_appliesCurrentCondition=[".var_export($array_appliesCurrentCondition,true)."] \n\n\n", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', "\$array_parenthesis=[".var_export($array_parenthesis,true)."] \n\n\n", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', "\$array_logicalOperator=[".var_export($array_logicalOperator,true)."] \n\n\n", __FILE__, __METHOD__, __LINE__);

	// Now we are going to make use of :-----> $array_appliesCurrentCondition, $array_parenthesis, $array_logicalOperator

	$parenthesis_equiv = Array(
		'-3' => ')))',
		'-2' => '))',
		'-1' => ')',
		'0' => '',
		'1' => '(',
		'2' => '((',
		'3' => '(((',
	);

	$conditions_equiv = Array(
	true => 'true',
	false => 'false',
	);

	// If $array_logicalOperator has its items equals empty => we assume that they are ANDs
	foreach ($array_logicalOperator as $key => $value) {
		if (!($key == (count($array_logicalOperator)-1))) {
			if ($value == "") {
				$array_logicalOperator[$key] = 'AND';
			}
		}
	}

	// Create the query
	$query = "(";
	foreach ($array_appliesCurrentCondition as $key => $value) {

		if ($array_parenthesis[$key] > 0) {
			$query .= $parenthesis_equiv[$array_parenthesis[$key]] 				. $conditions_equiv[$array_appliesCurrentCondition[$key]] 	. ' '.$array_logicalOperator[$key].' ';
		} else if ($array_parenthesis[$key] < 0) {
			$query .= $conditions_equiv[$array_appliesCurrentCondition[$key]] 	. $parenthesis_equiv[$array_parenthesis[$key]] 				. ' '.$array_logicalOperator[$key].' ';
		} else if ($array_parenthesis[$key] == 0) {
			$query .= $conditions_equiv[$array_appliesCurrentCondition[$key]]	/*. $array_parenthesis[$key] */								. ' '.$array_logicalOperator[$key].' ';
		}

	}
	$query .= ")";

	//wfm_utils::wfm_log('debug', "final after foreach 1 \$query=[".var_export($query,true)."] ", __FILE__, __METHOD__, __LINE__);

	$query = str_replace(array('AND', 'OR'), array('&&', '||'), $query);

	wfm_utils::wfm_log('debug', "final after foreach  \$query=[".var_export($query,true)."] ", __FILE__, __METHOD__, __LINE__);

	$eval_logics = 'return '.$query.' ? "APPLIES" : "NOTapplies";';

	wfm_utils::wfm_log('debug', "final after foreach \$eval_logics=[".var_export($eval_logics,true)."] ", __FILE__, __METHOD__, __LINE__);

	$appliesConditions = eval($eval_logics); // BE CAREFUL -> eval() returns NULL unless return is called in the evaluated code, in which case the value passed to return is returned. If there is a parse error in the evaluated code, eval() returns FALSE and execution of the following code continues normally. It is not possible to catch a parse error in eval() using set_error_handler().

	wfm_utils::wfm_log('debug', "final after foreach  eval(\$eval_logics)=[".var_export($appliesConditions,true)."] ", __FILE__, __METHOD__, __LINE__);

	switch ($appliesConditions) {
		case 'APPLIES':
			$appliesConditions = true;
			break;
		case 'NOTapplies':
			$appliesConditions = false;
			break;
		case false: //If there is a parse error in the evaluated code, eval() returns FALSE
			$appliesConditions = false;
			// If there is no condition it will be a parse error ----> $eval_logics=['return ( true && ()) ? "APPLIES" : "NOTapplies";']
			if ($conditions == '') { // If there is no condition then applies conditions
				$appliesConditions = true;
			}
			break;
	}

	wfm_utils::wfm_log('debug', "\$appliesConditions=[".var_export($appliesConditions,true)."] ", __FILE__, __METHOD__, __LINE__);

	wfm_utils::wfm_log('debug', "EXIT", __FILE__, __METHOD__, __LINE__);
	return $appliesConditions;
}

function check_condition_customVariable($condition, $customVariable_value, $hourOffset, $trigger_module, $current_user_id) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	return check_condition_notRelatedField($condition, $customVariable_value, $hourOffset, $trigger_module, $current_user_id);
}

function check_condition_notRelatedField($condition, $fieldValue, $hourOffset, $trigger_module, $current_user_id) { // regular_field, custom_field
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	// TRANSLATE
	$aux = generateQuery_wfm::translate_conditions_to_filterValues_and_fieldValues($condition, true);
	$field_values = $aux['field_values'];
	$filter_values = $aux['filter_values'];

	$i = 0;

	$user_id = $current_user_id;
	$user_id =  ($user_id !== null) ? $user_id : '1';

	$currentUserAsolConfig = wfm_reports_utils::getCurrentUserAsolConfig($user_id);
	$quarter_month = $currentUserAsolConfig["quarter_month"];
	$week_start = $currentUserAsolConfig["week_start"];

	$modulesTables = wfm_utils::wfm_get_moduleName_moduleTableName_conversion_array($user_id);
	$trigger_module_table = $modulesTables[$trigger_module];

	$condition_values = $filter_values[$i];// Be careful, filter_values is modified with modifyFilteringValues

	wfm_utils::wfm_log('debug', '$filter_values[$i]=['.var_export($filter_values[$i], true).']', __FILE__, __METHOD__, __LINE__);
	generateQuery_reports::modifyFilteringValues($filter_values, $i, $quarter_month, $week_start, $trigger_module_table, $hourOffset, $operator1, $operator2);
	wfm_utils::wfm_log('debug', '$filter_values[$i]=['.var_export($filter_values[$i], true).']', __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', '$operator1=['.var_export($operator1, true).']', __FILE__, __METHOD__, __LINE__);

	// check if current condition applies
	switch ($operator1) {

		case "=":
			$appliesCondition = ($fieldValue == $condition_values[2]);
			break;

		case "!=":
			$appliesCondition = ($fieldValue != $condition_values[2]);
			break;

		case "LIKE":
			$appliesCondition = (strpos($fieldValue, $condition_values[2]) !== false);
			break;

		case "NOT LIKE":
			$appliesCondition = (strpos($fieldValue, $condition_values[2]) === false);
			break;

		case "BETWEEN":
			$appliesCondition = (($fieldValue >= $condition_values[2]) && ($fieldValue <= $condition_values[3]));
			break;

		case "NOT BETWEEN":
			$appliesCondition =  (($fieldValue < $condition_values[2]) || ($fieldValue > $condition_values[3]));
			break;

		case ">":
			$appliesCondition =  ($fieldValue > $condition_values[2]);
			break;

		case "<":
			$appliesCondition = ($fieldValue < $condition_values[2]);
			break;

		case "IN":
			$appliesCondition =  (in_array($fieldValue, explode('${dollar}', $condition_values[2])));
			break;

		case "NOT IN":
			$appliesCondition = (!in_array($fieldValue, explode('${dollar}', $condition_values[2])));
			break;
	}

	return $appliesCondition;
}

function check_condition_relatedField($condition, $hourOffset, $userTZ, $trigger_module, $bean_id, $alternative_database, $current_user_id) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	$user_id = $current_user_id;
	$user_id =  ($user_id !== null) ? $user_id : '1';

	$modulesTables = wfm_utils::wfm_get_moduleName_moduleTableName_conversion_array($user_id);

	// TRANSLATE
	$condition = 'id${comma}LBL_ID${comma}id${dp}new\_bean${dp}true${dp}equals${dp}'.$bean_id.'${dp}${dp}char(36)${dp}${dp}false${dp}15${dp}${dp}${dp}0:${dp}0${comma}'.'${pipe}'.$condition;
	$aux = generateQuery_wfm::translate_conditions_to_filterValues_and_fieldValues($condition, true);
	$field_values = $aux['field_values'];
	$filter_values = $aux['filter_values'];

	$sql_array = generateQuery_wfm::getQueryArray_fromConditions_or_fromCustomVariables($field_values, $filter_values, $trigger_module, $userTZ, $modulesTables, $user_id, $alternative_database);
	//wfm_utils::wfm_log('asol', '$sql_array=['.print_r($sql_array, true).']', __FILE__, __METHOD__, __LINE__);

	$sql = generateQuery_wfm::getSql($sql_array);

	$object_ids = generateQuery_wfm::getObjectIds($sql);
	wfm_utils::wfm_log('debug', '$object_ids=['.var_export($object_ids, true).']', __FILE__, __METHOD__, __LINE__);

	$appliesCondition = (count($object_ids) > 0);

	return $appliesCondition;
}

// Slick way to check if array contains empty elements

function isEmpty($array) {
	wfm_utils::wfm_log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);

	$my_not_empty = create_function('$v', 'return strlen($v) > 0;');

	return (count(array_filter($array, $my_not_empty)) == 0) ? 1 : 0;
}

?>