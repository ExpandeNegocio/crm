<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $db, $mod_strings;

require_once("modules/asol_Activity/asol_Activity.php");

$focus = new asol_Activity();
$focus->retrieve($_REQUEST['record']);

/*
 * This if-statement is to process the data from the URL.
 * If there is a 'newOrders' field then it will store the changes to the MySQL-database. 
 * This changes are modifications of the task order.
 */
if (isset($_REQUEST['newOrders'])) {
	
	$string_newOrders_received = $_REQUEST['newOrders'];
	$array_newOrders_received = explode(' ', $string_newOrders_received);
	
	for ($i=0; $i<=(count($array_newOrders_received)-2) ; $i+=2) {
		//echo '<script> alert ("iteracion=[' . $i . ']id=[' . $array_newOrders_received[$i] . ']task_order=[' .  $array_newOrders_received[$i+1] . ']");</script>' ;
		
		$date_modified = gmdate('Y-m-d H:i:s');
		
		$task_order_query_update = $db->query("
												UPDATE asol_task
												SET task_order = {$array_newOrders_received[$i+1]}, date_modified='{$date_modified}'
												WHERE id = '{$array_newOrders_received[$i]}'	
										  	");
	}
}

/*
 * This is a button to change the order wherein the tasks will be sorted 
 */
echo '<input type="button" id="task_order" value="'.$mod_strings['LBL_ASOL_ORDER_TASK_BUTTON'].'" title = "'.$mod_strings['LBL_ASOL_ORDER_TASK_TITLE'].'"onClick="taskOrder()"></input>';

$function_button_task_order = '<script>
	function taskOrder() {
		//alert("taskOrder");
		document.getElementById("asolHoverDivOrder").style.visibility="visible";
	}
</script>';
echo $function_button_task_order;

/**
 * This php-code will print a html-code that will show a table with both the tasks and the tasks order. This table is hidden by default and will be visible when the button "task_order" is pressed. 
 * This code has several echo-php-command. Each echo-php-command performs a different goal.
 */
// BEGIN OF echo number 1
/*
 * This echo-php-command prints a row with two fields, the first field is "Task Name" and the second field is "Order". 
 */
echo '
	<div style="position: absolute; visibility: hidden; z-index: 1000; left: 410px; top: 375px; background-image: none;" id="asolHoverDivOrder">

			<table cellspacing="0" cellpadding="1" border="0" width="280" class="olBgClass">
				<tbody>
					<tr>
						<td>
						
							<!-- This table is intented to define the window´s style that shows up when clicking the task order button -->
							<table cellspacing="0" cellpadding="1" border="0" width="100%" class="detail view">
								<tbody>
									<tr>
										<td width="100%" class="olCgClass">
											<div class="olCapFontClass">
												<div style="float: left;"><b> '.$mod_strings['LBL_ASOL_TASK_ORDER'].' </b></div>
													<a onclick="javascript: document.getElementById(\'asolHoverDivOrder\').style.visibility=\'hidden\';" title="'.$mod_strings['LBL_ASOL_HOVER_CLOSE'].'">
														<span style="color: rgb(238, 238, 255); font-family: Verdana,Arial,Helvetica; font-size: 67%; text-decoration: underline;">
															<div style="float: right;">
																<img OnMouseOver="this.style.cursor=\'pointer\'" OnMouseOut="this.style.cursor=\'default\'" border="0" src="themes/Sugar5/images/close.gif" style="margin-left: 2px; margin-right: 2px;">
															</div>
														</span>
													</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- This table will depict the tasks -->
							<table cellspacing="0" cellpadding="1" border="0" width="100%" class="detail view">
								<tbody>
									<tr>
										<td width=200>
											<b> '.$mod_strings['LBL_ASOL_HOVER_TASK_NAME'].' </b>
										</td>
										<td>
											<b> '.$mod_strings['LBL_ASOL_HOVER_ORDER'].' </b>
										</td>
									</tr>'; 
									// END OF echo number 1 
						
						// This MySQL-query gets the activity´s tasks (not all tasks from all activities). activity_id = $focus->id . 
						$task_order_query = $db->query ("	
															SELECT asol_task.id AS task_id, asol_task.name AS task_name, asol_task.task_order AS task_order, asol_activity_asol_task_c.asol_activ5b86ctivity_ida AS activity_id
															FROM asol_task
															INNER JOIN asol_activity_asol_task_c ON asol_task.id = asol_activity_asol_task_c.asol_activf613ol_task_idb
															WHERE asol_activity_asol_task_c.asol_activ5b86ctivity_ida = '{$focus->id}' AND asol_task.deleted = 0 AND asol_activity_asol_task_c.deleted = 0
															ORDER BY asol_task.task_order ASC
														");
														
						$task_ids = array();
						$counter = 0;
						while ( $task_order_row = $db->fetchByAssoc($task_order_query) ) {
							$task_ids[$counter] = $task_order_row["task_id"]; // This array stores all the task_ids
							$counter++;
							
							// BEGIN OF echo number 2
							/*
							 * This echo-php-command prints the tasks from the database.
							 */
							echo '<tr>
									  <td>
									  		<label for="' . $task_order_row["task_id"] . '">' . $task_order_row["task_name"] /*. $task_order_row["task_id"] . 'activity_id='. $task_order_row["activity_id"] */. '</label>
									  </td>
									  <td>
									  		<input id="' . $task_order_row["task_id"] . '" value="' . $task_order_row["task_order"] . '" size="2" maxlength="2"  style="text-align: center"></input>
									  </td>
								  </tr>
							' ;
							// END OF echo number 2
						}
						
						//print_r($task_ids);
											
						// BEGIN OF echo number 3
						/*
						 * This echo-php-command just ends the html-tags started by the above echo-php-commands.
						 * Also it creates a Save-button that triggers the Save-function which will save the changes done to the MySQL database. 
						 */
						echo '</tbody>
						</table>
							
						<table cellspacing="0" cellpadding="1" border="0" width="100%" class="detail view">
							<tbody>
								<tr>
									<td>
										<p align="right">
											<input type="button" value="'.$mod_strings['LBL_ASOL_HOVER_SAVE'].'" onClick="Save()"></input>
										</p>
									</td>
								</tr>
							</tbody>
						</table>
						
					</td>
				</tr>
			</tbody>
		</table>
	</div>
';	
// END OF echo number 3	

/*
 * This is the javascript-function that will be executed when clicking the Save button.
 * It collects the input fields´ content and it saves the changes done by the user.
 */						
echo '<script>
	function Save() {
		//alert("Save");
		var stringNewOrders = "";
		';

		foreach ($task_ids as $value_task_ids) {
			echo 'stringNewOrders+= "' . $value_task_ids . ' "+' . 'document.getElementById("' . $value_task_ids . '").value+ " ";
			';
		}
	
		echo '
		window.location = "index.php?module=asol_Activity&action=DetailView&record=' . $focus->id . '&newOrders=" + stringNewOrders ;

		document.getElementById("asolHoverDivOrder").style.visibility="hidden";
	}
</script>';

?>