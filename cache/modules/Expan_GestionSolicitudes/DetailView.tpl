

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
<div class="action_buttons">{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}  {if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if}  {if $fields.id.value!=""}<input type="button" name="irsol" id="irsol" class onClick="irSolicitud('{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}');" value="Editar Solicitud"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C1','{$fields.id.value}');" value="Reenviar C1"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C2','{$fields.id.value}');" value="Reenviar C2"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C3','{$fields.id.value}');" value="Reenviar C3"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C4','{$fields.id.value}');" value="Reenviar C4"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C1.1','{$fields.id.value}');" value="Reenviar C1.1"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C1.2','{$fields.id.value}');" value="Reenviar C1.2"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C1.3','{$fields.id.value}');" value="Reenviar C1.3"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="save" class="submit" 
onClick="reenvioInfo('C1.4','{$fields.id.value}');" value="Reenviar C1.4"/>{/if} {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Expan_GestionSolicitudes", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Expan_GestionSolicitudes_detailview_tabs"
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
<table id='DEFAULT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.expan_solicitud_expan_gestionsolicitudes_1_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_solicitud_expan_gestionsolicitudes_1_name','relate')" class="div_value" id="expan_solicitud_expan_gestionsolicitudes_1_name_detailblock" target_id="expan_solicitud_expan_gestionsolicitudes_1_name">
{if !$fields.expan_solicitud_expan_gestionsolicitudes_1_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value)}
{capture assign="detail_url"}index.php?module=Expan_Solicitud&action=DetailView&record={$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida" class="sugar_field" data-id-value="{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}">{$fields.expan_solicitud_expan_gestionsolicitudes_1_name.value}</span>
{if !empty($fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value)}</a>{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha creacion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_entered','datetime')" class="div_value" id="date_entered_detailblock" target_id="date_entered">
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.prioridad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('prioridad','int')" class="div_value" id="prioridad_detailblock" target_id="prioridad">
{if !$fields.prioridad.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.prioridad.name}">
{sugar_number_format precision=0 var=$fields.prioridad.value}
</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_envio_auto.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envios automatizados' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_auto','bool')" class="div_value" id="chk_envio_auto_detailblock" target_id="chk_envio_auto">
{if !$fields.chk_envio_auto.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_auto.value) == "1" || strval($fields.chk_envio_auto.value) == "yes" || strval($fields.chk_envio_auto.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_auto.name}" id="{$fields.chk_envio_auto.name}" value="$fields.chk_envio_auto.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.franquicia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia','enum')" class="div_value" id="franquicia_detailblock" target_id="franquicia">
{if !$fields.franquicia.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.franquicia.options)}
<input type="hidden" class="sugar_field" id="{$fields.franquicia.name}" value="{ $fields.franquicia.options }">
{ $fields.franquicia.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.franquicia.name}" value="{ $fields.franquicia.value }">
{ $fields.franquicia.options[$fields.franquicia.value]}
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
<td width='12.5%' scope="col">
{if !$fields.oportunidad_inmediata.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OPORTUNIDAD_INMEDIATA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
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
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.candidatura_avanzada.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CANDIDATURA_AVANZADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('candidatura_avanzada','bool')" class="div_value" id="candidatura_avanzada_detailblock" target_id="candidatura_avanzada">
{if !$fields.candidatura_avanzada.hidden}
{counter name="panelFieldCount"}

{if strval($fields.candidatura_avanzada.value) == "1" || strval($fields.candidatura_avanzada.value) == "yes" || strval($fields.candidatura_avanzada.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.candidatura_avanzada.name}" id="{$fields.candidatura_avanzada.name}" value="$fields.candidatura_avanzada.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.estado_sol.hidden}
{capture name="label" assign="label"}{sugar_translate label='Estado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_sol','enum')" class="div_value" id="estado_sol_detailblock" target_id="estado_sol">
{if !$fields.estado_sol.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.estado_sol.options)}
<input type="hidden" class="sugar_field" id="{$fields.estado_sol.name}" value="{ $fields.estado_sol.options }">
{ $fields.estado_sol.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.estado_sol.name}" value="{ $fields.estado_sol.value }">
{ $fields.estado_sol.options[$fields.estado_sol.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.candidatura_caliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='Candidatura caliente' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('candidatura_caliente','bool')" class="div_value" id="candidatura_caliente_detailblock" target_id="candidatura_caliente">
{if !$fields.candidatura_caliente.hidden}
{counter name="panelFieldCount"}

{if strval($fields.candidatura_caliente.value) == "1" || strval($fields.candidatura_caliente.value) == "yes" || strval($fields.candidatura_caliente.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.candidatura_caliente.name}" id="{$fields.candidatura_caliente.name}" value="$fields.candidatura_caliente.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.chk_envio_documentacion.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envio de la documentacion (C1)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_documentacion','bool')" class="div_value" id="chk_envio_documentacion_detailblock" target_id="chk_envio_documentacion">
{if !$fields.chk_envio_documentacion.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_documentacion.value) == "1" || strval($fields.chk_envio_documentacion.value) == "yes" || strval($fields.chk_envio_documentacion.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_documentacion.name}" id="{$fields.chk_envio_documentacion.name}" value="$fields.chk_envio_documentacion.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.envio_documentacion.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envio de Documentación' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('envio_documentacion','date')" class="div_value" id="envio_documentacion_detailblock" target_id="envio_documentacion">
{if !$fields.envio_documentacion.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.envio_documentacion.value) <= 0}
{assign var="value" value=$fields.envio_documentacion.default_value }
{else}
{assign var="value" value=$fields.envio_documentacion.value }
{/if}
<span class="sugar_field" id="{$fields.envio_documentacion.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_responde_C1.hidden}
{capture name="label" assign="label"}{sugar_translate label='Responde a C1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_responde_C1','bool')" class="div_value" id="chk_responde_C1_detailblock" target_id="chk_responde_C1">
{if !$fields.chk_responde_C1.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_responde_C1.value) == "1" || strval($fields.chk_responde_C1.value) == "yes" || strval($fields.chk_responde_C1.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_responde_C1.name}" id="{$fields.chk_responde_C1.name}" value="$fields.chk_responde_C1.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_responde_C1.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha respuesta C1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_responde_C1','date')" class="div_value" id="f_responde_C1_detailblock" target_id="f_responde_C1">
{if !$fields.f_responde_C1.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_responde_C1.value) <= 0}
{assign var="value" value=$fields.f_responde_C1.default_value }
{else}
{assign var="value" value=$fields.f_responde_C1.value }
{/if}
<span class="sugar_field" id="{$fields.f_responde_C1.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_sol_amp_info.hidden}
{capture name="label" assign="label"}{sugar_translate label='Solicitud ampliacion información (Llamamos nosotros)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_sol_amp_info','bool')" class="div_value" id="chk_sol_amp_info_detailblock" target_id="chk_sol_amp_info">
{if !$fields.chk_sol_amp_info.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_sol_amp_info.value) == "1" || strval($fields.chk_sol_amp_info.value) == "yes" || strval($fields.chk_sol_amp_info.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_sol_amp_info.name}" id="{$fields.chk_sol_amp_info.name}" value="$fields.chk_sol_amp_info.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_sol_amp_info.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha Solicitud ampliacion información' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_sol_amp_info','date')" class="div_value" id="f_sol_amp_info_detailblock" target_id="f_sol_amp_info">
{if !$fields.f_sol_amp_info.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_sol_amp_info.value) <= 0}
{assign var="value" value=$fields.f_sol_amp_info.default_value }
{else}
{assign var="value" value=$fields.f_sol_amp_info.value }
{/if}
<span class="sugar_field" id="{$fields.f_sol_amp_info.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_resolucion_dudas.hidden}
{capture name="label" assign="label"}{sugar_translate label='Resolucion de primeras dudas (Llaman ellos)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_resolucion_dudas','bool')" class="div_value" id="chk_resolucion_dudas_detailblock" target_id="chk_resolucion_dudas">
{if !$fields.chk_resolucion_dudas.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_resolucion_dudas.value) == "1" || strval($fields.chk_resolucion_dudas.value) == "yes" || strval($fields.chk_resolucion_dudas.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_resolucion_dudas.name}" id="{$fields.chk_resolucion_dudas.name}" value="$fields.chk_resolucion_dudas.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_resolucion_dudas.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha de Resolucion primeras de dudas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_resolucion_dudas','date')" class="div_value" id="f_resolucion_dudas_detailblock" target_id="f_resolucion_dudas">
{if !$fields.f_resolucion_dudas.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_resolucion_dudas.value) <= 0}
{assign var="value" value=$fields.f_resolucion_dudas.default_value }
{else}
{assign var="value" value=$fields.f_resolucion_dudas.value }
{/if}
<span class="sugar_field" id="{$fields.f_resolucion_dudas.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_recepcio_cuestionario.hidden}
{capture name="label" assign="label"}{sugar_translate label='Recepción del cuestionario' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_recepcio_cuestionario','bool')" class="div_value" id="chk_recepcio_cuestionario_detailblock" target_id="chk_recepcio_cuestionario">
{if !$fields.chk_recepcio_cuestionario.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_recepcio_cuestionario.value) == "1" || strval($fields.chk_recepcio_cuestionario.value) == "yes" || strval($fields.chk_recepcio_cuestionario.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_recepcio_cuestionario.name}" id="{$fields.chk_recepcio_cuestionario.name}" value="$fields.chk_recepcio_cuestionario.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_recepcion_cuestionario.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha de recepción del cuestionario' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_recepcion_cuestionario','date')" class="div_value" id="f_recepcion_cuestionario_detailblock" target_id="f_recepcion_cuestionario">
{if !$fields.f_recepcion_cuestionario.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_recepcion_cuestionario.value) <= 0}
{assign var="value" value=$fields.f_recepcion_cuestionario.default_value }
{else}
{assign var="value" value=$fields.f_recepcion_cuestionario.value }
{/if}
<span class="sugar_field" id="{$fields.f_recepcion_cuestionario.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_informacion_adicional.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envio información adicional (C2)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_informacion_adicional','bool')" class="div_value" id="chk_informacion_adicional_detailblock" target_id="chk_informacion_adicional">
{if !$fields.chk_informacion_adicional.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_informacion_adicional.value) == "1" || strval($fields.chk_informacion_adicional.value) == "yes" || strval($fields.chk_informacion_adicional.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_informacion_adicional.name}" id="{$fields.chk_informacion_adicional.name}" value="$fields.chk_informacion_adicional.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_informacion_adicional.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha envio información adicional' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_informacion_adicional','date')" class="div_value" id="f_informacion_adicional_detailblock" target_id="f_informacion_adicional">
{if !$fields.f_informacion_adicional.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_informacion_adicional.value) <= 0}
{assign var="value" value=$fields.f_informacion_adicional.default_value }
{else}
{assign var="value" value=$fields.f_informacion_adicional.value }
{/if}
<span class="sugar_field" id="{$fields.f_informacion_adicional.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_entrevista.hidden}
{capture name="label" assign="label"}{sugar_translate label='Entrevista' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista','bool')" class="div_value" id="chk_entrevista_detailblock" target_id="chk_entrevista">
{if !$fields.chk_entrevista.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista.value) == "1" || strval($fields.chk_entrevista.value) == "yes" || strval($fields.chk_entrevista.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista.name}" id="{$fields.chk_entrevista.name}" value="$fields.chk_entrevista.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_entrevista.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha Entrevista' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista','date')" class="div_value" id="f_entrevista_detailblock" target_id="f_entrevista">
{if !$fields.f_entrevista.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_entrevista.value) <= 0}
{assign var="value" value=$fields.f_entrevista.default_value }
{else}
{assign var="value" value=$fields.f_entrevista.value }
{/if}
<span class="sugar_field" id="{$fields.f_entrevista.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_propuesta_zona.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_propuesta_zona','bool')" class="div_value" id="chk_propuesta_zona_detailblock" target_id="chk_propuesta_zona">
{if !$fields.chk_propuesta_zona.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_propuesta_zona.value) == "1" || strval($fields.chk_propuesta_zona.value) == "yes" || strval($fields.chk_propuesta_zona.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_propuesta_zona.name}" id="{$fields.chk_propuesta_zona.name}" value="$fields.chk_propuesta_zona.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_propuesta_zona.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_propuesta_zona','date')" class="div_value" id="f_propuesta_zona_detailblock" target_id="f_propuesta_zona">
{if !$fields.f_propuesta_zona.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_propuesta_zona.value) <= 0}
{assign var="value" value=$fields.f_propuesta_zona.default_value }
{else}
{assign var="value" value=$fields.f_propuesta_zona.value }
{/if}
<span class="sugar_field" id="{$fields.f_propuesta_zona.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_visitado_fran.hidden}
{capture name="label" assign="label"}{sugar_translate label='Visitado franquiciado/unidad propia' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visitado_fran','bool')" class="div_value" id="chk_visitado_fran_detailblock" target_id="chk_visitado_fran">
{if !$fields.chk_visitado_fran.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_visitado_fran.value) == "1" || strval($fields.chk_visitado_fran.value) == "yes" || strval($fields.chk_visitado_fran.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_visitado_fran.name}" id="{$fields.chk_visitado_fran.name}" value="$fields.chk_visitado_fran.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_visitado_fran.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha Visitado franquiciado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visitado_fran','date')" class="div_value" id="f_visitado_fran_detailblock" target_id="f_visitado_fran">
{if !$fields.f_visitado_fran.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_visitado_fran.value) <= 0}
{assign var="value" value=$fields.f_visitado_fran.default_value }
{else}
{assign var="value" value=$fields.f_visitado_fran.value }
{/if}
<span class="sugar_field" id="{$fields.f_visitado_fran.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_envio_precontrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envio borrador Precontrato (C3)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_precontrato','bool')" class="div_value" id="chk_envio_precontrato_detailblock" target_id="chk_envio_precontrato">
{if !$fields.chk_envio_precontrato.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_precontrato.value) == "1" || strval($fields.chk_envio_precontrato.value) == "yes" || strval($fields.chk_envio_precontrato.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_precontrato.name}" id="{$fields.chk_envio_precontrato.name}" value="$fields.chk_envio_precontrato.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_envio_precontrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha envio precontrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_precontrato','date')" class="div_value" id="f_envio_precontrato_detailblock" target_id="f_envio_precontrato">
{if !$fields.f_envio_precontrato.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_envio_precontrato.value) <= 0}
{assign var="value" value=$fields.f_envio_precontrato.default_value }
{else}
{assign var="value" value=$fields.f_envio_precontrato.value }
{/if}
<span class="sugar_field" id="{$fields.f_envio_precontrato.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_visita_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='Informacion de local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visita_local','bool')" class="div_value" id="chk_visita_local_detailblock" target_id="chk_visita_local">
{if !$fields.chk_visita_local.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_visita_local.value) == "1" || strval($fields.chk_visita_local.value) == "yes" || strval($fields.chk_visita_local.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_visita_local.name}" id="{$fields.chk_visita_local.name}" value="$fields.chk_visita_local.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_visita_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha Informacion de local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visita_local','date')" class="div_value" id="f_visita_local_detailblock" target_id="f_visita_local">
{if !$fields.f_visita_local.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_visita_local.value) <= 0}
{assign var="value" value=$fields.f_visita_local.default_value }
{else}
{assign var="value" value=$fields.f_visita_local.value }
{/if}
<span class="sugar_field" id="{$fields.f_visita_local.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_envio_contrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='Envío borrador Contrato (C4)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_contrato','bool')" class="div_value" id="chk_envio_contrato_detailblock" target_id="chk_envio_contrato">
{if !$fields.chk_envio_contrato.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_contrato.value) == "1" || strval($fields.chk_envio_contrato.value) == "yes" || strval($fields.chk_envio_contrato.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_contrato.name}" id="{$fields.chk_envio_contrato.name}" value="$fields.chk_envio_contrato.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_envio_contrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha envío de contrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_contrato','date')" class="div_value" id="f_envio_contrato_detailblock" target_id="f_envio_contrato">
{if !$fields.f_envio_contrato.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_envio_contrato.value) <= 0}
{assign var="value" value=$fields.f_envio_contrato.default_value }
{else}
{assign var="value" value=$fields.f_envio_contrato.value }
{/if}
<span class="sugar_field" id="{$fields.f_envio_contrato.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_visita_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='Visita a la Central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visita_central','bool')" class="div_value" id="chk_visita_central_detailblock" target_id="chk_visita_central">
{if !$fields.chk_visita_central.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_visita_central.value) == "1" || strval($fields.chk_visita_central.value) == "yes" || strval($fields.chk_visita_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_visita_central.name}" id="{$fields.chk_visita_central.name}" value="$fields.chk_visita_central.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_visita_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha visita a la Central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visita_central','date')" class="div_value" id="f_visita_central_detailblock" target_id="f_visita_central">
{if !$fields.f_visita_central.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_visita_central.value) <= 0}
{assign var="value" value=$fields.f_visita_central.default_value }
{else}
{assign var="value" value=$fields.f_visita_central.value }
{/if}
<span class="sugar_field" id="{$fields.f_visita_central.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.chk_posible_colabora.hidden}
{capture name="label" assign="label"}{sugar_translate label='Posible Colaboracion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_posible_colabora','bool')" class="div_value" id="chk_posible_colabora_detailblock" target_id="chk_posible_colabora">
{if !$fields.chk_posible_colabora.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_posible_colabora.value) == "1" || strval($fields.chk_posible_colabora.value) == "yes" || strval($fields.chk_posible_colabora.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_posible_colabora.name}" id="{$fields.chk_posible_colabora.name}" value="$fields.chk_posible_colabora.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_posible_colabora.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha Posible Colaboracion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_posible_colabora','date')" class="div_value" id="f_posible_colabora_detailblock" target_id="f_posible_colabora">
{if !$fields.f_posible_colabora.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_posible_colabora.value) <= 0}
{assign var="value" value=$fields.f_posible_colabora.default_value }
{else}
{assign var="value" value=$fields.f_posible_colabora.value }
{/if}
<span class="sugar_field" id="{$fields.f_posible_colabora.name}">{$value}</span>
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
<td width='12.5%' scope="col">
{if !$fields.cuando_empezar.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUANDO_EMPEZAR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuando_empezar','enum')" class="div_value" id="cuando_empezar_detailblock" target_id="cuando_empezar">
{if !$fields.cuando_empezar.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.cuando_empezar.options)}
<input type="hidden" class="sugar_field" id="{$fields.cuando_empezar.name}" value="{ $fields.cuando_empezar.options }">
{ $fields.cuando_empezar.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.cuando_empezar.name}" value="{ $fields.cuando_empezar.value }">
{ $fields.cuando_empezar.options[$fields.cuando_empezar.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.papel.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAPEL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('papel','enum')" class="div_value" id="papel_detailblock" target_id="papel">
{if !$fields.papel.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.papel.options)}
<input type="hidden" class="sugar_field" id="{$fields.papel.name}" value="{ $fields.papel.options }">
{ $fields.papel.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.papel.name}" value="{ $fields.papel.value }">
{ $fields.papel.options[$fields.papel.value]}
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
<td width='12.5%' scope="col">
{if !$fields.inversion.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVERSION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inversion','enum')" class="div_value" id="inversion_detailblock" target_id="inversion">
{if !$fields.inversion.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.inversion.options)}
<input type="hidden" class="sugar_field" id="{$fields.inversion.name}" value="{ $fields.inversion.options }">
{ $fields.inversion.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.inversion.name}" value="{ $fields.inversion.value }">
{ $fields.inversion.options[$fields.inversion.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.recursos_propios.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RECURSOS_PROPIOS' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('recursos_propios','enum')" class="div_value" id="recursos_propios_detailblock" target_id="recursos_propios">
{if !$fields.recursos_propios.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.recursos_propios.options)}
<input type="hidden" class="sugar_field" id="{$fields.recursos_propios.name}" value="{ $fields.recursos_propios.options }">
{ $fields.recursos_propios.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.recursos_propios.name}" value="{ $fields.recursos_propios.value }">
{ $fields.recursos_propios.options[$fields.recursos_propios.value]}
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
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.motivo_parada.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_PARADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_parada','enum')" class="div_value" id="motivo_parada_detailblock" target_id="motivo_parada">
{if !$fields.motivo_parada.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.motivo_parada.options)}
<input type="hidden" class="sugar_field" id="{$fields.motivo_parada.name}" value="{ $fields.motivo_parada.options }">
{ $fields.motivo_parada.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.motivo_parada.name}" value="{ $fields.motivo_parada.value }">
{ $fields.motivo_parada.options[$fields.motivo_parada.value]}
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
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.motivo_descarte.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_DESCARTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_descarte','enum')" class="div_value" id="motivo_descarte_detailblock" target_id="motivo_descarte">
{if !$fields.motivo_descarte.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.motivo_descarte.options)}
<input type="hidden" class="sugar_field" id="{$fields.motivo_descarte.name}" value="{ $fields.motivo_descarte.options }">
{ $fields.motivo_descarte.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.motivo_descarte.name}" value="{ $fields.motivo_descarte.value }">
{ $fields.motivo_descarte.options[$fields.motivo_descarte.value]}
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
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.motivo_positivo.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_POSITIVO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_positivo','enum')" class="div_value" id="motivo_positivo_detailblock" target_id="motivo_positivo">
{if !$fields.motivo_positivo.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.motivo_positivo.options)}
<input type="hidden" class="sugar_field" id="{$fields.motivo_positivo.name}" value="{ $fields.motivo_positivo.options }">
{ $fields.motivo_positivo.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.motivo_positivo.name}" value="{ $fields.motivo_positivo.value }">
{ $fields.motivo_positivo.options[$fields.motivo_positivo.value]}
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
<td width='12.5%' scope="col">
{if !$fields.observaciones_informe.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_INFORME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Añadir <b>SOLO</b> informacion que aporte valor al franquiciador" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_informe','text')" class="div_value" id="observaciones_informe_detailblock" target_id="observaciones_informe">
{if !$fields.observaciones_informe.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observaciones_informe.name|escape:'html'|url2html|nl2br}">{$fields.observaciones_informe.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.observaciones_descarte.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_DESCARTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_descarte','text')" class="div_value" id="observaciones_descarte_detailblock" target_id="observaciones_descarte">
{if !$fields.observaciones_descarte.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observaciones_descarte.name|escape:'html'|url2html|nl2br}">{$fields.observaciones_descarte.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<td width='12.5%' scope="col">
{if !$fields.tipo_origen.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPO_ORIGEN' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tipo_origen','enum')" class="div_value" id="tipo_origen_detailblock" target_id="tipo_origen">
{if !$fields.tipo_origen.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.tipo_origen.options)}
<input type="hidden" class="sugar_field" id="{$fields.tipo_origen.name}" value="{ $fields.tipo_origen.options }">
{ $fields.tipo_origen.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.tipo_origen.name}" value="{ $fields.tipo_origen.value }">
{ $fields.tipo_origen.options[$fields.tipo_origen.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.suborigen.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBORIGEN' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('suborigen','varchar')" class="div_value" id="suborigen_detailblock" target_id="suborigen">
{if !$fields.suborigen.hidden}
{counter name="panelFieldCount"}
<span id="suborigen" class="sugar_field">{php}
if ($this->_tpl_vars["bean"]->tipo_origen==1){
echo $GLOBALS["app_list_strings"]["subor_expande_list"][$this->_tpl_vars["bean"]->subor_expande];
} else if ($this->_tpl_vars["bean"]->tipo_origen==2){
echo $GLOBALS["app_list_strings"]["portal_list"][$this->_tpl_vars["bean"]->portal];
} else if ($this->_tpl_vars["bean"]->tipo_origen==3){
echo $GLOBALS["app_list_strings"]["eventos_list"][$this->_tpl_vars["bean"]->expan_evento_id_c];
} else if ($this->_tpl_vars["bean"]->tipo_origen==4){
echo $GLOBALS["app_list_strings"]["subor_central_list"][$this->_tpl_vars["bean"]->subor_central];
} else if ($this->_tpl_vars["bean"]->tipo_origen==5){
echo $GLOBALS["app_list_strings"]["subor_medios_list"][$this->_tpl_vars["bean"]->subor_medios];
} else if ($this->_tpl_vars["bean"]->tipo_origen==6){
echo $GLOBALS["app_list_strings"]["subor_mailing_list"][$this->_tpl_vars["bean"]->subor_mailing];
}
{/php}</span>
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
<td width='12.5%' scope="col">
{if !$fields.tiponegocio1.hidden}
{capture name="label" assign="label"}{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg1;                      
{/php}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio1','bool')" class="div_value" id="tiponegocio1_detailblock" target_id="tiponegocio1">
{if !$fields.tiponegocio1.hidden}
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio1.value) == "1" || strval($fields.tiponegocio1.value) == "yes" || strval($fields.tiponegocio1.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.tiponegocio1.name}" id="{$fields.tiponegocio1.name}" value="$fields.tiponegocio1.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.tiponegocio2.hidden}
{capture name="label" assign="label"}{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg2;                      
{/php}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio2','bool')" class="div_value" id="tiponegocio2_detailblock" target_id="tiponegocio2">
{if !$fields.tiponegocio2.hidden}
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio2.value) == "1" || strval($fields.tiponegocio2.value) == "yes" || strval($fields.tiponegocio2.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.tiponegocio2.name}" id="{$fields.tiponegocio2.name}" value="$fields.tiponegocio2.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.tiponegocio3.hidden}
{capture name="label" assign="label"}{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg3;                      
{/php}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio3','bool')" class="div_value" id="tiponegocio3_detailblock" target_id="tiponegocio3">
{if !$fields.tiponegocio3.hidden}
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio3.value) == "1" || strval($fields.tiponegocio3.value) == "yes" || strval($fields.tiponegocio3.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.tiponegocio3.name}" id="{$fields.tiponegocio3.name}" value="$fields.tiponegocio3.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.tiponegocio4.hidden}
{capture name="label" assign="label"}{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg4;                      
{/php}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio4','bool')" class="div_value" id="tiponegocio4_detailblock" target_id="tiponegocio4">
{if !$fields.tiponegocio4.hidden}
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio4.value) == "1" || strval($fields.tiponegocio4.value) == "yes" || strval($fields.tiponegocio4.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.tiponegocio4.name}" id="{$fields.tiponegocio4.name}" value="$fields.tiponegocio4.value" disabled="true" {$checked}>
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
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('assigned_user_name','relate')" class="div_value" id="assigned_user_name_detailblock" target_id="assigned_user_name">
{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount"}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.lnk_cuestionario.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUESTIONARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="No editar el cuestionario aquellos datos que ya se recojen en el CRM" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lnk_cuestionario','text')" class="div_value" id="lnk_cuestionario_detailblock" target_id="lnk_cuestionario">
{if !$fields.lnk_cuestionario.hidden}
{counter name="panelFieldCount"}
<span id="lnk_cuestionario" class="sugar_field">{php}
$link=$this->_tpl_vars["bean"]->lnk_cuestionario;
$id=$this->_tpl_vars["bean"]->id;
echo "<a target=\"_blank\" onclick=\"eliminarAlertaCuestionario('".$id."')\" href=\"".$link."\">".$link."<//a>";                      
{/php}</span>
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
<td width='12.5%' scope="col">
{if !$fields.modified_by_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MODIFICADO_POR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modified_by_name','relate')" class="div_value" id="modified_by_name_detailblock" target_id="modified_by_name">
{if !$fields.modified_by_name.hidden}
{counter name="panelFieldCount"}

<span id="modified_user_id" class="sugar_field" data-id-value="{$fields.modified_user_id.value}">{$fields.modified_by_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.perfil_ideoneo.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PERFIL_IDONEO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_ideoneo','enum')" class="div_value" id="perfil_ideoneo_detailblock" target_id="perfil_ideoneo">
{if !$fields.perfil_ideoneo.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.perfil_ideoneo.options)}
<input type="hidden" class="sugar_field" id="{$fields.perfil_ideoneo.name}" value="{ $fields.perfil_ideoneo.options }">
{ $fields.perfil_ideoneo.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.perfil_ideoneo.name}" value="{ $fields.perfil_ideoneo.value }">
{ $fields.perfil_ideoneo.options[$fields.perfil_ideoneo.value]}
{/if}
{/if}
</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
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