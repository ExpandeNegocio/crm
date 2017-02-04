<?php

class asolProjectUtils {

	static $edition = 'Community'; // Community/Enterprise/SRM
	static $release_version = '1.0';
	static $code_version = 'D20140528T1428'; // php, js, css, ...
	static $db_structure_version = 1;

	static function echoVersion() {
		echo self::$code_version;
	}

	static function log($logLevel, $logText, $file, $function=null, $line=null) {

		global $sugar_config;

		switch ($logLevel) {
			case 'asol_debug':
				$logLevel = (isset($sugar_config['asol_Project_changeLogLevelFromAsolDebugTo'])) ? $sugar_config['asol_Project_changeLogLevelFromAsolDebugTo'] : 'debug';
				break;
			case 'asol':
				$asolLogLevelEnabled = ((isset($sugar_config['asolLogLevelEnabled'])) && ($sugar_config['asolLogLevelEnabled'] == true)) ? true : false;
				$logLevel = ($asolLogLevelEnabled) ? 'asol' : 'debug';

				$logLevel = (isset($sugar_config['asol_Project_logLevelForInfoLogs'])) ? $sugar_config['asol_Project_logLevelForInfoLogs'] : $logLevel;
				break;
		}

		$log_prefix = "**********[ASOL][asol_Project][".session_id()."]";

		$GLOBALS['log']->$logLevel($log_prefix.': '.pathinfo($file, PATHINFO_BASENAME)."[$line]->".$function.': '.$logText);
	}

	static function str_starts_with($haystack, $needle)	{
		return strpos($haystack, $needle) === 0;
	}

	static function redirect($recordId) {
		$return_id = (!empty($_REQUEST['return_id'])) ? $_REQUEST['return_id'] : $recordId;
		$return_record = (empty($return_id)) ? $_REQUEST['record'] : $return_id;

		$return_action = (empty($_REQUEST['return_action'])) ? 'DetailView' : $_REQUEST['return_action'];
		$return_module = (empty($_REQUEST['return_module'])) ? 'asol_Events' : $_REQUEST['return_module'];

		header("Location: index.php?action={$return_action}&module={$return_module}&record={$return_record}");
	}

	static function convertArrayToCurlParameter($array) {

		$array = str_replace("&quot;", "&#34;", $array); // To avoid problems with sugarcrm-decoding
		$array = str_replace(">", "&gt;", $array); // To avoid problems with Save.php
		$array = str_replace("<", "&lt;", $array); // To avoid problems with Save.php
		$serialized_array = serialize($array);
		//self::log('debug', "\$serialized_array=[".$serialized_array."]", __FILE__, __METHOD__, __LINE__);
		$urlencode_serialized_array = urlencode($serialized_array);
		//self::log('debug', "\$urlencode_serialized_array=[".$urlencode_serialized_array."]", __FILE__, __METHOD__, __LINE__);

		return $urlencode_serialized_array;
	}

	static function convertCurlParamenterToArray($curl_parameter) {

		//self::wfm_log('debug', "\$curl_parameter=[".$curl_parameter."]", __FILE__, __METHOD__, __LINE__);
		$html_entity_decoded__array = str_replace("&quot;", '"', $curl_parameter);
		//self::wfm_log('debug', "\$html_entity_decoded__array=[".$html_entity_decoded__array."]", __FILE__, __METHOD__, __LINE__);
		$unserialized__html_entity_decoded__array = unserialize($html_entity_decoded__array);
		//self::wfm_log('debug', "\$unserialized__html_entity_decoded__array=[".print_r($unserialized__html_entity_decoded__array,true)."]", __FILE__, __METHOD__, __LINE__);
		$array = $unserialized__html_entity_decoded__array;
		//+++++++++++self::wfm_log('debug', "\$array=[".print_r($array,true)."]", __FILE__, __METHOD__, __LINE__);

		return $array;
	}


	static function sendCurl($type, $submit_url, $query_string, $exit, $timeout) {

		global $sugar_config;

		if ($submit_url == null) {
			// set URL
			// Url sintax : scheme://username:password@domain:port/path?query_string#fragment_id
			$site_url = (isset($sugar_config['asolProject_site_url'])) ? $sugar_config['asolProject_site_url'] : $sugar_config['site_url'];
			$site_url .= '/';
			$submit_url = $site_url."index.php";
		}

		switch ($type) {
			case 'post':

				// cURL by means of POST
				$curl = curl_init();

				curl_setopt($curl, CURLOPT_URL, $submit_url); // The URL to fetch. This can also be set when initializing a session with curl_init().
				curl_setopt($curl, CURLOPT_POST, true); // TRUE to do a regular HTTP POST.
				curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string); // The full data to post in a HTTP "POST" operation.
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // FALSE to stop cURL from verifying the peer's certificate.

				if ($timeout != null) {


					//curl_setopt($curl, /*CURLOPT_RETURNTRANSFER*/ 19913, true);
					//curl_setopt($curl, /*CURLOPT_NOSIGNAL*/ 99, 1);
					//curl_setopt($curl, /*CURLOPT_TIMEOUT_MS*/ 155, 100);
					//curl_setopt($curl, /*CURLOPT_CONNECTTIMEOUT_MS */ 156, 40);


					//curl_setopt($curl, CURLOPT_TIMEOUT_MS, $timeout); // Added in cURL 7.16.2. Available since PHP 5.2.3. // The maximum number of milliseconds to allow cURL functions to execute. If libcurl is built to use the standard system name resolver, that portion of the connect will still use full-second resolution for timeouts with a minimum timeout allowed of one second.
					//curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, $timeout); // Added in cURL 7.16.2. Available since PHP 5.2.3. // The number of milliseconds to wait while trying to connect. Use 0 to wait indefinitely. If libcurl is built to use the standard system name resolver, that portion of the connect will still use full-second resolution for timeouts with a minimum timeout allowed of one second.

					curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); // The maximum number of seconds to allow cURL functions to execute.
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); // The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
				}

				if (isset($sugar_config['asolProject_site_login_username_password'])) { // Basic Authentication (Site Login)
					curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ; // The HTTP authentication method(s) to use.
					//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
					//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
					//curl_setopt($curl, CURLOPT_HEADER, true);
					//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($curl, CURLOPT_USERPWD, $sugar_config['WFM_site_login_username_password']); // A username and password formatted as "[username]:[password]" to use for the connection.
					self::log('debug', "cURL -> Basic Authentication (Site Login) =[".$sugar_config['asolProject_site_login_username_password']."]", __FILE__, __METHOD__, __LINE__);
				}

				self::log('warn', "cURL=[".$site_url."index.php?".$query_string."]", __FILE__, __METHOD__, __LINE__);
				curl_exec($curl);
				self::log('warn', "curl_getinfo=[".print_r(curl_getinfo($curl),true)."]", __FILE__, __METHOD__, __LINE__);

				if(curl_errno($curl)) {
					self::log('warn', " curl_errno=[".print_r(curl_errno($curl),true)."]", __FILE__, __METHOD__, __LINE__);
				}

				curl_close($curl);
				self::log('debug', "EXIT cURL REQUEST*******************************************", __FILE__, __METHOD__, __LINE__);

				break;

			case 'get':

				// cURL by means of GET
				/*$ch = curl_init();
				 curl_setopt($ch, CURLOPT_URL, $site_url."index.php?entryPoint=wfm_engine&trigger_module=".$trigger_module."&trigger_event=".$trigger_event."&bean_id=".$bean_id."&current_user_id=".$current_user->id."&bean_ungreedy_count=".$bean_ungreedy_count."&old_bean=".$urlencode_serialized_old_bean."&new_bean=".$urlencode_serialized_new_bean."&execution_type=logic_hook");
				 self::log('debug', "*****site_url*******cURL=".$site_url."index.php?entryPoint=wfm_engine&trigger_module=".$trigger_module."&trigger_event=".$trigger_event."&bean_id=".$bean_id."&current_user_id=".$current_user->id."&bean_ungreedy_count=".$bean_ungreedy_count."&old_bean=".$urlencode_serialized_old_bean."&new_bean=".$urlencode_serialized_new_bean."&execution_type=logic_hook****************", __FILE__, __METHOD__, __LINE__);

				 curl_setopt($ch, CURLOPT_HEADER, 0);
				 curl_setopt($ch, CURLOPT_TIMEOUT, 1);

				 curl_exec($ch);

				 // close cURL resource, and free up system resources
				 curl_close($ch);*/

				break;
		}

		if ($exit) {
			exit();
		}
	}

	static public function managePremiumFeature($premiumFeature, $requiredFile, $callFunction, $extraParams, $isJsFile = false) {

		//self::log('debug', "ENTRY", __FILE__, __METHOD__, __LINE__);
		//self::log('debug', 'get_defined_vars=['.var_export(get_defined_vars(), true).']', __FILE__, __METHOD__, __LINE__);
			
		$basePremiumPath = "modules/asol_Project/___commonEnterpriseEdition/";

		$basePremiumPath .= (!$isJsFile) ? 'php/' : 'js/';

		if (!file_exists($basePremiumPath.$requiredFile)) {

			if (!$isJsFile)
			self::log('info', "Cannot get ".$premiumFeature." Premium Feature. ".$callFunction."() Function Called.", __FILE__, __METHOD__, __LINE__);
			else
			self::log('info', "Cannot get ".$premiumFeature." Premium Feature. Tried to Load '".$requiredFile."' File", __FILE__, __METHOD__, __LINE__);
			return false;

		} else {

			if (!$isJsFile) {
				require_once($basePremiumPath.$requiredFile);
				return $callFunction($extraParams);
			} else {
				return true;
			}

		}

	}
	
	static public function hasPremiumFeatures() {
			
		$basePremiumPath = "modules/asol_Project/___commonEnterpriseEdition";
		return is_dir($basePremiumPath);

	}

	static function addPremiumAppListStrings(& $app_list_strings, $language, $premiumFeature) {

		$extraParams = Array(
			'app_list_strings' => $app_list_strings,
			'language' => $language
		);

		$newAppListStrings = self::managePremiumFeature($premiumFeature, "asolProjectUtilsEnterprise.php", $premiumFeature, $extraParams);

		if ($newAppListStrings !== false) {
			$app_list_strings = $newAppListStrings;
		}
	}


}