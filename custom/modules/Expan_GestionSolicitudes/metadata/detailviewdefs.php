<?php

require_once("custom/modules/Expan_GestionSolicitudes/metadata/CreateCxButtonsHelper.php");

$module_name = 'Expan_GestionSolicitudes';

$gestion = new Expan_GestionSolicitudes();
$gestion->retrieve($focus->id);

$idFranquicia=$gestion->franquicia;

$franquicia = new Expan_Franquicia();
$franquicia->retrieve($gestion->franquicia);

$franquiaid=$franquicia->id;
$franquiciaName=$franquicia->name;

$createButtonsHelper = new CreateCxButtonsHelper($gestion, $franquicia);

if ($gestion->chk_gestionado_central==1){
  $textoGestCentral="<B>Gestionado por Central:</B>";
  $textoFGestCentral="<B>Fecha Gestionado por Central:</B>";
}else{
  $textoGestCentral="Gestionado por Central:";
  $textoFGestCentral="Fecha Gestionado por Central:";
}

if ($gestion->tieneApertura()) {
  $botonApertura = '{if $fields.id.value!=""} <input type="button" name="irApertura" id="irApertura" class="" style="color:#0000FF;"
                    onClick="irAperturas(\'{$fields.name.value}\');" value="Ir Aperturas">{/if}';
} else {
  $botonApertura = '{if $fields.id.value!=""} <input type="button" name="irApertura" id="irApertura" class=""  disabled=""
                    onClick="irAperturas(\'{$fields.name.value}\');" value="Ir Aperturas">{/if}';
}

$viewdefs [$module_name] =
  array(
    'DetailView' =>
      array(
        'templateMeta' =>
          array(

            'includes' => array(
              0 => array('file' => 'include/javascript/limpiarReunionDetail.js',),
              1 => array('file' => 'include/javascript/DetailViewGestionSolicitud.js',),
              2 => array('file' => 'include/javascript/EditGestionSolicitud.js',),
              3 => array('file' => 'include/javascript/popup_parent_helper.js',),
              4 => array('file' => 'cache/include/javascript/sugar_grp_jsolait.js',),
              5 => array('file' => 'modules/Documents/documents.js',),
              6 => array('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js',),
              7 => array('file' => 'include/javascript/include.js',),
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

            'form' =>
              array(
                'buttons' =>
                  array(
                    0 => 'EDIT',
                    1 => 'DELETE',
                    2 =>
                      array(
                        'customCode' => $botonApertura,
                      ),
                    3 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""} <input type="button" style="color:#FF0000;" name="irsol" id="irfran" class="" 
                                            onClick="irFranquicia(\'{$fields.franquicia.value}\');" value="Ir Franquicia">{/if}',
                      ),

                    4 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""} <input title="Abrir en otra pantalla la solicitud de la que depende la gestion actual" style="color:#00BC9F;"  type="button" name="irsol" id="irsol" class="" 
                                            onClick="irSolicitud(\'{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}\');" value="Editar Candidato">{/if}',
                      ),
                    5 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}<BR> <BR>' . $createButtonsHelper->createCxButton("C1") . '{/if}',
                      ),
                    6 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C2") . '{/if}',
                      ),
                    7 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C3") . '{/if}',
                      ),
                    8 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C4") . '{/if}',
                      ),
                    9 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C1.1") . '{/if}',
                      ),
                    10 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C1.2") . '{/if}',
                      ),
                    11 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C1.3") . '{/if}',
                      ),
                    12 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C1.4") . '{/if}',
                      ),
                    13 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""}' . $createButtonsHelper->createCxButton("C1.5") . '{/if}',
                      ),
                    14 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""} <BR><BR><input type="button" name="save" id="fichaFranquicia" 
                onClick="envioCorreoInterlocutor(\'{$fields.id.value}\',\'franq\');" value="Envio Ficha Franquicia">{/if}',
                      ),
                    15 =>
                      array(
                        'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="fichaConsultor" 
                onClick="envioCorreoInterlocutor(\'{$fields.id.value}\',\'consultor\');" value="Envio Ficha Consultor"><BR><BR>{/if}',
                      ),
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
                'LBL_EDITVIEW_OBSERVACIONES' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_IIT' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_PRECONTRATO' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_PLAN_FINANCIERO' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_CONTRATO' =>
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
                        'name' => 'expan_solicitud_expan_gestionsolicitudes_1_name',
                        'label' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE',
                      ),
                    1 =>
                      array(
                        'name' => 'franquicia',
                        'customCode' => '<a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Franquicia%26action%3DDetailView%26record%3D' . $franquiaid . '"><span id="expan_franquicia" class="sugar_field" data-id-value="' . $franquiaid . '">' . $franquiciaName . '</span></a>',
                        'label' => 'LBL_FRANQUICIA',
                      ),

                  ),
                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'prioridad',
                        'label' => 'LBL_PRIORIDAD',
                      ),
                    1 =>
                      array(
                        'name' => 'rating',
                        'label' => 'LBL_RATING',
                      ),

                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_auto',
                        'label' => 'Envios automatizados',
                      ),

                    1 =>
                      array(
                        'name' => 'candidatura_avanzada',
                        'label' => 'LBL_CANDIDATURA_AVANZADA',
                      ),
                  ),
                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'oportunidad_inmediata',
                        'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
                      ),
                    1 =>
                      array(
                        'name' => 'date_entered',
                        'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
                        'label' => 'Fecha creacion',
                      ),
                  ),
                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_posible_colabora',
                        'label' => 'Posible Colaboracion',
                      ),
                    1 =>
                      array(
                        'name' => 'candidatura_caliente',
                        'label' => 'Candidatura caliente',
                      ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(
                        'name' => 'estado_sol',
                        'studio' => 'visible',
                        'label' => 'Estado',
                      ),
                    1 =>
                      array(
                        'name' => 'f_posible_colabora',
                        'label' => 'Fecha Posible Colaboracion',
                      ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_gestionado_central',
                        'label' => $textoGestCentral,
                      ),
                    1 =>
                      array(
                        'name' => 'f_gestionado_central',
                        'label' => $textoFGestCentral,
                      ),
                  ),

                7 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_entrevista_previa',
                        'label' => 'LBL_ENTREVISTA_PREVIA',
                      ),
                    1 =>
                      array(
                        'name' => 'usuario_entrevista_previa',
                        'label' => 'LBL_USUARIO_ENTREVISTA_PREVIA',
                      ),
                  ),

                8 => array(
                  0 =>
                    array(
                      'name' => 'chk_envio_documentacion',
                      'label' => 'Envio documentacion comercial (C1)',
                    ),
                  1 =>
                    array(
                      'name' => 'envio_documentacion',
                      'label' => 'fecha de envío documentación comercial',
                    ),
                ),
                9 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_responde_C1',
                        'label' => 'LBL_RESPONDE_C1',
                      ),
                    1 =>
                      array(
                        'name' => 'f_responde_C1',
                        'label' => 'Fecha respuesta C1',
                      ),
                  ),
                10 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_sol_amp_info',
                        'label' => 'Solicitud ampliacion información (Pte resolver)',
                      ),
                    1 =>
                      array(
                        'name' => 'f_sol_amp_info',
                        'label' => 'Fecha Solicitud ampliacion información',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_autoriza_central',
                        'label' => 'Candidato autorizado por central',
                      ),
                    1 =>
                      array(
                        'name' => 'f_autoriza_central',
                        'label' => 'Fecha autorizacion por central',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_resolucion_dudas',
                        'label' => 'Resolucion de primeras dudas (Resueltas)',
                      ),
                    1 =>
                      array(
                        'name' => 'f_resolucion_dudas',
                        'label' => 'Fecha de Resolucion primeras de dudas',
                      ),

                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_recepcio_cuestionario',
                        'label' => 'LBL_RECEPCION_CUESTIONARIO',
                      ),
                    1 =>
                      array(
                        'name' => 'f_recepcion_cuestionario',
                        'label' => 'Fecha de recepción del cuestionario',
                      ),
                  ),

                14 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_informacion_adicional',
                        'label' => 'Envio información adicional (C2)',
                      ),
                    1 =>
                      array(
                        'name' => 'f_informacion_adicional',
                        'label' => 'Fecha envio información adicional',
                      ),
                  ),

                15 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_entrevista',
                        'label' => 'Entrevista',
                      ),
                    1 =>
                      array(
                        'name' => 'f_entrevista',
                        'label' => 'Fecha Entrevista',
                      ),
                  ),

                16 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_propuesta_zona',
                        'label' => 'LBL_ENVIO_PROP_ZONA',
                      ),
                    1 =>
                      array(
                        'name' => 'f_propuesta_zona',
                        'label' => 'LBL_F_ENVIO_PROP_ZONA',
                      ),
                  ),

                17 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_visitado_fran',
                        'label' => 'Visitado franquiciado/unidad propia',
                      ),
                    1 =>
                      array(
                        'name' => 'f_visitado_fran',
                        'label' => 'Fecha Visitado franquiciado',
                      ),
                  ),

                18 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_precontrato',
                        'label' => 'Envio borrador Precontrato (C3)',
                      ),
                    1 =>
                      array(
                        'name' => 'f_envio_precontrato',
                        'label' => 'Fecha envio borrador Precontrato',
                      ),
                  ),

                19 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_visita_local',
                        'label' => 'LBL_INFORMACION_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'f_visita_local',
                        'label' => 'Fecha Informacion de local',
                      ),
                  ),

                20 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_operacion_autorizada',
                        'label' => 'Operación autorizada',
                      ),
                    1 =>
                      array(
                        'name' => 'f_operacion_autorizada',
                        'label' => 'Fecha autorización de la operación',
                      ),
                  ),

                21 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_precontrato_personal',
                        'label' => 'LBL_ENVIO_PRECONTRATO_PERSONAL',
                      ),
                    1 =>
                      array(
                        'name' => 'f_envio_precontrato_personal',
                        'label' => 'LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL',
                      ),
                  ),

                22 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_precontrato_firmado',
                        'label' => 'Precontrato Firmado',
                      ),
                    1 =>
                      array(
                        'name' => 'f_precontrato_firmado',
                        'label' => 'Fecha firma precontrato',
                      ),
                  ),

                23 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_contrato',
                        'label' => 'Envío borrador Contrato (C4)',
                      ),
                    1 =>
                      array(
                        'name' => 'f_envio_contrato',
                        'label' => 'Fecha envío de contrato',
                      ),
                  ),

                24 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_aprobacion_local',
                        'label' => 'Aprobacion del local',
                      ),
                    1 =>
                      array(
                        'name' => 'f_aprobacion_local',
                        'label' => 'Fecha de aprobacion del local',
                      ),
                  ),

                25 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_plan_financiero_personal',
                        'label' => 'LBL_ENVIO_PLAN_FINANCIERO_PERSONAL',
                      ),
                    1 =>
                      array(
                        'name' => 'f_envio_plan_financiero_personal',
                        'label' => 'LBL_FECHA_ENVIO_PLAN_FINANCIERO_PERSONAL',
                      ),
                  ),

                26 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_visita_central',
                        'label' => 'Visita a la Central',
                      ),
                    1 =>
                      array(
                        'name' => 'f_visita_central',
                        'label' => 'Fecha visita a la Central',
                      ),
                  ),

                27 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_envio_contrato_personal',
                        'label' => 'LBL_ENVIO_CONTRATO_PERSONAL',
                      ),
                    1 =>
                      array(
                        'name' => 'f_envio_contrato_personal',
                        'label' => 'LBL_FECHA_ENVIO_CONTRATO_PERSONAL',
                      ),
                  ),

                28 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_contrato_firmado',
                        'label' => 'Contrato Firmado',
                      ),
                    1 =>
                      array(
                        'name' => 'f_contrato_firmado',
                        'label' => 'Fecha firma contrato',
                      ),
                  ),

                29 =>
                  array(
                    0 =>
                      array(
                        'name' => 'cuando_empezar',
                        'studio' => 'visible',
                        'label' => 'LBL_CUANDO_EMPEZAR',
                      ),
                    1 =>
                      array(
                        'name' => 'papel',
                        'studio' => 'visible',
                        'label' => 'LBL_PAPEL',
                      ),
                  ),

                30 =>
                  array(
                    0 =>
                      array(
                        'name' => 'inversion',
                        'studio' => 'visible',
                        'label' => 'LBL_INVERSION',
                      ),
                    1 =>
                      array(
                        'name' => 'recursos_propios',
                        'studio' => 'visible',
                        'label' => 'LBL_RECURSOS_PROPIOS',
                      ),
                  ),

                31 =>
                  array(
                    0 => array(
                      'name' => 'perfil_ideoneo',
                      'label' => 'LBL_PERFIL_IDONEO',
                    ),
                    1 =>
                      array(
                        'name' => 'motivo_parada',
                        'studio' => 'visible',
                        'label' => 'LBL_MOTIVO_PARADA',
                      ),
                  ),

                32 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'f_reactivacion_parado',
                        'studio' => 'visible',
                        'label' => 'LBL_F_REACTIVACION_PARADO',
                      ),
                  ),

                33 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'motivo_descarte',
                        'studio' => 'visible',
                        'label' => 'LBL_MOTIVO_DESCARTE',
                      ),
                  ),

                34 =>
                  array(
                    0 =>
                      array(
                        'name' => 'franq_apertura_desca',
                        'label' => 'LBL_FRANQ_APERTURA_DESCARTE',
                      ),
                    1 =>
                      array(
                        'name' => 'motivo_positivo',
                        'studio' => 'visible',
                        'label' => 'LBL_MOTIVO_POSITIVO',
                      ),
                  ),

                35 =>
                  array(
                    0 =>
                      array(
                        'name' => 'observaciones_informe',
                        'studio' => 'visible',
                        'label' => 'LBL_OBSERVACIONES_INFORME',
                      ),
                    1 =>
                      array(
                        'name' => 'observaciones_descarte',
                        'studio' => 'visible',
                        'label' => 'LBL_OBSERVACIONES_DESCARTE',
                      ),
                  ),

                36 =>
                  array(
                    0 =>
                      array(
                        'name' => 'tipo_origen',
                        'studio' => 'visible',
                        'label' => 'LBL_TIPO_ORIGEN',

                      ),
                    1 =>
                      array(
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
                      
                 {/php}',
                      ),
                  ),

                37 =>
                  array(
                    0 =>
                      array(
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

                38 =>
                  array(
                    0 =>
                      array(
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

                39 =>
                  array(
                    0 =>
                      array(
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

                40 =>
                  array(
                    0 =>
                      array(
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

                41 =>
                  array(
                    0 => 'assigned_user_name',
                    1 =>
                      array(
                        'name' => 'lnk_cuestionario',
                        'label' => 'LBL_CUESTIONARIO',
                        'customCode' => '{php}
                      $link=$this->_tpl_vars["bean"]->lnk_cuestionario;
                      $id=$this->_tpl_vars["bean"]->id;
                      $irClick = "";
                      if (strlen($link)!=0){
                          $irClick="Abrir Cuestionario";
                      }                      
                      echo "<a target=\"_blank\" onclick=\"eliminarAlertaCuestionario(\'".$id."\')\" href=\"".$link."\">".$irClick."</a>";                      
                 {/php}',
                      ),
                  ),

                42 =>
                  array(
                    0 => array(
                      'name' => 'modified_by_name',
                      'label' => 'LBL_MODIFICADO_POR',
                    ),
                    1 => array(
                      'name' => 'otras_preguntas_formulario',
                      'label' => 'LBL_OTRAS_PREGUNTAS_FORMULARIO',
                    ),
                  ),

              ),
            'LBL_EDITVIEW_OBSERVACIONES' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'preguntas_mn_t',
                        'studio' => 'visible',
                        'label' => 'LBL_PREGUNTAS_MN_T',
                      ),
                    1 =>
                      array(
                        'name' => 'preg_en_central',
                        'studio' => 'visible',
                        'label' => 'LBL_PREG_EN_CENTRAL',
                      ),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'objeciones_mn',
                        'studio' => 'visible',
                        'label' => 'LBL_OBJECIONES_MN',

                      ),
                    1 =>
                      array(
                        'name' => 'solicitudes_candidato',
                        'studio' => 'visible',
                        'label' => 'LBL_SOLICITUDES_CANDIDATO',

                      ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'informacion_proveedores',
                        'studio' => 'visible',
                        'label' => 'LBL_INFORMACION_PROVEEDORES',
                      ),
                    1 =>
                      array(
                        'name' => 'informacion_competencia',
                        'studio' => 'visible',
                        'label' => 'LBL_INFORMACION_COMPETENCIA',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'notas_argumentario',
                        'studio' => 'visible',
                        'label' => 'LBL_NOTAS_ARGUMENTARIO',
                      ),
                    1 =>
                      array(),
                  ),

                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'concesiones',
                        'studio' => 'visible',
                        'label' => 'LBL_CONCESIONES',
                      ),
                    1 =>
                      array(
                        'name' => 'mejoras',
                        'studio' => 'visible',
                        'label' => 'LBL_MEJORAS',
                      ),
                  ),
              ),

            // --- IIT --------------------------------------------

            'LBL_IIT' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_validado',
                        'label' => 'LBL_IIT_VALIDADO',
                      ),
                    1 =>
                      array(),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'label' => 'LBL_CANDIDATO',
                      ),
                    1 =>
                      array(
                        'label' => 'LBL_CONSULTOR',
                      ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_zona_implantacion',
                        'label' => 'LBL_IIT_ZONA_IMPLANTA',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_acuerdo_exclusividad',
                        'label' => 'LBL_IIT_ACUERDO_EXCLUSIVIDAD',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_aporta_local',
                        'label' => 'LBL_IIT_APORTA_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_acuerdo_economico',
                        'label' => 'LBL_IIT_ACUERDO_ECONOMICO',
                      ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_direccion_local',
                        'label' => 'LBL_IIT_DIRECCION_LOCAL',
                      ),
                    1 =>
                      array(
                        'label' => 'LBL_CRM',
                      ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_localidad_local',
                        'label' => 'LBL_IIT_LOCALIDAD_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_inversion_inicial_est',
                        'label' => 'LBL_IIT_INVER_INICIAL_EST',
                      ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_superficie_local',
                        'label' => 'LBL_IIT_SUPERFICIE_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_canon_entrada',
                        'label' => 'LBL_IIT_CANON_ENTRADA',
                      ),
                  ),

                7 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_superficie_escapa_local',
                        'label' => 'LBL_IIT_SUPERFICIE_ESCAPA_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_royalty_explota',
                        'label' => 'LBL_IIT_ROYALTY_EXPLOTA',
                      ),
                  ),

                8 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_superficie_almacen_local',
                        'label' => 'LBL_IIT_SUPERFICIE_ALMACEN_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_royalty_mkt',
                        'label' => 'LBL_IIT_ROYALTY_MKT',
                      ),
                  ),

                9 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_instalaciones_local',
                        'label' => 'LBL_IIT_INSTALACIONES_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_duracion_contrato',
                        'label' => 'LBL_IIT_DURACION_CONTRAT0',
                      ),
                  ),

                10 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_visitado_local',
                        'label' => 'LBL_IIT_VISITADO_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_year_renovado',
                        'label' => 'LBL_IIT_YEAR_RENOVADO',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_aprobado_local',
                        'label' => 'LBL_IIT_APROBADO_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'iit_max_estableci_zona',
                        'label' => 'LBL_IIT_MAX_ESTABLECI_ZONA',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_mod_neg_recomendado',
                        'label' => 'LBL_IIT_MOD_NEG_RECOMENDADO',
                      ),
                    1 =>
                      array(),
                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'iit_localidad_recomendado',
                        'label' => 'LBL_LOCALIDAD_RECOMENDADO',
                      ),
                    1 =>
                      array(),
                  ),

              ),

            // -- PRECONTRATO -------------------------------------------------------

            'lbl_precontrato' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'estado_precontrato',
                        'label' => 'LBL_ESTADO_PRECONTRATO',
                      ),
                    1 =>
                      array(),
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
                        'name' => 'pre_fir2_NIF',
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
                        'label' => 'LBL_UBICACION',
                      ),

                    1 =>
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
                        'name' => 'fecha_precontrato_minima',
                        'label' => 'LBL_FECHA_PRECONTRATO_MINIMA',
                      ),
                  ),

                9 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_apertura_pre',
                        'label' => 'LBL_PROVINCIA_APERTURA',
                      ),
                    1 =>
                      array(
                        'name' => 'f_precontrato_firma',
                        'label' => 'LBL_FECHA_PRECONTRATO_FIRMA',
                      ),
                  ),

                10 =>
                  array(
                    0 =>
                      array(
                        'name' => 'localidad_apertura_pre',
                        'label' => 'LBL_LOCALIDAD_APERTURA',
                      ),
                    1 =>
                      array(
                        'name' => 'periodo_validez',
                        'label' => 'LBL_PERIODO_VALIDEZ',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'direccion_local',
                        'label' => 'LBL_DIRECCION_LOCAL',

                      ),
                    1 =>
                      array(
                        'name' => 'modelo_negocio_precontrato',
                        'label' => 'LBL_MDN_PRECONTRATO',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'zona_exclusividad',
                        'label' => 'LBL_ZONA_EXCLUSIVIDAD',
                      ),
                    1 =>
                      array(
                        'name' => 'entrega_cuenta',
                        'label' => 'LBL_ENTREGA_CUENTA',
                      ),
                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'zona_reserva',
                        'label' => 'LBL_ZONA_RESERVA',
                      ),
                    1 =>
                      array(
                        'name' => 'canon_entrada',
                        'label' => 'LBL_CANON_ENTRADA',

                      ),
                  ),

                14 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array('name' => 'f_entrega_cuenta_pre',
                        'label' => 'LBL_F_ENTREGA_CUENTA_PRE',
                      ),
                  ),

                15 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array('name' => 'observacion_precontrato',
                        'label' => 'LBL_OBSERVACION_PRECONTRATO',

                      ),
                  ),
              ),

            'LBL_PLAN_FINANCIERO' =>
              array(

                -1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_validado',
                        'label' => 'LBL_PF_VALIDADO',
                      ),
                    1 =>
                      array(),
                  ),

                0 =>
                  array(
                    0 =>
                      array(
                        'label' => 'LBL_PF_LOCAL',
                      ),
                    1 =>
                      array(
                        'label' => 'LBL_PF_PERFIL_FRANQUICIADO',
                      ),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_superficie_local',
                        'label' => 'LBL_PF_SUPERFICIE_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'pf_tipo_franquiciado',
                        'label' => 'LBL_PF_TIPO_FRANQUICIADO',
                      ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_alquiler_local',
                        'label' => 'LBL_PF_ALQUILER_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'pf_trabajo_negocio',
                        'label' => 'LBL_PF_TRABAJO_NEGOCIO',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_estado_local',
                        'label' => 'LBL_PF_ESTADO_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'pf_forma_juridica',
                        'label' => 'LBL_PF_FORMA_JURIDICA',
                      ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'pf_historico_sociedad',
                        'label' => 'LBL_PF_HISTORICO_SOCIEDAD',
                      ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(
                        'label' => 'LBL_PF_CONDICIONES_APERTURA',
                      ),
                    1 =>
                      array(),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_canon_entrada',
                        'label' => 'LBL_PF_CANON_ENTRADA',
                      ),
                    1 =>
                      array(),
                  ),

                7 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_porcentaje_financia',
                        'label' => 'LBL_PF_PORCENTAJE_FINANCIA',
                      ),
                    1 =>
                      array(),
                  ),

                8 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_inversion',
                        'label' => 'LBL_PF_INVERSION',
                      ),
                    1 =>
                      array(),
                  ),

                9 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pf_f_prevista_inicio',
                        'label' => 'LBL_PF_F_PERVISTA_INICIO',
                      ),
                    1 =>
                      array(),
                  ),
              ),


            // CONTRATO

            'LBL_CONTRATO' =>
              array(

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
                        'name' => 'con_fir1_first_name',
                        'label' => 'LBL_FIRST_NAME',
                      ),
                    1 =>
                      array(
                        'name' => 'con_fir2_first_name',
                        'label' => 'LBL_FIRST_NAME',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'con_fir1_last_name',
                        'label' => 'LBL_LAST_NAME',
                      ),
                    1 =>
                      array(
                        'name' => 'con_fir2_last_name',
                        'label' => 'LBL_LAST_NAME',
                      ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'con_fir1_NIF',
                        'label' => 'LBL_NIF',
                      ),
                    1 =>
                      array(
                        'name' => 'con_fir2_last_name',
                        'label' => 'LBL_NIF',
                      ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(
                        'name' => 'con_fir1_vecino',
                        'label' => 'LBL_VECINO',
                      ),
                    1 =>
                      array(
                        'name' => 'con_fir2_vecino',
                        'label' => 'LBL_VECINO',
                      ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'con_fir1_domicilio',
                        'label' => 'LBL_DOMICILIO',
                      ),
                    1 =>
                      array(
                        'name' => 'con_fir2_domicilio',
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
                        'name' => 'sociedad1_razon_social',
                        'label' => 'LBL_RAZON_SOCIAL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_razon_social',
                        'label' => 'LBL_RAZON_SOCIAL',
                      ),
                  ),

                9 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_nacionalidad',
                        'label' => 'LBL_NACIONALIDAD',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_nacionalidad',
                        'label' => 'LBL_NACIONALIDAD',
                      ),
                  ),

                10 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_domicilio_social',
                        'label' => 'LBL_DOMICILIO_SOCIAL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_domicilio_social',
                        'label' => 'LBL_DOMICILIO_SOCIAL',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_cif',
                        'label' => 'LBL_CIF',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_cif',
                        'label' => 'LBL_CIF',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_f_ins_reg_mercantil',
                        'label' => 'LBL_FECHA_INS_REG_MERCANTIL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_f_ins_reg_mercantil',
                        'label' => 'LBL_FECHA_INS_REG_MERCANTIL',
                      ),
                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_lugar_ins_reg_mercantil',
                        'label' => 'LBL_LUGAR_INS_REG_MERCANTIL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_lugar_ins_reg_mercantil',
                        'label' => 'LBL_LUGAR_INS_REG_MERCANTIL',
                      ),
                  ),

                14 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_datos_ins_reg_mercantil',
                        'label' => 'LBL_DATOS_INS_REG_MERCANTIL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_datos_ins_reg_mercantil',
                        'label' => 'LBL_DATOS_INS_REG_MERCANTIL',
                      ),
                  ),

                15 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_representante_legal',
                        'label' => 'LBL_REPRESENTANTE_LEGAL',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_representante_legal',
                        'label' => 'LBL_REPRESENTANTE_LEGAL',
                      ),
                  ),

                16 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_domicilio_representante',
                        'label' => 'LBL_DOMICILIO_REPRESENTANTE',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad2_domicilio_representante',
                        'label' => 'LBL_DOMICILIO_REPRESENTANTE',
                      ),
                  ),

                17 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sociedad1_cargo_representante',
                        'label' => 'LBL_CARGO_REPRESENTANTE',
                      ),
                    1 =>
                      array(
                        'name' => 'sociedad1_cargo_representante',
                        'label' => 'LBL_CARGO_REPRESENTANTE',
                      ),
                  ),

                18 =>
                  array(
                    0 =>
                      array(
                        'label' => 'LBL_OBSERVACIONES_CANDIDATO',
                      ),
                    1 =>
                      array(
                        'label' => 'LBL_CONDICIONES_FRANQUICIA',
                      ),
                  ),

                19 =>
                  array(
                    0 =>
                      array(
                        'name' => 'f_contrato_firma',
                        'label' => 'LBL_FECHA_CONTRATO_FIRMA',
                      ),
                    1 =>
                      array(
                        'name' => 'modelo_franquicia',
                        'label' => 'LBL_MODELO_FRANQUICIA',
                      ),
                  ),

                20 =>
                  array(
                    0 =>
                      array(
                        'name' => 'franquicia_piloto',
                        'label' => 'LBL_FRANQUICIA_PILOTO',
                      ),
                    1 =>
                      array(
                        'name' => 'lineas_negocio',
                        'label' => 'LBL_LINEAS_NEGOCIO',
                      ),
                  ),

                21 =>
                  array(
                    0 =>
                      array(
                        'name' => 'contrato_condiciones_especiales',
                        'label' => 'LBL_CONDICIONES_ESPECIALES',
                      ),
                    1 =>
                      array(
                        'name' => 'canon_entrada_definitivo',
                        'label' => 'LBL_CANON_ENTRADA',
                      ),
                  ),

                22 =>
                  array(
                    0 =>
                      array(
                        'name' => 'local_titularidad',
                        'label' => 'LBL_LOCAL_TITULARIDAD',
                      ),
                    1 =>
                      array(
                        'name' => 'importe_abonado',
                        'label' => 'LBL_IMPORTE_ABONADO',
                      ),
                  ),

                23 =>
                  array(
                    0 =>
                      array(
                        'name' => 'local_Direccion',
                        'label' => 'LBL_DIRECCION',
                      ),
                    1 =>
                      array(
                        'name' => 'marca',
                        'label' => 'LBL_MARCA',
                      ),
                  ),

                24 =>
                  array(
                    0 =>
                      array(
                        'name' => 'local_municipio',
                        'label' => 'LBL_MUNICIPIO',
                      ),
                    1 =>
                      array(
                        'name' => 'estado_marca',
                        'label' => 'LBL_ESTADO_MARCA',
                      ),
                  ),

                25 =>
                  array(
                    0 =>
                      array(
                        'name' => 'f_apertura',
                        'label' => 'LBL_FECHA_APERTURA',
                      ),
                    1 =>
                      array(
                        'name' => 'propietario_marca',
                        'label' => 'LBL_PROPIETARIO_MARCA',
                      ),
                  ),

                26 =>
                  array(
                    0 =>
                      array(
                        'name' => 'zona_exlusividad',
                        'label' => 'LBL_ZONA_EXCLUSIVIDAD',
                      ),
                    1 =>
                      array(
                        'name' => 'codigo_marca',
                        'label' => 'LBL_CODIGO_MARCA',
                      ),
                  ),

                27 =>
                  array(
                    0 =>
                      array(
                        'name' => 'entidad_financiera',
                        'label' => 'LBL_ENTIDAD_FINANCIERA',
                      ),
                    1 =>
                      array(
                        'name' => 'duracion_contrato',
                        'label' => 'LBL_DURACION_CONTRATO',
                      ),
                  ),

                28 =>
                  array(
                    0 =>
                      array(
                        'name' => 'n_cuenta',
                        'label' => 'LBL_CUENTA',
                      ),
                    1 =>
                      array(
                        'name' => 'pago_en_cuenta',
                        'label' => 'LBL_PAGO_EN_CUENTA',
                      ),
                  ),

                29 =>
                  array(
                    0 =>
                      array(
                        'name' => 'lugar_formacion_preferente',
                        'label' => 'LBL_LUGAR_FORMACION_PREFERENTE',
                      ),
                    1 =>
                      array(
                        'name' => 'cuenta_expande',
                        'label' => 'LBL_CUENTA_EXPANDE',
                      ),
                  ),

                30 =>
                  array(
                    0 =>
                      array(
                        'name' => 'entrega_cuenta_cont',
                        'label' => 'LBL_ENTREGA_CUENTA_CONT',

                      ),
                    1 =>
                      array(
                        'name' => 'entidad_fin_expande',
                        'label' => 'LBL_ENTIDAD_FIN_EXPANDE',
                      ),
                  ),

                31 =>
                  array(
                    0 =>
                      array(
                        'name' => 'f_entrega_cuenta_cont',
                        'label' => 'LBL_F_ENTREGA_CUENTA_CONT',
                      ),
                    1 =>
                      array(
                        'name' => 'cuenta_franquiciador',
                        'label' => 'LBL_CUENTA_FRANQUICIADOR',
                      ),
                  ),

                32 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'entidad_fin_franquiciador',
                        'label' => 'LBL_ENTIDAD_FIN_FRANQUICIADOR',
                      ),
                  ),

                33 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'inversion_inicial',
                        'label' => 'LBL_ENTIDAD_FIN_FRANQUICIADOR',
                      ),
                  ),

                34 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'royalty_explotacion',
                        'label' => 'LBL_ROYALTY_EXPLOTA',
                      ),
                  ),

                35 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'min_royalty',
                        'label' => 'LBL_MIN_ROYALTY',
                      ),
                  ),

                36 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'fondo_marketing',
                        'label' => 'LBL_FONDO_MARKETING',
                      ),
                  ),

                37 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'observacion_contrato',
                        'label' => 'LBL_OBSERVACION_CONTRATO',
                      ),
                  ),
              ),


          ),
      ),
  );
?>
