<?php
$module_name = 'Expan_Evento';
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
      {sugar_getscript file="include/javascript/EditEvento.js"}
      {sugar_getscript file="include/javascript/include.js"}
      {sugar_getscript file="modules/Documents/documents.js"}',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
        			onClick="envioCorreosEvento(\'{$fields.id.value}\');" value="Enviar Correos Evento">{/if}',
          ),
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
            'name' => 'cuerpo',
            'label' => 'LBL_CUERPO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'tipo_evento',
            'label' => 'LBL_TIPO_EVENTO',
          ),
        ),

      ),
    ),
  ),
);
?>
