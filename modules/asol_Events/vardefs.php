<?php

$dictionary['asol_Events'] = array(
	'table'=>'asol_events',
	'audited'=>true,
	'fields'=>array (

  'type' => 
  array (
    'required' => false,
    'name' => 'type',
    'vname' => 'LBL_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'start',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_events_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'trigger_type' => 
  array (
    'required' => false,
    'name' => 'trigger_type',
    'vname' => 'LBL_TRIGGER_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    //'default' => 'logic_hook',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_trigger_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'trigger_event' => 
  array (
    'required' => false,
    'name' => 'trigger_event',
    'vname' => 'LBL_TRIGGER_EVENT',
    'type' => 'enum',
    'massupdate' => 0,
    //'default' => 'on_create',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_trigger_event_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'conditions' => 
  array (
    'required' => false,
    'name' => 'conditions',
    'vname' => 'LBL_CONDITIONS',
    'type' => 'text',
  ),
  
  'scheduled_tasks' => 
  array (
    'required' => false,
    'name' => 'scheduled_tasks',
    'vname' => 'LBL_SCHEDULED_TASKS',
    'type' => 'text',
  ),
  
  'scheduled_type' => 
  array (
    'required' => false,
    'name' => 'scheduled_type',
    'vname' => 'LBL_SCHEDULED_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    //'default' => 'sequential',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_scheduled_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'subprocess_type' => 
  array (
    'required' => false,
    'name' => 'subprocess_type',
    'vname' => 'LBL_SUBPROCESS_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    //'default' => 'sequential',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'wfm_subprocess_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  
  'module_fields' =>
  array (
      'name' => 'module_fields',
      'type' => 'varchar',
      'source'=>'non-db',
      'vname'=>'LBL_ASOL_MODULE_FIELDS',
  ),
  
  'module_conditions' =>
  array (
      'name' => 'module_conditions',
      'type' => 'varchar',
      'source'=>'non-db',
      'vname'=>'LBL_CONDITIONS',
  ),

  'trigger_module' =>
  array (
      'name' => 'trigger_module',
      'type' => 'varchar',
      'source'=>'non-db',
      'vname'=>'LBL_ASOL_TRIGGER_MODULE',
  ),
  
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('asol_Events','asol_Events', array('basic','assignable'));