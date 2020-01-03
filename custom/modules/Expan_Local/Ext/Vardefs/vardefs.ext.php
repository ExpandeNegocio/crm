<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2016-11-29 19:35:37
  $dictionary['Expan_Local']['fields']['expan_franquicia_name'] = array(
    'required'  => true,
    'source'    => 'non-db',
    'name'      => 'expan_franquicia_name',
    'vname'     => 'LBL_FRANQUICIA_NAME',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'expan_franquicia_id',
    'join_name' => 'expan_franquicia',
    'link'      => 'expan_franquicia',
    'table'     => 'expan_franquicia',
    'isnull'    => 'true',
    'module'    => 'Expan_Franquicia',
    'db_concat_fields' =>
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
  );
  /*
   * Linking id field
   * * make sure the field name matches the pattern <bean_name>_id
   */
  $dictionary['Expan_Local']['fields']['expan_franquicia_id'] = array(
    'name'              => 'expan_franquicia_id',
    'rname'             => 'id',
    'vname'             => 'LBL_FRANQUICIA_ID',
    'type'              => 'id',
    'table'             => 'expan_franquicia',
    'isnull'            => 'true',
    'module'            => 'Expan_Franquicia',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
  );

  $dictionary['Expan_Local']['fields']['Expan_Franquicia'] = array(
    'name'          => 'Expan_Franquicia',
    'type'          => 'link',
    'relationship'  => 'expan_franquicia_expan_local_1',
    'module'        => 'Expan_Franquicia',
    'bean_name'     => 'Expan_Franquicia',
    'source'        => 'non-db',
    'vname'         => 'LBL_FRANQUICIA',
  );

  $dictionary['Expan_Local']['relationships']['expan_franquicia_expan_local_1'] = array(
    'rhs_module'        => 'Expan_Local',
    'rhs_table'         => 'expan_local',
    'rhs_key'           => 'expan_franquicia_id',
    'lhs_module'        => 'Expan_Franquicia',
    'lhs_table'         => 'expan_franquicia',
    'lhs_key'           => 'id',
    'relationship_type' => 'one-to-many',
  );



// created: 2016-11-29 19:35:37
  $dictionary['Expan_Local']['fields']['expan_solicitud_name'] = array(
    'required'  => true,
    'source'    => 'non-db',
    'name'      => 'expan_solicitud_name',
    'vname'     => 'LBL_SOLICITUD_NAME',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'expan_solicitud_id',
    'join_name' => 'expan_solicitud',
    'link'      => 'expan_solicitud',
    'table'     => 'expan_solicitud',
    'isnull'    => 'true',
    'module'    => 'Expan_Solicitud',
    'db_concat_fields' =>
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
  );
  /*
   * Linking id field
   * * make sure the field name matches the pattern <bean_name>_id
   */
  $dictionary['Expan_Local']['fields']['expan_solicitud_id'] = array(
    'name'              => 'expan_solicitud_id',
    'rname'             => 'id',
    'vname'             => 'LBL_SOLICITUD_ID',
    'type'              => 'id',
    'table'             => 'expan_solicitud',
    'isnull'            => 'true',
    'module'            => 'Expan_Solicitud',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
  );

  $dictionary['Expan_Local']['fields']['Expan_Solicitud'] = array(
    'name'          => 'Expan_Solicitud',
    'type'          => 'link',
    'relationship'  => 'expan_solicitud_expan_local_1',
    'module'        => 'Expan_Solicitud',
    'bean_name'     => 'Expan_Solicitud',
    'source'        => 'non-db',
    'vname'         => 'LBL_SOLICITUD',
  );


  $dictionary['Expan_Local']['relationships']['expan_solicitud_expan_local_1'] = array(
    'rhs_module'        => 'Expan_Local',
    'rhs_table'         => 'expan_local',
    'rhs_key'           => 'expan_solicitud_id',
    'lhs_module'        => 'Expan_Solicitud',
    'lhs_table'         => 'expan_solicitud',
    'lhs_key'           => 'id',
    'relationship_type' => 'one-to-many',
  );


?>