<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $current_user;

$dashletData['asol_ProcessInstancesDashlet']['searchFields'] = 
	array(
			'date_entered' => array('default' => ''),
			'date_modified' => array('default' => ''),
			'assigned_user_id' => array(
										'type' => 'assigned_user_name', 
										'default' => $current_user->name
									),
	);
																								
$dashletData['asol_ProcessInstancesDashlet']['columns'] = 
	array(
			'name' => array(
							'width'	=> '30',
							'label'	=> 'LBL_LIST_NAME',
							'link' => false,
							'default' => true
						), 
			'process_id' => array(
									'width' => '10', 
									'label' => 'LBL_PROCESS_ID',
									'link' => true,
									'default' => true
							),
			'date_entered' => array(
									'width' => '5', 
									'label' => 'LBL_DATE_ENTERED',
									'default' => true
							),
			'date_modified' => array(
										'width' => '5', 
										'label' => 'LBL_DATE_MODIFIED',
										'default' => true
								),
			'created_by' => array(
									'width' => '8', 
									'label' => 'LBL_CREATED'
							),
			'assigned_user_name' => array(
											'width' => '8', 
											'label' => 'LBL_LIST_ASSIGNED_USER'
									),  
	);