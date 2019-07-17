<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
$module_name = 'Expan_Portales';

$viewdefs [$module_name] = 
    array (
      'EditView' => 
      array (
        'templateMeta' => 
        array (
            'includes' => array (
                0 =>array ('file' => 'include/javascript/EditViewPortal.js',),
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
            'LBL_EDIT_VIEW_FRANQUICIAS' =>
            array (
              'newTab' => true,
              'panelDefault' => 'expanded',
            ),
            'LBL_EDIT_VIEW_ESTADISTICAS' =>
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
                'name' => 'persona_contacto',
                'label' => 'LBL_PERSONA_CONTACTO',
              ),
            ),  
             
            1 => 
            array (
              0 => 
              array (
                'name' => 'telefono_contacto',
                'label' => 'LBL_TELEFONO_CONTACTO',
              ),
              1 => 
              array (
                'name' => 'correo_contacto',
                'label' => 'LBL_CORREO_CONTACTO',
              ),
            ),      
                           
          ),
          
          'LBL_EDIT_VIEW_FRANQUICIAS' =>          
          array (
          
            0 => 
            array (
              0 => 
              array (                              
              'customCode' => '                
                  {php}
                      $idportal=$this->_tpl_vars["bean"]->id;
                      include "custom/modules/Expan_Portales/metadata/opEdicionFranquicia.php";
                      $op=new opEdicionFranquicia();
                      $op->showInterfaz($idportal,"EditView");
                  {/php}',
                 
              ),    
              
              1=>
              array(
                'customCode' =>'
              {php}              
                  $idportal=$this->_tpl_vars["bean"]->id;                  
                  $op=new opEdicionFranquicia();
                  $year= date("Y");
                  $codigo=$op->listaFranquicias($idportal,$year);
                  echo $codigo;
              {/php}',
              ),         
            ),      
          ), 
          
          'LBL_EDIT_VIEW_ESTADISTICAS' =>          
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
                'name' => 'total_gestiones_ultima_cont',
                'label' => 'LBL_TOTAL_GEST_ULT_CONT',
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
                'name' => 'total_gestiones_ultimo_mes',
                'label' => 'LBL_TOTAL_GEST_ULT_MES',
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
            
            7 => 
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
            
            8 => 
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
            
            9 => 
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
            
            10 => 
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
            
            11 => 
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
            
            12 => 
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
        ),     
      ),
    );
?>