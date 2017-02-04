<?php
 // created: 2014-03-12 14:07:43
$layout_defs["Users"]["subpanel_setup"]['asol_project_users_1'] = array (
  'order' => 100,
  'module' => 'asol_Project',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_PROJECT_USERS_1_FROM_ASOL_PROJECT_TITLE',
  'get_subpanel_data' => 'asol_project_users_1',
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
