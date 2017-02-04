<?php
$module_name = 'zr2_ReportParameterLink';
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
      'useTabs' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'zr2_reportparameterlink_zr2_reportparameter_name',
          ),
          1 => 
          array (
            'name' => 'default_value',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'zr2_reportparameterlink_zr2_reporttemplate_name',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'zr2_reportparameterlink_zr2_querytemplate_name',
          ),
        ),
        4 => 
        array (
          0 => 
		  array (
			'name' => 'bind_to_module_name',
			'customCode' => '{html_options name="bind_to_module_name" options=$MODULE_OPTIONS selected=$fields.bind_to_module_name.value}'
		  ),		  
        ),		
        5 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
