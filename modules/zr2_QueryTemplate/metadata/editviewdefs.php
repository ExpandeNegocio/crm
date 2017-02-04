<?php

$module_name = 'zr2_QueryTemplate';
$viewdefs[$module_name]['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2', 
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'), 
                                            array('label' => '10', 'field' => '30')
                                            ),                                                                                                                                    
                                            ),
                                            
                                            
 'panels' =>array (
  'default' => 
  array (
    
    array (
      'name',
      'assigned_user_name',
    ),
    array (
      'description',
    ),
    array (
		  array (
			'name' => 'sql1',
			'displayParams'=>array('rows'=>8, 'cols'=>80)
		  ), 
    ),
	array(
	  	array (
		    'name' => '',
			'label' => '',
			'customCode' => '{$MOD.LBL_QUERY_SQL_HELP}'
		  ),
	),
  ),
                                                    
),
                        
);
?>