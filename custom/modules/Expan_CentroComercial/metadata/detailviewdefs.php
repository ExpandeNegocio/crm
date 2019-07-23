<?php
$module_name = 'Expan_CentroComercial';
$viewdefs [$module_name] =
  array(
    'DetailView' =>
      array(
        'templateMeta' =>
          array(
            'form' =>
              array(
                'buttons' =>
                  array(
                    0 => 'EDIT',
                    1 => 'DELETE',
                  ),
              ),
            'maxColumns' => '2',
            'widths' =>
              array(
                0 =>
                  array(
                    'label' => '10',
                    'field' => '30',
                  ),
                1 =>
                  array(
                    'label' => '10',
                    'field' => '30',
                  ),
              ),
            'useTabs' => true,
            'tabDefs' =>
              array(
                'LBL_DATOS_GENERALES' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
              ),
          ),
        'panels' =>
          array(
            'LBL_DATOS_GENERALES' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'name',
                        'label' => 'LBL_NAME',
                      ),
                    1 =>
                      array(
                        'name' => 'tipo_cc',
                        'label' => 'LBL_TIPO_CC',
                      ),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_apertura',
                        'label' => 'LBL_PROVINCIA_APERTURA',
                      ),
                    1 => array(
                      'name' => 'localidad_apertura',
                      'label' => 'LBL_LOCALIDAD_APERTURA',
                    ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'codigo_postal',
                        'label' => 'LBL_CODIGO_POSTAL',
                      ),
                    1 => array(
                      'name' => 'num_locales',
                      'label' => 'LBL_LOCALES',
                    ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'superficie_alquilable',
                        'label' => 'LBL_SUPERFICIE_ALQUILABLE'
                      ),
                    1 => array(
                      'name' => 'precio_suelo',
                      'label' => 'LBL_PRECIO_SUELO',
                    ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'num_visitantes',
                        'label' => 'LBL_VISITANTES',
                      ),
                    1 => array(
                      'name' => 'valoracion_en',
                      'label' => 'LBL_VALORACION_EN'
                    ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(
                        'name' => 'year_apertura',
                        'label' => 'LBL_YEAR_APERTURA',
                      ),
                    1 => array(
                      'name' => 'empresa_gestora',
                      'label' => 'LBL_EMPRESA_GESTORA',
                    ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'web',
                        'label' => 'LBL_WEB',
                      ),
                    1 => array(
                      'name' => 'direccion',
                      'label' => 'LBL_DIRECCION',
                    ),
                  ),

                7 =>
                  array(
                    0 =>
                      array(
                        'name' => 'telefono_contacto',
                        'label' => 'LBL_TELEFONO_CONTACTO',
                      ),
                    1 => array(
                      'name' => 'observaciones',
                      'label' => 'LBL_OBSERVACIONES',
                    ),
                  ),
              ),
          ),
      ),
  );
?>

