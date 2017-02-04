<?php
$module_name = 'asol_ProjectVersion';
$listViewDefs [$module_name] = 
array (
  'ASOL_PROJECT_ASOL_PROJECTVERSION_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
    'id' => 'ASOL_PROJECT_ASOL_PROJECTVERSIONASOL_PROJECT_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'VERSION_NUMBER' => 
  array (
    'type' => 'int',
    'label' => 'LBL_VERSION_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'IS_PUBLISHED' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_IS_PUBLISHED',
    'width' => '10%',
  ),
  'PUBLISHED_DATETIME' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_PUBLISHED_DATETIME',
    'width' => '10%',
    'default' => true,
  ),
  'CURRENT_EDITOR' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_CURRENT_EDITOR',
    'id' => 'USER_ID_C',
    'link' => false,
    'width' => '10%',
    'default' => true,
  ),
  'LAST_EDITOR_CALL' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LAST_EDITOR_CALL',
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'sortable' => true,
    'width' => '10%',
  ),
  
  /*
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  */
  
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
);
?>
