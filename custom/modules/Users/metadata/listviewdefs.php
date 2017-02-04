<?php
$listViewDefs ['Users'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'related_fields' => 
    array (
      0 => 'last_name',
      1 => 'first_name',
    ),
    'orderBy' => 'last_name',
    'default' => true,
  ),
  'USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_USER_NAME',
    'link' => true,
    'default' => true,
  ),
  'TITLE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TITLE',
    'link' => true,
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '30%',
    'sortable' => false,
    'label' => 'LBL_LIST_EMAIL',
    'link' => true,
    'default' => true,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_PHONE',
    'link' => true,
    'default' => true,
  ),
  'DIR_CUENTA' => 
  array (
    'width' => '10%',
    'link' => false,
    'label' => 'LBL_DIR_CUENTA',
    'default' => true,
    'id'=>'DIR_CUENTA',
    
  ),
  
  'DIR_CONSULTORIA' => 
  array (
    'width' => '10%',
    'link' => false,
    'label' => 'LBL_DIR_CONSULTORIA',
    'default' => true,
  ),
  
  'NUM_POSITIVAS' => 
  array (
    'width' => '10%',
    'link' => false,
    'label' => 'LBL_NUM_POSITIVAS',
    'default' => true,
  ),
  
  'NUM_ABIERTAS' => 
  array (
    'width' => '10%',
    'link' => false,
    'label' => 'LBL_NUM_ABIERTAS',
    'default' => true,
  ),
  
  'TOTAL_CUENTAS' => 
  array (
    'width' => '10%',
    'link' => false,
    'label' => 'LBL_TOTAL_CUENTAS',
    'default' => true,
  ),
  
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'IS_ADMIN' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ADMIN',
    'link' => false,
    'default' => true,
  ),

);
?>
