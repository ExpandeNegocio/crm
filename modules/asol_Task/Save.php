<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

global $timedate, $current_user;

$focus = new asol_Task();

if (isset($_REQUEST['record'])) {
	$focus->id = $_REQUEST['record'];
}
$focus->name = $_REQUEST['name'];
$focus->assigned_user_id = $current_user->id;
$focus->delay_type = $_REQUEST['delay_type'];
$focus->delay = $_REQUEST['time']." - ".$_REQUEST['time_amount'];
$focus->description = $_REQUEST['description'];
$focus->task_order = $_REQUEST['task_order'];
$focus->task_type = $_REQUEST['task_type'];
$focus->task_implementation = $_REQUEST['task_implementation_hidden'];

// SAVE
$recordId = $focus->save();

if ($focus->task_type == "php_custom") {
	wfm_utils::wfm_SavePhpCustomToFile($focus->id, $focus->task_implementation);
}

$return_id = (!empty($_REQUEST['return_id'])) ? $_REQUEST['return_id'] : $recordId;
$return_record = (empty($return_id)) ? $_REQUEST['record'] : $return_id;

$return_action = (empty($_REQUEST['return_action'])) ? 'DetailView' : $_REQUEST['return_action'];
$return_module = (empty($_REQUEST['return_module'])) ? 'asol_Task' : $_REQUEST['return_module'];

header("Location: index.php?action={$return_action}&module={$return_module}&record={$return_record}");

?>