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
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes_sugar.php');
require_once ('custom/include/EnvioAutoCorreos.php');
class Expan_GestionSolicitudes extends Expan_GestionSolicitudes_sugar {
           
    const ESTADO_NO_ATENDIDO='1';
    const ESTADO_EN_CURSO='2';
    const ESTADO_PARADO='3';
    const ESTADO_DESCARTADO='4';
    const ESTADO_POSITIVO='5';
    
    const TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO='7';
    
    const TIPO_ORIGEN_CENTRAL='4';
    const TIPO_ORIGEN_EXPANDENEGOCIO='1';
    const TIPO_ORIGEN_EVENTOS='3';
    const TIPO_ORIGEN_PORTALES='2';
    const TIPO_ORIGEN_MAILING='6';
    const TIPO_ORIGEN_MEDIOS_COMUN='5';
    
    const PARADA_POR_PROTOCOLO='1';
    
    const PARADA_ZONA_NO_INTERES='51';
    const PARADA_EXCLIENTE='52';
    const PARADA_NO_LOCALIZADO='53';
    const PARADA_DATOS_ERRORNEOS='54';
    
    const PARADA_CANDIDATO_PERSONAL='11';
    const PARADA_CANDIDATO_NEGOCIO='12';
    const PARADA_CANDIDATO_FINANCIACION='13';
    const PARADA_CANDIDATO_LOCAL='14';
    
    const DESCARTE_CANDIDATO_TOPO='5';    
    const DESCARTE_PERSONAL='14';
    const DESCARTE_FRANQUICIA_MISMO_SECTOR='26';
    const DESCARTE_FRANQUICIA_OTRO_SECTOR='27';
    const DESCARTE_OTROS='99';
    
    const POSITIVO_PRECONTRATO='Pre';
    const POSITIVO_FRANQUICIADO='Cont';
    const POSITIVO_COLABORACION='Col';    
    
    const SUBESTADO_='';
    const SUBESTADO_CENTRAL='Visita Central';
    const SUBESTADO_ENVIO_CONTRATO='Envio Contrato';
    const SUBESTADO_VISITA_LOCAL='Informacion local';
    const SUBESTADO_PRECONTRATO='Precontrato';
    const SUBESTADO_VISITA_FRANQ='Visita franquiciado';
    const SUBESTADO_ENTREVISTA='Entrevista';
    const SUBESTADO_INFOR_ADICIO='Informacion Adicional';
    const SUBESTADO_CUESTIONARIO='Cuestionario';
    const SUBESTADO_PRI_DUDAS='Primeras Dudas';
    const SUBESTADO_SOL_AMP='Solicitud info';
    const SUBESTADO_RESPON_C1='Responde C1';
    const SUBESTADO_ENVIO_DOC='Envio Doc';
    
	
	function Expan_GestionSolicitudes(){	
		parent::Expan_GestionSolicitudes_sugar();
	}
    
    function GetSolicitud(){
            
        $this -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

        $solicitud = null;
        foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $sol) {
            $solicitud = $sol;
            return $solicitud;
        }
        
        return $solicitud;
    }
    
    function archivarLLamadas(){
        
        //archivamos todas las llamadas de una gestion
        $db = DBManagerFactory::getInstance();
            
            $query= " update calls c JOIN (SELECT c.id ";
            $query=$query. " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs "; 
            $query=$query. " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '".$this->id."' "; 
            $query=$query. " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Planned' and g.deleted=0) t "; 
            $query=$query. " ON c.id = t.id set c.status='Archived'; ";
            
            $result = $db -> query($query);
        
    }
    
    function archivarTareas(){
        
        $db = DBManagerFactory::getInstance();
        
        $query="update tasks t join (select t.id FROM tasks t, expan_gestionsolicitudes g, expan_gestionsolicitudes_tasks_1_c gt where "; 
        $query=$query. " t.id=gt.expan_gestionsolicitudes_tasks_1tasks_idb and "; 
        $query=$query. " gt.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida=g.id and g.id='".$this->id."' and "; 
        $query=$query. " (t.status='Not Started') and t.deleted=0) b on t.id=b.id set t.status='Deferred';";
        
        $result = $db -> query($query);
                
    }
    
    function archivarReuniones(){
                       
        $db = DBManagerFactory::getInstance();
                
        $query ="update meetings m join (select m.id from expan_gestionsolicitudes g, expan_gestionsolicitudes_meetings_1_c gm, meetings m ";
        $query=$query. " where g.id=gm.expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida and "; 
        $query=$query. " gm.expan_gestionsolicitudes_meetings_1meetings_idb=m.id and g.id='".$this->id."' and "; 
        $query=$query. " (m.status='Not Started' or m.status='Could') and m.deleted = 0 ";
        $query=$query. " ) b on m.id=b.id set m.status='Archived';";     
        
        $result = $db -> query($query);
           
    }
    
    
    
   function archivarLLamadasPrevias(){
          //archivamos todas las llamadas de una gestion que se crean de forma automática
          
            $db = DBManagerFactory::getInstance();
            
            $query= " update calls c JOIN (SELECT c.id ";
            $query=$query. " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs "; 
            $query=$query. " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '".$this->id."' "; 
            $query=$query. " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Planned' and (c.call_type='Primera' or "; 
            $query=$query. " c.call_type='ResPriDuda' or c.call_type='InformacionAdicional' or c.call_type='Cuestionario' or c.call_type='VisitaF' or "; 
            $query=$query. " c.call_type='SegPre' or c.call_type='Locales' or c.call_type='Contrato') and g.deleted=0) t "; 
            $query=$query. " ON c.id = t.id set c.status='Archived'; ";
            
            $result = $db -> query($query);
  
    }
   
    function asociarLLamadas($status, $user) {

        $this -> load_relationship('expan_gestionsolicitudes_calls_1');

        foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar LLamadas] LLamada -' . $llamada -> id);
            if ($llamada -> status == $status) {
                $llamada -> assigned_user_id = $user;
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar LLamadas] Usuario-' . $user);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar LLamadas] Antes de guardar');
                $llamada -> ignore_update_c = true;
                $llamada -> save();
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar LLamadas] Despues de guardar');
            }
        }

    }
    
    
    function asociarTareas($status, $user) {

        $this -> load_relationship('expan_gestionsolicitudes_tasks_1');

        foreach ($this->expan_gestionsolicitudes_tasks_1->getBeans() as $tarea) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Tareas] LLamada -' . $tarea -> id);
            if ($tarea -> status == $status) {
                $tarea -> assigned_user_id = $user;
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Tareas] Usuario-' . $user);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Tareas] Antes de guardar');
                $tarea -> save();
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Tareas] Despues de guardar');
            }
        }

    }
    
    function asociarReuniones($status, $user) {

        $this -> load_relationship('expan_gestionsolicitudes_meetings_1');

        foreach ($this->expan_gestionsolicitudes_meetings_1->getBeans() as $reunion) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Reuniones] Reunion -' . $reunion -> id);
            if ($reunion -> status == $status) {
                $reunion -> assigned_user_id = $user;
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Reuniones] Usuario-' . $user);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Reuniones] Antes de guardar');
                $reunion -> save();
                $GLOBALS['log'] -> info('[ExpandeNegocio][Asociar Reuniones] Despues de guardar');
            }
        }

    }
        
    //Elimina todas las llamadas de la gestión con determinado status

    function eliminarLLamadas($status) {

        $GLOBALS['log'] -> info('[ExpandeNegocio][Eliminar LLamadas] Entra 1');

        $this -> load_relationship('expan_gestionsolicitudes_calls_1');

        $GLOBALS['log'] -> info('[ExpandeNegocio][Eliminar LLamadas] Entra 2');

        foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Eliminar LLamadas] LLamada -' . $llamada -> id);
            if ($llamada -> status == $status) {
                $llamada -> deleted = 1;
                $llamada -> save();
            }
        }

    }
    
    
    function eliminarTodasLLamadas() {
        $GLOBALS['log'] -> info('[ExpandeNegocio][Eliminar Todas LLamadas] Gestion-'.$this->id);

        $this -> load_relationship('expan_gestionsolicitudes_calls_1');

        foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {
                $llamada -> deleted = 1;
                $llamada -> save();
        }
    }
    
    function eliminarTodasTareas() {
        $GLOBALS['log'] -> info('[ExpandeNegocio][Eliminar Todas LLamadas] Gestion-'.$this->id);

        $this -> load_relationship('expan_gestionsolicitudes_tasks_1');

        foreach ($this->expan_gestionsolicitudes_tasks_1->getBeans() as $tareas) {
                $tareas -> deleted = 1;
                $tareas -> save();
        }
    }

    function tieneLlamadasPendientes(){
                
        $llamadasAbiertas=false;
        
        $db = DBManagerFactory::getInstance();
        $query = "select * from calls where status='Planned' AND deleted=0 AND parent_id='".$this->id."'";
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $llamadasAbiertas=true;
        }
        
        return $llamadasAbiertas;       
    }
    
    function tieneTareasPendientes(){
                              
        $tareasAbiertas=false;
        
        $db = DBManagerFactory::getInstance();
        $query = "select * from tasks where status='Planned' AND parent_id='".$this->id."'";
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $tareasAbiertas=true;
        }
        
        return $tareasAbiertas;        
    }
    
    function calcularPrioridades(){
                        
        $db = DBManagerFactory::getInstance();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Iniciamos calculo');
        
        //Actualizamos las prioridadesde la gestion
             
        $query = "  update expan_gestionsolicitudes g ";
        $query=$query."  inner join (SELECT g.id,ra.sid, ";
        $query=$query."       g.name,       ";
        $query=$query."       CASE WHEN estado_sol='".Expan_GestionSolicitudes::POSITIVO_PRECONTRATO."' THEN 200 ";
        $query=$query."       WHEN estado_sol='".Expan_GestionSolicitudes::POSITIVO_COLABORACION."' THEN 100 ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND oportunidad_inmediata = 1 THEN 1000  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_contrato_personal = 1 THEN 130  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_visita_central = 1 THEN 120  ";                        
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_contrato = 1 THEN 110  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_plan_financiero_personal = 1 THEN 100  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_precontrato_personal = 1 THEN 90  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_precontrato = 1 THEN 80  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_visitado_fran = 1 THEN 70  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_entrevista = 1 THEN 60  ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_informacion_adicional = 1 THEN 50   ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_recepcio_cuestionario = 1 THEN 40   ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_resolucion_dudas = 1 THEN 30   ";
        $query=$query."       WHEN estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_responde_C1 = 1 THEN 20   ";
        $query=$query."       when estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." AND chk_envio_documentacion = 1 THEN 10          ";
        $query=$query."       ELSE 0 END +IFNULL(ra.punt, 0) + IFNULL(lla.puntLLamada, 0) + IFNULL(co.puntCorreo, 0) final ";
        $query=$query." FROM   expan_gestionsolicitudes g ";
        $query=$query."       LEFT JOIN ";
        $query=$query."                 (SELECT   g.id, s.rating,s.id sid, ";
        $query=$query."                           SUM(CASE WHEN s.rating = 1 THEN 50 WHEN s.rating = 2 THEN 30 WHEN s.rating = 3 THEN 10 ELSE 0 END) punt ";
        $query=$query."                  FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query=$query."                  WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id='".$this->id."' ";
        $query=$query."                  GROUP BY g.id) ra ";
        $query=$query."                   ON g.id = ra.id  ";
        $query=$query."       LEFT JOIN (SELECT   g.id, ";
        $query=$query."                           SUM(CASE WHEN c.direction = 'Inbound' THEN 5 WHEN c.direction = 'Outbound' THEN 1 ELSE 0 END) puntLlamada ";
        $query=$query."                  FROM     expan_gestionsolicitudes g, calls c ";
        $query=$query."                  WHERE    c.parent_id = g.id AND c.status = 'Held' AND g.id='".$this->id."' ";
        $query=$query."                  GROUP BY g.id) lla ";
        $query=$query."         ON g.id = lla.id ";
        $query=$query."       LEFT JOIN (SELECT   g.id, SUM(3) puntCorreo ";
        $query=$query."                  FROM     expan_gestionsolicitudes g, emails e ";
        $query=$query."                  WHERE    e.parent_id = g.id AND e.type = 'inbound' AND e.parent_type = 'Expan_GestionSolicitudes' AND g.id='".$this->id."' ";
        $query=$query."                  GROUP BY g.id) co  ";
        $query=$query."         ON g.id = co.id) op ";
        $query=$query."  on g.id='".$this->id."' AND op.id=g.id   ";
        $query=$query."  set g.prioridad=op.final, g.date_modified=now(); ";
        $result = $db -> query($query, true);  
        
        //Actualizo las solicitudes
        
        $query = "  update expan_solicitud s inner join (SELECT s.id, max(g.prioridad) as prio ";
        $query = $query. " FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs "; 
        $query = $query. " WHERE g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida "; 
        $query = $query. " AND g.deleted= 0 and s.id= (SELECT s.id ";
        $query = $query. " FROM expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs "; 
        $query = $query. " WHERE g.id='".$this->id."' and g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida "; 
        $query = $query. " AND g.deleted= 0)) p on s.id=p.id set s.prioridad=p.prio;";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Actualizamos solicitudes');
        
        $result = $db -> query($query, true); 
        
        //Actualizo llamadas
        $query = "  update calls c ";
        $query=$query."  inner join expan_gestionsolicitudes g ";
        $query=$query."  on g.id=c.parent_id AND g.id='".$this->id."' ";
        $query=$query."  set c.prioridad=g.prioridad; ";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][calcularPrioridades] Actualizamos llamadas');
        
        $result = $db -> query($query, true); 
        
        //Actualizo tareas
        $query = "  update tasks t ";
        $query=$query."  inner join expan_gestionsolicitudes g ";
        $query=$query."  on g.id=t.parent_id AND g.id='".$this->id."' ";
        $query=$query."  set t.prioridad=g.prioridad; ";
        
        $result = $db -> query($query, true);
                
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las tareas');
        
        //Actualizo reuniones
        $query = "  update meetings m ";
        $query=$query."  inner join expan_gestionsolicitudes g ";
        $query=$query."  on g.id=m.parent_id AND g.id='".$this->id."' ";
        $query=$query."  set m.prioridad=g.prioridad; ";
        
        $result = $db -> query($query, true);
                
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las reuniones');        
        
        $query="select g.prioridad as prior from expan_gestionsolicitudes g where g.id='".$this->id."';";
        
        $result = $db -> query($query, true);
        
         while ($row = $db -> fetchByAssoc($result)) {
            return $row["prior"];
        }        
    }

    function asignarUsuarioGestor() {

        //asignamos el usuarioGestor s
        $Fran = new Expan_Franquicia();
        $Fran -> retrieve($this -> franquicia);

        $this -> assigned_user_id = $Fran -> assigned_user_id;
        $this -> asociarLLamadas("Planned", $Fran -> assigned_user_id);
    }

    //Comprobamos si hay una llamada el tipo y el estado que se indican

    function existeLlamada($tipo,$estado){
        
        $db = DBManagerFactory::getInstance();
        
        //Actualizo tareas
        $query = "SELECT id ";
        $query=$query."FROM   calls ";
        $query=$query."WHERE  parent_id = '".$this->id."' AND deleted = 0 AND status = '".$estado."' AND call_type = '".$tipo."' ";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][existeLlamada]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            return true;
        }        
        return false; 
    }

    private function existeTarea($tipo,$estado){
        
        $db = DBManagerFactory::getInstance();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][existeTarea]ID-' . $this->id);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][existeTarea]ID-' . $tipo);
        
        //Actualizo tareas
        $query = "SELECT id ";
        $query=$query."FROM   tasks ";
        $query=$query."WHERE  parent_id = '".$this->id."' AND deleted = 0 AND status = '".$estado."' AND task_type = '".$tipo."' ";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Expan_Solicitud][existeTarea]query-' . $query);
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            return true;
        }        
        return false; 
    }      
    
     public function fill_in_additional_list_fields() {        
        parent::fill_in_additional_list_fields();
              
        $db = DBManagerFactory::getInstance();
         
        $query = "SELECT s.provincia_apertura_1,s.rating,s.phone_mobile,g.motivo_parada,g.motivo_descarte,g.motivo_positivo, ";
        $query=$query."g.portal,g.expan_evento_id_c,g.subor_mailing,g.subor_central,g.subor_expande,g.subor_medios ";
        $query=$query."FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
        $query=$query."g.id ='".$this->id."'";
        
        $result = $db -> query($query, true);
        
        $parada='';
        $descarte='';
        $positivo='';
        $portal='';
        $evento='';
        $mailing='';
        $central='';
        $expande='';
        $medios='';
        
        while ($row = $db -> fetchByAssoc($result)) {          
            $this->provincia_apertura_1=$row['provincia_apertura_1']; 
            $this->rating=$row['rating'];            
            $this->telefono=$row['phone_mobile'];  
            $parada=$row['motivo_parada'];
            $descarte=$row['motivo_descarte'];
            $positivo=$row['motivo_positivo'];
            $portal=$GLOBALS["app_list_strings"]["portal_list"][$row['portal']];
            $evento=$GLOBALS["app_list_strings"]["eventos_list"][$row['expan_evento_id_c']];
            $mailing=$GLOBALS["app_list_strings"]["subor_mailing_list"][$row['subor_mailing']];
            $central=$GLOBALS["app_list_strings"]["subor_central_list"][$row['subor_central']];
            $expande=$GLOBALS["app_list_strings"]["subor_expande_list"][$row['subor_expande']];
            $medios=$GLOBALS["app_list_strings"]["subor_medios_list"][$row['subor_medios']];                                 
        }
        
            //Calculamos los subestados
         if ($this->estado_sol=='1'){
            $this->subestado="";
         } else if ($this->estado_sol=='2'){
            
            if ($this->chk_visita_central==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_CENTRAL;
            }else if ($this->chk_envio_contrato==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_ENVIO_CONTRATO;            
            }else if  ($this->chk_visita_local_label==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_VISITA_LOCAL;
            }else if  ($this->chk_envio_precontrato==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_PRECONTRATO;
            }else if  ($this->chk_visitado_fran==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_VISITA_FRANQ;
            }else if  ($this->chk_entrevista==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_ENTREVISTA;
            }else if  ($this->chk_informacion_adicional==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_INFOR_ADICIO;
            }else if  ($this->chk_recepcio_cuestionario==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_CUESTIONARIO;
            }else if  ($this->chk_resolucion_dudas==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_PRI_DUDAS;
            }else if  ($this->chk_sol_amp_info==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_SOL_AMP;
            }else if  ($this->chk_responde_C1==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_RESPON_C1;
            }else if  ($this->chk_envio_documentacion==true){
                $this->subestado=Expan_GestionSolicitudes::SUBESTADO_ENVIO_DOC;
            }
        
         } else if ($this->estado_sol=='3'){
            $this->subestado=$GLOBALS["app_list_strings"]["motivo_parada_list"][$parada];
         } else if ($this->estado_sol=='4'){
            $this->subestado=$GLOBALS["app_list_strings"]["motivo_descarte_list"][$descarte];
         } else if ($this->estado_sol=='5'){
            $this->subestado=$GLOBALS["app_list_strings"]["motivo_positivo_list"][$positivo];
         }  
         
         //Calculamos los suborigenes
         
        switch ($this->tipo_origen) {
            case Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL:
                $this->suborigen=$central;
                break;
            
            case Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS:
                $this->suborigen=$evento;
                break;
           
            case Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO:
                $this->suborigen=$expande;
                break;
            
            case Expan_GestionSolicitudes::TIPO_ORIGEN_MAILING:
                $this->suborigen=$mailing;
                break;
                
            case Expan_GestionSolicitudes::TIPO_ORIGEN_MEDIOS_COMUN:
                $this->suborigen=$medios;
                break;   
           
           case Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES:
                $this->suborigen=$portal;
                break;                                 
        }
    }

    public function isDescartadoUsuario(){
        
        $db = DBManagerFactory::getInstance();
        
        $query="select * from tipo_descarte where Desc_Nosotros=0";
        
        $result = $db -> query($query, true);

        $myArraydescartes[''] = '';
        while ($row = $db->fetchByAssoc($result)){
            $myArraydescartes[$row['id']] =0;
        }
                
        if ($this->estado_sol==SELF::ESTADO_DESCARTADO && 
            in_array($this->motivo_descarte,$myArraydescartes) ){            
            return true;            
        }else{
            return false;
        }
        
    }
    
    public function isDescartadoNosotros(){
        
        $db = DBManagerFactory::getInstance();
        
        $query="select * from tipo_descarte where Desc_Nosotros=1";        
        $result = $db -> query($query, true);

        $myArraydescartes[''] = '';
        while ($row = $db->fetchByAssoc($result)){
            $myArraydescartes[$row['id']] =1;
        }
                
        if ($this->estado_sol==SELF::ESTADO_DESCARTADO &&
            in_array($this->motivo_descarte,$myArraydescartes) ){            
            return true;            
        }else{
            return false;
        }
    }
    
     public function isParadoCandidato(){
        
        $db = DBManagerFactory::getInstance();
        
        $query="select * from tipo_parada where nombre like'POR CANDIDATO%'";
        
        $result = $db -> query($query, true);

        $myArrayPadara[''] = '';
        while ($row = $db->fetchByAssoc($result)){
            $myArrayPadara[$row['id']] =0;
        }
                
        if ($this->estado_sol==SELF::ESTADO_PARADO && 
            in_array($this->motivo_parada,$myArrayPadara) ){            
            return true;            
        }else{
            return false;
        }
        
    }   
     
    public function calcAvanzado(){
        
        if ($this->estado_sol== Expan_GestionSolicitudes::ESTADO_EN_CURSO &&
            ($this->chk_resolucion_dudas==true ||
            $this->chk_recepcio_cuestionario==true ||
            $this->chk_informacion_adicional==true ||
            $this->chk_entrevista==true ||
            $this->chk_visitado_fran==true ||
            $this->chk_envio_precontrato==true ||
            $this->chk_visita_local==true ||
            $this->chk_envio_contrato==true ||
            $this->chk_visita_central==true ||
            $this->chk_propuesta_zona==true)){
                            
                $this->candidatura_avanzada=true;
        }else{
            
            $reuniones=$this->comprobarReuniones();
            if($this->estado_sol== Expan_GestionSolicitudes::ESTADO_EN_CURSO &&$reuniones==true){
                $this->candidatura_avanzada=true;
            }else{
                $this->candidatura_avanzada=false;
            }
        }        
    } 

    public function comprobarReuniones(){
            //mirar si tienes reuniones planificadas
            $db = DBManagerFactory::getInstance();
            $query = "select count(*) as reuniones FROM meetings where parent_id='".$this->id."' and status='Planned' and deleted=0; ";
            $result = $db -> query($query, true);
            while ($row = $db -> fetchByAssoc($result)) {
                if ($row["reuniones"]!=0){
                    return true;
                }   
            }
            return false;
    }
    
    public function calcCaliente(){
        
        if (($this->estado_sol== Expan_GestionSolicitudes::ESTADO_EN_CURSO &&
            ($this->chk_visitado_fran==true ||
            $this->chk_envio_precontrato==true ||
            $this->chk_visita_local==true ||
            $this->chk_envio_contrato==true ||
            $this->chk_visita_central==true ||
            $this->chk_posible_colabora==true ||
            $this->chk_envio_precontrato_personal==true||
            $this->chk_envio_contrato_personal==true||
            $this->chk_envio_plan_financiero_personal==true
            ))
            ||
            ($this -> estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO && 
             $this -> motivo_positivo == Expan_GestionSolicitudes::POSITIVO_PRECONTRATO)){
                            
                $this->candidatura_caliente=true;
        }else{
            $this->candidatura_caliente=false;
        }        
    } 
    
    public function creaReunion($texto, $tipo,$días){
        
        $fecha = date("Y-m-d H:i:s", $this -> addBusinessDays($días));
        
        $reunion = new Meeting();
        $reunion -> parent_id = $this -> id;
        $reunion -> parent_type="Expan_GestionSolicitudes";
         
        $reunion -> meeting_type=$tipo;
        $reunion -> status = 'Planned';
        $reunion -> name = $this -> name . ' - ' . $texto;      
        $reunion -> date_start = $fecha;   
        $reunion -> assigned_user_id=$this->assigned_user_id;
        $reunion -> duration_minutes = $reunion->asignarTiempo($tipo);
         
        $reunion -> ignore_update_c = true;
        $reunion->save();
        
        //enlazamos con la gestión
        $this -> load_relationship('expan_gestionsolicitudes_meetings_1');
        $this -> expan_gestionsolicitudes_meetings_1 -> add($reunion -> id);
        $this -> ignore_update_c = true;
        $this -> save();
    
        $prioridad=$this->calcularPrioridades();
        $this->prioridad=$prioridad;       
        
    }
     
    public function creaLlamada($texto, $tipo) {
        
        $solicitud=$this->GetSolicitud();
        
        if ($solicitud==null){
            return;
        }
                
        $telefono=$solicitud->recogeTelefono();
        
        if ($telefono==""){
            if($solicitud->skype==""){
               return; 
            }
            else{//tiene skype y no telefono
                $telefono="";
                $texto=$texto." - Skype";
            }
        }        
        
        $Fran = new Expan_Franquicia();
        $Fran -> retrieve($this -> franquicia);
        
        $this->archivarLLamadasPrevias();
        
        if ($this->existeLlamada($tipo, "Planned")==true){
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] NO se puede añadir llamada por repetida');
            return;
        }
        
         //No se llama si solo viene de portales
        if (($solicitud -> do_not_call == 0 && $this -> tipo_origen != Expan_Solicitud::TIPO_ORIGEN_PORTALES ) || 
            ($solicitud -> do_not_call == 0 && $this -> tipo_origen == Expan_Solicitud::TIPO_ORIGEN_PORTALES && $tipo!='Primera') ||
            ($solicitud -> do_not_call == 0 && $this -> tipo_origen == Expan_Solicitud::TIPO_ORIGEN_PORTALES && $tipo=='Primera' && $Fran->llamar_todos == true)) {
                                               
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] Se puede añadir llamada');

            $numDias = $this -> calcularDias($solicitud, $tipo);

            //Creo la llamada
            $llamada = new Call();

            //Doy atributos
            if ($this -> assigned_user_id == null) {
                global $current_user;
                $llamada -> assigned_user_id = $current_user -> id;
            } else {
                $llamada -> assigned_user_id = $this -> assigned_user_id;
            }

            $llamada -> duration_minutes = 15;
            $llamada -> date_entered=TimeDate::getInstance()->getNow()->asDb();
            
            $llamada -> status = 'Planned';
            //$llamada->description='Una descripcion';
            $llamada -> parent_id = $this -> id;
            $llamada -> parent_type = 'Expan_GestionSolicitudes';
            $llamada -> reminder_time = -1;
            $llamada -> direction = 'Outbound';
            $llamada -> telefono = $telefono;
            $llamada -> call_type = $tipo;
            $llamada -> created_by = 1;
            $llamada -> franquicia = $this -> franquicia;
            $llamada -> origen = $this -> tipo_origen;

            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] NumDias - ' . $numDias);

            if($texto=='[AUT]De seguimiento'){ //la llamada es para dentro de 15 dias
                date_default_timezone_set('europe/madrid');
                $dateTime = time()-3600;
                $llamada->date_start=date("Y-m-d H:i:s", $dateTime + (15 * 24 * 3600));
                
            }else{
                if($texto=='[AUT]Puertas abiertas'){
                       $llamada -> date_start=TimeDate::getInstance()->getNow() -> modify('+1 hour')-> asDb();
                   //date_default_timezone_set('europe/madrid');
                    //$dateTime = time()+3600;
                    //$llamada->date_start=date("Y-m-d H:i:s", $dateTime);
                    
                }else{
                     $fecha = date("Y-m-d H:i:s", $this -> addBusinessDays($numDias));
                     $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] fecha - ' . $fecha);
                     $llamada -> date_start = $fecha;
                }
               

           
            }
            
             
            
            //Si es agrupada la marcamos

            if ($solicitud == null){
                $numgest=0;
            }else{
                $numgest = $solicitud -> NumGestionesEstado(Expan_GestionSolicitudes::ESTADO_EN_CURSO);
            }        

            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] NumGestiones - ' . $numgest);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] tipo llamada - ' . $llamada -> call_type);

            

            if ($numgest > 1 && ($llamada -> call_type == 'Primera' || 
                                 $llamada -> call_type == 'SolCorreo' ||
                                 $llamada -> call_type == 'InformacionAdicional')) {
                    
                $llamada -> gestion_agrupada = true;
                $llamada -> name = $solicitud -> name . ' - Gestion Agrupada - ' . $texto;
                $solicitud ->AgruparLLamadas('Planned',$tipo);
            } else {
                $llamada -> gestion_agrupada = false;
                $llamada -> name = $this -> name . ' - ' . $texto;
            }

            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada]Nombre llamada - ' . $llamada -> name);
            $llamada -> ignore_update_c = true;
            $llamada -> save();
            
            //Actualizamos la fecha de creacion
            $query = "UPDATE calls SET date_entered = UTC_TIMESTAMP() WHERE id = '" . $llamada -> id . "'";
            $db = DBManagerFactory::getInstance();
            $result = $db -> query($query);            

            //enlazamos con la gestión
            $this -> load_relationship('expan_gestionsolicitudes_calls_1');
            $this -> expan_gestionsolicitudes_calls_1 -> add($llamada -> id);
            $this -> ignore_update_c = true;
            $this -> save();
            
            $prioridad=$this->calcularPrioridades();
            $this->prioridad=$prioridad;       
        }else{
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] NO se puede añadir llamada or las condiciones impuestas');
        }
        
        
    }

    private function addBusinessDays($days, $dateTime = null) {
        date_default_timezone_set('europe/madrid');

        $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de llamada] fecha - ' . time());

        $dateTime = is_null($dateTime) ? time() : $dateTime;
        $_day = 0;
        $_direction = $days == 0 ? 0 : intval($days / abs($days));
        $_day_value = (60 * 60 * 24);
        
        $max=4;
        $i=0;

        while ($_day !== $days) {
            $dateTime += $_direction * $_day_value;
            $_day_w = date("w", $dateTime);
            if ($_day_w > 0 && $_day_w < 6) {
                $_day += $_direction * 1;
            }
            //Para no entrar en posible bucle infinito
            $i++;
            if ($i==$max){
               break; 
            }
        }

        $dateTime = is_null($dateTime) ? time() : $dateTime;

        return $dateTime - (2 * 3600);
    }
    
    private function calcularDias($solicitud, $tipo) {
        $dias = 0;
        if ($tipo == 'Primera') {
            switch ($solicitud->tipo_origen) {
                case Expan_Solicitud::TIPO_ORIGEN_CENTRAL :
                    $dias = 1;
                    break;
                case Expan_Solicitud::TIPO_ORIGEN_MEDIOS_COMUN :
                    $dias = 2;
                    break;
                case Expan_Solicitud::TIPO_ORIGEN_PORTALES :
                    $dias = 4;
                    break;
                case Expan_Solicitud::TIPO_ORIGEN_EVENTOS :
                    $dias = 3;
                    break;
                default :
                    $dias = 3;
            }
        } else if ($tipo == 'InformacionAdicional') {
            $dias = 3;
        } else if ($tipo == 'ResPriDuda'){
            $dias = 0;
        }else{
            $dias = 2;
        }

        return $dias;
    }
    
    public function addFechaObserva($texto,$permiteRepetido){
        
        if ($texto==""){
            return;
        }
        
        $pos = strpos($this->observaciones_informe, $texto);

        if ($permiteRepetido==true ||  $pos === false){
            $posDescartado = strpos($this->observaciones_informe, ": Descartado por");
            $posParado = strpos($this->observaciones_informe, ": Parado por");                       
            if ($posDescartado === false && $posParado === false){ 
                $fecha=date("d/m/Y",time());        
                $this->observaciones_informe=$this->observaciones_informe.'
'.$fecha.' : '.$texto;        //NO AÑADIR ESPACIOS AL INICIO DE LA LINEA
        
            }
        }
    }    
    
    function preparaCorreo($envio) {
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] Inicio.' );

        //Recogemos la franquica
        
        $solicitud=$this->GetSolicitud();
        
        if ($solicitud==null){
             $GLOBALS['log'] -> info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] No se puede enviar correo no existe la solicitud.' );
        }

        if ($solicitud->no_correos_c == false) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] Entra.' );

            if ($this -> franquicia != '' && 
                $this -> chk_envio_auto==1 && 
                $this -> isDescartadoUsuario() == false ) {
                
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] Previo recoger Franq.' );

                //Recogemos el objeto fraqnuicia

                $Fran = new Expan_Franquicia();
                $Fran -> retrieve($this -> franquicia);

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] Nombre de la franquicia - ' . $Fran -> name);

                $db = DBManagerFactory::getInstance();

                //Creamos la consulta para localizar el id del template correspondiente

                $query = "select id,type from email_templates where type='" . $this -> franquicia . "#" . $envio . "' AND deleted=0";

                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] Query correo - ' . $query);
                $result = $db -> query($query, true);

                $enviado = true;
                $idTemplate = "";

                while ($row = $db -> fetchByAssoc($result)) {
                    $idTemplate = $row["id"];
                    $typeTemplate= $row["type"];
                }

                if ($idTemplate == "") {
                    $this->crearTarea("INTPlantilla");
                    $incidencia= new Expan_IncidenciaCorreo();
                    $incidencia->RellenoGestion($this,$envio);
                    return "Alguno de los correos no han sido enviados. La plantilla no existe";
                } else {
                    //Comprobamos que el está validada la plantilla                                       
                   
                   if ($this->plantillaValida($typeTemplate)==true){                    
                        $envioCorreos = new EnvioAutoCorreos();
                        if ($envioCorreos -> sendMessage($solicitud, $this, $idTemplate, $Fran) == 'Ok') {
                            return "Ok";
                        } else {
                            return "Alguno de los correos no han sido enviados. Posiblemente el correo no sea válido.";
                        }
                   }else{
                       
                       $incidencia= new Expan_IncidenciaCorreo();
                       $incidencia->RellenoGestion($this,$envio);
                       return "La plantilla de envío no está validada";
                   }
                }
            }else{
                return "No se debe enviar correo";
            }
        } else {
            return "Los correos no se han enviado porque el usuario no quería recibirlos.";
        }
    }
   
    function crearTarea($tipoTarea) {
        
        $tarea = new Task();
        if (array_key_exists($tipoTarea, $GLOBALS['app_list_strings']['tipo_tarea_list'])){
            $tarea -> name = $this -> name . " - " .$GLOBALS['app_list_strings']['tipo_tarea_list'][$tipoTarea];                       
        }else{
            $tarea -> name = $this -> name. " - " .$tipoTarea;
        }
        
        $tarea -> status = "Not Started";
        $tarea -> task_type= $tipoTarea;
               
        $tarea -> date_start = TimeDate::getInstance()->nowDb();
        $tarea -> date_due = TimeDate::getInstance()->nowDb();
    
        $franquicia = new Expan_Franquicia();
        $franquicia -> retrieve($this -> franquicia);
        
        if ($tipoTarea=="INTPlantilla"){
            
            if ($franquicia->existeTarea($tipoTarea, "Not Started")==true){
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de tarea]NO se crea la tarea, ya existe otra igual para la franquicia');
                return;
            }   
            
            $tarea -> parent_id = $franquicia -> id;
            $tarea -> parent_type = 'Expan_Franquicia';
            $tarea -> assigned_user_id = $franquicia -> user_id1_c;
            
            $tarea -> ignore_update_c = true;
            $tarea -> save();
            
            $franquicia -> load_relationship('expan_franquicia_tasks_1');
            $franquicia -> expan_franquicia_tasks_1 -> add($tarea -> id);                       
            $franquicia -> ignore_update_c = true;
            $franquicia -> save();
        }else{
            
            if ($this->existeTarea($tipoTarea, "Not Started") == true){
                $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de tarea]NO se crea la tarea, ya existe otra igual para a gestion');
                return;
            }   
            
            $tarea -> parent_id = $this -> id;
            $tarea -> parent_type = 'Expan_GestionSolicitudes';            
            $tarea -> assigned_user_id = $this -> assigned_user_id;
            $tarea -> ignore_update_c = true;
            $tarea -> save();
            //enlazamos con la gestión
            $this -> load_relationship('expan_gestionsolicitudes_tasks_1');
            $this -> expan_gestionsolicitudes_tasks_1 -> add($tarea -> id);                       
            $this -> ignore_update_c = true;
            $this -> save();
        }               
           
        $prioridad=$this->calcularPrioridades();
        $this->prioridad=$prioridad;  
             
        
    }

    function plantillaValida($typeTemplate){
            
        //Cargamos la franquicia
        
        $Fran = new Expan_Franquicia();
        $Fran -> retrieve($this -> franquicia);
        
        $porcion = explode("#", $typeTemplate);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][plantillaValida] ID Plantilla - ' . $typeTemplate);
        $GLOBALS['log'] -> info('[ExpandeNegocio][plantillaValida] Tipo Plantilla - ' . $porcion[1]);
        $GLOBALS['log'] -> info('[ExpandeNegocio][plantillaValida] check franquicia - ' . $Fran->chk_c1);
        $GLOBALS['log'] -> info('[ExpandeNegocio][plantillaValida] nombre franquicia - ' . $Fran->name);

        if ($porcion[1]=="C1"){
           if ($Fran->chk_c1 == true){
               return true;
           } 
        }else if ($porcion[1] == "C1.1"){
            if ($Fran->chk_c11 == true){
                return true;
            }
        }else if ($porcion[1] == "C1.2"){
            if ($Fran->chk_c12 == true){
                return true;
            }
        }else if ($porcion[1] == "C1.3"){
            if ($Fran->chk_c13 == true){
                return true;
            }
        }else if ($porcion[1] == "C1.4"){
            if ($Fran->chk_c14 == true){
                return true;
            }
        }else if ($porcion[1] == "C1.5"){
            if ($Fran->chk_c15 == true){
                return true;
            }
        }else if ($porcion[1] == "C2"){
            if ($Fran->chk_c2 == true){
               return true;
           } 
        }else if ($porcion[1] == "C3"){
            if ($Fran->chk_c3 == true){
               return true;
           }
        }else if ($porcion[1] == "C4"){
            if ($Fran->chk_c4 == true){
               return true;
           }
        }
        
        $this->crearTarea("INTPlantilla");        
        return false;
    }

    public function pasoaOrigenExpandeFeria(){
        
        if ($this->tipo_origen==$this::TIPO_ORIGEN_EVENTOS){
            
            $db = DBManagerFactory::getInstance();

            //Creamos la consulta para ver el tipo de participacion en el evento           
            $query = "SELECT * ";
            $query=$query."FROM expan_franquicia_expan_evento_c ";
            $query=$query."WHERE expan_franquicia_expan_eventoexpan_franquicia_ida ='".$this->franquicia."' AND ";
            $query=$query."  expan_franquicia_expan_eventoexpan_evento_idb = '".$this->expan_evento_id_c."'; ";

            $result = $db -> query($query, true);
            
            $numElem=0;

            while ($row = $db -> fetchByAssoc($result)) {
                
               $numElem++;
               if($row['participacion']=='3'){
                   return true;
               }; 
            }   
            //Si no hay franquicia asociada pero el origen es evento. Se lo pasamos a Expande
            if ($numElem==0) {
                return true;
            }        
        }
        return false;
                       
    } 

    function llamadasHermanasOportunidadInmediata($estado) {

        $db = DBManagerFactory::getInstance();
        $query = "select oportunidad_inmediata from calls where parent_id='" . $this -> id . "' and status='" . $estado . "'";

        $result = $db -> query($query, true);

        $opIn = false;

        while ($row = $db -> fetchByAssoc($result)) {
            if ($row["oportunidad_inmediata"]==1){
                return true;
            }           
        }
        return $opIn;
    } 

}
?>