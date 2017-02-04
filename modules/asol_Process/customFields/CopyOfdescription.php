<?php 
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
?>

<link href="modules/asol_Process/___common_WFM/css/ckeditor.css?version=<?php wfm_utils::echoVersionWFM(); ?>" rel="stylesheet" type="text/css" />
<script src="modules/asol_Process/___common_WFM/plugins_js_css_images/ckeditor/ckeditor.js?version=<?php wfm_utils::echoVersionWFM(); ?>" type="text/javascript"></script>

<?php

$bean = $GLOBALS['FOCUS'];

$action = $_REQUEST['action'];

switch ($action) {
	case 'DetailView':
		$textarea_id = 'description_aux';
		echo "<textarea id='$textarea_id' name='$textarea_id' disabled=''>{$bean->description}</textarea>";
		
		break;
	case 'EditView':
		$textarea_id = 'description';
		echo "<textarea id='$textarea_id' name='$textarea_id'>{$bean->description}</textarea>";
		break;
}

?>

<script>

// Turn off automatic editor creation first.
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('<?php echo $textarea_id; ?>', {
	enterMode: CKEDITOR.ENTER_BR,
	shiftEnterMode: CKEDITOR.ENTER_P,
    language: 'es'
});
	
</script>

<?php 
if ($action == 'DetailView') {
	echo "
				<style>
					#description {
						display: inline;
					}
				</style>
		";
}
?>