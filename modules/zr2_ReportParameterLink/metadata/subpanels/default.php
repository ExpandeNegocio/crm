<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name='zr2_ReportParameterLink';
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
	 		'width' => '20%',
		),
		'zr2_reportparameterlink_zr2_reporttemplate_name'=>array(
	 		'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTTEMPLATE_FROM_ZR2_REPORTTEMPLATE_TITLE',
	 		'width' => '20%',
		),
		'zr2_reportparameterlink_zr2_querytemplate_name'=>array(
	 		'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_QUERYTEMPLATE_FROM_ZR2_QUERYTEMPLATE_TITLE',
	 		'width' => '20%',
		),
		'zr2_reportparameterlink_zr2_reportparameter_name'=>array(
	 		'vname' => 'LBL_ZR2_REPORTPARAMETERLINK_ZR2_REPORTPARAMETER_FROM_ZR2_REPORTPARAMETER_TITLE',
	 		'width' => '20%',
		),
		'date_modified'=>array(
	 		'vname' => 'LBL_DATE_MODIFIED',
	 		'width' => '20%',
		),
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
	),
);

?>