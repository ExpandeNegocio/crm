<?php
$module_name = 'Expan_Evento';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'year',
            'label' => 'LBL_YEAR',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ciudad',
            'label' => 'LBL_CIUDAD',
          ),
          1 => 
          array (
            'name' => 'fecha_celebracion',
            'label' => 'LBL_FECHA_CELEBRACION',
          ),
        ),
        2 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'cuerpo',
            'label' => 'LBL_CUERPO',
          ),
        ),
      ),
    ),
  ),
);
?>
