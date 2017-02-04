<?php
$dictionary['zr2_Report'] = array(
	'table' => 'zr2_report',
	'fields' => array (
		'filename' => array (
			'name' => 'filename',
			'type' => 'varchar',
			'vname' => 'LBL_REPORT_FILENAMENAME',
			),
		'icon_url' => array (
			'name' => 'icon_url',
			'type' => 'varchar',
			'source' => 'non-db',
			),
	),
);

if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('zr2_Report','zr2_Report', array('basic','assignable'));
?>
