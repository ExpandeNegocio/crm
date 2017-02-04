<link rel="stylesheet" href="modules/asol_Process/css/flowChart.css">

<?php
global $db;


function drawDiv($id, $module, $name, $top, $left) {
	return '<div class="window" style="top:'.$top.'px; left:'.$left.'px;" id="'.$id.'"><strong><a href="index.php?module='.$module.'&action=DetailView&record='.$id.'">'.$name.'</a></strong><br/><br/></div>';
}

function drawConnection ($source, $target) {
	return 'jsPlumb.connect({source:"'.$source.'", target:"'.$target.'"});';
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
			$connections .= drawConnection($value_process['id'], $event_row['id']);
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
				$connections .= drawConnection($value_event['id'], $activity_row['id']);
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
					$connections .= drawConnection($parent_activity_row['parent_activity_id'], $next_activity_row['id']);
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
				$connections .= drawConnection($value_activity['id'], $task_row['id']);
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
				$connections .= drawConnection($value_activity['id'], $task_row['id']);
				$left = ($left + 100) + 10*strlen($task_row['name']);
			}
		}
	}
}
$GLOBALS['log']->debug("*********************** ASOL: 6 FINAL \$export_array=[".print_r($export_array,true)."]");

// serialize and send

//echo nl2br(var_export($export_array,true));

echo $divs;


?>

<script>
	function generateConnections() {
		<?php echo $connections?>
	}
</script>

<!-- 
<div style="position:relative;margin-top:100px;">

	<div id="demo">
		<div class="window" id="window1"><strong>1</strong><br/><br/></div>
		<div class="window" id="window2"><strong>2</strong><br/><br/></div>
	    <div class="window" id="window3"><strong>3</strong><br/><br/></div>
	    <div class="window" id="window4"><strong>4</strong><br/><br/></div>
	</div>
</div>
 -->

<script>
	function main_jsPlumb() {
		//alert("jsPlumb is now loaded");
		
		//$(document).ready(function() {
			jsPlumb.bind("ready", function() {
				// your jsPlumb related init code goes here

				jsPlumb.importDefaults({
					// default to blue at one end and green at the other
					EndpointStyles : [{ fillStyle:'#225588' }, { fillStyle:'#558822' }],
					// blue endpoints 7 px; green endpoints 11.
					Endpoints : [ [ "Dot", {radius:7} ], [ "Dot", { radius:11 } ]],
					// the overlays to decorate each connection with.
					ConnectionOverlays : [
						[ "Arrow", { location:0.5 } ],
					],
					// 
					Anchors : [ "BottomCenter", "TopCenter" ],
					//
					PaintStyle : { lineWidth:5,	strokeStyle:"#deea18",	joinstyle:"round" },
					//
					HoverPaintStyle :{ lineWidth:7,	strokeStyle:"#2e2aF8" }
					
					
					
				});

				

				generateConnections();	
				

				

			});
		//});
 	}		
</script>

<script>
	function main() {
		//alert("JQuery is now loaded");
		
		var script_tag_jsPlumb = document.createElement("script");
		script_tag_jsPlumb.setAttribute("type","text/javascript");
		script_tag_jsPlumb.setAttribute("src", "modules/asol_Process/___common_WFM/js/jquery.min.jsPlumb.js?version=D20130121T1155");
		script_tag_jsPlumb.onload = main_jsPlumb; //Run main_jsPlumb() once jsPlumb has loaded
 		document.getElementsByTagName("head")[0].appendChild(script_tag_jsPlumb);
 		
		$(document).ready(function() {
			
		});

		$(window).unload(function() {
			jsPlumb.unload();
		});
 	}		
</script>

<script>
	if (typeof jQuery === "undefined") {
		
	    var script_tag = document.createElement("script");
	    script_tag.setAttribute("type","text/javascript");
	    script_tag.setAttribute("src", "modules/asol_Process/___common_WFM/js/jquery.min.js?version=D20130121T1155");
	    script_tag.onload = main; //Run main() once jQuery has loaded
 		document.getElementsByTagName("head")[0].appendChild(script_tag);
 	} else {
 		main();
 	}
</script>

<?php 
$GLOBALS['log']->debug("*********************** ASOL: EXIT flowChart");

exit;
?>