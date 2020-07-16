<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
$hook_version = 1;
$hook_array = Array();


$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'CreacionEventoA', 'custom/include/CreacionEvento.php', 'AccionesGuardadoEvento', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'CreacionEventoD', 'custom/include/CreacionEvento.php', 'AccionesGuardadoEvento', 'CreacionEventoD');

$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(1, 'AsignarRel', 'custom/include/CreacionEvento.php', 'AccionesGuardadoEvento', 'ActualizarRel');
?>