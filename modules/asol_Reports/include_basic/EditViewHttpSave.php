<?php 

require_once("modules/asol_Reports/include_basic/manageReportsFunctions.php");

echo '
<html>

	<head>

		'.asol_ReportsManagementFunctions::getHeaderLinksHtml().'

		<script>
			'.asol_ReportsManagementFunctions::getInitJqueryScriptHtml().'
			'.asol_ReportsManagementFunctions::getOnloadJavaScript().'
			'.asol_ReportsManagementFunctions::getDialogFxDisplayHtml().'
			'.asol_ReportsManagementFunctions::getInitEmailFrameHtml($users_opts, $acl_roles_opts).'
			'.asol_ReportsManagementFunctions::getInitDragDropElementsHtml().'
			'.asol_ReportsManagementFunctions::getRememberReportListsHtml($focus->report_fields, $focus->report_filters, $focus->report_charts_detail, $report_charts_engine, $focus->report_tasks, $focus->email_list, $audited_report, $defaultLanguage).'
			'.asol_ReportsManagementFunctions::getInitReportsJavaScriptsHtml($hasPremiumFeatures, $defaultExternalAppParams, $externalApps, $reportType[0], $reportScheduledType[0], $sel_scheduledApp, $sel_scheduledCustomUrl, $sel_scheduledCustomFixedParams, $sel_scheduledCustomParams, $sel_scheduledHeaders, $sel_scheduledQuotes, $availablePhpFunctions, $defaultExternalAppParams).'
		</script>

	</head>

	<body onload="loadReportsManagementJavaScript();">

		<table style="width: 100%">
		
			<tbody>
				<tr>
					<td>
			
						<div class="moduleTitle">
							<h2>'.($newReportFlag ? ($mod_strings['LBL_REPORT_CREATE']) : ($mod_strings['LBL_REPORT_EDIT'].': '.$report_name)).'</h2>
						</div>
						<div class="clear"></div>
			
						<form id="create_form" name="create_form" method="post" action="index.php">
			
							<table cellspacing="0" cellpadding="0" border="0" width="100%">
								<tbody>
									<tr>
										<td class="buttons">
											'.asol_ReportsManagementFunctions::getLoadingBlockDiv().'
											'.asol_ReportsManagementFunctions::getHiddenInputs($focus->id, $rhs_key, $mySQLcheckInsecurity, $PHPcheckInsecurity, $predefinedColorPaletteSchemasJson).'
											'.asol_ReportsManagementFunctions::getSubmitButtons($availablePhpFunctions).'
										</td>
										<td align="right"></td>
									</tr>
								</tbody>
							</table>';
									

							echo '
							<div id="DEFAULT" class="alineasol_reports yui-navset detailview_tabs yui-navset-top">';
							
								//***********************//
								//***AlineaSol Premium***//
								//***********************//
								$extraParams = array('isDomainsInstalled' => $isDomainsInstalled, 'isScheduled' => in_array($reportType[0], array('scheduled', 'stored')), 'hasCharts' => in_array($report_charts, array("Both", "Htob", "Char")));
								$manageReportTabs = asol_ReportsUtils::managePremiumFeature("manageReportTabs", "reportFunctions.php", "getManageReportTabs", $extraParams);
								echo ($manageReportTabs !== false) ? $manageReportTabs['html'].$manageReportTabs['css'] : '';
								
								$manageWithTabs = ($manageReportTabs !== false) ? true : false;
								$mainTabclass = ($manageReportTabs !== false) ? 'yui-content' : '';
								//***********************//
								//***AlineaSol Premium***//
								//***********************//
							
							echo '
								<div class="'.$mainTabclass.'">
									<div id="mainInfo" class="reportPanel">
										<h4 class="reportPanelHeader">'.$mod_strings['LBL_REPORT_BASIC_INFO'].'</h4>
										<table id="report_info" class="edit view">
											<tbody>
												<tr>
													'.asol_ReportsManagementFunctions::getReportNameHtml($report_name).'
													'.asol_ReportsManagementFunctions::getReportAssignedUserHtml($assigned_user_id, $assigned_user_name).'
												</tr>
												<tr valign="top">
													'.asol_ReportsManagementFunctions::getReportDatabaseHtml($alternativeDb, $focus->alternative_database).'								
													'.asol_ReportsManagementFunctions::getReportDisplayOptionsHtml($report_charts).'
												</tr>		
												<tr>
													<td  nowrap="nowrap" width="15%" scope="col">
														'.$mod_strings['LBL_REPORT_MODULE'].':<span class="required">*</span>
													</td>
													<td id="reportModulesTablesTd" nowrap="nowrap" width="35%">
														'.asol_ReportsManagementFunctions::getReportModuleTablesHtml($focus->alternative_database, $selectedModule, $audited_report, $sel_autorefresh).'
													</td>
													<td nowrap="nowrap" width="15%" scope="col">
														'.$mod_strings['LBL_REPORT_EMAIL_ATTACHMENT_FORMAT'].':<span class="required">*</span>
													</td>
													<td id="reportAttachmentFormatTd" nowrap="nowrap" width="35%">
														'.asol_ReportsManagementFunctions::getReportAttachmentFormatHtml($report_attachment_format).'
													</td>
												</tr>
												<tr>
													'.asol_ReportsManagementFunctions::getReportTypeHtml($reportType, $reportTypeUri, $reportScheduledType).'										
													'.((!$hasPremiumFeatures) ? asol_ReportsManagementFunctions::getReportChartEngineHtml($report_charts_engine) : asol_ReportsManagementFunctions::getReportEmptyFieldHtml()).'
												</tr>
												<tr>
													'.asol_ReportsManagementFunctions::getReportEmailLinkHtml($scheduled_images).'
													'.asol_ReportsManagementFunctions::getReportScopeHtml($sel_scope).'		
												</tr>
												<tr>
													'.asol_ReportsManagementFunctions::getReportInternalDescriptionHtml($internalDescription).'
													'.asol_ReportsManagementFunctions::getReportPublicDescriptionHtml($publicDescription).'
												</tr>
											</tbody>
										</table>
									</div>';
													
									
									echo '
									
									<div id="fieldsFilters" class="reportPanel">
										<h4 class="reportPanelHeader">'.asol_ReportsManagementFunctions::getCollapsableHeader('LBL_REPORT_FIELDS_FILTERS', 'fieldsFilters').'</h4>
										<table class="edit view">
											<tbody>
												<tr>
													<td rowspan="2">
														'.asol_ReportsManagementFunctions::getFieldsPanelHtml($focus->alternative_database, $selectedModule, $audited_report).'
													</td>
													<td width="100%" valign="top">
														'.asol_ReportsManagementFunctions::getFieldsHeadersHtml($focus->row_index_display).'
													</td>
												</tr>
												<tr>
													<td valign="top">
														'.asol_ReportsManagementFunctions::getFiltersHeadersHtml($results_limit).'
													</td>
												</tr>
											</tbody>
										</table>
				
									</div>
				
				
									<div id="charts" class="reportPanel">
										'.asol_ReportsManagementFunctions::getChartsHeadersHtml($report_charts_engine).'														
									</div>';
					

									
									echo ((in_array($reportType[0], array('scheduled', 'stored'))) && !$manageWithTabs) ? '<div id="scheduledDiv" class="reportPanel">' : '<div id="scheduledDiv" style="display: none" class="reportPanel">';		
									echo '							
										'.asol_ReportsManagementFunctions::getTasksHeadersHtml().'
									</div>';
				
									
									
									$distributionListVisibility = ($manageWithTabs) ? '' : 'display: none';								
				
									echo '
									<div id="distributionList" class="reportPanel">
										<h4 class="reportPanelHeader">'.asol_ReportsManagementFunctions::getCollapsableHeader('LBL_REPORT_DISTRIBUTION_LIST', 'distributionList', true).'</h4>
										<table id="distribution_List_Table" class="edit view" style="'.$distributionListVisibility.'">
											<tr>
												<td>
													<div id="task_implementation_field" class="yui-navset detailview_tabs yui-navset-top"></div>
												</td>
											</tr>
				
										</table>
				
									</div>';
									
									
									if ($isDomainsInstalled) {
	
										$domainPublishVisibility = ($manageWithTabs) ? '' : 'display: none';
										
										echo '
										<div id="domainPublishing" class="reportPanel">
											<h4 class="reportPanelHeader">'.asol_ReportsManagementFunctions::getCollapsableHeader('LBL_ASOL_DOMAINS_PUBLISH_FEATURE_PANEL', 'domainPublishing', true).'</h4>
											<table class="edit view" style="'.$domainPublishVisibility.'">
												<tbody>
													<tr>
														'.asol_manageDomains::getBeanDomainNameHtml($focus->asol_domain_name).'
														'.asol_manageDomains::getEmptyCellHtml().'
													</tr>
													<tr>
														'.asol_manageDomains::getBeanPublishManagementButtonHtml($focus->id, 'asol_reports').'
														'.asol_manageDomains::getBeanPublishDomainHtml($focus->asol_published_domain).'
													</tr>
												</tbody>
											</table>
					
										</div>';
									
									}
									
								echo '
								</div>
							</div>
			
							'.asol_ReportsManagementFunctions::getSubmitButtons($availablePhpFunctions).'
			
						</form>
			
					</td>
			
				</tr>
			
			</tbody>
		
		</table>
		
	</body>

</html>';