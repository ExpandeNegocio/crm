<?php
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('asol', "ENTRY", __FILE__);

// UPGRADE WFM-DATABASE (STRUCTURE+DATA)
global $sugar_config, $db, $timedate, $current_user;

$query = $db->query("SHOW TABLES LIKE 'asol_process'");
$row = $db->fetchByAssoc($query);

$GLOBALS['log']->debug("row=[".print_r($row, true)."]");

$only_print_queries = false;
$continue_upgrade = true;
$flag = false;

// If no previous version of WFM installed then exit script
if (empty($row)) {
	$continue_upgrade = false;
}

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version<=3.3.3 to WFM-version=3.4.1
	$query = $db->query("SHOW COLUMNS FROM asol_process LIKE 'trigger_module'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version<=3.3.3 to WFM-version=3.4.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		$event_query = $db->query("SELECT * FROM asol_events");

		while ($event_row = $db->fetchByAssoc($event_query)) {
			$trigger_event_array = explode(' - ', $event_row['trigger_event']);
			$db->query("UPDATE asol_events SET trigger_event='{$trigger_event_array[1]}' WHERE id='{$event_row['id']}'");
		}

		$db->query("ALTER TABLE asol_process CHANGE bean_module trigger_module varchar(100) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_events CHANGE trigger_event trigger_event varchar(100) DEFAULT 'on_create';");
		$db->query("ALTER TABLE asol_processinstances CHANGE bean_module trigger_module varchar(100) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_workingnodes CHANGE bean_fetched_row old_bean longtext;");
		$db->query("ALTER TABLE asol_onhold CHANGE bean_module trigger_module varchar(100) DEFAULT NULL;");

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version<=3.3.3 to WFM-version=3.4.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

//////////
// (mess!)
if ($continue_upgrade && $flag) {
	// Upgrade WFM-database in case WFM-version<=3.3.3 and WFM-version=3.4.1 were installed -> Set WFM-DB-version=3.4.1
	$query1 = $db->query("SHOW COLUMNS FROM asol_process LIKE 'bean_module'");
	$row1 = $db->fetchByAssoc($query1);
	$query2 = $db->query("SHOW COLUMNS FROM asol_process LIKE 'trigger_module'");
	$row2 = $db->fetchByAssoc($query2);

	if ((!empty($row1)) && (!empty($row2))) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database in case WFM-version<=3.3.3 and WFM-version=3.4.1 were installed -> Set WFM-DB-version=3.4.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		//
		$event_query = $db->query("SELECT * FROM asol_events");

		while ($event_row = $db->fetchByAssoc($event_query)) {
			$trigger_event_array = explode(' - ', $event_row['trigger_event']);
			if (!empty($trigger_event_array[1])) {
				$db->query("UPDATE asol_events SET trigger_event='{$trigger_event_array[1]}' WHERE id='{$event_row['id']}'");
			}
		}
		//
		$db->query("UPDATE asol_process SET trigger_module = bean_module WHERE trigger_module IS NULL");
		$db->query("ALTER TABLE asol_process DROP bean_module");
		//
		$db->query("UPDATE asol_processinstances SET trigger_module = bean_module WHERE trigger_module IS NULL");
		$db->query("ALTER TABLE asol_processinstances DROP bean_module");
		//
		$db->query("UPDATE asol_workingnodes SET old_bean = bean_fetched_row WHERE old_bean IS NULL");
		$db->query("ALTER TABLE asol_workingnodes CHANGE old_bean old_bean longtext AFTER status");
		$db->query("ALTER TABLE asol_workingnodes DROP bean_fetched_row");
		//
		$db->query("UPDATE asol_onhold SET trigger_module = bean_module WHERE trigger_module IS NULL");
		$db->query("ALTER TABLE asol_onhold DROP bean_module");

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database in case WFM-version<=3.3.3 and WFM-version=3.4.1 were installed -> Set WFM-DB-version=3.4.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}
//////////

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version=3.4.1 to WFM-version=3.4.2
	$query = $db->query("SHOW COLUMNS FROM asol_workingnodes LIKE 'custom_variables'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=3.4.1 to WFM-version=3.4.2";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		$db->query("ALTER TABLE asol_workingnodes ADD custom_variables longtext AFTER new_bean;");

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=3.4.1 to WFM-version=3.4.2";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version=3.4.2 to WFM-version=3.4.3
	$query = $db->query("SHOW COLUMNS FROM asol_events LIKE 'event_conditions'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=3.4.2 to WFM-version=3.4.3";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		$db->query("ALTER TABLE asol_events CHANGE condition_event event_conditions longtext DEFAULT NULL;");

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=3.4.2 to WFM-version=3.4.3";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version=3.4.3 to WFM-version=4.0.1
	$query = $db->query("SHOW COLUMNS FROM asol_events LIKE 'conditions'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=3.4.3 to WFM-version=4.0.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		// wfm-event
		$db->query("ALTER TABLE asol_events CHANGE event_conditions conditions longtext DEFAULT NULL;");
		$db->query("ALTER TABLE asol_events CHANGE type type varchar(100) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_events CHANGE trigger_type trigger_type varchar(100) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_events CHANGE trigger_event trigger_event varchar(100) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_events ADD scheduled_tasks longtext;");
		$db->query("ALTER TABLE asol_events ADD scheduled_type varchar(100) DEFAULT NULL;");
		updateFlows_from343_to401('asol_events');

		// wfm-activity
		$db->query("ALTER TABLE asol_activity CHANGE condition_activity conditions longtext DEFAULT NULL;");
		$db->query("ALTER TABLE asol_activity ADD type varchar(100) DEFAULT NULL;");
		updateFlows_from343_to401('asol_activity');

		// wfm-task
		$db->query("ALTER TABLE asol_task CHANGE order_task task_order int(2) DEFAULT '0';");

		// wfm-process_instances
		$db->query("ALTER TABLE asol_processinstances CHANGE bean_id bean_id longtext;");
		$db->query("ALTER TABLE asol_processinstances DROP trigger_module");

		// wfm-working_nodes
		$db->query("ALTER TABLE asol_workingnodes ADD asol_events_id_c char(36) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_workingnodes ADD iter_object int(11) DEFAULT NULL;");

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=3.4.3 to WFM-version=4.0.1";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version=4.0.1 to WFM-version=4.2
	$query = $db->query("SHOW COLUMNS FROM asol_process LIKE 'alternative_database'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=4.0.1 to WFM-version=4.2";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		$db->query("
					CREATE TABLE IF NOT EXISTS `asol_loginaudit` (
					  `id` char(36) NOT NULL,
					  `name` varchar(255) DEFAULT NULL,
					  `date_entered` datetime DEFAULT NULL,
					  `date_modified` datetime DEFAULT NULL,
					  `modified_user_id` char(36) DEFAULT NULL,
					  `created_by` char(36) DEFAULT NULL,
					  `description` text,
					  `deleted` tinyint(1) DEFAULT '0',
					  `assigned_user_id` char(36) DEFAULT NULL,
					  `ip_address` varchar(255) DEFAULT NULL,
					  `username_tried` varchar(255) DEFAULT NULL,
					  `action` varchar(100) DEFAULT NULL,
					  `user_id_c` char(36) NOT NULL,
					  `is_admin` varchar(255) DEFAULT NULL,
					  `user_roles` varchar(255) DEFAULT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			");
		
		$db->query("ALTER TABLE asol_process ADD alternative_database varchar(255) DEFAULT '-1' AFTER status;");

		$db->query("ALTER TABLE asol_processinstances DROP bean_id");

		$db->query("ALTER TABLE asol_workingnodes ADD object_ids longtext AFTER asol_activity_id_c;");

		updateFlows_from401_to42('asol_events');
		updateFlows_from401_to42('asol_activity');

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=4.0.1 to WFM-version=4.2";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

if ($continue_upgrade && $flag) {
	// Upgrade WFM-database from version WFM-version=4.2 to WFM-version=4.4
	$query = $db->query("SHOW COLUMNS FROM asol_workingnodes LIKE 'parent_type'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=4.2 to WFM-version=4.4";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		$db->query("ALTER TABLE asol_workingnodes ADD parent_id char(36) DEFAULT NULL AFTER object_ids;");
		$db->query("ALTER TABLE asol_workingnodes ADD parent_type varchar(100) DEFAULT 'Home' AFTER object_ids;");

		$db->query("ALTER TABLE asol_onhold CHANGE bean_id parent_id char(36) DEFAULT NULL;");
		$db->query("ALTER TABLE asol_onhold CHANGE trigger_module parent_type varchar(100) DEFAULT 'Home';");

		updateFlows_from42_to44();

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=4.2 to WFM-version=4.4";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

if ($continue_upgrade) {
	// Upgrade WFM-database from version WFM-version=4.4 to WFM-version=4.5
	$query = $db->query("SHOW COLUMNS FROM asol_workingnodes LIKE 'type'");
	$row = $db->fetchByAssoc($query);

	if (empty($row)) {
		$log_upgrade = "-- **********[ASOL][WFM]: BEGIN - Upgrade WFM-database from version WFM-version=4.4 to WFM-version=4.5";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";

		if ($only_print_queries) {
			echo "ALTER TABLE asol_workingnodes ADD type varchar(100);";
			echo "<br>";
			echo "ALTER TABLE asol_events ADD subprocess_type varchar(100);";
			echo "<br>";
		} else {
			$db->query("ALTER TABLE asol_workingnodes ADD type varchar(100);");
			$db->query("ALTER TABLE asol_events ADD subprocess_type varchar(100);");
		}
		
		updateFlows_from44_to45($only_print_queries);

		$log_upgrade = "-- **********[ASOL][WFM]: END - Upgrade WFM-database from version WFM-version=4.4 to WFM-version=4.5";
		$GLOBALS['log']->debug($log_upgrade);
		echo $log_upgrade."<br>";
	}
}

function updateFlows_from343_to401($wfm_module) {

	global $current_user, $db;

	$moduleTables =  aux_get_moduleName_moduleTableName_conversion_array($current_user->id);

	$asol_wfmmodule_resultSet = $db->query("SELECT * FROM {$wfm_module} WHERE deleted = 0");

	while ($wfmmodule_item = $db->fetchByAssoc($asol_wfmmodule_resultSet)) {
		$conditions = $wfmmodule_item['conditions'];

		$conditions_array = explode('${pipe}', $conditions);

		foreach ($conditions_array as $keyC => $condition) {
			$condition_array = explode('${dp}', $condition);

			$isRelated = $condition_array[8];

			if ($isRelated == 'true') {
				$fieldName_aux = $condition_array[0];
				$fieldName_aux_array = explode('${comma}', $fieldName_aux);

				$field_name = $fieldName_aux_array[0];
				$field_labelkey = $fieldName_aux_array[1];

				$field_name_array = explode('.', $field_name);

				$updated_field_name = $moduleTables[$field_name_array[0]] .'.'. $field_name_array[1];

				$updated_field_labelKey = $field_name_array[0] .'.'. $field_labelkey;

				$updated_fieldName_aux = $updated_field_name .'${comma}'. $updated_field_labelKey .'${comma}'. $fieldName_aux_array[2];

				$condition_array[0] = $updated_fieldName_aux;
			}
			$conditions_array[$keyC] = implode('${dp}', $condition_array);
		}

		$updated_conditions = implode('${pipe}', $conditions_array);

		$db->query("UPDATE {$wfm_module} SET conditions = '{$updated_conditions}' WHERE id = '{$wfmmodule_item['id']}'");
	}
}

function updateFlows_from401_to42($wfm_module) {

	global $current_user, $db;

	$moduleTables =  aux_get_moduleName_moduleTableName_conversion_array($current_user->id);

	$asol_wfmmodule_resultSet = $db->query("SELECT * FROM {$wfm_module} WHERE deleted = 0");

	while ($wfmmodule_item = $db->fetchByAssoc($asol_wfmmodule_resultSet)) {
		$conditions = $wfmmodule_item['conditions'];

		$conditions_array = explode('${pipe}', $conditions);

		foreach ($conditions_array as $keyC => $condition) {
			if (!empty($conditions_array[$keyC])) {
				$conditions_array[$keyC] .= '${dp}0${comma}';
			}
		}

		$updated_conditions = implode('${pipe}', $conditions_array);

		$db->query("UPDATE {$wfm_module} SET conditions = '{$updated_conditions}' WHERE id = '{$wfmmodule_item['id']}'");
	}
}

function updateFlows_from42_to44() {
	// new_version ${old_bean->date_start}${make_datetime}add${offset}YY-mm-dd HH:ii
	// old_version ${current_datetime->02-03-04 05:06}
	// new_version ${old_bean->date_closed}${make_date}add${offset}YY-mm-dd
	// old_version ${current_date->02-03-04}

	global $db;

	$wfm_task_query = $db->query("SELECT * FROM asol_task WHERE deleted = 0");

	while ($wfm_task_row = $db->fetchByAssoc($wfm_task_query)) {

		$update_flag = false;

		switch ($wfm_task_row['task_type']) {

			case 'create_object':
			case 'modify_object':
					
				$task_implementation = $wfm_task_row['task_implementation'];

				$task_implementation_array = explode('${mod}', $task_implementation);
				$object_module = $task_implementation_array[0];
				$fields = $task_implementation_array[1];

				$fields_array = explode('${pipe}', $fields);

				foreach ($fields_array as $keyF => $field) {
					$field_array = explode('${dp}', $field);

					$fieldType = $field_array[3];

					switch ($fieldType) {
						case 'datetime':
						case 'date':

							$fieldValue = $field_array[1];
							$fieldValue = str_replace('%20', '+', $fieldValue); //  PHP's urlencode() encodes a space as a '+' sign while Javascript's escape() encodes a space as '%20'.
							$fieldValue = urldecode($fieldValue);

							$aux = substr($fieldValue, 2);
							$aux2 = substr($aux, 0, -1);
							$fieldValue = $aux2;

							$fieldValue_array = explode('->', $fieldValue);
							$offset = $fieldValue_array[1];

							$updated_fieldValue = '${current_'.$fieldType.'}${make_'.$fieldType.'}add${offset}' . $offset;
							$updated_fieldValue	= urlencode($updated_fieldValue);
							$updated_fieldValue = str_replace('+', '%20', $updated_fieldValue); //  PHP's urlencode() encodes a space as a '+' sign while Javascript's escape() encodes a space as '%20'.
							$field_array[1] = $updated_fieldValue;

							$update_flag = true;
							break;
					}

					$fields_array[$keyF] = implode('${dp}', $field_array);
				}
					
				if ($update_flag) {
					$updated_task_implementation =  $object_module . '${mod}' . implode('${pipe}', $fields_array);
					$db->query("UPDATE asol_task SET task_implementation = '{$updated_task_implementation}' WHERE id = '{$wfm_task_row['id']}'");
				}
					
				break;
		}
	}
}

function updateFlows_from44_to45($only_print_queries) {
	// send_email -> notificationEmails_opts_string_for
	// call_process -> execute_subprocess_immediately
	// add_custom_variables -> is_global
	global $db;

	$wfm_task_query = $db->query("SELECT * FROM asol_task WHERE deleted = 0");

	while ($wfm_task_row = $db->fetchByAssoc($wfm_task_query)) {

		$update_flag = false;
		$task_implementation = $wfm_task_row['task_implementation'];

		switch ($wfm_task_row['task_type']) {

			case 'send_email':
				$updated_task_implementation = $task_implementation . '${pipe}${pipe}${pipe}';
				$update_flag = true;
				break;

			case 'call_process':
				$updated_task_implementation = $task_implementation . '${pipe}false';
				$update_flag = true;
				break;

			case 'add_custom_variables':

				$cvars = $task_implementation;
				$cvars_array = explode('${pipe}', $cvars);

				foreach ($cvars_array as $key => $cvar) {
					$cvars_array[$key] = $cvars_array[$key] . '${dp}false';
				}
				
				$updated_task_implementation = implode('${pipe}', $cvars_array);

				$update_flag = true;
				break;
		}

		if ($update_flag) {
			if ($only_print_queries) {
				echo "UPDATE asol_task SET task_implementation = '{$updated_task_implementation}' WHERE id = '{$wfm_task_row['id']}';";
				echo "<br>";
			} else {
				$db->query("UPDATE asol_task SET task_implementation = '{$updated_task_implementation}' WHERE id = '{$wfm_task_row['id']}'");
			}
			
		}
	}
}

function aux_get_moduleName_moduleTableName_conversion_array($user_id) {

	global $beanList, $beanFiles;

	$acl_modules = ACLAction::getUserActions($user_id);

	//Get an array of table names for admin accesible modules
	$modulesTables = Array();
	foreach($acl_modules as $key=>$mod){

		if($mod['module']['access']['aclaccess'] >= 0){

			$class_name = $beanList[$key];
			if (!empty($class_name)) {

				require_once($beanFiles[$class_name]);

				$bean = new $class_name();
				$table_name = $bean->table_name;

				$modulesTables[$key] = $table_name;

				unset($bean);
			}
		}
	}

	return $modulesTables;
}

wfm_utils::wfm_log('asol', "EXIT", __FILE__);
?>
