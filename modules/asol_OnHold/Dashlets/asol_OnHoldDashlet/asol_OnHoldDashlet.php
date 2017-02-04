<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_OnHold/asol_OnHold.php');

class asol_OnHoldDashlet extends DashletGeneric { 
    function asol_OnHoldDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_OnHold/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_OnHold');

        $this->searchFields = $dashletData['asol_OnHoldDashlet']['searchFields'];
        $this->columns = $dashletData['asol_OnHoldDashlet']['columns'];
        
        $this->lvs->quickViewLinks = false;

        $this->seedBean = new asol_OnHold();        
    }
}