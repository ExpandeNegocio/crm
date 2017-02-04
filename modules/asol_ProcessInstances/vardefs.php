<?php

$dictionary['asol_ProcessInstances'] = array(
	'table'=>'asol_processinstances',
	'audited'=>true,
	'fields'=>array (
  'asol_process_id_c' => 
  array (
    'required' => false,
    'name' => 'asol_process_id_c',
    'vname' => '',
    'type' => 'id',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => true,
    'len' => 36,
    'size' => '20',
  ),
  'process_id' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'process_id',
    'vname' => 'LBL_PROCESS_ID',
    'type' => 'relate',
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
    'id_name' => 'asol_process_id_c',
    'ext2' => 'asol_Process',
    'module' => 'asol_Process',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  /*
  'trigger_module' => 
  array (
    'required' => false,
    'name' => 'trigger_module',
    'vname' => 'LBL_TRIGGER_MODULE',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '100',
    'size' => '20',
  ),
  */
  /*
  'bean_id' => 
  array (
    'required' => false,
    'name' => 'bean_id',
    'vname' => 'LBL_BEAN_ID',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '36',
    'size' => '20',
  ),
  */
  /*
  'bean_id' => 
  array (
    'name' => 'bean_id',
    'type' => 'longtext',
    'isnull' => true,
  ),
  */
  'bean_ungreedy_count' => 
  array (
    'required' => false,
    'name' => 'bean_ungreedy_count',
    'vname' => 'LBL_BEAN_UNGREEDY_COUNT',
    'type' => 'int',
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
    'disable_num_format' => '',
  ),
  'asol_processinstances_id_c' => 
  array (
    'required' => false,
    'name' => 'asol_processinstances_id_c',
    'vname' => '',
    'type' => 'id',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => true,
    'len' => 36,
    'size' => '20',
  ),
  'parent_process_instance_id' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'parent_process_instance_id',
    'vname' => 'LBL_PARENT_PROCESS_INSTANCE_ID',
    'type' => 'relate',
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
    'id_name' => 'asol_processinstances_id_c',
    'ext2' => 'asol_ProcessInstances',
    'module' => 'asol_ProcessInstances',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('asol_ProcessInstances','asol_ProcessInstances', array('basic','assignable'));