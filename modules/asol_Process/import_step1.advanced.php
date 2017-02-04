<?php

require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
wfm_utils::wfm_log('debug', 'ENTRY', __FILE__);

global $mod_strings;

?>

<link href="modules/asol_Process/css/asol_process_style.css?version=<?php  echo wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />

<div>
	<h1><?php echo $mod_strings['LBL_IMPORT_TITLE_ADVANCED']; ?></h1>
	<br>
	<h3><?php echo $mod_strings['LBL_IMPORT_STEP1_ADVANCED']; ?></h3>
</div>
<br>
<form id='import_form' name='import_form' action='index.php?module=asol_Process&action=import_step2.advanced' method='post' enctype='multipart/form-data'>
	<input name='imported_workflows' type='file' />
	<input id='check' type='submit'  value='<?php echo $mod_strings['LBL_IMPORT_CHECK_ADVANCED']; ?>' />
</form>

<?php 
wfm_utils::wfm_log('debug', 'EXIT', __FILE__);
?>