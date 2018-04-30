<?php
$module_name = 'Expan_Apertura';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
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
    'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_GENERAL' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PRECONTRATO' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_CONTRATO' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_ADMINISTRACION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),        
      ),
    ),   
    'panels' => 
    array (
      'lbl_general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
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
          0 => 
          array (
            'name' => 'abierta',
            'label' => 'LBL_ABIERTA',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura',
            'label' => 'LBL_LOCALIDAD_APERTURA',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
              'name' => 'motivos_apertura',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVOS_APERTURA',
          ), 
          1 => 
          array (
            'name' => 'incidencias',
            'studio' => 'visible',
            'label' => 'LBL_INCIDENCIAS',   
          ), 
        ),
        5 =>
        array(
            0 => 
            array(
                'name' => 'valoracion',
                'studio' => 'visible',
                'label' => 'LBL_VALORACION_FRAN',
            ),
            1 =>
            array(
                 'name' => 'num_empleados',
                'label' => 'LBL_NUM_EMPLEADOS',
            ),
        ),
        6 =>
         array(
            0 =>
            array(
                'name' => 'area_exclusividad',
                'label' => 'LBL_AREA_EXCLUSIVIDAD',
            ),
            1 =>
            array(
                'name' => 'inversion_inicial',
                'label' => 'LBL_INVERSION_INICIAL',
            ),
            
         ),
         7 =>
         array(
            0 =>
            array(
                'name' => 'f_inicio_contrato',
                'label' => 'LBL_FECHA_INICIO_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'f_renovacion_contrato',
                'label' => 'LBL_FECHA_RENOVACION_CONTRATO',
            ),
            
         ),
         8 =>
         array(
            0 =>
            array(
                'name' => 'f_baja_contrato',
                'label' => 'LBL_FECHA_BAJA_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'motivo_baja',
                'label' => 'LBL_MOTIVO_BAJA',
            ),
            
         ),
         
         9 =>
         array(
            0 =>
            array(
                'name' => 'proy_ERM',
                'label' => 'LBL_PROY_ERM',
            ),        
         ),
                    
      ),
      'lbl_precontrato' => 
      array (
      
         0 =>
         array(
            0 =>
            array(
                'name' => 'f_precontrato_firma',
                'label' => 'LBL_FECHA_PRECONTRATO_FIRMA',
            ),
                      
         ),
      
        1 =>
         array(
            0 =>
            array(
                'label' => 'LBL_FIRMANTE1',
            ),
            1 =>
            array(
                'label' => 'LBL_FIRMANTE2',
            ),            
         ),
      
        2 =>
         array(
            0 =>
            array(
                'name' => 'pre_fir1_first_name',
                'label' => 'LBL_FIRST_NAME',
            ),
            1 =>
            array(
                'name' => 'pre_fir2_first_name',
                'label' => 'LBL_FIRST_NAME',
            ),            
         ),
      
        3 =>
         array(
            0 =>
            array(
                'name' => 'pre_fir1_last_name',
                'label' => 'LBL_LAST_NAME',
            ),
            1 =>
            array(
                'name' => 'pre_fir2_last_name',
                'label' => 'LBL_LAST_NAME',
            ),            
         ),
         
         4 =>
         array(
            0 =>
            array(
                'name' => 'pre_fir1_NIF',
                'label' => 'LBL_NIF',
            ),
            1 =>
            array(
                'name' => 'pre_fir2_last_name',
                'label' => 'LBL_NIF',
            ),
         ),
         
         5 =>
         array(
            0 =>
            array(
                'name' => 'pre_fir1_vecino',
                'label' => 'LBL_VECINO',
            ),
            1 =>
            array(
                'name' => 'pre_fir2_vecino',
                'label' => 'LBL_VECINO',
            ),
         ),
         
         6 =>
         array(
            0 =>
            array(
                'name' => 'pre_fir1_domicilio',
                'label' => 'LBL_DOMICILIO',
            ),
            1 =>
            array(
                'name' => 'pre_fir2_domicilio',
                'label' => 'LBL_DOMICILIO',
            ),
         ),
         
         7 =>
         array(
            0 =>
            array(
                'label' => 'LBL_CONDICIONES',
            ),
         ),
         
         
         8 =>
         array(
            0 =>
            array(
                'name' => 'pre_num_unidades',
                'label' => 'LBL_PRE_NUM_UNIDADES',
            ),
            1 =>
            array(
           
            ),
         ),
         
         9 =>
         array(
            0 =>
            array(
                'name' => 'provincia_apertura',
                'label' => 'LBL_PROVINCIA_APERTURA',
            ),
            1 =>
            array(
                'name' => 'localidad_apertura',
                'label' => 'LBL_LOCALIDAD_APERTURA',
            ),
         ),        
         
         10 =>
         array(
            0 =>
            array(
                'name' => 'periodo_validez',
                'label' => 'LBL_ENTREGA_CUENTA',
            ),
            1 =>
            array(
                'name' => 'entrega_cuenta',
                'label' => 'LBL_ENTREGA_CUENTA',
            ),
         ),        
         
         11 =>
         array(
            0 =>
            array(
                'name' => 'canon_entrada',
                'label' => 'LBL_CANON_ENTRADA',
            ),
            1 =>
            array(         
            ),
         ),               
        ),

      
          'LBL_CONTRATO' => 
          array (
          
              0 =>
             array(
                0 =>
                array(
                    'name' => 'f_precontrato_firma',
                    'label' => 'LBL_FECHA_PRECONTRATO_FIRMA',
                ),
                          
             ),
          
            1 =>
             array(
                0 =>
                array(
                    'label' => 'LBL_FIRMANTE1',
                ),
                1 =>
                array(
                    'label' => 'LBL_FIRMANTE2',
                ),            
             ),
          
            2 =>
             array(
                0 =>
                array(
                    'name' => 'pre_fir1_first_name',
                    'label' => 'LBL_FIRST_NAME',
                ),
                1 =>
                array(
                    'name' => 'pre_fir2_first_name',
                    'label' => 'LBL_FIRST_NAME',
                ),            
             ),
          
            3 =>
             array(
                0 =>
                array(
                    'name' => 'pre_fir1_last_name',
                    'label' => 'LBL_LAST_NAME',
                ),
                1 =>
                array(
                    'name' => 'pre_fir2_last_name',
                    'label' => 'LBL_LAST_NAME',
                ),            
             ),
             
             4 =>
             array(
                0 =>
                array(
                    'name' => 'pre_fir1_NIF',
                    'label' => 'LBL_NIF',
                ),
                1 =>
                array(
                    'name' => 'pre_fir2_last_name',
                    'label' => 'LBL_NIF',
                ),
             ),
             
             5 =>
             array(
                0 =>
                array(
                    'name' => 'pre_fir1_vecino',
                    'label' => 'LBL_VECINO',
                ),
                1 =>
                array(
                    'name' => 'pre_fir2_vecino',
                    'label' => 'LBL_VECINO',
                ),
             ),
             
             6 =>
             array(
                0 =>
                array(
                    'name' => 'pre_fir1_domicilio',                  
                    'label' => 'LBL_DOMICILIO',         
                ),
                1 =>
                array(
                    'name' => 'pre_fir2_domicilio',
                    'label' => 'LBL_DOMICILIO',
                ),
             ),   
             
             7 =>
             array(
                0 =>
                array(
                    'label' => 'LBL_SOCIEDAD1',
                ),
                1 =>
                array(
                    'label' => 'LBL_SOCIEDAD2',
                ),            
             ),
            
            8 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_localidad',
                    'label' => 'LBL_LOCALIDAD',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_localidad',
                    'label' => 'LBL_LOCALIDAD',
                ),
             ), 
                          
            9 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_provincia',
                    'label' => 'LBL_PROVINCIA',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_provincia',
                    'label' => 'LBL_PROVINCIA',
                ),
             ),
          
            10 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_CP',
                    'label' => 'LBL_CP',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_CP',
                    'label' => 'LBL_CP',
                ),
             ),
             
            11 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_tomo',
                    'label' => 'LBL_TOMO',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_tomo',
                    'label' => 'LBL_TOMO',
                ),
             ),
          
             12 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_hoja',
                    'label' => 'LBL_HOJA',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_hoja',
                    'label' => 'LBL_HOJA',
                ),
             ),
          
             13 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_folio',
                    'label' => 'LBL_FOLIO',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_folio',
                    'label' => 'LBL_FOLIO',
                ),
             ),
             
             14 =>
             array(
                0 =>
                array(
                    'name' => 'sociedad1_inscripcion',
                    'label' => 'LBL_INSCRIPCION',
                ),
                1 =>
                array(
                    'name' => 'sociedad2_inscripcion',
                    'label' => 'LBL_INSCRIPCION',
                ),
             ),
             
             15 =>
             array(
                0 =>
                array(
                    'label' => 'LBL_LOCAL',
                ),
                1 =>
                array(
                ),
             ),
             
             16 =>
             array(
                0 =>
                array(
                    'name' => 'local_municipio',
                    'label' => 'LBL_MUNICIPIO',
                ),
                1 =>
                array(
                    'name' => 'local_municipio',
                    'label' => 'LBL_PROVINCIA',
                ),
             ),
          
            17 =>
             array(
                0 =>
                array(
                    'name' => 'local_CP',
                    'label' => 'LBL_CP',
                ),
                1 =>
                array(
                    'name' => 'local_Direccion',
                    'label' => 'LBL_DIRECCION',
                ),
             ),
             
             18 =>
             array(
                0 =>
                array(
                    'name' => 'f_tope_apertura',
                    'label' => 'LBL_FECHA_INICIO_CONTRATO',
                ),
                1 =>
                array(
                    'name' => 'n_cuenta',
                    'label' => 'LBL_CUENTA',
                ),
             ),
          
             19 =>
             array(
                0 =>
                array(
                    'name' => 'duracion_contrato',
                    'label' => 'LBL_DURACION_CONTRATO',
                ),
                1 =>
                array(
                    'name' => 'canon_entrada_definitivo',
                    'label' => 'LBL_CANON_ENTRADA',
                ),
             ),
          
             20 =>
             array(
                0 =>
                array(
                    'name' => 'zona_exlusividad',
                    'label' => 'LBL_ZONA_EXCLUSIVIDAD',
                ),
   
             ),
          
          ),
          
          'LBL_ADMINISTRACION' => 
          array (
          
             0 =>
             array(
                0 =>
                array(
                    'name' => 'Comision_cons_cartera',
                    'label' => 'LBL_COMISION_CONS_CARTERA',
                ),                      
             ),
          
             1 =>
             array(
                0 =>
                array(
                    'name' => 'f_ini_com_cons_cartera',
                    'label' => 'LBL_FECHA_INI_COM_CONS_CARTERA',
                ),
                1 =>
                array(
                    'name' => 'f_fin_com_cons_cartera',
                    'label' => 'LBL_FECHA_FIN_COM_CONS_CARTERA',
                ),            
             ),
          
          ),
      
       ),
    ),
);
?>
