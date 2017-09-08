<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
$hook_version = 1;
$hook_array = Array();

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'AsignarTelefonoA', 'custom/include/CreacionLlamada.php', 'AccionesGuardadoTel', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'AsignarTelefonoD', 'custom/include/CreacionLlamada.php', 'AccionesGuardadoTel', 'AsignacionTelefono');

$hook_array['after_delete'] = Array();
$hook_array['after_delete'][] = Array(1, 'BorrarTelefonoD', 'custom/include/BorradaLlamada.php', 'AccionesBorradoLlamada', 'after_delete_method');

$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(1, 'BorrarTelefonoA', 'custom/include/BorradaLlamada.php', 'AccionesBorradoLlamada', 'before_delete_method');

$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(1, 'AsignarRel', 'custom/include/CreacionLlamada.php', 'AccionesGuardadoTel', 'ActualizarRel');

$hook_array['after_ui_frame'] = Array();
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Calls/DHA_DocumentTemplatesHooks.php', 'DHA_DocumentTemplatesCallsHook_class', 'after_ui_frame_method');
?>