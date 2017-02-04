<?php

$dictionary['zr2_ReportParameterLink'] = array(
	'table' => 'zr2_reportparameterlink',
	'fields' => array (
		'default_value' => array (
			'name' => 'default_value',
			'vname' => 'LBL_PARAM_LINK_DEFAULTVALUE',
			'required' => false,
			'type' => 'varchar',
			'len' => 255,
			),
		'bind_to_module_name' => array (
			'name' => 'bind_to_module_name',
			'vname' => 'LBL_PARAM_LINK_MODULENAME',
			'required' => false,
			'type' => 'varchar',
			'len' => 255,
			),			
		'friendly_name' => array (
			'name' => 'friendly_name',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_PARAM_LINK_PARAM'
			),
		'range_description' => array (
			'name' => 'range_description',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_PARAM_LINK_RANGE'
		),
	),
);

if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('zr2_ReportParameterLink','zr2_ReportParameterLink', array('basic','assignable'));


?>
