<?php

error_reporting(1); //E_ERROR


function displayReport($reportId, $field_sort, $sort_direction, $page_number = '', $isDashlet = false, $dashletId = '', $dashletWidth = '', $getLibraries = true, $returnHtml = false, $contextDomainId = null) {
	
	global $current_user, $timedate, $mod_strings, $app_strings, $theme, $db, $app_list_strings, $beanList, $beanFiles, $current_language, $sugar_config;

	require_once('modules/asol_Reports/include_basic/reportsUtils.php');
	require_once('modules/asol_Reports/include_basic/ReportChart.php');
	require_once('modules/asol_Reports/ReportsDashletChart.php');
	require_once('modules/asol_Reports/include_basic/generateReportsFunctions.php');


	//*************************************//
	//********Manage Report Domain*********//
	//*************************************//
	$domainsQuery = $db->query("SELECT * FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
	$isDomainsInstalled = ($domainsQuery->num_rows > 0);
			
	
	//****************************//
	//****Instance Report Bean****//
	//****************************//
	$focus = BeanFactory::getBean('asol_Reports', $reportId);
	
	
	//****************************//
	//****Variables Definition****//
	//****************************//
	$hasCurlRequestEnabled = (isset($sugar_config["asolReportsCurlRequestUrl"]) ? true : false);
	$hasNoPagination = ((isset($sugar_config["asolReportsAvoidReportsPagination"])) && ($sugar_config["asolReportsAvoidReportsPagination"] == true));
	$dispatcherMaxRequests = (isset($sugar_config['asolReportsDispatcherMaxRequests'])) ? $sugar_config['asolReportsDispatcherMaxRequests'] : 0;
	
	$reorderDetailGroups = true;
	
	
	//****************************//
	//*****module Strings FIX*****//
	//****************************//
	$mod_strings['MSG_REPORT_SEND_EMAIL_ALERT'] = str_replace("&#039", "\&#039", str_replace("'", "\&#039", translate('MSG_REPORT_SEND_EMAIL_ALERT', 'asol_Reports')));
	
	
	//***********************************************//
	//*****Get module & tables association array*****//
	//***********************************************//
	//Get an array of table names for admin accesible modules
	$modulesTables = asol_ReportsGenerationFunctions::getModuleTablesAssociation($focus->created_by);
		
	
	//****************************************//
	//****Check if External App is defined****//
	//****************************************//
	$reportScheduledTypeArray = explode('${dollar}', $focus->report_scheduled_type);
	$reportScheduledAppArray = explode('${pipe}', $reportScheduledTypeArray[1]);
	$hasExternalApp = (!empty($reportScheduledAppArray[1]));
	
	
	
	//****************************************//
	//****Clean DataBase Report Dispatcher****//
	//****************************************//
	asol_ReportsGenerationFunctions::cleanDataBaseReportDispatcher();
	
	
	if ((strpos($focus->report_type, 'stored') === 0) && ($_REQUEST['entryPoint'] != 'viewReport')) { // Stored Report!

		//****************************************//
		//*********Get Stored Report Data*********//
		//****************************************//
		$reportType = explode(':', $focus->report_type);
		echo asol_ReportsGenerationFunctions::getStoredReportData($reportType[1], $reportId, $isDashlet, $dashletId, $dashletWidth, $focus->report_charts);
		
	} else { // Anything else Report!
	
		if ((in_array($_REQUEST['entryPoint'], array('reloadReport', 'viewReport'))) || (!$hasCurlRequestEnabled)) {
	
			//*********************************//
			//****Check Access To Reports******//
			//*********************************//
			if(!ACLController::checkAccess('asol_Reports', 'view', true)) {
				die("<font color='red'>".$app_strings["LBL_EMAIL_DELETE_ERROR_DESC"]."</font>");
			}
					
			//*************************************************//
			//******Requiring FilesGet External Parameters*****//
			//*************************************************//
			require_once("include/SugarPHPMailer.php");
			require_once('modules/asol_Reports/include_basic/ReportExcel.php');
			require_once('modules/asol_Reports/include_basic/ReportFile.php');
			require_once('modules/asol_Reports/include_basic/ReportChart.php');
			require_once('modules/asol_Reports/include_basic/generateQuery.php');
			
			//*****************************//
			//****Variable Definition******//
			//*****************************//
			$return_action = (isset($_REQUEST['return_action'])) ? $_REQUEST['return_action'] : "";
			
			$report_data['record'] = $focus->id;
			$report_data['report_name'] = $focus->name;
			$report_data['report_module'] = $focus->report_module;
			$report_data['audited_report'] = $focus->audited_report;
			$report_data['description'] = $focus->description;
			$report_data['assigned_user_id'] = $focus->assigned_user_id;
			$report_data['created_by'] = $focus->created_by;
			$report_data['report_attachment_format'] = $focus->report_attachment_format;
			$report_data['report_charts'] = $focus->report_charts;
			$report_data['report_charts_engine'] = $focus->report_charts_engine;
			$report_data['scheduled_images'] = $focus->scheduled_images;
			$report_data['row_index_display'] = $focus->row_index_display;
			$report_data['results_limit'] = $focus->results_limit;
			$report_data['table_config'] = asol_ReportsGenerationFunctions::getTableConfiguration($focus->report_fields, 0);
			
			$audited_report = ($report_data['audited_report'] == '1') ? true : false;
			
			$availableReport = true;
			$displayTotals = ((!isset($report_data['table_config']['totals']['visible'])) || ($report_data['table_config']['totals']['visible']));
			$displaySubtotals = ((!isset($report_data['table_config']['subtotals']['visible'])) || ($report_data['table_config']['subtotals']['visible']));
			$allowExportGeneratedFile = true;
			$externalCall = false;
			$schedulerCall = false;
			$userTZ = null;
			
			$searchCriteria = isset($_REQUEST['search_criteria']);
			
			// Execute report with default filter values
			$reportFilters = unserialize(base64_decode($focus->report_filters));
			$initialExecution = $reportFilters['config']['initialExecution'];
			if ((isset($initialExecution)) && ($initialExecution)) {
				$searchCriteria = true;
			}
			// Execute report with default filter values
			
			$currentUserId = $_REQUEST['currentUserId'];
			
			
			//*****************************//
			//*******Temporal Fixes********//
			//*****************************//
			if (isset($_REQUEST["external_filters"])) {
				$external_filters = str_replace('${nbsp}', " ", $_REQUEST["external_filters"]);
			}
			
			//****************************************//
			//****External Dispatcher Management******//
			//****************************************//
			if ((isset($_REQUEST['sourceCall'])) && ($_REQUEST['sourceCall'] == "external")) {
				asol_ReportsGenerationFunctions::manageReportExternalDispatcher($dispatcherMaxRequests);
			}
			

			if ($isDomainsInstalled)
				asol_ReportsUtils::reports_log('asol', 'Executing Report with Id ['.$reportId.'] Domain ['.$contextDomainId.']', __FILE__, __METHOD__, __LINE__);
			else
				asol_ReportsUtils::reports_log('asol', 'Executing Report with Id ['.$reportId.']', __FILE__, __METHOD__, __LINE__);
			
			//****************************************//
			//********Get External Parameters*********//
			//****************************************//
			$externalParams = asol_ReportsGenerationFunctions::getExternalRequestParams();
			
			$current_language = $externalParams["current_language"];
			$mod_strings = $externalParams["mod_strings"];
			$current_user = $externalParams["current_user"];
			
			
			//*************************************//
			//********Manage Report Domain*********//
			//*************************************//
			if ($isDomainsInstalled && ($focus->report_type !== 'external')) {

				$reportDomain = ($contextDomainId !== null) ? $contextDomainId : $current_user->asol_default_domain;
				
				if (!asol_ReportsGenerationFunctions::manageReportDomain($reportId, $reportDomain, $focus->asol_domain_id)) {

					$availableReport = false;
					if ($returnHtml) {
						return (include "modules/asol_Reports/include_basic/DetailViewHttpSave.php");
					} else {
						include "modules/asol_Reports/include_basic/DetailViewHttpSave.php";
						exit();
					}
					
				}
			
			}
			

			if (((isset($_REQUEST['sourceCall'])) && ($_REQUEST['sourceCall'] == "external")) || ((isset($_REQUEST['schedulerCall'])) && ($_REQUEST['schedulerCall'] == "true"))) {
				
				//**********************************************************//
				//********Manage External Execution Report Variables********//
				//**********************************************************//
				$externalCall = true;
				$overridedExternalVariables = asol_ReportsGenerationFunctions::overrideExternalReportVariables($report_data['created_by']);
				
				$theUser = $overridedExternalVariables["theUser"];
				$current_user = $overridedExternalVariables["current_user"];
				$allowExportGeneratedFile = $overridedExternalVariables["allowExportGeneratedFile"];
				$schedulerCall = $overridedExternalVariables["schedulerCall"];
				$externalUserDateFormat = $overridedExternalVariables["externalUserDateFormat"];
				$externalUserDateTimeFormat = $overridedExternalVariables["externalUserDateTimeFormat"];
								
			}
			
				
			//*********************************************************//
			//********Reset Global Format & UserPrefs Variables********//
			//*********************************************************//
			$userDateFormat = ($externalCall) ? $externalUserDateFormat : $timedate->get_date_format();
			$userDateTimeFormat = ($externalCall) ? $externalUserDateTimeFormat : $timedate->get_date_time_format();
			
			$gmtZone = ($externalCall) ? $theUser->getUserDateTimePreferences() : $current_user->getUserDateTimePreferences();
			$userTZlabel = ($externalCall) ? $theUser->getPreference("timezone")." ".$gmtZone["userGmt"] : $current_user->getPreference("timezone")." ".$gmtZone["userGmt"];
			
			$userTZ = ($externalCall) ? $theUser->getPreference("timezone") : $current_user->getPreference("timezone");
			date_default_timezone_set($userTZ);
			
			$phpDateTime = new DateTime(null, new DateTimeZone($userTZ));
			$hourOffset = $phpDateTime->getOffset()*-1;

		
			//****************************************//
			//*****Get Current User Configuration*****//
			//****************************************//

			$currentUserAsolConfig = asol_ReportsGenerationFunctions::getCurrentUserAsolConfig($current_user->id);
			
			$quarter_month = $currentUserAsolConfig["quarter_month"];
			$entries_per_page = $currentUserAsolConfig["entries_per_page"];
			$pdf_orientation = $currentUserAsolConfig["pdf_orientation"];
			$week_start = $currentUserAsolConfig["week_start"];
			$pdf_img_scaling_factor = $currentUserAsolConfig["pdf_img_scaling_factor"];
			$scheduled_files_ttl = $currentUserAsolConfig["scheduled_files_ttl"];
			$host_name = $currentUserAsolConfig["host_name"];
			
			
			//***************************************************//
			//****Avoid Pagination With high Entries Quantity****//
			//***************************************************//
			if (($externalCall) || ($hasNoPagination)) {
				$entries_per_page = 1000000;
			}
			
		
			//*****************************//
			//*****Variable Definition*****//
			//*****************************//
			$rs_user_name = asol_Report::getSelectionResults("SELECT user_name FROM users WHERE id = '".$focus->assigned_user_id."'", false);
			$report_data['assigned_user_name'] = $rs_user_name[0]['user_name'];
			
			$report_data['selected_fields'] = $focus->report_fields;
			$report_data['selected_filters'] = $focus->report_filters;
			$report_data['selected_tasks'] = $focus->report_tasks;
			$report_data['selected_charts'] = $focus->report_charts_detail;
			
			$reportType = explode(':', $focus->report_type);
			$report_data['report_type'] = $reportType[0];
			$report_data['report_type_stored_data'] = $reportType[1];

			$isStoredReport = ($report_data['report_type'] == 'stored') ? true : false;
			
			$report_data['report_scope'] = $focus->report_scope;
			$report_data['email_list'] = $focus->email_list;
			
			$report_name = $focus->name;
			$report_fields = $focus->report_fields;
			$report_filters = $focus->report_filters;
			$report_module = $focus->report_module;
			$report_charts = $report_data['report_charts'];
			$report_charts_engine = $report_data['report_charts_engine'];
			
			$checkMaxAllowedResults = (isset($sugar_config['maxAllowedResults'])) ? true : false;
			
			$descriptionArray = unserialize(base64_decode($focus->description));
			$publicDescription = $descriptionArray['public'];
			
			
			//********************************************//
			//*****Managing External Database Queries*****//
			//********************************************//
			$alternativeDb = ($focus->alternative_database >= 0) ? $focus->alternative_database : false;
			$externalDataBaseQueryParams = asol_ReportsGenerationFunctions::manageExternalDatabaseQueries($alternativeDb, $report_module, $report_table);
			
			$useExternalDbConnection = true;
			
			$useAlternativeDbConnection = $externalDataBaseQueryParams["useAlternativeDbConnection"];
			$domainField = $externalDataBaseQueryParams["domainField"];
			$report_module = $externalDataBaseQueryParams["report_module"];
			$report_table = $externalDataBaseQueryParams["report_table"];
			
			$report_table_primary_key = $externalDataBaseQueryParams["report_table_primary_key"];


			//*************************************//
			//******Generate Chart Info Array******//
			//*************************************//
			$urlChart = array();
			$chartSubGroupsValues = array();
			
			$chartInfoParams = asol_ReportsGenerationFunctions::getChartInfoParams($report_data['selected_fields'], $report_data['selected_charts'], $audited_report, $report_table);
						
			$hasStackChart = $chartInfoParams["hasStackChart"];
			$chartInfo = $chartInfoParams["chartInfo"];
			$chartConfig = $chartInfoParams["chartConfig"];		
			$fieldValues = $chartInfoParams["fieldValues"];	

			//***********************************************//
			//*******Manage Filters & External Filters*******//
			//***********************************************//
			$extFilters = asol_ReportsGenerationFunctions::buildExternalFilters($external_filters, $userDateFormat);
			$filters = unserialize(base64_decode($report_filters));
 			
			$filteringParams = asol_ReportsGenerationFunctions::getFilteringParams($filters, $extFilters, $report_data['report_module'], $dashletId, $userDateFormat);

			$filterValuesData = $filteringParams["filterValues"]["data"];
			$filtersPanel = $filteringParams["filtersPanel"];
			$filtersHiddenInputs = $filteringParams["filtersHiddenInputs"];


			if (($filtersHiddenInputs == false) || ($searchCriteria == true)) {
				
				//************************************//
				//*******Get Queries [LeftJoin]*******//
				//************************************//
				$joinQueryArray = asol_ReportsGenerateQuery::getSqlJoinQuery($fieldValues, $filterValuesData, $report_module, $report_table, $audited_report, $useAlternativeDbConnection, $modulesTables, $domainField);
				
				$moduleCustomJoined = $joinQueryArray["moduleCustomJoined"];
				$moduleCountCustomJoined = $joinQueryArray["moduleCountCustomJoined"];
				$leftJoineds = $joinQueryArray["leftJoineds"];
				$sqlJoin = $joinQueryArray["querys"]["Join"];
				$sqlCountJoin = $joinQueryArray["querys"]["CountJoin"];
				
				
				//**********************************//
				//*******Get Queries [Select]*******//
				//**********************************//
				$selectQueryArray = asol_ReportsGenerateQuery::getSqlSelectQuery($fieldValues, $chartInfo, $report_table, $hourOffset, $quarter_month, $week_start, $audited_report, $leftJoineds);

				$custom_fields = $selectQueryArray["customFields"];
				$columns = $selectQueryArray["columns"];
				$columnsO = $selectQueryArray["columnsO"];
				
				$isGroupedReport = $selectQueryArray["hasGrouped"];
				$hasGroupedFunctionWithSQL = ($isGroupedReport && $selectQueryArray["hasFunctionWithSQL"]);

				$groupSubTotalField = $selectQueryArray["groupSubTotalField"];
				$groupSubTotalFieldAscSort = $selectQueryArray["groupSubTotalFieldAscSort"];
				
				$totals = $selectQueryArray["totals"];
				$resulset_fields = $selectQueryArray["resultsetFields"];
				
				$sqlTotalsC = $selectQueryArray["querys"]["Charts"];
				$sqlSelect = $selectQueryArray["querys"]["Select"];
				$sqlTotals = $selectQueryArray["querys"]["Totals"];
				
				
				//********************************//
				//*******Get Queries [From]*******//
				//********************************//
				$sqlFromArray = asol_ReportsGenerateQuery::getSqlFromQuery($report_table, $custom_fields, $audited_report);
			
				$sqlFrom = $sqlFromArray['from'];
				
				
				if ($sqlFromArray['joinExt'] !== null) {
					$sqlJoin .= (!$moduleCustomJoined) ? $sqlFromArray['joinExt'] : '';
					$sqlCountJoin .= (!$moduleCountCustomJoined) ? $sqlFromArray['joinExt'] : '';
				}
				
				
				//*********************************//
				//*******Get Queries [Where]*******//
				//*********************************//
				$sqlWhere = asol_ReportsGenerateQuery::getSqlWhereQuery($filterValuesData, $fieldValues, $report_table, $hourOffset, $quarter_month, $week_start, $useAlternativeDbConnection);

				if ($isDomainsInstalled) {
					asol_ReportsGenerateQuery::modifySqlWhereForAsolDomainsQuery($sqlWhere, $report_table, $current_user, $schedulerCall, $reportDomain, $domainField);
				}

				
				//***********************//
				//****Get Email Alert****//
				//***********************//
				$sendEmailquestion = asol_ReportsGenerationFunctions::getSendEmailAlert($focus->email_list, $reportDomain);
				
				
				//***********************************//
				//*******Get Queries [GroupBy]*******//
				//***********************************//
				$groupQueryArray = asol_ReportsGenerateQuery::getSqlGroupByQuery($fieldValues, $report_table);

				$sqlGroup = $groupQueryArray["querys"]["Group"];
				$sqlChartGroup = $groupQueryArray["querys"]["ChartGroup"];
				$details = $groupQueryArray["details"];
				$group_by_seq = $groupQueryArray["groupBySeq"];
				
				$isDetailedReport = $groupQueryArray["hasDetail"];
				$isGroupedReport = $groupQueryArray["hasGrouped"];
				$hasFunctionField = $groupQueryArray["hasFunctionField"];
				$massiveData = $groupQueryArray["massiveData"];
				
								
				//***********************************//
				//*******Get Queries [OrderBy]*******//
				//***********************************//
				$orderQueryArray = asol_ReportsGenerateQuery::getSqlOrderByQuery($fieldValues, $report_table, $field_sort, $sort_direction);
			
				$sqlOrder = $orderQueryArray["query"];
				$sort_direction = $orderQueryArray["sortDirection"];
				
				
				
				//***********************************//
				//*******Pagination Management*******//
				//***********************************//	
				if ($hasNoPagination) {
					
					$sqlLimit = "";
					$sqlLimitExport = "";
					$total_entries_basic = $entries_per_page;
					$total_entries = $entries_per_page;
					
				} else {
					
					//*********************************//
					//*******Get Queries [Limit]*******//
					//*********************************//					
					$total_entries = asol_ReportsGenerationFunctions::getReportTotalEntries($sqlFrom, $sqlCountJoin, $sqlWhere, $sqlGroup, $group_by_seq, $useExternalDbConnection, $alternativeDb);
					$orderQueryArray = asol_ReportsGenerateQuery::getSqlLimitQuery($report_data['results_limit'], $entries_per_page, $page_number, $total_entries, $externalCall);
					
					$sqlLimit = $orderQueryArray["querys"]["Limit"];
					$sqlLimitExport = $orderQueryArray["querys"]["LimitExport"];
					$total_entries_basic = $orderQueryArray["totalEntriesBasic"];
					
				}
				
				
				//******************************************//
				//*****Correct Fields for Empty Reports*****//
				//******************************************//
				$correctedEmptyReport = asol_ReportsGenerationFunctions::correctEmptyReport($sqlSelect, $sqlTotals);
				
				$columns[0] = ($correctedEmptyReport["select"] !== null) ? $correctedEmptyReport["select"] : $columns[0];
				$sqlSelect .= ($correctedEmptyReport["select"] !== null) ? $correctedEmptyReport["select"] : "";
				$sqlOrder .= ($correctedEmptyReport["select"] !== null) ? $correctedEmptyReport["select"] : "";
				
				$sqlTotals .= ($correctedEmptyReport["totals"]["sql"] !== null) ? $correctedEmptyReport["totals"]["sql"] : "";
				$totals[0]['alias'] = ($correctedEmptyReport["totals"]["column"] !== null) ? $correctedEmptyReport["totals"]["column"] : $totals[0]['alias'];
				
				
				//*******************************************************//
				//*****Get Extended Where Clause for Limited Reports*****//
				//*******************************************************//
				$sqlLimitSubSet = asol_ReportsGenerateQuery::getSqlSubSetLimitQuery($focus->alternative_database, $report_data['results_limit'], $total_entries, $entries_per_page, $page_number, $report_table, $report_table_primary_key, $sqlFrom, $sqlJoin, $sqlWhere, $sqlGroup);
				
				
				if ($audited_report) {
						
					//************************************//
					//********Manage Audited Field********//
					//************************************//
					$auditedFieldTypeArray = asol_Report::getFieldInfoFromVardefs($report_module, $filterValuesData[0]['parameters']['first'][0]);
					$auditedFieldType = $auditedFieldTypeArray["values"];
		
					$auditedAppliedFields = array($report_table."_audit.before_value_string", $report_table."_audit.after_value_string", $report_table."_audit.before_value_text", $report_table."_audit.after_value_text");
						
				}

				
				//************************************************************//
				//********Override Chart Names If Http Request Enabled********//
				//************************************************************//
				$chartsHttpQueryUrls = (!isset($_REQUEST['chartsHttpQueryUrls'])) ? array() : explode('${pipe}', $_REQUEST['chartsHttpQueryUrls']);
				

				//*************************//
				//******DETAIL REPORT******//
				//*************************//
				if ($isDetailedReport) {
				
					asol_ReportsUtils::reports_log('debug', 'Detailed Report', __FILE__, __METHOD__, __LINE__);
					
					//***************************************//
					//******Initialize Detail Variables******//
					//***************************************//
					$subGroups = Array();
					$subTotals = Array();

					
					$i=0;
					$detailFieldInfo = $details[$i];

					switch ($detailFieldInfo['grouping']) {
		
						case "Detail":

							//***********************************************//
							//*****Calculate Detail Pagination Variables*****//
							//***********************************************//
							$orderPaginationDetailVars = asol_ReportsGenerationFunctions::getOrderPaginationSingleDetailVars($detailFieldInfo, $report_data['results_limit'], $sqlFrom, $sqlJoin, $sqlWhere, $sqlGroup, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
							
							$rsGroups = $orderPaginationDetailVars["rsGroups"];
							$sizes = $orderPaginationDetailVars["sizes"];
							$fullSizes = $orderPaginationDetailVars["fullSizes"];
							
							break;
							
						case "Day Detail":
						case "DoW Detail":
						case "WoY Detail":
						case "Month Detail":
						case "Natural Quarter Detail":
						case "Fiscal Quarter Detail":
						case "Natural Year Detail":
						case "Fiscal Year Detail":
							
							//*************************************************************//
							//*****Calculate Day/DoW/Month Detail Pagination Variables*****//
							//*************************************************************//
							$orderPaginationMonthDayDetailVars = asol_ReportsGenerationFunctions::getOrderPaginationDateDetailVars($detailFieldInfo, $report_data['results_limit'], $sqlFrom, $sqlJoin, $sqlWhere, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults, $week_start);
							
							$rsGroups = $orderPaginationMonthDayDetailVars["rsGroups"];
							$sizes = $orderPaginationMonthDayDetailVars["sizes"];
							$fullSizes = $orderPaginationMonthDayDetailVars["fullSizes"];
							$reorderDetailGroups = false;
							
							break;
					
					}
					
					
					//*************************************//
					//*****Manage Pagination Variables*****//
					//*************************************//
					$paginationMainVariables = asol_ReportsGenerationFunctions::getPaginationMainVariables($page_number, $entries_per_page, $sizes);
					
					$init_group = $paginationMainVariables["init_group"];
					$end_group = $paginationMainVariables["end_group"];
					$current_entries = $paginationMainVariables["current_entries"];
					$first_entry = $paginationMainVariables["first_entry"];
					
					
					$groupField = Array();
					$subGroup = Array();
					$subTotals = Array();
					
					if (($report_charts != "Char") || (($hasStackChart) && ((count($group_by_seq) != 0) && (strtolower($group_by_seq[0]['display']) == 'yes'))) || ($report_data['results_limit'] != 'all')) {
					
						$subGroupsExport = Array();
						$subTotalsExport = Array();
						$subTotalsExportNoFormat = Array();

						$groupField = array();
						$subGroup = array();
				
						foreach ($rsGroups as $index=>$currentGroup) {
					
							if (($report_data['results_limit'] == "all") && (!$allowExportGeneratedFile) && (($index < $init_group) || ($index > $end_group)))
								continue;									
							
							//********************************************//
							//******Limit Clause For Detail Grouping******//
							//********************************************//							
							$detailWhereGrouping = asol_ReportsGenerateQuery::getDetailWhereGrouping($sqlWhere, $currentGroup['group'], $detailFieldInfo);
				
							$subGroup = $detailWhereGrouping["subGroup"];
							$sqlDetailWhere = $detailWhereGrouping["sqlDetailWhere"];
							
							$sqlLimit = asol_ReportsGenerateQuery::getSqlDetailLimitQuery($report_data['results_limit'], $fullSizes[$index]);

							$sqlDetailQuery = $sqlSelect.$sqlFrom.$sqlJoin.$sqlDetailWhere.$sqlGroup.$sqlOrder.$sqlLimit;
							$rsDetail = asol_Report::getSelectionResults($sqlDetailQuery, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);

							
							//***************************//
							//******Format SubGroup******//
							//***************************//
							if ($detailFieldInfo['function'] == '0') {
								$subGroup = asol_ReportsGenerateQuery::formatDateSpecialsGroup($subGroup, $detailFieldInfo, $userTZ, $focus->currency_id);
							}
								
							if ((empty($subGroup)) && ($subGroup !== "0"))
								continue;
								
							foreach($rsDetail as $currentDetail) {	
								if (($index >= $init_group) && ($index <= $end_group)) {
									$subGroups[$subGroup][] = $currentDetail;
								}
								$subGroupsExport[$subGroup][] = $currentDetail;
							}
									
							//***********************************************//
							//*******Subtotals Query for Current Group*******//
							//***********************************************//	
							if ($displaySubtotals) {

								$limitedGroupTotals = Array();
								
								if (($report_data['results_limit'] == "all") && (!$hasGroupedFunctionWithSQL)) {

									$sqlSubQueryTotals = $sqlTotals.$sqlFrom.$sqlCountJoin.$sqlDetailWhere;
									$rsSubTotals = $rsSubTotalsExport = asol_Report::getSelectionResults($sqlSubQueryTotals, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
									
								} else if (!$isGroupedReport) {

									$limitedIds = array();
									$limitIds = asol_Report::getSelectionResults("SELECT ".$report_table.".".$report_table_primary_key." ".$sqlFrom.$sqlCountJoin.$sqlDetailWhere.$sqlOrder.$sqlLimit, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
									foreach ($limitIds as $limitId)
										$limitedIds[] = $limitId[$report_table_primary_key];
									
									$sqlLimitWhere = " AND ".$report_table.".".$report_table_primary_key." IN ('".implode("','", $limitedIds)."')";
									
									$sqlSubQueryTotals = $sqlTotals.$sqlFrom.$sqlCountJoin.$sqlDetailWhere.$sqlLimitWhere;
									$rsSubTotals = $rsSubTotalsExport = asol_Report::getSelectionResults($sqlSubQueryTotals, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
								
								} else {
								
									//**************************************//
									//******Generate SubTotals Manually*****//
									//**************************************//
									$limitedGroupTotals = $limitedGroupTotalsExport = asol_ReportsGenerateQuery::generateManuallySubTotals($rsDetail, $totals);

								}
									
								if (!empty($limitedGroupTotalsExport[0])) {
									if (($index >= $init_group) && ($index <= $end_group)) {
										$rsSubTotals[0] = $limitedGroupTotals[0];
									}
									$rsSubTotalsExport[0] = $limitedGroupTotalsExport[0];
								}
									
									
								//Obtenemos el resultado de la query de los SubTotales para el subgrupo actual
								$subTotalsLimit[] = $rsSubTotalsExport[0];
								
								$subTotalsExportNoFormat[$subGroup] = $rsSubTotalsExport[0];
								
								//**********************************//
								//******Apply Displaying Format*****//
								//**********************************//
								$rsSubTotals = asol_ReportsGenerateQuery::formatGroupTotals($rsSubTotals, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $focus->currency_id, $audited_report, $auditedAppliedFields, $auditedFieldType);
								$rsSubTotalsExport = asol_ReportsGenerateQuery::formatGroupTotals($rsSubTotalsExport, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $focus->currency_id, $audited_report, $auditedAppliedFields, $auditedFieldType);
					
								$subTotals[$subGroup] = $rsSubTotals[0];
								$subTotalsExport[$subGroup] = $rsSubTotalsExport[0];

							}

						}
							
					
						//Order resultset for grouped totals
						if ($reorderDetailGroups) {

							if ($details[0]['order'] == 'DESC') {
								krsort($subGroups);
								krsort($subGroupsExport);
							} else if ($details[0]['order'] == 'ASC') {
								ksort($subGroups);
								ksort($subGroupsExport);
							}

						}
						
					}

					
					//**********************************************//
					//******Generate Values for Chart Totals********//
					//**********************************************//
								
					$subTotalsC = Array();

					if (($report_charts != "Tabl") && (count($chartInfo) > 0) && (strlen($sqlTotalsC) > 7)) {

						if ($report_data['results_limit'] != 'all') {
									
							$subTotalsC = $subTotalsExportNoFormat;
										
						} else {
	
							switch ($detailFieldInfo['grouping']) {
							
								case "Detail":
	
									$rsSubTotalsC = asol_Report::getSelectionResults($sqlTotalsC.",".$detailFieldInfo['field']." AS 'asol_grouping_field' ".$sqlFrom.$sqlCountJoin.$sqlWhere.$sqlChartGroup, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
									
									foreach ($rsSubTotalsC as $rsSubTotalC) {
										
										$theGroup = $rsSubTotalC['asol_grouping_field'];
										unset($rsSubTotalC['asol_grouping_field']);
										if ($theGroup == "")
											$theGroup = $mod_strings['LBL_REPORT_NAMELESS'];

										$theGroup = asol_ReportsGenerateQuery::formatSubGroup($theGroup, $detailFieldInfo, $userTZ, $currency_id);

										if (!$massiveData)
											$subTotalsC[$theGroup] = $rsSubTotalC;
										else
											$subTotalsC[$theGroup][] = $rsSubTotalC;
										
									} 
									
									break;
									
		
								case "Day Detail":
								case "DoW Detail":
								case "WoY Detail":
								case "Month Detail":	
								case "Natural Quarter Detail":
								case "Fiscal Quarter Detail":
								case "Natural Year Detail":
								case "Fiscal Year Detail":
	
									foreach ($rsGroups as $currentGroup) {
	
										$monthDayDetailGroupWhereExtensionQuery = asol_ReportsGenerationFunctions::getDateDetailGroupWhereExtensionQuery($sqlWhere, $detailFieldInfo['field'], $detailFieldInfo['grouping'], $currentGroup['group']);
	
										$subGroupC = $monthDayDetailGroupWhereExtensionQuery['subGroup'];
										$sqlDetailWhereC = $monthDayDetailGroupWhereExtensionQuery['sqlDetailWhere'];
												
										//Cambiar nº por nombre Mes
										if ($detailFieldInfo['grouping'] == 'Month Detail') {
										
											$monthValC = substr($subGroupC, 4); //YYYYMM
											$yearValC = substr($subGroupC, 0 ,-2); //YYYYMM
										
											$monthNameC = date("F", @mktime(0, 0, 0, $monthValC, 10));
											$subGroupC = (!empty($mod_strings["LBL_REPORT_".strtoupper($monthNameC)])) ? $mod_strings["LBL_REPORT_".strtoupper($monthNameC)]."-".$yearValC : $monthNameC."-".$yearValC;
										
										} else if ($detailFieldInfo['grouping'] == 'DoW Detail') {
											
											$dowLabels = array('LBL_REPORT_MONDAY', 'LBL_REPORT_TUESDAY', 'LBL_REPORT_WEDNESDAY', 'LBL_REPORT_THURSDAY', 'LBL_REPORT_FRIDAY', 'LBL_REPORT_SATURDAY' ,'LBL_REPORT_SUNDAY'); 
											$subGroupC = $mod_strings[$dowLabels[$subGroupC]];
											
										} else if ($detailFieldInfo['grouping'] == 'WoY Detail') {
											
											$woyVal = substr($subGroupC, 4); //YYYYW
											$woyVal = ($woyVal < 10) ? '0'.$woyVal : $woyVal;
											$yearVal = substr($subGroupC, 0 , 4); //YYYYW
											
											$subGroupC = $woyVal.' ('.$yearVal.')';
											
										} else if ($detailFieldInfo['grouping'] == 'Natural Quarter Detail') {
											
											$quarterVal = substr($subGroupC, 4); //YYYYQ
											$yearVal = substr($subGroupC, 0 , -1); //YYYYQ
				
											$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
											$subGroupC = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_NATURAL_QUARTER'].' ('.$yearVal.')';
											
										} else if ($detailFieldInfo['grouping'] == 'Fiscal Quarter Detail') {
											
											$quarterVal = substr($subGroupC, 4); //YYYYQ
											$yearVal = substr($subGroupC, 0 , -1); //YYYYQ
											
											$numberTranslation = array("FIRST", "SECOND", "THIRD", "FORTH");
											$subGroupC = $mod_strings['LBL_REPORT_'.$numberTranslation[intval($quarterVal)-1].'_FISCAL_QUARTER'].' ('.$yearVal.')';
	
										}
										
										
										//Obtenemos el resultado de la query de los SubTotales para el subgrupo actual
										$sqlSubQueryTotalsC = $sqlTotalsC.$sqlFrom.$sqlCountJoin.$sqlDetailWhereC;
										$rsSubTotalsC = asol_Report::getSelectionResults($sqlSubQueryTotalsC, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);

										if (!$massiveData)
											$subTotalsC[$subGroupC] = $rsSubTotalsC[0];
										else
											$subTotalsC[$subGroupC] = $rsSubTotalsC;
						
									}
	
									break;
									
							}
	
						}

						
						//********************************//
						//***Data For Charts Generation***//
						//********************************//
						$dataForChartsGeneration = asol_ReportsCharts::getDataForChartsGeneration($chartInfo, $chartConfig, $fieldValues, $subTotalsC, $subGroupsExport, $massiveData, true, $isGroupedReport, $hasFunctionField,  $group_by_seq, $groupExport, $userDateFormat);

						$subGroupsChart = $dataForChartsGeneration['subGroupsChart'];
						$chartValues = $dataForChartsGeneration['chartValues'];
						$chartConfigs = $dataForChartsGeneration['chartConfigs'];
						$chartYAxisLabels = $dataForChartsGeneration['chartYAxisLabels'];
						//********************************//
						//***Data For Charts Generation***//
						//********************************//
						
						
						//**************************************//
						//***Generate Chart Files & ExtraData***//
						//**************************************//
						$chartFilesWithExtraData = asol_ReportsCharts::getChartFilesWithExtraData($focus->report_charts_engine, true, $massiveData, $chartInfo, $chartConfigs, $chartYAxisLabels, $chartValues, $subGroupsChart, $reportId, $report_module, $chartsHttpQueryUrls, $isGroupedReport, $isStoredReport);
						
			 			$urlChart = $chartFilesWithExtraData['urlChart'];
						$chartSubGroupsValues = $chartFilesWithExtraData['chartSubGroupsValues'];
						//**************************************//
						//***Generate Chart Files & ExtraData***//
						//**************************************//
						
						
						
					}

					//}//Fin del for de cada group detallado
				
				
					//*********************************FORMATEO DEL RESULTSET**********************************
				
				
						
					//**********************************//
					//******Apply Displaying Format*****//
					//**********************************//
					$subGroups = asol_ReportsGenerateQuery::formatDetailResultSet($subGroups, $resulset_fields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $audited_report, $auditedAppliedFields, $auditedFieldType);
					$subGroups = asol_ReportsGenerateQuery::formatDetailGroupedFields($subGroups, $resulset_fields, $userDateFormat);
					
					//******************************************************************************************
				
					
					//Order resultsetExport for grouped totals
					if (empty($subGroupsExport))
						$subGroupsExport = Array();
				
					if (($report_data['results_limit'] != "all") || ($allowExportGeneratedFile)) {
					
						$subGroupsExport = asol_ReportsGenerateQuery::formatDetailResultSet($subGroupsExport, $resulset_fields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $audited_report, $auditedAppliedFields, $auditedFieldType);
						$subGroupsExport = asol_ReportsGenerateQuery::formatDetailGroupedFields($subGroupsExport, $resulset_fields, $userDateFormat);
						
					}
				
					//******************************************************************************************
				
					//Obtenemos los valores relaciones con el paginado
				
					if ($report_data['results_limit'] != "all") {
						$total_entries_basic = 0;
						foreach ($subGroupsExport as $subExp)
							$total_entries_basic += count($subExp);
						$data['total_entries'] = $total_entries_basic;
					} else {
						$data['total_entries'] = $total_entries;
					}
				
		
					$data['first_entry'] = $first_entry;
					$data['current_entries'] = (!empty($current_entries_limit)) ? $current_entries_limit : $current_entries;
					$data['page_number'] = $page_number;
					
					//Calcular numero de paginas en funciones de array sizes
					$parcial = 0;
					$num_pages = 0;
					
					foreach($sizes as $currentSize) {
				
						$parcial += $currentSize;
				
						if (($parcial >= $entries_per_page)) {
							$num_pages++;
							$parcial = 0;
						}
				
					}
				
					$data['num_pages'] = ($parcial == 0) ? $num_pages-1 : $num_pages;
				

				//*************************//
				//******SIMPLE REPORT******//
				//*************************//
				} else {
					
					asol_ReportsUtils::reports_log('debug', 'Simple Report', __FILE__, __METHOD__, __LINE__);
					
					$sqlLimit = (!empty($sqlLimitSubSet)) ? $sqlLimitSubSet : $sqlLimit;
					
					//Obtenemos el resultado de la Query generada
					$sqlQuery = $sqlSelect.$sqlFrom.$sqlJoin.$sqlWhere.$sqlGroup.$sqlOrder.$sqlLimit;
					$rs = asol_Report::getSelectionResults($sqlQuery, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
			
					
					if ($allowExportGeneratedFile) {
						
						if ($hasNoPagination) {
							
							$rsExport = $rs;
							
						} else {
							
							$sqlQueryExport = $sqlSelect.$sqlFrom.$sqlJoin.$sqlWhere.$sqlGroup.$sqlOrder.$sqlLimitExport;
							$rsExport = asol_Report::getSelectionResults($sqlQueryExport, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);
						
						}
						
					}
							
					
					//********************************************//
					//********** SINGLE REPORTS CHARTS ***********//
					//********************************************//
		
					if ($isGroupedReport) {
						
						//********************************//
						//***Data For Charts Generation***//
						//********************************//
						$dataForChartsGeneration = asol_ReportsCharts::getDataForChartsGeneration($chartInfo, $chartConfig, $fieldValues, $rsExport, null, null, false, true, $hasFunctionField,  $group_by_seq, null, $userDateFormat);

						$subGroupsChart = $dataForChartsGeneration['subGroupsChart'];
						$chartValues = $dataForChartsGeneration['chartValues'];
						$chartConfigs = $dataForChartsGeneration['chartConfigs'];
						$chartYAxisLabels = $dataForChartsGeneration['chartYAxisLabels'];
						//********************************//
						//***Data For Charts Generation***//
						//********************************//
						
						
						//**************************************//
						//***Generate Chart Files & ExtraData***//
						//**************************************//
						$chartFilesWithExtraData = asol_ReportsCharts::getChartFilesWithExtraData($focus->report_charts_engine, false, false, $chartInfo, $chartConfigs, $chartYAxisLabels, $chartValues, $subGroupsChart, $reportId, $report_module, $chartsHttpQueryUrls, false, $isStoredReport);
						
			 			$urlChart = $chartFilesWithExtraData['urlChart'];
						$chartSubGroupsValues = $chartFilesWithExtraData['chartSubGroupsValues'];
						//**************************************//
						//***Generate Chart Files & ExtraData***//
						//**************************************//

					}
	
					//********************************************//
					//********** SINGLE REPORTS CHARTS ***********//
					//********************************************//

					
					// Totals beginning
					if ($displayTotals) {
						
						if ((($isGroupedReport) && ($report_data['results_limit'] != 'all')) || ($hasGroupedFunctionWithSQL)) {
	
							//**************************************//
							//******Generate SubTotals Manually*****//
							//**************************************//
							$limitedTotals = asol_ReportsGenerateQuery::generateManuallySubTotals($rsExport, $totals, $subTotalsLimit);
			
						}
						
					}
					// Totals end
				
					
					//***********************************//
					//********ResultSet Formatting*******//
					//***********************************//
					$rs = asol_ReportsGenerateQuery::formatResultSet($rs, $resulset_fields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $audited_report, $auditedAppliedFields, $auditedFieldType);
					$rs = asol_ReportsGenerateQuery::formatGroupedFields($rs, $resulset_fields, $userDateFormat);
					//***********************************//
					//********ResultSet Formatting*******//
					//***********************************//
					

					//***********************************//
					//***Exported ResultSet Formatting***//
					//***********************************//
					if ($allowExportGeneratedFile) {
						$rsExport = asol_ReportsGenerateQuery::formatResultSet($rsExport, $resulset_fields, $userDateFormat, $userDateTimeFormat, $userTZ, $currency_id, $isGroupedReport, $audited_report, $auditedAppliedFields, $auditedFieldType);
						$rsExport = asol_ReportsGenerateQuery::formatGroupedFields($rsExport, $resulset_fields, $userDateFormat);
					}
					//***********************************//
					//***Exported ResultSet Formatting***//
					//***********************************//
				
				
					$data['total_entries'] = $total_entries_basic;
					$data['entries_per_page'] = $entries_per_page;
					$data['current_entries'] = count($rs);
					$data['page_number'] = $page_number;
					$data['num_pages'] = (($data['total_entries'] % $entries_per_page) != 0) ? floor($data['total_entries'] / $entries_per_page) : floor($data['total_entries'] / $entries_per_page) -1 ;
				
				}

				
				$hasDisplayedCharts = ((count($urlChart) > 0) && ($report_data['report_charts'] != 'Tabl'));
				
				
				$data['page_number_label'] = $data['page_number'] + 1;
				$data['num_pages_label'] = $data['num_pages'] + 1;
				
				
				// Totals beginning
				if ($displayTotals) {
					
					$sqlQueryTotals = $sqlTotals.$sqlFrom.$sqlCountJoin.$sqlWhere;
					$rsTotals = asol_Report::getSelectionResults($sqlQueryTotals, $useExternalDbConnection, $alternativeDb, $checkMaxAllowedResults);

					//**********************************//
					//******Apply Displaying Format*****//
					//**********************************//
					$rsTotals = asol_ReportsGenerateQuery::formatGroupTotals($rsTotals, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $focus->currency_id, $audited_report, $auditedAppliedFields, $auditedFieldType);
			
					if (($report_data['results_limit'] != "all") || ($allowExportGeneratedFile)) {
					
						$limitedTotals = asol_ReportsGenerateQuery::formatGroupTotals($limitedTotals, $totals, $userDateFormat, $userDateTimeFormat, $userTZ, $focus->currency_id, $audited_report, $auditedAppliedFields, $auditedFieldType);
					
					}
				
					if (!empty($limitedTotals)) {
						$rsTotals = $limitedTotals;
					}
					
				}
				// Totals end

	
				//**************************************//
				//****Save Report Data into Txt File****//
				//**************************************//
				if ($allowExportGeneratedFile) {

					$exportedReport = Array();
			
					$exportedReport['id'] = $reportId;
					$exportedReport['reportName'] = $report_name;
					$exportedReport['report_type'] = $report_data['report_type'];
					$exportedReport['report_type_stored_data'] = $report_data['report_type_stored_data'];
					$exportedReport['module'] = $app_list_strings["moduleList"][$report_module];
					$exportedReport['description'] = $report_data['description'];
					$exportedReport['report_charts'] = $report_data['report_charts'];
					$exportedReport['report_charts_engine'] = $report_data['report_charts_engine'];
					$exportedReport['report_attachment_format'] = $report_data['report_attachment_format'];
					$exportedReport['row_index_display'] = $report_data['row_index_display'];
					$exportedReport['results_limit'] = $report_data['results_limit'];
					$exportedReport['email_list'] = $focus->email_list;
					$exportedReport['created_by'] = $focus->created_by;
	
					if ($isDomainsInstalled)
						$exportedReport['asol_domain_id'] = $focus->asol_domain_id;
						
					$exportedReport['pdf_orientation'] = $pdf_orientation;
					$exportedReport['pdf_img_scaling_factor'] = $pdf_img_scaling_factor;
					
					$exportedReport['totals'] = $rsTotals;
					$exportedReport['headers'] = $columns;
					$exportedReport['headersTotals'] = $totals;
					
					$exportedReport['current_user_id'] = $current_user->id;
					$exportedReport['context_domain_id'] = $reportDomain;
					
					$exportedReport['isDetailedReport'] = $isDetailedReport;
					$exportedReport['hasDisplayedCharts'] = $hasDisplayedCharts;
					
					$exportedReport['reportScheduledType'] = $focus->report_scheduled_type;
					
					
					
					if ($isDetailedReport) {
						$exportedReport['resultset'] = $subGroupsExport;
						$exportedReport['subTotals'] = $subTotalsExport;
					} else {
						$exportedReport['resultset'] = $rsExport;
					}
					
					
					//Guardamos el fichero en disco por si surge un export
					$exportedReportName = preg_replace ('/[^a-zA-Z0-9]/', '', $report_data['report_name']);
					$reportNameNoSpaces = strtolower(str_replace(":", "", str_replace(" ", "_", $exportedReportName)));
					$exportedReportFile = $reportNameNoSpaces."_".dechex(time()).dechex(rand(0,999999)).".txt";
					
					$exportFolder = "modules/asol_Reports/tmpReportFiles/";
					$storedReportsSubFolder = "storedReports/";
					
					//If Scheduled-Stored Report, save report in StoredReports subfolder & update Report with reportFileName
					if ($report_data['report_type'] == 'stored') {
						
						$storedReportData = (empty($exportedReport['report_type_stored_data'])) ? array() : unserialize(base64_decode($exportedReport['report_type_stored_data']));
						
						$chartFiles = array();
						
						foreach ($chartInfo as $key=>$info) {
							
							if (!empty($urlChart[$key])) {
								$chartFiles[] = array(
									'file' => $urlChart[$key],
									'type' => $info["type"],
									'subGroups' => $info["subgroups"]
								);
							}
							
						}

						$accessKey = ($isDomainsInstalled) ? $reportDomain : 'base';
						
						$storedReportData[$accessKey] = array(
							'infoTxt' => $storedReportsSubFolder.$exportedReportFile,
							'chartFiles' => $chartFiles
						);
							
						$updatedSerializedStoredData = base64_encode(serialize($storedReportData)); 
						
						$setStoredReportFile = "UPDATE asol_reports SET report_type = 'stored:".$updatedSerializedStoredData."' WHERE id = '".$reportId."' LIMIT 1";
						$db->query($setStoredReportFile);
						
						$exportFolder .= $storedReportsSubFolder;
						
					}
					
					
					$exportFile = fopen($exportFolder.$exportedReportFile, "w");
					fwrite($exportFile, serialize($exportedReport));
					fclose($exportFile);
				
				}
				

				//********************************************//
				//****Do Final Action for Executed Reports****//
				//********************************************//
				if (!isset($_REQUEST['return_action'])) {
					asol_ReportsGenerationFunctions::doFinalExecuteReportActions($reportId, $dispatcherMaxRequests);
				}
			
			
			}
			

			if (!$externalCall) {
			
				echo '
				<script type="text/javascript" src="modules/asol_Reports/include_basic/js/reports.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>
				<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'">';
			
			}
			
			?>
			
			<script>
			function main() {
				$(document).ready(function() {
					<?php 
					echo 'setXmlCharts_'.str_replace("-", "", $focus->id).'();';
					?>				
				});
			}
			</script>
				
			<?php
			
			if ((!$externalCall) && $getLibraries) {
			
				if ($report_data['report_charts'] != "Tabl") {
					
					$chartEngineLibraries = asol_ReportsCharts::getChartEngineLibraries($focus->report_charts_engine, $isDashlet);
					foreach ($chartEngineLibraries as $chartEngineLibrary) {
						$library = explode(";", $chartEngineLibrary);
						if ($library[0] == 'JS')
							echo '<script type="text/javascript" src="'.$library[1].'"></script>';
						else if ($library[0] == 'CSS')
							echo '<link rel="stylesheet" type="text/css" href="'.$library[1].'">';
					}
				}		
				
				echo '<script type="text/javascript" src="modules/asol_Reports/include_basic/js/reports.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>';
				echo '<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'">';
				
			}
			
			?>	
			
	
			<script type="text/javascript">
			
			<?php 
			
			$returnScript = ((!$hasCurlRequestEnabled) || ((isset($_REQUEST['entryPoint'])) && ($_REQUEST['entryPoint'] == 'reloadReport')));
			
			if ($isDashlet) {
				echo asol_ReportsGenerationFunctions::getReloadCurrentDashletScriptFunction($reportId, $dashletId);
			}
			
			echo "function setXmlCharts_".str_replace("-", "", $focus->id)."() {";	
				
				switch ($focus->report_charts_engine) {
	
					case "flash":
						$flashArray = asol_ReportsCharts::getCrmChartHtml($focus->id, $focus->report_charts_engine, false, $returnScript, $urlChart, $chartInfo, $current_language, $theme, $isStoredReport, $isDashlet);
						echo $flashArray["chartHtml"];
						break;
						
					case "html5":
						$html5Array = asol_ReportsCharts::getCrmChartHtml($focus->id, $focus->report_charts_engine, true, $returnScript, $urlChart, $chartInfo, $current_language, $theme, $isStoredReport, $isDashlet);
						echo $html5Array["chartHtml"];
						$html5Chart = $html5Array["returnedCharts"];
						break;
						
					case "nvd3":
						$nvd3Array = asol_ReportsCharts::getCrmChartHtml($focus->id, $focus->report_charts_engine, true, $returnScript, $urlChart, $chartInfo, $current_language, $theme, $isStoredReport, $isDashlet);				
						echo $nvd3Array["chartHtml"];
						$nvd3Chart = $nvd3Array["returnedCharts"];
						break;
						
					default:
						break;
					
				}
	
				?>
		
			}
			</script>
		
			<script>
				if (typeof jQuery === "undefined") {
					
				    var script_tag = document.createElement("script");
				    script_tag.setAttribute("type","text/javascript");
				    script_tag.setAttribute("src", "modules/asol_Reports/include_basic/js/jquery.min.js");
				   
				    script_tag.onload = main; //Run main() once jQuery has loaded
			
			 		document.getElementsByTagName("head")[0].appendChild(script_tag);
			 	} else {
			 		main();
			 	}
			</script>

			<?php
			

			//Asignamos los valores para el ordenado
			$report_data['field_sort'] = $field_sort;
			$report_data['sort_direction'] = $sort_direction;
			
			if (!empty($limitedTotals))
				$rsTotals = $limitedTotals;
			
			if (empty($rsTotals))
				$rsTotals = array();
				
			$reportFields = ($isDetailedReport) ? $subGroups : $rs;
		
		
			if ((isset($_REQUEST['sourceCall'])) && ($_REQUEST['sourceCall'] == "httpReportRequest")) {
				
			
				if ((isset($_REQUEST['schedulerCall'])) && ($_REQUEST['schedulerCall'] == 'true')) { //Scheduled Reports
		
					if ($report_data['report_type'] == "scheduled") {
						
						$reportScheduledTypeArray = explode('${dollar}', $focus->report_scheduled_type);
						$reportScheduledType = (empty($reportScheduledTypeArray[0])) ? 'email' : $reportScheduledTypeArray[0];

						
						if ($reportScheduledType == 'email') { //Send Email
						
							//$exportedReportFile
							$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
							
							$descriptionArray = unserialize(base64_decode($report_data['description']));
							
							//************************//
							//****Get Email Arrays****//
							//************************//							
							$emailReportInfo = asol_ReportsGenerationFunctions::getEmailInfo($focus->email_list);

							$emailFrom = $emailReportInfo['emailFrom'];
							$emailArrays = $emailReportInfo['emailArrays'];
									
							$users_to = $emailArrays["users_to"];
							$users_cc = $emailArrays["users_cc"];
							$users_bcc = $emailArrays["users_bcc"];
							$roles_to = $emailArrays["roles_to"];
							$roles_cc = $emailArrays["roles_cc"];
							$roles_bcc = $emailArrays["roles_bcc"];
							$emails_to = $emailArrays["emails_to"];
							$emails_cc = $emailArrays["emails_cc"];
							$emails_bcc = $emailArrays["emails_bcc"];
							
							//Generar array con emails a enviar Report
							$mail = new SugarPHPMailer();
							$mail->setMailerForSystem();
							$user = new User();
						
							//created by
							$mail_config = $user->getEmailInfo($report_data['created_by']);
						
							
							if (!empty($emailFrom))
								$mail->From = $emailFrom;
							else
								$mail->From = (isset($sugar_config["asolReportsEmailsFrom"])) ? $sugar_config["asolReportsEmailsFrom"] : $mail_config['email'];
							
							$mail->FromName = (isset($sugar_config["asolReportsEmailsFromName"])) ? $sugar_config["asolReportsEmailsFromName"] : $mail_config['name'];
						
							//Timeout del envio de correo
							$mail->Timeout=30;
							$mail->CharSet = "UTF-8";
						
							
							asol_ReportsGenerationFunctions::setSendEmailAddresses($mail, $emailArrays, $reportDomain);
							
							
							if ($report_data['scheduled_images'] == "1") {
						
								$chartFiles = array();
						
								foreach ($chartInfo as $key=>$info){
									
									if (!empty($urlChart[$key])) {
										$chartFiles[] = array(
											'file' => $urlChart[$key],
											'type' => $info["type"],
											'subGroups' => $info["subgroups"]
										);
									}
									
								}
		
								$accessKey = 'base';
								
								$storedReportData[$accessKey] = array(
									'infoTxt' => $exportedReportFile,
									'chartFiles' => $chartFiles
								);
									
								$serializedStoredData = base64_encode(serialize($storedReportData)); 
								

								$uri = (!empty($host_name)) ? $host_name : $sugar_config['site_url'];
								$uri .= "/index.php";
								$uri .= "?entryPoint=scheduledEmailReport&module=asol_Reports&storedReportInfo=".$serializedStoredData;
						
								asol_ReportsUtils::reports_log('asol', 'scheduledImages is enabled - URI Rebuild: '.$uri, __FILE__, __METHOD__, __LINE__);
									
								//Generamos la url para reconstruir el report en un entryPoint
						
							}
						
							//Datos del email en si
							if ($isDomainsInstalled) {
								
								$reportDomain = ($contextDomainId !== null) ? $contextDomainId : $current_user->asol_default_domain;
								$mail->Subject = "[".BeanFactory::getBean('asol_Domains', $reportDomain)->name."] ".$mod_strings['LBL_REPORT_REPORTS_ACTION'].": ".$report_data['report_name'];
								
							} else {
								
								$mail->Subject = $mod_strings['LBL_REPORT_REPORTS_ACTION'].": ".$report_data['report_name'];
							
							}
								
							$mail->Body = "<b>".$mod_strings['LBL_REPORT_NAME'].": </b>".$report_data['report_name']."<br>";
							$mail->Body .= "<b>".$mod_strings['LBL_REPORT_MODULE'].": </b>".$app_list_strings["moduleList"][$report_data['report_module']]."<br>";
							$mail->Body .= "<b>".$mod_strings['LBL_REPORT_DESCRIPTION'].": </b>".$descriptionArray['public'];
						
							if ($report_data['scheduled_images'] == "1"){
						
								$mail->Body .= "<br><br>";
								$mail->Body .= "<a href='".$uri."'>".$mod_strings['LBL_REPORT_EMAIL_TTL_TEXT_1']."</a> ".$mod_strings['LBL_REPORT_EMAIL_TTL_TEXT_2']."<br><br>";
								$mail->Body .= "<i>".$mod_strings['LBL_REPORT_EMAIL_AVAILABLE_TEXT_1']." ".$scheduled_files_ttl." ".$mod_strings['LBL_REPORT_EMAIL_AVAILABLE_TEXT_2']."</i>";
						
							}
						
						
							//Mensaje en caso de que el destinatario no admita emails en formato html
							$mail->AltBody = $mod_strings['LBL_REPORT_NAME'].": ".$report_data['report_name']."\n";
							$mail->AltBody .= $mod_strings['LBL_REPORT_MODULE'].": ".$app_list_strings["moduleList"][$report_data['report_module']]."\n";
							$mail->AltBody .= $mod_strings['LBL_REPORT_DESCRIPTION'].": ".$descriptionArray['public'];
						
							if ($scheduled_images == "1"){
						
								$mail->AltBody .= "\n\n";
								$mail->AltBody .= $mod_strings['LBL_REPORT_ALT_EMAIL_TTL_TEXT'].": ".$uri."\n\n";
								$mail->AltBody .= $mod_strings['LBL_REPORT_EMAIL_AVAILABLE_TEXT_1']." ".$scheduled_files_ttl." ".$mod_strings['LBL_REPORT_EMAIL_AVAILABLE_TEXT_2'];
						
							}
						
				
							if (!$isDetailedReport){
						
								$rsExport = $rs;
								$subTotalsExport = "";
						
							} else {
						
								$rsExport = $subGroups;
								$subTotalsExport = $subTotals;
						
							}
						
						
							if ($report_data['report_charts'] != 'Char') {//If only charts Report, do not attach a generated file
								
								$descriptionArray = unserialize(base64_decode($report_data["description"]));
								$description = $descriptionArray['public'];
							
								switch ($report_data['report_attachment_format']){

									case "PDF":
										$adjunto = generateFile($focus->report_charts_engine, $report_data['report_name'], $app_list_strings["moduleList"][$report_data['report_module']], $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, Array(), Array(), false, true, 100, time(), $userTZlabel, $report_data['row_index_display'], $report_data['report_charts'], $reportDomain);
										break;
									case "HTML":
										$adjunto = generateFile($focus->report_charts_engine, $report_data['report_name'], $app_list_strings["moduleList"][$report_data['report_module']], $description, $columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, $pdf_orientation, Array(), Array(), true, true, 100, time(), $userTZlabel, $report_data['row_index_display'], $report_data['report_charts'], $reportDomain);
										break;
									case "CSV":
										$adjunto = generateCsv($report_data['report_name'] ,$columns, $rsExport, $totals, $rsTotals, $subTotalsExport, $isDetailedReport, true, false, $report_data['row_index_display']);
										break;
							
								}
								
								
								//Añadimos el Report como fichero adjunto del e-mail
								$mail->AddAttachment(getcwd()."/".$tmpFilesDir.$adjunto, $adjunto);
								
							}
						
							
							$success = $mail->Send();
						
							$tries=1;
							while ((!$success) && ($tries < 5)) {
						
								sleep(5);
								$success = $mail->Send();
								$tries++;
						
							}
						
							if ($report_data['report_charts'] != 'Char')
								unlink(getcwd()."/".$tmpFilesDir.$adjunto);
			
						} else { // Send Application
							
							//***********************//
							//***AlineaSol Premium***//
							//***********************//
							$extraParams = array(
								'reportScheduledType' => $focus->report_scheduled_type,
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
							
						}
							
					}
					
				} else {
					
					$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
					$httpHtmlFile = $_REQUEST['httpHtmlFile'];

					$noDataReport = ((empty($urlChart)) && (empty($reportFields)));
					$reportedError = asol_Report::$reported_error;
					
					if ($returnHtml) {
						return (include "modules/asol_Reports/include_basic/DetailViewHttpSave.php");
					} else {
						include "modules/asol_Reports/include_basic/DetailViewHttpSave.php";
					}
					
				}
				
			} else {

				$justDisplay = true;
				$noDataReport = ((empty($urlChart)) && (empty($reportFields)));
				$reportedError = asol_Report::$reported_error;
				
				if ($returnHtml) {
					return (include "modules/asol_Reports/include_basic/DetailViewHttpSave.php");
				} else {
					include "modules/asol_Reports/include_basic/DetailViewHttpSave.php";
					exit();
				}
					
			}
		
		} else {
			
			require_once('modules/asol_Reports/include_basic/ReportChart.php');
			require_once('modules/asol_Reports/include_basic/generateQuery.php');
			
			asol_ReportsUtils::reports_log('debug', 'HttpRequest REPORT!!', __FILE__, __METHOD__, __LINE__);

			$hasSearchCriteria = (!isset($_REQUEST['search_criteria'])) ? false : true;
		
			$pageNumber = (empty($_REQUEST['page_number'])) ? "" : "&page_number=".$_REQUEST['page_number'];
			$sortingField = (empty($_REQUEST['field_sort'])) ? "" : "&field_sort=".$_REQUEST['field_sort']."&sort_direction=".$_REQUEST['sort_direction'];
			$externalFilters = (!isset($_REQUEST['external_filters'])) ? "" : "&external_filters=".$_REQUEST['external_filters'];
			$searchCriteria = (!isset($_REQUEST['search_criteria'])) ? "" : "&search_criteria=1";
			$filtersHiddenInputs = (empty($_REQUEST['filters_hidden_inputs'])) ? "" : "&filters_hidden_inputs=".$_REQUEST['filters_hidden_inputs'];
		
			
			$currentUserId = (isset($_REQUEST['currentUserId'])) ? "&currentUserId=".$_REQUEST['currentUserId'] : "&currentUserId=".$current_user->id;
			
			$isDashletQuery = (!empty($isDashlet)) ? "&dashlet=true" : "";
			$isDashletQuery .= (!empty($dashletId)) ? "&dashletId=".$dashletId : "";

			$focus = BeanFactory::getBean('asol_Reports', $reportId);
			
			
			//*************************************//
			//********Manage Report Domain*********//
			//*************************************//
			if ($isDomainsInstalled) {

				$reportDomain = ($contextDomainId !== null) ? $contextDomainId : $current_user->asol_default_domain;
				
				if (!asol_ReportsGenerationFunctions::manageReportDomain($reportId, $reportDomain, $focus->asol_domain_id)) {

					$availableReport = false;
					include "modules/asol_Reports/include_basic/DetailViewHttpSave.php";
					exit();
					
				}
			
			}
			
			
			//Ver si hay charts para pasar los nombres
			$rsHttp = asol_Report::getSelectionResults("SELECT * FROM asol_reports WHERE id = '".$reportId."' LIMIT 1", false);
			
			$chartsUrls = array();
			$chartsInfo = array();
			
						
			$charts = unserialize(base64_decode($rsHttp[0]['report_charts_detail']));
			$filtersArray = unserialize(base64_decode($rsHttp[0]['report_filters']));
			
			//Check if there is some user_input fiter to show
			$hasUserInputsFilters = false;
			
			foreach ($filtersArray['data'] as $currentFilter){
				if ($currentFilter['behavior'] == 'user_input') {
					$hasUserInputsFilters = true;
					break;
				}
				
			}
			//Check if there is some user_inut fiter to show
			
			// Execute report with default filter values
			if ((isset($filtersArray['config']['initialExecution'])) && ($filtersArray['config']['initialExecution'])) {
				$hasSearchCriteria = true;
				$searchCriteria = "&search_criteria=1";
			}
			// Execute report with default filter values
			
			
			$tmpFilesDir = "modules/asol_Reports/tmpReportFiles/";
			
			
			//Guardamos el fichero en disco por si surge un export
			$exportedReportName = preg_replace ('/[^a-zA-Z0-9]/', '', $rsHttp[0]['name']);
			$reportNameNoSpaces = strtolower(str_replace(":", "", str_replace(" ", "_", $exportedReportName)));
			$httpHtmlFile = $reportNameNoSpaces."_".dechex(time()).dechex(rand(0,999999)).".html";
			
			$fileExtension = ($focus->report_charts_engine != 'nvd3') ? ".xml" : ".js";

			foreach ($charts['charts'] as $chart) {
		
				$chartinfo = $chart['data'];
				
				$prefixChart = str_replace(" ", "_", $prefixChart);
				$xmlName = count($chartsUrls)."_".dechex(time()).dechex(rand(0,999999)).$fileExtension;
			
				if ($chartinfo['display'] == 'yes') {
					
					$chartsInfo[] = $chartinfo;
					$chartsUrls[] = $tmpFilesDir.$xmlName;
				
				}
				
			}
			
			$chartsQueryUrls = (empty($chartsUrls)) ? "" : "&chartsHttpQueryUrls=".implode('${pipe}', $chartsUrls);
			
			echo '
				<script>
				if (typeof jQuery === "undefined") {
					
				    var script_tag = document.createElement("script");
				    script_tag.setAttribute("type","text/javascript");
			    	script_tag.setAttribute("src", "modules/asol_Reports/include_basic/js/jquery.min.js");
		
			    	document.getElementsByTagName("head")[0].appendChild(script_tag);
			
				} 
				</script>';
				
				if ($getLibraries) {
			
					if ($report_data['report_charts'] != "Tabl") {

						$chartEngineLibraries = asol_ReportsCharts::getChartEngineLibraries($focus->report_charts_engine, $isDashlet);
						foreach ($chartEngineLibraries as $chartEngineLibrary) {
							$library = explode(";", $chartEngineLibrary);
							if ($library[0] == 'JS')
								echo '<script type="text/javascript" src="'.$library[1].'"></script>';
							else if ($library[0] == 'CSS')
								echo '<link rel="stylesheet" type="text/css" href="'.$library[1].'">';
						}
						
					}	
					
					echo '<script type="text/javascript" src="modules/asol_Reports/include_basic/js/reports.min.js?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'"></script>';
					echo '<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version='.str_replace('.', '', asol_ReportsUtils::$reports_version).'">';
					
				}
				
			?>
			
				<script>
				<?php

					echo asol_ReportsGenerationFunctions::getSetUpInputCalendarsScriptFunction($reportId, $filtersArray['data']);
				
					$returnScript = (!$hasUserInputsFilters || $hasSearchCriteria);					
					echo asol_ReportsGenerationFunctions::getHttpChartsGenerationScriptFunction($reportId, $returnScript, false, $report_data['report_charts'], $focus->report_charts_engine, $chartsUrls, $chartsInfo, $current_language, $isStoredReport, $isDashlet);
					
				?>
				</script>
			
		<?php 
			
			$waitForReport = false;
			$reportRequestId = ""; 
			
			$asolUrlQuery = $pageNumber.$sortingField.$externalFilters.$searchCriteria.$filtersHiddenInputs.$currentUserId.$isDashletQuery;
			
			$baseRequestedUrl = (isset($sugar_config["asolReportsCurlRequestUrl"])) ? $sugar_config["asolReportsCurlRequestUrl"] : $sugar_config["site_url"];
			$curlRequestedUrl = $baseRequestedUrl.'/index.php?entryPoint=viewReport&record='.$reportId.'&language='.$current_language.'&sourceCall=httpReportRequest'.$chartsQueryUrls.$asolUrlQuery.'&httpHtmlFile='.$httpHtmlFile.$reportRequestId;

			
			//REPORTS DISPATCHER
			if (($dispatcherMaxRequests > 0) && ((!$hasUserInputsFilters) || (($hasUserInputsFilters) && (isset($_REQUEST['external_filters']))))) {
		
				$requestId = create_guid();
				$currentGMTDate = time();
				
				asol_ReportsUtils::reports_log('debug', 'Init GMDate(): '.$currentGMTDate, __FILE__, __METHOD__, __LINE__);
				
				$reportRequestId = "&reportRequestId=".$requestId;
				$initRequestTimeStamp = "&initRequestDateTimeStamp=".$currentGMTDate;
				
				$curlRequestedUrl .= $reportRequestId.$initRequestTimeStamp;
				
				
				asol_ReportsUtils::reports_log('debug', 'Reporting Queue Feature Enabled.', __FILE__, __METHOD__, __LINE__);
					
				
				$reportsDispatcherSql = "SELECT COUNT(id) as 'reportsThreads' FROM asol_reports_dispatcher WHERE status = 'executing'";
				$reportsDispatcherRs = $db->query($reportsDispatcherSql);
				$reportsDispatcherRow = $db->fetchByAssoc($reportsDispatcherRs);
				
				$currentReportsRunningThreads = $reportsDispatcherRow["reportsThreads"];
				
				
				
				if ($currentReportsRunningThreads >= $dispatcherMaxRequests) { //Put Report in queue
					
					$queueReportSql = "INSERT INTO `asol_reports_dispatcher` VALUES ('".$requestId."', '".$reportId."', '".$curlRequestedUrl."', 'waiting', '".$currentGMTDate."', '".$currentGMTDate."', 'manual', '".$current_user->id."')";
					$db->query($queueReportSql);
					$waitForReport = true;
					
				} else {
					
					$executeReportSql = "INSERT INTO `asol_reports_dispatcher` VALUES ('".$requestId."', '".$reportId."', '".$curlRequestedUrl."', 'executing', '".$currentGMTDate."', '".$currentGMTDate."', 'manual', '".$current_user->id."')";
					$db->query($executeReportSql);
					$waitForReport = false;
					
				}
				
			}
			//REPORTS DISPATCHER
		
			if (!$waitForReport) { //Execute report if not is waiting in queue
			
				$ch = curl_init();
				
				curl_setopt($ch, CURLOPT_URL, $curlRequestedUrl);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
				
				curl_exec($ch);
				curl_close($ch);
				
			}
			
			
			$checkHttpFileTimeout = (isset($sugar_config["asolReportsCheckHttpFileTimeout"])) ? $sugar_config["asolReportsCheckHttpFileTimeout"] : "1000";
			
			echo '
				<script>';
				
				if (!isset($_REQUEST['entryPoint'])) {
					
					echo asol_ReportsGenerationFunctions::getSendAjaxRequestScriptFunction($reportId, $dashletId, $checkHttpFileTimeout, $httpHtmlFile, $reportRequestId, $initRequestTimeStamp);
					echo asol_ReportsGenerationFunctions::getInitialAjaxRequest2GenerateReportScript($reportId);
					
				}
				
				if ($isDashlet) {
					echo asol_ReportsGenerationFunctions::getReloadCurrentDashletScriptFunction($reportId, $dashletId);
				}
				
			echo '
				</script>';

			if (!$isDashlet) {

				echo asol_ReportsGenerationFunctions::getStandByReportHtml('', false);
					    
			}
				    
		}
	
	}
	
}

?>