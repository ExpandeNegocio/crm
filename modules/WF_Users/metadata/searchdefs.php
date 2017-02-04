<?php

$searchdefs ['WF_Users'] = array ( 
  'layout' => array (
    'basic_search' => array (
      'role' => array('name'=>'role','query_type'=>'default'),
      'kind' => array('name'=>'kind','query_type'=>'default'),
      'user_name' => array('name'=>'user_name','query_type'=>'default','db_field'=>array('users.name')),
      'wf_module' => array (
        'name' => 'wf_module',
        'default' => true,
        'width' => '10%',
      ),
      'wf_type' => array('name'=>'wf_type','query_type'=>'default'),
    ),
    'advanced_search' => array (
      'role' => array('name'=>'role','query_type'=>'default'),
      'kind' => array('name'=>'kind','query_type'=>'default'),
      'user_name' => array('name'=>'user_name','query_type'=>'default','db_field'=>array('users.name')),
      'wf_module' => array (
        'name' => 'wf_module',
        'default' => true,
        'width' => '10%',
      ),
      'wf_type' => array('name'=>'wf_type','query_type'=>'default'),
    ),
    'templateMeta' => array (
      'maxColumns' => '3',
      'maxColumnsBasic' => '4', 
      'widths' => array (
        'label' => '10',
        'field' => '30',
      ),
    ),
  ),
);
?>
