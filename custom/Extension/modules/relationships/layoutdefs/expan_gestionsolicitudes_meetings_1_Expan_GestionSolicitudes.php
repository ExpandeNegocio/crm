<?php
 // created: 2014-08-01 19:48:26
$layout_defs["Expan_GestionSolicitudes"]["subpanel_setup"]['expan_gestionsolicitudes_meetings_1'] = array (
  'order' => 100,
  'module' => 'Meetings',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_GESTIONSOLICITUDES_MEETINGS_1_FROM_MEETINGS_TITLE',
  'get_subpanel_data' => 'expan_gestionsolicitudes_meetings_1',
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
