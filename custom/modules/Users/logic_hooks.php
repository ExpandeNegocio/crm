<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Users/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesUsersHook_class', 'after_ui_frame_method'); 
$hook_array['after_login'][] = Array(5, 'custom_external_session', 'custom/modules/Users/custom_external_session.php', 'custom_external_session', 'get_current_user');


?>