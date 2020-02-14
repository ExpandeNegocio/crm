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
require_once ('modules/Expan_Solicitud/Expan_Solicitud_sugar.php');
require_once ('modules/Calls/Call.php');
class Expan_Solicitud extends Expan_Solicitud_sugar {
    
      const TIPO_ORIGEN_CENTRAL='4';
      const TIPO_ORIGEN_EXPANDENEGOCIO='1';
      const TIPO_ORIGEN_EVENTOS='3';
      const TIPO_ORIGEN_PORTALES='2';
      const TIPO_ORIGEN_MAILING='6';
      const TIPO_ORIGEN_MEDIOS_COMUN='5';

    function Expan_Solicitud() {
        parent::Expan_Solicitud_sugar();
    }      

    function NumGestiones() {
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][NumHermanas]Solicitud ID' . $this -> id);

        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT count(*) num ";
        $query=$query."FROM   expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND g.deleted=0 and gs.deleted=0 and gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '". $this -> id ."'";
        
        $result = $db -> query($query, true);
        $num = 0;

        while ($row = $db -> fetchByAssoc($result)) {
            $num = $row["num"];
        }
        return $num;

    }

    function NumGestionesEstado($estado) {
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][NumHermanas]Solicitud ID' . $this -> id);

        $db = DBManagerFactory::getInstance();
        $query = "SELECT count(*) num ";
        $query=$query."FROM   expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND g.deleted=0 and gs.deleted=0 and gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '". $this -> id ."' AND g. ";
        $query=$query."       estado_sol = '".$estado."'";
        
        $result = $db -> query($query, true);
        $num = 0;

        while ($row = $db -> fetchByAssoc($result)) {
            $num = $row["num"];
        }
        return $num;

    }
    
    function AgruparLLamadas($estado,$call_type){
                
        if (in_array($call_type, $GLOBALS['app_list_strings']['tipo_llamada_list'])){
            $nomLLamada = $GLOBALS['app_list_strings']['tipo_llamada_list'][$call_type];                       
        }else{
            $nomLLamada = "Llamada sin definir";
        }                
        
        $db = DBManagerFactory::getInstance();

        $query = "update calls c  ";
        $query=$query." JOIN (SELECT g.id ,trim(concat(COALESCE(s.first_name,''),' ',COALESCE(s.last_name,''))) name ";
        $query=$query."             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."             WHERE  g.id = gs.expan_soli5dcccitudes_idb  AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida  ";
        $query=$query."                    AND s.id = '" . $this -> id . "') t  ";
        $query=$query."         ON c.parent_id = t.id  ";
        $query=$query."set c.name=concat(t.name,' - Gestion Agrupada - ','".$nomLLamada."'), c.gestion_agrupada=1 ";
        $query=$query."where status='".$estado."' AND call_type='".$call_type."' ; ";
        
        $result = $db -> query($query);        
    }
 
    //Vemos si no hemos lccalizado al solicitante en alguna gestión para una solicitud
    function TieneGestionNoLocalizado() {

        $db = DBManagerFactory::getInstance();
        $query = "select count(*) num from  expan_solicitud_expan_gestionsolicitudes_1_c gs,";
        $query .= "expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g";
        $query .= "WHERE g.deleted=0 AND gs.deleted=0 AND g.id = gs.expan_soli5dcccitudes_idb AND g.estado_sol=".Expan_GestionSolicitudes::ESTADO_DESCARTADO." AND ";
        $query .= "gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ='" . $this -> id . "'";

        $result = $db -> query($query, true);
        $num = 0;

        while ($row = $db -> fetchByAssoc($result)) {
            $num = $row["num"];
        }
        return $num;
    }

    function PasarGestionesSubEstado($estado,$subestado) {

        $db = DBManagerFactory::getInstance();

        $query = "SELECT g.id ";
        $query = $query . "FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "WHERE g.deleted=0 and gs.deleted=0 AND g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "AND s.id = '" . $this -> id . "'";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][PasarGestionesEstado]Query' . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][PasarGestionesEstado]Gestion Id' . $this -> id);

            $idGest = $row["id"];

            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($idGest);
            
            switch ($estado) {
                case Expan_GestionSolicitudes::ESTADO_PARADO:
                    
                    $gestion->motivo_parada=$subestado;
                    break;
                    
                case Expan_GestionSolicitudes::ESTADO_DESCARTADO:
                
                    $gestion->motivo_descarte=$subestado;
                    break;
                
                case Expan_GestionSolicitudes::ESTADO_POSITIVO:
                    
                    $gestion->motivo_positivo=$subestado;
                    break;
            }

            $gestion -> estado_sol = $estado;

            $gestion -> ignore_update_c = true;
            $gestion -> save();

        }

    } 

    //Recoge una gestion por id Franquicia

    function getGestionFromFranID($franID) {           
              
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][getGestionFromFranID]Intenta RecogerFranquicia');
        
        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][getGestionFromFranID]franquicia' . $gestion -> franquicia);

            if ($gestion -> franquicia == $franID) {
                echo "Encuentra Gestion" ."<br>";
                return $gestion;
            }
        }
        return null;

    }

    function recogeTelefono() {

        $telefono = "";

        if ($this -> phone_work != "") {
            $telefono = $this -> phone_work;
        }
        if ($this -> phone_home != "") {
            $telefono = $this -> phone_home;
        }
        if ($this -> phone_mobile != "") {
            $telefono = $this -> phone_mobile;
        }

        return $telefono;

    }

    //Elimina las llamadas de una solicitud en determinado estado
    function EliminarLLamadas($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set deleted=1 ";
        $query = $query . "where status='" . $status . "'; ";

        $result = $db -> query($query);

    }
    
        //Elimina las llamadas de una solicitud en determinado estado
    function EliminarTareas($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update tasks t ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND s.id = '" . $this -> id . "') p ";
        $query = $query . "         ON t.parent_id = p.id ";
        $query = $query . "set deleted=1 ";
        $query = $query . "where status='" . $status . "'; ";

        $result = $db -> query($query);

    }

    function EliminarTodasLLamadas() {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set deleted=1 where status = 'Planned'";

        $result = $db -> query($query);

    }

    function EliminarTodasTareas() {

        $db = DBManagerFactory::getInstance();

        $query = "update tasks c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                   AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set deleted=1 where status='Not Started'";

        $result = $db -> query($query);

    }

    //Archivamos las llamadas de una solicitud en un determinado status
    function ArchivarLLamadas($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set c.status='Archived' ";
        $query = $query . "where status='" . $status . "'; ";

        $result = $db -> query($query);
    }
    
    //Archivamos las tareas de una solicitud en un determinado status
    function ArchivarTareas($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update tasks t ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND s.id = '" . $this -> id . "') p ";
        $query = $query . "         ON c.parent_id = p.id ";
        $query = $query . "set c.status='Deferred' ";
        $query = $query . "where status='" . $status . "'; ";

        $result = $db -> query($query);
    }
    

    function ArchivarLLamadasPrevias($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND g.deleted=0 AND gs.deleted=0 AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set c.status='Archived' ";
        $query = $query . "where c.date_start < CURRENT_DATE() AND status='" . $status . "'; ";

        $result = $db -> query($query);
    }

    function CambiarEstadoLLamadas($status, $SoloAgrupadas) {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c ";
        $query = $query . " JOIN (SELECT g.id ";
        $query = $query . "             FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "             WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query = $query . "                    AND g.deleted=0 AND gs.deleted=0 AND s.id = '" . $this -> id . "') t ";
        $query = $query . "         ON c.parent_id = t.id ";
        $query = $query . "set status='" . $status . "' ";
        if ($SoloAgrupadas == true) {
            $query = $query . "where gestion_agrupada=1 and status='Planned'";
        }

        $result = $db -> query($query);
    }
    
    public function ProcesarLLamadasAgrupadas($llamadaOrigen,$franquicia,$gestion,$solicitud,$prevStatus,$newStatus){
        
        $db = DBManagerFactory::getInstance();
        
        //Recorremos todas las llamadas agrupadas de la solicitud excepto la 
        $query = "SELECT c.id cid,g.id gid ";
        $query = $query."FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, calls c ";
        $query = $query."WHERE  c.parent_id = g.id AND g.id = gs.expan_soli5dcccitudes_idb AND g.deleted=0 AND c.deleted=0 AND s.id = ";
        $query = $query."gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.id = '".$this->id."' AND gestion_agrupada=1 AND c.status='Planned' AND ";
        $query = $query."c.parent_type='Expan_GestionSolicitudes' and c.deleted=0 AND g.deleted=0 and gs.deleted=0 ";
        $query = $query."UNION select '".$llamadaOrigen->id."' cid,'".$gestion->id."' gid from dual";
        
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
                                                                                 
            $Llamada=new Call();
            $Llamada->retrieve($row["cid"]);
            
            $Llamada->procesarLLamadaModificada($gestion,$solicitud,$prevStatus,$newStatus);
            $Llamada->procesarLLamadaFinal($franquicia,$gestion,$solicitud);
               
        }         
    }

    function EsAbierta() {

        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
            if ($gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO || 
                $gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO) {
                return true;
            }
        }
        return false;
    }

    function EnEspera() {

        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        $NumEspera = 0;
        $NumTotal = 0;
        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
            if ($gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO) {
                $NumEspera++;
            }
            $NumTotal++;
        }
        if ($NumEspera == $NumTotal) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function EsCerrada() {

        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        $NumEspera = 0;
        $NumTotal = 0;
        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
            if ($gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO) {
                $NumEspera++;
            }
            $NumTotal++;
        }
        if ($NumEspera == $NumTotal) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function EsPositiva() {

        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
            if ($gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO) {
                return true;
            }
        }
        return false;

    }

    function EliminarGestiones() {
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][EliminarGestiones]Eliminamos gestiones de la solicitud' . $this -> id);
        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][EliminarGestiones]Eliminamos gestiones ' . $gestion -> id);
            $gestion -> deleted = 1;
            $gestion->ignore_update_c=true;
            $gestion -> save();
        }

        $this -> EliminarTodasLLamadas();
        $this -> EliminarTodasTareas();
    }

    function actualizaRating(){

      $rating=1000;

      $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

      foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
        if ($gestion -> estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO && $gestion->rating<$rating) {
          $rating=$gestion->rating;
        }
      }
      if ($rating!=1000){
        $this->rating=$rating;
      }
    }

    function actualizaEstadoAECP() {
        //Actualizamos los estados de las solicitudes

        if ($this -> EsAbierta()) {
            $this -> abierta = 1;
        } else {
            $this -> abierta = 0;
        }

        if ($this -> EnEspera()) {
            $this -> espera = 1;
        } else {
            $this -> espera = 0;
        }

        if ($this -> EsCerrada()) {
            $this -> cerrada = 1;
        } else {
            $this -> cerrada = 0;
        }

        if ($this -> EsPositiva()) {
            $this -> positiva = 1;
        } else {
            $this -> positiva = 0;
        }
    }

    function tieneLlamadasPendientes() {

        $llamadasAbiertas = false;

        $db = DBManagerFactory::getInstance();
        $query = "select *  ";
        $query = $query . "from  expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, calls c ";
        $query = $query . "where g.id = gs.expan_soli5dcccitudes_idb  AND ";
        $query = $query . "c.parent_id=g.id  AND c.deleted =0 AND c.status='Planned' AND gs.deleted=0 AND g.deleted=0 AND ";
        $query = $query . "gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '" . $this -> id . "' ; ";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $llamadasAbiertas = true;
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]Salida-'.$llamadasAbiertas);

        return $llamadasAbiertas;
    }
    
    function tieneReunionesPendientes() {

        $reunionesAbiertas = false;

        $db = DBManagerFactory::getInstance();
        $query = "select *  ";
        $query = $query . "from  expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, meetings m ";
        $query = $query . "where g.id = gs.expan_soli5dcccitudes_idb  AND ";
        $query = $query . "m.parent_id=g.id  AND m.deleted =0 AND (m.status='Planned' OR m.status='Could') AND gs.deleted=0 AND g.deleted=0 AND ";
        $query = $query . "gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '" . $this -> id . "' ; ";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneReunionesPendientes]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $reunionesAbiertas = true;
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneReunionesPendientes]Salida-'.$reunionesAbiertas);

        return $reunionesAbiertas;
    }

    function tieneTareasPendientes() {

        $tareasPendientes = false;

        $db = DBManagerFactory::getInstance();
        
        $query = "select *  ";
        $query = $query . "from  expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, tasks t ";
        $query = $query . "where g.id = gs.expan_soli5dcccitudes_idb  AND ";
        $query = $query . "t.parent_id=g.id  AND t.deleted =0 AND t.status='Not Started' AND gs.deleted=0 AND g.deleted=0 AND ";
        $query = $query . "gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '" . $this -> id . "' ; ";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneTareasPendientes]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $tareasPendientes = true;
        }
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneTareasPendientes]Salida-'.$tareasPendientes);

        return $tareasPendientes;
    }

    function localizaGestion($idFran) {

        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
            if ($gestion -> franquicia == $idFran) {
                return $gestion;
            }
        }
        return null;

    }

    function isPrincipalCerrada() {

        $principalCerrada = false;

        $db = DBManagerFactory::getInstance();

        $query = "SELECT ";
        $query = $query . "  * ";
        $query = $query . "FROM ";
        $query = $query . "  expan_gestionsolicitudes g, ";
        $query = $query . "  expan_solicitud s, ";
        $query = $query . "  expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query = $query . "WHERE ";
        $query = $query . "  s.id='" . $this -> id . "' AND  ";
        $query = $query . "  g.id = gs.expan_soli5dcccitudes_idb AND ";
        $query = $query . "  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND gs.deleted=0 AND g.deleted=0 AND ";
        $query = $query . "  s.franquicia_principal=g.franquicia AND (g.estado_sol='".Expan_GestionSolicitudes::ESTADO_DESCARTADO."' OR  g.estado_sol='".Expan_GestionSolicitudes::ESTADO_PARADO."'); ";

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $principalCerrada = true;
        }

        return $principalCerrada;

    }

    function pasaFranqiciaPrincipal() {

        if ($this -> isPrincipalCerrada()) {

            $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
            $nueFranPrin=null;
            
            foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestionHija) {
                if ($gestionHija -> estado_sol != Expan_GestionSolicitudes::ESTADO_DESCARTADO &&
                    $gestionHija -> estado_sol != Expan_GestionSolicitudes::ESTADO_PARADO) {                        
                    $nueFranPrin=$gestionHija -> franquicia;
                }
            }
            if ($nueFranPrin!=null){
                $this -> franquicia_principal = $nueFranPrin;
            }
            
        }

    }
    
    function recogerTelefono() {

        $telefono = '';

        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]Solicitud ID' . $this -> id);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_mobile-' . $this -> phone_mobile);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_home-' . $this -> phone_home);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_work-' . $this -> phone_work);

        if ($this -> phone_mobile != null && trim($this -> phone_mobile) != '') {
            $telefono = $this -> phone_mobile;
        }
        if ($this -> phone_home != null && trim($this -> phone_home) != '') {
            $telefono = $this -> phone_home;
        }
        if ($this -> phone_work != null && trim($this -> phone_work) != '') {
            $telefono = $this -> phone_work;
        }

        return $telefono;
    }
    
   public function _create_proper_name_field() {
        parent::_create_proper_name_field();
        if ($this->tipo_origen=='^1^'){
             $this->suborigen=$GLOBALS["app_list_strings"]["subor_expande_list"][$this->subor_expande];
         } else if ($this->tipo_origen=='^2^'){
             $this->suborigen= $GLOBALS["app_list_strings"]["portal_list"][$this->portal];
         } else if ($this->tipo_origen=='^3^'){
             $this->suborigen=$GLOBALS["app_list_strings"]["eventos_list"][$this->expan_evento_id_c];
         } else if ($this->tipo_origen=='^4^'){
             $this->suborigen=$GLOBALS["app_list_strings"]["subor_central_list"][$this->subor_central];
         } else if ($this->tipo_origen=='^5^'){
             $this->suborigen=$GLOBALS["app_list_strings"]["subor_medios_list"][$this->subor_medios];
         } else if ($this->tipo_origen=='^6^'){
             $this->suborigen=$GLOBALS["app_list_strings"]["subor_mailing_list"][$this->subor_mailing];
         }else{
             $this->suborigen='Varios Origenes';
         }
       
    }

    function tieneCorreo() {
        //Controlamos si una solicitud tiene correos

        $ltieneCorreo = false;

        $db = DBManagerFactory::getInstance();
        $query = "select * from expan_solicitud s,email_addr_bean_rel r,email_addresses e ";
        $query = $query . "where s.id = r.bean_id AND e.id = r.email_address_id AND e.deleted = 0 AND e.deleted=0 AND r.deleted=0 AND s.deleted = 0 AND s.id='" . $this -> id . "'";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_solicitud][TieneCorreo]-' . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {

            $ltieneCorreo = true;
        }

        return $ltieneCorreo;

    }
    
    //Recoge la lista de correos de la 
    function getCorreos() {

        $listaCorreo = array();

        $db = DBManagerFactory::getInstance();
        $query = "select e.email_address from expan_solicitud s,email_addr_bean_rel r,email_addresses e ";
        $query = $query . "where s.id = r.bean_id AND e.id = r.email_address_id AND r.deleted=0 AND e.deleted = 0 AND s.deleted = 0 AND s.id='" . $this -> id . "'";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_solicitud][TieneCorreo]-' . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
                
            $listaCorreo[] = $row["email_address"];           
        }

        return $listaCorreo;

    }

    function getCorreoPrincipal() {

        $listaCorreo = array();

        $db = DBManagerFactory::getInstance();
        $query = "select e.email_address from expan_solicitud s,email_addr_bean_rel r,email_addresses e ";
        $query = $query . "where r.primary_address=1 AND s.id = r.bean_id AND e.id = r.email_address_id AND r.deleted=0 AND e.deleted = 0 AND s.deleted = 0 AND s.id='" . $this -> id . "'";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_solicitud][TieneCorreo]-' . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
                
            $listaCorreo[] = $row["email_address"];           
        }

        return $listaCorreo;

    }

    function calcularOportunidadInmediata(){
            
        if ($this->gestionesInmediatas()==true){
           
            $this->oportunidad_inmediata=true;             
        }else{
            $this->oportunidad_inmediata=false;             
        }
        
        $this->ignore_update_c = true;
        $this->save();
                                  
    } 
  
    public function gestionesInmediatas(){
                
        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT oportunidad_inmediata ";
        $query=$query."FROM   expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND g.deleted=0 and gs.deleted=0 and gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '". $this -> id ."'";
        
        $result = $db -> query($query, true);
        $inmediata = false;

        while ($row = $db -> fetchByAssoc($result)) {
            if ($row["oportunidad_inmediata"]==1){
                $inmediata=true;
            }
        }
        return $inmediata;
        
    }

    
        //Buscará si el municipio entra dentro de la zona que la franquicia puede abrir
    //por las condiciones de la franquicia

    function puedeAbrirZona() {
        return true;
    }

    //Buscará si el municipio esta o no en zona ocupada
    function zonaOcupada() {
        return false;
    }
    
    function getListaTelefono() {

        $phone_list = array();

        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]Solicitud ID' . $this -> id);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_mobile-' . $this -> phone_mobile);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_mobile-' . $this -> phone_home);
        $GLOBALS['log'] -> info('[ExpandeNegocio][RecogerTelefono]phone_mobile-' . $this -> phone_work);

        if ($this -> phone_mobile != null && trim($this -> phone_mobile) != '') {
            $phone_list[] = str_replace(" ", "", $this -> phone_mobile);
        }
        if ($this -> phone_home != null && trim($this -> phone_home) != '') {
            $phone_list[] = str_replace(" ", "", $this -> phone_home);
        }
        if ($this -> phone_work != null && trim($this -> phone_work) != '') {
            $phone_list[] = str_replace(" ", "", $this -> phone_work);
        }
        return $phone_list;
    }
    
    function removeSol(){        
        
        $this->EliminarGestiones();        
        $this->deleted=true;
        $this->ignore_update_c=true;
        $this->save();
    }

    function getNewOrigen($origenAnt){
                                        
        $origenAnt = str_replace('^', '', $origenAnt);
                       
        $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Solicitud] Origen Ant - '.$origenAnt);
        
        $listaAnt = split(',', $origenAnt);

        $origenAct = str_replace('^', '', $this->tipo_origen);
        $listaAct = split(',', $origenAct);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Solicitud] Origen Act - '.$origenAct);
                               
        $listaDif=array_diff($listaAct, $listaAnt);
        
        $origen=-1;
                                          
        foreach ($listaDif as $ori){
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Solicitud] Nuevos origenes - '.$ori);
            $origen=$ori;
        }      
        
        if ($origen==-1){
            $origen =$listaAct[0];
        }      
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Solicitud] Origen final - '.$origen);
        
        return $origen;
    }   
    
    function actualizarEntrevista($fecha){
        
        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
           
            $gestion -> chk_entrevista = 1;
            if ($gestion -> f_entrevista==null){                
                $gestion -> f_entrevista=$fecha;
            }            
            $gestion->ignore_update_c=true;
            $gestion -> save();
        }
        
    }  
    
    function getFranquiciado(){
        
        $db = DBManagerFactory::getInstance();
        
        $salida="";
        
        $sql="SELECT id as idF FROM expan_franquiciado ";           
        $sql=$sql." WHERE solicitud_id='".$this->id."' AND deleted=0;";
         
        $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - '.$sql); 
         
        $resultSol = $db->query($sql, true);
        
        while ($rowSol = $db->fetchByAssoc($resultSol)){                     
            $salida=$rowSol["idF"];
        }
        
        return $salida;
    }
    
    public function actualizarEntrevistaPrevia(){
        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
    
        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
           
            $gestion -> chk_entrevista_previa = 1;
            $gestion-> usuario_entrevista_previa = $this->usuario_entrevista_previa_cliente;
              
            $gestion->ignore_update_c=true;
            $gestion -> save();
        }
    }     
}
?>