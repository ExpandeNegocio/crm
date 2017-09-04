<?php
$module_name = 'Expan_Solicitud';

$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'orderBy' => 'last_name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'franquicia_principal' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_FRANQUICIA_PRINCIPAL',
    'id' => 'franquicia_principal',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '15%',
    'label' => 'LBL_EMAIL_ADDRESS',
    'sortable' => false,
    'link' => true,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => true,
  ),
  'CANDIDATURA_CALIENTE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'Caliente',
    'width' => '10%',
  ),
  'date_entered' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'studio' => 'visible',
    'default' => true,
  ),
  'RATING' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RATING',
    'width' => '10%',
  ),
  'FRANQUICIAS_SECUNDARIAS' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'default' => false,
    'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
    'width' => '10%',
  ),
  'DO_NOT_CALL' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DO_NOT_CALL',
    'default' => false,
  ),
  'PHONE_HOME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_HOME_PHONE',
    'default' => false,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '15%',
    'label' => 'LBL_OFFICE_PHONE',
    'default' => false,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10%',
    'label' => 'LBL_WORK_PHONE',
    'default' => false,
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10%',
    'label' => 'LBL_FAX_PHONE',
    'default' => false,
  ),
  'ADDRESS_STREET' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'ADDRESS_STATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'TIPO_ORIGEN' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'label' => 'LBL_TIPO_ORIGEN',
    'width' => '10%',
    'default' => true,
  ),
  
  'provincia_apertura_1' => 
  array (
    'studio' => 'visible',
    'label' => 'LBL_PROVINCIA_APERTURA_1',
    'width' => '10%',
    'default' => true,
  ),
  
      'localidad_apertura_1' => 
  array (
    'studio' => 'visible',
    'label' => 'LBL_LOCALIDAD_APERTURA_1',
    'width' => '10%',
    'default' => false,
  ),    
  
    'ABIERTA' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_ABIERTA',
    'width' => '5%',
  ),
  
  'ESPERA' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_ESPERA',
    'width' => '5%',
  ),
  
  'CERRADA' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_CERRADA',
    'width' => '5%',
  ),
  
  'POSITIVA' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_POSITIVA',
    'width' => '5%',
  ),
  
  'prioridad' => 
  array (
    'width' => '5%',
    'label' => 'LBL_PRIORIDAD',
    'default' => true,
  ),
  
   'rating' => 
      array (
        'type' => 'enum',      
        'label' => 'LBL_RATING',
        'width' => '5%',
        'default' => true,  
      ),  
  
  'oportunidad_inmediata' => 
  array (
    'width' => '5%',
    'label' => 'Gest. Inme.',
    'default' => true,
  ),
  'suborigen'=>
  array (
    'label' => 'LBL_SUBORIGEN',
     'width' => '5%',
     'default' => true,
     'related_fields' => 
    array (
      0 => 'portal',
      1 => 'subor_expande',
      2 => 'expan_evento_id_c',
      3 =>'subor_central',
      4 => 'subor_medios',
      5 => 'subor_mailing',      
    ),
  ),
  'master' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MASTER_FRANQUICIA',
    'default' => true,
  ),
);
?>
