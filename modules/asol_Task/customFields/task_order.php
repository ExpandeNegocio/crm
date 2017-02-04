<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

$task_order = isset($_REQUEST['task_order']) ? $_REQUEST['task_order'] : $focus->task_order;

echo "<input id='task_order' name='task_order' value='{$task_order}' type='text' tabindex='0' title=''  maxlength='2' size='3'>"

?>
