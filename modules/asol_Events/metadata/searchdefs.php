<?php
$module_name = 'asol_Events';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'current_user_only' => 
      array (
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
        'name' => 'current_user_only',
      ),
      'trigger_type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TRIGGER_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'trigger_type',
      ),
      'type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'type',
      ),
      'trigger_event' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TRIGGER_EVENT',
        'width' => '10%',
        'default' => true,
        'name' => 'trigger_event',
      ),
      'scheduled_type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SCHEDULED_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'scheduled_type',
      ),
      'asol_process_asol_events_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASOL_PROCESS_ASOL_EVENTS_FROM_ASOL_PROCESS_TITLE',
        'id' => 'ASOL_PROCE6F14PROCESS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'asol_process_asol_events_name',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
