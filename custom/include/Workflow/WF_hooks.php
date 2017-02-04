<?php
class WF_hooks {

  function array_flat ($as) {
    return array_reduce ($as, 'array_merge', array ());
  }


  function after_entry_point ($event) {
    require_once ('custom/include/Workflow/utils.php');
  }

  function before_save (&$focus, $event) {
    global $current_user;
    require_once ('custom/include/Workflow/Statuses.php');
    $wf = new WF_Statuses ($focus->module_name, $focus->wf_type);
    $statusField = $wf->getStatusField();

    $errors = "";
    if (!empty($focus->fetched_row['id'])) {
      if ($focus->fetched_row[$statusField] != $focus->$statusField) {
        
        if (!$wf->isEventAllowed ($focus->fetched_row[$statusField], $focus->$statusField, $current_user->id)) 
          sugar_die ("Недопустимый перевод из статуса {$focus->fetched_row[$statusField]} в статус {$focus->$statusField}");

        require_once ('custom/include/Logic/LogicHook.php');
        $logic = $wf->getLogicForEvent ($focus->fetched_row[$statusField], $focus->$statusField);  
        foreach ($logic as $l) {
          $e = LogicBeforeSave::evaluateLogic ($l, $focus);
          if ($e != FALSE) $errors .= "$e; ";
        }       
      }
    } else { // FIXME Объединить в блок, где status1 == '' будет частным случаем 
// FIXME начальный статус тоже по пользователям
      if (!$wf->isStatusStarting ($focus->$statusField, $current_user->id)) 
        sugar_die ("Недопустимый начальный статус {$focus->$statusField}");

        $logic = $wf->getLogicForEvent ('', $focus->$statusField);  
        foreach ($logic as $l) {
          $e = LogicBeforeSave::evaluateLogic ($l, $focus);
          if ($e != FALSE) $errors .= "$e; ";
        }    
    }   
    if ($errors != "") sugar_die($errors);
  }
}
?>
