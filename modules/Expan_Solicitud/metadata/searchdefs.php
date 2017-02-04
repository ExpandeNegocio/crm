<?php
$module_name = 'Expan_Solicitud';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
      ),
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'first_name' => 
      array (
        'name' => 'first_name',
        'default' => true,
        'width' => '10%',
      ),
      'last_name' => 
      array (
        'name' => 'last_name',
        'default' => true,
        'width' => '10%',
      ),
      'created_by_name' => 
      array (
        'name' => 'created_by_name',
        'default' => true,
        'width' => '10%',
      ),
      'do_not_call' => 
      array (
        'name' => 'do_not_call',
        'default' => true,
        'width' => '10%',
      ),
      'email' => 
      array (
        'name' => 'email',
        'default' => true,
        'width' => '10%',
      ),
      'tipo_origen' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TIPO_ORIGEN',
        'width' => '10%',
        'default' => true,
        'name' => 'tipo_origen',
      ),
      'evento' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_EVENTO',
        'id' => 'EXPAN_EVENTO_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'evento',
      ),
      'fecha_primer_contacto' => 
      array (
        'type' => 'date',
        'label' => 'LBL_FECHA_PRIMER_CONTACTO',
        'width' => '10%',
        'default' => true,
        'name' => 'fecha_primer_contacto',
      ),
      'expan_franquicia_id_c' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_FRANQUICIA_TEMP_EXPAN_FRANQUICIA_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'expan_franquicia_id_c',
      ),
      'franquicias_secundarias' => 
      array (
        'type' => 'multienum',
        'studio' => 'visible',
        'label' => 'LBL_FRANQUICIAS_SECUNDARIAS',
        'width' => '10%',
        'default' => true,
        'name' => 'franquicias_secundarias',
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
      'rating' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_RATING',
        'width' => '10%',
        'default' => true,
        'name' => 'rating',
      ),
      'assigned_user_name' => 
      array (
        'link' => true,
        'type' => 'relate',
        'label' => 'LBL_ASSIGNED_TO_NAME',
        'id' => 'ASSIGNED_USER_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'assigned_user_name',
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
