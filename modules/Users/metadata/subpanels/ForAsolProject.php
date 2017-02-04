<?php
// created: 2014-03-20 14:24:06
$subpanel_layout['list_fields'] = array (
  'user_name' => 
  array (
    'vname' => 'LBL_LIST_USER_NAME',
    'width' => '25%',
    'default' => true,
  ),
  'email1' => 
  array (
    'vname' => 'LBL_LIST_EMAIL',
    'width' => '25%',
    'default' => true,
  ),
  'phone_work' => 
  array (
    'vname' => 'LBL_LIST_PHONE',
    'width' => '21%',
    'default' => true,
  ),
  /*
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Users',
    'width' => '4%',
    'linked_field' => 'users',
    'default' => true,
  ),
  */
  'first_name' => 
  array (
    'usage' => 'query_only',
  ),
  'last_name' => 
  array (
    'usage' => 'query_only',
  ),
);

global $current_user;

$asolProject = $GLOBALS['FOCUS']; // AsolProject

if (($current_user->id == $asolProject->assigned_user_id) || $current_user->is_admin) {
	$subpanel_layout['list_fields']['remove_button'] =  array (
	    'vname' => 'LBL_REMOVE',
	    'widget_class' => 'SubPanelRemoveButton',
	    'module' => 'Users',
	    'width' => '4%',
	    'linked_field' => 'users',
	    'default' => true,
	);
}