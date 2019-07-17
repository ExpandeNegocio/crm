<?php /* Smarty version 2.6.11, created on 2019-07-17 19:47:17
         compiled from cache/modules/Expan_Solicitud/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Expan_Solicitud/DetailView.tpl', 33, false),array('function', 'sugar_translate', 'cache/modules/Expan_Solicitud/DetailView.tpl', 40, false),array('function', 'counter', 'cache/modules/Expan_Solicitud/DetailView.tpl', 68, false),array('function', 'multienum_to_array', 'cache/modules/Expan_Solicitud/DetailView.tpl', 88, false),array('function', 'sugar_phone', 'cache/modules/Expan_Solicitud/DetailView.tpl', 402, false),array('function', 'sugar_help', 'cache/modules/Expan_Solicitud/DetailView.tpl', 1509, false),array('function', 'sugar_number_format', 'cache/modules/Expan_Solicitud/DetailView.tpl', 1634, false),array('function', 'sugar_getjspath', 'cache/modules/Expan_Solicitud/DetailView.tpl', 2950, false),array('modifier', 'strip_semicolon', 'cache/modules/Expan_Solicitud/DetailView.tpl', 78, false),array('modifier', 'escape', 'cache/modules/Expan_Solicitud/DetailView.tpl', 974, false),array('modifier', 'url2html', 'cache/modules/Expan_Solicitud/DetailView.tpl', 974, false),array('modifier', 'nl2br', 'cache/modules/Expan_Solicitud/DetailView.tpl', 974, false),)), $this); ?>


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
" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_Solicitud'; _form.return_action.value='DetailView'; _form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
"><?php endif; ?>  <?php if ($this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Expan_Solicitud'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
" id="delete_button"><?php endif; ?>  <?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Expan_Solicitud", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?><div class="clear"></div></div>
</div>
</td>
<td align="right" width="20%"><?php echo $this->_tpl_vars['ADMIN_EDIT']; ?>

<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<div id="Expan_Solicitud_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CONTACT_INFORMATION','module' => 'Expan_Solicitud'), $this);?>
</em></a></li>

<li><a id="tab1" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL2','module' => 'Expan_Solicitud'), $this);?>
</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL1','module' => 'Expan_Solicitud'), $this);?>
</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDITVIEW_PANEL_TAG','module' => 'Expan_Solicitud'), $this);?>
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

<table id='LBL_CONTACT_INFORMATION' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tipo_origen']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TIPO_ORIGEN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tipo_origen','multienum')" class="div_value" id="tipo_origen_detailblock" target_id="tipo_origen">
<?php if (! $this->_tpl_vars['fields']['tipo_origen']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['tipo_origen']['value'] ) && ( $this->_tpl_vars['fields']['tipo_origen']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tipo_origen']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['tipo_origen']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['tipo_origen']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['tipo_origen']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['subor_expande']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBOR_EXPANDE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_expande','enum')" class="div_value" id="subor_expande_detailblock" target_id="subor_expande">
<?php if (! $this->_tpl_vars['fields']['subor_expande']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['subor_expande']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_expande']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_expande']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_expande']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_expande']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_expande']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_expande']['options'][$this->_tpl_vars['fields']['subor_expande']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['portal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PORTAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('portal','enum')" class="div_value" id="portal_detailblock" target_id="portal">
<?php if (! $this->_tpl_vars['fields']['portal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['portal']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['portal']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['portal']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['portal']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['portal']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['portal']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['portal']['options'][$this->_tpl_vars['fields']['portal']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['expan_evento_id_c']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EVENTO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('expan_evento_id_c','enum')" class="div_value" id="expan_evento_id_c_detailblock" target_id="expan_evento_id_c">
<?php if (! $this->_tpl_vars['fields']['expan_evento_id_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['expan_evento_id_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['expan_evento_id_c']['options'][$this->_tpl_vars['fields']['expan_evento_id_c']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['subor_central']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBOR_CENTRAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_central','enum')" class="div_value" id="subor_central_detailblock" target_id="subor_central">
<?php if (! $this->_tpl_vars['fields']['subor_central']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['subor_central']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_central']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_central']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_central']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_central']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_central']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_central']['options'][$this->_tpl_vars['fields']['subor_central']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['subor_medios']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBOR_MEDIOS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_medios','enum')" class="div_value" id="subor_medios_detailblock" target_id="subor_medios">
<?php if (! $this->_tpl_vars['fields']['subor_medios']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['subor_medios']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_medios']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_medios']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_medios']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_medios']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_medios']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_medios']['options'][$this->_tpl_vars['fields']['subor_medios']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['subor_mailing']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBOR_MAILING','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('subor_mailing','enum')" class="div_value" id="subor_mailing_detailblock" target_id="subor_mailing">
<?php if (! $this->_tpl_vars['fields']['subor_mailing']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['subor_mailing']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_mailing']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_mailing']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_mailing']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['subor_mailing']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['subor_mailing']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['subor_mailing']['options'][$this->_tpl_vars['fields']['subor_mailing']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['first_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('first_name','varchar')" class="div_value" id="first_name_detailblock" target_id="first_name">
<?php if (! $this->_tpl_vars['fields']['first_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="first_name" class="sugar_field"><b><p style="font-size:14px;"><?php echo $this->_tpl_vars['fields']['first_name']['value']; ?>
</p></b></span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['empresa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('empresa','varchar')" class="div_value" id="empresa_detailblock" target_id="empresa">
<?php if (! $this->_tpl_vars['fields']['empresa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['empresa']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['empresa']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['empresa']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['empresa']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['empresa']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['last_name']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('last_name','varchar')" class="div_value" id="last_name_detailblock" target_id="last_name">
<?php if (! $this->_tpl_vars['fields']['last_name']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="last_name" class="sugar_field"><b><p style="font-size:14px;"><?php echo $this->_tpl_vars['fields']['last_name']['value']; ?>
</p></b></span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['phone_mobile']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOBILE_PHONE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_mobile','phone')" class="div_value" id="phone_mobile_detailblock" target_id="phone_mobile">
<?php if (! $this->_tpl_vars['fields']['phone_mobile']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['phone_mobile']['value'] )): ?>
<?php $this->assign('phone_value', $this->_tpl_vars['fields']['phone_mobile']['value']); ?>
<?php echo smarty_function_sugar_phone(array('value' => $this->_tpl_vars['phone_value'],'usa_format' => '0'), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['email1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_ADDRESS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('email1','varchar')" class="div_value" id="email1_detailblock" target_id="email1">
<?php if (! $this->_tpl_vars['fields']['email1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id='email1_span'>
<?php echo $this->_tpl_vars['fields']['email1']['value']; ?>

</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['phone_home']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_HOME_PHONE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_home','phone')" class="div_value" id="phone_home_detailblock" target_id="phone_home">
<?php if (! $this->_tpl_vars['fields']['phone_home']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['phone_home']['value'] )): ?>
<?php $this->assign('phone_value', $this->_tpl_vars['fields']['phone_home']['value']); ?>
<?php echo smarty_function_sugar_phone(array('value' => $this->_tpl_vars['phone_value'],'usa_format' => '0'), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['skype']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SKYPE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('skype','varchar')" class="div_value" id="skype_detailblock" target_id="skype">
<?php if (! $this->_tpl_vars['fields']['skype']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['skype']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['skype']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['skype']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['skype']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['skype']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['phone_work']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OFFICE_PHONE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_work','phone')" class="div_value" id="phone_work_detailblock" target_id="phone_work">
<?php if (! $this->_tpl_vars['fields']['phone_work']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['phone_work']['value'] )): ?>
<?php $this->assign('phone_value', $this->_tpl_vars['fields']['phone_work']['value']); ?>
<?php echo smarty_function_sugar_phone(array('value' => $this->_tpl_vars['phone_value'],'usa_format' => '0'), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['linkedin']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LINKEDIN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('linkedin','varchar')" class="div_value" id="linkedin_detailblock" target_id="linkedin">
<?php if (! $this->_tpl_vars['fields']['linkedin']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['linkedin']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['linkedin']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['linkedin']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['linkedin']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['linkedin']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['no_correos_c']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NO_CORREOS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('no_correos_c','bool')" class="div_value" id="no_correos_c_detailblock" target_id="no_correos_c">
<?php if (! $this->_tpl_vars['fields']['no_correos_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['no_correos_c']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['no_correos_c']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['no_correos_c']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['no_correos_c']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['no_correos_c']['name']; ?>
" value="$fields.no_correos_c.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['do_not_call']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DO_NOT_CALL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('do_not_call','bool')" class="div_value" id="do_not_call_detailblock" target_id="do_not_call">
<?php if (! $this->_tpl_vars['fields']['do_not_call']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['do_not_call']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['do_not_call']['name']; ?>
" value="$fields.do_not_call.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['no_newsletter']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NEWSLETTER','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('no_newsletter','bool')" class="div_value" id="no_newsletter_detailblock" target_id="no_newsletter">
<?php if (! $this->_tpl_vars['fields']['no_newsletter']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['no_newsletter']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['no_newsletter']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['no_newsletter']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['no_newsletter']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['no_newsletter']['name']; ?>
" value="$fields.no_newsletter.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['disp_contacto']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('disp_contacto','enum')" class="div_value" id="disp_contacto_detailblock" target_id="disp_contacto">
<?php if (! $this->_tpl_vars['fields']['disp_contacto']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['disp_contacto']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['disp_contacto']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['disp_contacto']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['disp_contacto']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['disp_contacto']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['disp_contacto']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['disp_contacto']['options'][$this->_tpl_vars['fields']['disp_contacto']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['master']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MASTER_FRANQUICIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('master','bool')" class="div_value" id="master_detailblock" target_id="master">
<?php if (! $this->_tpl_vars['fields']['master']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['master']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['master']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['master']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['master']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['master']['name']; ?>
" value="$fields.master.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['pais_c']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PAIS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pais_c','enum')" class="div_value" id="pais_c_detailblock" target_id="pais_c">
<?php if (! $this->_tpl_vars['fields']['pais_c']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['pais_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pais_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['pais_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['pais_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pais_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['pais_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['pais_c']['options'][$this->_tpl_vars['fields']['pais_c']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['fecha_primer_contacto']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_PRIMER_CONTACTO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fecha_primer_contacto','date')" class="div_value" id="fecha_primer_contacto_detailblock" target_id="fecha_primer_contacto">
<?php if (! $this->_tpl_vars['fields']['fecha_primer_contacto']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['fecha_primer_contacto']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fecha_primer_contacto']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['fecha_primer_contacto']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['fecha_primer_contacto']['name']; ?>
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
<?php if (! $this->_tpl_vars['fields']['provincia_residencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_RESIDENCIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_residencia','enum')" class="div_value" id="provincia_residencia_detailblock" target_id="provincia_residencia">
<?php if (! $this->_tpl_vars['fields']['provincia_residencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_residencia']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options'][$this->_tpl_vars['fields']['provincia_residencia']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['localidad_residencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_RESIDENCIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_residencia','varchar')" class="div_value" id="localidad_residencia_detailblock" target_id="localidad_residencia">
<?php if (! $this->_tpl_vars['fields']['localidad_residencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['localidad_residencia']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['localidad_residencia']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['localidad_residencia']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_residencia']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['localidad_residencia']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_APERTURA_1','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_1','enum')" class="div_value" id="provincia_apertura_1_detailblock" target_id="provincia_apertura_1">
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_apertura_1']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_1']['options'][$this->_tpl_vars['fields']['provincia_apertura_1']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_APERTURA_1','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_1','enum')" class="div_value" id="localidad_apertura_1_detailblock" target_id="localidad_apertura_1">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['localidad_apertura_1']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_1']['options'][$this->_tpl_vars['fields']['localidad_apertura_1']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_APERTURA_2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_2','enum')" class="div_value" id="provincia_apertura_2_detailblock" target_id="provincia_apertura_2">
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_apertura_2']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_2']['options'][$this->_tpl_vars['fields']['provincia_apertura_2']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_APERTURA_2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_2','enum')" class="div_value" id="localidad_apertura_2_detailblock" target_id="localidad_apertura_2">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['localidad_apertura_2']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_2']['options'][$this->_tpl_vars['fields']['localidad_apertura_2']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_APERTURA_3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_apertura_3','enum')" class="div_value" id="provincia_apertura_3_detailblock" target_id="provincia_apertura_3">
<?php if (! $this->_tpl_vars['fields']['provincia_apertura_3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_apertura_3']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_apertura_3']['options'][$this->_tpl_vars['fields']['provincia_apertura_3']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCALIDAD_APERTURA_3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('localidad_apertura_3','enum')" class="div_value" id="localidad_apertura_3_detailblock" target_id="localidad_apertura_3">
<?php if (! $this->_tpl_vars['fields']['localidad_apertura_3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['localidad_apertura_3']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['localidad_apertura_3']['options'][$this->_tpl_vars['fields']['localidad_apertura_3']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['observaciones_zona_apertura']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACIONES_ZONA_APERTURA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_zona_apertura','text')" class="div_value" id="observaciones_zona_apertura_detailblock" target_id="observaciones_zona_apertura">
<?php if (! $this->_tpl_vars['fields']['observaciones_zona_apertura']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_zona_apertura']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_zona_apertura']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['zona']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ZONA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('zona','enum')" class="div_value" id="zona_detailblock" target_id="zona">
<?php if (! $this->_tpl_vars['fields']['zona']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['zona']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['zona']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['zona']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['zona']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['zona']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['zona']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['zona']['options'][$this->_tpl_vars['fields']['zona']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['pais_residencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PAIS_RESIDENCIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('pais_residencia','enum')" class="div_value" id="pais_residencia_detailblock" target_id="pais_residencia">
<?php if (! $this->_tpl_vars['fields']['pais_residencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['pais_residencia']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pais_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['pais_residencia']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['pais_residencia']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['pais_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['pais_residencia']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['pais_residencia']['options'][$this->_tpl_vars['fields']['pais_residencia']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['provincia_residencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PROVINCIA_RESIDENCIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('provincia_residencia','enum')" class="div_value" id="provincia_residencia_detailblock" target_id="provincia_residencia">
<?php if (! $this->_tpl_vars['fields']['provincia_residencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['provincia_residencia']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['provincia_residencia']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['provincia_residencia']['options'][$this->_tpl_vars['fields']['provincia_residencia']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['oportunidad_inmediata']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OPORTUNIDAD_INMEDIATA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
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
<?php if (! $this->_tpl_vars['fields']['candidatura_caliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CANDIDATURA_CALIENTE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
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
<?php if (! $this->_tpl_vars['fields']['check_puertas_abiertas']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PUERTAS_ABIERTAS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('check_puertas_abiertas','bool')" class="div_value" id="check_puertas_abiertas_detailblock" target_id="check_puertas_abiertas">
<?php if (! $this->_tpl_vars['fields']['check_puertas_abiertas']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['check_puertas_abiertas']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['check_puertas_abiertas']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['check_puertas_abiertas']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['check_puertas_abiertas']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['check_puertas_abiertas']['name']; ?>
" value="$fields.check_puertas_abiertas.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['contacto_secundario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CONTACTO_SECUNDARIO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('contacto_secundario','varchar')" class="div_value" id="contacto_secundario_detailblock" target_id="contacto_secundario">
<?php if (! $this->_tpl_vars['fields']['contacto_secundario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['contacto_secundario']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['contacto_secundario']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['contacto_secundario']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['contacto_secundario']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['contacto_secundario']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['correo_secundario']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CORREO_SECUNDARIO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('correo_secundario','varchar')" class="div_value" id="correo_secundario_detailblock" target_id="correo_secundario">
<?php if (! $this->_tpl_vars['fields']['correo_secundario']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['correo_secundario']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['correo_secundario']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['correo_secundario']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['correo_secundario']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['correo_secundario']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['phone_other']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OTHER_PHONE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' class="phone">
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('phone_other','phone')" class="div_value" id="phone_other_detailblock" target_id="phone_other">
<?php if (! $this->_tpl_vars['fields']['phone_other']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['phone_other']['value'] )): ?>
<?php $this->assign('phone_value', $this->_tpl_vars['fields']['phone_other']['value']); ?>
<?php echo smarty_function_sugar_phone(array('value' => $this->_tpl_vars['phone_value'],'usa_format' => '0'), $this);?>

<?php endif; ?>
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
<script>document.getElementById("LBL_CONTACT_INFORMATION").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent1'>
<div id='detailpanel_2' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_EDITVIEW_PANEL2' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREVISTA_PREVIA_CLIENTE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_cliente','bool')" class="div_value" id="chk_entrevista_previa_cliente_detailblock" target_id="chk_entrevista_previa_cliente">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['name']; ?>
" value="$fields.chk_entrevista_previa_cliente.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREVISTA_PREVIA_EN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_EN','bool')" class="div_value" id="chk_entrevista_previa_EN_detailblock" target_id="chk_entrevista_previa_EN">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['name']; ?>
" value="$fields.chk_entrevista_previa_EN.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREVISTA_PREVIA_EN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_EN','bool')" class="div_value" id="chk_entrevista_previa_EN_detailblock" target_id="chk_entrevista_previa_EN">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_EN']['name']; ?>
" value="$fields.chk_entrevista_previa_EN.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTREVISTA_PREVIA_CLIENTE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_entrevista_previa_cliente','bool')" class="div_value" id="chk_entrevista_previa_cliente_detailblock" target_id="chk_entrevista_previa_cliente">
<?php if (! $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_entrevista_previa_cliente']['name']; ?>
" value="$fields.chk_entrevista_previa_cliente.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['f_entrevista_previa_EN']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_ENTREVISTA_PREVIA_EN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista_previa_EN','date')" class="div_value" id="f_entrevista_previa_EN_detailblock" target_id="f_entrevista_previa_EN">
<?php if (! $this->_tpl_vars['fields']['f_entrevista_previa_EN']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_entrevista_previa_EN']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista_previa_EN']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista_previa_EN']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_entrevista_previa_EN']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FECHA_ENTREVISTA_PREVIA_CLIENTE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('f_entrevista_previa_cliente','date')" class="div_value" id="f_entrevista_previa_cliente_detailblock" target_id="f_entrevista_previa_cliente">
<?php if (! $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (strlen ( $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['value']); ?>
<?php endif; ?>
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['f_entrevista_previa_cliente']['name']; ?>
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
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_USUARIO_ENTREVISTA_PREVIA_EN','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa_EN','varchar')" class="div_value" id="usuario_entrevista_previa_EN_detailblock" target_id="usuario_entrevista_previa_EN">
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa_EN']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_USUARIO_ENTREVISTA_PREVIA_CLIENTE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('usuario_entrevista_previa_cliente','varchar')" class="div_value" id="usuario_entrevista_previa_cliente_detailblock" target_id="usuario_entrevista_previa_cliente">
<?php if (! $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['usuario_entrevista_previa_cliente']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['perfil_profesional']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PERFIL_PROFESIONAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_profesional','text')" class="div_value" id="perfil_profesional_detailblock" target_id="perfil_profesional">
<?php if (! $this->_tpl_vars['fields']['perfil_profesional']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['perfil_profesional']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['perfil_profesional']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['historial_empresa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_HISTORIAL_EMPRESA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('historial_empresa','multienum')" class="div_value" id="historial_empresa_detailblock" target_id="historial_empresa">
<?php if (! $this->_tpl_vars['fields']['historial_empresa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['historial_empresa']['value'] ) && ( $this->_tpl_vars['fields']['historial_empresa']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['historial_empresa']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['historial_empresa']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['historial_empresa']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['historial_empresa']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
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
<?php if (! $this->_tpl_vars['fields']['sectores_historicos']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SECTORES_HISTORICOS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se pueden añadir varios sectores separados por coma",'module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sectores_historicos','varchar')" class="div_value" id="sectores_historicos_detailblock" target_id="sectores_historicos">
<?php if (! $this->_tpl_vars['fields']['sectores_historicos']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['sectores_historicos']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sectores_historicos']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['sectores_historicos']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sectores_historicos']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['sectores_historicos']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['empresa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('empresa','varchar')" class="div_value" id="empresa_detailblock" target_id="empresa">
<?php if (! $this->_tpl_vars['fields']['empresa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['empresa']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['empresa']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['empresa']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['empresa']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['empresa']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['franquicia_historicos']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_HISTORICOS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se pueden añadir varias franquicias separadas por coma",'module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_historicos','varchar')" class="div_value" id="franquicia_historicos_detailblock" target_id="franquicia_historicos">
<?php if (! $this->_tpl_vars['fields']['franquicia_historicos']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['franquicia_historicos']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicia_historicos']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicia_historicos']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_historicos']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['franquicia_historicos']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['inicio_franq_hst']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_INICIO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('inicio_franq_hst','int')" class="div_value" id="inicio_franq_hst_detailblock" target_id="inicio_franq_hst">
<?php if (! $this->_tpl_vars['fields']['inicio_franq_hst']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['inicio_franq_hst']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['inicio_franq_hst']['value']), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['fin_franq_hst']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_CIERRE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('fin_franq_hst','int')" class="div_value" id="fin_franq_hst_detailblock" target_id="fin_franq_hst">
<?php if (! $this->_tpl_vars['fields']['fin_franq_hst']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['fin_franq_hst']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['fin_franq_hst']['value']), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['franquicia_satisfa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_SATISFA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_satisfa','enum')" class="div_value" id="franquicia_satisfa_detailblock" target_id="franquicia_satisfa">
<?php if (! $this->_tpl_vars['fields']['franquicia_satisfa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['franquicia_satisfa']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['franquicia_satisfa']['options'][$this->_tpl_vars['fields']['franquicia_satisfa']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['chk_empresa_provee']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA_PROVEE','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'La empresa es proveedor','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_provee','bool')" class="div_value" id="chk_empresa_provee_detailblock" target_id="chk_empresa_provee">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_provee']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_empresa_provee']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_empresa_provee']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_empresa_provee']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_empresa_provee']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_empresa_provee']['name']; ?>
" value="$fields.chk_empresa_provee.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA_CLI_POTENCIAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'La empresa es un cliente potencial','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_cli_potencial','bool')" class="div_value" id="chk_empresa_cli_potencial_detailblock" target_id="chk_empresa_cli_potencial">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_empresa_cli_potencial']['name']; ?>
" value="$fields.chk_empresa_cli_potencial.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_competencia']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA_COMPETENCIA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'La empresa es competencia de nuestras franquicias','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_competencia','bool')" class="div_value" id="chk_empresa_competencia_detailblock" target_id="chk_empresa_competencia">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_competencia']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_empresa_competencia']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_empresa_competencia']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_empresa_competencia']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_empresa_competencia']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_empresa_competencia']['name']; ?>
" value="$fields.chk_empresa_competencia.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
&nbsp;
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('','')" class="div_value" id="_detailblock" target_id="">
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_alianza']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMPRESA_ALIANZA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'La empresa puede ser una alianza','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('chk_empresa_alianza','bool')" class="div_value" id="chk_empresa_alianza_detailblock" target_id="chk_empresa_alianza">
<?php if (! $this->_tpl_vars['fields']['chk_empresa_alianza']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['chk_empresa_alianza']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['chk_empresa_alianza']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['chk_empresa_alianza']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['chk_empresa_alianza']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['chk_empresa_alianza']['name']; ?>
" value="$fields.chk_empresa_alianza.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['observaciones_solicitud']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OBSERVACIONES_SOLICITUD','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Los datos contenidos en estas observaciones no llegan a la central','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('observaciones_solicitud','text')" class="div_value" id="observaciones_solicitud_detailblock" target_id="observaciones_solicitud">
<?php if (! $this->_tpl_vars['fields']['observaciones_solicitud']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_solicitud']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['observaciones_solicitud']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['cuando_empezar']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CUANDO_EMPEZAR','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
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
<?php if (! $this->_tpl_vars['fields']['rrss']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RRSS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('rrss','text')" class="div_value" id="rrss_detailblock" target_id="rrss">
<?php if (! $this->_tpl_vars['fields']['rrss']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rrss']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['rrss']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['dispone_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DISPONE_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('dispone_local','enum')" class="div_value" id="dispone_local_detailblock" target_id="dispone_local">
<?php if (! $this->_tpl_vars['fields']['dispone_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['dispone_local']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['dispone_local']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['dispone_local']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['dispone_local']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['dispone_local']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['dispone_local']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['dispone_local']['options'][$this->_tpl_vars['fields']['dispone_local']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['capital']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CAPITAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('capital','enum')" class="div_value" id="capital_detailblock" target_id="capital">
<?php if (! $this->_tpl_vars['fields']['capital']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['capital']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['capital']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['capital']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['capital']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['capital']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['capital']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['capital']['options'][$this->_tpl_vars['fields']['capital']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['capital_observaciones']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CAPITAL_OBSERVACIONES','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('capital_observaciones','varchar')" class="div_value" id="capital_observaciones_detailblock" target_id="capital_observaciones">
<?php if (! $this->_tpl_vars['fields']['capital_observaciones']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['capital_observaciones']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['capital_observaciones']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['capital_observaciones']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['capital_observaciones']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['capital_observaciones']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['recursos_propios']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RECURSOS_PROPIOS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
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
<?php if (! $this->_tpl_vars['fields']['sectores_de_interes']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SECTORES_DE_INTERES','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('sectores_de_interes','multienum')" class="div_value" id="sectores_de_interes_detailblock" target_id="sectores_de_interes">
<?php if (! $this->_tpl_vars['fields']['sectores_de_interes']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['sectores_de_interes']['value'] ) && ( $this->_tpl_vars['fields']['sectores_de_interes']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['sectores_de_interes']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['sectores_de_interes']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['sectores_de_interes']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['sectores_de_interes']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['franquicias_secundarias']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIAS_SECUNDARIAS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicias_secundarias','multienum')" class="div_value" id="franquicias_secundarias_detailblock" target_id="franquicias_secundarias">
<?php if (! $this->_tpl_vars['fields']['franquicias_secundarias']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['franquicias_secundarias']['value'] ) && ( $this->_tpl_vars['fields']['franquicias_secundarias']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicias_secundarias']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['franquicias_secundarias']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['franquicias_secundarias']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['franquicias_secundarias']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
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
<?php if (! $this->_tpl_vars['fields']['otros_sectores']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OTROS_SECTORES','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otros_sectores','text')" class="div_value" id="otros_sectores_detailblock" target_id="otros_sectores">
<?php if (! $this->_tpl_vars['fields']['otros_sectores']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['otros_sectores']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['otros_sectores']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['franquicia_principal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIA_PRINCIPAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicia_principal','enum')" class="div_value" id="franquicia_principal_detailblock" target_id="franquicia_principal">
<?php if (! $this->_tpl_vars['fields']['franquicia_principal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['franquicia_principal']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_principal']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['franquicia_principal']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['franquicia_principal']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicia_principal']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['franquicia_principal']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['franquicia_principal']['options'][$this->_tpl_vars['fields']['franquicia_principal']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['franquicias_contactadas']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FRANQUICIAS_CONTACTADAS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se pueden añadir varias franquicias separadas por coma",'module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('franquicias_contactadas','varchar')" class="div_value" id="franquicias_contactadas_detailblock" target_id="franquicias_contactadas">
<?php if (! $this->_tpl_vars['fields']['franquicias_contactadas']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['franquicias_contactadas']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicias_contactadas']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['franquicias_contactadas']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['franquicias_contactadas']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['franquicias_contactadas']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['otras_franquicias']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OTRAS_FRANQUICIAS','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('otras_franquicias','varchar')" class="div_value" id="otras_franquicias_detailblock" target_id="otras_franquicias">
<?php if (! $this->_tpl_vars['fields']['otras_franquicias']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['otras_franquicias']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['otras_franquicias']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['otras_franquicias']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['otras_franquicias']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['otras_franquicias']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['enviar_servicios_asesora']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ENVIAR_SERVICIOS_ASESORA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('enviar_servicios_asesora','bool')" class="div_value" id="enviar_servicios_asesora_detailblock" target_id="enviar_servicios_asesora">
<?php if (! $this->_tpl_vars['fields']['enviar_servicios_asesora']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['enviar_servicios_asesora']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['enviar_servicios_asesora']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['enviar_servicios_asesora']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['fields']['enviar_servicios_asesora']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['enviar_servicios_asesora']['name']; ?>
" value="$fields.enviar_servicios_asesora.value" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
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
<?php if (! $this->_tpl_vars['fields']['rating']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RATING','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
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
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['perfil_plurifranquiciado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PERFIL_PLURIFRANQUICIADO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('perfil_plurifranquiciado','enum')" class="div_value" id="perfil_plurifranquiciado_detailblock" target_id="perfil_plurifranquiciado">
<?php if (! $this->_tpl_vars['fields']['perfil_plurifranquiciado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['perfil_plurifranquiciado']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['perfil_plurifranquiciado']['options'][$this->_tpl_vars['fields']['perfil_plurifranquiciado']['value']]; ?>

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
<?php if (! $this->_tpl_vars['fields']['delegado']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DELEGADO','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('delegado','enum')" class="div_value" id="delegado_detailblock" target_id="delegado">
<?php if (! $this->_tpl_vars['fields']['delegado']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['delegado']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['delegado']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['delegado']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['delegado']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['delegado']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['delegado']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['delegado']['options'][$this->_tpl_vars['fields']['delegado']['value']]; ?>

<?php endif; ?>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL2").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_EDITVIEW_PANEL1' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCAL1','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%' colspan='3' >
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
<?php if (! $this->_tpl_vars['fields']['direccion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DIRECCION_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
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
<?php if (! $this->_tpl_vars['fields']['superficie_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUPERFICIE_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local','int')" class="div_value" id="superficie_local_detailblock" target_id="superficie_local">
<?php if (! $this->_tpl_vars['fields']['superficie_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['superficie_local']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['superficie_local']['value']), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['ubicacion_local1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_UBICACION_LOCAL1','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local1','enum')" class="div_value" id="ubicacion_local1_detailblock" target_id="ubicacion_local1">
<?php if (! $this->_tpl_vars['fields']['ubicacion_local1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['ubicacion_local1']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local1']['options'][$this->_tpl_vars['fields']['ubicacion_local1']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_1']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RENTA_ESTIMADA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_1','varchar')" class="div_value" id="renta_estimada_1_detailblock" target_id="renta_estimada_1">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_1']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['renta_estimada_1']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_1']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_1']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['renta_estimada_1']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['renta_estimada_1']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['descripcion_local']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPCION_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local','text')" class="div_value" id="descripcion_local_detailblock" target_id="descripcion_local">
<?php if (! $this->_tpl_vars['fields']['descripcion_local']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
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
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCAL2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%' colspan='3' >
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
<?php if (! $this->_tpl_vars['fields']['direccion_local2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DIRECCION_LOCAL2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local2','varchar')" class="div_value" id="direccion_local2_detailblock" target_id="direccion_local2">
<?php if (! $this->_tpl_vars['fields']['direccion_local2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['direccion_local2']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local2']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local2']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['direccion_local2']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['direccion_local2']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['superficie_local2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUPERFICIE_LOCAL2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local2','int')" class="div_value" id="superficie_local2_detailblock" target_id="superficie_local2">
<?php if (! $this->_tpl_vars['fields']['superficie_local2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['superficie_local2']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['superficie_local2']['value']), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['ubicacion_local2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_UBICACION_LOCAL2','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local2','enum')" class="div_value" id="ubicacion_local2_detailblock" target_id="ubicacion_local2">
<?php if (! $this->_tpl_vars['fields']['ubicacion_local2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['ubicacion_local2']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local2']['options'][$this->_tpl_vars['fields']['ubicacion_local2']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RENTA_ESTIMADA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_2','varchar')" class="div_value" id="renta_estimada_2_detailblock" target_id="renta_estimada_2">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['renta_estimada_2']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_2']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_2']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['renta_estimada_2']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['renta_estimada_2']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['descripcion_local2']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPCION_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local2','text')" class="div_value" id="descripcion_local2_detailblock" target_id="descripcion_local2">
<?php if (! $this->_tpl_vars['fields']['descripcion_local2']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local2']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local2']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
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
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCAL3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%' colspan='3' >
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
<?php if (! $this->_tpl_vars['fields']['direccion_local3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DIRECCION_LOCAL3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('direccion_local3','varchar')" class="div_value" id="direccion_local3_detailblock" target_id="direccion_local3">
<?php if (! $this->_tpl_vars['fields']['direccion_local3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['direccion_local3']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local3']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['direccion_local3']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['direccion_local3']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['direccion_local3']['value']; ?>
</span>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['superficie_local3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SUPERFICIE_LOCAL3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('superficie_local3','int')" class="div_value" id="superficie_local3_detailblock" target_id="superficie_local3">
<?php if (! $this->_tpl_vars['fields']['superficie_local3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['superficie_local3']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['superficie_local3']['value']), $this);?>

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
<?php if (! $this->_tpl_vars['fields']['ubicacion_local3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_UBICACION_LOCAL3','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('ubicacion_local3','enum')" class="div_value" id="ubicacion_local3_detailblock" target_id="ubicacion_local3">
<?php if (! $this->_tpl_vars['fields']['ubicacion_local3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['ubicacion_local3']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['ubicacion_local3']['options'][$this->_tpl_vars['fields']['ubicacion_local3']['value']]; ?>

<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RENTA_ESTIMADA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('renta_estimada_3','varchar')" class="div_value" id="renta_estimada_3_detailblock" target_id="renta_estimada_3">
<?php if (! $this->_tpl_vars['fields']['renta_estimada_3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['renta_estimada_3']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_3']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['renta_estimada_3']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['renta_estimada_3']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['renta_estimada_3']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['descripcion_local3']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPCION_LOCAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('descripcion_local3','text')" class="div_value" id="descripcion_local3_detailblock" target_id="descripcion_local3">
<?php if (! $this->_tpl_vars['fields']['descripcion_local3']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local3']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fields']['descripcion_local3']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlentitydecode') : smarty_modifier_escape($_tmp, 'htmlentitydecode')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('url2html', true, $_tmp) : url2html($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL1").style.display='none';</script>
<?php endif; ?>
</div>    <div id='tabcontent3'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table id='LBL_EDITVIEW_PANEL_TAG' class="panelContainer" cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['tags_empresa']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TAG_EMPRESA','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => "Se pueden añadir varias franquicias separadas por coma",'module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['popupText'] = ob_get_contents();  $this->assign('popupText', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['popupText'],'WIDTH' => 400), $this);?>

<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('tags_empresa','varchar')" class="div_value" id="tags_empresa_detailblock" target_id="tags_empresa">
<?php if (! $this->_tpl_vars['fields']['tags_empresa']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['tags_empresa']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tags_empresa']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['tags_empresa']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['tags_empresa']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['tags_empresa']['value']; ?>
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
<?php if (! $this->_tpl_vars['fields']['motivos_interes']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOTIVOS_INTERES','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('motivos_interes','multienum')" class="div_value" id="motivos_interes_detailblock" target_id="motivos_interes">
<?php if (! $this->_tpl_vars['fields']['motivos_interes']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['motivos_interes']['value'] ) && ( $this->_tpl_vars['fields']['motivos_interes']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['motivos_interes']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['motivos_interes']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['motivos_interes']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['motivos_interes']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>
</div>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['habilidades']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_HABILIDADES','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('habilidades','multienum')" class="div_value" id="habilidades_detailblock" target_id="habilidades">
<?php if (! $this->_tpl_vars['fields']['habilidades']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['habilidades']['value'] ) && ( $this->_tpl_vars['fields']['habilidades']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['habilidades']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['habilidades']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['habilidades']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['habilidades']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
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
<?php if (! $this->_tpl_vars['fields']['situacion_personal']['hidden']): ?>
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SITUACION_PERSONAL','module' => 'Expan_Solicitud'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<div style="width: 100%; min-height: 10px;" ondblclick="EDV.show_edit('situacion_personal','multienum')" class="div_value" id="situacion_personal_detailblock" target_id="situacion_personal">
<?php if (! $this->_tpl_vars['fields']['situacion_personal']['hidden']): ?>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['situacion_personal']['value'] ) && ( $this->_tpl_vars['fields']['situacion_personal']['value'] != '^^' )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['situacion_personal']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['situacion_personal']['value']; ?>
">
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['situacion_personal']['value'],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li style="margin-left:10px;"><?php echo $this->_tpl_vars['fields']['situacion_personal']['options'][$this->_tpl_vars['item']]; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
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
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_EDITVIEW_PANEL_TAG").style.display='none';</script>
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
var Expan_Solicitud_detailview_tabs = new YAHOO.widget.TabView("Expan_Solicitud_detailview_tabs");
Expan_Solicitud_detailview_tabs.selectTab(0);
</script>
<script src='include/javascript/enhanced_detailview.js'></script>
<script src='include/javascript/popup_helper.js'></script>
<script type='text/javascript'>
	EDV.calendar_format = "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
";
</script>