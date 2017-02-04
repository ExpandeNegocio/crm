<?php

require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

$htmlTarget = $_REQUEST['htmlTarget'];
$returnedHtml = "";
global $mod_strings, $current_language, $timedate; 

$mod_strings = return_module_language($current_language, "asol_Reports");
$defaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";


if ($htmlTarget == 'reportModuleTables') {
	
	$selectedDb = $_REQUEST['selectedDb'];
	$returnedHtml = asol_ReportsManagementFunctions::getReportModuleTablesHtml($selectedDb);
	
} else if ($htmlTarget == 'reportTableFields') {
	
	$selectedDb = $_REQUEST['selectedDb'];
	$selectedModule = $_REQUEST['selectedModule'];
	$auditedReport = (isset($_REQUEST['isAudited'])) ? $_REQUEST['isAudited'] : 0;
	$moduleFields = asol_ReportsManagementFunctions::getFieldsSelectHtml($selectedDb, $selectedModule, $auditedReport);
	
	$returnedHtml = $moduleFields['html'];
	$returnedHtml .= '<script>$("#addFieldsButton").attr("onClick", "'.$moduleFields['javascript'].'");</script>';
	if ($moduleFields['isAudited']) {
		
		$basicAuditInfo = asol_ReportsManagementFunctions::getBasicFieldFilterForAuditedReport($selectedModule);
		
		$returnedHtml .= '<script>$("#auditedReportSpan").css("visibility", "visible");';
		$returnedHtml .= ($auditedReport == 1) ? 'RememberFields("fields_Table", \''.$basicAuditInfo['auditFields'].'\', "'.$timedate->get_cal_date_format().'", "1", "'.$defaultLanguage.'");' : '';
		$returnedHtml .= ($auditedReport == 1) ? 'RememberFilters("filters_Table", \''.$basicAuditInfo['auditFilters'].'\', "'.$timedate->get_cal_date_format().'", "1");' : '';
		$returnedHtml .= '</script>';
		
	} else {
		$returnedHtml .= '<script>$("#auditedReportSpan").css("visibility", "hidden");</script>';
	}

} else if ($htmlTarget == 'reportRelatedTableFields') {
	
	$selectedDb = $_REQUEST['selectedDb'];
	$selectedModule = $_REQUEST['selectedModule'];
	$rhsKey = $_REQUEST['selectedRhsKey'];
	$auditedReport = (isset($_REQUEST['isAudited'])) ? $_REQUEST['isAudited'] : 0;
	$moduleRelatedFields = asol_ReportsManagementFunctions::getRelatedFieldsSelectHtml($selectedDb, $selectedModule, $rhsKey, $auditedReport);
	
	$returnedHtml = $moduleRelatedFields['html'];
	$returnedHtml .= '<script>$("#addRelatedFieldsButton").attr("onClick", "'.$moduleRelatedFields['javascript'].'");</script>';

} else if ($htmlTarget == 'reportPlainTextName') {
	
	$reportRecord = $_REQUEST['record'];
	$returnedHtml = BeanFactory::getBean('asol_Reports', $reportRecord)->name;
	
} else if ($htmlTarget == '') {
	
	$returnedHtml = '';
	
}

echo $returnedHtml;


?>