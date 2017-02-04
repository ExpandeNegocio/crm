<?php
$module_name = 'zr2_ReportTemplate';
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
	  'form' =>
	  array (
		'enctype' => 'multipart/form-data',
	  ),
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
            'name' => '',
			'label' => 'LBL_REPORT_FILENAME',
			'customCode' => '<input name="reportfile" type="file" size="20" onchange="setvalue(this);"/>'
          ),
        ),
        2 => 
        array (
          0 => 'description',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'export_as',
			'customCode' => '{$EXPORT_TYPES}'
          ),
        ),
      ),
      'LBL_RESOURCES' => 
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => '',
			'customCode' => '{$MOD.LBL_RESOURCE_HELP}'
		  ),
        ),
		1 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_RESOURCE',
			'customCode' => '<input name="resource0" type="file" size="20"/>'
		  ),
        ),
        2 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_RESOURCE',
			'customCode' => '<input name="resource1" type="file" size="20"/>'
		  ),
        ),
        3 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_RESOURCE',
			'customCode' => '<input name="resource2" type="file" size="20"/>'
		  ),
        ),
        4 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_RESOURCE',
			'customCode' => '<input name="resource3" type="file" size="20"/>'
		  ),
        ),	
        5 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_RESOURCE',
			'customCode' => '<input name="resource4" type="file" size="20"/>'
		  ),
        ),				
      ),
      'LBL_SUBREPORTS' => 
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => '',
			'customCode' => '{$MOD.LBL_SUBREPORT_HELP}'
		  ),
        ),
		1 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_SUBREPORT',
			'customCode' => '<input name="subreport0" type="file" size="20"/>'
		  ),
        ),
        2 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_SUBREPORT',
			'customCode' => '<input name="subreport1" type="file" size="20"/>'
		  ),
        ),
        3 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_SUBREPORT',
			'customCode' => '<input name="subreport2" type="file" size="20"/>'
		  ),
        ),
        4 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_SUBREPORT',
			'customCode' => '<input name="subreport3" type="file" size="20"/>'
		  ),
        ),	
        5 => 
        array (
          0 => 
		  array (
			'name' => '',
			'label' => 'LBL_SUBREPORT',
			'customCode' => '<input name="subreport4" type="file" size="20"/>'
		  ),
        ),				
      ),
    ),
  ),
);
?>