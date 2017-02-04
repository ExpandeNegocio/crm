<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/Administration/asolConfigBean.php');
global $current_user, $mod_strings, $app_strings, $sugar_config, $db;

$return_action = (isset($_REQUEST['return_action'])) ? $_REQUEST['return_action'] : "index";
$return_module = (isset($_REQUEST['return_module'])) ? $_REQUEST['return_module'] : "Administration";
$quarter_month = (!empty($_REQUEST['month_quarter'])) ? $_REQUEST['month_quarter'] : "";
$entries_per_page = (!empty($_REQUEST['entries_per_page'])) ? $_REQUEST['entries_per_page'] : "";
$pdf_orientation = (!empty($_REQUEST['pdf_orientation'])) ? $_REQUEST['pdf_orientation'] : "";
$week_start = (!empty($_REQUEST['week_start'])) ? $_REQUEST['week_start'] : "";

$scaling_factor = (!empty($_REQUEST['pdf_img_scaling_factor'])) ? $_REQUEST['pdf_img_scaling_factor'] : 0;
$pdf_img_scaling_factor = (($scaling_factor*100) == 0) ? 120 : ($scaling_factor*100);

$ttl = (!empty($_REQUEST['scheduled_files_ttl'])) ? $_REQUEST['scheduled_files_ttl'] : 0;
$scheduled_files_ttl = ($ttl == 0) ? 7 : $ttl;
$hostName = (!empty($_REQUEST['hostName'])) ? $_REQUEST['hostName'] : "";
$newConfig = "";


$reportsModuleQuery = $db->query("SELECT COUNT(id) as REPORTS FROM upgrade_history WHERE id_name = 'AlineaSolReports'");
$reportsModuleRow = $db->fetchByAssoc($reportsModuleQuery);
$isReportsModule = ($reportsModuleRow['REPORTS'] >= 1) ? "true" : "false" ;

if (!isset($_REQUEST['scheduled_files_ttl']))
	$scheduled_files_ttl = 7;

if (!isset($_REQUEST['hostName']))
	$hostName = $sugar_config["host_name"];
	
$focus = new AsolConfig();

$sqlCfg = "SELECT id, config FROM asol_config WHERE created_by = '".$current_user->id."'";
$rsCfg = $focus->getSelectionResults($sqlCfg);

if (count($rsCfg) == 0){
		
	$db->query("INSERT IGNORE INTO `asol_config` (`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`, `config`) VALUES ('".create_guid()."', '".$current_user->name."', '".gmdate("Y-m-d H:i:s")."', '".gmdate("Y-m-d H:i:s")."', '".$current_user->id."', '".$current_user->id."', 0, '1|15|landscape|1|120|7|')");
	$rsCfg = $focus->getSelectionResults($sqlCfg);

} 


$isAdmin = ($current_user->is_admin) ? true : false;

$config = explode("|",$rsCfg[0]['config']);


if (!isset($_REQUEST['entries_per_page']))
	$entries_per_page = $config[1];
	
if (!isset($_REQUEST['pdf_orientation']))
	$pdf_orientation = $config[2];
	

//Si se llam� a guardar
if (isset($_REQUEST['doSave'])){
	
	if ($isAdmin == true){
		$newConfig = $quarter_month."|".$entries_per_page."|".$pdf_orientation."|".$week_start."|".$pdf_img_scaling_factor."|".$scheduled_files_ttl."|".$hostName;	
	}else{
		$newConfig = $config[0]."|".$entries_per_page."|".$pdf_orientation."|".$config[3]."|".$pdf_img_scaling_factor."|".$config[5]."|".$config[6];
	}
	
	$query = "UPDATE asol_config SET date_modified='".Date("Y-m-d H:i:s")."', modified_user_id='".$current_user->id."', deleted='0', config='".$newConfig."' WHERE ID = '".$rsCfg[0]['id']."'";
	
	global $db;
	$db->query($query);
	
	$GLOBALS['log']->debug("ASOL---------------------------------------------------Guardando Nueva Configuracion");
	
	//Si es el admin el que guarda la configuraci�n, se debe reconfigurar los parametros de administracion a todos los usuarios
	if ($isAdmin == true){
		
		$rsUpdateAll = $focus->getSelectionResults("SELECT id, config FROM asol_config WHERE created_by != '".$current_user->id."'");

		for ($i=0; $i<count($rsUpdateAll); $i++){
			$configUser = explode("|",$rsUpdateAll[$i]['config']);
			$query = "UPDATE asol_config SET date_modified='".Date("Y-m-d H:i:s")."', modified_user_id='".$current_user->id."', deleted='0', config='".$quarter_month."|".$configUser[1]."|".$configUser[2]."|".$week_start."|".$configUser[4]."|".$scheduled_files_ttl."|".$hostName."' WHERE ID = '".$rsUpdateAll[$i]['id']."'";
			$db->query($query);		
		}
		
	}
	
	SugarApplication::redirect("index.php?action=".$return_action."&module=".$return_module);
	
}

if ($return_action == "restoreCSS")	{

	copy(getcwd()."/modules/asol_Reports/templates/reports_original.css", getcwd()."/modules/asol_Reports/templates/reports.css");
	
	if (is_file("modules/asol_Reports/templates/".$current_user->asol_default_domain.".css"))
		@unlink("modules/asol_Reports/templates/".$current_user->asol_default_domain.".css");

} else if ($return_action == "uploadCSS"){
	
	$size = $_FILES['uploadedCSS']['size'];// tama�o en bytes del archivo recibido
	$type = $_FILES['uploadedCSS']['type'];// tipo mime del archivo, por ejemplo image/gif
	$name = $_FILES['uploadedCSS']['name'];// nombre original del archivo
	$tmpName = $_FILES['uploadedCSS']['tmp_name'];// nombre del archivo temporal
	
	if ($name != "") {
		
		//guardamos el archivo a la carpeta files
		$target =  (!empty($current_user->asol_default_domain)) ? getcwd()."/modules/asol_Reports/templates/".$current_user->asol_default_domain.".css" : getcwd()."/modules/asol_Reports/templates/reports.css";
		copy($tmpName, $target);
		
	}
	
}

$smarty = new Sugar_Smarty();


$smarty->assign('isAdmin', $isAdmin);

if (!$config[4])
	$config[4] = 120;

if (!$config[5])
	$config[5] = 7;

if (!$config[6])
	$config[6] = $hostName;
	
$cfg = ($newConfig != "") ? explode("|",$newConfig) : $config;

$smarty->assign('config', $cfg);

//Asignamos todos los labels de $mod_Srings & $app_strings
$smarty->assign('LBL_ASOL_CONFIGURATION', $mod_strings['LBL_ASOL_CONFIGURATION']);
$smarty->assign('LBL_ASOL_DATE_TIME_OPTS', $mod_strings['LBL_ASOL_DATE_TIME_OPTS']);
$smarty->assign('LBL_ASOL_FISCAL_YEAR', $mod_strings['LBL_ASOL_FISCAL_YEAR']);
$smarty->assign('LBL_ASOL_WEEK_STARTS', $mod_strings['LBL_ASOL_WEEK_STARTS']);
$smarty->assign('LBL_ASOL_PAGINATION', $mod_strings['LBL_ASOL_PAGINATION']);
$smarty->assign('LBL_ASOL_ENTRIES_PER_PAGES', $mod_strings['LBL_ASOL_ENTRIES_PER_PAGES']);
$smarty->assign('LBL_ASOL_PDF_OPTS', $mod_strings['LBL_ASOL_PDF_OPTS']);
$smarty->assign('LBL_ASOL_PDF_ORIENTATION', $mod_strings['LBL_ASOL_PDF_ORIENTATION']);
$smarty->assign('LBL_ASOL_EXPORTED_CSS', $mod_strings['LBL_ASOL_EXPORTED_CSS']);
$smarty->assign('LBL_ASOL_EXPORT_ORIGINAL_CSS', $mod_strings['LBL_ASOL_EXPORT_ORIGINAL_CSS']);
$smarty->assign('LBL_ASOL_EXPORT_CUSTOM_CSS', $mod_strings['LBL_ASOL_EXPORT_CUSTOM_CSS']);
$smarty->assign('LBL_ASOL_EXPORT_CSS', $mod_strings['LBL_ASOL_EXPORT_CSS']);
$smarty->assign('LBL_ASOL_RESTORE_CSS', $mod_strings['LBL_ASOL_RESTORE_CSS']);
$smarty->assign('LBL_ASOL_RESTORE', $mod_strings['LBL_ASOL_RESTORE']);
$smarty->assign('LBL_ASOL_UPLOAD_CSS', $mod_strings['LBL_ASOL_UPLOAD_CSS']);
$smarty->assign('LBL_ASOL_UPLOAD', $mod_strings['LBL_ASOL_UPLOAD']);
$smarty->assign('LBL_ASOL_SCHEDULED_OPTS', $mod_strings['LBL_ASOL_SCHEDULED_OPTS']);
$smarty->assign('LBL_ASOL_PDF_SCALING_FACTOR', $mod_strings['LBL_ASOL_PDF_SCALING_FACTOR']);
$smarty->assign('LBL_ASOL_SCHEDULED_FILES_TTL', $mod_strings['LBL_ASOL_SCHEDULED_FILES_TTL']);

$smarty->assign('LBL_ASOL_PORTRAIT', $mod_strings['LBL_ASOL_PORTRAIT']);
$smarty->assign('LBL_ASOL_LANDSCAPE', $mod_strings['LBL_ASOL_LANDSCAPE']);
$smarty->assign('LBL_ASOL_JANUARY', $mod_strings['LBL_ASOL_JANUARY']);
$smarty->assign('LBL_ASOL_FEBRUARY', $mod_strings['LBL_ASOL_FEBRUARY']);
$smarty->assign('LBL_ASOL_MARCH', $mod_strings['LBL_ASOL_MARCH']);
$smarty->assign('LBL_ASOL_APRIL', $mod_strings['LBL_ASOL_APRIL']);
$smarty->assign('LBL_ASOL_MAY', $mod_strings['LBL_ASOL_MAY']);
$smarty->assign('LBL_ASOL_JUNE', $mod_strings['LBL_ASOL_JUNE']);
$smarty->assign('LBL_ASOL_JULY', $mod_strings['LBL_ASOL_JULY']);
$smarty->assign('LBL_ASOL_AUGUST', $mod_strings['LBL_ASOL_AUGUST']);
$smarty->assign('LBL_ASOL_SEPTEMBER', $mod_strings['LBL_ASOL_SEPTEMBER']);
$smarty->assign('LBL_ASOL_OCTOBER', $mod_strings['LBL_ASOL_OCTOBER']);
$smarty->assign('LBL_ASOL_NOVEMBER', $mod_strings['LBL_ASOL_NOVEMBER']);
$smarty->assign('LBL_ASOL_DECEMBER', $mod_strings['LBL_ASOL_DECEMBER']);
$smarty->assign('LBL_ASOL_SUNDAY', $mod_strings['LBL_ASOL_SUNDAY']);
$smarty->assign('LBL_ASOL_MONDAY', $mod_strings['LBL_ASOL_MONDAY']);

$smarty->assign('LBL_SAVE_BUTTON_LABEL', $app_strings['LBL_SAVE_BUTTON_LABEL']);
$smarty->assign('LBL_CANCEL_BUTTON_LABEL', $app_strings['LBL_CANCEL_BUTTON_LABEL']);

$smarty->assign('isReportsModule', $isReportsModule);
$smarty->assign('domainId', (!empty ($current_user->asol_default_domain)) ? $current_user->asol_default_domain : "");


$smarty->assign('return_module', $return_module);
$smarty->assign('return_action', $return_action);

$smarty->display('modules/Administration/asolConfig.tpl');
	

?>