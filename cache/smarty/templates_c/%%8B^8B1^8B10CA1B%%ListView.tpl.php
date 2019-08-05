<?php /* Smarty version 2.6.11, created on 2019-08-05 16:02:36
         compiled from include/SugarFields/Fields/Bool/ListView.tpl */ ?>

    <?php if (strval ( $this->_tpl_vars['parentFieldArray'][$this->_tpl_vars['col']] ) == '1' || strval ( $this->_tpl_vars['parentFieldArray'][$this->_tpl_vars['col']] ) == 'yes' || strval ( $this->_tpl_vars['parentFieldArray'][$this->_tpl_vars['col']] ) == 'on'): ?>
<?php $this->assign('checked', 'CHECKED'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="checkbox" class="checkbox" disabled="true" <?php echo $this->_tpl_vars['checked']; ?>
>