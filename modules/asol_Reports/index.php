<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

global $current_user, $mod_strings, $app_strings, $timedate, $app_list_strings, $db, $sugar_config;


//**************************//
//***Is Domains Installed***//
//**************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
//**************************//
//***Is Domains Installed***//
//**************************//


if(!ACLController::checkAccess('asol_Reports', 'list', true))
	die("<font color='red'>".$app_strings["LBL_EMAIL_DELETE_ERROR_DESC"]."</font>"); 


error_reporting(1); //E_ERROR 

require_once('modules/asol_Reports/include_basic/reportsUtils.php');
require_once('modules/Administration/asolConfigBean.php');


$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
$currentDir = getcwd()."/";


//*************************//
//***Search Form Process***//
//*************************//
$name = $_SESSION['name_basic'] = (isset($_REQUEST['name_basic'])) ? $_REQUEST['name_basic'] : $_SESSION['name_basic'];
$report_database = $_SESSION['database_type_basic'] = (isset($_REQUEST['database_type_basic'])) ? $_REQUEST['database_type_basic'] : $_SESSION['database_type_basic'];
$report_module = $_SESSION['module_type_basic'] = (isset($_REQUEST['module_type_basic'])) ? $_REQUEST['module_type_basic'] : $_SESSION['module_type_basic'];
$report_scope = $_SESSION['scope_basic'] = (isset($_REQUEST['scope_basic'])) ? $_REQUEST['scope_basic'] : $_SESSION['scope_basic'];
$report_type = $_SESSION['type_basic'] = (isset($_REQUEST['type_basic'])) ? $_REQUEST['type_basic'] : $_SESSION['type_basic'];
$assigned_user_id = $_SESSION['assigned_user_id'] = (isset($_REQUEST['assigned_user_id'])) ? $_REQUEST['assigned_user_id'] : $_SESSION['assigned_user_id'];
$assigned_user_name = $_SESSION['assigned_user_name'] = (isset($_REQUEST['assigned_user_name'])) ? $_REQUEST['assigned_user_name'] : $_SESSION['assigned_user_name'];

$field_sort = $_SESSION['field_sort'] = (isset($_REQUEST['field_sort'])) ? $_REQUEST['field_sort'] : $_SESSION['field_sort'];
$sort_direction = $_SESSION['sort_direction'] = (isset($_REQUEST['sort_direction'])) ? $_REQUEST['sort_direction'] : $_SESSION['sort_direction'];


$report_module = ($report_module == "") ? "%%" : $report_module;
$report_database = ($report_database == "") ? "-1" : $report_database;
//*************************//
//***Search Form Process***//
//*************************//


//***********************//
//***AlineaSol Premium***//
//***********************//
$alternativeDb = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "fillExternalDatabasesArray", null);
$alternativeDb = (!$alternativeDb) ? array() : $alternativeDb;
//***********************//
//***AlineaSol Premium***//
//***********************//

	
$return_action = (isset($_REQUEST['return_action'])) ? $_REQUEST['return_action'] : "";
$email_list = (isset($_REQUEST['email_list'])) ? $_REQUEST['email_list'] : "";

$selectedRows = (isset($_REQUEST['selectedRows'])) ? $_REQUEST['selectedRows'] : "";


//Instanciamos nuestra clase Report que extiende de SugarBean
$focus = BeanFactory::newBean('asol_Reports');


//obtenemos las entradas por pagina de la tabla asol_config
$sqlCfg = "SELECT id, config FROM asol_config WHERE created_by = '".$current_user->id."'";
$rsCfg = asol_Report::getSelectionResults($sqlCfg, false);


//Comprobamos si existe una entrada de configuracion para el usuario actvo
//sino existe se crea
$focusCfg = new AsolConfig();

$sqlCfg = "SELECT id, config FROM asol_config WHERE created_by = '".$current_user->id."'";
$rsCfg = asol_Report::getSelectionResults($sqlCfg, false);

if (count($rsCfg) == 0){
	
	$sqlCfgAux = "SELECT config FROM asol_config WHERE created_by = '1'";
	$rsCfgAux = asol_Report::getSelectionResults($sqlCfgAux, false);
	
	$cfgAux = explode("|",$rsCfgAux[0]['config']);
		
	$db->query("INSERT IGNORE INTO `asol_config` (`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`, `config`) VALUES ('".create_guid()."', '".$current_user->name."', '".gmdate("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '".$current_user->id."', '".$current_user->id."', 0, '".$cfgAux[0]."|15|landscape|".$cfgAux[3]."|120|".$cfgAux[5]."')");

	$rsCfg = asol_Report::getSelectionResults($sqlCfg, false);
	
}

$cfg = explode("|",$rsCfg[0]['config']);
$entries_per_page = $cfg[1];


//Obtener los modulo a los que tiene acceso el usuario activo
$sqlModules = "";
$allowedModule = array();

$acl_modules = ACLAction::getUserActions($current_user->id);

foreach($acl_modules as $key=>$mod){

	if($mod['module']['access']['aclaccess'] >= 0){

		if ((isset($sugar_config['asolModulesPermissions']['asolAllowedTables'])) || (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']))) {
			//Restrictive
		
			if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) && 
				 (in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['domains'][$current_user->asol_default_domain])) ) {

				$allowedModule[$key] = false;

			} else if ( (isset($sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance'])) &&
						(in_array($key, $sugar_config['asolModulesPermissions']['asolForbiddenTables']['instance']))) { 

				$allowedModule[$key] = false;
				
			} 
			
			if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) &&
						(in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['domains'][$current_user->asol_default_domain])) ) {
				
				if (!isset($allowedModule[$key]))
					$allowedModule[$key] = true;
							
			} else if ( (isset($sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) &&
						(in_array($key, $sugar_config['asolModulesPermissions']['asolAllowedTables']['instance'])) ) {
				
				if (!isset($allowedModule[$key]))
					$allowedModule[$key] = true;
					
			}			
		
		} else {

			$allowedModule[$key] = true;
			
		}
		
	}

}


foreach ($allowedModule as $key=>$isAllowed) {

	if ($isAllowed) {
	
		$module[$key] = (isset($app_list_strings['moduleList'][$key])) ? $app_list_strings['moduleList'][$key] : $key;
		$sqlModules .= "'".$key."',";
	
	}

}

asort($module);

$sqlModules = substr($sqlModules, 0, -1).",''";


//***********************//
//***AlineaSol Premium***//
//***********************//
$extraParams = array(
	'report_database' => $report_database,
);

$sqlExternalModules = asol_ReportsUtils::managePremiumFeature("externalDatabasesReports", "reportFunctions.php", "getExternalDatabasesExtendedWhereQuery", $extraParams);

$sqlExternalModules = (!$sqlExternalModules) ? " )" : $sqlExternalModules;
//***********************//
//***AlineaSol Premium***//
//***********************//


//Paginado
$sql = "SELECT asol_reports.*, users.user_name";
if ($isDomainsInstalled)
	$sql .= ", asol_domains.name as domain_name";
$sqlFrom = " FROM asol_reports";
$sqlJoin = " LEFT JOIN users ON asol_reports.assigned_user_id=users.id";

//**************************//
//***Is Domains Installed***//
//**************************//
if ($isDomainsInstalled) {
	$sqlJoin .= " LEFT JOIN asol_domains ON asol_reports.asol_domain_id=asol_domains.id";
}
//**************************//
//***Is Domains Installed***//
//**************************//

$sqlWhere = " WHERE asol_reports.deleted = 0 AND asol_reports.name LIKE '%".$name."%' ";

$sqlWhere .= " AND asol_reports.report_module LIKE '".$report_module."'";
//Filtramos los Reports de los modulos al que el user activo no tiene acceso
$sqlWhere .= " AND ((asol_reports.report_module IN (".$sqlModules."))";


$sqlWhere .= $sqlExternalModules;


$sqlWhere .= " AND asol_reports.report_scope LIKE '".$report_scope."%'";
$sqlWhere .= " AND asol_reports.report_type LIKE '".$report_type."%'";

$idsRoles = array();

if (!$current_user->is_admin) {
	
	$queryUserRoles = $db->query("SELECT DISTINCT role_id FROM acl_roles_users WHERE user_id='".$current_user->id."' AND deleted=0");
	while($queryRow = $db->fetchByAssoc($queryUserRoles))
		$idsRoles[] = $queryRow['role_id'];
		
	$sqlWhere .= " AND (asol_reports.report_scope = 'public' OR asol_reports.assigned_user_id = '".$current_user->id."' OR asol_reports.created_by = '".$current_user->id."'";

	$sqlWhereRoles = " OR ((report_scope LIKE 'role%') AND (";
	foreach ($idsRoles as $idRole)
		$sqlWhereRoles .= " report_scope LIKE '%".$idRole."%' OR";
	$sqlWhereRoles = substr($sqlWhereRoles, 0, -2)."))";
	
	if (empty($idsRoles))
		$sqlWhereRoles = "";
		
	$sqlWhere .= $sqlWhereRoles." )";
	
}

//**************************//
//***Is Domains Installed***//
//**************************//
if ($isDomainsInstalled) {

	if ((!$current_user->is_admin) || (($current_user->is_admin) && (!empty($current_user->asol_default_domain)))){
				
		require_once("modules/asol_Domains/asol_Domains.php");
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
		
		$domainsBean = new asol_domains();
		$domainsBean->retrieve($current_user->asol_default_domain);
		
		if ($domainsBean->asol_domain_enabled) {
				
			$sqlWhere .= " AND ( (asol_reports.asol_domain_id='".$current_user->asol_default_domain."')";
			
			if ($current_user->asol_only_my_domain == 0) {
			
				//asol_domain_child_share_depth
				$sqlWhere .= asol_manageDomains::getChildShareDepthQuery('asol_reports.');
				//asol_domain_child_share_depth
				
				//asol_multi_create_domain 
				$sqlWhere .= asol_manageDomains::getMultiCreateQuery('asol_reports.');
				//asol_multi_create_domain 
				
				//***asol_publish_to_all***//
				$sqlWhere .= asol_manageDomains::getPublishToAllQuery('asol_reports.');
				//***asol_publish_to_all***//
						
				//***asol_child_domains***//
				$sqlWhere .= asol_manageDomains::getChildHierarchyQuery('asol_reports.');
				//***asol_child_domains***//

			} else {
			
				$sqlWhere .= ") ";
				
			}
			
		} else {
		
			$sqlWhere .= " AND (1!=1) ";
			
		}
					
	
	}
	
}
//**************************//
//***Is Domains Installed***//
//**************************//


$sqlJoinWhere = " AND users.user_name LIKE '%".$assigned_user_name."%'";

$rs = asol_Report::getSelectionResults("SELECT COUNT(asol_reports.id) AS total FROM asol_reports".$sqlJoin.$sqlWhere.$sqlJoinWhere, false);

$total_entries = $rs[0]['total'];


$page_number = (isset($_REQUEST['page_number'])) ? $_REQUEST['page_number'] : 0;

$sqlOrder = " ORDER BY asol_reports.name ASC";

if (!empty($field_sort)){
	
	$sort_direction = (empty($sort_direction)) ? "ASC" : $sort_direction;
	$sqlOrder = " ORDER BY ".$field_sort." ".$sort_direction." ";
	
}

$sqlLimit = " LIMIT ".$entries_per_page*$page_number.",".$entries_per_page;


$rs = asol_Report::getSelectionResults($sql.$sqlFrom.$sqlJoin.$sqlWhere.$sqlJoinWhere.$sqlOrder.$sqlLimit, false);


$i=0;

$rows = array();
$translatedRows = array();

if (count($rs) > 0) {

	foreach($rs as $value) {
	
		$rows[$i]['id'] = $value['id'];
		$rows[$i]['name'] = $value['name'];
		$rows[$i]['module'] = $value['report_module'];
		
		$auditTable = "";
		if ($value['audited_report'] == '1')
			$auditTable = ' ('.$mod_strings['LBL_REPORT_AUDIT_TABLE'].')';
			
		$translatedRows[$i]['module'] = (isset($app_list_strings['moduleList'][$value['report_module']])) ? $app_list_strings['moduleList'][$value['report_module']].$auditTable : $value['report_module'].$auditTable;
		
		if ((!empty($value['date_modified'])) && ($value['date_modified'] != '0000-00-00 00:00:00')) {
			$value['date_modified'] = $timedate->handle_offset($value['date_modified'], $timedate->get_db_date_time_format());
			$rows[$i]['date_modified'] = $timedate->swap_formats($value['date_modified'], $timedate->get_db_date_time_format(), $timedate->get_date_time_format());
		}
			
		$rows[$i]['assigned_user_id'] = $value['assigned_user_id'];
		$rows[$i]['user_name'] = $value['user_name'];

		
		if ((!empty($value['last_run'])) && ($value['last_run'] != '0000-00-00 00:00:00')) {
			$value['last_run'] = $timedate->handle_offset($value['last_run'], $timedate->get_db_date_time_format());
			$rows[$i]['last_run'] = $timedate->swap_formats($value['last_run'], $timedate->get_db_date_time_format(), $timedate->get_date_time_format());
		}
		
		$rows[$i]['report_scope'] = $value['report_scope'];
		
		if (strpos($value['report_scope'], "public") !== false)
			$translatedRows[$i]['report_scope'] = $mod_strings['LBL_REPORT_PUBLIC'];
		else if (strpos($value['report_scope'], "private") !== false)
			$translatedRows[$i]['report_scope'] = $mod_strings['LBL_REPORT_PRIVATE'];
		else
			$translatedRows[$i]['report_scope'] = $mod_strings['LBL_REPORT_ROLE'];
		
		

		
		$rows[$i]['domain_modifiable'] = ($isDomainsInstalled) ? asol_ReportsManagementFunctions::domainCanModifyReport($value['asol_domain_id']) : true;
		$rows[$i]['user_modifiable'] = asol_ReportsManagementFunctions::userCanModifyReport($value['created_by'], $value['assigned_user_id']);
		$rows[$i]['role_modifiable'] = asol_ReportsManagementFunctions::roleCanModifyReport($idsRoles);
		
		
		$reportType = explode(':', $value['report_type']);
		$rows[$i]['type'] = $reportType[0]; //report_type

		if ($rows[$i]['type'] == "manual") {
			$translatedRows[$i]['type'] = $mod_strings['LBL_REPORT_MANUAL'];
			$rows[$i]['execute'] = true; //Execute Report
			$rows[$i]['external_url'] = ""; //url to execute report
		} else if ($rows[$i]['type'] == "external") {
			$translatedRows[$i]['type'] = $mod_strings['LBL_REPORT_EXTERNAL'];
			$rows[$i]['execute'] = false; //Execute Report
			$rows[$i]['external_url'] = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI']."?entryPoint=viewReport&module=asol_Reports&sourceCall=external&record=".$rows[$i]['id'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?entryPoint=viewReport&module=asol_Reports&sourceCall=external&record=".$rows[$i]['id']; //url to execute report
		} else {
			$translatedRows[$i]['type'] = ($rows[$i]['type'] == "scheduled") ? $mod_strings['LBL_REPORT_SCHEDULED'] : $mod_strings['LBL_REPORT_STORED'];
			$rows[$i]['execute'] = true; //Execute Report
			$rows[$i]['external_url'] = ""; //url to execute report
		}
			

		//Is Domains Installed
		if ($isDomainsInstalled) {
			$rows[$i]['domain_name'] = $value["domain_name"];
		}
		//Is Domains Installed

			
		if (strpos($value['report_tasks'], '${GMT}') !== false) {
			$taskArray = explode('${GMT}', $value['report_tasks']);
			$value['report_tasks'] = $taskArray[0];
		}

		$tasks = explode("|",$value['report_tasks']);
		
		$taskState = "";
		
		$actualDate = gmdate("Y-m-d");
		
		for ($l=0; $l<count($tasks); $l++) {
			
			if (in_array($rows[$i]['type'], array("scheduled", "stored"))){
			
				$currentTasks = explode(":",$tasks[$l]);
				
				if ((($currentTasks[5] == "inactive") || ($currentTasks[4] < $actualDate)) && (($taskState == "I") || ($taskState == ""))) {
					$taskState = "I";
				}	
				
				if ((($currentTasks[5] == "active") || ($currentTasks[4] >= $actualDate)) && (($taskState == "A") || ($taskState == ""))) {
					$taskState = "A";
				}
				
				if ((($currentTasks[5] == "inactive") || ($currentTasks[4] < $actualDate)) && ($taskState == "A")) {
					$taskState = "S";
				}
	
				if ((($currentTasks[5] == "active") && ($currentTasks[4] >= $actualDate)) && ($taskState == "I")) {
					$taskState = "S";
				}
					
			}
				
		}
		
		$rows[$i]['task_state'] = $taskState;

		$i++;
	}

}

//Obtenemos los valores relaciones con el paginado
$data['total_entries'] = $total_entries;
$data['entries_per_page'] = $entries_per_page;
$data['current_entries'] = count($rs);
$data['page_number'] = $page_number;
$data['num_pages'] = (($total_entries % $entries_per_page) != 0) ? floor($total_entries / $entries_per_page) : floor($total_entries / $entries_per_page) -1 ;

//creamos una nueva instancia de smarty
$smarty = new Sugar_Smarty();

//le asignamos los valores necesarios smarty
$smarty->assign('reports_version', str_replace('.', '', asol_ReportsUtils::$reports_version));

//Is Domains Installed
if ($isDomainsInstalled)
	$smarty->assign('is_domains_installed', 1);
else 
	$smarty->assign('is_domains_installed', 0);
//Is Domains Installed

$smarty->assign('available_alternative_db', $alternativeDb);
$smarty->assign('sel_altDb', $report_database);
	
$smarty->assign('available_modules', $module);

$smarty->assign('name', $name);
$smarty->assign('report_module', $report_module);
$smarty->assign('report_scope', $report_scope);
$smarty->assign('report_type', $report_type);
$smarty->assign('assigned_user_id', $assigned_user_id);
$smarty->assign('assigned_user_name', $assigned_user_name);

$smarty->assign('rows', $rows);
$smarty->assign('translatedRows', $translatedRows);
$smarty->assign('data', $data);

//Asignamos los valores para el ordenado
$smarty->assign('field_sort', $field_sort);
$smarty->assign('sort_direction', $sort_direction);


//Asignamos todos los labels de $mod_Srings & $app_strings
$smarty->assign('MOD', $mod_strings);
$smarty->assign('APP', $app_strings);

$smarty->assign('REPORTS_ACL_VIEW', ACLController::checkAccess('asol_Reports', 'view', true));
$smarty->assign('REPORTS_ACL_EDIT', ACLController::checkAccess('asol_Reports', 'edit', true));
$smarty->assign('REPORTS_ACL_DELETE', ACLController::checkAccess('asol_Reports', 'delete', true));
$smarty->assign('REPORTS_ACL_IMPORT', ACLController::checkAccess('asol_Reports', 'import', true));
$smarty->assign('REPORTS_ACL_EXPORT', ACLController::checkAccess('asol_Reports', 'export', true));



//finalmente mostramos la plantilla cn los valores recibidos
$smarty->display('modules/asol_Reports/templates/index.tpl');


if ($return_action == "exportReport"){
	
	$notExportingFields = array('id', 'date_entered', 'date_modified', 'modified_user_id', 'created_by', 'assigned_user_id', 'deleted', 'last_run', 'report_scope',	'asol_domain_id', 'asol_domain_published_mode', 'asol_domain_child_share_depth', 'asol_multi_create_domain', 'asol_published_domain');
	
	if ((empty($selectedRows)) || (count($selectedRows) == 0)) {
		
		//Obtener los datos de cada report y meterlos en exported reports de $k
		$sqlExport = "SELECT * FROM asol_reports WHERE id='".$_REQUEST['record']."'";
		$rsExport = asol_Report::getSelectionResults($sqlExport, false);
		
			
		//creamos un array bidmensional indexado y asociativo con una celda por cada campo del report
		$exportedReport[0]["version"] = "ASOLcrm Reports v ".asol_ReportsUtils::$reports_version;
		
		foreach ($rsExport[0] as $fieldKey=>$fieldValue) {
			if (!in_array($fieldKey, $notExportingFields))
				$exportedReport[0][$fieldKey] = $fieldValue;
		}
				

		$exportName = $rsExport[0]['name'];

	} else {
		
		$l=0;
		
		for ($k=0; $k<count($selectedRows); $k++){
			
			//Obtener los datos de cada report y meterlos en exported reports de $k
			$sqlExport = "SELECT * FROM asol_reports WHERE id='".$selectedRows[$k]."'";
			$rsExport = asol_Report::getSelectionResults($sqlExport, false);
			

			$exportedReport[$l]["version"] = "ASOLcrm Reports v ".asol_ReportsUtils::$reports_version;
		
			foreach ($rsExport[0] as $fieldKey=>$fieldValue) {
				if (!in_array($fieldKey, $notExportingFields))
					$exportedReport[$l][$fieldKey] = $fieldValue;
			}
				
			$l++;
			
		}
		
		if (count($selectedRows) == 1)
			$exportName = $exportedReport[0]["name"];
		else 
			$exportName = "ASOL Report"."_".date("Ymd")."T".date("Hi");
		
	}
	
	
	$serializedFile = serialize($exportedReport);

	setcookie("fileDownloadToken", "token"); // blockUI
	
	header("Cache-Control: private");
	header("Content-Type: application/octet-stream");
	header('Content-Disposition: attachment; filename="'.$exportName.'.txt"');
	header("Content-Description: File Transfer");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".mb_strlen($serializedFile, '8bit'));
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: public");
	 
	ob_clean();
	flush();

	echo $serializedFile;

	exit;


} else if ($return_action == "importReport") {

	require_once("modules/asol_Reports/include_basic/migrationReportsFunctions.php");
	
	$size = $_FILES['importedReport']['size'];// tamano en bytes del archivo recibido
	$type = $_FILES['importedReport']['type'];// tipo mime del archivo, por ejemplo image/gif
	$name = $_FILES['importedReport']['name'];// nombre original del archivo
	$tmpName = $_FILES['importedReport']['tmp_name'];// nombre del archivo temporal


	if ($name != "") {

		//guardamos el archivo a la carpeta files
		$target =  $currentDir.$tmpFilesDir.time()."_".$name;

		copy($_FILES['importedReport']['tmp_name'],$target);

		$descriptor = fopen($target, "r");

		$serializedReport = fread($descriptor, filesize($target));
		$report = unserialize($serializedReport);

		fclose($descriptor);
		unlink($target);

		for ($k=0; $k<count($report); $k++) { 

			
			//Comprobar si existe un report con el mismo nombre para el usuario
			$flag = false;
			foreach ($rows as $row){
				
				if ($report[$k]['name'] == $row[1]){
					$flag = true;
					break;
				}		
				
			}
			$reportModule = $report[$k]['report_module'];
			
			foreach ($report[$k] as $fieldKey=>$fieldValue) {
				if ($fieldKey == 'name') {
					$focus->$fieldKey = (!$flag) ? $fieldValue : $fieldValue."_".date("Ymd")."T".date("Hi");
				} else if ($fieldKey == 'description') {
					 $focus->$fieldKey = asol_ReportsMigrationFunctions::migrateDescriptionToJson($fieldValue);
				} else if ($fieldKey == 'report_fields') {
					$focus->$fieldKey = asol_ReportsMigrationFunctions::migrateFieldsDefinitionToJson($fieldValue, $reportModule);
				} else if ($fieldKey == 'report_filters') {
					$focus->$fieldKey = asol_ReportsMigrationFunctions::migrateFiltersDefinitionToJson($fieldValue, $reportModule);
				} else if ($fieldKey == 'report_charts_detail') {
					$focus->$fieldKey = asol_ReportsMigrationFunctions::migrateChartsDefinitionToJson($fieldValue);
				} else if ($fieldKey == 'report_type') {
					$focus->$fieldKey = asol_ReportsMigrationFunctions::migrateReportTypeToSerialized($fieldValue);
				} else {
					$focus->$fieldKey = $fieldValue;
				}
			}
			
			$focus->id = "";
			$focus->assigned_user_id = $current_user->id;
			$focus->report_scope = "private";


			$focus->save();


		}
		
		header("Location: ./index.php?module=asol_Reports&action=index");

	}

} else if ($return_action == "deleteReport") {
	
	$selectedReportIds = $_REQUEST['selectedRows'];
	$REPORTS_ACL_DELETE = ACLController::checkAccess('asol_Reports', 'delete', true);
	
	
	if (empty($selectedReportIds)) {
		asol_ReportsUtils::reports_log('error', 'No reports were checked', __FILE__, __METHOD__, __LINE__);
		header("Location: ./index.php?module=asol_Reports&action=index");
		exit();
	} else if (!$REPORTS_ACL_DELETE) {
		asol_ReportsUtils::reports_log('error', 'Unauthorized user tried to delete reports', __FILE__, __METHOD__, __LINE__);
		header("Location: ./index.php?module=asol_Reports&action=index");
		exit();
	}
		
	
	asol_ReportsUtils::reports_log('debug', 'Reports checked to delete ['.implode(', ', $selectedReportIds).']', __FILE__, __METHOD__, __LINE__);

	
	// idsRoles
	$idsRoles = array();
	if (!$current_user->is_admin) {
		$queryUserRoles = $db->query("SELECT DISTINCT role_id FROM acl_roles_users WHERE user_id='".$current_user->id."' AND deleted=0");
		while($queryRow = $db->fetchByAssoc($queryUserRoles)) {
			$idsRoles[] = $queryRow['role_id'];
		}
	}

	
	// reports from db
	$selectStatement = 'SELECT * FROM asol_reports WHERE';
	for($i=0; $i<count($selectedReportIds); $i++) {
		if ($i == 0) {
			$selectStatement .= ' id="'.$selectedReportIds[$i].'"';
		} else {
			$selectStatement .= ' OR id="'.$selectedReportIds[$i].'"';
		}
	}
	asol_ReportsUtils::reports_log('debug', 'Obtaning checked reports data ['.$selectStatement.']', __FILE__, __METHOD__, __LINE__);
	$selectedReports = asol_Report::getSelectionResults($selectStatement, false);

	
	if (empty($selectedReports)) {
		asol_ReportsUtils::reports_log('error', 'No deletable reports were found', __FILE__, __METHOD__, __LINE__);
		header("Location: ./index.php?module=asol_Reports&action=index");
		exit();
	}
	
	
	// checkings
	$deletableReportsIds = array();
	foreach($selectedReports as $currentReport) {
		$user_modifiable = asol_ReportsManagementFunctions::userCanModifyReport($currentReport['created_by'], $currentReport['assigned_user_id']);
		$role_modifiable = asol_ReportsManagementFunctions::roleCanModifyReport($idsRoles);
		$domain_modifiable = ($isDomainsInstalled ? asol_ReportsManagementFunctions::domainCanModifyReport($currentReport['asol_domain_id']) : true);

		if (($user_modifiable || $$role_modifiable) && $domain_modifiable && $REPORTS_ACL_DELETE) {
			asol_ReportsUtils::reports_log('debug', 'Report deletable ['.$currentReport['id'].']', __FILE__, __METHOD__, __LINE__);
			$deletableReportsIds[] = $currentReport['id'];
		} else {
			asol_ReportsUtils::reports_log('debug', 'Report undeletable ['.$currentReport['id'].']', __FILE__, __METHOD__, __LINE__);
		}
	}
	
	
	if (empty($deletableReportsIds)) {
				asol_ReportsUtils::reports_log('error', 'Unauthorized to remove all these reports', __FILE__, __METHOD__, __LINE__);
		header("Location: ./index.php?module=asol_Reports&action=index");
		exit();
	}
	
	
	asol_ReportsUtils::reports_log('info', 'Found '.count($deletableReportsIds).' reports to be deleted ['.implode(', ', $deletableReportsIds).']', __FILE__, __METHOD__, __LINE__);
	$deleteStatement = 'UPDATE asol_reports SET deleted=1 WHERE';
	for($i=0; $i<count($deletableReportsIds); $i++) {
		$currentReportId = $deletableReportsIds[$i];
		if ($i == 0) {
			$deleteStatement .= ' id="'.$currentReportId.'"';
		} else {
			$deleteStatement .= ' OR id="'.$currentReportId.'"';
		}
	}
	
	asol_ReportsUtils::reports_log('debug', 'Deleting deletable reports ['.$deleteStatement.']', __FILE__, __METHOD__, __LINE__);
	if ($db->query($deleteStatement)) {
		asol_ReportsUtils::reports_log('info', 'Deleted '.count($deletableReportsIds).' reports from database', __FILE__, __METHOD__, __LINE__);
	} else {
		asol_ReportsUtils::reports_log('error', 'Error deleting '.count($deletableReportsIds).' reports from database', __FILE__, __METHOD__, __LINE__);
	}
		
	header("Location: ./index.php?module=asol_Reports&action=index");
	
}
	
?>