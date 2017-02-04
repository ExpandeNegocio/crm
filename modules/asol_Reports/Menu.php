<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $current_user, $mod_strings,$app_strings;

if (ACLController::checkAccess('asol_Reports', 'list', true)) {
	$module_menu[]=Array("index.php?module=asol_Reports&action=index", $mod_strings["LBL_REPORT_REPORTS_ACTION"],"asol_Reports");
}
	
if (ACLController::checkAccess('asol_Reports', 'edit', true)) {
	$module_menu[]=Array("index.php?module=asol_Reports&action=EditView", $mod_strings["LBL_REPORT_CREATE_ACTION"],"Createasol_Reports");
}

$module_menu[]=Array("index.php?module=Administration&action=asolConfig&return_module=asol_Reports&return_action=index", $mod_strings["LBL_REPORT_CONFIG_ACTION"], "asol_Reports");

?>