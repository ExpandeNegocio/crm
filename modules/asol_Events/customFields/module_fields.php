<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

$bean_module = $trigger_module;

$multiple = 'multiple';
$show_idRelationships = true;

require_once('modules/asol_Process/___common_WFM/php/module_fields.fields_relatedFields.common.php');

?>