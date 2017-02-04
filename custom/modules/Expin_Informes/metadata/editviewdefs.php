<?php
$module_name = 'Expin_Informes';
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
      {sugar_getscript file="include/javascript/EditInformes.js"}
      {sugar_getscript file="include/javascript/include.js"}
      <script type="text/javascript"> onload=cargaEditor(\'{$current_user->id}\');</script>',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="generarInformes(\'{$fields.id.value}\',\'{$fields.fecha_inicio.value}\',\'{$fields.fecha_fin.value}\');" value="Lanzar Informe">{/if}',
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
          1 => 'description',
        ),
         1 => 
        array (
          0 => array (
            'name' => 'tipo',
            'label' => 'LBL_TIPO',
          ), 
        ),               
        2 => 
        array (
          0 => 
          array (
            'name' => 'fecha_inicio',
            'label' => 'LBL_FECHA_INICIO',
          ),
          1 => 
          array (
            'name' => 'fecha_fin',
            'label' => 'LBL_FECHA_FIN',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'consulta',
            'studio' => 'visible',
            'label' => 'LBL_CONSULTA',
          ),
        ),
      ),
    ),
  ),
);
?>
