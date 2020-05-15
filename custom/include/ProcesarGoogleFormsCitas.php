<?php

$GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Entra");

echo "Entra" . "<br>";
require_once('custom/include/CreacionGestionSolicitud.php');
procesar();

function procesar()
{

  echo "Entra1" . "<br>";

  //Recogemos los valores que nos pasa el formulario
  $idFran = $_POST['idFran'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $telefono = $_POST['telefono'];
  $fecha = $_POST['fecha'];
  $hora = $_POST['hora'];

  $idCuestionario = $_POST['idresp'];

  $GLOBALS['log']->info("[ExpandeNegocio][][Pruebas]IdFranq-" . $idFran);
  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Nombre-" . $nombre);
  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Apellidos-" . $apellidos);
  $GLOBALS['log']->info("[ExpandeNegocio][pprocesarGoogleFormsrocesarGoogleForms][Pruebas]Telefono-" . $telefono);
  $GLOBALS['log']->info("[ExpandeNegocio][pprocesarGoogleFormsrocesarGoogleForms][Pruebas]Fecha-" . $fecha);
  $GLOBALS['log']->info("[ExpandeNegocio][pprocesarGoogleFormsrocesarGoogleForms][Pruebas]Hora-" . $hora);

  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Dir Cuestionario-" . $idCuestionario);

  echo "Entra2" . "<br>";

  echo "Nombre-" . $nombre . "<br>";
  echo "Apellidos-" . $apellidos . "<br>";
  echo "Telefono-" . $telefono . "<br>";

  $idSol = localizaSolicitudPortelefono($telefono);

  //Si existe la solicitud -> la modificamos
  if ($idSol != '') {

    $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Tenemos la solicitud-".$idSol);

    $solicitud = new Expan_Solicitud();
    $solicitud->retrieve($idSol);


    $gestion = $solicitud->getGestionFromFranID($idFran);

    $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Tenemos la gestion-".$gestion->id);

    if ($gestion != null) {
      crearLLamadaGest($gestion,$telefono,$fecha,$hora);
    }
  }

  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms]Finaliza");
  echo "Finaliza" . "<br>";
}

function localizaSolicitudPortelefono($telefono)
{
  $db = DBManagerFactory::getInstance();

  if (trim($telefono) == "") {
    return "";
  }

  $query = 'SELECT s.id ';
  $query .= 'FROM expan_solicitud s ';
  $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($telefono) . "' OR ";
  $query = $query . "trim(phone_mobile)='" . trim($telefono) . "' OR ";
  $query = $query . "trim(phone_other)='" . trim($telefono) . "' OR ";
  $query = $query . "trim(phone_work)='" . trim($telefono) . "' OR ";
  $query = $query . "skype='" . trim($telefono) . "')";

  echo $query . "<br>";

  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Consulta-" . $query);

  $result = $db->query($query, true);
  $idSol = '';

  while ($row = $db->fetchByAssoc($result)) {
    $idSol = $row["id"];
    $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Bucle ENtra-" . $idSol);
  }

  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]idSol-" . $idSol);

  return $idSol;
}

function crearLLamadaGest($gestion,$telefono,$fecha,$hora){

  $GLOBALS['log']->info("[ExpandeNegocio][procesarGoogleForms][crearLLamadaGest]Inicio");
  $llamada = new Call();

  //Doy atributos
  if ($gestion->assigned_user_id == null) {
    global $current_user;
    $llamada->assigned_user_id = $current_user->id;
  } else {
    $llamada->assigned_user_id = $gestion->assigned_user_id;
  }

  $llamada->duration_minutes = 15;
  $llamada->date_entered = TimeDate::getInstance()->getNow()->asDb();

  $llamada->status = 'Planned';
  //$llamada->description='Una descripcion';
  $llamada->parent_id = $gestion->id;
  $llamada->parent_type = 'Expan_GestionSolicitudes';
  $llamada->reminder_time = -1;
  $llamada->created_by='1';
  $llamada->modified_user_id='1';

  $llamada->direction = 'Outbound';
  $llamada->telefono = $telefono;
  $llamada->call_type = 'PetLlamada';
  $llamada->created_by = 1;
  $llamada->franquicia = $gestion->franquicia;
  $llamada->origen = $gestion->tipo_origen;
  $llamada->save();

  //Actualizamos la hora
  $db = DBManagerFactory::getInstance();

  $id=$llamada->id;
  $date=$fecha.' '.$hora;

  $query = "update calls set date_start=str_to_date('$date','%Y-%m-%d %H:%i') where id='$id'";

  $db -> query($query, true);

}