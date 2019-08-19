<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once ('data/SugarBean.php');
require_once ('custom/modules/Expan_Solicitud/metadata/opEdicionSolicitud.php');

$tipo=$_POST["tipo"];

switch ($tipo) {
  case 'getSectores':
    $opEdicionSol=new opEdicionSolicitud();
    $opEdicionSol->cargaSectores(false);

  default:

    break;
}