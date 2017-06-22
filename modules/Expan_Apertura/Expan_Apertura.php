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
require_once('modules/Expan_Apertura/Expan_Apertura_sugar.php');
class Expan_Apertura extends Expan_Apertura_sugar {
    
    function Expan_Apertura(){    
        parent::Expan_Apertura_sugar();
    }
    
    
    function existeApertura($nombre){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "select id from expan_apertura where name='".$nombre."' and deleted=0; ";
        
        $result = $db -> query($query, true);
        
        while ($row = $db -> fetchByAssoc($result)) {
                
            return true;
                 
        }
            return false;
    }
    
    function crearApertura($nombre, $solicitud, $franquiciado){
        
        $apertura=new Expan_Apertura();
        $apertura -> name= $nombre;
        $apertura -> date_entered=TimeDate::getInstance()->getNow()->asDb();
        $apertura -> abierta=0;
        $apertura -> tipo_apertura=3;
        $apertura -> provincia_apertura=$solicitud -> provincia_apertura_1;
        $apertura -> localidad_apertura -> $solicitud -> localidad_apertura_1;
        $apertura -> franquicia= $bean -> franquicia;
        $apertura -> expan_franquiciado_id=$franquiciado;
        $apertura -> ignore_update_c = true;
        $apertura -> save();
    }
}
?>