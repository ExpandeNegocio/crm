<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name = 'asol_Task';
$object_name = 'asol_Task';
$_module_name = 'asol_task';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => 'name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							'whereStatement' => 'asol_task.id NOT IN (
																		SELECT DISTINCT asol_activf613ol_task_idb 
																		FROM asol_activity_asol_task_c 
																		WHERE deleted = 0
																	) 
											',
						);
?>
 
 