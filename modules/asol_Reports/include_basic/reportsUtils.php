<?php

class asol_ReportsUtils {

	static public $reports_version = "4.0.4"; 
	
	static public function reports_log($logLevel, $logText, $file, $function=null, $line=null) {
	
		global $sugar_config;
	
		$asolLogLevelEnabled = ((isset($sugar_config['asolLogLevelEnabled'])) && ($sugar_config['asolLogLevelEnabled'] == true)) ? true : false;
		$logLevel = (($logLevel == 'asol') && (!$asolLogLevelEnabled)) ? 'debug' : $logLevel;
	
		$reports_log_prefix = "**********[asol_Reports]";
		$GLOBALS['log']->$logLevel($reports_log_prefix.': '.pathinfo($file, PATHINFO_BASENAME)."[$line]->".$function.': '.$logText);
	
	}
	
	static public function reports_curl($type, $submit_url, $query_string, $exit, $timeout) {
	
		global $sugar_config;
		
		$curlReponse = true;
	
		if ($submit_url == null) {

			$baseRequestedUrl = (isset($sugar_config['asolReportsCurlRequestUrl'])) ? $sugar_config['asolReportsCurlRequestUrl'] : $sugar_config['site_url'];
			$submit_url = $baseRequestedUrl."/index.php";

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
					curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); // The maximum number of seconds to allow cURL functions to execute.
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); // The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
				}
	
				if (isset($sugar_config['asolReportsSiteLoginCredentials'])) { // Basic Authentication (Site Login)
					curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ; // The HTTP authentication method(s) to use.
					curl_setopt($curl, CURLOPT_USERPWD, $sugar_config['asolReportsSiteLoginCredentials']); // A username and password formatted as "[username]:[password]" to use for the connection.
				}
	
				curl_exec($curl);
				
				if (curl_errno($curl)) {
					$curlReponse = false;
					self::reports_log('fatal', " curl_errno=[".print_r(curl_errno($curl),true)."]", __FILE__, __METHOD__, __LINE__);
				}
	
				curl_close($curl);
				self::reports_log('debug', "EXIT cURL REQUEST*******************************************", __FILE__, __METHOD__, __LINE__);
	
				break;
	
			case 'get':
	
				// cURL by means of GET
	
				break;
		}
	
		if ($exit) {
			exit();
		}
		
		return $curlReponse;
		
	}
	
	static public function translateReportsLabel($labelId) {
		
		global $mod_strings;
		
		if ($_REQUEST['module'] === 'asol_Reports')
			return $mod_strings[$labelId];
		else
			return translate($labelId, 'asol_Reports');
		
	}
	
	static public function managePremiumFeature($premiumFeature, $requiredFile, $callFunction, $extraParams, $isJsFile = false) {
			
		$basePremiumPath = "modules/asol_Reports/include_premium/";
		
		if (!file_exists($basePremiumPath.$requiredFile)) {

			if (!$isJsFile)
				self::reports_log('warn', "Cannot get ".$premiumFeature." Premium Feature. ".$callFunction."() Function Called.", __FILE__, __METHOD__, __LINE__);
			else
				self::reports_log('warn', "Cannot get ".$premiumFeature." Premium Feature. Tried to Load '".$requiredFile."' File", __FILE__, __METHOD__, __LINE__);
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

	static function getRealIP() {

		if ($_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
			
			$client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
			
			$entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

			reset($entries);
			
			while (list(, $entry) = each($entries))	{

				$entry = trim($entry);
				
				if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
					
					$private_ip = array(
		                  '/^0\./', 
		                  '/^127\.0\.0\.1/', 
		                  '/^192\.168\..*/', 
		                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
		                  '/^10\..*/'
					);

					$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

					if ($client_ip != $found_ip) {
						$client_ip = $found_ip;
						break;
					}
					
				}
			
			}
		
		} else {
			
			$client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
		
		}

		return $client_ip;

	}
	
	static public function getBaseUrl() {
        
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        
        $path = $_SERVER['PHP_SELF'];
        $path_parts = pathinfo($path);
        $directory = $path_parts['dirname'];
        $directory = ($directory == "/") ? "" : $directory;
        

        return $protocol.$host.$directory;
        
    }
	
	static public function hasPremiumFeatures() {
			
		$basePremiumPath = "modules/asol_Reports/include_premium";
		return is_dir($basePremiumPath);
		
	}

}

?>