<?php

$mod_strings = array_merge (return_module_language("en_us", "zr2_Report"),
	array (
	//module
	'LBL_MODULE_NAME' => 'Report Parameter',
	'LBL_MODULE_TITLE' => 'Report Parameter',

	'LBL_PARAM_NEW' => 'New Report Parameter',
	'LBL_PARAM_FRIENDLYNAME' => 'Parameter Prompt',
	'LBL_PARAM_DEFAULTNAME' => 'Default Parameter Name',
	'LBL_PARAM_DEFAULTVALUE' => 'Default Value',
	'LBL_PARAM_DESCRIPTION' => 'Description',
	'LBL_PARAM_RANGE' => 'Selection',
	'LBL_PARAM_RANGE_LIST' => 'User-Defined List',
	'LBL_PARAM_RANGE_LIST_HELP' => 'Please enter the values for the list, separater by a colon (",").',
	'LBL_PARAM_RANGE_DROPDOWN' => 'Drop-Down List',
	'LBL_PARAM_RANGE_INPUT' => 'Direct Input',
	'LBL_PARAM_RANGE_SQL' => 'User-Defined Query',
	'LBL_PARAM_RANGE_SQL_HELP' => 'Please enter the SQL query for building the parameter selection list when executing the report. The value of the first column of the resultset will be handed to the report, the value of the second column will be shown to the user for selection.',
	'LBL_PARAM_RANGE_SQL_TEST' => 'Test SQL-Query',
	'LBL_PARAM_RANGE_SCRIPT' => 'PHP Script',
	'LBL_PARAM_RANGE_SCRIPT_DISABLED' => 'PHP Scripting has been disabled. Please enable it in the ZuckerReports Administration section.',
	'LBL_PARAM_RANGE_SCRIPT_HELP' => 'Please enter any PHP code you want. Finish with a "return"-statement.',
	'LBL_PARAM_RANGE_OPTIONS' => 'Parameter Settings',
	'LBL_PARAM_PANEL_SQL' => 'SQL Parameter',
	'LBL_PARAM_PANEL_LIST' => 'User-Defined List Parameter',
	'LBL_PARAM_PANEL_DROPDOWN' => 'Drop-Down List Parameter',
	'LBL_PARAM_PANEL_SCRIPT' => 'PHP Script Parameter',
	'LBL_PARAM_PANEL_SCRIPT_DISABLED' => 'PHP Script Parameter',
	)
);
?>
