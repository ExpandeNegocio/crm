<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_Task/asol_Task.php');

class asol_TaskDashlet extends DashletGeneric { 
    function asol_TaskDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_Task/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_Task');

        $this->searchFields = $dashletData['asol_TaskDashlet']['searchFields'];
        $this->columns = $dashletData['asol_TaskDashlet']['columns'];

        $this->seedBean = new asol_Task();        
    }
}