<?php
 // created: 2014-08-01 19:44:14
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['expan_gestionsolicitudes_tasks_1'] = array (
  'order' => 100,
  'module' => 'Tasks',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_TASKS_TITLE',
  'get_subpanel_data' => 'expan_gestionsolicitudes_tasks_1',
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
