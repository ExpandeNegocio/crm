<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

// Extract process_ids from $_REQUEST
$process_ids_array = explode(',', $_REQUEST['uid']);

wfm_utils::deleteWorkFlows($process_ids_array);

wfm_utils::wfm_echo('delete_workflows', $mod_strings['LBL_DELETE_WORKFLOWS_OK']);

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

?>

