<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


class asol_ReportsCharts {
	
	static public function generateGroupingValue($fieldValuesData, $currentChartIndex) {

		$groupingValue = "";
		
		foreach ($fieldValuesData as $keyF=>$currentField) {
				
			$chartOriginalFieldName = $currentField['chartOriginalFieldName'];
			unset($currentField['chartOriginalFieldName']);

			if ($currentField['index'] == $currentChartIndex) {
				$groupingValue = $currentField['alias'];
				break;
			}
				
		}
		
		return $groupingValue;
		
	}
	
	
	static public function getFieldAliasFromChartInfo($chartInfo, $fieldValuesData) {
		
		foreach ($fieldValuesData as $currentField) {
			
			if (($currentField['notModifiedFieldName'] == $chartInfo['field']) && ($currentField['isRelated'] == $chartInfo['related']) && ($currentField['index'] == $chartInfo['index']))
				return $currentField['alias'];	
			
		}
		
	}
	
	static private function getChartTypes($chartInfo) {
		
		$chartTypes = array();

		$chartTypes[] = $chartInfo['type'];
		foreach ($chartInfo['subcharts'] as $subChart) {
			$chartTypes[] = $subChart['data']['type'];
		}

		return $chartTypes;
		
	}
	
	static private function getChartYAxisSides($chartInfo) {
		
		$chartYAxisSides = array();

		$chartYAxisSides[] = 'left';
		foreach ($chartInfo['subcharts'] as $subChart) {
			$chartYAxisSides[] = $subChart['data']['yAxisSide'];
		}

		return $chartYAxisSides;
		
	}
	
	
	static public function getDataForChartsGeneration(& $chartInfo, & $chartConfig, $fieldValues, $subTotalsCharts, $subGroupsExport, $massiveData, $isDetailReport, $isGroupedReport, $hasFunctionField, $group_by_seq, $groupExport, $userDateFormat) {

		$subGroupsChart = array_keys($subTotalsCharts);

		$chartValues = array();
		$chartConfigs = array();
		$chartYAxisLabels = array();
		
		foreach ($chartInfo as $chartKey=>$currentChartInfo) {
			
			$hasSubCharts = (!empty($currentChartInfo['subcharts']));
			$currentChartLabel = trim($currentChartInfo['label']);
			
			if (strtolower($currentChartInfo['display']) == 'yes') {

				if ($isDetailReport) {
				
					if ($hasFunctionField) {
						
						foreach($subTotalsCharts as $groupKey=>$totalValues) {
							
							$currentValue = $totalValues[$currentChartLabel];
		
							if (in_array($currentChartInfo['type'], array('pie', 'bar', 'funnel'))) {
								
								$chartValues[$currentChartLabel]['mainChart'][] = $currentValue;
							
							} else if (in_array($currentChartInfo['type'], array('stack', 'horizontal', 'line', 'scatter', 'area', 'bubble'))) {
								
								$counter = count($chartValues[$currentChartLabel]['mainChart']);
								$chartValues[$currentChartLabel]['mainChart'][$counter]['totalValue'] = $currentValue;
			
								if ($isGroupedReport) {

									$groupingValue = self::generateGroupingValue($fieldValues['tables'][0]['data'], $currentChartInfo['index']);
									
									foreach ($subGroupsExport[$groupKey] as $groupExport) {
										
										$chartValues[$currentChartLabel]['mainChart'][$counter]['values'][] = array (
											'group' => asol_ReportsGenerateQuery::getGroupingChartValue($group_by_seq, $groupExport, $userDateFormat),
											'value' => $groupExport[$groupingValue],
										);
										
									}
								
								} else {
									
									$groupingValue = self::getFieldAliasFromChartInfo($currentChartInfo, $fieldValues['tables'][0]['data']);
									
									$chartValues[$currentChartLabel]['mainChart'][$counter]['values'][] = array (
										'group' => $groupingValue,
										'value' => $currentValue,
									);
		
								}
																		
							} else {
								
								unset($chartInfo[$chartKey]);
								
							}
		
						}

					} else {
	
						if ($massiveData) {
	
							if (in_array($currentChartInfo['type'], array('scatter', 'bubble'))) {
	
								foreach($subTotalsCharts as $groupKey=>$totalValues) {
									
									$groupValues = array();
									foreach ($totalValues as $currentValues) {
										$groupValues[] = $currentValues[$currentChartLabel];
									}
									
									$chartValues[$currentChartLabel]['mainChart'][] = array(
										'values' => $groupValues,
										'totalValue' => max($groupValues)
									);
									
								}
							
							} else {
	
								unset($chartInfo[$chartKey]);
	
							}
							
						} else {
	
							foreach($subTotalsCharts as $groupKey=>$totalValues) {
								
								$currentValue = $totalValues[$currentChartLabel];
								
								if (in_array($currentChartInfo['type'], array('stack', 'horizontal', 'line', 'scatter', 'area', 'bubble'))) {
		
									$counter = count($chartValues[$currentChartLabel]['mainChart']);
									$chartValues[$currentChartLabel]['mainChart'][$counter]['totalValue'] = $currentValue;
									
									if ($isGroupedReport) {
	
										$groupingValue = self::generateGroupingValue($fieldValues['tables'][0]['data'], $currentChartInfo['index']);
										
										foreach ($subGroupsExport[$groupKey] as $groupExport) {
	
											$chartValues[$currentChartLabel]['mainChart'][$counter]['values'][] = Array (
												'group' => asol_ReportsGenerateQuery::getGroupingChartValue($group_by_seq, $groupExport, $userDateFormat),
												'value' => $groupExport[$groupingValue],
											);
											
										}
									
									}
								
								} else {
		
									unset($chartInfo[$chartKey]);
								
								}
								
							}
	
						}
	
					}
				
				} else {
		
					if (in_array($currentChartInfo['type'], array('pie', 'bar', 'funnel', 'stack', 'horizontal', 'line', 'scatter', 'area', 'bubble'))) {
						
						$groupingValue = self::generateGroupingValue($fieldValues['tables'][0]['data'], $currentChartInfo['index']);
						
						foreach($subTotalsCharts as $key=>$values) {
							$subGroupsChart[$key] = asol_ReportsGenerateQuery::getGroupingChartValue($group_by_seq, $values, $userDateFormat);
							$chartValues[$currentChartLabel]['mainChart'][] = $values[$groupingValue];
						}
	
					} else {
						
						unset($chartInfo[$chartKey]);
						
					}
	
				}
				
				
				if (isset($chartInfo[$chartKey])) {
					
					$chartConfigs[$chartKey]['mainConfig'] = $chartConfig[$chartKey];
					$chartYAxisLabels[$chartKey][0] = self::getFieldAliasFromChartInfo($currentChartInfo, $fieldValues['tables'][0]['data']);

					if ($hasSubCharts) {

						//***********************//
						//***AlineaSol Premium***//
						//***********************//
						$extraParamsValues = array(
							'subcharts' => $currentChartInfo['subcharts'],
							'fieldValuesData' => $fieldValues['tables'][0]['data'],
							'subTotalsCharts' => $subTotalsCharts,
							'subGroupsExport' => $subGroupsExport,
							'currentChartLabel' => $currentChartLabel,
							'groupBySequence' => $group_by_seq,
							'userDateFormat' => $userDateFormat,
							'isDetailReport' => $isDetailReport,
							'isGroupedReport' => $isGroupedReport,
							'hasFunctionField' => $hasFunctionField,
							'massiveData' => $massiveData
						);
						
						$extraParamsConfigs = array(
							'subcharts' => $currentChartInfo['subcharts'],
						);
						
						$extraParamsYAxisLabels = array(
							'subcharts' => $currentChartInfo['subcharts'],
							'fieldValuesData' => $fieldValues['tables'][0]['data']
						);
						
						$chartValues[$currentChartLabel]['subCharts'] = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsValues", $extraParamsValues);
						$chartConfigs[$chartKey]['subConfigs'] = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsConfigs", $extraParamsConfigs);
						$subChartsYAxisLabels = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsYAxisLabels", $extraParamsYAxisLabels);
						
						$chartYAxisLabels[$chartKey] = ($subChartsYAxisLabels !== false) ? array_merge($chartYAxisLabels[$chartKey], $subChartsYAxisLabels) : $chartYAxisLabels[$chartKey];
						//***********************//
						//***AlineaSol Premium***//
						//***********************//
	
					} else {
					
						//***********************//
						//***AlineaSol Premium***//
						//***********************//
						$extraParamsValues = array(
							'zChart' => $currentChartInfo,
							'fieldValuesData' => $fieldValues['tables'][0]['data'],
							'subTotalsCharts' => $subTotalsCharts,
							'subGroupsExport' => $subGroupsExport,
							'currentChartLabel' => $currentChartLabel,
							'groupBySequence' => $group_by_seq,
							'userDateFormat' => $userDateFormat,
							'isDetailReport' => $isDetailReport,
							'isGroupedReport' => $isGroupedReport,
							'hasFunctionField' => $hasFunctionField,
							'massiveData' => $massiveData
						);
						
						$chartValues[$currentChartLabel]['zChart'] = asol_ReportsUtils::managePremiumFeature("bubbleReportCharts", "reportFunctions.php", "getZChartDataValues", $extraParamsValues);
						//***********************//
						//***AlineaSol Premium***//
						//***********************//

					}
					
				}
				

			} else {

				unset($chartInfo[$chartKey]);
				
			}
			
		}
		
		$chartInfo = array_values($chartInfo);
		$chartConfigs = array_values($chartConfigs);
		$chartYAxisLabels = array_values($chartYAxisLabels);
		
		return array(
			'subGroupsChart' => $subGroupsChart,
			'chartValues' => $chartValues,
			'chartConfigs' => $chartConfigs,
			'chartYAxisLabels' => $chartYAxisLabels
		);
		
	}
	
	
	static public function getChartFilesWithExtraData($chartsEngine, $isStackedChart, $massiveData, & $chartInfo, $chartConfigs, $chartYAxisLabels, $chartValues, $subGroupsChart, $reportId, $report_module, $chartsHttpQueryUrls, $isGroupedReport, $isStoredReport) {
		
		$chartIndex=0;
		
		foreach($chartValues as $currentChartValues) {
			
			$currentChartInfo = $chartInfo[$chartIndex];
			$currentChartConfigs = $chartConfigs[$chartIndex];
			$currentChartTypes = self::getChartTypes($currentChartInfo);
			$currentChartYAxisSides = self::getChartYAxisSides($currentChartInfo);
			
			if ($currentChartInfo['type'] == 'pie') {
				if ($chartsEngine != 'nvd3')
					$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				else
					$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				$chartInfo[$chartIndex]['type'] = 'PieChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
				
			}
			
			if ($currentChartInfo['type'] == 'bar') {
					
				if ($chartsEngine != 'nvd3')
					$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				else
					$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				$chartInfo[$chartIndex]['type'] = 'BarChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
			
			if ($currentChartInfo['type'] == 'funnel') {
					
				if ($chartsEngine != 'nvd3')
					$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				else
					$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				$chartInfo[$chartIndex]['type'] = 'FunnelChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
			
			if ($currentChartInfo['type'] == 'stack') {

				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				}
				$chartInfo[$chartIndex]['type'] = 'StackChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
			
			if ($currentChartInfo['type'] == 'horizontal') {
	
				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else	
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				}
				$chartInfo[$chartIndex]['type'] = 'HorizontalChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
			
			if ($currentChartInfo['type'] == 'line') {
	
				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				}
				$chartInfo[$chartIndex]['type'] = 'LineChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}				
	
			if ($currentChartInfo['type'] == 'scatter') {
	
				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);			
				}
				$chartInfo[$chartIndex]['type'] = 'ScatterChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
			
			if ($currentChartInfo['type'] == 'area') {
	
				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				}
				$chartInfo[$chartIndex]['type'] = 'AreaChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}

			if ($currentChartInfo['type'] == 'bubble') {
	
				if ($chartsEngine != 'nvd3') {
					if ($isStackedChart)
						$urlChart[] = self::generateCrmNativeStackedChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
					else
						$urlChart[] = self::generateCrmNativeNormalChartData($currentChartTypes[0], count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues['mainChart'], count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);
				} else {
					if ($isStackedChart)
						$urlChart[] = self::generateNvd3StackedChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $massiveData, $isGroupedReport, $isStoredReport);
					else
						$urlChart[] = self::generateNvd3NormalChartData($reportId, $currentChartTypes, $chartYAxisLabels[$chartIndex], $currentChartYAxisSides, $currentChartConfigs, count($urlChart), $report_module, $currentChartInfo['label'], $subGroupsChart, $currentChartValues, count($subGroupsChart), (empty($chartsHttpQueryUrls)) ? null : $chartsHttpQueryUrls[count($urlChart)], $currentChartInfo['function'], $isStoredReport);			
				}
				$chartInfo[$chartIndex]['type'] = 'BubbleChart';
				$chartInfo[$chartIndex]['subgroups'] = count($subGroupsChart);
				$chartSubGroupsValues[] = count($subGroupsChart);
					
			}
				
			$chartIndex++;
			
		}
		
		return array(
			'urlChart' => $urlChart,
			'chartSubGroupsValues' => $chartSubGroupsValues
		);
		
	}
	
	
	static public function getChartEngineLibraries($chartEngine, $isDashlet) {
		
		$chartFiles = array();
		
		switch ($chartEngine) {
	
			case "flash":
				$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/swfobject/swfobject.js";
				break;
				
			case "html5":
				$chartFiles[] = "JS;include/SugarCharts/Jit/js/Jit/jit.js";
				$chartFiles[] = "CSS;include/SugarCharts/Jit/css/base.css";
				$chartFiles[] = ($isDashlet) ? "JS;modules/asol_Reports/include_basic/js/sugarCharts.min.js" : "JS;include/SugarCharts/Jit/js/sugarCharts.js";
				break;
	
			case "nvd3":
				$chartFiles[] = "CSS;modules/asol_Reports/include_basic/js/nvd3/src/nv.d3.css";
				
				if (!$isDashlet)
					$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/innersvg.min.js";
				
				$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/nvd3/lib/d3.v2.min.js";
				$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/nvd3/nv.d3.js";
		
				//$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/nvd3/lib/fisheye.js";
				$chartFiles[] = "JS;modules/asol_Reports/include_basic/js/nvd3/src/utils.js";
				break;
				
			default:
				break;				
		}
		
		return $chartFiles;
		
	}
	
	static public function getCrmChartHtml($reportId, $chartEngine, $returnData, $returnScript, $urlChart, $chartInfo, $current_language, $theme, $isStoredReport, $isDashlet) {
		
		global $sugar_config;
		

		$asolReportsResizableNVD3Charts = ((isset($sugar_config['asolReportsResizableNVD3Charts'])) && ($sugar_config['asolReportsResizableNVD3Charts']));
		
		$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
		if (($isStoredReport) && ($returnData))
			$tmpFilesDir .= 'storedReports/';
			
		$chartHtml = "";
		
		if ($chartEngine == "flash") { //FLASH
			
			foreach ($urlChart as $key=>$value) {
	
				if ($returnScript) {
				
					$chartHtml .= '
						var chartSubGroupsValues = document.getElementById("chartSubGroupsValues").value;
						var groupsCountValues = chartSubGroupsValues.split(",");	
					
						var flashvars = {};
						flashvars.inputFile = "'.$value.'";
						flashvars.swfLocation = "include/SugarCharts/swf/";
					';
		
					if (file_exists("themes/default/images/sugarColors.xml")) 
						$chartHtml .= 'flashvars.inputColorScheme = "themes/default/images/sugarColors.xml";';
					else 
						$chartHtml .= 'flashvars.inputColorScheme = "themes/'.$theme.'/images/sugarColors.xml";';
					
					$chartHtml .= 'flashvars.c = "1";';
		
					if (file_exists("cache/themes/Sugar/css/chart.css")) 
						$chartHtml .= 'flashvars.inputStyleSheet = "themes/default/css/chart.css";';
					else 
						$chartHtml .= 'flashvars.inputStyleSheet = "themes/'.$theme.'/css/chart.css";';
				
					$chartHtml .= 'flashvars.inputLanguage = "modules/asol_Reports/language/chart_strings.'.$current_language.'.lang.xml";';
				
					
					$chartHtml .= 'var defaultWidth = 600;';
					$chartHtml .= 'var defaultHeight = 450;';
	
					if ($isDashlet) {
						
						$chartHtml .= 'defaultWidth = "100%";';
						
					} else {
	
						if ($chartInfo[$key]['type'] == 'bar')
		                	$chartHtml .= 'defaultWidth = (groupsCountValues['.$key.'] > defaultWidth/100) ? defaultWidth + ((( groupsCountValues['.$key.'] ) -(defaultWidth/100))*65) : defaultWidth;';
						
		                if ($chartInfo[$key]['type'] == 'line')
		                	$chartHtml .= 'defaultWidth = (groupsCountValues['.$key.'] > defaultWidth/100) ? defaultWidth + ((( groupsCountValues['.$key.'] ) -(defaultWidth/100))*85) : defaultWidth;';
		                	
						if ($chartInfo[$key]['type'] == 'stack')
		                	$chartHtml .= 'defaultWidth = (groupsCountValues['.$key.'] > defaultWidth/100) ? defaultWidth + ((( groupsCountValues['.$key.'] ) -(defaultWidth/100))*85) : defaultWidth;';
						
						if ($chartInfo[$key]['type'] == 'horizontal')
		                	$chartHtml .= 'defaultHeight = (groupsCountValues['.$key.'] > defaultHeight/100) ? defaultHeight + ((( groupsCountValues['.$key.'] ) -(defaultHeight/100))*25) : defaultHeight;';                                                         
		                	
					}
	
			        $chartHtml .= 'flashvars.myWidth = defaultWidth;';
			        $chartHtml .= 'flashvars.myHeight = defaultHeight;';
				
					$chartHtml .= '
						var params = {};
						params.quality = "high";
						params.wmode = "transparent";
						params.menu = "false";
						params.allowscriptaccess = "always";
						var attributes = {};
					';
			
					$chartHtml .= 'swfobject.embedSWF("include/SugarCharts/swf/ASOLchart.swf", "ASOLflash_'.str_replace("-", "", $reportId).'_'.$key.'", defaultWidth, defaultHeight, "10.0.0", "", flashvars, params, attributes);';
	
				}
						
			}
			
			$chartArray = array(
				"chartHtml" => $chartHtml
			);
			
		} else if ($chartEngine == "html5") { //HTML5
	
			$html5Chart = array();
				
			foreach ($urlChart as $key=>$value) { 
				
				$fileIdArray = explode("/", $value);
				$fileIdArray2 = explode(".", $fileIdArray[count($fileIdArray)-1]);
				$fileId = $fileIdArray2[0];
		
				$chartType = ($chartInfo[$key]['type']== 'PieChart') ? "pieChart" : "barChart";
				$chartParamType = ($chartInfo[$key]['type'] == 'PieChart') ? "pieType" : "barType";
				$chartComplex = (in_array($chartInfo[$key]['type'], array('StackChart', 'HorizontalChart', 'LineChart'))) ? "stacked" : "basic";
				
				if ($chartInfo[$key]['type'] == 'HorizontalChart')
					$chartOrientation = 'chartConfig["orientation"] = "horizontal";';
				else if ($chartInfo[$key]['type'] == 'StackChart')
					$chartOrientation = 'chartConfig["orientation"] = "vertical";';
				else
					$chartOrientation = '';
		
					
				if ($returnData) {
					
					if ($chartInfo[$key]['type'] == 'PieChart')
						$chartTypeHtml5 = "pie chart";
					if ($chartInfo[$key]['type'] == 'BarChart')
						$chartTypeHtml5 = "bar chart";
					if ($chartInfo[$key]['type'] == 'StackChart')
						$chartTypeHtml5 = "stacked group by chart";
					if ($chartInfo[$key]['type'] == 'HorizontalChart')
						$chartTypeHtml5 = "horizontal group by chart";
					if ($chartInfo[$key]['type'] == 'LineChart')
						$chartTypeHtml5 = "line chart";
					if ($chartInfo[$key]['type'] == 'FunnelChart')
						$chartTypeHtml5 = "funnel chart 3D";	
							
					$chart = new ReportsDashletChart($fileId);
			  
					$w = 600;
					$h = 400;
	
					if ($isDashlet) {
	
						$w = '100%';
						
					} else {
		        		
						if ($chartInfo[$key]['type'] == 'BarChart')
				        	$w = ($chartInfo[$key]['subgroups'] > $w/100) ? $w + ((($chartInfo[$key]['subgroups']) -($w/100))*50) : $w;
				        
				        if ($chartInfo[$key]['type'] == 'LineChart')
				        	$w = ($chartInfo[$key]['subgroups'] > $w/100) ? $w + ((($chartInfo[$key]['subgroups']) -($w/100))*50) : $w;
				        	
				        if ($chartInfo[$key]['type'] == 'StackChart')
				        	$w = ($chartInfo[$key]['subgroups'] > $w/100) ? $w + ((($chartInfo[$key]['subgroups']) -($w/100))*50) : $w;
				        	
				        if ($chartInfo[$key]['type'] == 'HorizontalChart')
				        	$h = ($chartInfo[$key]['subgroups'] > $h/100) ? $h + ((($chartInfo[$key]['subgroups']) -($h/100))*50) : $h;
	
				        $w .= 'px';
				        	
					}
					
					        
					$html5Chart[] = array(
						"html" => $chart->display("", "", $value, $chartTypeHtml5, "100%", $h),
						"id" => $fileId,
						"dimensions" => array(
							"width" => $w,
							"height" => $h
						)
					);
						
				}
	
				if ($returnScript) {
				
					$chartHtml .= 'SUGAR.util.doWhen("((SUGAR && SUGAR.mySugar && SUGAR.mySugar.sugarCharts) || SUGAR.loadChart || document.getElementById(\'showHideChartButton\') != null) && typeof(loadSugarChart) != undefined",
						function(){
							var css = new Array();
							var chartConfig = new Array();
							css["gridLineColor"] = "#cccccc";
							css["font-family"] = "Arial";
							css["color"] = "#000000";
							'.$chartOrientation.'
							chartConfig["'.$chartParamType.'"] = "'.$chartComplex.'";
							chartConfig["tip"] = "name";
							chartConfig["chartType"] = "'.$chartType.'";
							chartConfig["imageExportType"] = "png";
							loadCustomChartForReports = function(){
								loadSugarChart("'.$fileId.'","'.$tmpFilesDir.$fileId.'.js",css,chartConfig);
							};
							loadCustomChartForReports();
						}
					);';
					
				}
					
			}
			
			$chartArray = array(
				"chartHtml" => $chartHtml,
				"returnedCharts" => $html5Chart
			);
			
		} else if ($chartEngine == "nvd3") { //NVD3
	
			$nvd3Chart = array();
				
			foreach ($urlChart as $key=>$value) { 
	
				if ($returnData) {
					
					$w = 600;
					$h = 400;
	
					if ($isDashlet) {
	
						$w = '100%';
						
					} else {
		        		
						if (in_array($chartInfo[$key]['type'], array('BarChart', 'LineChart', 'ScatterChart', 'StackChart', 'AreaChart', 'BubbleChart')))
				        	$w = ($chartInfo[$key]['subgroups'] > $w/100) ? $w + ((($chartInfo[$key]['subgroups']) -($w/100))*25) : $w;
				        	
				        if ($chartInfo[$key]['type'] == 'HorizontalChart')
				        	$h = ($chartInfo[$key]['subgroups'] > $h/100) ? $h + ((($chartInfo[$key]['subgroups']) -($h/100))*20) : $h;
				        	
				        $w .= 'px';
				        	
					}
					
					        
					$nvd3Chart[] = array(
						"html" => "<h4 id='ASOLnvd3Title_".str_replace("-", "", $reportId)."_".$key."'></h4>",
						"dimensions" => array(
							"width" => $w,
							"height" => $h
						)
					);
						
				}
	
				if ($returnScript) {
					
					$chartHtml .= '
						try {
							var script_'.str_replace("-", "", $reportId).'_'.$key.' = document.createElement("script");
						    script_'.str_replace("-", "", $reportId).'_'.$key.'.type = "text/javascript";
						    script_'.str_replace("-", "", $reportId).'_'.$key.'.src = "'.$value.'";
						    document.getElementById("ASOLnvd3_'.str_replace("-", "", $reportId).'_'.$key.'").appendChild(script_'.str_replace("-", "", $reportId).'_'.$key.');';
		
					if ((!$isDashlet) && ($asolReportsResizableNVD3Charts))
					    $chartHtml .= '$("#ASOLnvd3_'.str_replace("-", "", $reportId).'_'.$key.'").resizable({ alsoResize: "#ASOLsvg_'.str_replace("-", "", $reportId).'_'.$key.'" });';
						
					$chartHtml .= '
						} catch(err) { console.log("Cannot Load AlineaSolReport ['.$reportId.']"); }
					';
					    
				}
				
			}
			
			$chartArray = array(
				"chartHtml" => $chartHtml,
				"returnedCharts" => $nvd3Chart
			);
			
		}
	
		return $chartArray;
		
	}
	
	//***********************//
	//***CRM Native Charts***//
	//***********************//
	
	static public function generateCrmNativeNormalChartData($chartType, $prefixChart, $reportModule, $chartTitle, $chartLegends, $chartValues, $numGroups, $overridedName = null, $chartFunction = '0', $isStoredReport = false){
	
		if (in_array($chartType, array('pie', 'bar', 'funnel'))) {
		
			global $sugar_config, $mod_strings;
		
			$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
			
			if ($isStoredReport)
				$tmpFilesDir .= "storedReports/";
				
			$currentDir = getcwd()."/";
			
			$prefixChart = str_replace(" ", "_", $prefixChart);
			$xmlName = $prefixChart."_".dechex(time()).dechex(rand(0,999999)).".xml";
			
			$xmlCompletePath = (empty($overridedName)) ? $tmpFilesDir.$xmlName : $overridedName;
			
			$descriptor = fopen($xmlCompletePath, "w");
			
			if (max($chartValues) >= 1000000)
				$chartSubTitle = translate('LBL_REPORT_CHARTS_VALUE_SIZE_M', 'asol_Reports');
			else if (max($chartValues) >= 1000)
				$chartSubTitle = translate('LBL_REPORT_CHARTS_VALUE_SIZE_K', 'asol_Reports');
			else
				$chartSubTitle = "";
		
			$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
			$xml .= "<sugarcharts version=\"1.0\">\n";
			
			$xml .= "\t<properties>\n";
			$xml .= "\t\t<title>".$chartTitle."</title>\n";
			$xml .= "\t\t<subtitle>".$chartSubTitle."</subtitle>\n";
			
			if ($chartType == "pie")
				$xml .= "\t\t<type>pie chart</type>\n";
			else if ($chartType == "bar")
				$xml .= "\t\t<type>bar chart</type>\n";
			else if ($chartType == "funnel")
				$xml .= "\t\t<type>funnel chart 3D</type>\n";
			
			$xml .= "\t\t<legend>on</legend>\n";
			$xml .= "\t\t<labels>value</labels>\n";
			$xml .= "\t</properties>\n";
			
			$xml .= "\t<data>\n";
			
			$avoidFormatting = (strpos($chartFunction, "COUNT") !== false);
			
			foreach ($chartLegends as $key=>$chartLegend){
				
				$xml .= "\t\t<group>\n";
				$xml .= "\t\t\t<title>".$chartLegend."</title>\n";
				
				if (max($chartValues) >= 1000000){
		
					if ($chartType == "bar")
						$xml .= (($chartValues[$key]) == 0) ? "\t\t\t<value>0.000001</value>\n" : "\t\t\t<value>".($chartValues[$key]/1000000)."</value>\n";
					else if ($chartType == "pie")
						$xml .= "\t\t\t<value>".($chartValues[$key]/1000000)."</value>\n";
					else if ($chartType == "funnel")
						$xml .= "\t\t\t<value>".($chartValues[$key]/1000000)."</value>\n";
						
					$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number($chartValues[$key]/1000000)."M</label>\n" : "\t\t\t<label>".($chartValues[$key]/1000000)."M</label>\n";
				
				} else if (max($chartValues) >= 1000){
		
					if ($chartType == "bar")
						$xml .= (($chartValues[$key]) == 0) ? "\t\t\t<value>0.000001</value>\n" : "\t\t\t<value>".($chartValues[$key]/1000)."</value>\n";
					else if ($chartType == "pie")
						$xml .= "\t\t\t<value>".($chartValues[$key]/1000)."</value>\n";
					else if ($chartType == "funnel")
						$xml .= "\t\t\t<value>".($chartValues[$key]/1000)."</value>\n";
						
					$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number($chartValues[$key]/1000)."K</label>\n" : "\t\t\t<label>".($chartValues[$key]/1000)."K</label>\n";
				
				} else {
		
					if ($chartType == "bar")
						$xml .= (($chartValues[$key]) == 0) ? "\t\t\t<value>0.000001</value>\n" : "\t\t\t<value>".$chartValues[$key]."</value>\n";
					else if ($chartType == "pie")
						$xml .= "\t\t\t<value>".$chartValues[$key]."</value>\n";
					else if ($chartType == "funnel")
						$xml .= "\t\t\t<value>".$chartValues[$key]."</value>\n";
						
					$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number(floor($chartValues[$key] * 100) / 100)."</label>\n" : "\t\t\t<label>".(floor($chartValues[$key] * 100) / 100)."</label>\n";
				
				}
				
				//$xml .= "\t\t\t<link>index.php?module=".$reportModule."&action=index&query=true&searchFormTab=advanced_search</link>";
				
				$xml .= "\t\t\t<subgroups>\n";
				$xml .= "\t\t\t</subgroups>\n";
				$xml .= "\t\t</group>\n";
				
			}
			
			$xml .= "\t</data>\n";
			
			$xml .= "\t<yAxis>\n";
			$xml .= "\t\t<yMin>0</yMin>\n";
		
			if ($chartType == "bar") {
				
				if (max($chartValues) >= 1000000)
					$truncatedMaxValue = ceil((max($chartValues))/1000000)+2;
				else if (max($chartValues) >= 1000)
					$truncatedMaxValue = ceil((max($chartValues))/1000)+2;
				else
					$truncatedMaxValue = ceil(max($chartValues))+2;
				
				$roundedDigits = strlen((string)(ceil($truncatedMaxValue)))-1;
				$yMax = round($truncatedMaxValue, $roundedDigits*(-1));
				$yMax = ($yMax < $truncatedMaxValue) ? $yMax+((pow(10, $roundedDigits))/2) : $yMax; 
				
				$yStep = ceil($yMax/5);
				
				while($yMax >= $truncatedMaxValue)
					$yMax -= $yStep;
				$yMax += $yStep;
				
			} else if ($chartType == "pie") {
				
				if (max($chartValues) >= 1000000)
					$yMax = ceil((max($chartValues))/1000000)+2;
				else if (max($chartValues) >= 1000)
					$yMax = ceil((max($chartValues))/1000)+2;
				else
					$yMax = max($chartValues)+1;
				$yStep = '';
			
			} else if ($chartType == "funnel") {
				
				if (max($chartValues) >= 1000000)
					$yMax = ceil((max($chartValues))/1000000)+2;
				else if (max($chartValues) >= 1000)
					$yMax = ceil((max($chartValues))/1000)+2;
				else
					$yMax = max($chartValues)+1;
				$yStep = '';
			
			}
			
			$xml .= "\t\t<yMax>".$yMax."</yMax>\n";
			$xml .= "\t\t<yStep>".$yStep."</yStep>\n";
			
			$xml .= "\t\t<yLog>1</yLog>\n";
			$xml .= "\t</yAxis>\n";
			
			$xml .= "</sugarcharts>";
			
			$xml = chr(255).chr(254).mb_convert_encoding($xml, 'UTF-16LE', 'UTF-8');
			fputs($descriptor, $xml);
			fclose($descriptor);
			
			
			return $xmlCompletePath;
			
		} else if (in_array($chartType, array('stack', 'horizontal', 'line'))) {
			
			$dataGroups = array();
			foreach ($chartLegends as $key=>$chartLegend) {

				$dataGroups[] = array(
		            'totalValue' => $chartValues[$key],
		            'values' => array(
		             	0 => array(
							'group' => $chartTitle,
							'value' => $chartValues[$key]
		                )
					)		
				);
				
			}

			return self::generateCrmNativeStackedChartData($chartType, $prefixChart, $reportModule, $chartTitle, $chartLegends, $dataGroups, $numGroups, $overridedName, $chartFunction, $isStoredReport);
			
		}
		
	}
	
	static public function generateCrmNativeStackedChartData($chartType, $prefixChart, $reportModule, $chartTitle, $chartLegends, $chartValues, $numGroups, $overridedName = null, $chartFunction = '0', $isStoredReport = false){
		
		global $sugar_config, $mod_strings;
	
		$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
		
		if ($isStoredReport)
			$tmpFilesDir .= "storedReports/";
			
		$currentDir = getcwd()."/";
	
		
		$prefixChart = str_replace(" ", "_", $prefixChart);
		$xmlName = $prefixChart."_".dechex(time()).dechex(rand(0,999999)).".xml";
		
		$xmlCompletePath = (empty($overridedName)) ? $tmpFilesDir.$xmlName : $overridedName;
		
		$descriptor = fopen($xmlCompletePath, "w");
		
		$subTotalsArray = Array();
		
		$numGroups = 0;
		$maxGroupKey = null;
		$groups = Array();
		foreach ($chartLegends as $key=>$chartLegend) {		
			$subTotalsArray[] = $chartValues[$key]['totalValue'];
			
			//Generate here $groups array 
			foreach ($chartValues[$key]['values'] as $aValue) {
				if (!(in_array($aValue['group'], $groups)))
					$groups[] = $aValue['group'];
			}
			
		}
		
		if (max($subTotalsArray) >= 1000000)
			$chartSubTitle = translate('LBL_REPORT_CHARTS_VALUE_SIZE_M', 'asol_Reports');
		else if (max($subTotalsArray) >= 1000)
			$chartSubTitle = translate('LBL_REPORT_CHARTS_VALUE_SIZE_K', 'asol_Reports');
		else
			$chartSubTitle = "";
	
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml .= "<sugarcharts version=\"1.0\">\n";
		
		$xml .= "\t<properties>\n";
		$xml .= "\t\t<title>".$chartTitle."</title>\n";
		$xml .= "\t\t<subtitle>".$chartSubTitle."</subtitle>\n";
		
		if ($chartType == "stack")
			$xml .= "\t\t<type>stacked group by chart</type>\n";
		else if ($chartType == "horizontal")
			$xml .= "\t\t<type>horizontal group by chart</type>\n";
		else if ($chartType == "line")
			$xml .= "\t\t<type>line chart</type>\n";
			
		$xml .= "\t\t<legend>on</legend>\n";
		$xml .= "\t\t<labels>value</labels>\n";
		$xml .= "\t</properties>\n";
		
		$xml .= "\t<data>\n";
		
		
		$avoidFormatting = (strpos($chartFunction, "COUNT") !== false);
	
		foreach ($chartLegends as $key=>$chartLegend){
			
			$xml .= "\t\t<group>\n";
			$xml .= "\t\t\t<title>".$chartLegend."</title>\n";
			
			if (max($subTotalsArray) >= 1000000){
				$xml .= "\t\t\t<value>".($chartValues[$key]['totalValue']/1000000)."</value>\n";
				$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number($chartValues[$key]['totalValue']/1000000)."M</label>\n" : "\t\t\t<label>".($chartValues[$key]['totalValue']/1000000)."M</label>\n";
			} else if (max($subTotalsArray) >= 1000){
				$xml .= "\t\t\t<value>".($chartValues[$key]['totalValue']/1000)."</value>\n";
				$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number($chartValues[$key]['totalValue']/1000)."K</label>\n" : "\t\t\t<label>".($chartValues[$key]['totalValue']/1000)."K</label>\n";
			} else {
				$xml .= "\t\t\t<value>".$chartValues[$key]['totalValue']."</value>\n";
				$xml .= ($avoidFormatting === false) ? "\t\t\t<label>".format_number(floor($chartValues[$key]['totalValue'] * 100) / 100)."</label>\n" : "\t\t\t<label>".(floor($chartValues[$key]['totalValue'] * 100) / 100)."</label>\n";
			}
	
			
			$xml .= "\t\t\t<subgroups>\n";
	
			//Generate empty groups
			$groupValues = Array();
			
			foreach ($groups as $keyG=>$group) {
				
				$currentValues = null;
				foreach ($chartValues[$key]['values'] as $groupValue) {
					if ($groupValue['group'] == $group) {
						$currentValues = $groupValue;
						break;
					}
				}
			
				if ($currentValues != null)
					$groupValues[$keyG] = $currentValues;
				else
					$groupValues[$keyG] = Array('group' => $group, 'value' => '0');
					
			}
			
			
			foreach ($groupValues as $groupValue) {
				
				$xml .= "\t\t\t\t<group>\n";
	
				$xml .= "\t\t\t\t\t<title>".$groupValue['group']."</title>\n";
		
				if (max($subTotalsArray) >= 1000000){
					$xml .= "\t\t\t\t\t<value>".($groupValue['value']/1000000)."</value>\n";
					$xml .= ($avoidFormatting === false) ? "\t\t\t\t\t<label>".format_number($groupValue['value']/1000000)."M</label>\n" : "\t\t\t\t\t<label>".($groupValue['value']/1000000)."M</label>\n";
				} else if (max($subTotalsArray) >= 1000){
					$xml .= "\t\t\t\t\t<value>".($groupValue['value']/1000)."</value>\n";
					$xml .= ($avoidFormatting === false) ? "\t\t\t\t\t<label>".format_number($groupValue['value']/1000)."K</label>\n" : "\t\t\t\t\t<label>".($groupValue['value']/1000)."K</label>\n";
				} else {
					$xml .= "\t\t\t\t\t<value>".$groupValue['value']."</value>\n";
					$xml .= ($avoidFormatting === false) ? "\t\t\t\t\t<label>".format_number(floor($groupValue['value'] * 100) / 100)."</label>\n" : "\t\t\t\t\t<label>".(floor($groupValue['value'] * 100) / 100)."</label>\n";
				}
	
				//$xml .= "\t\t\t<link>index.php?module=".$reportModule."&action=index&query=true&searchFormTab=advanced_search</link>";
	
				$xml .= "\t\t\t\t</group>\n";
				
			}
			
			$xml .= "\t\t\t</subgroups>\n";
			$xml .= "\t\t</group>\n";
			
		}
		
		$xml .= "\t</data>\n";
		
		$xml .= "\t<yAxis>\n";
		$xml .= "\t\t<yMin>0</yMin>\n";
			
	
		if (max($subTotalsArray) >= 1000000)
			$truncatedMaxValue = ceil((max($subTotalsArray))/1000000)+2;
		else if (max($subTotalsArray) >= 1000)
			$truncatedMaxValue = ceil((max($subTotalsArray))/1000)+2;
		else
			$truncatedMaxValue = ceil(max($subTotalsArray))+2;
		
		$roundedDigits = strlen((string)(ceil($truncatedMaxValue)))-1;
		$yMax = round($truncatedMaxValue, $roundedDigits*(-1));
		$yMax = ($yMax < $truncatedMaxValue) ? $yMax+((pow(10, $roundedDigits))/2) : $yMax; 
	
	
		$yStep = ceil($yMax/5);
		
		while($yMax >= $truncatedMaxValue)
			$yMax -= $yStep;
		$yMax += $yStep;
	
		$xml .= "\t\t<yMax>".$yMax."</yMax>";
		$xml .= "\t\t<yStep>".$yStep."</yStep>";
		
		$xml .= "\t\t<yLog>1</yLog>\n";
		$xml .= "\t</yAxis>\n";
		
		$xml .= "</sugarcharts>";
		
		
		$xml = chr(255).chr(254).mb_convert_encoding($xml, 'UTF-16LE', 'UTF-8'); 
		fputs($descriptor, $xml);
		fclose($descriptor);
		
		return $xmlCompletePath;
		
	}
	
	
	
	//***********************//
	//******NVD3 Charts******//
	//***********************//
	static public function generateNvd3NormalChartData($reportId, $chartTypes, $chartYAxisLabels, $chartYAxisSides, $chartConfigs, $prefixChart, $reportModule, $chartTitle, $chartLegends, $chartValues, $numGroups, $overridedName = null, $chartFunction = '0', $isStoredReport = false){
		
		global $sugar_config, $mod_strings;

		$maxChartValue = self::getNvd3NormalMaxSubTotal($chartValues);
		$hasSubCharts = (!empty($chartValues['subCharts'])); 
		
		//**************************//
		//***Variables Definition***//
		//**************************//
		$tmpFilesDir = ($isStoredReport) ? "modules/asol_Reports/tmpReportFiles/storedReports/" : "modules/asol_Reports/tmpReportFiles/";	
		$indexKey = str_replace("-", "", $reportId)."_".$prefixChart;
		$prefixChart = str_replace(" ", "_", $prefixChart);
		$jsName = $prefixChart."_".dechex(time()).dechex(rand(0,999999)).".js";
		$jsCompletePath = (empty($overridedName)) ? $tmpFilesDir.$jsName : $overridedName;
		//**************************//
		//***Variables Definition***//
		//**************************//
		
		
		$descriptor = fopen($jsCompletePath, "w");
		
		//***********************************//
		//***Generate JavaScript CodeLines***//
		//***********************************//
		$avoidFormatting = (strpos($chartFunction, "COUNT") !== false);
		
		$chartD3Format = self::getNvd3ChartNumberFormat($maxChartValue, $avoidFormatting);
		$chartSubTitle = self::getNvd3ChartSubtitle($maxChartValue);
		
		$nvd3ColorPalete = self::getNvd3ColorPalete($indexKey, $chartConfigs);
		$nvd3DataLabelsJs = self::getNvd3DataLabelsJs($indexKey, $chartLegends);
		
		if (!$hasSubCharts) {
			
			$nvd3ChartDataJs = self::getNvd3NormalDataJs($chartTypes[0], $chartYAxisLabels[0], $indexKey, $nvd3ColorPalete, $chartLegends, $chartValues, $maxChartValue);
			$chartType = $chartTypes[0];
			
		} else {
			
			$mainChart = $chartValues['mainChart'];
			$dataGroups[0][$chartYAxisLabels[0]] = array();
			
			foreach ($chartLegends as $keyLegend=>$legendVal) {
				$dataGroups[0][$chartYAxisLabels[0]][$legendVal] = $mainChart[$keyLegend];
			}
			
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraDataGroupsParams = array(
				'dataGroups' => $dataGroups,
				'subCharts' => $chartValues['subCharts'],
				'chartYAxisLabels' => $chartYAxisLabels,
				'chartLegends' => $chartLegends,
			);

			$dataGroups = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsDataGrouping", $extraDataGroupsParams);
			
			$extraMultiChartParams = array(
				'indexKey' => $indexKey,
				'chartTypes' => $chartTypes,
				'chartYAxisLabel' => $chartYAxisLabels[0],
				'chartYAxisSides' => $chartYAxisSides,
				'chartLegends' => $chartLegends,
				'nvd3ColorPalete' => $nvd3ColorPalete,
				'dataGroups' => $dataGroups,
				'maxSubTotals' => $maxChartValue,
				'massiveData' => false
			);
				
			$nvd3ChartDataJs = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getNvd3MultiDataJs", $extraMultiChartParams);
			$chartType = 'multiple';	
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			
		}
		
		$nvd3ModelChartJs = self::getNvd3ModelChartJs($chartType, $indexKey);
		
		if ($hasSubCharts) {
			$nvd3ChartFormatJs = '';
			$nvd3AxisFormatJs = self::getNvd3AxisFormatJs($indexKey, true, true, $chartD3Format, $maxChartValue);
		} else {
			$nvd3ChartFormatJs = (in_array($chartType, array('stack', 'horizontal', 'line', 'scatter', 'area', 'bubble'))) ? '' : self::getNvd3SingleChartFormatJs($maxChartValue, $chartD3Format);
			$nvd3AxisFormatJs = (in_array($chartType, array('bar', 'stack', 'horizontal', 'line', 'scatter', 'area', 'bubble'))) ? self::getNvd3AxisFormatJs($indexKey, false, true, $chartD3Format, $maxChartValue) : '';
		}
		$generatedNvd3ChartJs = self::generateNvd3ChartJs($indexKey, 800);
		
		$generatedNvd3TitleSubtitleJs = self::generateNvd3TitleSubtitleJs($indexKey, $chartTitle, $chartSubTitle);
		//***********************************//
		//***Generate JavaScript CodeLines***//
		//***********************************//
		
		
		$jsData = "
			try {
			
				".$nvd3DataLabelsJs."
				".$nvd3ChartDataJs."
				
				nv.addGraph(function() {
			
					".$nvd3ModelChartJs."
					".$nvd3ChartFormatJs."
					".$nvd3AxisFormatJs."		
					".$generatedNvd3ChartJs."
				
				});
				
				".$generatedNvd3TitleSubtitleJs."
		
			} catch(e) { 
				console.error(e); 
			}";
		
		fputs($descriptor, $jsData);
		fclose($descriptor);
		
		return $jsCompletePath;
		
	}
	
	static public function generateNvd3StackedChartData($reportId, $chartTypes, $chartYAxisLabels, $chartYAxisSides, $chartConfigs, $prefixChart, $reportModule, $chartTitle, $chartLegends, $chartValues, $numGroups, $overridedName = null, $chartFunction = '0', $massiveData = false, $isGroupedReport = true, $isStoredReport = false){

		global $sugar_config, $mod_strings;

		$hasSubCharts = (!empty($chartValues['subCharts']));
		
		$dataGroupsZ = null;
		
		
		//**************************//
		//***Variables Definition***//
		//**************************//
		$tmpFilesDir = ($isStoredReport) ? "modules/asol_Reports/tmpReportFiles/storedReports/" : "modules/asol_Reports/tmpReportFiles/";
		$indexKey = str_replace("-", "", $reportId)."_".$prefixChart;
		$prefixChart = str_replace(" ", "_", $prefixChart);
		$jsName = $prefixChart."_".dechex(time()).dechex(rand(0,999999)).".js";
		$jsCompletePath = (empty($overridedName)) ? $tmpFilesDir.$jsName : $overridedName;
		//**************************//
		//***Variables Definition***//
		//**************************//
		
		
		$descriptor = fopen($jsCompletePath, "w");
		
		//***********************************//
		//***Generate JavaScript CodeLines***//
		//***********************************//
		$avoidFormatting = (strpos($chartFunction, "COUNT") !== false);
		$isCumulativeChart = in_array($chartTypes[0], array('stack', 'horizontal', 'area'));
		
		$maxSubTotal = self::getNvd3StackedMaxSubTotal($chartValues, $isCumulativeChart);
		
		$chartD3Format = self::getNvd3ChartNumberFormat($maxSubTotal, $avoidFormatting);
		$chartSubTitle = self::getNvd3ChartSubtitle($maxSubTotal);
		
		$dataGroups = self::generateNvd3DataGroupingValues($chartLegends, $chartYAxisLabels, $chartValues, $isGroupedReport, $massiveData);
		$nvd3ColorPalete = self::getNvd3ColorPalete($indexKey, $chartConfigs);
		$nvd3DataLabelsJs = self::getNvd3DataLabelsJs($indexKey, $chartLegends);
		
		if (!$hasSubCharts) {
			
			if (!empty($chartValues['zChart'])) {
				$dataGroupsZ = self::generateNvd3DataGroupingValues($chartLegends, $chartYAxisLabels, array( 'mainChart' => $chartValues['zChart'] ), $isGroupedReport, $massiveData);
			}
				
			$nvd3ChartDataJs = self::getNvd3StackedDataJs($indexKey, $chartLegends, $chartYAxisLabels[0], $nvd3ColorPalete, $dataGroups, $dataGroupsZ, $maxSubTotal, $massiveData);			
			$chartType = $chartTypes[0];
			
		} else {
			
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'indexKey' => $indexKey,
				'chartTypes' => $chartTypes,
				'chartYAxisLabel' => $chartYAxisLabels[0],
				'chartYAxisSides' => $chartYAxisSides,
				'chartLegends' => $chartLegends,
				'nvd3ColorPalete' => $nvd3ColorPalete,
				'dataGroups' => $dataGroups,
				'maxSubTotals' => $maxSubTotal,
				'massiveData' => $massiveData
			);
				
			$nvd3ChartDataJs = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getNvd3MultiDataJs", $extraParams);
			$chartType = 'multiple';	
			//***********************//
			//***AlineaSol Premium***//
			//***********************//

		}
			
		$nvd3ModelChartJs = self::getNvd3ModelChartJs($chartType, $indexKey);
		$nvd3AxisFormatJs = self::getNvd3AxisFormatJs($indexKey, $hasSubCharts, true, $chartD3Format, $maxSubTotal);
		$generatedNvd3ChartJs = self::generateNvd3ChartJs($indexKey, 500);
		
		$generatedNvd3TitleSubtitleJs = self::generateNvd3TitleSubtitleJs($indexKey, $chartTitle, $chartSubTitle);
		//***********************************//
		//***Generate JavaScript CodeLines***//
		//***********************************//
		
		$jsData = "
			try {
			
				".$nvd3DataLabelsJs."
				".$nvd3ChartDataJs."
				
				nv.addGraph(function() {
				
					".$nvd3ModelChartJs."
					".$nvd3AxisFormatJs."
					".$generatedNvd3ChartJs."
					
				});
				
				".$generatedNvd3TitleSubtitleJs."
				
			} catch(e) { 
				console.error(e); 
			}
				
		";
		
		fputs($descriptor, $jsData);
		fclose($descriptor);
		
		return $jsCompletePath;
			
	}
	
	static private function getNvd3NormalMaxSubTotal($chartValues) {
		
		$mainChart = $chartValues['mainChart'];

		$mainChartTotalsArray = Array();
		foreach ($mainChart as $mainValue) {		
			$mainChartTotalsArray[] = abs($mainValue);
		}
		
		//***********************//
		//***AlineaSol Premium***//
		//***********************//
		$extraParams = array(
			'subCharts' => $chartValues['subCharts']
		);

		$subChartsTotalsArray = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsTotalsArray", $extraParams);
		$mainChartTotalsArray = ($subChartsTotalsArray !== false) ? array_merge($mainChartTotalsArray, $subChartsTotalsArray) : $mainChartTotalsArray;
		//***********************//
		//***AlineaSol Premium***//
		//***********************//

		return max($mainChartTotalsArray);
		
	}
	
	static private function getNvd3StackedMaxSubTotal($chartValues, $isCumulativeChart = false) {
		
		$mainChart = $chartValues['mainChart'];

		$mainChartTotalsArray = Array();
		foreach ($mainChart as $mainValue) {
			if ($isCumulativeChart) {
				$mainChartTotalsArray[] = abs($mainValue['totalValue']);
			} else {
				foreach ($mainValue['values'] as $singleValue) {
					$mainChartTotalsArray[] = abs($singleValue['value']);
				}
			}
		}

		//***********************//
		//***AlineaSol Premium***//
		//***********************//		
		$extraParams = array(
			'subCharts' => $chartValues['subCharts'],
			'isCumulativeChart' => $isCumulativeChart
		);

		$subChartsTotalsArray = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsDetailTotalsArray", $extraParams);
		$mainChartTotalsArray = ($subChartsTotalsArray !== false) ? array_merge($mainChartTotalsArray, $subChartsTotalsArray) : $mainChartTotalsArray;
		//***********************//
		//***AlineaSol Premium***//
		//***********************//

		
		return max($mainChartTotalsArray);
		
	}
	
	static private function generateNvd3DataGroupingValues($chartLegends, $chartYAxisLabels, $chartValues, $isGroupedReport, $massiveData) {

		$dataGroups = array();
		
		$mainChart = $chartValues['mainChart'];
		$hasSubCharts = (count($chartValues['subCharts']) > 0);
				
		if (!$massiveData) {

			foreach ($mainChart as $key=>$chartValue) {
				foreach ($chartValue['values'] as $values) {
					if ($hasSubCharts) {
						$group = ($isGroupedReport) ? $chartYAxisLabels[0].' ('.$values['group'].')' : $chartYAxisLabels[0];
					} else {
						$group = $values['group'];
					}
					$dataGroups[0][$group][$chartLegends[$key]] = $values['value'];
				}
			}

			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'subCharts' => $chartValues['subCharts'],
				'chartLegends' => $chartLegends,
				'chartYAxisLabels' => $chartYAxisLabels,
				'dataGroups' => $dataGroups,
				'isGroupedReport' => $isGroupedReport
			);

			$combineChartsResult = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getSubChartsDetailDataGrouping", $extraParams);
			$dataGroups = (!$combineChartsResult) ? $dataGroups : $combineChartsResult;
			//***********************//
			//***AlineaSol Premium***//
			//***********************//

		} else {

			foreach ($mainChart as $key=>$chartValue) {
				$dataGroups[0][$chartLegends[$key]] = $chartValue['values'];
			}
			
		}

		return $dataGroups;
		
	}

	static private function getNvd3ChartNumberFormat($maxValue, $avoidFormatting) {
		
		if ($maxValue >= 1000000) {
			$chartD3Format = ",.2f";
		} else if ($maxValue >= 1000) {
			$chartD3Format = ",.2f";
		} else {
			$chartD3Format = ($avoidFormatting) ? ",.0f" : ",.2f";
		}
		
		return $chartD3Format;
		
	}
	
	static private function getNvd3ChartSubtitle($maxValue) {

		if ($maxValue >= 1000000) {
			$chartSubTitle = " (".translate('LBL_REPORT_CHARTS_VALUE_SIZE_M', 'asol_Reports').")";
		} else if ($maxValue >= 1000) {
			$chartSubTitle = " (".translate('LBL_REPORT_CHARTS_VALUE_SIZE_K', 'asol_Reports').")";
		} else {
			$chartSubTitle = "";
		}
		
		return $chartSubTitle;
		
	}
	
	static private function getNvd3ColorPalete($indexKey, $chartConfigs) {
		
		global $sugar_config;
		
		$defaultColorPalette = array("#8c2b2b", "#468c2b", "#2b5d8c", "#cd5200", "#e6bf00", "#7f3acd", "#00a9b8", "#572323", "#004d00", "#000087", "#e48d30", "#9fba09", "#560066", "#009f92", "#b36262", "#38795c", "#3D3D99", "#99623d", "#998a3d", "#994e78", "#3d6899", "#CC0000", "#00CC00", "#0000CC", "#cc5200", "#ccaa00", "#6600cc", "#005fcc");
		
		$mainConfig = $chartConfigs['mainConfig'];
		$subConfigs = $chartConfigs['subConfigs'];
		
		$colorMainPalete = null;

		if (isset($mainConfig['selectedPalette'])) {
			if ($mainConfig['selectedPalette'] === '-1') {
				$colorMainPalete = $mainConfig['colorPalette'];
			} else if (isset($sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'])) {
				$colorMainPalete = $sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'][$mainConfig['selectedPalette']]['colorPalette'];
			}
			$colorMainPalete = array_map(create_function('$color', 'return "#".$color;'), $colorMainPalete);
		}
		$colorPalete[0] = ($colorMainPalete !== null) ? $colorMainPalete : $defaultColorPalette;
		
		foreach ($subConfigs as $subKey=>$subConfig) {
			
			$colorSubPalete = null;

			if (isset($subConfig['selectedPalette'])) {
				if ($subConfig['selectedPalette'] === '-1') {
					$colorSubPalete = $subConfig['colorPalette'];
				} else if (isset($sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'])) {
					$colorSubPalete = $sugar_config['asolReportsNvd3ChartPredefinedColorPaletteSchemas'][$subConfig['selectedPalette']]['colorPalette'];
				}
				$colorSubPalete = array_map(create_function('$color', 'return "#".$color;'), $colorSubPalete);
			}
			$colorPalete[$subKey+1] = ($colorSubPalete !== null) ? $colorSubPalete : $defaultColorPalette;
				
		}
		
		return $colorPalete;
		
	}
	
	static private function getNvd3DataLabelsJs($indexKey, $chartLegends) {
		
		$jsData = 'var dataLabels_'.$indexKey.' = [';
		 	
	 	foreach ($chartLegends as $keyLegend=>$legendVal)
	 		$jsData .= '"'.$legendVal.'",';
	 		
	 	$jsData = substr($jsData, 0, -1).'];';
		
	 	return $jsData;
	 	
	}
		
	static private function getNvd3NormalDataJs($chartType, $chartYAxisLabel, $indexKey, $colorPalete, $chartLegends, $chartValues, $maxValue) {
		
		$mainChart = $chartValues['mainChart'];
		$hasSubCharts = (!empty($chartValues['subCharts']));
		
		switch ($chartType) {
			
			case "pie":
				$jsData = 'var asolColorPalete_'.$indexKey.' = ["'.implode('", "', $colorPalete[0]).'"];'; 
				$jsData .= 'var data_'.$indexKey.' = [';
			
				$legendIndex = 0;
				foreach ($chartLegends as $keyLegend=>$legendVal) {
					
					$chartValue = (!empty($mainChart[$keyLegend])) ? $mainChart[$keyLegend] : "0";
					
					if ($maxValue >= 1000000)
						$jsData .= '{key:'.$keyLegend.',y:'.($chartValue/1000000).'},';
					else if ($maxValue >= 1000)
						$jsData .= '{key:'.$keyLegend.',y:'.($chartValue/1000).'},';
					else
						$jsData .= '{key:'.$keyLegend.',y:'.$chartValue.'},';
						
					$legendIndex++;
				}
				
				$jsData = substr($jsData, 0, -1);
				$jsData .= '];';
				break;
				
			case "bar":
				$mainPalete = $colorPalete[0];
				$totalColors = count($mainPalete);
				
				$jsData = 'var data_'.$indexKey.' = [{values:[';
				
				$legendIndex = 0;
				foreach ($chartLegends as $keyLegend=>$legendVal) {
					
					$chartValue = (!empty($mainChart[$keyLegend])) ? $mainChart[$keyLegend] : "0";
					
					if ($maxValue >= 1000000)
						$jsData .= '{"label":'.$keyLegend.',"value":'.($chartValue/1000000).',"color":"'.$mainPalete[($legendIndex % $totalColors)].'"},';
					else if ($maxValue >= 1000)
						$jsData .= '{"label":'.$keyLegend.',"value":'.($chartValue/1000).',"color":"'.$mainPalete[($legendIndex % $totalColors)].'"},';
					else
						$jsData .= '{"label":'.$keyLegend.',"value":'.$chartValue.',"color":"'.$mainPalete[($legendIndex % $totalColors)].'"},';
						
					$legendIndex++;
				}
				
				$jsData = substr($jsData, 0, -1);
				$jsData .= ']}];';
				break;
			
			case "stack":
			case "horizontal":
			case "line":
			case "scatter":
			case "area":
			case "bubble":
				$dataGroups[0][$chartYAxisLabel] = array();
				foreach ($chartLegends as $keyLegend=>$legendVal) {
					$dataGroups[0][$chartYAxisLabel][$legendVal] = $mainChart[$keyLegend];
				}
				
				if (!empty($chartValues['zChart'])) {
					$dataGroupsZ[0][$chartYAxisLabel] = array();
					foreach ($chartLegends as $keyLegend=>$legendVal) {
						$dataGroupsZ[0][$chartYAxisLabel][$legendVal] = $chartValues['zChart'][$keyLegend];
					}
				}
				
				$jsData = self::getNvd3StackedDataJs($indexKey, $chartLegends, $chartYAxisLabel, $colorPalete, $dataGroups, $dataGroupsZ, $maxValue);
				break;
				
		}
		
		return $jsData;
		
	}
	
	
	static private function getNvd3StackedDataJs($indexKey, $chartLegends, $chartYAxisLabel, $colorPalete, $dataGroups, $dataGroupsZ, $maxSubTotals, $massiveData = false) {
		
		$mainPalete = $colorPalete[0];
		$totalColors = count($mainPalete);
		
		$jsData = 'var data_'.$indexKey.' = [';
		
		if (!$massiveData) {
		
			$groupIndex = 0;
			foreach ($dataGroups[0] as $group=>$dataGroup) {
		
				$jsData .= '{"values":[';
				
				foreach ($chartLegends as $legendKey=>$legendVal) {
					
					//***********************//
					//***AlineaSol Premium***//
					//***********************//
					$extraParams = array(
						'dataGroupZ' => $dataGroupsZ[0],
						'group' => $group,
						'legendVal' => $legendVal
					);
						
					$bubbleReportExtendedData = asol_ReportsUtils::managePremiumFeature("bubbleReportCharts", "reportFunctions.php", "getBubbleReportExtendedData", $extraParams);
					
					$extendedData = ($bubbleReportExtendedData !== false ? $bubbleReportExtendedData['extendedData'] : '');
					$extendedEmptyData = ($bubbleReportExtendedData !== false ? $bubbleReportExtendedData['extendedEmptyData'] : '');
					//***********************//
					//***AlineaSol Premium***//
					//***********************//
					
					if ($maxSubTotals >= 1000000)
						$jsData .= (isset($dataGroup[$legendVal])) ? '{"x":'.$legendKey.',"y":'.($dataGroup[$legendVal]/1000000).$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
					else if ($maxSubTotals >= 1000)
						$jsData .= (isset($dataGroup[$legendVal])) ? '{"x":'.$legendKey.',"y":'.($dataGroup[$legendVal]/1000).$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
					else
						$jsData .= (isset($dataGroup[$legendVal])) ? '{"x":'.$legendKey.',"y":'.$dataGroup[$legendVal].$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
					
				}
				
				$jsData = substr($jsData, 0, -1);				
				$jsData .= '],"key":"'.$group.'","color":"'.$mainPalete[($groupIndex % $totalColors)].'"},';

				$groupIndex++;
			}
				
		} else {
			
			$jsData .= '{"values":[';	
			
			foreach ($dataGroups[0] as $group=>$dataValues) {
				
				$legendKey = array_search($group, $chartLegends);
				
				foreach ($dataValues as $dataKey=>$dataValue) {
					
					//***********************//
					//***AlineaSol Premium***//
					//***********************//
					$extraParams = array(
						'dataGroupZ' => $dataGroupsZ[0],
						'group' => $group,
						'legendVal' => $dataKey
					);
						
					$bubbleReportExtendedData = asol_ReportsUtils::managePremiumFeature("bubbleReportCharts", "reportFunctions.php", "getBubbleReportExtendedData", $extraParams);
					
					$extendedData = ($bubbleReportExtendedData !== false ? $bubbleReportExtendedData['extendedData'] : '');
					$extendedEmptyData = ($bubbleReportExtendedData !== false ? $bubbleReportExtendedData['extendedEmptyData'] : '');
					//***********************//
					//***AlineaSol Premium***//
					//***********************//
					
					if ($maxSubTotals >= 1000000)
						$jsData .= (isset($dataValue)) ? '{"x":'.$legendKey.',"y":'.($dataValue/1000000).$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
					else if ($maxSubTotals >= 1000)
						$jsData .= (isset($dataValue)) ? '{"x":'.$legendKey.',"y":'.($dataValue/1000).$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
					else
						$jsData .= (isset($dataValue)) ? '{"x":'.$legendKey.',"y":'.$dataValue.$extendedData.'},' : '{"x":"'.$legendKey.'","y":0'.$extendedEmptyData.'},';
				}
				
			}
					
			$jsData = substr($jsData, 0, -1);
			$jsData .= '],"key":"'.$chartYAxisLabel.'","color":"'.$mainPalete[0].'"},';
				
		}
				
		
		$jsData = substr($jsData, 0, -1);
		
		$jsData .= '];';
		
		return $jsData;
		
	}	
	
	private static function getNvd3ModelChartJs($chartType, $indexKey = null) {
		
		switch ($chartType) {
			
			case "pie":
				$jsData = 'var chart_'.$indexKey.' = nv.models.pieChart().x(function(d) { return dataLabels_'.$indexKey.'[d.key] }).y(function(d) { return d.y }).values(function(d) { return d }).tooltips(true).color(d3.scale.ordinal().range(asolColorPalete_'.$indexKey.').range()).donut(false)';
				break;
			case "bar":
				$jsData = 'var chart_'.$indexKey.' = nv.models.discreteBarChart().margin({top: 15, right: 50, bottom: 50, left: 60}).x(function(d) { return d.label }).y(function(d) { return d.value }).staggerLabels(true).tooltips(true).showValues(true)';
				break;
			case "stack":
				$jsData = 'var chart_'.$indexKey.' = nv.models.multiBarChart().margin({top: 30, right: 30, bottom: 80, left: 60}).stacked(true).reduceXTicks(false).tooltips(true).showControls(true);';
				break;
			case "scatter":
				$jsData = 'var chart_'.$indexKey.' = nv.models.scatterChart().showDistX(true).showDistY(true).margin({top: 30, right: 50, bottom: 70, left: 75}).tooltips(true).showControls(false);';
				break;
			case "line":
				$jsData = 'var chart_'.$indexKey.' = nv.models.lineChart().margin({top: 30, right: 50, bottom: 70, left: 60}).x(function(d) { return d.x }).y(function(d) { return d.y }).tooltips(true);';
				break;
			case "horizontal":
				$jsData = 'var chart_'.$indexKey.' = nv.models.multiBarHorizontalChart().margin({top: 30, right: 30, bottom: 30, left: 80}).stacked(true).showValues(true).x(function(d) { return d.x }).y(function(d) { return d.y }).tooltips(true).showControls(true);';
				break;
			case "area":
				$jsData = 'var chart_'.$indexKey.' = nv.models.stackedAreaChart().margin({top: 30, right: 50, bottom: 80, left: 60}).tooltips(true).showControls(true);';
				break;
			case "bubble":
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
				$jsData = asol_ReportsUtils::managePremiumFeature("bubbleReportCharts", "reportFunctions.php", "getBubbleChartModelJs", array('indexKey' => $indexKey));
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
				break;
			case "multiple":
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
				$jsData = asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getMultiChartModelJs", array('indexKey' => $indexKey));
				//***********************//
				//***AlineaSol Premium***//
				//***********************//
				break;
			 
		}
		
		return $jsData;
		
	}
	
	private static function getNvd3SingleChartFormatJs($maxValue, $chartD3Format) {
		
		if ($maxValue >= 1000000)
			$jsData = '.valueFormat(function(d) { return (d3.format("'.$chartD3Format.'")(d))+"M"; });';
		else if ($maxValue >= 1000)
			$jsData = '.valueFormat(function(d) { return (d3.format("'.$chartD3Format.'")(d))+"K"; });';
		else
			$jsData = '.valueFormat(function(d) { return (d3.format("'.$chartD3Format.'")(d)) });';
		
		return $jsData;
			
	}
	
	private static function getNvd3AxisFormatJs($indexKey, $hasSubCharts, $rotateLabels, $chartD3Format, $maxValue) {
		
		if ($rotateLabels)
			$jsData = 'chart_'.$indexKey.'.xAxis.rotateLabels(45).tickFormat(function(d) { return dataLabels_'.$indexKey.'[d]; });';
		else
			$jsData = 'chart_'.$indexKey.'.xAxis.tickFormat(function(d) { return dataLabels_'.$indexKey.'[d]; });';
			
		if (!$hasSubCharts) {
			
			if ($maxValue >= 1000000)
				$jsData .= 'chart_'.$indexKey.'.yAxis.tickFormat(function(d) { return (d3.format("'.$chartD3Format.'")(d))+"M"; });';
			else if ($maxValue >= 1000)
				$jsData .= 'chart_'.$indexKey.'.yAxis.tickFormat(function(d) { return (d3.format("'.$chartD3Format.'")(d))+"K"; });';
			else
				$jsData .= 'chart_'.$indexKey.'.yAxis.tickFormat(d3.format("'.$chartD3Format.'"));';
			
		} else {
			
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			$extraParams = array(
				'indexKey' => $indexKey,
				'maxValue' => $maxValue,
				'chartD3Format' => $chartD3Format
			);
				
			$jsData .= asol_ReportsUtils::managePremiumFeature("combineReportCharts", "reportFunctions.php", "getNvd3MultiAxisFormatJs", $extraParams);
			//***********************//
			//***AlineaSol Premium***//
			//***********************//
			
		}
			
		return $jsData;
			
	}
	
	private static function generateNvd3ChartJs($indexKey, $transitionDuration) {
		
		$jsData = 'd3.select("#ASOLnvd3_'.$indexKey.' svg").datum(data_'.$indexKey.').transition().duration('.$transitionDuration.').call(chart_'.$indexKey.');';
		$jsData .= 'nv.utils.windowResize(chart_'.$indexKey.'.update);';
		
		$jsData .= 'return chart_'.$indexKey.';';
		
		return $jsData;
		
	}
	
	private static function generateNvd3TitleSubtitleJs($indexKey, $chartTitle, $chartSubTitle) {
		
		return '$("#ASOLnvd3Title_'.$indexKey.'").html("'.$chartTitle.'<span style=\"font-weight: normal;\">'.$chartSubTitle.'</span>");';
		
	}
	
}

?>