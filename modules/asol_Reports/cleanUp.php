<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

error_reporting(1); //E_ERROR 

global $sugar_config, $db;


//***********************************//
//*******Reports Admin Config********//
//***********************************//
$sqlCfgAdmin = "SELECT config FROM asol_config WHERE created_by = '1'";
$rsCfgAdmin = asol_Report::getSelectionResults($sqlCfgAdmin, false);
$cfgAdmin = explode("|",$rsCfgAdmin[0]['config']);

$scheduled_files_ttl = (empty($cfgAdmin[5])) ? "7" : $cfgAdmin[5];
$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
$tmpStoredDir = "storedReports/";
//***********************************//
//*******Reports Admin Config********//
//***********************************//


//***********************************//
//******Clean Old Report Files*******//
//***********************************//
$directorio = opendir($tmpFilesDir);
$aWeek = time() - (3600*24*$scheduled_files_ttl);

while ($archivo = readdir($directorio)) {

	if ((filemtime($tmpFilesDir.$archivo) < $aWeek) && ( endsWith(strtolower($archivo), ".xml") || endsWith(strtolower($archivo), ".js") || endsWith(strtolower($archivo), ".html") || endsWith(strtolower($archivo), ".zip") || endsWith(strtolower($archivo), ".pdf") || endsWith(strtolower($archivo), ".png") || endsWith(strtolower($archivo), ".txt") || endsWith(strtolower($archivo), ".csv") ))
		unlink ($tmpFilesDir.$archivo);

}
closedir($directorio);
//***********************************//
//******Clean Old Report Files*******//
//***********************************//


//******************************************//
//******Clean Old Stored Report Files*******//
//******************************************//
$directorio = opendir($tmpFilesDir.$tmpStoredDir);
$aWeek = time() - (3600*24*$scheduled_files_ttl);

while ($archivo = readdir($directorio)) {

	if ((filemtime($tmpFilesDir.$tmpStoredDir.$archivo) < $aWeek) && ( endsWith(strtolower($archivo), ".js") || endsWith(strtolower($archivo), ".txt") ))
		unlink ($tmpFilesDir.$tmpStoredDir.$archivo);

}
closedir($directorio);
//******************************************//
//******Clean Old Stored Report Files*******//
//******************************************//


//***********************************//
//*****Clean DB ReportDispatcher*****//
//***********************************//
$dispatcherTableExists = asol_Report::getSelectionResults("SHOW tables like 'asol_reports_dispatcher'", false);

if(count($dispatcherTableExists) > 0) {
	
	$currentTime = time();
	
	$checkHttpFileTimeout = (isset($sugar_config["asolReportsCheckHttpFileTimeout"])) ? $sugar_config["asolReportsCheckHttpFileTimeout"] : "1000";
	$timedOutStamp = $currentTime - $sugar_config['asolReportsMaxExecutionTime']; //Time to check report execution expiration time
	$closedWindowStamp = $currentTime - ($checkHttpFileTimeout / 500);  //Time to check last recall not updated for manual Reports (browser screen closed). 
	
	$cleanDispatcherTableSql = "DELETE FROM asol_reports_dispatcher WHERE (status IN ('terminated', 'timeout')) OR (request_init_date < ".$timedOutStamp.") OR ((status = 'waiting') AND (request_type = 'manual') AND (last_recall < ".$closedWindowStamp."))";
	$db->query($cleanDispatcherTableSql);
	
}
//***********************************//
//*****Clean DB ReportDispatcher*****//
//***********************************//


function endsWith( $str, $sub ) {
	return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}


?>