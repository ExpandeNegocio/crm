<?php
 // created: 2014-07-12 10:49:59
$layout_defs["Expan_Solicitud"]["subpanel_setup"]['expan_solicitud_expan_franquicia'] = array (
  'order' => 100,
  'module' => 'Expan_Franquicia',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_SOLICITUD_EXPAN_FRANQUICIA_FROM_EXPAN_FRANQUICIA_TITLE',
  'get_subpanel_data' => 'expan_solicitud_expan_franquicia',
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
