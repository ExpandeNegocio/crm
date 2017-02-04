<?php

require_once('service/v4_1/SugarWebServiceImplv4_1.php');
require_once('service/v4_1/SugarWebServiceUtilv4_1.php');
require_once('modules/Administration/Administration.php');

class SugarWebServiceImpl_v4_custom extends SugarWebServiceImplv4_1 
{

	function zuckerreports_query($session, $sql)
	{	
		global $current_user;
	
		$util = new SugarWebServiceUtilv4_1();
	
		if (!$util->validate_authenticated($session)) {
			return array(
				'result' => 'error',
				'message' => 'ZuckerReports Query invalid session'
			);
		}
		
		$admin = new Administration();
		$admin->retrieveSettings();
		$sugaruser = $admin->settings['zuckerreports2_ondemandsugaruser'];
		
		if ($current_user->user_name != $sugaruser) {
			return array(
				'result' => 'error',
				'message' => 'ZuckerReports Query invalid user ('.($current_user->user_name).')',
			);
		}
		
		$db = DBManagerFactory::getInstance();
        $result = $db->query($sql);
		
		$row_list = array();
		$colnames_list = array();
		while (($row = $db->fetchByAssoc($result)) != null)
        {
			if (empty($colnames_list)) 
			{
				foreach ($row as $colname => $colval)
				{
					$colnames_list[] = $colname;
				}			
			}
		
		
			$json_row = array();
			foreach ($row as $colname => $colval)
			{
				$json_row[] = $colval;
			}
			
			$row_list[] = $json_row;
		}
			
        return array(
			'result' => 'ok',
            'columnnames_list' => $colnames_list,
			'rows_list' => $row_list
        );		
	}

}

?>