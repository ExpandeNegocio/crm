<?php

/**
 *
 */
class wfm_domains_utils {

	/**
	 * D20130607T1818
	 * Is domains installed
	 */
	static function wfm_isDomainsInstalled() {

		global $db;

		// Is Domains Installed
		$DomainsQuery = $db->query("SELECT DISTINCT count(id_name) as count FROM upgrade_history WHERE id_name='AlineaSolDomains' AND status='installed'");
		$DomainsRow = $db->fetchByAssoc($DomainsQuery);
		$isDomainsInstalled = ($DomainsRow['count'] > 0);

		return $isDomainsInstalled;
	}

	/**
	 * D20130607T1818
	 * Get child domains in a string separated by commas
	 * @param $domainId
	 */
	static function wfm_getChildDomains_string($domainId) {

		require_once("modules/asol_Domains/asol_Domains.php");
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");

		$domains_string = '';

		$childDomains = asol_manageDomains::getChildDomainsWithDepth($domainId);

		foreach ($childDomains as $childDomain) {
			$domains_string .= "'{$childDomain['id']}',";
		}

		if (!empty($domains_string)) {
			$domains_string = substr($domains_string, 0, -1);
		} else {
			$domains_string = "''";
		}

		return $domains_string;
	}

	/**
	 * D20130607T1818
	 * Get parent domains in a string separated by commas
	 * @param $domainId
	 */
	static function wfm_getParentDomains_string($domainId) {

		require_once("modules/asol_Domains/asol_Domains.php");
		require_once("modules/asol_Domains/AlineaSolDomainsFunctions.php");

		$domains_string = '';

		$parentDomains = asol_manageDomains::getParentDomainsWithHeight($domainId);

		foreach ($parentDomains as $parentDomain) {
			$domains_string .= "'{$parentDomain['id']}',";
		}

		if (!empty($domains_string)) {
			$domains_string = substr($domains_string, 0, -1);
		} else {
			$domains_string = "''";
		}

		wfm_utils::wfm_log('debug', '$domains_string=['.var_export($domains_string, true).']', __FILE__, __METHOD__, __LINE__);
		return $domains_string;
	}
}

?>