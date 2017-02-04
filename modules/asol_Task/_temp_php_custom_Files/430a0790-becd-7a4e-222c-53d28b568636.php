<?php

function __autoload($clase){
  include $clase.'.php';
 }

//require_once('include/utils/EnvioAutoCorreos.php');

	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

	$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Llega1');

	const numCorreo="1";

	$bean = BeanFactory::getBean('Expan_Solicitud', $bean_id);

	$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Llega2');

	$caracteres = split(',', $bean->franquicias_secundarias);

	foreach  ($caracteres as $valor){

		$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Entra franquias1');
		
		$valor=str_replace('^','',$valor);

		if ($valor!=''){


			$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Entra franquias2');

			//envío el correo
			$envioCorreos=new EnvioAutoCorreos;
			//$envioCorreos($bean,$valor."#".numCorreo);

			$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Entra franquias3');

			$envioCorreos->saludar();

			$GLOBALS['log']->info('[ExpandeNegocio][Envio correos Plantilla]Entra franquias4');
		}
	}

?>