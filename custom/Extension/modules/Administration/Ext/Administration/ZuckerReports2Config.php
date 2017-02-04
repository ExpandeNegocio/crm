<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$admin_option_defs=array();
$admin_option_defs['Administration']['ZuckerReports2Config']= array('zuckerreports','LBL_MANAGE_ZUCKERREPORTS2CONFIG','LBL_ZUCKERREPORTS2CONFIG','./index.php?module=Configurator&action=ZuckerReports2Config');
$admin_group_header[]=array('LBL_ZUCKERREPORTS2CONFIG_TITLE','',false,$admin_option_defs, 'LBL_ZUCKERREPORTS2CONFIG_DESC');

?>
