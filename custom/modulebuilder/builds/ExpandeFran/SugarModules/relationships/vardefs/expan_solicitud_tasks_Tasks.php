<?php
// created: 2014-08-17 00:21:22
$dictionary["Task"]["fields"]["expan_solicitud_tasks"] = array (
  'name' => 'expan_solicitud_tasks',
  'type' => 'link',
  'relationship' => 'expan_solicitud_tasks',
  'source' => 'non-db',
  'module' => 'Expan_Solicitud',
  'bean_name' => 'Expan_Solicitud',
  'vname' => 'LBL_EXPAN_SOLICITUD_TASKS_FROM_EXPAN_SOLICITUD_TITLE',
  'id_name' => 'expan_solicitud_tasksexpan_solicitud_ida',
);
$dictionary["Task"]["fields"]["expan_solicitud_tasks_name"] = array (
  'name' => 'expan_solicitud_tasks_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_EXPAN_SOLICITUD_TASKS_FROM_EXPAN_SOLICITUD_TITLE',
  'save' => true,
  'id_name' => 'expan_solicitud_tasksexpan_solicitud_ida',
  'link' => 'expan_solicitud_tasks',
  'table' => 'expan_solicitud',
  'module' => 'Expan_Solicitud',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Task"]["fields"]["expan_solicitud_tasksexpan_solicitud_ida"] = array (
  'name' => 'expan_solicitud_tasksexpan_solicitud_ida',
  'type' => 'link',
  'relationship' => 'expan_solicitud_tasks',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_EXPAN_SOLICITUD_TASKS_FROM_TASKS_TITLE',
);
