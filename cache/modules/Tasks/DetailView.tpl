

<script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
<form action="index.php" method="post" name="DetailView2" id="formDetailView">
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
</form>
<div class="action_buttons">{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Tasks'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}  {if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Tasks'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if}  {if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Tasks'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} <div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Tasks_detailview_tabs"
>
<form method="post" action="index.php" name='DetailView' id='DetailView'>
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="">
<input type="hidden" name="to_pdf" value="">
{php}
global $beanList,$beanFiles;
$class_name = $beanList[$_REQUEST['module']];
$b = new $class_name();
$b->retrieve($_REQUEST['record']);
if($b->ACLAccess('Save'))
echo '<input type="hidden" id="is_editable" value="true">';
else
echo '<input type="hidden" id="is_editable" value="">';
{/php}
<div >
<div id='detailpanel_1' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(1);">
<img border="0" id="detailpanel_1_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(1);">
<img border="0" id="detailpanel_1_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_TASK_INFORMATION' module='Tasks'}
<script>
document.getElementById('detailpanel_1').className += ' expanded';
</script>
</h4>
<table id='LBL_TASK_INFORMATION' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.task_type.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TASK_TYPE' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('task_type','enum')" class="div_value" id="task_type_detailblock" target_id="task_type">
{if !$fields.task_type.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.task_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.task_type.name}" value="{ $fields.task_type.options }">
{ $fields.task_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.task_type.name}" value="{ $fields.task_type.value }">
{ $fields.task_type.options[$fields.task_type.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.status.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('status','enum')" class="div_value" id="status_detailblock" target_id="status">
{if !$fields.status.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.status.options)}
<input type="hidden" class="sugar_field" id="{$fields.status.name}" value="{ $fields.status.options }">
{ $fields.status.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.status.name}" value="{ $fields.status.value }">
{ $fields.status.options[$fields.status.value]}
{/if}
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.date_start.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_START_DATE' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_start','datetimecombo')" class="div_value" id="date_start_detailblock" target_id="date_start">
{if !$fields.date_start.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_start.value) <= 0}
{assign var="value" value=$fields.date_start.default_value }
{else}
{assign var="value" value=$fields.date_start.value }
{/if} 
<span class="sugar_field" id="{$fields.date_start.name}">{$fields.date_start.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.parent_name.hidden}
{sugar_translate label='LBL_MODULE_NAME' module=$fields.parent_type.value}
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('parent_name','parent')" class="div_value" id="parent_name_detailblock" target_id="parent_name">
{if !$fields.parent_name.hidden}
{counter name="panelFieldCount"}

<input type="hidden" class="sugar_field" id="{$fields.parent_name.name}" value="{$fields.parent_name.value}">
<input type="hidden" class="sugar_field" id="parent_id" value="{$fields.parent_id.value}">
<a href="index.php?module={$fields.parent_type.value}&action=DetailView&record={$fields.parent_id.value}" class="tabDetailViewDFLink">{$fields.parent_name.value}</a>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.date_due.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DUE_DATE' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_due','datetimecombo')" class="div_value" id="date_due_detailblock" target_id="date_due">
{if !$fields.date_due.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_due.value) <= 0}
{assign var="value" value=$fields.date_due.default_value }
{else}
{assign var="value" value=$fields.date_due.value }
{/if} 
<span class="sugar_field" id="{$fields.date_due.name}">{$fields.date_due.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.priority.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORITY' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('priority','enum')" class="div_value" id="priority_detailblock" target_id="priority">
{if !$fields.priority.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.priority.options)}
<input type="hidden" class="sugar_field" id="{$fields.priority.name}" value="{ $fields.priority.options }">
{ $fields.priority.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.priority.name}" value="{ $fields.priority.value }">
{ $fields.priority.options[$fields.priority.value]}
{/if}
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.description.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('description','text')" class="div_value" id="description_detailblock" target_id="description">
{if !$fields.description.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.expan_gestionsolicitudes_tasks_1_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXPAN_GESTIONSOLICITUDES_TASKS_1_FROM_EXPAN_GESTIONSOLICITUDES_TITLE' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_gestionsolicitudes_tasks_1_name','relate')" class="div_value" id="expan_gestionsolicitudes_tasks_1_name_detailblock" target_id="expan_gestionsolicitudes_tasks_1_name">
{if !$fields.expan_gestionsolicitudes_tasks_1_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida.value)}
{capture assign="detail_url"}index.php?module=Expan_GestionSolicitudes&action=DetailView&record={$fields.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida" class="sugar_field" data-id-value="{$fields.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida.value}">{$fields.expan_gestionsolicitudes_tasks_1_name.value}</span>
{if !empty($fields.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida.value)}</a>{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.oportunidad_inmediata.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OPORTUNIDAD_INMEDIATA' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('oportunidad_inmediata','bool')" class="div_value" id="oportunidad_inmediata_detailblock" target_id="oportunidad_inmediata">
{if !$fields.oportunidad_inmediata.hidden}
{counter name="panelFieldCount"}

{if strval($fields.oportunidad_inmediata.value) == "1" || strval($fields.oportunidad_inmediata.value) == "yes" || strval($fields.oportunidad_inmediata.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.oportunidad_inmediata.name}" id="{$fields.oportunidad_inmediata.name}" value="$fields.oportunidad_inmediata.value" disabled="true" {$checked}>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.expan_franquicia_tasks_1_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXPAN_FRANQUICIA_TASKS_1_FROM_EXPAN_FRANQUICIA_TITLE' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_franquicia_tasks_1_name','relate')" class="div_value" id="expan_franquicia_tasks_1_name_detailblock" target_id="expan_franquicia_tasks_1_name">
{if !$fields.expan_franquicia_tasks_1_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.expan_franquicia_tasks_1expan_franquicia_ida.value)}
{capture assign="detail_url"}index.php?module=Expan_Franquicia&action=DetailView&record={$fields.expan_franquicia_tasks_1expan_franquicia_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="expan_franquicia_tasks_1expan_franquicia_ida" class="sugar_field" data-id-value="{$fields.expan_franquicia_tasks_1expan_franquicia_ida.value}">{$fields.expan_franquicia_tasks_1_name.value}</span>
{if !empty($fields.expan_franquicia_tasks_1expan_franquicia_ida.value)}</a>{/if}
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.modified_by_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MODIFICADO_POR' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modified_by_name','relate')" class="div_value" id="modified_by_name_detailblock" target_id="modified_by_name">
{if !$fields.modified_by_name.hidden}
{counter name="panelFieldCount"}

<span id="modified_user_id" class="sugar_field" data-id-value="{$fields.modified_user_id.value}">{$fields.modified_by_name.value}</span>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(1, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_TASK_INFORMATION").style.display='none';</script>
{/if}
<div id='detailpanel_2' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(2);">
<img border="0" id="detailpanel_2_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(2);">
<img border="0" id="detailpanel_2_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_PANEL_ASSIGNMENT' module='Tasks'}
<script>
document.getElementById('detailpanel_2').className += ' expanded';
</script>
</h4>
<table id='LBL_PANEL_ASSIGNMENT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('assigned_user_name','relate')" class="div_value" id="assigned_user_name_detailblock" target_id="assigned_user_name">
{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount"}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_entered','datetime')" class="div_value" id="date_entered_detailblock" target_id="date_entered">
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='%' scope="col">
{if !$fields.date_modified.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_MODIFIED' module='Tasks'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_modified','datetime')" class="div_value" id="date_modified_detailblock" target_id="date_modified">
{if !$fields.date_modified.hidden}
{counter name="panelFieldCount"}
<span id="date_modified" class="sugar_field">{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}</span>
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(2, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PANEL_ASSIGNMENT").style.display='none';</script>
{/if}
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>
<script src='include/javascript/enhanced_detailview.js'></script>
<script src='include/javascript/popup_helper.js'></script>
<script type='text/javascript'>
	EDV.calendar_format = "{$CALENDAR_FORMAT}";
</script>