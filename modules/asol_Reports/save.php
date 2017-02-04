<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");
require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

global $db, $timedate, $current_user, $sugar_config;

//**************************//
//***Is Domains Installed***//
//**************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
//**************************//
//***Is Domains Installed***//
//**************************//

$focus = BeanFactory::getBean('asol_Reports', $_REQUEST['record']);

//Si es un nuevo report, no se le pasa el id, si ya existe se le pasa el id para realizar el update del registro

$delete = (!isset($_REQUEST['delete'])) ? false : ($_REQUEST['delete'] == "true") ? true : false;

if (!$delete) {
		
	$focus->name = $_REQUEST['report_name'];
	
	$focus->assigned_user_id = $_REQUEST['assigned_user_id'];
	$focus->report_module = ($_REQUEST['alternative_database'] >= 0) ? $sugar_config["asolReportsAlternativeDbConnections"][$_REQUEST['alternative_database']]["asolReportsDbName"].".".$_REQUEST['alternative_database_table']." (External_Table)" : $_REQUEST['report_module'];
	$focus->audited_report = (!isset($_REQUEST['audited_report'])) ? 0 : ($_REQUEST['audited_report'] == 1) ? 1 : 0;

	$_REQUEST['internal_description'] = trim($_REQUEST['internal_description']); // request == null => empty string
	$_REQUEST['public_description'] = trim($_REQUEST['public_description']); // request == null => empty string
	$descriptionArray = array(
		'internal' => (empty($_REQUEST['internal_description']) ? null : $_REQUEST['internal_description']),
		'public' =>	(empty($_REQUEST['public_description']) ? null : $_REQUEST['public_description']),
	);
	$descriptionSerialized = base64_encode(serialize($descriptionArray));
	$focus->description = $descriptionSerialized;
	
	$focus->alternative_database = $_REQUEST['alternative_database'];
	
	$report_scope_role_array = (isset($_REQUEST['report_scope_role'])) ? $_REQUEST['report_scope_role'] : array();
	$focus->report_scope = ($_REQUEST['report_scope'] == "public") ? $_REQUEST['report_scope'] : $_REQUEST['report_scope'].'${dp}'.implode('${comma}', $report_scope_role_array);
	$focus->report_charts = $_REQUEST['report_charts'];
	$focus->report_charts_engine = $_REQUEST['report_charts_engine'];
	$focus->scheduled_images = (!isset($_REQUEST['scheduled_images'])) ? 0 : ($_REQUEST['scheduled_images'] == 1) ? 1 : 0;
	
	$reportFieldsJson = json_decode(html_entity_decode($_REQUEST['selected_fields']), true);
	$focus->report_fields = base64_encode(serialize($reportFieldsJson));
	
	$reportChartsJson = json_decode(html_entity_decode($_REQUEST['selected_charts']), true);
	$focus->report_charts_detail = base64_encode(serialize($reportChartsJson));
	
	$focus->row_index_display = ($_REQUEST['row_index_display'] == 1) ? 1 : 0;
	$focus->results_limit = $_REQUEST['results_limit'];

	//formateo las fechas de los filtros
	$filtersArray = ($_REQUEST['selected_filters'] == '${v2.2.0}') ? array() : json_decode(html_entity_decode($_REQUEST['selected_filters']), true);
	
	foreach($filtersArray['data'] as &$currentFilter) {
		
		if (in_array($currentFilter['type'], array("date", "datetime", "timestamp")) && !in_array($currentFilter['operator'], array("last", "this", "these", "next", "not last", "not this", "not next"))) {
			
			if (!in_array($currentFilter['operator'], array("equals", "not equals", "before date", "after date", "between", "not between"))) {
				foreach($currentFilter['parameters']['first'] as &$currentParameter) {
					if ((!$timedate->check_matching_format($currentParameter, $GLOBALS['timedate']->dbDayFormat)) && ($currentParameter != "")) {
						$currentParameter = $timedate->swap_formats($currentParameter, $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
					}
				}
			}
			
			if ((count($currentFilter['parameters']['first']) > 0) && (in_array($currentFilter['parameters']['first'][0], array("calendar")))) {
				foreach($currentFilter['parameters']['second'] as &$currentParameter) {
					if ((!$timedate->check_matching_format($currentParameter, $GLOBALS['timedate']->dbDayFormat)) && ($currentParameter != "")) {
						$currentParameter = $timedate->swap_formats($currentParameter, $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
					}
				}

				if (in_array($currentFilter['operator'], array("between", "not between"))) {
					foreach($currentFilter['parameters']['third'] as &$currentParameter) {
						if((!$timedate->check_matching_format($currentParameter, $GLOBALS['timedate']->dbDayFormat)) && ($currentParameter != "")) {
							$currentParameter = $timedate->swap_formats($currentParameter, $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
						}
					}
				}
				
			}
			
		}
	}
	
	$filtersJson = empty($filtersArray) ? '${v2.2.0}' : base64_encode(serialize($filtersArray));
	
	$focus->report_filters = $filtersJson;
	

	$report_type = $_REQUEST['report_type'];
	$report_type_uri = $_REQUEST['report_type_uri'];
	
	if (!empty($report_type_uri)) {
		
		if ($isDomainsInstalled) {
			require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
			$domainIdsToDelete = asol_manageDomains::getDomainPublicationDiff('asol_reports', $focus->id, false);
		}
		
		$domainIdsToDelete = ($report_type !== 'stored') ? null : $domainIdsToDelete;
		$report_type_uri = asol_ReportsManagementFunctions::cleanUpStoredReportFiles($report_type_uri, $domainIdsToDelete);
		
	}
	
	$focus->report_type = ((!empty($report_type_uri)) && ($report_type == 'stored')) ? $report_type.':'.$report_type_uri : $report_type;
	
	$focus->report_scheduled_type = $_REQUEST['report_scheduled_type'].'${dollar}'.$_REQUEST['report_scheduled_type_app'].'${pipe}'.$_REQUEST['report_scheduled_type_url'].'${pipe}'.$_REQUEST['report_scheduled_type_fixed_params'].'${pipe}'.$_REQUEST['report_scheduled_type_params'].'${pipe}'.$_REQUEST['report_scheduled_type_headers'].'${pipe}'.$_REQUEST['report_scheduled_type_quotes'];
	
	$focus->report_attachment_format = $_REQUEST['report_attachment_format'];
	
	//reformatear la fecha de finalizacion de las areas progrmadas al formato de la BDD
	$tasks = ($_REQUEST['selected_tasks'] == '${GMT}') ? array() : explode("|", $_REQUEST['selected_tasks']);
	
	foreach($tasks as $key=>$task){
		
		$values = explode(":", $task);
		
		if((!$timedate->check_matching_format($values[4], $GLOBALS['timedate']->dbDayFormat)) && ($values[4]!=""))
			$values[4] = $timedate->swap_formats($values[4], $timedate->get_date_format(), $GLOBALS['timedate']->dbDayFormat );
		
		$userTZ = $current_user->getPreference("timezone");
		
		$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
		$hourOffset = $phpDateTime->getOffset()*-1;

		$time1 = explode(",", $values[3]);
		$values[3] = date("H,i", @mktime($time1[0],$time1[1],0,date("m"),date("d"),date("Y"))+$hourOffset);
		
		$tasks[$key] = implode(":", $values);
			
	}
	
	$localMachineOffSet = date("Z");
	$focus->report_tasks = (empty($tasks)) ? '${GMT}' : implode("|", $tasks).(($localMachineOffSet/3600));
	$focus->email_list = $_REQUEST['email_list'];
	
} else {
	
	$focus->id = $_REQUEST['record'];
	$focus->deleted = 1;

}


$reportId = $focus->save();


//*************************//
//***Publication Domains***//
//*************************//
if ($isDomainsInstalled) {
	require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
	asol_manageDomains::managePublicationDomainRequest('asol_domain_published_mode', 'asol_domain_child_share_depth', 'asol_multi_create_domain', 'asol_published_domain');
}
//*************************//
//***Publication Domains***//
//*************************//


//Redireccionar a la pantalla 'search.php'
if (isset($_POST['return_module']) && $_POST['return_module'] != "")
	$return_module = $_POST['return_module'];
else 
	$return_module = "asol_Reports";
	
if (isset($_POST['return_action']) && $_POST['return_action'] != "")
	$return_action = $_POST['return_action'];
else 
	$return_action = "index";
	
if (isset($_POST['return_id']) && $_POST['return_id'] != "")
	$return_id = $_POST['return_id'];

asol_ReportsUtils::reports_log('asol', 'Saved record with id of '.$reportId, __FILE__, __METHOD__, __LINE__);

header("Location: index.php?action=".$return_action."&module=".$return_module);

?>