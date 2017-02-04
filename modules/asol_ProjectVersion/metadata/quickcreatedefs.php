<?php
$module_name = 'asol_ProjectVersion';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
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
          0 => 
          array (
            'name' => 'version_number',
            'label' => 'LBL_VERSION_NUMBER',
          	'type' => 'readonly',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'is_published',
            'label' => 'LBL_IS_PUBLISHED',
          ),
          1 => 
          array (
            'name' => 'published_datetime',
            'label' => 'LBL_PUBLISHED_DATETIME',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'baseline',
            'label' => 'LBL_BASELINE',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
    ),
  ),
);
?>
