<?php
$module_name = 'Expan_Franquiciado';
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
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
      
       -1 =>
       array(
          0 => 
          array (
              'name' => 'date_entered',
              'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
              'label' => 'Fecha creacion',
          ),
       ),
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'estado',
            'label' => 'LBL_ESTADO',
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
            'name' => 'no_correos',
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
        array(
            0 => 
            array(
                'name' => 'no_newsletter',
                'label' => 'LBL_NEWSLETTER',
            ),
            
            1 => 
            array(
                'name' => 'sectores_historicos',
                'label' => 'LBL_SECTORES_HISTORICOS',
            ),
        ),
        
        6 => 
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
        7 => 
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
        8 =>
        array(
            0=>
            array(
                'name'=>'observaciones',
                'label'=>'LBL_OBSERVACIONES'
            ),
        ),
        
          
      ),
    ),
  ),
);
?>
