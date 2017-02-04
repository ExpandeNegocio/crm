<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2014-02-26 13:28:27
$layout_defs["asol_Project"]["subpanel_setup"]['activities'] = array (
  'order' => 10,
  'sort_order' => 'desc',
  'sort_by' => 'date_start',
  'title_key' => 'LBL_ACTIVITIES_SUBPANEL_TITLE',
  'type' => 'collection',
  'subpanel_name' => 'activities',
  'module' => 'Activities',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateTaskButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopScheduleMeetingButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopScheduleCallButton',
    ),
    3 => 
    array (
      'widget_class' => 'SubPanelTopComposeEmailButton',
    ),
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'asol_project_activities_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'asol_project_activities_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'asol_project_activities_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["asol_Project"]["subpanel_setup"]['history'] = array (
  'order' => 20,
  'sort_order' => 'desc',
  'sort_by' => 'date_modified',
  'title_key' => 'LBL_HISTORY',
  'type' => 'collection',
  'subpanel_name' => 'history',
  'module' => 'History',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateNoteButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopArchiveEmailButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopSummaryButton',
    ),
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'asol_project_activities_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'asol_project_activities_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'asol_project_activities_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'asol_project_activities_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'asol_project_activities_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


 // created: 2014-02-26 13:28:27
$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_asol_projecttask'] = array (
  'order' => 100,
  'module' => 'asol_ProjectTask',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECTTASK_TITLE',
  'get_subpanel_data' => 'asol_project_asol_projecttask',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);




 // created: 2014-02-26 13:28:27
$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_contacts'] = array (
  'order' => 100,
  'module' => 'Contacts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_CONTACTS_FROM_CONTACTS_TITLE',
  'get_subpanel_data' => 'asol_project_contacts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


 
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




global $current_user;

$bean = $GLOBALS['FOCUS'];

$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_users'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'ForAsolProject',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_USERS_FROM_USERS_TITLE',
  'get_subpanel_data' => 'asol_project_users',
  'top_buttons' => array (), 
);

if (($current_user->id == $bean->assigned_user_id) || $current_user->is_admin) {
	$layout_defs["asol_Project"]["subpanel_setup"]['asol_project_users']['top_buttons'][] =  
		array (
		      'widget_class' => 'SubPanelTopSelectButton',
		      'mode' => 'MultiSelect',
		);
}

?>