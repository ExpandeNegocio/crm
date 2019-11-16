<?php
  if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
  $module_name = 'Expan_Local';

  $viewdefs [$module_name] =
    array(
      'DetailView' =>
        array(
          'templateMeta' =>
            array(
              'includes' => array(
                0 => array('file' => 'include/javascript/Expan_Local/DetailViewLocal.js',),
                1 => array('file' => 'include/javascript/include.js',),
              ),
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
                  'DEFAULT' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                ),
            ),
          'panels' =>
            array(
              'default' =>
                array(
                  0 =>
                    array(
                      0 =>
                        array(
                          'name' => 'provincia',
                          'label' => 'LBL_PROVINCIA',
                        ),
                      1 =>
                        array(
                          'name' => 'localidad',
                          'label' => 'LBL_LOCALIDAD',
                        ),
                    ),

                  1 =>
                    array(
                      0 =>
                        array(
                          'name' => 'ubicacion_local',
                          'label' => 'LBL_UBICACION_LOCAL',
                        ),
                      1 =>
                        array(
                          'name' => 'propiedad',
                          'label' => 'LBL_PROPIEDAD',
                        ),
                    ),

                  2 =>
                    array(
                      0 =>
                        array(
                          'name' => 'superficie_local',
                          'label' => 'LBL_SUPERFICIE_LOCAL',
                        ),
                      1 =>
                        array(
                          'name' => 'renta_estimada',
                          'label' => 'LBL_RENTA_ESTIMADA',
                        ),
                    ),

                  3 =>
                    array(
                      0 =>
                        array(
                          'name' => 'descripcion_local',
                          'label' => 'LBL_DESCRIPCION_LOCAL',
                        ),
                      1 =>
                        array(
                          'name' => 'origen_local',
                          'label' => 'LBL_ORIGEN_LOCAL',
                        ),
                    ),
                ),
            ),
        ),
    );
?>