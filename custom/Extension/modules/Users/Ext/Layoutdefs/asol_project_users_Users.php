<?php
 // created: 2014-02-26 13:28:27
$layout_defs["Users"]["subpanel_setup"]['asol_project_users'] = array (
  'order' => 100,
  'module' => 'asol_Project',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_USERS_FROM_ASOL_PROJECT_TITLE',
  'get_subpanel_data' => 'asol_project_users',
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
