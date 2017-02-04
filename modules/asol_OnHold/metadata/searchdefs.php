<?php
$module_name = 'asol_OnHold';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'working_node_id',
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'process_instance_id' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROCESS_INSTANCE_ID',
        'id' => 'ASOL_PROCESSINSTANCES_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'process_instance_id',
      ),
      'working_node_id' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_WORKING_NODE_ID',
        'id' => 'ASOL_WORKINGNODES_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'working_node_id',
      ),
      'parent_type' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TRIGGER_MODULE',
        'width' => '10%',
        'name' => 'parent_type',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_ONHOLD_OBJECT',
        'link' => true,
        'sortable' => false,
        'ACLTag' => 'PARENT',
        'dynamic_module' => 'PARENT_TYPE',
        'id' => 'PARENT_ID',
        'related_fields' => 
        array (
          0 => 'parent_id',
          1 => 'parent_type',
        ),
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
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
