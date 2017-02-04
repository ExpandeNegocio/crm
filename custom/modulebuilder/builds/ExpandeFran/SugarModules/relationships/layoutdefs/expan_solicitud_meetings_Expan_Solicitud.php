<?php
 // created: 2014-08-17 00:21:22
$layout_defs["Expan_Solicitud"]["subpanel_setup"]['expan_solicitud_meetings'] = array (
  'order' => 100,
  'module' => 'Meetings',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_SOLICITUD_MEETINGS_FROM_MEETINGS_TITLE',
  'get_subpanel_data' => 'expan_solicitud_meetings',
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
