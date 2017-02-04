<?php /* Smarty version 2.6.11, created on 2017-01-07 19:16:15
         compiled from modules/Administration/templates/RepairDatabase.tpl */ ?>

<h3><?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_DIFFERENCES']; ?>
</h3>
<p><?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_TEXT']; ?>
</p>
<form name="RepairDatabaseForm" method="post">
<input type="hidden" name="module" value="Administration"/>
<input type="hidden" name="action" value="repairDatabase"/>
<input type="hidden" name="raction" value="execute"/>
<textarea name="sql" rows="24" cols="150" id="repairsql"><?php echo $this->_tpl_vars['qry_str']; ?>
</textarea>
<br/>
<input type="button" class="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_EXECUTE']; ?>
" onClick="document.RepairDatabaseForm.submit();"/> 
<input type="button" class="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REPAIR_DATABASE_EXPORT']; ?>
" onClick="document.RepairDatabaseForm.raction.value='export'; document.RepairDatabaseForm.submit();"/>