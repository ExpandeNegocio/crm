<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

if(!is_admin($current_user)){
	sugar_die('Admin Only');	
}

echo get_module_title($mod_strings['LBL_MANAGE_ZUCKERREPORTS2CONFIG'], $mod_strings['LBL_MANAGE_ZUCKERREPORTS2CONFIG'], false);

require_once('include/Sugar_Smarty.php');
$sugar_smarty = new Sugar_Smarty();

$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);

$sugar_smarty->assign('RETURN_ACTION', 'index');
$sugar_smarty->assign('RETURN_MODULE', 'Administration');

require_once('modules/Administration/Administration.php');
$admin = new Administration();
$admin->retrieveSettings();

if (!empty($_REQUEST["index_include"])) {
	$admin->saveSetting("zuckerreports2", "index_include", html_entity_decode($_REQUEST["index_include"]));
}
if (!empty($_REQUEST["script_enabled"])) {
	$admin->saveSetting("zuckerreports2", "script_enabled", $_REQUEST["script_enabled"]);
}
if (!empty($_REQUEST["debug_enabled"])) {
	$admin->saveSetting("zuckerreports2", "debug_enabled", $_REQUEST["debug_enabled"]);
}
if (!empty($_REQUEST["charset"])) {
	$admin->saveSetting("zuckerreports2", "charset", html_entity_decode($_REQUEST["charset"]));
}
if (!empty($_REQUEST["deployment"])) {
	$admin->saveSetting("zuckerreports2", "deployment", html_entity_decode($_REQUEST["deployment"]));
}
if (!empty($_REQUEST["localjdkpath"])) {
	$admin->saveSetting("zuckerreports2", "localjdkpath", html_entity_decode($_REQUEST["localjdkpath"]));
}
if (!empty($_REQUEST["execmode"])) {
	$admin->saveSetting("zuckerreports2", "execmode", html_entity_decode($_REQUEST["execmode"]));
}
if (!empty($_REQUEST["jdbcurlextension"])) {
	$admin->saveSetting("zuckerreports2", "jdbcurlextension", html_entity_decode($_REQUEST["jdbcurlextension"]));
}
if (!empty($_REQUEST["ondemandservice"])) {
	$admin->saveSetting("zuckerreports2", "ondemandservice", html_entity_decode($_REQUEST["ondemandservice"]));
}
if (!empty($_REQUEST["ondemandappsecret"])) {
	$admin->saveSetting("zuckerreports2", "ondemandappsecret", html_entity_decode($_REQUEST["ondemandappsecret"]));
}
if (!empty($_REQUEST["ondemandsugarservice"])) {
	$admin->saveSetting("zuckerreports2", "ondemandsugarservice", html_entity_decode($_REQUEST["ondemandsugarservice"]));
}
if (!empty($_REQUEST["ondemandsugaruser"])) {
	$admin->saveSetting("zuckerreports2", "ondemandsugaruser", html_entity_decode($_REQUEST["ondemandsugaruser"]));
}

$admin->retrieveSettings();

$yesno = array("yes" => "Yes", "no" => "No");

if (array_key_exists('zuckerreports2_index_include', $admin->settings)) $sugar_smarty->assign('INDEX_INCLUDE', $admin->settings['zuckerreports2_index_include']);
$sugar_smarty->assign('INDEX_INCLUDE_OPTIONS', array("OnDemand" => "On-Demand Reporting", "ReportCategories" => "Report Archive"));
if (array_key_exists('zuckerreports2_script_enabled', $admin->settings)) $sugar_smarty->assign('SCRIPT_ENABLED', $admin->settings['zuckerreports2_script_enabled']);
$sugar_smarty->assign('SCRIPT_ENABLED_OPTIONS', $yesno);
if (array_key_exists('zuckerreports2_debug_enabled', $admin->settings)) $sugar_smarty->assign('DEBUG_ENABLED', $admin->settings['zuckerreports2_debug_enabled']);
$sugar_smarty->assign('DEBUG_ENABLED_OPTIONS', $yesno);
if (array_key_exists('zuckerreports2_charset', $admin->settings)) $sugar_smarty->assign('CHARSET', $admin->settings['zuckerreports2_charset']);
if (array_key_exists('zuckerreports2_deployment', $admin->settings)) $sugar_smarty->assign('DEPLOYMENT', $admin->settings['zuckerreports2_deployment']);
$sugar_smarty->assign('DEPLOYMENT_OPTIONS', array("local" => "Local JDK", "ondemand" => "ZuckerReports On-Demand"));
if (array_key_exists('zuckerreports2_localjdkpath', $admin->settings)) $sugar_smarty->assign('LOCALJDKPATH', $admin->settings['zuckerreports2_localjdkpath']);
if (array_key_exists('zuckerreports2_execmode', $admin->settings)) $sugar_smarty->assign('EXECMODE', $admin->settings['zuckerreports2_execmode']);
$sugar_smarty->assign('EXECMODE_OPTIONS', array("exec" => "exec", "shell_exec" => "shell_exec"));
if (array_key_exists('zuckerreports2_jdbcurlextension', $admin->settings)) $sugar_smarty->assign('JDBCURLEXTENSION', $admin->settings['zuckerreports2_jdbcurlextension']);
if (array_key_exists('zuckerreports2_ondemandservice', $admin->settings)) $sugar_smarty->assign('ONDEMANDSERVICE', $admin->settings['zuckerreports2_ondemandservice']);
if (array_key_exists('zuckerreports2_ondemandappsecret', $admin->settings)) $sugar_smarty->assign('ONDEMANDAPPSECRET', $admin->settings['zuckerreports2_ondemandappsecret']);
if (array_key_exists('zuckerreports2_ondemandsugarservice', $admin->settings)) $sugar_smarty->assign('ONDEMANDSUGARSERVICE', $admin->settings['zuckerreports2_ondemandsugarservice']);
if (array_key_exists('zuckerreports2_ondemandsugaruser', $admin->settings)) $sugar_smarty->assign('ONDEMANDSUGARUSER', $admin->settings['zuckerreports2_ondemandsugaruser']);


if (!empty($_REQUEST["runjavatest"]) && $_REQUEST["runjavatest"] == "yes") {
	require_once("modules/zr2_ReportTemplate/zr2_ReportTemplate.php");
	
	$rt = new zr2_ReportTemplate();
	$result = $rt->execute_java("-version");

	if ($result) {
		$sugar_smarty->assign('TESTJAVA_RESULT', "Exec Result: Success");
	}
	else {
		$sugar_smarty->assign('TESTJAVA_RESULT', "Exec Result: Failed");
	}
	$sugar_smarty->assign('TESTJAVA_OUTPUT', $rt->report_output);
}




$sugar_smarty->display('custom/modules/Configurator/ZuckerReports2Config.tpl');

?>