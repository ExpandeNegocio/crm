<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings;

$popupMeta = array('moduleMain' => 'WF_User',
						'varName' => 'WF_USER',
						'orderBy' => 'wf_module',
//						'whereClauses' => 
//							array('module' => 'budgets.name'),
						'searchInputs' =>
							array('wf_module','wf_type','role','kind','user_name'),
						'listviewdefs' => array(
							'WF_MODULE' => array (
								'width'   => '30',  
								'label'   => 'LBL_WF_MODULE', 
								'link'    => true,
							'default' => true),
							'WF_TYPE' => array (
								'width'   => '30',  
								'label'   => 'LBL_WF_TYPE', 
							'default' => true),
							'ROLE' => array (
								'width'   => '30',  
								'label'   => 'LBL_ROLE', 
							'default' => true),
							'KIND' => array (
								'width'   => '30',  
								'label'   => 'LBL_KIND', 
							'default' => true),
							'USER_ID' => array (
								'width'   => '30',  
								'label'   => 'LBL_USER_ID', 
							'default' => true),
                                                ),
						'searchdefs'   => array(
										 	'wf_module', 'wf_type', 'kind','user_id' 
										  )
						);


?>
