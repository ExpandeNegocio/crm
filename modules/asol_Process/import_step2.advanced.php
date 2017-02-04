<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

$name = $_FILES['imported_workflows']['name'];
$tmpName = $_FILES['imported_workflows']['tmp_name'];

// Save file to temporal folder
$target =  getcwd()."/modules/asol_Process/_temp_Imported_Files/".$name."_".time().".txt";

copy($tmpName,$target);

$descriptor = fopen($target, "r");

$serialized_workflows = fread($descriptor, filesize($target));
wfm_utils::wfm_log('debug', '$serialized_workflows=['.var_export($serialized_workflows, true).']', __FILE__, __METHOD__, __LINE__);

$imported_workflows = unserialize($serialized_workflows);

fclose($descriptor);
unlink($target);

wfm_utils::wfm_log('debug', '$imported_workflows=['.var_export($imported_workflows, true).']', __FILE__, __METHOD__, __LINE__);

$_SESSION['imported_workflows'] = $imported_workflows;

// Check if WorkFlows Exist
$workflows_exist_process_ids = wfm_utils::getWorkFlowsExist($imported_workflows);
$_SESSION['workflows_exist_process_ids'] = $workflows_exist_process_ids;

$workflows_exist = (count($workflows_exist_process_ids) > 0);
if ($workflows_exist) {
	require_once('modules/asol_Process/import_step2.workflows_exist.advanced.php');
} else {
	require_once('modules/asol_Process/import_step2.workflows_not_exist.advanced.php');
}

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>