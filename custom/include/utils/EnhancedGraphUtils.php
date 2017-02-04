<?php


/*******************************************************************************
 * This file is integral part of the project "Extension Manager" for SugarCRM.
 * 
 * "Extension Manager" is a project created by: 
 * Dispage - Patrizio Gelosi
 * Via A. De Gasperi 91 
 * P. Potenza Picena (MC) - Italy
 * 
 * (Hereby referred to as "DISPAGE")
 * 
 * Copyright (c) 2010-2012 DISPAGE.
 * 
 * The contents of this file are released under the GNU General Public License
 * version 3 as published by the Free Software Foundation that can be found on
 * the "LICENSE.txt" file which is integral part of the SUGARCRM(TM) project. If
 * the file is not present, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You may not use the present file except in compliance with the License.
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied.  See the License
 * for the specific language governing rights and limitations under the
 * License.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * Dispage" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by Dispage".
 * 
 ******************************************************************************/

class EnhancedGraphUtils {
	
	public function liteSelect ($options, $params = array()) {
		
		$res = '';

		if (array_key_exists('selected', $params)) {
			$selected = $params['selected'];
			unset($params['selected']);
		} 
		
		$res .= '<select ';
		$res .= join(' ', array_map(create_function('$k, $v', 'return "$k=\'$v\'";'), array_keys($params), $params));
		$res .= '>';
		if (is_array($options)) {
			foreach ($options as $k => $v) {
				settype($k, "string");
				$res .= "<option value='$k'";
				if (is_array($selected) ? in_array($k, $selected, true) : ($selected === $k)) {
					$res .= " selected='1'";
				}
				$res .= ">$v</option>";
			}
		}
		$res .= '</select>';
		
		return $res;
	}
}

?>
