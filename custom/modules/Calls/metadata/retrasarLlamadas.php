<?php

	$GLOBALS['log']->info('[ExpandeNegocio][Retrasar Llamada] Entra');
	
	require_once ('data/SugarBean.php');
	require_once ('modules/Calls/Call.php');
	
	$GLOBALS['log']->info('[ExpandeNegocio][Retrasar Llamada] LLega2');
	
	//Recojemos los parámetros de la llamada Ajax
	
	$id = $_POST['id'];
	$tipoRetraso = $_POST['retraso'];
	
	$GLOBALS['log']->info('[ExpandeNegocio][Retrasar Llamada] LLega3');
	
	$bean = new Call();
	$bean -> retrieve($id);
	
	$dateTime = $bean -> date_start;

	if ($tipoRetraso == "1H") {
		$nuevaFecha=strtotime ( '+1 hour' , strtotime ( $dateTime ) ) ;
	} elseif ($tipoRetraso == "1D") {
		$nuevaFecha=strtotime ( '+1 day' , strtotime ( $dateTime ) ) ;
	}elseif ($tipoRetraso == "3D") {
        $nuevaFecha=strtotime ( '+3 day' , strtotime ( $dateTime ) ) ;
    }elseif ($tipoRetraso == "7D") {
        $nuevaFecha=strtotime ( '+7 day' , strtotime ( $dateTime ) ) ;
    }   
	
	$GLOBALS['log']->info('[ExpandeNegocio][Retrasar Llamada] Fecha - '.date("d/m/Y H:i", $nuevaFecha));
	$bean -> date_start = date("d/m/Y H:i", $nuevaFecha);

	$bean -> save();
	$GLOBALS['log']->info('[ExpandeNegocio][Retrasar Llamada] FIN');
?>
