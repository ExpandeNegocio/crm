<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings, $db, $current_user;

$current_datetime = gmdate('Y-m-d H:i:s');

$process_ids = $_REQUEST['uid'];

$process_ids_string = wfm_utils::convert_recordIds_fromUrl_toDB_format($process_ids);

$db->query("UPDATE asol_process SET status = 'inactive', date_modified = '{$current_datetime}', modified_user_id = '{$current_user->id}' WHERE id IN ({$process_ids_string})");

wfm_utils::wfm_echo('inactivate_workflows', $mod_strings['LBL_INACTIVATE_WORKFLOWS_OK']);

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

?>

