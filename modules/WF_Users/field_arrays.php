<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$fields_array['WF_User'] = array (

  'column_fields' => array(
    "id",
    "name",
    "date_entered",
    "date_modified",
    "modified_user_id",
    "created_by",
    "wf_module",
    "wf_type",
    "role",
    "kind",
    "user_id"
  ),

  'list_fields' => array (
    'id', 
    "wf_module",
    "wf_type",
    'role', 
    'kind',
    'user_id'
  ),

//  'required_fields' => array ('name'=>1, 'project_id' => 2),

);
?>
