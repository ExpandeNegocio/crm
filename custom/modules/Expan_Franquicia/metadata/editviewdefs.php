<?php
$module_name = 'Expan_Franquicia';
$_object_name = 'expan_franquicia';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
          'label' => '20',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '20',
          'field' => '30',
        ),
      ),
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
      {sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
      {sugar_getscript file="include/javascript/EditFranquicia.js"}
      {sugar_getscript file="include/javascript/jquery.js"}
      {sugar_getscript file="modules/Accounts/Account.js"}
      <script type="text/javascript"> onload=inicio();</script>',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_ENVIOS_AUTOMATIZADOS' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),        
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL_MOD_NEG' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_MEMORANDUM' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PERFIL_IDONEO' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PROVEEDORES' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_COMPETIDORES' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_MISTERY' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),   
      ),
    ),
     'panels' => 
    array (
    
    //-----------------------------------------------------------------------------------------------------------------------------
    
      //Datos de la franquicia
      'lbl_account_information' => 
      array (
      
        -2 =>
        array (
          
          0 => 
          array (          
             'name' => 'sector',
            'studio' => 'visible',
            'label' => 'LBL_SECTOR',
            
          ),
        ),

        -1 =>
          array(
            0 =>
              array(
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
              ),
            1 =>
              array(

              ),
          ),
                                      
        0 => 
        array (
          0 => 'name',
          1 => 
          array (          
             'name' => 'sector',
            'studio' => 'visible',
            'label' => 'LBL_SECTOR',
            'customCode' => '
          {php}
              include "custom/modules/Expan_Franquicia/metadata/opEdicionFranquicia.php";
              $prueba=new opEdicionFranquicia();
              $prueba->cargaSectores();  
          {/php}',
            
          ),
        ),
        1 => 
        array (          
          0 => 
          array (
            'name' => 'tipo_cuenta',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_CUENTA',
          ),
          1 =>
          array(
           'name' => 'chk_intermediacion_pasiva',
            'label' => 'LBL_TIPO_CUENTA',          
          ),
        ), 
        2 => 
        array (
          0 =>
          array (
            'name' => 'breve_descripcion',
            'label' => 'LBL_BREVE_DESCRIPCION',
          ),
          1 => 'description',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'fecha_creacion',
            'label' => 'LBL_FECHA_CREACION',
          ),
          1 => 
          array (
            'name' => 'inicio_expansion',
            'label' => 'LBL_INICIO_EXPANSION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'presencia_internacional',
            'studio' => 'visible',
            'label' => 'LBL_PRESENCIA_INTERNACIONAL',
          ),
          1 => 
          array (
            'name' => 'paises',
            'studio' => 'visible',
            'label' => 'LBL_PAISES',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'centros_nacionales_propios',
            'label' => 'LBL_CENTROS_NACIONALES_PROPIOS',
          ),
          1 => 
          array (
            'name' => 'centros_extranjeros_propios',
            'label' => 'LBL_CENTROS_EXTRANJEROS_PROPIOS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'centros_nacionales_franquicia',
            'label' => 'LBL_CENTROS_NACIONALES_FRANQUICIA',
          ),
          1 => 
          array (
            'name' => 'centros_extranjeros_franqui',
            'label' => 'LBL_CENTROS_EXTRANJEROS_FRANQUI',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'red_spain',
            'label' => 'LBL_RED_SPAIN',
          ),
          1 => 
          array (
            'name' => 'red_extrangera',
            'label' => 'LBL_RED_EXTRANGERA',
          ),
        ),
        8 =>
          array (
            0 =>
              array (
                'name' => 'num_aperuras_reg',
                'label' => 'LBL_NUM_APERURAS_REG',
                'type' => 'readonly',
              ),
            1 =>
              array (
              ),
          ),
        9 =>
        array (
          0 => 
          array (
            'name' => 'plantilla_central',
            'label' => 'LBL_PLANTILLA_CENTRAL',
          ),
          1 => 
          array (
            'name' => 'cifra_negocio_grupo',
            'label' => 'LBL_CIFRA_NEGOCIO_GRUPO',
          ),
        ),
        10 =>
        array (
          0 => 
          array (
            'name' => 'nifra',
            'label' => 'LBL_NIFRA',
          ),
          1 => 
          array (
            'name' => 'aef',
            'studio' => 'visible',
            'label' => 'LBL_AEF',
          ),
        ),
        11 =>
        array (
          0 => 
          array (
            'name' => 'sellos_calidad',
            'studio' => 'visible',
            'label' => 'LBL_SELLOS_CALIDAD',
          ),
          1 => 
          array (
            'name' => 'otro_sello_calidad',
            'label' => 'LBL_OTRO_SELLO_CALIDAD',
          ),
        ),
        12 =>
        array (
          0 => 
          array (
            'name' => 'sellos_calidad',
            'label' => 'LBL_SELLOS_CALIDAD',
          ),
          1 => 
          array (
            'name' => 'otro_sello_calidad',
            'label' => 'LBL_OTRO_SELLO_CALIDAD',
          ),
        ),
        
        13 =>
        array (
          0 => 
          array (
            'name' => 'otros_requisitos',
            'label' => 'LBL_OTROS_REQUISITOS',
          ),
          1 => 
          array (
            'name' => 'elementos_diferenciales',
            'label' => 'LBL_ELEMENTOS_DIFERENCIALES',
          ),
        ),
        14 =>
        array (
          0 => 
          array (
            'name' => 'dossier',
            'label' => 'LBL_DOSSIER',
          ),
          1 => 
          array (
            'name' => 'ayuda_financiera',
            'label' => 'LBL_AYUDA_FINANCIERA',
          ),
        ),
        15 =>
        array (
          0 => 
          array (
            'name' => 'localizacion_franq',
            'label' => 'LBL_LOCALIZACION_FRANQ',
          ),
          1 => 
          array (
            'name' => 'centros_cerrados_ult_year',
            'label' => 'LBL_CENTROS_CERRADOS_ULT_YEAR',
          ),
        ),
        16=>
        array(
            0=> array(
                
                'name'=>'prime',
                'studio' =>'visible',
                'label' =>'LBL_PRIME',
            
            ),
        ),
      ),
    
    //-----------------------------------------------------------------------------------------------------------------------------
     //Contacto
     'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'empresa',
            'label' => 'LBL_EMPRESA',
          ),
          1 => 'website',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'direccion_direccion',
            'label' => 'LBL_DIRECCION_DIRECCION',
          ),
          1 => 
          array (
            'name' => 'direccion_provincia',
            'studio' => 'visible',
            'label' => 'LBL_DIRECCION_PROVINCIA',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'direccion_localidad',
            'label' => 'LBL_DIRECCION_LOCALIDAD',
          ),
          1 => 
          array (
            'name' => 'direccion_pais',
            'studio' => 'visible',
            'label' => 'LBL_DIRECCION_PAIS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'direccion_codigo_postal',
            'label' => 'LBL_DIRECCION_CODIGO_POSTAL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'cargo_contacto_general',
            'studio' => 'visible',
            'label' => 'LBL_CARGO_CONTACTO_GENERAL',
          ),
          1 => 
          array (
            'name' => 'cargo_contacto_2',
            'studio' => 'visible',
            'label' => 'LBL_CARGO_CONTACTO_2',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'persona_contacto',
            'label' => 'LBL_PERSONA_CONTACTO',
          ),
          1 => 
          array (
            'name' => 'contacto_general_2',
            'label' => 'LBL_CONTACTO_GENERAL_2',
          ),
        ),
        6 => 
        array (
          0 => 'phone_office',
          1 => 
          array (
            'name' => 'telefono_contacto_2',
            'label' => 'LBL_TELEFONO_CONTACTO_2',
          ),
        ),
        7 => 
        array (
          0 => 'phone_alternate',
          1 => 
          array (
            'name' => 'telefono_alternativo_2',
            'label' => 'LBL_TELEFONO_ALTERNATIVO_2',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'movil_general',
            'label' => 'LBL_MOVIL_GENERAL',
          ),
          1 => 
          array (
            'name' => 'movil_general_2',
            'label' => 'LBL_MOVIL_GENERAL_2',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'correo_general',
            'label' => 'LBL_CORREO_GENERAL',
          ),
          1 => 
          array (
            'name' => 'correo_contacto_2',
            'label' => 'LBL_CORREO_CONTACTO_2',
          ),
        ),
      ),
      //-----------------------------------------------------------------------------------------------------------------------------
      //Gestion Interna
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'tipo_ficha',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_FICHA',
          ),
          1 => 
          array (
            'name' => 'zona',
            'studio' => 'visible',
            'label' => 'LBL_ZONA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'logotipo',
            'studio' => 'visible',
            'label' => 'LBL_LOGOTIPO',
          ),
          1 => 
          array (
            'name' => 'video',
            'label' => 'LBL_VIDEO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'exclusion_de_sector',
            'label' => 'LBL_EXCLUSION_DE_SECTOR',
          ),
          1 => 
          array (
            'name' => 'exclusion_de_subsector',
            'label' => 'LBL_EXCLUSION_DE_SUBSECTOR',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'estado_validacion',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO_VALIDACION',
          ),
          1 => 
          array (
           
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
          1 => 
          array (
            'name' => 'correo_envio',
            'label' => 'LBL_CORREO_ENVIO',
          ),
        ),
         5 => 
        array (
          0 => 
          array (
            'name' => 'director_consultoria',
            'studio' => 'visible',
            'label' => 'LBL_DIRECTOR_CONSULTORIA',
          ),
          1 =>  array (
            'name' => 'informe_urgente',
            'studio' => 'visible',
            'label' => 'LBL_INFORME_URGENTE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'filtro_solicitudes_c',
            'studio' => 'visible',
            'label' => 'LBL_FILTRO_SOLICITUDES',
          ),
          1 => 
          array ('name' => 'prioridad',
            'studio' => 'visible',
            'label' => 'LBL_PRIORIDAD_FRAN',
          ),
        ),
       7 => 
        array (
          0 => 
          array (
            'name' => 'config_correo',
            'studio' => 'visible',
            'label' => 'LBL_CONFIG_CORREO',
          ),      
        ),
               
        8 => 
        array (
          0 => array (
            'name' => 'llamar_todos',
            'studio' => 'visible',
            'label' => 'LBL_LLAMAR_TODOS',
          ),
          1 =>  array (
            'name' => 'chk_c15',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C15',
          ),
        ),    
        9 => 
        array (
          0 => array (
            'name' => 'parada_temp_envios',
            'studio' => 'visible',
            'label' => 'LBL_PARADA_TEMP_ENVIOS',
          ),          
        ),                    
        10 => 
        array (
          0 => array (
            'name' => 'cod_franquicia',
            'studio' => 'visible',
            'label' => 'LBL_COD_FRANQUICIA',
          ),
          1 =>  array (
            'name' => 'proy_ERM',
            'studio' => 'visible',
            'label' => 'LBL_PROY_ERM',
          ),
        ),  
        
        11 => 
        array (
          0 => array (
            'name' => 'correo_drive',
            'studio' => 'visible',
            'label' => 'LBL_CORREO_DRIVE',
          ),
          1 =>  array (            
          ),
        ),  
        
        12 => 
        array (
          0 => array (
            'name' => 'carpeta_drive',
            'studio' => 'visible',
            'label' => 'LBL_CARPETA_DRIVE',
          ),
          1 =>  array (  
            'name' => 'lnk_cuestionario',
            'studio' => 'visible',
            'label' => 'LBL_CUESTIONARIO',        
          ),
        ),                      
        
      ),
      
      //-----------------------------------------------------------------------------------------------------------------------------
      'LBL_ENVIOS_AUTOMATIZADOS'=>
      array(
      
        0 => 
        array (
          0 => 
          array (
            'name' => 'chk_c1',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C1',
          ),
          1 =>  array (
            'name' => 'chk_c11',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C11',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'chk_c2',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C2',
          ),
          1 =>  array (
            'name' => 'chk_c12',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C12',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'chk_c3',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C3',
          ),
          1 =>  array (
            'name' => 'chk_c13',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C13',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'chk_c4',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C4',
          ),
          1 =>  array (
            'name' => 'chk_c14',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C14',
          ),
        ),
        
        4 => 
        array (
          0 => 
          array (
            
          ),
          1 =>  array (
            'name' => 'chk_c15',
            'studio' => 'visible',
            'label' => 'LBL_CHK_C15',
          ),
        ),
      
        5 => 
        array (
          0 => 
          array (
            'name' => 'info_resaltar_C1',
            'studio' => 'visible',
            'label' => 'LBL_INFO_RESALTAR_C1',
          ),
          1 => 
          array (
            'name' => 'tipos_documentos_C1',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_DOCUMENTO_C1',
          ),
        ),
      
        6 => 
        array (
          0 => 
          array (
            'name' => 'info_resaltar_C2',
            'studio' => 'visible',
            'label' => 'LBL_INFO_RESALTAR_C2',
          ),
          1 => 
          array (
            'name' => 'tipos_documentos_C2',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_DOCUMENTO_C2',
          ),
        ),
        
        7 => 
        array (
          0 => 
          array (
            'name' => 'info_resaltar_C3',
            'studio' => 'visible',
            'label' => 'LBL_INFO_RESALTAR_C3',
          ),
          1 => 
          array (
            'name' => 'tipos_documentos_C3',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_DOCUMENTO_C3',
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'info_resaltar_C4',
            'studio' => 'visible',
            'label' => 'LBL_INFO_RESALTAR_C4',
          ),
          1 => 
          array (
            'name' => 'tipos_documentos_C4',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_DOCUMENTO_C4',
          ),
        ),
        
        9 => 
        array (
          0 => 
          array (
            'name' => 'Enlace_C1',
            'studio' => 'visible',
            'customCode' => '
            {php}            
               $idfran=$this->_tpl_vars["bean"]->id;
               $Fran = new Expan_Franquicia();
               $Fran -> retrieve($idfran);
               echo $Fran->getCLink("C1");     
            {/php}',
            'label' => 'LBL_ENLACE_C1',
          ),
          1 => 
           array (
            'name' => 'Enlace_C2',
            'studio' => 'visible',
            'customCode' => '
            {php}            
               $idfran=$this->_tpl_vars["bean"]->id;
               $Fran = new Expan_Franquicia();
               $Fran -> retrieve($idfran);
               echo $Fran->getCLink("C2");     
            {/php}',
            'label' => 'LBL_ENLACE_C2',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'Enlace_C3',
            'studio' => 'visible',
            'customCode' => '
            {php}            
               $idfran=$this->_tpl_vars["bean"]->id;
               $Fran = new Expan_Franquicia();
               $Fran -> retrieve($idfran);
               echo $Fran->getCLink("C3");     
            {/php}',
            'label' => 'LBL_ENLACE_C3',
          ),
          1 => 
           array (
            'name' => 'Enlace_C3',
            'studio' => 'visible',
            'customCode' => '
            {php}            
               $idfran=$this->_tpl_vars["bean"]->id;
               $Fran = new Expan_Franquicia();
               $Fran -> retrieve($idfran);
               echo $Fran->getCLink("C3");     
            {/php}',
            'label' => 'LBL_ENLACE_C3',
          ),
        ),
      
       11 => 
        array (
          0 => 
          array (
            'name' => 'Observaciones_imagen',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_IMAGEN_VIDEO',
          ), 
          
          1 => 
          array (
            'name' => 'reporte_alta_cliente',
            'studio' => 'visible',
            'label' => 'LBL_REPORTE_ALTA_CLIENTE',
          ),         
        ),
                              
      ),
            
      
      //-----------------------------------------------------------------------------------------------------------------------------
      'lbl_editview_panel_mod_neg'=>
      array(
      
        1 => 
        array (
          0 => array (
            'name' => 'modNeg1',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG1',
          ),
          1 => array (
            'name' => 'nomail_modNeg1',
            'studio' => 'visible',
            'label' => 'LBL_NOMAIL_MODNEG1',
          ),        
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'valNeg11',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG11',
          ),
          1 =>  array (
            'name' => 'valNeg12',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG12',
          ),
        ),
        
        3 => 
        array (
          0 => 
          array (
            'name' => 'valNeg13',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG13',
          ),
          1 =>  array (
            'name' => 'valNeg14',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG14',
          ),
        ),
        
        4 => 
        array (
          0 => 
          array (
            'name' => 'valNeg15',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG15',
          ),              
        ),      
        
        5 => 
        array (
          0 => 
          array (
            'name' => 'notext1',
            'studio' => 'visible',            
            'customCode' => '{php}echo "<hr>";{/php}'
          ),              
        ), 
     
        6 => 
        array (
          0 => array (
            'name' => 'modNeg2',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG2',
          ),
          1 => array (
            'name' => 'nomail_modNeg2',
            'studio' => 'visible',
            'label' => 'LBL_NOMAIL_MODNEG2',
          ),          
        ),      
        
        7 => 
        array (
          0 => 
          array (
            'name' => 'valNeg21',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG21',
          ),
          1 =>  array (
            'name' => 'valNeg22',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG22',
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'valNeg23',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG23',
          ),
          1 =>  array (
            'name' => 'valNeg24',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG24',
          ),
        ),
        
        9 => 
        array (
          0 => 
          array (
            'name' => 'valNeg25',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG25',
          ),              
        ),
        
        10 => 
        array (
          0 => 
          array (
            'name' => 'notext2',
            'studio' => 'visible',            
            'customCode' => '{php}echo "<hr>";{/php}'
          ),              
        ), 
          
          
        11 => 
        array (
          0 => array (
            'name' => 'modNeg3',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG3',
          ),  
          1 => array (
            'name' => 'nomail_modNeg3',
            'studio' => 'visible',
            'label' => 'LBL_NOMAIL_MODNEG3',
          ),        
        ),     
                
        12 => 
        array (
          0 => 
          array (
            'name' => 'valNeg31',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG31',
          ),
          1 =>  array (
            'name' => 'valNeg32',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG32',
          ),
        ),
        
        13 => 
        array (
          0 => 
          array (
            'name' => 'valNeg33',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG33',
          ),
          1 =>  array (
            'name' => 'valNeg34',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG34',
          ),
        ),
        
        14 => 
        array (
          0 => 
          array (
            'name' => 'valNeg35',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG35',
          ),              
        ),
        
        15 => 
        array (
          0 => 
          array (
            'name' => 'notext3',
            'studio' => 'visible',            
            'customCode' => '{php}echo "<hr>";{/php}'
          ),              
        ), 
                       
        16 => 
        array (
          0 => array (
            'name' => 'modNeg4',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG4',
          ),
          1 => array (
            'name' => 'nomail_modNeg4',
            'studio' => 'visible',
            'label' => 'LBL_NOMAIL_MODNEG4',
          ),         
        ),
        
        17 => 
        array (
          0 => 
          array (
            'name' => 'valNeg41',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG41',
          ),
          1 =>  array (
            'name' => 'valNeg42',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG32',
          ),
        ),
        
        18=> 
        array (
          0 => 
          array (
            'name' => 'valNeg43',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG43',
          ),
          1 =>  array (
            'name' => 'valNeg44',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG44',
          ),
        ),
        
        19 => 
        array (
          0 => 
          array (
            'name' => 'valNeg45',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG45',
          ),              
        ),                
     
      ),      
      //-----------------------------------------------------------------------------------------------------------------------------
      //Administracion
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'comment' => 'The street address used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'contacto_administracion',
            'label' => 'LBL_CONTACTO_ADMINISTRACION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_city',
            'comment' => 'The city used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_CITY',
          ),
          1 => 
          array (
            'name' => 'telefono_administracion',
            'label' => 'LBL_TELEFONO_ADMINISTRACION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_postalcode',
            'comment' => 'The postal code used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
          ),
          1 => 
          array (
            'name' => 'movil_administracion',
            'label' => 'LBL_MOVIL_ADMINISTRACION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_state',
            'comment' => 'The state used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'correo_administracion',
            'label' => 'LBL_CORREO_ADMINISTRACION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_country',
            'comment' => 'The country used for the billing address',
            'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
          ),
        ),
      ),
      //-----------------------------------------------------------------------------------------------------------------------------
      //Intermediacion
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fecha_acuerdo',
            'label' => 'LBL_FECHA_ACUERDO',
          ),
          1 => 
          array (
            'name' => 'fecha_activacion',
            'label' => 'LBL_FECHA_ACTIVACION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ficha_ampliada_anterior',
            'label' => 'LBL_FICHA_AMPLIADA_ANTERIOR',
          ),
          1 => 
          array (
            'name' => 'consultora',
            'studio' => 'visible',
            'label' => 'LBL_CONSULTORA',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'estado_fran',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO_FRAN',
          ),
          1 => 
          array (
            'name' => 'preseleccionadas',
            'studio' => 'visible',
            'label' => 'LBL_PRESELECCIONADAS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'homologacion',
            'studio' => 'visible',
            'label' => 'LBL_HOMOLOGACION',
          ),
          1 => 
          array (
            'name' => 'contacto_intermediacion',
            'label' => 'LBL_CONTACTO_INTERMEDIACION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'documentacion_pendiente',
            'studio' => 'visible',
            'label' => 'LBL_DOCUMENTACION_PENDIENTE',
          ),
          1 => 
          array (
            'name' => 'telefono_intermediacion',
            'label' => 'LBL_TELEFONO_INTERMEDIACION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'ejecutivo_homologacion',
            'studio' => 'visible',
            'label' => 'LBL_EJECUTIVO_HOMOLOGACION',
          ),
          1 => 
          array (
            'name' => 'movil_intermediacion',
            'label' => 'LBL_MOVIL_INTERMEDIACION',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'objeciones_foros_bbdd',
            'studio' => 'visible',
            'label' => 'LBL_OBJECIONES_FOROS_BBDD',
          ),
          1 => 
          array (
            'name' => 'correo_intermediacion',
            'label' => 'LBL_CORREO_INTERMEDIACION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_inter',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_INTER',
          ),
        ),
      ),
      
      
     //-----------------------------------------------------------------------------------------------------------------------------
      //Datos Economicos
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'derecho_entrada_min',
            'label' => 'LBL_DERECHO_ENTRADA_MIN',
          ),
          1 => 
          array (
            'name' => 'derecho_entrada_max',
            'label' => 'LBL_DERECHO_ENTRADA_MAX',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'royalty_expltacion',
            'label' => 'LBL_ROYALTY_EXPLTACION',
          ),
          1 => 
          array (
            'name' => 'royalty_publicitario',
            'label' => 'LBL_ROYALTY_PUBLICITARIO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'otros_royalties',
            'label' => 'LBL_OTROS_ROYALTIES',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'facturacion_year_unidad_fran_1',
            'label' => 'LBL_FACTURACION_YEAR_UNIDAD_FRAN_1',
          ),
          1 => 
          array (
            'name' => 'beneficio_neto_unidad_fran_1',
            'label' => 'LBL_BENEFICIO_NETO_UNIDAD_FRAN_1',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'facturacion_year_unidad_fran_2',
            'label' => 'LBL_FACTURACION_YEAR_UNIDAD_FRAN_2',
          ),
          1 => 
          array (
            'name' => 'beneficio_neto_unidad_fran_2',
            'label' => 'LBL_BENEFICIO_NETO_UNIDAD_FRAN_2',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'facturacion_year_unidad_fran_3',
            'label' => 'LBL_FACTURACION_YEAR_UNIDAD_FRAN_3',
          ),
          1 => 
          array (
            'name' => 'beneficio_neto_unidad_fran_3',
            'label' => 'LBL_BENEFICIO_NETO_UNIDAD_FRAN_3',
          ),
        ),
      ),
      //-----------------------------------------------------------------------------------------------------------------------------
      //Requisitos y condiciones
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'tipo_de_franquiciado',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_DE_FRANQUICIADO',
          ),
          1 => 
          array (
            'name' => 'necesario_titulacion',
            'studio' => 'visible',
            'label' => 'LBL_NECESARIO_TITULACION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'titulacion',
            'label' => 'LBL_TITULACION',
          ),
          1 => 
          array (
            'name' => 'condiciones_especiales',
            'studio' => 'visible',
            'label' => 'LBL_CONDICIONES_ESPECIALES',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'observaciones',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES',
          ),
          1 => 
          array (
            'name' => 'inversion_minima_necesaria',
            'label' => 'LBL_INVERSION_MINIMA_NECESARIA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'tipo_franquicia',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_FRANQUICIA',
          ),
          1 => 
          array (
            'name' => 'necesita_local',
            'studio' => 'visible',
            'label' => 'LBL_NECESITA_LOCAL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'superficie_local',
            'studio' => 'visible',
            'label' => 'LBL_SUPERFICIE_LOCAL',
          ),
          1 => 
          array (
            'name' => 'requisitos_local',
            'studio' => 'visible',
            'label' => 'LBL_REQUISITOS_LOCAL',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'entorno_ubicacion',
            'studio' => 'visible',
            'label' => 'LBL_ENTORNO_UBICACION',
          ),
          1 => 
          array (
            'name' => 'observaciones_ubicacion',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVACIONES_UBICACION',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'provincias_ubicar_negocio',
            'studio' => 'visible',
            'label' => 'LBL_PROVINCIAS_UBICAR_NEGOCIO',
          ),
          1 => 
          array (
            'name' => 'poblacion_minima',
            'studio' => 'visible',
            'label' => 'LBL_POBLACION_MINIMA',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'personal_minimo',
            'studio' => 'visible',
            'label' => 'LBL_PERSONAL_MINIMO',
          ),
          1 => 
          array (
            'name' => 'zona_exclisiva',
            'studio' => 'visible',
            'label' => 'LBL_ZONA_EXCLISIVA',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'vigencia_contrato',
            'studio' => 'visible',
            'label' => 'LBL_VIGENCIA_CONTRATO',
          ),
          1 => 
          array (
            'name' => 'reconvertir_negocio',
            'studio' => 'visible',
            'label' => 'LBL_RECONVERTIR_NEGOCIO',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'acuerdo_financiacion',
            'studio' => 'visible',
            'label' => 'LBL_ACUERDO_FINANCIACION',
          ),
        ),
      ),
      //-----------------------------------------------------------------------------------------------------------------------------
      'LBL_EDITVIEW_MEMORANDUM' => 
      array (
      
         0 => 
        array (
          0 => 
          array (            
            'label' => 'LBL_MEM_CONVOCATORIA',
          ),
          1 => 
          array (            
            'label' => 'LBL_MEM_TIMMING',
          ),
        ), 
      
      
        1 => 
        array (
          0 => 
          array (            
            'name' => 'mem_sug_orden_dia',
            'studio' => 'visible',
            'label' => 'LBL_ORDEN_DIA',
          ),
          1 => 
          array (
            'name' => 'mem_nov_timming',
            'studio' => 'visible',
            'label' => 'LBL_NOV_TIMMING',
          ),
        ), 
      
        2 => 
        array (
          0 => 
          array (            
            'name' => 'mem_doc_reunion',
            'studio' => 'visible',
            'label' => 'LBL_DOC_REUNION',
          ),
          1 => 
          array (  
            'name' => 'mem_asun_sig_reunion',
            'studio' => 'visible',
            'label' => 'LBL_ASUN_SIG_REUNION',
          ),
        ), 
        
        3 => 
        array (
          0 => 
          array (            
            'label' => 'LBL_PROVEEDORES',
          ),
          1 => 
          array (
          
          ),
        ), 
        
        4 => 
        array (
          0 => 
          array (            
            'name' => 'mem_proveedor_interno',
            'studio' => 'visible',
            'label' => 'LBL_PROVEEDOR_INTERNO',
          ),
          1 => 
          array (
            'name' => 'mem_proveedor_externo',
            'studio' => 'visible',
            'label' => 'LBL_PROVEEDOR_EXTERNO',
          ),
        ), 
        
        5 => 
        array (
          0 => 
          array (                        
            'label' => 'LBL_REV_MODEL_NEG',
          ),
          1 => 
          array (
            'label' => 'LBL_HERR_EXPAN',
          ),
        ), 
        
        6 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_anal_punto_venta',
            'studio' => 'visible',
            'label' => 'LBL_ANAL_PUNTO_VENTA',
          ),
          1 => 
          array (
            'name' => 'mem_estado_herr_expan',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO_HERR_EXPAN',
          ),
        ),
        
        7 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_con_mod_negocio',
            'studio' => 'visible',
            'label' => 'LBL_CON_MOD_NEGOCIO',
          ),
          1 => 
          array (
            
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (                        
            
          ),
          1 => 
          array (
            'label' => 'LBL_CONTROL_CALIDAD',
          ),
        ),
        
        9 => 
        array (
          0 => 
          array (                        
            'name' => 'objeciones_mn',
            'studio' => 'visible',
            'label' => 'LBL_OBJECIONES_MN',
          ),
          1 => 
          array (           
            'name' => 'mejoras',
            'studio' => 'visible',
            'label' => 'LBL_MEJORAS',
          ),
        ),
        
        10 => 
        array (
          0 => 
          array (                        
            
          ),
          1 => 
          array (           
            'label' => 'LBL_ACUERDOS',
          ),
        ),
        
        11 => 
        array (
          0 => 
          array (                        
            'name' => 'informacion_competencia',
            'studio' => 'visible',
            'label' => 'LBL_INFORMACION_COMPETENCIA',
          ),
          1 => 
          array (           
           'name' => 'concesiones',
            'studio' => 'visible',
            'label' => 'LBL_CONCESIONES',
          ),
        ),
        
        12 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_argumento_venta',
            'studio' => 'visible',
            'label' => 'LBL_ARGUMENTO_VENTA',
          ),
          1 => 
          array (           
            'name' => 'mem_acuerdo_reunion',
            'studio' => 'visible',
            'label' => 'LBL_ACUERDO_REUNION',
          ),
        ),
        
        13 => 
        array (
          0 => 
          array (                                    
            'label' => 'LBL_ACTA_REUNION_INTER',
          ),
          1 => 
          array (           

          ),
        ),
        
        14 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_fecha_reunion',
            'studio' => 'visible',
            'label' => 'LBL_FECHA_REUNION',
          ),
          
        ),
        
        15 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_tipo_reunion',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_REUNION',
          ),
          
        ),
        
        16 => 
        array (
          0 => 
          array (                        
            'name' => 'mem_contenido_reunion',
            'studio' => 'visible',
            'label' => 'LBL_CONTENIDO_REUNION',
          ),
          
        ),
        
        17 => 
        array (
          0 => 
          array (                        

          ),          
        ),                             
      ),
      
      // ---- DATOS PERFIL IDONEO ------------------------------------------------------------------------------------------------------------
      
      'LBL_EDITVIEW_PERFIL_IDONEO' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'habilidades',
            'label' => 'LBL_HABILIDADES',                     
          ),  
          1 => 
          array (
            'name' => 'motivos_interes',
            'label' => 'LBL_MOTIVOS_INTERES',          
          ),      
        ),  
               
        1 => 
        array (
          0 => 
          array (
            'name' => 'tags_empresa',
            'label' => 'LBL_TAG_EMPRESA',
            'customCode'=>
            '{php}
                include "custom/modules/Expan_Solicitud/metadata/opEdicionSolicitud.php";
                $fran=new opEdicionSolicitud();
                $idSol=$this-> _tpl_vars["bean"]-> id;
                $fran->recogerTagsEmpresa($idSol);  
      
            {/php}
            <div id="sugerencias_tag_emp" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencias_tag_emp"></div>',
          ),
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'papel_idoneo',
            'label' => 'LBL_PAPEL_IDONEO',                     
          ),        
        ),                 
        
            
        3 => 
        array (
          0 => 
          array (
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
          array (
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
      ),  
      
      
      // ---- PROVEEDORES -------------------------------------------------------------------------------------------------
      
      'LBL_EDITVIEW_PROVEEDORES' => 
      array (
                     
        1 => 
        array (
          0 => 
          array (
            'name' => 'proveedor_insert',  
            'customCode'=>
            '{php}
                $idFranq=$this->_tpl_vars["bean"]->id;   
                $op=new opEdicionFranquicia();                
                $op->showInterfazProveedorFraquicia($idFranq,"EditView");        
            {/php}',
          ),
          
          1=> array (
              'name' => 'proveedor_list',
               'customCode' =>'
              {php}              
                  $idFranq=$this->_tpl_vars["bean"]->id;                           
                  $op=new opEdicionFranquicia();
                  $op->showListProveedores($idFranq);
              {/php}',
          ),
        ),                   
      ),  
      
      // ---- COMPETIDORES -------------------------------------------------------------------------------------------------
      
      'LBL_EDITVIEW_COMPETIDORES' => 
      array (

        0 =>
          array (
            0 =>
              array (
                'label' => 'LBL_CARACTERISTICAS_COMPETI',
              ),
            1 =>
              array (
              ),
          ),

        1 =>
          array (
            0 =>
              array (
                'name' => 'cd_sector',
                'label' => 'LBL_CD_SECTOR',
              ),
            1 =>
              array (
                'name' => 'cd_inversion',
                'label' => 'LBL_CD_INVERSION',
              ),
          ),

        2 =>
          array (
            0 =>
              array (
                'name' => 'cd_subsector',
                'label' => 'LBL_CD_SUBSECTOR',
              ),
            1 =>
              array (
                'name' => 'cd_opera_inter',
                'label' => 'LBL_CD_OPERA_INTER',
              ),
          ),

        3 =>
          array (
            0 =>
              array (
                'name' => 'cd_acttividad',
                'label' => 'LBL_CD_ACTTIVIDAD',
              ),
            1 =>
              array (
                'name' => 'cd_num_centros',
                'label' => 'LBL_CD_NUM_CENTROS',
              ),
          ),

        4 =>
          array (
            0 =>
              array (
                'name' => 'cd_perfil_franquiciado',
                'label' => 'LBL_CD_PERFIL_FRANQUICIADO',
              ),
            1 =>
              array (
                'name' => 'cd_oferta_comercial',
                'label' => 'LBL_CD_OFERTA_COMERCIAL',
              ),
          ),

        5 =>
          array (
            0 =>
              array (
                'name' => 'cd_modal_negocio',
                'label' => 'LBL_CD_MODAL_NEGOCIO',
              ),
            1 =>
              array (
                'name' => 'cd_canon',
                'label' => 'LBL_CD_CANON',
              ),
          ),

        6 =>
          array (
            0 =>
              array (
                'name' => 'cd_royaltys',
                'label' => 'LBL_CD_ROYALTYS',
              ),
            1 =>
              array (
                'name' => 'cd_pobl_minima',
                'label' => 'LBL_CD_POBL_MINIMA',
              ),
          ),

        7 =>
          array (
            0 =>
              array (
                'name' => 'cd_caract_local',
                'label' => 'LBL_CD_CARACT_LOCAL',
              ),
            1 =>
              array (
                'name' => 'cd_estruct_personal',
                'label' => 'LBL_CD_ESTRUCT_PERSONAL',
              ),
          ),
                     
        8 =>
        array (
          0 => 
          array (
            'name' => 'competidor_list',
               'customCode' =>'
              {php}              
                  $idFranq=$this->_tpl_vars["bean"]->id;                           
                  $op=new opEdicionFranquicia();
                  $op->showListCompetidores($idFranq);
              {/php}',       
          ),
          
          1=> array (
              'name' => 'competidor_insert',                
          ),
        ),                   
      ),
      
      // ---- MISTERY --------------------------------------------------------------------
      
      'LBL_EDITVIEW_MISTERY' => 
      array (
                     
        1 => 
        array (
          0 => 
          array (
            'name' => 'mistery_insert',
             'customCode'=>
            '{php}
                $idFranq=$this->_tpl_vars["bean"]->id;   
                $op=new opEdicionFranquicia();                
                $op->showInterfazMisteryFdo($idFranq);        
            {/php}',
          ),
          
          1=> array (
              'name' => 'mistery_list',
               'customCode' =>'
              {php}              
                  $idFranq=$this->_tpl_vars["bean"]->id;                           
                  $op=new opEdicionFranquicia();
                  $op->showListMisteryFdo($idFranq);
              {/php}',
          ),
        ),                   
      ),
                     
    ),
  ),
);
?>
