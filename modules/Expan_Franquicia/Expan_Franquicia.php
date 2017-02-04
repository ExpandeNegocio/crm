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
    
}
?>