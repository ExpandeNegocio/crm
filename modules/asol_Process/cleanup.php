<?php
global $db;

if (isset($_REQUEST['confirm'])) {
	if ($_REQUEST['confirm'] == 'true') {
		$db->query("
				DELETE FROM asol_processinstances					
		");
		$result = "DELETE FROM asol_processinstances<BR>";

		$db->query ("
				DELETE FROM asol_workingnodes		
			");
		$result .= "DELETE FROM asol_workingnodes<BR>";

		$db->query("
				DELETE FROM asol_onhold				
		");
		$result .= "DELETE FROM asol_onhold<BR>";

		$result .= "DONE";

		echo $result;
	} else {
		echo 'Tables were NOT cleaned';
	}
} else{
	echo "
		<input type='button' value='cleanup WFM working tables' onClick='if (confirm(\"Wish to Accept or Cancel\")) {window.location = \"index.php?module=asol_Process&action=cleanup&confirm=true\" } else {window.location = \"index.php?module=asol_Process&action=cleanup&confirm=false\"}' ></input>
	";	
}

?>