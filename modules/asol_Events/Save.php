<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $timedate, $current_user;

$focus = new asol_Events();

if (isset($_REQUEST['record'])) {
	$focus->retrieve($_REQUEST['record']);
}
$focus->name = $_REQUEST['name'];
$focus->assigned_user_id = $current_user->id;
$focus->description = $_REQUEST['description'];

// Event Conditions
// Timedate -> Swap Formats
$conditions = wfm_utils::wfm_prepareConditions_fromSugar_toDB($_REQUEST['conditions']);

// Scheduled Tasks
// Timedate -> Swap Formats
$scheduled_tasks = wfm_utils::wfm_prepareTasks_fromSugar_toDB($_REQUEST['scheduled_tasks_hidden']);

// Trigger Type
$focus->trigger_type = $_REQUEST['trigger_type'];

switch ($focus->trigger_type) {
	case 'logic_hook':
		$focus->type = $_REQUEST['type'];
		$focus->trigger_event = $_REQUEST['trigger_event'];
		$focus->conditions = $conditions;
		$focus->scheduled_tasks = "";
		$focus->scheduled_type = "";
		$focus->subprocess_type = "";
		break;
	case 'scheduled':
		$focus->type = "";
		$focus->trigger_event = "";
		$focus->conditions = $conditions;
		$focus->scheduled_tasks = $scheduled_tasks;
		$focus->scheduled_type = $_REQUEST['scheduled_type'];
		$focus->subprocess_type = "";
		break;
	case 'subprocess':
		$focus->type = "";
		$focus->trigger_event = "";
		$focus->scheduled_tasks = "";
		$focus->conditions = "";
		$focus->scheduled_type = "";
		$focus->subprocess_type = $_REQUEST['subprocess_type'];
		break;
}

// SAVE
$recordId = $focus->save();

$return_id = (!empty($_REQUEST['return_id'])) ? $_REQUEST['return_id'] : $recordId;
$return_record = (empty($return_id)) ? $_REQUEST['record'] : $return_id;

$return_action = (empty($_REQUEST['return_action'])) ? 'DetailView' : $_REQUEST['return_action'];
$return_module = (empty($_REQUEST['return_module'])) ? 'asol_Events' : $_REQUEST['return_module'];

header("Location: index.php?action={$return_action}&module={$return_module}&record={$return_record}");

?>