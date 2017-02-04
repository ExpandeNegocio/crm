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

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings, $paramArray, $JSUniqueCodes, $sugar_config;

require_once('custom/include/EnhancedManager/EnhancedManager.php');
require_once('custom/include/EnhancedManager/ThemeManager.php');
require_once('custom/include/utils/EnhancedGraphUtils.php');

$optionSettings = array(
	'autologin' => 'optionLoginChecked',
	'autoclose' => 'optionAutoClose',
	'disautoupdate' => 'optionAutoUpdate',
	'encodeResponse' => 'emOptionEncodeResponse',
);

if(!EnhancedManager::isAdminEquiv()){
	sugar_die("Access denied to the user");
}

$json = getJSONobj();

if (!isset($app_strings['LBL_DISPAGE_MANAGER_EXTENSION'])) {
	ob_start();
	require('custom/Extension/application/Ext/Language/en_us.ExtensionManager.php');
	ob_end_clean();
}

if (isset($_REQUEST['em_option_save'])) {

	EnhancedManager::saveOptions($_REQUEST['em_option_username'], $_REQUEST['em_option_password'], @$_REQUEST['em_option_autologin'], 
		array_merge(array(
			'autoclose' => isset($_REQUEST['em_option_autoclose']) ? 1 : 0, 
			'disautoupdate' => isset($_REQUEST['em_option_disautoupdate']) ? 1 : 0,
			'emOptionEncodeResponse' => isset($_REQUEST['emOptionEncodeResponse']) ? 1 : 0,
		),
		array_intersect_key($_REQUEST, array_flip(array('emOptionTries', 'emOptionTimeout', 'emOptionRespTimeout', 'emOptionTheme', 'emOptionLowerAdmin', 'emOptionProxyHost', 'emOptionProxyPort', 'emOptionProxyUsername', 'emOptionProxyPassword'))))
	);
}

EnhancedManager::retrieveLoginData();

foreach ($optionSettings as $confName => $var) {
	if (@$paramArray[$confName]) {
		$$var = 'checked="checked"';
	}
}

$AdminUsers = EnhancedManager::getAdminUsers();
$lowerAdmin = @$sugar_config['dispageExtMan']['emOptionLowerAdmin'];

$EMThemeColors = ThemeManager::getEMThemeColors();
$selectedTheme = @$sugar_config['dispageExtMan']['emOptionTheme'] ? $sugar_config['dispageExtMan']['emOptionTheme'] : 'auto';

?>

<script type="text/javascript" src="custom/include/EnhancedManager/js/emExtensionManager.js?s=<?php echo $JSUniqueCodes["Extension Manager"] ?>"></script>
<script type="text/javascript" src="custom/include/EnhancedManager/js/urlEncode.js?s=<?php echo $JSUniqueCodes["Extension Manager"] ?>"></script>
<script language="JavaScript" src="custom/include/EnhancedManager/js/grUtils.js?s=<?php echo $JSUniqueCodes["Extension Manager"] ?>"></script>
<script language="JavaScript" src="custom/include/jquery/tooltip/wtooltip.min.js?s=<?php echo $JSUniqueCodes["Extension Manager"] ?>"></script>
<script language="javascript">

var currentSugarVer = '<?php echo $GLOBALS['sugar_version'] ?>';
var currentSugarLang = '<?php echo $GLOBALS['current_language'] ?>';

var dateFormat = '<?php echo preg_replace('/yyy+/', 'yy', $timedate->get_user_date_format()) ?>';
var highlightTitle = '<?php echo @$_REQUEST['highlight'] ?>';
var emLang = <?php echo $json->encode($app_strings['LBL_DISPAGE_MANAGER_EXTENSION']) ?>;

extMan.selectedTheme = '<?php echo $selectedTheme ?>';
instConsole.DSPUid = '<?php echo $paramArray['emuser'] ?>';
instConsole.DSPMD5Pwd = '<?php echo $paramArray['empwd'] ?>';

d$.preloadImages([
	"custom/include/EnhancedManager/img/loadingRound.gif"
]);

</script>
	<div class="moduleTitle em-admin-title">
		<h2>Dispage Extension Manager: Administration</h2>
		<span><a href="http://www.dispage.com" target="_blank"><img width="91" height="25" border="0" src="custom/include/EnhancedManager/img/powered-by-dispage.png" alt="Powered by Dispage"/></a></span>
	</div>
	<div id="emPanel" class="ui-layout-center ui-helper-reset ui-widget-content" >
	<div id="emDEMWaiting"><div id='em-waiting-generic'><span class="emDEMWaitingMsg">Loading</span><img src='custom/include/EnhancedManager/img/loadingRound.gif' /></div></div>
	<div id="switcher">
            <ul>
                <li><a href="#fragment-1"><span>Installed Extensions</span></a></li>
                <li><a href="#fragment-2"><span>Available Extensions</span></a></li>

                <li><a href="#fragment-3"><span>Event Manager</span></a></li>
                <li><a href="#fragment-4"><span>Options</span></a></li>
            </ul>
            <div id="fragment-1">
    	<table id="treegrid1" class="scroll" cellpadding="0" cellspacing="0"></table> 
    	<div id="ptreegrid1" class="scroll"></div> 
		<div class="dem-panels">
			<input type="button" class="button" value="Uninstall Selected" onclick="instConsole.multipleUninst = null; extMan.EMUninstallSelected()"/> 

		</div>
            </div>
			<div id="fragment-2">
    	<table id="treegrid2" class="scroll" cellpadding="0" cellspacing="0"></table>
    	<div id="ptreegrid2" class="scroll"></div> 
		<div class="dem-panels">
			<input type="button" class="button" value="Install Selected" onclick="instConsole.multipleInst = null; extMan.EMInstallSelected()"/><br/>
		</div>
		<div class="dem-panels">
			<input type="checkbox" id="em-hide-installed" checked="checked" onclick="extMan.EMToggleHideInstalled()"/> Hide installed Extensions
		</div>
             </div>

			<div id="fragment-3">
    	<table id="grid3" class="scroll" cellpadding="0" cellspacing="0"></table> 
    	<div id="pgrid3" class="scroll" style="text-align:center;"></div>
            </div>
            <div id="fragment-4">
				<form name="emoptions" method="post">
					<div class="ui-widget-content ui-corner-all em-option-panel">
						<div class="em-options-title em-login-options-title">Login Options</div>
						<table class="em-options-table">
							<tr>
								<td width="200">Username:</td>
								<td><input type="text" id="em-option-username" name="em_option_username" value="<?php echo @$paramArray['emuser'] ?>"/></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="password" id="em-option-password" name="em_option_password" value="<?php echo @$paramArray['empwd'] ?>"/></td>
							</tr>
							<tr>
								<td>Automatic login:</td>
								<td>
									<input type="checkbox" id="em-option-autologin" name="em_option_autologin" value="1" <?php echo @$optionLoginChecked ?>/>
								</td>
							</tr>
							<tr>
								<td>Hide login popup to Non-Admin Users:</td>
								<td>
									<input type="checkbox" id="em-option-autoclose" name="em_option_autoclose" value="1" <?php echo @$optionAutoClose ?>/>
								</td>
							</tr>
							<tr>
								<td>Disable automatic check for updates:</td>
								<td>
									<input type="checkbox" id="em-option-autoupdate" name="em_option_disautoupdate" value="1" <?php echo @$optionAutoUpdate ?>/>
								</td>
							</tr>
							<tr>
								<td>Apply Non-Admin rules to the Admin Users:</td>
								<td>
									<?php echo EnhancedGraphUtils::liteSelect($AdminUsers, array('name' => "emOptionLowerAdmin[]", 'multiple' => 1, 'size' => 3, 'selected' => $lowerAdmin)); ?>
								</td>
							</tr>
						</table>
					</div>
					<div class="ui-widget-content ui-corner-all em-option-panel">
						<div class="em-options-title em-login-options-title" style="width: 110px;">Connection Options</div>
						<table class="em-options-table">
							<tr>
								<td>Encode Response:</td>
								<td>
									<input type="checkbox" id="em-option-encode" name="emOptionEncodeResponse" value="1" <?php echo @$emOptionEncodeResponse ?>/>
								</td>
							</tr>
							<tr>
								<td width="200">Connection attempts:</td>
								<td><input type="text" id="em-option-tries" name="emOptionTries" size="4" value="<?php echo @$paramArray['emOptionTries'] ?>"/></td>
							</tr>
							<tr>
								<td>Timeout (sec.):</td>
								<td><input type="text" id="em-option-timeout" name="emOptionTimeout" size="4" value="<?php echo @$paramArray['emOptionTimeout'] ?>"/></td>
							</tr>
							<tr>
								<td>Response Timeout (sec.):</td>
								<td><input type="text" id="em-option-resp-timeout" name="emOptionRespTimeout" size="4" value="<?php echo @$paramArray['emOptionRespTimeout'] ?>"/></td>
							</tr>
							<tr>
								<td colspan="2" class="proxy-title"><div class="ui-icon ui-icon-triangle-1-e"></div><div class="proxy-title-text">Proxy Settings</div></td>
							</tr>
							<tbody id="proxy-settings">
								<tr>
									<td class="proxy-label">Proxy Host:</td>
									<td><input type="text" id="em-option-proxy-host" name="emOptionProxyHost" size="40" value="<?php echo @$paramArray['emOptionProxyHost'] ?>"/></td>
								</tr>
								<tr>
									<td class="proxy-label">Proxy Port:</td>
									<td><input type="text" id="em-option-proxy-port" name="emOptionProxyPort" size="6" value="<?php echo @$paramArray['emOptionProxyPort'] ?>"/></td>
								</tr>
								<tr>
									<td class="proxy-label">Proxy Username:</td>
									<td><input type="text" id="em-option-proxy-username" name="emOptionProxyUsername" size="14" value="<?php echo @$paramArray['emOptionProxyUsername'] ?>"/></td>
								</tr>
								<tr>
									<td class="proxy-label">Proxy Password:</td>
									<td><input type="password" id="em-option-proxy-password" name="emOptionProxyPassword" size="14" value="<?php echo @$paramArray['emOptionProxyPassword'] ?>"/></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="ui-widget-content ui-corner-all em-option-panel">
						<div class="em-options-title em-login-options-title" style="width: 45px;">Themes</div>
						<table class="em-options-table">
							<tr>
								<td width="200">Dispage Theme:</td>
								<td class="em-option-theme"><div class="em-option-theme-auto" item="auto">Auto</div><?php echo join(array_map(create_function('$v', 'return "<div item=\'$v\' style=\'background-color:#$v;\'></div>";'), $EMThemeColors)); ?><input id="em-option-theme" type="hidden" name="emOptionTheme" value="<?php echo $selectedTheme ?>"></td>
							</tr>
						</table>
					</div>
					<div class="em-option-panel">
						<input type="submit" class="button em-install-button" name="em_option_save" value="Save" onclick="return extMan.checkOptionSubmit()"/>&nbsp;&nbsp;
						<input type="reset" class="button em-install-button" value="Reset" onclick="d$('.em-option-theme > div[item=<?php echo $selectedTheme ?>]').click()"/>
					</div>
				</form>
            </div>
    </div>
    </div>

