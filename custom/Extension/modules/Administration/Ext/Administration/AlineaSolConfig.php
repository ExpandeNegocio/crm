<?php

$admin_option_defs=array();
$admin_option_defs['Administration']['asol_config']= array('asolAdministration','LBL_ASOL_CONFIG_TITLE','LBL_ASOL_CONFIG_DESC','./index.php?module=Administration&action=asolConfig');
$admin_option_defs['Administration']['asol_repair']= array('asolAdministration','LBL_ASOL_REPAIR_TITLE','LBL_ASOL_REPAIR_DESC','./index.php?module=Administration&action=asolRepair');

$admin_group_header[]= array('LBL_ASOL_CONFIG_TITLE','',false,$admin_option_defs, 'LBL_ASOL_ADMIN_PANEL_DESC');

?>