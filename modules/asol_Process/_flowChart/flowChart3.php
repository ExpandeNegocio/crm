<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('asol', 'ENTRY', __FILE__);

global $db;

wfm_utils::wfm_log('debug', 'ENTRY POINT $_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

$export_array = Array();

// Extract process_ids from $_REQUEST
$process_ids_array = explode(',', $_REQUEST['uid']);

// SEARCH FOR PROCESSES
foreach($process_ids_array as $key_process_id => $value_process_id) {
	$process_query = $db->query ("
									SELECT *
									FROM asol_process
									WHERE id = '{$value_process_id}'
								");
	$process_row = $db->fetchByAssoc($process_query);

	$export_array['processes'][] = $process_row;
}
//wfm_utils::wfm_log('debug', "1 FINAL \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);

// SEARCH FOR EVENTS
if (!empty($export_array['processes'])) { // It is always only one process for the flowChart
	foreach ($export_array['processes'] as $key_process => $value_process) {

		$event_from_process__query = $db->query("
													SELECT asol_events.*
													FROM asol_proces_asol_events_c
													INNER JOIN asol_events ON (asol_proces_asol_events_c.asol_procea8ca_events_idb = asol_events.id)
													WHERE (asol_proces_asol_events_c.asol_proce6f14process_ida = '{$value_process['id']}') AND (asol_events.deleted = 0) AND (asol_proces_asol_events_c.deleted = 0)
													ORDER BY
														CASE asol_events.type
															WHEN 'initialize' THEN 1
														    WHEN 'start' THEN 2
														    WHEN 'intermediate' THEN 3
														    WHEN 'cancel' THEN 4
														    ELSE 5
														END,
														asol_events.name ASC
												");
		while ($event_from_process__row = $db->fetchByAssoc($event_from_process__query)) {
			$export_array['events'][$value_process['id']][] = $event_from_process__row;
		}
	}
}
//wfm_utils::wfm_log('debug', "2 FINAL \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);

// SEARCH FOR ACTIVITIES
if (!empty($export_array['events'])) {
	foreach ($export_array['events'] as $key_parent_process => $value_parent_process) {
		foreach ($value_parent_process as $key_event => $value_event) {

			$activity_from_event__query = $db->query("
														SELECT asol_activity.*
														FROM asol_eventssol_activity_c
														INNER JOIN asol_activity ON (asol_eventssol_activity_c.asol_event8042ctivity_idb = asol_activity.id)
														WHERE (asol_eventssol_activity_c.asol_event87f4_events_ida = '{$value_event['id']}') AND (asol_activity.deleted = 0) AND (asol_eventssol_activity_c.deleted = 0)
														ORDER BY asol_activity.name ASC
													");
			while ($activity_from_event__row = $db->fetchByAssoc($activity_from_event__query)) {
				$export_array['activities'][$value_event['id']][] = $activity_from_event__row;
			}

			if (is_array($export_array['activities'])) { // Avoid php-warning array_key_exists
				if (!array_key_exists($value_event['id'], $export_array['activities'])) {
					$export_array['activities'][$value_event['id']][] = "empty_token";
				}
			} else {
				$export_array['activities'][$value_event['id']][] = "empty_token";
			}
		}
	}
}

//wfm_utils::wfm_log('debug', "3 FINAL \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);

// SEARCH FOR NEXT_ACTIVITIES FROM ACTIVITIES(FROM EVENTS)

/**
 *
 * Get all next_activities(children, grandchildren...) for an activity
 * @param $activity_id
 * @param $next_activities -> You need to call this function like this: "getNextActivities($activity_id);" without the second parameter, because this is just for implementing recursiveness(there is a call to the function inside the function itself)
 */
function getNextActivities($activity_id, & $next_activities=array()){ // recursive

	//wfm_utils::wfm_log('debug', "Executing getNextActivities function", __FILE__, __METHOD__, __LINE__);

	global $db;
	$next_activities_query = $db->query("
											SELECT asol_activ9e2dctivity_idb  AS next_activity_id
											FROM asol_activisol_activity_c
											WHERE asol_activ898activity_ida  = '{$activity_id}' AND deleted = 0
										");

	while($next_activities_row = $db->fetchByAssoc($next_activities_query)) {
		$next_activities[] = $next_activities_row['next_activity_id'];

		getNextActivities($next_activities_row['next_activity_id'], $next_activities);
	}

	return $next_activities;
}

//---------------WHEN SEARCHING FOR NEXT_ACTIVITIES -> CALCULATE Y-COORDENATE FOR THE ACTIVITIES AND FOR EVENTS

// draw-information for Events
$draw_information_event = Array();
$top_Process = 130;
$left_Process = 50;
$height_Event = 1+7+90+7+1;
$width_Event = 1+7+90+7+1;
$separation_vertical_Event = 50;
// draw-information for Activities
$draw_information_activity = Array();
$top_Process = $top_Process;
$separation_horizontal_Event = 100;// for activity loop
$separation_horizontal_Activity = 100;// for next_activity loop
$left_Process = $left_Process + $width_Event + $separation_horizontal_Event;
$height_Activity = 1+7+90+7+1;
$border_Activity = 1; // this is set on the style by 'em' not by 'px', so it is relative
$padding_Activity = 7; // this is set on the style by 'em' not by 'px', so it is relative
$number_of_pixels_to_susbstrate_from_width_Activity = 13;
$with_Activity_depending_on_number_of_tasks_Default = 94;// default
$with_Activity_depending_on_number_of_tasks_Maximum = $with_Activity_depending_on_number_of_tasks_Default; // to get the nex_activity location
$separation_vertical_Activity = 50;

// search for next_activities
if (!empty($export_array['activities'])) {
	$activity_ids_event_duplicity = Array();

	foreach ($export_array['activities'] as $key_parent_event => $value_parent_event) {

		$draw_information_event[$key_parent_event] = $top_Process;

		if ($export_array['activities'][$key_parent_event][0] == "empty_token") {
			$top_Process = $top_Process + $height_Event + $separation_vertical_Event;
			continue;
		}

		$aux_only_event_duplicity_for_this_event = true;

		foreach ($value_parent_event as $key_activity => $value_activity) {

			//wfm_utils::wfm_log('debug', "\$activity_ids=[".print_r($activity_ids,true)."]", __FILE__, __METHOD__, __LINE__);
			if (!in_array($value_activity['id'], $activity_ids_event_duplicity)) {	// Event duplicity.

				// Calculate Y-coordenate for activity(from events)
				$draw_information_activity[$value_activity['id']]['y'] = $top_Process;

				$next_activity_ids_all_tree = getNextActivities($value_activity['id']);
				//wfm_utils::wfm_log('debug', "\$next_activity_ids_all_tree".print_r($next_activity_ids_all_tree,true), __FILE__, __METHOD__, __LINE__);

				foreach($next_activity_ids_all_tree as $key => $value) {

					$next_activity_query = $db->query ("
															SELECT *
															FROM asol_activity
															WHERE id = '{$value}'
														");
					$next_activity_row = $db->fetchByAssoc($next_activity_query);

					$parent_activity_query = $db->query("
															SELECT asol_activ898activity_ida   AS parent_activity_id
															FROM asol_activisol_activity_c
															WHERE asol_activ9e2dctivity_idb  = '{$next_activity_row['id']}' AND deleted = 0
														");
					$parent_activity_row = $db->fetchByAssoc($parent_activity_query);

					$export_array['next_activities'][$parent_activity_row['parent_activity_id']][] = $next_activity_row;

					// Calculate Y-coordenate for next_activity(from activity and from next_activity)
					$number_of_child = 0;
					$next_activity_for_number_query =  $db->query ("
																		SELECT asol_activ9e2dctivity_idb AS next_activity_id
																		FROM asol_activisol_activity_c
																		WHERE asol_activ898activity_ida = '{$parent_activity_row['parent_activity_id']}' AND deleted = 0
																	");
					while ($next_activity_for_number_row = $db->fetchByAssoc($next_activity_for_number_query)) {
						$number_of_child++;
						if ($next_activity_for_number_row['next_activity_id'] == $next_activity_row['id']) {
							break;
						}
					}

					if ($number_of_child > 1) { // if == 1 then $top_Process = $top_Process -> i.e. the first next_activity has the same $top as its parent
						$top_Process = $top_Process + $height_Activity + $separation_vertical_Activity;
					}

					$draw_information_activity[$next_activity_row['id']]['y'] = $top_Process;
				}

				// separation between the last next_activity of the current activity and the following activity
				$top_Process = $top_Process + $height_Activity + $separation_vertical_Activity;

				// event duplicity
				$activity_ids_event_duplicity[] = $value_activity['id'];
				$aux_only_event_duplicity_for_this_event = false;

			} else {
				wfm_utils::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
			}
		}

		if ($aux_only_event_duplicity_for_this_event) { // Can be more than one activity pointed for several events for one event -> flowChart must only draw space for one activity
			$top_Process = $top_Process + $height_Event + $separation_vertical_Event;
		}
	}
}

//wfm_utils::wfm_log('debug', "4 FINAL \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);

// SEARCH FOR TASKS FROM ACTIVITIES( from [event, activity, next_activity] )
$event_duplicity = Array();

$activity_type = Array('activities', 'next_activities');
foreach ($activity_type as $key_activity_type => $value_activity_type) {

	if (!empty($export_array[$value_activity_type])) {
		foreach ($export_array[$value_activity_type] as $key_parent => $value_parent) {// parent -> [event, activity, next_activity]

			if ($export_array[$value_activity_type][$key_parent][0] == "empty_token") {
				continue;
			}

			foreach($value_parent as $key_activity => $value_activity) {

				if (in_array($value_activity['id'], $event_duplicity)) {
					continue;
				}
				$event_duplicity[] = $value_activity['id'];
					
				// asol_Task-structure
				// id 	name 	date_entered 	date_modified 	modified_user_id 	created_by 	description 	deleted 	assigned_user_id 	delay_type 	delay 	task_type 	task_order 	task_implementation
				$tasks_from_activity__array = Array();
				$tasks_from_activity__query = $db->query("
															SELECT asol_task.*
															FROM asol_activity_asol_task_c
															INNER JOIN asol_task ON (asol_activity_asol_task_c.asol_activf613ol_task_idb = asol_task.id AND asol_activity_asol_task_c.deleted = 0)
															WHERE asol_activity_asol_task_c.asol_activ5b86ctivity_ida = '{$value_activity['id']}' AND asol_activity_asol_task_c.deleted = 0
															ORDER BY asol_task.task_order ASC, asol_task.name ASC
														");
				while ($tasks_from_activity__row = $db->fetchByAssoc($tasks_from_activity__query)) {
					$tasks_from_activity__array[] = $tasks_from_activity__row;
				}

				$export_array['tasks'][$value_activity['id']] = $tasks_from_activity__array;
			}
		}
	}
}
wfm_utils::wfm_log('debug', "5 FINAL \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);

//////////////////////////////////
//*************DRAW*************//
//////////////////////////////////

// JSPLUMB-CALL-FUNCTIONS

function drawConnection ($source, $target, $number_of_connection) {
	return 'jsPlumb.connect({
								source:"'.$source.'", target:"'.$target.'", 
							});
	';
}

function drawCondition($id) {
	return '
			var targetEndpoint = { 
									endpoint:["Image", { src:"modules/asol_Process/_flowChart/images/condition_icon_16.png" } ],
									anchor:"LeftMiddle", 
								 };
			jsPlumb.addEndpoint( "'.$id.'", targetEndpoint );
	';
}

function drawDelay($id) {
	return '
			var targetEndpoint = { 
									endpoint:["Image", { src:"modules/asol_Process/_flowChart/images/delay_icon_24.png" } ],
									anchor:"TopCenter", 
								 };
			var delay = jsPlumb.addEndpoint( "'.$id.'", targetEndpoint );
			
			delay.bind("mouseenter", function(delay) {
				console.log("you clicked on ", delay);
				console.log("you clicked on id ", delay.id);
				console.log("you clicked on id ", delay.elementId);
			});
			
	';
}

//-------------------DRAW NODE FUNCTIONS-----------------------//

//window.opener.location=\'index.php?module=asol_Process&action=DetailView&record='.$id.'\';
function generate_Process_HTML($id, $name, $alternative_database, $trigger_module, $status, $description) {

	return '
		<div class="process_name">
			<img src="modules/asol_Process/_flowChart/images/process_'.$status.'_32.png" style="margin-bottom: -5px;" />
			<span>
				<a module="asol_Process" link_id="'.$id.'" onclick="" qtip_info="'.generate_process_info_HTML($alternative_database, $trigger_module, $status, $description).'">'.$name.'</a>
			</span>
		</div>
	';
}

function generate_Event_HTML($id, $name, $description, $top, $left, $event_conditions, $type, $trigger_type, $alternative_database, $trigger_event, $scheduled_type, $subprocess_type, $module) {

	global $app_list_strings;

	$draw_Condition = "";
	if (!($event_conditions == "")) {
		$conditions_to_print = generate_conditions_HTML($event_conditions, $module);
		//wfm_utils::wfm_log('debug', "\$conditions_to_print=[".print_r($conditions_to_print,true)."]", __FILE__, __METHOD__, __LINE__);

		$draw_Condition .= '
							<span class="condition_icon_for_events">
								<img qtip_info="'.$conditions_to_print.'" src="modules/asol_Process/_flowChart/images/condition_icon_24.png">
							</span>
						';
	}

	$event_info = generate_event_info_HTML($type, $trigger_type, $alternative_database, $trigger_event, $scheduled_type, $subprocess_type);

	//window.opener.location=\'index.php?module=asol_Events&action=DetailView&record='.$id.'\';
	switch ($trigger_type) {
		case 'logic_hook':
			switch ($trigger_event) {
				case 'login_failed':
				case 'after_login':
				case 'before_logout':
					$src = "modules/asol_Process/_flowChart/images/event_{$trigger_type}_{$trigger_event}_90.png";
					$src2 = "";
					$draw_trigger_event = "";
					break;
				case 'on_create':
				case 'on_modify':
				case 'on_modify__before_save':
				case 'on_delete':
					$src = "modules/asol_Process/_flowChart/images/event_{$trigger_type}_{$type}_90.png";
					$src2= "modules/asol_Process/_flowChart/images/{$trigger_event}.gif";
					$draw_trigger_event = "<span class='trigger_event'><img alt='trigger_event' title='{$app_list_strings['wfm_trigger_event_list'][$trigger_event]}' src='{$src2}'></span>";
					break;
			}

			break;
		case 'scheduled':
			$src = "modules/asol_Process/_flowChart/images/event_{$trigger_type}_{$scheduled_type}_90.png";
			break;
		case 'subprocess':
			$src = "modules/asol_Process/_flowChart/images/event_{$trigger_type}_90.png";
			break;

	}

	return '
		<div class="event" style="top:'.$top.'px; left:'.$left.'px;">
			<div class="event_symbol" id="'.$id.'" style="width: 90px; height: 90px">
				<img alt="Event" qtip_info="'.$event_info.'" src="'.$src.'">
				'.$draw_trigger_event.'
				' . $draw_Condition . ' 
			</div>
			<div class="">
				<span class="event_name aux_name_overflow overflow_ellipsis_enabled">
					<a module="asol_Events" link_id="'.$id.'" onclick="" title="'.generate_name_and_description_HTML($name, $description).'">'.$name.'</a>
				</span>
			</div>
		</div>
	';
}

function generate_Activity_HTML($id, $name, $description, $top, $left, $width, $draw_Tasks_of_this_activity, $counter_Tasks_of_this_activity, $activity_conditions, $delay, $module) {

	$draw_Delay = "";
	if (!( ($delay == 'minutes - 0') || ($delay == 'hours - 0') || ($delay == 'days - 0') || ($delay == 'weeks - 0') || ($delay == 'months - 0') )) {
		$draw_Delay .= '
						<span class="delay_icon" style="left: '.(((1+7+$width+7+1)/2)-24/2).'px;">
							<img alt="'.generate_delay($delay).'" src="modules/asol_Process/_flowChart/images/delay_icon_24.png">
						</span>
					';
	}

	$draw_Condition = "";
	if (!($activity_conditions == "")) {
		$conditions_to_print = generate_conditions_HTML($activity_conditions, $module);
		$draw_Condition .= '
							<span class="condition_icon">
								<img qtip_info="'.$conditions_to_print.'" src="modules/asol_Process/_flowChart/images/condition_icon_16.png">
							</span>
						';
	}

	// window.opener.location=\'index.php?module=asol_Activity&action=DetailView&record='.$id.'\';
	return '
		<div class="activity_symbol"  id="'.$id.'" style="top:'.$top.'px; left:'.$left.'px; width:'.$width.'px;">
			<div>
				' . $draw_Delay . ' 
				' . $draw_Condition . ' 
				<span class="activity_name aux_name_overflow overflow_ellipsis_enabled" style="width:'.($width+6).'px;">
					<a module="asol_Activity" link_id="'.$id.'" onclick="" title="'.generate_name_and_description_HTML($name, $description).'">'.$name.'</a>
				</span>
			</div>
			<div class="activity_container_of_tasks">
			' . $draw_Tasks_of_this_activity . ' 
			</div>
		</div>
	';
}

function generate_Task_HTML($id, $name, $description, $task_type, $top, $left, $delay_type, $delay, $order, $task_implementation) {

	global $app_list_strings;

	$draw_Delay = "";
	if ($delay_type != 'no_delay') {
		$draw_Delay .= '
							<span class="delay_icon_for_task">
								<img alt="'.generate_delay($delay).'" src="modules/asol_Process/_flowChart/images/delay_icon_16.png">
							</span>
						';
	}

	$draw_Call_process_open_subprocess = "";
	if ($task_type == 'call_process') {
			
		$task_implementation_array = explode('${pipe}', $task_implementation);
		$id_process = $task_implementation_array[0];
		$name_process = $task_implementation_array[1];
		$id_event = $task_implementation_array[2];
		$name_event = $task_implementation_array[3];
			
		$subprocess_info .= '<tr>';
		$subprocess_info .= "<td><b>&nbsp; ".'SubProcess'." &nbsp;</b></td>";
		$subprocess_info .= "<td>&nbsp; ".$name_process." &nbsp;</td>";
		$subprocess_info .= '</tr>';
		$subprocess_info .= '<tr>';
		$subprocess_info .= "<td><b>&nbsp; ".'SubEvent'." &nbsp;</b></td>";
		$subprocess_info .= "<td>&nbsp; ".$name_event." &nbsp;</td>";
		$subprocess_info .= '</tr>';
			
		$draw_Call_process_open_subprocess .= '
													<span class="task_call_process_open_subprocess_icon">
														<img qtip_info="'.$subprocess_info.'" src="modules/asol_Process/_flowChart/images/task_call_process_open_subprocess_16.png" onclick="window.opener.location=\'index.php?module=asol_Events&action=DetailView&record='.$id_event.'\';" >
													</span>
												';
	}

	// window.opener.location=\'index.php?module=asol_Task&action=DetailView&record='.$id.'\';
	return '
		<div class="task" style="top:'.$top.'px; left:'.$left.'px;">
			<div class="task_name overflow_ellipsis_enabled">
				<a module="asol_Task" link_id="'.$id.'" onclick="" title="'.generate_info_for_Task_HTML($name, $description, $delay_type, $order).'">'.$name.'</a>
			</div>
			<div class="task_symbol" id="'.$id.'">
				<img alt="Task" src="modules/asol_Process/_flowChart/images/task_'.$task_type.'_32.png" title="'.$app_list_strings['wfm_task_type_list'][$task_type].'">
				' . $draw_Delay . '
				' . $draw_Call_process_open_subprocess . ' 
			</div>
		</div>	
	';
}

//-------------------AUX FUNCTIONS FOR DRAW NODE FUNCTIONS-----------------------//

function generate_delay($delay) {

	$delay_array = explode(' - ', $delay);

	switch ($delay_array[0]) {
		case 'minutes':
			$delay_label = translate('LBL_ASOL_MINUTES', 'asol_Activity');
			break;
		case 'hours':
			$delay_label = translate('LBL_ASOL_HOURS', 'asol_Activity');
			break;
		case 'days':
			$delay_label = translate('LBL_ASOL_DAYS', 'asol_Activity');
			break;
		case 'weeks':
			$delay_label = translate('LBL_ASOL_WEEKS', 'asol_Activity');
			break;
		case 'months':
			$delay_label = translate('LBL_ASOL_MONTHS', 'asol_Activity');
			break;
	}

	$delay_label = $delay_array[1]." ".$delay_label;

	return $delay_label;
}

function generate_name_and_description_HTML($name, $description) {

	// generate HTML
	$info = "";
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_NAME', 'asol_Process')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$name." &nbsp;</td>";
	$info .= '</tr>';
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_DESCRIPTION', 'asol_Process')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$description." &nbsp;</td>";
	$info .= '</tr>';

	return $info;
}

function generate_info_for_Task_HTML($name, $description, $delay_type, $order) {

	global $app_list_strings;

	// generate HTML
	$info = "";
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_NAME', 'asol_Task')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$name." &nbsp;</td>";
	$info .= '</tr>';
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_DESCRIPTION', 'asol_Task')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$description." &nbsp;</td>";
	$info .= '</tr>';
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_DELAY_TYPE', 'asol_Task')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$app_list_strings['wfm_task_delay_type_list'][$delay_type]." &nbsp;</td>";
	$info .= '</tr>';
	$info .= '<tr>';
	$info .= "<td><b>&nbsp; ".translate('LBL_TASK_ORDER', 'asol_Task')." &nbsp;</b></td>";
	$info .= "<td>&nbsp; ".$order." &nbsp;</td>";
	$info .= '</tr>';

	return $info;
}


function generate_process_info_HTML($alternative_database, $trigger_module, $status, $description) {
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $app_list_strings;

	$trigger_module = ($alternative_database == '-1') ? $app_list_strings['moduleList'][$trigger_module] : $trigger_module;

	// generate HTML
	$process_info = "";
	$process_info .= '<tr>';
	$process_info .= "<td><b>&nbsp; ".translate('LBL_ASOL_TRIGGER_MODULE', 'asol_Process')." &nbsp;</b></td>";
	$process_info .= "<td>&nbsp; ".$trigger_module." &nbsp;</td>";
	$process_info .= '</tr>';
	$process_info .= '<tr>';
	$process_info .= "<td><b>&nbsp; ".translate('LBL_STATUS', 'asol_Process')." &nbsp;</b></td>";
	$process_info .= "<td>&nbsp; ".$app_list_strings['wfm_process_status_list'][$status]." &nbsp;</td>";
	$process_info .= '</tr>';
	$process_info .= '<tr>';
	$process_info .= "<td><b>&nbsp; ".translate('LBL_DESCRIPTION', 'asol_Process')." &nbsp;</b></td>";
	$process_info .= "<td>&nbsp; ".$description." &nbsp;</td>";
	$process_info .= '</tr>';

	return $process_info;
}

function generate_event_info_HTML($type, $trigger_type, $alternative_database, $trigger_event, $scheduled_type, $subprocess_type) {
	wfm_utils::wfm_log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);

	global $app_list_strings;

	if ($alternative_database == '-1') {
		$trigger_event = (!empty($app_list_strings['wfm_trigger_event_list'][$trigger_event])) ? $app_list_strings['wfm_trigger_event_list'][$trigger_event] : $app_list_strings['wfm_trigger_event_list_only_users'][$trigger_event];
	} else {
		$trigger_event = $trigger_event;
	}

	// generate HTML
	$event_info = "";
	$event_info .= '<tr>';
	$event_info .= "<td><b>&nbsp; ".translate('LBL_TRIGGER_TYPE', 'asol_Events')." &nbsp;</b></td>";
	$event_info .= "<td>&nbsp; ".$app_list_strings['wfm_trigger_type_list'][$trigger_type]." &nbsp;</td>";
	$event_info .= '</tr>';
	$event_info .= '<tr>';
	$event_info .= "<td><b>&nbsp; ".translate('LBL_ASOL_TRIGGER_EVENT', 'asol_Events')." &nbsp;</b></td>";
	$event_info .= "<td>&nbsp; ".$trigger_event." &nbsp;</td>";
	$event_info .= '</tr>';
	$event_info .= '<tr>';
	$event_info .= "<td><b>&nbsp; ".translate('LBL_TYPE', 'asol_Events')." &nbsp;</b></td>";
	$event_info .= "<td>&nbsp; ".$app_list_strings['wfm_events_type_list'][$type]." &nbsp;</td>";
	$event_info .= '</tr>';
	$event_info .= '<tr>';
	$event_info .= "<td><b>&nbsp; ".translate('LBL_SCHEDULED_TYPE', 'asol_Events')." &nbsp;</b></td>";
	$event_info .= "<td>&nbsp; ".$app_list_strings['wfm_scheduled_type_list'][$scheduled_type]." &nbsp;</td>";
	$event_info .= '</tr>';
	$event_info .= '<tr>';
	$event_info .= "<td><b>&nbsp; ".translate('LBL_SUBPROCESS_TYPE', 'asol_Events')." &nbsp;</b></td>";
	$event_info .= "<td>&nbsp; ".$app_list_strings['wfm_subprocess_type_list'][$subprocess_type]." &nbsp;</td>";
	$event_info .= '</tr>';

	return $event_info;
}

function generate_conditions_TableBegin_HTML() {

	return '
		<table id=\'conditions_Table\' class=\'gradient-style\'>
			<thead>
				<tr>
			
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_LOGICAL_OPERATORS', 'asol_Events').'
						</div>
					</th>
				
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_DATABASE_FIELD', 'asol_Events').'
						</div>
					</th>
					
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_OLD_BEAN_NEW_BEAN_CHANGED', 'asol_Events').'
						</div>
					</th>
					
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_IS_CHANGED', 'asol_Events').'
						</div>
					</th>
			
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_OPERATOR', 'asol_Events').'
						</div>
					</th>
			
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_FIRST_PARAMETER', 'asol_Events').'
						</div>
					</th>
			
					<th  scope=\'col\'>
						<div align=\'left\' width=\'100%\' style=\'white-space: nowrap;\'>
						'.translate('LBL_ASOL_SECOND_PARAMETER', 'asol_Events').'
						</div>
					</th>
			
				</tr>
			</thead>
			<tbody>
	';
}

function generate_conditions_TableEnd_HTML() {

	return '
			</tbody>
		</table>
	';
}

function generate_conditions_HTML($conditions_string, $module) {

	$conditions_to_print = "";
	$conditions_to_print .= generate_conditions_TableBegin_HTML();

	$conditions = explode("\${pipe}",$conditions_string);
	//wfm_utils::wfm_log('debug', "\$conditions=[".print_r($conditions,true)."]", __FILE__, __METHOD__, __LINE__);

	foreach ($conditions as $key => $value) {
			
		$values = explode("\${dp}",$conditions[$key]);
		// BEGIN - values array
		$fieldName = $values[0];
		$fieldName_array = explode("\${comma}", $fieldName);
		$OldBean_NewBean_Changed = $values[1];
		$OldBean_NewBean_Changed = stripcslashes($OldBean_NewBean_Changed);
		$isChanged = $values[2];
		$operator = $values[3];
		$Param1 = $values[4];
		$Param2 = $values[5]; $Param2 = str_replace('\_', '_', $Param2);
		$fieldType = $values[6];
		$key = $values[7];
		$isRelated = $values[8];
		$fieldIndex = $values[9];// index of module_fields, not rowIndex
		//$options_string = $values[10];
		//$options = $values[10].split("|");
		//$options_db_string = $values[11];
		//$options_db = $values[11].split("|");
		$enum_operator = $values[10];
		$enum_reference = $values[11];
		$logical_parameters = $values[12];
		// END - values array
			
		$condition_HTML = "";
		$condition_HTML .= "<tr>";
		$condition_HTML .= "<td>&nbsp; ".generate_Logical_Parameters($logical_parameters)." &nbsp;</td>";
		$condition_HTML .= "<td><b>&nbsp; ".generate_Name_of_the_Field($key, $fieldName_array, $module)." &nbsp;</b></td>";
		$condition_HTML .= "<td>&nbsp; ".(($isRelated == 'false') ? generate_OldBean_NewBean_Changed($OldBean_NewBean_Changed) : "")." &nbsp;</td>";
		$condition_HTML .= "<td>&nbsp; ".(($OldBean_NewBean_Changed == 'changed') ? generate_IsChanged($isChanged) : "") ." &nbsp;</td>";
		$condition_HTML .= "<td>&nbsp; ".(($OldBean_NewBean_Changed != 'changed') ? generate_Operator($operator) : "") ." &nbsp;</td>";
		$condition_HTML .= "<td>&nbsp; ".(($OldBean_NewBean_Changed != 'changed') ? generate_Param1($Param1, $enum_reference, $fieldType, $operator) : "") ." &nbsp;</td>";
		$condition_HTML .= "<td>&nbsp; ".(($OldBean_NewBean_Changed != 'changed') ? $Param2 : "") ." &nbsp;</td>";
		$condition_HTML .= "</tr>";

		$conditions_to_print .= $condition_HTML;
	}

	$conditions_to_print .= generate_conditions_TableEnd_HTML();

	return $conditions_to_print;
}

//-------------------LANGUAGE AUX FUNCTIONS FOR DRAW NODE FUNCTIONS-----------------------//

function generate_Logical_Parameters($logical_parameters) {

	//wfm_utils::wfm_log('debug', "\$logical_parameters=[".print_r($logical_parameters,true)."]", __FILE__, __METHOD__, __LINE__);

	$lbl_and = translate("LBL_ASOL_AND", 'asol_Events');
	$lbl_or = translate("LBL_ASOL_OR", 'asol_Events');

	$selectedValues = explode(':', $logical_parameters);
	$parenthesis = $selectedValues[0];
	$logicalOperator = $selectedValues[1];

	switch ($logicalOperator) {
		case 'AND':
			$operator_label = $lbl_and;;
			break;
		case 'OR':
			$operator_label = $lbl_or;
			break;
	}

	$parenthesis_array = Array(
		'0' => '',
		'1' => '(',
		'2' => '((',
		'3' => '(((',
		'-1' => '..)',
		'-2' => '..))',
		'-3' => '..)))',
	);

	$label = $parenthesis_array[$parenthesis].'&nbsp;&nbsp;&nbsp;&nbsp;'.$operator_label;

	return $label;
}

function generate_Name_of_the_Field($key, $fieldName_array, $trigger_module) {

	global $app_list_strings, $sugar_config;

	// Whether translate or not variable for all this php-file
	$translateFieldLabels = ((!isset($sugar_config['WFM_TranslateLabels'])) || ($sugar_config['WFM_TranslateLabels'])) ? true : false;

	//wfm_utils::wfm_log('debug', "\$fieldName_array=[".print_r($fieldName_array,true)."]", __FILE__, __METHOD__, __LINE__);

	$value = $fieldName_array[0];
	$label_key = $fieldName_array[1];
	$label = $fieldName_array[2];

	$value_array = explode('.',$value);
	$label_key_array = explode('.',$label_key);

	if (count($value_array) == 2) { // not a regular_field

		if (strpos($value_array[0], '_cstm') !== false) { // custom_field

			if (count($label_key_array) == 2) { // custom_field(from related_field)
				$module = $label_key_array[0];
				$lbl_module = $app_list_strings['moduleList'][$module];
				if (empty($lbl_module)) {
					$lbl_module = $module;
				}

				$field = $value_array[1];
				$lbl_field = translate($label_key_array[1], $module);
				if (empty($lbl_field)) {
					$lbl_field = $field;
				}

				if ($translateFieldLabels) {
					$inner_html = $lbl_module.'_cstm.'.$lbl_field;
				} else {
					$inner_html = $value;
				}
			} else { // custom_field(from regular_field)
				$module = $trigger_module;
				$lbl_module = $app_list_strings['moduleList'][$module];
				if (empty($lbl_module)) {
					$lbl_module = $module;
				}

				$field = $value_array[1];
				$lbl_field = translate($label_key, $module);
				if (empty($lbl_field)) {
					$lbl_field = $field;
				}

				if ($translateFieldLabels) {
					$inner_html = $lbl_module.'_cstm.'.$lbl_field;
				} else {
					$inner_html = $value;
				}
			}
		} else { // related_field

			$relatedModule = $label_key_array[0];
			$lbl_relatedModule = $app_list_strings['moduleList'][$relatedModule];
			if (empty($lbl_relatedModule)) {
				$lbl_relatedModule = $relatedModule;
			}

			$fieldRelatedModule = $value_array[1];
			$lbl_fieldRelatedModule = translate($label_key_array[1], $relatedModule);
			if (empty($lbl_fieldRelatedModule)) {
				$lbl_fieldRelatedModule = $fieldRelatedModule;
			}

			if ($translateFieldLabels) {
				$inner_html = $lbl_relatedModule.'.'.$lbl_fieldRelatedModule;
			} else {
				$inner_html = $value;
			}
		}
	} else  { // regular_field

		$module = $trigger_module;

		$field = $value;
		$lbl_field = translate($label_key, $module);
		if (empty($lbl_field)) {
			$lbl_field = $field;
		}

		if ($translateFieldLabels) {
			$inner_html = $lbl_field;
		} else {
			$inner_html = $value;
		}
	}

	$label = trim($inner_html);
	$label = (substr($label, -1) == ':') ? substr($label, 0, -1) : $label;// remove colon

	$label = ($key != '') ? "{$label} ({$key})" : $label;// related_fields

	return $label;
}

function generate_OldBean_NewBean_Changed($OldBean_NewBean_Changed) {

	$lbl_asol_old_bean = translate("LBL_ASOL_OLD_BEAN", 'asol_Events');
	$lbl_asol_new_bean = translate("LBL_ASOL_NEW_BEAN", 'asol_Events');
	$lbl_asol_changed = translate("LBL_ASOL_CHANGED", 'asol_Events');

	switch ($OldBean_NewBean_Changed) {
		case 'old_bean':
			$label = $lbl_asol_old_bean;
			break;
		case 'new_bean':
			$label = $lbl_asol_new_bean;
			break;
		case 'changed':
			$label = $lbl_asol_changed;
			break;
		default:
			$label = "";
			break;
	}

	return $label;
}

function generate_IsChanged($isChanged) {

	$lbl_asol_true = translate("LBL_ASOL_TRUE", 'asol_Events');
	$lbl_asol_false = translate("LBL_ASOL_FALSE", 'asol_Events');

	switch ($isChanged) {
		case 'true':
			$label = $lbl_asol_true;
			break;
		case 'false':
			$label = $lbl_asol_false;
			break;
		default:
			$label = "";
			break;
	}

	return $label;
}

function generate_Operator($operator) {

	//enum
	$lbl_event_equals = translate("LBL_EVENT_EQUALS", 'asol_Events');
	$lbl_event_not_equals = translate("LBL_EVENT_NOT_EQUALS", 'asol_Events');
	$lbl_event_one_of = translate("LBL_EVENT_ONE_OF", 'asol_Events');
	$lbl_event_not_one_of = translate("LBL_EVENT_NOT_ONE_OF", 'asol_Events');
	//int
	$lbl_event_less_than = translate("LBL_EVENT_LESS_THAN", 'asol_Events');
	$lbl_event_more_than = translate("LBL_EVENT_MORE_THAN", 'asol_Events');
	//datetime
	$lbl_event_before_date = translate("LBL_EVENT_BEFORE_DATE", 'asol_Events');
	$lbl_event_after_date = translate("LBL_EVENT_AFTER_DATE", 'asol_Events');
	$lbl_event_between = translate("LBL_EVENT_BETWEEN", 'asol_Events');
	$lbl_event_not_between = translate("LBL_EVENT_NOT_BETWEEN", 'asol_Events');
	$lbl_event_last = translate("LBL_EVENT_LAST", 'asol_Events');
	$lbl_event_not_last = translate("LBL_EVENT_NOT_LAST", 'asol_Events');
	$lbl_event_this = translate("LBL_EVENT_THIS", 'asol_Events');
	$lbl_event_not_this = translate("LBL_EVENT_NOT_THIS", 'asol_Events');
	$lbl_event_next = translate("LBL_EVENT_NEXT", 'asol_Events');
	$lbl_event_not_next = translate("LBL_EVENT_NOT_NEXT", 'asol_Events');
	//default
	$lbl_event_like = translate("LBL_EVENT_LIKE", 'asol_Events');
	$lbl_event_not_like = translate("LBL_EVENT_NOT_LIKE", 'asol_Events');

	switch ($operator) {
		//enum
		case 'equals':
			$label = $lbl_event_equals;
			break;
		case 'not equals':
			$label = $lbl_event_not_equals;
			break;
		case 'one of':
			$label = $lbl_event_one_of;
			break;
		case 'not one of':
			$label = $lbl_event_not_one_of;
			break;
			//int
		case 'less than':
			$label = $lbl_event_less_than;
			break;
		case 'more than':
			$label = $lbl_event_more_than;
			break;
			//datetime
		case 'before date':
			$label = $lbl_event_before_date;
			break;
		case 'after date':
			$label = $lbl_event_after_date;
			break;
		case 'between':
			$label = $lbl_event_between;
			break;
		case 'not between':
			$label = $lbl_event_not_between;
			break;
		case 'last':
			$label = $lbl_event_last;
			break;
		case 'not last':
			$label = $lbl_event_not_last;
			break;
		case 'this':
			$label = $lbl_event_this;
			break;
		case 'not this':
			$label = $lbl_event_not_this;
			break;
		case 'next':
			$label = $lbl_event_next;
			break;
		case 'not next':
			$label = $lbl_event_not_next;
			break;
			//default
		case 'like':
			$label = $lbl_event_like;
			break;
		case 'not like':
			$label = $lbl_event_not_like;
			break;
		default:
			$label = "";
			break;
	}

	return $label;
}

function generate_Param1($Param1, $enum_reference, $fieldType, $operator) {

	global $app_list_strings;

	wfm_utils::wfm_log('debug', "\$Param1=[".print_r($Param1,true)."]", __FILE__, __METHOD__, __LINE__);

	$label = "";

	switch ($fieldType) {
		case 'enum':
			$Param1_array = explode("\${dollar}", $Param1);
			foreach ($Param1_array as $key => $value) {
				$label .=  $app_list_strings[$enum_reference][$value] . "<br>"."&nbsp;&nbsp;";
			}
			$label = substr($label, 0, (-4-6-6));
			break;

		case "int":
		case "double":
		case "currency":
		case "decimal":
			$label = $Param1;
			break;

		case "datetime":
		case "date":

			switch ($operator) {
				case "last":
				case "this":
				case "next":
				case "not last":
				case "not this":
				case "not next":
					$lbl_event_day = translate("LBL_EVENT_DAY", 'asol_Events');
					$lbl_event_week = translate("LBL_EVENT_WEEK", 'asol_Events');
					$lbl_event_month = translate("LBL_EVENT_MONTH", 'asol_Events');
					$lbl_event_nquarter = translate("LBL_EVENT_NQUARTER", 'asol_Events');
					$lbl_event_fquarter = translate("LBL_EVENT_FQUARTER", 'asol_Events');
					$lbl_event_nyear = translate("LBL_EVENT_NYEAR", 'asol_Events');
					$lbl_event_fyear = translate("LBL_EVENT_FYEAR", 'asol_Events');

					switch ($Param1) {
						case 'day':
							$label = $lbl_event_day;
							break;
						case 'week':
							$label = $lbl_event_week;
							break;
						case 'month':
							$label = $lbl_event_month;
							break;
						case 'Nquarter':
							$label = $lbl_event_nquarter;
							break;
						case 'Fquarter':
							$label = $lbl_event_fquarter;
							break;
						case 'Nyear':
							$label = $lbl_event_nyear;
							break;
						case 'Fyear':
							$label = $lbl_event_fyear;
							break;
					}
					break;

				default: // [between, not between]
					$label = $Param1;
					break;
			}

			break;

		case "tinyint(1)":
			$lbl_event_true = translate("LBL_EVENT_TRUE", 'asol_Events');
			$lbl_event_false = translate("LBL_EVENT_FALSE", 'asol_Events');

			switch ($Param1) {
				case 'true':
					$label = $lbl_event_true;
					break;
				case 'false':
					$label = $lbl_event_false;
					break;
				default:
					$label = "";
					break;
			}

			break;

		default:
			$label = $Param1;
			break;
	}

	$label = str_replace('\_', '_', $label);
	return $label;
}

//////////////////////////////////////////////////////////////////////////////////////////
//**************************************DRAW********************************************//
//////////////////////////////////////////////////////////////////////////////////////////

// DRAW PROCESS
if (!empty($export_array['processes'])) {
	$draw_Process = generate_Process_HTML($export_array['processes'][0]['id'], $export_array['processes'][0]['name'], $export_array['processes'][0]['alternative_database'],$export_array['processes'][0]['trigger_module'],  $export_array['processes'][0]['status'], $export_array['processes'][0]['description']);
}

// DRAW ALL EVENTS
//$top_Process = 120;
$left_Process = 50;
$height_Event = 1+7+90+7+1;
$width_Event = 1+7+90+7+1; // = 106
$separation_vertical_Event = 50;

$draw_Events = "";
if (array_key_exists('events', $export_array)) {
	foreach ($export_array['events'] as $key_parent_process => $value_parent_process) {
		foreach ($value_parent_process as $key_event => $value_event) {
			$draw_Events .= generate_Event_HTML($value_event['id'], $value_event['name'], $value_event['description'], $draw_information_event[$value_event['id']], $left_Process, $value_event['conditions'], $value_event['type'], $value_event['trigger_type'], $export_array['processes'][0]['alternative_database'], $value_event['trigger_event'], $value_event['scheduled_type'], $value_event['subprocess_type'], $export_array['processes'][0]['trigger_module']);
			//$top_Process = $top_Process + $height_Event + $separation_vertical_Event;
		}
	}
}

// DRAW ALL ACTIVITIES(AND NEXT_ACTIVITIES) AND THEIR TASKS
$event_duplicity = Array();
$aux_counter = 0;

$draw_Activities = "";
$connections = "";
$conditions = "";
$icon_activities = "";

$activity_type = Array('activities', 'next_activities');
foreach ($activity_type as $key_activity_type => $value_activity_type) {

	//$top_Process = 120;
	$separation_horizontal_Event = 100;// for activity loop
	$separation_horizontal_Activity = 100;// for next_activity loop
	$left_Process = $left_Process + $width_Event + $separation_horizontal_Event;
	$height_Activity = 1+7+90+7+1;
	$border_Activity = 1; // this is set on the style by 'em' not by 'px', so it is relative
	$padding_Activity = 7; // this is set on the style by 'em' not by 'px', so it is relative
	$number_of_pixels_to_susbstrate_from_width_Activity = 13;
	$with_Activity_depending_on_number_of_tasks_Default = 94;// default
	$with_Activity_depending_on_number_of_tasks_Maximum = $with_Activity_depending_on_number_of_tasks_Default; // to get the nex_activity location
	$separation_vertical_Activity = 50;

	$number_of_connection = 0;

	if (array_key_exists($value_activity_type, $export_array)) {
		foreach ($export_array[$value_activity_type] as $key_parent => $value_parent) {// parent -> [event, activity, next_activity]

			if ($export_array[$value_activity_type][$key_parent][0] == "empty_token") {
				continue;
			}

			foreach ($value_parent as $key_activity => $value_activity) {

				if (in_array($value_activity['id'], $event_duplicity)) {
					wfm_utils::wfm_log('debug', "Event duplicity", __FILE__, __METHOD__, __LINE__);
					$connections .= drawConnection($key_parent, $value_activity['id'], $number_of_connection);
					continue;
				} else  {
					$connections .= drawConnection($key_parent, $value_activity['id'], $number_of_connection);
				}

				$event_duplicity[] = $value_activity['id'];
				wfm_utils::wfm_log('debug', "\$event_duplicity=[".print_r($event_duplicity,true)."]", __FILE__, __METHOD__, __LINE__);
				wfm_utils::wfm_log('debug', "\$aux_counter=[".print_r($aux_counter++,true)."]", __FILE__, __METHOD__, __LINE__);


				$top_Tasks_of_this_activity = 40;
				$left_Tasks_of_this_activity = 5;
				$height_Tasks_of_this_activity = 1+6+32+6+1;
				$width_Tasks_of_this_activity = 1+6+32+6+1; // = 46
				$separation_Tasks_of_this_activity = 5;

				$with_Activity_depending_on_number_of_tasks = $with_Activity_depending_on_number_of_tasks_Default;

				$draw_Tasks_of_this_activity = "";
				$counter_Tasks_of_this_activity = 0;

				// Draw tasks for this activity
				if (array_key_exists('tasks', $export_array)) {
					foreach ($export_array['tasks'] as $key_parent_activity => $value_parent_activity) {
						if ($key_parent_activity == $value_activity['id']) {

							foreach ($value_parent_activity as $key_task => $value_task) {
								$draw_Tasks_of_this_activity .= generate_Task_HTML($value_task['id'], $value_task['name'], $value_task['description'], $value_task['task_type'], $top_Tasks_of_this_activity, $left_Tasks_of_this_activity, $value_task['delay_type'], $value_task['delay'], $value_task['task_order'], $value_task['task_implementation']);
								$counter_Tasks_of_this_activity++;

								$left_Tasks_of_this_activity = $left_Tasks_of_this_activity + $width_Tasks_of_this_activity + $separation_Tasks_of_this_activity;
								$aux_width = $left_Tasks_of_this_activity - $number_of_pixels_to_susbstrate_from_width_Activity;// minimun-activity-width
								$with_Activity_depending_on_number_of_tasks = ($aux_width > $with_Activity_depending_on_number_of_tasks_Default) ? $aux_width : $with_Activity_depending_on_number_of_tasks_Default;
							}
						}
					}
				}

				// Calculate X-coordinate and Width-property for this activity(or next_activity)
				if ($value_activity_type == 'activities') {
					$draw_information_activity[$value_activity['id']]['x'] = $left_Process;
				} else  {
					$draw_information_activity[$value_activity['id']]['x'] = $draw_information_activity[$key_parent]['x'] + $draw_information_activity[$key_parent]['w'] + $separation_horizontal_Activity;
				}
				$draw_information_activity[$value_activity['id']]['w'] = $with_Activity_depending_on_number_of_tasks;

				// Draw activity(or next_activity) and connections. Information about delays and conditions inside the activity.
				$draw_Activities .= generate_Activity_HTML($value_activity['id'], $value_activity['name'], $value_activity['description'], $draw_information_activity[$value_activity['id']]['y'], $draw_information_activity[$value_activity['id']]['x'], $with_Activity_depending_on_number_of_tasks, $draw_Tasks_of_this_activity, $counter_Tasks_of_this_activity, $value_activity['conditions'], $value_activity['delay'], $export_array['processes'][0]['trigger_module']);
					

				$number_of_connection++;
				//$top_Process = $top_Process + $height_Activity + $separation_vertical_Activity;
			}
		}
	}
}

//wfm_utils::wfm_log('debug', "7 TEST DRAW \$export_array=[".print_r($export_array,true)."]", __FILE__, __METHOD__, __LINE__);
//wfm_utils::wfm_log('debug', "7 TEST DRAW \$draw_information_event=[".print_r($draw_information_event,true)."]", __FILE__, __METHOD__, __LINE__);
//wfm_utils::wfm_log('debug', "7 TEST DRAW \$draw_information_activity=[".print_r($draw_information_activity,true)."]", __FILE__, __METHOD__, __LINE__);

// CONTROL-PANEL
$control_panel = '
					<ul class="control_panel">
						<li class="control_panel_action">
							<img id="flowchart_info" class="control_panel_icon nice persistent" src="modules/asol_Process/___common_WFM/images/flowchart_info.png" alt="'.translate('LBL_ASOL_INFO_TITLE', 'asol_Process').'" title="'.translate('LBL_ASOL_INFO_TITLE', 'asol_Process').'" />
						</li>
						<li class="control_panel_action">
							<img class="control_panel_icon" id="refresh" src="modules/asol_Process/___common_WFM/images/flowchart_refresh.png" alt="'.translate('LBL_ASOL_REFRESH', 'asol_Process').'" title="'.translate('LBL_ASOL_REFRESH', 'asol_Process').'" onclick="window.location.reload();" />
						</li>
						<li class="control_panel_action">
							<img class="control_panel_icon" src="modules/asol_Process/___common_WFM/images/overflow_ellipsis.png" alt="'.translate('LBL_ASOL_TEXT_OVERFLOW_ELLIPSIS', 'asol_Process').'" title="'.translate('LBL_ASOL_TEXT_OVERFLOW_ELLIPSIS', 'asol_Process').'" onclick="toggleEllipsis();" />
						</li>
					</ul>
				';

?>

<!-- GENERATE HTTP RESPONSE -->

<meta
	http-equiv="X-UA-Compatible" content="IE=9" />
<!-- needed for border-radius IE -->

<html>

<head>

<script
	src="modules/asol_Process/___common_WFM/js/jquery.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>"
	type="text/javascript"></script>
<script
	src="modules/asol_Process/___common_WFM/js/jquery.jsPlumb.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>"
	type="text/javascript"></script>

<script
	src="modules/asol_Process/___common_WFM/plugins_js_css_images/qTip2/jquery.qtip.min.js?version=<?php wfm_utils::echoVersionWFM(); ?>"
	type="text/javascript"></script>
<link
	href="modules/asol_Process/___common_WFM/plugins_js_css_images/qTip2/jquery.qtip.min.css?version=<?php wfm_utils::echoVersionWFM(); ?>"
	rel="stylesheet">
<!-- <link rel="stylesheet" href="modules/asol_Process/css/flowChart.css">  -->

<script>
	function toggleEllipsis() {
		
		if ($('.aux_name_overflow').hasClass('overflow_ellipsis_enabled')) {
			$('.aux_name_overflow').addClass('overflow_ellipsis_disabled');
			$('.aux_name_overflow').removeClass('overflow_ellipsis_enabled');
		} else {
			$('.aux_name_overflow').addClass('overflow_ellipsis_enabled');
			$('.aux_name_overflow').removeClass('overflow_ellipsis_disabled');
		}
		
		//$(".aux_name_overflow").switchClass( "overflow_ellipsis_disabled", "overflow_ellipsis_enabled", 1000 );
		//$(".aux_name_overflow").switchClass( "overflow_ellipsis_enabled", "overflow_ellipsis_disabled", 1000 );
	}
</script>

<script>
	function generateConnections() {
		<?php echo $connections ?>
		<?php echo $conditions ?>
		<?php echo $delays ?>
		<?php //echo $icon_activities ?>
		
	}
</script>

<script>
	function main_jsPlumb() {
		//alert("jsPlumb is now loaded");
		
		jsPlumb.bind("ready", function() {
			// your jsPlumb related init code goes here
			
			jsPlumb.Defaults.Container = $("body"); // In order to attach svg-jsPlumb-tags to the body, and not to the elements´s parent that is connected  
			
			jsPlumb.importDefaults({
				// default to blue at one end and green at the other
				EndpointStyles : [{ fillStyle:'#225588' }, { fillStyle:'#225588' }],
				//EndpointStyles : [ null, null ],
				// blue endpoints 7 px; green endpoints 11.
				//Endpoints : [ [ "Dot", {radius:3} ], [ "Rectangle", { width :10, height: 10 } ]],
				Endpoints : [ [ "Dot", {radius:3} ],  [ "Dot", {radius:3} ]],
				//Endpoints : [ "Blank", "Blank" ],
				// the overlays to decorate each connection with.
				//
				ConnectionOverlays : [
					[ "Arrow", { location:0.5 } ]
				],
				
				//Connector : [ "Flowchart", { stub:10 } ],
				//Connector : [ "Bezier", { curviness:1 } ],
				Connector : [ "Straight" ],
				//Connector : [ "StateMachine", {curviness :0} ],
				// 
				Anchors : [ "RightMiddle", "LeftMiddle" ],
				//
				PaintStyle : { lineWidth:3,	strokeStyle:"#deea18", joinstyle:"round"},
				//
				HoverPaintStyle : { lineWidth:5, strokeStyle:"#2e2aF8" }
			});

			generateConnections();	
			
		});

		jsPlumb.bind("click", function(conn, originalEvent) {

			if ($('#'+conn.sourceId).hasClass('connection_clicked')) {
				$('#'+conn.sourceId).removeClass('connection_clicked');
			} else {
				$('#'+conn.sourceId).addClass('connection_clicked');
			}

			if ($('#'+conn.targetId).hasClass('connection_clicked')) {
				$('#'+conn.targetId).removeClass('connection_clicked');
			} else {
				$('#'+conn.targetId).addClass('connection_clicked');
			}
		});
		
 	}		
</script>

<script>
		//-----------------MAIN SCRIPT---------------//
		
		$(document).ready(function() {

			//Check to see if the window is top if not then display button
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('.scrollToTop').fadeIn();
				} else {
					$('.scrollToTop').fadeOut();
				}
			});
			//Click event to scroll to top
			$('.scrollToTop').click(function(){
				$('html, body').animate({scrollTop : 0},800);
				return false;
			});
			
			// When pressing 'Ctrl' key + 'Space' key => complete names
			$(document).keypress(function(e) {
			    if (e.which == 32) { // space key was pressed
			        if (e.ctrlKey) { // 
			        	toggleEllipsis();
			        } 
			    }
			});
			
			// When pressing 'Ctrl' key and clicking on a link => redirect to EditView (instead of DetailView when only clicking without pressing)
			$("a").not('#scrollToTop').click(function(event) {
				
				var viewType = "DetailView";
				if (event.ctrlKey) {
					viewType = "EditView";	
				}

				var module = $(this).attr("module");
				var id = $(this).attr("link_id");
				window.opener.location='index.php?module='+module+'&action='+viewType+'&record='+id;
				
			});

			// jsPlumb
			main_jsPlumb();

			$('a[title]').qtip({
				style: {
					classes: 'ui-tooltip-rounded ui-tooltip-shadow'
				},
				position: {
					my: 'bottom left',
					at: 'top left'
				}
			});

			$('.process_name a').qtip({
				content: {
					attr: 'qtip_info'
				},
				style: {
					classes: 'ui-tooltip-rounded ui-tooltip-shadow myTooltip'
				},
				position: {
					my: 'top left',
					at: 'bottom left'
				}
			});
			
			$('.delay_icon img, .delay_icon_for_task img').qtip({
				content: {
					attr: 'alt'
				},
				style: {
					classes: 'ui-tooltip-rounded ui-tooltip-shadow myTooltip'
				},
				position: {
					my: 'bottom middle',
					at: 'top middle'
				}
			});

			$('.event_symbol img, .task_call_process_open_subprocess_icon img').qtip({
				content: {
					attr: 'qtip_info'
				},
				style: {
					classes: 'ui-tooltip-rounded ui-tooltip-shadow myTooltip'
				},
				position: {
					my: 'bottom left',
					at: 'top right'
				},
			});

			$('.condition_icon img, .condition_icon_for_events img').qtip({
				content: {
					attr: 'qtip_info'
				},
				style: {
					classes: 'ui-tooltip-rounded ui-tooltip-shadow myTooltip'
				},
				position: {
					my: 'left top',
					at: 'bottom middle'
				},
				show: 'click',
				hide: 'click',
			});
			
		});

		$(window).unload(function() {
			jsPlumb.unload();
		});


		// BEGIN - Growl
		$(document).ready(function() {
		    $('#flowchart_info').click(function() {
		        // Check if it should be persistent (can set to a normal bool if you like!)
		        createGrowl($(this).hasClass('persistent'));
		    });
		 
		    window.createGrowl = function(persistent) {
		        // Use the last visible jGrowl qtip as our positioning target
		        var target = $('.qtip.jgrowl:visible:last');
		 
		        // Create your jGrowl qTip...
		        $(document.body).qtip({
		            // Any content config you want here really.... go wild!
		            content: {
		                text: '<?php echo translate('LBL_ASOL_INFO_TEXT', 'asol_Process') ?>',
		                title: {
		                    text: '<?php echo translate('LBL_ASOL_INFO_TITLE', 'asol_Process') ?>',
		                    button: true
		                }
		            },
		            position: {
		                my: 'top right',
		                // Not really important...
		                at: (target.length ? 'bottom' : 'top') + ' right',
		                // If target is window use 'top right' instead of 'bottom right'
		                target: target.length ? target : $(window),
		                // Use our target declared above
		                adjust: { x: -5, y: 47 }, // y = bar height + bar border
		                effect: function(api, newPos) {
		                    // Animate as usual if the window element is the target
		                    $(this).animate(newPos, {
		                        duration: 200,
		                        queue: false
		                    });
		 
		                    // Store the final animate position
		                    api.cache.finalPos = newPos; 
		                }
		            },
		            show: {
		                event: false,
		                // Don't show it on a regular event
		                ready: true,
		                // Show it when ready (rendered)
		                effect: function() {
		                    $(this).stop(0, 1).fadeIn(400);
		                },
		                // Matches the hide effect
		                delay: 0,
		                // Needed to prevent positioning issues
		                // Custom option for use with the .get()/.set() API, awesome!
		                persistent: persistent
		            },
		            hide: {
		                event: false,
		                // Don't hide it on a regular event
		                effect: function(api) {
		                    // Do a regular fadeOut, but add some spice!
		                    $(this).stop(0, 1).fadeOut(400).queue(function() {
		                        // Destroy this tooltip after fading out
		                        api.destroy();
		 
		                        // Update positions
		                        updateGrowls();
		                    })
		                }
		            },
		            style: {
		                classes: 'jgrowl qtip-dark qtip-rounded',
		                // Some nice visual classes
		                tip: false // No tips for this one (optional ofcourse)
		            },
		            events: {
		                render: function(event, api) {
		                    // Trigger the timer (below) on render
		                    timer.call(api.elements.tooltip, event);
		                }
		            }
		        }).removeData('qtip');
		    };
		 
		    // Make it a window property see we can call it outside via updateGrowls() at any point
		    window.updateGrowls = function() {
		        // Loop over each jGrowl qTip
		        var each = $('.qtip.jgrowl'),
		            width = each.outerWidth(),
		            height = each.outerHeight(),
		            gap = each.eq(0).qtip('option', 'position.adjust.y'),
		            pos;
		 
		        each.each(function(i) {
		            var api = $(this).data('qtip');
		 
		            // Set target to window for first or calculate manually for subsequent growls
		            api.options.position.target = !i ? $(window) : [
		                pos.left + width, pos.top + (height * i) + Math.abs(gap * (i-1))
		            ];
		            api.set('position.at', 'top right');
		            
		            // If this is the first element, store its finak animation position
		            // so we can calculate the position of subsequent growls above
		            if(!i) { pos = api.cache.finalPos; }
		        });
		    };
		 
		    // Setup our timer function
		    function timer(event) {
		        var api = $(this).data('qtip'),
		            lifespan = 5000; // 5 second lifespan
		        
		        // If persistent is set to true, don't do anything.
		        if (api.get('show.persistent') === true) { return; }
		 
		        // Otherwise, start/clear the timer depending on event type
		        clearTimeout(api.timer);
		        if (event.type !== 'mouseover') {
		            api.timer = setTimeout(api.hide, lifespan);
		        }
		    }
		 
		    // Utilise delegate so we don't have to rebind for every qTip!
		    $(document).delegate('.qtip.jgrowl', 'mouseover mouseout', timer);
		});
		// END - Growl
</script>

<style type="text/css">
body {
	margin: 0;
	padding: 0;
}

table {
	white-space: nowrap;
}

/********custom scrollbar*********/
::-webkit-scrollbar {
	width: 12px;
}

::-webkit-scrollbar-track {
	-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
	border-radius: 10px;
}

::-webkit-scrollbar-thumb {
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
}
/********************/

/*****qTip******/
.myTooltip {
	max-width: 1000px; /*Tooltips have a max-width of 280px by default*/
}

.asol_table_tooltip {
	
}

/*
			td, th{
			    border: 1px inset Silver;
			    width: auto;
			}
			*/
.gradient-style {
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 12px;
	margin: 2px;
	width: auto;
	text-align: left;
	border-collapse: collapse;
}

.gradient-style th {
	font-size: 10px;
	font-weight: normal;
	padding: 1px;
	background: #b9c9fe
		url('modules/asol_Process/_flowChart/images/gradhead.png') repeat-x;
	border-top: 2px solid #d3ddff;
	border-bottom: 1px solid #fff;
	color: #039;
}

.gradient-style td {
	padding: 1px;
	border-bottom: 1px solid #fff;
	color: #669;
	border-top: 1px solid #fff;
	background: #e8edff
		url('modules/asol_Process/_flowChart/images/gradback.png') repeat-x;
}

.gradient-style tfoot tr td {
	background: #e8edff;
	font-size: 12px;
	color: #99c;
}

.gradient-style tbody tr:hover td {
	background: #d0dafd
		url('modules/asol_Process/_flowChart/images/gradhover.png') repeat-x;
	color: #339;
}

/****************/
a {
	cursor: alias;
}

/***************/
.delay_icon { /*for activity*/
	position: absolute;
	top: -13px;
	left: -9px;
	opacity: 1;
	z-index: 40;
	cursor: copy;
}

.delay_icon_for_task {
	position: absolute;
	top: 14px;
	left: -5px;
	opacity: 1;
	z-index: 40;
	cursor: copy;
}

.condition_icon { /*for activity*/
	position: absolute;
	top: 44px;
	left: -9px;
	opacity: 1;
	z-index: 40;
	cursor: help;
}

.condition_icon_for_events {
	position: absolute;
	top: 39px;
	left: -13px;
	opacity: 1;
	z-index: 40;
	cursor: help;
}

.trigger_event {
	position: absolute;
	top: 3px;
	left: 89px;
	opacity: 1;
	z-index: 40;
	cursor: pointer;
}

.task_call_process_open_subprocess_icon {
	position: absolute;
	top: 27px;
	left: 27px;
	opacity: 1;
	z-index: 40;
	cursor: alias;
}
/****************/
._jsPlumb_endpoint,.endpointTargetLabel,.endpointSourceLabel {
	
}

._jsPlumb_connector {
	z-index: 10;
}

._jsPlumb_endpoint {
	z-index: 11;
}

._jsPlumb_overlay {
	z-index: 12;
}

.aux_name_overflow {
	
}

.overflow_ellipsis_disabled {
	overflow: visible;
	text-overflow: ellipsis;
}

.overflow_ellipsis_enabled {
	overflow: hidden;
	text-overflow: ellipsis;
}

.control_panel {
	margin: 0;
	padding: 5px;
	position: fixed;
	z-index: 100000;
	width: 100%;
	height: 30px
	top: 0px;
	background: #DDDDDD;
	border-bottom: solid 2px #AAAAAA;
}

.control_panel li {
	display: inline-block;
	margin: 5px;
}

.control_panel .control_panel_icon {
	width: 20px;
	height: 20px;
}

.control_panel .control_panel_action {
	cursor: pointer;
	height: 20px;
}

.process_name {
	position: absolute;
	top: 70px;
	left: 5px;
	white-space: nowrap;
	font-family: arial;
	font-size: 30px;
	width: auto;
	cursor: pointer;
	color: blue;
	text-decoration: none;
}

.process_name:hover {
	text-decoration: underline;
}

.process_name a {
	
}

.event {
	position: absolute;
}

.event_symbol {
	border: 1px solid #346789;
	box-shadow: 2px 2px 19px #aaa;
	-o-box-shadow: 2px 2px 19px #aaa;
	-webkit-box-shadow: 2px 2px 19px #aaa;
	-moz-box-shadow: 2px 2px 19px #aaa;
	-moz-border-radius: 0.5em;
	border-radius: 0.5em;
	opacity: 1;
	filter: alpha(opacity =                       80);
	background-color: #eeeeef;
	padding: 0.5em;
	font-size: 0.9em;
	cursor: pointer;
	z-index: 20;
	position: absolute;
	width: auto;
	height: auto;
}

.event_symbol:hover {
	box-shadow: 2px 2px 19px #444;
	-o-box-shadow: 2px 2px 19px #444;
	-webkit-box-shadow: 2px 2px 19px #444;
	-moz-box-shadow: 2px 2px 19px #444;
	opacity: 1;
	filter: alpha(opacity =                       60);
}

.event_name {
	font-family: arial;
	font-size: 13px;
	white-space: nowrap;
	position: absolute;
	top: 104px;
	width: 106px;
	color: blue;
	cursor: pointer;
	text-decoration: none;
}

.event_name:hover {
	text-decoration: underline;
}

.event_name a {
	width: auto;
}

/**********************/
.activity {
	width: auto;
	height: auto;
	position: absolute;
}

.activity_symbol {
	border: 1px solid #346789;
	box-shadow: 2px 2px 19px #aaa;
	-o-box-shadow: 2px 2px 19px #aaa;
	-webkit-box-shadow: 2px 2px 19px #aaa;
	-moz-box-shadow: 2px 2px 19px #aaa;
	-moz-border-radius: 0.5em;
	border-radius: 0.5em;
	opacity: 1;
	filter: alpha(opacity =                       80);
	width: 668px;
	height: 90px;
	z-index: 20;
	position: absolute;
	background-color: #eeeeef;
	padding: 0.5em;
	font-size: 0.9em;
	cursor: pointer;
}

.activity_symbol img {
	z-index: 40;
}

.activity_symbol:hover {
	box-shadow: 2px 2px 19px #444;
	-o-box-shadow: 2px 2px 19px #444;
	-webkit-box-shadow: 2px 2px 19px #444;
	-moz-box-shadow: 2px 2px 19px #444;
	opacity: 1;
	filter: alpha(opacity =                       60);
}

.activity_name {
	font-family: arial;
	font-size: 13px;
	white-space: nowrap;
	width: auto;
	height: auto;
	position: absolute;
	left: 5px /*45px*/;
	top: 12px;
	color: blue;
	text-decoration: none;
}

.activity_name:hover {
	text-decoration: underline;
}

.activity_name a {
	width: auto;
}
/**********************/
.task {
	width: auto;
	height: auto;
	position: absolute;
}

.task_symbol {
	border: 1px solid #346789;
	box-shadow: 2px 2px 19px #aaa;
	-o-box-shadow: 2px 2px 19px #aaa;
	-webkit-box-shadow: 2px 2px 19px #aaa;
	-moz-box-shadow: 2px 2px 19px #aaa;
	-moz-border-radius: 0.5em;
	border-radius: 0.5em;
	opacity: 0.8;
	filter: alpha(opacity =                       80);
	width: auto;
	height: auto;
	z-index: 20;
	position: absolute;
	background-color: #eeeeef;
	padding: 0.5em;
	font-size: 0.9em;
	cursor: pointer;
}

.task_symbol:hover {
	box-shadow: 2px 2px 19px #444;
	-o-box-shadow: 2px 2px 19px #444;
	-webkit-box-shadow: 2px 2px 19px #444;
	-moz-box-shadow: 2px 2px 19px #444;
	opacity: 0.6;
	filter: alpha(opacity =                       60);
}

.task_name { /*overflow: hidden;
				text-overflow: ellipsis;*/
	font-family: arial;
	font-size: 13px;
	white-space: nowrap;
	width: 46px;
	height: auto;
	color: blue;
	text-decoration: none;
}

.task_name:hover {
	text-decoration: underline;
}

.task_name a {
	width: auto;
	font-size: 10px;
}

.connection_clicked {
	border-color: red;
	border-width: thin;
	border-style: solid;
}

.scrollToTop {
	width: 48px;
	height: 48px;
	padding: 10px;
	text-align: center;
	background: whiteSmoke;
	font-weight: bold;
	color: #444;
	text-decoration: none;
	position: fixed;
	bottom: 24px;
	right: 0px;
	display: none;
	background:
		url('modules/asol_Process/_flowChart/images/scrollToTop_48.png')
		no-repeat 0px 20px;
	cursor: pointer;
}

.scrollToTop:hover {
	text-decoration: none;
}
</style>

<title>Flow</title>


</head>

<body>

<?php echo $control_panel; ?>

<?php echo $draw_Process; ?>

<?php echo $draw_Events; ?>

<?php echo $draw_Activities; ?>

	<a id='scrollToTop' href="#" class="scrollToTop"></a>

</body>

</html>

<?php
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

exit;
?>