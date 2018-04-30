<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'CrearDocumentoA', 'custom/include/CreacionDocumento.php', 'AccionesGuardadoDocumento', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'CrearDocumentoD', 'custom/include/CreacionDocumento.php', 'AccionesGuardadoDocumento', 'ModificacionDocumento');
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Documents/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesDocumentsHook_class', 'after_ui_frame_method'); 

?>