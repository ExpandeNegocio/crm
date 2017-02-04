<?php
$module_name = 'asol_ProcessInstances';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
        ),
      ),
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
            'name' => 'process_id',
            'studio' => 'visible',
            'label' => 'LBL_PROCESS_ID',
          ),
          1 => '',
        ),
        2 => 
        array (
        /*
          0 => 
          array (
            'name' => 'trigger_module',
            'label' => 'LBL_TRIGGER_MODULE',
          ),
          */
          1 => 
          array (
            'name' => 'bean_id',
            'label' => 'LBL_BEAN_ID',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'parent_process_instance_id',
            'studio' => 'visible',
            'label' => 'LBL_PARENT_PROCESS_INSTANCE_ID',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'bean_ungreedy_count',
            'label' => 'LBL_BEAN_UNGREEDY_COUNT',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
