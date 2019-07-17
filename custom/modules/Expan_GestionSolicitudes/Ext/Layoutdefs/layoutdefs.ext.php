<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2014-12-20 18:54:37
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['activities'] = array (
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
      'widget_class' => 'SubPanelTopCreateFranqTaskButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopScheduleCallButton',
    ),    
    3 => 
    array (
      'widget_class' => 'SubPanelTopScheduleFranqCallButton',
    ),
    4 => 
    array (
      'widget_class' => 'SubPanelTopComposeEmailButton',
    ),
    5 => 
    array (
      'widget_class' => 'SubPanelTopScheduleMeetingButton',
    ),
 
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['history'] = array (
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
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


 // created: 2014-12-20 18:56:25
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['activities'] = array (
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
      'widget_class' => 'SubPanelTopCreateFranqTaskButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopScheduleCallButton',
    ),    
    3 => 
    array (
      'widget_class' => 'SubPanelTopScheduleFranqCallButton',
    ),
    4 => 
    array (
      'widget_class' => 'SubPanelTopComposeEmailButton',
    ),
    5 => 
    array (
      'widget_class' => 'SubPanelTopScheduleMeetingButton',
    ),
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['history'] = array (
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
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_gestionsolicitudes_activities_1_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


 // created: 2014-08-01 19:02:05


 // created: 2016-11-29 19:35:36
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['expan_gestionsolicitudes_expan_incidenciacorreo_1'] = array (
  'order' => 100,
  'module' => 'Expan_IncidenciaCorreo',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_GESTIONSOLICITUDES_EXPAN_INCIDENCIACORREO_1_FROM_EXPAN_INCIDENCIACORREO_TITLE',
  'get_subpanel_data' => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
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


 // created: 2014-08-01 19:48:26



 // created: 2014-08-01 19:44:14


//auto-generated file DO NOT EDIT
$layout_defs['Expan_GestionSolicitudes']['subpanel_setup']['expan_gestionsolicitudes_calls_1']['override_subpanel_name'] = 'Expan_GestionSolicitudes_subpanel_expan_gestionsolicitudes_calls_1';

?>