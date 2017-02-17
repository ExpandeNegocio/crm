<?php
global $current_user; 
$module_name = 'Expan_Solicitud';
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
      {sugar_getscript file="include/javascript/EditSolicitud.js"}
      {sugar_getscript file="modules/Documents/documents.js"}
      <script type="text/javascript"> onload=inicio();</script>',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" name="save" id="save" class="submit" onClick="this.form.return_action.value=\'DetailView\'; this.form.action.value=\'Save\';  return validarSubOrigen(\'EditView\');" value="Guardar Validado">',
          ),
          2 => 'CANCEL',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_contact_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'empresa',
            'label' => 'LBL_EMPRESA',
          ),
        ),
        1 => 
        array (
          0 => 'last_name',
          1 => array (
            'name' => 'phone_mobile',
            'displayParams' => array('field' => array(
            'onBlur' => 'controlTelefono(this,\'{$fields.id.value}\')')),
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'email1',
          ),   
          1 => array (
            'name' => 'phone_home',
            'comment' => 'Home phone number of the contact',
            'label' => 'LBL_HOME_PHONE',
          ),
        ),
         3 => 
        array (
          0 => array (
            'name' => 'skype',
            'comment' => 'Skype del contacto',
            'label' => 'LBL_SKYPE',
          ),         
          1 => 'phone_work',
          
        ),
        
        4 => 
        array (
          0 => 
          array (
            'name' => 'no_correos_c',
            'label' => 'LBL_NO_CORREOS',
          ),
          1 => 
          array ( 
            'name' => 'do_not_call',
            'comment' => 'An indicator of whether contact can be called',
            'label' => 'LBL_DO_NOT_CALL',
          ),
        ),
        
        5 => 
        array (
          0 => 
          array (
            'name' => 'pais_c',
            'studio' => 'visible',
            'label' => 'LBL_PAIS',
          ),
          1 => 
          array (
            'name' => 'fecha_primer_contacto',
            'label' => 'LBL_FECHA_PRIMER_CONTACTO',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
          'name' => 'provincia_apertura_1',
            'studio' => 'visible',
            'label' => 'LBL_PROVINCIA_APERTURA_1',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura_1',
            'label' => 'LBL_LOCALIDAD_APERTURA_1',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'provincia_apertura_2',
            'studio' => 'visible',
            'label' => 'LBL_PROVINCIA_APERTURA_2',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura_2',
            'label' => 'LBL_LOCALIDAD_APERTURA_2',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'provincia_apertura_3',
            'studio' => 'visible',
            'label' => 'LBL_PROVINCIA_APERTURA_3',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura_3',
            'label' => 'LBL_LOCALIDAD_APERTURA_3',
          ),
        ),
        9 => 
        array (
          0 => 
           array (          
            'name' => 'oportunidad_inmediata',
            'studio' => 'visible',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
            'displayParams' => array('readOnly' => true),
          ),
          1 => 
          array (
            'name' => 'candidatura_caliente',
            'label' => 'LBL_CANDIDATURA_CALIENTE',
            'displayParams' => array('readOnly' => true),
          ),
        ),
        
        10 => 
        array (
          0 => 
           array (          
            'name' => 'disp_contacto',
            'label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
          ),
          1 => 
          array (
            'name' => 'zona',
            'studio' => 'visible',
            'label' => 'LBL_ZONA',
          ),
        ),                    
        
        11 => 
        array (
          0 => 
         array (
            'name' => 'primary_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
          1 => (''
          ),          
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'contacto_secundario',
            'label' => 'LBL_CONTACTO_SECUNDARIO',
          ),
          1 => 
          array (
            'name' => 'correo_secundario',
            'label' => 'LBL_CORREO_SECUNDARIO',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
          ),
          1 => 
          array (
            'name' => 'observaciones_contacto_sec',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_CONTACTO_SEC',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'alt_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'alt',
              'copy' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'franquicias_secundarias',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
          ),
          1 => 
          array (
            'name' => 'sectores_de_interes',
            'studio' => 'visible',
            'label' => 'LBL_SECTORES_DE_INTERES',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'perfil_franquicia',
            'studio' => 'visible',
            'label' => 'LBL_PERFIL_FRANQUICIA',
          ),
          1 => 
          array (
            'name' => 'situacion_profesional',
            'studio' => 'visible',
            'label' => 'LBL_SITUACION_PROFESIONAL',
          ),
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'perfil_profesional',
            'label' => 'LBL_PERFIL_PROFESIONAL',
          ),
          1 => 
          array (
            'name' => 'cuando_empezar',
            'studio' => 'visible',
            'label' => 'LBL_CUANDO_EMPEZAR',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_solicitud',
            'label' => 'LBL_OBSERVACIONES_SOLICITUD',
          ),
        
        ),
     /*   4 => 
        array (
          0 => 
          array (
            'name' => 'experiencia_sector',
            'label' => 'LBL_EXPERIENCIA_SECTOR',
          ),
          1 => 
          array (
            'name' => 'desc_experiencia',
            'label' => 'DESC_EXPERIENCIA',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'negocio_antes',
            'label' => 'LBL_NEGOCIO_ANTES',
          ),
          1 => 
          array (
            'name' => 'negocio',
            'label' => 'LBL_NEGOCIO',
          ),
        ),*/
        6 => 
        array (
          0 => 
          array (
            'name' => 'capital',
            'studio' => 'visible',
            'label' => 'LBL_CAPITAL',
          ),
          1 => 
          array (
            'name' => 'capital_observaciones',
            'label' => 'LBL_CAPITAL_OBSERVACIONES',
          ),
        ),
        
        7 => 
        array (
          0 => 
          array (
            'name' => 'recursos_propios',
            'studio' => 'visible',
            'label' => 'LBL_RECURSOS_PROPIOS',
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'sectores_de_interes',
            'studio' => 'visible',
            'label' => 'LBL_SECTORES_DE_INTERES',
            'customCode' => '
          {php}
              include $_SERVER[\'DOCUMENT_ROOT\']."custom/modules/Expan_Solicitud/metadata/opEdicionSolicitud.php";
              $prueba=new opEdicionSolicitud();
              $prueba->cargaSectores();  
      
          {/php}',
          ),
          1 => 
          array (
            ''
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'franquicias_secundarias',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
            'customCode' => '
          {php}
              $prueba=new opEdicionSolicitud();
              $prueba->cargaFranquicias();      
          {/php}',
          ),
          1 => 
          array (
            'name' => 'franquicia_principal',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIA_PRINCIPAL',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'franquicias_contactadas',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIAS_CONTACTADAS',
          ),
          1 => 
          array ('name' => 'otras_franquicias',
            'label' => 'LBL_OTRAS_FRANQUICIAS',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'enviar_servicios_asesora',
            'label' => 'LBL_ENVIAR_SERVICIOS_ASESORA',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'tipo_origen',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_ORIGEN',
            'displayParams' => array('field' => array(
            'onChange' => 'cambioSeleccion()')),
          ),
          1 => 
          array (
            'name' => 'subor_expande',
            'studio' => 'visible',
            'label' => 'LBL_SUBOR_EXPANDE',
          ),
        ),
        13 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'portal',
            'studio' => 'visible',
            'label' => 'LBL_PORTAL',
          ),
        ),
        14 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'expan_evento_id_c',
            'label' => 'LBL_EVENTO',
          ),
        ),        
         15 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_central',
            'label' => 'LBL_SUBOR_CENTRAL',
          ),
        ),        
         16 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_medios',
            'label' => 'LBL_SUBOR_MEDIOS',
          ),
        ),
        17 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_mailing',
            'label' => 'LBL_SUBOR_MAILING',
          ),
        ),
        
        18 =>
        array (
          0 => array (
            'name' => 'rating',
            'studio' => 'visible',
            'label' => 'LBL_RATING',
          ),
          1 => array (         
            'name' => 'perfil_plurifranquiciado',
            'studio' => 'visible',
            'label' => 'LBL_PERFIL_PLURIFRANQUICIADO',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'dispone_local',
            'label' => 'LBL_DISPONE_LOCAL',
          ),
          1 => 
          array (
            'name' => 'negocio_anterior_local',
            'label' => 'LBL_NEGOCIO_ANTERIOR_LOCAL',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'direccion_local',
            'label' => 'LBL_DIRECCION_LOCAL',
          ),
          1 => 
          array (
            'name' => 'superficie_local',
            'label' => 'LBL_SUPERFICIE_LOCAL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'direccion_local2',
            'label' => 'LBL_DIRECCION_LOCAL2',
          ),
          1 => 
          array (
            'name' => 'superficie_local2',
            'label' => 'LBL_SUPERFICIE_LOCAL2',
          ),
        ),
         3 => 
        array (
          0 => 
          array (
            'name' => 'direccion_local3',
            'label' => 'LBL_DIRECCION_LOCAL3',
          ),
          1 => 
          array (
            'name' => 'superficie_local3',
            'label' => 'LBL_SUPERFICIE_LOCAL3',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'descripcion_local',
            'label' => 'LBL_DESCRIPCION_LOCAL',
          ),
        ),

      ),
    ),
  ),
);
?>
