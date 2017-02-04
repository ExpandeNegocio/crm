<?php 

require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

$displayNoDataMsg = (($noDataReport) && ((empty($filtersPanel)) || ((!empty($filtersPanel)) && (!empty($searchCriteria)))));
$columnsCount = ($report_data['row_index_display'] == '1') ? count($columns)+1 : count($columns);


$detailViewHttpFile = '';

	
if ($isDashlet) {
	
	$detailViewHttpFile .= '<style>
		#loadingGIF'.$dashletId.', #loadingTEXT'.$dashletId.' {
			display: none;
		}
	</style>';
	
}

if ($availableReport) {


	if (!$isDashlet) {

		$detailViewHttpFile .=

			'<div id="moduleTitle" class="moduleTitle">
				<h2>'.$report_name.'</h2>
			</div>
			<div class="clear"></div>	
			
		';
		
		$detailViewHttpFile .= getReportDetailButtons($report_data['record'], $report_data['asol_domain_id'], $report_data['created_by'], $report_data['assigned_user_id'], $report_data['report_scope'], $hasDisplayedCharts, $report_charts_engine, $urlChart, $html5Chart, $nvd3Chart, $report_data['report_attachment_format'], $sendEmailquestion, $hasExternalApp, $filtersHiddenInputs, $searchCriteria, $isDashlet, $dashletId, $externalCall, $getLibraries, $scheduledEmailHideButtons, $displayNoDataMsg);
		
	}
			
	if (!$isDashlet) {
	
		$detailViewHttpFile .= '<form id="display_form" name="display_form" method="post" action="index.php">
		
			<input type="hidden" value="asol_Reports" name="module">
			<input type="hidden" value="EditView" name="action">
			<input type="hidden" value="" name="return_module">
			<input type="hidden" value="" name="return_action">
			<input type="hidden" value="'.$report_data['record'].'" name="record">
			<input type="hidden" value="'.$report_data['report_scope'].'" name="init_report_scope">
			<input type="hidden" value="'.$data['page_number'].'" name="page_number">
			
			<input type="hidden" value="'.(($isDashlet) ? "true": "false").'" name="dashlet">
			
			<input type="hidden" value="'.$report_data['field_sort'].'" name="field_sort">
			<input type="hidden" value="'.$report_data['sort_direction'].'" name="sort_direction">
		
			<input type="hidden" value="" name="pngs">
			<input type="hidden" value="" name="legends">
			<input type="hidden" value="'.implode(",", $chartSubGroupsValues).'" id="chartSubGroupsValues">
		
			<input type="hidden" id="display_external_filters" name="external_filters" value="'.str_replace(' ', '${nbsp}', $external_filters).'">
			<input type="hidden" id="display_search_criteria" name="search_criteria" value="'.$searchCriteria.'">
		
		</form>
		
		<form id="export_form" name="export_form" method="post" action="index.php?entryPoint=reportPopup" target="ExportWindow">
		
			<input type="hidden" value="'.$report_data['record'].'" name="record">
			<input type="hidden" value="" name="return_action">
			<input type="hidden" value="" name="pngs">
			<input type="hidden" value="" name="legends">
			<input type="hidden" value="asol_Reports" name="module">
			<input type="hidden" value="'.$exportedReportFile.'" name="exportedReportFile">
		
		</form>';
	
	} else {
	
		$detailViewHttpFile .= '<input type="hidden" value="'.$data['page_number'].'" id="page_number_'.$dashletId.'" name="page_number_'.$dashletId.'">';
		$detailViewHttpFile .= '<input type="hidden" value="'.implode(",", $chartSubGroupsValues).'" id="chartSubGroupsValues">';
		
	}
	
	
	$detailViewHttpFile .= '

	<div id="reportDiv" class="alineasol_reports">
	
	<table id="reportTable" style="width: 100%">
	
		<tbody>';

		if ((!empty($publicDescription)) && (!$isDashlet)) {
			
			$detailViewHttpFile .= '

			<tr>
				<td>
					<div id="reportInfoDivWrapper" class="detail view">
						'.getReportHeaderInfo($isDashlet, $externalCall, $mod_strings['LBL_REPORT_DESCRIPTION'], null, "reportInfoDiv").'
						<div id="reportInfoDiv">
							<table id="resultTable">
								<tbody>
									<tr>
										<td>'.$publicDescription.'</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</td>
			</tr>';
			
		}
	
	$detailViewHttpFile .= '
		<tr>
			<td>';
			
			$detailViewHttpFile .= getReportDetailSearchCriteria($report_data['record'], $filtersPanel, $filtersHiddenInputs, $external_filters, $searchCriteria, $currentUserId, $isDashlet, $dashletId);
			
				
			if (($filtersHiddenInputs == false) || ($searchCriteria == true)) {
				
				$detailViewHttpFileCharts = '';
					
						if (count($urlChart) > 0) {
							
							$detailViewHttpFileCharts .= '<div id="chartsContent">';
							
							switch ($report_charts_engine) {
								
								case "flash":

									foreach ($urlChart as $key=>$value) {					
												
										$detailViewHttpFileCharts .=
										'<div class="asolChartContainer">
											<div id="ASOLflash_'.str_replace("-", "", $report_data['record']).'_'.$key.'"> 
			   								
			   									<strong>'.$mod_strings['LBL_REPORT_FLASH_WARNING'].'</strong>   
			   									<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Descargar Adobe Flash Player" /></a>        
										
											</div>
										</div>'; 
	
									} 
									break;
									
								case "html5":
									
									$detailViewHttpFileCharts .= "<input type='hidden' id='showHideChartButton' value='true'>";
									foreach ($html5Chart as $key=>$html5) {
										
										$detailViewHttpFileCharts .=
											'<div class="asolChartContainer" id="ASOLhtml5_'.str_replace("-", "", $report_data['record']).'_'.$key.'" style="width: '.$html5['dimensions']['width'].';">'.$html5['html'].'</div>';
										
									}
									break;
									
								case "nvd3":
									
									foreach ($nvd3Chart as $key=>$nvd3) {
													
										$detailViewHttpFileCharts .=
											'<div class="asolChartContainer" style="height: '.($nvd3['dimensions']['height']+30).'px; width: '.$nvd3['dimensions']['width'].';" id="ASOLnvd3_'.str_replace("-", "", $report_data['record']).'_'.$key.'">
												'.$nvd3['html'].'
												<svg xmlns="http://www.w3.org/2000/svg" id="ASOLsvg_'.str_replace("-", "", $report_data['record']).'_'.$key.'" style="height: '.$nvd3['dimensions']['height'].'px; width: '.$nvd3['dimensions']['width'].';"></svg>
											</div>';
										
									}
									break;
									
								default:
									break;
									
							}
							
							$detailViewHttpFileCharts .= '</div>';
							
						}
				
				 $detailViewHttpFile .=
					'<div>';
					
				 	if (!$displayNoDataMsg) {
	
				 		if ($report_data['report_charts'] == "Htob")
				 			$detailViewHttpFile .= $detailViewHttpFileCharts;
				 	
				 	}
				 
					if (in_array($report_data['report_charts'], array("Both", "Htob", "Tabl"))) {
					
						$detailViewHttpFile .=
						'<div id="resultDivWrapper" class="detail view">';
						
						if (!$isDashlet) {

							if ($displayNoDataMsg) {

								if ($reportedError != null) {
									
									$reportHeaderMessage = $mod_strings['LBL_REPORT_MYSQL_ERROR'];
									$reportHeaderInfo = '<span style="color:red">'.$reportedError.'</span>';
									$collapsableHeaderId = null;
									
								} else {
									
									$reportHeaderMessage = $mod_strings['LBL_REPORT_NO_RESULTS'];
									$reportHeaderInfo = null;
									$collapsableHeaderId = null;
								
								}
								
							} else {
								
								$reportHeaderMessage = $mod_strings['LBL_REPORT_RESULTS'];
								$reportHeaderInfo = null;
								$collapsableHeaderId = 'resultDiv';
								
							}
							
							
							$detailViewHttpFile .= getReportHeaderInfo($isDashlet, $externalCall, $reportHeaderMessage, $reportHeaderInfo, $collapsableHeaderId);
							
															
						}
						
						
						if (!$displayNoDataMsg) {
						
							$detailViewHttpFile .= '<div id="resultDiv">';
				
							if (!$hasNoPagination)
								$detailViewHttpFile .= getReportDetailPagination($report_data['record'], $externalCall, $getLibraries, $isDashlet, $dashletId, $data['num_pages'], $data['num_pages_label'], $data['page_number'], $data['page_number_label'], $data['total_entries'], $report_data['field_sort'], $sortDirection);

							$columnsDataTypes = array();
							foreach ($resulset_fields as $currentField) {
								$currentType = $currentField['type'];
								$parenthesesPosition = strpos($currentType, '(');
								if ($parenthesesPosition != false) {
									$currentType = substr($currentType, 0, $parenthesesPosition);
								}
								$columnsDataTypes[$currentField['alias']] = $currentType;							
							}
							
							if ($isDetailedReport == false) {
					
								$detailViewHttpFile .=
								'<table id="resultTable" class="list view">
									<tbody>
										<tr>';
								
									if ($report_data['row_index_display'] == '1') {
										$dataType = 'index';
										$cellClasses = ($isDashlet ? '' : 'data_header data_cell report_header report_cell data_header_'.$dataType.' data_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);

										$detailViewHttpFile .= '<th class="'.$cellClasses.'">N&deg;</th>';
									}
									
										
								foreach($columns as $columnKey=>$column) {

									$dataType = $columnsDataTypes[$column];
									$cellClasses = ($isDashlet ? '' : 'data_header data_cell report_header report_cell data_header_'.$dataType.' data_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);
									
									$detailViewHttpFile .= '<th class="'.$cellClasses.'">';
									
						    			if (($columnsO[$columnKey] != "") && (!$externalCall)) {
						    				
						    				if ($report_data['field_sort'] !== $columnsO[$columnKey])
						    					$sortDirection = "ASC";
						    				else if ($report_data['sort_direction'] == 'ASC')
						    					$sortDirection = "ASC";
						    				else
						    					$sortDirection = "DESC";
						    				
						    				$initSortDirection = "document.display_form.sort_direction.value = '".$sortDirection."';";
						    				
						    				if (($report_data['field_sort'] == $columnsO[$columnKey]) && ($report_data['sort_direction'] == 'ASC')) {
						    					$sortingImg = "themes/default/images/arrow_down.gif";
						    				} else if (($report_data['field_sort'] == $columnsO[$columnKey]) && ($report_data['sort_direction'] == 'DESC')) { 
						    					$sortingImg = "themes/default/images/arrow_up.gif";
						    				} else { 
						    					$sortingImg = "themes/default/images/arrow.gif";
						    				}
						    					
						    				if (!$isDashlet) {
							    				$detailViewHttpFile .= '<a class="listViewThLinkS1" OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" onclick="'.$initSortDirection.'document.display_form.field_sort.value=\''.htmlentities($columnsO[$columnKey]).'\'; document.display_form.action.value=\'DetailView\'; document.display_form.return_action.value=\'\'; document.display_form.submit();">'.$column.'</a>';
						    				} else {
							    				$detailViewHttpFile .= '<a class="listViewThLinkS1" OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" onclick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'(\''.$data['page_number'].'\', \''.htmlentities($columnsO[$columnKey]).'\', \''.$sortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">'.$column.'</a>';
						    				}
							    			$detailViewHttpFile .= '&nbsp;<img height="10" border="0" align="absmiddle" width="8" src="'.$sortingImg.'">';
						    			
						    			} else {
						    				$detailViewHttpFile .= $column;
						    			}
						    		$detailViewHttpFile .= '</th>';
			
								}

								$detailViewHttpFile .=
								'</tr>';
								
								foreach ($reportFields as $fieldKey=>$field) {
								
									$rowClass = ((($fieldKey + 1) % 2) == 0) ? 'evenListRowS1' : 'oddListRowS1';
									
									$detailViewHttpFile .=
							    	'<tr class="'.$rowClass.'">';
							    		
										if ($report_data['row_index_display'] == '1') {
											$dataType = 'index';
											$cellClasses = ($isDashlet ? '' : 'data_value data_cell report_value report_cell data_value_'.$dataType.' data_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);

											$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.($data['page_number']*$data['entries_per_page']+$fieldKey+1).'</td>';
										}
										
										foreach ($field as $key3=>$item3) {
											$dataType = $columnsDataTypes[$key3];
											$cellClasses = ($isDashlet ? '' : 'data_value data_cell report_value report_cell data_value_'.$dataType.' data_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);
											
		  									$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.$item3.'</td>';
										} 
										
									$detailViewHttpFile .= 
									'</tr>';
			
								}
								
								$detailViewHttpFile .= 
									'</tbody>
								</table>';
								
							} else {

								foreach ($reportFields as $key=>$item) {
								
									$detailViewHttpFile .=
									'<div class="list view">
									<h4><em>'.$key.'</em></h4>
									<table>
										<tbody>
											<tr>';
									
										if ($report_data['row_index_display'] == '1') {
											$dataType = 'index';
											$cellClasses = ($isDashlet ? '' : 'data_header data_cell report_header report_cell data_header_'.$dataType.' data_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);
										
											$detailViewHttpFile .= '<th class="'.$cellClasses.'">N&deg;</th>';
										}
									
										foreach ($columns as $columnKey=>$column) {
											$dataType = $columnsDataTypes[$column];
											$cellClasses = ($isDashlet ? '' : 'data_header data_cell report_header report_cell data_header_'.$dataType.' data_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);

											$detailViewHttpFile .=
						    				'<th class="'.$cellClasses.'">';
											
						    					if (($columnsO[$columnKey] != "") && (!$externalCall)) {

						    						if ($report_data['field_sort'] !== $columnsO[$columnKey])
								    					$sortDirection = "ASC";
								    				else if ($report_data['sort_direction'] == 'ASC')
								    					$sortDirection = "ASC";
								    				else
								    					$sortDirection = "DESC";
								    					
						    						$initSortDirection = "document.display_form.sort_direction.value = '".$sortDirection."';";
						    				
						    						if (($report_data['field_sort'] == $columnsO[$columnKey]) && ($report_data['sort_direction'] == 'ASC'))
						    							$sortingImg = "themes/default/images/arrow_down.gif";
						    						else if (($report_data['field_sort'] == $columnsO[$columnKey]) && ($report_data['sort_direction'] == 'DESC'))
						    							$sortingImg = "themes/default/images/arrow_up.gif";
						    						else
						    							$sortingImg = "themes/default/images/arrow.gif";
						    					
						    						if (!$isDashlet)
						    							$detailViewHttpFile .= '<a class="listViewThLinkS1" OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" onclick="'.$initSortDirection.' document.display_form.field_sort.value=\''.htmlentities($columnsO[$columnKey]).'\'; document.display_form.action.value=\'DetailView\';document.display_form.return_action.value=\'\'; document.display_form.submit()">'.$column.'</a>';
						    						else
							    						$detailViewHttpFile .= '<a class="listViewThLinkS1" OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" onclick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'(\''.$data['page_number'].'\', \''.htmlentities($columnsO[$columnKey]).'\', \''.$sortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">'.$column.'</a>';
						    						
						    						$detailViewHttpFile .= '&nbsp;<img height="10" border="0" align="absmiddle" width="8" src="'.$sortingImg.'">';
						    					} else {
						    						$detailViewHttpFile .= $column;
						    					}
						    				$detailViewHttpFile .=
						    				'</th>';
			
										}
			  						
									$detailViewHttpFile .=
			  						'</tr>';
			  						
									foreach ($item as $key2=>$item2) {
			  						
										$rowClass = ((($key2 + 1) % 2) == 0) ? 'evenListRowS1' : 'oddListRowS1';
										
										$detailViewHttpFile .=
			  							'<tr class="'.$rowClass.'">';
										
											if ($report_data['row_index_display'] == '1') {
												$dataType = 'index';
												$cellClasses = ($isDashlet ? '' : 'data_value data_cell report_value report_cell data_value_'.$dataType.' data_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);
										
												$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.($key2+1).'</td>';
											}
										
			  								foreach ($item2 as $key3=>$item3) {
			  									$dataType = $columnsDataTypes[$key3];
												$cellClasses = ($isDashlet ? '' : 'data_value data_cell report_value report_cell data_value_'.$dataType.' data_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);

			  									$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.$item3.'</td>';
		  									}
	
			  							$detailViewHttpFile .=
			  							'</tr>';
			  						
			  						}
			  						
			  						// Subtotals beginning
			  						if ($displaySubtotals) {
				  						$detailViewHttpFile .=
				  						'<tr><td colspan='.$columnsCount.'>
				  						
				  						<table class="view" border=1>
				  						
				  						<tr>
				  						<td rowspan=2 style="width:20%"><center><h3><em>'.$key.' '.$mod_strings['LBL_REPORT_SUBTOTALS'].'</em></h3></center></td>';
				  						
										foreach ($subTotals[$key] as $key4=>$item4) {
		  									$dataType = $columnsDataTypes[$key4];
											$cellClasses = ($isDashlet ? '' : 'subtotal_header subtotal_cell report_header report_cell subtotal_header_'.$dataType.' subtotal_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);

											$detailViewHttpFile .= '<th class="'.$cellClasses.'">'.$key4.'</th>';
										}
	
										$detailViewHttpFile .= 
										'</tr>
				
										<tr>';
										foreach ($subTotals[$key] as $key5=>$item5) {
		  									$dataType = $columnsDataTypes[$key5];
											$cellClasses = ($isDashlet ? '' : 'subtotal_value subtotal_cell report_value report_cell subtotal_value_'.$dataType.' subtotal_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);

											$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.$item5.'</td>';
										}
										
										$detailViewHttpFile .= '</tr>
										</table></td></tr>';
			  						}
									// Subtotals end
									
									$detailViewHttpFile .= 
									'</tbody>
									</table>';
									
									$detailViewHttpFile .= '</div>';
									
								}

								
							}
		
							if (!$hasNoPagination)
								$detailViewHttpFile .= getReportDetailPagination($report_data['record'], $externalCall, $getLibraries, $isDashlet, $dashletId, $data['num_pages'], $data['num_pages_label'], $data['page_number'], $data['page_number_label'], $data['total_entries'], $report_data['field_sort'], $sortDirection);
	
							// Totals beginning
							if ($displayTotals) {
								if (!$isDashlet) {
									
									$detailViewHttpFile .= '
									<div class="list view">
									<h4>'.$mod_strings['LBL_REPORT_TOTALS'].'</h4>
									<table id="totalTable">';
									
								} else {
									$detailViewHttpFile .= '
									<div>
									<table id="totalTable" class="list view">';
								}
						
								
								$detailViewHttpFile .=
									'<tbody>
										
										<tr>';
										
											foreach ($totals as $totalColumn) {
												$dataType = $columnsDataTypes[$totalColumn['alias']];
												$cellClasses = ($isDashlet ? '' : 'total_header total_cell report_header report_cell total_header_'.$dataType.' total_cell_'.$dataType.' report_header_'.$dataType.' report_cell_'.$dataType);

								    			$detailViewHttpFile .= '<th class="'.$cellClasses.'">'.$totalColumn['alias'].'</th>';
											}
		
								    	$detailViewHttpFile .=
										'</tr>';
										
								    	foreach ($rsTotals as $total) {
				
								    		$detailViewHttpFile .=
								    		'<tr>';
								    		
								    			foreach ($total as $key=>$value) {
								    				$dataType = $columnsDataTypes[$key];
													$cellClasses = ($isDashlet ? '' : 'total_value total_cell report_value report_cell total_value_'.$dataType.' total_cell_'.$dataType.' report_value_'.$dataType.' report_cell_'.$dataType);

													$detailViewHttpFile .= '<td class="'.$cellClasses.'">'.$value.'</td>';
								    			}
					
											$detailViewHttpFile .=
											'</tr>';
					
								    	}
								    	
							$detailViewHttpFile .=				
									'</tbody>
								</table>
								</div>';
						}
						// Totals end
						
				    	$detailViewHttpFile .=				
							'</div>
						</div>';
						
					}
					
				} else if ($displayNoDataMsg) {

					if ($reportedError != null) {
						
						$reportHeaderMessage = $mod_strings['LBL_REPORT_MYSQL_ERROR'];
						$reportHeaderInfo = '<span style="color:red">'.$reportedError.'</span>';
						
					} else {
						
						$reportHeaderMessage = $mod_strings['LBL_REPORT_NO_RESULTS'];
						$reportHeaderInfo = null;

					}
					

					$detailViewHttpFile .= getReportHeaderInfo($isDashlet, $externalCall, $reportHeaderMessage, $reportHeaderInfo);
							
					
				}

	
				if (!$displayNoDataMsg) {
	
					if (in_array($report_data['report_charts'], array("Both", "Char")))
					 	$detailViewHttpFile .= $detailViewHttpFileCharts;
				
				}
					
					
				$detailViewHttpFile .= '</div>';
					
			}
			
		
			$detailViewHttpFile .= getReportDetailButtons($report_data['record'], $report_data['asol_domain_id'], $report_data['created_by'], $report_data['assigned_user_id'], $report_data['report_scope'], $hasDisplayedCharts, $report_charts_engine, $urlChart, $html5Chart, $nvd3Chart, $report_data['report_attachment_format'], $sendEmailquestion, $hasExternalApp, $filtersHiddenInputs, $searchCriteria, $isDashlet, $dashletId, $externalCall, $getLibraries, $scheduledEmailHideButtons, $displayNoDataMsg);
				
				
			$detailViewHttpFile .= 
			'</td>
		</tr>
		</tbody>
	</table>';
	
	
	$detailViewHttpFile .= 
		'</div>';
	
		
	if ((isset($justDisplay)) && ($justDisplay)) {
	
		if ($returnHtml) {
			return $detailViewHttpFile;
		} else {
			echo $detailViewHttpFile;
		}
		
	} else {
		
		$exportHttpFile = fopen($tmpFilesDir.$httpHtmlFile, "w");
		fwrite($exportHttpFile, $detailViewHttpFile);
		fclose($exportHttpFile);
		
		if ($returnHtml)
			return false;
		
	}

} else {

	$detailViewHttpFile .=
	'<div class="detail view">
		'.getReportHeaderInfo($isDashlet, $externalCall, $mod_strings['LBL_REPORT_NOT_AVAILABLE'], null, null).'
	</div>';
	
	if ($returnHtml) {
		return $detailViewHttpFile;
	} else {
		echo $detailViewHttpFile;
	}
	
}

function getReportDetailButtons($reportId, $reportDomainId, $created_by, $assigned_user_id, $report_scope, $hasDisplayedCharts, $report_charts_engine, $urlChart, $html5Chart, $nvd3Chart, $report_attachment_format, $sendEmailquestion, $hasExternalApp, $filtersHiddenInputs, $searchCriteria, $isDashlet, $dashletId, $externalCall, $getLibraries, $scheduledEmailHideButtons, $displayNoDataMsg) {
	
	global $current_user, $sugar_config, $db, $mod_strings;
	
	$returnedHTML = "";
	
	if ((!$isDashlet) && (!$externalCall) && (!isset($scheduledEmailHideButtons))) {
			
		if (!$filtersHiddenInputs)
			$returnedHTML .= '<input id="reportbutton_refresh" type="button" title="'.$mod_strings['LBL_REPORT_REFRESH'].'" class="button" onclick="document.display_form.action.value=\'DetailView\';document.display_form.return_action.value=\'refresh\'; document.display_form.field_sort.value=\'\';document.display_form.sort_direction.value=\'\'; document.display_form.submit()" name="button" value="'.$mod_strings['LBL_REPORT_REFRESH'].'">';

	}
	
	
	if ($filtersHiddenInputs && (!$externalCall) && (!isset($scheduledEmailHideButtons)))  {
		
		if (!$isDashlet) {
		
			$returnedHTML .= '<input type="submit" value="'.asol_ReportsUtils::translateReportsLabel('LBL_REPORT_EXECUTE').'" onClick="$(\'#external_filters\').val(formatExternalFilters(\'\')); document.getElementById(\'criteria_form\').submit();">';
		
		} else {
			
			$returnedHTML .= '<input type="button" value="'.asol_ReportsUtils::translateReportsLabel('LBL_REPORT_EXECUTE').'" onClick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'(0, \'\', \'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">';
			
		}
		
	}
		
		
	if ((!$isDashlet) && (!$externalCall)) {
		
		//**************************//
		//***Is Domains Installed***//
		//**************************//
		$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$isDomainsInstalled = ($domainsQuery->num_rows > 0);
		//**************************//
		//***Is Domains Installed***//
		//**************************//

		$domainReportModifiable = ($isDomainsInstalled) ? asol_ReportsManagementFunctions::domainCanModifyReport($reportDomainId) : true;
		$userReportModifiable = asol_ReportsManagementFunctions::userCanModifyReport($created_by, $assigned_user_id);
		$roleReportModifiable = asol_ReportsManagementFunctions::roleCanModifyReport();
		

		if ((($roleReportModifiable) || ($userReportModifiable)) && ($domainReportModifiable) && (ACLController::checkAccess('asol_Reports', 'edit', true)) && (!isset($scheduledEmailHideButtons)))
			$returnedHTML .= '<input id="reportbutton_edit" type="button" title="'.$mod_strings['LBL_REPORT_EDIT'].'" class="button" onclick="document.display_form.action.value=\'EditView\'; document.display_form.return_action.value=\'\'; document.display_form.submit()" name="button" value="'.$mod_strings['LBL_REPORT_EDIT'].'">';
		
		if ((($filtersHiddenInputs == false) || ($searchCriteria == true)) && (!$displayNoDataMsg)) {
			
			$returnedHTML .= '
			<script>
			function generateChartsPng() {
				var chartArray = new Array();';
	
			switch ($report_charts_engine) {
				
				case "flash":
					foreach ($urlChart as $key=>$value)
						$returnedHTML .= '
						var flashObject = document.getElementById(\'ASOLflash_'.str_replace("-", "", $reportId).'_'.$key.'\');
						chartArray['.$key.'] = flashObject.getEncodedPNG();';
					break;
					
				case "html5":
					$returnedHTML .= '
						var legendArray = new Array();
					';
					
					foreach ($html5Chart as $key=>$value) {
						$returnedHTML .= '
						var html5Canvas = document.getElementById("'.$value['id'].'-canvas"); 
						chartArray['.$key.'] = html5Canvas.toDataURL("image/png");';
					
						$returnedHTML .= '
						var html5Legend = encodeURIComponent($("#legend'.$value['id'].'").html());
						legendArray['.$key.'] = html5Legend;';
					}
				
					$returnedHTML .= 'document.export_form.legends.value = legendArray.join(\'%legendSeparator\');';
					break;
					
				case "nvd3":
					$returnedHTML .= '
					var legendArray = new Array();
					';
					
					foreach ($nvd3Chart as $key=>$value) {
						$returnedHTML .= '
						var nvd3Svg = \'<svg xmlns="http://www.w3.org/2000/svg" style="width:\'+$("#ASOLsvg_'.str_replace("-", "", $reportId).'_'.$key.'").width()+\'; height:\'+$("#ASOLsvg_'.str_replace("-", "", $reportId).'_'.$key.'").height()+\';">\'+document.getElementById("ASOLsvg_'.str_replace("-", "", $reportId).'_'.$key.'").innerHTML+\'</svg>\';
						chartArray['.$key.'] = escape(nvd3Svg);';
					
						$returnedHTML .= '
						var nvd3Title = escape($("#ASOLnvd3Title_'.str_replace("-", "", str_replace("-", "", $reportId)).'_'.$key.'").html());
						legendArray['.$key.'] = nvd3Title;';
	
					}
	
					$returnedHTML .= 'document.export_form.legends.value = legendArray.join(\'%legendSeparator\');';
					break;
					
				default:
					break;
					
			}
			
			
			$returnedHTML .= '
				document.export_form.pngs.value = chartArray.join(\'%pngSeparator\');';
				
			
			$returnedHTML .= '
			}
			</script>
			';
			
			if (!$hasDisplayedCharts)
				$returnedHTML .= '<input id="reportbutton_html" type="button" title="'.$mod_strings['LBL_REPORT_EXPORT_HTML'].'" class="button" onclick="document.export_form.return_action.value=\'ExportHtml\'; document.export_form.pngs.value = \'\'; document.export_form.legends.value = \'\'; window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_EXPORT_HTML'].'">';
			else
				$returnedHTML .= '<input id="reportbutton_html" type="button" title="'.$mod_strings['LBL_REPORT_EXPORT_HTML'].'" class="button" onclick="document.export_form.return_action.value=\'ExportHtml\'; generateChartsPng(); window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_EXPORT_HTML'].'">';
				
			if (!$hasDisplayedCharts)
				$returnedHTML .= '<input id="reportbutton_pdf" type="button" title="'.$mod_strings['LBL_REPORT_EXPORT_PDF'].'" class="button" onclick="document.export_form.return_action.value=\'ExportPdf\'; document.export_form.pngs.value = \'\'; document.export_form.legends.value = \'\'; window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_EXPORT_PDF'].'">';
			else
				$returnedHTML .= '<input id="reportbutton_pdf" type="button" title="'.$mod_strings['LBL_REPORT_EXPORT_PDF'].'" class="button" onclick="document.export_form.return_action.value=\'ExportPdf\'; generateChartsPng(); window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_EXPORT_PDF'].'">';
				
			$returnedHTML .= '<input id="reportbutton_csv" type="button" title="'.$mod_strings['LBL_REPORT_EXPORT_CSV'].'" class="button" onclick="document.export_form.return_action.value=\'ExportCsv\'; document.export_form.pngs.value = \'\';document.export_form.legends.value = \'\'; window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_EXPORT_CSV'].'">';
			
			if (ACLController::checkAccess('asol_Reports', 'edit', true)) {
	
				if ((in_array($report_attachment_format, array("PDF", "HTML"))) && ($hasDisplayedCharts))
					$returnedHTML .= '<input id="reportbutton_email" type="button" title="'.$mod_strings['LBL_REPORT_SEND_EMAIL'].'" class="button" onclick="document.export_form.return_action.value=\'ManualTasks\'; generateChartsPng(); if (confirm(\''.$sendEmailquestion.'\')){ window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();}" name="button" value="'.$mod_strings['LBL_REPORT_SEND_EMAIL'].'">';
				else
					$returnedHTML .= '<input id="reportbutton_email" type="button" title="'.$mod_strings['LBL_REPORT_SEND_EMAIL'].'" class="button" onclick="document.export_form.return_action.value=\'ManualTasks\'; document.export_form.pngs.value = \'\'; document.export_form.legends.value = \'\'; if (confirm(\''.$sendEmailquestion.'\')){ window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();}" name="button" value="'.$mod_strings['LBL_REPORT_SEND_EMAIL'].'">';
	
				if (isset($sugar_config['asolReportsExternalApplicationFixedParams']) && $hasExternalApp)
					$returnedHTML .= '<input id="reportbutton_app" type="button" title="'.$mod_strings['LBL_REPORT_SEND_APP'].'" class="button" onclick="document.export_form.return_action.value=\'SendToApp\'; document.export_form.pngs.value = \'\';document.export_form.legends.value = \'\'; window.open(\'\', \'ExportWindow\', \'width=300,height=100,location=0,status=0,scrollbars=0\'); document.export_form.submit();" name="button" value="'.$mod_strings['LBL_REPORT_SEND_APP'].'">';
				
			}		
	
		}
	
	}
	
	return $returnedHTML;
	
}
		

function getReportDetailPagination($reportId, $externalCall, $getLibraries, $isDashlet, $dashletId, $numPages, $numPagesLabel, $pageNumber, $pageNumberLabel, $totalEntries, $fieldSort, $sortDirection) {
	
	global $app_strings;

	$returnedHTML = "";
	
	$previousPage = ($pageNumber > 0) ? $pageNumber-1 : '0';
	$nextPage = ($pageNumber < $numPages) ? $pageNumber+1 : $numPages;
	
	$paginationSortDirection = ($sortDirection == 'ASC') ? "DESC" : "ASC";
	
	$disabledPaginationButtonsBack = (($numPages == 0) || ($pageNumber == 0)) ? "disabled" : "";
	$disabledPaginationButtonsForward = (($numPages == 0) || ($pageNumber == $numPages) || ($totalEntries == 0)) ? "disabled" : "";
	
	$paginationStartImg = (($numPages == 0) || ($pageNumber == 0)) ? "themes/default/images/start_off.gif" : "themes/default/images/start.gif";
	$paginationPreviousImg = (($numPages == 0) || ($pageNumber == 0)) ? "themes/default/images/previous_off.gif" : "themes/default/images/previous.gif";
	$paginationNextImg = (($numPages == 0) || ($pageNumber == $numPages) || ($totalEntries == 0)) ? "themes/default/images/next_off.gif" : "themes/default/images/next.gif";
	$paginationEndImg = (($numPages == 0) || ($pageNumber == $numPages) || ($totalEntries == 0)) ? "themes/default/images/end_off.gif" : "themes/default/images/end.gif";
		
	
	if (!$externalCall) {
								
		if ($numPages > 0) {

			$returnedHTML .= 
			'<table class="list view">
				<tbody>
				<tr class="pagination">
					<td colspan="8">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paginationTable">
							<tbody><tr>
													
								<td nowrap="nowrap" align="right" width="1%" class="paginationChangeButtons">';
									
									if (!$isDashlet) {
				
										$returnedHTML .=
										'<button '.$disabledPaginationButtonsBack.' class="button" title="'.$app_strings['LNK_LIST_START'].'" name="listViewStartButton" type="button" onClick="document.display_form.sort_direction.value=\''.$paginationSortDirection.'\'; document.display_form.action.value=\'DetailView\';document.display_form.page_number.value=0; document.display_form.return_action.value=\'\';document.display_form.submit()">
											<img height="11" border="0" align="absmiddle" width="13" alt="Start" src="'.$paginationStartImg.'">
										</button>
										
										<button '.$disabledPaginationButtonsBack.' title="'.$app_strings['LNK_LIST_PREVIOUS'].'" class="button" name="listViewPrevButton" type="button"  onClick="document.display_form.sort_direction.value=\''.$paginationSortDirection.'\'; document.display_form.action.value=\'DetailView\';document.display_form.page_number.value='.$previousPage.';document.display_form.return_action.value=\'\'; document.display_form.submit()">
											<img height="11" border="0" align="absmiddle" width="8" alt="Previous" src="'.$paginationPreviousImg.'">
										</button>
	
										<span class="pageNumbers">Page '.$pageNumberLabel.' of '.$numPagesLabel.'</span>
										
										<button '.$disabledPaginationButtonsForward.' title="'.$app_strings['LNK_LIST_NEXT'].'" class="button" name="listViewNextButton" type="button" onClick="document.display_form.sort_direction.value=\''.$paginationSortDirection.'\'; document.display_form.action.value=\'DetailView\';document.display_form.page_number.value='.$nextPage.'; document.display_form.return_action.value=\'\';document.display_form.submit()">
											<img height="11" border="0" align="absmiddle" width="8" alt="Next" src="'.$paginationNextImg.'">
										</button>
										
										<button '.$disabledPaginationButtonsForward.' title="'.$app_strings['LNK_LIST_END'].'" name="listViewEndButton" class="button" type="button"  onClick="document.display_form.sort_direction.value=\''.$paginationSortDirection.'\'; document.display_form.action.value=\'DetailView\';document.display_form.page_number.value='.$numPages.';document.display_form.return_action.value=\'\'; document.display_form.submit()">
							 				<img height="11" border="0" align="absmiddle" width="13" alt="End" src="'.$paginationEndImg.'">
										</button>';
									
									} else {
										
										$returnedHTML .=
										'<button '.$disabledPaginationButtonsBack.' class="button" title="'.$app_strings['LNK_LIST_START'].'" name="listViewStartButton" type="button" onClick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'(0, \''.$field_sort.'\', \''.$paginationSortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">
											<img height="11" border="0" align="absmiddle" width="13" alt="Start" src="'.$paginationStartImg.'">
										</button>
										
										<button '.$disabledPaginationButtonsBack.' title="'.$app_strings['LNK_LIST_PREVIOUS'].'" class="button" name="listViewPrevButton" type="button"  onClick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'('.$previousPage.', \''.$fieldSort.'\', \''.$paginationSortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">
											<img height="11" border="0" align="absmiddle" width="8" alt="Previous" src="'.$paginationPreviousImg.'">
										</button>
	
										<span class="pageNumbers">Page '.$pageNumberLabel.' of '.$numPagesLabel.'</span>
										
										<button '.$disabledPaginationButtonsForward.' title="'.$app_strings['LNK_LIST_NEXT'].'" class="button" name="listViewNextButton" type="button" onClick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'('.$nextPage.', \''.$fieldSort.'\', \''.$paginationSortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">
											<img height="11" border="0" align="absmiddle" width="8" alt="Next" src="'.$paginationNextImg.'">
										</button>
										
										<button '.$disabledPaginationButtonsForward.' title="'.$app_strings['LNK_LIST_END'].'" name="listViewEndButton" class="button" type="button"  onClick="reloadCurrentDashletReport'.str_replace("-", "", $dashletId).'('.$numPages.', \''.$fieldSort.'\', \''.$paginationSortDirection.'\', \''.($getLibraries ? '&getLibraries=true' : '').'&currentUserId='.$current_user->id.'&search_criteria=1&external_filters=\'+formatExternalFilters(\''.$dashletId.'\'));">
							 				<img height="11" border="0" align="absmiddle" width="13" alt="End" src="'.$paginationEndImg.'">
										</button>';
										
									}
			
							$returnedHTML .=
								'</td>
			
							</tr></tbody>
						</table>
					</td>
				</tr>
				</tbody>
			</table>';
			
		}
		
	}
	
	return $returnedHTML;
	
}

function getCollapseImg($containerId) {

	return '<img onclick="if( $(&quot;#'.$containerId.'&quot;).is(&quot;:visible&quot;) ) { $(&quot;#'.$containerId.'&quot;).hide(); $(&quot;#'.$containerId.'_collapseImg&quot;).attr(&quot;src&quot;, &quot;themes/default/images/advanced_search.gif&quot;) } else { $(&quot;#'.$containerId.'&quot;).show(); $(&quot;#'.$containerId.'_collapseImg&quot;).attr(&quot;src&quot;, &quot;themes/default/images/basic_search.gif&quot;) } " onmouseout="this.style.cursor=&quot;default&quot;" onmouseover="this.style.cursor=&quot;pointer&quot;" src="themes/default/images/basic_search.gif" id="'.$containerId.'_collapseImg" style="cursor: default;">&nbsp';

}

function getReportHeaderInfo($isDashlet, $externalCall, $reportHeaderMessage, $reportHeaderInfo = null, $collapsableHeaderId = null) {

	$headerHtml = (!$isDashlet) ? '<h4>' : '';
	if (!$externalCall) {
		$headerHtml .= ($collapsableHeaderId !== null) ? getCollapseImg($collapsableHeaderId) : '';
	}
	$headerHtml .= ($reportHeaderInfo !== null) ? '<em>'.$reportHeaderMessage.'</em>'.' : '.$reportHeaderInfo : '<em>'.$reportHeaderMessage.'</em>';
	$headerHtml .= (!$isDashlet) ? '</h4>' : '';
	
	return $headerHtml;

}

function getReportDetailSearchCriteria($reportId, $filtersPanel, $filtersHiddenInputs, $external_filters, $searchCriteria, $currentUserId, $isDashlet, $dashletId) {
	
	global $mod_strings;
	
	$returnedHTML = "";
	
	if (!empty($filtersPanel)) {
						
		$returnedHTML .=
			'<div class="detail view">
				
				<h4>'.$mod_strings['LBL_REPORT_SEARCH_CRITERIA'].'</h4>
				
				<form id="criteria_form" name="criteria_form" method="post" action="./index.php?module=asol_Reports&action=DetailView&record='.$reportId.'">
				<input type="hidden" id="filters_hidden_inputs'.$dashletId.'" name="filters_hidden_inputs'.$dashletId.'" value="'.$filtersHiddenInputs.'">
				<input type="hidden" id="external_filters" name="external_filters" value="'.$external_filters.'">
				<input type="hidden" id="search_criteria" name="search_criteria" value="'.$searchCriteria.'">
				<input type="hidden" id="currentUserId" name="currentUserId" value="'.$currentUserId.'">
					
				<table id="search_criteria">';

					$numPanels = count($filtersPanel);
					$panelsPerRow = ($isDashlet ? 1 : 2);
																
					$filterWidth = round((100.0 / $panelsPerRow / 5), 2);
					
					$returnedHTML .= '<colgroup>';
					for($i=0; $i<$panelsPerRow; $i++) {
						$returnedHTML .= '<col span="5" style="width: '.$filterWidth.'%;" />';
					}
					$returnedHTML .= '</colgroup>';
					
					$returnedHTML .= '<tbody>';
					$index = 1;
					foreach ($filtersPanel as $key=>$item) {
						
						if (($index % $panelsPerRow) == 1) { // first filter
							$returnedHTML .= '<tr>';
						}
						
						$returnedHTML .= '
							<td scope="col" valign="top">
								<input id="filterType" type="hidden" value="'.$item['type'].'">
								<input id="filterRef" type="hidden" value="'.$item['reference'].'">
								'.$item['label'].'
							</td>
							<td valign="top">
								<b>'.$item['genLabel'].'</b>
							</td>
							<td valign="top">
								'.$item['input1'].'
							</td>
							<td valign="top">
								'.$item['input2'].'
							</td>
							<td valign="top">
								'.$item['input3'].'
							</td>';
						
						if ((($index % $panelsPerRow) == 0) || ($index == $numPanels)) {
							if (($index == $numPanels) && ($index % 2 != 0) && (!$isDashlet)) {
								$returnedHTML .= '
								<td scope="col" style="width: 10%;"></td>
								<td colspan="4" style="width: 40%;"></td>';								
							}
							
							$returnedHTML .= '</tr>';
						}
						
						$index++;
						
					}
					$returnedHTML .= '</tbody>';
								
		$returnedHTML .= '
					</table>
				</form>
		
			</div>';
		
	}
	
	return $returnedHTML;
	
}

		
?>