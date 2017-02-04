<?php
 // created: 2014-07-31 19:38:10
$layout_defs["Expan_Solicitud"]["subpanel_setup"]['expan_solicitud_users'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_SOLICITUD_USERS_FROM_USERS_TITLE',
  'get_subpanel_data' => 'expan_solicitud_users',
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
