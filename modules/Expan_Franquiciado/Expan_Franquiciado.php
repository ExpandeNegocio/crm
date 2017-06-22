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
require_once('modules/Expan_Franquiciado/Expan_Franquiciado_sugar.php');
class Expan_Franquiciado extends Expan_Franquiciado_sugar {
    
    function Expan_Franquiciado(){    
        parent::Expan_Franquiciado_sugar();
    }
    
    function existeFranquiciado($solId){
            
        $db = DBManagerFactory::getInstance();
        
        $sql="SELECT id as idF FROM   expan_franquiciado f, ";
        $sql=$sql." (select phone_home as phf, phone_mobile as pmf from expan_solicitud where id='".$solId."') b ";
        $sql=$sql." WHERE  (phone_home =phf OR phone_home=pmf OR phone_mobile =phf OR phone_mobile=pmf) AND deleted=0;";
                 
        $resultSol = $db->query($sql, true);
                
        while ($rowSol = $db->fetchByAssoc($resultSol)){
             return $rowSol["idF"]; 
        }
        return false;
    }
    function crearFranquiciado($solicitud){
        
        $franquiciado=new Expan_Franquiciado();
        $franquiciado -> date_entered=TimeDate::getInstance()->getNow()->asDb();
        $franquiciado -> first_name= $solicitud->first_name;
        $franquiciado -> last_name=$solicitud->last_name;
        $franquiciado -> salutation =$solicitud->salutation;
        $franquiciado -> phone_home=$solicitud ->phone_home;
        $franquiciado -> phone_mobile=$solicitud->phone_mobile;
        $franquiciado -> no_correos=$solicitud->no_correos;
        $franquiciado -> no_newsletter=$solicitud->no_newsletter;
        $franquiciado -> skype=$solicitud->skype;
        $franquiciado -> email1=$solicitud->email1;
        $franquiciado -> email2=$solicitud->email2;
        $franquiciado -> pais=$solicitud->pais_c;
                  
        //guardar los cambios del franquiciado
        $franquiciado -> ignore_update_c = true;
        $franquiciado -> save();
        return $franquiciado;
    }
}
?>