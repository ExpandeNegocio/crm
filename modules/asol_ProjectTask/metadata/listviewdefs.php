<?php
$module_name = 'asol_ProjectTask';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'ASOL_PROJECT_ASOL_PROJECTTASK_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ASOL_PROJECT_ASOL_PROJECTTASK_FROM_ASOL_PROJECT_TITLE',
    'id' => 'ASOL_PROJECT_ASOL_PROJECTTASKASOL_PROJECT_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'START' => 
  array (
    'type' => 'date',
    'label' => 'LBL_START',
    'width' => '10%',
    'default' => true,
  ),
  'END' => 
  array (
    'type' => 'date',
    'label' => 'LBL_END',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'PROGRESS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_PROGRESS',
    'width' => '10%',
    'default' => true,
  ),
  'DURATION' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_DURATION',
    'width' => '10%',
    'default' => true,
  ),
  'LEVEL' => 
  array (
    'type' => 'int',
    'label' => 'LBL_LEVEL',
    'width' => '10%',
    'default' => true,
  ),
  'START_IS_MILESTONE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_START_IS_MILESTONE',
    'width' => '10%',
  ),
  'END_IS_MILESTONE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_END_IS_MILESTONE',
    'width' => '10%',
  ),
  'DEPENDS' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_DEPENDS',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'TASK_ORDER' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TASK_ORDER',
    'width' => '10%',
    'default' => true,
  ),
);
?>
