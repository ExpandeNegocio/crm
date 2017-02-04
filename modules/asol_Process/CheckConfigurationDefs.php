<?php

require_once("modules/asol_Process/___common_WFM/php/checkConfigurationDefsFunctions.php");



//**************************//
//***Module Dependencies****//
//**************************//


	echo "<div class='detail view  detail508'><h4>AlineaSolWFM Module Dependencies (<span class='required' style='font-size: 10px'>* required module</span>)</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";
	//*************************//
	//***AlineaSolCommonBase***//
	//*************************//
	echo "<span style='font-weight: bold;'>· AlineaSol Common Base</span>:</td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkModuleDependence('AlineaSolCommonBase');
	//*************************//
	//***AlineaSolCommonBase***//
	//*************************//
	
	echo "</td><td width='22.5%'>";
	
	//**********************//
	//***AlineaSolDomains***//
	//**********************//
	echo "<span style='font-weight: bold;'>· AlineaSol Domains:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkModuleDependence('AlineaSolDomains');
	//**********************//
	//***AlineaSolDomains***//
	//**********************//
	
	echo "</td></tr><tr><td width='22.5%'>";
	
	//**************************//
	//***Reports HTTP Request***//
	//**************************//
	echo "<span style='font-weight: bold;'>· AlineaSol Ajax Post Requests IE10 Compatibility:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkModuleDependence('AlineaSolAjaxPostRequestsIE10Compatibility');
	//**************************//
	//***Reports HTTP Request***//
	//**************************//
	
	echo "</td><td width='22.5%'>";
	
	//********************************//
	//***AlineaSol Publish HomePage***//
	//********************************//
	echo "<span style='font-weight: bold;'>· AlineaSol Publish HomePage:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkModuleDependence('AlineaSolPublishHomePage');
	//**************************//
	//********************************//
	//***AlineaSol Publish HomePage***//
	//********************************//
	
	echo "</td></tr><tr><td width='22.5%'>";
	
	//********************************//
	//***fix_sugarcrm6510_self_referencing***//
	//********************************//
	echo "<span style='font-weight: bold;'>· _fix_sugarcrm6510_module_selfReferencing_bug<span class='required'>*</span>:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkModuleDependence('fix_sugarcrm6510_self_referencing', true);
	//**************************//
	//********************************//
	//***fix_sugarcrm6510_self_referencing***//
	//********************************//
	
	echo "</td><td width='22.5%'>";
	
	echo "</td><td width='22.5%'>";
	
	echo "</td></tr></table></div>";


//**************************//
//***Module Dependencies****//
//**************************//

echo "<br/>";	
	
//********************************//
//***PHP Function Dependencies****//
//********************************//

	echo "<div class='detail view  detail508'><h4>PHP Function Dependencies</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";

	//**********//
	//***cURL***//
	//**********//
	echo "<span style='font-weight: bold;'>· curl_init:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkPHPFunctionDependence("curl_init");
	//**********//
	//***cURL***//
	//**********//
	
	echo "</td><td width='22.5%'>";
	
	echo "</td><td width='27.5%'>";

	echo "</td></tr></table></div>";

//********************************//
//***PHP Function Dependencies****//
//********************************//


	
echo "<br/>";
	
//**********************************//
//***Files & Folders Permisions ****//
//**********************************//

	echo "<div class='detail view  detail508'><h4>AlineaSolWFM Files Access</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";
	
	//***************************//
	//***AlineaSol WFM CSS***//
	//***************************//
	echo "<span style='font-weight: bold;'>· AlineaSol WFM's CSS Files:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_activity_style.css", "asol_activity_style_ccs", "modules/asol_Activity/css/asol_activity_style.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_events_style.css", "asol_events_style_ccs", "modules/asol_Events/css/asol_events_style.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_popupHelp.css", "asol_popupHelp_ccs", "modules/asol_Process/___common_WFM/css/asol_popupHelp.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("tabs.css", "tabs_ccs", "modules/asol_Process/___common_WFM/css/tabs.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("codemirror.css", "codemirror_ccs", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/codemirror.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("docs.css", "docs_ccs", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/docs.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.ui.min.css", "jquery_ui_min_css", "modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/css/jquery.ui.min.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.qtip.min.css", "jquery_qtip_min_css", "modules/asol_Process/___common_WFM/plugins_js_css_images/qTip2/jquery.qtip.min.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("flowChart.css", "flowChart_ccs", "modules/asol_Process/_flowChart/flowChart.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_process_style.css", "asol_process_style_ccs", "modules/asol_Process/css/asol_process_style.css");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_task_style.css", "asol_task_style_ccs", "modules/asol_Task/css/asol_task_style.css");
	//***************************//
	//***AlineaSol WFM CSS***//
	//***************************//
	
	echo "</td><td width='22.5%'>";
	
	//**************************//
	//***AlineaSol WFM JS***//
	//**************************//
	echo "<span style='font-weight: bold;'>· AlineaSol WFM's JavaScript Files</span>:</td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_activity.js", "asol_activity_js", "modules/asol_Activity/js/asol_activity.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_events.js", "asol_events_js", "modules/asol_Events/js/asol_events.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("module_fields.js", "module_fields_js", "modules/asol_Events/js/module_fields.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("activatables.js", "activatables_js", "modules/asol_Process/___common_WFM/js/activatables.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("common_event_activity_task.js", "common_event_activity_task_js", "modules/asol_Process/___common_WFM/js/common_event_activity_task.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.jec.js", "jquery_jec_js", "modules/asol_Process/___common_WFM/js/jquery.jec.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.jsPlumb.min.js", "jquery_jsPlumb_min_js", "modules/asol_Process/___common_WFM/js/jquery.jsPlumb.min.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.min.js", "jquery_min_js", "modules/asol_Process/___common_WFM/js/jquery.min.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("clike.js", "clike_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/clike.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("codemirror.js", "codemirror_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/codemirror.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("css.js", "css_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/css.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("htmlmixed.js", "htmlmixed_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/htmlmixed.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("javascript.js", "javascript_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/javascript.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("matchbrackets.js", "matchbrackets_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/matchbrackets.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("php.js", "php_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/php.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("xml.js", "xml_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/codemirror_php/xml.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.ui.min.js", "jquery_ui_min_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/jquery.ui/js/jquery.ui.min.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("jquery.qtip.min.js", "jquery_qtip_min_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/qTip2/jquery.qtip.min.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("ZeroClipboard.js", "ZeroClipboard_js", "modules/asol_Process/___common_WFM/plugins_js_css_images/ZeroClipboard/ZeroClipboard.js");
	echo asol_CheckConfigurationDefsFunctions::checkFileAccess("asol_task.js", "asol_task_js", "modules/asol_Task/js/asol_task.js");
	//**************************//
	//***AlineaSol WFM JS***//
	//**************************//
	
	echo "</td></tr></table></div>";
	
//**********************************//
//***Files & Folders Permisions ****//
//**********************************//
	
echo "<br/>";

//**************************//
//***SugarCRM Schedulers****//
//**************************//

	echo "<div class='detail view  detail508'><h4>AlineaSolWFM Schedulers</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";

	//**********************************//
	//***AlineaSol Reports Scheduled****//
	//**********************************//
	echo "<span style='font-weight: bold;'>· wfm_scheduled_task:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkSchedulerJob("wfm_scheduled_task");
	//**********************************//
	//***AlineaSol Reports Scheduled****//
	//**********************************//
	
	echo "</td><td width='22.5%'>";

	//********************************//
	//***AlineaSol Reports CleanUp****//
	//********************************//
	echo "<span style='font-weight: bold;'>· wfm_engine_crontab:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkSchedulerJob("wfm_engine_crontab");
	//********************************//
	//***AlineaSol Reports CleanUp****//
	//********************************//

	echo "</td></tr></table></div>";

//**************************//
//***SugarCRM Schedulers****//
//**************************//

echo "<br/>";

//*********************//
//***BASIC Features****//
//*********************//


	echo "<div class='detail view  detail508'><h4>AlineaSolWFM Community Features</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";
	
	
	//**********************************//
	//***WFM_site_url***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_site_url:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_site_url');
	//**********************************//
	//***WFM_site_url***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_site_login_username_password***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_site_login_username_password:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_site_login_username_password');
	//*****************************************//
	//***WFM_site_login_username_password***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	
	
	
	
	////////////////
	//**********************************//
	//***WFM_TranslateLabels***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_TranslateLabels:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_TranslateLabels');
	//**********************************//
	//***WFM_TranslateLabels***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_get_fields_from_db***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_get_fields_from_db:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_get_fields_from_db');
	//*****************************************//
	//***WFM_get_fields_from_db***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	////////////////
	//**********************************//
	//***WFM_sugarcrm_emailTemplate_charset***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_sugarcrm_emailTemplate_charset:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_sugarcrm_emailTemplate_charset');
	//**********************************//
	//***WFM_sugarcrm_emailTemplate_charset***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_MAX_loops***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_MAX_loops:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_MAX_loops');
	//*****************************************//
	//***WFM_MAX_loops***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	
	////////////////
	//**********************************//
	//***WFM_MAX_working_nodes_executed_in_one_php_instance***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_MAX_working_nodes_executed_in_one_php_instance:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_MAX_working_nodes_executed_in_one_php_instance');
	//**********************************//
	//***WFM_MAX_working_nodes_executed_in_one_php_instance***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_logLevelForInfoLogs***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_logLevelForInfoLogs:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_logLevelForInfoLogs');
	//*****************************************//
	//***WFM_logLevelForInfoLogs***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	///////////////////
	//**********************************//
	//***WFM_NonVisibleFields***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_NonVisibleFields:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_NonVisibleFields');
	//**********************************//
	//***WFM_NonVisibleFields***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_use_metadata_per_domain***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_use_metadata_per_domain:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_use_metadata_per_domain');
	//*****************************************//
	//***WFM_use_metadata_per_domain***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	
	////////////////
	//**********************************//
	//***WFM_use_alternative_listview***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_use_alternative_listview:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_use_alternative_listview');
	//**********************************//
	//***WFM_use_alternative_listview***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_CanSeeAsolDomainIdField_Roles***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_CanSeeAsolDomainIdField_Roles:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_CanSeeAsolDomainIdField_Roles');
	//*****************************************//
	//***WFM_CanSeeAsolDomainIdField_Roles***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	///////////////////
	//**********************************//
	//***WFM_disable_wfm_completely***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_disable_wfm_completely:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_disable_wfm_completely');
	//**********************************//
	//***WFM_disable_wfm_completely***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_disable_wfmHook***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_disable_wfmHook:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_disable_wfmHook');
	//*****************************************//
	//***WFM_disable_wfmHook***//
	//*****************************************//
	
	echo "</td></tr><tr><td>";
	////////////////
	
	///////////////////
	//**********************************//
	//***WFM_disable_wfmScheduledTask***//
	//**********************************//
	echo "<span style='font-weight: bold;'>· WFM_disable_wfmScheduledTask:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_disable_wfmScheduledTask');
	//**********************************//
	//***WFM_disable_wfmScheduledTask***//
	//**********************************//
	
	echo "</td><td width='22.5%'>";
	
	//*****************************************//
	//***WFM_disable_workFlowManagerEngine***//
	//*****************************************//
	echo "<span style='font-weight: bold;'>· WFM_disable_workFlowManagerEngine:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_disable_workFlowManagerEngine');
	//*****************************************//
	//***WFM_disable_workFlowManagerEngine***//
	//*****************************************//
	
	//echo "</td></tr><tr><td>";
	////////////////
	
	
	
	echo "</td></tr></table></div>";
	
//*********************//
//***BASIC Features****//
//*********************//

	
if (wfm_reports_utils::hasPremiumFeatures()) {
	
	
	echo "<br/>";
	
//***********************//
//***PREMIUM Features****//
//***********************//

	
	echo "<div class='detail view  detail508'><h4>AlineaSolWFM Enterprise Features</h4><table cellspacing='0' width='100%'><tr><td width='22.5%'>";
	//****************************************//
	//***External non CRM databases reports***//
	//****************************************//
	echo "<span style='font-weight: bold;'>· External non CRM databases reports:</span></td><td width='27.5%'>";
	echo asol_CheckConfigurationDefsFunctions::checkConfiguration('WFM_AlternativeDbConnections');
	//****************************************//
	//***External non CRM databases reports***//
	//****************************************//
	
	echo "</td><td width='22.5%'>";
	
	echo "</td><td width='27.5%'>";
	
	
	echo "</td></tr></table></div>";
	
	
//***********************//
//***PREMIUM Features****//
//***********************//
	
		
}


echo "
<script>
	$.fx.speeds._default = 500;
	$.extend($.ui.dialog.prototype.options, { width: 500, show: 'fade', hide: 'fade'});
</script>";


?>