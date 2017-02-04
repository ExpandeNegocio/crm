<?php

$module_name = 'zr2_ReportParameterLink';
$viewdefs[$module_name]['QuickCreate'] = array(
    'templateMeta' => array('maxColumns' => '2', 
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'), 
                                            array('label' => '10', 'field' => '30'),
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
	  'zr2_reportparameterlink_zr2_reporttemplate_name',
	  'zr2_reportparameterlink_zr2_reportparameter_name',
	),
	array (
	  'zr2_reportparameterlink_zr2_querytemplate_name',
	)
  ),
                                                    
),
                        
);
?>