<?php
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
