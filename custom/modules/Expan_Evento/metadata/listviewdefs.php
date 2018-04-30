<?php
$module_name = 'Expan_Evento';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'CIUDAD' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CIUDAD',
    'width' => '10%',
    'default' => true,
  ),
  'YEAR' => 
  array (
    'type' => 'int',
    'label' => 'LBL_YEAR',
    'width' => '10%',
    'default' => true,
  ),
  
  'fecha_celebracion'=>
  array (
    'type' => 'date',
    'label' => 'LBL_FECHA_CELEBRACION',
    'width' => '10%',
    'default' => true,
  ),
);
?>
