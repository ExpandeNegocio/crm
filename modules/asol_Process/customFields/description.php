<style>
.description_tinymce
{
	padding: 10px;
	height: 100px;
	width: 400px;
	overflow: auto;

	border: 1px solid gray;
	-webkit-appearance: textfield;
	
	background-color: #FFFFFF;
	border-color: #94C1E8;
}
</style>


<?php 
require_once("modules/asol_Process/___common_WFM/php/asol_utils.php");
?>

<?php

$bean = $GLOBALS['FOCUS'];

$action = $_REQUEST['action'];

switch ($action) {
	case 'DetailView':
		$textarea_id = 'description_aux';
		echo "<div id='$textarea_id' name='$textarea_id' disabled=''>{$bean->description}</textarea>";
		
		break;
	case 'EditView':
		$textarea_id = 'description';
		echo "<textarea id='$textarea_id' name='$textarea_id' class='editable'>{$bean->description}</textarea>";
		break;
}

?>

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<script>

tinymce.init({
	mode : "specific_textareas",
    editor_selector : "editable",
    inline: true,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});

</script>
