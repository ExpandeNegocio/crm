<?php
$module_name = 'asol_WorkingNodes';
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
            'name' => 'process_instance_id',
            'studio' => 'visible',
            'label' => 'LBL_PROCESS_INSTANCE_ID',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'priority',
            'label' => 'LBL_PRIORITY',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'current_activity',
            'studio' => 'visible',
            'label' => 'LBL_CURRENT_ACTIVITY',
          ),
          1 => 
          array (
            'name' => 'current_task',
            'studio' => 'visible',
            'label' => 'LBL_CURRENT_TASK',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'delay_wakeup_time',
            'label' => 'LBL_DELAY_WAKEUP_TIME',
          ),
          1 => '',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'label' => 'LBL_STATUS',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
