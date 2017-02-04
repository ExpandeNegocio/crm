<?php if(!defined('sugarEntry') ||!sugarEntry) die('Not A Valid Entry Point');
class custom_external_session {
     function get_current_user(& $focus, $event, $arguments){
          global $current_user;
          $user_id = $current_user->id;
          session_start();
          $_SESSION["custom_current_user"] =  $user_id;
          $_SESSION["custom_current_userfranq"] =  $current_user->franquicia;
     }
}
?>  