<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_Activity/asol_Activity.php');

class asol_ActivityDashlet extends DashletGeneric { 
    function asol_ActivityDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_Activity/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_Activity');

        $this->searchFields = $dashletData['asol_ActivityDashlet']['searchFields'];
        $this->columns = $dashletData['asol_ActivityDashlet']['columns'];

        $this->seedBean = new asol_Activity();        
    }
}