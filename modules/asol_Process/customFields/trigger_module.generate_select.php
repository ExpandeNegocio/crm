<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

// Generate trigger_module select
$selectModules = "";

if (!empty($focusId)) { // Modify
	$trigger_module = $focus->trigger_module;
	$selectModules_Disabled = 'disabled';
	if ($sel_altDb >= '0') {
		$name = 'alternative_database_table';
		$value = $sel_altDbTable;
	} else  {
		$name = 'trigger_module';
		$value = $trigger_module;
	}
	$selectModules .= "<input type='hidden' value='{$value}' id='{$name}' name='{$name}'>";
} else { // Create
	$selectModules_Disabled = '';
}

if ($sel_altDb >= '0') {
	$selectModules .= wfm_utils::wfm_generate_alternativeDBtable_select($available_alternative_db_tables, 'alternative_database_table', $sel_altDbTable, '', $selectModules_Disabled);
} else {
	$selectModules .= wfm_utils::wfm_generate_field_module_select('trigger_module', $trigger_module, '', $selectModules_Disabled);
}

?>

