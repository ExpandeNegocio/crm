<?php
$module_name = 'Expan_Evento';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
        'includes' => array (
            0 =>array ('file' => 'include/javascript/EditEvento.js',),
            1=>array ('file' => 'include/javascript/include.js',),
        ),
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="envioCorreosEvento(\'{$fields.id.value}\');" value="Enviar Correos Evento">{/if}',
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'year',
            'label' => 'LBL_YEAR',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ciudad',
            'label' => 'LBL_CIUDAD',
          ),
          1 => 
          array (
            'name' => 'fecha_celebracion',
            'label' => 'LBL_FECHA_CELEBRACION',
          ),
        ),
        2 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'tipo_evento',
            'label' => 'LBL_TIPO_EVENTO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'total_solicitudes',
            'label' => 'LBL_TOTAL_SOLICITUDES',
          ),
          1 => 
          array (
            'name' => 'total_gestiones',
            'label' => 'LBL_TOTAL_GESTIONES',
          ),
        ),
      ),
    ),
  ),
);
?>
