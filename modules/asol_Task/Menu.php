<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings, $app_strings;

$module_menu[]=Array("index.php?module=asol_Process&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_PROCESSES"],"asol_Process");
$module_menu[]=Array("index.php?module=asol_Process&action=EditView", $mod_strings["LBL_ASOL_CREATE_ASOL_PROCESS"],"Createasol_Process");
$module_menu[]=Array("index.php?module=asol_Events&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_EVENTS"],"asol_Events");
//$module_menu[]=Array("index.php?module=asol_Events&action=EditView", $mod_strings["LBL_ASOL_CREATE_ASOL_EVENT"],"Createasol_Events");
$module_menu[]=Array("index.php?module=asol_Activity&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_ACTIVITIES"],"asol_Activity");
//$module_menu[]=Array("index.php?module=asol_Activity&action=EditView", $mod_strings["LBL_ASOL_CREATE_ASOL_ACTIVITY"],"Createasol_Activity");
$module_menu[]=Array("index.php?module=asol_Task&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_TASKS"],"asol_Task");
//$module_menu[]=Array("index.php?module=asol_Task&action=EditView", $mod_strings["LBL_ASOL_CREATE_ASOL_TASK"],"Createasol_Task");

if(ACLController::checkAccess('EmailTemplates', 'list', true)) $module_menu[]=Array("index.php?module=EmailTemplates&action=index", translate('LNK_EMAIL_TEMPLATE_LIST', 'EmailTemplates'),"EmailTemplates");
if(wfm_notification_emails_utils::isNotificationEmailsInstalled()) $module_menu[]=Array("index.php?module=asol_NotificationEmails&action=index", translate('LNK_LIST', 'asol_NotificationEmails'),"asol_NotificationEmails");

$module_menu[]=Array("index.php?module=asol_WorkingNodes&action=index", $mod_strings["LBL_ASOL_ALINEASOL_WFM_MONITOR"],"asol_WorkingNodes");

// Login Audit
$extraParams = Array(
	'module_menu' => $module_menu,
);
$addLoginAuditToModuleMenu = wfm_reports_utils::managePremiumFeature("addLoginAuditToModuleMenu", "wfm_utils_premium.php", "addLoginAuditToModuleMenu", $extraParams);
if ($addLoginAuditToModuleMenu !== false) {
	$module_menu = $addLoginAuditToModuleMenu;
}

?>