<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

?>

<link href="modules/asol_Process/css/asol_process_style.css?version=<?php  echo wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />

<div>
	<h1><?php echo $mod_strings['LBL_IMPORT_TITLE_ADVANCED']; ?></h1>
	<br>
	<h3><?php echo $mod_strings['LBL_IMPORT_STEP2_WORKFLOWS_NOT_EXIST_ADVANCED']; ?></h3>
</div>
<br>
<form id='import_form' name='import_form' action='index.php?module=asol_Process&action=import_step3.advanced' method='post' enctype='multipart/form-data'>
	
	<?php require_once('modules/asol_Process/import_step2.email_templates.advanced.php'); ?>
	
	<br>
	
	<?php require_once('modules/asol_Process/import_step2.domains.advanced.php'); ?>
	
	<br>
	
	<input id='import' type='submit'  value='<?php echo $mod_strings['LBL_IMPORT_ADVANCED']; ?>' />
</form>

<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>