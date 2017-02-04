<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(2, 'wfm_hook', 'custom/include/wfm_hook.php','wfm_hook_process', 'execute_process'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(2, 'wfm_hook', 'custom/include/wfm_hook.php','wfm_hook_process', 'execute_process'); 
$hook_array['before_delete'] = Array(); 
$hook_array['before_delete'][] = Array(2, 'wfm_hook', 'custom/include/wfm_hook.php','wfm_hook_process', 'execute_process'); 
$hook_array['before_delete'][] = Array(1, 'deleteAsolProject', 'custom/include/deleteAsolProject.php','deleteAsolProject', 'deleteAsolProject'); 
$hook_array['after_delete'] = Array(); 
$hook_array['after_delete'][] = Array(1, 'deleteAsolProject', 'custom/include/deleteAsolProject.php','deleteAsolProject', 'deleteAsolProject'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/asol_Project/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesasol_ProjectHook_class', 'after_ui_frame_method'); 



?>