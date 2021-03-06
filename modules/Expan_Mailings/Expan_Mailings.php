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
require_once('modules/Expan_Mailings/Expan_Mailings_sugar.php');
class Expan_Mailings extends Expan_Mailings_sugar {
    
    function Expan_Mailings(){    
        parent::Expan_Mailings_sugar();
    }   
    
     public function fill_in_additional_detail_fields() {
        parent::fill_in_additional_detail_fields();
        
    $this->total_gestiones = $this->get_total_gestiones();    
    $this->total_gestiones_ultimo_mes = $this->get_total_gestiones_ultimo_mes();
    $this->gestiones_existentes = $this->get_gestiones_existentes();
    $this->gestiones_existentes_mailing = $this->get_gestiones_existentes_mailing();
    $this->gestiones_encurso = $this->get_gestiones_encurso();
    $this->gestiones_paradas = $this->get_gestiones_paradas();
    $this->gestiones_descartadas = $this->get_gestiones_descartadas();
    $this->gestiones_descartadas_nosector = $this->get_gestiones_descartadas_nosector();
    $this->gestiones_descartadas_nocadena = $this->get_gestiones_descartadas_nocadena();
    $this->solicitudes_aplus = $this->get_solicitudes_aplus();
    $this->solicitudes_a = $this->get_solicitudes_a();
    $this->solicitudes_b = $this->get_solicitudes_b();
    $this->solicitudes_c = $this->get_solicitudes_c();
    $this->solicitudes_t = $this->get_solicitudes_t();
    $this->solicitudes_no_rating = $this->get_solicitudes_no_rating();
                   
    }

    private function get_total_gestiones(){
        $cont=0;
                       
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
       
    
    private function get_total_gestiones_ultimo_mes(){
        $cont=0;
        
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() and deleted=0 ";
                
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;  
    }
    
    private function get_gestiones_existentes(){
        $cont=0;
                       
                $query = "select count(1) num  ";
        $query=$query."from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs   ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.tipo_origen<>g.tipo_origen and s.subor_mailing <> g.subor_mailing And ";
        $query=$query."g.subor_mailing='".$this->id."'  AND g.deleted=0 and s.deleted=0  ";     
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_gestiones_existentes_mailing(){
        $cont=0;
    
        $query = "SELECT count(1) num ";
        $query=$query."FROM   (SELECT   count(1) num ";
        $query=$query."        FROM     expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
        $query=$query."        WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query=$query."                 AND s.deleted = ";
        $query=$query."                 0 AND g.deleted = 0 AND g.subor_mailing = '".$this->id."' ";
        $query=$query."        GROUP BY s.id, g.date_entered ";
        $query=$query."        HAVING   count(1) > 1) a ";
        
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_gestiones_encurso(){
        $cont=0;
    
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
        $query=$query."AND estado_sol=2";
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
        
        return $cont;
    }
    
    private function get_gestiones_paradas(){
        $cont=0;
    
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
        $query=$query."AND estado_sol=3";
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_gestiones_descartadas(){
        $cont=0;
    
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
        $query=$query."AND estado_sol=4";
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_gestiones_descartadas_nosector(){
        $cont=0;
        
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
        $query=$query."AND estado_sol=4 and motivo_descarte=6 ";
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_gestiones_descartadas_nocadena(){
        $cont=0;
        
        $query = "select count(1) num from expan_gestionsolicitudes where subor_mailing='".$this->id."' and deleted=0 ";     
        $query=$query."AND estado_sol=4 and motivo_descarte=3 ";
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_solicitudes_aplus(){
        $cont=0;
        
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating=1 AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_solicitudes_a(){
        $cont=0;
        
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating=2 AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_solicitudes_b(){
        $cont=0;
        
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating=3 AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_solicitudes_c(){
        $cont=0;
    
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating=4 AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
    private function get_solicitudes_t(){
        $cont=0;
    
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating=5 AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
        
        return $cont;
    }
    
    private function get_solicitudes_no_rating(){
        $cont=0;
        
        $query = "select count(1) num from expan_solicitud s, expan_gestionsolicitudes g,expan_solicitud_expan_gestionsolicitudes_1_c gs  ";
        $query=$query."where  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."g.subor_mailing='".$this->id."' AND s.rating is null AND g.deleted=0 and s.deleted=0 ";           
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
    
        return $cont;
    }
    
}
?>