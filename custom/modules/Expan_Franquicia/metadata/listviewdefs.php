<?php
$module_name = 'Expan_Franquicia';
$OBJECT_NAME = 'EXPAN_FRANQUICIA';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_ACCOUNT_NAME',
    'link' => true,
    'default' => true,
  ),
  'BILLING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CITY',
    'default' => false,
  ),
  'EMAIL1' => 
  array (
    'width' => '15%',
    'label' => 'LBL_EMAIL_ADDRESS',
    'sortable' => false,
    'link' => true,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => false,
  ),
  'TIPO_CUENTA' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TIPO_CUENTA',
    'width' => '10%',
  ),
  'gestionesFran' => 
  array (
    'width' => '1%',
    'label' => 'LBL_GESTIONESFRAN',
    'default'=>true,
  ),
  
  'llamadaspendientesfran' => 
  array (
    'width' => '1%',
    'label' => 'LBL_LLAMADASPENDIENTESFRAN',
    'default'=>true,
  ),

  'llamar_todos' => 
  array (
    'width' => '10%',
    'studio' => 'visible',
    'label' => 'LBL_LLAMAR_TODOS',
    'default' => true,
  ),
  
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '15%',
    'label' => 'LBL_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'EXPAN_FRANQUICIA_TYPE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_TYPE',
    'default' => false,
  ),
  'INDUSTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_INDUSTRY',
    'default' => false,
  ),
  'ANNUAL_REVENUE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ANNUAL_REVENUE',
    'default' => false,
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PHONE_FAX',
    'default' => false,
  ),
  'BILLING_ADDRESS_STREET' => 
  array (
    'width' => '15%',
    'label' => 'LBL_BILLING_ADDRESS_STREET',
    'default' => false,
  ),
  'BILLING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_BILLING_ADDRESS_STATE',
    'default' => false,
  ),
  'BILLING_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'BILLING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_STREET' => 
  array (
    'width' => '15%',
    'label' => 'LBL_SHIPPING_ADDRESS_STREET',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_CITY',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_SHIPPING_ADDRESS_STATE',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'SHIPPING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SHIPPING_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'PHONE_ALTERNATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PHONE_ALT',
    'default' => false,
  ),
  'WEBSITE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_WEBSITE',
    'default' => false,
  ),
  'OWNERSHIP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OWNERSHIP',
    'default' => false,
  ),
  'EMPLOYEES' => 
  array (
    'width' => '10%',
    'label' => 'LBL_EMPLOYEES',
    'default' => false,
  ),
  'TICKER_SYMBOL' => 
  array (
    'width' => '10%',
    'label' => 'LBL_TICKER_SYMBOL',
    'default' => false,
  ),
  'filtro_solicitudes_c'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_FILTRO_SOLICITUDES',
    'default' => true,
  ),
  'director_consultoria'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_DIRECTOR_CONSULTORIA',
    'default' => true,
  ),
  
  'correo_envio'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CORREO_ENVIO',
    'default' => true,
  ),
  'chk_c1'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C1',
    'default' => true,
  ),
  'chk_c2'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C2',
    'default' => true,
  ),
  'chk_c3'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C3',
    'default' => true,
  ),
  'chk_c4'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C4',
    'default' => true,
  ),
    'chk_c11'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C11',
    'default' => true,
  ),
  'chk_c12'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C12',
    'default' => true,
  ),
  'chk_c13'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C13',
    'default' => true,
  ),
  'chk_c14'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C14',
    'default' => true,
  ),
    'chk_c15'=> 
  array (
    'width' => '10%',
    'label' => 'LBL_CHK_C15',
    'default' => true,
  ),
  
  'prioridad' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIORIDAD_FRAN',
    'default' => true,
  ),
  
  'informe_urgente' => 
  array (
    'width' => '10%',
    'label' => 'LBL_INFORME_URGENTE',
    'default' => true,
  ),
  
  'master' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MASTER_FRANQUICIA',
    'default' => true,
  ),
  
);
?>
