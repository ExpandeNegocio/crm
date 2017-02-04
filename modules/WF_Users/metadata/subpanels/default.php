<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
		$subpanel_layout = array(
	
		'top_buttons' => array(
		),
	
		'where' => '',
	
	
		'list_fields' => array(
	        'name'=>array(
			 	'vname' => 'LBL_LIST_NAME',
				'widget_class' => 'SubPanelDetailViewLink',
				'width' => '70%',
			),
			'wf_module'=>array(
			 	'vname' => 'LBL_WF_MODULE',
				'width' => '15%',
			),
			'wf_type'=>array(
			 	'vname' => 'LBL_WF_TYPE',
				'width' => '15%',
			),
			'role'=>array(
			 	'vname' => 'LBL_ROLE',
				'width' => '15%',
			),
			'kind'=>array(
			 	'vname' => 'LBL_KIND',
				'width' => '15%',
			),
			'user_name'=>array(
			 	'vname' => 'LBL_USER_NAME',
				'width' => '15%',
			),
		),
	);
?>
