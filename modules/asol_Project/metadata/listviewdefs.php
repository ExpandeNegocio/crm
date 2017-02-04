<?php
$module_name = 'asol_Project';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DATE_START' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_START',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_END' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_END',
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
  'PRIORITY' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRIORITY',
    'width' => '10%',
  ),
  'LAST_PUBLISHED_VERSION' => 
  array (
      'type' => 'relate',
      'module' => 'asol_ProjectVersion',
      'link' => true,
      'label' => 'LBL_LAST_PUBLISHED_VERSION',
      'id' => 'ASOL_PROJECTVERSION_ID1_C',
      'width' => '10%',
      'default' => true,
      'related_fields' => array('asol_projectversion_id1_c'),
  ),
  'WORKING_VERSION' => 
  array (
      'type' => 'relate',
      'module' => 'asol_ProjectVersion',
      'link' => true,
      'label' => 'LBL_WORKING_VERSION',
      'id' => 'ASOL_PROJECTVERSION_ID_C',
      'width' => '10%',
      'default' => true,
      'related_fields' => array('asol_projectversion_id_c'),
  ),
  'ASOL_RELEASE_ASOL_PROJECT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ASOL_RELEASE_ASOL_PROJECT_FROM_ASOL_RELEASE_TITLE',
    'id' => 'ASOL_RELEASE_ASOL_PROJECTASOL_RELEASE_IDA',
    'width' => '10%',
    'default' => true,
  ),
);
?>
