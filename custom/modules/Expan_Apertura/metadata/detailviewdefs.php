<?php
$module_name = 'Expan_Apertura';
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
          2 => array (
            'customCode' => '<a href="index.php?module=Expan_GestionSolicitudes&action=DetailView&record={$fields.gestion.value}">
               <button>Ir Gestion</button>
            </a>',
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
    'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_GENERAL' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),                
        'LBL_ADMINISTRACION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),        
      ),
    ),   
    'panels' => 
    array (
      'lbl_general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
          array (
            'name' => 'franquicia',
            'studio' => 'visible',
            'link' => true,
            'label' => 'LBL_FRANQUICIA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (           
          ),
          1 => 
          array (
            'name' => 'otra_franquicia',
            'label' => 'LBL_OTRA_FRANQUICIA',
          ),
        ),                
        2 => 
        array (
          0 => 
          array (
            'name' => 'tipo_apertura',
            'label' => 'LBL_TIPO_APERTURA',
          ),
          1 => 
          array (
            'name' => 'provincia_apertura',
            'label' => 'LBL_PROVINCIA_APERTURA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'abierta',
            'label' => 'LBL_ABIERTA',
          ),
          1 => 
          array (
            'name' => 'localidad_apertura',
            'label' => 'LBL_LOCALIDAD_APERTURA',
          ),
        ),
        
        4 => 
        array (
          0 => 
          array (
        
          ),
          1 => 
          array (
            'name' => 'direccion',
            'label' => 'LBL_DIRECCION',
          ),
        ),
        
        5 => 
        array (
          0 => 
          array (
              'name' => 'motivos_apertura',
                'studio' => 'visible',
                'label' => 'LBL_MOTIVOS_APERTURA',
          ), 
          1 => 
          array (
            'name' => 'incidencias',
            'studio' => 'visible',
            'label' => 'LBL_INCIDENCIAS',   
          ), 
        ),
        6 =>
        array(
            0 => 
            array(
                'name' => 'valoracion',
                'studio' => 'visible',
                'label' => 'LBL_VALORACION_FRAN',
            ),
            1 =>
            array(
                 'name' => 'num_empleados',
                'label' => 'LBL_NUM_EMPLEADOS',
            ),
        ),
        7 =>
         array(
            0 =>
            array(
                'name' => 'area_exclusividad',
                'label' => 'LBL_AREA_EXCLUSIVIDAD',
            ),
            1 =>
            array(
                'name' => 'inversion_inicial',
                'label' => 'LBL_INVERSION_INICIAL',
            ),
            
         ),
         8 =>
         array(
            0 =>
            array(
                'name' => 'f_inicio_contrato',
                'label' => 'LBL_FECHA_INICIO_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'f_renovacion_contrato',
                'label' => 'LBL_FECHA_RENOVACION_CONTRATO',
            ),
            
         ),
         9 =>
         array(
            0 =>
            array(
                'name' => 'f_baja_contrato',
                'label' => 'LBL_FECHA_BAJA_CONTRATO',
            ),
            1 =>
            array(
                'name' => 'motivo_baja',
                'label' => 'LBL_MOTIVO_BAJA',
            ),
            
         ),
         
         10 =>
         array(
            0 =>
            array(
                'name' => 'observaciones',
                'label' => 'LBL_OBSERVACIONES',
            ),        
         ),                   
      ), 
      
          'LBL_ADMINISTRACION' => 
          array (
          
             0 =>
             array(
                0 =>
                array(
                    'name' => 'Comision_cons_cartera',
                    'label' => 'LBL_COMISION_CONS_CARTERA',
                ),                      
             ),
          
             1 =>
             array(
                0 =>
                array(
                    'name' => 'f_ini_com_cons_cartera',
                    'label' => 'LBL_FECHA_INI_COM_CONS_CARTERA',
                ),
                1 =>
                array(
                    'name' => 'f_fin_com_cons_cartera',
                    'label' => 'LBL_FECHA_FIN_COM_CONS_CARTERA',
                ),            
             ),
          
          ),
      
       ),
    ),
);
?>
