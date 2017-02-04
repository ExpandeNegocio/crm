<?php

require_once("modules/asol_Reports/include_basic/reportsUtils.php");

global $current_user, $mod_strings, $app_strings, $timedate, $app_list_strings, $db;

$report_module = $_REQUEST['report_module'];

?>
<html>
<head>
	
	<style type="text/css">
		body, tr {
			white-space: nowrap;
		}
	</style>
	
	<script	src="modules/asol_Reports/include_basic/js/jquery.min.js?version=<?php asol_ReportsUtils::$reports_version; ?>" type="text/javascript"></script>	
	<script	src="modules/asol_Reports/include_basic/js/ZeroClipboard/ZeroClipboard.js?version=<?php asol_ReportsUtils::$reports_version; ?>" type="text/javascript"></script>
	
</head>

<body>

	<table>
		<tr>
			<td>
				<form method="post"	action="index.php?entryPoint=reportVariableGenerator&module=asol_Reports">
					<table style='width: 230px;'>
						<tr>
							<td>
								<?php 
									if (!empty($report_module)) {
																				
									}
								?>
							</td>
						</tr>
					</table>
				</form>
			</td>
			<td>
				<table>
					<tr>
						<td>
							
							<section>
							
								<div style="position:relative;">
									<table>
										<tr>
											<td>
												<a href="javascript:;" id="copy" style="display:block;">Copy</a>
											</td>
											<td>
												<span id="copied" style='display: none; color: red;' >Copied!</span>
											</td>
										</tr>
									</table>
								</div>
								
								<input type="button" id="copy" name="copy" value="Copy to Clipboard" style="margin-top:-10px;display:none" />
								
								<textarea name="reports_variable_result" id="reports_variable_result" rows="1" cols="50"></textarea>
								<br /><br />
								
								<script type="text/javascript">
									$(document).ready(function() {
										
										setTimeout(function() {
											//set path
											ZeroClipboard.setMoviePath("modules/asol_Reports/include_basic/js/ZeroClipboard/ZeroClipboard.swf");
											//create client
											var clip = new ZeroClipboard.Client();
											//event
											clip.addEventListener('mousedown',function() {
												clip.setText(document.getElementById('reports_variable_result').value);
											});
											clip.addEventListener('complete',function(client,text) {
												$('#copied').fadeIn(400).delay(100).fadeOut(400);
												console.log('copied: ' + text);
											});
											//glue it to the button
											clip.glue('copy');
										}, 2000);
										
									});
									
								</script>
								
							</section>
							
						</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>

</body>
</html>