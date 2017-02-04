<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $current_user;

$focus = new asol_Activity();

if (isset($_REQUEST['record'])) {
	$focus->id = $_REQUEST['record'];
}
$focus->name = $_REQUEST['name'];
$focus->assigned_user_id = $current_user->id;
$focus->delay = $_REQUEST['time']." - ".$_REQUEST['time_amount'];
$focus->description = $_REQUEST['description'];
$focus->type = $_REQUEST['type'];

// Activity Conditions
// Timedate -> Swap Formats
$focus->conditions = wfm_utils::wfm_prepareConditions_fromSugar_toDB($_REQUEST['conditions']);

// SAVE
$recordId = $focus->save();

$return_id = (!empty($_REQUEST['return_id'])) ? $_REQUEST['return_id'] : $recordId; 
$return_record = (empty($return_id)) ? $_REQUEST['record'] : $return_id;

$return_action = (empty($_REQUEST['return_action'])) ? 'DetailView' : $_REQUEST['return_action'];
$return_module = (empty($_REQUEST['return_module'])) ? 'asol_Activity' : $_REQUEST['return_module'];

header("Location: index.php?action={$return_action}&module={$return_module}&record={$return_record}");

?>