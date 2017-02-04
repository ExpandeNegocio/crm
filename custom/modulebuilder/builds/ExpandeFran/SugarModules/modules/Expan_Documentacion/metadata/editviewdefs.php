<?php
$module_name = 'Expan_Documentacion';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
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
          0 => 'document_name',
          1 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
        ),
        1 => 
        array (
          0 => 'category_id',
          1 => 'subcategory_id',
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'prueba',
            'studio' => 'visible',
            'label' => 'LBL_PRUEBA',
          ),
        ),
        3 => 
        array (
          0 => 'status_id',
          1 => 
          array (
            'name' => 'pruebasiframe',
            'label' => 'LBL_PRUEBASIFRAME',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
          1 => 
          array (
            'name' => 'franquicias',
            'studio' => 'visible',
            'label' => 'LBL_FRANQUICIAS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'fran_buenas',
            'studio' => 'visible',
            'label' => 'LBL_FRAN_BUENAS',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
