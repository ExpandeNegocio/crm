<?php
 if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dictionary['WF_User'] = array(
  'table' => 'wf_users',
  'unified_search' => true,
  'fields' => array (
        'wf_module' => array (
          'name' => 'wf_module',
          'vname' => 'LBL_WF_MODULE',
          'type' => 'enum',
          'function' => 'wf_getModulesList',
          'required' => true,
        ),
        'wf_type' => array (
          'name' => 'wf_type',
          'vname' => 'LBL_WF_TYPE',
          'type' => 'enum',
          'function' => 'wf_getTypes',
          'required' => true,
        ),
        'role' => array (
          'name' => 'role',
          'vname' => 'LBL_ROLE',
          'type' => 'enum',
          'function' => 'wf_getRoles',
          'required' => true,
        ),
        'kind' => array (
          'name' => 'kind',
          'vname' => 'LBL_KIND',
          'type' => 'enum',
          'options' => 'wf_users_kinds_dom',
          'required' => true,
        ),
        'user_id' => array(
            'name' => 'user_id',
            'vname' => 'LBL_USER_ID',
            'required' => true,
            'type' => 'id',
            'reportable' => false,
            'importable' => 'required',
            'required' => true,
        ),
        'user_name'=>    array(
            'name'=>'user_name',
            'rname'=>'name',
            'id_name'=>'user_id',
            'vname'=>'LBL_USER_NAME',
            'type'=>'relate',
            'join_name'=>'users',
            'table'=>'users',
            'isnull'=>'true',
            'module'=>'Users',
            'link'=>'user_name_link',
            'massupdate'=>false,
            'source'=>'non-db'
        ),
        'user_name_link' => array (
            'name' => 'user_name_link',
            'type' => 'link',
            'relationship' => 'users_workflow',
            'vname' => 'LBL_USER_NAME',
            'link_type' => 'one',
            'module'=>'Users',
            'bean_name'=>'User',
            'source'=>'non-db',
        ),
  ),
);
VardefManager::createVardef('WF_Users', 'WF_User', array('default'));
?>
