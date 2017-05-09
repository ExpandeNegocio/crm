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
require_once('modules/Expan_Franquicia/Expan_Franquicia_sugar.php');
class Expan_Franquicia extends Expan_Franquicia_sugar {
    
    const TIPO_FRAN_CONSULTORIA='1';
    const TIPO_FRAN_INTERMEDIA='2';
    const TIPO_FRAN_SERV_DIV='3';
    const TIPO_FRAN_NO_CLIENTE='4';
    const TIPO_FRAN_CLIENTE_PARADO='5';
    const TIPO_FRAN_PENDIENTE_ENTRADA='6';
    const TIPO_FRAN_DESAPARECIDA='7';
    const TIPO_FRAN_EXCLIENTE='8';
    const TIPO_FRAN_ENTRADA_INMINENTE='9';
    
	
	function Expan_Franquicia(){	
		parent::Expan_Franquicia_sugar();
	}
    
    public function fill_in_additional_list_fields() {
        parent::fill_in_additional_list_fields();
        $vista=$GLOBALS['app']->controller->action;
        //rellenar los campos de la lista de franquicias de numero de gestiones en curso y llamadas pendientes de gestiones
        if($vista=="listview"){//solo entra si es de consultoria o intermediacion, y solo en la vista de franquicias
            if(($this->tipo_cuenta==1|$this->tipo_cuenta==2)){
                $this->gestionesfran=$this->numGestionesEnCurso();
                $this->llamadaspendientesfran=$this->numLlamadasPendientes();
            }
        
        }
        else{
            $this->num_solicitudes=$this->numSolicitudes("");
            $this->total_gestiones=$this->numTotalGestiones(false);
            $this->dummies=$this->numTotalGestiones(true);
            $this->sol_rating_a_plus=$this->numSolicitudes(1);
            $this->sol_rating_a=$this->numSolicitudes(2);
            $this->sol_rating_b=$this->numSolicitudes(3);
            $this->sol_rating_c=$this->numSolicitudes(4);   
        }
        
        
    }
    
    public function numTotalGestiones($ConDummies){
        $db = DBManagerFactory::getInstance();
        
        if ($ConDummies==true){
            $query = "select count(1) num  ";
            $query=$query."from expan_gestionsolicitudes where franquicia='".$this->id."' AND deleted=0 AND name like '%Dummie%' AND ";
            $query=$query."((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->expan_franquicia_expan_eventoexpan_evento_idb."' ) OR ";
            $query=$query."expan_evento_id_c='".$this->expan_franquicia_expan_eventoexpan_evento_idb."'); ";
        }else{
            $query = "select count(1) num  ";
            $query=$query."from expan_gestionsolicitudes where franquicia='".$this->id."' AND deleted=0 AND not name like '%Dummie%' AND ";
            $query=$query."((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->expan_franquicia_expan_eventoexpan_evento_idb."' ) OR ";
            $query=$query."expan_evento_id_c='".$this->expan_franquicia_expan_eventoexpan_evento_idb."'); ";
        }          
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;  
    }
    
    public function numSolicitudes($rating){
        $db = DBManagerFactory::getInstance();
        
        if($rating==""){
            $query = "SELECT count(distinct(s.id)) num ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  deleted = 0  AND franquicia='".$this->id."' AND ((tipo_origen = 1 AND subor_expande = 7 AND evento_bk = ";
            $query=$query."               '".$this->expan_franquicia_expan_eventoexpan_evento_idb."') OR expan_evento_id_c = '".$this->expan_franquicia_expan_eventoexpan_evento_idb."')) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
            
        }else{
            $query = "SELECT count(distinct(s.id)) num ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  deleted = 0  AND franquicia='".$this->id."' AND ((tipo_origen = 1 AND subor_expande = 7 AND evento_bk = ";
            $query=$query."               '".$this->expan_franquicia_expan_eventoexpan_evento_idb."') OR expan_evento_id_c = '".$this->expan_franquicia_expan_eventoexpan_evento_idb."')) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.rating='".$rating."' ";
            
        }
        
                  
        $result = $db -> query($query, true);
        
        $numSolicitudesRecogidas=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numSolicitudesRecogidas = $row["num"];
        }                
        
        return $numSolicitudesRecogidas;  
    }
    
    /**
     * Calcula el número de gestiones en curso de una franquicia concreta
     */
    public function numGestionesEnCurso(){
        $db = DBManagerFactory::getInstance();
        
            $query = "select count(*) as gestionesfran FROM expan_gestionsolicitudes where estado_sol='2' and franquicia='".$this->id."' and dummie=0 and deleted=0;";
                       
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["gestionesfran"];
        }                
        
        return $numGestiones;  
    }
    
    /**
     * Calcula el número de llamadas pendientes de todas las gestiones en curso de una franquicia concreta
     */
    public function numLlamadasPendientes(){
        $db = DBManagerFactory::getInstance();
        
            $query = "select count(*) as llamadasPendientes FROM calls where status='Planned' and franquicia='".$this->id."' and parent_type='Expan_GestionSolicitudes' and deleted=0;";
                       
        $result = $db -> query($query, true);
        
        $numLlamadasPendientes=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numLlamadasPendientes = $row["llamadasPendientes"];
        }                
        
        return $numLlamadasPendientes;  
    }
	
    function existeTarea($tipo,$estado){
        
        $db = DBManagerFactory::getInstance();
        
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
    
     public function cambioDirCuenta($dirCuentaAnt,$dirCuentaAct) {
         
        $db = DBManagerFactory::getInstance();
            
        $query = "select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this -> id."' AND assigned_user_id='".$dirCuentaAnt."'";  
                           
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
                                                                                           
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);

            $gestion -> assigned_user_id=$dirCuentaAct;
            $gestion -> ignore_update_c = true;
            $gestion -> save();
  
            $gestion -> asociarLLamadas("Planned", $dirCuentaAct);
            $gestion -> asociarTareas("Not Started", $dirCuentaAct);  
        }
    }
        
    public function cambioFiltro($filtroAnt,$filtroAct){
        
        $db = DBManagerFactory::getInstance();                
        $query = "select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this -> id."' AND assigned_user_id='".$filtroAnt."'";  
                           
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);
                                                                           
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);

            $gestion->assigned_user_id=$filtroAct;
            $gestion->ignore_update_c = true;
            $gestion->save();
  
            $gestion -> asociarLLamadas("Planned", $filtroAct);
            $gestion -> asociarTareas("Not Started", $filtroAct);  
        }
    }    
    
    public function pasoaExcliente(){
        
         $db = DBManagerFactory::getInstance();
        
         $query = "select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this -> id."' AND estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO;  
        
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);
            
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);

            $gestion -> estado_sol=Expan_GestionSolicitudes::ESTADO_PARADO;
            $gestion -> motivo_parada= Expan_GestionSolicitudes::PARADA_EXCLIENTE;
            
            //$gestion -> ignore_update_c = true;
            $gestion -> save();
            
        }
    }
    
    public function vueltaExcliente(){
        
         $db = DBManagerFactory::getInstance();
        
         $query = "select id from expan_gestionsolicitudes where deleted=0 and franquicia='".$this -> id."' AND estado_sol=".Expan_GestionSolicitudes::ESTADO_PARADO;  
         $query = $query. " AND motivo_parada=".Expan_GestionSolicitudes::PARADA_EXCLIENTE;
         
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);

            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);
            
            $gestion -> estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            $gestion -> motivo_parada=null;
            
            $gestion->ignore_update_c = true;
            $gestion->save();
            
            $gestion->creaLlamada('[AUT]Revision Estado', 'RevEst');
            
        }
    }

    public function lanzaIncidencias($tipoEnv){
               
        $db = DBManagerFactory::getInstance();
        
        //Recogemos todas las incidencias 
        
         $query = "SELECT g.id gid, i.id iid ";
         $query=$query."FROM   Expan_gestionsolicitudes g, expan_incidenciacorreo i ";
         $query=$query."WHERE  g.id = i.expan_gestionsolicitudes_id AND i.deleted=0 and g.deleted=0 AND incidencia_type='".$tipoEnv."'";
         $query=$query." and g.franquicia='".$this->id."'";
        
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);
            
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['gid']);

            $salida = $gestion -> preparaCorreo($tipoEnv);

            $incidencia = new Expan_IncidenciaCorreo();
            $incidencia -> retrieve($row['iid']);
            
            // Eliimnamos la incidencia en todo caso, si se vuelve a dar el problema preparaCorro la crea de nuevo                                           
            $incidencia->deleted=1;
            $incidencia->ignore_update_c = true;
            $incidencia->save();
            
        }
    }
    
    public function creaLlamadasPortal(){
                
        $db = DBManagerFactory::getInstance();
               
        $query = "SELECT * ";
        $query=$query."FROM   expan_gestionsolicitudes ";
        $query=$query."WHERE  franquicia = '".$this->id."' AND  ";
        $query=$query."tipo_origen = '".Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES."' AND  ";
        $query=$query."date_entered BETWEEN date_sub(now(), INTERVAL 2 MONTH) AND NOW() AND ";
        $query=$query."id not in (select parent_id from calls where parent_id is not null ); ";                        
         
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);
            $gestion -> creaLlamada('[AUT]Primera llamada', 'Primera');      
        }  
        
    }
    /**
     * Crea una llamada de recordatorio, si no está creada
     */
    public function creaLlamadaRecor($texto, $tipo){
        
            $telefono = $this -> getTelefono();
        
        if($this -> existeLlamada($tipo, "Planned")== true){
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion de llamada] Ya está añadida la llamada');
            return;
        }
        
        //No existe la llamada, hay que crearla
        $llamada = new Call();
        
        //completar campos
        $llamada -> assigned_user_id = $this -> assigned_user_id;
        $llamada -> assigned_user_name = $this -> assigned_user_name;
        $llamada -> duration_minutes = 15;
        $llamada -> date_entered=TimeDate::getInstance()->getNow()->asDb();
        $llamada -> status = "Planned";
        $llamada -> parent_id = $this -> id;
        $llamada -> parent_type = 'Expan_Franquicia';
        $llamada -> direction = 'Outbound';
        $llamada -> telefono = $telefono;
        $llamada -> call_type = $tipo;
        $llamada -> franquicia = $this -> id;
        $llamada -> reminder_time = -1;
        $llamada -> created_by = 1;
        
        $llamada -> gestion_agrupada = false;
        $llamada -> name = $this -> name . ' - '. $texto;
        
        $llamada -> date_start = $this -> calcularFechaInicio();
        
        //guardar los cambios de la llamada
        $llamada -> ignore_update_c = true;
        $llamada -> save();
        
        $this -> actualizarFechaCreacion($llamada);
        
        $this -> enlazarConFranquicia($llamada);
    }
    
    /**
     * Se calcula como 12 horas después de la fecha actual, suponiendo que se ejecutará
     * a las 12 de la noche, devolverá las 12 de la mañana del día siguiente.
     */
    function calcularFechaInicio(){
         
        date_default_timezone_set('europe/madrid');
        $dateTime = time();
        return date("Y-m-d H:i:s", $dateTime + (12 * 3600));
    }
    
    function enlazarConFranquicia($llamada){
        
        $this -> load_relationship('expan_franquicia_calls_1');
        $this -> expan_franquicia_calls_1 -> add($llamada -> id);
        $this -> ignore_update_c = true;
        $this -> save();
    }
    
    /**
     * Actualizar fecha de creación de la llamada
     */
    function actualizarFechaCreacion($llamada){
        
        $db = DBManagerFactory::getInstance();
        $query = "UPDATE calls SET date_entered = UTC_TIMESTAMP() WHERE id = '".$llamada -> id."'";
        $result = $db -> query($query);
    }
    
    /**
     * Comprueba si ya se ha creado la llamada de recordatorio
     */
    function existeLlamada($tipo, $estado){
        
        $db= DBManagerFactory::getInstance();
        
        $query= "SELECT id FROM calls WHERE parent_id='".$this -> id."' AND status = '".$estado."' AND call_type = '".$tipo."' AND deleted=0;";
        
        $result = $db -> query($query, TRUE);
        
        while ($row = $db -> fetchByAssoc($result)) {
            return true;
        }
        return false;
    }
    
    function getTelefono(){
        
        $telefono = "";
        
        if ($this -> phone_office !=""){//si hay telefono de la oficina
            $telefono = $this -> phone_office;
        }
        
        return $telefono;
    }
    
}
?>