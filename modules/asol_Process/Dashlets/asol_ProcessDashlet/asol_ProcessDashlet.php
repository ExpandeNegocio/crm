<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_Process/asol_Process.php');

class asol_ProcessDashlet extends DashletGeneric { 
    function asol_ProcessDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_Process/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_Process');

        $this->searchFields = $dashletData['asol_ProcessDashlet']['searchFields'];
        $this->columns = $dashletData['asol_ProcessDashlet']['columns'];

        $this->seedBean = new asol_Process();        
    }
}