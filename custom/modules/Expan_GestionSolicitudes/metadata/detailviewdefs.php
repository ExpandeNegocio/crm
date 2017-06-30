<?php
$module_name = 'Expan_GestionSolicitudes';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
      array(
      
      'includes' => array (
                        0 =>array ('file' => 'include/javascript/limpiarReunionDetail.js',),
                        1 =>array ('file' => 'include/javascript/EditGestionSolicitud.js',),
                        2 =>array ('file' => 'include/javascript/popup_parent_helper.js',),
                        3 =>array ('file' => 'cache/include/javascript/sugar_grp_jsolait.js',),
                        4 =>array ('file' => 'modules/Documents/documents.js',),
                        5 =>array ('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js',),
                        6 =>array ('file' => 'include/javascript/include.js',),
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
         
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DELETE',
          2 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="irsol" id="irsol" class="" 
                    onClick="irSolicitud(\'{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}\');" value="Editar Solicitud">{/if}',
          ),
         3=> 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1\',\'{$fields.id.value}\');" value="Reenviar C1">{/if}',
          ),
          4=> 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C2\',\'{$fields.id.value}\');" value="Reenviar C2">{/if}',
          ),
          5 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C3\',\'{$fields.id.value}\');" value="Reenviar C3">{/if}',
          ),
          6 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C4\',\'{$fields.id.value}\');" value="Reenviar C4">{/if}',
          ),
           7 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1.1\',\'{$fields.id.value}\');" value="Reenviar C1.1">{/if}',
          ),
          8 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1.2\',\'{$fields.id.value}\');" value="Reenviar C1.2">{/if}',
          ),
          9 => 
           array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1.3\',\'{$fields.id.value}\');" value="Reenviar C1.3">{/if}',
          ),
          10 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1.4\',\'{$fields.id.value}\');" value="Reenviar C1.4">{/if}',
          ),
          11 =>
          array(
             'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit"
                onClick="reenvioInfo(\'C1.5\',\'{$fields.id.value}\');" value="Reenviar C1.5">{/if}',
          ),
          12 =>
          array(
             'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit"
                onClick="envioCorreoInterlocutor(\'{$fields.id.value}\');" value="Correo interlocutor">{/if}',
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
          0 => 
          array (
            'name' => 'expan_solicitud_expan_gestionsolicitudes_1_name',
            'label' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE',
          ),
          1 => 
          array (
          
              'name' => 'date_entered',
              'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
              'label' => 'Fecha creacion',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
              'name' => 'prioridad',
              'label' => 'LBL_PRIORIDAD',
          ),        
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_auto',
            'label' => 'Envios automatizados',
          ),
          1 => 
          array (
            'name' => 'franquicia',
            'studio' => 'visible',
            'link' => true,
            'label' => 'LBL_FRANQUICIA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'oportunidad_inmediata',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
          ),
          1 => 
          array (
            'name' => 'candidatura_avanzada',
            'label' => 'LBL_CANDIDATURA_AVANZADA',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'estado_sol',
            'studio' => 'visible',
            'label' => 'Estado',
          ),
          1 => 
          array (
            'name' => 'candidatura_caliente',
            'label' => 'Candidatura caliente',
          ),
        ),
        5=> 
        array (
          0 => 
          array (
            'name' => 'chk_envio_documentacion',
            'label' => 'Envio de la documentacion (C1)',
          ),
          1 => 
          array (
            'name' => 'envio_documentacion',
            'label' => 'Envio de Documentación',
          ),
        ),
       6 => 
        array (
          0 => 
          array (
            'name' => 'chk_responde_C1',
            'label' => 'LBL_RESPONDE_C1',
          ),
          1 => 
          array (
            'name' => 'f_responde_C1',
            'label' => 'Fecha respuesta C1',
          ),
        ),
        7=>         
           array (
          0 => 
          array (
            'name' => 'chk_sol_amp_info',
            'label' => 'Solicitud ampliacion información (Llamamos nosotros)',
          ),
          1 => 
          array (
            'name' => 'f_sol_amp_info',
            'label' => 'Fecha Solicitud ampliacion información',
          ),
        ),
        
        8 =>         
        array (
          0 => 
          array (
            'name' => 'chk_resolucion_dudas',
            'label' => 'Resolucion de primeras dudas (Llaman ellos)',
          ),
          1 => 
          array (
            'name' => 'f_resolucion_dudas',
            'label' => 'Fecha de Resolucion primeras de dudas',
          ),
     
        ),
        
        9 => 
        array (
          0 => 
          array (
            'name' => 'chk_recepcio_cuestionario',
            'label' => 'LBL_RECEPCION_CUESTIONARIO',
          ),
          1 => 
          array (
            'name' => 'f_recepcion_cuestionario',
            'label' => 'Fecha de recepción del cuestionario',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'chk_informacion_adicional',
            'label' => 'Envio información adicional (C2)',
          ),
          1 => 
          array (
            'name' => 'f_informacion_adicional',
            'label' => 'Fecha envio información adicional',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'chk_entrevista',
            'label' => 'Entrevista',
          ),
          1 => 
          array (
            'name' => 'f_entrevista',
            'label' => 'Fecha Entrevista',
          ),
        ),
        
        12 => 
        array (
          0 => 
          array (
            'name' => 'chk_propuesta_zona',
            'label' => 'LBL_ENVIO_PROP_ZONA',
          ),
          1 => 
          array (
            'name' => 'f_propuesta_zona',
            'label' => 'LBL_F_ENVIO_PROP_ZONA',
          ),
        ),
        
       13 => 
        array (
          0 => 
          array (
            'name' => 'chk_visitado_fran',
            'label' => 'Visitado franquiciado/unidad propia',
          ),
          1 => 
          array (
            'name' => 'f_visitado_fran',
            'label' => 'Fecha Visitado franquiciado',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_precontrato',
            'label' => 'Envio borrador Precontrato (C3)',
          ),
          1 => 
          array (
            'name' => 'f_envio_precontrato',
            'label' => 'Fecha envio precontrato',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'chk_visita_local',
            'label' => 'LBL_INFORMACION_LOCAL',
          ),
          1 => 
          array (
            'name' => 'f_visita_local',
            'label' => 'Fecha Informacion de local',
          ),
        ),
        
        16 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_precontrato_personal',
            'label' => 'LBL_ENVIO_PRECONTRATO_PERSONAL',
          ),
          1 => 
          array (
            'name' => 'f_envio_precontrato_personal',
            'label' => 'LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL',
          ),
        ),
        
        17 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_plan_financiero_personal',
            'label' => 'LBL_ENVIO_PLAN_FINANCIERO_PERSONAL',
          ),
          1 => 
          array (
            'name' => 'f_envio_plan_financiero_personal',
            'label' => 'LBL_FECHA_ENVIO_PLAN_FINANCIERO_PERSONAL',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_contrato',
            'label' => 'Envío borrador Contrato (C4)',
          ),
          1 => 
          array (
            'name' => 'f_envio_contrato',
            'label' => 'Fecha envío de contrato',
          ),
        ),
        
        19 => 
        array (
          0 => 
          array (
            'name' => 'chk_visita_central',
            'label' => 'Visita a la Central',
          ),
          1 => 
          array (
            'name' => 'f_visita_central',
            'label' => 'Fecha visita a la Central',
          ),
        ),
        
        20 => 
        array (
          0 => 
          array (
            'name' => 'chk_posible_colabora',
            'label' => 'Posible Colaboracion',
          ),
          1 => 
          array (
            'name' => 'f_posible_colabora',
            'label' => 'Fecha Posible Colaboracion',
          ),
        ),
        
        21 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_contrato_personal',
            'label' => 'LBL_ENVIO_CONTRATO_PERSONAL',
          ),
          1 => 
          array (
            'name' => 'f_envio_contrato_personal',
            'label' => 'LBL_FECHA_ENVIO_CONTRATO_PERSONAL',
          ),
        ),
        
         22 => 
        array (
          0 => 
          array (
            'name' => 'cuando_empezar',
            'studio' => 'visible',
            'label' => 'LBL_CUANDO_EMPEZAR',
          ),
          1 => 
          array (
            'name' => 'papel',
            'studio' => 'visible',
            'label' => 'LBL_PAPEL',
          ),
        ),
        
        23 => 
        array (
          0 => 
          array (
            'name' => 'inversion',
            'studio' => 'visible',
            'label' => 'LBL_INVERSION',
          ),
          1 => 
          array (
            'name' => 'recursos_propios',
            'studio' => 'visible',
            'label' => 'LBL_RECURSOS_PROPIOS',
          ),
        ),
        
        24 => 
        array (
          0 => 
          array (

          ),    
          1 => 
          array (
            'name' => 'motivo_parada',
            'studio' => 'visible',
            'label' => 'LBL_MOTIVO_PARADA',   
          ),  
        ),
        
        25 => 
        array (
          0 => 
          array (
          ),    
          1 => 
          array (
            'name' => 'motivo_descarte',
            'studio' => 'visible',
            'label' => 'LBL_MOTIVO_DESCARTE',   
          ),  
        ),
 
        26 => 
        array (
          0 => 
          array (
          ),    
          1 => 
          array (
            'name' => 'motivo_positivo',
            'studio' => 'visible',
            'label' => 'LBL_MOTIVO_POSITIVO',   
          ),  
        ),       
       
        27 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_informe',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_INFORME',
          ),
          1 => 
          array (
            'name' => 'observaciones_descarte',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_DESCARTE',
          ),
        ),
                
        28 => 
        array (
          0 => 
          array (
            'name' => 'tipo_origen',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_ORIGEN',
            
          ),
            1 => 
            array (
                'name' => 'suborigen',
                'label' => 'LBL_SUBORIGEN',
                'customCode' => '{php}
                      if ($this->_tpl_vars["bean"]->tipo_origen==1){
                          echo $GLOBALS["app_list_strings"]["subor_expande_list"][$this->_tpl_vars["bean"]->subor_expande];
                      } else if ($this->_tpl_vars["bean"]->tipo_origen==2){
                          echo $GLOBALS["app_list_strings"]["portal_list"][$this->_tpl_vars["bean"]->portal];
                      } else if ($this->_tpl_vars["bean"]->tipo_origen==3){
                          echo $GLOBALS["app_list_strings"]["eventos_list"][$this->_tpl_vars["bean"]->expan_evento_id_c];
                      } else if ($this->_tpl_vars["bean"]->tipo_origen==4){
                          echo $GLOBALS["app_list_strings"]["subor_central_list"][$this->_tpl_vars["bean"]->subor_central];
                      } else if ($this->_tpl_vars["bean"]->tipo_origen==5){
                          echo $GLOBALS["app_list_strings"]["subor_medios_list"][$this->_tpl_vars["bean"]->subor_medios];
                      } else if ($this->_tpl_vars["bean"]->tipo_origen==6){
                          echo $GLOBALS["app_list_strings"]["subor_mailing_list"][$this->_tpl_vars["bean"]->subor_mailing];
                      }
                      
                 {/php}' ,
            ),
        ),
        
        29 => 
        array (
          0 => 
          array (
            'name' => 'tiponegocio1',
            'studio' => 'visible',
            'label' => '{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg1;                      
                 {/php}',
          ),
        ),
        
        30 => 
        array (        
          0 => 
          array (
            'name' => 'tiponegocio2',
            'studio' => 'visible',
            'label' => '{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg2;                      
                 {/php}',
          ),
        ),
        
        31 => 
        array (         
          0 => 
          array (
            'name' => 'tiponegocio3',
            'studio' => 'visible',
            'label' => '{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg3;                      
                 {/php}',
          ),
        ),
        
        32 => 
        array (         
          0 => 
          array (
            'name' => 'tiponegocio4',
            'studio' => 'visible',
            'label' => '{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg4;                      
                 {/php}',
          ),
        ),
        
        33 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'lnk_cuestionario',
            'label' => 'LBL_CUESTIONARIO',
           'customCode'=> '{php}
                      $link=$this->_tpl_vars["bean"]->lnk_cuestionario;
                      $id=$this->_tpl_vars["bean"]->id;
                      echo "<a target=\"_blank\" onclick=\"eliminarAlertaCuestionario(\'".$id."\')\" href=\"".$link."\">".$link."<//a>";                      
                 {/php}',
          ),          
        ),
        
        34 => 
        array (
          0 =>  array (
            'name' =>'modified_by_name',     
            'label' => 'LBL_MODIFICADO_POR',
          ),  
          1 =>  array (
            'name' =>'perfil_ideoneo',     
            'label' => 'LBL_PERFIL_IDONEO',
          ),        
        ),
        
      ),
    ),
  ),
);
?>
