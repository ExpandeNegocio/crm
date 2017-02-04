<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'AsignarReunionA', 'custom/include/CreacionReunion.php', 'AccionesGuardadoReunion', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'AsignarReunionD', 'custom/include/CreacionReunion.php', 'AccionesGuardadoReunion', 'AsignacionReunion');

//$hook_array['after_relationship_add'] = Array();
//$hook_array['after_relationship_add'][] = Array(1, 'AsignarRel', 'custom/include/CreacionReunion.php', 'AccionesGuardadoReunion', 'ActualizarRel');

$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Meetings/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesMeetingsHook_class', 'after_ui_frame_method'); 



?>