<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

// Get wfm-task bean-object (If I use "$focus = $GLOBALS['FOCUS'];" => I can not access the member-functions of the class)
$focus = new asol_Task();
$focus->retrieve($_REQUEST['record']);

$delay_type = isset($_REQUEST['delay_type']) ? $_REQUEST['delay_type'] : $focus->delay_type;

echo wfm_utils::wfm_generate_field_select('wfm_task_delay_type_list', 'delay_type', $delay_type, '', '');

?>
