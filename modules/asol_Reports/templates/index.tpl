<script type="text/javascript" src="modules/asol_Reports/include_basic/js/reports.min.js?version={$reports_version}"></script>
<script type="text/javascript" src="modules/asol_Reports/include_basic/js/LAB.min.js?version={$reports_version}"></script>
<link rel="stylesheet" type="text/css" href="modules/asol_Reports/include_basic/css/style.css?version={$reports_version}">

<script>
{php}
	require_once('modules/asol_Reports/include_basic/manageReportsFunctions.php');
	echo asol_ReportsManagementFunctions::getInitJqueryScriptHtml();
{/php}
</script>

<!-- Titulo Modulo -->
<div class="moduleTitle">
	<h2>{$MOD.LBL_REPORT_SEARCH}</h2>
</div>
<div class="clear"></div>

<div class="listViewBody">

	<table class="alineasol_reports" style="width: 100%">
	
	<tbody>
		<tr>
			<td>
							
				<form id="display_form" name="display_form" action="index.php?module=asol_Reports&action=DetailView" method="post">
					<input type="hidden" id="display_record" name="record" value="">
				</form>
				
				<form id="search_form" name="search_form" class="search_form" action="index.php?module=asol_Reports&action=index" method="post" enctype="multipart/form-data" name="search_form">
					<input type="hidden" value="basic_search" name="searchFormTab">
					<input type="hidden" value="asol_Reports" name="module">
					<input type="hidden" value="index" name="action">
					<input type="hidden" value="true" name="query">
					<input type="hidden" value="{$assigned_user_id}" name="assigned_user_id">
					<input type="hidden" value="" id="return_action" name="return_action">
					
					<input type="hidden" id="page_number" value="{$data.page_number}" name="page_number">
					
					<input type="hidden" value="{$field_sort}" id="field_sort" name="field_sort">
					<input type="hidden" value="{$sort_direction}" id="sort_direction" name="sort_direction">
					
					<div class="edit view search" style="" id="Reportsbasic_searchSearchForm">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
						
							<tbody>
							<tr>
							
								<td nowrap="nowrap" width="8.33333333333%" scope="row">
									{$MOD.LBL_REPORT_NAME}
								</td>
								<td nowrap="nowrap" width="25%">
									<input type="text" tabindex="" title="" value="{$name}" maxlength="" size="30" id="name_basic" name="name_basic"> 
							   	</td>
							
								<td nowrap="nowrap" width="8.33333333333%" scope="row">
									{$MOD.LBL_REPORT_MODULE}
								</td>
								
								<td nowrap="nowrap" width="25%">
								
									<select style="max-width: 150px;" name="database_type_basic" onChange="if (this.selectedIndex < 1) document.getElementById('module_type_basic').style.visibility = 'inherit'; else document.getElementById('module_type_basic').style.visibility = 'hidden';">
										<option value="-1">{$MOD.LBL_REPORT_NATIVE_DB}</option>
										{foreach from=$available_alternative_db key=db_index item=alternativeDb}
	  										<option value="{$db_index}" {if ($sel_altDb == $db_index)} selected {/if}>{$alternativeDb}</option>
										{/foreach}
									</select>
	
									{if ($sel_altDb >= '0')}
									<select style="width: 150px; visibility: hidden" name="module_type_basic" id="module_type_basic">
									{else}
									<select style="width: 150px; visibility: inherit" name="module_type_basic" id="module_type_basic">
									{/if}
										
										<option value=""></option>
										
										{foreach key=keyModule item=itemModule from=$available_modules}
										
										<option value="{$keyModule}" {if $report_module == $keyModule}selected{/if}>{$itemModule}</option>
										
										{/foreach}
				
									</select>
									
									
									
	   							</td>
								
								<td nowrap="nowrap" width="8.33333333333%" scope="row">
									{$MOD.LBL_REPORT_ASSIGNED_TO}
								</td>
								
								<td nowrap="nowrap" width="25%">
									<input type="text" tabindex="" title="" value="{$assigned_user_name}" maxlength="" size="30" id="assigned_user_name" name="assigned_user_name">
									<button type="button" onclick="open_popup('Users', 600, 400, '', true, false, {literal}{'call_back_function':'set_return','form_name':'search_form','field_to_name_array':{'id':'assigned_user_id','user_name':'assigned_user_name'}}{/literal}, 'single', true);" title="{$APP.LBL_SELECT_BUTTON_LABEL}" class="button" id="btn_assigned_user_name" name="btn_assigned_user_name"><img src='themes/default/images/id-ff-select.png'></button>
	   								<button type="button" onclick="document.search_form.assigned_user_name.value = '';" title="{$APP.LBL_CLEAR_BUTTON_LABEL}" class="button" id="btn_clr_assigned_user_name" name="btn_clr_assigned_user_name"><img src='themes/default/images/id-ff-clear.png'></button>
	   							</td>
							
							</tr>
							
							<tr>
							
								<td nowrap="nowrap" width="8.33333333333%" scope="row">
									{$MOD.LBL_REPORT_SCOPE}
								</td>
								
								<td nowrap="nowrap" width="25%">
									<select style="width: 150px;" name="scope_basic">
										
										<option value="" {if $report_scope == ""}selected{/if}>{$MOD.LBL_REPORT_ALL}</option>
										<option value="public"  {if $report_scope == "public"}selected{/if}>{$MOD.LBL_REPORT_PUBLIC}</option>
										<option value="private" {if $report_scope == "private"}selected{/if}>{$MOD.LBL_REPORT_PRIVATE}</option>
										<option value="role" {if $report_scope == "role"}selected{/if}>{$MOD.LBL_REPORT_ROLE}</option>
				
									</select>
	   							</td>
							
								
								<td nowrap="nowrap" width="8.33333333333%" scope="row">
									{$MOD.LBL_REPORT_TYPE}
								</td>
								
								<td nowrap="nowrap" width="25%">
									<select style="width: 150px;" name="type_basic">
										
										<option value="" {if $report_scope == ""}selected{/if}>{$MOD.LBL_REPORT_ALL}</option>
										<option value="manual"  {if $report_type == "manual"}selected{/if}>{$MOD.LBL_REPORT_MANUAL}</option>
										<option value="external"  {if $report_type == "external"}selected{/if}>{$MOD.LBL_REPORT_EXTERNAL}</option>
										<option value="scheduled" {if $report_type == "scheduled"}selected{/if}>{$MOD.LBL_REPORT_SCHEDULED}</option>
										<option value="stored" {if $report_type == "stored"}selected{/if}>{$MOD.LBL_REPORT_STORED}</option>								
				
									</select>
	   							</td>
							
							
							</tr>
							</tbody>
							
						</table>
					</div>
				
					<input type="submit" id="search_form_submit" value="{$APP.LBL_SEARCH}" name="button" class="button" onclick="document.search_form.return_action.value=''; document.getElementById('page_number').value = 0;" title="{$APP.LBL_SEARCH}">
					<input type="button" value="{$APP.LBL_CLEAR_BUTTON_LABEL}" name="clear" class="button" onclick="SUGAR.searchForm.clear_form(this.form);" title="{$APP.LBL_CLEAR_BUTTON_LABEL}">
					
					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="list view" id="reportRows">
						<tbody>
						
						<!-- Paginado -->
						<tr class="pagination">
							<td colspan="{$is_domains_installed+10}" align="right">
								<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paginationTable">
									<tbody><tr>
															
										<td nowrap="nowrap" align="right" width="2%" class="paginationChangeButtons">
											
											<button {if (($data.num_pages == 0) || ($data.page_number == 0)) } disabled {/if} class="button" title="{$APP.LNK_LIST_START}" name="listViewStartButton" type="button" onClick="document.search_form.page_number.value=0; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="13" alt="{$APP.LNK_LIST_START}" {if (($data.num_pages == 0) || ($data.page_number == 0)) } src="themes/default/images/start_off.gif" {else} src="themes/default/images/start.gif" {/if}>
											</button>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == 0)) } disabled {/if} title="{$APP.LNK_LIST_PREVIOUS}" class="button" name="listViewPrevButton" type="button"  onClick="document.search_form.page_number.value={if $data.page_number > 0}{$data.page_number-1}{else}0{/if}; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="8" alt="{$APP.LNK_LIST_PREVIOUS}" {if (($data.num_pages == 0) || ($data.page_number == 0)) } src="themes/default/images/previous_off.gif" {else} src="themes/default/images/previous.gif" {/if}>
											</button>
											
											<span class="pageNumbers">({if $data.total_entries != 0}{$data.page_number*$data.entries_per_page+1}{else}{$data.page_number*$data.entries_per_page}{/if} - {$data.entries_per_page*$data.page_number+$data.current_entries} of {$data.total_entries})</span>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } disabled {/if} title="{$APP.LNK_LIST_NEXT}" class="button" name="listViewNextButton" type="button" onClick="document.search_form.return_action.value=''; document.search_form.page_number.value={if $data.page_number < $data.num_pages}{$data.page_number+1}{else}{$data.num_pages}{/if}; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="8" alt="{$APP.LNK_LIST_NEXT}" {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } src="themes/default/images/next_off.gif" {else} src="themes/default/images/next.gif" {/if}>
											</button>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } disabled {/if} title="{$APP.LNK_LIST_END}" class="button" name="listViewEndButton" type="button"  onClick="document.search_form.return_action.value=''; document.search_form.page_number.value={$data.num_pages}; document.search_form.submit()">
								 				<img height="11" border="0" align="absmiddle" width="13" alt="{$APP.LNK_LIST_END}" {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } src="themes/default/images/end_off.gif" {else} src="themes/default/images/end.gif" {/if}>
											</button>
										
										</td>
					
									</tr></tbody>
								</table>
							</td>
							
						</tr>
						
						<!-- Cabecera de la tabla -->
						
						<tr height="20">
						
							<th nowrap="nowrap" width="2%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
									<input type="checkbox" class="massiveCheck_all" />
								</div>
							</th>
											
							<th nowrap="nowrap" width="20%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                    			{if (($field_sort != 'name') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionName value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionName value='DESC'}
	                    			{/if}
	                    			<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionName}'); $('#field_sort').val('name'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_NAME}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'name') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'name') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
	
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                    			{if (($field_sort != 'report_module') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionModule value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionModule value='DESC'}
	                    			{/if}
	                    			<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionModule}'); $('#field_sort').val('report_module'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_MODULE}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'report_module') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'report_module') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                            	{if (($field_sort != 'last_run') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionLastRun value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionLastRun value='DESC'}
	                    			{/if}
	                            	<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionLastRun}'); $('#field_sort').val('last_run'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_LAST_RUN}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'last_run') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'last_run') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                            	{if (($field_sort != 'date_modified') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionDateModified value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionDateModified value='DESC'}
	                    			{/if}
	                            	<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionDateModified}'); $('#field_sort').val('date_modified'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_LAST_UPDATE}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'date_modified') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'date_modified') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
	
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                            	{if (($field_sort != 'user_name') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionUserName value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionUserName value='DESC'}
	                    			{/if}
	                            	<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionUserName}'); $('#field_sort').val('user_name'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_ASSIGNED_USER}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'user_name') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'user_name') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
									{if (($field_sort != 'report_scope') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionScope value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionScope value='DESC'}
	                    			{/if}
									<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionScope}'); $('#field_sort').val('report_scope'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_SCOPE}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'report_scope') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'report_scope') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
				
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                            	{if (($field_sort != 'report_type') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionType value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionType value='DESC'}
	                    			{/if}
	                            	<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionType}'); $('#field_sort').val('report_type'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_TYPE}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'report_type') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'report_type') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
							
							{if $is_domains_installed}
							<th nowrap="nowrap" width="10%" scope="col">
								<div align="left" width="100%" style="white-space: nowrap;">
	                            	{if (($field_sort != 'asol_domains.name') || ($sort_direction == 'DESC'))}
	                    				{assign var=sortDirectionDomain value='ASC'}
	                    			{else}
	                    				{assign var=sortDirectionDomain value='DESC'}
	                    			{/if}
	                            	<a class="listViewThLinkS1" OnMouseOver="this.style.cursor='pointer'" OnMouseOut="this.style.cursor='default'" onclick="$('#sort_direction').val('{$sortDirectionDomain}'); $('#field_sort').val('asol_domains.name'); document.search_form.action.value='index'; $('#return_action').val(''); document.search_form.submit()">{$MOD.LBL_REPORT_DOMAIN}</a>
				    				&nbsp;<img height="10" border="0" align="absmiddle" width="8" {if (($field_sort == 'asol_domains.name') && ($sort_direction == 'ASC')) } src="themes/default/images/arrow_up.gif" {elseif (($field_sort == 'asol_domains.name') && ($sort_direction == 'DESC')) } src="themes/default/images/arrow_down.gif" {else} src="themes/default/images/arrow.gif" {/if} >
									
								</div>
							</th>
							{/if}
							
							<th nowrap="nowrap" width="2%" scope="col"></th>
							<th nowrap="nowrap" width="7%" scope="col"></th>
						</tr>
			
						<!--  -->
						<!-- Aqui va la tabla con todos los campos encontrados -->
						
	
						{section name=row_sec loop=$rows}
							{strip}
										
							{if $smarty.section.row_sec.iteration is even}
						    	{assign var=colorClass value="evenListRowS1"}
						    {else}
						    	{assign var=colorClass value="oddListRowS1"}
						    {/if}
						    
						    {if (($rows[row_sec].user_modifiable) || ($rows[row_sec].role_modifiable)) && ($rows[row_sec].domain_modifiable) && ($REPORTS_ACL_DELETE)}
						    	{assign var=deletableReport value="true"}
					    	{else}
					    		{assign var=deletableReport value="false"}
					    	{/if}
																
							<tr class="{$colorClass} asolReportsIndexRow" height="20">
							
								<td align="left" width="2%" valign="top" scope="row">	
								    {if ($rows[row_sec].domain_modifiable)}					
									<input type="checkbox" class="listViewCheck massiveCheck" name="selectedRows[]" value="{$rows[row_sec].id}">
									{/if}
									<input type="hidden" class="deletableReport" value="{$deletableReport}" />
								</td>
							
								<td align="left" width="20%" valign="top" scope="row">						
									<!-- Al clickear ir a la p�gna de visualizaci�n -->
									<!-- <a href="index.php?module=asol_Reports&action=DetailView&record={$rows[row_sec].id}">{$rows[row_sec].name}</a>-->
									{if $rows[row_sec].execute}
										<a href="#" onClick="document.getElementById('display_record').value = '{$rows[row_sec].id}'; document.display_form.submit();">{$rows[row_sec].name}</a>
									{else}
										{$rows[row_sec].name}
									{/if}
								</td>
		
								<td align="left" width="10%" valign="top" scope="row">						
									{$translatedRows[row_sec].module}
								</td>
		
								<td align="left" width="10%" valign="top" scope="row">						
									{$rows[row_sec].last_run}
								</td>
								
								<td align="left" width="10%" valign="top" scope="row">						
									{$rows[row_sec].date_modified}
								</td>
								
								<td align="left" width="10%" valign="top" scope="row">						
									{$rows[row_sec].user_name}
								</td>
								
								<td align="left" width="10%" valign="top" scope="row">						
									{$translatedRows[row_sec].report_scope}
								</td>
								
								<td align="left" width="10%" valign="top" scope="row">						
									{if $rows[row_sec].task_state == "A"}<font color="GREEN">{elseif $rows[row_sec].task_state == "I"}<font color="RED">{elseif $rows[row_sec].task_state == "S"}<font color="ORANGE">{/if}{$translatedRows[row_sec].type}</font>
								</td>
								
								{if $is_domains_installed}
								<td align="left" width="10%" valign="top" scope="row">						
									{$rows[row_sec].domain_name}
								</td>
								{/if}
								
								<!-- Enlazar a la pagina de edicion de Reports -->
								
								<td align="right" width="2%" valign="top" scope="row">
								
									{if $REPORTS_ACL_VIEW}
									
									<!-- <a title="{$MOD.LBL_REPORT_EXECUTE}" href="index.php?module=asol_Reports&action=DetailView&record={$rows[row_sec].id}"><img style="margin-right: 5px" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_runreport.png"></a>-->
									{if ($rows[row_sec].type == "stored")}
										<a title="{$MOD.LBL_REPORT_SHOW}" href="#" onClick="document.getElementById('display_record').value = '{$rows[row_sec].id}'; document.display_form.submit();"><img style="margin-right: 5px" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_runreport.png"></a>
									{else}
										{if $rows[row_sec].execute}
											<a title="{$MOD.LBL_REPORT_EXECUTE}" href="#" onClick="document.getElementById('display_record').value = '{$rows[row_sec].id}'; document.display_form.submit();"><img style="margin-right: 5px" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_runreport.png"></a>
										{else}
											<a title="{$MOD.LBL_REPORT_EXECUTE}" href="#" onClick="alert('{$rows[row_sec].external_url}');"><img style="margin-right: 0px" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_url.png"></a>
										{/if}
									{/if}
									
									{/if}
								
								</td>
								
								<td align="right" width="7%" valign="top" scope="row">
								
									{if (($rows[row_sec].domain_modifiable) && ($REPORTS_ACL_EXPORT))}
									<a title="{$MOD.LBL_REPORT_COPY}" href="index.php?module=asol_Reports&action=EditView&record={$rows[row_sec].id}&return_action=duplicate&report_name=Copy of {$rows[row_sec].name}&init_report_scope={$rows[row_sec].report_scope}"><img class="asol_icon" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_duplicate.png"></a>
									{/if}
	
									{if (($rows[row_sec].user_modifiable) || ($rows[row_sec].role_modifiable)) && ($rows[row_sec].domain_modifiable) && ($REPORTS_ACL_EDIT)}
									<a title="{$MOD.LBL_REPORT_EDIT}" href="index.php?module=asol_Reports&action=EditView&record={$rows[row_sec].id}&init_report_scope={$rows[row_sec].report_scope}"><img class="asol_icon" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_edit.png"></a>								
									{/if}
									
									{if (($rows[row_sec].domain_modifiable) && ($REPORTS_ACL_EXPORT))}
									<a title="{$MOD.LBL_REPORT_EXPORT_ONE}" href="index.php?module=asol_Reports&action=index&return_action=exportReport&record={$rows[row_sec].id}"><img class="asol_icon" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_export.png"></a>
									{/if}
									
									{if (($rows[row_sec].user_modifiable) || ($rows[row_sec].role_modifiable)) && ($rows[row_sec].domain_modifiable) && ($REPORTS_ACL_DELETE)}								
									<a title="{$APP.LBL_DELETE}" href="index.php?module=asol_Reports&action=save&delete=true&record={$rows[row_sec].id}" onclick="return confirm('{$MOD.MSG_REPORT_DELETE_ALERT} {$rows[row_sec].name}')"><img class="asol_icon" border="0" src="modules/asol_Reports/include_basic/images/asol_reports_delete.png"></a>
									{/if}
								
								</td>
		
							</tr>
						
							{/strip}
						{/section}
						
						<!-- Paginado -->
						<tr class="pagination">
							<td colspan="{$is_domains_installed+10}" align="right">
								<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paginationTable">
									<tbody><tr>
															
										<td nowrap="nowrap" align="right" width="2%" class="paginationChangeButtons">
											
											<button {if (($data.num_pages == 0) || ($data.page_number == 0)) } disabled {/if} class="button" title="{$APP.LNK_LIST_START}" name="listViewStartButton" type="button" onClick="document.search_form.page_number.value=0; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="13" alt="{$APP.LNK_LIST_START}" {if (($data.num_pages == 0) || ($data.page_number == 0)) } src="themes/default/images/start_off.gif" {else} src="themes/default/images/start.gif" {/if}>
											</button>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == 0)) } disabled {/if} title="{$APP.LNK_LIST_PREVIOUS}" class="button" name="listViewPrevButton" type="button"  onClick="document.search_form.page_number.value={if $data.page_number > 0}{$data.page_number-1}{else}0{/if}; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="8" alt="{$APP.LNK_LIST_PREVIOUS}" {if (($data.num_pages == 0) || ($data.page_number == 0)) } src="themes/default/images/previous_off.gif" {else} src="themes/default/images/previous.gif" {/if}>
											</button>
											
											<span class="pageNumbers">({if $data.total_entries != 0}{$data.page_number*$data.entries_per_page+1}{else}{$data.page_number*$data.entries_per_page}{/if} - {$data.entries_per_page*$data.page_number+$data.current_entries} of {$data.total_entries})</span>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } disabled {/if} title="{$APP.LNK_LIST_NEXT}" class="button" name="listViewNextButton" type="button" onClick="document.search_form.page_number.value={if $data.page_number < $data.num_pages}{$data.page_number+1}{else}{$data.num_pages}{/if}; document.search_form.submit()">
												<img height="11" border="0" align="absmiddle" width="8" alt="{$APP.LNK_LIST_NEXT}" {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } src="themes/default/images/next_off.gif" {else} src="themes/default/images/next.gif" {/if}>
											</button>
											
											<button {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } disabled {/if} title="{$APP.LNK_LIST_END}" class="button" name="listViewEndButton" type="button"  onClick="document.search_form.page_number.value={$data.num_pages}; document.search_form.submit()">
								 				<img height="11" border="0" align="absmiddle" width="13" alt="{$APP.LNK_LIST_END}" {if (($data.num_pages == 0) || ($data.page_number == $data.num_pages) || ($data.total_entries == 0)) } src="themes/default/images/end_off.gif" {else} src="themes/default/images/end.gif" {/if}>
											</button>
										
										</td>
					
									</tr></tbody>
								</table>
							</td>
							
						</tr>
	
						<tr>
							<td colspan=8>
											
								<input type="hidden" name="MAX_FILE_SIZE" value="100000">
								
								{if $REPORTS_ACL_IMPORT}			
									{$MOD.LBL_REPORT_SELECT_FILE}: <input name="importedReport" type="file">&nbsp;&nbsp;
									<input type="submit" value="{$MOD.LBL_REPORT_IMPORT}" onClick="document.search_form.return_action.value='importReport'">&nbsp;
								{/if}										
								{if $REPORTS_ACL_EXPORT}
									<input disabled type="submit" value="{$MOD.LBL_REPORT_EXPORT}" class="massiveAction" onClick="document.search_form.return_action.value='exportReport'">
								{/if}
								
								<input disabled type="submit" value="{$MOD.LBL_REPORT_MULTIDELETE}" class="massiveAction" onClick="{literal}document.search_form.return_action.value='deleteReport'; return deleteReports('massiveCheck', 'deletableReport');{/literal}">
											
							</td>
						</tr>
	
					</tbody></table>
					
				</form>	
					
			</td>
		</tr>
		
		
			
	</tbody>
	
	</table>
	
	{literal}
	<script>
		window.onload = initJqueryScripts(false, function() {
			initMassiveAction('reportRows', 'massiveCheck', 'massiveCheck_all', 'massiveAction');
		});
	</script>
	{/literal}
	
</div>