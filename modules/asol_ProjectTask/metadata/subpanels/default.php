<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name='asol_ProjectTask';
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
	 		'width' => '45%',
		),
		'date_modified'=>array(
	 		'vname' => 'LBL_DATE_MODIFIED',
	 		'width' => '45%',
		),
		/*
		'edit_button'=>array(
			'widget_class' => 'SubPanelEditButton',
		 	'module' => $module_name,
	 		'width' => '4%',
		),
		'remove_button'=>array(
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => $module_name,
			'width' => '5%',
		),
		*/
	),
);

global $current_user;

$bean = $GLOBALS['FOCUS'];

if (($current_user->id == $bean->assigned_user_id) || $current_user->is_admin) {
	$subpanel_layout['list_fields']['remove_button'] =  array (
	    'vname' => 'LBL_REMOVE',
	    'widget_class' => 'SubPanelRemoveButton',
	    'module' => 'Users',
	    'width' => '4%',
	    'linked_field' => 'users',
	    'default' => true,
	);
}

?>