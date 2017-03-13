.<?php
$module_name = 'Expan_GestionSolicitudes';
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
      {sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
      {sugar_getscript file="include/javascript/EditGestionSolicitud.js"}
      {sugar_getscript file="modules/Documents/documents.js"}
      {sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
      {sugar_getscript file="include/javascript/include.js"}
      <script type="text/javascript"> onload=ocultarCheck();</script>',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => array (
                'customCode' => '<input type="submit" name="save" id="save" class="submit" 
                onClick="document.getElementById(\'candidatura_caliente\').disabled = false;
                this.form.return_action.value=\'DetailView\';                 
                this.form.action.value=\'Save\';
                return validarEdicion();" 
                value="Guardar">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="irsol" id="irsol" class="" 
                    onClick="irSolicitud(\'{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}\');" value="Ir Solicitud">{/if}',
          ),
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
        			onClick="reenvioInfo(\'C1\',\'{$fields.id.value}\');" value="Reenviar C1">{/if}',
          ),
          4 => 
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
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="reenvioInfo(\'C1.5\',\'{$fields.id.value}\');" value="Reenviar C1.5">{/if}',
          ),
          12 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="abrirHermanas(\'{$fields.id.value}\');" value="Abrir Hermanas">{/if}',
          ),
          13 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="window.open(\'index.php?module=Calls&action=EditView&expan_gestionsolicitudes_calls_1_name={$fields.name.value}&&expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida={$fields.id.value}\');" value="CrearLlamada">{/if}',
          ),
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
        -2=>
         array (
          0 => 
          array (
            'name' => 'date_entered',
            'label' => 'Fecha creacion',
          ),
          1 =>
          array(
            'name' => 'oportunidad_inmediata',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
          ),
        ),
        -1=> 
        array (
          0 => 
          array (
              'name' => 'prioridad',
              'label' => 'LBL_PRIORIDAD',
              'type' => 'readonly',
          ),        
        ),
      
        0 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_auto',
            'label' => 'Envios automatizados',
          ),
          1 =>
          array(
            'name' => 'candidatura_avanzada',
            'label' => 'LBL_CANDIDATURA_AVANZADA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'estado_sol',
            'studio' => 'visible',
            'label' => 'Estado',
            'displayParams' => 
            array (
              'javascript' => 'onchange="ocultarCheck();"',
            ),
          ),
          1 => 
          array (
            'name' => 'candidatura_caliente',
            'label' => 'Candidatura caliente',
          ),
        ),
        2 => 
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
        3 => 
        array (
          0 => 
          array (
            'name' => 'chk_responde_C1',
            'label' => 'Responde a C1',
          ),
          1 => 
          array (
            'name' => 'f_responde_C1',
            'label' => 'Fecha respuesta C1',
          ),
        ),
        4 => 
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
        
       5 => 
        array (
          0 => 
          array (
            'name' => 'chk_resolucion_dudas',
            'label' => 'Resolucion de primeras dudas (Llaman ellos)',
          ),
          1 => 
          array (
            'name' => 'f_resolucion_dudas',
            'label' => 'Fecha de Resolucion de primeras dudas',
          ),
        ),
        
        6 => 
        array (
          0 => 
          array (
            'name' => 'chk_recepcio_cuestionario',
            'label' => 'Recepción del cuestionario',
          ),
          1 => 
          array (
            'name' => 'f_recepcion_cuestionario',
            'label' => 'Fecha de recepción del cuestionario',
          ),
        ),
        7 => 
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
               
        8 => 
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
        
        9 => 
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
        
        10 => 
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
        11 => 
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
        12 => 
        array (
          0 => 
          array (
            'name' => 'chk_visita_local',
            'label' => 'Información de local',
          ),
          1 => 
          array (
            'name' => 'f_visita_local',
            'label' => 'Fecha Información de local',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'chk_envio_contrato',
            'label' => 'Envío borrador contrato (C4)',
          ),
          1 => 
          array (
            'name' => 'f_envio_contrato',
            'label' => 'Fecha envío de contrato',
          ),
        ),
        14 => 
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
        
        15 => 
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
        
        16 => 
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
        
        17 => 
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
        
        18 => 
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
        
        19 => 
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
        
        20 => 
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
        
        21 => 
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
        
        22 => 
        array (
          0 => 
          array (
            'name' => 'tipo_origen',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_ORIGEN',
            'displayParams' => 
            array (
              'javascript' => 'onchange="mostrarSuborigen();"',
            ),
          ),
        ),
        
        23 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
           'name' => 'portal',
            'studio' => 'visible',
            'label' => 'LBL_PORTAL',
          ),
        ),
        
        24 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
            'name' => 'subor_medios',
            'studio' => 'visible',
            'label' => 'LBL_SUBOR_MEDIOS',
          ),
        ),
        
        25 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
            'name' => 'subor_central',
            'studio' => 'visible',
            'label' => 'LBL_SUBOR_CENTRAL',
          ),
        ),
        
        26 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
            'name' => 'subor_expande',
            'studio' => 'visible',
            'label' => 'LBL_SUBOR_EXPANDE',
          ),
        ),
        
        27 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
            'name' => 'subor_mailing',
            'studio' => 'visible',
            'label' => 'LBL_SUBOR_MAILING',
          ),
        ),
        
        28 => 
        array (
          0 => 
          array (
            'name' => 'tiponegocio1',
            'studio' => 'visible',
            'label' => 'LBL_TIPONEG1',
          ),
        ),
        
        29 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg11',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG11',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg12',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG12',
          ),
        ),
        
        30=> 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg13',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG13',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg14',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG14',
          ),
        ),
        
       31=> 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg15',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG15',
          ),         
        ),        
        
        32 => 
        array (
          0 => 
          array (
            'name' => 'tiponegocio2',
            'studio' => 'visible',
            'label' => 'LBL_TIPONEG2',
          ),
        ),
        
        33 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg21',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG21',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg22',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG22',
          ),
        ),
        
        34=> 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg23',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG23',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg24',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG24',
          ),
        ),
        
       35 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg25',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG25',
          ),         
        ),        
        
        36 => 
        array (
          0 => 
          array (
            'name' => 'tiponegocio3',
            'studio' => 'visible',
            'label' => 'LBL_TIPONEG3',
          ),
        ),
        
        37 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg31',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG31',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg32',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG32',
          ),
        ),
        
        38 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg33',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG33',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg34',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG34',
          ),
        ),
        
       39 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg35',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG35',
          ),         
        ),   
              
        40 => 
        array (
          0 => 
          array (
            'name' => 'tiponegocio4',
            'studio' => 'visible',
            'label' => 'LBL_TIPONEG4',
          ),
        ),
        
        41 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg41',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG41',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg42',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG42',
          ),
        ),
        
        42 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg43',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG43',
          ),
          1 => 
          array (
            'name' => 'chkvalNeg44',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG44',
          ),
        ),
        
       43 => 
        array (
          0 => 
          array (
            'name' => 'chkvalNeg45',
            'studio' => 'visible',
            'label' => 'LBL_CHKVALNEG45',
          ),         
        ),        
        
        44 => 
        array (
          0 => 
          array (
          ),
          1 => 
          array (
            'name' => 'expan_evento_id_c',
            'studio' => 'visible',
            'label' => 'LBL_EVENTO',
          ),
        ),
        
        45 =>
        array (
           0 => 'assigned_user_name',
           
              1 => 
          array (
            'name' => 'lnk_cuestionario',
            'label' => 'LBL_CUESTIONARIO',
          ),      
        ),
        
        46 => 
        array (         
          0 => 
          array (
           'name' => 'temp_modneg1',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_modneg1" id="temp_modneg1" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg1;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
        ),
        
        47 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg11',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg11" id="temp_valNeg11" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg11;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg12',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg12" id="temp_valNeg12" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg12;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
        
        48 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg13',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg13" id="temp_valNeg13" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg13;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg14',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg14" id="temp_valNeg14" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg14;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
                
        49 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg15',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg15" id="temp_valNeg15" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg15;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),                  
        ),
        
        50 => 
        array (         
          0 => 
          array (
           'name' => 'temp_modneg2',
                'label' => 'Pruebas2',
                'customCode' => '<input class="date_input"  type="text" name="temp_modneg2" id="temp_modneg2" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->modNeg2;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ), 
         ),
         
        51 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg21',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg21" id="temp_valNeg21" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg21;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg22',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg22" id="temp_valNeg22" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg22;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
        
        52 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg23',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg23" id="temp_valNeg23" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg23;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg24',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg24" id="temp_valNeg24" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg24;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
                
        53 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg25',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg25" id="temp_valNeg25" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg25;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),                  
        ),
                  
        54 => 
        array (         
          0 => 
          array (
           'name' => 'temp_modneg3',
                'label' => 'Pruebas3',
                 'customCode' => '<input class="date_input"  type="text" name="temp_modneg3" id="temp_modneg3" value="{php}
                  $idfran=$this->_tpl_vars["bean"]->franquicia;
                  $Fran = new Expan_Franquicia();
                  $Fran -> retrieve($idfran);
                  echo $Fran->modNeg3;
                  
             {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ), 
         ),
         
        55 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg31',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg31" id="temp_valNeg31" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg31;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg32',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg32" id="temp_valNeg32" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg32;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
        
        56 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg33',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg33" id="temp_valNeg33" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg33;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg34',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg34" id="temp_valNeg34" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg34;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
                
        57 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg35',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg35" id="temp_valNeg35" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg35;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),                  
        ),
                  
        58 => 
        array (         
          0 => 
          array (
            'name' => 'temp_modneg4',
            'label' => 'Pruebas4',
            'customCode' => '<input class="date_input"  type="text" name="temp_modneg4" id="temp_modneg4" value="{php}
                  $idfran=$this->_tpl_vars["bean"]->franquicia;
                  $Fran = new Expan_Franquicia();
                  $Fran -> retrieve($idfran);
                  echo $Fran->modNeg4;
                  
             {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),    
         ),
         
        59 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg41',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg41" id="temp_valNeg41" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg41;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg42',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg42" id="temp_valNeg42" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg42;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
        
        60 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg43',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg43" id="temp_valNeg43" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg43;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),          
           1 => 
          array (
           'name' => 'temp_valNeg44',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg44" id="temp_valNeg44" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg44;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),  
        ),
                
        61 => 
        array (         
          0 => 
          array (
           'name' => 'temp_valNeg45',
                'label' => 'Pruebas',
                 'customCode' => '<input class="date_input"  type="text" name="temp_valNeg45" id="temp_valNeg45" value="{php}
                      $idfran=$this->_tpl_vars["bean"]->franquicia;
                      $Fran = new Expan_Franquicia();
                      $Fran -> retrieve($idfran);
                      echo $Fran->valNeg45;
                      
                 {/php}" title="" tabindex="0" size="11" maxlength="10">' ,
            ),                  
        ), 
         
        62 => 
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
