<?php
$dictionary['zr2_ReportContainer'] = array(
	'table' => 'zr2_reportcontainer',
	'fields' => array (
	),
);

if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('zr2_ReportContainer','zr2_ReportContainer', array('basic','assignable'));


?>
