 <?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/asol_Reports/include_basic/reportsUtils.php");


error_reporting(1); //E_ERROR 


function generateCsv($reportName, $headers, $resultset, $headersTotals, $totals, $subTotals, $isDetailedReport, $store, $returnData, $rowIndex=0, $removeHeaders=false, $removeQuotes=false){
	
	global $sugar_config, $mod_strings, $current_language;
	
	$asolDefaultLanguage = (isset($sugar_config["asolReportsDefaultExportedLanguage"])) ? $sugar_config["asolReportsDefaultExportedLanguage"] : "en_us";
	$current_language = (empty($current_language)) ? $asolDefaultLanguage : $current_language;
	$mod_strings = return_module_language($current_language, "asol_Reports");
	
	$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
	$currentDir = getcwd()."/";
	
	$exportCsvDelimiter = (isset($sugar_config["asolReportsCsvDelimiter"])) ? $sugar_config["asolReportsCsvDelimiter"] : ",";
	
	$ExcelFile = "";
	//$idFile = strtolower(str_replace(" ", "_", $reportName))."_".date("Ymd")."T".date("His").".csv";
	$idFile = preg_replace('/[^a-zA-Z0-9]/', '', $reportName)."_".date("Ymd")."T".date("His").".csv";
		
	if (!$removeHeaders) {
		$ExcelFile .= strtoupper($reportName)."\n\n\n\n";
		$ExcelFile .= $mod_strings['LBL_REPORT_RESULTS']."\n\n";
	}
		
	$columns = "";
		
	if (($rowIndex == 1) && !$removeHeaders)
		$columns .= "N".$exportCsvDelimiter;
		
	foreach ($headers as $column)			
		$columns .= $column.$exportCsvDelimiter;

		
	$columns = substr($columns, 0, -1);
		
	$ExcelFile .= $columns;
	
	if (!$removeHeaders)
		$ExcelFile .= "\n\n";
	else 
		$ExcelFile .= "\n";	
	
	if (!$isDetailedReport) {
		
		$cont = 1;
		
		foreach ($resultset as $row){
			
			$rowSet = "";
			
			if ($rowIndex == 1)
				$rowSet .= ($removeQuotes) ? $cont.$exportCsvDelimiter : "\"".$cont."\"".$exportCsvDelimiter;
			
			foreach ($row as $value) {
				$rowSet .= ($removeQuotes) ? eregi_replace("[\n|\r|\n\r]", ' ', $value).$exportCsvDelimiter : "\"".eregi_replace("[\n|\r|\n\r]", ' ', $value)."\"".$exportCsvDelimiter;
			}
			
			$rowSet = substr($rowSet, 0, -1);
			
			$ExcelFile .= $rowSet."\n";
			
			$cont++;
			
		}

		if (!$removeHeaders)
			$ExcelFile .= "\n\n\n";

	} else {
		
		foreach ($resultset as $key=>$subGroup){
			
			if (!$removeHeaders)
				$ExcelFile .= $key."\n";
			
			$cont= 1;
			
			foreach ($subGroup as $row){
				
				$rowSet = "";
				
				if ($rowIndex == 1)
					$rowSet .= ($removeQuotes) ? $cont.$exportCsvDelimiter : "\"".$cont."\"".$exportCsvDelimiter;
				
				foreach ($row as $value){
				
					$rowSet .= ($removeQuotes) ? eregi_replace("[\n|\r|\n\r]", ' ', $value).$exportCsvDelimiter : "\"".eregi_replace("[\n|\r|\n\r]", ' ', $value)."\"".$exportCsvDelimiter;
				
				}
				
				$rowSet = substr($rowSet, 0, -1);
			
				$ExcelFile .= $rowSet."\n";
				
				$cont++;
				
			}
			
			// Subtotals beginning
			if (!empty($subTotals)) {
				if (!$removeHeaders)
					$ExcelFile .= "\n".$key." ".$mod_strings['LBL_REPORT_SUBTOTALS']."\n";
					
				$columnsTotals = "";
			
				foreach ($headersTotals as $columnTotal){
						
					$columnsTotals .= $columnTotal["alias"]."".$exportCsvDelimiter;
						
				}
					
				$columns = substr($columnsTotals, 0, -1);
					
				if (!$removeHeaders) {
					$ExcelFile .= $columnsTotals;
					$ExcelFile .= "\n";
				}
						
				$rowTotals = "";
				
				if (empty($subTotals[$key]))
					$subTotals[$key] = array();
				
				foreach ($subTotals[$key] as $value){
					
					$rowTotals .= ($removeQuotes) ? $value.$exportCsvDelimiter : "\"".$value."\"".$exportCsvDelimiter;
					
				} 
				
				if (!$removeHeaders)
					$ExcelFile .= $rowTotals."\n\n";
					
			}
			// Subtotals end
			
			$ExcelFile .= "\n";
			
		}
		
		if (!$removeHeaders)
			$ExcelFile .= "\n\n";
		
	}
	
	// Totals beginning
	if (!empty($totals)) {
	
		if (!$removeHeaders)
			$ExcelFile .= $mod_strings['LBL_REPORT_TOTALS']."\n\n";
			
		$columnsTotals = "";
			
		foreach ($headersTotals as $columnTotal){
				
			$columnsTotals .= $columnTotal["alias"].$exportCsvDelimiter;
				
		}
			
		$columnsTotals = substr($columnsTotals, 0, -1);
			
		$ExcelFile .= $columnsTotals;
		$ExcelFile .= "\n";
			
		$rowTotals = "";
			
		foreach ($totals as $total){
				
			foreach ($total as $value){
				
				$rowTotals .= ($removeQuotes) ? $value.$exportCsvDelimiter : "\"".$value."\"".$exportCsvDelimiter;
					
			}
				
		}
				
		$rowTotals = substr($rowTotals, 0, -1);
				
		$ExcelFile .= $rowTotals;
		
	}
	// Totals end
		
	$ExcelFile .= "\n";
	
	if (isset($sugar_config["asolReportsExportReplaceByEmptyString"])) {
	
		foreach ($sugar_config["asolReportsExportReplaceByEmptyString"] as $token)
			$ExcelFile = str_replace($token, "", $ExcelFile);
	
	}
	
	$ExcelFile = html_entity_decode($ExcelFile);
	
	 //formateamos el fichero a codificacion que pueda leer CSV

	if (isset($sugar_config["asolReportsCsvCodification"]))
    	$ExcelFile = (iconv("UTF-8", $sugar_config["asolReportsCsvCodification"]."//TRANSLIT//IGNORE", $ExcelFile) === false) ? $ExcelFile : iconv("UTF-8", $sugar_config["asolReportsCsvCodification"]."//TRANSLIT//IGNORE", $ExcelFile);
    	
    if (!$store) {
    	
    	if ($returnData) {
    		
    		return $ExcelFile;
    		
	    } else {
	    	
	    	setcookie("fileDownloadToken", "token"); // blockUI
	    	
		    //The filename is stored in the $produitFilename variable in my script (the only thing you need)
		    header("Cache-Control: private");
		    header('Content-Type: application/csv; utf-8');
		    header("Content-Disposition: attachment; filename=\"$idFile\"");
		    header("Content-Description: File Transfer");
		    header("Content-Length: ".mb_strlen($ExcelFile, '8bit'));
		    header("Expires: 0");
		    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		    header("Pragma: public");
			
		    
			ob_clean();
		    flush();
		    
		    echo $ExcelFile;
		
		    exit;
	    
	    }
		    
    } else {
    	
    	$descriptor = fopen($currentDir.$tmpFilesDir.$idFile, "w");
			
		fwrite($descriptor, $ExcelFile);
		fclose($descriptor);
		//Almacenar el csv y devolver la ruta y nombre del fichero
		return $idFile;
    	
    }
    
}


?>