<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings,$app_strings;

$module_menu[]=Array("index.php?module=asol_ProcessInstances&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_PROCESSINSTANCES"],"asol_ProcessInstances");
$module_menu[]=Array("index.php?module=asol_WorkingNodes&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_WORKINGNODES"],"asol_WorkingNodes");
$module_menu[]=Array("index.php?module=asol_OnHold&action=index", $mod_strings["LBL_ASOL_VIEW_ASOL_ONHOLD"],"asol_OnHold");
$module_menu[]=Array("index.php?module=asol_Process&action=index", $mod_strings["LBL_ASOL_ALINEASOL_WFM"],"asol_Process");

?>