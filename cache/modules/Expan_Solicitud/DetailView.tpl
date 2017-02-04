

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
<div class="action_buttons">{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_Solicitud'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}  {if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_Solicitud'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if}  {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Expan_Solicitud", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Expan_Solicitud_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='LBL_CONTACT_INFORMATION' module='Expan_Solicitud'}</em></a></li>

<li><a id="tab1" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL4' module='Expan_Solicitud'}</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL2' module='Expan_Solicitud'}</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Expan_Solicitud'}</em></a></li>
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
<table id='LBL_CONTACT_INFORMATION' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('first_name','varchar')" class="div_value" id="first_name_detailblock" target_id="first_name">
{if !$fields.first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.first_name.value) <= 0}
{assign var="value" value=$fields.first_name.default_value }
{else}
{assign var="value" value=$fields.first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.first_name.name}">{$fields.first_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.empresa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMPRESA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('empresa','varchar')" class="div_value" id="empresa_detailblock" target_id="empresa">
{if !$fields.empresa.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.empresa.value) <= 0}
{assign var="value" value=$fields.empresa.default_value }
{else}
{assign var="value" value=$fields.empresa.value }
{/if} 
<span class="sugar_field" id="{$fields.empresa.name}">{$fields.empresa.value}</span>
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
{if !$fields.last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('last_name','varchar')" class="div_value" id="last_name_detailblock" target_id="last_name">
{if !$fields.last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.last_name.value) <= 0}
{assign var="value" value=$fields.last_name.default_value }
{else}
{assign var="value" value=$fields.last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.last_name.name}">{$fields.last_name.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.phone_mobile.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOBILE_PHONE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_mobile','phone')" class="div_value" id="phone_mobile_detailblock" target_id="phone_mobile">
{if !$fields.phone_mobile.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_mobile.value)}
{assign var="phone_value" value=$fields.phone_mobile.value }
{sugar_phone value=$phone_value usa_format="0"}
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
{if !$fields.email1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMAIL_ADDRESS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('email1','varchar')" class="div_value" id="email1_detailblock" target_id="email1">
{if !$fields.email1.hidden}
{counter name="panelFieldCount"}
<span id='email1_span'>
{$fields.email1.value}
</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.phone_home.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_HOME_PHONE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_home','phone')" class="div_value" id="phone_home_detailblock" target_id="phone_home">
{if !$fields.phone_home.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_home.value)}
{assign var="phone_value" value=$fields.phone_home.value }
{sugar_phone value=$phone_value usa_format="0"}
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
{if !$fields.skype.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SKYPE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('skype','varchar')" class="div_value" id="skype_detailblock" target_id="skype">
{if !$fields.skype.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.skype.value) <= 0}
{assign var="value" value=$fields.skype.default_value }
{else}
{assign var="value" value=$fields.skype.value }
{/if} 
<span class="sugar_field" id="{$fields.skype.name}">{$fields.skype.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.phone_work.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OFFICE_PHONE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_work','phone')" class="div_value" id="phone_work_detailblock" target_id="phone_work">
{if !$fields.phone_work.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_work.value)}
{assign var="phone_value" value=$fields.phone_work.value }
{sugar_phone value=$phone_value usa_format="0"}
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
{if !$fields.no_correos_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NO_CORREOS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('no_correos_c','bool')" class="div_value" id="no_correos_c_detailblock" target_id="no_correos_c">
{if !$fields.no_correos_c.hidden}
{counter name="panelFieldCount"}

{if strval($fields.no_correos_c.value) == "1" || strval($fields.no_correos_c.value) == "yes" || strval($fields.no_correos_c.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.no_correos_c.name}" id="{$fields.no_correos_c.name}" value="$fields.no_correos_c.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.do_not_call.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DO_NOT_CALL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('do_not_call','bool')" class="div_value" id="do_not_call_detailblock" target_id="do_not_call">
{if !$fields.do_not_call.hidden}
{counter name="panelFieldCount"}

{if strval($fields.do_not_call.value) == "1" || strval($fields.do_not_call.value) == "yes" || strval($fields.do_not_call.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.do_not_call.name}" id="{$fields.do_not_call.name}" value="$fields.do_not_call.value" disabled="true" {$checked}>
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
{if !$fields.pais_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAIS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pais_c','enum')" class="div_value" id="pais_c_detailblock" target_id="pais_c">
{if !$fields.pais_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.pais_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.pais_c.name}" value="{ $fields.pais_c.options }">
{ $fields.pais_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.pais_c.name}" value="{ $fields.pais_c.value }">
{ $fields.pais_c.options[$fields.pais_c.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.fecha_primer_contacto.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_PRIMER_CONTACTO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fecha_primer_contacto','date')" class="div_value" id="fecha_primer_contacto_detailblock" target_id="fecha_primer_contacto">
{if !$fields.fecha_primer_contacto.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.fecha_primer_contacto.value) <= 0}
{assign var="value" value=$fields.fecha_primer_contacto.default_value }
{else}
{assign var="value" value=$fields.fecha_primer_contacto.value }
{/if}
<span class="sugar_field" id="{$fields.fecha_primer_contacto.name}">{$value}</span>
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
{if !$fields.provincia_apertura_1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_APERTURA_1' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_1','enum')" class="div_value" id="provincia_apertura_1_detailblock" target_id="provincia_apertura_1">
{if !$fields.provincia_apertura_1.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_apertura_1.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_1.name}" value="{ $fields.provincia_apertura_1.options }">
{ $fields.provincia_apertura_1.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_1.name}" value="{ $fields.provincia_apertura_1.value }">
{ $fields.provincia_apertura_1.options[$fields.provincia_apertura_1.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.localidad_apertura_1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_APERTURA_1' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_1','varchar')" class="div_value" id="localidad_apertura_1_detailblock" target_id="localidad_apertura_1">
{if !$fields.localidad_apertura_1.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.localidad_apertura_1.value) <= 0}
{assign var="value" value=$fields.localidad_apertura_1.default_value }
{else}
{assign var="value" value=$fields.localidad_apertura_1.value }
{/if} 
<span class="sugar_field" id="{$fields.localidad_apertura_1.name}">{$fields.localidad_apertura_1.value}</span>
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
{if !$fields.provincia_apertura_2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_APERTURA_2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_2','enum')" class="div_value" id="provincia_apertura_2_detailblock" target_id="provincia_apertura_2">
{if !$fields.provincia_apertura_2.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_apertura_2.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_2.name}" value="{ $fields.provincia_apertura_2.options }">
{ $fields.provincia_apertura_2.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_2.name}" value="{ $fields.provincia_apertura_2.value }">
{ $fields.provincia_apertura_2.options[$fields.provincia_apertura_2.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.localidad_apertura_2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_APERTURA_2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_2','varchar')" class="div_value" id="localidad_apertura_2_detailblock" target_id="localidad_apertura_2">
{if !$fields.localidad_apertura_2.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.localidad_apertura_2.value) <= 0}
{assign var="value" value=$fields.localidad_apertura_2.default_value }
{else}
{assign var="value" value=$fields.localidad_apertura_2.value }
{/if} 
<span class="sugar_field" id="{$fields.localidad_apertura_2.name}">{$fields.localidad_apertura_2.value}</span>
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
{if !$fields.provincia_apertura_3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_APERTURA_3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_3','enum')" class="div_value" id="provincia_apertura_3_detailblock" target_id="provincia_apertura_3">
{if !$fields.provincia_apertura_3.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_apertura_3.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_3.name}" value="{ $fields.provincia_apertura_3.options }">
{ $fields.provincia_apertura_3.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_apertura_3.name}" value="{ $fields.provincia_apertura_3.value }">
{ $fields.provincia_apertura_3.options[$fields.provincia_apertura_3.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.localidad_apertura_3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_APERTURA_3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_3','varchar')" class="div_value" id="localidad_apertura_3_detailblock" target_id="localidad_apertura_3">
{if !$fields.localidad_apertura_3.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.localidad_apertura_3.value) <= 0}
{assign var="value" value=$fields.localidad_apertura_3.default_value }
{else}
{assign var="value" value=$fields.localidad_apertura_3.value }
{/if} 
<span class="sugar_field" id="{$fields.localidad_apertura_3.name}">{$fields.localidad_apertura_3.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_OPORTUNIDAD_INMEDIATA' module='Expan_Solicitud'}{/capture}
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
{if !$fields.candidatura_caliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CANDIDATURA_CALIENTE' module='Expan_Solicitud'}{/capture}
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
{if !$fields.disp_contacto.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPONIBILIDAD_HORARIA_CONTACTO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('disp_contacto','enum')" class="div_value" id="disp_contacto_detailblock" target_id="disp_contacto">
{if !$fields.disp_contacto.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.disp_contacto.options)}
<input type="hidden" class="sugar_field" id="{$fields.disp_contacto.name}" value="{ $fields.disp_contacto.options }">
{ $fields.disp_contacto.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.disp_contacto.name}" value="{ $fields.disp_contacto.value }">
{ $fields.disp_contacto.options[$fields.disp_contacto.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.zona.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ZONA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona','enum')" class="div_value" id="zona_detailblock" target_id="zona">
{if !$fields.zona.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.zona.options)}
<input type="hidden" class="sugar_field" id="{$fields.zona.name}" value="{ $fields.zona.options }">
{ $fields.zona.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.zona.name}" value="{ $fields.zona.value }">
{ $fields.zona.options[$fields.zona.value]}
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
</td>
<td width='37.5%' colspan='2' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('primary_address_street','varchar')" class="div_value" id="primary_address_street_detailblock" target_id="primary_address_street">
{if !$fields.primary_address_street.hidden}
{counter name="panelFieldCount"}

<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td width='99%' >
<input type="hidden" class="sugar_field" id="primary_address_street" value="{$fields.primary_address_street.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="sugar_field" id="primary_address_city" value="{$fields.primary_address_city.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="sugar_field" id="primary_address_state" value="{$fields.primary_address_state.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="sugar_field" id="primary_address_country" value="{$fields.primary_address_country.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="sugar_field" id="primary_address_postalcode" value="{$fields.primary_address_postalcode.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
{$fields.primary_address_street.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}<br>
{$fields.primary_address_city.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br} {$fields.primary_address_state.value|escape:'htmlentitydecode'|strip_tags|url2html|nl2br}&nbsp;&nbsp;{$fields.primary_address_postalcode.value|escape:'htmlentitydecode'|strip_tags|url2html|nl2br}<br>
{$fields.primary_address_country.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}
</td>
<td class='dataField' width='1%'>
{$custom_code_primary}
</td>
</tr>
</table>
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
<script>document.getElementById("LBL_CONTACT_INFORMATION").style.display='none';</script>
{/if}
</div>    <div id='tabcontent1'>
<div id='detailpanel_2' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL4' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.contacto_secundario.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CONTACTO_SECUNDARIO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('contacto_secundario','varchar')" class="div_value" id="contacto_secundario_detailblock" target_id="contacto_secundario">
{if !$fields.contacto_secundario.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.contacto_secundario.value) <= 0}
{assign var="value" value=$fields.contacto_secundario.default_value }
{else}
{assign var="value" value=$fields.contacto_secundario.value }
{/if} 
<span class="sugar_field" id="{$fields.contacto_secundario.name}">{$fields.contacto_secundario.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.correo_secundario.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CORREO_SECUNDARIO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('correo_secundario','varchar')" class="div_value" id="correo_secundario_detailblock" target_id="correo_secundario">
{if !$fields.correo_secundario.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.correo_secundario.value) <= 0}
{assign var="value" value=$fields.correo_secundario.default_value }
{else}
{assign var="value" value=$fields.correo_secundario.value }
{/if} 
<span class="sugar_field" id="{$fields.correo_secundario.name}">{$fields.correo_secundario.value}</span>
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
{if !$fields.phone_other.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OTHER_PHONE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_other','phone')" class="div_value" id="phone_other_detailblock" target_id="phone_other">
{if !$fields.phone_other.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_other.value)}
{assign var="phone_value" value=$fields.phone_other.value }
{sugar_phone value=$phone_value usa_format="0"}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.observaciones_contacto_sec.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_CONTACTO_SEC' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
{if !$fields.observaciones_contacto_sec.hidden}
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
{if !$fields.alt_address_street.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ALT_ADDRESS_STREET' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('alt_address_street','varchar')" class="div_value" id="alt_address_street_detailblock" target_id="alt_address_street">
{if !$fields.alt_address_street.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.alt_address_street.value) <= 0}
{assign var="value" value=$fields.alt_address_street.default_value }
{else}
{assign var="value" value=$fields.alt_address_street.value }
{/if} 
<span class="sugar_field" id="{$fields.alt_address_street.name}">{$fields.alt_address_street.value}</span>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL4").style.display='none';</script>
{/if}
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL2' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.franquicias_secundarias.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIAS_SECUNDARIAS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicias_secundarias','multienum')" class="div_value" id="franquicias_secundarias_detailblock" target_id="franquicias_secundarias">
{if !$fields.franquicias_secundarias.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.franquicias_secundarias.value) && ($fields.franquicias_secundarias.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.franquicias_secundarias.name}" value="{$fields.franquicias_secundarias.value}">
{multienum_to_array string=$fields.franquicias_secundarias.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.franquicias_secundarias.options.$item }</li>
{/foreach}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sectores_de_interes.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SECTORES_DE_INTERES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sectores_de_interes','multienum')" class="div_value" id="sectores_de_interes_detailblock" target_id="sectores_de_interes">
{if !$fields.sectores_de_interes.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.sectores_de_interes.value) && ($fields.sectores_de_interes.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.sectores_de_interes.name}" value="{$fields.sectores_de_interes.value}">
{multienum_to_array string=$fields.sectores_de_interes.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.sectores_de_interes.options.$item }</li>
{/foreach}
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
{if !$fields.perfil_franquicia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PERFIL_FRANQUICIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_franquicia','enum')" class="div_value" id="perfil_franquicia_detailblock" target_id="perfil_franquicia">
{if !$fields.perfil_franquicia.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.perfil_franquicia.options)}
<input type="hidden" class="sugar_field" id="{$fields.perfil_franquicia.name}" value="{ $fields.perfil_franquicia.options }">
{ $fields.perfil_franquicia.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.perfil_franquicia.name}" value="{ $fields.perfil_franquicia.value }">
{ $fields.perfil_franquicia.options[$fields.perfil_franquicia.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.situacion_profesional.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SITUACION_PROFESIONAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('situacion_profesional','enum')" class="div_value" id="situacion_profesional_detailblock" target_id="situacion_profesional">
{if !$fields.situacion_profesional.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.situacion_profesional.options)}
<input type="hidden" class="sugar_field" id="{$fields.situacion_profesional.name}" value="{ $fields.situacion_profesional.options }">
{ $fields.situacion_profesional.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.situacion_profesional.name}" value="{ $fields.situacion_profesional.value }">
{ $fields.situacion_profesional.options[$fields.situacion_profesional.value]}
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
{if !$fields.perfil_profesional.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PERFIL_PROFESIONAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_profesional','text')" class="div_value" id="perfil_profesional_detailblock" target_id="perfil_profesional">
{if !$fields.perfil_profesional.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.perfil_profesional.name|escape:'html'|url2html|nl2br}">{$fields.perfil_profesional.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.cuando_empezar.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUANDO_EMPEZAR' module='Expan_Solicitud'}{/capture}
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
{if !$fields.observaciones_solicitud.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_SOLICITUD' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Los datos contenidos en estas observaciones no llegan a la central" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_solicitud','text')" class="div_value" id="observaciones_solicitud_detailblock" target_id="observaciones_solicitud">
{if !$fields.observaciones_solicitud.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observaciones_solicitud.name|escape:'html'|url2html|nl2br}">{$fields.observaciones_solicitud.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{if !$fields.capital.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAPITAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('capital','enum')" class="div_value" id="capital_detailblock" target_id="capital">
{if !$fields.capital.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.capital.options)}
<input type="hidden" class="sugar_field" id="{$fields.capital.name}" value="{ $fields.capital.options }">
{ $fields.capital.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.capital.name}" value="{ $fields.capital.value }">
{ $fields.capital.options[$fields.capital.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.capital_observaciones.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAPITAL_OBSERVACIONES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('capital_observaciones','varchar')" class="div_value" id="capital_observaciones_detailblock" target_id="capital_observaciones">
{if !$fields.capital_observaciones.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.capital_observaciones.value) <= 0}
{assign var="value" value=$fields.capital_observaciones.default_value }
{else}
{assign var="value" value=$fields.capital_observaciones.value }
{/if} 
<span class="sugar_field" id="{$fields.capital_observaciones.name}">{$fields.capital_observaciones.value}</span>
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
{if !$fields.recursos_propios.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RECURSOS_PROPIOS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
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
{if !$fields.sectores_de_interes.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SECTORES_DE_INTERES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sectores_de_interes','multienum')" class="div_value" id="sectores_de_interes_detailblock" target_id="sectores_de_interes">
{if !$fields.sectores_de_interes.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.sectores_de_interes.value) && ($fields.sectores_de_interes.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.sectores_de_interes.name}" value="{$fields.sectores_de_interes.value}">
{multienum_to_array string=$fields.sectores_de_interes.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.sectores_de_interes.options.$item }</li>
{/foreach}
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
{if !$fields.franquicias_secundarias.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIAS_SECUNDARIAS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicias_secundarias','multienum')" class="div_value" id="franquicias_secundarias_detailblock" target_id="franquicias_secundarias">
{if !$fields.franquicias_secundarias.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.franquicias_secundarias.value) && ($fields.franquicias_secundarias.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.franquicias_secundarias.name}" value="{$fields.franquicias_secundarias.value}">
{multienum_to_array string=$fields.franquicias_secundarias.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.franquicias_secundarias.options.$item }</li>
{/foreach}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.franquicia_principal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_PRINCIPAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_principal','enum')" class="div_value" id="franquicia_principal_detailblock" target_id="franquicia_principal">
{if !$fields.franquicia_principal.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.franquicia_principal.options)}
<input type="hidden" class="sugar_field" id="{$fields.franquicia_principal.name}" value="{ $fields.franquicia_principal.options }">
{ $fields.franquicia_principal.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.franquicia_principal.name}" value="{ $fields.franquicia_principal.value }">
{ $fields.franquicia_principal.options[$fields.franquicia_principal.value]}
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
{if !$fields.franquicias_contactadas.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIAS_CONTACTADAS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicias_contactadas','varchar')" class="div_value" id="franquicias_contactadas_detailblock" target_id="franquicias_contactadas">
{if !$fields.franquicias_contactadas.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.franquicias_contactadas.value) <= 0}
{assign var="value" value=$fields.franquicias_contactadas.default_value }
{else}
{assign var="value" value=$fields.franquicias_contactadas.value }
{/if} 
<span class="sugar_field" id="{$fields.franquicias_contactadas.name}">{$fields.franquicias_contactadas.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.otras_franquicias.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OTRAS_FRANQUICIAS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otras_franquicias','varchar')" class="div_value" id="otras_franquicias_detailblock" target_id="otras_franquicias">
{if !$fields.otras_franquicias.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.otras_franquicias.value) <= 0}
{assign var="value" value=$fields.otras_franquicias.default_value }
{else}
{assign var="value" value=$fields.otras_franquicias.value }
{/if} 
<span class="sugar_field" id="{$fields.otras_franquicias.name}">{$fields.otras_franquicias.value}</span>
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
{if !$fields.enviar_servicios_asesora.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENVIAR_SERVICIOS_ASESORA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('enviar_servicios_asesora','bool')" class="div_value" id="enviar_servicios_asesora_detailblock" target_id="enviar_servicios_asesora">
{if !$fields.enviar_servicios_asesora.hidden}
{counter name="panelFieldCount"}

{if strval($fields.enviar_servicios_asesora.value) == "1" || strval($fields.enviar_servicios_asesora.value) == "yes" || strval($fields.enviar_servicios_asesora.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.enviar_servicios_asesora.name}" id="{$fields.enviar_servicios_asesora.name}" value="$fields.enviar_servicios_asesora.value" disabled="true" {$checked}>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_TIPO_ORIGEN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tipo_origen','multienum')" class="div_value" id="tipo_origen_detailblock" target_id="tipo_origen">
{if !$fields.tipo_origen.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.tipo_origen.value) && ($fields.tipo_origen.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.tipo_origen.name}" value="{$fields.tipo_origen.value}">
{multienum_to_array string=$fields.tipo_origen.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.tipo_origen.options.$item }</li>
{/foreach}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.subor_expande.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_EXPANDE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_expande','enum')" class="div_value" id="subor_expande_detailblock" target_id="subor_expande">
{if !$fields.subor_expande.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.subor_expande.options)}
<input type="hidden" class="sugar_field" id="{$fields.subor_expande.name}" value="{ $fields.subor_expande.options }">
{ $fields.subor_expande.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.subor_expande.name}" value="{ $fields.subor_expande.value }">
{ $fields.subor_expande.options[$fields.subor_expande.value]}
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
{if !$fields.portal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PORTAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('portal','enum')" class="div_value" id="portal_detailblock" target_id="portal">
{if !$fields.portal.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.portal.options)}
<input type="hidden" class="sugar_field" id="{$fields.portal.name}" value="{ $fields.portal.options }">
{ $fields.portal.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.portal.name}" value="{ $fields.portal.value }">
{ $fields.portal.options[$fields.portal.value]}
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
{if !$fields.expan_evento_id_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EVENTO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_evento_id_c','enum')" class="div_value" id="expan_evento_id_c_detailblock" target_id="expan_evento_id_c">
{if !$fields.expan_evento_id_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.expan_evento_id_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.expan_evento_id_c.name}" value="{ $fields.expan_evento_id_c.options }">
{ $fields.expan_evento_id_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.expan_evento_id_c.name}" value="{ $fields.expan_evento_id_c.value }">
{ $fields.expan_evento_id_c.options[$fields.expan_evento_id_c.value]}
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
{if !$fields.subor_central.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_CENTRAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_central','enum')" class="div_value" id="subor_central_detailblock" target_id="subor_central">
{if !$fields.subor_central.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.subor_central.options)}
<input type="hidden" class="sugar_field" id="{$fields.subor_central.name}" value="{ $fields.subor_central.options }">
{ $fields.subor_central.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.subor_central.name}" value="{ $fields.subor_central.value }">
{ $fields.subor_central.options[$fields.subor_central.value]}
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
{if !$fields.subor_medios.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_MEDIOS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_medios','enum')" class="div_value" id="subor_medios_detailblock" target_id="subor_medios">
{if !$fields.subor_medios.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.subor_medios.options)}
<input type="hidden" class="sugar_field" id="{$fields.subor_medios.name}" value="{ $fields.subor_medios.options }">
{ $fields.subor_medios.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.subor_medios.name}" value="{ $fields.subor_medios.value }">
{ $fields.subor_medios.options[$fields.subor_medios.value]}
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
{if !$fields.subor_mailing.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBOR_MAILING' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_mailing','enum')" class="div_value" id="subor_mailing_detailblock" target_id="subor_mailing">
{if !$fields.subor_mailing.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.subor_mailing.options)}
<input type="hidden" class="sugar_field" id="{$fields.subor_mailing.name}" value="{ $fields.subor_mailing.options }">
{ $fields.subor_mailing.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.subor_mailing.name}" value="{ $fields.subor_mailing.value }">
{ $fields.subor_mailing.options[$fields.subor_mailing.value]}
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
{if !$fields.rating.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RATING' module='Expan_Solicitud'}{/capture}
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
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.perfil_plurifranquiciado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PERFIL_PLURIFRANQUICIADO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_plurifranquiciado','enum')" class="div_value" id="perfil_plurifranquiciado_detailblock" target_id="perfil_plurifranquiciado">
{if !$fields.perfil_plurifranquiciado.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.perfil_plurifranquiciado.options)}
<input type="hidden" class="sugar_field" id="{$fields.perfil_plurifranquiciado.name}" value="{ $fields.perfil_plurifranquiciado.options }">
{ $fields.perfil_plurifranquiciado.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.perfil_plurifranquiciado.name}" value="{ $fields.perfil_plurifranquiciado.value }">
{ $fields.perfil_plurifranquiciado.options[$fields.perfil_plurifranquiciado.value]}
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
<script>document.getElementById("LBL_EDITVIEW_PANEL2").style.display='none';</script>
{/if}
</div>    <div id='tabcontent3'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL1' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dispone_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPONE_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('dispone_local','bool')" class="div_value" id="dispone_local_detailblock" target_id="dispone_local">
{if !$fields.dispone_local.hidden}
{counter name="panelFieldCount"}

{if strval($fields.dispone_local.value) == "1" || strval($fields.dispone_local.value) == "yes" || strval($fields.dispone_local.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.dispone_local.name}" id="{$fields.dispone_local.name}" value="$fields.dispone_local.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.negocio_anterior_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEGOCIO_ANTERIOR_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('negocio_anterior_local','varchar')" class="div_value" id="negocio_anterior_local_detailblock" target_id="negocio_anterior_local">
{if !$fields.negocio_anterior_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.negocio_anterior_local.value) <= 0}
{assign var="value" value=$fields.negocio_anterior_local.default_value }
{else}
{assign var="value" value=$fields.negocio_anterior_local.value }
{/if} 
<span class="sugar_field" id="{$fields.negocio_anterior_local.name}">{$fields.negocio_anterior_local.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION_LOCAL' module='Expan_Solicitud'}{/capture}
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
{if !$fields.superficie_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUPERFICIE_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local','int')" class="div_value" id="superficie_local_detailblock" target_id="superficie_local">
{if !$fields.superficie_local.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.superficie_local.name}">
{sugar_number_format precision=0 var=$fields.superficie_local.value}
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
{if !$fields.direccion_local2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION_LOCAL2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local2','varchar')" class="div_value" id="direccion_local2_detailblock" target_id="direccion_local2">
{if !$fields.direccion_local2.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.direccion_local2.value) <= 0}
{assign var="value" value=$fields.direccion_local2.default_value }
{else}
{assign var="value" value=$fields.direccion_local2.value }
{/if} 
<span class="sugar_field" id="{$fields.direccion_local2.name}">{$fields.direccion_local2.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.superficie_local2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUPERFICIE_LOCAL2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local2','int')" class="div_value" id="superficie_local2_detailblock" target_id="superficie_local2">
{if !$fields.superficie_local2.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.superficie_local2.name}">
{sugar_number_format precision=0 var=$fields.superficie_local2.value}
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
{if !$fields.direccion_local3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DIRECCION_LOCAL3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local3','varchar')" class="div_value" id="direccion_local3_detailblock" target_id="direccion_local3">
{if !$fields.direccion_local3.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.direccion_local3.value) <= 0}
{assign var="value" value=$fields.direccion_local3.default_value }
{else}
{assign var="value" value=$fields.direccion_local3.value }
{/if} 
<span class="sugar_field" id="{$fields.direccion_local3.name}">{$fields.direccion_local3.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.superficie_local3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUPERFICIE_LOCAL3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local3','int')" class="div_value" id="superficie_local3_detailblock" target_id="superficie_local3">
{if !$fields.superficie_local3.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.superficie_local3.name}">
{sugar_number_format precision=0 var=$fields.superficie_local3.value}
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
{if !$fields.descripcion_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPCION_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local','varchar')" class="div_value" id="descripcion_local_detailblock" target_id="descripcion_local">
{if !$fields.descripcion_local.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.descripcion_local.value) <= 0}
{assign var="value" value=$fields.descripcion_local.default_value }
{else}
{assign var="value" value=$fields.descripcion_local.value }
{/if} 
<span class="sugar_field" id="{$fields.descripcion_local.name}">{$fields.descripcion_local.value}</span>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL1").style.display='none';</script>
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
var Expan_Solicitud_detailview_tabs = new YAHOO.widget.TabView("Expan_Solicitud_detailview_tabs");
Expan_Solicitud_detailview_tabs.selectTab(0);
</script>
<script src='include/javascript/enhanced_detailview.js'></script>
<script src='include/javascript/popup_helper.js'></script>
<script type='text/javascript'>
	EDV.calendar_format = "{$CALENDAR_FORMAT}";
</script>