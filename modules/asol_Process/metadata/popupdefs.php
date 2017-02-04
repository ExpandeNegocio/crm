<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$module_name = 'asol_Process';
$object_name = 'asol_Process';
$_module_name = 'asol_process';
$popupMeta = array('moduleMain' => $module_name,
						'varName' => $object_name,
						'orderBy' => 'name',
						'whereClauses' => 
							array('name' => $_module_name . '.name', 
								),
						    'searchInputs'=> array($_module_name. '_number', 'name', 'priority','status'),
							
								
						);
?>
 
 