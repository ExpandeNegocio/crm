<?php
$module_name = 'Expan_Solicitud';
$id = $_REQUEST["record"];
if ($id == "") {
  $id = $_POST["record"];
}
if ($id == "") {
  $id = $_GET["record"];
}
if ($id == "") {
  $id = $_SESSION["Expan_Solicitud_detailview_record"];
}

$solicitud = new Expan_Solicitud();
$solicitud->retrieve($id);

if ($solicitud->getFranquiciado() != "") {
  $cutomCodeBotFranqui = '<input title="Abrir Franquiciado asociado a esta solicitud"  type="button" name="openFranquiciado" id="openFranquiciado"  
                    onclick="abrirFranquiciado(\'' . $id . '\');" value="Abrir Franquiciado">';
}

$disponeLocal = $GLOBALS['app_list_strings']['lst_tipo_dispone_local'][$solicitud->dispone_local];

$viewdefs [$module_name] =
  array(
    'EditView' =>
      array(
        'templateMeta' =>
          array(
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
            'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
                              {sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
                              {sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
                              {sugar_getscript file="include/javascript/Expan_Solicitud/EditViewSolicitud.js"}
                              {sugar_getscript file="include/javascript/ExpandeNegocio/general.js"}                              
                              {sugar_getscript file="modules/Documents/documents.js"}
                              {sugar_getscript file="include/javascript/include.js"}
      <script type="text/javascript"> onload=inicio();</script>',
            'form' =>
              array(
                'buttons' =>
                  array(
                    0 =>
                      array(
                        'customCode' => '<input type="submit" name="save" id="save" class="submit" 
            onClick="        
            this.form.return_action.value=\'DetailView\'; 
            this.form.action.value=\'Save\';             
            var valido=validarSubOrigen(\'EditView\');
            if (valido!=false) controlRating(\'' . $id . '\');                        
            return valido;" value="Guardar">',
                      ),
                    2 => 'CANCEL',
                    3 =>
                      array(
                        'customCode' => $cutomCodeBotFranqui,
                      ),
                    4 =>
                      array(
                        'customCode' => '<input title="Mostrar informacion ampliada"  type="button" name="ampliarResumir" id="ampliarResumir"  
                    onclick="alternarVistaAmpli();" value="Informacion Reducida">',
                      ),
                  ),
              ),
            'useTabs' => true,
            'tabDefs' =>
              array(
                'LBL_CONTACT_INFORMATION' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
           /*     'LBL_EDITVIEW_PANEL1' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),*/
                'LBL_EDITVIEW_PANEL4' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_EDITVIEW_PANEL2' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
                'LBL_EDITVIEW_PANEL_TAG' =>
                  array(
                    'newTab' => true,
                    'panelDefault' => 'expanded',
                  ),
              ),
          ),
        'panels' =>
          array(
            'lbl_contact_information' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'tipo_origen',
                        'studio' => 'visible',
                        'label' => 'LBL_TIPO_ORIGEN',
                        'displayParams' => array('field' => array(
                          'onChange' => 'cambioSeleccion()')),
                      ),
                    1 =>
                      array(
                        'name' => 'subor_expande',
                        'studio' => 'visible',
                        'label' => 'LBL_SUBOR_EXPANDE',
                      ),
                  ),

                1 =>
                  array(
                    0 => '',
                    1 =>
                      array(
                        'name' => 'portal',
                        'studio' => 'visible',
                        'label' => 'LBL_PORTAL',
                      ),
                  ),

                2 =>
                  array(
                    0 => '',
                    1 =>
                      array(
                        'name' => 'expan_evento_id_c',
                        'label' => 'LBL_EVENTO',
                      ),
                  ),

                3 =>
                  array(
                    0 => '',
                    1 =>
                      array(
                        'name' => 'subor_central',
                        'label' => 'LBL_SUBOR_CENTRAL',
                      ),
                  ),

                4 =>
                  array(
                    0 => '',
                    1 =>
                      array(
                        'name' => 'subor_medios',
                        'label' => 'LBL_SUBOR_MEDIOS',
                      ),
                  ),

                5 =>
                  array(
                    0 => '',
                    1 =>
                      array(
                        'name' => 'subor_mailing',
                        'label' => 'LBL_SUBOR_MAILING',
                      ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'first_name',
                        'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
                      ),
                    1 =>
                      array(
                        'name' => 'empresa',
                        'label' => 'LBL_EMPRESA',
                      ),
                  ),

                7 =>
                  array(
                    0 => 'last_name',
                    1 => array(
                      'name' => 'phone_mobile',
                      'displayParams' => array('field' => array(
                        'onBlur' => 'controlTelefono(this,\'' . $id . '\')')),
                    ),
                  ),

                8 =>
                  array(
                    0 =>
                      array(
                        'name' => 'email1',
                      ),
                    1 => array(
                      'name' => 'phone_home',
                      'comment' => 'Home phone number of the contact',
                      'label' => 'LBL_HOME_PHONE',
                    ),
                  ),
                9 =>
                  array(
                    0 => array(
                      'name' => 'skype',
                      'comment' => 'Skype del contacto',
                      'label' => 'LBL_SKYPE',
                    ),
                    1 => 'phone_work',

                  ),
                10 =>
                  array(
                    0 => array(
                      'name' => 'linkedin',
                      'comment' => 'LinkedIn',
                      'label' => 'LBL_LINKEDIN',
                    ),
                    1 => array(),

                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'no_correos_c',
                        'label' => 'LBL_NO_CORREOS',
                      ),
                    1 =>
                      array(
                        'name' => 'do_not_call',
                        'comment' => 'An indicator of whether contact can be called',
                        'label' => 'LBL_DO_NOT_CALL',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'no_newsletter',
                        'label' => 'LBL_NEWSLETTER',
                      ),
                    1 =>
                      array(
                        'name' => 'disp_contacto',
                        'label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
                      ),
                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'master',
                        'studio' => 'visible',
                        'label' => 'LBL_MASTER_FRANQUICIA',
                      ),
                    1 =>
                      array(),
                  ),

                14 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pais_c',
                        'studio' => 'visible',
                        'label' => 'LBL_PAIS',
                      ),
                    1 =>
                      array(
                        'name' => 'fecha_primer_contacto',
                        'label' => 'LBL_FECHA_PRIMER_CONTACTO',
                      ),
                  ),

                15 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_residencia',
                        'studio' => 'visible',
                        'label' => 'LBL_PROVINCIA_RESIDENCIA',
                      ),
                    1 =>
                      array(
                        'name' => 'localidad_residencia',
                        'label' => 'LBL_LOCALIDAD_RESIDENCIA',
                      ),
                  ),

                16 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_apertura_1',
                        'studio' => 'visible',
                        'label' => 'LBL_PROVINCIA_APERTURA_1',
                      ),
                    1 =>
                      array(
                        'name' => 'localidad_apertura_1',
                        'label' => 'LBL_LOCALIDAD_APERTURA_1',
                      ),
                  ),

                17 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_apertura_2',
                        'studio' => 'visible',
                        'label' => 'LBL_PROVINCIA_APERTURA_2',
                      ),
                    1 =>
                      array(
                        'name' => 'localidad_apertura_2',
                        'label' => 'LBL_LOCALIDAD_APERTURA_2',
                      ),
                  ),

                18 =>
                  array(
                    0 =>
                      array(
                        'name' => 'provincia_apertura_3',
                        'studio' => 'visible',
                        'label' => 'LBL_PROVINCIA_APERTURA_3',
                      ),
                    1 =>
                      array(
                        'name' => 'localidad_apertura_3',
                        'label' => 'LBL_LOCALIDAD_APERTURA_3',
                      ),
                  ),

                19 =>
                  array(
                    0 =>
                      array(
                        'name' => 'observaciones_zona_apertura',
                        'label' => 'LBL_OBSERVACIONES_ZONA_APERTURA',
                      ),
                    1 =>
                      array(
                        'name' => 'zona',
                        'studio' => 'visible',
                        'label' => 'LBL_ZONA',
                      ),
                  ),

                20 =>
                  array(
                    0 =>
                      array(
                        'name' => 'pais_residencia',
                        'label' => 'LBL_PAIS_RESIDENCIA',
                      ),
                    1 =>
                      array(
                        'name' => 'provincia_residencia',
                        'label' => 'LBL_PROVINCIA_RESIDENCIA',
                      ),
                  ),

                21 =>
                  array(
                    0 =>
                      array(
                        'name' => 'oportunidad_inmediata',
                        'studio' => 'visible',
                        'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
                        'displayParams' => array('readOnly' => true),
                      ),
                    1 =>
                      array(
                        'name' => 'candidatura_caliente',
                        'label' => 'LBL_CANDIDATURA_CALIENTE',
                        'displayParams' => array('readOnly' => true),
                      ),
                  ),

                22 =>
                  array(
                    0 =>
                      array(
                        'name' => 'check_puertas_abiertas',
                        'label' => 'LBL_PUERTAS_ABIERTAS',
                      ),
                    1 =>
                      array(),
                  ),

                23 =>
                  array(
                    0 => array(
                      'name' => '',
                      'customCode' => '<hr size="10" align="left" style="color: #0056b2;" width="75%" />',
                    ),
                  ),

                24 =>
                  array(
                    0 =>
                      array(
                        'name' => 'contacto_secundario',
                        'label' => 'LBL_CONTACTO_SECUNDARIO',
                      ),
                    1 =>
                      array(
                        'name' => 'correo_secundario',
                        'label' => 'LBL_CORREO_SECUNDARIO',
                      ),
                  ),

                25 =>
                  array(
                    0 =>
                      array(
                        'name' => 'phone_other',
                        'comment' => 'Other phone number for the contact',
                        'label' => 'LBL_OTHER_PHONE',
                      ),
                  ),
              ),

            //------------------------------------------------------------------------------------------
            'lbl_editview_panel2' =>
              array(
                -3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'franquicias_secundarias',
                        'studio' => 'visible',
                        'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
                      ),
                    1 =>
                      array(
                        'name' => 'sectores_de_interes',
                        'studio' => 'visible',
                        'label' => 'LBL_SECTORES_DE_INTERES',
                      ),
                  ),

                -2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'chk_entrevista_previa_EN',
                        'studio' => 'visible',
                        'label' => 'LBL_ENTREVISTA_PREVIA_EN',
                      ),
                    1 =>
                      array(
                        'name' => 'chk_entrevista_previa_cliente',
                        'studio' => 'visible',
                        'label' => 'LBL_ENTREVISTA_PREVIA_CLIENTE',
                      ),
                  ),

                -1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'f_entrevista_previa_EN',
                        'studio' => 'visible',
                        'label' => 'LBL_FECHA_ENTREVISTA_PREVIA_EN',
                      ),
                    1 =>
                      array(
                        'name' => 'f_entrevista_previa_cliente',
                        'studio' => 'visible',
                        'label' => 'LBL_FECHA_ENTREVISTA_PREVIA_CLIENTE',
                      ),
                  ),

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'usuario_entrevista_previa_EN',
                        'studio' => 'visible',
                        'label' => 'LBL_USUARIO_ENTREVISTA_PREVIA_EN',
                      ),
                    1 =>
                      array(
                        'name' => 'usuario_entrevista_previa_cliente',
                        'studio' => 'visible',
                        'label' => 'LBL_USUARIO_ENTREVISTA_PREVIA_CLIENTE',
                      ),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'perfil_franquicia',
                        'studio' => 'visible',
                        'label' => 'LBL_PERFIL_FRANQUICIA',
                      ),
                    1 =>
                      array(
                        'name' => 'situacion_profesional',
                        'studio' => 'visible',
                        'label' => 'LBL_SITUACION_PROFESIONAL',
                      ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'perfil_profesional',
                        'label' => 'LBL_PERFIL_PROFESIONAL',
                      ),
                    1 =>
                      array(

                        'name' => 'historial_empresa',
                        'studio' => 'visible',
                        'label' => 'LBL_HISTORIAL_EMPRESA',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'sectores_historicos',
                        'label' => 'LBL_SECTORES_HISTORICOS',
                        'customCode' => '
            {php}
                include "custom/modules/Expan_Solicitud/metadata/opEdicionSolicitud.php";
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerSectorHisto($idSol);  
      
            {/php}
            <div id="sugerencia_sectores_hist" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencia_sectores_hist"></div>',
                      ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'empresa_temp',
                        'label' => 'LBL_EMPRESA_TEMP',
                      ),
                  ),

                5 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'franquicia_historicos',
                        'label' => 'LBL_FRANQUICIA_HISTORICOS',
                        'customCode' => '
            {php}                
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerFranHisto($idSol);        
            {/php}
            <div id="sugerencias_hist" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencias_hist"></div>',
                      ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'inicio_franq_hst',
                        'label' => 'LBL_FRANQUICIA_INICIO',
                      ),
                  ),

                7 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'fin_franq_hst',
                        'label' => 'LBL_FRANQUICIA_CIERRE',
                      ),
                  ),

                8 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'franquicia_satisfa',
                        'label' => 'LBL_FRANQUICIA_SATISFA',
                      ),
                  ),

                9 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'chk_empresa_provee',
                        'label' => 'LBL_EMPRESA_PROVEE',
                      ),
                  ),

                10 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'chk_empresa_cli_potencial',
                        'label' => 'LBL_EMPRESA_CLI_POTENCIAL',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'chk_empresa_competencia',
                        'label' => 'LBL_EMPRESA_COMPETENCIA',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(),
                    1 =>
                      array(
                        'name' => 'chk_empresa_alianza',
                        'label' => 'LBL_EMPRESA_ALIANZA',
                      ),
                  ),

                13 =>
                  array(
                    0 =>
                      array(
                        'name' => 'rrss',
                        'label' => 'LBL_RRSS',
                      ),
                    1 =>
                      array(
                        'name' => 'dispone_local',
                        'label' => 'LBL_DISPONE_LOCAL',
                      ),
                  ),

                14 =>
                  array(
                    0 =>
                      array(
                        'name' => 'observaciones_solicitud',
                        'label' => 'LBL_OBSERVACIONES_SOLICITUD',
                      ),
                    1 =>
                      array(
                        'name' => 'cuando_empezar',
                        'studio' => 'visible',
                        'label' => 'LBL_CUANDO_EMPEZAR',
                      ),
                  ),

                15 =>
                  array(
                    0 =>
                      array(
                        'name' => 'recursos_propios',
                        'label' => 'LBL_RECURSOS_PROPIOS',
                      ),
                    1 =>array(
                      'name' => 'capital',
                      'studio' => 'visible',
                      'label' => 'LBL_CAPITAL',
                    ),
                  ),

                16 =>
                  array(
                    0 =>
                      array(
                        'name' => 'sectores_de_interes',
                        'studio' => 'visible',
                        'label' => 'LBL_SECTORES_DE_INTERES',
                        'customCode' => '
          {php}              
              $prueba=new opEdicionSolicitud();
              $prueba->cargaSectores();  
      
          {/php}',
                      ),
                    1 =>
                      array(
                        'name' => 'franquicias_secundarias',
                        'studio' => 'visible',
                        'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
                        'customCode' => '
            {php}
              $prueba=new opEdicionSolicitud();
              $prueba->cargaFranquicias();      
            {/php}',
                      ),
                  ),

                17 =>
                  array(
                    0 =>
                      array(
                        'name' => 'otros_sectores',
                        'studio' => 'visible',
                        'label' => 'LBL_OTROS_SECTORES',
                      ),
                    1 =>
                      array(
                        'name' => 'franquicia_principal',
                        'studio' => 'visible',
                        'label' => 'LBL_FRANQUICIA_PRINCIPAL',
                      ),
                  ),

                18 =>
                  array(
                    0 =>
                      array(
                        'name' => 'franquicias_contactadas',
                        'studio' => 'visible',
                        'label' => 'LBL_FRANQUICIAS_CONTACTADAS',
                        'customCode' => '
            {php}
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerFranContactadas($idSol);  
      
            {/php}
          <div id="sugerencias" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencias"></div>        
               ',
                      ),
                    1 =>
                      array('name' => 'otras_franquicias',
                        'label' => 'LBL_OTRAS_FRANQUICIAS',
                        'customCode' => '
            {php}
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerFranNoContactadas($idSol);  
      
            {/php}
            <div id="sugerenciasO" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerenciasO"></div>        
               ',
                      ),
                  ),

                19 =>
                  array(
                    0 =>
                      array(
                        'name' => 'enviar_servicios_asesora',
                        'label' => 'LBL_ENVIAR_SERVICIOS_ASESORA',
                      ),
                  ),

                20 =>
                  array(
                    0 => array(
                      'name' => 'rating',
                      'studio' => 'visible',
                      'label' => 'LBL_RATING',
                    ),
                    1 => array(
                      'name' => 'perfil_plurifranquiciado',
                      'studio' => 'visible',
                      'label' => 'LBL_PERFIL_PLURIFRANQUICIADO',
                    ),
                  ),

                21 =>
                  array(
                    0 => array(),
                    1 => array(
                      'name' => 'delegado',
                      'studio' => 'visible',
                      'label' => 'LBL_DELEGADO',
                    ),
                  ),
              ),

            //---------------------------------------------------------------------------------------------------
    /*        'lbl_editview_panel1' =>
              array(
                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'dispone_local',
                        'label' => 'LBL_DISPONE_LOCAL',
                        'customCode' => $disponeLocal,

                      ),
                    1 =>
                      array(),
                  ),
                1 =>
                  array(
                    0 => array(
                      'label' => 'LBL_LOCAL1',
                    ),
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'direccion_local',
                        'label' => 'LBL_DIRECCION_LOCAL',
                      ),
                    1 =>
                      array(
                        'name' => 'superficie_local',
                        'label' => 'LBL_SUPERFICIE_LOCAL',
                      ),
                  ),
                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'ubicacion_local1',
                        'label' => 'LBL_UBICACION_LOCAL1',
                      ),
                    1 =>
                      array(
                        'name' => 'renta_estimada_1',
                        'label' => 'LBL_RENTA_ESTIMADA',
                      ),
                  ),

                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'descripcion_local',
                        'label' => 'LBL_DESCRIPCION_LOCAL',
                      ),
                    1 =>
                      array(),
                  ),

                5 =>
                  array(
                    0 => array(
                      'label' => 'LBL_LOCAL2',
                    ),
                  ),

                6 =>
                  array(
                    0 =>
                      array(
                        'name' => 'direccion_local2',
                        'label' => 'LBL_DIRECCION_LOCAL2',
                      ),
                    1 =>
                      array(
                        'name' => 'superficie_local2',
                        'label' => 'LBL_SUPERFICIE_LOCAL2',
                      ),
                  ),

                7 =>
                  array(
                    0 =>
                      array(
                        'name' => 'ubicacion_local2',
                        'label' => 'LBL_UBICACION_LOCAL2',
                      ),
                    1 =>
                      array(
                        'name' => 'renta_estimada_2',
                        'label' => 'LBL_RENTA_ESTIMADA',
                      ),
                  ),

                8 =>
                  array(
                    0 =>
                      array(
                        'name' => 'descripcion_local2',
                        'label' => 'LBL_DESCRIPCION_LOCAL',
                      ),
                    1 =>
                      array(),
                  ),

                9 =>
                  array(
                    0 => array(
                      'label' => 'LBL_LOCAL3',
                    ),
                  ),

                10 =>
                  array(
                    0 =>
                      array(
                        'name' => 'direccion_local3',
                        'label' => 'LBL_DIRECCION_LOCAL3',
                      ),
                    1 =>
                      array(
                        'name' => 'superficie_local3',
                        'label' => 'LBL_SUPERFICIE_LOCAL3',
                      ),
                  ),

                11 =>
                  array(
                    0 =>
                      array(
                        'name' => 'ubicacion_local3',
                        'label' => 'LBL_UBICACION_LOCAL3',
                      ),
                    1 =>
                      array(
                        'name' => 'renta_estimada_3',
                        'label' => 'LBL_RENTA_ESTIMADA',
                      ),
                  ),

                12 =>
                  array(
                    0 =>
                      array(
                        'name' => 'descripcion_local3',
                        'label' => 'LBL_DESCRIPCION_LOCAL',
                      ),
                    1 =>
                      array(),
                  ),
              ),*/
            // ------------------------------------------------------------------------------------------------
            'LBL_EDITVIEW_PANEL_TAG' =>
              array(

                0 =>
                  array(
                    0 =>
                      array(
                        'name' => 'habilidades',
                        'label' => 'LBL_HABILIDADES',
                      ),
                    1 =>
                      array(
                        'name' => 'situacion_personal',
                        'label' => 'LBL_SITUACION_PERSONAL',
                      ),
                  ),

                1 =>
                  array(
                    0 =>
                      array(
                        'name' => 'motivos_interes',
                        'label' => 'LBL_MOTIVOS_INTERES',
                      ),
                    1 => array()
                  ),

                2 =>
                  array(
                    0 =>
                      array(
                        'name' => 'tags_empresa',
                        'label' => 'LBL_TAG_EMPRESA',
                        'customCode' =>
                          '{php}
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerTagsEmpresa($idSol);  
      
            {/php}
            <div id="sugerencias_tag_emp" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencias_tag_emp"></div>',
                      ),
                  ),

                3 =>
                  array(
                    0 =>
                      array(
                        'name' => 'motivos_interes',
                        'label' => 'LBL_MOTIVOS_INTERES',
                        'customCode' => '
              {php}                
                  $opSol=new opEdicionSolicitud();
                  $idSol=$this-> _tpl_vars["bean"]-> id;
                  $opSol->cargaMotivos($idSol);            
              {/php}',

                      ),
                    1 =>
                      array(
                        'name' => 'habilidades',
                        'label' => 'LBL_HABILIDADES',
                        'customCode' => '
              {php}                
                  $opSol=new opEdicionSolicitud();
                  $idSol=$this-> _tpl_vars["bean"]-> id;
                  $opSol->cargaHabilidades($idSol);            
              {/php}',
                      ),
                  ),
                4 =>
                  array(
                    0 =>
                      array(
                        'name' => 'situacion_personal',
                        'label' => 'LBL_SITUACION_PERSONAL',
                        'customCode' => '
              {php}                
                  $opSol=new opEdicionSolicitud();
                  $idSol=$this-> _tpl_vars["bean"]-> id;
                  $opSol->cargaSituacionesPersonales($idSol);            
              {/php}',
                      ),

                    1 => array()
                  ),
              ),
          ),
      ),
  );
?>
