<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'AntesGuardarTarea', 'custom/include/CreacionTarea.php', 'controlTareas', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'DespuesGuardarTarea', 'custom/include/CreacionTarea.php', 'controlTareas', 'modTareas');

$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(1, 'AsignarRel', 'custom/include/CreacionTarea.php', 'controlTareas', 'ActualizarRel');
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Tasks/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesTasksHook_class', 'after_ui_frame_method'); 

?>