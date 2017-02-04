<?php
$module_name = 'asol_Project';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      /*
      'includes'=> 
       array(
        	0 => array('file'=>'modules/asol_Project/resources/js/jquery.min.js'),
       ),
       */
    
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
            'name' => 'wiki_link',
            'label' => 'LBL_WIKI_LINK',
          	'customCode' => '
								{php} 
									require_once("modules/asol_Project/customFields/EDV_asolProject_Wiki.php");
								{/php}
							',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'label' => 'LBL_DATE_START',
          ),
          1 => 
          array (
            'name' => 'date_end',
            'label' => 'LBL_DATE_END',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'priority',
            'studio' => 'visible',
            'label' => 'LBL_PRIORITY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'last_published_version',
            'studio' => 'visible',
            'label' => 'LBL_LAST_PUBLISHED_VERSION',
          ),
          1 => 
          array (
            'name' => 'working_version',
            'studio' => 'visible',
            'label' => 'LBL_WORKING_VERSION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'studio' => 'visible',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
          1 => 
          array (
            'name' => 'asol_release_asol_project_name',
          ),
        ),
        5 => 
        array (
          0 => 'description',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'log',
            'studio' => 'visible',
            'label' => 'LBL_LOG',
          ),
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
