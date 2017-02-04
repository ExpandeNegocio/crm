<?php

$mod_strings = array_merge(return_module_language("en_us", "zr2_Report"),
	array(
	  'LBL_MODULE_NAME' => 'Query Template',
	  'LBL_MODULE_TITLE' => 'Query Template',
	  'LBL_QUERY_SQL' => 'SQL',
	  'LBL_QUERY_SQL_HELP' => 'Please enter the SQL query for this report. To include parameter selection, enter a "$" followed by the parameter name, and the value will be inserted at this position on report execution.<br/><br/>The following placeholders are supported as well: <br/><b>$SUGAR_USER_ID</b> - contains the ID of the currently logged on user<br/><b>$SUGAR_USER_NAME</b> - contains the name of the currently logged on user<br/><b>$SUGAR_SESSION_ID</b> - contains the ID of the current session',
	  
	'LBL_QUERY_ONDEMAND_COLUMN_DELIMITER' => 'Column Delimiter',
	'LBL_QUERY_ONDEMAND_ROW_DELIMITER' => 'Row Delimiter',
	'LBL_QUERY_ONDEMAND_INCLUDE_HEADER' => 'Include Header',
	'LBL_QUERY_ONDEMAND_PROSPECTLISTNAME' => 'Prospectlist Name',
	'LBL_QUERY_ONDEMAND_PROSPECTLIST_MODULE' => 'Query Result Type',
	'LBL_QUERY_ONDEMAND_PROSPECTLIST_MODULE_HELP' => 'Select the type of Sugar objects returned by your query',
	'LBL_QUERY_ONDEMAND_PROSPECTLIST_IDCOL' => 'Identity Column Name',
	'LBL_QUERY_ONDEMAND_PROSPECTLIST_IDCOL_HELP' => 'Enter the name of the query column holding the id value of the Sugar object',
	)
);

global $app_list_strings;

$mod_list_strings = array_merge(return_mod_list_strings_language("en_us", "zr2_Report"),
	array (
		  'QUERY_EXPORT_TYPES' =>
		  array (
			'CSV' => 'Comma Separated Values (*.csv)',
			'HTML' => 'HTML (*.html)',
			'SIMPLEHTML' => 'Simple HTML (*.html)',
			'TABLE' => 'Inline Table',
			'PROSPECTLIST' => 'Prospectlist',
		  ),
		  'COL_DELIMS' =>
		  array (
			',' => 'Colon (,)',
			';' => 'Semicolon (;)',
			'tab' => 'Tab (\t)',
			'.' => 'Dot (.)',
		  ),
		  'ROW_DELIMS' =>
		  array (
			'newline' => 'Newline (\n)',
		  ),
		  'PROSPECTLIST_MODULE' =>
		  array (
			'Contacts' => $app_list_strings['moduleList']['Contacts'],
			'Leads' => $app_list_strings['moduleList']['Leads'],
			'Prospects' => $app_list_strings['moduleList']['Prospects'],
			'Accounts' => $app_list_strings['moduleList']['Accounts'],
			'Users' => $app_list_strings['moduleList']['Users'],
		  ),
	)
);

?>