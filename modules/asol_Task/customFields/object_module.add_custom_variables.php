<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $current_user, $mod_strings, $app_strings, $timedate, $app_list_strings, $db;

$trigger_module = $focus->getTriggerModule();

$objectModule = $trigger_module;

// Generate objectModule select

//*********************************//
//***Get External Databases Info***//
//*********************************//
$sel_altDb = $focus->getAlternativeDatabase();

$extraParams = array(
	'alternative_database' => $sel_altDb,
	'report_module' => $objectModule,
);

$externalDatabasesInfo = wfm_reports_utils::managePremiumFeature("externalDatabasesReports", "wfm_reports_utils_premium.php", "wfm_getExternalDatabasesInfo", $extraParams);
wfm_utils::wfm_log('debug', '$externalDatabasesInfo=['.var_export($externalDatabasesInfo, true).']', __FILE__, __METHOD__, __LINE__);

if ($externalDatabasesInfo !== false) {
	$alternativeDb = $externalDatabasesInfo['alternativeDb'];
	$available_alternative_db_tables = $externalDatabasesInfo['available_alternative_db_tables'];
	$sel_altDbTable = $externalDatabasesInfo['sel_altDbTable'];
} else {
	$alternativeDb = null;
	$available_alternative_db_tables = null;
	$sel_altDbTable = null;
}
//*********************************//
//***Get External Databases Info***//
//*********************************//

if ($sel_altDb >= '0') {
	$selectModules .= wfm_utils::wfm_generate_alternativeDBtable_select($available_alternative_db_tables, 'alternative_database_table', $sel_altDbTable, '', 'disabled');
} else {
	$selectModules .= wfm_utils::wfm_generate_field_module_select('objectModule', $objectModule, '', 'disabled');
}
echo $selectModules;

?>