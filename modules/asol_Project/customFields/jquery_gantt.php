<?php 

require_once('modules/asol_Project/asolProjectUtils.php');

global $sugar_config, $current_user;

// Mandatory for not-crm access
$site_url = (isset($sugar_config['asolProject_site_url'])) ? $sugar_config['asolProject_site_url'] : $sugar_config['site_url'];
$site_url = str_replace(array('https:', 'http:'), array('', ''), $site_url);// Avoid Blocked loading mixed active content
$ganttModule = $_REQUEST['module'];
$asolProjectId = ($ganttModule == 'asol_Project') ?  $_REQUEST['record'] : '';
$asolProjectVersionId = ($ganttModule == 'asol_ProjectVersion') ?  $_REQUEST['record'] : '';

// Not-mandatory for not-crm access
$intervalMinutesAutosave = (isset($sugar_config['intervalMinutesAutosave'])) ? $sugar_config['intervalMinutesAutosave'] : 5;
$intervalMinutesKeepAliveEditMode = (isset($sugar_config['intervalMinutesKeepAliveEditMode'])) ? $sugar_config['intervalMinutesKeepAliveEditMode'] : 1;
$Date_defaultFormat = $current_user->getPreference('datef');
$Date_defaultFormat = str_replace(array('Y', 'm', 'd'), array('yyyy', 'MM', 'dd'), $Date_defaultFormat);

// Not-mandatory
$adjustParentToChildrenDuration = (isset($sugar_config['adjustParentToChildrenDuration'])) ? $sugar_config['adjustParentToChildrenDuration'] : true;
$isEnterpriseEdition = (asolProjectUtils::hasPremiumFeatures()) ? 'true' : 'false'; 

?>

<script>

document.getElementById("jquery_gantt_label").parentNode.style.display = "none";

// Mandatory for not-crm access
var site_url = '<?php echo $site_url; ?>';
var asolProjectId = '<?php echo $asolProjectId; ?>';
var asolProjectVersionId = '<?php echo $asolProjectVersionId; ?>';

// Not-mandatory for not-crm access
var intervalMinutesAutosave = <?php echo $intervalMinutesAutosave; ?>;
var intervalMinutesKeepAliveEditMode = <?php echo $intervalMinutesKeepAliveEditMode; ?>;
var Date_defaultFormat = '<?php echo $Date_defaultFormat; ?>';
var entryPoint = 'ganttServerCanEditMode';

// Not-mandatory
var adjustParentToChildrenDuration = <?php echo (($adjustParentToChildrenDuration) ? 'true' : 'false'); ?>;
var isEnterpriseEdition = <?php echo $isEnterpriseEdition; ?>;

</script>

<div id="iframe_container">
	<iframe id="myiframe" name="myiframe" width="100%" src="modules/asol_Project/resources/jQueryGantt-master/gantt.html?<?php asolProjectUtils::echoVersion(); ?>" height="302px" frameborder="0"></iframe>
</div>
