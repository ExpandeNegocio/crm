<?php
 // created: 2015-12-22 08:00:19
$layout_defs["Expan_Franquicia"]["subpanel_setup"]['expan_franquicia_tasks_1'] = array (
  'order' => 100,
  'module' => 'Tasks',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_TASKS_TITLE',
  'get_subpanel_data' => 'expan_franquicia_tasks_1',
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
