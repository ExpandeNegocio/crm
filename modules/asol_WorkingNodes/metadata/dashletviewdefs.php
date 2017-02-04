<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $current_user;

$dashletData['asol_WorkingNodesDashlet']['searchFields'] = 
	array(
			'date_entered'     => array('default' => ''),
			'date_modified'    => array('default' => ''),
			'assigned_user_id' => array(
										'type'    => 'assigned_user_name', 
										'default' => $current_user->name
									)
	);

$dashletData['asol_WorkingNodesDashlet']['columns'] =  
	array(   
			'name' => array(
							'width'   => '30', 
							'label'   => 'LBL_LIST_NAME',
							'link'    => false,
							'default' => true
						),
			'event' => array(
								'width'   => '10', 
								'label'   => 'LBL_EVENT',
								'link'    => true,
								'default' => true
						),
			'current_activity' => array(
										'width'   => '10', 
										'label'   => 'LBL_CURRENT_ACTIVITY',
										'link'    => true,
										'default' => true
									),
			'current_task' => array(
									'width'   => '10', 
									'label'   => 'LBL_CURRENT_TASK',
									'link'    => true,
									'default' => true
								),
			'status' => array(
								'width'   => '10', 
								'label'   => 'LBL_STATUS',
								'default' => true
						),  
			'date_entered' => array(
									'width'   => '5', 
									'label'   => 'LBL_DATE_ENTERED',
									'default' => true
								),
			'date_modified' => array(
									'width'   => '5', 
									'label'   => 'LBL_DATE_MODIFIED',
									'default' => true
								),    
			'created_by' => array(
									'width'   => '8', 
									'label'   => 'LBL_CREATED'
							),
			'assigned_user_name' => array(
											'width'   => '8', 
											'label'   => 'LBL_LIST_ASSIGNED_USER'
									),
	);