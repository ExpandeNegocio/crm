<?php

	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

	$GLOBALS['log']->info('[ExpandeNegocio] Creamos la llamada');

	$call = new Call();
	// fill in record data
	$call->assigned_user_id = "1";
	$call->assigned_user_name = "Administrator";
	$call->name = "call manager";
	$call->direction = "Outbound";
	$call->status = "Planned";

 	$date_call = new DateTime('now', new DateTimeZone('GMT'));

	$date_call->add(new DateInterval('P3D'));

  	$new_date_start = $date_call->format($GLOBALS['timedate']->get_date_time_format());

	$call->date_start =$new_date_start;
	$call->duration_minutes = "15";
	// this values can also be taken from db as well as any other value, just example
	$call->description = "please call your manager and superior and report for work!";

	// this is called in the end to save entry, and your new record in Calls will be created with data above
	$call->save();
	
	$GLOBALS['log']->info('[ExpandeNegocio] Final de llamada');

//

?>