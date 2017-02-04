<?php

/**
 *
 */
class wfm_notification_emails_utils {

	/**
	 * D20130607T1818
	 * Is domains installed
	 */
	static function isNotificationEmailsInstalled() {

		global $db;

		// Is Domains Installed
		$DomainsQuery = $db->query("SELECT DISTINCT count(id_name) as count FROM upgrade_history WHERE id_name='AlineaSolNotificationEmails' AND status='installed'");
		$DomainsRow = $db->fetchByAssoc($DomainsQuery);
		$isDomainsInstalled = ($DomainsRow['count'] > 0);

		return $isDomainsInstalled;
	}
}

?>