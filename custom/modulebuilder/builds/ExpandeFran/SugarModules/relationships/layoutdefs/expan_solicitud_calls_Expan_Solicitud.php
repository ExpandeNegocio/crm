<?php
 // created: 2014-08-17 00:21:22
$layout_defs["Expan_Solicitud"]["subpanel_setup"]['expan_solicitud_calls'] = array (
  'order' => 100,
  'module' => 'Calls',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_SOLICITUD_CALLS_FROM_CALLS_TITLE',
  'get_subpanel_data' => 'expan_solicitud_calls',
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
