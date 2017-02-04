<?php
$module_name = 'asol_ProcessInstances';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'process_id',
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'process_id' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROCESS_ID',
        'id' => 'ASOL_PROCESS_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'process_id',
      ),
      'parent_process_instance_id' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PARENT_PROCESS_INSTANCE_ID',
        'id' => 'ASOL_PROCESSINSTANCES_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'parent_process_instance_id',
      ),
      'bean_ungreedy_count' => 
      array (
        'type' => 'int',
        'label' => 'LBL_BEAN_UNGREEDY_COUNT',
        'width' => '10%',
        'default' => true,
        'name' => 'bean_ungreedy_count',
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
