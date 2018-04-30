<?php
$module_name = 'Expan_Solicitud';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
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
      
      'includes' =>
      array (
        0 =>array ('file' => 'include/javascript/EditSolicitud.js',),
        1 =>array ('file' => 'include/javascript/ViewSolicitud.js',),
        2 =>array ('onload' => 'cargaAccionesSol();',),
       ),
      
      
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
      {sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
      {sugar_getscript file="include/javascript/EditSolicitud.js"}
      {sugar_getscript file="include/javascript/jquery.js"}
      {sugar_getscript file="modules/Documents/documents.js"}
      {sugar_getscript file="include/javascript/ViewSolicitud.js"}
      <script type="text/javascript"> onload=cargaAccionesSol();</script>',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          2 => 'DELETE',
          3 =>
          array(
             'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit"
                onClick="pasoAFranquiciado(\'{$fields.id.value}\');" value="Paso a franquiciado">{/if}',
          ), 
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
        'LBL_EDITVIEW_PANEL1' => 
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
        'LBL_EDITVIEW_PANEL_TAG' => 
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
            'comment' => 'First name of the contact',
            'label' => 'LBL_FIRST_NAME',
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
            'name' => 'no_newsletter',
            'label' => 'LBL_NEWSLETTER',        
          ),
          1 => 
          array ( 
            'name' => 'disp_contacto',
            'label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
          ),
        ),
              
        6 =>
        array(
            0 => 
            array(
                'name'=>'master',
                'studio' =>'visible',
                'label' =>'LBL_MASTER_FRANQUICIA',               
            ),
            1 => 
            array(
                'name'=> 'check_puertas_abiertas',
                'label'=> 'LBL_PUERTAS_ABIERTAS',
            ),
        ),
     
        7 => 
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
        
        8 => 
        array (
          0 => 
          array (
          'name' => 'provincia_residencia',
            'studio' => 'visible',
            'label' => 'LBL_PROVINCIA_RESIDENCIA',
          ),
          1 => 
          array (
            'name' => 'localidad_residencia',
            'label' => 'LBL_LOCALIDAD_RESIDENCIA',
          ),
        ),
        
        9 => 
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
        
        10 => 
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
        
        11 => 
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
        
        12 => 
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
        
        13 => 
        array (
          0 => 
           array (                     
          ),
          1 => 
          array (
            'name' => 'zona',
            'studio' => 'visible',
            'label' => 'LBL_ZONA',
          ),
        ),                    
        
        14 => 
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
        ),
        
        15 => array(
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
        
        16 =>
        array(
          0 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
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
            
      'lbl_editview_panel2' => 
      array (
        0 => 
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
        1 => 
        array (
          0 => 
          array (
            'name' => 'perfil_profesional',
            'label' => 'LBL_PERFIL_PROFESIONAL',
          ),
          1 => 
          array (
            'name' => 'historial_empresa',
            'studio' => 'visible',
            'label' => 'LBL_HISTORIAL_EMPRESA',
          ),          
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_solicitud',
            'label' => 'LBL_OBSERVACIONES_SOLICITUD',
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
        
        4 => 
        array (
          0 => 
          array (
            'name' => 'recursos_propios',
            'studio' => 'visible',
            'label' => 'LBL_RECURSOS_PROPIOS',
          ),
        ),        
        
        5 => 
        array (
          0 => 
          array (
            'name' => 'sectores_de_interes',
            'studio' => 'visible',
            'label' => 'LBL_SECTORES_DE_INTERES',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'franquicias_secundarias',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
          ),
          1 => 
          array (
            'name' => 'franquicia_principal',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIA_PRINCIPAL',
          ),
        ),
      
        7 => 
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
        8 => 
        array (
         0 => 
          array (
            'name' => 'enviar_servicios_asesora',
            'label' => 'LBL_ENVIAR_SERVICIOS_ASESORA',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'tipo_origen',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_ORIGEN',
          ),
          1 => 
          array (
             'name' => 'subor_expande',          
            'label' => 'LBL_SUBOR_EXPANDE',            
          ),
        ),        
        10=> 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'portal',
            'studio' => 'visible',
            'label' => 'LBL_PORTAL',
          ),
        ),
        11 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'expan_evento_id_c',
            'label' => 'LBL_EVENTO',
          ),
        ),        
        12 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_central',
            'label' => 'LBL_SUBOR_CENTRAL',
          ),
        ),        
        13 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_medios',
            'label' => 'LBL_SUBOR_MEDIOS',
          ),
        ),
        14 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'subor_mailing',
            'label' => 'LBL_SUBOR_MAILING',
          ),
        ),
        
         15 =>
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
      
      'LBL_EDITVIEW_PANEL_TAG' => 
      array (                  
      
        1 => 
        array (
          0 => 
          array (
            'name' => 'tags_empresa',
            'label' => 'LBL_TAG_EMPRESA',           
          ),
        ),
            
        2 => 
        array (
          0 => 
          array (
            'name' => 'motivos_interes',
            'label' => 'LBL_MOTIVOS_INTERES',          
          ),
          1 => 
          array (
            'name' => 'habilidades',
            'label' => 'LBL_HABILIDADES', 
          ),
        ),
                 
       3 => 
        array (
          0 => 
          array (
            'name' => 'situacion_personal',
            'label' => 'LBL_SITUACION_PERSONAL',      
          ), 
          1=> array()                  
        ),
      ),                  
    ),
  ),
);
?>
