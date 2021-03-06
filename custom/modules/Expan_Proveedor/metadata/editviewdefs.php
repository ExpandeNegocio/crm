<?php
$module_name = 'Expan_Proveedor';
$_object_name = '_expan_proveedor';
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
      
      {sugar_getscript file="include/javascript/jquery.js"}
      </script>',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_DATOS_GENERALES' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        
      ),
    ),
     'panels' => 
    array (
    
    //-----------------------------------------------------------------------------------------------------------------------------
    
      //Datos gerenales de la empresa
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
            'name' => 'empresa_type',
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
            'label' => 'LBL_SECTOR',
            'customCode' => '
              {php}
                  include "custom/modules/Expan_Franquicia/metadata/opEdicionFranquicia.php";
                  $prueba=new opEdicionFranquicia();
                  $prueba->cargaSectores();  
              {/php}',
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
      
    ),
  ),
);
?>
