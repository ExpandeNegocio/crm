<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $current_user;

$dashletData['asol_OnHoldDashlet']['searchFields'] = 
	array(
			'date_entered' => array('default' => ''),
			'date_modified'    => array('default' => ''),
			'assigned_user_id' => array(
										'type' => 'assigned_user_name', 
										'default' => $current_user->name
									)
	);
	
$dashletData['asol_OnHoldDashlet']['columns'] = 
	array( 
			'name' => array(
								'width' => '30', 
								'label' => 'LBL_LIST_NAME',
								'link' => false,
								'default' => true
						),
			'trigger_module' => array(
										'width' => '10', 
										'label' => 'LBL_TRIGGER_MODULE',
										'default' => true
								),
			'bean_id' => array(
								'width' => '10', 
								'label' => 'LBL_BEAN_ID',
								'default' => true
							),
			'process_instance_id' => array(
											'width' => '10', 
											'label' => 'LBL_PROCESS_INSTANCE_ID',
											'default' => true
									),
			'working_node_id' => array(
										'width' => '10', 
										'label' => 'LBL_WORKING_NODE_ID',
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