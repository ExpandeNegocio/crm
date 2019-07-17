<?php 
 //WARNING: The contents of this file are auto-generated


    $dictionary["Expan_Empresa"]["unified_search"] = true;
    $dictionary["Expan_Empresa"]["full_text_search"] = true;
    $dictionary["Expan_Empresa"]["unified_search_default_enabled"] = true;
    $dictionary['Expan_Empresa']['fields']['name']['unified_search'] = true;


// created: 2014-12-20 18:56:34
$dictionary["Expan_Empresa"]["fields"]["expan_empresa_activities_1_calls"] = array (
  'name' => 'expan_empresa_activities_1_calls',
  'type' => 'link',
  'relationship' => 'expan_empresa_activities_1_calls',
  'source' => 'non-db',
  'module' => 'Calls',
  'bean_name' => 'Call',
  'vname' => 'LBL_EXPAN_EMPRESA_ACTIVITIES_1_CALLS_FROM_CALLS_TITLE',
);


// created: 2014-12-20 18:56:25
$dictionary["Expan_Empresa"]["fields"]["expan_empresa_activities_1_meetings"] = array (
  'name' => 'expan_empresa_activities_1_meetings',
  'type' => 'link',
  'relationship' => 'expan_empresa_activities_1_meetings',
  'source' => 'non-db',
  'module' => 'Meetings',
  'bean_name' => 'Meeting',
  'vname' => 'LBL_EXPAN_EMPRESA_ACTIVITIES_1_MEETINGS_FROM_MEETINGS_TITLE',
);


// created: 2014-12-20 18:56:29
$dictionary["Expan_Empresa"]["fields"]["expan_empresa_activities_1_tasks"] = array (
  'name' => 'expan_empresa_activities_1_tasks',
  'type' => 'link',
  'relationship' => 'expan_empresa_activities_1_tasks',
  'source' => 'non-db',
  'module' => 'Tasks',
  'bean_name' => 'Task',
  'vname' => 'LBL_EXPAN_EMPRESA_ACTIVITIES_1_TASKS_FROM_TASKS_TITLE',
);


// created: 2014-08-01 17:17:40
$dictionary["Expan_Empresa"]["fields"]["expan_empresa_competidores"] = array (
  'name' => 'expan_empresa_competidores',
  'type' => 'link',
  'relationship' => 'expan_empresa_competidores',
  'source' => 'non-db',
  'module' => 'Expan_Empresa',
  'bean_name' => 'Expan_Empresa',
  'vname' => 'LBL_EXPAN_EMPRESA_COMPETIDOR_TITLE',
 );
    
$dictionary['Expan_Empresa']['fields']['e_tipo_competidor'] =
 array (
 'name' => 'e_tipo_competidor',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'competidor_id', 'tipo_competidor' => 'tipo_competidor'),
 'vname' => 'LBL_CONT_ACCEPT_CANCELLED',
 'type' => 'relate',
 'link' => 'expan_empresa_competidores',
 'link_type' => 'relationship_info',
 'join_link_name' => 'expan_empresa_competidores',
 'source' => 'non-db',
 'importable' => 'false',
 'duplicate_merge'=> 'disabled',
 'studio' => false,
 'join_primary' => false,
 );
 
$dictionary['Expan_Empresa']['fields']['tipo_competidor'] =
 array(
 'massupdate' => false,
 'name' => 'tipo_competidor',
 'type' => 'enum',
 'options' => 'lst_tipo_competidor',
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Tipo de competidor',
 'importable' => 'false',
 );
 
 $dictionary['Expan_Empresa']['fields']['e_competidor_principal'] =
 array (
 'name' => 'e_competidor_principal',
 'rname' => 'id',
 'relationship_fields'=>array('id' => 'competidor_id', 'competidor_principal' => 'competidor_principal'),
 'vname' => 'LBL_CONT_ACCEPT_CANCELLED',
 'type' => 'relate',
 'link' => 'expan_empresa_competidores',
 'link_type' => 'relationship_info',
 'join_link_name' => 'expan_empresa_competidores',
 'source' => 'non-db',
 'importable' => 'false',
 'duplicate_merge'=> 'disabled',
 'studio' => false,
 'join_primary' => false,
 );
 
$dictionary['Expan_Empresa']['fields']['competidor_principal'] =
 array(
 'massupdate' => false,
 'name' => 'competidor_principal',
 'type' => 'boolean', 
 'studio' => 'false',
 'source' => 'non-db',
 'vname' => 'Competidor Principal',
 'importable' => 'false',
 );
   


?>