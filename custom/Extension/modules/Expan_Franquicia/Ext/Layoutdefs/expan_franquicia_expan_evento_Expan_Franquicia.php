<?php
 // created: 2014-08-01 17:17:40
$layout_defs["Expan_Franquicia"]["subpanel_setup"]['expan_franquicia_expan_evento'] = array (
  'order' => 100,
  'module' => 'Expan_Evento',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPAN_FRANQUICIA_EXPAN_EVENTO_FROM_EXPAN_EVENTO_TITLE',
  'get_subpanel_data' => 'expan_franquicia_expan_evento',
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
