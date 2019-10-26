<?php
  $module_name = 'Expan_Empresa';
  $_object_name = 'expan_empresa';
  $viewdefs [$module_name] =
    array(
      'EditView' =>
        array(
          'templateMeta' =>
            array(
              'form' =>
                array(
                  'buttons' =>
                    array(
                      //  0 => 'SAVE',
                      0 =>
                        array(
                          'customCode' => '<input type="submit" name="save" id="save" class="submit" 
            onClick="        
            this.form.return_action.value=\'DetailView\'; 
            this.form.action.value=\'Save\';             
            var valido=validarEmpresa(\'EditView\');                           
            return valido;" value="Guardar">',
                        ),

                      1 => 'CANCEL',
                    ),
                ),
              'maxColumns' => '2',
              'widths' =>
                array(
                  0 =>
                    array(
                      'label' => '20',
                      'field' => '30',
                    ),
                  1 =>
                    array(
                      'label' => '20',
                      'field' => '30',
                    ),
                ),
              'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
      {sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
      {sugar_getscript file="include/javascript/ExpandeNegocio/general.js"}
      {sugar_getscript file="include/javascript/Expan_Empresa/GeneralEmpresa.js"}
      {sugar_getscript file="include/javascript/Expan_Empresa/EditViewEmpresa.js"}      
      {sugar_getscript file="include/javascript/jquery.js"}
      {sugar_getscript file="modules/Accounts/Account.js"}
      </script>',
              'useTabs' => true,
              'tabDefs' =>
                array(
                  'LBL_DATOS_GENERALES' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_PROVEEDORES_GENERAL' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_PROVEEDORES_FRANQUICIA' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_PROPUESTA' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_COMPETIDOR' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_ALIANZA' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                  'LBL_DATOS_MISTERY' =>
                    array(
                      'newTab' => true,
                      'panelDefault' => 'expanded',
                    ),
                ),
            ),
          'panels' =>
            array(

              //-----------------------------------------------------------------------------------------------------------------------------

              //Datos gerenales de la empresa
              'LBL_DATOS_GENERALES' =>
                array(

                  -2 =>
                    array(
                      0 =>
                        array(
                          'name' => 'sector',
                          'label' => 'LBL_SECTOR',
                        ),
                      1 =>
                        array(),
                    ),

                  -1 =>
                    array(
                      0 =>
                        array(
                          'name' => 'date_entered',
                          'label' => 'LBL_DATE_ENTERED',
                        ),
                      1 =>
                        array(),
                    ),

                  0 =>
                    array(
                      0 =>
                        array(
                          'name' => 'name',
                          'label' => 'LBL_NAME',
                        ),
                      1 =>
                        array(
                          'name' => 'origen',
                          'label' => 'LBL_ORIGEN',
                        ),
                    ),

                  1 =>
                    array(
                      0 =>
                        array(
                          'name' => 'razon_social',
                          'label' => 'LBL_RAZON_SOCIAL',
                        ),
                      1 =>
                        array(
                          'name' => 'cif',
                          'label' => 'LBL_CIF',
                        ),
                    ),

                  2 =>
                    array(
                      0 =>
                        array(
                          'name' => 'empresa_type',
                          'label' => 'LBL_TYPE',
                        ),
                      1 =>
                        array(
                          'name' => 'chk_es_cliente_potencial',
                          'label' => 'LBL_ES_CLIENTE_POTENCIAL',
                        ),
                    ),

                  3 =>
                    array(
                      0 =>
                        array(),
                      1 =>
                        array(
                          'name' => 'chk_es_proveedor',
                          'label' => 'LBL_ES_PROVEEDOR',
                        ),
                    ),

                  4 =>
                    array(
                      0 =>
                        array(),
                      1 =>
                        array(
                          'name' => 'chk_es_competidor',
                          'label' => 'LBL_ES_COMPETIDOR',
                        ),
                    ),

                  5 =>
                    array(
                      0 =>
                        array(),
                      1 =>
                        array(
                          'name' => 'chk_alianza',
                          'label' => 'LBL_ALIANZA',
                        ),
                    ),

                  6 =>
                    array(
                      0 =>
                        array(
                          'name' => 'chk_trabaja_consultora',
                          'label' => 'LBL_TRABAJA_CONSULTORA',
                        ),
                      1 =>
                        array(
                          'name' => 'consultora',
                          'label' => 'LBL_CONSULTORA',
                        ),
                    ),

                  7 =>
                    array(
                      0 =>
                        array(
                          'name' => 'email1',
                          'label' => 'LBL_EMAIL',
                        ),
                      1 => array(),
                    ),

                  8 =>
                    array(
                      0 =>
                        array(
                          'name' => 'telefono_contacto_1',
                          'label' => 'LBL_TELEFONO_CONTACTO1',
                        ),
                      1 => array(
                        'name' => 'telefono_contacto_observa1',
                        'label' => 'LBL_TELEFONO_CONTACTO_OBSERVA1',
                      ),
                    ),

                  9 =>
                    array(
                      0 =>
                        array(
                          'name' => 'telefono_contacto_2',
                          'label' => 'LBL_TELEFONO_CONTACTO2',
                        ),
                      1 => array(
                        'name' => 'telefono_contacto_observa2',
                        'label' => 'LBL_TELEFONO_CONTACTO_OBSERVA2',
                      ),
                    ),

                  10 =>
                    array(
                      0 =>
                        array(
                          'name' => 'telefono_contacto_3',
                          'label' => 'LBL_TELEFONO_CONTACTO3',
                        ),
                      1 => array(
                        'name' => 'telefono_contacto_observa3',
                        'label' => 'LBL_TELEFONO_CONTACTO_OBSERVA3',
                      ),
                    ),

                  11 =>
                    array(
                      0 =>
                        array(
                          'name' => 'direccion',
                          'label' => 'LBL_DIRECCION',
                        ),
                      1 => array(
                        'name' => 'codigo_postal',
                        'label' => 'LBL_CODIGO_POSTAL',
                      ),
                    ),

                  12 =>
                    array(
                      0 =>
                        array(
                          'name' => 'pais',
                          'label' => 'LBL_PAIS',
                        ),
                      1 => array(),
                    ),

                  13 =>
                    array(
                      0 =>
                        array(
                          'name' => 'ccaa',
                          'label' => 'LBL_CCAA',
                        ),
                      1 => array(
                        'name' => 'provincia',
                        'label' => 'LBL_PROVINCIA',
                      ),
                    ),

                  14 =>
                    array(
                      0 =>
                        array(
                          'name' => 'poblacion',
                          'label' => 'LBL_POBLACION',
                        ),
                      1 => array(),
                    ),

                  15 =>
                    array(
                      0 =>
                        array(
                          'name' => 'web',
                          'label' => 'LBL_WEB',
                        ),
                      1 => array(
                        'name' => 'ambito_empresa',
                        'label' => 'LBL_AMBITO_EMPRESA',
                      ),
                    ),

                  16 =>
                    array(
                      0 =>
                        array(
                          'name' => 'sector_arbol',
                          'studio' => 'visible',
                          'label' => 'LBL_SECTOR',
                          'customCode' => '
              {php}
                  include "custom/modules/Expan_Franquicia/metadata/opEdicionFranquicia.php";
                  $prueba=new opEdicionFranquicia();
                  $prueba->cargaSectores();  
              {/php}',
                        ),
                      1 => array(
                        'name' => 'actividad_principal',
                        'label' => 'LBL_ACTIVIDAD_PRINCIPAL',
                      ),
                    ),

                  17 =>
                    array(
                      0 =>
                        array(
                          'name' => 'otros_sectores',
                          'label' => 'LBL_OTROS_SECTORES',
                        ),
                      1 => array(),
                    ),

                  18 =>
                    array(
                      0 =>
                        array(
                          'name' => 'fecha_contacto',
                          'label' => 'LBL_FECHA_CONTACTO',
                        ),
                      1 => array(),
                    ),

                  19 =>
                    array(
                      0 =>
                        array(
                          'name' => 'observaciones',
                          'label' => 'LBL_OBSERVACIONES',
                        ),
                      1 => array(),
                    ),

                  20 =>
                    array(
                      0 =>
                        array(
                          'label' => 'LBL_CONTACTO1',
                        ),
                      1 => array(
                        'label' => 'LBL_CONTACTO2',
                      ),
                    ),

                  21 =>
                    array(
                      0 =>
                        array(
                          'name' => 'contacto1',
                          'label' => 'LBL_CONTACTO',
                        ),
                      1 => array(
                        'name' => 'contacto2',
                        'label' => 'LBL_CONTACTO',
                      ),
                    ),

                  22 =>
                    array(
                      0 =>
                        array(
                          'name' => 'cargo1',
                          'label' => 'LBL_CARGO',
                        ),
                      1 => array(
                        'name' => 'cargo2',
                        'label' => 'LBL_CARGO',
                      ),
                    ),

                  23 =>
                    array(
                      0 =>
                        array(
                          'name' => 'telefono1',
                          'label' => 'LBL_TELEFONO',
                        ),
                      1 => array(
                        'name' => 'telefono2',
                        'label' => 'LBL_TELEFONO',
                      ),
                    ),

                  24 =>
                    array(
                      0 =>
                        array(
                          'name' => 'movil1',
                          'label' => 'LBL_MOVIL',
                        ),
                      1 => array(
                        'name' => 'movil2',
                        'label' => 'LBL_MOVIL',
                      ),
                    ),

                  25 =>
                    array(
                      0 =>
                        array(
                          'name' => 'email_con_1',
                          'label' => 'LBL_EMAIL',
                        ),
                      1 => array(
                        'name' => 'email_con_2',
                        'label' => 'LBL_EMAIL',
                      ),
                    ),

                  26 =>
                    array(
                      0 =>
                        array(
                          'name' => 'observacion_con_1',
                          'label' => 'LBL_OBSERVACIONES_CONTACTO',
                        ),
                      1 => array(
                        'name' => 'observacion_con_2',
                        'label' => 'LBL_OBSERVACIONES_CONTACTO',
                      ),
                    ),
                ),
            ),
        ),
    );


  // ---- PROVEEDORES --------------------------------------------------------------

  $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_PROVEEDORES_GENERAL'] =
    array(
      0 =>
        array(
          0 =>
            array(
              'name' => 'chk_proveedor_activo',
              'label' => 'LBL_PROVEEDOR_ACTIVO',
            ),
          1 =>
            array(
              'name' => 'principales_prod_serv',
              'label' => 'LBL_PRINCIPALES_PROD_SERV',
            ),
        ),

      1 =>
        array(
          0 =>
            array(
              'name' => 'chk_proveedor_cliente',
              'label' => 'LBL_PROVEEDOR_CLIENTE',
            ),
          1 =>
            array(),
        ),

      2 =>
        array(
          0 =>
            array(
              'name' => 'zonas_no_opera',
              'label' => 'LBL_ZONAS_NO_OPERA',
            ),
          1 =>
            array(
              'name' => 'ambito_actuacion',
              'label' => 'LBL_AMBITO_ACTUACION',
            ),
        ),

      3 =>
        array(
          0 =>
            array(
              'name' => 'cert_calidad',
              'label' => 'LBL_CERT_CALIDAD',
            ),
          1 =>
            array(
              'name' => 'sedes',
              'label' => 'LBL_SEDES',
            ),
        ),

      4 =>
        array(
          0 =>
            array(
              'name' => 'chk_proveedor_cliente',
              'label' => 'LBL_PROVEEDOR_CLIENTE',
            ),
          1 =>
            array(
              'name' => 'intranet_catalogo',
              'label' => 'LBL_INTRANET_CATALOGO',
            ),
        ),

      5 =>
        array(
          0 =>
            array(
              'name' => 'condiciones_generales',
              'label' => 'LBL_CONDICIONES_GENERALES',
            ),
          1 =>
            array(
              'name' => 'condiciones_especiales_en',
              'label' => 'LBL_CONDICIONES_ESPECIALES_EN',
            ),
        ),

      6 =>
        array(
          0 =>
            array(
              'name' => 'observaciones_proveedor',
              'label' => 'LBL_OBSERVACIONES_PROVEEDOR',
            ),
          1 =>
            array(),
        ),
    );


  // ---- PROVEEDORES FRANQUICIA--------------------------------------------------------------

  $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_PROVEEDORES_FRANQUICIA'] =
    array(
      0 => array(
        0 =>
          array(
            'name' => 'proveedor_insert',

            'customCode' => '         
      {php}                             
           $idProveedor=$this->_tpl_vars["bean"]->id;                    
          include "custom/modules/Expan_Empresa/metadata/opEdicionEmpresa.php";
          $op=new opEdicionEmpresa();
          $op->showInterfazProveedorEmpresa($idProveedor,"EditView");
      {/php}',

          ),

        1 =>
          array(
            'name' => 'proveedor_list',
            'customCode' => '
      {php}              
          $idProveedor=$this->_tpl_vars["bean"]->id;                           
          $op=new opEdicionEmpresa();
          $op->showListFranqucia($idProveedor);
      {/php}',
          )
      ),
    );


  // ---- DATOS DE COMPETIDOR --------------------------------------------------------------------------

  $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_COMPETIDOR'] =
    array(
      -1 =>
        array(
          0 =>
            array(
              'name' => 'date_entered',
              'label' => 'LBL_FCREACION_CADENA',
              'type' => 'readonly',
            ),
          1 =>
            array(
              'name' => 'date_modified',
              'label' => 'LBL_F_TOMA_DATOS',
              'type' => 'readonly',
            ),
        ),

      0 =>
        array(
          0 =>
            array(
              'name' => 'const_year',
              'label' => 'LBL_CONST_YEAR',
            ),
          1 =>
            array(),
        ),
      1 =>
        array(
          0 =>
            array(
              'name' => 'num_locales_propios',
              'label' => 'LBL_LOCALES_PROPIOS',
            ),
          1 =>
            array(
              'name' => 'num_locales_franquiciados',
              'label' => 'LBL_LOCALES_FRANQUICIADOS',
            ),
        ),

      2 =>
        array(
          0 =>
            array(
              'name' => 'num_locales_extran',
              'label' => 'LBL_LOCALES_EXTRAN',
            ),
          1 =>
            array(
              'name' => 'poblacion_min',
              'label' => 'LBL_POBLACION_MIN',
            ),
        ),

      3 =>
        array(
          0 =>
            array(
              'name' => 'sup_local_min',
              'label' => 'SUP_LOCAL_MIN',
            ),
          1 =>
            array(
              'name' => 'zona_prioritaria_antece',
              'label' => 'LBL_ZONA_PRIORITARIA',
            ),
        ),

      4 =>
        array(
          0 =>
            array(
              'name' => 'productos_servicios',
              'label' => 'LBL_PRODUCTOS_SERVICIOS',
            ),
          1 =>
            array(
              'name' => 'otros_requisitos',
              'label' => 'LBL_OTROS_REQUISITOS',
            ),
        ),

      5 =>
        array(
          0 =>
            array(
              'name' => 'inversion',
              'label' => 'LBL_INVERSION',
            ),
          1 =>
            array(
              'name' => 'canon_entrada',
              'label' => 'LBL_CANON_ENTRADA',
            ),
        ),

      6 =>
        array(
          0 =>
            array(
              'name' => 'royalty_explotacion',
              'label' => 'LBL_ROYALTY_EXPLOTACION',
            ),
          1 =>
            array(
              'name' => 'fondo_marketing',
              'label' => 'LBL_FONDO_MARKETING',
            ),
        ),

      7 =>
        array(
          0 =>
            array(
              'name' => 'duracion_contrato',
              'label' => 'LBL_DURACION_CONTRATO',
            ),
          1 =>
            array(
              'name' => 'ayuda_financiera',
              'label' => 'LBL_AYUDA_FINANCIERA',
            ),
        ),

      8 =>
        array(
          0 =>
            array(
              'name' => 'personal_necesario',
              'label' => 'LBL_PERSONAL_NECESARIO',
            ),
          1 =>
            array(
              'name' => 'perfil_candidato',
              'label' => 'LBL_PERFIL_CANDIDATO',
            ),
        ),

      9 =>
        array(
          0 =>
            array(
              'name' => 'elementos_diferenciales',
              'label' => 'LBL_ELEM_DIFERENCIALES',
            ),
          1 =>
            array(
              'name' => 'posicionamiento_online',
              'label' => 'LBL_POSICIONAMIENTO_ONLINE',
            ),
        ),

      10 =>
        array(
          0 =>
            array(
              'name' => 'ferias',
              'label' => 'LBL_FERIAS',
            ),
          1 =>
            array(
              'name' => 'portales',
              'label' => 'LBL_PORTALES',
            ),
        ),

      11 =>
        array(
          0 =>
            array(
              'name' => 'mailings',
              'label' => 'LBL_MAILINGS',
            ),
          1 =>
            array(
              'name' => 'publicaciones',
              'label' => 'LBL_PUBLICACIONES',
            ),
        ),

      12 =>
        array(
          0 =>
            array(
              'name' => 'marketing_digital',
              'label' => 'LBL_MARKETING_DIGITAL',
            ),
          1 =>
            array(
              'name' => 'otras_acciones',
              'label' => 'LBL_OTRAS_ACCIONES',
            ),
        ),

      13 =>
        array(
          0 =>
            array(
              'name' => 'aperturas_propias',
              'label' => 'LBL_APERTURAS_PROPIAS',
            ),
          1 =>
            array(
              'name' => 'aperturas_franquiciados',
              'label' => 'LBL_APERTURAS_FRANQUICIADOS',
            ),
        ),

      14 =>
        array(
          0 =>
            array(
              'name' => 'cierres_propios',
              'label' => 'LBL_CIERRES_PROPIOS',
            ),
          1 =>
            array(
              'name' => 'cierres_franquiciados',
              'label' => 'LBL_CIERRES_FRANQUICIADOS',
            ),
        ),

      15 =>
        array(
          0 =>
            array(
              'name' => 'aperturas_extranjero',
              'label' => 'LBL_APERTURAS_EXTRANJERO',
            ),
          1 =>
            array(
              'name' => 'cierres_extranjero',
              'label' => 'LBL_CIERRES_EXTRANJERO',
            ),
        ),

      16 =>
        array(
          0 =>
            array(
              'name' => 'web',
              'label' => 'LBL_WEB',
              'type' => 'readonly',
            ),
          1 =>
            array(
              'name' => 'noticias',
              'label' => 'LBL_NOTICIAS',
            ),

        ),
    );

  global $current_user;

  if ($current_user->id == '71f40543-2702-4095-9d30-536f529bd8b6' || $current_user->id == '1'
  ) {


    // ---- DATOS DE CLIENTE POTENCIAL --------------------------------------------------------------------------

    $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_PROPUESTA'] =
      array(
        0 =>
          array(
            0 =>
              array(
                'name' => 'rating',
                'label' => 'LBL_RATING',
              ),
            1 =>
              array(),
          ),

        1 =>
          array(
            0 =>
              array(
                'name' => 'estado_cp',
                'label' => 'LBL_ESTADO',
              ),
            1 =>
              array(
                'name' => 'positivo_cp',
                'label' => 'LBL_POSITIVO_CP'
              ),
          ),

        2 =>
          array(
            0 =>
              array(
                'name' => 'estado_proyecto',
                'label' => 'LBL_ESTADO_PROYECTO',
              ),
            1 =>
              array(
                'name' => 'observaciones_estado',
                'label' => 'LBL_OBSERVACIONES_ESTADO',
              ),
          ),

        3 =>
          array(
            0 =>
              array(
                'name' => 'interes_en',
                'label' => 'LBL_INTERES_EN',
              ),
            1 =>
              array(
                'name' => 'encaje_cliente',
                'label' => 'LBL_ENCAJE_CLIENTE',
              ),
          ),

        4 =>
          array(
            0 =>
              array(),
            1 =>
              array(
                'name' => 'motivo_no_gusta',
                'label' => 'LBL_MOTIVO_NO_GUSTA',
              ),
          ),

        5 =>
          array(
            0 =>
              array(),
            1 =>
              array(
                'name' => 'motivo_no_encaja',
                'label' => 'LBL_MOTIVO_NO_ENCAJA',
              ),
          ),

        6 =>
          array(
            0 =>
              array(
                'name' => 'chk_corto_plazo',
                'label' => 'LBL_CORTO_PLAZO',
              ),
            1 =>
              array(),
          ),

        7 =>
          array(
            0 =>
              array(
                'name' => 'decision',
                'label' => 'LBL_DECISION',
              ),
            1 =>
              array(
                'name' => 'f_plazo',
                'label' => 'LBL_PLAZO',
              ),
          ),

        8 =>
          array(
            0 =>
              array(
                'name' => 'tipo_propuesta',
                'label' => 'LBL_TIPO_PROPUESTA',
              ),
            1 =>
              array(
                'name' => 'f_envio_propuesta',
                'label' => 'LBL_ENVIO_PROPUESTA',
              ),
          ),

        9 =>
          array(
            0 =>
              array(
                'name' => 'observaciones_propuesta',
                'label' => 'LBL_OBSERVACIONES_PROPUESTA',
              ),
            1 =>
              array(),
          ),

        10 =>
          array(
            0 =>
              array(
                'name' => 'consultora_habla',
                'label' => 'LBL_CONSULTORA_FRANQUICIA_HABLA',
              ),
            1 =>
              array(

              ),
          ),

        11 =>
          array(
            0 =>
              array(
                'name' => 'informacion_proyecto',
                'label' => 'LBL_INFORMACION_PROYECTO',
              ),
            1 =>
              array(
                'name' => 'chk_alta_news',
                'label' => 'LBL_ALTA_NEWS',
              ),
          ),

        12 =>
          array(
            0 =>
              array(
                'name' => 'hist_conversacion',
                'label' => 'LBL_HISTORICO_CONVERSACION',
              ),
            1 =>
              array(),
          ),

      );

    // ---- DATOS DE ALIZANZA --------------------------------------------------------------------------

    $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_ALIANZA'] =
      array(

        1 =>
          array(
            0 =>
              array(
                'name' => 'estado_alia',
                'label' => 'LBL_ESTADO',
              ),
            1 =>
              array(),
          ),

        2 =>
          array(
            0 =>
              array(
                'name' => 'f_inicio_alianza',
                'label' => 'LBL_FECHA_INICIO_ALIANZA',
              ),
            1 =>
              array(
                'name' => 'f_restriccion_alianza',
                'label' => 'LBL_FECHA_RESTRICCION_ALIANZA',
              ),
          ),

        3 =>
          array(
            0 =>
              array(
                'name' => 'chk_alianza_central',
                'label' => 'LBL_ALIANZA_CENTRAL',
              ),
            1 =>
              array(
                'name' => 'chk_alianza_fdo',
                'label' => 'LBL_ALIANZA_FDO',
              ),
          ),

        4 =>
          array(
            0 =>
              array(
                'name' => 'condiciones_alianza',
                'label' => 'LBL_CONDICIONES_ALIANZA',
              ),
            1 =>
              array(),
          ),
      );

  }


  // ---- DATOS DE MISTERY ----------------------------------------------------------------------------

  $viewdefs [$module_name]['EditView']['panels']['LBL_DATOS_MISTERY'] =
    array(
      0 =>
        array(
          0 =>
            array(
              'name' => 'nom_central_mistery',
              'label' => 'LBL_NOM_CENTRAL_MISTERY',
            ),
          1 =>
            array(
              'name' => 'nom_mistery',
              'label' => 'LBL_NOM_MISTERY',
            ),
        ),

      1 =>
        array(
          0 =>
            array(
              'name' => 'correo_central_mistery',
              'label' => 'LBL_CORREO_CENTRAL_MISTERY',
            ),
          1 =>
            array(
              'name' => 'correo_mistery',
              'label' => 'LBL_CORREO_MISTERY',
            ),
        ),

      2 =>
        array(
          0 =>
            array(
              'name' => 'telefono_central_mistery',
              'label' => 'LBL_TELEFONO_CENTRAL_MISTERY',
            ),
          1 =>
            array(
              'name' => 'telefono_mistery',
              'label' => 'LBL_TELEFONO_MISTERY',
            ),
        ),

      3 =>
        array(
          0 =>
            array(
              'name' => 'f_entrevista_mistery',
              'label' => 'LBL_FECHA_MISTERY',
            ),
          1 =>
            array(),
        ),

      4 =>
        array(
          0 =>
            array(
              'name' => 'ubicacion_mistery',
              'label' => 'LBL_UBICACION_MISTERY',
            ),
          1 =>
            array(
              'name' => 'catalogos_mistery',
              'label' => 'LBL_CATALOGO_MISTERY',
            ),
        ),
    );


?>
