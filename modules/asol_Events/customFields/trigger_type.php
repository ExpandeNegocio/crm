<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

wfm_utils::wfm_log('debug', '$_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

// Get wfm-event bean-object (If I use "$focus = $GLOBALS['FOCUS'];" => I can not access the member-functions of the class)
$focus = new asol_Events();
$focus->retrieve($_REQUEST['record']);

$trigger_type = isset($_REQUEST['trigger_type']) ? $_REQUEST['trigger_type'] : $focus->trigger_type;

echo wfm_utils::wfm_generate_field_select('wfm_trigger_type_list', 'trigger_type', $trigger_type, '', '');

?>
