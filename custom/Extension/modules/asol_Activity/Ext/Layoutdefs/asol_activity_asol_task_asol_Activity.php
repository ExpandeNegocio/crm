<?php
// created: 2011-04-05 11:16:12
$layout_defs["asol_Activity"]["subpanel_setup"]["asol_activity_asol_task"] = array (
  'order' => 100,
  'module' => 'asol_Task',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ASOL_ACTIVITY_ASOL_TASK_FROM_ASOL_TASK_TITLE',
  'get_subpanel_data' => 'asol_activity_asol_task',
  'top_buttons' => 
  array (
    0 => 
    array (
      //'widget_class' => 'SubPanelTopButtonQuickCreate',
      'widget_class' => 'SubPanelTopButtonAsolCreateTask',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
