<?php
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
