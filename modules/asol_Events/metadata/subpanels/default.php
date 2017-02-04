<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name='asol_Events';
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
		'trigger_type'=>array(
			'vname' => 'LBL_TRIGGER_TYPE',
			'width' => '10%',
		),
		'trigger_event'=>array(
			'vname' => 'LBL_TRIGGER_EVENT',
			//'widget_class' => 'SubPanelEventTrigger',
			'width' => '10%',
		),
		'type'=>array(
			'vname' => 'LBL_TYPE',
			'width' => '10%',
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