<?php
// created: 2014-09-03 17:45:44
$subpanel_layout['list_fields'] = array (
  'object_image' => 
  array (
    'vname' => 'LBL_OBJECT_IMAGE',
    'widget_class' => 'SubPanelIcon',
    'width' => '2%',
    'default' => true,
  ),
  'close_button' => 
  array (
    'widget_class' => 'SubPanelCloseButton',
    'vname' => 'LBL_LIST_CLOSE',
    'width' => '6%',
    'sortable' => false,
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '30%',
    'default' => true,
  ),
  'telefono' => 
  array (
    'type' => 'phone',
    'vname' => 'LBL_TELEFONO',
    'width' => '10%',
    'default' => true,
  ),
  'status' => 
  array (
    'widget_class' => 'SubPanelActivitiesStatusField',
    'vname' => 'LBL_STATUS',
    'width' => '15%',
    'default' => true,
  ),
  
  'type' => 
  array (
    'widget_class' => 'SubPanelActivitiesTypeField',
    'vname' => 'LBL_TYPE',
    'width' => '15%',
    'default' => true,
  ),
  
  'date_start' => 
  array (
    'vname' => 'LBL_DATE_TIME',
    'width' => '10%',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'name' => 'assigned_user_name',
    'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'assigned_user_id',
    'target_module' => 'Employees',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'width' => '2%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelDeleteButton',
    'width' => '2%',
    'default' => true,
  ),
  'time_start' => 
  array (
    'usage' => 'query_only',
  ),
  'recurring_source' => 
  array (
    'usage' => 'query_only',
  ),
);