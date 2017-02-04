<?php

$dictionary['asol_Report'] = array(

	  'table' => 'asol_reports',
	  'audited'=>true, 
	  'unified_search' => true,
	  'duplicate_merge'=>true,
	  'comment' => 'AlineaSol Reports module',
	  'fields' => array (
  
		  'description' =>
		  array (
		    'name' => 'description',
		    'vname' => 'LBL_DESCRIPTION',
		    'type' => 'text',
		    'comment' => 'Report description',
		    'importable' => 'required',
		  ),
		  'last_run' =>
		  array (
		    'name' => 'last_run',
		    'vname' => 'LBL_REPORT_LAST_RUN',
		    'type' => 'datetime',
		    'comment' => 'Last execution of the report',
		    'importable' => 'required',
		  ),
		  'report_module' =>
		  array (
		    'name' => 'report_module',
		    'vname' => 'LBL_REPORT_MODULE',
		    'type' => 'varchar',
		    'len' => '255',
		    'comment' => 'Module of the report',
		    'importable' => 'required',
		  ),
		  'report_scope' =>
		  array (
		    'name' => 'report_scope',
		    'vname' => 'LBL_REPORT_SCOPE',
		    'type' => 'text',
		    'comment' => 'Scope of the report',
		  ),
		  'report_fields' =>
		  array (
		    'name' => 'report_fields',
		    'vname' => 'LBL_REPORT_FIELDS',
		    'type' => 'text',
		    'comment' => 'Fields of the report',
		  ),
		  'report_filters' =>
		  array (
		    'name' => 'report_filters',
		    'vname' => 'LBL_REPORT_FILTERS',
		    'type' => 'text',
		    'comment' => 'Filters of the report',
		  ),
		  'report_charts_detail' =>
		  array (
		    'name' => 'report_charts_detail',
		    'vname' => 'LBL_REPORT_CHARTS_DETAIL',
		    'type' => 'text',
		    'comment' => 'Charts of the report',
		  ),
		  'report_type' =>
		  array (
		    'name' => 'report_type',
		    'vname' => 'LBL_REPORT_TYPE',
		    'type' => 'text',
		    'comment' => 'report type: manual, scheduled or stored',
		    'importable' => 'required',
		  ),
		  'report_scheduled_type' =>
		  array (
		    'name' => 'report_scheduled_type',
		    'vname' => 'LBL_REPORT_SCHEDULED_TYPE',
		    'type' => 'text',
		    'comment' => 'report scheduled type: email or application',
		    'importable' => 'required',
		  ),
		  
		  'report_attachment_format' =>
		  array (
		    'name' => 'report_attachment_format',
		    'vname' => 'LBL_REPORT_EMAIL_ATTACHMENT_FORMAT',
		    'type' => 'varchar',
		    'len' => '8',
		    'comment' => 'report attachment format: html, pdf or csv',
		    'importable' => 'required',
		  ),
		  'report_tasks' =>
		  array (
		    'name' => 'report_tasks',
		    'vname' => 'LBL_REPORT_TASKS',
		    'type' => 'varchar',
		    'len' => '255',
		    'comment' => 'Tasks of the report',
		  ),
		  'report_charts' =>
		  array (
		    'name' => 'report_charts',
		    'vname' => 'LBL_REPORT_CHARTS',
		    'type' => 'varchar',
		    'len' => '4',
		    'comment' => 'Display or not report charts',
		  ),
		  'report_charts_engine' =>
		  array (
		    'name' => 'report_charts_engine',
		    'vname' => 'LBL_REPORT_CHARTS_ENGINE',
		    'type' => 'varchar',
		    'len' => '8',
		    'comment' => 'report charts engine: flash, html5 or nvd3',
		    'importable' => 'required',
		  ),
		  'email_list' =>
		  array (
		    'name' => 'email_list',
		    'vname' => 'LBL_REPORT_EMAIL_LIST',
		    'type' => 'text',
		    'comment' => 'Email list to distribute scheduled or manual reports',
		  ),
		  'scheduled_images' =>
		  array (
		    'name' => 'scheduled_images',
		    'vname' => 'LBL_REPORT_EMAIL_LINK',
		    'type' => 'tinyint',
		    'len' => '1',
		    'comment' => 'Activates or deactivates the images on scheduled report emails',
		  ),
		  'audited_report' =>
		  array (
		    'name' => 'audited_report',
		    'vname' => 'LBL_REPORT_AUDIT_TABLE',
		    'type' => 'tinyint',
		    'len' => '1',
		    'default' => '0',
		    'comment' => 'Makes report for Modules audited table',
		  ),
		  'row_index_display' =>
		  array (
		    'name' => 'row_index_display',
		    'vname' => 'LBL_REPORT_ROW_INDEX',
		    'type' => 'tinyint',
		    'len' => '1',
		    'default' => '0',
		    'comment' => 'Activates or deactivates the index display at display screen',
		  ),
		  'results_limit' =>
		  array (
		    'name' => 'results_limit',
		    'vname' => 'LBL_REPORT_RESULTS',
		    'type' => 'varchar',
		    'len' => '255',
		    'default' => 'all',
		    'comment' => 'limit the entries for the Report main query: first or last n entries',
		  ),
		  'alternative_database' =>
		  array (
		    'name' => 'alternative_database',
		    'vname' => 'LBL_REPORT_USE_ALTERNATIVE_DB',
		    'type' => 'varchar',
		    'len' => '255',
		    'default' => '-1', 
		    'comment' => 'Non CRM Database usage definition',
		  ),
	),
	'optimistic_locking'=>true,
);


if (!class_exists('VardefManager')){
	require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('asol_Reports','asol_Report', array('basic', 'assignable',));

?>
