<?php
 
global $current_user;

$bean = $GLOBALS['FOCUS'];

$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_users_1'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'ForAsolProject',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_USERS_1_FROM_USERS_TITLE',
  'get_subpanel_data' => 'asol_project_users_1',
  'top_buttons' => array (), 
);

if (($current_user->id == $bean->assigned_user_id) || $current_user->is_admin) {
	$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_users_1']['top_buttons'][] =  
		array (
		      'widget_class' => 'SubPanelTopSelectButton',
		      'mode' => 'MultiSelect',
		);
}

