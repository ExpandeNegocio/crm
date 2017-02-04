<?php
$popupMeta = array (
    'moduleMain' => 'asol_ProjectVersion',
    'varName' => 'asol_ProjectVersion',
    'orderBy' => 'asol_projectversion.name',
    'whereClauses' => array (
  'name' => 'asol_projectversion.name',
  'asol_project_asol_projectversion_name' => 'asol_projectversion.asol_project_asol_projectversion_name',
  'version_number' => 'asol_projectversion.version_number',
  'is_published' => 'asol_projectversion.is_published',
  'published_datetime' => 'asol_projectversion.published_datetime',
  'is_expired' => 'asol_projectversion.is_expired',
  'expiration_datetime' => 'asol_projectversion.expiration_datetime',
  'baseline' => 'asol_projectversion.baseline',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'asol_project_asol_projectversion_name',
  5 => 'version_number',
  6 => 'is_published',
  7 => 'published_datetime',
),
    'searchdefs' => array (
  'asol_project_asol_projectversion_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ASOL_PROJECT_ASOL_PROJECTVERSION_FROM_ASOL_PROJECT_TITLE',
    'id' => 'ASOL_PROJECT_ASOL_PROJECTVERSIONASOL_PROJECT_IDA',
    'width' => '10%',
    'name' => 'asol_project_asol_projectversion_name',
  ),
  'version_number' => 
  array (
    'type' => 'int',
    'label' => 'LBL_VERSION_NUMBER',
    'width' => '10%',
    'name' => 'version_number',
  ),
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
    'name' => 'name',
  ),
  'is_published' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_IS_PUBLISHED',
    'width' => '10%',
    'name' => 'is_published',
  ),
  'published_datetime' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_PUBLISHED_DATETIME',
    'width' => '10%',
    'name' => 'published_datetime',
  ),
),
    'listviewdefs' => array (
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
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
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
),
);
