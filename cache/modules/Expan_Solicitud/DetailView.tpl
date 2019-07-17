

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

<li><a id="tab1" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL2' module='Expan_Solicitud'}</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Expan_Solicitud'}</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL_TAG' module='Expan_Solicitud'}</em></a></li>
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
{if !$fields.first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('first_name','varchar')" class="div_value" id="first_name_detailblock" target_id="first_name">
{if !$fields.first_name.hidden}
{counter name="panelFieldCount"}
<span id="first_name" class="sugar_field"><b><p style="font-size:14px;">{$fields.first_name.value}</p></b></span>
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
<span id="last_name" class="sugar_field"><b><p style="font-size:14px;">{$fields.last_name.value}</p></b></span>
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
{if !$fields.linkedin.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LINKEDIN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('linkedin','varchar')" class="div_value" id="linkedin_detailblock" target_id="linkedin">
{if !$fields.linkedin.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.linkedin.value) <= 0}
{assign var="value" value=$fields.linkedin.default_value }
{else}
{assign var="value" value=$fields.linkedin.value }
{/if} 
<span class="sugar_field" id="{$fields.linkedin.name}">{$fields.linkedin.value}</span>
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
{if !$fields.no_newsletter.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEWSLETTER' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('no_newsletter','bool')" class="div_value" id="no_newsletter_detailblock" target_id="no_newsletter">
{if !$fields.no_newsletter.hidden}
{counter name="panelFieldCount"}

{if strval($fields.no_newsletter.value) == "1" || strval($fields.no_newsletter.value) == "yes" || strval($fields.no_newsletter.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.no_newsletter.name}" id="{$fields.no_newsletter.name}" value="$fields.no_newsletter.value" disabled="true" {$checked}>
{/if}
</div>
</td>
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
{if !$fields.master.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MASTER_FRANQUICIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('master','bool')" class="div_value" id="master_detailblock" target_id="master">
{if !$fields.master.hidden}
{counter name="panelFieldCount"}

{if strval($fields.master.value) == "1" || strval($fields.master.value) == "yes" || strval($fields.master.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.master.name}" id="{$fields.master.name}" value="$fields.master.value" disabled="true" {$checked}>
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
{if !$fields.provincia_residencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_RESIDENCIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_residencia','enum')" class="div_value" id="provincia_residencia_detailblock" target_id="provincia_residencia">
{if !$fields.provincia_residencia.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_residencia.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_residencia.name}" value="{ $fields.provincia_residencia.options }">
{ $fields.provincia_residencia.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_residencia.name}" value="{ $fields.provincia_residencia.value }">
{ $fields.provincia_residencia.options[$fields.provincia_residencia.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.localidad_residencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCALIDAD_RESIDENCIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_residencia','varchar')" class="div_value" id="localidad_residencia_detailblock" target_id="localidad_residencia">
{if !$fields.localidad_residencia.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.localidad_residencia.value) <= 0}
{assign var="value" value=$fields.localidad_residencia.default_value }
{else}
{assign var="value" value=$fields.localidad_residencia.value }
{/if} 
<span class="sugar_field" id="{$fields.localidad_residencia.name}">{$fields.localidad_residencia.value}</span>
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
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_1','enum')" class="div_value" id="localidad_apertura_1_detailblock" target_id="localidad_apertura_1">
{if !$fields.localidad_apertura_1.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.localidad_apertura_1.options)}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_1.name}" value="{ $fields.localidad_apertura_1.options }">
{ $fields.localidad_apertura_1.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_1.name}" value="{ $fields.localidad_apertura_1.value }">
{ $fields.localidad_apertura_1.options[$fields.localidad_apertura_1.value]}
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
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_2','enum')" class="div_value" id="localidad_apertura_2_detailblock" target_id="localidad_apertura_2">
{if !$fields.localidad_apertura_2.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.localidad_apertura_2.options)}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_2.name}" value="{ $fields.localidad_apertura_2.options }">
{ $fields.localidad_apertura_2.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_2.name}" value="{ $fields.localidad_apertura_2.value }">
{ $fields.localidad_apertura_2.options[$fields.localidad_apertura_2.value]}
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
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_3','enum')" class="div_value" id="localidad_apertura_3_detailblock" target_id="localidad_apertura_3">
{if !$fields.localidad_apertura_3.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.localidad_apertura_3.options)}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_3.name}" value="{ $fields.localidad_apertura_3.options }">
{ $fields.localidad_apertura_3.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.localidad_apertura_3.name}" value="{ $fields.localidad_apertura_3.value }">
{ $fields.localidad_apertura_3.options[$fields.localidad_apertura_3.value]}
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
{if !$fields.observaciones_zona_apertura.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OBSERVACIONES_ZONA_APERTURA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_zona_apertura','text')" class="div_value" id="observaciones_zona_apertura_detailblock" target_id="observaciones_zona_apertura">
{if !$fields.observaciones_zona_apertura.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observaciones_zona_apertura.name|escape:'html'|url2html|nl2br}">{$fields.observaciones_zona_apertura.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<td width='12.5%' scope="col">
{if !$fields.pais_residencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAIS_RESIDENCIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pais_residencia','enum')" class="div_value" id="pais_residencia_detailblock" target_id="pais_residencia">
{if !$fields.pais_residencia.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.pais_residencia.options)}
<input type="hidden" class="sugar_field" id="{$fields.pais_residencia.name}" value="{ $fields.pais_residencia.options }">
{ $fields.pais_residencia.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.pais_residencia.name}" value="{ $fields.pais_residencia.value }">
{ $fields.pais_residencia.options[$fields.pais_residencia.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.provincia_residencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROVINCIA_RESIDENCIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_residencia','enum')" class="div_value" id="provincia_residencia_detailblock" target_id="provincia_residencia">
{if !$fields.provincia_residencia.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.provincia_residencia.options)}
<input type="hidden" class="sugar_field" id="{$fields.provincia_residencia.name}" value="{ $fields.provincia_residencia.options }">
{ $fields.provincia_residencia.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.provincia_residencia.name}" value="{ $fields.provincia_residencia.value }">
{ $fields.provincia_residencia.options[$fields.provincia_residencia.value]}
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
{if !$fields.check_puertas_abiertas.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PUERTAS_ABIERTAS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('check_puertas_abiertas','bool')" class="div_value" id="check_puertas_abiertas_detailblock" target_id="check_puertas_abiertas">
{if !$fields.check_puertas_abiertas.hidden}
{counter name="panelFieldCount"}

{if strval($fields.check_puertas_abiertas.value) == "1" || strval($fields.check_puertas_abiertas.value) == "yes" || strval($fields.check_puertas_abiertas.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.check_puertas_abiertas.name}" id="{$fields.check_puertas_abiertas.name}" value="$fields.check_puertas_abiertas.value" disabled="true" {$checked}>
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
<td width='37.5%' colspan='3' class="phone">
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
<table id='LBL_EDITVIEW_PANEL2' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.chk_entrevista_previa_cliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA_CLIENTE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_cliente','bool')" class="div_value" id="chk_entrevista_previa_cliente_detailblock" target_id="chk_entrevista_previa_cliente">
{if !$fields.chk_entrevista_previa_cliente.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa_cliente.value) == "1" || strval($fields.chk_entrevista_previa_cliente.value) == "yes" || strval($fields.chk_entrevista_previa_cliente.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista_previa_cliente.name}" id="{$fields.chk_entrevista_previa_cliente.name}" value="$fields.chk_entrevista_previa_cliente.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.chk_entrevista_previa_EN.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA_EN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_EN','bool')" class="div_value" id="chk_entrevista_previa_EN_detailblock" target_id="chk_entrevista_previa_EN">
{if !$fields.chk_entrevista_previa_EN.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa_EN.value) == "1" || strval($fields.chk_entrevista_previa_EN.value) == "yes" || strval($fields.chk_entrevista_previa_EN.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista_previa_EN.name}" id="{$fields.chk_entrevista_previa_EN.name}" value="$fields.chk_entrevista_previa_EN.value" disabled="true" {$checked}>
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
{if !$fields.chk_entrevista_previa_EN.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA_EN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_EN','bool')" class="div_value" id="chk_entrevista_previa_EN_detailblock" target_id="chk_entrevista_previa_EN">
{if !$fields.chk_entrevista_previa_EN.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa_EN.value) == "1" || strval($fields.chk_entrevista_previa_EN.value) == "yes" || strval($fields.chk_entrevista_previa_EN.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista_previa_EN.name}" id="{$fields.chk_entrevista_previa_EN.name}" value="$fields.chk_entrevista_previa_EN.value" disabled="true" {$checked}>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.chk_entrevista_previa_cliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENTREVISTA_PREVIA_CLIENTE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_cliente','bool')" class="div_value" id="chk_entrevista_previa_cliente_detailblock" target_id="chk_entrevista_previa_cliente">
{if !$fields.chk_entrevista_previa_cliente.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_entrevista_previa_cliente.value) == "1" || strval($fields.chk_entrevista_previa_cliente.value) == "yes" || strval($fields.chk_entrevista_previa_cliente.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_entrevista_previa_cliente.name}" id="{$fields.chk_entrevista_previa_cliente.name}" value="$fields.chk_entrevista_previa_cliente.value" disabled="true" {$checked}>
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
{if !$fields.f_entrevista_previa_EN.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENTREVISTA_PREVIA_EN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista_previa_EN','date')" class="div_value" id="f_entrevista_previa_EN_detailblock" target_id="f_entrevista_previa_EN">
{if !$fields.f_entrevista_previa_EN.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_entrevista_previa_EN.value) <= 0}
{assign var="value" value=$fields.f_entrevista_previa_EN.default_value }
{else}
{assign var="value" value=$fields.f_entrevista_previa_EN.value }
{/if}
<span class="sugar_field" id="{$fields.f_entrevista_previa_EN.name}">{$value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.f_entrevista_previa_cliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FECHA_ENTREVISTA_PREVIA_CLIENTE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista_previa_cliente','date')" class="div_value" id="f_entrevista_previa_cliente_detailblock" target_id="f_entrevista_previa_cliente">
{if !$fields.f_entrevista_previa_cliente.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.f_entrevista_previa_cliente.value) <= 0}
{assign var="value" value=$fields.f_entrevista_previa_cliente.default_value }
{else}
{assign var="value" value=$fields.f_entrevista_previa_cliente.value }
{/if}
<span class="sugar_field" id="{$fields.f_entrevista_previa_cliente.name}">{$value}</span>
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
{if !$fields.usuario_entrevista_previa_EN.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_USUARIO_ENTREVISTA_PREVIA_EN' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa_EN','varchar')" class="div_value" id="usuario_entrevista_previa_EN_detailblock" target_id="usuario_entrevista_previa_EN">
{if !$fields.usuario_entrevista_previa_EN.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.usuario_entrevista_previa_EN.value) <= 0}
{assign var="value" value=$fields.usuario_entrevista_previa_EN.default_value }
{else}
{assign var="value" value=$fields.usuario_entrevista_previa_EN.value }
{/if} 
<span class="sugar_field" id="{$fields.usuario_entrevista_previa_EN.name}">{$fields.usuario_entrevista_previa_EN.value}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.usuario_entrevista_previa_cliente.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_USUARIO_ENTREVISTA_PREVIA_CLIENTE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa_cliente','varchar')" class="div_value" id="usuario_entrevista_previa_cliente_detailblock" target_id="usuario_entrevista_previa_cliente">
{if !$fields.usuario_entrevista_previa_cliente.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.usuario_entrevista_previa_cliente.value) <= 0}
{assign var="value" value=$fields.usuario_entrevista_previa_cliente.default_value }
{else}
{assign var="value" value=$fields.usuario_entrevista_previa_cliente.value }
{/if} 
<span class="sugar_field" id="{$fields.usuario_entrevista_previa_cliente.name}">{$fields.usuario_entrevista_previa_cliente.value}</span>
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
{if !$fields.historial_empresa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_HISTORIAL_EMPRESA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('historial_empresa','multienum')" class="div_value" id="historial_empresa_detailblock" target_id="historial_empresa">
{if !$fields.historial_empresa.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.historial_empresa.value) && ($fields.historial_empresa.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.historial_empresa.name}" value="{$fields.historial_empresa.value}">
{multienum_to_array string=$fields.historial_empresa.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.historial_empresa.options.$item }</li>
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sectores_historicos.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SECTORES_HISTORICOS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se pueden añadir varios sectores separados por coma" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sectores_historicos','varchar')" class="div_value" id="sectores_historicos_detailblock" target_id="sectores_historicos">
{if !$fields.sectores_historicos.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sectores_historicos.value) <= 0}
{assign var="value" value=$fields.sectores_historicos.default_value }
{else}
{assign var="value" value=$fields.sectores_historicos.value }
{/if} 
<span class="sugar_field" id="{$fields.sectores_historicos.name}">{$fields.sectores_historicos.value}</span>
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.franquicia_historicos.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_HISTORICOS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se pueden añadir varias franquicias separadas por coma" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_historicos','varchar')" class="div_value" id="franquicia_historicos_detailblock" target_id="franquicia_historicos">
{if !$fields.franquicia_historicos.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.franquicia_historicos.value) <= 0}
{assign var="value" value=$fields.franquicia_historicos.default_value }
{else}
{assign var="value" value=$fields.franquicia_historicos.value }
{/if} 
<span class="sugar_field" id="{$fields.franquicia_historicos.name}">{$fields.franquicia_historicos.value}</span>
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
{if !$fields.inicio_franq_hst.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_INICIO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inicio_franq_hst','int')" class="div_value" id="inicio_franq_hst_detailblock" target_id="inicio_franq_hst">
{if !$fields.inicio_franq_hst.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.inicio_franq_hst.name}">
{sugar_number_format precision=0 var=$fields.inicio_franq_hst.value}
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.fin_franq_hst.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_CIERRE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fin_franq_hst','int')" class="div_value" id="fin_franq_hst_detailblock" target_id="fin_franq_hst">
{if !$fields.fin_franq_hst.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.fin_franq_hst.name}">
{sugar_number_format precision=0 var=$fields.fin_franq_hst.value}
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.franquicia_satisfa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FRANQUICIA_SATISFA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_satisfa','enum')" class="div_value" id="franquicia_satisfa_detailblock" target_id="franquicia_satisfa">
{if !$fields.franquicia_satisfa.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.franquicia_satisfa.options)}
<input type="hidden" class="sugar_field" id="{$fields.franquicia_satisfa.name}" value="{ $fields.franquicia_satisfa.options }">
{ $fields.franquicia_satisfa.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.franquicia_satisfa.name}" value="{ $fields.franquicia_satisfa.value }">
{ $fields.franquicia_satisfa.options[$fields.franquicia_satisfa.value]}
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
{if !$fields.chk_empresa_provee.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMPRESA_PROVEE' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="La empresa es proveedor" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_provee','bool')" class="div_value" id="chk_empresa_provee_detailblock" target_id="chk_empresa_provee">
{if !$fields.chk_empresa_provee.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_empresa_provee.value) == "1" || strval($fields.chk_empresa_provee.value) == "yes" || strval($fields.chk_empresa_provee.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_empresa_provee.name}" id="{$fields.chk_empresa_provee.name}" value="$fields.chk_empresa_provee.value" disabled="true" {$checked}>
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
{if !$fields.chk_empresa_cli_potencial.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMPRESA_CLI_POTENCIAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="La empresa es un cliente potencial" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_cli_potencial','bool')" class="div_value" id="chk_empresa_cli_potencial_detailblock" target_id="chk_empresa_cli_potencial">
{if !$fields.chk_empresa_cli_potencial.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_empresa_cli_potencial.value) == "1" || strval($fields.chk_empresa_cli_potencial.value) == "yes" || strval($fields.chk_empresa_cli_potencial.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_empresa_cli_potencial.name}" id="{$fields.chk_empresa_cli_potencial.name}" value="$fields.chk_empresa_cli_potencial.value" disabled="true" {$checked}>
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
{if !$fields.chk_empresa_competencia.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMPRESA_COMPETENCIA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="La empresa es competencia de nuestras franquicias" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_competencia','bool')" class="div_value" id="chk_empresa_competencia_detailblock" target_id="chk_empresa_competencia">
{if !$fields.chk_empresa_competencia.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_empresa_competencia.value) == "1" || strval($fields.chk_empresa_competencia.value) == "yes" || strval($fields.chk_empresa_competencia.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_empresa_competencia.name}" id="{$fields.chk_empresa_competencia.name}" value="$fields.chk_empresa_competencia.value" disabled="true" {$checked}>
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
{if !$fields.chk_empresa_alianza.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMPRESA_ALIANZA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="La empresa puede ser una alianza" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_alianza','bool')" class="div_value" id="chk_empresa_alianza_detailblock" target_id="chk_empresa_alianza">
{if !$fields.chk_empresa_alianza.hidden}
{counter name="panelFieldCount"}

{if strval($fields.chk_empresa_alianza.value) == "1" || strval($fields.chk_empresa_alianza.value) == "yes" || strval($fields.chk_empresa_alianza.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{$fields.chk_empresa_alianza.name}" id="{$fields.chk_empresa_alianza.name}" value="$fields.chk_empresa_alianza.value" disabled="true" {$checked}>
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
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_solicitud','text')" class="div_value" id="observaciones_solicitud_detailblock" target_id="observaciones_solicitud">
{if !$fields.observaciones_solicitud.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.observaciones_solicitud.name|escape:'html'|url2html|nl2br}">{$fields.observaciones_solicitud.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{if !$fields.rrss.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RRSS' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('rrss','text')" class="div_value" id="rrss_detailblock" target_id="rrss">
{if !$fields.rrss.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.rrss.name|escape:'html'|url2html|nl2br}">{$fields.rrss.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dispone_local.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPONE_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('dispone_local','enum')" class="div_value" id="dispone_local_detailblock" target_id="dispone_local">
{if !$fields.dispone_local.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.dispone_local.options)}
<input type="hidden" class="sugar_field" id="{$fields.dispone_local.name}" value="{ $fields.dispone_local.options }">
{ $fields.dispone_local.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.dispone_local.name}" value="{ $fields.dispone_local.value }">
{ $fields.dispone_local.options[$fields.dispone_local.value]}
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
{if !$fields.otros_sectores.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OTROS_SECTORES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otros_sectores','text')" class="div_value" id="otros_sectores_detailblock" target_id="otros_sectores">
{if !$fields.otros_sectores.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.otros_sectores.name|escape:'html'|url2html|nl2br}">{$fields.otros_sectores.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{capture name="popupText" assign="popupText"}{sugar_translate label="Se pueden añadir varias franquicias separadas por coma" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
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
{if !$fields.delegado.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DELEGADO' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('delegado','enum')" class="div_value" id="delegado_detailblock" target_id="delegado">
{if !$fields.delegado.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.delegado.options)}
<input type="hidden" class="sugar_field" id="{$fields.delegado.name}" value="{ $fields.delegado.options }">
{ $fields.delegado.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.delegado.name}" value="{ $fields.delegado.value }">
{ $fields.delegado.options[$fields.delegado.value]}
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
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL1' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCAL1' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%' colspan='3' >
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
{if !$fields.ubicacion_local1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_UBICACION_LOCAL1' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local1','enum')" class="div_value" id="ubicacion_local1_detailblock" target_id="ubicacion_local1">
{if !$fields.ubicacion_local1.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.ubicacion_local1.options)}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local1.name}" value="{ $fields.ubicacion_local1.options }">
{ $fields.ubicacion_local1.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local1.name}" value="{ $fields.ubicacion_local1.value }">
{ $fields.ubicacion_local1.options[$fields.ubicacion_local1.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.renta_estimada_1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RENTA_ESTIMADA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_1','varchar')" class="div_value" id="renta_estimada_1_detailblock" target_id="renta_estimada_1">
{if !$fields.renta_estimada_1.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.renta_estimada_1.value) <= 0}
{assign var="value" value=$fields.renta_estimada_1.default_value }
{else}
{assign var="value" value=$fields.renta_estimada_1.value }
{/if} 
<span class="sugar_field" id="{$fields.renta_estimada_1.name}">{$fields.renta_estimada_1.value}</span>
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
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local','text')" class="div_value" id="descripcion_local_detailblock" target_id="descripcion_local">
{if !$fields.descripcion_local.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.descripcion_local.name|escape:'html'|url2html|nl2br}">{$fields.descripcion_local.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCAL2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%' colspan='3' >
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
{if !$fields.ubicacion_local2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_UBICACION_LOCAL2' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local2','enum')" class="div_value" id="ubicacion_local2_detailblock" target_id="ubicacion_local2">
{if !$fields.ubicacion_local2.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.ubicacion_local2.options)}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local2.name}" value="{ $fields.ubicacion_local2.options }">
{ $fields.ubicacion_local2.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local2.name}" value="{ $fields.ubicacion_local2.value }">
{ $fields.ubicacion_local2.options[$fields.ubicacion_local2.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.renta_estimada_2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RENTA_ESTIMADA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_2','varchar')" class="div_value" id="renta_estimada_2_detailblock" target_id="renta_estimada_2">
{if !$fields.renta_estimada_2.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.renta_estimada_2.value) <= 0}
{assign var="value" value=$fields.renta_estimada_2.default_value }
{else}
{assign var="value" value=$fields.renta_estimada_2.value }
{/if} 
<span class="sugar_field" id="{$fields.renta_estimada_2.name}">{$fields.renta_estimada_2.value}</span>
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
{if !$fields.descripcion_local2.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPCION_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local2','text')" class="div_value" id="descripcion_local2_detailblock" target_id="descripcion_local2">
{if !$fields.descripcion_local2.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.descripcion_local2.name|escape:'html'|url2html|nl2br}">{$fields.descripcion_local2.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCAL3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%' colspan='3' >
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
{if !$fields.ubicacion_local3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_UBICACION_LOCAL3' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local3','enum')" class="div_value" id="ubicacion_local3_detailblock" target_id="ubicacion_local3">
{if !$fields.ubicacion_local3.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.ubicacion_local3.options)}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local3.name}" value="{ $fields.ubicacion_local3.options }">
{ $fields.ubicacion_local3.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.ubicacion_local3.name}" value="{ $fields.ubicacion_local3.value }">
{ $fields.ubicacion_local3.options[$fields.ubicacion_local3.value]}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.renta_estimada_3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RENTA_ESTIMADA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_3','varchar')" class="div_value" id="renta_estimada_3_detailblock" target_id="renta_estimada_3">
{if !$fields.renta_estimada_3.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.renta_estimada_3.value) <= 0}
{assign var="value" value=$fields.renta_estimada_3.default_value }
{else}
{assign var="value" value=$fields.renta_estimada_3.value }
{/if} 
<span class="sugar_field" id="{$fields.renta_estimada_3.name}">{$fields.renta_estimada_3.value}</span>
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
{if !$fields.descripcion_local3.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPCION_LOCAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local3','text')" class="div_value" id="descripcion_local3_detailblock" target_id="descripcion_local3">
{if !$fields.descripcion_local3.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.descripcion_local3.name|escape:'html'|url2html|nl2br}">{$fields.descripcion_local3.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL1").style.display='none';</script>
{/if}
</div>    <div id='tabcontent3'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL_TAG' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.tags_empresa.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAG_EMPRESA' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{capture name="popupText" assign="popupText"}{sugar_translate label="Se pueden añadir varias franquicias separadas por coma" module='Expan_Solicitud'}{/capture}
{sugar_help text=$popupText WIDTH=400}
{/if}
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tags_empresa','varchar')" class="div_value" id="tags_empresa_detailblock" target_id="tags_empresa">
{if !$fields.tags_empresa.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.tags_empresa.value) <= 0}
{assign var="value" value=$fields.tags_empresa.default_value }
{else}
{assign var="value" value=$fields.tags_empresa.value }
{/if} 
<span class="sugar_field" id="{$fields.tags_empresa.name}">{$fields.tags_empresa.value}</span>
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
{if !$fields.motivos_interes.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOTIVOS_INTERES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivos_interes','multienum')" class="div_value" id="motivos_interes_detailblock" target_id="motivos_interes">
{if !$fields.motivos_interes.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.motivos_interes.value) && ($fields.motivos_interes.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.motivos_interes.name}" value="{$fields.motivos_interes.value}">
{multienum_to_array string=$fields.motivos_interes.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.motivos_interes.options.$item }</li>
{/foreach}
{/if}
{/if}
</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.habilidades.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_HABILIDADES' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('habilidades','multienum')" class="div_value" id="habilidades_detailblock" target_id="habilidades">
{if !$fields.habilidades.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.habilidades.value) && ($fields.habilidades.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.habilidades.name}" value="{$fields.habilidades.value}">
{multienum_to_array string=$fields.habilidades.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.habilidades.options.$item }</li>
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
{if !$fields.situacion_personal.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SITUACION_PERSONAL' module='Expan_Solicitud'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('situacion_personal','multienum')" class="div_value" id="situacion_personal_detailblock" target_id="situacion_personal">
{if !$fields.situacion_personal.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.situacion_personal.value) && ($fields.situacion_personal.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.situacion_personal.name}" value="{$fields.situacion_personal.value}">
{multienum_to_array string=$fields.situacion_personal.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.situacion_personal.options.$item }</li>
{/foreach}
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL_TAG").style.display='none';</script>
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