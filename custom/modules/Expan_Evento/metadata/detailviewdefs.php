<?php
$module_name = 'Expan_Evento';
global $current_user;

if  ($current_user->id=='875daf39-76a9-4eb7-2fbc-53c7fa8dec18' || 
    $current_user->id=='71f40543-2702-4095-9d30-536f529bd8b6' ||
    $current_user->id=='1'){
    $viewdefs [$module_name] = 
    array (
      'DetailView' => 
      array (
        'templateMeta' => 
        array (
            'includes' => array (
                0 =>array ('file' => 'include/javascript/EditEvento.js',),
                1=>array ('file' => 'include/javascript/include.js',),
            ),
          'form' => 
          array (
            'buttons' => 
            array (
              0 => 'EDIT',
              1 => 'DUPLICATE',
              2 => 'DELETE',
              3 => 
              array (
                'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                        onClick="envioCorreosEvento(\'{$fields.id.value}\');" value="Enviar Correos Evento">{/if}',
              ),
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
            'LBL_DETAIL_VIEW_ESTADISTICAS' =>
            array (
              'newTab' => true,
              'panelDefault' => 'expanded',
            ),
            'LBL_DETAIL_VIEW_ADMINISTRACION' =>
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
               
              ),
            ),
            
            2 => 
            array (
              0 => 
              array (
                 'name' => 'fecha_celebracion',
                'label' => 'LBL_FECHA_CELEBRACION',
              ),
              1 => 
              array (
                'name' => 'fecha_fin',
                'label' => 'LBL_FECHA_FIN',
              ),
            ),
            
            3 => 
            array (
              0 => 'description',
              1 => 
              array (
                'name' => 'tipo_evento',
                'label' => 'LBL_TIPO_EVENTO',
              ),
            ), 
            
            4 => 
            array (
              0 => 
              array (
                'name' => 'observaciones',
                'label' => 'LBL_OBSERVACIONES',
              ),
            ), 
          ),
          
          'LBL_DETAIL_VIEW_ESTADISTICAS' =>
          
          array (                  
          
            0 => 
            array (
              0 => 
              array (
                'name' => 'total_empresas_parti',
                'label' => 'LBL_TOTAL_EMPRESAS_PARTI',
              ),
              1 => 
              array (
                'name' => 'total_empresas_con_stand',
                'label' => 'LBL_TOTAL_EMPRESAS_CON_STAND',
              ),
            ),   
            
            1 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_compartido',
                'label' => 'LBL_TOTAL_EMPRESAS_COMPARTIDO',
              ),
            ),  
            
            2 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_corner',
                'label' => 'LBL_TOTAL_EMPRESAS_CORNER',
              ),
            ),
                 
            3 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_mesa_inde',
                'label' => 'LBL_TOTAL_EMPRESAS_MESA_INDE',
              ),
            ),
            
            4 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_mesa_compa',
                'label' => 'LBL_TOTAL_EMPRESAS_MESA_COMPA',
              ),
            ),
            
            5 => 
            array (
              0 => 
              array (
                'name' => 'total_gestiones',
                'label' => 'LBL_TOTAL_GESTIONES',
              ),
              1 => 
              array (
                'name' => 'total_gest_EN',
                'label' => 'LBL_TOTAL_GEST_EN',
              ),
            ),
            
            6 => 
            array (
              0 => 
              array (
                'name' => 'total_gest_fran_part',
                'label' => 'LBL_TOTAL_GEST_PART',
              ),
              1 => 
              array (
                'name' => 'total_gest_Cliente',
                'label' => 'LBL_TOTAL_GEST_CLIENTE',
              ),
            ),
            
            7 => 
            array (
              0 => 
              array (
                'name' => 'total_gest_fran_nopart',
                'label' => 'LBL_TOTAL_GEST_NOPART',
              ),
              1 => 
              array (
                'name' => 'total_gest_tablet',
                'label' => 'LBL_TOTAL_GEST_TABLET',
              ),
            ),
            
            8 => 
            array (
              0 => 
              array (
                'name' => 'total_solicitudes',
                'label' => 'LBL_TOTAL_SOLICITUDES',
              ),
              1 => 
              array (
               
              ),
            ),
            
            9 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_a_plus',
                'label' => 'LBL_SOL_RATING_ORIG_A_PLUS',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_a_plus',
                'label' => 'LBL_SOL_RATING_REAL_A_PLUS',
              ),
            ),
            
            10 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_a',
                'label' => 'LBL_SOL_RATING_ORIG_A',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_a',
                'label' => 'LBL_SOL_RATING_REAL_A',
              ),
            ),
            
            11 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_b',
                'label' => 'LBL_SOL_RATING_ORIG_B',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_b',
                'label' => 'LBL_SOL_RATING_REAL_B',
              ),
            ),
            
            12 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_c',
                'label' => 'LBL_SOL_RATING_ORIG_C',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_c',
                'label' => 'LBL_SOL_RATING_REAL_C',
              ),
            ),
            
            13 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_topo',
                'label' => 'LBL_SOL_RATING_ORIG_TOPO',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_topo',
                'label' => 'LBL_SOL_RATING_REAL_TOPO',
              ),
            ),
            
            14 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_norating',
                'label' => 'LBL_TOTAL_RATING_ORIG_NORATING',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_norating',
                'label' => 'LBL_TOTAL_RATING_REAL_NORATING',
              ),
            ),
            
            15 => 
            array (
              0 => 
              array (
                'name' => 'sol_unicas',
                'label' => 'LBL_SOL_UNICAS',
              ),
            ),
            
            16 => 
            array (
              0 => 
              array (
                'name' => 'empresas_ratio_sg',
                'label' => 'LBL_TOTAL_EMPRESAS_RATIO_SG',
              ),          
              1 => 
              array (
                'name' => 'ratio_medio_formato',
                'label' => 'LBL_RATIO_MEDIO_FORMATO',
              ),
            ),      
          ),
          
          'LBL_DETAIL_VIEW_ADMINISTRACION' =>
          
          array (
            
            0 => 
            array (
              0 => array (
                'name' => 'consultores',
                'label' => 'LBL_CONSULTORES',
              ),
              1 => array (
                'name' => 'num_rev',
                'label' => 'LBL_REVISTAS',
              ),
            ),
            
            1 => 
            array (
              0 => array (
                'name' => 'incidencias',
                'label' => 'LBL_INCIDENCIAS',
              ),
              1 => array (
                'name' => 'mejoras',
                'label' => 'LBL_MEJORAS',
              ),
            ),
            
            2 => 
            array (
              0 => 
              array (          
                'name' => 'positivos',
                'studio' => 'visible',
                'label' => 'LBL_POSITIVOS',
                'customCode' => '
              {php}
                  include "custom/modules/Expan_Evento/metadata/opEdicionEvento.php";
                  $idSector=$this->_tpl_vars["bean"]->id; 
                  $opEdicionEvento=new opEdicionEvento();
                  $opEdicionEvento->cargaPositivos($idSector);  
              {/php}',
                
              ),          
              1 => 
              array (
              
              ),
            ),                     
          ),         
        ),
      ),
    );
}else{
    $viewdefs [$module_name] = 
    array (
      'DetailView' => 
      array (
        'templateMeta' => 
        array (
            'includes' => array (
                0 =>array ('file' => 'include/javascript/EditEvento.js',),
                1=>array ('file' => 'include/javascript/include.js',),
            ),
          'form' => 
          array (
            'buttons' => 
            array (
              0 => 'EDIT',
              1 => 'DUPLICATE',
              2 => 'DELETE',
              3 => 
              array (
                'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                        onClick="envioCorreosEvento(\'{$fields.id.value}\');" value="Enviar Correos Evento">{/if}',
              ),
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
            'LBL_DETAIL_VIEW_ESTADISTICAS' =>
            array (
              'newTab' => true,
              'panelDefault' => 'expanded',
            ),
            'LBL_DETAIL_VIEW_ADMINISTRACION' =>
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
               
              ),
            ),
            
            2 => 
            array (
              0 => 
              array (
                 'name' => 'fecha_celebracion',
                'label' => 'LBL_FECHA_CELEBRACION',
              ),
              1 => 
              array (
                'name' => 'fecha_fin',
                'label' => 'LBL_FECHA_FIN',
              ),
            ),
            
            3 => 
            array (
              0 => 'description',
              1 => 
              array (
                'name' => 'tipo_evento',
                'label' => 'LBL_TIPO_EVENTO',
              ),
            ),        
          ),
          
          'LBL_DETAIL_VIEW_ESTADISTICAS' =>
          
          array (
          
            0 => 
            array (
              0 => 
              array (
                'name' => 'total_empresas_parti',
                'label' => 'LBL_TOTAL_EMPRESAS_PARTI',
              ),
              1 => 
              array (
                'name' => 'total_empresas_con_stand',
                'label' => 'LBL_TOTAL_EMPRESAS_CON_STAND',
              ),
            ),   
            
            1 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_compartido',
                'label' => 'LBL_TOTAL_EMPRESAS_COMPARTIDO',
              ),
            ),  
            
            2 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_corner',
                'label' => 'LBL_TOTAL_EMPRESAS_CORNER',
              ),
            ),
                 
            3 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_mesa_inde',
                'label' => 'LBL_TOTAL_EMPRESAS_MESA_INDE',
              ),
            ),
            
            4 => 
            array (
              0 => 
              array (          
              ),
              1 => 
              array (
                'name' => 'total_empresas_mesa_compa',
                'label' => 'LBL_TOTAL_EMPRESAS_MESA_COMPA',
              ),
            ),
            
            5 => 
            array (
              0 => 
              array (
                'name' => 'total_gestiones',
                'label' => 'LBL_TOTAL_GESTIONES',
              ),
              1 => 
              array (
                'name' => 'total_gest_EN',
                'label' => 'LBL_TOTAL_GEST_EN',
              ),
            ),
            
            6 => 
            array (
              0 => 
              array (
                'name' => 'total_gest_fran_part',
                'label' => 'LBL_TOTAL_GEST_PART',
              ),
              1 => 
              array (
                'name' => 'total_gest_Cliente',
                'label' => 'LBL_TOTAL_GEST_CLIENTE',
              ),
            ),
            
            7 => 
            array (
              0 => 
              array (
                'name' => 'total_gest_fran_nopart',
                'label' => 'LBL_TOTAL_GEST_NOPART',
              ),
              1 => 
              array (
                'name' => 'total_gest_tablet',
                'label' => 'LBL_TOTAL_GEST_TABLET',
              ),
            ),
            
            8 => 
            array (
              0 => 
              array (
                'name' => 'total_solicitudes',
                'label' => 'LBL_TOTAL_SOLICITUDES',
              ),
              1 => 
              array (
               
              ),
            ),
            
            9 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_a_plus',
                'label' => 'LBL_SOL_RATING_ORIG_A_PLUS',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_a_plus',
                'label' => 'LBL_SOL_RATING_REAL_A_PLUS',
              ),
            ),
            
            10 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_a',
                'label' => 'LBL_SOL_RATING_ORIG_A',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_a',
                'label' => 'LBL_SOL_RATING_REAL_A',
              ),
            ),
            
            11 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_b',
                'label' => 'LBL_SOL_RATING_ORIG_B',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_b',
                'label' => 'LBL_SOL_RATING_REAL_B',
              ),
            ),
            
            12 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_c',
                'label' => 'LBL_SOL_RATING_ORIG_C',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_c',
                'label' => 'LBL_SOL_RATING_REAL_C',
              ),
            ),
            
            13 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_topo',
                'label' => 'LBL_SOL_RATING_ORIG_TOPO',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_topo',
                'label' => 'LBL_SOL_RATING_REAL_TOPO',
              ),
            ),
            
            14 => 
            array (
              0 => 
              array (
                'name' => 'total_rating_orig_norating',
                'label' => 'LBL_TOTAL_RATING_ORIG_NORATING',
              ),
              1 => 
              array (
                'name' => 'total_rating_real_norating',
                'label' => 'LBL_TOTAL_RATING_REAL_NORATING',
              ),
            ),
            
            15 => 
            array (
              0 => 
              array (
                'name' => 'sol_unicas',
                'label' => 'LBL_SOL_UNICAS',
              ),
            ),
            
            16 => 
            array (
              0 => 
              array (
                'name' => 'empresas_ratio_sg',
                'label' => 'LBL_TOTAL_EMPRESAS_RATIO_SG',
              ),          
              1 => 
              array (
                'name' => 'ratio_medio_formato',
                'label' => 'LBL_RATIO_MEDIO_FORMATO',
              ),
            ),      
          ),                  
               
        ),
      ),
    );
}
?>
