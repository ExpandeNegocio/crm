<?php
$module_name = 'Expan_Apertura';
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
      ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        
        1 =>
        array(
            0 => 
            array (
            'name' => 'franquicia',
            'studio' => 'visible',
            'link' => true,
            'label' => 'LBL_FRANQUICIA',
          ),
            
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'tipo_apertura',
            'label' => 'LBL_TIPO_APERTURA',
          ),
          1 => 
          array (
            'name' => 'provincia_apertura',
            'label' => 'LBL_PROVINCIA_APERTURA',
          ),
        ),
        
        3 =>
        array (
            0 => array(
                'name' => 'abierta',
                'label' => 'LBL_ABIERTA',
            ),
            1 => array(
                'name' => 'Localidad_apertura',
                'label' => 'LBL_LOCALIDAD_APERTURA',
            ),
        ),
        
        4 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
