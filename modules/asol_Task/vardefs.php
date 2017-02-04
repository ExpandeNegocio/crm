<?php

$dictionary['asol_Task'] = array(
	'table'=>'asol_task',
	'audited'=>true,
	'fields'=>array (
  'delay_type' => 
  array (
    'required' => false,
    'name' => 'delay_type',
    'vname' => 'LBL_DELAY_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'no_delay',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_task_delay_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'delay' => 
  array (
    'required' => false,
    'name' => 'delay',
    'vname' => 'LBL_DELAY',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '255',
    'size' => '20',
  ),
  'task_type' => 
  array (
    'required' => false,
    'name' => 'task_type',
    'vname' => 'LBL_TASK_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'send_email',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_task_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'task_order' => 
  array (
    'required' => false,
    'name' => 'task_order',
    'vname' => 'LBL_TASK_ORDER',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '2',
    'size' => '20',
  	'default' => '0',
  ),

  'task_implementation' =>
  array(
  	'required' => false,
    'name' => 'task_implementation',
    'vname' => 'LBL_TASK_IMPLEMENTATION',
    'type' => 'text',
  ),
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('asol_Task','asol_Task', array('basic','assignable'));