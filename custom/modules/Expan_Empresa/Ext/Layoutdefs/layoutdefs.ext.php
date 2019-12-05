<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2014-12-20 18:54:37
$layout_defs["Expan_Empresa"]["subpanel_setup"]['activities'] = array (
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
      'widget_class' => 'SubPanelTopCreateFranqTaskButton',
    ),    
    1 => 
    array (
      'widget_class' => 'SubPanelTopScheduleFranqCallButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopComposeEmailButton',
    ),
    3 => 
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
      'get_subpanel_data' => 'expan_empresa_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_empresa_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_empresa_activities_1_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["Expan_Empresa"]["subpanel_setup"]['history'] = array (
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
      'get_subpanel_data' => 'expan_empresa_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


 // created: 2014-12-20 18:56:25
$layout_defs["Expan_Empresa"]["subpanel_setup"]['activities'] = array (
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
      'widget_class' => 'SubPanelTopCreateFranqTaskButton',
    ), 
    2 => 
    array (
      'widget_class' => 'SubPanelTopScheduleFranqCallButton',
    ),
    3 => 
    array (
      'widget_class' => 'SubPanelTopScheduleMeetingButton',
    ),
    4 => 
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
      'get_subpanel_data' => 'expan_empresa_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_empresa_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'expan_empresa_activities_1_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["Expan_Empresa"]["subpanel_setup"]['history'] = array (
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
      'get_subpanel_data' => 'expan_empresa_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'expan_empresa_activities_1_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


$layout_defs["Expan_Empresa"]["subpanel_setup"]['expan_empresa_competidores'] = array (
      'order' => 1,
      'module' => 'Expan_Empresa',
      'subpanel_name' => 'default',
      'sort_order' => 'asc',
      'sort_by' => 'id',
      'title_key' => 'LBL_EXPAN_EMPRESA_COMPETIDOR_TITLE',
      'get_subpanel_data' => 'expan_empresa_competidores',
      'top_buttons' => 
      array (
        0 => 
        array (
          'widget_class' => 'SubPanelTopSelectButton',
          'mode' => 'MultiSelect',
        ),
        1 => 
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorTipoButton',
          'tipoComp' => 'CD',
        ),   
        2 =>
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorTipoButton',
          'tipoComp' => 'CI',
        ), 
        3 =>
        array (
          'widget_class' => 'SubPanelTopChangeCompetidorPrinButton',
        ),
        4 =>
          array (
            'widget_class' => 'SubPanelTopDelCompetidorPrinButton',
          ),
      ),           
      
      'list_fields' => array(
            'name'=>array(
                'vname' => 'LBL_NAME',
                'widget_class' => 'SubPanelDetailViewLink',
                'width' => '25%',
            ),
            'date_modified'=>array(
                'vname' => 'LBL_DATE_MODIFIED',
                'width' => '25%',
            ),    
            'e_tipo_competidor' => array (
                'usage' => 'query_only',
             ), 
               
        ),           
    );


?>