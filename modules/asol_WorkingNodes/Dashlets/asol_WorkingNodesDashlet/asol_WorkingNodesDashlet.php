<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_WorkingNodes/asol_WorkingNodes.php');

class asol_WorkingNodesDashlet extends DashletGeneric { 
    function asol_WorkingNodesDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_WorkingNodes/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_WorkingNodes');

        $this->searchFields = $dashletData['asol_WorkingNodesDashlet']['searchFields'];
        $this->columns = $dashletData['asol_WorkingNodesDashlet']['columns'];
        
        $this->lvs->quickViewLinks = false;
        
        $this->seedBean = new asol_WorkingNodes();        
    }
}