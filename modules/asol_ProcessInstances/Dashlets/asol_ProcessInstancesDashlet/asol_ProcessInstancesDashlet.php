<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_ProcessInstances/asol_ProcessInstances.php');

class asol_ProcessInstancesDashlet extends DashletGeneric { 
    function asol_ProcessInstancesDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_ProcessInstances/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_ProcessInstances');

        $this->searchFields = $dashletData['asol_ProcessInstancesDashlet']['searchFields'];
        $this->columns = $dashletData['asol_ProcessInstancesDashlet']['columns'];
        
        $this->lvs->quickViewLinks = false;

        $this->seedBean = new asol_ProcessInstances();        
    }
}