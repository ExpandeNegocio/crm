<?php
$module_name = 'asol_OnHold';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'trigger_module',
            'label' => 'LBL_TRIGGER_MODULE',
          ),
          1 => 
          array (
            'name' => 'bean_id',
            'label' => 'LBL_BEAN_ID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'process_instance_id',
            'studio' => 'visible',
            'label' => 'LBL_PROCESS_INSTANCE_ID',
          ),
          1 => 
          array (
            'name' => 'working_node_id',
            'studio' => 'visible',
            'label' => 'LBL_WORKING_NODE_ID',
          ),
        ),
      ),
    ),
  ),
);
?>
