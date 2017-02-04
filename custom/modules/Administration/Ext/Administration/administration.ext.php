<?php 
 //WARNING: The contents of this file are auto-generated



$admin_option_defs=array();
$admin_option_defs['Administration']['asol_config']= array('asolAdministration','LBL_ASOL_CONFIG_TITLE','LBL_ASOL_CONFIG_DESC','./index.php?module=Administration&action=asolConfig');
$admin_option_defs['Administration']['asol_repair']= array('asolAdministration','LBL_ASOL_REPAIR_TITLE','LBL_ASOL_REPAIR_DESC','./index.php?module=Administration&action=asolRepair');

$admin_group_header[]= array('LBL_ASOL_CONFIG_TITLE','',false,$admin_option_defs, 'LBL_ASOL_ADMIN_PANEL_DESC');




$admin_option_defs=array();
$admin_option_defs['Administration']['asol_reports_validations']= array('asol_Reports',translate('LBL_REPORT_CHECK_ACTION', 'asol_Reports'),translate('LBL_REPORT_CHECK_ACTION', 'asol_Reports'),'./index.php?module=asol_Reports&action=CheckConfigurationDefs');
$admin_group_header[]= array(translate('LBL_ASOL_REPORTS_TITLE', 'asol_Reports'),'',false,$admin_option_defs, translate('LBL_ASOL_REPORTS_PANEL_DESC', 'asol_Reports'));




//global $mod_strings;

$admin_option_defs=array();
$admin_option_defs['Administration']['asol_wfm'] = array('asolAdministration','LBL_ASOL_WORKFLOWMANAGER','LBL_ASOL_WORKFLOWMANAGER_DESC','./index.php?module=asol_Process&action=index');
$admin_option_defs['Administration']['asol_wfm_2'] = array('asolAdministration','LBL_ASOL_CLEANUP','LBL_ASOL_CLEANUP_DESC','./index.php?module=asol_Process&action=cleanup');
$admin_option_defs['Administration']['asol_wfm_3'] = array('asolAdministration','LBL_ASOL_MONITOR','LBL_ASOL_MONITOR_DESC','./index.php?module=asol_WorkingNodes&action=index');
$admin_option_defs['Administration']['asol_wfm_4'] = array('asolAdministration','LBL_ASOL_REBUILD','LBL_ASOL_REBUILD_DESC','./index.php?module=asol_Process&action=rebuild');
$admin_option_defs['Administration']['asol_wfm_5'] = array('asolAdministration','LBL_ASOL_CHECKCONFIGURATIONDEFS','LBL_ASOL_CHECKCONFIGURATIONDEFS_DESC','./index.php?module=asol_Process&action=CheckConfigurationDefs');
$admin_option_defs['Administration']['asol_wfm_6'] = array('asolAdministration','LBL_ABOUT_WFM','LBL_ABOUT_WFM_DESC','./index.php?module=asol_Process&action=About');

$admin_group_header[]= array('LBL_ASOL_WFM_PANEL','',false,$admin_option_defs, 'LBL_ASOL_WFM_PANEL_DESC');




global $app_list_strings;

$admin_option_defs=array();
$admin_option_defs['Administration']['DHA_PlantillasDocumentos_validations']= array(
   'DHA_PlantillasDocumentos',
   translate('LBL_MODULE_CONFIG_DESC', 'DHA_PlantillasDocumentos'),
   translate('LBL_MODULE_CONFIG_DESC', 'DHA_PlantillasDocumentos'),
   './index.php?module=DHA_PlantillasDocumentos&action=Configuration'
);
   
$admin_group_header[]= array(
   $app_list_strings['moduleList']['DHA_PlantillasDocumentos'], //translate('LBL_MODULE_TITLE', 'DHA_PlantillasDocumentos'),
   '',
   false,
   $admin_option_defs, 
   translate('LBL_MODULE_CONFIG_SECTION_DESC', 'DHA_PlantillasDocumentos')
);



if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$admin_option_defs=array();
$admin_option_defs['Administration']['ZuckerReports2Config']= array('zuckerreports','LBL_MANAGE_ZUCKERREPORTS2CONFIG','LBL_ZUCKERREPORTS2CONFIG','./index.php?module=Configurator&action=ZuckerReports2Config');
$admin_group_header[]=array('LBL_ZUCKERREPORTS2CONFIG_TITLE','',false,$admin_option_defs, 'LBL_ZUCKERREPORTS2CONFIG_DESC');



?>