<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name = 'zr2_ReportParameterLink';
$listViewDefs[$module_name] = array(
	'NAME' => array(
		'width' => '32', 
		'label' => 'LBL_NAME', 
		'default' => true,
        'link' => true),         
	'zr2_reportparameterlink_zr2_reporttemplate_name' => array(
		'width' => '32', 
		'label' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE', 
		'default' => true,
		'link' => false),         
	'zr2_reportparameterlink_zr2_querytemplate_name' => array(
		'width' => '32', 
		'label' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE', 
		'default' => true,
		'link' => false),         
	'zr2_reportparameterlink_zr2_reportparameter_name' => array(
		'width' => '32', 
		'label' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE', 
		'default' => true,
		'link' => false),  
	'ASSIGNED_USER_NAME' => array(
		'width' => '9', 
		'label' => 'LBL_ASSIGNED_TO_NAME',
		'module' => 'Employees',
        'id' => 'ASSIGNED_USER_ID',
        'default' => true),
	
);
?>
