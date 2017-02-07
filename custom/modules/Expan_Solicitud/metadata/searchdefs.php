<?php
$module_name = 'Expan_Solicitud';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'search_name' => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'phone_mobile' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_MOBILE_PHONE',
        'width' => '10%',
        'default' => true,
        'name' => 'phone_mobile',
      ),
    ),
    'advanced_search' => 
    array (
      'first_name' => 
      array (
        'name' => 'first_name',
        'default' => true,
        'width' => '10%',
      ),
      'last_name' => 
      array (
        'name' => 'last_name',
        'default' => true,
        'width' => '10%',
      ),      
      'phone_mobile' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_MOBILE_PHONE',
        'width' => '10%',
        'default' => true,
        'name' => 'phone_mobile',
      ),
      'created_by_name' => 
      array (
        'name' => 'created_by_name',
        'default' => true,
        'width' => '10%',
      ),
      'do_not_call' => 
      array (
        'name' => 'do_not_call',
        'default' => true,
        'width' => '10%',
      ),
      'email' => 
      array (
        'name' => 'email',
        'default' => true,
        'width' => '10%',
      ),
      'tipo_origen' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TIPO_ORIGEN',
        'width' => '10%',
        'default' => true,
        'name' => 'tipo_origen',
      ),
      'expan_evento_id_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_EVENTO',
        'width' => '10%',
        'name' => 'expan_evento_id_c',
      ),         
      'franquicia_principal' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_FRANQUICIA_PRINCIPAL',
        'width' => '10%',
        'default' => true,
        'name' => 'franquicia_principal',
      ),
      'franquicias_secundarias' => 
      array (
        'type' => 'multienum',
        'studio' => 'visible',
        'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
        'width' => '10%',
        'default' => true,
        'name' => 'franquicias_secundarias',
      ),
      'provincia_apertura_1' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_PROVINCIA_APERTURA_1',
        'width' => '10%',
        'default' => true,
        'name' => 'provincia_apertura_1',
      ),
      'rating' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_RATING',
        'width' => '10%',
        'default' => true,
        'name' => 'rating',
      ),
      'assigned_user_name' => 
      array (
        'link' => true,
        'type' => 'relate',
        'label' => 'LBL_ASSIGNED_TO_NAME',
        'id' => 'ASSIGNED_USER_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'assigned_user_name',
      ),
      'localidad_apertura_1' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_LOCALIDAD_APERTURA_1',
        'width' => '10%',
        'default' => true,
        'name' => 'localidad_apertura_1',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'portal' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PORTAL',
        'width' => '10%',
        'name' => 'portal',
      ),      
      'sectores_de_interes' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SECTORES_DE_INTERES',
        'width' => '10%',
        'name' => 'sectores_de_interes',
      ),
      
      'candidatura_avanzada' => 
      array (
        'name' => 'candidatura_avanzada',
        'label' => 'LBL_CANDIDATURA_AVANZADA',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
            
      'candidatura_caliente' => 
      array (
        'name' => 'candidatura_caliente',
        'label' => 'LBL_CANDIDATURA_CALIENTE',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'observaciones_solicitud' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_OBSERVACIONES_SOLICITUD',
        'width' => '10%',
        'default' => true,
        'name' => 'observaciones_solicitud',
      ),

   /*   'abierta' => 
      array (
        'name' => 'abierta',
        'label' => 'LBL_ABIERTA',
        'default' => true,
        'width' => '10%',
      ),
      
      'espera' => 
      array (
        'name' => 'espera',
        'label' => 'LBL_ESPERA',
        'default' => true,
        'width' => '10%',
      ),
      
    'cerrada' => 
      array (
        'name' => 'cerrada',
        'label' => 'LBL_CERRADA',
        'default' => true,
        'width' => '10%',
      ),
      
        'positiva' => 
      array (
        'name' => 'positiva',
        'label' => 'LBL_POSITIVA',
        'default' => true,
        'width' => '10%',
      ),*/
      
      'pais_c' => 
      array (
        'name' => 'pais_c',
        'label' => 'LBL_PAIS',
        'default' => true,
        'width' => '10%',
      ),
      
      
       'oportunidad_inmediata' => 
    array (
    'type' => 'bool',
        'default' => true,
        'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
        'width' => '10%',
        'name' => 'oportunidad_inmediata',
      ),
       
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
