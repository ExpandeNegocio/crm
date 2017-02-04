<?php
$dictionary['zr2_ReportTemplate'] = array(
	'table' => 'zr2_reporttemplate',
	'fields' => array (
		'filename' => array (
			'name' => 'filename',
			'vname' => 'LBL_REPORT_FILENAME',
			'required' => false,
			'type' => 'varchar',
			'len' => 255,
			),
		'export_as' => array (
			'name' => 'export_as',
			'vname' => 'LBL_REPORT_EXPORT_AS',
			'required' => false,
			'type' => 'varchar',
			'len' => 255,
			),
		'error_message' => array(	
			'name' => 'error_message',
			'vname' => 'LBL_REPORT_ERROR_MESSAGE',
			'required' => false,
			'type' => 'text',
			),
		'template_url' => array (
			'name' => 'template_url',
			'type' => 'varchar',
			'source' => 'non-db',
			),
		'compiled_filename' => array (
			'name' => 'compiled_filename',
			'type' => 'varchar',
			'source' => 'non-db',
			),
		'resources_folder' => array (
			'name' => 'resources_folder',
			'type' => 'varchar',
			'source' => 'non-db',
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
VardefManager::createVardef('zr2_ReportTemplate','zr2_ReportTemplate', array('basic','assignable'));

?>
