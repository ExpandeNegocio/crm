<?php
global $db;

function drawDiv($id, $module, $name, $top, $left) {
	return '<div class="window" style="top:'.$top.'px; left:'.$left.'px;" id="'.$id.'"><strong><a href="index.php?module='.$module.'&action=DetailView&record='.$id.'">'.$name.'</a></strong><br/><br/></div>';
}






$divs = "";
$connections = "";

$GLOBALS['log']->debug("*********************** ASOL: ENTRY flowChart.php");

$GLOBALS['log']->debug("*********************** ASOL: ENTRY POINT \$_REQUEST=[".print_r($_REQUEST,true)."]");



$export_array = Array();

//$process_id = $_REQUEST['process_id'];//////////////*************para el export_button.php

// extract process_ids from $_REQUEST
$process_ids_array = explode(',', $_REQUEST['uid']);

$top=100;
$left=100;

foreach($process_ids_array as $key_process_id => $value_process_id) {
	$process_query = $db->query ("
									SELECT *
									FROM asol_process
									WHERE id = '".$value_process_id."'
								");
	$process_row = $db->fetchByAssoc($process_query);

	$export_array['processes'][] = $process_row;
	$divs .= drawDiv($process_row['id'], 'asol_Process', $process_row['name'], $top, $left);
	$left = ($left + 100) + 10*strlen($process_row['name']);
}

$GLOBALS['log']->debug("*********************** ASOL: 1 FINAL \$export_array=[".print_r($export_array,true)."]");

// search for events

$top=400;
$left=100;

if (!empty($export_array['processes'])) {
	foreach ($export_array['processes'] as $key_process => $value_process) {
	
		$event_ids_from_process__array = Array();
		$event_ids_from_process__query = $db->query("
														SELECT asol_procea8ca_events_idb AS event_id
														FROM asol_proces_asol_events_c
														WHERE asol_proce6f14process_ida = '".$value_process['id']."' AND deleted = 0
													");
		while ($event_ids_from_process__row = $db->fetchByAssoc($event_ids_from_process__query)) {
			$event_ids_from_process__array[] = $event_ids_from_process__row['event_id'];
		}
		foreach ($event_ids_from_process__array as $key_event_id => $value_event_id) {
			//$export_array['process']['event_ids'][] = $value_event_id;
	
			$event_query = $db->query ("
											SELECT *
											FROM asol_events
											WHERE id = '".$value_event_id."'
										");
			$event_row = $db->fetchByAssoc($event_query);
	
			$export_array['events'][$value_process['id']][] = $event_row;
			$divs .= drawDiv($event_row['id'], 'asol_Events', $event_row['name'], $top, $left);
			//$connections .= drawConnection($value_process['id'], $event_row['id']);
			$left = ($left + 100) + 10*strlen($event_row['name']);
		}
	}
}
$GLOBALS['log']->debug("*********************** ASOL: 2 FINAL \$export_array=[".print_r($export_array,true)."]");

// search for activities

$top=700;
$left=100;

if (!empty($export_array['events'])) {
	foreach ($export_array['events'] as $key_parent_process => $value_parent_process) {
		foreach ($value_parent_process as $key_event => $value_event) {
			$activity_ids_from_event__array = Array();
			$activity_ids_from_event__query = $db->query("
															SELECT asol_event8042ctivity_idb AS activity_id
															FROM asol_eventssol_activity_c
															WHERE asol_event87f4_events_ida = '".$value_event['id']."' AND deleted = 0
														");
	
			while ($activity_ids_from_event__row = $db->fetchByAssoc($activity_ids_from_event__query)) {
				$activity_ids_from_event__array[] = $activity_ids_from_event__row['activity_id'];
			}
	
			foreach ($activity_ids_from_event__array as $key_activity_id => $value_activity_id) {
				//$export_array['events'][$key_event]['activity_ids'][] = $value_activity_id;
	
				$activity_query = $db->query ("
												SELECT *
												FROM asol_activity
												WHERE id = '".$value_activity_id."'
											");
				$activity_row = $db->fetchByAssoc($activity_query);
	
				$export_array['activities'][$value_event['id']][] = $activity_row;
				$divs .= drawDiv($activity_row['id'], 'asol_Activity', $activity_row['name'], $top, $left);
				//$connections .= drawConnection($value_event['id'], $activity_row['id']);
				$left = ($left + 100) + 10*strlen($activity_row['name']);
				//$GLOBALS['log']->debug("*********************** ASOL: 3 part \$export_array=[".print_r($export_array,true)."]");
			}
		}
	}
}
$GLOBALS['log']->debug("*********************** ASOL: 3 FINAL \$export_array=[".print_r($export_array,true)."]");

// search for next_activities from activities(from events)

$top=1000;
$left=100;

function getNextActivities($activity_id, $next_activities=array()){ // recursive

	$GLOBALS['log']->debug("****************ASOL: Executing getNextActivities function");

	global $db;
	$next_activities_query = $db->query("
											SELECT asol_activ9e2dctivity_idb  AS next_activity_id
											FROM asol_activisol_activity_c
											WHERE asol_activ898activity_ida  = '".$activity_id."' AND deleted = 0
										");

	while($next_activities_row = $db->fetchByAssoc($next_activities_query)) {
		$next_activities[] = $next_activities_row['next_activity_id'];

		getNextActivities($next_activities_row['next_activity_id'], & $next_activities);
	}

	return $next_activities;
}


if (!empty($export_array['activities'])) {
	$activity_ids = Array();
	
	foreach ($export_array['activities'] as $key_parent_event => $value_parent_event) {
		foreach ($value_parent_event as $key_activity => $value_activity) {
	
			$GLOBALS['log']->debug("*********************** ASOL: \$activity_ids=[".print_r($activity_ids,true)."]");
			if (!in_array($value_activity['id'], $activity_ids)) {	// Event duplicity.
	
				$next_activity_ids_all_tree = getNextActivities($value_activity['id']);
	
				$GLOBALS['log']->debug("****************ASOL: \$next_activity_ids_all_tree".print_r($next_activity_ids_all_tree,true));
	
				foreach($next_activity_ids_all_tree as $key => $value) {
					//$export_array['activities'][$key_activity]['next_activity_ids'][] = $value;
	
					$next_activity_query = $db->query ("
														SELECT *
														FROM asol_activity
														WHERE id = '".$value."'
													");
					$next_activity_row = $db->fetchByAssoc($next_activity_query);
	
					$parent_activity_query = $db->query("
														SELECT asol_activ898activity_ida   AS parent_activity_id
														FROM asol_activisol_activity_c
														WHERE asol_activ9e2dctivity_idb  = '".$next_activity_row['id']."' AND deleted = 0
													");
					$parent_activity_row = $db->fetchByAssoc($parent_activity_query);
	
					$export_array['next_activities'][$parent_activity_row['parent_activity_id']][] = $next_activity_row;
					$divs .= drawDiv($next_activity_row['id'], 'asol_Activity', $next_activity_row['name'], $top, $left);
					//$connections .= drawConnection($parent_activity_row['parent_activity_id'], $next_activity_row['id']);
					$left = ($left + 100) + 10*strlen($next_activity_row['name']);
				}
				
				$activity_ids[] = $value_activity['id'];
			}
			else {
				$GLOBALS['log']->debug("*********************** ASOL: Event duplicity");
			}
		}
	}
}
$GLOBALS['log']->debug("*********************** ASOL: 4 FINAL \$export_array=[".print_r($export_array,true)."]");

// search for tasks from activities(from events)
$top=1300;
$left=100;

if (!empty($export_array['activities'])) {
	foreach ($export_array['activities'] as $key_parent_event => $value_parent_event) {
	
		foreach($value_parent_event as $key_activity => $value_activity) {
	
			$task_ids_from_activity__array = Array();
			$task_ids_from_activity__query = $db->query("
														SELECT asol_activf613ol_task_idb AS task_id
														FROM asol_activity_asol_task_c
														WHERE asol_activ5b86ctivity_ida = '".$value_activity['id']."' AND deleted = 0
													");
			while ($task_ids_from_activity__row = $db->fetchByAssoc($task_ids_from_activity__query)) {
				$task_ids_from_activity__array[] = $task_ids_from_activity__row['task_id'];
			}
	
			foreach ($task_ids_from_activity__array as $key_task_id => $value_task_id) {
				//$export_array['activities'][$key_activity]['task_ids'][] = $value_task_id;
	
				$task_query = $db->query ("
											SELECT *
											FROM asol_task
											WHERE id = '".$value_task_id."'
										");
				$task_row = $db->fetchByAssoc($task_query);
	
				$export_array['tasks'][$value_activity['id']][] = $task_row;
				$divs .= drawDiv($task_row['id'], 'asol_Task', $task_row['name'], $top, $left);
				//$connections .= drawConnection($value_activity['id'], $task_row['id']);
				$left = ($left + 100) + 10*strlen($task_row['name']);
			}
		}
	}
}

$GLOBALS['log']->debug("*********************** ASOL: 5 FINAL \$export_array=[".print_r($export_array,true)."]");

// search for tasks from activities(from next_activities)
//$top=1600;
//$left=1000;

if (!empty($export_array['next_activities'])) {
	foreach ($export_array['next_activities'] as $key_parent_activity => $value_array_next_activities) {
	
		foreach($value_array_next_activities as $key_activity => $value_activity) {
	
			$task_ids_from_activity__array = Array();
			$task_ids_from_activity__query = $db->query("
														SELECT asol_activf613ol_task_idb AS task_id
														FROM asol_activity_asol_task_c
														WHERE asol_activ5b86ctivity_ida = '".$value_activity['id']."' AND deleted = 0
													");
			while ($task_ids_from_activity__row = $db->fetchByAssoc($task_ids_from_activity__query)) {
				$task_ids_from_activity__array[] = $task_ids_from_activity__row['task_id'];
			}
	
			foreach ($task_ids_from_activity__array as $key_task_id => $value_task_id) {
				//$export_array['next_activities'][$key_activity]['task_ids'][] = $value_task_id;
	
				$task_query = $db->query ("
											SELECT *
											FROM asol_task
											WHERE id = '".$value_task_id."'
										");
				$task_row = $db->fetchByAssoc($task_query);
	
				$export_array['tasks'][$value_activity['id']][] = $task_row;
				$divs .= drawDiv($task_row['id'], 'asol_Task',$task_row['name'], $top, $left);
				//$connections .= drawConnection($value_activity['id'], $task_row['id']);
				$left = ($left + 100) + 10*strlen($task_row['name']);
			}
		}
	}
}
$GLOBALS['log']->debug("*********************** ASOL: 6 FINAL \$export_array=[".print_r($export_array,true)."]");
//echo nl2br(var_export($export_array,true));

















//connector : [ "Flowchart", { stub:'.$stub.' } ],  



function drawConnection ($source, $target, $number_of_connection) {
	$stub = 5*$number_of_connection;
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
			jsPlumb.addEndpoint( "'.$id.'", targetEndpoint );
	';
}



////////////////////////////////////////////////////////////
function generate_Event_HTML($id, $name, $top, $left) {
	
	if (strlen($name) >= (13-3)) {// 3->...(3 period)
		$displayed_name = substr($name, 0, (13-3));
		$ellipsis = '...'; 
	} else {
		$displayed_name = $name;
		$ellipsis = "";
	}
	
	return '
		<div class="event" style="top:'.$top.'px; left:'.$left.'px;">
			<div class="event_symbol" id="'.$id.'" style="width: 90px; height: 90px">
				<img alt="Event" src="modules/asol_Process/_flowChart/images/event_end_90.png">
			</div>
			<div class="event_name">
				<span>
					<a href="index.php?module=asol_Events&action=DetailView&record='.$id.'">'.$name.$ellipsis.'</a>
				</span>
			</div>
		</div>
	';
}

function generate_Activity_HTML($id, $name, $top, $left, $width, $draw_Tasks_of_this_activity, $counter_Tasks_of_this_activity) {
	
	if ($counter_Tasks_of_this_activity <= 2) {
		$displayed_name = substr($name, 0, 6);
		$ellipsis = '...'; 
	} else {
		if (strlen($name) >= (15-3)) {
			$displayed_name = substr($name, 0, 12);
			$ellipsis = '...'; 
		} else {
			$displayed_name = $name;
			$ellipsis = "";
		}
	}
	
	return '
		<div class="activity_symbol"  id="'.$id.'" style="top:'.$top.'px; left:'.$left.'px; width:'.$width.'px;">
			<div>
				<span>
					<img alt="Activity" src="modules/asol_Process/_flowChart/images/icon_asol_Activity_32.gif">
				</span>
				<span class="activity_name">
					<a href="index.php?module=asol_Activity&action=DetailView&record='.$id.'" title="'.$name.'">'.$displayed_name.$ellipsis.'</a>
				</span>
			</div>
			
			<!-- ******************************************************** -->
			<div class="activity_container_of_tasks">' 
			. $draw_Tasks_of_this_activity .
			' 
			</div>
			<!-- ******************************************************** -->
			
		</div>
	';
}

function generate_Task_HTML($id, $name, $task_type, $top, $left) {
	
	if (strlen($name) >= (9-3)) {// 3->...(3 period)
		$displayed_name = substr($name, 0, (9-3));
		$ellipsis = '...'; 
	} else {
		$displayed_name = $name;
		$ellipsis = ''; 
	}
	
	return '
		<div class="task" style="top:'.$top.'px; left:'.$left.'px;">
			<div class="task_name">
				<a href="index.php?module=asol_Task&action=DetailView&record='.$id.'" title="'.$name.'">'.$displayed_name.$ellipsis.'</a>
			</div>
			<div class="task_symbol" id="'.$id.'">
				<img alt="Task" src="modules/asol_Process/_flowChart/images/task_'.$task_type.'_32.png" title="'.$task_type.'">
			</div>
		</div>	
	';
}




/////////////////////////////////////////////////////////




// print Events
$top_Process = 100;
$left_Process = 50;
$height_Event = 1+7+90+7+1;
$width_Event = 1+7+90+7+1;
$separation_vertical_Event = 50;

$draw_Events = "";
if (array_key_exists('events', $export_array)) {
	foreach ($export_array['events'] as $key_parent_process => $value_parent_process) {
		foreach ($value_parent_process as $key_event => $value_event) {
			$draw_Events .= generate_Event_HTML($value_event['id'], $value_event['name'], $top_Process, $left_Process);
			$top_Process = $top_Process + $height_Event + $separation_vertical_Event;
		}
	}
}



////////////////////////
$draw_Activities = "";
$connections = "";
$conditions = "";


// print activities(and next_activities) and their tasks
$activity_type = Array('activities', 'next_activities');

foreach ($activity_type as $key_activity_type => $value_activity_type) {

	$top_Process = 100;
	$separation_horizontal_Event = 100;// for activity loop
	$separation_horizontal_Activity = 100;// for next_activity loop
	if ($value_activity_type == 'activities') {
		$left_Process = $left_Process + $width_Event + $separation_horizontal_Event;
	} else {
		$left_Process = $left_Process + $with_Activity_depending_on_number_of_tasks_Maximum + $separation_horizontal_Activity;
	}
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
			
			foreach ($value_parent as $key_activity => $value_activity) {
				$top_Tasks_of_this_activity = 40;
				$left_Tasks_of_this_activity = 5;
				$height_Tasks_of_this_activity = 1+6+32+6+1;
				$width_Tasks_of_this_activity = 1+6+32+6+1;
				$separation_Tasks_of_this_activity = 5;
				
				$with_Activity_depending_on_number_of_tasks = $with_Activity_depending_on_number_of_tasks_Default;
	
				$draw_Tasks_of_this_activity = "";
				$counter_Tasks_of_this_activity = 0;
				
				////////////////////////////////////////////////////////////////
				if (array_key_exists('tasks', $export_array)) {
					foreach ($export_array['tasks'] as $key_parent_activity => $value_parent_activity) {
						if ($key_parent_activity == $value_activity['id']) {
							
							foreach ($value_parent_activity as $key_task => $value_task) {
								$draw_Tasks_of_this_activity .= generate_Task_HTML($value_task['id'], $value_task['name'], $value_task['task_type'], $top_Tasks_of_this_activity, $left_Tasks_of_this_activity);
								$counter_Tasks_of_this_activity++;

								$left_Tasks_of_this_activity = $left_Tasks_of_this_activity + $width_Tasks_of_this_activity + $separation_Tasks_of_this_activity;
								$aux_width = $left_Tasks_of_this_activity - $number_of_pixels_to_susbstrate_from_width_Activity;// minimun-activity-width
								$with_Activity_depending_on_number_of_tasks = ($aux_width > $with_Activity_depending_on_number_of_tasks_Default) ? $aux_width : $with_Activity_depending_on_number_of_tasks_Default;
								if ($value_activity_type == 'activities') {
									$with_Activity_depending_on_number_of_tasks_Maximum = ($with_Activity_depending_on_number_of_tasks > $with_Activity_depending_on_number_of_tasks_Maximum) ? $with_Activity_depending_on_number_of_tasks : $with_Activity_depending_on_number_of_tasks_Maximum;
								} 							
							}
						}
					}
				}
				////////////////////////////////////////////////////////////////
				
				
				$draw_Activities .= generate_Activity_HTML($value_activity['id'], $value_activity['name'], $top_Process, $left_Process, $with_Activity_depending_on_number_of_tasks, $draw_Tasks_of_this_activity, $counter_Tasks_of_this_activity);
				$connections .= drawConnection($key_parent, $value_activity['id'], $number_of_connection);
				$conditions .= ($value_activity['conditions'] == '') ? "" : drawCondition($value_activity['id']);
				$delays .= ( ($value_activity['delay'] == 'minutes - 0') || ($value_activity['delay'] == 'hours - 0') || ($value_activity['delay'] == 'days - 0') || ($value_activity['delay'] == 'weeks - 0') || ($value_activity['delay'] == 'months - 0') ) ? "" : drawDelay($value_activity['id']);
				$number_of_connection++;
				$top_Process = $top_Process + $height_Activity + $separation_vertical_Activity;
			}
		}
	}
}


?>

<!-- GENERATE HTTP RESPONSE -->

<html>

	<head>
		<script src="modules/asol_Process/___common_WFM/js/jquery.min.js?version=D20130121T1155" type="text/javascript"></script>
		<script src="modules/asol_Process/___common_WFM/js/jquery.min.jsPlumb.js?version=D20130121T1155" type="text/javascript"></script>
		<!-- <link rel="stylesheet" href="modules/asol_Process/css/flowChart.css">  -->
		
		<script>
			function generateConnections() {
				<?php echo $connections ?>
				<?php echo $conditions ?>
				<?php echo $delays ?>
				
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
						PaintStyle : { lineWidth:3,	strokeStyle:"#deea18", joinstyle:"round" },
						//
						HoverPaintStyle : { lineWidth:5, strokeStyle:"#2e2aF8" }
					});
	
					generateConnections();	
					
				});
		 	}		
		</script>
		
		<script>
				$(document).ready(function() {
					main_jsPlumb();
					
				});
		
				$(window).unload(function() {
					jsPlumb.unload();
				});
		</script>
		
		<style type="text/css">
		
			._jsPlumb_endpoint,.endpointTargetLabel,.endpointSourceLabel {
				z-index: 21;
				cursor: help;
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
				opacity: 0.8;
				filter: alpha(opacity = 80);
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
				opacity: 0.6;
				filter: alpha(opacity = 60);
			}
			
			.event_name {
				position: absolute;
    			top: 104px;
			}
			
			.event_name a {
				text-decoration: none;
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
				opacity: 0.8;
				filter: alpha(opacity = 80);
				width: 668px;
				height: 90px;
				z-index: 20;
				position: absolute;
				background-color: #eeeeef;
				padding: 0.5em;
				font-size: 0.9em;
			    cursor: pointer;
			}
			
			.activity_symbol:hover {
				box-shadow: 2px 2px 19px #444;
				-o-box-shadow: 2px 2px 19px #444;
				-webkit-box-shadow: 2px 2px 19px #444;
				-moz-box-shadow: 2px 2px 19px #444;
				opacity: 0.8;
				filter: alpha(opacity = 60);
			}
			
			.activity_name {
				width: auto;
				height: auto;
				font-size: 14px;
				position: absolute;
			    left: 45px;
			    top: 12px;
			}
			
			.activity_name a {
				text-decoration: none;
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
				filter: alpha(opacity = 80);
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
				filter: alpha(opacity = 60);
			}
			
			.task_name {
				width: auto;
				height: auto;
			}
			
			.task_name a {
				text-decoration: none;
				width: auto;
				font-size: 10px;
			}
			
		</style>
		
	</head>

	<body>
	
		<?php //echo $divs; ?>
		
		<?php echo $draw_Events; ?>
		
		<?php echo $draw_Activities; ?>
		
		<?php echo $draw_nextActivities; ?>
		
	</body>

</html>

<?php 
$GLOBALS['log']->debug("*********************** ASOL: EXIT flowChart");

exit;
?>