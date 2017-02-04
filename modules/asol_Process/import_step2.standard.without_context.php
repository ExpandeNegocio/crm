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

$workflows_exist_process_ids = wfm_utils::getWorkFlowsExist($imported_workflows);
$workflows_exist = (count($workflows_exist_process_ids) > 0);
$in_context_process_id = null;

$import_type = 'clone';
$prefix = '';
$suffix = '_D'.date('Ymd').'T'.date('Hi');
$rename_type = 'wfm_process_only';
$set_status_type = 'set_status_inactive';

$import_email_template_type = 'import';
$if_email_template_already_exists = 'replace'; 

$import_domain_type = 'use_current_user_domain';
$explicit_domain = null;

wfm_utils::importWorkFlows($imported_workflows, $workflows_exist_process_ids, $workflows_exist, $in_context_process_id, $import_type, $prefix, $suffix, $rename_type, $set_status_type, $import_domain_type, $explicit_domain, $import_email_template_type, $if_email_template_already_exists);

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>



