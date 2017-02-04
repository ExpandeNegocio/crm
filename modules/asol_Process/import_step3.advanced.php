<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

$imported_workflows = $_SESSION['imported_workflows'];
$workflows_exist_process_ids = $_SESSION['workflows_exist_process_ids'];
$workflows_exist = (count($workflows_exist_process_ids) > 0);
$in_context_process_id = null;

$import_type = $_REQUEST['import_type'];
$prefix = ($import_type == 'clone') ? $_REQUEST['prefix'] : '';
$prefix = ($rename_type == 'keep_names') ? '' : $prefix;
$suffix = ($import_type == 'clone') ? $_REQUEST['suffix'] : '';
$suffix = ($rename_type == 'keep_names') ? '' : $suffix;
$rename_type = $_REQUEST['rename_type'];
$set_status_type = $_REQUEST['set_status_type'];

$import_email_template_type = $_REQUEST['import_email_template_type'];
$if_email_template_already_exists = $_REQUEST['if_email_template_already_exists'];

$import_domain_type = $_REQUEST['import_domain_type'];
$explicit_domain = $_REQUEST['explicit_domain'];

wfm_utils::importWorkFlows($imported_workflows, $workflows_exist_process_ids, $workflows_exist, $in_context_process_id, $import_type, $prefix, $suffix, $rename_type, $set_status_type, $import_domain_type, $explicit_domain, $import_email_template_type, $if_email_template_already_exists);

wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>