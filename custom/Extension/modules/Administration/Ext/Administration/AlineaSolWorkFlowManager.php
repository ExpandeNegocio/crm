<?php

//global $mod_strings;

$admin_option_defs=array();
$admin_option_defs['Administration']['asol_wfm'] = array('asolAdministration','LBL_ASOL_WORKFLOWMANAGER','LBL_ASOL_WORKFLOWMANAGER_DESC','./index.php?module=asol_Process&action=index');
$admin_option_defs['Administration']['asol_wfm_2'] = array('asolAdministration','LBL_ASOL_CLEANUP','LBL_ASOL_CLEANUP_DESC','./index.php?module=asol_Process&action=cleanup');
$admin_option_defs['Administration']['asol_wfm_3'] = array('asolAdministration','LBL_ASOL_MONITOR','LBL_ASOL_MONITOR_DESC','./index.php?module=asol_WorkingNodes&action=index');
$admin_option_defs['Administration']['asol_wfm_4'] = array('asolAdministration','LBL_ASOL_REBUILD','LBL_ASOL_REBUILD_DESC','./index.php?module=asol_Process&action=rebuild');
$admin_option_defs['Administration']['asol_wfm_5'] = array('asolAdministration','LBL_ASOL_CHECKCONFIGURATIONDEFS','LBL_ASOL_CHECKCONFIGURATIONDEFS_DESC','./index.php?module=asol_Process&action=CheckConfigurationDefs');
$admin_option_defs['Administration']['asol_wfm_6'] = array('asolAdministration','LBL_ABOUT_WFM','LBL_ABOUT_WFM_DESC','./index.php?module=asol_Process&action=About');

$admin_group_header[]= array('LBL_ASOL_WFM_PANEL','',false,$admin_option_defs, 'LBL_ASOL_WFM_PANEL_DESC');

?>