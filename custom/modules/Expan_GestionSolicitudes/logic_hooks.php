<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
//$hook_array['after_save'] = Array(); 
//$hook_array['after_save'][] = Array(2, 'wfm_hook', 'custom/include/wfm_hook.php','wfm_hook_process', 'execute_process'); 
//$hook_array['before_save'] = Array(); 
//$hook_array['before_save'][] = Array(2, 'wfm_hook', 'custom/include/wfm_hook.php','wfm_hook_process', 'execute_process'); 

$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'envioCorreo', 'custom/include/CreacionGestionSolicitud.php','AccionesGuardadoGestionSol', 'guardadoGestionSolicitud'); 
$hook_array['before_delete'] = Array(); 
$hook_array['before_delete'][] = Array(2, 'EliminarGestion', 'custom/include/EliminarGestion.php','AccionesEliminadoGest', 'EliminarGestion');

$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1, 'Accounts InsideView frame', 'modules/Connectors/connectors/sources/ext/rest/insideview/InsideViewLogicHook.php','InsideViewLogicHook', 'showFrame'); 
$hook_array['after_ui_frame'][] = Array(2, 'AddButtonsToListView', 'custom/modules/Expan_GestionSolicitudes/metadata/boton.php','Boton', 'add');

?>