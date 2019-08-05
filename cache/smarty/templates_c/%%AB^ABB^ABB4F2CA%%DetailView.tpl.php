<?php /* Smarty version 2.6.11, created on 2019-08-05 16:42:09
         compiled from cache/modules/Expan_GestionSolicitudes/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 53, false),array('function', 'sugar_translate', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 60, false),array('function', 'counter', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 92, false),array('function', 'sugar_ajax_url', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 112, false),array('function', 'sugar_number_format', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 155, false),array('function', 'sugar_help', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 294, false),array('function', 'sugar_getjspath', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 6016, false),array('modifier', 'strip_semicolon', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 102, false),array('modifier', 'escape', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 1901, false),array('modifier', 'url2html', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 1901, false),array('modifier', 'nl2br', 'cache/modules/Expan_GestionSolicitudes/DetailView.tpl', 1901, false),)), $this); ?>


<script language="javascript">
<?php echo '
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
'; ?>

</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
<form action="index.php" method="post" name="DetailView2" id="formDetailView">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
</form>
<div class="action_buttons"><?php if ($this->_tpl_vars['bean']->aclAccess('edit')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='DetailView'; _form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
"><?php endif; ?>  <?php if ($this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_GestionSolicitudes'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
" id="delete_button"><?php endif; ?>  <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="irApertura" id="irApertura" class style="color:#0000FF;" 
onClick="irAperturas('<?php echo $this->_tpl_vars['fields']['name']['value']; ?>
');" value="Ir Aperturas"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" style="color:#FF0000;" name="irsol" id="irfran" class onClick="irFranquicia('<?php echo $this->_tpl_vars['fields']['franquicia']['value']; ?>
');" value="Ir Franquicia"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input title="Abrir en otra pantalla la solicitud de la que depende la gestion actual" style="color:#00BC9F;" type="button" name="irsol" id="irsol" class onClick="irSolicitud('<?php echo $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida']['value']; ?>
');" value="Editar Candidato"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><BR> <BR/><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#0000FF;" 
title="Reenvio documentación inicial (C1) (Cuestionario, dosier y multimedia)" onClick="reenvioInfoDetalle('C1','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio información Adicional (C2) (Plan financiero)" disabled
onClick="reenvioInfoDetalle('C2','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C2"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio borrador precontrato (C3)" disabled
onClick="reenvioInfoDetalle('C3','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C3"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio borrador contrato (C4)" disabled
onClick="reenvioInfoDetalle('C4','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C4"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.1 (Provinvia Ocupada))" disabled
onClick="reenvioInfoDetalle('C1.1','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1.1"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.2 (No puede abrir en la zona))" disabled
onClick="reenvioInfoDetalle('C1.2','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1.2"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.3 (Agradecimiento cuestionario))" disabled
onClick="reenvioInfoDetalle('C1.3','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1.3"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.4 (Reenvío C1 no cuestionario))" disabled
onClick="reenvioInfoDetalle('C1.4','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1.4"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="reenInfo1" id="reenInfo1" class style="color:#FF0000;" 
title="Reenvio correo C1.5 (No telefono))" disabled
onClick="reenvioInfoDetalle('C1.5','<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); " value="Reenviar C1.5"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><BR><BR><input type="button" name="save" id="fichaFranquicia" 
onClick="envioCorreoInterlocutor('<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
','franq');" value="Envio Ficha Franquicia"/><?php endif; ?> <?php if ($this->_tpl_vars['fields']['id']['value'] != ""): ?><input type="button" name="save" id="fichaConsultor" 
onClick="envioCorreoInterlocutor('<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
','consultor');" value="Envio Ficha Consultor"/><BR <BR/><?php endif; ?> <?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Expan_GestionSolicitudes", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?><div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%"><?php echo $this->_tpl_vars['ADMIN_EDIT']; ?>

<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<div id="Expan_GestionSolicitudes_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'DEFAULT','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>

<li><a id="tab1" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_OBSERVACIONES','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_IIT','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PRECONTRATO','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>

<li><a id="tab4" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PLAN_FINANCIERO','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>

<li><a id="tab5" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CONTRATO','module' => 'Expan_GestionSolicitudes'), $this);?>
</em></a></li>
</ul>
<form method="post" action="index.php" name='DetailView' id='DetailView'>
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<input type="hidden" name="action" value="">
<input type="hidden" name="to_pdf" value="">
<?php 
global $beanList,$beanFiles;
$class_name = $beanList[$_REQUEST['module']];
$b = new $class_name();
$b->retrieve($_REQUEST['record']);
if($b->ACLAccess('Save'))
echo '<input type="hidden" id="is_editable" value="true">';
else
echo '<input type="hidden" id="is_editable" value="">';
 ?>
<div class="yui-content">
<div id='tabcontent0'>
<div id='detailpanel_1' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='DEFAULT' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EXPAN_SOLICITUD_EXPAN_GESTIONSOLICITUDES_1_FROM_EXPAN_SOLICITUD_TITLE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_solicitud_expan_gestionsolicitudes_1_name','relate')" class="div_value" id="expan_solicitud_expan_gestionsolicitudes_1_name_detailblock" target_id="expan_solicitud_expan_gestionsolicitudes_1_name">
<?php if (! $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida']['value'] )): ?>
<?php ob_start(); ?>index.php?module=Expan_Solicitud&action=DetailView&record=<?php echo $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida']['value'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('detail_url', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo smarty_function_sugar_ajax_url(array('url' => $this->_tpl_vars['detail_url']), $this);?>
"><?php endif; ?>
<span id="expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1_name']['value']; ?>
</span>
<?php if (! empty ( $this->_tpl_vars['fields']['expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida']['value'] )): ?></a><?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['franquicia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia','enum')" class="div_value" id="franquicia_detailblock" target_id="franquicia">
<?php if (! $this->_tpl_vars['fields']['franquicia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="franquicia" class="sugar_field"><a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Franquicia%26action%3DDetailView%26record%3D34e1c623-cbb8-26f8-6d4f-573193efc8ee"><span id="expan_franquicia" class="sugar_field" data-id-value="34e1c623-cbb8-26f8-6d4f-573193efc8ee">Adagio Cantabile</span></a></span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['prioridad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('prioridad','int')" class="div_value" id="prioridad_detailblock" target_id="prioridad">
<?php if (! $this->_tpl_vars['fields']['prioridad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['prioridad']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['prioridad']['value']), $this);?>

</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['rating']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RATING','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('rating','enum')" class="div_value" id="rating_detailblock" target_id="rating">
<?php if (! $this->_tpl_vars['fields']['rating']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['rating']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rating']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['rating']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['rating']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['rating']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['rating']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['rating']['options'][$this->_tpl_vars['fields']['rating']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_auto']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Envios automatizados','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_auto','bool')" class="div_value" id="chk_envio_auto_detailblock" target_id="chk_envio_auto">
<?php if (! $this->_tpl_vars['fields']['chk_envio_auto']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_auto']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_auto']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_auto']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_auto']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_auto']['name']; ?>
" value="$fields.chk_envio_auto.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha creacion','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('date_entered','datetime')" class="div_value" id="date_entered_detailblock" target_id="date_entered">
<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="date_entered" class="sugar_field"><?php echo $this->_tpl_vars['fields']['date_entered']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['created_by_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['oportunidad_inmediata']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OPORTUNIDAD_INMEDIATA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('oportunidad_inmediata','bool')" class="div_value" id="oportunidad_inmediata_detailblock" target_id="oportunidad_inmediata">
<?php if (! $this->_tpl_vars['fields']['oportunidad_inmediata']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['oportunidad_inmediata']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['oportunidad_inmediata']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['oportunidad_inmediata']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['oportunidad_inmediata']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['oportunidad_inmediata']['name']; ?>
" value="$fields.oportunidad_inmediata.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['candidatura_avanzada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CANDIDATURA_AVANZADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('candidatura_avanzada','bool')" class="div_value" id="candidatura_avanzada_detailblock" target_id="candidatura_avanzada">
<?php if (! $this->_tpl_vars['fields']['candidatura_avanzada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['candidatura_avanzada']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['candidatura_avanzada']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['candidatura_avanzada']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['candidatura_avanzada']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['candidatura_avanzada']['name']; ?>
" value="$fields.candidatura_avanzada.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_posible_colabora']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Posible Colaboracion','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Interesado en comprar servicios o productos sin ser franquiciado. Todavía no es positivo.",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_posible_colabora','bool')" class="div_value" id="chk_posible_colabora_detailblock" target_id="chk_posible_colabora">
<?php if (! $this->_tpl_vars['fields']['chk_posible_colabora']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_posible_colabora']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_posible_colabora']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_posible_colabora']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_posible_colabora']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_posible_colabora']['name']; ?>
" value="$fields.chk_posible_colabora.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['candidatura_caliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Candidatura caliente','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('candidatura_caliente','bool')" class="div_value" id="candidatura_caliente_detailblock" target_id="candidatura_caliente">
<?php if (! $this->_tpl_vars['fields']['candidatura_caliente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['candidatura_caliente']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['candidatura_caliente']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['candidatura_caliente']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['candidatura_caliente']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['candidatura_caliente']['name']; ?>
" value="$fields.candidatura_caliente.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['estado_sol']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Estado','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_sol','enum')" class="div_value" id="estado_sol_detailblock" target_id="estado_sol">
<?php if (! $this->_tpl_vars['fields']['estado_sol']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['estado_sol']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['estado_sol']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['estado_sol']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['estado_sol']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['estado_sol']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['estado_sol']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['estado_sol']['options'][$this->_tpl_vars['fields']['estado_sol']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_posible_colabora']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha Posible Colaboracion','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_posible_colabora','date')" class="div_value" id="f_posible_colabora_detailblock" target_id="f_posible_colabora">
<?php if (! $this->_tpl_vars['fields']['f_posible_colabora']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_posible_colabora']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_posible_colabora']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_posible_colabora']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_posible_colabora']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_gestionado_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CHK_GESTIONADO_CENTRAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_gestionado_central','bool')" class="div_value" id="chk_gestionado_central_detailblock" target_id="chk_gestionado_central">
<?php if (! $this->_tpl_vars['fields']['chk_gestionado_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_gestionado_central']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_gestionado_central']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_gestionado_central']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_gestionado_central']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_gestionado_central']['name']; ?>
" value="$fields.chk_gestionado_central.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_gestionado_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_F_GESTIONADO_CENTRAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_gestionado_central','date')" class="div_value" id="f_gestionado_central_detailblock" target_id="f_gestionado_central">
<?php if (! $this->_tpl_vars['fields']['f_gestionado_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_gestionado_central']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_gestionado_central']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_gestionado_central']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_gestionado_central']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREVISTA_PREVIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Presencial, virtual o entrevista preconcertada en feria",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa','bool')" class="div_value" id="chk_entrevista_previa_detailblock" target_id="chk_entrevista_previa">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista_previa']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa']['name']; ?>
" value="$fields.chk_entrevista_previa.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_USUARIO_ENTREVISTA_PREVIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa','varchar')" class="div_value" id="usuario_entrevista_previa_detailblock" target_id="usuario_entrevista_previa">
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['usuario_entrevista_previa']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_documentacion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Envio documentacion comercial (C1)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Cuestionario, dosier y multimedia",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_documentacion','bool')" class="div_value" id="chk_envio_documentacion_detailblock" target_id="chk_envio_documentacion">
<?php if (! $this->_tpl_vars['fields']['chk_envio_documentacion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_documentacion']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_documentacion']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_documentacion']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_documentacion']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_documentacion']['name']; ?>
" value="$fields.chk_envio_documentacion.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['envio_documentacion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'fecha de envío documentación comercial','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('envio_documentacion','date')" class="div_value" id="envio_documentacion_detailblock" target_id="envio_documentacion">
<?php if (! $this->_tpl_vars['fields']['envio_documentacion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['envio_documentacion']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['envio_documentacion']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['envio_documentacion']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['envio_documentacion']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_responde_C1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RESPONDE_C1','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se activa si el usuario responde al C1. Es de activación automática no es necesario que el usuario la active",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_responde_C1','bool')" class="div_value" id="chk_responde_C1_detailblock" target_id="chk_responde_C1">
<?php if (! $this->_tpl_vars['fields']['chk_responde_C1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_responde_C1']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_responde_C1']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_responde_C1']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_responde_C1']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_responde_C1']['name']; ?>
" value="$fields.chk_responde_C1.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_responde_C1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha respuesta C1','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_responde_C1','date')" class="div_value" id="f_responde_C1_detailblock" target_id="f_responde_C1">
<?php if (! $this->_tpl_vars['fields']['f_responde_C1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_responde_C1']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_responde_C1']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_responde_C1']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_responde_C1']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_sol_amp_info']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Solicitud ampliacion información (Pte resolver)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_sol_amp_info','bool')" class="div_value" id="chk_sol_amp_info_detailblock" target_id="chk_sol_amp_info">
<?php if (! $this->_tpl_vars['fields']['chk_sol_amp_info']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_sol_amp_info']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_sol_amp_info']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_sol_amp_info']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_sol_amp_info']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_sol_amp_info']['name']; ?>
" value="$fields.chk_sol_amp_info.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_sol_amp_info']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha Solicitud ampliacion información','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_sol_amp_info','date')" class="div_value" id="f_sol_amp_info_detailblock" target_id="f_sol_amp_info">
<?php if (! $this->_tpl_vars['fields']['f_sol_amp_info']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_sol_amp_info']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_sol_amp_info']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_sol_amp_info']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_sol_amp_info']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_autoriza_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Candidato autorizado por central','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_autoriza_central','bool')" class="div_value" id="chk_autoriza_central_detailblock" target_id="chk_autoriza_central">
<?php if (! $this->_tpl_vars['fields']['chk_autoriza_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_autoriza_central']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_autoriza_central']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_autoriza_central']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_autoriza_central']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_autoriza_central']['name']; ?>
" value="$fields.chk_autoriza_central.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_autoriza_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha autorizacion por central','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_autoriza_central','date')" class="div_value" id="f_autoriza_central_detailblock" target_id="f_autoriza_central">
<?php if (! $this->_tpl_vars['fields']['f_autoriza_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_autoriza_central']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_autoriza_central']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_autoriza_central']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_autoriza_central']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_resolucion_dudas']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Resolucion de primeras dudas (Resueltas)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_resolucion_dudas','bool')" class="div_value" id="chk_resolucion_dudas_detailblock" target_id="chk_resolucion_dudas">
<?php if (! $this->_tpl_vars['fields']['chk_resolucion_dudas']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_resolucion_dudas']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_resolucion_dudas']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_resolucion_dudas']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_resolucion_dudas']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_resolucion_dudas']['name']; ?>
" value="$fields.chk_resolucion_dudas.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_resolucion_dudas']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha de Resolucion primeras de dudas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_resolucion_dudas','date')" class="div_value" id="f_resolucion_dudas_detailblock" target_id="f_resolucion_dudas">
<?php if (! $this->_tpl_vars['fields']['f_resolucion_dudas']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_resolucion_dudas']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_resolucion_dudas']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_resolucion_dudas']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_resolucion_dudas']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RECEPCION_CUESTIONARIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se activa cuando el solicitante rellena el cuestionario. Es de activación automática, no es necesario que el usuario la active",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_recepcio_cuestionario','bool')" class="div_value" id="chk_recepcio_cuestionario_detailblock" target_id="chk_recepcio_cuestionario">
<?php if (! $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_recepcio_cuestionario']['name']; ?>
" value="$fields.chk_recepcio_cuestionario.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_recepcion_cuestionario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha de recepción del cuestionario','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_recepcion_cuestionario','date')" class="div_value" id="f_recepcion_cuestionario_detailblock" target_id="f_recepcion_cuestionario">
<?php if (! $this->_tpl_vars['fields']['f_recepcion_cuestionario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_recepcion_cuestionario']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_recepcion_cuestionario']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_recepcion_cuestionario']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_recepcion_cuestionario']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_informacion_adicional']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Envio información adicional (C2)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Plan financiero','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_informacion_adicional','bool')" class="div_value" id="chk_informacion_adicional_detailblock" target_id="chk_informacion_adicional">
<?php if (! $this->_tpl_vars['fields']['chk_informacion_adicional']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_informacion_adicional']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_informacion_adicional']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_informacion_adicional']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_informacion_adicional']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_informacion_adicional']['name']; ?>
" value="$fields.chk_informacion_adicional.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_informacion_adicional']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha envio información adicional','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_informacion_adicional','date')" class="div_value" id="f_informacion_adicional_detailblock" target_id="f_informacion_adicional">
<?php if (! $this->_tpl_vars['fields']['f_informacion_adicional']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_informacion_adicional']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_informacion_adicional']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_informacion_adicional']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_informacion_adicional']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Entrevista','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Presencial, virtual o entrevista preconcertada en feria",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista','bool')" class="div_value" id="chk_entrevista_detailblock" target_id="chk_entrevista">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista']['name']; ?>
" value="$fields.chk_entrevista.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_entrevista']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha Entrevista','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista','date')" class="div_value" id="f_entrevista_detailblock" target_id="f_entrevista">
<?php if (! $this->_tpl_vars['fields']['f_entrevista']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_entrevista']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_entrevista']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_propuesta_zona']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENVIO_PROP_ZONA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_propuesta_zona','bool')" class="div_value" id="chk_propuesta_zona_detailblock" target_id="chk_propuesta_zona">
<?php if (! $this->_tpl_vars['fields']['chk_propuesta_zona']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_propuesta_zona']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_propuesta_zona']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_propuesta_zona']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_propuesta_zona']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_propuesta_zona']['name']; ?>
" value="$fields.chk_propuesta_zona.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_propuesta_zona']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_F_ENVIO_PROP_ZONA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_propuesta_zona','date')" class="div_value" id="f_propuesta_zona_detailblock" target_id="f_propuesta_zona">
<?php if (! $this->_tpl_vars['fields']['f_propuesta_zona']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_propuesta_zona']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_propuesta_zona']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_propuesta_zona']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_propuesta_zona']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_visitado_fran']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Visitado franquiciado/unidad propia','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visitado_fran','bool')" class="div_value" id="chk_visitado_fran_detailblock" target_id="chk_visitado_fran">
<?php if (! $this->_tpl_vars['fields']['chk_visitado_fran']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_visitado_fran']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_visitado_fran']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_visitado_fran']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_visitado_fran']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_visitado_fran']['name']; ?>
" value="$fields.chk_visitado_fran.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_visitado_fran']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha Visitado franquiciado','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visitado_fran','date')" class="div_value" id="f_visitado_fran_detailblock" target_id="f_visitado_fran">
<?php if (! $this->_tpl_vars['fields']['f_visitado_fran']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_visitado_fran']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visitado_fran']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visitado_fran']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_visitado_fran']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_precontrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Envio borrador Precontrato (C3)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_precontrato','bool')" class="div_value" id="chk_envio_precontrato_detailblock" target_id="chk_envio_precontrato">
<?php if (! $this->_tpl_vars['fields']['chk_envio_precontrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_precontrato']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_precontrato']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_precontrato']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_precontrato']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_precontrato']['name']; ?>
" value="$fields.chk_envio_precontrato.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_envio_precontrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha envio borrador Precontrato','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_precontrato','date')" class="div_value" id="f_envio_precontrato_detailblock" target_id="f_envio_precontrato">
<?php if (! $this->_tpl_vars['fields']['f_envio_precontrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_envio_precontrato']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_precontrato']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_precontrato']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_envio_precontrato']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_visita_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INFORMACION_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visita_local','bool')" class="div_value" id="chk_visita_local_detailblock" target_id="chk_visita_local">
<?php if (! $this->_tpl_vars['fields']['chk_visita_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_visita_local']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_visita_local']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_visita_local']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_visita_local']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_visita_local']['name']; ?>
" value="$fields.chk_visita_local.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_visita_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha Informacion de local','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visita_local','date')" class="div_value" id="f_visita_local_detailblock" target_id="f_visita_local">
<?php if (! $this->_tpl_vars['fields']['f_visita_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_visita_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visita_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visita_local']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_visita_local']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_operacion_autorizada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Operación autorizada','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_operacion_autorizada','bool')" class="div_value" id="chk_operacion_autorizada_detailblock" target_id="chk_operacion_autorizada">
<?php if (! $this->_tpl_vars['fields']['chk_operacion_autorizada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_operacion_autorizada']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_operacion_autorizada']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_operacion_autorizada']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_operacion_autorizada']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_operacion_autorizada']['name']; ?>
" value="$fields.chk_operacion_autorizada.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_operacion_autorizada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha autorización de la operación','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_operacion_autorizada','date')" class="div_value" id="f_operacion_autorizada_detailblock" target_id="f_operacion_autorizada">
<?php if (! $this->_tpl_vars['fields']['f_operacion_autorizada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_operacion_autorizada']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_operacion_autorizada']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_operacion_autorizada']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_operacion_autorizada']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENVIO_PRECONTRATO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_precontrato_personal','bool')" class="div_value" id="chk_envio_precontrato_personal_detailblock" target_id="chk_envio_precontrato_personal">
<?php if (! $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_precontrato_personal']['name']; ?>
" value="$fields.chk_envio_precontrato_personal.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_envio_precontrato_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_ENVIO_PRECONTRATO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_precontrato_personal','date')" class="div_value" id="f_envio_precontrato_personal_detailblock" target_id="f_envio_precontrato_personal">
<?php if (! $this->_tpl_vars['fields']['f_envio_precontrato_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_envio_precontrato_personal']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_precontrato_personal']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_precontrato_personal']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_envio_precontrato_personal']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_precontrato_firmado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Precontrato Firmado','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_precontrato_firmado','bool')" class="div_value" id="chk_precontrato_firmado_detailblock" target_id="chk_precontrato_firmado">
<?php if (! $this->_tpl_vars['fields']['chk_precontrato_firmado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_precontrato_firmado']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_precontrato_firmado']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_precontrato_firmado']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_precontrato_firmado']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_precontrato_firmado']['name']; ?>
" value="$fields.chk_precontrato_firmado.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_precontrato_firmado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha firma precontrato','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_precontrato_firmado','date')" class="div_value" id="f_precontrato_firmado_detailblock" target_id="f_precontrato_firmado">
<?php if (! $this->_tpl_vars['fields']['f_precontrato_firmado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_precontrato_firmado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_precontrato_firmado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_precontrato_firmado']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_precontrato_firmado']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_contrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Envío borrador Contrato (C4)','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_contrato','bool')" class="div_value" id="chk_envio_contrato_detailblock" target_id="chk_envio_contrato">
<?php if (! $this->_tpl_vars['fields']['chk_envio_contrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_contrato']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_contrato']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_contrato']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_contrato']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_contrato']['name']; ?>
" value="$fields.chk_envio_contrato.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_envio_contrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha envío de contrato','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_contrato','date')" class="div_value" id="f_envio_contrato_detailblock" target_id="f_envio_contrato">
<?php if (! $this->_tpl_vars['fields']['f_envio_contrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_envio_contrato']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_contrato']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_contrato']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_envio_contrato']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_aprobacion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Aprobacion del local','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_aprobacion_local','bool')" class="div_value" id="chk_aprobacion_local_detailblock" target_id="chk_aprobacion_local">
<?php if (! $this->_tpl_vars['fields']['chk_aprobacion_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_aprobacion_local']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_aprobacion_local']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_aprobacion_local']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_aprobacion_local']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_aprobacion_local']['name']; ?>
" value="$fields.chk_aprobacion_local.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_aprobacion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha de aprobacion del local','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_aprobacion_local','date')" class="div_value" id="f_aprobacion_local_detailblock" target_id="f_aprobacion_local">
<?php if (! $this->_tpl_vars['fields']['f_aprobacion_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_aprobacion_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_aprobacion_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_aprobacion_local']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_aprobacion_local']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENVIO_PLAN_FINANCIERO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_plan_financiero_personal','bool')" class="div_value" id="chk_envio_plan_financiero_personal_detailblock" target_id="chk_envio_plan_financiero_personal">
<?php if (! $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_plan_financiero_personal']['name']; ?>
" value="$fields.chk_envio_plan_financiero_personal.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_ENVIO_PLAN_FINANCIERO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_plan_financiero_personal','date')" class="div_value" id="f_envio_plan_financiero_personal_detailblock" target_id="f_envio_plan_financiero_personal">
<?php if (! $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_envio_plan_financiero_personal']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_visita_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Visita a la Central','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_visita_central','bool')" class="div_value" id="chk_visita_central_detailblock" target_id="chk_visita_central">
<?php if (! $this->_tpl_vars['fields']['chk_visita_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_visita_central']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_visita_central']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_visita_central']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_visita_central']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_visita_central']['name']; ?>
" value="$fields.chk_visita_central.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_visita_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha visita a la Central','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_visita_central','date')" class="div_value" id="f_visita_central_detailblock" target_id="f_visita_central">
<?php if (! $this->_tpl_vars['fields']['f_visita_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_visita_central']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visita_central']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_visita_central']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_visita_central']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_envio_contrato_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENVIO_CONTRATO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_envio_contrato_personal','bool')" class="div_value" id="chk_envio_contrato_personal_detailblock" target_id="chk_envio_contrato_personal">
<?php if (! $this->_tpl_vars['fields']['chk_envio_contrato_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_envio_contrato_personal']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_envio_contrato_personal']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_envio_contrato_personal']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_envio_contrato_personal']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_envio_contrato_personal']['name']; ?>
" value="$fields.chk_envio_contrato_personal.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_envio_contrato_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_ENVIO_CONTRATO_PERSONAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_envio_contrato_personal','date')" class="div_value" id="f_envio_contrato_personal_detailblock" target_id="f_envio_contrato_personal">
<?php if (! $this->_tpl_vars['fields']['f_envio_contrato_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_envio_contrato_personal']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_contrato_personal']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_envio_contrato_personal']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_envio_contrato_personal']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_contrato_firmado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Contrato Firmado','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_contrato_firmado','bool')" class="div_value" id="chk_contrato_firmado_detailblock" target_id="chk_contrato_firmado">
<?php if (! $this->_tpl_vars['fields']['chk_contrato_firmado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_contrato_firmado']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_contrato_firmado']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_contrato_firmado']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_contrato_firmado']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_contrato_firmado']['name']; ?>
" value="$fields.chk_contrato_firmado.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_contrato_firmado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Fecha firma contrato','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_contrato_firmado','date')" class="div_value" id="f_contrato_firmado_detailblock" target_id="f_contrato_firmado">
<?php if (! $this->_tpl_vars['fields']['f_contrato_firmado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_contrato_firmado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_contrato_firmado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_contrato_firmado']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_contrato_firmado']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['cuando_empezar']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUANDO_EMPEZAR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuando_empezar','date')" class="div_value" id="cuando_empezar_detailblock" target_id="cuando_empezar">
<?php if (! $this->_tpl_vars['fields']['cuando_empezar']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['cuando_empezar']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuando_empezar']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuando_empezar']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['cuando_empezar']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['papel']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PAPEL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('papel','enum')" class="div_value" id="papel_detailblock" target_id="papel">
<?php if (! $this->_tpl_vars['fields']['papel']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['papel']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['papel']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['papel']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['papel']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['papel']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['papel']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['papel']['options'][$this->_tpl_vars['fields']['papel']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['inversion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INVERSION','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inversion','enum')" class="div_value" id="inversion_detailblock" target_id="inversion">
<?php if (! $this->_tpl_vars['fields']['inversion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['inversion']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['inversion']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['inversion']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['inversion']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['inversion']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['inversion']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['inversion']['options'][$this->_tpl_vars['fields']['inversion']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['recursos_propios']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RECURSOS_PROPIOS','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('recursos_propios','enum')" class="div_value" id="recursos_propios_detailblock" target_id="recursos_propios">
<?php if (! $this->_tpl_vars['fields']['recursos_propios']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['recursos_propios']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['recursos_propios']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['recursos_propios']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['recursos_propios']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['recursos_propios']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['recursos_propios']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['recursos_propios']['options'][$this->_tpl_vars['fields']['recursos_propios']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['perfil_ideoneo']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PERFIL_IDONEO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_ideoneo','enum')" class="div_value" id="perfil_ideoneo_detailblock" target_id="perfil_ideoneo">
<?php if (! $this->_tpl_vars['fields']['perfil_ideoneo']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['perfil_ideoneo']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['perfil_ideoneo']['options'][$this->_tpl_vars['fields']['perfil_ideoneo']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['motivo_parada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOTIVO_PARADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_parada','enum')" class="div_value" id="motivo_parada_detailblock" target_id="motivo_parada">
<?php if (! $this->_tpl_vars['fields']['motivo_parada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['motivo_parada']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_parada']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_parada']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_parada']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_parada']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_parada']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_parada']['options'][$this->_tpl_vars['fields']['motivo_parada']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_reactivacion_parado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_F_REACTIVACION_PARADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Fecha en el que se pasará la gestión de parado a en curso",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_reactivacion_parado','date')" class="div_value" id="f_reactivacion_parado_detailblock" target_id="f_reactivacion_parado">
<?php if (! $this->_tpl_vars['fields']['f_reactivacion_parado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_reactivacion_parado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_reactivacion_parado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_reactivacion_parado']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_reactivacion_parado']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['motivo_descarte']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOTIVO_DESCARTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_descarte','enum')" class="div_value" id="motivo_descarte_detailblock" target_id="motivo_descarte">
<?php if (! $this->_tpl_vars['fields']['motivo_descarte']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['motivo_descarte']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_descarte']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_descarte']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_descarte']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_descarte']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_descarte']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_descarte']['options'][$this->_tpl_vars['fields']['motivo_descarte']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['motivo_positivo']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOTIVO_POSITIVO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivo_positivo','enum')" class="div_value" id="motivo_positivo_detailblock" target_id="motivo_positivo">
<?php if (! $this->_tpl_vars['fields']['motivo_positivo']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['motivo_positivo']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_positivo']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_positivo']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_positivo']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivo_positivo']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivo_positivo']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['motivo_positivo']['options'][$this->_tpl_vars['fields']['motivo_positivo']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['observaciones_informe']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACIONES_INFORME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Añadir <b>SOLO</b> informacion que aporte valor al franquiciador",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_informe','text')" class="div_value" id="observaciones_informe_detailblock" target_id="observaciones_informe">
<?php if (! $this->_tpl_vars['fields']['observaciones_informe']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_informe']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_informe']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['observaciones_descarte']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACIONES_DESCARTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_descarte','text')" class="div_value" id="observaciones_descarte_detailblock" target_id="observaciones_descarte">
<?php if (! $this->_tpl_vars['fields']['observaciones_descarte']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_descarte']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_descarte']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tipo_origen']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TIPO_ORIGEN','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tipo_origen','enum')" class="div_value" id="tipo_origen_detailblock" target_id="tipo_origen">
<?php if (! $this->_tpl_vars['fields']['tipo_origen']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['tipo_origen']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tipo_origen']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['tipo_origen']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['tipo_origen']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tipo_origen']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['tipo_origen']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['tipo_origen']['options'][$this->_tpl_vars['fields']['tipo_origen']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['suborigen']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBORIGEN','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('suborigen','varchar')" class="div_value" id="suborigen_detailblock" target_id="suborigen">
<?php if (! $this->_tpl_vars['fields']['suborigen']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="suborigen" class="sugar_field"><?php 
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
 ?></span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tiponegocio1']['hidden']): ?>
<?php ob_start();  
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg1;                      
  $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio1','bool')" class="div_value" id="tiponegocio1_detailblock" target_id="tiponegocio1">
<?php if (! $this->_tpl_vars['fields']['tiponegocio1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['tiponegocio1']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['tiponegocio1']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['tiponegocio1']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['tiponegocio1']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['tiponegocio1']['name']; ?>
" value="$fields.tiponegocio1.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tiponegocio2']['hidden']): ?>
<?php ob_start();  
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg2;                      
  $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio2','bool')" class="div_value" id="tiponegocio2_detailblock" target_id="tiponegocio2">
<?php if (! $this->_tpl_vars['fields']['tiponegocio2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['tiponegocio2']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['tiponegocio2']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['tiponegocio2']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['tiponegocio2']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['tiponegocio2']['name']; ?>
" value="$fields.tiponegocio2.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tiponegocio3']['hidden']): ?>
<?php ob_start();  
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg3;                      
  $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio3','bool')" class="div_value" id="tiponegocio3_detailblock" target_id="tiponegocio3">
<?php if (! $this->_tpl_vars['fields']['tiponegocio3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['tiponegocio3']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['tiponegocio3']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['tiponegocio3']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['tiponegocio3']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['tiponegocio3']['name']; ?>
" value="$fields.tiponegocio3.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tiponegocio4']['hidden']): ?>
<?php ob_start();  
$idfran=$this->_tpl_vars["bean"]->franquicia;
$Fran = new Expan_Franquicia();
$Fran -> retrieve($idfran);
echo $Fran->modNeg4;                      
  $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tiponegocio4','bool')" class="div_value" id="tiponegocio4_detailblock" target_id="tiponegocio4">
<?php if (! $this->_tpl_vars['fields']['tiponegocio4']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['tiponegocio4']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['tiponegocio4']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['tiponegocio4']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['tiponegocio4']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['tiponegocio4']['name']; ?>
" value="$fields.tiponegocio4.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['assigned_user_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('assigned_user_name','relate')" class="div_value" id="assigned_user_name_detailblock" target_id="assigned_user_name">
<?php if (! $this->_tpl_vars['fields']['assigned_user_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span id="assigned_user_id" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['assigned_user_id']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['assigned_user_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['lnk_cuestionario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUESTIONARIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'No editar el cuestionario aquellos datos que ya se recojen en el CRM','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lnk_cuestionario','text')" class="div_value" id="lnk_cuestionario_detailblock" target_id="lnk_cuestionario">
<?php if (! $this->_tpl_vars['fields']['lnk_cuestionario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="lnk_cuestionario" class="sugar_field"><?php 
$link=$this->_tpl_vars["bean"]->lnk_cuestionario;
$id=$this->_tpl_vars["bean"]->id;
$irClick = "";
if (strlen($link)!=0){
$irClick="Abrir Cuestionario";
}                      
echo "<a target=\"_blank\" onclick=\"eliminarAlertaCuestionario('".$id."')\" href=\"".$link."\">".$irClick."</a>";                      
 ?></span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['modified_by_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFICADO_POR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modified_by_name','relate')" class="div_value" id="modified_by_name_detailblock" target_id="modified_by_name">
<?php if (! $this->_tpl_vars['fields']['modified_by_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span id="modified_user_id" class="sugar_field" data-id-value="<?php echo $this->_tpl_vars['fields']['modified_user_id']['value']; ?>
"><?php echo $this->_tpl_vars['fields']['modified_by_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['otras_preguntas_formulario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OTRAS_PREGUNTAS_FORMULARIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Informacion recogida del cuestionario que da respuestas específicas sobre la enseña (no hay campos específicos en el CRM)",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otras_preguntas_formulario','text')" class="div_value" id="otras_preguntas_formulario_detailblock" target_id="otras_preguntas_formulario">
<?php if (! $this->_tpl_vars['fields']['otras_preguntas_formulario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['otras_preguntas_formulario']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['otras_preguntas_formulario']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("DEFAULT").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent1'>
<div id='detailpanel_2' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_EDITVIEW_OBSERVACIONES' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['preguntas_mn_t']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PREGUNTAS_MN_T','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Preguntas realizadas por el solicitante sobre el modelo de negocio o técnicas de la actividad en las conversaciones mantenidas",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('preguntas_mn_t','text')" class="div_value" id="preguntas_mn_t_detailblock" target_id="preguntas_mn_t">
<?php if (! $this->_tpl_vars['fields']['preguntas_mn_t']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['preguntas_mn_t']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['preguntas_mn_t']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['preg_en_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PREG_EN_CENTRAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('preg_en_central','text')" class="div_value" id="preg_en_central_detailblock" target_id="preg_en_central">
<?php if (! $this->_tpl_vars['fields']['preg_en_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['preg_en_central']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['preg_en_central']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['objeciones_mn']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBJECIONES_MN','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Objeciones sobre el modelo de negocio por el solicitante en las conversaciones mantenidas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('objeciones_mn','text')" class="div_value" id="objeciones_mn_detailblock" target_id="objeciones_mn">
<?php if (! $this->_tpl_vars['fields']['objeciones_mn']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['objeciones_mn']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['objeciones_mn']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['solicitudes_candidato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SOLICITUDES_CANDIDATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Solicitudes realizadas por el solicitante en las conversaciones mantenidas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('solicitudes_candidato','text')" class="div_value" id="solicitudes_candidato_detailblock" target_id="solicitudes_candidato">
<?php if (! $this->_tpl_vars['fields']['solicitudes_candidato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['solicitudes_candidato']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['solicitudes_candidato']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['informacion_proveedores']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INFORMACION_PROVEEDORES','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Informacion de proveedores que nos proporciona el solicitante en las conversaciones mantenidas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('informacion_proveedores','text')" class="div_value" id="informacion_proveedores_detailblock" target_id="informacion_proveedores">
<?php if (! $this->_tpl_vars['fields']['informacion_proveedores']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['informacion_proveedores']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['informacion_proveedores']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['informacion_competencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INFORMACION_COMPETENCIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Informacion de la compatencia que nos proporciona el solicitante en las conversaciones mantenidas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('informacion_competencia','text')" class="div_value" id="informacion_competencia_detailblock" target_id="informacion_competencia">
<?php if (! $this->_tpl_vars['fields']['informacion_competencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['informacion_competencia']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['informacion_competencia']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['notas_argumentario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NOTAS_ARGUMENTARIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Información recogida del franquiciador",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('notas_argumentario','text')" class="div_value" id="notas_argumentario_detailblock" target_id="notas_argumentario">
<?php if (! $this->_tpl_vars['fields']['notas_argumentario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['notas_argumentario']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['notas_argumentario']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['concesiones']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONCESIONES','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('concesiones','text')" class="div_value" id="concesiones_detailblock" target_id="concesiones">
<?php if (! $this->_tpl_vars['fields']['concesiones']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['concesiones']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['concesiones']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['mejoras']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MEJORAS','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Mejoras a implementar detectadas en las conversaciones mantenidas','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('mejoras','text')" class="div_value" id="mejoras_detailblock" target_id="mejoras">
<?php if (! $this->_tpl_vars['fields']['mejoras']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['mejoras']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['mejoras']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_EDITVIEW_OBSERVACIONES").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_IIT' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_validado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_VALIDADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_validado','bool')" class="div_value" id="iit_validado_detailblock" target_id="iit_validado">
<?php if (! $this->_tpl_vars['fields']['iit_validado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['iit_validado']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['iit_validado']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['iit_validado']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['iit_validado']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['iit_validado']['name']; ?>
" value="$fields.iit_validado.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CANDIDATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONSULTOR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_zona_implantacion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_ZONA_IMPLANTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_zona_implantacion','varchar')" class="div_value" id="iit_zona_implantacion_detailblock" target_id="iit_zona_implantacion">
<?php if (! $this->_tpl_vars['fields']['iit_zona_implantacion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_zona_implantacion']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_zona_implantacion']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_zona_implantacion']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_zona_implantacion']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_zona_implantacion']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_ACUERDO_EXCLUSIVIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_acuerdo_exclusividad','varchar')" class="div_value" id="iit_acuerdo_exclusividad_detailblock" target_id="iit_acuerdo_exclusividad">
<?php if (! $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_acuerdo_exclusividad']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_aporta_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_APORTA_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_aporta_local','varchar')" class="div_value" id="iit_aporta_local_detailblock" target_id="iit_aporta_local">
<?php if (! $this->_tpl_vars['fields']['iit_aporta_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_aporta_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_aporta_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_aporta_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_aporta_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_aporta_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_acuerdo_economico']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_ACUERDO_ECONOMICO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_acuerdo_economico','varchar')" class="div_value" id="iit_acuerdo_economico_detailblock" target_id="iit_acuerdo_economico">
<?php if (! $this->_tpl_vars['fields']['iit_acuerdo_economico']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_acuerdo_economico']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_acuerdo_economico']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_acuerdo_economico']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_acuerdo_economico']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_acuerdo_economico']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_direccion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_DIRECCION_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_direccion_local','varchar')" class="div_value" id="iit_direccion_local_detailblock" target_id="iit_direccion_local">
<?php if (! $this->_tpl_vars['fields']['iit_direccion_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_direccion_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_direccion_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_direccion_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_direccion_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_direccion_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CRM','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_localidad_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_LOCALIDAD_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_localidad_local','varchar')" class="div_value" id="iit_localidad_local_detailblock" target_id="iit_localidad_local">
<?php if (! $this->_tpl_vars['fields']['iit_localidad_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_localidad_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_localidad_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_localidad_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_localidad_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_localidad_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_inversion_inicial_est']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_INVER_INICIAL_EST','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_inversion_inicial_est','varchar')" class="div_value" id="iit_inversion_inicial_est_detailblock" target_id="iit_inversion_inicial_est">
<?php if (! $this->_tpl_vars['fields']['iit_inversion_inicial_est']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_inversion_inicial_est']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_inversion_inicial_est']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_inversion_inicial_est']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_inversion_inicial_est']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_inversion_inicial_est']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_SUPERFICIE_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_local','varchar')" class="div_value" id="iit_superficie_local_detailblock" target_id="iit_superficie_local">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_superficie_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_superficie_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_superficie_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_canon_entrada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_CANON_ENTRADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_canon_entrada','varchar')" class="div_value" id="iit_canon_entrada_detailblock" target_id="iit_canon_entrada">
<?php if (! $this->_tpl_vars['fields']['iit_canon_entrada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_canon_entrada']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_canon_entrada']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_canon_entrada']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_canon_entrada']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_canon_entrada']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_escapa_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_SUPERFICIE_ESCAPA_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_escapa_local','varchar')" class="div_value" id="iit_superficie_escapa_local_detailblock" target_id="iit_superficie_escapa_local">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_escapa_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_superficie_escapa_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_escapa_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_escapa_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_superficie_escapa_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_superficie_escapa_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_royalty_explota']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_ROYALTY_EXPLOTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_royalty_explota','varchar')" class="div_value" id="iit_royalty_explota_detailblock" target_id="iit_royalty_explota">
<?php if (! $this->_tpl_vars['fields']['iit_royalty_explota']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_royalty_explota']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_royalty_explota']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_royalty_explota']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_royalty_explota']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_royalty_explota']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_almacen_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_SUPERFICIE_ALMACEN_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_superficie_almacen_local','varchar')" class="div_value" id="iit_superficie_almacen_local_detailblock" target_id="iit_superficie_almacen_local">
<?php if (! $this->_tpl_vars['fields']['iit_superficie_almacen_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_superficie_almacen_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_almacen_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_superficie_almacen_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_superficie_almacen_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_superficie_almacen_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_royalty_mkt']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_ROYALTY_MKT','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_royalty_mkt','varchar')" class="div_value" id="iit_royalty_mkt_detailblock" target_id="iit_royalty_mkt">
<?php if (! $this->_tpl_vars['fields']['iit_royalty_mkt']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_royalty_mkt']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_royalty_mkt']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_royalty_mkt']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_royalty_mkt']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_royalty_mkt']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_instalaciones_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_INSTALACIONES_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_instalaciones_local','varchar')" class="div_value" id="iit_instalaciones_local_detailblock" target_id="iit_instalaciones_local">
<?php if (! $this->_tpl_vars['fields']['iit_instalaciones_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_instalaciones_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_instalaciones_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_instalaciones_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_instalaciones_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_instalaciones_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_duracion_contrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_DURACION_CONTRAT0','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_duracion_contrato','varchar')" class="div_value" id="iit_duracion_contrato_detailblock" target_id="iit_duracion_contrato">
<?php if (! $this->_tpl_vars['fields']['iit_duracion_contrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_duracion_contrato']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_duracion_contrato']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_duracion_contrato']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_duracion_contrato']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_duracion_contrato']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_visitado_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_VISITADO_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_visitado_local','varchar')" class="div_value" id="iit_visitado_local_detailblock" target_id="iit_visitado_local">
<?php if (! $this->_tpl_vars['fields']['iit_visitado_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_visitado_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_visitado_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_visitado_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_visitado_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_visitado_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_year_renovado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_YEAR_RENOVADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_year_renovado','varchar')" class="div_value" id="iit_year_renovado_detailblock" target_id="iit_year_renovado">
<?php if (! $this->_tpl_vars['fields']['iit_year_renovado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_year_renovado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_year_renovado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_year_renovado']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_year_renovado']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_year_renovado']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_aprobado_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_APROBADO_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_aprobado_local','varchar')" class="div_value" id="iit_aprobado_local_detailblock" target_id="iit_aprobado_local">
<?php if (! $this->_tpl_vars['fields']['iit_aprobado_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_aprobado_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_aprobado_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_aprobado_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_aprobado_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_aprobado_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_max_estableci_zona']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_MAX_ESTABLECI_ZONA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_max_estableci_zona','varchar')" class="div_value" id="iit_max_estableci_zona_detailblock" target_id="iit_max_estableci_zona">
<?php if (! $this->_tpl_vars['fields']['iit_max_estableci_zona']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_max_estableci_zona']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_max_estableci_zona']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_max_estableci_zona']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_max_estableci_zona']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_max_estableci_zona']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IIT_MOD_NEG_RECOMENDADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_mod_neg_recomendado','varchar')" class="div_value" id="iit_mod_neg_recomendado_detailblock" target_id="iit_mod_neg_recomendado">
<?php if (! $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_mod_neg_recomendado']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['iit_localidad_recomendado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_RECOMENDADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('iit_localidad_recomendado','varchar')" class="div_value" id="iit_localidad_recomendado_detailblock" target_id="iit_localidad_recomendado">
<?php if (! $this->_tpl_vars['fields']['iit_localidad_recomendado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['iit_localidad_recomendado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_localidad_recomendado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['iit_localidad_recomendado']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['iit_localidad_recomendado']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['iit_localidad_recomendado']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_IIT").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent3'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_PRECONTRATO' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['estado_precontrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ESTADO_PRECONTRATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_precontrato','enum')" class="div_value" id="estado_precontrato_detailblock" target_id="estado_precontrato">
<?php if (! $this->_tpl_vars['fields']['estado_precontrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['estado_precontrato']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['estado_precontrato']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['estado_precontrato']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['estado_precontrato']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['estado_precontrato']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['estado_precontrato']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['estado_precontrato']['options'][$this->_tpl_vars['fields']['estado_precontrato']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRMANTE1','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRMANTE2','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_first_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_first_name','varchar')" class="div_value" id="pre_fir1_first_name_detailblock" target_id="pre_fir1_first_name">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_first_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir1_first_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_first_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_first_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir1_first_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir1_first_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_first_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_first_name','varchar')" class="div_value" id="pre_fir2_first_name_detailblock" target_id="pre_fir2_first_name">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_first_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir2_first_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_first_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_first_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir2_first_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir2_first_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_last_name','varchar')" class="div_value" id="pre_fir1_last_name_detailblock" target_id="pre_fir1_last_name">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir1_last_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_last_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_last_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir1_last_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir1_last_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_last_name','varchar')" class="div_value" id="pre_fir2_last_name_detailblock" target_id="pre_fir2_last_name">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir2_last_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_last_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_last_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir2_last_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir2_last_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_NIF']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_NIF','varchar')" class="div_value" id="pre_fir1_NIF_detailblock" target_id="pre_fir1_NIF">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_NIF']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir1_NIF']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_NIF']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_NIF']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir1_NIF']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir1_NIF']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_NIF']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_NIF','varchar')" class="div_value" id="pre_fir2_NIF_detailblock" target_id="pre_fir2_NIF">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_NIF']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir2_NIF']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_NIF']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_NIF']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir2_NIF']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir2_NIF']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_vecino']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_VECINO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_vecino','varchar')" class="div_value" id="pre_fir1_vecino_detailblock" target_id="pre_fir1_vecino">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_vecino']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir1_vecino']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_vecino']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_vecino']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir1_vecino']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir1_vecino']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_vecino']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_VECINO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_vecino','varchar')" class="div_value" id="pre_fir2_vecino_detailblock" target_id="pre_fir2_vecino">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_vecino']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir2_vecino']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_vecino']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_vecino']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir2_vecino']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir2_vecino']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_domicilio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir1_domicilio','varchar')" class="div_value" id="pre_fir1_domicilio_detailblock" target_id="pre_fir1_domicilio">
<?php if (! $this->_tpl_vars['fields']['pre_fir1_domicilio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir1_domicilio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_domicilio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir1_domicilio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir1_domicilio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir1_domicilio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_domicilio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pre_fir2_domicilio','varchar')" class="div_value" id="pre_fir2_domicilio_detailblock" target_id="pre_fir2_domicilio">
<?php if (! $this->_tpl_vars['fields']['pre_fir2_domicilio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pre_fir2_domicilio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_domicilio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pre_fir2_domicilio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pre_fir2_domicilio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pre_fir2_domicilio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_UBICACION','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONDICIONES','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pre_num_unidades']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRE_NUM_UNIDADES','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('num_empleados','int')" class="div_value" id="num_empleados_detailblock" target_id="num_empleados">
<?php if (! $this->_tpl_vars['fields']['pre_num_unidades']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['num_empleados']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['num_empleados']['value']), $this);?>

</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['fecha_precontrato_minima']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_PRECONTRATO_MINIMA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fecha_precontrato_minima','varchar')" class="div_value" id="fecha_precontrato_minima_detailblock" target_id="fecha_precontrato_minima">
<?php if (! $this->_tpl_vars['fields']['fecha_precontrato_minima']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['fecha_precontrato_minima']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fecha_precontrato_minima']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fecha_precontrato_minima']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['fecha_precontrato_minima']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['fecha_precontrato_minima']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_pre']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_APERTURA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_pre','enum')" class="div_value" id="provincia_apertura_pre_detailblock" target_id="provincia_apertura_pre">
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_pre']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_apertura_pre']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_pre']['options'][$this->_tpl_vars['fields']['provincia_apertura_pre']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_precontrato_firma']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_PRECONTRATO_FIRMA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_precontrato_firma','date')" class="div_value" id="f_precontrato_firma_detailblock" target_id="f_precontrato_firma">
<?php if (! $this->_tpl_vars['fields']['f_precontrato_firma']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_precontrato_firma']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_precontrato_firma']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_precontrato_firma']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_precontrato_firma']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_pre']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_APERTURA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_pre','varchar')" class="div_value" id="localidad_apertura_pre_detailblock" target_id="localidad_apertura_pre">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_pre']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['localidad_apertura_pre']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['localidad_apertura_pre']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['localidad_apertura_pre']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_pre']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['localidad_apertura_pre']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['periodo_validez']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PERIODO_VALIDEZ','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('periodo_validez','varchar')" class="div_value" id="periodo_validez_detailblock" target_id="periodo_validez">
<?php if (! $this->_tpl_vars['fields']['periodo_validez']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['periodo_validez']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['periodo_validez']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['periodo_validez']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['periodo_validez']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['periodo_validez']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['direccion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DIRECCION_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local','varchar')" class="div_value" id="direccion_local_detailblock" target_id="direccion_local">
<?php if (! $this->_tpl_vars['fields']['direccion_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['direccion_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['direccion_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['direccion_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['modelo_negocio_precontrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MDN_PRECONTRATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modelo_negocio_precontrato','varchar')" class="div_value" id="modelo_negocio_precontrato_detailblock" target_id="modelo_negocio_precontrato">
<?php if (! $this->_tpl_vars['fields']['modelo_negocio_precontrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['modelo_negocio_precontrato']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modelo_negocio_precontrato']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modelo_negocio_precontrato']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['modelo_negocio_precontrato']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['modelo_negocio_precontrato']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['zona_exclusividad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ZONA_EXCLUSIVIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_exclusividad','text')" class="div_value" id="zona_exclusividad_detailblock" target_id="zona_exclusividad">
<?php if (! $this->_tpl_vars['fields']['zona_exclusividad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_exclusividad']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_exclusividad']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['entrega_cuenta']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREGA_CUENTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entrega_cuenta','varchar')" class="div_value" id="entrega_cuenta_detailblock" target_id="entrega_cuenta">
<?php if (! $this->_tpl_vars['fields']['entrega_cuenta']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['entrega_cuenta']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entrega_cuenta']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entrega_cuenta']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['entrega_cuenta']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['entrega_cuenta']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['zona_reserva']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ZONA_RESERVA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_reserva','text')" class="div_value" id="zona_reserva_detailblock" target_id="zona_reserva">
<?php if (! $this->_tpl_vars['fields']['zona_reserva']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_reserva']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_reserva']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['canon_entrada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CANON_ENTRADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('canon_entrada','varchar')" class="div_value" id="canon_entrada_detailblock" target_id="canon_entrada">
<?php if (! $this->_tpl_vars['fields']['canon_entrada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['canon_entrada']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['canon_entrada']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['canon_entrada']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['canon_entrada']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['canon_entrada']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_F_ENTREGA_CUENTA_PRE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Solo se rellena a la recepcion del justificante','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrega_cuenta_pre','date')" class="div_value" id="f_entrega_cuenta_pre_detailblock" target_id="f_entrega_cuenta_pre">
<?php if (! $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_entrega_cuenta_pre']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['observacion_precontrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACION_PRECONTRATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Recoger solicitudes, objeciones y concesiones relacionadas con el precontrato. EN definitiva, cualquier observacion para redartar el precontrato",'module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observacion_precontrato','text')" class="div_value" id="observacion_precontrato_detailblock" target_id="observacion_precontrato">
<?php if (! $this->_tpl_vars['fields']['observacion_precontrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observacion_precontrato']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observacion_precontrato']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_PRECONTRATO").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent4'>
<div id='detailpanel_5' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_PLAN_FINANCIERO' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_validado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_VALIDADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_validado','bool')" class="div_value" id="pf_validado_detailblock" target_id="pf_validado">
<?php if (! $this->_tpl_vars['fields']['pf_validado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['pf_validado']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['pf_validado']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['pf_validado']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['pf_validado']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['pf_validado']['name']; ?>
" value="$fields.pf_validado.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_PERFIL_FRANQUICIADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_superficie_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_SUPERFICIE_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_superficie_local','varchar')" class="div_value" id="pf_superficie_local_detailblock" target_id="pf_superficie_local">
<?php if (! $this->_tpl_vars['fields']['pf_superficie_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_superficie_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_superficie_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_superficie_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_superficie_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_superficie_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_tipo_franquiciado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_TIPO_FRANQUICIADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_tipo_franquiciado','varchar')" class="div_value" id="pf_tipo_franquiciado_detailblock" target_id="pf_tipo_franquiciado">
<?php if (! $this->_tpl_vars['fields']['pf_tipo_franquiciado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_tipo_franquiciado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_tipo_franquiciado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_tipo_franquiciado']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_tipo_franquiciado']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_tipo_franquiciado']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_alquiler_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_ALQUILER_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_alquiler_local','varchar')" class="div_value" id="pf_alquiler_local_detailblock" target_id="pf_alquiler_local">
<?php if (! $this->_tpl_vars['fields']['pf_alquiler_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_alquiler_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_alquiler_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_alquiler_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_alquiler_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_alquiler_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_trabajo_negocio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_TRABAJO_NEGOCIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_trabajo_negocio','varchar')" class="div_value" id="pf_trabajo_negocio_detailblock" target_id="pf_trabajo_negocio">
<?php if (! $this->_tpl_vars['fields']['pf_trabajo_negocio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_trabajo_negocio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_trabajo_negocio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_trabajo_negocio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_trabajo_negocio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_trabajo_negocio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_estado_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_ESTADO_LOCAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_estado_local','varchar')" class="div_value" id="pf_estado_local_detailblock" target_id="pf_estado_local">
<?php if (! $this->_tpl_vars['fields']['pf_estado_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_estado_local']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_estado_local']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_estado_local']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_estado_local']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_estado_local']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_forma_juridica']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_FORMA_JURIDICA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_forma_juridica','varchar')" class="div_value" id="pf_forma_juridica_detailblock" target_id="pf_forma_juridica">
<?php if (! $this->_tpl_vars['fields']['pf_forma_juridica']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_forma_juridica']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_forma_juridica']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_forma_juridica']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_forma_juridica']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_forma_juridica']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_historico_sociedad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_HISTORICO_SOCIEDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_historico_sociedad','varchar')" class="div_value" id="pf_historico_sociedad_detailblock" target_id="pf_historico_sociedad">
<?php if (! $this->_tpl_vars['fields']['pf_historico_sociedad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_historico_sociedad']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_historico_sociedad']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_historico_sociedad']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_historico_sociedad']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_historico_sociedad']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_CONDICIONES_APERTURA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_canon_entrada']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_CANON_ENTRADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_canon_entrada','varchar')" class="div_value" id="pf_canon_entrada_detailblock" target_id="pf_canon_entrada">
<?php if (! $this->_tpl_vars['fields']['pf_canon_entrada']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_canon_entrada']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_canon_entrada']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_canon_entrada']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_canon_entrada']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_canon_entrada']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_porcentaje_financia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_PORCENTAJE_FINANCIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_porcentaje_financia','varchar')" class="div_value" id="pf_porcentaje_financia_detailblock" target_id="pf_porcentaje_financia">
<?php if (! $this->_tpl_vars['fields']['pf_porcentaje_financia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_porcentaje_financia']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_porcentaje_financia']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_porcentaje_financia']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_porcentaje_financia']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_porcentaje_financia']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_inversion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_INVERSION','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_inversion','varchar')" class="div_value" id="pf_inversion_detailblock" target_id="pf_inversion">
<?php if (! $this->_tpl_vars['fields']['pf_inversion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_inversion']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_inversion']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_inversion']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_inversion']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_inversion']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pf_f_prevista_inicio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PF_F_PERVISTA_INICIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pf_f_prevista_inicio','varchar')" class="div_value" id="pf_f_prevista_inicio_detailblock" target_id="pf_f_prevista_inicio">
<?php if (! $this->_tpl_vars['fields']['pf_f_prevista_inicio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pf_f_prevista_inicio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_f_prevista_inicio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pf_f_prevista_inicio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pf_f_prevista_inicio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pf_f_prevista_inicio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_PLAN_FINANCIERO").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent5'>
<div id='detailpanel_6' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_CONTRATO' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRMANTE1','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRMANTE2','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir1_first_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_first_name','varchar')" class="div_value" id="con_fir1_first_name_detailblock" target_id="con_fir1_first_name">
<?php if (! $this->_tpl_vars['fields']['con_fir1_first_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir1_first_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_first_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_first_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir1_first_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir1_first_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir2_first_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_first_name','varchar')" class="div_value" id="con_fir2_first_name_detailblock" target_id="con_fir2_first_name">
<?php if (! $this->_tpl_vars['fields']['con_fir2_first_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir2_first_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_first_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_first_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir2_first_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir2_first_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir1_last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_last_name','varchar')" class="div_value" id="con_fir1_last_name_detailblock" target_id="con_fir1_last_name">
<?php if (! $this->_tpl_vars['fields']['con_fir1_last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir1_last_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_last_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_last_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir1_last_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir1_last_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir2_last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_last_name','varchar')" class="div_value" id="con_fir2_last_name_detailblock" target_id="con_fir2_last_name">
<?php if (! $this->_tpl_vars['fields']['con_fir2_last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir2_last_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_last_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_last_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir2_last_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir2_last_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir1_NIF']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_NIF','varchar')" class="div_value" id="con_fir1_NIF_detailblock" target_id="con_fir1_NIF">
<?php if (! $this->_tpl_vars['fields']['con_fir1_NIF']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir1_NIF']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_NIF']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_NIF']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir1_NIF']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir1_NIF']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir2_last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_last_name','varchar')" class="div_value" id="con_fir2_last_name_detailblock" target_id="con_fir2_last_name">
<?php if (! $this->_tpl_vars['fields']['con_fir2_last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir2_last_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_last_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_last_name']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir2_last_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir2_last_name']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir1_vecino']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_VECINO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_vecino','varchar')" class="div_value" id="con_fir1_vecino_detailblock" target_id="con_fir1_vecino">
<?php if (! $this->_tpl_vars['fields']['con_fir1_vecino']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir1_vecino']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_vecino']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_vecino']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir1_vecino']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir1_vecino']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir2_vecino']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_VECINO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_vecino','varchar')" class="div_value" id="con_fir2_vecino_detailblock" target_id="con_fir2_vecino">
<?php if (! $this->_tpl_vars['fields']['con_fir2_vecino']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir2_vecino']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_vecino']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_vecino']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir2_vecino']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir2_vecino']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir1_domicilio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir1_domicilio','varchar')" class="div_value" id="con_fir1_domicilio_detailblock" target_id="con_fir1_domicilio">
<?php if (! $this->_tpl_vars['fields']['con_fir1_domicilio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir1_domicilio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_domicilio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir1_domicilio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir1_domicilio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir1_domicilio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['con_fir2_domicilio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('con_fir2_domicilio','varchar')" class="div_value" id="con_fir2_domicilio_detailblock" target_id="con_fir2_domicilio">
<?php if (! $this->_tpl_vars['fields']['con_fir2_domicilio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['con_fir2_domicilio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_domicilio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['con_fir2_domicilio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['con_fir2_domicilio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['con_fir2_domicilio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SOCIEDAD1','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SOCIEDAD2','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_razon_social']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RAZON_SOCIAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_razon_social','varchar')" class="div_value" id="sociedad1_razon_social_detailblock" target_id="sociedad1_razon_social">
<?php if (! $this->_tpl_vars['fields']['sociedad1_razon_social']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_razon_social']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_razon_social']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_razon_social']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_razon_social']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_razon_social']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_razon_social']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RAZON_SOCIAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_razon_social','varchar')" class="div_value" id="sociedad2_razon_social_detailblock" target_id="sociedad2_razon_social">
<?php if (! $this->_tpl_vars['fields']['sociedad2_razon_social']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_razon_social']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_razon_social']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_razon_social']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_razon_social']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_razon_social']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_nacionalidad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NACIONALIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_nacionalidad','varchar')" class="div_value" id="sociedad1_nacionalidad_detailblock" target_id="sociedad1_nacionalidad">
<?php if (! $this->_tpl_vars['fields']['sociedad1_nacionalidad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_nacionalidad']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_nacionalidad']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_nacionalidad']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_nacionalidad']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_nacionalidad']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_nacionalidad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NACIONALIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_nacionalidad','varchar')" class="div_value" id="sociedad2_nacionalidad_detailblock" target_id="sociedad2_nacionalidad">
<?php if (! $this->_tpl_vars['fields']['sociedad2_nacionalidad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_nacionalidad']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_nacionalidad']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_nacionalidad']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_nacionalidad']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_nacionalidad']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_domicilio_social']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO_SOCIAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_domicilio_social','varchar')" class="div_value" id="sociedad1_domicilio_social_detailblock" target_id="sociedad1_domicilio_social">
<?php if (! $this->_tpl_vars['fields']['sociedad1_domicilio_social']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_domicilio_social']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_domicilio_social']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_domicilio_social']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_domicilio_social']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_domicilio_social']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_domicilio_social']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO_SOCIAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_domicilio_social','varchar')" class="div_value" id="sociedad2_domicilio_social_detailblock" target_id="sociedad2_domicilio_social">
<?php if (! $this->_tpl_vars['fields']['sociedad2_domicilio_social']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_domicilio_social']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_domicilio_social']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_domicilio_social']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_domicilio_social']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_domicilio_social']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cif']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cif','varchar')" class="div_value" id="sociedad1_cif_detailblock" target_id="sociedad1_cif">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cif']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_cif']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cif']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cif']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_cif']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_cif']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_cif']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CIF','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_cif','varchar')" class="div_value" id="sociedad2_cif_detailblock" target_id="sociedad2_cif">
<?php if (! $this->_tpl_vars['fields']['sociedad2_cif']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_cif']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_cif']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_cif']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_cif']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_cif']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_f_ins_reg_mercantil','date')" class="div_value" id="sociedad1_f_ins_reg_mercantil_detailblock" target_id="sociedad1_f_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_f_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_f_ins_reg_mercantil','date')" class="div_value" id="sociedad2_f_ins_reg_mercantil_detailblock" target_id="sociedad2_f_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_f_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LUGAR_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_lugar_ins_reg_mercantil','varchar')" class="div_value" id="sociedad1_lugar_ins_reg_mercantil_detailblock" target_id="sociedad1_lugar_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_lugar_ins_reg_mercantil']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LUGAR_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_lugar_ins_reg_mercantil','varchar')" class="div_value" id="sociedad2_lugar_ins_reg_mercantil_detailblock" target_id="sociedad2_lugar_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_lugar_ins_reg_mercantil']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DATOS_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_datos_ins_reg_mercantil','varchar')" class="div_value" id="sociedad1_datos_ins_reg_mercantil_detailblock" target_id="sociedad1_datos_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_datos_ins_reg_mercantil']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DATOS_INS_REG_MERCANTIL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_datos_ins_reg_mercantil','varchar')" class="div_value" id="sociedad2_datos_ins_reg_mercantil_detailblock" target_id="sociedad2_datos_ins_reg_mercantil">
<?php if (! $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_datos_ins_reg_mercantil']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_representante_legal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_REPRESENTANTE_LEGAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_representante_legal','varchar')" class="div_value" id="sociedad1_representante_legal_detailblock" target_id="sociedad1_representante_legal">
<?php if (! $this->_tpl_vars['fields']['sociedad1_representante_legal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_representante_legal']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_representante_legal']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_representante_legal']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_representante_legal']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_representante_legal']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_representante_legal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_REPRESENTANTE_LEGAL','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_representante_legal','varchar')" class="div_value" id="sociedad2_representante_legal_detailblock" target_id="sociedad2_representante_legal">
<?php if (! $this->_tpl_vars['fields']['sociedad2_representante_legal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_representante_legal']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_representante_legal']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_representante_legal']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_representante_legal']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_representante_legal']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO_REPRESENTANTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_domicilio_representante','varchar')" class="div_value" id="sociedad1_domicilio_representante_detailblock" target_id="sociedad1_domicilio_representante">
<?php if (! $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_domicilio_representante']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DOMICILIO_REPRESENTANTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad2_domicilio_representante','varchar')" class="div_value" id="sociedad2_domicilio_representante_detailblock" target_id="sociedad2_domicilio_representante">
<?php if (! $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad2_domicilio_representante']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cargo_representante']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CARGO_REPRESENTANTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cargo_representante','varchar')" class="div_value" id="sociedad1_cargo_representante_detailblock" target_id="sociedad1_cargo_representante">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cargo_representante']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cargo_representante']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_cargo_representante']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cargo_representante']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CARGO_REPRESENTANTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sociedad1_cargo_representante','varchar')" class="div_value" id="sociedad1_cargo_representante_detailblock" target_id="sociedad1_cargo_representante">
<?php if (! $this->_tpl_vars['fields']['sociedad1_cargo_representante']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cargo_representante']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sociedad1_cargo_representante']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sociedad1_cargo_representante']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACIONES_CANDIDATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONDICIONES_FRANQUICIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_contrato_firma']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_CONTRATO_FIRMA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_contrato_firma','date')" class="div_value" id="f_contrato_firma_detailblock" target_id="f_contrato_firma">
<?php if (! $this->_tpl_vars['fields']['f_contrato_firma']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_contrato_firma']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_contrato_firma']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_contrato_firma']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_contrato_firma']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['modelo_franquicia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MODELO_FRANQUICIA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('modelo_franquicia','varchar')" class="div_value" id="modelo_franquicia_detailblock" target_id="modelo_franquicia">
<?php if (! $this->_tpl_vars['fields']['modelo_franquicia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['modelo_franquicia']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modelo_franquicia']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modelo_franquicia']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['modelo_franquicia']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['modelo_franquicia']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['franquicia_piloto']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_PILOTO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_piloto','varchar')" class="div_value" id="franquicia_piloto_detailblock" target_id="franquicia_piloto">
<?php if (! $this->_tpl_vars['fields']['franquicia_piloto']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['franquicia_piloto']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicia_piloto']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicia_piloto']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_piloto']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['franquicia_piloto']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['lineas_negocio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LINEAS_NEGOCIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lineas_negocio','varchar')" class="div_value" id="lineas_negocio_detailblock" target_id="lineas_negocio">
<?php if (! $this->_tpl_vars['fields']['lineas_negocio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['lineas_negocio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['lineas_negocio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['lineas_negocio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['lineas_negocio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['lineas_negocio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['contrato_condiciones_especiales']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONDICIONES_ESPECIALES','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('contrato_condiciones_especiales','varchar')" class="div_value" id="contrato_condiciones_especiales_detailblock" target_id="contrato_condiciones_especiales">
<?php if (! $this->_tpl_vars['fields']['contrato_condiciones_especiales']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['contrato_condiciones_especiales']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['contrato_condiciones_especiales']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['contrato_condiciones_especiales']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['contrato_condiciones_especiales']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['contrato_condiciones_especiales']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['canon_entrada_definitivo']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CANON_ENTRADA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('canon_entrada_definitivo','varchar')" class="div_value" id="canon_entrada_definitivo_detailblock" target_id="canon_entrada_definitivo">
<?php if (! $this->_tpl_vars['fields']['canon_entrada_definitivo']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['canon_entrada_definitivo']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['canon_entrada_definitivo']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['canon_entrada_definitivo']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['canon_entrada_definitivo']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['canon_entrada_definitivo']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['local_titularidad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCAL_TITULARIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local_titularidad','varchar')" class="div_value" id="local_titularidad_detailblock" target_id="local_titularidad">
<?php if (! $this->_tpl_vars['fields']['local_titularidad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['local_titularidad']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local_titularidad']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local_titularidad']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['local_titularidad']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['local_titularidad']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['importe_abonado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_IMPORTE_ABONADO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('importe_abonado','varchar')" class="div_value" id="importe_abonado_detailblock" target_id="importe_abonado">
<?php if (! $this->_tpl_vars['fields']['importe_abonado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['importe_abonado']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['importe_abonado']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['importe_abonado']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['importe_abonado']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['importe_abonado']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['local_Direccion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DIRECCION','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local1_Direccion','varchar')" class="div_value" id="local1_Direccion_detailblock" target_id="local1_Direccion">
<?php if (! $this->_tpl_vars['fields']['local_Direccion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['local1_Direccion']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local1_Direccion']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local1_Direccion']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['local1_Direccion']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['local1_Direccion']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['marca']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MARCA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('marca','varchar')" class="div_value" id="marca_detailblock" target_id="marca">
<?php if (! $this->_tpl_vars['fields']['marca']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['marca']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['marca']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['marca']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['marca']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['marca']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['local_municipio']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MUNICIPIO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('local_municipio','varchar')" class="div_value" id="local_municipio_detailblock" target_id="local_municipio">
<?php if (! $this->_tpl_vars['fields']['local_municipio']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['local_municipio']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local_municipio']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['local_municipio']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['local_municipio']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['local_municipio']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['estado_marca']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ESTADO_MARCA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('estado_marca','varchar')" class="div_value" id="estado_marca_detailblock" target_id="estado_marca">
<?php if (! $this->_tpl_vars['fields']['estado_marca']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['estado_marca']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['estado_marca']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['estado_marca']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['estado_marca']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['estado_marca']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_apertura']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_APERTURA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_apertura','date')" class="div_value" id="f_apertura_detailblock" target_id="f_apertura">
<?php if (! $this->_tpl_vars['fields']['f_apertura']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_apertura']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_apertura']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_apertura']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_apertura']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['propietario_marca']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROPIETARIO_MARCA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('propietario_marca','varchar')" class="div_value" id="propietario_marca_detailblock" target_id="propietario_marca">
<?php if (! $this->_tpl_vars['fields']['propietario_marca']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['propietario_marca']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['propietario_marca']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['propietario_marca']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['propietario_marca']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['propietario_marca']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['zona_exlusividad']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ZONA_EXCLUSIVIDAD','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona_exlusividad','text')" class="div_value" id="zona_exlusividad_detailblock" target_id="zona_exlusividad">
<?php if (! $this->_tpl_vars['fields']['zona_exlusividad']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_exlusividad']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['zona_exlusividad']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['codigo_marca']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CODIGO_MARCA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('codigo_marca','varchar')" class="div_value" id="codigo_marca_detailblock" target_id="codigo_marca">
<?php if (! $this->_tpl_vars['fields']['codigo_marca']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['codigo_marca']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['codigo_marca']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['codigo_marca']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['codigo_marca']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['codigo_marca']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['entidad_financiera']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTIDAD_FINANCIERA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_financiera','varchar')" class="div_value" id="entidad_financiera_detailblock" target_id="entidad_financiera">
<?php if (! $this->_tpl_vars['fields']['entidad_financiera']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['entidad_financiera']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_financiera']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_financiera']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['entidad_financiera']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['entidad_financiera']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['duracion_contrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DURACION_CONTRATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('duracion_contrato','varchar')" class="div_value" id="duracion_contrato_detailblock" target_id="duracion_contrato">
<?php if (! $this->_tpl_vars['fields']['duracion_contrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['duracion_contrato']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['duracion_contrato']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['duracion_contrato']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['duracion_contrato']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['duracion_contrato']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['n_cuenta']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUENTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('n_cuenta','varchar')" class="div_value" id="n_cuenta_detailblock" target_id="n_cuenta">
<?php if (! $this->_tpl_vars['fields']['n_cuenta']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['n_cuenta']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['n_cuenta']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['n_cuenta']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['n_cuenta']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['n_cuenta']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['pago_en_cuenta']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PAGO_EN_CUENTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pago_en_cuenta','varchar')" class="div_value" id="pago_en_cuenta_detailblock" target_id="pago_en_cuenta">
<?php if (! $this->_tpl_vars['fields']['pago_en_cuenta']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['pago_en_cuenta']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pago_en_cuenta']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['pago_en_cuenta']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pago_en_cuenta']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['pago_en_cuenta']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['lugar_formacion_preferente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LUGAR_FORMACION_PREFERENTE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('lugar_formacion_preferente','varchar')" class="div_value" id="lugar_formacion_preferente_detailblock" target_id="lugar_formacion_preferente">
<?php if (! $this->_tpl_vars['fields']['lugar_formacion_preferente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['lugar_formacion_preferente']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['lugar_formacion_preferente']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['lugar_formacion_preferente']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['lugar_formacion_preferente']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['lugar_formacion_preferente']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['cuenta_expande']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUENTA_EXPANDE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuenta_expande','varchar')" class="div_value" id="cuenta_expande_detailblock" target_id="cuenta_expande">
<?php if (! $this->_tpl_vars['fields']['cuenta_expande']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['cuenta_expande']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuenta_expande']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuenta_expande']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['cuenta_expande']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['cuenta_expande']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['entrega_cuenta_cont']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREGA_CUENTA_CONT','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entrega_cuenta_cont','varchar')" class="div_value" id="entrega_cuenta_cont_detailblock" target_id="entrega_cuenta_cont">
<?php if (! $this->_tpl_vars['fields']['entrega_cuenta_cont']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['entrega_cuenta_cont']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entrega_cuenta_cont']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entrega_cuenta_cont']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['entrega_cuenta_cont']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['entrega_cuenta_cont']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['entidad_fin_expande']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTIDAD_FIN_EXPANDE','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_fin_expande','varchar')" class="div_value" id="entidad_fin_expande_detailblock" target_id="entidad_fin_expande">
<?php if (! $this->_tpl_vars['fields']['entidad_fin_expande']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['entidad_fin_expande']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_fin_expande']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_fin_expande']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['entidad_fin_expande']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['entidad_fin_expande']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_F_ENTREGA_CUENTA_CONT','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Solo se rellena a la recepcion del justificante','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrega_cuenta_cont','date')" class="div_value" id="f_entrega_cuenta_cont_detailblock" target_id="f_entrega_cuenta_cont">
<?php if (! $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_entrega_cuenta_cont']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['cuenta_franquiciador']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUENTA_FRANQUICIADOR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('cuenta_franquiciador','varchar')" class="div_value" id="cuenta_franquiciador_detailblock" target_id="cuenta_franquiciador">
<?php if (! $this->_tpl_vars['fields']['cuenta_franquiciador']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['cuenta_franquiciador']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuenta_franquiciador']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['cuenta_franquiciador']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['cuenta_franquiciador']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['cuenta_franquiciador']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['entidad_fin_franquiciador']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTIDAD_FIN_FRANQUICIADOR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('entidad_fin_franquiciador','varchar')" class="div_value" id="entidad_fin_franquiciador_detailblock" target_id="entidad_fin_franquiciador">
<?php if (! $this->_tpl_vars['fields']['entidad_fin_franquiciador']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['entidad_fin_franquiciador']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_fin_franquiciador']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['entidad_fin_franquiciador']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['entidad_fin_franquiciador']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['entidad_fin_franquiciador']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['inversion_inicial']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTIDAD_FIN_FRANQUICIADOR','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inversion_inicial','varchar')" class="div_value" id="inversion_inicial_detailblock" target_id="inversion_inicial">
<?php if (! $this->_tpl_vars['fields']['inversion_inicial']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['inversion_inicial']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['inversion_inicial']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['inversion_inicial']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['inversion_inicial']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['inversion_inicial']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['royalty_explotacion']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ROYALTY_EXPLOTA','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('royalty_explotacion','varchar')" class="div_value" id="royalty_explotacion_detailblock" target_id="royalty_explotacion">
<?php if (! $this->_tpl_vars['fields']['royalty_explotacion']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['royalty_explotacion']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['royalty_explotacion']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['royalty_explotacion']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['royalty_explotacion']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['royalty_explotacion']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['min_royalty']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MIN_ROYALTY','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('min_royalty','varchar')" class="div_value" id="min_royalty_detailblock" target_id="min_royalty">
<?php if (! $this->_tpl_vars['fields']['min_royalty']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['min_royalty']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['min_royalty']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['min_royalty']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['min_royalty']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['min_royalty']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['fondo_marketing']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FONDO_MARKETING','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fondo_marketing','varchar')" class="div_value" id="fondo_marketing_detailblock" target_id="fondo_marketing">
<?php if (! $this->_tpl_vars['fields']['fondo_marketing']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['fondo_marketing']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fondo_marketing']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fondo_marketing']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['fondo_marketing']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['fondo_marketing']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['observacion_contrato']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACION_CONTRATO','module' => 'Expan_GestionSolicitudes'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observacion_contrato','text')" class="div_value" id="observacion_contrato_detailblock" target_id="observacion_contrato">
<?php if (! $this->_tpl_vars['fields']['observacion_contrato']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observacion_contrato']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observacion_contrato']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean(); ?>
<?php if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']): ?>
<?php echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_CONTRATO").style.display='none';</script>
<?php endif; ?>
</div>
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
function(){SUGAR.util.buildAccessKeyLabels();});
</script><script type='text/javascript' src='<?php echo smarty_function_sugar_getjspath(array('file' => 'include/javascript/popup_helper.js'), $this);?>
'></script>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js'), $this);?>
"></script>
<script type="text/javascript">
var Expan_GestionSolicitudes_detailview_tabs = new YAHOO.widget.TabView("Expan_GestionSolicitudes_detailview_tabs");
Expan_GestionSolicitudes_detailview_tabs.selectTab(0);
</script>
<script src='include/javascript/enhanced_detailview.js'></script>
<script src='include/javascript/popup_helper.js'></script>
<script type='text/javascript'>
	EDV.calendar_format = "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
";
</script>