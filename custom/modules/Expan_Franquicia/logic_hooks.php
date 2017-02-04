<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'AsignarTelefonoA', 'custom/include/CreacionFranquicia.php', 'AccionesGuardadoFranq', 'saveFetchedRow');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'AsignarTelefonoD', 'custom/include/CreacionFranquicia.php', 'AccionesGuardadoFranq', 'ModificacionFranq');

?>