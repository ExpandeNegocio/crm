<?php

	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
	
	// depending on what your log level is set at in log4php.properties
	$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log');
	
	$bean = BeanFactory::getBean('Expan_Solicitud', $bean_id);


	$GLOBALS['log']->info('[ExpandeNegocio] '.$bean->franquicia_principal);

	$GLOBALS['log']->info('[ExpandeNegocio] '.$bean->franquicias_secundarias);


//$NewCall->assigned_user_id = $Contact_Aux->assigned_user_id; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log1');

	$NewCall->name='Llamada inicial'; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log2');

$NewCall->status='Planned';

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log3');

$NewCall->duration_hours=0; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log4');

$NewCall->duration_minutes=15; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log5');

$NewCall->direction='Outbound';

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log6');
	
//	$NewCall->parent_id=$bean_id; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log7');

//	$NewCall->parent_type='Expan_Solicitud'; 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log8');

 	$date_call = new DateTime('now', new DateTimeZone('GMT'));
  
$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log9');

	$date_call->add(new DateInterval('P3D'));

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log91');

  	$new_date_start = $date_call->format($GLOBALS['timedate']->get_date_time_format());

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log10');

//$NewCall->date_start=$new_date_start;

$NewCall->date_start = "25/08/2010 18:45";

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log11');

	$NewCall->save(); 

$GLOBALS['log']->info('[ExpandeNegocio] Escribimos en el log12');


$GLOBALS['log']->info('[ExpandeNegocio] Final ');

?>