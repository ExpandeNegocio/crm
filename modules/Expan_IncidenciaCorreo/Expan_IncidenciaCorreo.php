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
require_once('modules/Expan_IncidenciaCorreo/Expan_IncidenciaCorreo_sugar.php');
class Expan_IncidenciaCorreo extends Expan_IncidenciaCorreo_sugar {
	
	function Expan_IncidenciaCorreo(){	
		parent::Expan_IncidenciaCorreo_sugar();
	}
	
    function RellenoGestion($gestion,$tipo){
        
        if ($this->ExisteIncidencia($gestion,$tipo)==false && 
            $this->ExisteEnvioAnterior($gestion,$tipo)==false){
                
            $this->expan_gestionsolicitudes_id=$gestion->id;
            $this->name=$gestion->name.'-'.$tipo;
            $this->incidencia_type=$tipo;
            
            $franq= new Expan_Franquicia();
            $franq->retrieve($gestion->franquicia);        
            $this->assigned_user_id=$franq->assigned_user_id;
            
            $this -> ignore_update_c = true;
            $this -> save(); 
        }        
    }
    
    function ExisteIncidencia($gestion,$tipo){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "select * from expan_incidenciacorreo  ";
        $query=$query."where expan_gestionsolicitudes_id='".$gestion->id."' AND incidencia_type='".$tipo."' AND deleted=0; ";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Consulta-'.$query);

        $result = $db -> query($query, true);
        
        $existeInci=false;

        while ($row = $db -> fetchByAssoc($result)) {
            $existeInci=true;
        }
        
        return $existeInci;
    }
    
    function ExisteEnvioAnterior($gestion,$tipo){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT e.id,et.name,et.type from emails e, email_templates et  ";
        $query=$query."WHERE et.subject=e.name and parent_id='".$gestion->id."' AND et.type='".$tipo."' ";
        $query=$query."AND e.deleted=0 AND et.deleted=0 ";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Consulta-'.$query);

        $result = $db -> query($query, true);
        
        $existeEnvio=false;

        while ($row = $db -> fetchByAssoc($result)) {
            $existeEnvio=true;
        }
        
        return $existeEnvio;
        
    }
    
}
?>