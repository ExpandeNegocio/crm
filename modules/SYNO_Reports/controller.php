<?php
/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2009 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

class SYNO_ReportsController extends SugarController
{
    function action_detailview()
    {
        global $app_strings;

        $matrice_ok = FALSE;
        $sql_header_matrice = array();
        $sql_result_matrice = array();

        $sql_header = array();
        $sql_result = array();

        // Exécution de la requêtte SQL
        $db = DBManagerFactory::getInstance();        
        $result = $db->query(from_html($this->bean->description), true, $app_strings['ERR_EXPORT_TYPE'].": <BR>.".$this->bean->description);
        if ($result !== FALSE) {
            $sql_header = $db->getFieldsArray($result);

            // On check si on est en Matrice qu'il n'y a que 3 colonnes
            if ($this->bean->syno_reports_type == 'matrix' && count($sql_header) == 3) {
                $matrice_ok = TRUE;
                $original_datas = array();
            }

            while($val = $db->fetchByAssoc($result, -1, false)) {
                $sql_result[] = $val;
                if ($matrice_ok) {
                    $original_datas[] = $val;
                }
            }

            if ($matrice_ok) {
                // Mode Matrie en plus
                $sql_header_matrice = array();
                $sql_header_matrice_tmp = array();
                $sql_result_matrice = array();
                // On check que Google Maps est activé et que les 2 colonnes clés soient présentes
                if ($this->bean->syno_reports_type == 'geoloc' && !empty($google_maps_api_key) && array_search('dep', $sql_header_matrice) !== FALSE && array_search('counter', $sql_header_matrice) !== FALSE) {
                    $google_maps_ok = TRUE;
                }
                foreach ($original_datas as $original_data) {
                    $nb_column = 0;
                    foreach ($original_data as $key => $val) {
                        switch ($nb_column) {
                            case 0 :
                                $sql_header_matrice_tmp[] = $key;
                                break;
                            case 1 :
                                $sql_header_matrice_tmp[] = $val;
                                break;
                            default : 
                                break 2;
                        }
                        $nb_column++;
                    }
                }
                $sql_header_matrice_tmp = array_unique($sql_header_matrice_tmp);
                foreach ($sql_header_matrice_tmp as $key => $val) {
                    $sql_header_matrice[] = $val;
                }
                $sql_header_matrice_tmp = array();
                foreach ($sql_header_matrice as $key => $val) {
                    $sql_header_matrice_tmp[$val] = $key;
                }

                foreach ($original_datas as $original_data) {
                    $nb_column = 0;
                    $current_matrice_key_1 = '';
                    $current_matrice_key_2 = '';
                    $current_matrice_key_2_value = 0;
                    foreach ($original_data as $key => $val) {
                        switch ($nb_column) {
                            case 0 :
                                $current_matrice_key_1 = $val;
                                break;                                
                            case 1 :
                                $current_matrice_key_2 = $key;
                                break;
                            case 2 :
                                $current_matrice_key_2_value = $val;
                                break 2;
                       }
                       $nb_column++;
                    }
                    $sql_result_matrice[$original_data[$sql_header_matrice[0]]][0] = $original_data[$sql_header_matrice[0]];
                    $sql_result_matrice[$original_data[$sql_header_matrice[0]]][$sql_header_matrice_tmp[$original_data[$current_matrice_key_2]]] = $current_matrice_key_2_value;
                }
                foreach ($sql_header_matrice as $sql_header_matrice_key => $sql_header_matrice_val) {
                    foreach ($sql_result_matrice as $sql_result_matrice_key => $sql_result_matrice_val) {
                        if (!array_key_exists($sql_header_matrice_key, $sql_result_matrice[$sql_result_matrice_key])) {
                            $sql_result_matrice[$sql_result_matrice_key][$sql_header_matrice_key] = 0;
                        }                        
                    }
                }
                
                foreach($sql_result_matrice as $key => $matrice){
                    ksort($matrice);
                    $sql_result_matrice[$key] = $matrice;
                }
            }

        }


        // Transmission des données à la vue
        $this->bean->synoReportsData = array(
            'SQL_HEADER'            => $sql_header,
            'SQL_RESULT'            => $sql_result,
            'SQL_HEADER_MATRICE'    => $sql_header_matrice,
            'SQL_RESULT_MATRICE'    => $sql_result_matrice,
            'MATRICE_OK'            => ($matrice_ok ? 1 : 0),
        );

        $this->view = 'detail';
    }
}
?>
