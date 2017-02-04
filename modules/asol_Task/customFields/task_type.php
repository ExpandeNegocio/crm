<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$task_type = (isset($_REQUEST['task_type'])) ? $_REQUEST['task_type'] : $focus->task_type;

global /*$beanList, $beanFiles, */$app_list_strings/*, $timedate, $db, $mod_strings*/;

// task_type dropdown
$select_task_type = "<select name='task_type' id='task_type' onChange='onChange_task_type(this);'>";

foreach ($app_list_strings['wfm_task_type_list'] as $key => $value) {
	$select_task_type .= ($task_type == $key) ? "<option value='{$key}' selected> {$value} </option>" : "<option value='{$key}'> {$value} </option>";
}
$select_task_type .= "</select>";
echo $select_task_type;

?>