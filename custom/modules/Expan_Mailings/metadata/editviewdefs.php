<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
$module_name = 'Expan_Mailings';

$viewdefs [$module_name] = 
    array (
      'EditView' => 
      array (
        'templateMeta' => 
        array (
            'includes' => array (                
                1=>array ('file' => 'include/javascript/include.js',),
            ),
          'form' => 
          array (
            'buttons' => 
            array (
              0 => 'SAVE',
              1 => 'CANCEL',           
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
            'DEFAULT' => 
            array (
              'newTab' => true,
              'panelDefault' => 'expanded',
            ),          
            'LBL_EDIT_VIEW_ESTADISTICAS' =>
            array (
              'newTab' => true,
              'panelDefault' => 'expanded',
            ),
            'LBL_EDIT_VIEW_ADMINISTRACION' =>
            array (
              'newTab' => true,
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
                'name' => 'tipo',
                'label' => 'LBL_TIPO_MAILING',
              ),
            ),  
             
            1 => 
            array (
              0 => 
              array (
                'name' => 'fecha_envio',
                'label' => 'LBL_F_ENVIO',
              ),
              1 => 
              array (
                'name' => 'envio_name',
                'label' => 'LBL_MAILING_INTERNO',              ),
            ),    
            
            2 => 
            array (
              0 => 
              array (
                'name' => 'franquicias_envio',
                'label' => 'LBL_FRANQUICIAS_ENVIO',
              ),
              1 => 
              array (
                'name' => 'mailings_enviados_medio',
                'label' => 'LBL_MAILINGS_ENVIADOS_MEDIO',
              ),
            ),  
            
            3 => 
            array (
              0 => 
              array (
                'name' => 'f_ultima_entrada',
                'label' => 'LBL_F_ULTIMA_ENTRADA',  
              ),
              1 => 
              array (
                'name' => 'plantilla',
                'label' => 'LBL_PLANTILLA',
              ),
            ),   
            
            4 => 
            array (
              0 => 
              array (
                    'name' => 'herramienta_envio',
                'label' => 'LBL_HERRAMIENTA_ENVIO',
              ),
              1 => 
              array (

              ),
            ),                                            
          ),                     
          
          'LBL_DETAIL_VIEW_ESTADISTICAS' =>          
          array (
          
            0 => 
            array (
              0 => 
              array (               
                'label' => 'LBL_GEST',
              ),
              1 => 
              array (
                'label' => 'LBL_GEST_ESTADO',
              ),
            ),
          
            1 => 
            array (
              0 => 
              array (
                'name' => 'total_gestiones',
                'label' => 'LBL_TOTAL_GEST',
              ),
              1 => 
              array (
                'name' => 'gestiones_encurso',
                'label' => 'LBL_GEST_EN_CURSO',
              ),
            ), 
            
            2 => 
            array (
              0 => 
              array (
                'name' => 'total_gestiones_ultimo_mes',
                'label' => 'LBL_TOTAL_GEST_ULT_MES',
              ),
              1 => 
              array (
                'name' => 'gestiones_paradas',
                'label' => 'LBL_GEST_PARADAS',
              ),
            ),
            
            3 => 
            array (
              0 => 
              array (
                'name' => 'total_gestiones_ultima_cont',
                'label' => 'LBL_TOTAL_GEST_ULT_CONT',
              ),
              1 => 
              array (
                'name' => 'gestiones_descartadas',
                'label' => 'LBL_GEST_DESCARTADAS',
              ),
            ),
            
            4 => 
            array (
              0 => 
              array (
                'name' => 'gestiones_existentes',
                'label' => 'LBL_GEST_EXISTENTES',
              ),
              1 => 
              array (
                'name' => 'gestiones_descartadas_nosector',
                'label' => 'LBL_GEST_DESCARTADAS_NOSECTOR',
              ),
            ),
            
            5 => 
            array (
              0 => 
              array (
                'name' => 'gestiones_existentes_portal',
                'label' => 'LBL_GEST_EXISTENTES_PORTAL',
              ),
              1 => 
              array (
                'name' => 'gestiones_descartadas_nocadena',
                'label' => 'LBL_GEST_DESCARTADAS_NOCADENA',
              ),
            ),
            
            6 => 
            array (
              0 => 
              array (
                  'label' => 'LBL_SOLICITUDES_RATING',
              ),
              1 => 
              array (
                
              ),
            ),
            
            9 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_aplus',
                'label' => 'LBL_SOL_APLUS',
              ),
              1 => 
              array (
                
              ),
            ),
            
            10 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_a',
                'label' => 'LBL_SOL_A',
              ),
              1 => 
              array (
                
              ),
            ),
            
            11 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_b',
                'label' => 'LBL_SOL_B',
              ),
              1 => 
              array (
                
              ),
            ),
            
            12 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_c',
                'label' => 'LBL_SOL_C',
              ),
              1 => 
              array (
                
              ),
            ),
            
            13 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_t',
                'label' => 'LBL_SOL_T',
              ),
              1 => 
              array (
                
              ),
            ),
            
            14 => 
            array (
              0 => 
              array (
                'name' => 'solicitudes_no_rating',
                'label' => 'LBL_SOL_NO_RATING',
              ),
              1 => 
              array (
                
              ),
            ),
                 
          ),    
          
          'LBL_DETAIL_VIEW_ADMINISTRACION' =>          
          array (
          
            0 => 
            array (
              0 => 
              array (
                'name'=>'coste_accion',
                'label'=>'LBL_COSTE_ACCION',
              ),
              1 => 
              array (
             
              ),
            ),      
          ),                  
        ),     
      ),
    );
?>