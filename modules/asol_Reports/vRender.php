<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");
require_once("modules/asol_Reports/include_basic/generateReportsFunctions.php");

global $current_user, $mod_strings, $current_language, $timedate, $app_list_strings, $sugar_config, $db;

$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
	
$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;	
$mod_strings = return_module_language($current_language, "asol_Reports");


asol_ReportsUtils::reports_log('debug', 'Entering at vRender.php', __FILE__, __METHOD__, __LINE__);

require_once("include/SugarPHPMailer.php");
require_once('modules/asol_Reports/include_basic/ReportExcel.php');
require_once('modules/asol_Reports/include_basic/ReportFile.php');
require_once('modules/asol_Reports/include_basic/ReportChart.php');
require_once('modules/Users/User.php');


//*************************************//
//********Manage Report Domain*********//
//*************************************//
$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
$isDomainsInstalled = ($domainsQuery->num_rows > 0);
			

$return_action = $_REQUEST['return_action'];


$exportFolder = "modules/asol_Reports/tmpReportFiles/";
$currentDir = getcwd()."/";

$exportedReportFile = (isset($_REQUEST['exportedReportFile'])) ? $_REQUEST['exportedReportFile'] : "";


if ($exportedReportFile != "") { //Es un export normal
	
	$fileName = $exportFolder.$exportedReportFile;
	$exportFile = fopen($fileName, "r");
	$serializedReport = fread($exportFile, filesize($fileName));
	$report = unserialize($serializedReport);
	fclose($exportFile);
	
	asol_ReportsUtils::reports_log('asol', 'Txt File Readed: Report name-> '.$report["reportName"], __FILE__, __METHOD__, __LINE__);
	
	//Volcamos el contenido del report exportado en variables
	$report_name = $report["reportName"];
	$report_module = $report["module"];
	$descriptionArray = unserialize(base64_decode($report["description"]));
	$description = $descriptionArray['public'];
	$isDetailedReport = $report["isDetailedReport"];
	
	$reportScheduledType = $report["reportScheduledType"];
	
	$hasDisplayedCharts = $report["hasDisplayedCharts"];
	$pdf_orientation = $report["pdf_orientation"];
	$pdf_img_scaling_factor = $report["pdf_img_scaling_factor"];
	
	//Only if AlineaSolDomains installed
	$reportDomainId = (isset($report["asol_domain_id"])) ? $report["asol_domain_id"] : null;
	//Only if AlineaSolDomains installed
	
	$report_charts = $report["report_charts"];
	$report_charts_engine = $report["report_charts_engine"];
	$report_attachment_format = $report["report_attachment_format"];
	$row_index_display = $report["row_index_display"];

	$email_list = $report["email_list"];
	
	$created_by = $report["created_by"];
	
	$columns = $report["headers"];
	$totals = $report["headersTotals"];
	$rsTotals = $report["totals"];
	
	$rs = $report["resultset"];
	$subGroups = $report["resultset"];
	
	$subTotals = $report["subTotals"];
	
	
	$reportDate = filectime($fileName);
		
	$theUser = BeanFactory::getBean('Users', $report["current_user_id"]);
	$gmtZone = $theUser->getUserDateTimePreferences();
	$userTZ = $theUser->getPreference("timezone")." ".$gmtZone["userGmt"];
	
	//Only if AlineaSolDomains installed
	$contextDomainId = $report["context_domain_id"];
	//Only if AlineaSolDomains installed
	
}

if ($return_action == "ExportCsv") {
	
	
	if (!$isDetailedReport){

		$rsExport = $rs;
		$subTotalsExport = "";

	} else {

		$rsExport = $subGroups;
		$subTotalsExport = $subTotals;

	}
	
	$filePath = generateCsv($report_name ,$columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, true, false, $row_index_display);

	echo $filePath;

	
} else if ($return_action == "ExportHtml") {

	if (!$isDetailedReport){
		$rsExport = $rs;
		$subTotalsExport = "";
	} else {
		$rsExport = $subGroups;
		$subTotalsExport = $subTotals;
	}
	
	$pngSrcs = Array();
	$legends = Array();
	
	if ($hasDisplayedCharts) {

		if (in_array($report_charts, array("Char", "Both", "Htob"))) {
			
			//Generamos las imagenes
			$pngSrcs = explode("%pngSeparator", $_REQUEST['pngs']);
			$legends = explode("%legendSeparator", $_REQUEST['legends']);
			
		}
			
	}

	if ($report_charts == "Char") {

		$rsExport = Array();
		$rsTotals = Array();
		
	}
	
	$filePath = generateFile($report_charts_engine, $report_name , $report_module, $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, $pngSrcs, $legends, true, true, 100, $reportDate, $userTZ, $row_index_display, $report_charts, $contextDomainId);

	echo $filePath;
	
	
} else if ($return_action == "ExportPdf") {

	if (!$isDetailedReport){
		$rsExport = $rs;
		$subTotalsExport = "";
	} else {
		$rsExport = $subGroups;
		$subTotalsExport = $subTotals;
	}
	
	$pngSrcs = Array();
	$legends = Array();
		
	if ($hasDisplayedCharts){

		if (in_array($report_charts, array("Char", "Both", "Htob"))) {
		
			//Generamos las imagenes
			$pngs = explode("%pngSeparator", rawurldecode($_REQUEST['pngs']));
			foreach ($pngs as $key=>$png) {
				$pngSrcs[$key] = $png;
			}
			$legends = explode("%legendSeparator", $_REQUEST['legends']);
			
		} 

	}
	
	if ($report_charts == "Char") {

		$columns = Array();
		$rsExport = Array();
		$rsTotals = Array();
		
	}
	
	asol_ReportsUtils::reports_log('asol', 'Before generateFile mem_use:'.memory_get_usage().' Bytes', __FILE__, __METHOD__, __LINE__);
		
	//Enviar el html a convertir en PDF desde el template y generarlo aqui con DOMPDF
	$filePath = generateFile($report_charts_engine, $report_name , $report_module, $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, $pngSrcs, $legends, false, true, $pdf_img_scaling_factor, $reportDate, $userTZ, $row_index_display, $report_charts, $contextDomainId);

	asol_ReportsUtils::reports_log('asol', 'After generateFile: '.$filePath.' - mem_use:'.memory_get_usage().' Bytes', __FILE__, __METHOD__, __LINE__);
	asol_ReportsUtils::reports_log('asol', 'Memory Peak Usage: '.memory_get_peak_usage().' Bytes', __FILE__, __METHOD__, __LINE__);
		
	echo $filePath;
	
} else if ($return_action == "ManualTasks") {
	
	//Generar array con emails a enviar Report
	$mail = new SugarPHPMailer();

	//************************//
	//****Get Email Arrays****//
	//************************//
	$emailReportInfo = asol_ReportsGenerationFunctions::getEmailInfo($email_list);

	$emailFrom = $emailReportInfo['emailFrom'];
	$emailArrays = $emailReportInfo['emailArrays'];
	
	$users_to = $emailArrays['users_to'];
	$users_cc = $emailArrays['users_cc'];
	$users_bcc = $emailArrays['users_bcc'];
	$roles_to = $emailArrays['roles_to'];
	$roles_cc = $emailArrays['roles_cc'];
	$roles_bcc = $emailArrays['roles_bcc'];
	$emails_to = $emailArrays['emails_to'];
	$emails_cc = $emailArrays['emails_cc'];
	$emails_bcc = $emailArrays['emails_bcc'];
	
	$mail->setMailerForSystem();

	$user = new User();

	//created by
	$mail_config = $user->getEmailInfo($created_by);

	if (!empty($emailFrom))
		$mail->From = $emailFrom;
	else
		$mail->From = (isset($sugar_config["asolReportsEmailsFrom"])) ? $sugar_config["asolReportsEmailsFrom"] : $mail_config['email'];
	
	$mail->FromName = (isset($sugar_config["asolReportsEmailsFromName"])) ? $sugar_config["asolReportsEmailsFromName"] : $mail_config['name'];	

	//Timeout del envio de correo

	$mail->Timeout=30;
	$mail->CharSet = "UTF-8";

	
	asol_ReportsGenerationFunctions::setSendEmailAddresses($mail, $emailArrays, $contextDomainId);
	
	
	//Datos del email en si
	if ($isDomainsInstalled) {						
		$mail->Subject = "[".BeanFactory::getBean('asol_Domains', $contextDomainId)->name."] ".$mod_strings['LBL_REPORT_REPORTS_ACTION'].": ".$report_name;
	} else {
		$mail->Subject = $mod_strings['LBL_REPORT_REPORTS_ACTION'].": ".$report_name;
	}


	$mail->Body = "<b>".$mod_strings['LBL_REPORT_NAME'].": </b>".$report_name."<br>";
	$mail->Body .= "<b>".$mod_strings['LBL_REPORT_MODULE'].": </b>".$report_module."<br>";
	$mail->Body .= "<b>".$mod_strings['LBL_REPORT_DESCRIPTION'].": </b>".$description;

	//Mensaje en caso de que el destinatario no admita emails en formato html
	$mail->AltBody = $mod_strings['LBL_REPORT_NAME'].": ".$report_name."\n";
	$mail->AltBody .= $mod_strings['LBL_REPORT_MODULE'].": ".$report_module."\n";
	$mail->AltBody .= $mod_strings['LBL_REPORT_DESCRIPTION'].": ".$description;

	$pngSrcs = Array();
	$legends = Array();

	if (!$hasDisplayedCharts){

		$rsExport = $rs;
		$subTotalsExport = "";

	} else {

		$rsExport = $subGroups;
		$subTotalsExport = $subTotals;

		if ($report_attachment_format != "CSV") {

			if (in_array($report_charts, array("Char", "Both", "Htob"))) {
			
				//Generamos las imagenes
				$pngs = explode("%pngSeparator", $_REQUEST['pngs']);
				foreach ($pngs as $key=>$png) {
					$pngSrcs[$key] = $png;
				}
				$legends = explode("%legendSeparator", $_REQUEST['legends']);

			}

		}

	}

	switch ($report_attachment_format){

		case "HTML":
			if ($report_charts == "Char") {
		
				$columns = Array();
				$rsExport = Array();
				$rsTotals = Array();
				
			}	
			$adjunto = generateFile($report_charts_engine, $report_name , $report_module, $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, $pngs, $legends, true, true, 100, $reportDate, $userTZ, $row_index_display, $report_charts, $contextDomainId);
			break;

		case "PDF":
			if ($report_charts == "Char") {
		
				$columns = Array();
				$rsExport = Array();
				$rsTotals = Array();
				
			}
			$adjunto = generateFile($report_charts_engine, $report_name , $report_module, $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, $pngSrcs, $legends, false, true, $pdf_img_scaling_factor, $reportDate, $userTZ, $row_index_display, $report_charts, $contextDomainId);
			break;

		case "CSV":
			$adjunto = generateCsv($report_name ,$columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, true, false, $row_index_display);
			break;

	}

	//Añadimos el Report como fichero adjunto del e-mail
	$mail->AddAttachment($currentDir.$exportFolder.$adjunto, $adjunto);

	//Exito sera true si el email se envio satisfactoriamente, false en caso comtrario
	$success = $mail->Send();


	$tries=1;
	while ((!$success) && ($tries < 5)) {

		sleep(5);
		$success = $mail->Send();
		$tries++;

	}

	unlink($currentDir.$exportFolder.$adjunto);

	echo "EmailsSent";

} else if ($return_action == "SendToApp") {

	if (!$isDetailedReport){

		$rsExport = $rs;
		$subTotalsExport = "";

	} else {

		$rsExport = $subGroups;
		$subTotalsExport = $subTotals;

	}

	
	//***********************//
	//***AlineaSol Premium***//
	//***********************//
	$extraParams = array(
		'reportScheduledType' => $reportScheduledType,
		'cvsData' => array(
			'reportName' => $report_data['report_name'],
			'resultset' => $rsExport,
			'subtotals' => $subTotalsExport,
			'isDetailed' => $isDetailedReport,
			'rowIndexDisplay' => $report_data['row_index_display']
		)
	);
	
	asol_ReportsUtils::managePremiumFeature("externalApplicationReports", "reportFunctions.php", "sendReportToExternalApplication", $extraParams);
	//***********************//
	//***AlineaSol Premium***//
	//***********************//
	
	
	echo "CSV_Sent";
	
}



?>