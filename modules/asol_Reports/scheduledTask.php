<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");


error_reporting(1); //E_ERROR 

global $current_language, $db, $sugar_config;


//*************************************//
//********Manage Report Domain*********//
//*************************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
//*************************************//
//********Manage Report Domain*********//
//*************************************//	


$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;
	
//Obtenemos un listado con todos los reports que sean scheduled


if (!isset($_REQUEST['scheduledReports'])) {

	$sqlScheduled = "SELECT * FROM asol_reports WHERE ((report_type LIKE 'scheduled%' AND (report_scheduled_type IS NULL OR report_scheduled_type LIKE 'email%') AND email_list IS NOT NULL AND email_list != '\${pipe}\${pipe}\${pipe}\${pipe}\${pipe}\${pipe}\${pipe}\${pipe}\${pipe}') OR (report_scheduled_type LIKE 'app%') OR (report_type LIKE 'stored%')) AND report_tasks IS NOT NULL AND deleted=0";
	$scheduledReports = asol_Report::getSelectionResults($sqlScheduled, false);


	$currentTimeStamp = time();
	$scheduled_reports = array();

	if (count($scheduledReports) == 0)
		$scheduledReports = array();

	foreach ($scheduledReports as $key=>$scheduledReport) {

		//Quitar etiqueta de GMT
		$taskTimeZoneOffset = 0;
		if (strpos($scheduledReport['report_tasks'], '${GMT}') !== false) {
			$taskArray = explode('${GMT}', $scheduledReport['report_tasks']);
			$scheduledReport['report_tasks'] = $taskArray[0];
			$taskTimeZoneOffset = (isset($taskArray[1]) && (!empty($taskArray[1]))) ? $taskArray[1] : 0;
		}
		
		$currentW = date("w", $currentTimeStamp + ($taskTimeZoneOffset*-3600));
		$currentJ = date("j", $currentTimeStamp + ($taskTimeZoneOffset*-3600));
		$currentH = date("H", $currentTimeStamp + ($taskTimeZoneOffset*-3600));
		$currentI = date("i", $currentTimeStamp + ($taskTimeZoneOffset*-3600));
		$currentDate = date("Y-m-d", $currentTimeStamp + ($taskTimeZoneOffset*-3600));
		
		
		//Check if report has some user_input filter
		$hasUserInputFilter = false;
		$reportFilters = explode('${pipe}', $scheduledReport['report_filters']);

		foreach ($reportFilters as $filter){
				
			$filterValues = explode('${dp}', $filter);
				
			if ($filterValues[11] == 'user_input') {
				$hasUserInputFilter = true;
				break;
			}
				
		}

				
		if (!$hasUserInputFilter) {

			$reportTasks = explode("|", $scheduledReport['report_tasks']);

			foreach ($reportTasks as $task){

				$taskValues = explode(":", $task);
				$hourValue = explode(",", $taskValues[3]);

				$min = $hourValue[1];
				$hour = $hourValue[0];

				if ($taskValues[5] == "active"){

					switch ($taskValues[1]){

						case "weekly":
							$dayWeek = $taskValues[2];
							$dayMonth = "-1";
							break;

						case "monthly":
							$dayWeek = "-1";
							$dayMonth = $taskValues[2];
							break;

						case "daily":
							$dayWeek = "-1";
							$dayMonth = "-1";
							break;
					}

					if (((($currentW == $dayWeek%7) || ($currentJ == $dayMonth) || ($taskValues[1] == "daily")) &&
					($currentH == $hour) && ($currentI == $min)) && ($taskValues[5] == "active") &&
					($currentDate <= $taskValues[4])) {

						if ($isDomainsInstalled) {
				
							require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");
							
							$reportDomainId = $scheduledReport['asol_domain_id'];
							$reportDomainIsPublished = ($scheduledReport['asol_published_domain'] == '1') ? true : false;
		
							$reportDomainPublishedMode = $scheduledReport['asol_domain_published_mode'];
							$reportDomainPublishedLevels = ($scheduledReport['asol_domain_child_share_depth'] === ';;') ? array() : explode(';;', substr($scheduledReport['asol_domain_child_share_depth'], 1, -1));
							$reportDomainPublishedDomains = ($scheduledReport['asol_multi_create_domain'] === ';;') ? array() : explode(';;', substr($scheduledReport['asol_multi_create_domain'], 1, -1)); 
							
							
							if (($reportDomainPublishedMode != '0') && $reportDomainIsPublished) {
								
								$domainPublishingInfo = array(
									'domains' => $reportDomainPublishedDomains,
									'levels' => $reportDomainPublishedLevels,
									'mode' => $reportDomainPublishedMode,
									'mainDomain' => $reportDomainId,
									'isPublished' => $reportDomainIsPublished
								);
								
								foreach (asol_manageDomains::getDomainsPublished($domainPublishingInfo) as $reportPublishedDomain) {
								
									$scheduled_reports[] = array(
										'id' => $scheduledReports[$key]['id'],
										'created_by' => $scheduledReports[$key]['created_by'],
										'report_type' => $scheduledReports[$key]['report_type'],
										'domain_id' => $reportPublishedDomain
									);
									
									asol_ReportsUtils::reports_log('asol', 'Scheduled Report Id: '.$scheduledReports[$key]['id'].' Domain: '.$reportPublishedDomain.' ', __FILE__, __METHOD__, __LINE__);
								
								}
							
							} else {
								
								$scheduled_reports[] = array(
									'id' => $scheduledReports[$key]['id'],
									'created_by' => $scheduledReports[$key]['created_by'],
									'report_type' => $scheduledReports[$key]['report_type'],
									'domain_id' => $reportDomainId
								);
								
								asol_ReportsUtils::reports_log('asol', 'Scheduled Report Id: '.$scheduledReports[$key]['id'].' Domain: '.$reportDomainId.' ', __FILE__, __METHOD__, __LINE__);
								
							}
							
						} else {
						
							$scheduled_reports[] = array(
								'id' => $scheduledReports[$key]['id'],
								'created_by' => $scheduledReports[$key]['created_by'],
								'report_type' => $scheduledReports[$key]['report_type'],
								'domain_id' => null
							);
							
							asol_ReportsUtils::reports_log('asol', 'Scheduled Report Id: '.$scheduledReport['id'], __FILE__, __METHOD__, __LINE__);

						}

						//Se rompe el bucle foreach una vez se haya comprobado que hay que realizar una tarea
						break;

					} //Fin de la condicion de que se cumpla la fecha y hora


				} //Fin de la condicion de que la tarea actual este activa


			}
				
		} else {

			asol_ReportsUtils::reports_log('asol', 'Scheduled Reports with Id ['.$scheduledReport['id'].'] has user_input filters', __FILE__, __METHOD__, __LINE__);

		}

	}

} else {

	$scheduled_reports = unserialize(base64_decode($_REQUEST['scheduledReports']));

}



//********************************//
//****Current Report Execution****//
//********************************//
$currentScheduledReport = $scheduled_reports[0];

$record = $currentScheduledReport['id'];
$currentUserId = $currentScheduledReport['created_by'];

$reportType = explode(':', $currentScheduledReport['report_type']);
$storeReport = ($reportType[0] == 'stored') ? '&storedReport=true' : '';

$contextDomainId = ($isDomainsInstalled) ? '&contextDomainId='.$currentScheduledReport['domain_id'] : '';


$ch = curl_init();
$curlRequestUrl = (isset($sugar_config["asolReportsCurlRequestUrl"])) ? $sugar_config["asolReportsCurlRequestUrl"] : $sugar_config["site_url"];
$requestedUrl = $curlRequestUrl.'/index.php?entryPoint=viewReport&record='.$record.'&language='.$current_language.'&sourceCall=httpReportRequest&currentUserId='.$currentUserId."&schedulerCall=true".$storeReport.$contextDomainId;


curl_setopt($ch, CURLOPT_URL, $requestedUrl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_exec($ch);
curl_close($ch);
//********************************//
//****Current Report Execution****//
//********************************//


//*****************************//
//****Next Report Execution****//
//*****************************//
if (!empty($scheduled_reports[0])) {

	array_shift($scheduled_reports);
	
	$nextRequestedUrl = (isset($sugar_config["asolReportsCurlRequestUrl"])) ? $sugar_config["asolReportsCurlRequestUrl"] : $sugar_config["site_url"];
	$nextRequestedPostParams = 'entryPoint=scheduledTask&module=asol_Reports&scheduledReports='.base64_encode(serialize($scheduled_reports));

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $nextRequestedUrl.'/index.php');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nextRequestedPostParams);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_exec($ch);
	curl_close($ch);
}
//*****************************//
//****Next Report Execution****//
//*****************************//


?>