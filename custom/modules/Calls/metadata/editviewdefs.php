<?php

//SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\'; document.EditView.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; {/if}formSubmitCheck();;  Avisar();

$guardar='SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\'; 
document.EditView.return_action.value=\'DetailView\'; 
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; 
{/if}formSubmitCheck();;  Avisar({$fields.repeticiones.value});
';

$viewdefs ['Calls'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
          1 => '<input type="hidden" name="send_invites">',
          2 => '<input type="hidden" name="user_invitees">',
          3 => '<input type="hidden" name="lead_invitees">',
          4 => '<input type="hidden" name="contact_invitees">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id="SAVE_HEADER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="'.$guardar.'" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="Guardar y Crear Nuevo id="CLOSE_CREATE_FOOTER" accessKey="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_KEY}" class="button" onclick="SUGAR.calls.fill_invitees(); document.EditView.action.value=\'Save\'; document.EditView.return_module.value=\'Calls\'; document.EditView.isDuplicate.value=true; document.EditView.isSaveAndNew.value=true; document.EditView.return_action.value=\'EditView\'; document.EditView.return_id.value=\'{$fields.id.value}\'; formSubmitCheck();" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),         
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="abrirGestionesAgrupadas(\'{$fields.id.value}\');  abrirSolicitudEdicion(\'{$fields.parent_id.value}\');" value="Editar Gestion/Solicitud">{/if}',
          ),
         /*         
             7 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="abrirSolicitudGestionEdicion(\'{$fields.parent_id.value}\');" value="Editar Gestion/Solicitud">{/if}',
          ), 
           
           8 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="crearLlamada(\'{$fields.parent_id.value}\');" value="Crear Llamada">{/if}',
          ),
          9 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="crearTarea(\'{$fields.parent_id.value}\');" value="Crear Tarea">{/if}',
          ),  */   
        ),
        'buttons_footer' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id="SAVE_FOOTER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="'.$guardar.'" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="Guardar y Crear Nuevo id="CLOSE_CREATE_FOOTER" accessKey="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_KEY}" class="button" onclick="SUGAR.calls.fill_invitees(); document.EditView.action.value=\'Save\'; document.EditView.return_module.value=\'Calls\'; document.EditView.isDuplicate.value=true; document.EditView.isSaveAndNew.value=true; document.EditView.return_action.value=\'EditView\'; document.EditView.return_id.value=\'{$fields.id.value}\'; formSubmitCheck();" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),         
          3 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="abrirGestionesAgrupadas(\'{$fields.id.value}\');  abrirSolicitudEdicion(\'{$fields.parent_id.value}\');" value="Editar Gestion/Solicitud">{/if}',
          ),
      /*    8 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="crearLlamada(\'{$fields.parent_id.value}\');" value="Crear Llamada">{/if}',
          ),
          9 => 
          array (
            'customCode' => '{if $fields.id.value!=""} <input type="button" name="save" id="save" class="submit" 
                    onClick="crearTarea(\'{$fields.parent_id.value}\');" value="Crear Tarea">{/if}',
          ),*/
        ),
        'footerTpl' => 'modules/Calls/tpls/footer.tpl',
      ),
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
        <script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>
        <script type="text/javascript"> onload=DesactivarGS(\'{$fields.parent_id.value}\',\'Expan_GestionSolicitudes\');</script>
        <script>    name = "gestion".replace(/[\\[]/, "\\[").replace(/[\\]]/, "\\]");
                    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                    results =decodeURIComponent(results[1].replace(/\\+/g, " ")) ;                    
                    $("#expan_gestionsolicitudes_calls_1_name").val(results);
                    $("#direction").val("Outbound");                    
                    </script>
        <script>toggle_portal_flag();function toggle_portal_flag()  {ldelim} {$TOGGLE_JS} {rdelim}
        function formSubmitCheck(){ldelim}var duration=true;if(typeof(isValidDuration)!="undefined"){ldelim}duration=isValidDuration();{rdelim}if(check_form(\'EditView\') && duration){ldelim}SUGAR.ajaxUI.submitForm("EditView");{rdelim}{rdelim}</script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CALL_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_call_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'call_type',
          ),
          1 => 
          array (
            'name' => 'status',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'direction',
              ),
              1 => 
              array (
                'name' => 'status',
              ),
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'displayParams' => 
            array (
              'updateCallback' => 'SugarWidgetScheduler.update_time();',
            ),
            'label' => 'LBL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'date_delayed',
            'displayParams' => 
            array (
              'updateCallback' => 'SugarWidgetScheduler.update_time();',
            ),
            'label' => 'LBL_DATE_DELAYED',
          ),
         
        ),
      
        2 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'telefono',
            'label' => 'LBL_TELEFONO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
          1 => 
          array (
            'name' => 'oportunidad_inmediata',
            'label' => 'LBL_OPORTUNIDAD_INMEDIATA',
          ),
        ),
        4 => 
        array (
            0 =>  array (
            'name' =>'modified_by_name',     
            'label' => 'LBL_MODIFICADO_POR',
          ), 
           1 => 
          array (
            'name' => 'disp_contacto',
            'label' => 'LBL_DISPONIBILIDAD_HORARIA_CONTACTO',
          ),
                                  
        ),
      ),
    ),
  ),
);
?>
