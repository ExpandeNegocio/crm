<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$listViewDefs['WF_Users'] = array(
  'WF_MODULE' => array(
    'width' => '40', 
    'label' => 'LBL_LIST_WF_MODULE', 
    'link' => true,
    'default' => true
  ),
  'WF_TYPE' => array(
    'width' => '40', 
    'label' => 'LBL_LIST_WF_TYPE', 
    'default' => true
  ),
  'ROLE' => array(
    'width' => '40', 
    'label' => 'LBL_LIST_ROLE', 
    'default' => true
  ),
  'KIND' => array(
    'width' => '40', 
    'label' => 'LBL_LIST_KIND', 
    'default' => true
  ),
  'USER_NAME' => array(
      'width' => '25',
      'label' => 'LBL_USER_NAME',
      'id'=>'USER_ID',
      'link' => true,
      'default' => true,
      'sortable' => true,
      'module'  => 'Users',
      'ACLTag' => 'USERS',
      'related_fields' => array('user_id')),
);
?>
