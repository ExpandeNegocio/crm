<?php
$module_name = 'asol_ProjectVersion';
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
          ),
          1 => 
          array (
            'name' => 'asol_project_asol_projectversion_name',
          ),
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
            'name' => 'type',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'wiki_link',
            'label' => 'LBL_WIKI_LINK',
          	'customCode' => '
								{php} 
									require_once("modules/asol_Project/customFields/EDV_asolProject_Wiki.php");
								{/php}
							',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'current_editor',
            'studio' => 'visible',
            'label' => 'LBL_CURRENT_EDITOR',
          ),
          1 => 
          array (
            'name' => 'last_editor_call',
            'label' => 'LBL_LAST_EDITOR_CALL',
          ),
        ),
        5 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_detailview_jquery_gantt' => 
      array (
        0 => 
        array (
          0 => 
          array (
          	'name' => 'jquery_gantt',
          	'customCode' => '
				{php} 
					require_once("modules/asol_Project/customFields/jquery_gantt.php");
				{/php}
			',
          	'customLabel' => '<div id="jquery_gantt_label"></div>',  
          ),        
        ),
      ),
    ),
  ),
);
?>
