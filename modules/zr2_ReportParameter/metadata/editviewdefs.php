<?php
$module_name = 'zr2_ReportParameter';
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
          'label' => '15',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '15',
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
          0 => 'friendly_name',
        ),		
        2 => 
        array (
          0 => 
          array (
            'name' => 'default_name',
          ),
          1 => 
          array (
            'name' => 'default_value',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'range_name',
			'customCode' => '<select name="range_name" onChange="this.form.action.value=\'EditView\'; if(check_form(\'EditView\')) SUGAR.ajaxUI.submitForm(this.form);">{html_options options=$fields.range_name.options selected=$fields.range_name.value}</select>'
          ),
        ),
      ),
      'LBL_PARAM_PANEL_SQL' =>
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => 'range_options',
			'label' => 'LBL_PARAM_RANGE_SQL',
			'displayParams'=>array('rows'=>8, 'cols'=>80)
		  ),
          1 =>
		  array (
		    'name' => 'range_help',
			'label' => 'LBL_PARAM_RANGE_SQL_HELP',
			'customCode' => ''
		  ),
        ),
		1 =>
		array (
		  0 =>
		  array (
		    'name' => 'sql_test',
			'customCode' => '<input type="hidden" name="sqltest"><input class="button" onclick="this.form.action.value=\'EditView\'; this.form.sqltest.value=\'true\'; if(check_form(\'EditView\')) SUGAR.ajaxUI.submitForm(this.form);" type="submit" name="button" value="  {$MOD.LBL_PARAM_RANGE_SQL_TEST}  " >
			<br/>{$SQL_RESULT}<br/>'
		  ),
		),  
      ),
	  'LBL_PARAM_PANEL_LIST' =>
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => 'range_options',
			'label' => 'LBL_PARAM_RANGE_LIST',
			'displayParams'=>array('rows'=>8, 'cols'=>80)
		  ),
          1 =>
		  array (
		    'name' => 'range_help',
			'label' => 'LBL_PARAM_RANGE_LIST_HELP',
			'customCode' => ''
		  ),
        ),
	  ),
	  'LBL_PARAM_PANEL_DROPDOWN' =>
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => 'range_options',
			'label' => 'LBL_PARAM_RANGE_DROPDOWN',
			'customCode' => '{html_options name="range_options" options=$DROPDOWN_OPTIONS selected=$fields.range_options.value}'
		  ),
        ),
	  ),
	  'LBL_PARAM_PANEL_SCRIPT' =>
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => 'range_options',
			'label' => 'LBL_PARAM_RANGE_SCRIPT',
			'displayParams'=>array('rows'=>8, 'cols'=>80)
		  ),
          1 =>
		  array (
		    'name' => 'range_help',
			'label' => 'LBL_PARAM_RANGE_SCRIPT_HELP',
			'customCode' => ''
		  ),
        ),
	  ),
	  'LBL_PARAM_PANEL_SCRIPT_DISABLED' =>
      array (
        0 => 
        array (
          0 => 
		  array (
			'name' => 'range_options_disabled',
			'label' => 'LBL_PARAM_RANGE_SCRIPT',
			'customCode' => '{$MOD.LBL_PARAM_RANGE_SCRIPT_DISABLED}'
		  ),
        ),
	  ),
    ),
  ),
);
?>
