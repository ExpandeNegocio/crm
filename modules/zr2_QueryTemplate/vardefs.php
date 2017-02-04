<?php
$dictionary['zr2_QueryTemplate'] = array(
	'table' => 'zr2_querytemplate',
	'fields' => array (
		'sql1' => 
			array (
			  'name' => 'sql1',
			  'vname' => 'LBL_QUERY_SQL',
			  'required' => true,
			  'type' => 'text',
			),
		'image_html' => array (
			'name' => 'image_html',
			'type' => 'varchar',
			'source' => 'non-db',
			),
		'action_module' => array (
			'name' => 'action_module',
			'type' => 'varchar',
			'source' => 'non-db',
			),
		'type_desc' => array (
			'name' => 'type_desc',
			'type' => 'varchar',
			'source' => 'non-db',
			),			
	),
);

if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('zr2_QueryTemplate','zr2_QueryTemplate', array('basic','assignable'));

?>
