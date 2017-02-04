<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

wfm_utils::wfm_log('debug', 'ENTRY POINT $_REQUEST=['.var_export($_REQUEST, true).']', __FILE__, __METHOD__, __LINE__);

//$process_id = $_REQUEST['process_id']; // Used by export_button.php

// Extract process_ids from $_REQUEST
$process_ids_array = explode(',', $_REQUEST['uid']);

$exported_workflows = wfm_utils::getWorkFlows($process_ids_array);

$serialized_exported_workflows = serialize($exported_workflows);

$datetime = 'D'.date('Ymd').'T'.date('Hi');
$version_WFM = 'WFM v'.wfm_utils::$wfm_release_version.' ';

if (count($process_ids_array) == 1) {
	$filename = "{$exported_workflows['processes'][0]['name']}.{$version_WFM}.{$datetime}.txt";
} else {
	$filename = "{$mod_strings['LBL_EXPORTED_WORKFLOWS_FILENAME']}.{$version_WFM}.{$datetime}.txt";
}

setcookie("fileDownloadToken", "token"); // blockUI
header("Cache-Control: private");
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Content-Description: File Transfer");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".mb_strlen($serialized_exported_workflows, '8bit'));
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: public");

ob_clean();
flush();

echo $serialized_exported_workflows;

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);

exit;

?>