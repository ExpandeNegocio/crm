<?php
$viewdefs ['Tasks'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.status.value != "Completed"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" class="button" onclick="document.getElementById(\'status\').value=\'Completed\'; this.form.action.value=\'Save\'; this.form.return_module.value=\'Tasks\'; this.form.isDuplicate.value=true; this.form.isSaveAndNew.value=true; this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'; if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(this.form);" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="abrirSolicitudGestionEdicion(\'{$fields.parent_id.value}\');" value="Editar Gestion/Solicitud">{/if}',
          ),  
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
        {sugar_getscript file="include/javascript/EditLlamadas.js"}              
        <script type="text/javascript"> onload=DesactivarGS();</script>
        <script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>
        <script>    name = "gestion".replace(/[\\[]/, "\\[").replace(/[\\]]/, "\\]");
                    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                    results =decodeURIComponent(results[1].replace(/\\+/g, " ")) ;                    
                    $("#parent_name").val(results);
                    $("#parent_type").val("Expan_GestionSolicitudes");                  
                    </script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_TASK_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_task_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'task_type',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'status',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_due',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'priority',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'expan_gestionsolicitudes_tasks_1_name',
          ),
          1 => 
          array (
            'name' => 'oportunidad_inmediata',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'expan_franquicia_tasks_1_name',
          ),
        ),
        6 => 
        array (
          0 =>  array (
            'name' =>'modified_by_name',     
            'label' => 'LBL_MODIFICADO_POR',
          ),  
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
       array (
         0 => 
         array (
           0 => 'assigned_user_name',
            ),
       ),
    ),
  ),
);
?>
