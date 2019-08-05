

<script>
{literal}
$(document).ready(function(){
$("ul.clickMenu").each(function(index, node){
$(node).sugarActionMenu();
});
});
{/literal}
</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if (!empty($smarty.request.return_module) || !empty($smarty.request.relate_to)) && !(isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true")}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
{assign var='place' value="_HEADER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="action_buttons"><input type="submit" name="save" id="save" class="submit" 
onClick="document.getElementById('candidatura_caliente').disabled = false;
this.form.return_action.value='DetailView';                 
this.form.action.value='Save';
return validarEdicion('{$fields.id.value}');" value="Guardar"/> {if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_HEADER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Expan_GestionSolicitudes'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {/if} {if $fields.id.value!=""}<input type="button" name="irApertura" id="irApertura" class style="color:#0000FF;" 
onClick="irAperturas('{$fields.name.value}');" value="Ir Aperturas"/>{/if} {if $fields.id.value!=""}<input type="button" style="color:#FF0000;" name="irfran" id="irfran" class onClick="irFranquicia('{$fields.franquicia.value}');" value="Ir Franquicia"/>{/if} {if $fields.id.value!=""}<input type="button" style="color:#00BC9F;" name="irsol" id="irsol" class onClick="irSolicitud('{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}');" value="Ir Solicitud"/>{/if} {if $fields.id.value!=""}<BR> <BR/><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#0000FF;" 
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
onClick="envioCorreoInterlocutor('{$fields.id.value}','consultor');" value="Envio Ficha Consultor"/>{/if} {if $fields.id.value!=""}<BR><BR><input type="button" name="openWind" id="openWind" class onClick="abrirHermanas('{$fields.id.value}');" value="Abrir Hermanas"/>{/if} {if $fields.id.value!=""}<input type="button" name="open" id="open" class onClick="window.open('index.php?module=Calls&action=EditView&expan_gestionsolicitudes_calls_1_name={$fields.name.value}&&expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida={$fields.id.value}');" value="CrearLlamada"/>{/if} {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Expan_GestionSolicitudes", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="EditView_tabs"
class="yui-navset"
>

<ul class="yui-nav">
<li class="selected"><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='DEFAULT' module='Expan_GestionSolicitudes'}</em></a></li>
<li class="selected"><a id="tab1" href="javascript:void(1)"><em>{sugar_translate label='LBL_EDITVIEW_OBSERVACIONES' module='Expan_GestionSolicitudes'}</em></a></li>
<li class="selected"><a id="tab2" href="javascript:void(2)"><em>{sugar_translate label='LBL_IIT' module='Expan_GestionSolicitudes'}</em></a></li>
<li class="selected"><a id="tab3" href="javascript:void(3)"><em>{sugar_translate label='LBL_PRECONTRATO' module='Expan_GestionSolicitudes'}</em></a></li>
<li class="selected"><a id="tab4" href="javascript:void(4)"><em>{sugar_translate label='LBL_PLAN_FINANCIERO' module='Expan_GestionSolicitudes'}</em></a></li>
<li class="selected"><a id="tab5" href="javascript:void(5)"><em>{sugar_translate label='LBL_CONTRATO' module='Expan_GestionSolicitudes'}</em></a></li>
</ul>
<div class="yui-content">
<div id='tabcontent0'>
<div id="detailpanel_1" >
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='Default_{$module}_Subpanel'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='date_entered_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha creacion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}


{if strlen($fields.date_entered.value) <= 0}
{assign var="value" value=$fields.date_entered.default_value }
{else}
{assign var="value" value=$fields.date_entered.value }
{/if}
<span class="sugar_field" id="{$fields.date_entered.name}">{$value}</span>
<td valign="top" id='oportunidad_inmediata_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OPORTUNIDAD_INMEDIATA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.oportunidad_inmediata.value) == "1" || strval($fields.oportunidad_inmediata.value) == "yes" || strval($fields.oportunidad_inmediata.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.oportunidad_inmediata.name}" value="0"> 
<input type="checkbox" id="{$fields.oportunidad_inmediata.name}" 
name="{$fields.oportunidad_inmediata.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='prioridad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.prioridad.value) <= 0}
{assign var="value" value=$fields.prioridad.default_value }
{else}
{assign var="value" value=$fields.prioridad.value }
{/if} 
<span class="sugar_field" id="{$fields.prioridad.name}">{$fields.prioridad.value}</span>
<td valign="top" id='rating_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RATING' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.rating.name}" 
id="{$fields.rating.name}" 
title=''       
>
{if isset($fields.rating.value) && $fields.rating.value != ''}
{html_options options=$fields.rating.options selected=$fields.rating.value}
{else}
{html_options options=$fields.rating.options selected=$fields.rating.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.rating.options }
{capture name="field_val"}{$fields.rating.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.rating.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.rating.name}" 
id="{$fields.rating.name}" 
title=''          
>
{if isset($fields.rating.value) && $fields.rating.value != ''}
{html_options options=$fields.rating.options selected=$fields.rating.value}
{else}
{html_options options=$fields.rating.options selected=$fields.rating.default}
{/if}
</select>
<input
id="{$fields.rating.name}-input"
name="{$fields.rating.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.rating.name}-image"></button><button type="button"
id="btn-clear-{$fields.rating.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.rating.name}-input', '{$fields.rating.name}');sync_{$fields.rating.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.rating.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.rating.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.rating.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.rating.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.rating.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.rating.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.rating.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.rating.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.rating.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.rating.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_auto_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Envios automatizados' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_auto.value) == "1" || strval($fields.chk_envio_auto.value) == "yes" || strval($fields.chk_envio_auto.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_auto.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_auto.name}" 
name="{$fields.chk_envio_auto.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='candidatura_avanzada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CANDIDATURA_AVANZADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.candidatura_avanzada.value) == "1" || strval($fields.candidatura_avanzada.value) == "yes" || strval($fields.candidatura_avanzada.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.candidatura_avanzada.name}" value="0"> 
<input type="checkbox" id="{$fields.candidatura_avanzada.name}" 
name="{$fields.candidatura_avanzada.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_posible_colabora_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Posible Colaboracion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Interesado en comprar servicios o productos sin ser franquiciado. Todavía no es positivo." module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_posible_colabora.value) == "1" || strval($fields.chk_posible_colabora.value) == "yes" || strval($fields.chk_posible_colabora.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_posible_colabora.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_posible_colabora.name}" 
name="{$fields.chk_posible_colabora.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='candidatura_caliente_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Candidatura caliente' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.candidatura_caliente.value) == "1" || strval($fields.candidatura_caliente.value) == "yes" || strval($fields.candidatura_caliente.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.candidatura_caliente.name}" value="0"> 
<input type="checkbox" id="{$fields.candidatura_caliente.name}" 
name="{$fields.candidatura_caliente.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='estado_sol_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Estado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.estado_sol.name}" 
id="{$fields.estado_sol.name}" 
title=''       
onchange="ocultarCheck('{$fields.id.value}');">
{if isset($fields.estado_sol.value) && $fields.estado_sol.value != ''}
{html_options options=$fields.estado_sol.options selected=$fields.estado_sol.value}
{else}
{html_options options=$fields.estado_sol.options selected=$fields.estado_sol.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.estado_sol.options }
{capture name="field_val"}{$fields.estado_sol.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.estado_sol.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.estado_sol.name}" 
id="{$fields.estado_sol.name}" 
title=''          
onchange="ocultarCheck('{$fields.id.value}');">
{if isset($fields.estado_sol.value) && $fields.estado_sol.value != ''}
{html_options options=$fields.estado_sol.options selected=$fields.estado_sol.value}
{else}
{html_options options=$fields.estado_sol.options selected=$fields.estado_sol.default}
{/if}
</select>
<input
id="{$fields.estado_sol.name}-input"
name="{$fields.estado_sol.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.estado_sol.name}-image"></button><button type="button"
id="btn-clear-{$fields.estado_sol.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.estado_sol.name}-input', '{$fields.estado_sol.name}');sync_{$fields.estado_sol.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.estado_sol.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.estado_sol.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.estado_sol.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.estado_sol.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.estado_sol.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.estado_sol.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.estado_sol.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.estado_sol.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.estado_sol.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.estado_sol.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='f_posible_colabora_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha Posible Colaboracion' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_posible_colabora.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_posible_colabora.name}" id="{$fields.f_posible_colabora.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_posible_colabora.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_posible_colabora.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_posible_colabora.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='motivo_parada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_PARADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.motivo_parada.name}" 
id="{$fields.motivo_parada.name}" 
title=''       
>
{if isset($fields.motivo_parada.value) && $fields.motivo_parada.value != ''}
{html_options options=$fields.motivo_parada.options selected=$fields.motivo_parada.value}
{else}
{html_options options=$fields.motivo_parada.options selected=$fields.motivo_parada.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.motivo_parada.options }
{capture name="field_val"}{$fields.motivo_parada.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.motivo_parada.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.motivo_parada.name}" 
id="{$fields.motivo_parada.name}" 
title=''          
>
{if isset($fields.motivo_parada.value) && $fields.motivo_parada.value != ''}
{html_options options=$fields.motivo_parada.options selected=$fields.motivo_parada.value}
{else}
{html_options options=$fields.motivo_parada.options selected=$fields.motivo_parada.default}
{/if}
</select>
<input
id="{$fields.motivo_parada.name}-input"
name="{$fields.motivo_parada.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.motivo_parada.name}-image"></button><button type="button"
id="btn-clear-{$fields.motivo_parada.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.motivo_parada.name}-input', '{$fields.motivo_parada.name}');sync_{$fields.motivo_parada.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.motivo_parada.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.motivo_parada.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.motivo_parada.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.motivo_parada.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.motivo_parada.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.motivo_parada.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.motivo_parada.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.motivo_parada.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.motivo_parada.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.motivo_parada.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='f_reactivacion_parado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_F_REACTIVACION_PARADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Fecha en el que se pasará la gestión de parado a en curso" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_reactivacion_parado.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_reactivacion_parado.name}" id="{$fields.f_reactivacion_parado.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_reactivacion_parado.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_reactivacion_parado.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_reactivacion_parado.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='motivo_descarte_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_DESCARTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.motivo_descarte.name}" 
id="{$fields.motivo_descarte.name}" 
title=''       
>
{if isset($fields.motivo_descarte.value) && $fields.motivo_descarte.value != ''}
{html_options options=$fields.motivo_descarte.options selected=$fields.motivo_descarte.value}
{else}
{html_options options=$fields.motivo_descarte.options selected=$fields.motivo_descarte.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.motivo_descarte.options }
{capture name="field_val"}{$fields.motivo_descarte.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.motivo_descarte.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.motivo_descarte.name}" 
id="{$fields.motivo_descarte.name}" 
title=''          
>
{if isset($fields.motivo_descarte.value) && $fields.motivo_descarte.value != ''}
{html_options options=$fields.motivo_descarte.options selected=$fields.motivo_descarte.value}
{else}
{html_options options=$fields.motivo_descarte.options selected=$fields.motivo_descarte.default}
{/if}
</select>
<input
id="{$fields.motivo_descarte.name}-input"
name="{$fields.motivo_descarte.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.motivo_descarte.name}-image"></button><button type="button"
id="btn-clear-{$fields.motivo_descarte.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.motivo_descarte.name}-input', '{$fields.motivo_descarte.name}');sync_{$fields.motivo_descarte.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.motivo_descarte.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.motivo_descarte.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.motivo_descarte.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.motivo_descarte.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.motivo_descarte.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.motivo_descarte.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.motivo_descarte.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.motivo_descarte.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.motivo_descarte.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.motivo_descarte.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='franq_apertura_desca_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQ_APERTURA_DESCARTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{php}      
include "custom/modules/Expan_Solicitud/metadata/opEdicionSolicitud.php";          
$fran=new opEdicionSolicitud();
$idGest=$this-> _tpl_vars["bean"]-> id;
$fran->recogerFranDescarte($idGest);        
{/php}
<div id="sugerencias_franq_apertura_desca" class="ui-autocomplete" style="display:none;background:white;overflow:auto" class="ui-menu" name="sugerencias_franq_apertura_desca"></div>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='motivo_positivo_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVO_POSITIVO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.motivo_positivo.name}" 
id="{$fields.motivo_positivo.name}" 
title=''       
>
{if isset($fields.motivo_positivo.value) && $fields.motivo_positivo.value != ''}
{html_options options=$fields.motivo_positivo.options selected=$fields.motivo_positivo.value}
{else}
{html_options options=$fields.motivo_positivo.options selected=$fields.motivo_positivo.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.motivo_positivo.options }
{capture name="field_val"}{$fields.motivo_positivo.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.motivo_positivo.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.motivo_positivo.name}" 
id="{$fields.motivo_positivo.name}" 
title=''          
>
{if isset($fields.motivo_positivo.value) && $fields.motivo_positivo.value != ''}
{html_options options=$fields.motivo_positivo.options selected=$fields.motivo_positivo.value}
{else}
{html_options options=$fields.motivo_positivo.options selected=$fields.motivo_positivo.default}
{/if}
</select>
<input
id="{$fields.motivo_positivo.name}-input"
name="{$fields.motivo_positivo.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.motivo_positivo.name}-image"></button><button type="button"
id="btn-clear-{$fields.motivo_positivo.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.motivo_positivo.name}-input', '{$fields.motivo_positivo.name}');sync_{$fields.motivo_positivo.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.motivo_positivo.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.motivo_positivo.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.motivo_positivo.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.motivo_positivo.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.motivo_positivo.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.motivo_positivo.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.motivo_positivo.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.motivo_positivo.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.motivo_positivo.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.motivo_positivo.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_gestionado_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHK_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_gestionado_central.value) == "1" || strval($fields.chk_gestionado_central.value) == "yes" || strval($fields.chk_gestionado_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_gestionado_central.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_gestionado_central.name}" 
name="{$fields.chk_gestionado_central.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_gestionado_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_F_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_gestionado_central.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_gestionado_central.name}" id="{$fields.f_gestionado_central.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_gestionado_central.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_gestionado_central.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_gestionado_central.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_entrevista_previa_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Presencial, virtual o entrevista preconcertada en feria" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa.value) == "1" || strval($fields.chk_entrevista_previa.value) == "yes" || strval($fields.chk_entrevista_previa.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_entrevista_previa.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_entrevista_previa.name}" 
name="{$fields.chk_entrevista_previa.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='usuario_entrevista_previa_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_USUARIO_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.usuario_entrevista_previa.value) <= 0}
{assign var="value" value=$fields.usuario_entrevista_previa.default_value }
{else}
{assign var="value" value=$fields.usuario_entrevista_previa.value }
{/if}  
<input type='text' name='{$fields.usuario_entrevista_previa.name}' 
id='{$fields.usuario_entrevista_previa.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_documentacion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Envio documentacion comercial (C1)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Cuestionario, dosier y multimedia" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_documentacion.value) == "1" || strval($fields.chk_envio_documentacion.value) == "yes" || strval($fields.chk_envio_documentacion.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_documentacion.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_documentacion.name}" 
name="{$fields.chk_envio_documentacion.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='envio_documentacion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='fecha de envío documentación comercial' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.envio_documentacion.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.envio_documentacion.name}" id="{$fields.envio_documentacion.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.envio_documentacion.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.envio_documentacion.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.envio_documentacion.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_responde_C1_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RESPONDE_C1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se activa si el usuario responde al C1. Es de activación automática no es necesario que el usuario la active" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_responde_C1.value) == "1" || strval($fields.chk_responde_C1.value) == "yes" || strval($fields.chk_responde_C1.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_responde_C1.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_responde_C1.name}" 
name="{$fields.chk_responde_C1.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_responde_C1_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha respuesta C1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_responde_C1.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_responde_C1.name}" id="{$fields.f_responde_C1.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_responde_C1.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_responde_C1.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_responde_C1.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_sol_amp_info_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Solicitud ampliacion información (Pte resolver)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_sol_amp_info.value) == "1" || strval($fields.chk_sol_amp_info.value) == "yes" || strval($fields.chk_sol_amp_info.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_sol_amp_info.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_sol_amp_info.name}" 
name="{$fields.chk_sol_amp_info.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_sol_amp_info_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha Solicitud ampliacion información' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_sol_amp_info.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_sol_amp_info.name}" id="{$fields.f_sol_amp_info.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_sol_amp_info.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_sol_amp_info.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_sol_amp_info.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_autoriza_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Candidato autorizado por central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_autoriza_central.value) == "1" || strval($fields.chk_autoriza_central.value) == "yes" || strval($fields.chk_autoriza_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_autoriza_central.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_autoriza_central.name}" 
name="{$fields.chk_autoriza_central.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_autoriza_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha autorizacion por central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_autoriza_central.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_autoriza_central.name}" id="{$fields.f_autoriza_central.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_autoriza_central.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_autoriza_central.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_autoriza_central.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_resolucion_dudas_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Resolucion de primeras dudas (Resueltas)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_resolucion_dudas.value) == "1" || strval($fields.chk_resolucion_dudas.value) == "yes" || strval($fields.chk_resolucion_dudas.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_resolucion_dudas.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_resolucion_dudas.name}" 
name="{$fields.chk_resolucion_dudas.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_resolucion_dudas_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha de Resolucion de primeras dudas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_resolucion_dudas.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_resolucion_dudas.name}" id="{$fields.f_resolucion_dudas.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_resolucion_dudas.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_resolucion_dudas.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_resolucion_dudas.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_recepcio_cuestionario_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RECEPCION_CUESTIONARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se activa cuando el solicitante rellena el cuestionario. Es de activación automática, no es necesario que el usuario la active" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_recepcio_cuestionario.value) == "1" || strval($fields.chk_recepcio_cuestionario.value) == "yes" || strval($fields.chk_recepcio_cuestionario.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_recepcio_cuestionario.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_recepcio_cuestionario.name}" 
name="{$fields.chk_recepcio_cuestionario.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_recepcion_cuestionario_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha de recepción del cuestionario' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_recepcion_cuestionario.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_recepcion_cuestionario.name}" id="{$fields.f_recepcion_cuestionario.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_recepcion_cuestionario.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_recepcion_cuestionario.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_recepcion_cuestionario.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_informacion_adicional_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Envio información adicional (C2)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Plan financiero" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_informacion_adicional.value) == "1" || strval($fields.chk_informacion_adicional.value) == "yes" || strval($fields.chk_informacion_adicional.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_informacion_adicional.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_informacion_adicional.name}" 
name="{$fields.chk_informacion_adicional.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_informacion_adicional_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha envio información adicional' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_informacion_adicional.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_informacion_adicional.name}" id="{$fields.f_informacion_adicional.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_informacion_adicional.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_informacion_adicional.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_informacion_adicional.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_entrevista_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Entrevista' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Presencial, virtual o entrevista preconcertada en feria" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista.value) == "1" || strval($fields.chk_entrevista.value) == "yes" || strval($fields.chk_entrevista.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_entrevista.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_entrevista.name}" 
name="{$fields.chk_entrevista.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_entrevista_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha Entrevista' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_entrevista.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_entrevista.name}" id="{$fields.f_entrevista.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_entrevista.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_entrevista.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_entrevista.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_propuesta_zona_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_propuesta_zona.value) == "1" || strval($fields.chk_propuesta_zona.value) == "yes" || strval($fields.chk_propuesta_zona.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_propuesta_zona.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_propuesta_zona.name}" 
name="{$fields.chk_propuesta_zona.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_propuesta_zona_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_propuesta_zona.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_propuesta_zona.name}" id="{$fields.f_propuesta_zona.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_propuesta_zona.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_propuesta_zona.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_propuesta_zona.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_visitado_fran_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Visitado franquiciado/unidad propia' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_visitado_fran.value) == "1" || strval($fields.chk_visitado_fran.value) == "yes" || strval($fields.chk_visitado_fran.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_visitado_fran.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_visitado_fran.name}" 
name="{$fields.chk_visitado_fran.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_visitado_fran_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha Visitado franquiciado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_visitado_fran.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_visitado_fran.name}" id="{$fields.f_visitado_fran.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_visitado_fran.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_visitado_fran.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_visitado_fran.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_precontrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Envio borrador Precontrato (C3)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_precontrato.value) == "1" || strval($fields.chk_envio_precontrato.value) == "yes" || strval($fields.chk_envio_precontrato.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_precontrato.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_precontrato.name}" 
name="{$fields.chk_envio_precontrato.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_envio_precontrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha envio precontrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_envio_precontrato.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_envio_precontrato.name}" id="{$fields.f_envio_precontrato.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_envio_precontrato.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_envio_precontrato.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_envio_precontrato.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_visita_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_visita_local.value) == "1" || strval($fields.chk_visita_local.value) == "yes" || strval($fields.chk_visita_local.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_visita_local.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_visita_local.name}" 
name="{$fields.chk_visita_local.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_visita_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha Informacion de local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_visita_local.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_visita_local.name}" id="{$fields.f_visita_local.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_visita_local.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_visita_local.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_visita_local.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_operacion_autorizada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Operación autorizada' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_operacion_autorizada.value) == "1" || strval($fields.chk_operacion_autorizada.value) == "yes" || strval($fields.chk_operacion_autorizada.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_operacion_autorizada.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_operacion_autorizada.name}" 
name="{$fields.chk_operacion_autorizada.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_operacion_autorizada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha autorización de la operación' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_operacion_autorizada.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_operacion_autorizada.name}" id="{$fields.f_operacion_autorizada.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_operacion_autorizada.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_operacion_autorizada.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_operacion_autorizada.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_precontrato_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_precontrato_personal.value) == "1" || strval($fields.chk_envio_precontrato_personal.value) == "yes" || strval($fields.chk_envio_precontrato_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_precontrato_personal.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_precontrato_personal.name}" 
name="{$fields.chk_envio_precontrato_personal.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_envio_precontrato_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_envio_precontrato_personal.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_envio_precontrato_personal.name}" id="{$fields.f_envio_precontrato_personal.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_envio_precontrato_personal.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_envio_precontrato_personal.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_envio_precontrato_personal.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_precontrato_firmado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Precontrato Firmado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_precontrato_firmado.value) == "1" || strval($fields.chk_precontrato_firmado.value) == "yes" || strval($fields.chk_precontrato_firmado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_precontrato_firmado.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_precontrato_firmado.name}" 
name="{$fields.chk_precontrato_firmado.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_precontrato_firmado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha firma precontrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_precontrato_firmado.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_precontrato_firmado.name}" id="{$fields.f_precontrato_firmado.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_precontrato_firmado.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_precontrato_firmado.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_precontrato_firmado.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_contrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Envío borrador Contrato (C4)' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_contrato.value) == "1" || strval($fields.chk_envio_contrato.value) == "yes" || strval($fields.chk_envio_contrato.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_contrato.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_contrato.name}" 
name="{$fields.chk_envio_contrato.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_envio_contrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha envío de contrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_envio_contrato.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_envio_contrato.name}" id="{$fields.f_envio_contrato.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_envio_contrato.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_envio_contrato.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_envio_contrato.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_aprobacion_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Aprobacion del local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_aprobacion_local.value) == "1" || strval($fields.chk_aprobacion_local.value) == "yes" || strval($fields.chk_aprobacion_local.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_aprobacion_local.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_aprobacion_local.name}" 
name="{$fields.chk_aprobacion_local.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_aprobacion_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha de aprobacion del local' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_aprobacion_local.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_aprobacion_local.name}" id="{$fields.f_aprobacion_local.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_aprobacion_local.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_aprobacion_local.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_aprobacion_local.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_plan_financiero_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_plan_financiero_personal.value) == "1" || strval($fields.chk_envio_plan_financiero_personal.value) == "yes" || strval($fields.chk_envio_plan_financiero_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_plan_financiero_personal.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_plan_financiero_personal.name}" 
name="{$fields.chk_envio_plan_financiero_personal.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_envio_plan_financiero_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_envio_plan_financiero_personal.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_envio_plan_financiero_personal.name}" id="{$fields.f_envio_plan_financiero_personal.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_envio_plan_financiero_personal.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_envio_plan_financiero_personal.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_envio_plan_financiero_personal.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_visita_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Visita a la Central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_visita_central.value) == "1" || strval($fields.chk_visita_central.value) == "yes" || strval($fields.chk_visita_central.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_visita_central.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_visita_central.name}" 
name="{$fields.chk_visita_central.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_visita_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha visita a la Central' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_visita_central.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_visita_central.name}" id="{$fields.f_visita_central.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_visita_central.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_visita_central.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_visita_central.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_envio_contrato_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_envio_contrato_personal.value) == "1" || strval($fields.chk_envio_contrato_personal.value) == "yes" || strval($fields.chk_envio_contrato_personal.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_envio_contrato_personal.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_envio_contrato_personal.name}" 
name="{$fields.chk_envio_contrato_personal.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_envio_contrato_personal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_envio_contrato_personal.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_envio_contrato_personal.name}" id="{$fields.f_envio_contrato_personal.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_envio_contrato_personal.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_envio_contrato_personal.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_envio_contrato_personal.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chk_contrato_firmado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Contrato Firmado' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chk_contrato_firmado.value) == "1" || strval($fields.chk_contrato_firmado.value) == "yes" || strval($fields.chk_contrato_firmado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chk_contrato_firmado.name}" value="0"> 
<input type="checkbox" id="{$fields.chk_contrato_firmado.name}" 
name="{$fields.chk_contrato_firmado.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='f_contrato_firmado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Fecha firma contrato' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_contrato_firmado.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_contrato_firmado.name}" id="{$fields.f_contrato_firmado.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_contrato_firmado.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_contrato_firmado.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_contrato_firmado.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='cuando_empezar_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CUANDO_EMPEZAR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.cuando_empezar.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.cuando_empezar.name}" id="{$fields.cuando_empezar.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.cuando_empezar.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.cuando_empezar.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.cuando_empezar.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='papel_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PAPEL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.papel.name}" 
id="{$fields.papel.name}" 
title=''       
>
{if isset($fields.papel.value) && $fields.papel.value != ''}
{html_options options=$fields.papel.options selected=$fields.papel.value}
{else}
{html_options options=$fields.papel.options selected=$fields.papel.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.papel.options }
{capture name="field_val"}{$fields.papel.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.papel.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.papel.name}" 
id="{$fields.papel.name}" 
title=''          
>
{if isset($fields.papel.value) && $fields.papel.value != ''}
{html_options options=$fields.papel.options selected=$fields.papel.value}
{else}
{html_options options=$fields.papel.options selected=$fields.papel.default}
{/if}
</select>
<input
id="{$fields.papel.name}-input"
name="{$fields.papel.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.papel.name}-image"></button><button type="button"
id="btn-clear-{$fields.papel.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.papel.name}-input', '{$fields.papel.name}');sync_{$fields.papel.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.papel.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.papel.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.papel.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.papel.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.papel.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.papel.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.papel.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.papel.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.papel.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.papel.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='inversion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_INVERSION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.inversion.name}" 
id="{$fields.inversion.name}" 
title=''       
>
{if isset($fields.inversion.value) && $fields.inversion.value != ''}
{html_options options=$fields.inversion.options selected=$fields.inversion.value}
{else}
{html_options options=$fields.inversion.options selected=$fields.inversion.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.inversion.options }
{capture name="field_val"}{$fields.inversion.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.inversion.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.inversion.name}" 
id="{$fields.inversion.name}" 
title=''          
>
{if isset($fields.inversion.value) && $fields.inversion.value != ''}
{html_options options=$fields.inversion.options selected=$fields.inversion.value}
{else}
{html_options options=$fields.inversion.options selected=$fields.inversion.default}
{/if}
</select>
<input
id="{$fields.inversion.name}-input"
name="{$fields.inversion.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.inversion.name}-image"></button><button type="button"
id="btn-clear-{$fields.inversion.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.inversion.name}-input', '{$fields.inversion.name}');sync_{$fields.inversion.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.inversion.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.inversion.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.inversion.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.inversion.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.inversion.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.inversion.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.inversion.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.inversion.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.inversion.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.inversion.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='recursos_propios_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RECURSOS_PROPIOS' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.recursos_propios.name}" 
id="{$fields.recursos_propios.name}" 
title=''       
>
{if isset($fields.recursos_propios.value) && $fields.recursos_propios.value != ''}
{html_options options=$fields.recursos_propios.options selected=$fields.recursos_propios.value}
{else}
{html_options options=$fields.recursos_propios.options selected=$fields.recursos_propios.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.recursos_propios.options }
{capture name="field_val"}{$fields.recursos_propios.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.recursos_propios.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.recursos_propios.name}" 
id="{$fields.recursos_propios.name}" 
title=''          
>
{if isset($fields.recursos_propios.value) && $fields.recursos_propios.value != ''}
{html_options options=$fields.recursos_propios.options selected=$fields.recursos_propios.value}
{else}
{html_options options=$fields.recursos_propios.options selected=$fields.recursos_propios.default}
{/if}
</select>
<input
id="{$fields.recursos_propios.name}-input"
name="{$fields.recursos_propios.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.recursos_propios.name}-image"></button><button type="button"
id="btn-clear-{$fields.recursos_propios.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.recursos_propios.name}-input', '{$fields.recursos_propios.name}');sync_{$fields.recursos_propios.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.recursos_propios.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.recursos_propios.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.recursos_propios.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.recursos_propios.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.recursos_propios.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.recursos_propios.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.recursos_propios.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.recursos_propios.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.recursos_propios.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.recursos_propios.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='observaciones_informe_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_INFORME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Añadir <b>SOLO</b> informacion que aporte valor al franquiciador" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.observaciones_informe.value)}
{assign var="value" value=$fields.observaciones_informe.default_value }
{else}
{assign var="value" value=$fields.observaciones_informe.value }
{/if}  
<textarea  id='{$fields.observaciones_informe.name}' name='{$fields.observaciones_informe.name}'
rows="20" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='observaciones_descarte_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_DESCARTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.observaciones_descarte.value)}
{assign var="value" value=$fields.observaciones_descarte.default_value }
{else}
{assign var="value" value=$fields.observaciones_descarte.value }
{/if}  
<textarea  id='{$fields.observaciones_descarte.name}' name='{$fields.observaciones_descarte.name}'
rows="10" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='tipo_origen_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPO_ORIGEN' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.tipo_origen.name}" 
id="{$fields.tipo_origen.name}" 
title=''       
onchange="mostrarSuborigen();">
{if isset($fields.tipo_origen.value) && $fields.tipo_origen.value != ''}
{html_options options=$fields.tipo_origen.options selected=$fields.tipo_origen.value}
{else}
{html_options options=$fields.tipo_origen.options selected=$fields.tipo_origen.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.tipo_origen.options }
{capture name="field_val"}{$fields.tipo_origen.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.tipo_origen.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.tipo_origen.name}" 
id="{$fields.tipo_origen.name}" 
title=''          
onchange="mostrarSuborigen();">
{if isset($fields.tipo_origen.value) && $fields.tipo_origen.value != ''}
{html_options options=$fields.tipo_origen.options selected=$fields.tipo_origen.value}
{else}
{html_options options=$fields.tipo_origen.options selected=$fields.tipo_origen.default}
{/if}
</select>
<input
id="{$fields.tipo_origen.name}-input"
name="{$fields.tipo_origen.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.tipo_origen.name}-image"></button><button type="button"
id="btn-clear-{$fields.tipo_origen.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.tipo_origen.name}-input', '{$fields.tipo_origen.name}');sync_{$fields.tipo_origen.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.tipo_origen.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.tipo_origen.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.tipo_origen.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.tipo_origen.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.tipo_origen.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.tipo_origen.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.tipo_origen.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.tipo_origen.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.tipo_origen.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.tipo_origen.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='portal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PORTAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.portal.name}" 
id="{$fields.portal.name}" 
title=''       
>
{if isset($fields.portal.value) && $fields.portal.value != ''}
{html_options options=$fields.portal.options selected=$fields.portal.value}
{else}
{html_options options=$fields.portal.options selected=$fields.portal.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.portal.options }
{capture name="field_val"}{$fields.portal.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.portal.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.portal.name}" 
id="{$fields.portal.name}" 
title=''          
>
{if isset($fields.portal.value) && $fields.portal.value != ''}
{html_options options=$fields.portal.options selected=$fields.portal.value}
{else}
{html_options options=$fields.portal.options selected=$fields.portal.default}
{/if}
</select>
<input
id="{$fields.portal.name}-input"
name="{$fields.portal.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.portal.name}-image"></button><button type="button"
id="btn-clear-{$fields.portal.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.portal.name}-input', '{$fields.portal.name}');sync_{$fields.portal.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.portal.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.portal.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.portal.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.portal.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.portal.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.portal.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.portal.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.portal.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.portal.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.portal.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='subor_medios_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_MEDIOS' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.subor_medios.name}" 
id="{$fields.subor_medios.name}" 
title=''       
>
{if isset($fields.subor_medios.value) && $fields.subor_medios.value != ''}
{html_options options=$fields.subor_medios.options selected=$fields.subor_medios.value}
{else}
{html_options options=$fields.subor_medios.options selected=$fields.subor_medios.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.subor_medios.options }
{capture name="field_val"}{$fields.subor_medios.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.subor_medios.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.subor_medios.name}" 
id="{$fields.subor_medios.name}" 
title=''          
>
{if isset($fields.subor_medios.value) && $fields.subor_medios.value != ''}
{html_options options=$fields.subor_medios.options selected=$fields.subor_medios.value}
{else}
{html_options options=$fields.subor_medios.options selected=$fields.subor_medios.default}
{/if}
</select>
<input
id="{$fields.subor_medios.name}-input"
name="{$fields.subor_medios.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.subor_medios.name}-image"></button><button type="button"
id="btn-clear-{$fields.subor_medios.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.subor_medios.name}-input', '{$fields.subor_medios.name}');sync_{$fields.subor_medios.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.subor_medios.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.subor_medios.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.subor_medios.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.subor_medios.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.subor_medios.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.subor_medios.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.subor_medios.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.subor_medios.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.subor_medios.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.subor_medios.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='subor_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.subor_central.name}" 
id="{$fields.subor_central.name}" 
title=''       
>
{if isset($fields.subor_central.value) && $fields.subor_central.value != ''}
{html_options options=$fields.subor_central.options selected=$fields.subor_central.value}
{else}
{html_options options=$fields.subor_central.options selected=$fields.subor_central.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.subor_central.options }
{capture name="field_val"}{$fields.subor_central.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.subor_central.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.subor_central.name}" 
id="{$fields.subor_central.name}" 
title=''          
>
{if isset($fields.subor_central.value) && $fields.subor_central.value != ''}
{html_options options=$fields.subor_central.options selected=$fields.subor_central.value}
{else}
{html_options options=$fields.subor_central.options selected=$fields.subor_central.default}
{/if}
</select>
<input
id="{$fields.subor_central.name}-input"
name="{$fields.subor_central.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.subor_central.name}-image"></button><button type="button"
id="btn-clear-{$fields.subor_central.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.subor_central.name}-input', '{$fields.subor_central.name}');sync_{$fields.subor_central.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.subor_central.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.subor_central.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.subor_central.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.subor_central.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.subor_central.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.subor_central.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.subor_central.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.subor_central.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.subor_central.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.subor_central.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='subor_expande_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_EXPANDE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.subor_expande.name}" 
id="{$fields.subor_expande.name}" 
title=''       
>
{if isset($fields.subor_expande.value) && $fields.subor_expande.value != ''}
{html_options options=$fields.subor_expande.options selected=$fields.subor_expande.value}
{else}
{html_options options=$fields.subor_expande.options selected=$fields.subor_expande.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.subor_expande.options }
{capture name="field_val"}{$fields.subor_expande.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.subor_expande.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.subor_expande.name}" 
id="{$fields.subor_expande.name}" 
title=''          
>
{if isset($fields.subor_expande.value) && $fields.subor_expande.value != ''}
{html_options options=$fields.subor_expande.options selected=$fields.subor_expande.value}
{else}
{html_options options=$fields.subor_expande.options selected=$fields.subor_expande.default}
{/if}
</select>
<input
id="{$fields.subor_expande.name}-input"
name="{$fields.subor_expande.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.subor_expande.name}-image"></button><button type="button"
id="btn-clear-{$fields.subor_expande.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.subor_expande.name}-input', '{$fields.subor_expande.name}');sync_{$fields.subor_expande.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.subor_expande.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.subor_expande.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.subor_expande.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.subor_expande.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.subor_expande.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.subor_expande.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.subor_expande.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.subor_expande.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.subor_expande.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.subor_expande.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='subor_mailing_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_MAILING' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.subor_mailing.name}" 
id="{$fields.subor_mailing.name}" 
title=''       
>
{if isset($fields.subor_mailing.value) && $fields.subor_mailing.value != ''}
{html_options options=$fields.subor_mailing.options selected=$fields.subor_mailing.value}
{else}
{html_options options=$fields.subor_mailing.options selected=$fields.subor_mailing.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.subor_mailing.options }
{capture name="field_val"}{$fields.subor_mailing.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.subor_mailing.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.subor_mailing.name}" 
id="{$fields.subor_mailing.name}" 
title=''          
>
{if isset($fields.subor_mailing.value) && $fields.subor_mailing.value != ''}
{html_options options=$fields.subor_mailing.options selected=$fields.subor_mailing.value}
{else}
{html_options options=$fields.subor_mailing.options selected=$fields.subor_mailing.default}
{/if}
</select>
<input
id="{$fields.subor_mailing.name}-input"
name="{$fields.subor_mailing.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.subor_mailing.name}-image"></button><button type="button"
id="btn-clear-{$fields.subor_mailing.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.subor_mailing.name}-input', '{$fields.subor_mailing.name}');sync_{$fields.subor_mailing.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.subor_mailing.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.subor_mailing.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.subor_mailing.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.subor_mailing.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.subor_mailing.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.subor_mailing.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.subor_mailing.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.subor_mailing.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.subor_mailing.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.subor_mailing.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='modelosDeNegocio_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<p id="ModelosDeNegocio"><u><b>Modelos de negocio: </b></u><span class="required">*</span></p>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='tiponegocio1_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPONEG1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio1.value) == "1" || strval($fields.tiponegocio1.value) == "yes" || strval($fields.tiponegocio1.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.tiponegocio1.name}" value="0"> 
<input type="checkbox" id="{$fields.tiponegocio1.name}" 
name="{$fields.tiponegocio1.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg11_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG11' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg11.value) == "1" || strval($fields.chkvalNeg11.value) == "yes" || strval($fields.chkvalNeg11.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg11.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg11.name}" 
name="{$fields.chkvalNeg11.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg12_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG12' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg12.value) == "1" || strval($fields.chkvalNeg12.value) == "yes" || strval($fields.chkvalNeg12.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg12.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg12.name}" 
name="{$fields.chkvalNeg12.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg13_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG13' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg13.value) == "1" || strval($fields.chkvalNeg13.value) == "yes" || strval($fields.chkvalNeg13.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg13.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg13.name}" 
name="{$fields.chkvalNeg13.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg14_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG14' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg14.value) == "1" || strval($fields.chkvalNeg14.value) == "yes" || strval($fields.chkvalNeg14.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg14.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg14.name}" 
name="{$fields.chkvalNeg14.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg15_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG15' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg15.value) == "1" || strval($fields.chkvalNeg15.value) == "yes" || strval($fields.chkvalNeg15.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg15.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg15.name}" 
name="{$fields.chkvalNeg15.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='tiponegocio2_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPONEG2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio2.value) == "1" || strval($fields.tiponegocio2.value) == "yes" || strval($fields.tiponegocio2.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.tiponegocio2.name}" value="0"> 
<input type="checkbox" id="{$fields.tiponegocio2.name}" 
name="{$fields.tiponegocio2.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg21_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG21' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg21.value) == "1" || strval($fields.chkvalNeg21.value) == "yes" || strval($fields.chkvalNeg21.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg21.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg21.name}" 
name="{$fields.chkvalNeg21.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg22_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG22' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg22.value) == "1" || strval($fields.chkvalNeg22.value) == "yes" || strval($fields.chkvalNeg22.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg22.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg22.name}" 
name="{$fields.chkvalNeg22.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg23_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG23' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg23.value) == "1" || strval($fields.chkvalNeg23.value) == "yes" || strval($fields.chkvalNeg23.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg23.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg23.name}" 
name="{$fields.chkvalNeg23.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg24_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG24' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg24.value) == "1" || strval($fields.chkvalNeg24.value) == "yes" || strval($fields.chkvalNeg24.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg24.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg24.name}" 
name="{$fields.chkvalNeg24.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg25_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG25' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg25.value) == "1" || strval($fields.chkvalNeg25.value) == "yes" || strval($fields.chkvalNeg25.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg25.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg25.name}" 
name="{$fields.chkvalNeg25.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='tiponegocio3_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPONEG3' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio3.value) == "1" || strval($fields.tiponegocio3.value) == "yes" || strval($fields.tiponegocio3.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.tiponegocio3.name}" value="0"> 
<input type="checkbox" id="{$fields.tiponegocio3.name}" 
name="{$fields.tiponegocio3.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg31_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG31' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg31.value) == "1" || strval($fields.chkvalNeg31.value) == "yes" || strval($fields.chkvalNeg31.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg31.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg31.name}" 
name="{$fields.chkvalNeg31.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg32_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG32' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg32.value) == "1" || strval($fields.chkvalNeg32.value) == "yes" || strval($fields.chkvalNeg32.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg32.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg32.name}" 
name="{$fields.chkvalNeg32.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg33_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG33' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg33.value) == "1" || strval($fields.chkvalNeg33.value) == "yes" || strval($fields.chkvalNeg33.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg33.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg33.name}" 
name="{$fields.chkvalNeg33.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg34_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG34' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg34.value) == "1" || strval($fields.chkvalNeg34.value) == "yes" || strval($fields.chkvalNeg34.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg34.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg34.name}" 
name="{$fields.chkvalNeg34.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg35_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG35' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg35.value) == "1" || strval($fields.chkvalNeg35.value) == "yes" || strval($fields.chkvalNeg35.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg35.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg35.name}" 
name="{$fields.chkvalNeg35.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='tiponegocio4_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPONEG4' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.tiponegocio4.value) == "1" || strval($fields.tiponegocio4.value) == "yes" || strval($fields.tiponegocio4.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.tiponegocio4.name}" value="0"> 
<input type="checkbox" id="{$fields.tiponegocio4.name}" 
name="{$fields.tiponegocio4.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg41_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG41' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg41.value) == "1" || strval($fields.chkvalNeg41.value) == "yes" || strval($fields.chkvalNeg41.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg41.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg41.name}" 
name="{$fields.chkvalNeg41.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg42_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG42' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg42.value) == "1" || strval($fields.chkvalNeg42.value) == "yes" || strval($fields.chkvalNeg42.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg42.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg42.name}" 
name="{$fields.chkvalNeg42.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg43_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG43' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg43.value) == "1" || strval($fields.chkvalNeg43.value) == "yes" || strval($fields.chkvalNeg43.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg43.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg43.name}" 
name="{$fields.chkvalNeg43.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='chkvalNeg44_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG44' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg44.value) == "1" || strval($fields.chkvalNeg44.value) == "yes" || strval($fields.chkvalNeg44.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg44.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg44.name}" 
name="{$fields.chkvalNeg44.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='chkvalNeg45_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CHKVALNEG45' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strval($fields.chkvalNeg45.value) == "1" || strval($fields.chkvalNeg45.value) == "yes" || strval($fields.chkvalNeg45.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.chkvalNeg45.name}" value="0"> 
<input type="checkbox" id="{$fields.chkvalNeg45.name}" 
name="{$fields.chkvalNeg45.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='expan_evento_id_c_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_EVENTO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.expan_evento_id_c.name}" 
id="{$fields.expan_evento_id_c.name}" 
title=''       
>
{if isset($fields.expan_evento_id_c.value) && $fields.expan_evento_id_c.value != ''}
{html_options options=$fields.expan_evento_id_c.options selected=$fields.expan_evento_id_c.value}
{else}
{html_options options=$fields.expan_evento_id_c.options selected=$fields.expan_evento_id_c.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.expan_evento_id_c.options }
{capture name="field_val"}{$fields.expan_evento_id_c.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.expan_evento_id_c.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.expan_evento_id_c.name}" 
id="{$fields.expan_evento_id_c.name}" 
title=''          
>
{if isset($fields.expan_evento_id_c.value) && $fields.expan_evento_id_c.value != ''}
{html_options options=$fields.expan_evento_id_c.options selected=$fields.expan_evento_id_c.value}
{else}
{html_options options=$fields.expan_evento_id_c.options selected=$fields.expan_evento_id_c.default}
{/if}
</select>
<input
id="{$fields.expan_evento_id_c.name}-input"
name="{$fields.expan_evento_id_c.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.expan_evento_id_c.name}-image"></button><button type="button"
id="btn-clear-{$fields.expan_evento_id_c.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.expan_evento_id_c.name}-input', '{$fields.expan_evento_id_c.name}');sync_{$fields.expan_evento_id_c.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.expan_evento_id_c.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.expan_evento_id_c.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.expan_evento_id_c.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.expan_evento_id_c.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.expan_evento_id_c.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.expan_evento_id_c.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.expan_evento_id_c.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.expan_evento_id_c.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.expan_evento_id_c.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.expan_evento_id_c.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='assigned_user_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.assigned_user_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.assigned_user_name.name}" size="" value="{$fields.assigned_user_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.assigned_user_name.id_name}" 
id="{$fields.assigned_user_name.id_name}" 
value="{$fields.assigned_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.assigned_user_name.name}" id="btn_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.assigned_user_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.assigned_user_name.name}" id="btn_clr_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.assigned_user_name.name}', '{$fields.assigned_user_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.assigned_user_name.name}']) != 'undefined'",
		enableQS
);
</script>
<td valign="top" id='lnk_cuestionario_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CUESTIONARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="No editar el cuestionario aquellos datos que ya se recojen en el CRM" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.lnk_cuestionario.value)}
{assign var="value" value=$fields.lnk_cuestionario.default_value }
{else}
{assign var="value" value=$fields.lnk_cuestionario.value }
{/if}  
<textarea  id='{$fields.lnk_cuestionario.name}' name='{$fields.lnk_cuestionario.name}'
rows="4" 
cols="60" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_modneg1_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_modneg1" id="temp_modneg1" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg1;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg11_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg11" id="temp_valNeg11" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg11;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg12_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg12" id="temp_valNeg12" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg12;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg13_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg13" id="temp_valNeg13" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg13;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg14_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg14" id="temp_valNeg14" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg14;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg15_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg15" id="temp_valNeg15" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg15;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_modneg2_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_modneg2" id="temp_modneg2" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg2;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg21_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg21" id="temp_valNeg21" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg21;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg22_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg22" id="temp_valNeg22" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg22;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg23_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg23" id="temp_valNeg23" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg23;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg24_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg24" id="temp_valNeg24" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg24;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg25_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg25" id="temp_valNeg25" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg25;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_modneg3_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas3' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_modneg3" id="temp_modneg3" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg3;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg31_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg31" id="temp_valNeg31" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg31;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg32_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg32" id="temp_valNeg32" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg32;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg33_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg33" id="temp_valNeg33" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg33;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg34_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg34" id="temp_valNeg34" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg34;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg35_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg35" id="temp_valNeg35" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg35;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_modneg4_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas4' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_modneg4" id="temp_modneg4" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg4;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg41_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg41" id="temp_valNeg41" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg41;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg42_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg42" id="temp_valNeg42" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg42;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg43_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg43" id="temp_valNeg43" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg43;
{/php}" title="" tabindex="0" size="11" maxlength="10">
<td valign="top" id='temp_valNeg44_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg44" id="temp_valNeg44" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg44;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='temp_valNeg45_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Pruebas' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  class="date_input"  type="text" name="temp_valNeg45" id="temp_valNeg45" value="{php}
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->valNeg45;
{/php}" title="" tabindex="0" size="11" maxlength="10">
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='modified_by_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MODIFICADO_POR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.modified_by_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.modified_by_name.name}" size="" value="{$fields.modified_by_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.modified_by_name.id_name}" 
id="{$fields.modified_by_name.id_name}" 
value="{$fields.modified_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.modified_by_name.name}" id="btn_{$fields.modified_by_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.modified_by_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"modified_user_id","user_name":"modified_by_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.modified_by_name.name}" id="btn_clr_{$fields.modified_by_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.modified_by_name.name}', '{$fields.modified_by_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.modified_by_name.name}']) != 'undefined'",
		enableQS
);
</script>
<td valign="top" id='perfil_ideoneo_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PERFIL_IDONEO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.perfil_ideoneo.name}" 
id="{$fields.perfil_ideoneo.name}" 
title=''       
>
{if isset($fields.perfil_ideoneo.value) && $fields.perfil_ideoneo.value != ''}
{html_options options=$fields.perfil_ideoneo.options selected=$fields.perfil_ideoneo.value}
{else}
{html_options options=$fields.perfil_ideoneo.options selected=$fields.perfil_ideoneo.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.perfil_ideoneo.options }
{capture name="field_val"}{$fields.perfil_ideoneo.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.perfil_ideoneo.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.perfil_ideoneo.name}" 
id="{$fields.perfil_ideoneo.name}" 
title=''          
>
{if isset($fields.perfil_ideoneo.value) && $fields.perfil_ideoneo.value != ''}
{html_options options=$fields.perfil_ideoneo.options selected=$fields.perfil_ideoneo.value}
{else}
{html_options options=$fields.perfil_ideoneo.options selected=$fields.perfil_ideoneo.default}
{/if}
</select>
<input
id="{$fields.perfil_ideoneo.name}-input"
name="{$fields.perfil_ideoneo.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.perfil_ideoneo.name}-image"></button><button type="button"
id="btn-clear-{$fields.perfil_ideoneo.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.perfil_ideoneo.name}-input', '{$fields.perfil_ideoneo.name}');sync_{$fields.perfil_ideoneo.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.perfil_ideoneo.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.perfil_ideoneo.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.perfil_ideoneo.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.perfil_ideoneo.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.perfil_ideoneo.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.perfil_ideoneo.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.perfil_ideoneo.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.perfil_ideoneo.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.perfil_ideoneo.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.perfil_ideoneo.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='otras_preguntas_formulario_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OTRAS_PREGUNTAS_FORMULARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion recogida del cuestionario que da respuestas específicas sobre la enseña (no hay campos específicos en el CRM)" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.otras_preguntas_formulario.value)}
{assign var="value" value=$fields.otras_preguntas_formulario.default_value }
{else}
{assign var="value" value=$fields.otras_preguntas_formulario.value }
{/if}  
<textarea  id='{$fields.otras_preguntas_formulario.name}' name='{$fields.otras_preguntas_formulario.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
</div>    <div id='tabcontent1'>
<div id="detailpanel_2" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_EDITVIEW_OBSERVACIONES'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='preguntas_mn_t_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PREGUNTAS_MN_T' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Preguntas realizadas por el solicitante sobre el modelo de negocio o técnicas de la actividad en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.preguntas_mn_t.value)}
{assign var="value" value=$fields.preguntas_mn_t.default_value }
{else}
{assign var="value" value=$fields.preguntas_mn_t.value }
{/if}  
<textarea  id='{$fields.preguntas_mn_t.name}' name='{$fields.preguntas_mn_t.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='objeciones_mn_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBJECIONES_MN' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Objeciones sobre el modelo de negocio por el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.objeciones_mn.value)}
{assign var="value" value=$fields.objeciones_mn.default_value }
{else}
{assign var="value" value=$fields.objeciones_mn.value }
{/if}  
<textarea  id='{$fields.objeciones_mn.name}' name='{$fields.objeciones_mn.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='solicitudes_candidato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SOLICITUDES_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solicitudes realizadas por el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.solicitudes_candidato.value)}
{assign var="value" value=$fields.solicitudes_candidato.default_value }
{else}
{assign var="value" value=$fields.solicitudes_candidato.value }
{/if}  
<textarea  id='{$fields.solicitudes_candidato.name}' name='{$fields.solicitudes_candidato.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='concesiones_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONCESIONES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.concesiones.value)}
{assign var="value" value=$fields.concesiones.default_value }
{else}
{assign var="value" value=$fields.concesiones.value }
{/if}  
<textarea  id='{$fields.concesiones.name}' name='{$fields.concesiones.name}'
rows="10" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='informacion_competencia_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_COMPETENCIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion de la compatencia que nos proporciona el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.informacion_competencia.value)}
{assign var="value" value=$fields.informacion_competencia.default_value }
{else}
{assign var="value" value=$fields.informacion_competencia.value }
{/if}  
<textarea  id='{$fields.informacion_competencia.name}' name='{$fields.informacion_competencia.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='informacion_proveedores_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_INFORMACION_PROVEEDORES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Informacion de proveedores que nos proporciona el solicitante en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.informacion_proveedores.value)}
{assign var="value" value=$fields.informacion_proveedores.default_value }
{else}
{assign var="value" value=$fields.informacion_proveedores.value }
{/if}  
<textarea  id='{$fields.informacion_proveedores.name}' name='{$fields.informacion_proveedores.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='---------------------------------' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
-----------------------------------------------------------------------------------------------------------------------------
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='---------------------------------' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
-----------------------------------------------------------------------------------------------------------------------------
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='preg_en_central_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PREG_EN_CENTRAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.preg_en_central.value)}
{assign var="value" value=$fields.preg_en_central.default_value }
{else}
{assign var="value" value=$fields.preg_en_central.value }
{/if}  
<textarea  id='{$fields.preg_en_central.name}' name='{$fields.preg_en_central.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='mejoras_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MEJORAS' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Mejoras a implementar detectadas en las conversaciones mantenidas" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.mejoras.value)}
{assign var="value" value=$fields.mejoras.default_value }
{else}
{assign var="value" value=$fields.mejoras.value }
{/if}  
<textarea  id='{$fields.mejoras.name}' name='{$fields.mejoras.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='notas_argumentario_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NOTAS_ARGUMENTARIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Información recogida del franquiciador" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.notas_argumentario.value)}
{assign var="value" value=$fields.notas_argumentario.default_value }
{else}
{assign var="value" value=$fields.notas_argumentario.value }
{/if}  
<textarea  id='{$fields.notas_argumentario.name}' name='{$fields.notas_argumentario.name}'
rows="15" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_OBSERVACIONES").style.display='none';</script>
{/if}
</div>    <div id='tabcontent2'>
<div id="detailpanel_3" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_IIT'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_validado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_VALIDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.iit_validado.value) == "1" || strval($fields.iit_validado.value) == "yes" || strval($fields.iit_validado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.iit_validado.name}" value="0"> 
<input type="checkbox" id="{$fields.iit_validado.name}" 
name="{$fields.iit_validado.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONSULTOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_zona_implantacion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ZONA_IMPLANTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_zona_implantacion.value) <= 0}
{assign var="value" value=$fields.iit_zona_implantacion.default_value }
{else}
{assign var="value" value=$fields.iit_zona_implantacion.value }
{/if}  
<input type='text' name='{$fields.iit_zona_implantacion.name}' 
id='{$fields.iit_zona_implantacion.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='iit_acuerdo_exclusividad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ACUERDO_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_acuerdo_exclusividad.value) <= 0}
{assign var="value" value=$fields.iit_acuerdo_exclusividad.default_value }
{else}
{assign var="value" value=$fields.iit_acuerdo_exclusividad.value }
{/if}  
<input type='text' name='{$fields.iit_acuerdo_exclusividad.name}' 
id='{$fields.iit_acuerdo_exclusividad.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_aporta_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_APORTA_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_aporta_local.value) <= 0}
{assign var="value" value=$fields.iit_aporta_local.default_value }
{else}
{assign var="value" value=$fields.iit_aporta_local.value }
{/if}  
<input type='text' name='{$fields.iit_aporta_local.name}' 
id='{$fields.iit_aporta_local.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='iit_acuerdo_economico_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ACUERDO_ECONOMICO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_acuerdo_economico.value) <= 0}
{assign var="value" value=$fields.iit_acuerdo_economico.default_value }
{else}
{assign var="value" value=$fields.iit_acuerdo_economico.value }
{/if}  
<input type='text' name='{$fields.iit_acuerdo_economico.name}' 
id='{$fields.iit_acuerdo_economico.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_direccion_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_DIRECCION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_direccion_local.value) <= 0}
{assign var="value" value=$fields.iit_direccion_local.default_value }
{else}
{assign var="value" value=$fields.iit_direccion_local.value }
{/if}  
<input type='text' name='{$fields.iit_direccion_local.name}' 
id='{$fields.iit_direccion_local.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CRM' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_localidad_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_LOCALIDAD_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_localidad_local.value) <= 0}
{assign var="value" value=$fields.iit_localidad_local.default_value }
{else}
{assign var="value" value=$fields.iit_localidad_local.value }
{/if}  
<input type='text' name='{$fields.iit_localidad_local.name}' 
id='{$fields.iit_localidad_local.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='iit_inversion_inicial_est_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_INVER_INICIAL_EST' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_inversion_inicial_est.value) <= 0}
{assign var="value" value=$fields.iit_inversion_inicial_est.default_value }
{else}
{assign var="value" value=$fields.iit_inversion_inicial_est.value }
{/if}  
<input type='text' name='{$fields.iit_inversion_inicial_est.name}' 
id='{$fields.iit_inversion_inicial_est.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_superficie_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_local.value }
{/if}  
<input type='text' name='{$fields.iit_superficie_local.name}' 
id='{$fields.iit_superficie_local.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='iit_canon_entrada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_canon_entrada.value) <= 0}
{assign var="value" value=$fields.iit_canon_entrada.default_value }
{else}
{assign var="value" value=$fields.iit_canon_entrada.value }
{/if}  
<input type='text' name='{$fields.iit_canon_entrada.name}' 
id='{$fields.iit_canon_entrada.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_superficie_escapa_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_ESCAPA_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_escapa_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_escapa_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_escapa_local.value }
{/if}  
<input type='text' name='{$fields.iit_superficie_escapa_local.name}' 
id='{$fields.iit_superficie_escapa_local.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='iit_royalty_explota_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_royalty_explota.value) <= 0}
{assign var="value" value=$fields.iit_royalty_explota.default_value }
{else}
{assign var="value" value=$fields.iit_royalty_explota.value }
{/if}  
<input type='text' name='{$fields.iit_royalty_explota.name}' 
id='{$fields.iit_royalty_explota.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_superficie_almacen_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_SUPERFICIE_ALMACEN_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_superficie_almacen_local.value) <= 0}
{assign var="value" value=$fields.iit_superficie_almacen_local.default_value }
{else}
{assign var="value" value=$fields.iit_superficie_almacen_local.value }
{/if}  
<input type='text' name='{$fields.iit_superficie_almacen_local.name}' 
id='{$fields.iit_superficie_almacen_local.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='iit_royalty_mkt_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_ROYALTY_MKT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_royalty_mkt.value) <= 0}
{assign var="value" value=$fields.iit_royalty_mkt.default_value }
{else}
{assign var="value" value=$fields.iit_royalty_mkt.value }
{/if}  
<input type='text' name='{$fields.iit_royalty_mkt.name}' 
id='{$fields.iit_royalty_mkt.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_instalaciones_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_INSTALACIONES_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_instalaciones_local.value) <= 0}
{assign var="value" value=$fields.iit_instalaciones_local.default_value }
{else}
{assign var="value" value=$fields.iit_instalaciones_local.value }
{/if}  
<input type='text' name='{$fields.iit_instalaciones_local.name}' 
id='{$fields.iit_instalaciones_local.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='iit_duracion_contrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_DURACION_CONTRAT0' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_duracion_contrato.value) <= 0}
{assign var="value" value=$fields.iit_duracion_contrato.default_value }
{else}
{assign var="value" value=$fields.iit_duracion_contrato.value }
{/if}  
<input type='text' name='{$fields.iit_duracion_contrato.name}' 
id='{$fields.iit_duracion_contrato.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_visitado_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_VISITADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_visitado_local.value) <= 0}
{assign var="value" value=$fields.iit_visitado_local.default_value }
{else}
{assign var="value" value=$fields.iit_visitado_local.value }
{/if}  
<input type='text' name='{$fields.iit_visitado_local.name}' 
id='{$fields.iit_visitado_local.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
<td valign="top" id='iit_year_renovado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_YEAR_RENOVADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_year_renovado.value) <= 0}
{assign var="value" value=$fields.iit_year_renovado.default_value }
{else}
{assign var="value" value=$fields.iit_year_renovado.value }
{/if}  
<input type='text' name='{$fields.iit_year_renovado.name}' 
id='{$fields.iit_year_renovado.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_aprobado_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_APROBADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_aprobado_local.value) <= 0}
{assign var="value" value=$fields.iit_aprobado_local.default_value }
{else}
{assign var="value" value=$fields.iit_aprobado_local.value }
{/if}  
<input type='text' name='{$fields.iit_aprobado_local.name}' 
id='{$fields.iit_aprobado_local.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
<td valign="top" id='iit_max_estableci_zona_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_MAX_ESTABLECI_ZONA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_max_estableci_zona.value) <= 0}
{assign var="value" value=$fields.iit_max_estableci_zona.default_value }
{else}
{assign var="value" value=$fields.iit_max_estableci_zona.value }
{/if}  
<input type='text' name='{$fields.iit_max_estableci_zona.name}' 
id='{$fields.iit_max_estableci_zona.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_mod_neg_recomendado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IIT_MOD_NEG_RECOMENDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_mod_neg_recomendado.value) <= 0}
{assign var="value" value=$fields.iit_mod_neg_recomendado.default_value }
{else}
{assign var="value" value=$fields.iit_mod_neg_recomendado.value }
{/if}  
<input type='text' name='{$fields.iit_mod_neg_recomendado.name}' 
id='{$fields.iit_mod_neg_recomendado.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='iit_localidad_recomendado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_RECOMENDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.iit_localidad_recomendado.value) <= 0}
{assign var="value" value=$fields.iit_localidad_recomendado.default_value }
{else}
{assign var="value" value=$fields.iit_localidad_recomendado.value }
{/if}  
<input type='text' name='{$fields.iit_localidad_recomendado.name}' 
id='{$fields.iit_localidad_recomendado.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_IIT").style.display='none';</script>
{/if}
</div>    <div id='tabcontent3'>
<div id="detailpanel_4" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_PRECONTRATO'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='estado_precontrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ESTADO_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.estado_precontrato.name}" 
id="{$fields.estado_precontrato.name}" 
title=''       
>
{if isset($fields.estado_precontrato.value) && $fields.estado_precontrato.value != ''}
{html_options options=$fields.estado_precontrato.options selected=$fields.estado_precontrato.value}
{else}
{html_options options=$fields.estado_precontrato.options selected=$fields.estado_precontrato.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.estado_precontrato.options }
{capture name="field_val"}{$fields.estado_precontrato.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.estado_precontrato.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.estado_precontrato.name}" 
id="{$fields.estado_precontrato.name}" 
title=''          
>
{if isset($fields.estado_precontrato.value) && $fields.estado_precontrato.value != ''}
{html_options options=$fields.estado_precontrato.options selected=$fields.estado_precontrato.value}
{else}
{html_options options=$fields.estado_precontrato.options selected=$fields.estado_precontrato.default}
{/if}
</select>
<input
id="{$fields.estado_precontrato.name}-input"
name="{$fields.estado_precontrato.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.estado_precontrato.name}-image"></button><button type="button"
id="btn-clear-{$fields.estado_precontrato.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.estado_precontrato.name}-input', '{$fields.estado_precontrato.name}');sync_{$fields.estado_precontrato.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.estado_precontrato.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.estado_precontrato.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.estado_precontrato.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.estado_precontrato.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.estado_precontrato.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.estado_precontrato.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.estado_precontrato.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.estado_precontrato.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.estado_precontrato.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.estado_precontrato.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_fir1_first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_first_name.value) <= 0}
{assign var="value" value=$fields.pre_fir1_first_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_first_name.value }
{/if}  
<input type='text' name='{$fields.pre_fir1_first_name.name}' 
id='{$fields.pre_fir1_first_name.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='pre_fir2_first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_first_name.value) <= 0}
{assign var="value" value=$fields.pre_fir2_first_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_first_name.value }
{/if}  
<input type='text' name='{$fields.pre_fir2_first_name.name}' 
id='{$fields.pre_fir2_first_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_fir1_last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_last_name.value) <= 0}
{assign var="value" value=$fields.pre_fir1_last_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_last_name.value }
{/if}  
<input type='text' name='{$fields.pre_fir1_last_name.name}' 
id='{$fields.pre_fir1_last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='pre_fir2_last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.pre_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_last_name.value }
{/if}  
<input type='text' name='{$fields.pre_fir2_last_name.name}' 
id='{$fields.pre_fir2_last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_fir1_NIF_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_NIF.value) <= 0}
{assign var="value" value=$fields.pre_fir1_NIF.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_NIF.value }
{/if}  
<input type='text' name='{$fields.pre_fir1_NIF.name}' 
id='{$fields.pre_fir1_NIF.name}' size='30' 
maxlength='20' 
value='{$value}' title=''      >
<td valign="top" id='pre_fir2_NIF_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_NIF.value) <= 0}
{assign var="value" value=$fields.pre_fir2_NIF.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_NIF.value }
{/if}  
<input type='text' name='{$fields.pre_fir2_NIF.name}' 
id='{$fields.pre_fir2_NIF.name}' size='30' 
maxlength='20' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_fir1_vecino_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_vecino.value) <= 0}
{assign var="value" value=$fields.pre_fir1_vecino.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_vecino.value }
{/if}  
<input type='text' name='{$fields.pre_fir1_vecino.name}' 
id='{$fields.pre_fir1_vecino.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='pre_fir2_vecino_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_vecino.value) <= 0}
{assign var="value" value=$fields.pre_fir2_vecino.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_vecino.value }
{/if}  
<input type='text' name='{$fields.pre_fir2_vecino.name}' 
id='{$fields.pre_fir2_vecino.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_fir1_domicilio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir1_domicilio.value) <= 0}
{assign var="value" value=$fields.pre_fir1_domicilio.default_value }
{else}
{assign var="value" value=$fields.pre_fir1_domicilio.value }
{/if}  
<input type='text' name='{$fields.pre_fir1_domicilio.name}' 
id='{$fields.pre_fir1_domicilio.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='pre_fir2_domicilio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pre_fir2_domicilio.value) <= 0}
{assign var="value" value=$fields.pre_fir2_domicilio.default_value }
{else}
{assign var="value" value=$fields.pre_fir2_domicilio.value }
{/if}  
<input type='text' name='{$fields.pre_fir2_domicilio.name}' 
id='{$fields.pre_fir2_domicilio.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_UBICACION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pre_num_unidades_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PRE_NUM_UNIDADES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.num_empleados.value) <= 0}
{assign var="value" value=$fields.num_empleados.default_value }
{else}
{assign var="value" value=$fields.num_empleados.value }
{/if}  
<input type='text' name='{$fields.num_empleados.name}' 
id='{$fields.num_empleados.name}' size='30' maxlength='10' value='{sugar_number_format precision=0 var=$value}' title='' tabindex='0'    >
<td valign="top" id='fecha_precontrato_minima_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_PRECONTRATO_MINIMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.fecha_precontrato_minima.value) <= 0}
{assign var="value" value=$fields.fecha_precontrato_minima.default_value }
{else}
{assign var="value" value=$fields.fecha_precontrato_minima.value }
{/if}  
<input type='text' name='{$fields.fecha_precontrato_minima.name}' 
id='{$fields.fecha_precontrato_minima.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='provincia_apertura_pre_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.provincia_apertura_pre.name}" 
id="{$fields.provincia_apertura_pre.name}" 
title=''       
>
{if isset($fields.provincia_apertura_pre.value) && $fields.provincia_apertura_pre.value != ''}
{html_options options=$fields.provincia_apertura_pre.options selected=$fields.provincia_apertura_pre.value}
{else}
{html_options options=$fields.provincia_apertura_pre.options selected=$fields.provincia_apertura_pre.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.provincia_apertura_pre.options }
{capture name="field_val"}{$fields.provincia_apertura_pre.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.provincia_apertura_pre.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.provincia_apertura_pre.name}" 
id="{$fields.provincia_apertura_pre.name}" 
title=''          
>
{if isset($fields.provincia_apertura_pre.value) && $fields.provincia_apertura_pre.value != ''}
{html_options options=$fields.provincia_apertura_pre.options selected=$fields.provincia_apertura_pre.value}
{else}
{html_options options=$fields.provincia_apertura_pre.options selected=$fields.provincia_apertura_pre.default}
{/if}
</select>
<input
id="{$fields.provincia_apertura_pre.name}-input"
name="{$fields.provincia_apertura_pre.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.provincia_apertura_pre.name}-image"></button><button type="button"
id="btn-clear-{$fields.provincia_apertura_pre.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.provincia_apertura_pre.name}-input', '{$fields.provincia_apertura_pre.name}');sync_{$fields.provincia_apertura_pre.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.provincia_apertura_pre.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.provincia_apertura_pre.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.provincia_apertura_pre.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.provincia_apertura_pre.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.provincia_apertura_pre.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.provincia_apertura_pre.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.provincia_apertura_pre.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.provincia_apertura_pre.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.provincia_apertura_pre.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.provincia_apertura_pre.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='f_precontrato_firma_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_PRECONTRATO_FIRMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_precontrato_firma.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_precontrato_firma.name}" id="{$fields.f_precontrato_firma.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_precontrato_firma.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_precontrato_firma.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_precontrato_firma.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='localidad_apertura_pre_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.localidad_apertura_pre.value) <= 0}
{assign var="value" value=$fields.localidad_apertura_pre.default_value }
{else}
{assign var="value" value=$fields.localidad_apertura_pre.value }
{/if}  
<input type='text' name='{$fields.localidad_apertura_pre.name}' 
id='{$fields.localidad_apertura_pre.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='periodo_validez_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PERIODO_VALIDEZ' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.periodo_validez.value) <= 0}
{assign var="value" value=$fields.periodo_validez.default_value }
{else}
{assign var="value" value=$fields.periodo_validez.value }
{/if}  
<input type='text' name='{$fields.periodo_validez.name}' 
id='{$fields.periodo_validez.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='direccion_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.direccion_local.value) <= 0}
{assign var="value" value=$fields.direccion_local.default_value }
{else}
{assign var="value" value=$fields.direccion_local.value }
{/if}  
<input type='text' name='{$fields.direccion_local.name}' 
id='{$fields.direccion_local.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='modelo_negocio_precontrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MDN_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.modelo_negocio_precontrato.value) <= 0}
{assign var="value" value=$fields.modelo_negocio_precontrato.default_value }
{else}
{assign var="value" value=$fields.modelo_negocio_precontrato.value }
{/if}  
<input type='text' name='{$fields.modelo_negocio_precontrato.name}' 
id='{$fields.modelo_negocio_precontrato.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='zona_exclusividad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.zona_exclusividad.value)}
{assign var="value" value=$fields.zona_exclusividad.default_value }
{else}
{assign var="value" value=$fields.zona_exclusividad.value }
{/if}  
<textarea  id='{$fields.zona_exclusividad.name}' name='{$fields.zona_exclusividad.name}'
rows="2" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='entrega_cuenta_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREGA_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.entrega_cuenta.value) <= 0}
{assign var="value" value=$fields.entrega_cuenta.default_value }
{else}
{assign var="value" value=$fields.entrega_cuenta.value }
{/if}  
<input type='text' name='{$fields.entrega_cuenta.name}' 
id='{$fields.entrega_cuenta.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='zona_reserva_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_RESERVA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.zona_reserva.value)}
{assign var="value" value=$fields.zona_reserva.default_value }
{else}
{assign var="value" value=$fields.zona_reserva.value }
{/if}  
<textarea  id='{$fields.zona_reserva.name}' name='{$fields.zona_reserva.name}'
rows="2" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='canon_entrada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.canon_entrada.value) <= 0}
{assign var="value" value=$fields.canon_entrada.default_value }
{else}
{assign var="value" value=$fields.canon_entrada.value }
{/if}  
<input type='text' name='{$fields.canon_entrada.name}' 
id='{$fields.canon_entrada.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='f_entrega_cuenta_pre_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENTREGA_CUENTA_PRE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solo se rellena a la recepcion del justificante" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_entrega_cuenta_pre.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_entrega_cuenta_pre.name}" id="{$fields.f_entrega_cuenta_pre.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_entrega_cuenta_pre.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_entrega_cuenta_pre.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_entrega_cuenta_pre.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='observacion_precontrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACION_PRECONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Recoger solicitudes, objeciones y concesiones relacionadas con el precontrato. EN definitiva, cualquier observacion para redartar el precontrato" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.observacion_precontrato.value)}
{assign var="value" value=$fields.observacion_precontrato.default_value }
{else}
{assign var="value" value=$fields.observacion_precontrato.value }
{/if}  
<textarea  id='{$fields.observacion_precontrato.name}' name='{$fields.observacion_precontrato.name}'
rows="6" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PRECONTRATO").style.display='none';</script>
{/if}
</div>    <div id='tabcontent4'>
<div id="detailpanel_5" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_PLAN_FINANCIERO'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_validado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_VALIDADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.pf_validado.value) == "1" || strval($fields.pf_validado.value) == "yes" || strval($fields.pf_validado.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.pf_validado.name}" value="0"> 
<input type="checkbox" id="{$fields.pf_validado.name}" 
name="{$fields.pf_validado.name}" 
value="1" title='' tabindex="0" {$checked} >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_PERFIL_FRANQUICIADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_superficie_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_superficie_local.value) <= 0}
{assign var="value" value=$fields.pf_superficie_local.default_value }
{else}
{assign var="value" value=$fields.pf_superficie_local.value }
{/if}  
<input type='text' name='{$fields.pf_superficie_local.name}' 
id='{$fields.pf_superficie_local.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='pf_tipo_franquiciado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_TIPO_FRANQUICIADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_tipo_franquiciado.value) <= 0}
{assign var="value" value=$fields.pf_tipo_franquiciado.default_value }
{else}
{assign var="value" value=$fields.pf_tipo_franquiciado.value }
{/if}  
<input type='text' name='{$fields.pf_tipo_franquiciado.name}' 
id='{$fields.pf_tipo_franquiciado.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_alquiler_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_ALQUILER_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_alquiler_local.value) <= 0}
{assign var="value" value=$fields.pf_alquiler_local.default_value }
{else}
{assign var="value" value=$fields.pf_alquiler_local.value }
{/if}  
<input type='text' name='{$fields.pf_alquiler_local.name}' 
id='{$fields.pf_alquiler_local.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='pf_trabajo_negocio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_TRABAJO_NEGOCIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_trabajo_negocio.value) <= 0}
{assign var="value" value=$fields.pf_trabajo_negocio.default_value }
{else}
{assign var="value" value=$fields.pf_trabajo_negocio.value }
{/if}  
<input type='text' name='{$fields.pf_trabajo_negocio.name}' 
id='{$fields.pf_trabajo_negocio.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_estado_local_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_ESTADO_LOCAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_estado_local.value) <= 0}
{assign var="value" value=$fields.pf_estado_local.default_value }
{else}
{assign var="value" value=$fields.pf_estado_local.value }
{/if}  
<input type='text' name='{$fields.pf_estado_local.name}' 
id='{$fields.pf_estado_local.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='pf_forma_juridica_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_FORMA_JURIDICA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_forma_juridica.value) <= 0}
{assign var="value" value=$fields.pf_forma_juridica.default_value }
{else}
{assign var="value" value=$fields.pf_forma_juridica.value }
{/if}  
<input type='text' name='{$fields.pf_forma_juridica.name}' 
id='{$fields.pf_forma_juridica.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='pf_historico_sociedad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_HISTORICO_SOCIEDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_historico_sociedad.value) <= 0}
{assign var="value" value=$fields.pf_historico_sociedad.default_value }
{else}
{assign var="value" value=$fields.pf_historico_sociedad.value }
{/if}  
<input type='text' name='{$fields.pf_historico_sociedad.name}' 
id='{$fields.pf_historico_sociedad.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_CONDICIONES_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_canon_entrada_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_canon_entrada.value) <= 0}
{assign var="value" value=$fields.pf_canon_entrada.default_value }
{else}
{assign var="value" value=$fields.pf_canon_entrada.value }
{/if}  
<input type='text' name='{$fields.pf_canon_entrada.name}' 
id='{$fields.pf_canon_entrada.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_porcentaje_financia_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_PORCENTAJE_FINANCIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_porcentaje_financia.value) <= 0}
{assign var="value" value=$fields.pf_porcentaje_financia.default_value }
{else}
{assign var="value" value=$fields.pf_porcentaje_financia.value }
{/if}  
<input type='text' name='{$fields.pf_porcentaje_financia.name}' 
id='{$fields.pf_porcentaje_financia.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_inversion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_INVERSION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_inversion.value) <= 0}
{assign var="value" value=$fields.pf_inversion.default_value }
{else}
{assign var="value" value=$fields.pf_inversion.value }
{/if}  
<input type='text' name='{$fields.pf_inversion.name}' 
id='{$fields.pf_inversion.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='pf_f_prevista_inicio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PF_F_PERVISTA_INICIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pf_f_prevista_inicio.value) <= 0}
{assign var="value" value=$fields.pf_f_prevista_inicio.default_value }
{else}
{assign var="value" value=$fields.pf_f_prevista_inicio.value }
{/if}  
<input type='text' name='{$fields.pf_f_prevista_inicio.name}' 
id='{$fields.pf_f_prevista_inicio.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PLAN_FINANCIERO").style.display='none';</script>
{/if}
</div>    <div id='tabcontent5'>
<div id="detailpanel_6" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_CONTRATO'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRMANTE2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='con_fir1_first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_first_name.value) <= 0}
{assign var="value" value=$fields.con_fir1_first_name.default_value }
{else}
{assign var="value" value=$fields.con_fir1_first_name.value }
{/if}  
<input type='text' name='{$fields.con_fir1_first_name.name}' 
id='{$fields.con_fir1_first_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='con_fir2_first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_first_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_first_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_first_name.value }
{/if}  
<input type='text' name='{$fields.con_fir2_first_name.name}' 
id='{$fields.con_fir2_first_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='con_fir1_last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir1_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir1_last_name.value }
{/if}  
<input type='text' name='{$fields.con_fir1_last_name.name}' 
id='{$fields.con_fir1_last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='con_fir2_last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_last_name.value }
{/if}  
<input type='text' name='{$fields.con_fir2_last_name.name}' 
id='{$fields.con_fir2_last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='con_fir1_NIF_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_NIF.value) <= 0}
{assign var="value" value=$fields.con_fir1_NIF.default_value }
{else}
{assign var="value" value=$fields.con_fir1_NIF.value }
{/if}  
<input type='text' name='{$fields.con_fir1_NIF.name}' 
id='{$fields.con_fir1_NIF.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='con_fir2_last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_last_name.value) <= 0}
{assign var="value" value=$fields.con_fir2_last_name.default_value }
{else}
{assign var="value" value=$fields.con_fir2_last_name.value }
{/if}  
<input type='text' name='{$fields.con_fir2_last_name.name}' 
id='{$fields.con_fir2_last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='con_fir1_vecino_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_vecino.value) <= 0}
{assign var="value" value=$fields.con_fir1_vecino.default_value }
{else}
{assign var="value" value=$fields.con_fir1_vecino.value }
{/if}  
<input type='text' name='{$fields.con_fir1_vecino.name}' 
id='{$fields.con_fir1_vecino.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='con_fir2_vecino_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_vecino.value) <= 0}
{assign var="value" value=$fields.con_fir2_vecino.default_value }
{else}
{assign var="value" value=$fields.con_fir2_vecino.value }
{/if}  
<input type='text' name='{$fields.con_fir2_vecino.name}' 
id='{$fields.con_fir2_vecino.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='con_fir1_domicilio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir1_domicilio.value) <= 0}
{assign var="value" value=$fields.con_fir1_domicilio.default_value }
{else}
{assign var="value" value=$fields.con_fir1_domicilio.value }
{/if}  
<input type='text' name='{$fields.con_fir1_domicilio.name}' 
id='{$fields.con_fir1_domicilio.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='con_fir2_domicilio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.con_fir2_domicilio.value) <= 0}
{assign var="value" value=$fields.con_fir2_domicilio.default_value }
{else}
{assign var="value" value=$fields.con_fir2_domicilio.value }
{/if}  
<input type='text' name='{$fields.con_fir2_domicilio.name}' 
id='{$fields.con_fir2_domicilio.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SOCIEDAD1' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SOCIEDAD2' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_razon_social_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_razon_social.value) <= 0}
{assign var="value" value=$fields.sociedad1_razon_social.default_value }
{else}
{assign var="value" value=$fields.sociedad1_razon_social.value }
{/if}  
<input type='text' name='{$fields.sociedad1_razon_social.name}' 
id='{$fields.sociedad1_razon_social.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_razon_social_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_razon_social.value) <= 0}
{assign var="value" value=$fields.sociedad2_razon_social.default_value }
{else}
{assign var="value" value=$fields.sociedad2_razon_social.value }
{/if}  
<input type='text' name='{$fields.sociedad2_razon_social.name}' 
id='{$fields.sociedad2_razon_social.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_nacionalidad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_nacionalidad.value) <= 0}
{assign var="value" value=$fields.sociedad1_nacionalidad.default_value }
{else}
{assign var="value" value=$fields.sociedad1_nacionalidad.value }
{/if}  
<input type='text' name='{$fields.sociedad1_nacionalidad.name}' 
id='{$fields.sociedad1_nacionalidad.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_nacionalidad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_nacionalidad.value) <= 0}
{assign var="value" value=$fields.sociedad2_nacionalidad.default_value }
{else}
{assign var="value" value=$fields.sociedad2_nacionalidad.value }
{/if}  
<input type='text' name='{$fields.sociedad2_nacionalidad.name}' 
id='{$fields.sociedad2_nacionalidad.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_domicilio_social_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_domicilio_social.value) <= 0}
{assign var="value" value=$fields.sociedad1_domicilio_social.default_value }
{else}
{assign var="value" value=$fields.sociedad1_domicilio_social.value }
{/if}  
<input type='text' name='{$fields.sociedad1_domicilio_social.name}' 
id='{$fields.sociedad1_domicilio_social.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_domicilio_social_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_domicilio_social.value) <= 0}
{assign var="value" value=$fields.sociedad2_domicilio_social.default_value }
{else}
{assign var="value" value=$fields.sociedad2_domicilio_social.value }
{/if}  
<input type='text' name='{$fields.sociedad2_domicilio_social.name}' 
id='{$fields.sociedad2_domicilio_social.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_cif_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cif.value) <= 0}
{assign var="value" value=$fields.sociedad1_cif.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cif.value }
{/if}  
<input type='text' name='{$fields.sociedad1_cif.name}' 
id='{$fields.sociedad1_cif.name}' size='30' 
maxlength='15' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_cif_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_cif.value) <= 0}
{assign var="value" value=$fields.sociedad2_cif.default_value }
{else}
{assign var="value" value=$fields.sociedad2_cif.value }
{/if}  
<input type='text' name='{$fields.sociedad2_cif.name}' 
id='{$fields.sociedad2_cif.name}' size='30' 
maxlength='15' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_f_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.sociedad1_f_ins_reg_mercantil.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.sociedad1_f_ins_reg_mercantil.name}" id="{$fields.sociedad1_f_ins_reg_mercantil.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.sociedad1_f_ins_reg_mercantil.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.sociedad1_f_ins_reg_mercantil.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.sociedad1_f_ins_reg_mercantil.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='sociedad2_f_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.sociedad2_f_ins_reg_mercantil.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.sociedad2_f_ins_reg_mercantil.name}" id="{$fields.sociedad2_f_ins_reg_mercantil.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.sociedad2_f_ins_reg_mercantil.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.sociedad2_f_ins_reg_mercantil.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.sociedad2_f_ins_reg_mercantil.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_lugar_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_lugar_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad1_lugar_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad1_lugar_ins_reg_mercantil.value }
{/if}  
<input type='text' name='{$fields.sociedad1_lugar_ins_reg_mercantil.name}' 
id='{$fields.sociedad1_lugar_ins_reg_mercantil.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_lugar_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_lugar_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad2_lugar_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad2_lugar_ins_reg_mercantil.value }
{/if}  
<input type='text' name='{$fields.sociedad2_lugar_ins_reg_mercantil.name}' 
id='{$fields.sociedad2_lugar_ins_reg_mercantil.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_datos_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_datos_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad1_datos_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad1_datos_ins_reg_mercantil.value }
{/if}  
<input type='text' name='{$fields.sociedad1_datos_ins_reg_mercantil.name}' 
id='{$fields.sociedad1_datos_ins_reg_mercantil.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_datos_ins_reg_mercantil_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_datos_ins_reg_mercantil.value) <= 0}
{assign var="value" value=$fields.sociedad2_datos_ins_reg_mercantil.default_value }
{else}
{assign var="value" value=$fields.sociedad2_datos_ins_reg_mercantil.value }
{/if}  
<input type='text' name='{$fields.sociedad2_datos_ins_reg_mercantil.name}' 
id='{$fields.sociedad2_datos_ins_reg_mercantil.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_representante_legal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_representante_legal.value) <= 0}
{assign var="value" value=$fields.sociedad1_representante_legal.default_value }
{else}
{assign var="value" value=$fields.sociedad1_representante_legal.value }
{/if}  
<input type='text' name='{$fields.sociedad1_representante_legal.name}' 
id='{$fields.sociedad1_representante_legal.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_representante_legal_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_representante_legal.value) <= 0}
{assign var="value" value=$fields.sociedad2_representante_legal.default_value }
{else}
{assign var="value" value=$fields.sociedad2_representante_legal.value }
{/if}  
<input type='text' name='{$fields.sociedad2_representante_legal.name}' 
id='{$fields.sociedad2_representante_legal.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_domicilio_representante_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_domicilio_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_domicilio_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_domicilio_representante.value }
{/if}  
<input type='text' name='{$fields.sociedad1_domicilio_representante.name}' 
id='{$fields.sociedad1_domicilio_representante.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad2_domicilio_representante_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad2_domicilio_representante.value) <= 0}
{assign var="value" value=$fields.sociedad2_domicilio_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad2_domicilio_representante.value }
{/if}  
<input type='text' name='{$fields.sociedad2_domicilio_representante.name}' 
id='{$fields.sociedad2_domicilio_representante.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sociedad1_cargo_representante_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cargo_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_cargo_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cargo_representante.value }
{/if}  
<input type='text' name='{$fields.sociedad1_cargo_representante.name}' 
id='{$fields.sociedad1_cargo_representante.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='sociedad1_cargo_representante_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sociedad1_cargo_representante.value) <= 0}
{assign var="value" value=$fields.sociedad1_cargo_representante.default_value }
{else}
{assign var="value" value=$fields.sociedad1_cargo_representante.value }
{/if}  
<input type='text' name='{$fields.sociedad1_cargo_representante.name}' 
id='{$fields.sociedad1_cargo_representante.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_CANDIDATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='f_contrato_firma_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_CONTRATO_FIRMA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_contrato_firma.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_contrato_firma.name}" id="{$fields.f_contrato_firma.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_contrato_firma.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_contrato_firma.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_contrato_firma.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='modelo_franquicia_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MODELO_FRANQUICIA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.modelo_franquicia.value) <= 0}
{assign var="value" value=$fields.modelo_franquicia.default_value }
{else}
{assign var="value" value=$fields.modelo_franquicia.value }
{/if}  
<input type='text' name='{$fields.modelo_franquicia.name}' 
id='{$fields.modelo_franquicia.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='franquicia_piloto_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_PILOTO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.franquicia_piloto.value) <= 0}
{assign var="value" value=$fields.franquicia_piloto.default_value }
{else}
{assign var="value" value=$fields.franquicia_piloto.value }
{/if}  
<input type='text' name='{$fields.franquicia_piloto.name}' 
id='{$fields.franquicia_piloto.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
<td valign="top" id='lineas_negocio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LINEAS_NEGOCIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.lineas_negocio.value) <= 0}
{assign var="value" value=$fields.lineas_negocio.default_value }
{else}
{assign var="value" value=$fields.lineas_negocio.value }
{/if}  
<input type='text' name='{$fields.lineas_negocio.name}' 
id='{$fields.lineas_negocio.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='contrato_condiciones_especiales_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CONDICIONES_ESPECIALES' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.contrato_condiciones_especiales.value) <= 0}
{assign var="value" value=$fields.contrato_condiciones_especiales.default_value }
{else}
{assign var="value" value=$fields.contrato_condiciones_especiales.value }
{/if}  
<input type='text' name='{$fields.contrato_condiciones_especiales.name}' 
id='{$fields.contrato_condiciones_especiales.name}' size='30' 
maxlength='250' 
value='{$value}' title=''      >
<td valign="top" id='canon_entrada_definitivo_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.canon_entrada_definitivo.value) <= 0}
{assign var="value" value=$fields.canon_entrada_definitivo.default_value }
{else}
{assign var="value" value=$fields.canon_entrada_definitivo.value }
{/if}  
<input type='text' name='{$fields.canon_entrada_definitivo.name}' 
id='{$fields.canon_entrada_definitivo.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='local_titularidad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCAL_TITULARIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.local_titularidad.value) <= 0}
{assign var="value" value=$fields.local_titularidad.default_value }
{else}
{assign var="value" value=$fields.local_titularidad.value }
{/if}  
<input type='text' name='{$fields.local_titularidad.name}' 
id='{$fields.local_titularidad.name}' size='30' 
maxlength='250' 
value='{$value}' title=''      >
<td valign="top" id='importe_abonado_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_IMPORTE_ABONADO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.importe_abonado.value) <= 0}
{assign var="value" value=$fields.importe_abonado.default_value }
{else}
{assign var="value" value=$fields.importe_abonado.value }
{/if}  
<input type='text' name='{$fields.importe_abonado.name}' 
id='{$fields.importe_abonado.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='local_Direccion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.local1_Direccion.value) <= 0}
{assign var="value" value=$fields.local1_Direccion.default_value }
{else}
{assign var="value" value=$fields.local1_Direccion.value }
{/if}  
<input type='text' name='{$fields.local1_Direccion.name}' 
id='{$fields.local1_Direccion.name}' size='30' 
maxlength='200' 
value='{$value}' title=''      >
<td valign="top" id='marca_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.marca.value) <= 0}
{assign var="value" value=$fields.marca.default_value }
{else}
{assign var="value" value=$fields.marca.value }
{/if}  
<input type='text' name='{$fields.marca.name}' 
id='{$fields.marca.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='local_municipio_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MUNICIPIO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.local_municipio.value) <= 0}
{assign var="value" value=$fields.local_municipio.default_value }
{else}
{assign var="value" value=$fields.local_municipio.value }
{/if}  
<input type='text' name='{$fields.local_municipio.name}' 
id='{$fields.local_municipio.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='estado_marca_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ESTADO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.estado_marca.value) <= 0}
{assign var="value" value=$fields.estado_marca.default_value }
{else}
{assign var="value" value=$fields.estado_marca.value }
{/if}  
<input type='text' name='{$fields.estado_marca.name}' 
id='{$fields.estado_marca.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='f_apertura_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_APERTURA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_apertura.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_apertura.name}" id="{$fields.f_apertura.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_apertura.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_apertura.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_apertura.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='propietario_marca_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PROPIETARIO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.propietario_marca.value) <= 0}
{assign var="value" value=$fields.propietario_marca.default_value }
{else}
{assign var="value" value=$fields.propietario_marca.value }
{/if}  
<input type='text' name='{$fields.propietario_marca.name}' 
id='{$fields.propietario_marca.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='zona_exlusividad_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.zona_exlusividad.value)}
{assign var="value" value=$fields.zona_exlusividad.default_value }
{else}
{assign var="value" value=$fields.zona_exlusividad.value }
{/if}  
<textarea  id='{$fields.zona_exlusividad.name}' name='{$fields.zona_exlusividad.name}'
rows="4" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='codigo_marca_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CODIGO_MARCA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.codigo_marca.value) <= 0}
{assign var="value" value=$fields.codigo_marca.default_value }
{else}
{assign var="value" value=$fields.codigo_marca.value }
{/if}  
<input type='text' name='{$fields.codigo_marca.name}' 
id='{$fields.codigo_marca.name}' size='30' 
maxlength='150' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='entidad_financiera_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FINANCIERA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.entidad_financiera.value) <= 0}
{assign var="value" value=$fields.entidad_financiera.default_value }
{else}
{assign var="value" value=$fields.entidad_financiera.value }
{/if}  
<input type='text' name='{$fields.entidad_financiera.name}' 
id='{$fields.entidad_financiera.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='duracion_contrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DURACION_CONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.duracion_contrato.value) <= 0}
{assign var="value" value=$fields.duracion_contrato.default_value }
{else}
{assign var="value" value=$fields.duracion_contrato.value }
{/if}  
<input type='text' name='{$fields.duracion_contrato.name}' 
id='{$fields.duracion_contrato.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='n_cuenta_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.n_cuenta.value) <= 0}
{assign var="value" value=$fields.n_cuenta.default_value }
{else}
{assign var="value" value=$fields.n_cuenta.value }
{/if}  
<input type='text' name='{$fields.n_cuenta.name}' 
id='{$fields.n_cuenta.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='pago_en_cuenta_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PAGO_EN_CUENTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.pago_en_cuenta.value) <= 0}
{assign var="value" value=$fields.pago_en_cuenta.default_value }
{else}
{assign var="value" value=$fields.pago_en_cuenta.value }
{/if}  
<input type='text' name='{$fields.pago_en_cuenta.name}' 
id='{$fields.pago_en_cuenta.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='lugar_formacion_preferente_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LUGAR_FORMACION_PREFERENTE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.lugar_formacion_preferente.value) <= 0}
{assign var="value" value=$fields.lugar_formacion_preferente.default_value }
{else}
{assign var="value" value=$fields.lugar_formacion_preferente.value }
{/if}  
<input type='text' name='{$fields.lugar_formacion_preferente.name}' 
id='{$fields.lugar_formacion_preferente.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='cuenta_expande_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA_EXPANDE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.cuenta_expande.value) <= 0}
{assign var="value" value=$fields.cuenta_expande.default_value }
{else}
{assign var="value" value=$fields.cuenta_expande.value }
{/if}  
<input type='text' name='{$fields.cuenta_expande.name}' 
id='{$fields.cuenta_expande.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='entrega_cuenta_cont_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.entrega_cuenta_cont.value) <= 0}
{assign var="value" value=$fields.entrega_cuenta_cont.default_value }
{else}
{assign var="value" value=$fields.entrega_cuenta_cont.value }
{/if}  
<input type='text' name='{$fields.entrega_cuenta_cont.name}' 
id='{$fields.entrega_cuenta_cont.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='entidad_fin_expande_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_EXPANDE' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.entidad_fin_expande.value) <= 0}
{assign var="value" value=$fields.entidad_fin_expande.default_value }
{else}
{assign var="value" value=$fields.entidad_fin_expande.value }
{/if}  
<input type='text' name='{$fields.entidad_fin_expande.name}' 
id='{$fields.entidad_fin_expande.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='f_entrega_cuenta_cont_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_F_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Solo se rellena a la recepcion del justificante" module='Expan_GestionSolicitudes'}{/capture}
{sugar_help text=$popupText WIDTH=-1}
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.f_entrega_cuenta_cont.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.f_entrega_cuenta_cont.name}" id="{$fields.f_entrega_cuenta_cont.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.f_entrega_cuenta_cont.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.f_entrega_cuenta_cont.name}",
form : "EditView",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.f_entrega_cuenta_cont.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='cuenta_franquiciador_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CUENTA_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.cuenta_franquiciador.value) <= 0}
{assign var="value" value=$fields.cuenta_franquiciador.default_value }
{else}
{assign var="value" value=$fields.cuenta_franquiciador.value }
{/if}  
<input type='text' name='{$fields.cuenta_franquiciador.name}' 
id='{$fields.cuenta_franquiciador.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='entidad_fin_franquiciador_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.entidad_fin_franquiciador.value) <= 0}
{assign var="value" value=$fields.entidad_fin_franquiciador.default_value }
{else}
{assign var="value" value=$fields.entidad_fin_franquiciador.value }
{/if}  
<input type='text' name='{$fields.entidad_fin_franquiciador.name}' 
id='{$fields.entidad_fin_franquiciador.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='inversion_inicial_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTIDAD_FIN_FRANQUICIADOR' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.inversion_inicial.value) <= 0}
{assign var="value" value=$fields.inversion_inicial.default_value }
{else}
{assign var="value" value=$fields.inversion_inicial.value }
{/if}  
<input type='text' name='{$fields.inversion_inicial.name}' 
id='{$fields.inversion_inicial.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='royalty_explotacion_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.royalty_explotacion.value) <= 0}
{assign var="value" value=$fields.royalty_explotacion.default_value }
{else}
{assign var="value" value=$fields.royalty_explotacion.value }
{/if}  
<input type='text' name='{$fields.royalty_explotacion.name}' 
id='{$fields.royalty_explotacion.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='min_royalty_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MIN_ROYALTY' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.min_royalty.value) <= 0}
{assign var="value" value=$fields.min_royalty.default_value }
{else}
{assign var="value" value=$fields.min_royalty.value }
{/if}  
<input type='text' name='{$fields.min_royalty.name}' 
id='{$fields.min_royalty.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='fondo_marketing_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FONDO_MARKETING' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.fondo_marketing.value) <= 0}
{assign var="value" value=$fields.fondo_marketing.default_value }
{else}
{assign var="value" value=$fields.fondo_marketing.value }
{/if}  
<input type='text' name='{$fields.fondo_marketing.name}' 
id='{$fields.fondo_marketing.name}' size='30' 
maxlength='50' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='observacion_contrato_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACION_CONTRATO' module='Expan_GestionSolicitudes'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.observacion_contrato.value)}
{assign var="value" value=$fields.observacion_contrato.default_value }
{else}
{assign var="value" value=$fields.observacion_contrato.value }
{/if}  
<textarea  id='{$fields.observacion_contrato.name}' name='{$fields.observacion_contrato.name}'
rows="4" 
cols="40" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_CONTRATO").style.display='none';</script>
{/if}
</div></div>

<script language="javascript">
    var _form_id = '{$form_id}';
    {literal}
    SUGAR.util.doWhen(function(){
        _form_id = (_form_id == '') ? 'EditView' : _form_id;
        return document.getElementById(_form_id) != null;
    }, SUGAR.themes.actionMenu);
    {/literal}
</script>
{assign var='place' value="_FOOTER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="buttons">
<div class="action_buttons"><input type="submit" name="save" id="save" class="submit" 
onClick="document.getElementById('candidatura_caliente').disabled = false;
this.form.return_action.value='DetailView';                 
this.form.action.value='Save';
return validarEdicion('{$fields.id.value}');" value="Guardar"/> {if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_FOOTER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Expan_GestionSolicitudes'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {/if} {if $fields.id.value!=""}<input type="button" name="irApertura" id="irApertura" class style="color:#0000FF;" 
onClick="irAperturas('{$fields.name.value}');" value="Ir Aperturas"/>{/if} {if $fields.id.value!=""}<input type="button" style="color:#FF0000;" name="irfran" id="irfran" class onClick="irFranquicia('{$fields.franquicia.value}');" value="Ir Franquicia"/>{/if} {if $fields.id.value!=""}<input type="button" style="color:#00BC9F;" name="irsol" id="irsol" class onClick="irSolicitud('{$fields.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida.value}');" value="Ir Solicitud"/>{/if} {if $fields.id.value!=""}<BR> <BR/><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#0000FF;" 
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
onClick="envioCorreoInterlocutor('{$fields.id.value}','consultor');" value="Envio Ficha Consultor"/>{/if} {if $fields.id.value!=""}<BR><BR><input type="button" name="openWind" id="openWind" class onClick="abrirHermanas('{$fields.id.value}');" value="Abrir Hermanas"/>{/if} {if $fields.id.value!=""}<input type="button" name="open" id="open" class onClick="window.open('index.php?module=Calls&action=EditView&expan_gestionsolicitudes_calls_1_name={$fields.name.value}&&expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida={$fields.id.value}');" value="CrearLlamada"/>{/if} {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Expan_GestionSolicitudes", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</form>
{$set_focus_block}
<!-- Begin Meta-Data Javascript -->
{sugar_getscript file="include/javascript/popup_parent_helper.js"}
{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
{sugar_getscript file="include/javascript/EditGestionSolicitud.js"}
{sugar_getscript file="modules/Documents/documents.js"}
{sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
{sugar_getscript file="include/javascript/include.js"}
<script type="text/javascript"> onload=ocultarCheck('{$fields.id.value}');</script>
<!-- End Meta-Data Javascript -->
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>{sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
<script type="text/javascript">
var EditView_tabs = new YAHOO.widget.TabView("EditView_tabs");
EditView_tabs.selectTab(0);
</script>
<script type="text/javascript">
YAHOO.util.Event.onContentReady("EditView",
    function () {ldelim} initEditView(document.forms.EditView) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {ldelim}
$(document).ready(function() {ldelim}
    $(".collapseLink,.expandLink").click(function (e) {ldelim} e.preventDefault(); {rdelim});
  {rdelim});
{rdelim}
</script>{literal}
<script type="text/javascript">
addForm('EditView');addToValidate('EditView', 'name', 'name', true,'{/literal}{sugar_translate label='LBL_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'date_entered_date', 'date', false,'Fecha de Creación' );
addToValidate('EditView', 'date_modified_date', 'date', false,'Última Modificación' );
addToValidate('EditView', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_documentacion', 'bool', false,'{/literal}{sugar_translate label='Envio de la documentacion (C1)' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_resolucion_dudas', 'bool', false,'{/literal}{sugar_translate label='LBL_RESOLUCION_DUDAS' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_resolucion_dudas', 'date', false,'{/literal}{sugar_translate label='Fecha de Resolucion de dudas' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_sol_amp_info', 'bool', false,'{/literal}{sugar_translate label='Solicitud ampliacion información (Llamamos nosotros)' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_sol_amp_info', 'date', false,'{/literal}{sugar_translate label='Fecha Solicitud ampliacion información ' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_recepcio_cuestionario', 'bool', false,'{/literal}{sugar_translate label='LBL_RECEPCION_CUESTIONARIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_recepcion_cuestionario', 'date', false,'{/literal}{sugar_translate label='Fecha de recepción del cuestionario' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_informacion_adicional', 'bool', false,'{/literal}{sugar_translate label='Envio información adicional (C2)' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_informacion_adicional', 'date', false,'{/literal}{sugar_translate label='Fecha envio información adicional' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_responde_C1', 'bool', false,'{/literal}{sugar_translate label='LBL_RESPONDE_C1' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_responde_C1', 'date', false,'{/literal}{sugar_translate label='Fecha resolucion C1' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_entrevista', 'bool', false,'{/literal}{sugar_translate label='Entrevista' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_entrevista', 'date', false,'{/literal}{sugar_translate label='Fecha Entrevista' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_entrevista_previa', 'bool', false,'{/literal}{sugar_translate label='LBL_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_entrevista_previa', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'usuario_entrevista_previa', 'varchar', false,'{/literal}{sugar_translate label='LBL_USUARIO_ENTREVISTA_PREVIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_propuesta_zona', 'bool', false,'{/literal}{sugar_translate label='LBL_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_propuesta_zona', 'date', false,'{/literal}{sugar_translate label='LBL_F_ENVIO_PROP_ZONA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_visitado_fran', 'bool', false,'{/literal}{sugar_translate label='Visitado franquiciado / unidad propia' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_visitado_fran', 'date', false,'{/literal}{sugar_translate label='Fecha Visitado franquiciado' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_precontrato', 'bool', false,'{/literal}{sugar_translate label='Envio precontrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_envio_precontrato', 'date', false,'{/literal}{sugar_translate label='Fecha envio precontrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_visita_local', 'bool', false,'{/literal}{sugar_translate label='LBL_INFORMACION_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_visita_local', 'date', false,'{/literal}{sugar_translate label='Fecha visita al local' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_contrato', 'bool', false,'{/literal}{sugar_translate label='Envío de contrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_envio_contrato', 'date', false,'{/literal}{sugar_translate label='Fecha envío de contrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_visita_central', 'bool', false,'{/literal}{sugar_translate label='Visita a la Central' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_visita_central', 'date', false,'{/literal}{sugar_translate label='Fecha visita a la Central' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_posible_colabora', 'bool', false,'{/literal}{sugar_translate label='Posible Colaboracion' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_posible_colabora', 'date', false,'{/literal}{sugar_translate label='Fecha Posible Colaboracion' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'candidatura_caliente', 'bool', false,'{/literal}{sugar_translate label='Candidatura caliente' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'candidatura_avanzada', 'bool', false,'{/literal}{sugar_translate label='LBL_CANDIDATURA_AVANZADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'estado_sol', 'enum', false,'{/literal}{sugar_translate label='Estado' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'envio_documentacion', 'date', false,'{/literal}{sugar_translate label='Fecha de envio de Documentación' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'franquicia', 'enum', true,'{/literal}{sugar_translate label='LBL_FRANQUICIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'observaciones_informe', 'text', false,'{/literal}{sugar_translate label='LBL_OBSERVACIONES_INFORME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_auto', 'bool', false,'{/literal}{sugar_translate label='Envios automatizados' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'cuando_empezar', 'date', false,'{/literal}{sugar_translate label='LBL_CUANDO_EMPEZAR' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'prioridad', 'int', false,'{/literal}{sugar_translate label='LBL_PRIORIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'oportunidad_inmediata', 'bool', false,'{/literal}{sugar_translate label='LBL_OPORTUNIDAD_INMEDIATA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'observaciones_descarte', 'text', false,'{/literal}{sugar_translate label='LBL_OBSERVACIONES_DESCARTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'motivo_descarte', 'enum', false,'{/literal}{sugar_translate label='LBL_MOTIVO_DESCARTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'motivo_parada', 'enum', false,'{/literal}{sugar_translate label='LBL_MOTIVO_PARADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'motivo_positivo', 'enum', false,'{/literal}{sugar_translate label='LBL_MOTIVO_POSITIVO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'tipo_origen', 'enum', true,'{/literal}{sugar_translate label='LBL_TIPO_ORIGEN' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'portal', 'enum', false,'{/literal}{sugar_translate label='LBL_PORTAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'subor_medios', 'enum', false,'{/literal}{sugar_translate label='LBL_SUBOR_MEDIOS' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'subor_central', 'enum', false,'{/literal}{sugar_translate label='LBL_SUBOR_CENTRAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'subor_expande', 'enum', false,'{/literal}{sugar_translate label='LBL_SUBOR_EXPANDE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'subor_mailing', 'enum', false,'{/literal}{sugar_translate label='LBL_SUBOR_MAILING' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'expan_evento_id_c', 'enum', false,'{/literal}{sugar_translate label='LBL_EVENTO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'evento_bk', 'enum', false,'{/literal}{sugar_translate label='LBL_EVENTO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'lnk_cuestionario', 'text', false,'{/literal}{sugar_translate label='LBL_CUESTIONARIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'tiponegocio1', 'bool', false,'{/literal}{sugar_translate label='LBL_TIPONEG1' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg11', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG11' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg12', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG12' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg13', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG13' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg14', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG14' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg15', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG15' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'tiponegocio2', 'bool', false,'{/literal}{sugar_translate label='LBL_TIPONEG2' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg21', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG21' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg22', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG22' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg23', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG23' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg24', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG24' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg25', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG25' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'tiponegocio3', 'bool', false,'{/literal}{sugar_translate label='LBL_TIPONEG3' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg31', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG31' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg32', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG32' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg33', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG33' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg34', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG34' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg35', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG35' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'tiponegocio4', 'bool', false,'{/literal}{sugar_translate label='LBL_TIPONEG4' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg41', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG41' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg42', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG42' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg43', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG43' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg44', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG44' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chkvalNeg45', 'bool', false,'{/literal}{sugar_translate label='LBL_CHKVALNEG45' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'inversion', 'enum', false,'{/literal}{sugar_translate label='LBL_INVERSION' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'recursos_propios', 'enum', false,'{/literal}{sugar_translate label='LBL_RECURSOS_PROPIOS' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_gestionado_central', 'bool', false,'{/literal}{sugar_translate label='LBL_CHK_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_gestionado_central', 'date', false,'{/literal}{sugar_translate label='LBL_F_GESTIONADO_CENTRAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'papel', 'enum', false,'{/literal}{sugar_translate label='LBL_PAPEL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'dummie', 'bool', false,'{/literal}{sugar_translate label='dummie' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'provincia_apertura_1', 'enum', false,'{/literal}{sugar_translate label='LBL_PROVINCIA_APERTURA_1' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pais_apertura', 'enum', false,'{/literal}{sugar_translate label='LBL_PAIS_APERTURA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'rating', 'enum', false,'{/literal}{sugar_translate label='LBL_RATING' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'telefono', 'phone', false,'{/literal}{sugar_translate label='LBL_TELEFONO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'perfil_ideoneo', 'enum', false,'{/literal}{sugar_translate label='LBL_PERFIL_IDONEO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'subestado', 'varchar', false,'{/literal}{sugar_translate label='LBL_SUBESTADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'suborigen', 'varchar', false,'{/literal}{sugar_translate label='LBL_SUBORIGEN' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'Accesos', 'SelectField', false,'{/literal}{sugar_translate label='Accesos' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_precontrato_personal', 'bool', false,'{/literal}{sugar_translate label='LBL_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_envio_precontrato_personal', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_contrato_personal', 'bool', false,'{/literal}{sugar_translate label='LBL_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_envio_contrato_personal', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_ENVIO_CONTRATO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_envio_plan_financiero_personal', 'bool', false,'{/literal}{sugar_translate label='LBL_ENVIO_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_envio_plan_financiero_personal', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_PLAN_FINANCIERO_PERSONAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'preguntas_mn_t', 'text', false,'{/literal}{sugar_translate label='LBL_PREGUNTAS_MN_T' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'objeciones_mn', 'text', false,'{/literal}{sugar_translate label='LBL_OBJECIONES_MN' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'solicitudes_candidato', 'text', false,'{/literal}{sugar_translate label='LBL_SOLICITUDES_CANDIDATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'informacion_competencia', 'text', false,'{/literal}{sugar_translate label='LBL_INFORMACION_COMPETENCIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'informacion_proveedores', 'text', false,'{/literal}{sugar_translate label='LBL_INFORMACION_PROVEEDORES' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'mejoras', 'text', false,'{/literal}{sugar_translate label='LBL_MEJORAS' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'concesiones', 'text', false,'{/literal}{sugar_translate label='LBL_CONCESIONES' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'preg_en_central', 'text', false,'{/literal}{sugar_translate label='LBL_PREG_EN_CENTRAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'notas_argumentario', 'text', false,'{/literal}{sugar_translate label='LBL_NOTAS_ARGUMENTARIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'otras_preguntas_formulario', 'text', false,'{/literal}{sugar_translate label='LBL_OTRAS_PREGUNTAS_FORMULARIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_autoriza_central', 'bool', false,'{/literal}{sugar_translate label='Autorizacion por parte de la central' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_autoriza_central', 'date', false,'{/literal}{sugar_translate label='Fecha autorizacion por parte de la central' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_operacion_autorizada', 'bool', false,'{/literal}{sugar_translate label='Operación autorizada' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_operacion_autorizada', 'date', false,'{/literal}{sugar_translate label='Fecha autorización de la operación' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_precontrato_firmado', 'bool', false,'{/literal}{sugar_translate label='Precontrato Firmado' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_precontrato_firmado', 'date', false,'{/literal}{sugar_translate label='Fecha firma precontrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_aprobacion_local', 'bool', false,'{/literal}{sugar_translate label='Aprobacion del local' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_aprobacion_local', 'date', false,'{/literal}{sugar_translate label='Fecha de aprobacion del local' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'chk_contrato_firmado', 'bool', false,'{/literal}{sugar_translate label='Contrato Firmado' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_contrato_firmado', 'date', false,'{/literal}{sugar_translate label='Fecha firma contrato' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_precontrato_firma', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_PRECONTRATO_FIRMA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'estado_precontrato', 'enum', false,'{/literal}{sugar_translate label='LBL_ESTADO_PRECONTRATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir1_first_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir1_last_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir1_NIF', 'varchar', false,'{/literal}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir1_vecino', 'varchar', false,'{/literal}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir1_domicilio', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir2_first_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir2_last_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir2_NIF', 'varchar', false,'{/literal}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir2_vecino', 'varchar', false,'{/literal}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_fir2_domicilio', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pre_num_unidades', 'int', false,'{/literal}{sugar_translate label='LBL_PRE_NUM_UNIDADES' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'provincia_apertura_pre', 'enum', false,'{/literal}{sugar_translate label='LBL_PROVINCIA_APERTURA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'localidad_apertura_pre', 'varchar', false,'{/literal}{sugar_translate label='LBL_LOCALIDAD_APERTURA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'periodo_validez', 'varchar', false,'{/literal}{sugar_translate label='LBL_PERIODO_VALIDEZ' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'entrega_cuenta', 'varchar', false,'{/literal}{sugar_translate label='LBL_ENTREGA_CUENTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'entrega_cuenta_cont', 'varchar', false,'{/literal}{sugar_translate label='LBL_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'canon_entrada', 'varchar', false,'{/literal}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'observacion_precontrato', 'text', false,'{/literal}{sugar_translate label='LBL_OBSERVACION_PRECONTRATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'direccion_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_DIRECCION_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'zona_exclusividad', 'text', false,'{/literal}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'zona_reserva', 'text', false,'{/literal}{sugar_translate label='LBL_ZONA_RESERVA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'modelo_negocio_precontrato', 'varchar', false,'{/literal}{sugar_translate label='LBL_MDN_PRECONTRATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'fecha_precontrato_minima', 'varchar', false,'{/literal}{sugar_translate label='LBL_FECHA_PRECONTRATO_MINIMA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_validado', 'bool', false,'{/literal}{sugar_translate label='LBL_PF_VALIDADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_superficie_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_alquiler_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_ALQUILER_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_estado_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_ESTADO_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_tipo_franquiciado', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_TIPO_FRANQUICIADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_trabajo_negocio', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_TRABAJO_NEGOCIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_forma_juridica', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_FORMA_JURIDICA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_historico_sociedad', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_HISTORICO_SOCIEDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_canon_entrada', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_CANON_ENTRADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_porcentaje_financia', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_PORCENTAJE_FINANCIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_inversion', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_INVERSION' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pf_f_prevista_inicio', 'varchar', false,'{/literal}{sugar_translate label='LBL_PF_F_PERVISTA_INICIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_validado', 'bool', false,'{/literal}{sugar_translate label='LBL_IIT_VALIDADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_zona_implantacion', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_ZONA_IMPLANTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_aporta_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_APORTA_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_direccion_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_DIRECCION_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_localidad_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_LOCALIDAD_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_superficie_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_SUPERFICIE_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_superficie_escapa_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_SUPERFICIE_ESCAPA_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_superficie_almacen_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_SUPERFICIE_ALMACEN_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_instalaciones_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_INSTALACIONES_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_visitado_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_VISITADO_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_aprobado_local', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_APROBADO_LOCAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_mod_neg_recomendado', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_MOD_NEG_RECOMENDADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_localidad_recomendado', 'varchar', false,'{/literal}{sugar_translate label='LBL_LOCALIDAD_RECOMENDADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_acuerdo_exclusividad', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_ACUERDO_EXCLUSIVIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_acuerdo_economico', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_ACUERDO_ECONOMICO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_inversion_inicial_est', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_INVER_INICIAL_EST' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_canon_entrada', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_CANON_ENTRADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_royalty_explota', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_royalty_mkt', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_ROYALTY_MKT' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_duracion_contrato', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_DURACION_CONTRAT0' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_year_renovado', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_YEAR_RENOVADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'iit_max_estableci_zona', 'varchar', false,'{/literal}{sugar_translate label='LBL_IIT_MAX_ESTABLECI_ZONA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'franq_apertura_desca', 'varchar', false,'{/literal}{sugar_translate label='LBL_FRANQ_APERTURA_DESCARTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_entrega_cuenta_pre', 'date', false,'{/literal}{sugar_translate label='LBL_F_ENTREGA_CUENTA_PRE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_entrega_cuenta_cont', 'date', false,'{/literal}{sugar_translate label='LBL_F_ENTREGA_CUENTA_CONT' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_reactivacion_parado', 'date', false,'{/literal}{sugar_translate label='LBL_F_REACTIVACION_PARADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir1_first_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir1_last_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir1_NIF', 'varchar', false,'{/literal}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir1_vecino', 'varchar', false,'{/literal}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir1_domicilio', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir2_first_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir2_last_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir2_NIF', 'varchar', false,'{/literal}{sugar_translate label='LBL_NIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir2_vecino', 'varchar', false,'{/literal}{sugar_translate label='LBL_VECINO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'con_fir2_domicilio', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_razon_social', 'varchar', false,'{/literal}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_razon_social', 'varchar', false,'{/literal}{sugar_translate label='LBL_RAZON_SOCIAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_nacionalidad', 'varchar', false,'{/literal}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_nacionalidad', 'varchar', false,'{/literal}{sugar_translate label='LBL_NACIONALIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_domicilio_social', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_domicilio_social', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO_SOCIAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_cif', 'varchar', false,'{/literal}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_cif', 'varchar', false,'{/literal}{sugar_translate label='LBL_CIF' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_f_ins_reg_mercantil', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_f_ins_reg_mercantil', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_lugar_ins_reg_mercantil', 'varchar', false,'{/literal}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_lugar_ins_reg_mercantil', 'varchar', false,'{/literal}{sugar_translate label='LBL_LUGAR_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_datos_ins_reg_mercantil', 'varchar', false,'{/literal}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_datos_ins_reg_mercantil', 'varchar', false,'{/literal}{sugar_translate label='LBL_DATOS_INS_REG_MERCANTIL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_representante_legal', 'varchar', false,'{/literal}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_representante_legal', 'varchar', false,'{/literal}{sugar_translate label='LBL_REPRESENTANTE_LEGAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_domicilio_representante', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_domicilio_representante', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOMICILIO_REPRESENTANTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad1_cargo_representante', 'varchar', false,'{/literal}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'sociedad2_cargo_representante', 'varchar', false,'{/literal}{sugar_translate label='LBL_CARGO_REPRESENTANTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_contrato_firma', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_CONTRATO_FIRMA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'franquicia_piloto', 'varchar', false,'{/literal}{sugar_translate label='LBL_FRANQUICIA_PILOTO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'contrato_condiciones_especiales', 'varchar', false,'{/literal}{sugar_translate label='LBL_CONDICIONES_ESPECIALES' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'local_titularidad', 'varchar', false,'{/literal}{sugar_translate label='LBL_LOCAL_TITULARIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'local_Direccion', 'varchar', false,'{/literal}{sugar_translate label='LBL_DIRECCION' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'local_municipio', 'varchar', false,'{/literal}{sugar_translate label='LBL_MUNICIPIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'f_apertura', 'date', false,'{/literal}{sugar_translate label='LBL_FECHA_APERTURA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'zona_exlusividad', 'text', false,'{/literal}{sugar_translate label='LBL_ZONA_EXCLUSIVIDAD' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'entidad_financiera', 'varchar', false,'{/literal}{sugar_translate label='LBL_ENTIDAD_FINANCIERA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'n_cuenta', 'varchar', false,'{/literal}{sugar_translate label='LBL_CUENTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'lugar_formacion_preferente', 'varchar', false,'{/literal}{sugar_translate label='LBL_LUGAR_FORMACION_PREFERENTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'modelo_franquicia', 'varchar', false,'{/literal}{sugar_translate label='LBL_MODELO_FRANQUICIA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'lineas_negocio', 'varchar', false,'{/literal}{sugar_translate label='LBL_LINEAS_NEGOCIO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'canon_entrada_definitivo', 'varchar', false,'{/literal}{sugar_translate label='LBL_CANON_ENTRADA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'importe_abonado', 'varchar', false,'{/literal}{sugar_translate label='LBL_IMPORTE_ABONADO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'marca', 'varchar', false,'{/literal}{sugar_translate label='LBL_MARCA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'estado_marca', 'varchar', false,'{/literal}{sugar_translate label='LBL_ESTADO_MARCA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'propietario_marca', 'varchar', false,'{/literal}{sugar_translate label='LBL_PROPIETARIO_MARCA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'codigo_marca', 'varchar', false,'{/literal}{sugar_translate label='LBL_CODIGO_MARCA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'duracion_contrato', 'varchar', false,'{/literal}{sugar_translate label='LBL_DURACION_CONTRATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'pago_en_cuenta', 'varchar', false,'{/literal}{sugar_translate label='LBL_PAGO_EN_CUENTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'cuenta_expande', 'varchar', false,'{/literal}{sugar_translate label='LBL_CUENTA_EXPANDE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'entidad_fin_expande', 'varchar', false,'{/literal}{sugar_translate label='LBL_ENTIDAD_FIN_EXPANDE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'cuenta_franquiciador', 'varchar', false,'{/literal}{sugar_translate label='LBL_CUENTA_FRANQUICIADOR' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'entidad_fin_franquiciador', 'varchar', false,'{/literal}{sugar_translate label='LBL_ENTIDAD_FIN_FRANQUICIADOR' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'inversion_inicial', 'varchar', false,'{/literal}{sugar_translate label='LBL_INVERSION_INICIAL' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'royalty_explotacion', 'varchar', false,'{/literal}{sugar_translate label='LBL_ROYALTY_EXPLOTA' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'min_royalty', 'varchar', false,'{/literal}{sugar_translate label='LBL_MIN_ROYALTY' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'fondo_marketing', 'varchar', false,'{/literal}{sugar_translate label='LBL_FONDO_MARKETING' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'observacion_contrato', 'text', false,'{/literal}{sugar_translate label='LBL_OBSERVACION_CONTRATO' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'expan_solicitud_expan_gestionsolicitudes_1_name', 'relate', false,'{/literal}{sugar_translate label='LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidate('EditView', 'motivo_descarte_c', 'text', false,'{/literal}{sugar_translate label='LBL_MOTIVO_DESCARTE' module='Expan_GestionSolicitudes' for_js=true}{literal}' );
addToValidateBinaryDependency('EditView', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Expan_GestionSolicitudes' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='Expan_GestionSolicitudes' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('EditView', 'modified_by_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Expan_GestionSolicitudes' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='Expan_GestionSolicitudes' for_js=true}{literal}', 'modified_user_id' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['EditView_assigned_user_name']={"form":"EditView","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"Sin coincidencias"};sqs_objects['EditView_modified_by_name']={"form":"EditView","method":"get_user_array","field_list":["user_name","id"],"populate_list":["modified_by_name","modified_user_id"],"required_list":["modified_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"Sin coincidencias"};</script>{/literal}
