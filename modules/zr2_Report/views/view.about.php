<?php

class ViewAbout extends SugarView {

	public function display()
	{
		$smarty = new Sugar_Smarty();
		$smarty->display("modules/zr2_Report/tpls/about.tpl");		
	}
}


?>