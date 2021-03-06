<?php
$module_name = 'Expan_ClientePotencial';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',          
          1 => 'DELETE',          
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
        'LBL_DATOS_GENERALES' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DATOS_PROPUESTA' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),        
      ),      
    ),
    'panels' => 
    array (
      'LBL_DATOS_GENERALES' => 
      array (      
    
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'cif',
            'label' => 'LBL_CIF',
          ),
        ),        
        
        1 => 
        array (
          0 => 
          array (
            'name' => 'expan_empresa_type',
            'label' => 'LBL_TYPE',
          ),
          1 => array (
            'name' => 'origen',
            'label' => 'LBL_ORIGEN',
          ),
        ),
        
        2 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'label' => 'LBL_EMAIL',
          ),
          1 => array (           
          ),
        ),               
        
        3 => 
        array (
          0 => 
          array (
            'name' => 'sector',
            'studio' => 'visible',
            'label' => 'LBL_SECTOR'           
          ),   
          1 => array (
            'name' => 'actividad_principal',            
            'label' => 'LBL_ACTIVIDAD_PRINCIPAL',
          ),
        ),
       
        4 => 
        array (
          0 => 
          array (
            'name' => 'fecha_contacto',
            'label' => 'LBL_FECHA_CONTACTO',
          ),   
          1 => array (
                      
          ),
        ),     
        
        5 => 
        array (
          0 => 
          array (          
            'label' => 'LBL_CONTACTO1',
          ),   
          1 => array (
            'label' => 'LBL_CONTACTO2',         
          ),
        ),  
                
        
        6 => 
        array (
          0 => 
          array (
            'name' => 'contacto1',
            'label' => 'LBL_CONTACTO',
          ),   
          1 => array (
            'name' => 'contacto2',
            'label' => 'LBL_CONTACTO',     
          ),
        ),
        
        7 => 
        array (
          0 => 
          array (
            'name' => 'cargo1',
            'label' => 'LBL_CARGO',
          ),   
          1 => array (
            'name' => 'cargo2',
            'label' => 'LBL_CARGO',     
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'telefono1',
            'label' => 'LBL_TELEFONO',
          ),   
          1 => array (
            'name' => 'telefono2',
            'label' => 'LBL_TELEFONO',     
          ),
        ),
       
        9 => 
        array (
          0 => 
          array (
            'name' => 'movil1',
            'label' => 'LBL_MOVIL',
          ),   
          1 => array (
            'name' => 'movil2',
            'label' => 'LBL_MOVIL',     
          ),
        ), 
        
        10 => 
        array (
          0 => 
          array (
            'name' => 'email_con_1',
            'label' => 'LBL_EMAIL',
          ),   
          1 => array (
            'name' => 'email_con_2',
            'label' => 'LBL_EMAIL',     
          ),
        ),
        
        11 => 
        array (
          0 => 
          array (
            'name' => 'direccion',
            'label' => 'LBL_DIRECCION',
          ),   
          1 => array (
            'name' => 'codigo_postal',
            'label' => 'LBL_CODIGO_POSTAL',     
          ),
        ),
        
        12 => 
        array (
          0 => 
          array (
            'name' => 'ccaa',
            'label' => 'LBL_CCAA',
          ),   
          1 => array (
            'name' => 'provincia',
            'label' => 'LBL_PROVINCIA',     
          ),
        ),
        
        13 => 
        array (
          0 => 
          array (
            'name' => 'poblacion',
            'label' => 'LBL_POBLACION',
          ),   
          1 => array (

          ),
        ),
        
        14 => 
        array (
          0 => 
          array (
            'name' => 'web',
            'label' => 'LBL_WEB',
          ),   
          1 => array (

          ),
        ),
                
        15 => 
        array (
          0 => 
          array (
            'name' => 'observaciones',
            'label' => 'LBL_OBSERVACIONES',
          ),   
          1 => array (          
          ),
        ),
      ),
    'LBL_DATOS_PROPUESTA' => 
    array (
    
        0 => 
        array (
          0 => 
          array (
            'name' => 'rating',
            'label' => 'LBL_RATING',
          ),
          1 => 
          array (
            
          ),
        ),  
        
        1 => 
        array (
          0 => 
          array (
            'name' => 'estado',
            'label' => 'LBL_ESTADO',
          ),
          1 => 
          array (
            
          ),
        ), 
    
        2 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_estado',
            'label' => 'LBL_OBSERVACIONES_ESTADO',
          ),
          1 => 
          array (
           
          ),
        ),
        
        3 => 
        array (
          0 => 
          array (
            'name' => 'chk_corto_plazo',
            'label' => 'LBL_CORTO_PLAZO',
          ),
          1 => 
          array (
            'name' => 'chk_interesa',
            'label' => 'LBL_INTERESA',
          ),
        ),
    
        4 => 
        array (
          0 => 
          array (
            'name' => 'decision',
            'label' => 'LBL_DECISION',
          ),
          1 => 
          array (
            'name' => 'f_plazo',
            'label' => 'LBL_PLAZO',
          ),
        ),
        
        5 => 
        array (
          0 => 
          array (
            'name' => 'tipo_propuesta',
            'label' => 'LBL_TIPO_PROPUESTA',
          ),
          1 => 
          array (
            'name' => 'f_envio_propuesta',
            'label' => 'LBL_ENVIO_PROPUESTA',
          ),
        ),
        
        6 => 
        array (
          0 => 
          array (
            'name' => 'observaciones_propuesta',
            'label' => 'LBL_OBSERVACIONES_PROPUESTA',
          ),
          1 => 
          array (
      
          ),
        ),
        
        7 => 
        array (
          0 => 
          array (
            'name' => 'chk_franquicia',
            'label' => 'LBL_FRANQUICIA',
          ),
          1 => 
          array (
            'name' => 'consultora',
            'label' => 'LBL_CONSULTORA',
          ),
        ),
        
        8 => 
        array (
          0 => 
          array (
            'name' => 'informacion_proyecto',
            'label' => 'LBL_INFORMACION_PROYECTO',
          ),
          1 => 
          array (
            'name' => 'chk_alta_news',
            'label' => 'LBL_ALTA_NEWS',
          ),
        ),
      ),                          
    ),
  ),
);
?>

