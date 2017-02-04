<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/asol_Reports/tcpdf/config/lang/eng.php');
require_once('modules/asol_Reports/tcpdf/tcpdf.php');
require_once("modules/asol_Reports/include_basic/reportsUtils.php");


error_reporting(1); //E_ERROR  


function generateFile($chartEngine, $reportName, $module, $description, $headers, $resultset, $headersTotals, $totals, $subTotals, $isDetailedReport, $pdf_orientation, $pngs, $legendChart, $isHTML, $store, $pdf_img_scaling_factor, $reportDate, $userTZ, $rowIndex=0, $report_charts, $domainId="") {
	
	//$pdf_img_scaling_factor solo usada para Exports & Emails
	global $sugar_config, $mod_strings, $current_language;
	
	$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
	
	$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;	
	$mod_strings = return_module_language($current_language, "asol_Reports");
	
	$tableClass = ($isHTML) ? 'htmlTable' : 'pdfTable'; 
	
	asol_ReportsUtils::reports_log('asol', 'Entering at ReportPDF', __FILE__, __METHOD__, __LINE__);
		
		
	$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
	$currentDir = getcwd()."/";

	
	$idFile = preg_replace('/[^a-zA-Z0-9]/', '', $reportName)."_".date("Ymd")."T".date("His");
	
	
	asol_ReportsUtils::reports_log('asol', 'Generating PDF: '.$idFile, __FILE__, __METHOD__, __LINE__);
	
	
	//GENERAMOS EL HTML
	$html = '';

	
	//Get the required css
	$cssURL = (is_file("modules/asol_Reports/include_basic/css/".$domainId.".css")) ? "modules/asol_Reports/include_basic/css/".$domainId.".css" : "modules/asol_Reports/include_basic/css/reports.css";
	

	//Get the required company logo
	if (is_file("modules/asol_Domains/logos/".$domainId.".png")) {
		$logoURL = "modules/asol_Domains/logos/".$domainId.".png";
	} else {
		$logoURL = (is_file("custom/themes/default/images/company_logo.png")) ? "custom/themes/default/images/company_logo.png" : "themes/default/images/company_logo.png";
	}
	
	
	//Get CSS file content
	ob_start() ;
	include($cssURL);
	$cssContent = ob_get_contents();
	ob_end_clean();
	$htmlCss = '<style>'.$cssContent.'</style>';
		
	
	if ($isHTML) {
	
		$moduleHeader = (!empty($module)) ? ' - '.$mod_strings['LBL_REPORT_MODULE_HEADER_LABEL'].' '.$module : '';
		
		$logoBase64 = 'data:image/png;base64,'.base64_encode(file_get_contents($logoURL));
		$html .= '<table class="header-title '.$tableClass.'"><tr><td rowspan="3"><img src="'.$logoBase64.'"></td><td>'.$reportName.$moduleHeader.'</td></tr><tr><td>'.$description.'</td></tr><tr><td>'.date("Y-m-d H:i:s", $reportDate).' - '.$userTZ.'</td></tr></table>';
	
	}
	
	$htmlChart = '';
	$pdfChart = Array();
	
	if (count($pngs) > 0) {
	
		$today = dechex(time()).dechex(rand(0,999999));
		
		if ((count($resultset) > 0) && ($report_charts == 'Both'))
			$htmlChart .= '<div style="page-break-after: always;">&nbsp;</div>';
								
		foreach ($pngs as $key=>$png) {

			if ($isHTML)
				$htmlChart .= '<br>';

			switch ($chartEngine) {
				
				case "flash":
				case "html5":
					if ($isHTML) {
						$imgData = (strpos($png, "data:image/png;base64,") !== false) ? $png : "data:image/png;base64,".$png;
					} else {
						$somecontent = base64_decode(str_replace("data:image/png;base64,", "", $png));
						$filename = $key."_".$today.'.png';
						if ($handle = fopen($tmpFilesDir.$filename, 'w+')) {
							if (!fwrite($handle, $somecontent) === FALSE) {
								fclose($handle);
							}
						}
						$pdfChart[] = $imgData = $tmpFilesDir.$filename;
					}
					
					$htmlChart .= '<table class="'.$tableClass.'"><tbody><tr><td><img class="chart-img" src="'.$imgData.'"></td></tr></tbody></table>';
					if (!empty($legendChart))
						$htmlChart .= '<table class="'.$tableClass.'"><tbody><tr><td><div class="legend">'.urldecode($legendChart[$key]).'</div></td></tr></tbody></table>';
					
					break;
				
				case "nvd3":
					if (!$isHTML) {
						if ((isset($sugar_config["asolReportsPhantomJsFilePath"])) && (is_file($sugar_config["asolReportsPhantomJsFilePath"]))) {
							$svgData = '<html><body>'.$htmlCss.str_replace("'", "\"", urldecode($png)).'</body></html>';
							
							if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	    	
								$fileSVGname = $key."_".$today.'.svg.html';
								
								if ($handle = fopen($tmpFilesDir.$fileSVGname, 'w'))
									if (!fwrite($handle, $svgData) === FALSE)
										fclose($handle);
								$svgImgFile = $tmpFilesDir.$fileSVGname;
								
								$somecontent = base64_decode(shell_exec($sugar_config["asolReportsPhantomJsFilePath"].' modules/asol_Reports/include_basic/js/phantomjs/rasterizeBase64.js '.$svgImgFile));
								
								unlink($svgImgFile);
								
							} else {
							    	
								$somecontent = base64_decode(shell_exec($sugar_config["asolReportsPhantomJsFilePath"].' modules/asol_Reports/include_basic/js/phantomjs/renderSVGtags.js \''.$svgData.'\''));
								
							}

							$filename = $key."_".$today.'.png';
							if ($handle = fopen($tmpFilesDir.$filename, 'w'))
								if (!fwrite($handle, $somecontent) === FALSE)
									fclose($handle);
							$pdfChart[] = $imgData = $tmpFilesDir.$filename;
							$htmlChart .= '<table class="'.$tableClass.'"><tbody><tr><td>'.urldecode($legendChart[$key]).'</td></tr><tr><td><img class="chart-img" src="'.$imgData.'"></td></tr></tbody></table>';
						
						} else {

							$htmlChart .= '<table class="'.$tableClass.'"><tbody><tr><td>Download <a href="http://phantomjs.org/">phantomJS</a> to render SVG images with TCPDF</td></tr></tbody></table>';
						
						}
					} else {
						$htmlChart .= '<table class="'.$tableClass.'"><tbody><tr><td>'.urldecode($legendChart[$key]).'</td></tr><tr><td>'.urldecode($png).'</td></tr></tbody></table>';
					}
					
					break;
					
				default:
					break;
				
			}	

			if (($key < (count($pngs)-1)) || ($report_charts == 'Htob'))
				$htmlChart .= '<div style="page-break-after: always;">&nbsp;</div>';
				
		}
		
		
	} 
		
	if (in_array($report_charts, array('Htob', 'Char')))
		$html .= $htmlChart;
		

	if ($report_charts != 'Char') {
		
		$html .= '<table class="'.$tableClass.'"><tbody>';
		$html .= '<tr><td class="header">'.$mod_strings['LBL_REPORT_RESULTS'].'</td></tr></tbody></table>';
		
	} else {
		
		$rowIndex = 0;
		$headers = array();
		$resultset = array();
		
	}

	if (!$isDetailedReport) {

		$html .= '<table class="'.$tableClass.'"><tbody>';
		
		$columns = '<tr>';
		
		if ($rowIndex == 1)		
			$columns .= '<td class="column">N&deg;</td>';
		
		foreach ($headers as $column){	

				$columns .= '<td class="column">'.$column.'</td>';

		}
			
		$columns .= '</tr>';
			
		$html .= $columns;
		
		$cont = 0;
		
		if (count($resultset) == 0)
			$resultset = Array();
		
		foreach ($resultset as $row){
			
			$rowSet = '<tr>';
			
			if ($rowIndex == 1) {
				if ($cont%2 != 0)
					$rowSet .= '<td class="row-uneven">'.($cont + 1).'</td>';
				else
					$rowSet .= '<td class="row-even">'.($cont + 1).'</td>';
			}
						
			foreach ($row as $key=>$value){

				if ($cont%2 != 0)
					$rowSet .= '<td class="row-uneven">'.$value.'</td>';
				else
					$rowSet .= '<td class="row-even">'.$value.'</td>';	
					
			}
			
			$html .= $rowSet.'</tr>';
			
			$cont++;
			
		}
		
		$html .= '</tbody></table><br>';

	} else {
	
		foreach ($resultset as $key=>$subGroup){
			
			$html .= '<table class="'.$tableClass.'"><tbody>';
			
			$html .= '<tr><td class="header-group" colspan="'.(count($headers) + $rowIndex).'">'.strtoupper($key).'</td></tr>';
				
			$columns = '<tr>';
		
			if ($rowIndex == 1)		
				$columns .= '<td class="column">N&deg;</td>';
		
			foreach ($headers as $column){		

				$columns .= '<td class="column">'.$column.'</td>';

			}
				
			$columns .= '</tr>';
				
			$html .= $columns;
			
			$cont=0;
			foreach ($subGroup as $row){
				
				$rowSet = '<tr>';
					
				if ($rowIndex == 1) {
					if ($cont%2 != 0)
						$rowSet .= '<td class="row-uneven">'.($cont + 1).'</td>';
					else
						$rowSet .= '<td class="row-even">'.($cont + 1).'</td>';
				}
					
				foreach ($row as $value){
	
					if ($cont%2 != 0)
						$rowSet .= '<td class="row-uneven">'.$value.'</td>';
					else
						$rowSet .= '<td class="row-even">'.$value.'</td>';	
						
				}
				$html .= $rowSet.'</tr>';
				
				$cont++;
			}
		
			$html .= '</tbody></table>';
			
			// Subtotals beginning
			if (!empty($subTotals)) {
			
				$html .= '<table class="'.$tableClass.'"><tbody>';
			
				$html .= '<tr><td class="header-subtotal" rowspan="2" style="width: 20%;">'.$key.' '.$mod_strings['LBL_REPORT_SUBTOTALS'].'</td>';
				
				$columnsTotals = '';
			
				foreach ($headersTotals as $columnTotal){
					$columnsTotals .= '<td class="column-subtotal" style="width: '.(80/count($headersTotals)).'%">'.$columnTotal["alias"].'</td>';
				}
	
				$html .= $columnsTotals.'</tr>';
				$rowTotals = '<tr>';
				
				if (empty($subTotals[$key]))
					$subTotals[$key] = array();
				
				foreach ($subTotals[$key] as $value){
					$rowTotals .= '<td class="row-subtotal">'.$value.'</td>';
				} 
				
				$html .= $rowTotals.'</tr>';
				
				$html .= '</tbody></table>';
				
			}
			// Subtotals end
			
			$html .= '<br />';
			
		}
		
	}

	// Totals beginning
	if (!empty($totals)) {
		
		$html .= '<br><table class="'.$tableClass.'"><tbody>'; 
		$html .= '<tr><td class="header">'.$mod_strings['LBL_REPORT_TOTALS'].'</td></tr></tbody></table>';
		
		
		$html .= '<table class="'.$tableClass.'"><tbody>';
		$columnsTotals = '<tr>';
			
		foreach ($headersTotals as $columnTotal){
			
			$columnsTotals .= '<td class="column-total">'.$columnTotal["alias"].'</td>';
	
		}
			
		$columnsTotals .= '</tr>';
		
		if (count($totals) > 0)
			$html .= $columnsTotals;
		
		$rowTotals = '<tr>';
			
		foreach ($totals as $total) {
					
			foreach ($total as $value) {
	
				$rowTotals .= '<td class="row-total">'.$value.'</td>';
			
			}
				
		}
				
		$rowTotals .= '</tr>';
				
		$html .= $rowTotals;
		$html .= '</tbody></table>';
	
	}
	// Totals end
		
	if ($report_charts == 'Both')
		$html .= $htmlChart;
	
		
	if ($isHTML) {
		
		$idFile .= ".html";
		
		$html = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"></head><body>".$htmlCss.$html."</body></html>";
		
		$descriptor = fopen($currentDir.$tmpFilesDir.$idFile, "w");
		fwrite($descriptor, $html);
		fclose($descriptor);
		
		if (!$store) {
			
			setcookie("fileDownloadToken", "token"); // blockUI
			
			header("Content-type: application/force-download");
	        header("Content-Disposition: attachment; filename=\"".$idFile."\"");
	        header("Content-Transfer-Encoding: binary");
	        header("Content-Length: ".filesize($tmpFilesDir.$idFile));
	
	        readfile($tmpFilesDir.$idFile); 
		    
	        //Eliminamos ficheros tmp
		    unlink($tmpFilesDir.$idFile);
	        
		} else {
			
			//Almacenar el html y devolver la ruta y nombre del fichero
			return $idFile;
			
		}
		
	} else {
		
		$idFile .= ".pdf"; 
		
		asol_ReportsUtils::reports_log('asol', 'Instantiating and configuring PDF', __FILE__, __METHOD__, __LINE__);
			
		//Define ASOL images base path
		define('ASOL_PATH_IMAGES', $currentDir);
		
		$tcpdf_orientation = ($pdf_orientation == "landscape") ? 'L' : 'P';		
		$pdf = new TCPDF($tcpdf_orientation, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
					
		// set default header data
		$moduleHeader = (!empty($module)) ? ' - '.$mod_strings['LBL_REPORT_MODULE_HEADER_LABEL'].' '.$module : '';
		
		$pdfTitle = $reportName.$moduleHeader;
		$pdfSubtitle = date("Y-m-d H:i:s", $reportDate)." - ".$userTZ;
		$logoImageWidth = 40;
		
		
		$pdf->SetHeaderData($logoURL, $logoImageWidth, $pdfTitle, $pdfSubtitle);
	
		
		if (isset($sugar_config["asolReportsExportPdfFontTTF"])) {
			
			$fontName = $sugar_config["asolReportsExportPdfFontTTF"];
			    
			if (!file_exists('modules/asol_Reports/tcpdf/fonts/'.$fontName.'.php')) {
			
				$pdf->addTTFfont('modules/asol_Reports/tcpdf/fonts/'.$fontName.'.ttf', 'TrueTypeUnicode', '', 32);
		
			}
		    
		} else {
			
			$fontName = 'Helvetica';
		
		}
		
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array($fontName, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array($fontName, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont($fontName);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		
		asol_ReportsUtils::reports_log('asol', 'Loading HTML with PDF', __FILE__, __METHOD__, __LINE__);
			
		
		if (isset($sugar_config["asolReportsExportReplaceByEmptyString"])) {
		
			foreach ($sugar_config["asolReportsExportReplaceByEmptyString"] as $token)
				$html = str_replace($token, "", $html);
		
		}
		
	    $pdf->SetFont($fontName, '', 8, '', true);
	    

	    $pdf->AddPage();

		$pdf->writeHTML($htmlCss.$html, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output($currentDir.$tmpFilesDir.$idFile, 'F');	
		
		foreach ($pdfChart as $key=>$chart){				
			unlink($chart);
		}
		
		return $idFile;
	
	}
	
}

?>