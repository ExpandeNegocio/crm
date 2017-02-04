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

require_once('custom/include/EnhancedManager/XMLManager.php');

class ExtensionManager {
		
	public function getInstExtensions () {
	
		global $db, $timedate, $sugar_config;

		require_once('config.php');

		$rows = array();
		
		@ob_end_clean();
		@ob_end_clean();

		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
		   header("Content-type: application/xhtml+xml;charset=utf-8");
		} else {
		   header("Content-type: text/xml;charset=utf-8");
		}
		$et = ">";
		echo "<?xml version='1.0' encoding='utf-8'?$et\n";
		echo "<rows>";
		echo "<page>1</page>";
		echo "<total>1</total>";
		echo "<records>1</records>";
		$SQL = "SELECT * FROM em_installed ";
		$result = $db->query( $SQL );

		while($r = $db->fetchByAssoc($result)) {
			$rows[] = $r;
		}
		$rows = self::correctOrder($rows);

		foreach($rows as $row) {
			self::execPreView($row);
			if (self::checkIsUpgradable($row['id'], $row['sub_id'])) {
				$row['add_info'] .= "isUpgradable=1;";
			}
			$row['add_info'] .= "subrelId=$row[sub_id];";

			if ($serialCode = @$sugar_config['dispageExtMan']['serials'][$row['sub_id']]) {
				$serialCode = join('-', str_split($serialCode, 4));
				$row['add_info'] .= "serialCode=$serialCode;";
			}

			echo "<row>";         
			echo "<cell>". $row['id']."</cell>";
		    echo "<cell>0</cell>";
			echo "<cell>". $row['extension_name']."</cell>";
		    echo "<cell>". $row['relase']."</cell>";
		    echo "<cell>". $row['version']."</cell>";
		    echo "<cell>". $timedate->to_display_date(preg_replace('/\..*$/', '', $row['installed']), true, false)."</cell>";
		    echo "<cell>". $timedate->to_display_date(preg_replace('/\..*$/', '', $row['updated']), true, false)."</cell>";
		    echo "<cell>". $timedate->to_display_date(preg_replace('/\..*$/', '', $row['expires']), true, false)."</cell>";
		    echo "<cell></cell>";
		    echo "<cell>". XMLManager::cdata(preg_replace('/\r?\n/', '<br/>', $row['description']))."</cell>";
		    echo "<cell>". @$row['add_info']."</cell>";
		    
		    echo "<cell>". (@empty($row['parent_id']) ? 0 : 1)."</cell>";
		    if(!@$row['parent_id']) $valp = 'NULL'; else $valp = $row['parent_id'];
		    echo "<cell>".XMLManager::cdata($valp)."</cell>";
		    if(@$row['ntype'] == 0) $leaf='true'; else $leaf = 'false';
		    echo "<cell>".$leaf."</cell>";
		    echo "<cell>false</cell>";
		    echo "</row>";
	    }
		echo "</rows>";

	}

	public function correctOrder ($rows) {
		
		$toAssign = $res = $ret = array();

		foreach($rows as $row) {
			$row['parent_id'] = trim($row['parent_id']);
			if (empty($row['parent_id'])) {
				$res[] = $row;
			}
			else {
				if (!isset($toAssign[$row['parent_id']])) $toAssign[$row['parent_id']] = array();
				$toAssign[$row['parent_id']][] = $row;
			}
		}
		if ($toAssign) {
			foreach ($res as $r) {
				$ret[] = $r;
				if (isset($toAssign[$r['id']])) {
					$ret = array_merge($ret, $toAssign[$r['id']]);
				}
			}
		}
		else {
			$ret = $res;
		}
		return $ret;
	}

	public function getInstalledProperties ($id) {

		global $db;

		if (!$db) {
			require_once("custom/include/EnhancedManager/ultraLiteDB.php");
			$db = new ultraLiteDB;
		}
		$result = $db->query("SELECT * FROM em_installed WHERE id = '$id'");
		
		return $db->fetchByAssoc($result);
	}

	public function execPreView (& $row) {

		$filepath = preg_replace('/-restore$/', '-base', $row['extension_path']). "/scripts/pre_view.php";
		if (file_exists($filepath)) {
			require_once($filepath);
			pre_view($row);
		}
	}

	public function checkIsUpgradable ($id, $sub_id) {

		global $_SESSION;
		
		foreach (@(array)$_SESSION['em_ext2install'] as $package) {
			if (@$package['ext_id'] == $id && @$package['subrel_id'] != $sub_id) {
				return true;
			}
		}
		return false;
	}

	public function delEventLog () {
		
		global $_REQUEST, $db;
		
		$db->query("DELETE FROM em_events WHERE id IN ('".str_replace(",", "','", $_REQUEST['id'])."')");
	}
	
	public function getEventLog () {
	
		global $_REQUEST, $db, $timedate, $current_user;
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
		   header("Content-type: application/xhtml+xml;charset=utf-8");
		} else {
		   header("Content-type: text/xml;charset=utf-8");
		}
		$page = $_REQUEST['page'];
		$limit = $_REQUEST['rows'];
		$sidx = $_REQUEST['sidx'];
		$sord = $_REQUEST['sord'];
		if(!$sidx) $sidx =1;
		
		$wh = "1=1";
		$searchOn = ExtensionManager::Strip($_REQUEST['_search']);
		if($searchOn=='true') {
			$sarr = ExtensionManager::Strip($_REQUEST);
			foreach( $sarr as $k=>$v) {
				switch ($k) {
					case 'eobject':
						$wh .= " AND ($k LIKE '%$v%' OR description LIKE '%$v%')";
						break;
					case 'etime':
						$wh .= " AND $k <= '".$timedate->swap_formats("$v 23:59:59", $timedate->get_date_time_format(), $timedate->get_db_date_time_format())."'";
						break;
					case 'id':
					case 'etype':
						$wh .= " AND $k = '$v'";
						break;
				}				
			}
		}
		$et = ">";
		$SQL = "FROM em_events WHERE ".$wh;
		
		$result = $db->query("SELECT COUNT(*) as count ". $SQL);
		$row = $db->fetchByAssoc($result);
		$count = $row['count'];

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
        if ($start<0) $start = 0;
 		echo "<?xml version='1.0' encoding='utf-8'?$et\n";
		echo "<rows>";
		echo "<page>$page</page>";
		echo "<total>$total_pages</total>";
		echo "<records>$count</records>";

		$query = "SELECT * ". $SQL . " ORDER BY ".$sidx." ".$sord;
		$result = $db->limitQuery($query, $start, $limit);
 		
		while($row = $db->fetchByAssoc($result)) {
			echo "<row>";         
		    echo "<cell>". @$row['id']."</cell>";
		    echo "<cell>". @$row['etype']."</cell>";
		    echo "<cell>". @$row['eobject']."</cell>";
		    echo "<cell>". $timedate->swap_formats(@$row['etime'], $timedate->dbDayFormat . ' ' . $timedate->dbTimeFormat, $timedate->get_date_format($current_user) . ' H:i:s') ."</cell>";
		    echo "<cell>". XMLManager::cdata(@$row['description'])."</cell>";
		    echo "</row>";
	    }
		echo "</rows>";

	}

	public function addEventLog($type, $object = 'Unknown error', $description) {

		global $db;
				
		$id = method_exists($db, 'create_guid') ? $db->create_guid() : create_guid();
		$db->query("INSERT INTO em_events (id, etype, eobject, etime, description) VALUES ('$id', '$type', '".@$db->quote($object)."', CURRENT_TIMESTAMP, '".@$db->quote($description)."')");
	}

	private function Strip($value)
	{
		if(get_magic_quotes_gpc() != 0)
	  	{
	    	if(is_array($value))  
				if ( ExtensionManager::array_is_associative($value) )
				{
					foreach( $value as $k=>$v)
						$tmp_val[$k] = stripslashes($v);
					$value = $tmp_val; 
				}				
				else  
					for($j = 0; $j < sizeof($value); $j++)
	        			$value[$j] = stripslashes($value[$j]);
			else
				$value = stripslashes($value);
		}
		return $value;
	}
	
	private function array_is_associative ($array)
	{
	    if ( is_array($array) && ! empty($array) )
	    {
	        for ( $iterator = count($array) - 1; $iterator; $iterator-- )
	        {
	            if ( ! array_key_exists($iterator, $array) ) { return true; }
	        }
	        return ! array_key_exists(0, $array);
	    }
	    return false;
	}
}
?>
