<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

error_reporting(1);


global $timedate, $current_user, $db, $mod_strings, $app_strings, $app_list_strings, $beanList, $beanFiles, $sugar_config;

require_once("modules/asol_Reports/include_basic/reportsUtils.php");
require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

if(!ACLController::checkAccess('asol_Reports', 'edit', true))
	die("<font color='red'>".$app_strings["LBL_EMAIL_DELETE_ERROR_DESC"]."</font>"); 


$return_action = (isset($_REQUEST['return_action'])) ? $_REQUEST['return_action'] : ""; //devuelve la accion a ejecutar


$focus = BeanFactory::getBean('asol_Reports', $_REQUEST['record']);
	
$newReportFlag = empty($_REQUEST['record']);

//**********************************//
//******Check GeneratedQueries******//
//**********************************//
if (false) {
	require_once("modules/asol_Reports/include_basic/generateQuery.php");
	$queries = asol_ReportsGenerateQuery::getQuerys($focus->id);
	echo print_r($queries, true);
}
	

//**********************************//
//***Get Config_Override Features***//
//**********************************//
$translateFieldLabels = ((!isset($sugar_config['asolReportsTranslateLabels'])) || ($sugar_config['asolReportsTranslateLabels'])) ? true : false;
$defaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
$mySQLinsecurityScope = (isset($sugar_config["asolReportsMySQLinsecuritySubSelectScope"])) ? $sugar_config["asolReportsMySQLinsecuritySubSelectScope"] : 1;
//**********************************//
//***Get Config_Override Features***//
//**********************************//


//***********************************//
//**Get Module Field Current Values**//
//***********************************//
$rhs_key = "";

$report_name = (isset($_REQUEST['report_name'])) ? $_REQUEST['report_name'] : $focus->name;
$selectedModule = $focus->report_module;

$descriptionArray = unserialize(base64_decode($focus->description));
$internalDescription = $descriptionArray['internal'];
$publicDescription = $descriptionArray['public'];

if (isset($_REQUEST['assigned_user_id']))
	$assigned_user_id = $_REQUEST['assigned_user_id'];
else
	$assigned_user_id = (!empty($focus->assigned_user_id)) ? $focus->assigned_user_id : $current_user->id;

if (isset($_REQUEST['assigned_user_name']))
	$assigned_user_name = $_REQUEST['assigned_user_name'];
else {
	$userNamequery = $db->query("SELECT user_name FROM users WHERE id='".$assigned_user_id."'");
	$userNameRow = $db->fetchByAssoc($userNamequery);
	$assigned_user_name = $userNameRow['user_name'];
}

if (empty($_REQUEST['report_scope_role']))
	$_REQUEST['report_scope_role'] = array();

if (isset($_REQUEST['init_report_scope']))
	$report_scope = $_REQUEST['init_report_scope'];
else if (isset($_REQUEST['report_scope']))
	$report_scope = ($_REQUEST['report_scope'] == "role") ? $_REQUEST['report_scope'].'${dp}'.implode('${comma}', $_REQUEST['report_scope_role']) : $_REQUEST['report_scope'];
else
	$report_scope = (!empty($focus->report_scope)) ? $focus->report_scope : "private" ; //devuelve el ambito del report creado

$reportType = explode(':', $focus->report_type);
$reportScheduledType = explode('${dollar}', $focus->report_scheduled_type);
$report_attachment_format = $focus->report_attachment_format;
$report_charts = $focus->report_charts;
$report_charts_engine = $focus->report_charts_engine;
$scheduled_images = $focus->scheduled_images;

$audited_report = $focus->audited_report;
$sel_autorefresh = 0;

$tmp_results_limit = explode('${dp}', $focus->results_limit);
$results_limit['operator'] = (!empty($focus->results_limit)) ? $tmp_results_limit[0] : "all";	
$results_limit['first_param'] = (isset($tmp_results_limit[1])) ? $tmp_results_limit[1] : "";
$results_limit['second_param'] = (isset($tmp_results_limit[2])) ? $tmp_results_limit[2] : "";
//***********************************//
//**Get Module Field Current Values**//
//***********************************//


//**************************//
//***Is Domains Installed***//
//**************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
//**************************//
//***Is Domains Installed***//
//**************************//


//****************************************//
//***Get Non Visible Fields for Reports***//
//****************************************//
$fieldsToBeRemoved = asol_ReportsManagementFunctions::getNonVisibleFields($focus->report_module, $isDomainsInstalled);
//****************************************//
//***Get Non Visible Fields for Reports***//
//****************************************//


//**************************//
//***Is Domains Installed***//
//**************************//
if ($isDomainsInstalled) {
	
	if ($return_action != "duplicate") {

		$DomainIdNameQuery = $db->query("SELECT asol_reports.asol_domain_id as domain_id, asol_domains.name as domain_name FROM asol_reports LEFT JOIN asol_domains ON asol_reports.asol_domain_id=asol_domains.id WHERE asol_reports.id='".$focus->id."'");
		$DomainIdNameRow = $db->fetchByAssoc($DomainIdNameQuery);

		if ((($current_user->is_admin) && (!empty($current_user->asol_domain_id))) || (!$current_user->is_admin)) {

			if ((in_array($_REQUEST['action'], array("DetailView", "EditView"))) && (isset($_REQUEST['update_domain'])) && ($_REQUEST['update_domain'] != $DomainIdNameRow['domain_id']))
				header("Location: index.php?module=".$_REQUEST['module']."&action=index&update_domain=".$current_user->asol_domain_id);

			if ((in_array($_REQUEST['action'], array("DetailView", "EditView"))) && ($current_user->asol_default_domain != $DomainIdNameRow['domain_id'])) {

				if (!empty($_REQUEST['record'])) {

					if (!isset($_REQUEST['update_domain'])) {

						header("Location: index.php?module=Home&action=changeDomain&domain_id=".$DomainIdNameRow['domain_id']."&domain_name=".$DomainIdNameRow['domain_name']."&return_module=".$_REQUEST['module']."&return_action=".$_REQUEST['action']."&return_record=".$_REQUEST['record']);
							
					} else {
							
						if (!isset($_REQUEST['is_update'])) {

							header("Location: index.php?module=".$_REQUEST['module']."&action=index");

						}

					}

				}
					
			}

		}

	}

}
//**************************//
//***Is Domains Installed***//
//**************************//


//*********************************//
//***Get External Databases Info***//
//*********************************//


//***********************//
//***AlineaSol Premium***//
//***********************//
$focus->alternative_database = (isset($_REQUEST['alternative_database'])) ? $_REQUEST['alternative_database'] : $focus->alternative_database;
$extraParams = array(
	'alternative_database' => $focus->alternative_database,
	'report_module' => $focus->report_module,
);

$externalDatabasesInfo = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalDatabasesInfo", $extraParams);

$alternativeDb = ($externalDatabasesInfo !== false) ? $externalDatabasesInfo['alternativeDb'] : null;
$selectedModule = (($externalDatabasesInfo !== false) && (!empty($externalDatabasesInfo['sel_altDbTable']))) ? $externalDatabasesInfo['sel_altDbTable'] : $selectedModule;
//***********************//
//***AlineaSol Premium***//
//***********************//
				

//*********************************//
//***Get External Databases Info***//
//*********************************//


//***************************//
//***Get External App Info***//
//***************************//
$reportTypeUri = (!empty($reportType[1])) ? $reportType[1] : "";
$reportScheduledTypeUri = (!empty($reportScheduledType[1])) ? $reportScheduledType[1] : "";

//***********************//
//***AlineaSol Premium***//
//***********************//
$extraParams = array(
	'reportScheduledTypeUri' => $reportScheduledTypeUri,
);

$externalApplicationInfo = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalApplicationInfo", $extraParams);

if (!$externalApplicationInfo) {
	
	$externalApps = array();
	$defaultExternalAppParams = '';
	
	$sel_scheduledApp = null;
	$sel_scheduledCustomUrl = null;
	$sel_scheduledCustomFixedParams = null;
	$sel_scheduledCustomParams = null;
	$sel_scheduledHeaders = null;
	$sel_scheduledQuotes = null;

} else {
	
	$externalApps = $externalApplicationInfo['externalApps'];
	$defaultExternalAppParams = $externalApplicationInfo['defaultExternalAppParams'];
	
	$sel_scheduledApp = $externalApplicationInfo['sel_scheduledApp'];
	$sel_scheduledCustomUrl = $externalApplicationInfo['sel_scheduledCustomUrl'];
	$sel_scheduledCustomFixedParams = $externalApplicationInfo['sel_scheduledCustomFixedParams'];
	$sel_scheduledCustomParams = $externalApplicationInfo['sel_scheduledCustomParams'];
	$sel_scheduledHeaders = $externalApplicationInfo['sel_scheduledHeaders'];
	$sel_scheduledQuotes = $externalApplicationInfo['sel_scheduledQuotes'];
	
}
//***********************//
//***AlineaSol Premium***//
//***********************//

//***************************//
//***Get External App Info***//
//***************************//



//***************************//
//***Prepare Report Fields***//
//***************************//
$preparedFieldsArray = asol_ReportsManagementFunctions::prepareReportFields($focus->report_fields);
$focus->report_fields = $preparedFieldsArray['json'];
//***************************//
//***Prepare Report Fields***//
//***************************//


//****************************//
//***Prepare Report Filters***//
//****************************//
$preparedFiltersArray = asol_ReportsManagementFunctions::prepareReportFilters($focus->report_module, $focus->report_filters, $translateFieldLabels, $fieldsToBeRemoved);
$focus->report_filters = $preparedFiltersArray['json'];
$reportFiltersArray= $preparedFiltersArray['array'];
//****************************//
//***Prepare Report Filters***//
//****************************//


//***************************//
//***Prepare Report Charts***//
//***************************//
$focus->report_charts_detail = asol_ReportsManagementFunctions::prepareReportCharts($focus->report_charts_detail);
//***************************//
//***Prepare Report Charts***//
//***************************//


//**************************//
//***Prepare Report Tasks***//
//**************************//
$focus->report_tasks = asol_ReportsManagementFunctions::prepareReportTasks($focus->report_tasks, $return_action);
//**************************//
//***Prepare Report Tasks***//
//**************************//



//*****************************************//
//***Manage Duplicate Action For Reports***//
//*****************************************//
if ($return_action == "duplicate") {
	$focus->id = "";
	
	$report_scope = ($current_user->is_admin) ? "private" : (strpos($report_scope, 'role') !== false) ? str_replace("role", "private", $report_scope) : $report_scope;
	$assigned_user_id = $current_user->id;
	$assigned_user_name = $current_user->user_name;
}
//*****************************************//
//***Manage Duplicate Action For Reports***//
//*****************************************//



//***********************************************************//
//***Get System Users & Roles For Current User Environment***//
//***********************************************************//
$systemUsersAndRoles = asol_ReportsManagementFunctions::getSystemUsersAndRoles($isDomainsInstalled);

$users_opts = $systemUsersAndRoles['users'];
$acl_roles_opts = $systemUsersAndRoles['roles'];
//***********************************************************//
//***Get System Users & Roles For Current User Environment***//
//***********************************************************//



if ($report_scope == 'public') 
	$sel_scope = $report_scope;
else
	$sel_scope = (strpos($report_scope, 'private') !== false) ? 'private' : 'role';
	
	

$focus->report_tasks = str_replace("&#039", "\\&#039", str_replace("'", "\\&#039", str_replace('"', '&quot;', $focus->report_tasks)));
//*******************************//
//***Execute Some Report Fixes***//
//*******************************//


//***********************//
//***AlineaSol Premium***//
//***********************//
$hasPremiumFeatures = asol_ReportsUtils::managePremiumFeature("managePremiumFeature", "reportFunctions.php", "hasPremiumFeatures", null);
//***********************//
//***AlineaSol Premium***//
//***********************//
							

//****************************//
//***Display Edition Screen***//
//****************************//
//Calculate SubSelectQueries Scope
$mySQLcheckInsecurity = false;
if ((($mySQLinsecurityScope === 1) && (!$current_user->is_admin)) || ($mySQLinsecurityScope === 2)) {
	$mySQLcheckInsecurity = true;
} else if (($mySQLinsecurityScope === 3) && (!$current_user->is_admin)) {
	foreach (ACLRole::getUserRoles($current_user->id) as $userRole) {
		if (!in_array($userRole, $sugar_config["asolReportsMySQLinsecuritySubSelectRoles"])) {
			$mySQLcheckInsecurity = true;
			break;
		}
	}
}
//Calculate SubSelectQueries Scope

$PHPcheckInsecurity = ($current_user->is_admin) ? false : true;

//Get predefined color palette schemas for Nvd3 charts
$predefinedColorPaletteSchemas = (isset($sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'])) ? $sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'] : array();
$predefinedColorPaletteSchemasJson = htmlentities(json_encode($predefinedColorPaletteSchemas));
//Get predefined color palette schemas for Nvd3 charts

//Set flag to allow initial execution using default filter values
$initialExecutionFlag = $reportFiltersArray['config']['initialExecution'];
//Set flag to allow initial execution using default filter values

$availablePhpFunctions = (isset($sugar_config['asolReportsExternalApplicationPhpAllowedFunctions'])) ? implode(',', $sugar_config['asolReportsExternalApplicationPhpAllowedFunctions']) : ''; 
	
	
require_once("modules/asol_Reports/include_basic/EditViewHttpSave.php");
//****************************//
//***Display Edition Screen***//
//****************************//

?>