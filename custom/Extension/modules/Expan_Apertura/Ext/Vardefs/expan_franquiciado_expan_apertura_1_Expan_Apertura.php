<?php
// created: 2016-11-29 19:35:37
  $dictionary['Expan_Apertura']['fields']['expan_franquiciado_name'] = array(
        'required'  => true,
        'source'    => 'non-db',
        'name'      => 'expan_franquiciado_name',
        'vname'     => 'LBL_FRANQUICIADO_NAME',
        'type'      => 'relate',
        'rname'     => 'name',
        'id_name'   => 'expan_franquiciado_id',
        'join_name' => 'expan_franquiciado',
        'link'      => 'expan_franquiciado',
        'table'     => 'expan_franquiciado',
        'isnull'    => 'true',
        'module'    => 'Expan_Franquiciado',
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
    $dictionary['Expan_Apertura']['fields']['expan_franquiciado_id'] = array(
        'name'              => 'expan_franquiciado_id',
        'rname'             => 'id',
        'vname'             => 'LBL_FRANQUICIADO_ID',
        'type'              => 'id',
        'table'             => 'expan_franquiciado',
        'isnull'            => 'true',
        'module'            => 'Expan_Franquiciado',
        'dbType'            => 'id',
        'reportable'        => false,
        'massupdate'        => false,
        'duplicate_merge'   => 'disabled',
        );

    $dictionary['Expan_Apertura']['fields']['Expan_Franquiciado'] = array(
        'name'          => 'Expan_Franquiciado',
        'type'          => 'link',
        'relationship'  => 'expan_franquiciado_expan_apertura_1',
        'module'        => 'Expan_Franquiciado',
        'bean_name'     => 'Expan_Franquiciado',
        'source'        => 'non-db',
        'vname'         => 'LBL_FRANQUICIADO',
        );
        
    
    $dictionary['Expan_Apertura']['relationships']['expan_franquiciado_expan_apertura_1'] = array(
        'rhs_module'        => 'Expan_Apertura',
        'rhs_table'         => 'expan_apertura',
        'rhs_key'           => 'expan_franquiciado_id',
        'lhs_module'        => 'Expan_Franquiciado',
        'lhs_table'         => 'expan_franquiciado',
        'lhs_key'           => 'id',
        'relationship_type' => 'one-to-many',
        );  

?>