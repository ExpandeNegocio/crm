<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('data/SugarBean.php');
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once('modules/Expan_Franquiciado/Expan_Franquiciado.php');

$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
$GLOBALS['log']->info('[ExpandeNegocio][Franquiciado]Entra a crear un franquiciado o comprobar telefono');

$accion = $_POST['accion'];
$solId = $_POST['id'];

$db = DBManagerFactory::getInstance();
$salida = '';
switch ($accion) {

  case '1':
    $salida = 'Ok';

    if (Expan_Franquiciado::existeFranquiciado($solId) != false) {
      $salida = '';
    }

    break;

  case '2':

    $sol = new Expan_Solicitud();
    $sol->retrieve($solId);

    Expan_Franquiciado::crearFranquiciado($sol, 2);

    $salida = 'Ok';

    break;

  case 'abrir':

    $sql = "SELECT id as idF FROM expan_franquiciado ";
    $sql = $sql . " WHERE solicitud_id='" . $solId . "' AND deleted=0;";

    $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - ' . $sql);

    $resultSol = $db->query($sql, true);

    while ($rowSol = $db->fetchByAssoc($resultSol)) {
      $salida = $rowSol["idF"];
      echo $salida;
      return;
    }


    break;
}
echo $salida;