<?php
 // created: 2015-01-29 10:43:56
$layout_defs["Expma_Mailing"]["subpanel_setup"]['expma_mailing_expan_gestionsolicitudes'] = array (
  'order' => 100,
  'module' => 'Expan_GestionSolicitudes',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EXPMA_MAILING_EXPAN_GESTIONSOLICITUDES_FROM_EXPAN_GESTIONSOLICITUDES_TITLE',
  'get_subpanel_data' => 'expma_mailing_expan_gestionsolicitudes',
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
