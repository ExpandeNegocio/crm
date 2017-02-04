<?php

$admin_option_defs=array();
$admin_option_defs['Administration']['asol_reports_validations']= array('asol_Reports',translate('LBL_REPORT_CHECK_ACTION', 'asol_Reports'),translate('LBL_REPORT_CHECK_ACTION', 'asol_Reports'),'./index.php?module=asol_Reports&action=CheckConfigurationDefs');
$admin_group_header[]= array(translate('LBL_ASOL_REPORTS_TITLE', 'asol_Reports'),'',false,$admin_option_defs, translate('LBL_ASOL_REPORTS_PANEL_DESC', 'asol_Reports'));

?>