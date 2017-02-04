<?php

	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
	
	// depending on what your log level is set at in log4php.properties
	$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Escribimos en el log');
	
	$bean = BeanFactory::getBean('Expan_Solicitud', $bean_id);
	
	$bean->load_relationship('expan_solicitud_users');

	//Debemos de recoger el usuario al que le asignamos

	$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Franquicia P -'.$bean->franquicia_principal);

	$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Franquicias - '.$bean->franquicias_secundarias);

	$caracteres = split(',', $bean->franquicias_secundarias);

	$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Longitud Array - '.count($caracteres));
	
	//Recorremos el array
	foreach  ($caracteres as $valor){
		
		$valor=str_replace('^','',$valor);

		if ($valor!=''){
		
			//Buscamos la franquicia y recogemos el id del 
			
			$franq = BeanFactory::getBean('Expan_Franquicia', $valor);
			$usuario_asg=$franq->assigned_user_id;
			
			//asignamos el usuario
			$bean->expan_solicitud_users->add($usuario_asg);
			$bean->save();
			
			$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Usuario -'.$usuario_asg.' pertenece a -'.$valor);
		}
	}

	//Si no tiene franquicias hay que pasarselo al usuario de asesoramiento
	if ($bean->franquicias_secundarias==''){

		
		$usuario_asg='46d27a2c-4375-6b3e-d3b6-53a31512a252';
			
		//asignamos el usuario
		$bean->expan_solicitud_users->add($usuario_asg);
		$bean->save();
		$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Debemos asignarlo al usuario de consultoria ');
	}

	$GLOBALS['log']->info('[ExpandeNegocio][Asignar Usuario] Final ');

?>