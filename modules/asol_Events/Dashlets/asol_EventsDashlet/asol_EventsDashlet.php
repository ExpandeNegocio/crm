<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/asol_Events/asol_Events.php');

class asol_EventsDashlet extends DashletGeneric { 
    function asol_EventsDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/asol_Events/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'asol_Events');

        $this->searchFields = $dashletData['asol_EventsDashlet']['searchFields'];
        $this->columns = $dashletData['asol_EventsDashlet']['columns'];

        $this->seedBean = new asol_Events();        
    }
}