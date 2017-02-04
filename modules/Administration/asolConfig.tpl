<html>

<head>
<style type="text/css">@import url("themes/SugarClassic/style.css"); </style>
<link href="themes/SugarClassic/navigation.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table style="width: 100%">

	<tbody>
	<tr>
		<td>
		
			<!-- Titulo Modulo -->
			<div class="moduleTitle">
				<h2>{$LBL_ASOL_CONFIGURATION}</h2>
			</div>
			
			<form id="config_form" name="create_form" method="post" action="index.php">
			
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tbody><tr>
						<td class="buttons">
							<input type="hidden" value="Administration" name="module">
							<input type="hidden" value="asolConfig" name="action">
							<input type="hidden" value="" name="doSave">
							<input type="hidden" value="{$return_module}" name="return_module">
							<input type="hidden" value="{$return_action}" name="return_action">
							<input type="submit" value="{$LBL_SAVE_BUTTON_LABEL}" name="button" class="button" onClick="document.config_form.doSave.value='true'"> 
							<input type="submit" value="{$LBL_CANCEL_BUTTON_LABEL}" name="button" class="button" onClick="document.config_form.return_action.value='index'">
						</td>
						<td align="right"></td>
					</tr></tbody>
				</table>
				
				<div id="DEFAULT">
				
				{if ($isAdmin == true)}
				
				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="formHeader h3Row">
						<tbody><tr>
							<td nowrap="">
								<h2><span>{$LBL_ASOL_DATE_TIME_OPTS}</span></h2></td><td width="100%"><img height="1" width="1" src="themes/default/images/blank.gif?s=1f6427691c998307be9837faeadb8770&amp;c=1&amp;developerMode=1631829203" alt="">
							</td>
						</tr></tbody>
				</table>
				
				<table cellspacing="1" cellpadding="0" border="0" width="100%" class="edit view">
						<tbody>
							
							<tr>
								<td nowrap="nowrap" width="15%">
									{$LBL_ASOL_FISCAL_YEAR}:<span class="required">*</span>
								</td>
							
								<td nowrap="nowrap" width="35%">
								
									<select id="month_quarter" name="month_quarter">
										<option value="1" {if $config[0] == '1'}selected{/if}>{$LBL_ASOL_JANUARY}</option>
										<option value="2" {if $config[0] == '2'}selected{/if}>{$LBL_ASOL_FEBRUARY}</option>
										<option value="3" {if $config[0] == '3'}selected{/if}>{$LBL_ASOL_MARCH}</option>
										<option value="4" {if $config[0] == '4'}selected{/if}>{$LBL_ASOL_APRIL}</option>
										<option value="5" {if $config[0] == '5'}selected{/if}>{$LBL_ASOL_MAY}</option>
										<option value="6" {if $config[0] == '6'}selected{/if}>{$LBL_ASOL_JUNE}</option>
										<option value="7" {if $config[0] == '7'}selected{/if}>{$LBL_ASOL_JULY}</option>
										<option value="8" {if $config[0] == '8'}selected{/if}>{$LBL_ASOL_AUGUST}</option>
										<option value="9" {if $config[0] == '9'}selected{/if}>{$LBL_ASOL_SEPTEMBER}</option>
										<option value="10" {if $config[0] == '10'}selected{/if}>{$LBL_ASOL_OCTOBER}</option>
										<option value="11" {if $config[0] == '11'}selected{/if}>{$LBL_ASOL_NOVEMBER}</option>
										<option value="12" {if $config[0] == '12'}selected{/if}>{$LBL_ASOL_DECEMBER}</option>
									</select>							
																	
								</td>
								
																
								<td nowrap="nowrap" width="15%">
									{$LBL_ASOL_WEEK_STARTS}:<span class="required">*</span>
								</td>
							
								<td nowrap="nowrap" width="35%">
								
									<select id="week_start" name="week_start">
										<option value="0" {if $config[3] == '0'}selected{/if}>{$LBL_ASOL_SUNDAY}</option>
										<option value="1" {if $config[3] == '1'}selected{/if}>{$LBL_ASOL_MONDAY}</option>
									</select>							
																	
								</td>
								
								
							</tr>				
															
						</tbody>
					</table>
				
				{/if}
				
				{if ($isReportsModule == "true")}
				
				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="formHeader h3Row">
						<tbody><tr>
							<td nowrap="">
								<h2><span>{$LBL_ASOL_PAGINATION}</span></h2></td><td width="100%"><img height="1" width="1" src="themes/default/images/blank.gif?s=1f6427691c998307be9837faeadb8770&amp;c=1&amp;developerMode=1631829203" alt="">
							</td>
						</tr></tbody>
				</table>
				
				<table cellspacing="1" cellpadding="0" border="0" width="100%" class="edit view">
						<tbody>
							
							<tr>
								<td nowrap="nowrap" width="15%">
									{$LBL_ASOL_ENTRIES_PER_PAGES}:<span class="required">*</span>
								</td>
							
								<td nowrap="nowrap" width="35%">
								
									<select id="entries_per_page" name="entries_per_page">
										<option value="5" {if $config[1] == '5'}selected{/if}>5</option>
										<option value="10" {if $config[1] == '10'}selected{/if}>10</option>
										<option value="15" {if $config[1] == '15'}selected{/if}>15</option>
										<option value="20" {if $config[1] == '20'}selected{/if}>20</option>
										<option value="25" {if $config[1] == '25'}selected{/if}>25</option>
										<option value="30" {if $config[1] == '30'}selected{/if}>30</option>
										<option value="35" {if $config[1] == '35'}selected{/if}>35</option>
										<option value="40" {if $config[1] == '40'}selected{/if}>40</option>
										<option value="45" {if $config[1] == '45'}selected{/if}>45</option>
										<option value="50" {if $config[1] == '50'}selected{/if}>50</option>
									</select>							
																	
								</td>
								
								<td nowrap="nowrap" width="50%">
									&nbsp;
								</td>
								
							</tr>				
															
						</tbody>
					</table>
				
				
				<table cellspacing="0" cellpadding="0" border="0" width="100%" class="formHeader h3Row">
						<tbody><tr>
							<td nowrap="">
								<h2><span>{$LBL_ASOL_PDF_OPTS}</span></h2></td><td width="100%"><img height="1" width="1" src="themes/default/images/blank.gif?s=1f6427691c998307be9837faeadb8770&amp;c=1&amp;developerMode=1631829203" alt="">
							</td>
						</tr></tbody>
				</table>
				
				<table cellspacing="1" cellpadding="0" border="0" width="100%" class="edit view">
						<tbody>
							
							<tr>
								<td nowrap="nowrap" width="15%">
									{$LBL_ASOL_PDF_ORIENTATION}:<span class="required">*</span>
								</td>
							
								<td nowrap="nowrap" width="35%">
								
									<select id="pdf_orientation" name="pdf_orientation">
										<option value="normal" {if $config[2] == 'normal'}selected{/if}>{$LBL_ASOL_PORTRAIT}</option>
										<option value="landscape" {if $config[2] == 'landscape'}selected{/if}>{$LBL_ASOL_LANDSCAPE}</option>
									</select>							
																	
								</td>
								
								<td nowrap="nowrap" width="15%">
									{$LBL_ASOL_PDF_SCALING_FACTOR}:<span class="required">*</span>
								</td>
								
								<td nowrap="nowrap" width="35%">
									<input name="pdf_img_scaling_factor" value="{$config[4]/100}">
								</td>
								
							</tr>				
															
						</tbody>
				</table>
				
				{if ($isAdmin == true)}
				
					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="formHeader h3Row">
							<tbody><tr>
								<td nowrap="">
									<h2><span>{$LBL_ASOL_SCHEDULED_OPTS}</span></h2></td><td width="100%"><img height="1" width="1" src="themes/default/images/blank.gif?s=1f6427691c998307be9837faeadb8770&amp;c=1&amp;developerMode=1631829203" alt="">
								</td>
							</tr></tbody>
					</table>
					
					
					<table cellspacing="1" cellpadding="0" border="0" width="100%" class="edit view">
							<tbody>
								
								<tr>
								
									<td nowrap="nowrap" width="15%">
										{$LBL_ASOL_SCHEDULED_FILES_TTL}:<span class="required">*</span>
									</td>
									
									<td nowrap="nowrap" width="35%">
										<input size="6px" name="scheduled_files_ttl" value="{$config[5]}">
									</td>
								
									<td nowrap="nowrap" width="15%">
										Host Name:
									</td>
									
									<td nowrap="nowrap" width="35%">
										<input size="30px" name="hostName" value="{$config[6]}"> 
									</td>
									
								</tr>				
																
							</tbody>
					</table>
					
				{/if}
				
				{/if}
				
				</form>
				
				{if ($isReportsModule == "true")}
				
				{if ($isAdmin == true)}
				
					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="formHeader h3Row">
							<tbody><tr>
								<td nowrap="">
									<h2><span>{$LBL_ASOL_EXPORTED_CSS}</span></h2></td><td width="100%"><img height="1" width="1" src="themes/default/images/blank.gif?s=1f6427691c998307be9837faeadb8770&amp;c=1&amp;developerMode=1631829203" alt="">
								</td>
							</tr></tbody>
					</table>
					
					<form name="css_form" id="css_form" action="index.php" method="POST" target="_self" enctype="multipart/form-data">
				
					<input type="hidden" value="Administration" name="module">
					<input type="hidden" value="" name="return_action">
				
					<table cellspacing="1" cellpadding="0" border="0" width="100%" class="edit view">
							<tbody>
								
								<tr>
									<td nowrap="nowrap" width="15%">
										{$LBL_ASOL_EXPORT_ORIGINAL_CSS}:
									</td>
								
									<td nowrap="nowrap" width="35%">
										<script type="text/javascript">
										
											{literal}
										
											function onclickTest() {
												
												document.css_form.return_action.value = 'downloadCSS';
												var form = document.getElementById('css_form');
												form.action = 'index.php?entryPoint=reportPopup&module=Administration'; 
												form.target='ExportWindow'; 
												window.open('', 'ExportWindow', 'width=300,height=100,location=0,status=0,scrollbars=0');
												form.submit();
											}
										
											{/literal}
										
										</script>
										
										<input type="button" value="{$LBL_ASOL_EXPORT_CSS}" onclick="onclickTest()">						
																		
									</td>
									
									<td nowrap="nowrap" width="15%">
										{$LBL_ASOL_EXPORT_CUSTOM_CSS}:
									</td>
								
									<td nowrap="nowrap" width="35%">
									
										<input type="button" value="{$LBL_ASOL_EXPORT_CSS}" onclick="document.css_form.return_action.value = 'downloadCustomCSS'; document.css_form.action = 'index.php?entryPoint=reportPopup&module=Administration&domainId={$domainId}'; document.css_form.target='ExportWindow'; window.open('', 'ExportWindow', 'width=300,height=100,location=0,status=0,scrollbars=0'); document.css_form.submit();">						
																		
									</td>
								
								</tr>
								<tr>
								
									<td nowrap="nowrap" width="15%">
										{$LBL_ASOL_RESTORE_CSS}:
									</td>
								
									<td nowrap="nowrap" width="35%">
									
										<input type="button" value="{$LBL_ASOL_RESTORE}" onclick="document.css_form.return_action.value = 'restoreCSS'; document.css_form.action='index.php?action=asolConfig'; document.css_form.target='_self'; document.css_form.submit();">						
																		
									</td>
									
									<td nowrap="nowrap" width="15%">
										{$LBL_ASOL_UPLOAD_CSS}:
									</td>
								
									<td nowrap="nowrap" width="35%">
									
										<input type="file" name="uploadedCSS">&nbsp;&nbsp;<input type="button" value="{$LBL_ASOL_UPLOAD}" onclick="document.css_form.return_action.value = 'uploadCSS'; document.css_form.action='index.php?action=asolConfig'; document.css_form.target='_self'; document.css_form.submit();">					
																		
									</td>
									
								</tr>				
																
							</tbody>
					</table>
				
				</form>
				
				{/if}
				
				{/if}
				
				</div>
				
		</td>
	</tr>
	</tbody>

</table>

</body>

</html>