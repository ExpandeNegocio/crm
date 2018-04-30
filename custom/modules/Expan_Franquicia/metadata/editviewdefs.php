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
      ),
    ),
     'panels' => 
    array (
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
            'name' => 'tipo_cuenta',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_CUENTA',
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
        9 => 
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
        10 => 
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
        11 => 
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
        12 => 
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
        13 => 
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
        
      ),
      
      'lbl_editview_panel_mod_neg'=>
      array(
      
        1 => 
        array (
          0 => array (
            'name' => 'modNeg1',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG1',
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
          0 => array (
            'name' => 'modNeg2',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG2',
          ),         
        ),      
        
        6 => 
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
        
        7 => 
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
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'valNeg25',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG25',
          ),              
        ),     
          
        9 => 
        array (
          0 => array (
            'name' => 'modNeg3',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG3',
          ),         
        ),     
                
        10 => 
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
        
        11 => 
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
        
        12 => 
        array (
          0 => 
          array (
            'name' => 'valNeg35',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG35',
          ),              
        ), 
                  
        13 => 
        array (
          0 => array (
            'name' => 'modNeg4',
            'studio' => 'visible',
            'label' => 'LBL_MODNEG4',
          ),         
        ),
        
        14 => 
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
        
        15=> 
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
        
        16 => 
        array (
          0 => 
          array (
            'name' => 'valNeg45',
            'studio' => 'visible',
            'label' => 'LBL_VALNEG45',
          ),              
        ), 
     
      ),      
      
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
    
      //Datos de la franquicia
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'sector',
            'studio' => 'visible',
            'label' => 'LBL_SECTOR',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'breve_descripcion',
            'label' => 'LBL_BREVE_DESCRIPCION',
          ),
          1 => 'description',
        ),
        2 => 
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
        3 => 
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
        4 => 
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
        5 => 
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
        6 => 
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
        7 => 
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
        8 => 
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
        9 => 
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
        10=>
        array(
            0=> array(
                
                'name'=>'prime',
                'studio' =>'visible',
                'label' =>'LBL_PRIME',
            
            ),
        ),
      ),
     
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
    ),
  ),
);
?>
