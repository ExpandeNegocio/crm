<?php
$dictionary['zr2_ReportParameter'] = array(
	'table' => 'zr2_reportparameter',
	'fields' => array (
		'friendly_name' => array (
			'name' => 'friendly_name',
			'vname' => 'LBL_PARAM_FRIENDLYNAME',
			'required' => true,
			'type' => 'varchar',
			'len' => 255,
			),
		'default_name' => array (
			'name' => 'default_name',
			'vname' => 'LBL_PARAM_DEFAULTNAME',
			'required' => true,
			'type' => 'varchar',
			'len' => 255,
			),
		'default_value' => array (
			'name' => 'default_value',
			'vname' => 'LBL_PARAM_DEFAULTVALUE',
			'required' => false,
			'type' => 'varchar',
			'len' => 255,
			),
		'range_name' => array (
			'name' => 'range_name',
			'vname' => 'LBL_PARAM_RANGE',
			'required' => true,
			'type' => 'enum',
			'options' => 'PARAM_RANGE_TYPES',
			'len' => 255,
			'massupdate' => false
			),
		'range_options' => array (
			'name' => 'range_options',
			'vname' => 'LBL_PARAM_RANGE_OPTIONS',
			'required' => false,
			'type' => 'text',
			),
		'range_description' => array (
			'name' => 'range_description',
			'type' => 'varchar',
			'source' => 'non-db',
			),
		),
);

if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('zr2_ReportParameter','zr2_ReportParameter', array('basic','assignable'));
?>
