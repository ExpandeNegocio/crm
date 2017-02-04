<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $current_user;

wfm_utils::wfm_log('debug', "\$_REQUEST=[".print_r($_REQUEST,true)."]", __FILE__, __METHOD__, __LINE__);

$focus = new asol_Process();

if (isset($_REQUEST['record'])) {
	$focus->id = $_REQUEST['record'];
}
$focus->name = $_REQUEST['name'];
$focus->assigned_user_id = $current_user->id;
$focus->description = $_REQUEST['description'];

$focus->status = $_REQUEST['status'];
$focus->trigger_module = ($_REQUEST['alternative_database'] >= 0) ? $sugar_config["WFM_AlternativeDbConnections"][$_REQUEST['alternative_database']]["asolReportsDbName"].".".$_REQUEST['alternative_database_table']." (External_Table)" : $_REQUEST['trigger_module'];

$focus->alternative_database = $_REQUEST['alternative_database'];

// SAVE
$recordId = $focus->save();

$return_id = (!empty($_REQUEST['return_id'])) ? $_REQUEST['return_id'] : $recordId; 
$return_record = (empty($return_id)) ? $_REQUEST['record'] : $return_id;

header("Location: index.php?module=asol_Process&action=DetailView&record={$recordId}");

?>