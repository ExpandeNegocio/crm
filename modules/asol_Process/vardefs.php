<?php

$dictionary['asol_Process'] = array(
	'table'=>'asol_process',
	'audited'=>true,
	'fields'=>array (
		  'status' => 
		  array (
		    'required' => false,
		    'name' => 'status',
		    'vname' => 'LBL_STATUS',
		    'type' => 'enum',
		    'massupdate' => 0,
		    'default' => 'inactive',
		    'comments' => '',
		    'help' => '',
		    'importable' => 'true',
		    'duplicate_merge' => 'disabled',
		    'duplicate_merge_dom_value' => '0',
		    'audited' => false,
		    'reportable' => true,
		    'len' => 100,
		    'size' => '20',
		    'options' => 'wfm_process_status_list',
		    'studio' => 'visible',
		    'dependency' => false,
		  //'popupHelp' => 'click help',
		  //'help' => 'hover help',
		  ),
		  'trigger_module' => 
		  array (
		    'required' => true,
		    'name' => 'trigger_module',
		    'vname' => 'LBL_TRIGGER_MODULE',
		    'type' => 'enum',
		    'massupdate' => 0,
		    'comments' => '',
		    'help' => '',
		    'importable' => 'true',
		    'duplicate_merge' => 'disabled',
		    'duplicate_merge_dom_value' => '0',
		    'audited' => false,
		    'reportable' => true,
		    'len' => 100,
		    'size' => '20',
		    'options' => 'moduleList',
		    'studio' => 'visible',
		    'dependency' => false,
		  ),
		  
		  'alternative_database' =>
		  array (
		    'name' => 'alternative_database',
		    'vname' => 'LBL_REPORT_USE_ALTERNATIVE_DB',
		    'type' => 'varchar',
		    'len' => '255',
		    'default' => '-1', 
		    'comment' => 'Non CRM Database usage definition',
		  ),
		  
	),
	'relationships'=>array (
	),
	'optimistic_locking'=>true,
);
if (!class_exists('VardefManager')){
	require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('asol_Process','asol_Process', array('basic','assignable'));