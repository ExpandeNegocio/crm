<?php
$module_name = 'Expin_Informes';
$listViewDefs [$module_name] = 
array (

  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '60%',
    'default' => true,
  ),
    'tipo' => 
  array (
    'type' => 'text',
    'label' => 'LBL_TIPO',
    'sortable' => true,
    'width' => '30%',
    'default' => true,
  ),
);
?>
