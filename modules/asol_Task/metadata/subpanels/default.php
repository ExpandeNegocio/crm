<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name='asol_Task';
$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => $module_name),
	),

	'where' => '',

	'list_fields' => array(
		'name'=>array(
	 		'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
	 		'width' => '30%',
		),
		'task_type' => array(
			'width' => '10%',
		    'name' => 'task_type',
		    'vname' => 'LBL_TASK_TYPE',
		),
		'delay_type' => array(
			'width' => '10%',
		    'name' => 'delay_type',
		    'vname' => 'LBL_DELAY_TYPE',
		),
		'delay' => array(
			'width' => '10%',
		    'name' => 'delay',
		    'vname' => 'LBL_DELAY',
		),
		'task_order' => array (
			'width' => '10%',
		    'name' => 'task_order',
		    'vname' => 'LBL_TASK_ORDER',
		),
		
		'date_entered'=>array(
	 		'vname' => 'LBL_DATE_ENTERED',
	 		'width' => '5%',
		),
		'date_modified'=>array(
	 		'vname' => 'LBL_DATE_MODIFIED',
	 		'width' => '5%',
		),
		'edit_button'=>array(
			'widget_class' => 'SubPanelEditButton',
		 	'module' => $module_name,
	 		'width' => '5%',
		),
		'remove_button'=>array(
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => $module_name,
			'width' => '5%',
		),
	),
);

?>