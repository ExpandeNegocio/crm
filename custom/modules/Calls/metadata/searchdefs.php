<?php
$searchdefs ['Calls'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'open_only' => 
      array (
        'name' => 'open_only',
        'label' => 'LBL_OPEN_ITEMS',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'date_start' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
    ),
    'advanced_search' => 
    array (
    
        'franquicia' => 
      array (
        'name' => 'franquicia',
        'label' => 'LBL_FRANQUICIA',
        'type' => 'enum',
        'default' => true,
        'width' => '10%',
      ),
    
     'call_type' => 
      array (
        'name' => 'call_type',
        'type' => 'enum',
        'default' => true,
        'width' => '10%',
      ),
    
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'direction' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_DIRECTION',
        'width' => '10%',
        'default' => true,
        'name' => 'direction',
      ),
      'status' => 
      array (
        'name' => 'status',
        'default' => true,
        'width' => '10%',
      ),
      'date_start' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'gestion_agrupada' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_GESTION_AGRUPADA',
        'width' => '10%',
        'name' => 'gestion_agrupada',
      ),
      
       'provincia_apertura_1' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_PROVINCIA_APERTURA_1',
        'width' => '10%',
        'default' => true,
        'name' => 'provincia_apertura_1',
      ),
      
      'disp_contacto' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
        'width' => '10%',
        'default' => true,
        'name' => 'disp_contacto',
      ),
      
     'origen' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_ORIGEN',
        'width' => '10%',
        'default' => true,
        'name' => 'origen',
      ),
      
      'repeticiones' => 
      array (
        'type' => 'int',
        'studio' => 'visible',
        'label' => 'LBL_REPETICIONES',
        'width' => '10%',
        'default' => true,
        'name' => 'repeticiones',
      ),
            
      'description' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DESCRIPTION',
        'width' => '10%',
        'default' => true,
        'name' => 'description',
      ),
     
      
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
