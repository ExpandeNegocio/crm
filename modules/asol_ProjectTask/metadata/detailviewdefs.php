<?php
$module_name = 'asol_ProjectTask';
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
          3 => 'FIND_DUPLICATES',
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
          1 => 
          array (
            'name' => 'asol_project_asol_projecttask_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'start',
            'label' => 'LBL_START',
          ),
          1 => 
          array (
            'name' => 'end',
            'label' => 'LBL_END',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'progress',
            'label' => 'LBL_PROGRESS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'level',
            'label' => 'LBL_LEVEL',
          ),
          1 => 
          array (
            'name' => 'duration',
            'label' => 'LBL_DURATION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'start_is_milestone',
            'label' => 'LBL_START_IS_MILESTONE',
          ),
          1 => 
          array (
            'name' => 'end_is_milestone',
            'label' => 'LBL_END_IS_MILESTONE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'depends',
            'studio' => 'visible',
            'label' => 'LBL_DEPENDS',
          ),
          1 =>
          array (
            'name' => 'task_order',
            'label' => 'LBL_TASK_ORDER',
          ),
        ),
        6 => 
        array (
            'name' => 'assigned_user_name',
        ),
        7 => 
        array (
          0 => 'description',
        ),
        8 => 
        array (
          0 => 'assigs',
        ),
      ),
    ),
  ),
);
?>
