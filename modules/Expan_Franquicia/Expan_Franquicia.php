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
                $this->calculoDatosFranquicia();
            }
        }
        else{
            $this->calculoDatosEvento();
        }
        
        
    }
    
    
    public function calculoDatosEvento(){
        $db=DBManagerFactory::getInstance();
        
        $query="SELECT distinct(s.id), rating, s.first_name FROM  expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, ( ";
        $query=$query." SELECT id FROM   expan_gestionsolicitudes WHERE franquicia='".$this->id."' AND ((tipo_origen = 1 AND "; 
        $query=$query." subor_expande = 7 AND evento_bk = '".$this->expan_franquicia_expan_eventoexpan_evento_idb."') OR expan_evento_id_c = '".$this->expan_franquicia_expan_eventoexpan_evento_idb."') and deleted = 0) g ";  
        $query=$query." WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida; ";
        
        $result = $db -> query($query, true);
        $cont = 0;
        $contAA=0;
        $contA=0;
        $contB=0;
        $contC=0;
        $contD=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $pos=strpos($row["first_name"], 'Dummie');
            if($pos!==false){
                $contD=$contD+1;
            }
            $cont=$cont+1;
            switch($row["rating"]){
                case 1:
                    $contAA=$contAA+1;
                    break;
                case 2:
                    $contA=$contA+1;
                    break;
                case 3:
                    $contB=$contB+1;
                    break;
                case 4:
                    $contC=$contC+1;
                    break;
            }
        }  
        $this->num_solicitudes=$cont;
        $this->total_gestiones=$cont;  
        $this->sol_rating_a_plus=$contAA;
        $this->sol_rating_a=$contA;
        $this->sol_rating_b=$contB;
        $this->sol_rating_c=$contC;
        $this->dummies=$contD;
                    
        
    }

    public function calculoDatosFranquicia(){
        
        $db=DBManagerFactory::getInstance();
        $query="select * from (select count(*) as gestionesfran FROM expan_gestionsolicitudes where estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO." and ";
        $query=$query. " franquicia='".$this->id."' and dummie=0 and deleted=0) a ";
        $query=$query. " join (select count(*) as llamadasPendientes FROM calls where status='Planned' and ";
        $query=$query. " franquicia='".$this->id."' and parent_type='Expan_GestionSolicitudes' and deleted=0)b;";
        
         $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $this->gestionesfran=$row["gestionesfran"];
            $this->llamadaspendientesfran=$row["llamadasPendientes"];
            
        }     
    
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
    
     public function cambioUsuarioGestion($usuarioAnt,$usuarioAct) {
         
        $db = DBManagerFactory::getInstance();
        
        $query = "select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this -> id."' AND assigned_user_id='".$usuarioAnt."'";  
                           
        $resultado = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($resultado)) {
                                                                 
            $idGestion =$row['id'];
            //ANTIGUA FORMA
            //$gestion -> asociarLLamadas("Planned", $dirCuentaAct);
            //$gestion -> asociarTareas("Not Started", $dirCuentaAct);  
            //$this -> eliminarEnlaceConFranquicia($idGestion);
            $this -> asociarLlamadas($idGestion, $usuarioAct);
            $this -> asociarTareas($idGestion, $usuarioAct);
            
            $query="Insert into expan_gestionsolicitudes_audit (id,parent_id,date_created,created_by,field_name,data_type,before_value_string,after_value_string) values ";
            $query=$query. "(UUID(),'".$idGestion."',now(),'1','assigned_user_id','enum','".$usuarioAnt."','".$usuarioAct."')";       
            
            $result = $db -> query($query, true);                
            
        }
        $query="update expan_gestionsolicitudes g join (select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this->id."' "; 
        $query=$query. " AND assigned_user_id='".$usuarioAnt."') b on g.id=b.id set g.assigned_user_id='".$usuarioAct."' where g.deleted=0;";
            
        $result = $db -> query($query);
     }  
     
     function asociarLlamadas($idGestion, $user){
         

        $db = DBManagerFactory::getInstance();    
        
        $query = "update calls c join ";
        $query=$query." (select * from ( ";
        $query=$query." (select c.id FROM calls c,  ";
        $query=$query." expan_franquicia_calls_1_c fc where c.parent_id='".$this->id."' and  ";
        $query=$query." c.status='Planned' and  c.id=fc.expan_franquicia_calls_1calls_idb and c.deleted=0 and fc.deleted=0  ";
        $query=$query." )  ";
        $query=$query."  UNION  ";
        $query=$query." (select c.id FROM calls c, expan_gestionsolicitudes_calls_1_c fc  ";
        $query=$query." where c.parent_id='".$idGestion."' and  ";
        $query=$query." c.status='Planned' and  c.id=fc.expan_gestionsolicitudes_calls_1calls_idb and c.deleted=0 and fc.deleted=0  ";
        $query=$query." ) ";
        $query=$query." )a)b on b.id=c.id set c.assigned_user_id='".$user."'; ";
                
        
         $result = $db -> query($query, true);
     }
     
     function asociarTareas($idGestion, $user){
         

        $db = DBManagerFactory::getInstance();       
        
        $query = "update tasks t join  ";
        $query=$query."        (select * from  ";
        $query=$query."        ((select t.id FROM tasks t,  ";
        $query=$query." expan_franquicia_tasks_1_c ft where t.parent_id='".$this->id."' and  ";
        $query=$query." t.status='Not Started' and  t.id=ft.expan_franquicia_tasks_1tasks_idb and t.deleted=0 and ft.deleted=0  ";
        $query=$query." ) UNION  ";
        $query=$query." (select t.id FROM tasks t,  ";
        $query=$query." expan_gestionsolicitudes_tasks_1_c ft where t.parent_id='".$idGestion."' and  ";
        $query=$query." t.status='Not Started' and  t.id=ft.expan_gestionsolicitudes_tasks_1tasks_idb and t.deleted=0 and ft.deleted=0  ";
        $query=$query." ))a)b on t.id=b.id set assigned_user_id='".$user."'; ";
        
         $result = $db -> query($query, true);
     }
        
    function eliminarEnlaceConFranquicia($idGestion){
        $db = DBManagerFactory::getInstance();       
        $query="delete from expan_franquicia_calls_1_c where expan_franquicia_calls_1calls_idb in ";
        $query=$query. "(select c.id from expan_gestionsolicitudes_calls_1_c gc, expan_gestionsolicitudes g, calls c ";
        $query=$query." where gc.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida=g.id and ";
        $query=$query. " gc.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida='".$idGestion."' and "; 
        $query=$query. " c.parent_id=g.id and gc.expan_gestionsolicitudes_calls_1calls_idb=c.id and c.status='Planned' and "; 
        $query=$query." c.parent_type='Expan_GestionSolicitudes');";
        
         $result = $db -> query($query, true);
        
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
            $gestion -> motivo_parada= Expan_GestionSolicitudes::PARADA_ENESPERA;
            
            //$gestion -> ignore_update_c = true;
            $gestion -> save();
            
        }
    }
    
    public function vueltaExcliente(){
        
         $db = DBManagerFactory::getInstance();
        
         $query = "select id from expan_gestionsolicitudes where deleted=0 and franquicia='".$this -> id."' AND estado_sol=".Expan_GestionSolicitudes::ESTADO_PARADO;  
         $query = $query. " AND motivo_parada=".Expan_GestionSolicitudes::PARADA_ENESPERA;
         
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
    
    
    public function pasoaClienteParado(){
        
         $db = DBManagerFactory::getInstance();
        
         $query = "select id from expan_gestionsolicitudes where deleted=0 AND franquicia='".$this -> id."' AND estado_sol=".Expan_GestionSolicitudes::ESTADO_EN_CURSO;  
        
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);
            
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);

            $gestion -> estado_sol=Expan_GestionSolicitudes::ESTADO_PARADO;
            $gestion -> motivo_parada= Expan_GestionSolicitudes::PARADA_ENESPERA;                       
            
            $gestion -> ignore_update_c = true;
            $gestion -> save();
            
            $gestion->pausarLLamadas();
            $gestion->pausarTareas();
            $gestion->pausarReuniones();           
            
        }
    }
    
    public function vueltaClienteParado(){
        
         $db = DBManagerFactory::getInstance();
        
         $query = "select id from expan_gestionsolicitudes where deleted=0 and franquicia='".$this -> id."' AND estado_sol=".Expan_GestionSolicitudes::ESTADO_PARADO;  
         $query = $query. " AND motivo_parada=".Expan_GestionSolicitudes::PARADA_ENESPERA;
         
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);

            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['id']);
            
            $gestion -> estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
            $gestion -> motivo_parada=null;
            
            $gestion->ignore_update_c = true;
            $gestion->save();
            
            $gestion->restartLLamadas();
            $gestion->restartTareas();
            $gestion->restartReuniones();  
            
        }
    }


    public function lanzaIncidencias($tipoEnv){
               
        $db = DBManagerFactory::getInstance();        
        $fechaHoy=  new DateTime();
        
        //Recogemos todas las incidencias 
        
         $query = "SELECT g.id gid, i.id iid ";
         $query=$query."FROM   expan_gestionsolicitudes g, expan_incidenciacorreo i ";
         $query=$query."WHERE  g.id = i.expan_gestionsolicitudes_id AND i.deleted=0 and g.deleted=0 AND i.deleted=0 AND incidencia_type='".$tipoEnv."'";
         $query=$query." and g.franquicia='".$this->id."'";
        
         $result = $db -> query($query, true);

         while ($row = $db -> fetchByAssoc($result)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Gestion ID-'.$row['id']);
            
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($row['gid']);
                      
            //Si enviamos el C1 es porque no está en estado 2 y por lo tanto si lo pasamos a estado 2 sigue la secuancia                       
            if ($tipoEnv=='C1'){
                
                $GLOBALS['log'] -> info('[ExpandeNegocio][Modificacion de Franquicia]Paso a estado 2');
                
                $gestion -> estado_sol=Expan_GestionSolicitudes::ESTADO_EN_CURSO;
                $gestion->ignore_update_c=false;
                $gestion -> save();                                
            }else{
                $salida = $gestion -> preparaCorreo($tipoEnv);
            }
          
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
        $prueba= $this -> id;
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
        if($tipo=='PasarColaborador'){
            //otra opcion para las fechas
            /*$now = gmdate('Y-m-d H:i:s');  
            $today = new DateTime($now,new DateTimeZone('EUROPE'));
            $today_plus = $today->add(new DateInterval('PT5M')); //add 7 days
            $llamada -> date_start = $today_plus->format('Y-m-d H:i:s');*/
            
            $llamada -> date_start=TimeDate::getInstance()->getNow() -> modify('+5 minutes')-> asDb();
            
        }else{
            $llamada -> date_start = $this -> calcularFechaInicio();
        }
        
        
        //guardar los cambios de la llamada
        $llamada -> ignore_update_c = true;
        $llamada -> save();
        
        $this -> actualizarFechaCreacion($llamada);
        
        $this -> enlazarConFranquicia($llamada);
    }

    function crearTarea($tipo){
        
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
        
        if ($this->existeTarea($tipoTarea, "Not Started")==true){
            $GLOBALS['log'] -> info('[ExpandeNegocio][Creaion de tarea]NO se crea la tarea, ya existe otra igual para la franquicia');
            return;
        }   
        
        $tarea -> parent_id = $this -> id;
        $tarea -> parent_type = 'Expan_Franquicia';
        $tarea -> assigned_user_id = $this -> user_id1_c;
        
        $tarea -> ignore_update_c = true;
        $tarea -> save();
        
        $this -> load_relationship('expan_franquicia_tasks_1');
        $this -> expan_franquicia_tasks_1 -> add($tarea -> id);                       
        $this -> ignore_update_c = true;
        $this -> save();                  
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
        }elseif($this->phone_alternate != ""){
            $telefono = $this -> phone_alternate;
        }elseif($this -> movil_general!=""){
            $telefono = $this -> movil_general;
        }elseif($this->telefono_contacto_2!=""){
            $telefono = $this -> telefono_contacto_2;
        }elseif($this -> telefono_alternativo_2!=""){
            $telefono = $this -> telefono_alternativo_2;            
        }elseif($this ->movil_general_2!=""){
            $telefono = $this -> movil_general_2;
        }
        
        return $telefono;
    }
    
    //Archivamos las llamadas de una franquicia en un determinado status
    function archivarLLamadas($status) {

        $db = DBManagerFactory::getInstance();

        $query = "update calls c set c.status='Archived' where c.parent_id='".$this->id."' and c.status='Planned' and deleted=0;";

        $result = $db -> query($query);
    }
    
    function getNombreModeloNegocio($modNegId){
        
        $campo='modNeg'.$modNegId;   
        $nombreNeg="";     
     
        $db = DBManagerFactory::getInstance();

        $query = "select * from expan_franquicia where id='".$this->id."'";
        
        $result = $db -> query($query, TRUE);
         
        while ($row = $db -> fetchByAssoc($result)) {
            $nombreNeg=$row[$campo];
        }
        return $nombreNeg;
    }
    
}
?>