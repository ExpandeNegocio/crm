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
        $this->total_empresas_parti=$this->NumEmpresasPart();
        $this->total_empresas_con_stand=$this->NumEmpresas('SI');
        $this->total_empresas_corner=$this->NumEmpresas('CO');
        $this->total_empresas_compartido=$this->NumEmpresas('SC');
        $this->total_empresas_mesa_inde=$this->NumEmpresas('MI');
        $this->total_empresas_mesa_compa=$this->NumEmpresas('MC'); 
        
        $this->empresas_ratio_sg=$this->RatioSolGes(false);
        $this->ratio_medio_formato=$this->RatioMedioFormato();     
        $this->sol_unicas=$this->NumSolUnicas();                      //  2 seg
        $this->total_gest_tablet = $this->TotalGestTablet(false);
        $this->total_gest_Cliente = $this->TotalGestCliente(false);
        $this->total_gest_EN = $this->TotalGestEN(false);
        
        $this->total_gest_fran_nopart = $this->TotalGestFranNoPart(false);
        $this->total_gest_fran_part =  $this->TotalGestFranPart(false); 
        
        $this->total_rating_real_a_plus = $this->GestionesRating(false,1);
        $this->total_rating_real_a = $this->GestionesRating(false,2);
        $this->total_rating_real_b = $this->GestionesRating(false,3);
        $this->total_rating_real_c = $this->GestionesRating(false,4);
        $this->total_rating_real_topo = $this->GestionesRating(false,5);
        $this->total_rating_real_norating = $this->GestionesNoRating(false);
                
        $this->total_rating_orig_a_plus = $this->OriginalRating(false,1);
        $this->total_rating_orig_a = $this->OriginalRating(false,2);
        $this->total_rating_orig_b = $this->OriginalRating(false,3);
        $this->total_rating_orig_c = $this->OriginalRating(false,4);
        $this->total_rating_orig_topo = $this->OriginalRating(false,5);
        $this->total_rating_orig_norating = $this->GestionOrgigiNoRating(false);

        $this->citas_solicitadas = $this->CitasSolicitadas();
        $this->citas_realizadas_con_cita = $this->CitasRealizadasConCita();
        $this->citas_realizadas_sin_cita = $this->CitasRealizadasSinCita();
        $this->citas_canceladas = $this->CitasCanceladas();
        $this->citas_no_acuden = $this->CitasNoAcuden();
        
        if($this->id!=""){//ficha de evento concreto
            $this->addFranquiciasNoInscritas();
        }
        
    }
    
    /**
     * Añade a la lista de franquicias las de los identificadores que devuelve la consulta. 
     * La consulta devuelve los identificadores de las franquicias que tienen gestiones del evento, pero no
     * estaban inscritas en ella.
     */
    public function addFranquiciasNoInscritas(){
    
        $db = DBManagerFactory::getInstance();
        
        //consulta las los identificadores de franquicias que no es
        $query= "select franquicia ";
        $query= $query."from expan_gestionsolicitudes g where g.franquicia not in ( ";
        $query=$query. "select e.expan_franquicia_expan_eventoexpan_franquicia_ida from expan_franquicia_expan_evento_c e "; 
        $query=$query."where e.expan_franquicia_expan_eventoexpan_evento_idb='".$this->id."' and deleted=0";   
        $query=$query.") and deleted=0 AND ((tipo_origen = '1' AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->id."' ) OR "; 
        $query=$query."expan_evento_id_c='".$this->id."');";
        
        $result = $db -> query($query, true);
            
        $this -> load_relationship('expan_franquicia_expan_evento');  
    
        while ($row = $db -> fetchByAssoc($result)) {
            $id = $row["franquicia"];
            $this->  expan_franquicia_expan_evento->add($id);
            
            $query= "update  expan_franquicia_expan_evento_c set participacion=3 where expan_franquicia_expan_eventoexpan_franquicia_ida='".$id. "' ";
            $query= $query." and expan_franquicia_expan_eventoexpan_evento_idb='".$this->id."'";
            $GLOBALS['log'] -> info('[ExpandeNegocio][addFranquiciasNoInscritas] Consulta - ' . $query);
            
           
           $result = $db -> query($query);
        }   
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
            $query=$query."        WHERE  deleted = 0  AND ((tipo_origen = 1 AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c = '".$this->id."')) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        }else{
            $query = "SELECT count(distinct(s.id)) num ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  deleted = 0 AND NOT name LIKE '%Dummie%' AND ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = ";
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
    
    public function NumEmpresasPart(){
        $db = DBManagerFactory::getInstance();
        
        $query = "select count(1) num from expan_franquicia_expan_evento_c  ";
        $query=$query."where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' and not (participacion='' or participacion is null)and deleted=0;";
        
        $result = $db -> query($query, true);
        
        $numEmpresas=0;
        while ($row = $db -> fetchByAssoc($result)) {
            $numEmpresas = $row["num"];
        }
        
        return $numEmpresas;        
    }
    
    public function NumEmpresas($tipo){
        $db = DBManagerFactory::getInstance();
        
        $query = "select count(1) num from expan_franquicia_expan_evento_c  ";
        $query=$query."where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' ";
        $query=$query."AND deleted=0 And formato_participacion='".$tipo."'; ";
        
        $result = $db -> query($query, true);
                
        $numEmpresas=0;
        while ($row = $db -> fetchByAssoc($result)) {
            $numEmpresas = $row["num"];
        }
        
        return $numEmpresas;
    }
    
    
    
    public function RatioSolGes($ConDummies){
        $db = DBManagerFactory::getInstance();   
        
        if ($ConDummies==true){
            $query = "SELECT round(count(s.id)/count(distinct(s.id)),2) num  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  deleted = 0  AND ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c = '".$this->id."')) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida; ";
        }else {
            $query = "SELECT round(count(s.id)/count(distinct(s.id)),2) num  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  NOT name LIKE '%Dummie%' AND deleted = 0  AND ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c = '".$this->id."')) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida; ";
        }
            
        $result = $db -> query($query, true);
                
        $ratioSG=0;
        while ($row = $db -> fetchByAssoc($result)) {
            $ratioSG = $row["num"];
        }    
            
        return $ratioSG;
    }

    public function TotalGestTablet($ConDummies){
            
        $db = DBManagerFactory::getInstance();
        
        if ($ConDummies==true){
            $query = "select count(1) num from (SELECT s.from_import  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND s.from_import=1) a; ";
        }else{
            $query = "select count(1) num from (SELECT s.from_import  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND NOT name LIKE '%Dummie%' AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND s.from_import=1) a; ";
        }
                
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;               
        
    } 
    
    public function TotalGestCliente($ConDummies){
            
        $db = DBManagerFactory::getInstance();
        
        if ($ConDummies==true){
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."')  AND  deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND not franquicia  is null) a; ";
        }else{
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND NOT name LIKE '%Dummie%' AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND not franquicia  is null) a; ";
        }
        

                
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;               
        
    } 
    
    public function TotalGestEN($ConDummies){
            
        $db = DBManagerFactory::getInstance();
        
        if ($ConDummies==true){
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND franquicia  is null and from_import<>1) a; ";
        }else{
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND NOT name LIKE '%Dummie%' AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id ";
            $query=$query."       AND franquicia  is null and from_import<>1) a; ";
        }
        
                
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;
    }      
    
    public function TotalGestFranNoPart($ConDummies){
            
        $db = DBManagerFactory::getInstance();
        if ($ConDummies==true){
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND  ";
            $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
            $query=$query."                              from expan_franquicia_expan_evento_c   ";
            $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' and  ";
            $query=$query."                                 (participacion='' or participacion is null) and deleted=0 ";
            $query=$query."                ) AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id) a; ";
        }else{
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND  ";
            $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
            $query=$query."                              from expan_franquicia_expan_evento_c   ";
            $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' and  ";
            $query=$query."                                 (participacion='' or participacion is null) AND NOT name LIKE '%Dummie%' and deleted=0 ";
            $query=$query."                ) AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id) a; ";
        }       
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;               
        
    } 
    
    public function TotalGestFranPart($ConDummies){
            
        $db = DBManagerFactory::getInstance();
        if ($ConDummies==true){
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND  ";
            $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
            $query=$query."                              from expan_franquicia_expan_evento_c   ";
            $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' and  ";
            $query=$query."                                 not (participacion='' or participacion is null) and deleted=0 ";
            $query=$query."                ) AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id) a; ";
        }else{
            $query = "select count(1) num from (SELECT franquicia  ";
            $query=$query."FROM   expan_solicitud s,  ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
            $query=$query."       users u,  ";
            $query=$query."       (SELECT id  ";
            $query=$query."        FROM   expan_gestionsolicitudes  ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
            $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
            $query=$query."               '".$this->id."') AND  ";
            $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
            $query=$query."                              from expan_franquicia_expan_evento_c   ";
            $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' and  ";
            $query=$query."                                not (participacion='' or participacion is null) AND NOT name LIKE '%Dummie%' and deleted=0 ";
            $query=$query."                ) AND deleted = 0) g  ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
            $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.created_by=u.id) a; ";
        }       
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;               
        
    }
    
    public function RatioMedioFormato(){
                   
        $ratio=0;        
            
        return $ratio;
    }
    
    public function NumSolUnicas(){
        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT count(1) num ";
        $query=$query."FROM   (SELECT   count(1) ";
        $query=$query."        FROM     expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_solicitud s ";
        $query=$query."        WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
        $query=$query."                 AND ((g.tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND g.subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = ";
        $query=$query."               '".$this->id."') OR g.expan_evento_id_c = '".$this->id."') AND g.deleted = 0 AND gs.deleted = 0 AND s.deleted ";
        $query=$query."                 = 0 AND s.dummie = 0 ";
        $query=$query."        GROUP BY s.id having count(1)=1) a; ";
                
        $NumSol=0;
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
            $NumSol = $row["num"];
        } 
        
        return $NumSol;
    }
    
    public function GestionesRating($ConDummies,$tipo){
                
        $db = DBManagerFactory::getInstance();
        
        //Cogemos las originales
        if ($ConDummies==true){
                        $query = "select count(1) num from ( ";
            $query=$query."SELECT s.id sid, date_entered de ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = '".$this->id."') OR ";
            $query=$query."               expan_evento_id_c = '".$this->id."')  ";
            $query=$query."               AND franquicia IN (                                                              ";
            $query=$query."                  SELECT expan_franquicia_expan_eventoexpan_franquicia_ida ";
            $query=$query."                  FROM   expan_franquicia_expan_evento_c ";
            $query=$query."                  WHERE  expan_franquicia_expan_eventoexpan_evento_idb = '".$this->id."' AND deleted = 0) AND deleted ";
            $query=$query."               = 0 AND rating = '".$tipo."') g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
            $query=$query."group by s.id) a;  ";
        }else{
          /*  $query = "select count(1) num  ";
            $query=$query."from expan_gestionsolicitudes where deleted=0 AND not name like '%Dummie%' AND ";
            $query=$query."((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande=".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk='".$this->id."' ) OR ";
            $query=$query."expan_evento_id_c='".$this->id."') AND rating='".$tipo."'; ";*/
            
            $query = "select count(1) num from ( ";
            $query=$query."SELECT s.id sid, date_entered de ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = '".$this->id."') OR ";
            $query=$query."               expan_evento_id_c = '".$this->id."')  ";
            $query=$query."               AND franquicia IN (                                                              ";
            $query=$query."                  SELECT expan_franquicia_expan_eventoexpan_franquicia_ida ";
            $query=$query."                  FROM   expan_franquicia_expan_evento_c ";
            $query=$query."                  WHERE  expan_franquicia_expan_eventoexpan_evento_idb = '".$this->id."' AND NOT name LIKE '%Dummie%' and deleted = 0) AND deleted ";
            $query=$query."               = 0 AND rating = '".$tipo."') g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
            $query=$query."group by s.id) a;  ";
        }
                       
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;     
        
    }
    
    public function OriginalRating($ConDummies,$tipo){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "select count(1) num from ( ";
        $query=$query."select * from ( ";
        $query=$query."SELECT s.id sid, date_entered de ";
        $query=$query."FROM   expan_solicitud s,  ";
        $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
        $query=$query."       (SELECT id  ";
        $query=$query."        FROM   expan_gestionsolicitudes  ";
        $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
        $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
        $query=$query."               '".$this->id."') AND not name like '%Dummie%' AND  ";
        $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
        $query=$query."                              from expan_franquicia_expan_evento_c   ";
        $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' ";
        $query=$query."                ) AND deleted = 0) g  ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
        $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida  AND ";
        $query=$query."       s.rating='".$tipo."' ";
        $query=$query."union  ";
        $query=$query."select parent_id sid, date_created de  ";
        $query=$query."from expan_gestionsolicitudes_audit s,  ";
        $query=$query."expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
        $query=$query."       (SELECT id  ";
        $query=$query."        FROM   expan_gestionsolicitudes  ";
        $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
        $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
        $query=$query."               '".$this->id."') AND not name like '%Dummie%' AND   ";
        $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
        $query=$query."                              from expan_franquicia_expan_evento_c   ";
        $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' ";
        $query=$query."                ) AND deleted = 0) g  ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
        $query=$query."       s.parent_id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
        $query=$query."       field_name='rating' AND after_value_string='".$tipo."')b order by de)  c ";
        
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;    
        
    }
    
    public function GestionesNoRating($ConDummies){
                
        $db = DBManagerFactory::getInstance();
        
        //Cogemos las originales
        if ($ConDummies==true){
            $query = "select count(1) num from ( ";
            $query=$query."SELECT s.id sid, date_entered de ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = '".$this->id."') OR ";
            $query=$query."               expan_evento_id_c = '".$this->id."')  ";
            $query=$query."               AND franquicia IN (                                                              ";
            $query=$query."                  SELECT expan_franquicia_expan_eventoexpan_franquicia_ida ";
            $query=$query."                  FROM   expan_franquicia_expan_evento_c ";
            $query=$query."                  WHERE  expan_franquicia_expan_eventoexpan_evento_idb = '".$this->id."' AND  deleted = 0) AND deleted ";
            $query=$query."               = 0 AND LENGTH(rating)=0)) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
            $query=$query."group by s.id) a;  ";
        }else{
                    
            $query = "select count(1) num from ( ";
            $query=$query."SELECT s.id sid, date_entered de ";
            $query=$query."FROM   expan_solicitud s, ";
            $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
            $query=$query."       (SELECT id ";
            $query=$query."        FROM   expan_gestionsolicitudes ";
            $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk = '".$this->id."') OR ";
            $query=$query."               expan_evento_id_c = '".$this->id."')  ";
            $query=$query."               AND franquicia IN (                                                              ";
            $query=$query."                  SELECT expan_franquicia_expan_eventoexpan_franquicia_ida ";
            $query=$query."                  FROM   expan_franquicia_expan_evento_c ";
            $query=$query."                  WHERE  expan_franquicia_expan_eventoexpan_evento_idb = '".$this->id."' AND NOT name LIKE '%Dummie%' and deleted = 0) AND deleted ";
            $query=$query."               = 0 AND LENGTH(rating)=0) g ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
            $query=$query."group by s.id) a;  ";                         
        }
                       
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;     
        
    }

    public function GestionOrgigiNoRating($ConDummies){
                
        $db = DBManagerFactory::getInstance();
        
        $query = "select count(1) num from ( ";
        $query=$query."select * from ( ";
        $query=$query."SELECT s.id sid, date_entered de ";
        $query=$query."FROM   expan_solicitud s,  ";
        $query=$query."       expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
        $query=$query."       (SELECT id  ";
        $query=$query."        FROM   expan_gestionsolicitudes  ";
        $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
        $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
        $query=$query."               '".$this->id."') AND not name like '%Dummie%' AND  ";
        $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
        $query=$query."                              from expan_franquicia_expan_evento_c   ";
        $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' ";
        $query=$query."                ) AND deleted = 0) g  ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
        $query=$query."       s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
        $query=$query."       LENGTH(s.rating)=0 ";
        $query=$query."union  ";
        $query=$query."select parent_id sid, date_created de  ";
        $query=$query."from expan_gestionsolicitudes_audit s,  ";
        $query=$query."expan_solicitud_expan_gestionsolicitudes_1_c gs,  ";
        $query=$query."       (SELECT id  ";
        $query=$query."        FROM   expan_gestionsolicitudes  ";
        $query=$query."        WHERE  ((tipo_origen = ".Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO." AND subor_expande = ".Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO." AND evento_bk =  ";
        $query=$query."               '".$this->id."') OR expan_evento_id_c =  ";
        $query=$query."               '".$this->id."') AND not name like '%Dummie%' AND  ";
        $query=$query."               franquicia in (select expan_franquicia_expan_eventoexpan_franquicia_ida  ";
        $query=$query."                              from expan_franquicia_expan_evento_c   ";
        $query=$query."                              where expan_franquicia_expan_eventoexpan_evento_idb ='".$this->id."' ";
        $query=$query."                ) AND deleted = 0) g  ";
        $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND   ";
        $query=$query."       s.parent_id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
        $query=$query."       field_name='rating' AND LENGTH(after_value_string)=0)b order by de)  c ";
                       
        $result = $db -> query($query, true);
        
        $numGestiones=0;

        while ($row = $db -> fetchByAssoc($result)) {
            $numGestiones = $row["num"];
        }                
        
        return $numGestiones;     
        
    }

    public function CitasSolicitadas(){

      $db = DBManagerFactory::getInstance();

      $query = "select count(1) num from expan_gestionsolicitudes g, expan_evento e  ";
      $query=$query."where g.deleted=0 and expan_evento_id_c='$this->id' and g.expan_evento_id_c=e.id  and g.date_entered<=e.fecha_celebracion";

      $numGestiones=0;

      $result = $db -> query($query, true);

      while ($row = $db -> fetchByAssoc($result)) {
        $numGestiones = $row["num"];
      }

      return $numGestiones;
    }

    public function CitasRealizadasConCita(){
      $db = DBManagerFactory::getInstance();

      $query = "select count(1) num from expan_gestionsolicitudes g, expan_evento e  ";
      $query=$query."where g.deleted=0 and expan_evento_id_c='$this->id' and g.expan_evento_id_c=e.id ";
      $query=$query."and g.date_entered<e.fecha_celebracion and g.chk_entrevista_previa=1";

      $numGestiones=0;

      $result = $db -> query($query, true);

      while ($row = $db -> fetchByAssoc($result)) {
        $numGestiones = $row["num"];
      }

      return $numGestiones;
    }

  public function CitasRealizadasSinCita(){
    $db = DBManagerFactory::getInstance();

    $query = "select count(1) num from expan_gestionsolicitudes g, expan_evento e  ";
    $query=$query."where g.deleted=0 and expan_evento_id_c='$this->id' and g.expan_evento_id_c=e.id ";
    $query=$query."and g.date_entered>=e.fecha_celebracion and g.chk_entrevista_previa=1";

    $numGestiones=0;

    $result = $db -> query($query, true);

    while ($row = $db -> fetchByAssoc($result)) {
      $numGestiones = $row["num"];
    }

    return $numGestiones;
  }

  public function CitasCanceladas(){
    $db = DBManagerFactory::getInstance();

    $query = "select count(1) num from expan_gestionsolicitudes g, expan_evento e  ";
    $query=$query."where g.deleted=0 and expan_evento_id_c='$this->id' and g.expan_evento_id_c=e.id ";
    $query=$query."and chk_entrevista_previa_cancelada=1";

    $numGestiones=0;

    $result = $db -> query($query, true);

    while ($row = $db -> fetchByAssoc($result)) {
      $numGestiones = $row["num"];
    }

    return $numGestiones;
  }



  public function CitasNoAcuden(){
    $db = DBManagerFactory::getInstance();

    $query = "select count(1) num from expan_gestionsolicitudes g, expan_evento e  ";
    $query=$query."where g.deleted=0 and expan_evento_id_c='$this->id' and g.expan_evento_id_c=e.id ";
    $query=$query."and g.date_entered<=e.fecha_celebracion and g.chk_entrevista_previa=0";

    $numGestiones=0;

    $result = $db -> query($query, true);

    while ($row = $db -> fetchByAssoc($result)) {
      $numGestiones = $row["num"];
    }

    return $numGestiones;
  }

}
?>