<?PHP
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/Expan_Apertura/Expan_Apertura_sugar.php');

class Expan_Apertura extends Expan_Apertura_sugar
{

  const ABIERTO_SI = 1;
  const ABIERTO_NO = 2;

  const TIPO_APERTURA_PROPIA=2;
  const TIPO_APERTURA_FRANQUICIADA=3;

  function __construct()
  {
    parent::Expan_Apertura_sugar();
  }

  static function PreparaApertura($name, $solicitud, $gestion)
  {
    if (Expan_Apertura::existeApertura($name) == false &&
      Expan_Apertura::franquiciaNoApertura($name) == false) { //no está creada la apertura

      $franquiciadoId = Expan_Franquiciado::existeFranquiciado($solicitud->id);

      $GLOBALS['log']->info('[ExpandeNegocio][PreparaApertura]Entra-'.$name);

      if ($franquiciadoId == false) {  //se crea el franquiciado a partir de la solicitud, no existe
        $GLOBALS['log']->info('[ExpandeNegocio][PreparaApertura]No existe el franquiciado');
        $franquiciado = Expan_Franquiciado::crearFranquiciado($solicitud, 4);
        $franquiciado->setAddress($solicitud);
      } else{
        $GLOBALS['log']->info('[ExpandeNegocio][PreparaApertura]Existe el franquiciado');
        $franquiciado = new Expan_Franquiciado();
        $franquiciado->retrieve($franquiciadoId);
      }
      Expan_Apertura::crearApertura($name, $gestion, $franquiciado);
    }
  }

  static function existeApertura($nombre)
  {

    $db = DBManagerFactory::getInstance();

    $query = "select id from expan_apertura where name='" . $nombre . "' and deleted=0; ";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }
    return false;
  }

  function franquiciaNoApertura($nombre)
  {
    $db = DBManagerFactory::getInstance();

    $query = "select franq_excep from w_fran_excep where ucase(franq_excep)='" . strtoupper($nombre) . "'";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }
    return false;
  }

  public static function crearApertura($nombre, $gestion, $franquiciado)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][crearApertura]Se crea apertura');

    $apertura = new Expan_Apertura();
    $apertura->name = $nombre;
    $apertura->date_entered = TimeDate::getInstance()->getNow()->asDb();
    $apertura->abierta = Expan_Apertura::ABIERTO_SI;
    $apertura->tipo_apertura = Expan_Apertura::TIPO_APERTURA_FRANQUICIADA;

    $solicitud = $gestion->GetSolicitud();

    if ($solicitud != null) {
      if ($solicitud->provincia_apertura_1 != null && $solicitud->provincia_apertura_1 != '') {
        $apertura->provincia_apertura = $solicitud->provincia_apertura_1;
      }
      if ($solicitud->localidad_apertura_1 != null && $solicitud->localidad_apertura_1 != "") {
        $apertura->localidad_apertura = $GLOBALS['app_list_strings']['municipios_list'][$solicitud->localidad_apertura_1];
      }
    }
    if ($gestion->estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO && ($gestion->motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_MISMO_SECTOR || $gestion->motivo_descarte == Expan_GestionSolicitudes::DESCARTE_FRANQUICIA_OTRO_SECTOR)) {
      $apertura->otra_franquicia = $gestion->franq_apertura_desca;
    } else {
      $apertura->franquicia = $gestion->franquicia;
    }
    $apertura->direccion = $solicitud->direccion_local;

    $apertura->gestion = $gestion->id;
    $apertura->solicitud = $solicitud->id;
    $apertura->expan_franquiciado_id = $franquiciado->id;
    $GLOBALS['log']->info('[ExpandeNegocio][crearApertura]Se guarda la apertura');
    $apertura->save();
  }

  static function PreparaAperuraCompetencia($solicitud, $gestion)
  {
    if ($gestion->franq_apertura_desca=="" || $gestion->franq_apertura_desca==null){
      $nomFran="Franquicia de la competencia";
    }
    else{
      $nomFran=$gestion->franq_apertura_desca;
    }
    $name = $solicitud->first_name . " " . $solicitud->last_name . "-".$nomFran;

    $franquiciado_id = Expan_Franquiciado::existeFranquiciado($solicitud->id);
    if ($franquiciado_id == false) { //se crea el franquiciado
      $franquiciado = Expan_Franquiciado::crearFranquiciado($solicitud, Expan_Franquiciado::ORIGEN_CADENA_NO_EN);
      $franquiciado->setAddress($solicitud);
    }else{
      $franquiciado = new Expan_Franquiciado();
      $franquiciado->retrieve($franquiciado_id);
    }

    if (Expan_Apertura::existeApertura($name) == false &&
      Expan_Apertura::franquiciaNoApertura($gestion->name) == false) {
      Expan_Apertura::crearApertura($name, $gestion, $franquiciado);
    }
  }

  function aperturaRepetida($provincia, $franquicia, $otraFran,$aperturaId)
  {

    $db = DBManagerFactory::getInstance();

    $query = "SELECT id ";
    $query=$query."FROM   expan_apertura ";
    $query=$query."WHERE  provincia_apertura = '$provincia' AND id <> '$aperturaId' AND (franquicia = '$franquicia' OR (otra_franquicia = '$otraFran' ";
    $query=$query."       AND otra_franquicia <> '')) AND deleted = 0 ";

    $GLOBALS['log']->info('[ExpandeNegocio][crearApertura]Consulta-' . $query);

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }
    return false;
  }

  function crearAperturaOtraFran($franquicia, $franquiciado, $solicitud)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][crearApertura]Se crea apertura');

    $apertura = new Expan_Apertura();

    $apertura->name = $solicitud->first_name . " " . $solicitud->last_name . " - " . $franquicia;
    $apertura->date_entered = TimeDate::getInstance()->getNow()->asDb();
    $apertura->abierta = Expan_Apertura::ABIERTO_SI;
    $apertura->tipo_apertura = TIPO_APERTURA_FRANQUICIADA::TIPO_APERTURA_FRANQUICIADA;

    if ($solicitud != null) {
      if ($solicitud->provincia_apertura_1 != null && $solicitud->provincia_apertura_1 !="") {
        $apertura->provincia_apertura =$solicitud->provincia_apertura_1;
      }
      if ($solicitud->localidad_apertura_1 != null && $solicitud->localidad_apertura_1 != "") {
        $apertura->localidad_apertura = $GLOBALS['app_list_strings']['municipios_list'][$solicitud->localidad_apertura_1];
      }
    }

    $apertura->otra_franquicia = $franquicia;

    $apertura->direccion = $solicitud->direccion_local;
    $apertura->expan_franquiciado_id = $franquiciado->id;
    $apertura->solicitud = $solicitud->id;

    $GLOBALS['log']->info('[ExpandeNegocio][crearApertura]Antes del guardado de la apertura-' . $apertura->name);
    $apertura->save();
  }

  function crearTablaEntregaCuentaContrato($esAdmin)
  {

    if ($esAdmin) {
      $campos = array("Nombre" => "<b>Nombre</b>", "Apellidos" => "<b>Apellidos</b>", "Franquicia" => "<b>Franquicia</b>", "ImporteEnt" => "<b>Importe Entregado</b>", "FEnt" => "<b>Fecha de la Entrega</b>");
    } else {
      $campos = array("Nombre" => "<b>Nombre</b>", "Apellidos" => "<b>Apellidos</b>", "Provincia" => "<b>Provincia</b>", "FEnt" => "<b>Fecha de la Entrega</b>",);
    }

    $query = "SELECT first_name Nombre, last_name Apellidos, f.name franquicia, f_entrega_cuenta_cont FEnt, entrega_cuenta ImporteEnt  ";
    $query = $query . "from ( ";
    $query = $query . "select s.first_name, s.last_name, g.franquicia, a.f_entrega_cuenta_cont, a.entrega_cuenta  ";
    $query = $query . "from expan_apertura a, expan_gestionsolicitudes g,  expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id= a.gestion ";
    $query = $query . "and a.id='" . $this->id . "') b ";
    $query = $query . "LEFT JOIN expan_franquicia f ON f.id = b.franquicia ; ";

    $db = DBManagerFactory::getInstance();

    $result = $db->query($query, true);
    $tabla = '<table border="1">
                <tbody>';

    while ($row = $db->fetchByAssoc($result)) {
      foreach ($campos as $key => $value) {
        $tabla = $tabla . "<tr>";
        $tabla = $tabla . "<td>" . $value . "</td>";
        $tabla = $tabla . "<td>" . $row[$key] . "</td>";
        $tabla = $tabla . "</tr>";
      }
    }

    $tabla = $tabla . "</tbody>
        </table>";
    return $tabla;
  }
}