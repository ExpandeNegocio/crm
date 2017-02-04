<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class zr2_ReportParameterLinkViewEdit extends ViewEdit
{
 	public function __construct()
 	{
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
	
 	public function display()
 	{
        $this->ev->process();

		$bind_to_module_name = $this->bean->bind_to_module_name;
		
		if (!empty($_REQUEST['bind_to_module_name'])) {
			$bind_to_module_name = $_REQUEST['bind_to_module_name'];
		}
        $this->ev->fieldDefs['bind_to_module_name']['value'] = $bind_to_module_name;
		
		global $beanList, $beanFiles;
		global $app_list_strings;
		
		$moduleSelection = array();
		$moduleSelection[""] = "";
		
		foreach ($beanList as $beanName) {
			$beanFile = $beanFiles[$beanName];
			if (empty($beanFile)) continue;
			require_once($beanFile);
			$seed = new $beanName;
			if (!empty($app_list_strings["moduleList"][$seed->module_dir])) {
				$moduleSelection[$seed->module_dir] = $app_list_strings["moduleList"][$seed->module_dir];
			}
		}
		asort($moduleSelection);
		$this->ss->assign("MODULE_OPTIONS", $moduleSelection);

		echo $this->ev->display($this->showTitle);
 	}
}
?>
