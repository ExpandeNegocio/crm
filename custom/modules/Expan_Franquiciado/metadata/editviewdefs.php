<?php
$module_name = 'Expan_Franquiciado';
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
      {sugar_getscript file="include/javascript/EditFranquiciado.js"}
      {sugar_getscript file="include/javascript/jquery.js"}',
    ),
    'panels' => 
    array (
      'default' => 
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
            'name' => 'estado',
            'label' => 'LBL_ESTADO',
            'type' => 'readonly',
          ),
        ),
        1 => 
        array (
          0 => 'last_name',
          1 => array (
            'name' => 'phone_mobile',
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
              'name' => 'provincia',
              'label' => 'LBL_PROVINCIA',
          ),         
          1 => 'phone_work',
          
        ),
        
        4 => 
        array (
          0 => 
          array (
              'name' => 'localidad',
              'label' => 'LBL_LOCALIDAD',
          ),
          1 => 
          array (
              'name' => 'sectores_historicos',
              'label' => 'LBL_SECTORES_HISTORICOS',
          ),
        ),

        5 =>
        array (
          0 => 
          array (
            'name' => 'pais',
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
            'name' => 'origen',
            'studio' => 'visible',
            'label' => 'LBL_ORIGEN',
          ),
          1 => 
          array (
            'name' => 'check_plurifranquiciado',
            'label' => 'LBL_CHECK_PLURIFRANQUICIADO',
          ),
        ),

        7 =>
        array(
            0=>
            array(
                'name'=>'observaciones',
                'label'=>'LBL_OBSERVACIONES'
            ),
          1 =>
            array(
              'name' => 'solicitud',
              'label' => 'LBL_SOLICITUD',
              'customCode' => '<a href="index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Solicitud%26action%3DDetailView%26record%3D{$fields.solicitud_id.value}">{$fields.solicitud.value}</a><div />',
            ),
        ),
      ),
    ),
  ),
);
?>
