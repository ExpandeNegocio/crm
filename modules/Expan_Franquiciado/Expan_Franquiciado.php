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
require_once('modules/Expan_Franquiciado/Expan_Franquiciado_sugar.php');
require_once('modules/Expan_Solicitud/Expan_Solicitud.php');

class Expan_Franquiciado extends Expan_Franquiciado_sugar
{

  function __construct()
  {
    parent::Expan_Franquiciado_sugar();
  }

  /*   function existeFranquiciado($solId) {

         $db = DBManagerFactory::getInstance();

         $query = "SELECT f.id AS idF ";
         $query=$query."FROM   expan_franquiciado f, expan_solicitud s ";
         $query=$query."WHERE  s.id = '" . $solId . "' AND (f.phone_home = s.phone_home OR f.phone_home = s.phone_mobile OR f. ";
         $query=$query."       phone_mobile = ";
         $query=$query."       s.phone_home OR f.phone_mobile = s.phone_mobile) AND f.deleted = 0; ";


         $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Franquiciado] Consulta'.$query);

         $result = $db -> query($query);

         while ($row = $db -> fetchByAssoc($result)) {
             $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Franquiciado] Entra Bucle-'.$row["idF"]);
             return $row["idF"];
         }
         return false;
     }*/

  static function existeFranquiciado($solId)
  {

    $db = DBManagerFactory::getInstance();

    $solicitud = new Expan_Solicitud();
    $solicitud->retrieve($solId);

    $query = "SELECT * ";
    $query = $query . "FROM expan_franquiciado  ";
    $query = $query . "WHERE deleted = 0; ";

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] Consulta' . $query);

    $result = $db->query($query);

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] Telefonos Solicitud -Phone Home-'.$solicitud->phone_home."-Phone Movile-". $solicitud->phone_mobile);

    while ($row = $db->fetchByAssoc($result)) {

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] Entra Bucle-' . $row["idF"]."-Phone Home-".$row["phone_home"]."-Phone Movile-". $row["phone_mobile"]);

      if (($solicitud->phone_home == $row["phone_home"] && $solicitud->phone_home!="" && $solicitud->phone_home!=null ) ||
          ($solicitud->phone_home == $row["phone_mobile"] && $solicitud->phone_home!="" && $solicitud->phone_home!=null) ||
          ($solicitud->phone_mobile == $row["phone_home"] && $solicitud->phone_mobile!="" && $solicitud->phone_mobile!=null) ||
          ($solicitud->phone_mobile == $row["phone_mobile"] && $solicitud->phone_mobile!="" && $solicitud->phone_mobile!=null)) {
        $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] #Encontrado#');
        return $row["id"];
      }
    }
    return false;
  }

  public static function crearFranquiciado($solicitud, $origen = 0)
  {

    $franquiciado = new Expan_Franquiciado();
    $franquiciado->date_entered = TimeDate::getInstance()->getNow()->asDb();
    $franquiciado->first_name = $solicitud->first_name;
    $franquiciado->last_name = $solicitud->last_name;
    $franquiciado->salutation = $solicitud->salutation;
    $franquiciado->phone_home = $solicitud->phone_home;
    $franquiciado->phone_mobile = $solicitud->phone_mobile;
    $franquiciado->no_correos = $solicitud->no_correos;
    $franquiciado->no_newsletter = $solicitud->no_newsletter;
    $franquiciado->skype = $solicitud->skype;

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] email1' . $solicitud->email1);
    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] email2' . $solicitud->email2);

    $franquiciado->pais = $solicitud->pais_c;
    $franquiciado->origen = $origen;

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] Antes nuevos campos');

    $franquiciado->provincia = $solicitud->provincia_apertura_1;
    $franquiciado->localidad = $solicitud->localidad_apertura_1;

    $franquiciado->sectores_historicos = $solicitud->sectores_historicos;
    $franquiciado->setAddress($solicitud);

    $franquiciado->solicitud_id = $solicitud->id;

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Franquiciado] Antes guardado');

    //guardar los cambios del franquiciado
    $franquiciado->ignore_update_c = true;
    $franquiciado->save();

    return $franquiciado;
  }

  public function setAddress($solicitud)
  {

    $this->emailAddress->addAddress($solicitud->email1, true);
    $this->emailAddress->addAddress($solicitud->email2, true);
    $this->emailAddress->save($this->id, $this->module_dir);
  }

  public function getEstado()
  {
    $db = DBManagerFactory::getInstance();

    $sql = "SELECT abierta FROM expan_apertura where deleted=0 and expan_franquiciado_id='" . $this->id . "'";

    $resultSol = $db->query($sql, true);

    while ($rowSol = $db->fetchByAssoc($resultSol)) {
      if ($rowSol["abierta"] == 1) {
        return "ON";
      }
    }
    return "EX";
  }
}