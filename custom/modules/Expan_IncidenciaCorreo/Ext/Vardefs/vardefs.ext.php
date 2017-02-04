<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2016-11-29 19:35:37
  $dictionary['Expan_IncidenciaCorreo']['fields']['expan_gestionsolicitudes_name'] = array(
        'required'  => true,
        'source'    => 'non-db',
        'name'      => 'expan_gestionsolicitudes_name',
        'vname'     => 'LBL_GESTIOSNSOLICITUD_NAME',
        'type'      => 'relate',
        'rname'     => 'name',
        'id_name'   => 'expan_gestionsolicitudes_id',
        'join_name' => 'expan_gestionsolicitudes',
        'link'      => 'expan_gestionsolicitudes',
        'table'     => 'expan_gestionsolicitudes',
        'isnull'    => 'true',
        'module'    => 'Expan_GestionSolicitudes',
    );
    /*
     * Linking id field
     * * make sure the field name matches the pattern <bean_name>_id
     */
    $dictionary['Expan_IncidenciaCorreo']['fields']['expan_gestionsolicitudes_id'] = array(
        'name'              => 'expan_gestionsolicitudes_id',
        'rname'             => 'id',
        'vname'             => 'LBL_GESTIOSNSOLICITUD_ID',
        'type'              => 'id',
        'table'             => 'expan_gestionsolicitudes',
        'isnull'            => 'true',
        'module'            => 'Expan_GestionSolicitudes',
        'dbType'            => 'id',
        'reportable'        => false,
        'massupdate'        => false,
        'duplicate_merge'   => 'disabled',
        );

    $dictionary['Expan_IncidenciaCorreo']['fields']['Expan_GestionSolicitudes'] = array(
        'name'          => 'Expan_GestionSolicitudes',
        'type'          => 'link',
        'relationship'  => 'expan_gestionsolicitudes_expan_incidenciacorreo_1',
        'module'        => 'Expan_GestionSolicitudes',
        'bean_name'     => 'Expan_GestionSolicitudes',
        'source'        => 'non-db',
        'vname'         => 'LBL_GESTIONSOLICITUDES',
        );
        
    
    $dictionary['Expan_IncidenciaCorreo']['relationships']['expan_gestionsolicitudes_expan_incidenciacorreo_1'] = array(
        'rhs_module'        => 'Expan_IncidenciaCorreo',
        'rhs_table'         => 'expan_incidenciacorreo',
        'rhs_key'           => 'expan_gestionsolicitudes_id',
        'lhs_module'        => 'Expan_GestionSolicitudes',
        'lhs_table'         => 'expan_gestionsolicitudes',
        'lhs_key'           => 'id',
        'relationship_type' => 'one-to-many',
        );  
?>