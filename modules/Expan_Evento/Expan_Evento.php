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
require_once('modules/Expan_Evento/Expan_Evento_sugar.php');
class Expan_Evento extends Expan_Evento_sugar {
	
	function Expan_Evento(){	
		parent::Expan_Evento_sugar();
	}
	
    public function fill_in_additional_detail_fields() {
        parent::fill_in_additional_detail_fields();
        
        $this->total_solicitudes=$this->NumSolicitudes(false);
        $this->total_gestiones=$this->NumGestiones(false);
        
    }
    
    public function NumGestiones($ConDummies){
        $db = DBManagerFactory::getInstance();
        
        
        //Cogemos las originales
        if ($ConDummies==true){
            $query = "select count(1) num  ";
            $query=$query."from expan_gestionsolicitudes where deleted=0 AND ";
            $query=$query."((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->id."' ) OR ";
            $query=$query."expan_evento_id_c='".$this->id."'); ";
        }else{
            $query = "select count(1) num  ";
            $query=$query."from expan_gestionsolicitudes where deleted=0 AND not name like '%Dummie%' AND ";
            $query=$query."((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->id."' ) OR ";
            $query=$query."expan_evento_id_c='".$this->id."'); ";
        }
                       
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;  
    }
    
    public function NumSolicitudes($ConDummies){
        $db = DBManagerFactory::getInstance();
        
        if ($ConDummies==true){
            $query = "SELECT count(distinct(s.id)) num ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  deleted = 0  AND ((tipo_origen = 1 AND subor_expande = 7 AND evento_bk = ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c = '".$this->id."')) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        }else{
            $query = "SELECT count(distinct(s.id)) num ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  deleted = 0 AND NOT name LIKE '%Dummie%' AND ((tipo_origen = 1 AND subor_expande = 7 AND evento_bk = ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c = '".$this->id."')) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        }
                       
        $result = $db -> query($query, true);
        
        $numSolicitudes=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numSolicitudes = $row["num"];
        } 
        
        return $numSolicitudes;  
    }   
    
}
?>