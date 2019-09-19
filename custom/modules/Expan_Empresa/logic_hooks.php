<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'CreaEmpresa', 'custom/include/CreacionEmpresa.php', 'AccionesGuardadoEmpresa', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'ModEmpresa', 'custom/include/CreacionEmpresa.php', 'AccionesGuardadoEmpresa', 'ModificacionEmpresa');

$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(2, 'EliminaEmpresa', 'custom/include/CreacionEmpresa.php','AccionesGuardadoEmpresa', 'BorrarEmpresa');

$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(1, 'AsignarRel', 'custom/include/CreacionEmpresa.php', 'AccionesGuardadoEmpresa', 'ActualizarRel');

?>


