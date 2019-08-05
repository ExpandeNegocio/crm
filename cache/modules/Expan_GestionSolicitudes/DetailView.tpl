

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
<div class="action_buttons">{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}  {if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if}  {if $fields.id.value!=""}<input type="button" name="irApertura" id="irApertura" class style="color:#0000FF;" 
onClick="irAperturas('{$fields.name.value}');" value="Ir Aperturas"/>{/if} {if $fields.id.value!=""}<input type="button" style="color:#FF0000;" name="irsol" id="irfran" class onClick="irFranquicia('{$fields.franquicia.value}');" value="Ir Franquicia"/>{/if} {if $fields.id.value!=""}<input title="Abrir en otra pantalla la solicitud de la que depende la gestion actual" style="color:#00BC9F;" type="button" name="irsol" id="irsol" class onClick="irSolicitud('{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}');" value="Editar Candidato"/>{/if} {if $fields.id.value!=""}<BR> <BR/><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#0000FF;" 
title="Reenvio documentación inicial (C1) (Cuestionario, dosier y multimedia)" onClick="reenvioInfoDetalle('C1','{$fields.id.value}'); " value="Reenviar C1"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio información Adicional (C2) (Plan financiero)" disabled
onClick="reenvioInfoDetalle('C2','{$fields.id.value}'); " value="Reenviar C2"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio borrador precontrato (C3)" disabled
onClick="reenvioInfoDetalle('C3','{$fields.id.value}'); " value="Reenviar C3"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio borrador contrato (C4)" disabled
onClick="reenvioInfoDetalle('C4','{$fields.id.value}'); " value="Reenviar C4"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.1 (Provinvia Ocupada))" disabled
onClick="reenvioInfoDetalle('C1.1','{$fields.id.value}'); " value="Reenviar C1.1"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.2 (No puede abrir en la zona))" disabled
onClick="reenvioInfoDetalle('C1.2','{$fields.id.value}'); " value="Reenviar C1.2"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.3 (Agradecimiento cuestionario))" disabled
onClick="reenvioInfoDetalle('C1.3','{$fields.id.value}'); " value="Reenviar C1.3"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.4 (Reenvío C1 no cuestionario))" disabled
onClick="reenvioInfoDetalle('C1.4','{$fields.id.value}'); " value="Reenviar C1.4"/>{/if} {if $fields.id.value!=""}<input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.5 (No telefono))" disabled
onClick="reenvioInfoDetalle('C1.5','{$fields.id.value}'); " value="Reenviar C1.5"/>{/if} {if $fields.id.value!=""}<BR><BR><input type="button" name="save" id="fichaFranquicia" 
onClick="envioCorreoInterlocutor('{$fields.id.value}','franq');" value="Envio Ficha Franquicia"/>{/if} {if $fields.id.value!=""}<input type="button" name="save" id="fichaConsultor" 
onClick="envioCorreoInterlocutor('{$fields.id.value}','consultor');" value="Envio Ficha Consultor"/><BR <BR/>{/if} {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Expan_GestionSolicitudes", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Expan_GestionSolicitudes_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='DEFAULT' module='Expan_GestionSolicitudes'}</em></a></li>

<li><a id="tab1" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_OBSERVACIONES' module='Expan_GestionSolicitudes'}</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em>{sugar_translate label='LBL_IIT' module='Expan_GestionSolicitudes'}</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em>{sugar_translate label='LBL_PRECONTRATO' module='Expan_GestionSolicitudes'}</em></a></li>

<li><a id="tab4" href="javascript:void(0)"><em>{sugar_translate label='LBL_PLAN_FINANCIERO' module='Expan_GestionSolicitudes'}</em></a></li>

<li><a id="tab5" href="javascript:void(0)"><em>{sugar_translate label='LBL_CONTRATO' module='Expan_GestionSolicitudes'}</em></a></li>
</ul>
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
<div class="yui-content">
<div id='tabcontent0'>
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
{if !$fields.franquicia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia','enum')" class="div_value" id="franquicia_detailblock" target_id="franquicia">
{if !$fields.franquicia.hidden}
{counter name="panelFieldCount"}
<span id="franquicia" class="sugar_field"><a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Franquicia%26action%3DDetailView%26record%3D34e1c623-cbb8-26f8-6d4f-573193efc8ee"><span id="expan_franquicia" class="sugar_field" data-id-value="34e1c623-cbb8-26f8-6d4f-573193efc8ee">Adagio Cantabile</span></a></span>
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
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('prioridad','int')" class="div_value" id="prioridad_detailblock" target_id="prioridad">
{if !$fields.prioridad.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.prioridad.name}">
{sugar_number_format precision=0 var=$fields.prioridad.value}
</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.rating.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RATING' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('rating','enum')" class="div_value" id="rating_detailblock" target_id="rating">
{if !$fields.rating.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.rating.options)}
<input type="hidden" class="sugar_field" id="{$fields.rating.name}" value="{ $fields.rating.options }">
{ $fields.rating.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.rating.name}" value="{ $fields.rating.value }">
{ $fields.rating.options[$fields.rating.value]}
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
{if !$fields.chk_posible_colabora.hidden}
{capture name="label" assign="label"}{sugar_translate label='Posible Colaboracion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Interesado en comprar servicios o productos sin ser franquiciado. Todavía no es positivo." module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{if !$fields.chk_gestionado_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CHK_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_gestionado_central','bool')" class="div_value" id="chk_gestionado_central_detailblock" target_id="chk_gestionado_central">
{if !$fields.chk_gestionado_central.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_gestionado_central.value) == "1" || strval($fields.chk_gestionado_central.value) == "yes" || strval($fields.chk_gestionado_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_gestionado_central.name}" id="{$fields.chk_gestionado_central.name}" value="$fields.chk_gestionado_central.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_gestionado_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_F_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_gestionado_central','date')" class="div_value" id="f_gestionado_central_detailblock" target_id="f_gestionado_central">
{if !$fields.f_gestionado_central.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_gestionado_central.value) <= 0}
{assign var="value" value=$fields.f_gestionado_central.default_value }
{else}
{assign var="value" value=$fields.f_gestionado_central.value }
{/if}
<span class="sugar_field" id="{$fields.f_gestionado_central.name}">{$value}</span>
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
{if !$fields.chk_entrevista_previa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Presencial, virtual o entrevista preconcertada en feria" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa','bool')" class="div_value" id="chk_entrevista_previa_detailblock" target_id="chk_entrevista_previa">
{if !$fields.chk_entrevista_previa.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa.value) == "1" || strval($fields.chk_entrevista_previa.value) == "yes" || strval($fields.chk_entrevista_previa.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista_previa.name}" id="{$fields.chk_entrevista_previa.name}" value="$fields.chk_entrevista_previa.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.usuario_entrevista_previa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_USUARIO_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa','varchar')" class="div_value" id="usuario_entrevista_previa_detailblock" target_id="usuario_entrevista_previa">
{if !$fields.usuario_entrevista_previa.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.usuario_entrevista_previa.value) <= 0}
{assign var="value" value=$fields.usuario_entrevista_previa.default_value }
{else}
{assign var="value" value=$fields.usuario_entrevista_previa.value }
{/if} 
<span class="sugar_field" id="{$fields.usuario_entrevista_previa.name}">{$fields.usuario_entrevista_previa.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='Envio documentacion comercial (C1)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Cuestionario, dosier y multimedia" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{capture name="label" assign="label"}{sugar_translate label='fecha de envío documentación comercial' module='Expan_GestionSolicitudes'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_RESPONDE_C1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se activa si el usuario responde al C1. Es de activación automática no es necesario que el usuario la active" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{capture name="label" assign="label"}{sugar_translate label='Solicitud ampliacion información (Pte resolver)' module='Expan_GestionSolicitudes'}{/capture}
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
{if !$fields.chk_autoriza_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='Candidato autorizado por central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_autoriza_central','bool')" class="div_value" id="chk_autoriza_central_detailblock" target_id="chk_autoriza_central">
{if !$fields.chk_autoriza_central.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_autoriza_central.value) == "1" || strval($fields.chk_autoriza_central.value) == "yes" || strval($fields.chk_autoriza_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_autoriza_central.name}" id="{$fields.chk_autoriza_central.name}" value="$fields.chk_autoriza_central.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_autoriza_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha autorizacion por central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_autoriza_central','date')" class="div_value" id="f_autoriza_central_detailblock" target_id="f_autoriza_central">
{if !$fields.f_autoriza_central.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_autoriza_central.value) <= 0}
{assign var="value" value=$fields.f_autoriza_central.default_value }
{else}
{assign var="value" value=$fields.f_autoriza_central.value }
{/if}
<span class="sugar_field" id="{$fields.f_autoriza_central.name}">{$value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='Resolucion de primeras dudas (Resueltas)' module='Expan_GestionSolicitudes'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_RECEPCION_CUESTIONARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se activa cuando el solicitante rellena el cuestionario. Es de activación automática, no es necesario que el usuario la active" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{capture name="popupText" assign="popupText"}{sugar_translate label="Plan financiero" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{capture name="popupText" assign="popupText"}{sugar_translate label="Presencial, virtual o entrevista preconcertada en feria" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{capture name="label" assign="label"}{sugar_translate label='Fecha envio borrador Precontrato' module='Expan_GestionSolicitudes'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
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
{if !$fields.chk_operacion_autorizada.hidden}
{capture name="label" assign="label"}{sugar_translate label='Operación autorizada' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_operacion_autorizada','bool')" class="div_value" id="chk_operacion_autorizada_detailblock" target_id="chk_operacion_autorizada">
{if !$fields.chk_operacion_autorizada.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_operacion_autorizada.value) == "1" || strval($fields.chk_operacion_autorizada.value) == "yes" || strval($fields.chk_operacion_autorizada.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_operacion_autorizada.name}" id="{$fields.chk_operacion_autorizada.name}" value="$fields.chk_operacion_autorizada.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_operacion_autorizada.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha autorización de la operación' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_operacion_autorizada','date')" class="div_value" id="f_operacion_autorizada_detailblock" target_id="f_operacion_autorizada">
{if !$fields.f_operacion_autorizada.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_operacion_autorizada.value) <= 0}
{assign var="value" value=$fields.f_operacion_autorizada.default_value }
{else}
{assign var="value" value=$fields.f_operacion_autorizada.value }
{/if}
<span class="sugar_field" id="{$fields.f_operacion_autorizada.name}">{$value}</span>
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
{if !$fields.chk_envio_precontrato_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_precontrato_personal','bool')" class="div_value" id="chk_envio_precontrato_personal_detailblock" target_id="chk_envio_precontrato_personal">
{if !$fields.chk_envio_precontrato_personal.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_precontrato_personal.value) == "1" || strval($fields.chk_envio_precontrato_personal.value) == "yes" || strval($fields.chk_envio_precontrato_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_precontrato_personal.name}" id="{$fields.chk_envio_precontrato_personal.name}" value="$fields.chk_envio_precontrato_personal.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_envio_precontrato_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_precontrato_personal','date')" class="div_value" id="f_envio_precontrato_personal_detailblock" target_id="f_envio_precontrato_personal">
{if !$fields.f_envio_precontrato_personal.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_envio_precontrato_personal.value) <= 0}
{assign var="value" value=$fields.f_envio_precontrato_personal.default_value }
{else}
{assign var="value" value=$fields.f_envio_precontrato_personal.value }
{/if}
<span class="sugar_field" id="{$fields.f_envio_precontrato_personal.name}">{$value}</span>
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
{if !$fields.chk_precontrato_firmado.hidden}
{capture name="label" assign="label"}{sugar_translate label='Precontrato Firmado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_precontrato_firmado','bool')" class="div_value" id="chk_precontrato_firmado_detailblock" target_id="chk_precontrato_firmado">
{if !$fields.chk_precontrato_firmado.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_precontrato_firmado.value) == "1" || strval($fields.chk_precontrato_firmado.value) == "yes" || strval($fields.chk_precontrato_firmado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_precontrato_firmado.name}" id="{$fields.chk_precontrato_firmado.name}" value="$fields.chk_precontrato_firmado.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_precontrato_firmado.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha firma precontrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_precontrato_firmado','date')" class="div_value" id="f_precontrato_firmado_detailblock" target_id="f_precontrato_firmado">
{if !$fields.f_precontrato_firmado.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_precontrato_firmado.value) <= 0}
{assign var="value" value=$fields.f_precontrato_firmado.default_value }
{else}
{assign var="value" value=$fields.f_precontrato_firmado.value }
{/if}
<span class="sugar_field" id="{$fields.f_precontrato_firmado.name}">{$value}</span>
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
{if !$fields.chk_aprobacion_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='Aprobacion del local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_aprobacion_local','bool')" class="div_value" id="chk_aprobacion_local_detailblock" target_id="chk_aprobacion_local">
{if !$fields.chk_aprobacion_local.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_aprobacion_local.value) == "1" || strval($fields.chk_aprobacion_local.value) == "yes" || strval($fields.chk_aprobacion_local.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_aprobacion_local.name}" id="{$fields.chk_aprobacion_local.name}" value="$fields.chk_aprobacion_local.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_aprobacion_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha de aprobacion del local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_aprobacion_local','date')" class="div_value" id="f_aprobacion_local_detailblock" target_id="f_aprobacion_local">
{if !$fields.f_aprobacion_local.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_aprobacion_local.value) <= 0}
{assign var="value" value=$fields.f_aprobacion_local.default_value }
{else}
{assign var="value" value=$fields.f_aprobacion_local.value }
{/if}
<span class="sugar_field" id="{$fields.f_aprobacion_local.name}">{$value}</span>
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
{if !$fields.chk_envio_plan_financiero_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_plan_financiero_personal','bool')" class="div_value" id="chk_envio_plan_financiero_personal_detailblock" target_id="chk_envio_plan_financiero_personal">
{if !$fields.chk_envio_plan_financiero_personal.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_plan_financiero_personal.value) == "1" || strval($fields.chk_envio_plan_financiero_personal.value) == "yes" || strval($fields.chk_envio_plan_financiero_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_plan_financiero_personal.name}" id="{$fields.chk_envio_plan_financiero_personal.name}" value="$fields.chk_envio_plan_financiero_personal.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_envio_plan_financiero_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_plan_financiero_personal','date')" class="div_value" id="f_envio_plan_financiero_personal_detailblock" target_id="f_envio_plan_financiero_personal">
{if !$fields.f_envio_plan_financiero_personal.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_envio_plan_financiero_personal.value) <= 0}
{assign var="value" value=$fields.f_envio_plan_financiero_personal.default_value }
{else}
{assign var="value" value=$fields.f_envio_plan_financiero_personal.value }
{/if}
<span class="sugar_field" id="{$fields.f_envio_plan_financiero_personal.name}">{$value}</span>
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
{if !$fields.chk_envio_contrato_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_contrato_personal','bool')" class="div_value" id="chk_envio_contrato_personal_detailblock" target_id="chk_envio_contrato_personal">
{if !$fields.chk_envio_contrato_personal.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_contrato_personal.value) == "1" || strval($fields.chk_envio_contrato_personal.value) == "yes" || strval($fields.chk_envio_contrato_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_envio_contrato_personal.name}" id="{$fields.chk_envio_contrato_personal.name}" value="$fields.chk_envio_contrato_personal.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_envio_contrato_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_contrato_personal','date')" class="div_value" id="f_envio_contrato_personal_detailblock" target_id="f_envio_contrato_personal">
{if !$fields.f_envio_contrato_personal.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_envio_contrato_personal.value) <= 0}
{assign var="value" value=$fields.f_envio_contrato_personal.default_value }
{else}
{assign var="value" value=$fields.f_envio_contrato_personal.value }
{/if}
<span class="sugar_field" id="{$fields.f_envio_contrato_personal.name}">{$value}</span>
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
{if !$fields.chk_contrato_firmado.hidden}
{capture name="label" assign="label"}{sugar_translate label='Contrato Firmado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_contrato_firmado','bool')" class="div_value" id="chk_contrato_firmado_detailblock" target_id="chk_contrato_firmado">
{if !$fields.chk_contrato_firmado.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_contrato_firmado.value) == "1" || strval($fields.chk_contrato_firmado.value) == "yes" || strval($fields.chk_contrato_firmado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_contrato_firmado.name}" id="{$fields.chk_contrato_firmado.name}" value="$fields.chk_contrato_firmado.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_contrato_firmado.hidden}
{capture name="label" assign="label"}{sugar_translate label='Fecha firma contrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_contrato_firmado','date')" class="div_value" id="f_contrato_firmado_detailblock" target_id="f_contrato_firmado">
{if !$fields.f_contrato_firmado.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_contrato_firmado.value) <= 0}
{assign var="value" value=$fields.f_contrato_firmado.default_value }
{else}
{assign var="value" value=$fields.f_contrato_firmado.value }
{/if}
<span class="sugar_field" id="{$fields.f_contrato_firmado.name}">{$value}</span>
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
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuando_empezar','date')" class="div_value" id="cuando_empezar_detailblock" target_id="cuando_empezar">
{if !$fields.cuando_empezar.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.cuando_empezar.value) <= 0}
{assign var="value" value=$fields.cuando_empezar.default_value }
{else}
{assign var="value" value=$fields.cuando_empezar.value }
{/if}
<span class="sugar_field" id="{$fields.cuando_empezar.name}">{$value}</span>
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
{if !$fields.f_reactivacion_parado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_F_REACTIVACION_PARADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Fecha en el que se pasará la gestión de parado a en curso" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_reactivacion_parado','date')" class="div_value" id="f_reactivacion_parado_detailblock" target_id="f_reactivacion_parado">
{if !$fields.f_reactivacion_parado.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_reactivacion_parado.value) <= 0}
{assign var="value" value=$fields.f_reactivacion_parado.default_value }
{else}
{assign var="value" value=$fields.f_reactivacion_parado.value }
{/if}
<span class="sugar_field" id="{$fields.f_reactivacion_parado.name}">{$value}</span>
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
$irClick = "";
if (strlen($link)!=0){
$irClick="Abrir Cuestionario";
}                      
echo "<a target=\"_blank\" onclick=\"eliminarAlertaCuestionario('".$id."')\" href=\"".$link."\">".$irClick."</a>";                      
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
{if !$fields.otras_preguntas_formulario.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OTRAS_PREGUNTAS_FORMULARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion recogida del cuestionario que da respuestas específicas sobre la enseña (no hay campos específicos en el CRM)" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otras_preguntas_formulario','text')" class="div_value" id="otras_preguntas_formulario_detailblock" target_id="otras_preguntas_formulario">
{if !$fields.otras_preguntas_formulario.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.otras_preguntas_formulario.name|escape:'html'|url2html|nl2br}">{$fields.otras_preguntas_formulario.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
</div>    <div id='tabcontent1'>
<div id='detailpanel_2' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_OBSERVACIONES' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.preguntas_mn_t.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PREGUNTAS_MN_T' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Preguntas realizadas por el solicitante sobre el modelo de negocio o técnicas de la actividad en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('preguntas_mn_t','text')" class="div_value" id="preguntas_mn_t_detailblock" target_id="preguntas_mn_t">
{if !$fields.preguntas_mn_t.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.preguntas_mn_t.name|escape:'html'|url2html|nl2br}">{$fields.preguntas_mn_t.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.preg_en_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PREG_EN_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('preg_en_central','text')" class="div_value" id="preg_en_central_detailblock" target_id="preg_en_central">
{if !$fields.preg_en_central.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.preg_en_central.name|escape:'html'|url2html|nl2br}">{$fields.preg_en_central.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{if !$fields.objeciones_mn.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBJECIONES_MN' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Objeciones sobre el modelo de negocio por el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('objeciones_mn','text')" class="div_value" id="objeciones_mn_detailblock" target_id="objeciones_mn">
{if !$fields.objeciones_mn.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.objeciones_mn.name|escape:'html'|url2html|nl2br}">{$fields.objeciones_mn.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.solicitudes_candidato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SOLICITUDES_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solicitudes realizadas por el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('solicitudes_candidato','text')" class="div_value" id="solicitudes_candidato_detailblock" target_id="solicitudes_candidato">
{if !$fields.solicitudes_candidato.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.solicitudes_candidato.name|escape:'html'|url2html|nl2br}">{$fields.solicitudes_candidato.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{if !$fields.informacion_proveedores.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_PROVEEDORES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion de proveedores que nos proporciona el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('informacion_proveedores','text')" class="div_value" id="informacion_proveedores_detailblock" target_id="informacion_proveedores">
{if !$fields.informacion_proveedores.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.informacion_proveedores.name|escape:'html'|url2html|nl2br}">{$fields.informacion_proveedores.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.informacion_competencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_COMPETENCIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion de la compatencia que nos proporciona el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('informacion_competencia','text')" class="div_value" id="informacion_competencia_detailblock" target_id="informacion_competencia">
{if !$fields.informacion_competencia.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.informacion_competencia.name|escape:'html'|url2html|nl2br}">{$fields.informacion_competencia.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{if !$fields.notas_argumentario.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NOTAS_ARGUMENTARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Información recogida del franquiciador" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('notas_argumentario','text')" class="div_value" id="notas_argumentario_detailblock" target_id="notas_argumentario">
{if !$fields.notas_argumentario.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.notas_argumentario.name|escape:'html'|url2html|nl2br}">{$fields.notas_argumentario.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.concesiones.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CONCESIONES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('concesiones','text')" class="div_value" id="concesiones_detailblock" target_id="concesiones">
{if !$fields.concesiones.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.concesiones.name|escape:'html'|url2html|nl2br}">{$fields.concesiones.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.mejoras.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MEJORAS' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Mejoras a implementar detectadas en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('mejoras','text')" class="div_value" id="mejoras_detailblock" target_id="mejoras">
{if !$fields.mejoras.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.mejoras.name|escape:'html'|url2html|nl2br}">{$fields.mejoras.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<script>document.getElementById("LBL_EDITVIEW_OBSERVACIONES").style.display='none';</script>
{/if}
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_IIT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_validado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_VALIDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_validado','bool')" class="div_value" id="iit_validado_detailblock" target_id="iit_validado">
{if !$fields.iit_validado.hidden}
{counter name="panelFieldCount"}

{if strval($fields.iit_validado.value) == "1" || strval($fields.iit_validado.value) == "yes" || strval($fields.iit_validado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.iit_validado.name}" id="{$fields.iit_validado.name}" value="$fields.iit_validado.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{capture name="label" assign="label"}{sugar_translate label='LBL_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONSULTOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.iit_zona_implantacion.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ZONA_IMPLANTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_zona_implantacion','varchar')" class="div_value" id="iit_zona_implantacion_detailblock" target_id="iit_zona_implantacion">
{if !$fields.iit_zona_implantacion.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_zona_implantacion.value) <= 0}
{assign var="value" value=$fields.iit_zona_implantacion.default_value }
{else}
{assign var="value" value=$fields.iit_zona_implantacion.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_zona_implantacion.name}">{$fields.iit_zona_implantacion.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_acuerdo_exclusividad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ACUERDO_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_acuerdo_exclusividad','varchar')" class="div_value" id="iit_acuerdo_exclusividad_detailblock" target_id="iit_acuerdo_exclusividad">
{if !$fields.iit_acuerdo_exclusividad.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_acuerdo_exclusividad.value) <= 0}
{assign var="value" value=$fields.iit_acuerdo_exclusividad.default_value }
{else}
{assign var="value" value=$fields.iit_acuerdo_exclusividad.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_acuerdo_exclusividad.name}">{$fields.iit_acuerdo_exclusividad.value}</span>
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
{if !$fields.iit_aporta_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_APORTA_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_aporta_local','varchar')" class="div_value" id="iit_aporta_local_detailblock" target_id="iit_aporta_local">
{if !$fields.iit_aporta_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_aporta_local.value) <= 0}
{assign var="value" value=$fields.iit_aporta_local.default_value }
{else}
{assign var="value" value=$fields.iit_aporta_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_aporta_local.name}">{$fields.iit_aporta_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_acuerdo_economico.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ACUERDO_ECONOMICO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_acuerdo_economico','varchar')" class="div_value" id="iit_acuerdo_economico_detailblock" target_id="iit_acuerdo_economico">
{if !$fields.iit_acuerdo_economico.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_acuerdo_economico.value) <= 0}
{assign var="value" value=$fields.iit_acuerdo_economico.default_value }
{else}
{assign var="value" value=$fields.iit_acuerdo_economico.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_acuerdo_economico.name}">{$fields.iit_acuerdo_economico.value}</span>
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
{if !$fields.iit_direccion_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_DIRECCION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_direccion_local','varchar')" class="div_value" id="iit_direccion_local_detailblock" target_id="iit_direccion_local">
{if !$fields.iit_direccion_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_direccion_local.value) <= 0}
{assign var="value" value=$fields.iit_direccion_local.default_value }
{else}
{assign var="value" value=$fields.iit_direccion_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_direccion_local.name}">{$fields.iit_direccion_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CRM' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.iit_localidad_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_LOCALIDAD_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_localidad_local','varchar')" class="div_value" id="iit_localidad_local_detailblock" target_id="iit_localidad_local">
{if !$fields.iit_localidad_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_localidad_local.value) <= 0}
{assign var="value" value=$fields.iit_localidad_local.default_value }
{else}
{assign var="value" value=$fields.iit_localidad_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_localidad_local.name}">{$fields.iit_localidad_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_inversion_inicial_est.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_INVER_INICIAL_EST' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_inversion_inicial_est','varchar')" class="div_value" id="iit_inversion_inicial_est_detailblock" target_id="iit_inversion_inicial_est">
{if !$fields.iit_inversion_inicial_est.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_inversion_inicial_est.value) <= 0}
{assign var="value" value=$fields.iit_inversion_inicial_est.default_value }
{else}
{assign var="value" value=$fields.iit_inversion_inicial_est.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_inversion_inicial_est.name}">{$fields.iit_inversion_inicial_est.value}</span>
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
{if !$fields.iit_superficie_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_local','varchar')" class="div_value" id="iit_superficie_local_detailblock" target_id="iit_superficie_local">
{if !$fields.iit_superficie_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_superficie_local.name}">{$fields.iit_superficie_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_canon_entrada.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_canon_entrada','varchar')" class="div_value" id="iit_canon_entrada_detailblock" target_id="iit_canon_entrada">
{if !$fields.iit_canon_entrada.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_canon_entrada.value) <= 0}
{assign var="value" value=$fields.iit_canon_entrada.default_value }
{else}
{assign var="value" value=$fields.iit_canon_entrada.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_canon_entrada.name}">{$fields.iit_canon_entrada.value}</span>
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
{if !$fields.iit_superficie_escapa_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_ESCAPA_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_escapa_local','varchar')" class="div_value" id="iit_superficie_escapa_local_detailblock" target_id="iit_superficie_escapa_local">
{if !$fields.iit_superficie_escapa_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_escapa_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_escapa_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_escapa_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_superficie_escapa_local.name}">{$fields.iit_superficie_escapa_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_royalty_explota.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_royalty_explota','varchar')" class="div_value" id="iit_royalty_explota_detailblock" target_id="iit_royalty_explota">
{if !$fields.iit_royalty_explota.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_royalty_explota.value) <= 0}
{assign var="value" value=$fields.iit_royalty_explota.default_value }
{else}
{assign var="value" value=$fields.iit_royalty_explota.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_royalty_explota.name}">{$fields.iit_royalty_explota.value}</span>
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
{if !$fields.iit_superficie_almacen_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_ALMACEN_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_almacen_local','varchar')" class="div_value" id="iit_superficie_almacen_local_detailblock" target_id="iit_superficie_almacen_local">
{if !$fields.iit_superficie_almacen_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_almacen_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_almacen_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_almacen_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_superficie_almacen_local.name}">{$fields.iit_superficie_almacen_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_royalty_mkt.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ROYALTY_MKT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_royalty_mkt','varchar')" class="div_value" id="iit_royalty_mkt_detailblock" target_id="iit_royalty_mkt">
{if !$fields.iit_royalty_mkt.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_royalty_mkt.value) <= 0}
{assign var="value" value=$fields.iit_royalty_mkt.default_value }
{else}
{assign var="value" value=$fields.iit_royalty_mkt.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_royalty_mkt.name}">{$fields.iit_royalty_mkt.value}</span>
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
{if !$fields.iit_instalaciones_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_INSTALACIONES_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_instalaciones_local','varchar')" class="div_value" id="iit_instalaciones_local_detailblock" target_id="iit_instalaciones_local">
{if !$fields.iit_instalaciones_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_instalaciones_local.value) <= 0}
{assign var="value" value=$fields.iit_instalaciones_local.default_value }
{else}
{assign var="value" value=$fields.iit_instalaciones_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_instalaciones_local.name}">{$fields.iit_instalaciones_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_duracion_contrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_DURACION_CONTRAT0' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_duracion_contrato','varchar')" class="div_value" id="iit_duracion_contrato_detailblock" target_id="iit_duracion_contrato">
{if !$fields.iit_duracion_contrato.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_duracion_contrato.value) <= 0}
{assign var="value" value=$fields.iit_duracion_contrato.default_value }
{else}
{assign var="value" value=$fields.iit_duracion_contrato.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_duracion_contrato.name}">{$fields.iit_duracion_contrato.value}</span>
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
{if !$fields.iit_visitado_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_VISITADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_visitado_local','varchar')" class="div_value" id="iit_visitado_local_detailblock" target_id="iit_visitado_local">
{if !$fields.iit_visitado_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_visitado_local.value) <= 0}
{assign var="value" value=$fields.iit_visitado_local.default_value }
{else}
{assign var="value" value=$fields.iit_visitado_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_visitado_local.name}">{$fields.iit_visitado_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_year_renovado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_YEAR_RENOVADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_year_renovado','varchar')" class="div_value" id="iit_year_renovado_detailblock" target_id="iit_year_renovado">
{if !$fields.iit_year_renovado.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_year_renovado.value) <= 0}
{assign var="value" value=$fields.iit_year_renovado.default_value }
{else}
{assign var="value" value=$fields.iit_year_renovado.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_year_renovado.name}">{$fields.iit_year_renovado.value}</span>
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
{if !$fields.iit_aprobado_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_APROBADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_aprobado_local','varchar')" class="div_value" id="iit_aprobado_local_detailblock" target_id="iit_aprobado_local">
{if !$fields.iit_aprobado_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_aprobado_local.value) <= 0}
{assign var="value" value=$fields.iit_aprobado_local.default_value }
{else}
{assign var="value" value=$fields.iit_aprobado_local.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_aprobado_local.name}">{$fields.iit_aprobado_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.iit_max_estableci_zona.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_MAX_ESTABLECI_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_max_estableci_zona','varchar')" class="div_value" id="iit_max_estableci_zona_detailblock" target_id="iit_max_estableci_zona">
{if !$fields.iit_max_estableci_zona.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_max_estableci_zona.value) <= 0}
{assign var="value" value=$fields.iit_max_estableci_zona.default_value }
{else}
{assign var="value" value=$fields.iit_max_estableci_zona.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_max_estableci_zona.name}">{$fields.iit_max_estableci_zona.value}</span>
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
{if !$fields.iit_mod_neg_recomendado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_MOD_NEG_RECOMENDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_mod_neg_recomendado','varchar')" class="div_value" id="iit_mod_neg_recomendado_detailblock" target_id="iit_mod_neg_recomendado">
{if !$fields.iit_mod_neg_recomendado.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_mod_neg_recomendado.value) <= 0}
{assign var="value" value=$fields.iit_mod_neg_recomendado.default_value }
{else}
{assign var="value" value=$fields.iit_mod_neg_recomendado.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_mod_neg_recomendado.name}">{$fields.iit_mod_neg_recomendado.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.iit_localidad_recomendado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_RECOMENDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_localidad_recomendado','varchar')" class="div_value" id="iit_localidad_recomendado_detailblock" target_id="iit_localidad_recomendado">
{if !$fields.iit_localidad_recomendado.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.iit_localidad_recomendado.value) <= 0}
{assign var="value" value=$fields.iit_localidad_recomendado.default_value }
{else}
{assign var="value" value=$fields.iit_localidad_recomendado.value }
{/if} 
<span class="sugar_field" id="{$fields.iit_localidad_recomendado.name}">{$fields.iit_localidad_recomendado.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
<script>document.getElementById("LBL_IIT").style.display='none';</script>
{/if}
</div>    <div id='tabcontent3'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_PRECONTRATO' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.estado_precontrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ESTADO_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_precontrato','enum')" class="div_value" id="estado_precontrato_detailblock" target_id="estado_precontrato">
{if !$fields.estado_precontrato.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.estado_precontrato.options)}
<input type="hidden" class="sugar_field" id="{$fields.estado_precontrato.name}" value="{ $fields.estado_precontrato.options }">
{ $fields.estado_precontrato.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.estado_precontrato.name}" value="{ $fields.estado_precontrato.value }">
{ $fields.estado_precontrato.options[$fields.estado_precontrato.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pre_fir1_first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_first_name','varchar')" class="div_value" id="pre_fir1_first_name_detailblock" target_id="pre_fir1_first_name">
{if !$fields.pre_fir1_first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_first_name.value) <= 0}
{assign var="value" value=$fields.pre_fir1_first_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir1_first_name.name}">{$fields.pre_fir1_first_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pre_fir2_first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_first_name','varchar')" class="div_value" id="pre_fir2_first_name_detailblock" target_id="pre_fir2_first_name">
{if !$fields.pre_fir2_first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_first_name.value) <= 0}
{assign var="value" value=$fields.pre_fir2_first_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir2_first_name.name}">{$fields.pre_fir2_first_name.value}</span>
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
{if !$fields.pre_fir1_last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_last_name','varchar')" class="div_value" id="pre_fir1_last_name_detailblock" target_id="pre_fir1_last_name">
{if !$fields.pre_fir1_last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_last_name.value) <= 0}
{assign var="value" value=$fields.pre_fir1_last_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir1_last_name.name}">{$fields.pre_fir1_last_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pre_fir2_last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_last_name','varchar')" class="div_value" id="pre_fir2_last_name_detailblock" target_id="pre_fir2_last_name">
{if !$fields.pre_fir2_last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.pre_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir2_last_name.name}">{$fields.pre_fir2_last_name.value}</span>
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
{if !$fields.pre_fir1_NIF.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_NIF','varchar')" class="div_value" id="pre_fir1_NIF_detailblock" target_id="pre_fir1_NIF">
{if !$fields.pre_fir1_NIF.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_NIF.value) <= 0}
{assign var="value" value=$fields.pre_fir1_NIF.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_NIF.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir1_NIF.name}">{$fields.pre_fir1_NIF.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pre_fir2_NIF.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_NIF','varchar')" class="div_value" id="pre_fir2_NIF_detailblock" target_id="pre_fir2_NIF">
{if !$fields.pre_fir2_NIF.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_NIF.value) <= 0}
{assign var="value" value=$fields.pre_fir2_NIF.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_NIF.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir2_NIF.name}">{$fields.pre_fir2_NIF.value}</span>
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
{if !$fields.pre_fir1_vecino.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_vecino','varchar')" class="div_value" id="pre_fir1_vecino_detailblock" target_id="pre_fir1_vecino">
{if !$fields.pre_fir1_vecino.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_vecino.value) <= 0}
{assign var="value" value=$fields.pre_fir1_vecino.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_vecino.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir1_vecino.name}">{$fields.pre_fir1_vecino.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pre_fir2_vecino.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_vecino','varchar')" class="div_value" id="pre_fir2_vecino_detailblock" target_id="pre_fir2_vecino">
{if !$fields.pre_fir2_vecino.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_vecino.value) <= 0}
{assign var="value" value=$fields.pre_fir2_vecino.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_vecino.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir2_vecino.name}">{$fields.pre_fir2_vecino.value}</span>
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
{if !$fields.pre_fir1_domicilio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_domicilio','varchar')" class="div_value" id="pre_fir1_domicilio_detailblock" target_id="pre_fir1_domicilio">
{if !$fields.pre_fir1_domicilio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_domicilio.value) <= 0}
{assign var="value" value=$fields.pre_fir1_domicilio.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_domicilio.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir1_domicilio.name}">{$fields.pre_fir1_domicilio.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pre_fir2_domicilio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_domicilio','varchar')" class="div_value" id="pre_fir2_domicilio_detailblock" target_id="pre_fir2_domicilio">
{if !$fields.pre_fir2_domicilio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_domicilio.value) <= 0}
{assign var="value" value=$fields.pre_fir2_domicilio.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_domicilio.value }
{/if} 
<span class="sugar_field" id="{$fields.pre_fir2_domicilio.name}">{$fields.pre_fir2_domicilio.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_UBICACION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pre_num_unidades.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRE_NUM_UNIDADES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('num_empleados','int')" class="div_value" id="num_empleados_detailblock" target_id="num_empleados">
{if !$fields.pre_num_unidades.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.num_empleados.name}">
{sugar_number_format precision=0 var=$fields.num_empleados.value}
</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.fecha_precontrato_minima.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_PRECONTRATO_MINIMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fecha_precontrato_minima','varchar')" class="div_value" id="fecha_precontrato_minima_detailblock" target_id="fecha_precontrato_minima">
{if !$fields.fecha_precontrato_minima.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.fecha_precontrato_minima.value) <= 0}
{assign var="value" value=$fields.fecha_precontrato_minima.default_value }
{else}
{assign var="value" value=$fields.fecha_precontrato_minima.value }
{/if} 
<span class="sugar_field" id="{$fields.fecha_precontrato_minima.name}">{$fields.fecha_precontrato_minima.value}</span>
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
{if !$fields.provincia_apertura_pre.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_pre','enum')" class="div_value" id="provincia_apertura_pre_detailblock" target_id="provincia_apertura_pre">
{if !$fields.provincia_apertura_pre.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_apertura_pre.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_pre.name}" value="{ $fields.provincia_apertura_pre.options }">
{ $fields.provincia_apertura_pre.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_pre.name}" value="{ $fields.provincia_apertura_pre.value }">
{ $fields.provincia_apertura_pre.options[$fields.provincia_apertura_pre.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_precontrato_firma.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_PRECONTRATO_FIRMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_precontrato_firma','date')" class="div_value" id="f_precontrato_firma_detailblock" target_id="f_precontrato_firma">
{if !$fields.f_precontrato_firma.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_precontrato_firma.value) <= 0}
{assign var="value" value=$fields.f_precontrato_firma.default_value }
{else}
{assign var="value" value=$fields.f_precontrato_firma.value }
{/if}
<span class="sugar_field" id="{$fields.f_precontrato_firma.name}">{$value}</span>
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
{if !$fields.localidad_apertura_pre.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_pre','varchar')" class="div_value" id="localidad_apertura_pre_detailblock" target_id="localidad_apertura_pre">
{if !$fields.localidad_apertura_pre.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.localidad_apertura_pre.value) <= 0}
{assign var="value" value=$fields.localidad_apertura_pre.default_value }
{else}
{assign var="value" value=$fields.localidad_apertura_pre.value }
{/if} 
<span class="sugar_field" id="{$fields.localidad_apertura_pre.name}">{$fields.localidad_apertura_pre.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.periodo_validez.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PERIODO_VALIDEZ' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('periodo_validez','varchar')" class="div_value" id="periodo_validez_detailblock" target_id="periodo_validez">
{if !$fields.periodo_validez.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.periodo_validez.value) <= 0}
{assign var="value" value=$fields.periodo_validez.default_value }
{else}
{assign var="value" value=$fields.periodo_validez.value }
{/if} 
<span class="sugar_field" id="{$fields.periodo_validez.name}">{$fields.periodo_validez.value}</span>
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
{if !$fields.direccion_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local','varchar')" class="div_value" id="direccion_local_detailblock" target_id="direccion_local">
{if !$fields.direccion_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.direccion_local.value) <= 0}
{assign var="value" value=$fields.direccion_local.default_value }
{else}
{assign var="value" value=$fields.direccion_local.value }
{/if} 
<span class="sugar_field" id="{$fields.direccion_local.name}">{$fields.direccion_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.modelo_negocio_precontrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MDN_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modelo_negocio_precontrato','varchar')" class="div_value" id="modelo_negocio_precontrato_detailblock" target_id="modelo_negocio_precontrato">
{if !$fields.modelo_negocio_precontrato.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.modelo_negocio_precontrato.value) <= 0}
{assign var="value" value=$fields.modelo_negocio_precontrato.default_value }
{else}
{assign var="value" value=$fields.modelo_negocio_precontrato.value }
{/if} 
<span class="sugar_field" id="{$fields.modelo_negocio_precontrato.name}">{$fields.modelo_negocio_precontrato.value}</span>
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
{if !$fields.zona_exclusividad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_exclusividad','text')" class="div_value" id="zona_exclusividad_detailblock" target_id="zona_exclusividad">
{if !$fields.zona_exclusividad.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.zona_exclusividad.name|escape:'html'|url2html|nl2br}">{$fields.zona_exclusividad.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.entrega_cuenta.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREGA_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entrega_cuenta','varchar')" class="div_value" id="entrega_cuenta_detailblock" target_id="entrega_cuenta">
{if !$fields.entrega_cuenta.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.entrega_cuenta.value) <= 0}
{assign var="value" value=$fields.entrega_cuenta.default_value }
{else}
{assign var="value" value=$fields.entrega_cuenta.value }
{/if} 
<span class="sugar_field" id="{$fields.entrega_cuenta.name}">{$fields.entrega_cuenta.value}</span>
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
{if !$fields.zona_reserva.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_RESERVA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_reserva','text')" class="div_value" id="zona_reserva_detailblock" target_id="zona_reserva">
{if !$fields.zona_reserva.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.zona_reserva.name|escape:'html'|url2html|nl2br}">{$fields.zona_reserva.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.canon_entrada.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('canon_entrada','varchar')" class="div_value" id="canon_entrada_detailblock" target_id="canon_entrada">
{if !$fields.canon_entrada.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.canon_entrada.value) <= 0}
{assign var="value" value=$fields.canon_entrada.default_value }
{else}
{assign var="value" value=$fields.canon_entrada.value }
{/if} 
<span class="sugar_field" id="{$fields.canon_entrada.name}">{$fields.canon_entrada.value}</span>
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
{if !$fields.f_entrega_cuenta_pre.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENTREGA_CUENTA_PRE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solo se rellena a la recepcion del justificante" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrega_cuenta_pre','date')" class="div_value" id="f_entrega_cuenta_pre_detailblock" target_id="f_entrega_cuenta_pre">
{if !$fields.f_entrega_cuenta_pre.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_entrega_cuenta_pre.value) <= 0}
{assign var="value" value=$fields.f_entrega_cuenta_pre.default_value }
{else}
{assign var="value" value=$fields.f_entrega_cuenta_pre.value }
{/if}
<span class="sugar_field" id="{$fields.f_entrega_cuenta_pre.name}">{$value}</span>
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
{if !$fields.observacion_precontrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACION_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Recoger solicitudes, objeciones y concesiones relacionadas con el precontrato. EN definitiva, cualquier observacion para redartar el precontrato" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observacion_precontrato','text')" class="div_value" id="observacion_precontrato_detailblock" target_id="observacion_precontrato">
{if !$fields.observacion_precontrato.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observacion_precontrato.name|escape:'html'|url2html|nl2br}">{$fields.observacion_precontrato.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<script>document.getElementById("LBL_PRECONTRATO").style.display='none';</script>
{/if}
</div>    <div id='tabcontent4'>
<div id='detailpanel_5' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_PLAN_FINANCIERO' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pf_validado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_VALIDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_validado','bool')" class="div_value" id="pf_validado_detailblock" target_id="pf_validado">
{if !$fields.pf_validado.hidden}
{counter name="panelFieldCount"}

{if strval($fields.pf_validado.value) == "1" || strval($fields.pf_validado.value) == "yes" || strval($fields.pf_validado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.pf_validado.name}" id="{$fields.pf_validado.name}" value="$fields.pf_validado.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_PERFIL_FRANQUICIADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pf_superficie_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_superficie_local','varchar')" class="div_value" id="pf_superficie_local_detailblock" target_id="pf_superficie_local">
{if !$fields.pf_superficie_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_superficie_local.value) <= 0}
{assign var="value" value=$fields.pf_superficie_local.default_value }
{else}
{assign var="value" value=$fields.pf_superficie_local.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_superficie_local.name}">{$fields.pf_superficie_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pf_tipo_franquiciado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_TIPO_FRANQUICIADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_tipo_franquiciado','varchar')" class="div_value" id="pf_tipo_franquiciado_detailblock" target_id="pf_tipo_franquiciado">
{if !$fields.pf_tipo_franquiciado.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_tipo_franquiciado.value) <= 0}
{assign var="value" value=$fields.pf_tipo_franquiciado.default_value }
{else}
{assign var="value" value=$fields.pf_tipo_franquiciado.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_tipo_franquiciado.name}">{$fields.pf_tipo_franquiciado.value}</span>
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
{if !$fields.pf_alquiler_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_ALQUILER_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_alquiler_local','varchar')" class="div_value" id="pf_alquiler_local_detailblock" target_id="pf_alquiler_local">
{if !$fields.pf_alquiler_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_alquiler_local.value) <= 0}
{assign var="value" value=$fields.pf_alquiler_local.default_value }
{else}
{assign var="value" value=$fields.pf_alquiler_local.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_alquiler_local.name}">{$fields.pf_alquiler_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pf_trabajo_negocio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_TRABAJO_NEGOCIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_trabajo_negocio','varchar')" class="div_value" id="pf_trabajo_negocio_detailblock" target_id="pf_trabajo_negocio">
{if !$fields.pf_trabajo_negocio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_trabajo_negocio.value) <= 0}
{assign var="value" value=$fields.pf_trabajo_negocio.default_value }
{else}
{assign var="value" value=$fields.pf_trabajo_negocio.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_trabajo_negocio.name}">{$fields.pf_trabajo_negocio.value}</span>
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
{if !$fields.pf_estado_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_ESTADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_estado_local','varchar')" class="div_value" id="pf_estado_local_detailblock" target_id="pf_estado_local">
{if !$fields.pf_estado_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_estado_local.value) <= 0}
{assign var="value" value=$fields.pf_estado_local.default_value }
{else}
{assign var="value" value=$fields.pf_estado_local.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_estado_local.name}">{$fields.pf_estado_local.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pf_forma_juridica.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_FORMA_JURIDICA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_forma_juridica','varchar')" class="div_value" id="pf_forma_juridica_detailblock" target_id="pf_forma_juridica">
{if !$fields.pf_forma_juridica.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_forma_juridica.value) <= 0}
{assign var="value" value=$fields.pf_forma_juridica.default_value }
{else}
{assign var="value" value=$fields.pf_forma_juridica.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_forma_juridica.name}">{$fields.pf_forma_juridica.value}</span>
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
{if !$fields.pf_historico_sociedad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_HISTORICO_SOCIEDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_historico_sociedad','varchar')" class="div_value" id="pf_historico_sociedad_detailblock" target_id="pf_historico_sociedad">
{if !$fields.pf_historico_sociedad.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_historico_sociedad.value) <= 0}
{assign var="value" value=$fields.pf_historico_sociedad.default_value }
{else}
{assign var="value" value=$fields.pf_historico_sociedad.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_historico_sociedad.name}">{$fields.pf_historico_sociedad.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_CONDICIONES_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pf_canon_entrada.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_canon_entrada','varchar')" class="div_value" id="pf_canon_entrada_detailblock" target_id="pf_canon_entrada">
{if !$fields.pf_canon_entrada.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_canon_entrada.value) <= 0}
{assign var="value" value=$fields.pf_canon_entrada.default_value }
{else}
{assign var="value" value=$fields.pf_canon_entrada.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_canon_entrada.name}">{$fields.pf_canon_entrada.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pf_porcentaje_financia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_PORCENTAJE_FINANCIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_porcentaje_financia','varchar')" class="div_value" id="pf_porcentaje_financia_detailblock" target_id="pf_porcentaje_financia">
{if !$fields.pf_porcentaje_financia.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_porcentaje_financia.value) <= 0}
{assign var="value" value=$fields.pf_porcentaje_financia.default_value }
{else}
{assign var="value" value=$fields.pf_porcentaje_financia.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_porcentaje_financia.name}">{$fields.pf_porcentaje_financia.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pf_inversion.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_INVERSION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_inversion','varchar')" class="div_value" id="pf_inversion_detailblock" target_id="pf_inversion">
{if !$fields.pf_inversion.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_inversion.value) <= 0}
{assign var="value" value=$fields.pf_inversion.default_value }
{else}
{assign var="value" value=$fields.pf_inversion.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_inversion.name}">{$fields.pf_inversion.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.pf_f_prevista_inicio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_F_PERVISTA_INICIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_f_prevista_inicio','varchar')" class="div_value" id="pf_f_prevista_inicio_detailblock" target_id="pf_f_prevista_inicio">
{if !$fields.pf_f_prevista_inicio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pf_f_prevista_inicio.value) <= 0}
{assign var="value" value=$fields.pf_f_prevista_inicio.default_value }
{else}
{assign var="value" value=$fields.pf_f_prevista_inicio.value }
{/if} 
<span class="sugar_field" id="{$fields.pf_f_prevista_inicio.name}">{$fields.pf_f_prevista_inicio.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
<script>document.getElementById("LBL_PLAN_FINANCIERO").style.display='none';</script>
{/if}
</div>    <div id='tabcontent5'>
<div id='detailpanel_6' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_CONTRATO' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.con_fir1_first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_first_name','varchar')" class="div_value" id="con_fir1_first_name_detailblock" target_id="con_fir1_first_name">
{if !$fields.con_fir1_first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_first_name.value) <= 0}
{assign var="value" value=$fields.con_fir1_first_name.default_value }
{else}
{assign var="value" value=$fields.con_fir1_first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir1_first_name.name}">{$fields.con_fir1_first_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.con_fir2_first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_first_name','varchar')" class="div_value" id="con_fir2_first_name_detailblock" target_id="con_fir2_first_name">
{if !$fields.con_fir2_first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_first_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_first_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir2_first_name.name}">{$fields.con_fir2_first_name.value}</span>
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
{if !$fields.con_fir1_last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_last_name','varchar')" class="div_value" id="con_fir1_last_name_detailblock" target_id="con_fir1_last_name">
{if !$fields.con_fir1_last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir1_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir1_last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir1_last_name.name}">{$fields.con_fir1_last_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.con_fir2_last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_last_name','varchar')" class="div_value" id="con_fir2_last_name_detailblock" target_id="con_fir2_last_name">
{if !$fields.con_fir2_last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir2_last_name.name}">{$fields.con_fir2_last_name.value}</span>
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
{if !$fields.con_fir1_NIF.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_NIF','varchar')" class="div_value" id="con_fir1_NIF_detailblock" target_id="con_fir1_NIF">
{if !$fields.con_fir1_NIF.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_NIF.value) <= 0}
{assign var="value" value=$fields.con_fir1_NIF.default_value }
{else}
{assign var="value" value=$fields.con_fir1_NIF.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir1_NIF.name}">{$fields.con_fir1_NIF.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.con_fir2_last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_last_name','varchar')" class="div_value" id="con_fir2_last_name_detailblock" target_id="con_fir2_last_name">
{if !$fields.con_fir2_last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir2_last_name.name}">{$fields.con_fir2_last_name.value}</span>
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
{if !$fields.con_fir1_vecino.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_vecino','varchar')" class="div_value" id="con_fir1_vecino_detailblock" target_id="con_fir1_vecino">
{if !$fields.con_fir1_vecino.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_vecino.value) <= 0}
{assign var="value" value=$fields.con_fir1_vecino.default_value }
{else}
{assign var="value" value=$fields.con_fir1_vecino.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir1_vecino.name}">{$fields.con_fir1_vecino.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.con_fir2_vecino.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_vecino','varchar')" class="div_value" id="con_fir2_vecino_detailblock" target_id="con_fir2_vecino">
{if !$fields.con_fir2_vecino.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_vecino.value) <= 0}
{assign var="value" value=$fields.con_fir2_vecino.default_value }
{else}
{assign var="value" value=$fields.con_fir2_vecino.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir2_vecino.name}">{$fields.con_fir2_vecino.value}</span>
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
{if !$fields.con_fir1_domicilio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_domicilio','varchar')" class="div_value" id="con_fir1_domicilio_detailblock" target_id="con_fir1_domicilio">
{if !$fields.con_fir1_domicilio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_domicilio.value) <= 0}
{assign var="value" value=$fields.con_fir1_domicilio.default_value }
{else}
{assign var="value" value=$fields.con_fir1_domicilio.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir1_domicilio.name}">{$fields.con_fir1_domicilio.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.con_fir2_domicilio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_domicilio','varchar')" class="div_value" id="con_fir2_domicilio_detailblock" target_id="con_fir2_domicilio">
{if !$fields.con_fir2_domicilio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_domicilio.value) <= 0}
{assign var="value" value=$fields.con_fir2_domicilio.default_value }
{else}
{assign var="value" value=$fields.con_fir2_domicilio.value }
{/if} 
<span class="sugar_field" id="{$fields.con_fir2_domicilio.name}">{$fields.con_fir2_domicilio.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_SOCIEDAD1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SOCIEDAD2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.sociedad1_razon_social.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_razon_social','varchar')" class="div_value" id="sociedad1_razon_social_detailblock" target_id="sociedad1_razon_social">
{if !$fields.sociedad1_razon_social.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_razon_social.value) <= 0}
{assign var="value" value=$fields.sociedad1_razon_social.default_value }
{else}
{assign var="value" value=$fields.sociedad1_razon_social.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_razon_social.name}">{$fields.sociedad1_razon_social.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_razon_social.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_razon_social','varchar')" class="div_value" id="sociedad2_razon_social_detailblock" target_id="sociedad2_razon_social">
{if !$fields.sociedad2_razon_social.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_razon_social.value) <= 0}
{assign var="value" value=$fields.sociedad2_razon_social.default_value }
{else}
{assign var="value" value=$fields.sociedad2_razon_social.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_razon_social.name}">{$fields.sociedad2_razon_social.value}</span>
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
{if !$fields.sociedad1_nacionalidad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_nacionalidad','varchar')" class="div_value" id="sociedad1_nacionalidad_detailblock" target_id="sociedad1_nacionalidad">
{if !$fields.sociedad1_nacionalidad.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_nacionalidad.value) <= 0}
{assign var="value" value=$fields.sociedad1_nacionalidad.default_value }
{else}
{assign var="value" value=$fields.sociedad1_nacionalidad.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_nacionalidad.name}">{$fields.sociedad1_nacionalidad.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_nacionalidad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_nacionalidad','varchar')" class="div_value" id="sociedad2_nacionalidad_detailblock" target_id="sociedad2_nacionalidad">
{if !$fields.sociedad2_nacionalidad.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_nacionalidad.value) <= 0}
{assign var="value" value=$fields.sociedad2_nacionalidad.default_value }
{else}
{assign var="value" value=$fields.sociedad2_nacionalidad.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_nacionalidad.name}">{$fields.sociedad2_nacionalidad.value}</span>
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
{if !$fields.sociedad1_domicilio_social.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_domicilio_social','varchar')" class="div_value" id="sociedad1_domicilio_social_detailblock" target_id="sociedad1_domicilio_social">
{if !$fields.sociedad1_domicilio_social.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_domicilio_social.value) <= 0}
{assign var="value" value=$fields.sociedad1_domicilio_social.default_value }
{else}
{assign var="value" value=$fields.sociedad1_domicilio_social.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_domicilio_social.name}">{$fields.sociedad1_domicilio_social.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_domicilio_social.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_domicilio_social','varchar')" class="div_value" id="sociedad2_domicilio_social_detailblock" target_id="sociedad2_domicilio_social">
{if !$fields.sociedad2_domicilio_social.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_domicilio_social.value) <= 0}
{assign var="value" value=$fields.sociedad2_domicilio_social.default_value }
{else}
{assign var="value" value=$fields.sociedad2_domicilio_social.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_domicilio_social.name}">{$fields.sociedad2_domicilio_social.value}</span>
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
{if !$fields.sociedad1_cif.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cif','varchar')" class="div_value" id="sociedad1_cif_detailblock" target_id="sociedad1_cif">
{if !$fields.sociedad1_cif.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cif.value) <= 0}
{assign var="value" value=$fields.sociedad1_cif.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cif.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_cif.name}">{$fields.sociedad1_cif.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_cif.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_cif','varchar')" class="div_value" id="sociedad2_cif_detailblock" target_id="sociedad2_cif">
{if !$fields.sociedad2_cif.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_cif.value) <= 0}
{assign var="value" value=$fields.sociedad2_cif.default_value }
{else}
{assign var="value" value=$fields.sociedad2_cif.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_cif.name}">{$fields.sociedad2_cif.value}</span>
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
{if !$fields.sociedad1_f_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_f_ins_reg_mercantil','date')" class="div_value" id="sociedad1_f_ins_reg_mercantil_detailblock" target_id="sociedad1_f_ins_reg_mercantil">
{if !$fields.sociedad1_f_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.sociedad1_f_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad1_f_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad1_f_ins_reg_mercantil.value }
{/if}
<span class="sugar_field" id="{$fields.sociedad1_f_ins_reg_mercantil.name}">{$value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_f_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_f_ins_reg_mercantil','date')" class="div_value" id="sociedad2_f_ins_reg_mercantil_detailblock" target_id="sociedad2_f_ins_reg_mercantil">
{if !$fields.sociedad2_f_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.sociedad2_f_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad2_f_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad2_f_ins_reg_mercantil.value }
{/if}
<span class="sugar_field" id="{$fields.sociedad2_f_ins_reg_mercantil.name}">{$value}</span>
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
{if !$fields.sociedad1_lugar_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_lugar_ins_reg_mercantil','varchar')" class="div_value" id="sociedad1_lugar_ins_reg_mercantil_detailblock" target_id="sociedad1_lugar_ins_reg_mercantil">
{if !$fields.sociedad1_lugar_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_lugar_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad1_lugar_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad1_lugar_ins_reg_mercantil.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_lugar_ins_reg_mercantil.name}">{$fields.sociedad1_lugar_ins_reg_mercantil.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_lugar_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_lugar_ins_reg_mercantil','varchar')" class="div_value" id="sociedad2_lugar_ins_reg_mercantil_detailblock" target_id="sociedad2_lugar_ins_reg_mercantil">
{if !$fields.sociedad2_lugar_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_lugar_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad2_lugar_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad2_lugar_ins_reg_mercantil.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_lugar_ins_reg_mercantil.name}">{$fields.sociedad2_lugar_ins_reg_mercantil.value}</span>
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
{if !$fields.sociedad1_datos_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_datos_ins_reg_mercantil','varchar')" class="div_value" id="sociedad1_datos_ins_reg_mercantil_detailblock" target_id="sociedad1_datos_ins_reg_mercantil">
{if !$fields.sociedad1_datos_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_datos_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad1_datos_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad1_datos_ins_reg_mercantil.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_datos_ins_reg_mercantil.name}">{$fields.sociedad1_datos_ins_reg_mercantil.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_datos_ins_reg_mercantil.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_datos_ins_reg_mercantil','varchar')" class="div_value" id="sociedad2_datos_ins_reg_mercantil_detailblock" target_id="sociedad2_datos_ins_reg_mercantil">
{if !$fields.sociedad2_datos_ins_reg_mercantil.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_datos_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad2_datos_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad2_datos_ins_reg_mercantil.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_datos_ins_reg_mercantil.name}">{$fields.sociedad2_datos_ins_reg_mercantil.value}</span>
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
{if !$fields.sociedad1_representante_legal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_representante_legal','varchar')" class="div_value" id="sociedad1_representante_legal_detailblock" target_id="sociedad1_representante_legal">
{if !$fields.sociedad1_representante_legal.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_representante_legal.value) <= 0}
{assign var="value" value=$fields.sociedad1_representante_legal.default_value }
{else}
{assign var="value" value=$fields.sociedad1_representante_legal.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_representante_legal.name}">{$fields.sociedad1_representante_legal.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_representante_legal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_representante_legal','varchar')" class="div_value" id="sociedad2_representante_legal_detailblock" target_id="sociedad2_representante_legal">
{if !$fields.sociedad2_representante_legal.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_representante_legal.value) <= 0}
{assign var="value" value=$fields.sociedad2_representante_legal.default_value }
{else}
{assign var="value" value=$fields.sociedad2_representante_legal.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_representante_legal.name}">{$fields.sociedad2_representante_legal.value}</span>
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
{if !$fields.sociedad1_domicilio_representante.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_domicilio_representante','varchar')" class="div_value" id="sociedad1_domicilio_representante_detailblock" target_id="sociedad1_domicilio_representante">
{if !$fields.sociedad1_domicilio_representante.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_domicilio_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_domicilio_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_domicilio_representante.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_domicilio_representante.name}">{$fields.sociedad1_domicilio_representante.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad2_domicilio_representante.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_domicilio_representante','varchar')" class="div_value" id="sociedad2_domicilio_representante_detailblock" target_id="sociedad2_domicilio_representante">
{if !$fields.sociedad2_domicilio_representante.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_domicilio_representante.value) <= 0}
{assign var="value" value=$fields.sociedad2_domicilio_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad2_domicilio_representante.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad2_domicilio_representante.name}">{$fields.sociedad2_domicilio_representante.value}</span>
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
{if !$fields.sociedad1_cargo_representante.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cargo_representante','varchar')" class="div_value" id="sociedad1_cargo_representante_detailblock" target_id="sociedad1_cargo_representante">
{if !$fields.sociedad1_cargo_representante.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cargo_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_cargo_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cargo_representante.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_cargo_representante.name}">{$fields.sociedad1_cargo_representante.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sociedad1_cargo_representante.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cargo_representante','varchar')" class="div_value" id="sociedad1_cargo_representante_detailblock" target_id="sociedad1_cargo_representante">
{if !$fields.sociedad1_cargo_representante.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cargo_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_cargo_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cargo_representante.value }
{/if} 
<span class="sugar_field" id="{$fields.sociedad1_cargo_representante.name}">{$fields.sociedad1_cargo_representante.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
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
{if !$fields.f_contrato_firma.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_CONTRATO_FIRMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_contrato_firma','date')" class="div_value" id="f_contrato_firma_detailblock" target_id="f_contrato_firma">
{if !$fields.f_contrato_firma.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_contrato_firma.value) <= 0}
{assign var="value" value=$fields.f_contrato_firma.default_value }
{else}
{assign var="value" value=$fields.f_contrato_firma.value }
{/if}
<span class="sugar_field" id="{$fields.f_contrato_firma.name}">{$value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.modelo_franquicia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MODELO_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modelo_franquicia','varchar')" class="div_value" id="modelo_franquicia_detailblock" target_id="modelo_franquicia">
{if !$fields.modelo_franquicia.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.modelo_franquicia.value) <= 0}
{assign var="value" value=$fields.modelo_franquicia.default_value }
{else}
{assign var="value" value=$fields.modelo_franquicia.value }
{/if} 
<span class="sugar_field" id="{$fields.modelo_franquicia.name}">{$fields.modelo_franquicia.value}</span>
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
{if !$fields.franquicia_piloto.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_PILOTO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_piloto','varchar')" class="div_value" id="franquicia_piloto_detailblock" target_id="franquicia_piloto">
{if !$fields.franquicia_piloto.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.franquicia_piloto.value) <= 0}
{assign var="value" value=$fields.franquicia_piloto.default_value }
{else}
{assign var="value" value=$fields.franquicia_piloto.value }
{/if} 
<span class="sugar_field" id="{$fields.franquicia_piloto.name}">{$fields.franquicia_piloto.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.lineas_negocio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LINEAS_NEGOCIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lineas_negocio','varchar')" class="div_value" id="lineas_negocio_detailblock" target_id="lineas_negocio">
{if !$fields.lineas_negocio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.lineas_negocio.value) <= 0}
{assign var="value" value=$fields.lineas_negocio.default_value }
{else}
{assign var="value" value=$fields.lineas_negocio.value }
{/if} 
<span class="sugar_field" id="{$fields.lineas_negocio.name}">{$fields.lineas_negocio.value}</span>
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
{if !$fields.contrato_condiciones_especiales.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES_ESPECIALES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('contrato_condiciones_especiales','varchar')" class="div_value" id="contrato_condiciones_especiales_detailblock" target_id="contrato_condiciones_especiales">
{if !$fields.contrato_condiciones_especiales.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.contrato_condiciones_especiales.value) <= 0}
{assign var="value" value=$fields.contrato_condiciones_especiales.default_value }
{else}
{assign var="value" value=$fields.contrato_condiciones_especiales.value }
{/if} 
<span class="sugar_field" id="{$fields.contrato_condiciones_especiales.name}">{$fields.contrato_condiciones_especiales.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.canon_entrada_definitivo.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('canon_entrada_definitivo','varchar')" class="div_value" id="canon_entrada_definitivo_detailblock" target_id="canon_entrada_definitivo">
{if !$fields.canon_entrada_definitivo.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.canon_entrada_definitivo.value) <= 0}
{assign var="value" value=$fields.canon_entrada_definitivo.default_value }
{else}
{assign var="value" value=$fields.canon_entrada_definitivo.value }
{/if} 
<span class="sugar_field" id="{$fields.canon_entrada_definitivo.name}">{$fields.canon_entrada_definitivo.value}</span>
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
{if !$fields.local_titularidad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCAL_TITULARIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local_titularidad','varchar')" class="div_value" id="local_titularidad_detailblock" target_id="local_titularidad">
{if !$fields.local_titularidad.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.local_titularidad.value) <= 0}
{assign var="value" value=$fields.local_titularidad.default_value }
{else}
{assign var="value" value=$fields.local_titularidad.value }
{/if} 
<span class="sugar_field" id="{$fields.local_titularidad.name}">{$fields.local_titularidad.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.importe_abonado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IMPORTE_ABONADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('importe_abonado','varchar')" class="div_value" id="importe_abonado_detailblock" target_id="importe_abonado">
{if !$fields.importe_abonado.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.importe_abonado.value) <= 0}
{assign var="value" value=$fields.importe_abonado.default_value }
{else}
{assign var="value" value=$fields.importe_abonado.value }
{/if} 
<span class="sugar_field" id="{$fields.importe_abonado.name}">{$fields.importe_abonado.value}</span>
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
{if !$fields.local_Direccion.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local1_Direccion','varchar')" class="div_value" id="local1_Direccion_detailblock" target_id="local1_Direccion">
{if !$fields.local_Direccion.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.local1_Direccion.value) <= 0}
{assign var="value" value=$fields.local1_Direccion.default_value }
{else}
{assign var="value" value=$fields.local1_Direccion.value }
{/if} 
<span class="sugar_field" id="{$fields.local1_Direccion.name}">{$fields.local1_Direccion.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.marca.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('marca','varchar')" class="div_value" id="marca_detailblock" target_id="marca">
{if !$fields.marca.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.marca.value) <= 0}
{assign var="value" value=$fields.marca.default_value }
{else}
{assign var="value" value=$fields.marca.value }
{/if} 
<span class="sugar_field" id="{$fields.marca.name}">{$fields.marca.value}</span>
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
{if !$fields.local_municipio.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MUNICIPIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local_municipio','varchar')" class="div_value" id="local_municipio_detailblock" target_id="local_municipio">
{if !$fields.local_municipio.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.local_municipio.value) <= 0}
{assign var="value" value=$fields.local_municipio.default_value }
{else}
{assign var="value" value=$fields.local_municipio.value }
{/if} 
<span class="sugar_field" id="{$fields.local_municipio.name}">{$fields.local_municipio.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.estado_marca.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ESTADO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_marca','varchar')" class="div_value" id="estado_marca_detailblock" target_id="estado_marca">
{if !$fields.estado_marca.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.estado_marca.value) <= 0}
{assign var="value" value=$fields.estado_marca.default_value }
{else}
{assign var="value" value=$fields.estado_marca.value }
{/if} 
<span class="sugar_field" id="{$fields.estado_marca.name}">{$fields.estado_marca.value}</span>
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
{if !$fields.f_apertura.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_apertura','date')" class="div_value" id="f_apertura_detailblock" target_id="f_apertura">
{if !$fields.f_apertura.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_apertura.value) <= 0}
{assign var="value" value=$fields.f_apertura.default_value }
{else}
{assign var="value" value=$fields.f_apertura.value }
{/if}
<span class="sugar_field" id="{$fields.f_apertura.name}">{$value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.propietario_marca.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROPIETARIO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('propietario_marca','varchar')" class="div_value" id="propietario_marca_detailblock" target_id="propietario_marca">
{if !$fields.propietario_marca.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.propietario_marca.value) <= 0}
{assign var="value" value=$fields.propietario_marca.default_value }
{else}
{assign var="value" value=$fields.propietario_marca.value }
{/if} 
<span class="sugar_field" id="{$fields.propietario_marca.name}">{$fields.propietario_marca.value}</span>
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
{if !$fields.zona_exlusividad.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_exlusividad','text')" class="div_value" id="zona_exlusividad_detailblock" target_id="zona_exlusividad">
{if !$fields.zona_exlusividad.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.zona_exlusividad.name|escape:'html'|url2html|nl2br}">{$fields.zona_exlusividad.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.codigo_marca.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CODIGO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('codigo_marca','varchar')" class="div_value" id="codigo_marca_detailblock" target_id="codigo_marca">
{if !$fields.codigo_marca.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.codigo_marca.value) <= 0}
{assign var="value" value=$fields.codigo_marca.default_value }
{else}
{assign var="value" value=$fields.codigo_marca.value }
{/if} 
<span class="sugar_field" id="{$fields.codigo_marca.name}">{$fields.codigo_marca.value}</span>
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
{if !$fields.entidad_financiera.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FINANCIERA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_financiera','varchar')" class="div_value" id="entidad_financiera_detailblock" target_id="entidad_financiera">
{if !$fields.entidad_financiera.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.entidad_financiera.value) <= 0}
{assign var="value" value=$fields.entidad_financiera.default_value }
{else}
{assign var="value" value=$fields.entidad_financiera.value }
{/if} 
<span class="sugar_field" id="{$fields.entidad_financiera.name}">{$fields.entidad_financiera.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.duracion_contrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DURACION_CONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('duracion_contrato','varchar')" class="div_value" id="duracion_contrato_detailblock" target_id="duracion_contrato">
{if !$fields.duracion_contrato.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.duracion_contrato.value) <= 0}
{assign var="value" value=$fields.duracion_contrato.default_value }
{else}
{assign var="value" value=$fields.duracion_contrato.value }
{/if} 
<span class="sugar_field" id="{$fields.duracion_contrato.name}">{$fields.duracion_contrato.value}</span>
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
{if !$fields.n_cuenta.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('n_cuenta','varchar')" class="div_value" id="n_cuenta_detailblock" target_id="n_cuenta">
{if !$fields.n_cuenta.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.n_cuenta.value) <= 0}
{assign var="value" value=$fields.n_cuenta.default_value }
{else}
{assign var="value" value=$fields.n_cuenta.value }
{/if} 
<span class="sugar_field" id="{$fields.n_cuenta.name}">{$fields.n_cuenta.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pago_en_cuenta.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAGO_EN_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pago_en_cuenta','varchar')" class="div_value" id="pago_en_cuenta_detailblock" target_id="pago_en_cuenta">
{if !$fields.pago_en_cuenta.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pago_en_cuenta.value) <= 0}
{assign var="value" value=$fields.pago_en_cuenta.default_value }
{else}
{assign var="value" value=$fields.pago_en_cuenta.value }
{/if} 
<span class="sugar_field" id="{$fields.pago_en_cuenta.name}">{$fields.pago_en_cuenta.value}</span>
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
{if !$fields.lugar_formacion_preferente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_FORMACION_PREFERENTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lugar_formacion_preferente','varchar')" class="div_value" id="lugar_formacion_preferente_detailblock" target_id="lugar_formacion_preferente">
{if !$fields.lugar_formacion_preferente.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.lugar_formacion_preferente.value) <= 0}
{assign var="value" value=$fields.lugar_formacion_preferente.default_value }
{else}
{assign var="value" value=$fields.lugar_formacion_preferente.value }
{/if} 
<span class="sugar_field" id="{$fields.lugar_formacion_preferente.name}">{$fields.lugar_formacion_preferente.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.cuenta_expande.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA_EXPANDE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuenta_expande','varchar')" class="div_value" id="cuenta_expande_detailblock" target_id="cuenta_expande">
{if !$fields.cuenta_expande.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.cuenta_expande.value) <= 0}
{assign var="value" value=$fields.cuenta_expande.default_value }
{else}
{assign var="value" value=$fields.cuenta_expande.value }
{/if} 
<span class="sugar_field" id="{$fields.cuenta_expande.name}">{$fields.cuenta_expande.value}</span>
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
{if !$fields.entrega_cuenta_cont.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entrega_cuenta_cont','varchar')" class="div_value" id="entrega_cuenta_cont_detailblock" target_id="entrega_cuenta_cont">
{if !$fields.entrega_cuenta_cont.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.entrega_cuenta_cont.value) <= 0}
{assign var="value" value=$fields.entrega_cuenta_cont.default_value }
{else}
{assign var="value" value=$fields.entrega_cuenta_cont.value }
{/if} 
<span class="sugar_field" id="{$fields.entrega_cuenta_cont.name}">{$fields.entrega_cuenta_cont.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.entidad_fin_expande.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_EXPANDE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_fin_expande','varchar')" class="div_value" id="entidad_fin_expande_detailblock" target_id="entidad_fin_expande">
{if !$fields.entidad_fin_expande.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.entidad_fin_expande.value) <= 0}
{assign var="value" value=$fields.entidad_fin_expande.default_value }
{else}
{assign var="value" value=$fields.entidad_fin_expande.value }
{/if} 
<span class="sugar_field" id="{$fields.entidad_fin_expande.name}">{$fields.entidad_fin_expande.value}</span>
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
{if !$fields.f_entrega_cuenta_cont.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solo se rellena a la recepcion del justificante" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrega_cuenta_cont','date')" class="div_value" id="f_entrega_cuenta_cont_detailblock" target_id="f_entrega_cuenta_cont">
{if !$fields.f_entrega_cuenta_cont.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_entrega_cuenta_cont.value) <= 0}
{assign var="value" value=$fields.f_entrega_cuenta_cont.default_value }
{else}
{assign var="value" value=$fields.f_entrega_cuenta_cont.value }
{/if}
<span class="sugar_field" id="{$fields.f_entrega_cuenta_cont.name}">{$value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.cuenta_franquiciador.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuenta_franquiciador','varchar')" class="div_value" id="cuenta_franquiciador_detailblock" target_id="cuenta_franquiciador">
{if !$fields.cuenta_franquiciador.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.cuenta_franquiciador.value) <= 0}
{assign var="value" value=$fields.cuenta_franquiciador.default_value }
{else}
{assign var="value" value=$fields.cuenta_franquiciador.value }
{/if} 
<span class="sugar_field" id="{$fields.cuenta_franquiciador.name}">{$fields.cuenta_franquiciador.value}</span>
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
{if !$fields.entidad_fin_franquiciador.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_fin_franquiciador','varchar')" class="div_value" id="entidad_fin_franquiciador_detailblock" target_id="entidad_fin_franquiciador">
{if !$fields.entidad_fin_franquiciador.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.entidad_fin_franquiciador.value) <= 0}
{assign var="value" value=$fields.entidad_fin_franquiciador.default_value }
{else}
{assign var="value" value=$fields.entidad_fin_franquiciador.value }
{/if} 
<span class="sugar_field" id="{$fields.entidad_fin_franquiciador.name}">{$fields.entidad_fin_franquiciador.value}</span>
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
{if !$fields.inversion_inicial.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inversion_inicial','varchar')" class="div_value" id="inversion_inicial_detailblock" target_id="inversion_inicial">
{if !$fields.inversion_inicial.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.inversion_inicial.value) <= 0}
{assign var="value" value=$fields.inversion_inicial.default_value }
{else}
{assign var="value" value=$fields.inversion_inicial.value }
{/if} 
<span class="sugar_field" id="{$fields.inversion_inicial.name}">{$fields.inversion_inicial.value}</span>
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
{if !$fields.royalty_explotacion.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('royalty_explotacion','varchar')" class="div_value" id="royalty_explotacion_detailblock" target_id="royalty_explotacion">
{if !$fields.royalty_explotacion.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.royalty_explotacion.value) <= 0}
{assign var="value" value=$fields.royalty_explotacion.default_value }
{else}
{assign var="value" value=$fields.royalty_explotacion.value }
{/if} 
<span class="sugar_field" id="{$fields.royalty_explotacion.name}">{$fields.royalty_explotacion.value}</span>
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
{if !$fields.min_royalty.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MIN_ROYALTY' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('min_royalty','varchar')" class="div_value" id="min_royalty_detailblock" target_id="min_royalty">
{if !$fields.min_royalty.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.min_royalty.value) <= 0}
{assign var="value" value=$fields.min_royalty.default_value }
{else}
{assign var="value" value=$fields.min_royalty.value }
{/if} 
<span class="sugar_field" id="{$fields.min_royalty.name}">{$fields.min_royalty.value}</span>
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
{if !$fields.fondo_marketing.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FONDO_MARKETING' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fondo_marketing','varchar')" class="div_value" id="fondo_marketing_detailblock" target_id="fondo_marketing">
{if !$fields.fondo_marketing.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.fondo_marketing.value) <= 0}
{assign var="value" value=$fields.fondo_marketing.default_value }
{else}
{assign var="value" value=$fields.fondo_marketing.value }
{/if} 
<span class="sugar_field" id="{$fields.fondo_marketing.name}">{$fields.fondo_marketing.value}</span>
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
{if !$fields.observacion_contrato.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACION_CONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observacion_contrato','text')" class="div_value" id="observacion_contrato_detailblock" target_id="observacion_contrato">
{if !$fields.observacion_contrato.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observacion_contrato.name|escape:'html'|url2html|nl2br}">{$fields.observacion_contrato.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<script>document.getElementById("LBL_CONTRATO").style.display='none';</script>
{/if}
</div>
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script><script type='text/javascript' src='{sugar_getjspath file='include/javascript/popup_helper.js'}'></script>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>
<script type="text/javascript">
var Expan_GestionSolicitudes_detailview_tabs = new YAHOO.widget.TabView("Expan_GestionSolicitudes_detailview_tabs");
Expan_GestionSolicitudes_detailview_tabs.selectTab(0);
</script>
<script src='include/javascript/enhanced_detailview.js'></script>
<script src='include/javascript/popup_helper.js'></script>
<script type='text/javascript'>
	EDV.calendar_format = "{$CALENDAR_FORMAT}";
</script>