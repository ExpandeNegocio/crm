<?php 
global $mod_strings, $app_strings;

$module_menu[] = Array("index.php?module=zr2_Report&action=ReportOnDemand", $mod_strings['LNK_REPORT_ONDEMAND'], "zr2_ReportOnDemand");
$module_menu[] = Array("index.php?module=zr2_ReportContainer&action=ListView", $mod_strings['LNK_ARCHIVE_LIST'], "zr2_ReportContainer");
$module_menu[] = Array("index.php?module=zr2_ReportTemplate&action=ListView", $mod_strings['LNK_JASPERREPORTS_LIST'], "zr2_ReportTemplate");
$module_menu[] = Array("index.php?module=zr2_ReportTemplate&action=EditView", $mod_strings['LNK_JASPERREPORTS_NEW'], "zr2_ReportTemplate");
$module_menu[] = Array("index.php?module=zr2_QueryTemplate&action=ListView", $mod_strings['LNK_QUERYTEMPLATE_LIST'], "zr2_QueryTemplate");
$module_menu[] = Array("index.php?module=zr2_QueryTemplate&action=EditView", $mod_strings['LNK_QUERYTEMPLATE_NEW'], "zr2_QueryTemplate");
$module_menu[] = Array("index.php?module=zr2_ReportParameter&action=ListView", $mod_strings['LNK_PARAMETER_LIST'], "zr2_ReportParameter");
$module_menu[] = Array("index.php?module=zr2_ReportParameter&action=EditView", $mod_strings['LNK_PARAMETER_NEW'], "zr2_ReportParameter");
$module_menu[] = Array("http://www.zuckerfriends.com", "ZuckerFriends", "zr2_About");
$module_menu[] = Array("index.php?module=zr2_Report&action=About", $mod_strings['LBL_MENU_ABOUT'], "zr2_About");
?>