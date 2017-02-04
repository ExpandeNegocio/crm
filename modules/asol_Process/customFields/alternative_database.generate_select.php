<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $current_user, $mod_strings, $app_strings, $timedate, $app_list_strings, $db;

if (!empty($focusId)) { // Modify
	$focus->retrieve($focusId);
	$select_alternative_database_Disabled = 'disabled';
	$alternative_database_select = "<input type='hidden' value='{$focus->alternative_database}' id='alternative_database' name='alternative_database'>";
} else {
	$select_alternative_database_Disabled = '';
	$alternative_database_select = '';
}

//*********************************//
//***Get External Databases Info***//
//*********************************//
$sel_altDb = (isset($_REQUEST['alternative_database'])) ? $_REQUEST['alternative_database'] : $focus->alternative_database;
if ($sel_altDb == '') {
	$sel_altDb = '-1';
}

$extraParams = array(
	'alternative_database' => $sel_altDb,
	'report_module' => $focus->trigger_module,
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

$alternative_database_select .= wfm_utils::wfm_generate_alternativeDB_select($alternativeDb, 'alternative_database', $sel_altDb, 'onChange_alternativeDatabase(this);', $select_alternative_database_Disabled);

?>

