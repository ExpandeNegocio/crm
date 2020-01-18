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
require_once('modules/Expma_Mailing/Expma_Mailing_sugar.php');
class Expma_Mailing extends Expma_Mailing_sugar {
	
	function __construct(){
		parent::Expma_Mailing_sugar();
	}
    
    function actualizarMailing(){
        
        $this->correos_ok=$this->calculaCorreosCorrectos();
        $this->correos_ko=$this->calculaCorreosIncorrectos();
        $this->total_correos=$this->calculaCorreosTotales();
        $this->correos_protocolo=$this->calculaNoEnviosProtocolo();
        $this->n_reenvios=$this->n_reenvios+1;
        $this-> fecha_ultimo_envio = TimeDate::getInstance()->nowDb();
        if ($this-> fecha_primer_envio==null){
            $this-> fecha_primer_envio= TimeDate::getInstance()->nowDb();
        
        }
        $this->actualizaCorreosGestionMailig($this->id,$this->correos_ok);
    }

    private function actualizaCorreosGestionMailig($idMailing,$correos_ok){

      $db = DBManagerFactory::getInstance();
      $query = "update expan_mailings set correos_enviados=$correos_ok where envio='$idMailing'; ";
      $result = $db -> query($query);
    }
    
    private function calculaCorreosCorrectos(){
        
        $numCorreosOk=0;
        
        $db = DBManagerFactory::getInstance();
                
        $query = "SELECT count(1) num ";
        $query=$query."FROM   expma_mailing_expan_solicitud_c ";
        $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$this->id."' AND enviado=1 AND deleted=0; ";    
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaCorreosCorrectos query:' . $query);    
        
        $resultSol = $db -> query($query, true);
    
        while ($rowSol = $db -> fetchByAssoc($resultSol)) {                     
           $numCorreosOk=$rowSol["num"];
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]Num Correos Correctos:' . $numCorreosOk); 
        
        return $numCorreosOk;        
    }
    
     private function calculaCorreosIncorrectos(){
        
        $numCorreosKo=0;
        
        $db = DBManagerFactory::getInstance();
                
        $query = "SELECT count(1) num ";
        $query=$query."FROM   expma_mailing_expan_solicitud_c ";
        $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$this->id."' AND not (motivo_no_envio is null OR motivo_no_envio='Por protocolo') AND deleted=0; ";
        $query=$query." "; 
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaCorreosCorrectos query:' . $query);   
        
        $resultSol = $db -> query($query, true);
    
        while ($rowSol = $db -> fetchByAssoc($resultSol)) {                     
           $numCorreosKo=$rowSol["num"];
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaCorreosCorrectos query:' . $numCorreosKo); 
        
        return $numCorreosKo;
        
    }
     
    private function calculaCorreosTotales(){
        
        $numCorreosTotales=0;
        
        $db = DBManagerFactory::getInstance();
                
        $query = "SELECT count(1) num ";
        $query=$query."FROM   expma_mailing_expan_solicitud_c ";
        $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$this->id."' AND deleted=0; "; 
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaCorreosTotales query:' . $query);   
        
        $resultSol = $db -> query($query, true);
    
        while ($rowSol = $db -> fetchByAssoc($resultSol)) {                     
           $numCorreosTotales=$rowSol["num"];
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaCorreosTotales query:' . $numCorreosTotales); 
        
        return $numCorreosTotales;
        
    }

    private function calculaNoEnviosProtocolo(){
        
        $numNoEnviosProtocolo=0;
        
        $db = DBManagerFactory::getInstance();
                
        $query = "SELECT count(1) num ";
        $query=$query."FROM   expma_mailing_expan_solicitud_c ";
        $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$this->id."' AND motivo_no_envio='Por protocolo'AND deleted=0; "; 
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaNoEnviosProtocolo query:' . $query);   
        
        $resultSol = $db -> query($query, true);
    
        while ($rowSol = $db -> fetchByAssoc($resultSol)) {                     
           $numNoEnviosProtocolo=$rowSol["num"];
        }

        $GLOBALS['log'] -> info('[ExpandeNegocio][Mailing]calculaNoEnviosProtocolo query:' . $numNoEnviosProtocolo); 
        
        return $numNoEnviosProtocolo;
        
    }
	
}
?>