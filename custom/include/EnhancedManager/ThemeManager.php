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

class ThemeManager {

	public $sugarThemeMgm;


	private function getSugarThemeColor () {

		if ($this->sugarThemeMgm && (isset($_SESSION['authenticated_user_theme']) ? ($_SESSION['authenticated_user_theme'] == 'Sugar') : isset($_SESSION['admin_PREFERENCES']) && isset($_SESSION['admin_PREFERENCES']['global']['user_theme']) && $_SESSION['admin_PREFERENCES']['global']['user_theme'] == 'Sugar') || !($links = $this->getSugarThemeCSS())) return 'aaaaaa';

		$foundColor = 'aaaaaa';
		
		$styleRX = $this->sugarThemeMgm ? '#(?>subModuleList|moduleList\.yuimenubar[^\{]*)' : '#(?>subModuleList|subtabs|Shortcuts_globalLinks)';

		for ($i = count($links) -1; $i >= 0; $i--) {
			$cssFile = preg_replace('#^cache/#', '', $links[$i]);
			if (!file_exists($cssFile)) continue;
			$content = file_get_contents($cssFile);
			if (preg_match('/.*'.$styleRX.'\s*\{[^\}]*?background-color:\s*#([0-9a-f]*)/i', $content, $color)) {
				$foundColor = $color[1];
				break;
			}
		}
		return $foundColor;
	}

	private function getSugarThemeCSS () {

		if (class_exists('SugarThemeRegistry')) {
			$cssLinks = SugarThemeRegistry::current()->getCSS();
			if (preg_match_all('/href="([^?"]*)/', $cssLinks, $links)) {
				return $links[1];
			}
			else {
				return array();
			}
		}
		else {
			return array(
				"themes/".$_SESSION['authenticated_user_theme']."/style.css",
				"themes/".$_SESSION['authenticated_user_theme']."/colors.sugar.css",
			);
		}
	}

	private function findBestMatch () {

		require_once('custom/include/EnhancedManager/ColorManager.php');
		
		$distance = 99999999;
		$EMTheme = 'aaaaaa';
		$ccomp = new ColorManager;

		if ($sugarColor = $this->getSugarThemeColor()) {

			$EMTColors = $this->getEMThemeColors();

			foreach ($EMTColors as $f) {
				$d = $ccomp->colorDistance($f, $sugarColor);
				if ($d < $distance) {
					$EMTheme = $f;
					$distance = $d;
				}
			}
		}
		return $EMTheme;
	}

	public function getEMThemeColors () {
		
		$themeDir = 'custom/include/EnhancedManager/css/ui.themes';
		$res = array();

		foreach (scandir($themeDir) as $f) {
			$tg = "$themeDir/$f";
			if ($f == '.' || $f == '..' || !is_dir($tg)) continue;
			$res[] = preg_replace('/^.*\./', '', $f);
		}
		return $res;
	}

	public function sugarColorChanged () {
		
		if ($this->sugarThemeMgm) {

			return !isset($_SESSION['EM_authenticated_user_theme_old']) || @$_SESSION['EM_authenticated_user_theme_old'] != @$_SESSION['authenticated_user_theme'];
		}
		else {
			$colorChanged = isset($_SESSION['authenticated_user_theme_color']) && (!isset($_SESSION['authenticated_user_theme_color_old']) || $_SESSION['authenticated_user_theme_color'] != $_SESSION['authenticated_user_theme_color_old'] );

			if ($colorChanged) {
				$_SESSION['authenticated_user_theme_color_old'] = $_SESSION['authenticated_user_theme_color'];
			}
			return @$_SESSION['theme_changed'] || $colorChanged;
		}
	}

	public function assignTheme () {

		global $sugar_config, $sugar_version, $sugar_flavor;

		if (!$sugar_config) require_once('config.php');
		if (!$sugar_version) include('sugar_version.php');

		$this->sugarThemeMgm = ($sugar_version > '6' && $sugar_flavor != 'CE');

		if (@$_REQUEST["emOptionTheme"]) {
			$_SESSION['EM_Theme'] = $_REQUEST["emOptionTheme"];
		}
		if (!@$_REQUEST["emOptionTheme"] && @$sugar_config['dispageExtMan']['emOptionTheme'] && $sugar_config['dispageExtMan']['emOptionTheme'] != 'auto') {
			$_SESSION['EM_Theme'] = $sugar_config['dispageExtMan']['emOptionTheme'];
		}
		elseif (!@$_SESSION['EM_Theme'] || @$_REQUEST["emOptionTheme"] == 'auto' || $this->sugarColorChanged()) {
			$_SESSION['EM_Theme'] = $this->findBestMatch();
		}
		if ($this->sugarThemeMgm) {
			if (isset($_SESSION['authenticated_user_theme'])) {
				$_SESSION['EM_authenticated_user_theme_old'] = $_SESSION['authenticated_user_theme'];
			}
			else {
				$_SESSION['EM_authenticated_user_theme_old'] = '';
			}
		}

	}
}
?>
