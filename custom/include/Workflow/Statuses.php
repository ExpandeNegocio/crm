<?php
class WF_Statuses {

  protected $module;
  protected $type;

  protected $statusField;

  protected $roles;

  protected $statuses = array ();
    
  protected $events = array ();

  protected $beanName;
  protected $bean0;

  function WF_Statuses ($module, $type) {
    global $beanList;
    $this->module = $module;
    $this->type   = $type;
    // TODO проверить, что модуль такой есть
    $this->beanName = $beanList[$module];
    $this->bean0 = new $this->beanName ();
    // TODO Проверить наличие файла
    require ("custom/modules/{$module}/workflow/{$this->type}/statuses.php");
    $this->statusField = $workflow['statusField'];
    $this->statuses = $this->normStatuses ($workflow['statuses']);

    $this->events = $workflow['events'];
    $this->roles = $this->normRoles($workflow['roles']);
  }

private function normStatuses ($s) {
  return $this->array_flat (array_map (function ($i) { return array ($i['name'] => $i['label']); }, $s));
}

private function normRoles ($r) {  return $this->normStatuses($r); }


/***************************************
* Получение сведений о маршруте
****************************************/

  public function getNewStatuses ($status, $user_id) {
    $th = &$this;
    $statuses = $this->getAllStatuses();
    return $this->array_flat (
         array_map (function ($i) use ($statuses) { return array ($i['status2'] => $statuses[$i['status2']]); }, 
                   array_filter($this->events, 
                                function ($i) use ($status, $user_id, &$th) { 
                                  return $th->hasAnyRole ($user_id, $i['confirm_roles'], 'confirm') && 
                                        ((empty($i['status1']) && empty($status)) || $i['status1'] === $status); 
                                })
        )
    );
  }

  public function getUserStatuses ($user_id) {
    $th = &$this;
    $statuses = $this->getAllStatuses();
    $statuses1 =  $this->array_flat (
         array_map (function ($i) use ($statuses) { return array ($i[status1] => $statuses[$i[status1]]); }, 
                   array_filter($this->events, 
                                function ($i) use ($user_id, &$th) { 
                                  return !empty($i['status1']) && $th->hasAnyRole ($user_id, $i['confirm_roles'], 'confirm'); 
                                })
        )
    );
    return $statuses1;
  }

  public function getExecutersForNewStatus ($s, $user_id) {
    $th = &$this;
    $r = array_filter ($this->events,
                       function ($i) use (&$th, $s, $user_id) { 
                          return $i['status1'] == $s && $th->hasAnyRole ($user_id, $i['confirm_roles'], 'confirm'); 
                       });
// FIXME ошибка с array flat
    $r = /*$this->array_flat3*/ (array_map (function ($i) use (&$th) { 
         //    function mycmp ($a, $b) { return $a == $b; }
//             return array ('status' => $i['status2'], 
//                           'executers' => /*uksort*/ ($th->array_flat2 (array_map (function ($j) use (&$th) { 
//                                                        return $th->getUsersForRole ($j, 'assigned');
//                                                     }, $i['executer_roles']))/*, "mycmp" function ($a, $b) { return $a == $b;})*/ )); 
//         }, $r)); 
             return array ($i['status2'] =>  
                            /*uksort*/ ($th->array_flat2 (array_map (function ($j) use (&$th) { 
                                                        return $th->getUsersForRole ($j, 'assigned');
                                                     }, $i['executer_roles']))/*, "mycmp" function ($a, $b) { return $a == $b;})*/ )); 
         }, $r)); 
    $r = $this->array_flat ($r);

//echo "R = " . print_r($r, true) . "<br><br>";

//echo "users: " . print_r(get_user_array(), true) . "<br>";
//die();
    return $r;
  }

  public function getAllRoles () { return $this->roles; }

  public function getAllStatuses () { return $this->statuses; }

  public function getStatusField () {return $this->statusField;}

  public function getAllowedEvents ($s1, $s2, $user_id) {
    $th = &$this;
    $res = 
      array_filter($this->events, 
                   function ($i) use (&$th, $s1, $s2, $user_id) { 
                     return $th->hasAnyRole ($user_id, $i['confirm_roles'], 'confirm') && $i['status1'] == $s1 && $i['status2'] == $s2; 
                   }
      );
return $res;
  }

  public function getLogicForEvent ($s1, $s2) {
    return $this->array_flat (array_map (
      function ($i) { return $i['logic']; },
      array_filter ($this->events, function ($i) use ($s1, $s2) { 
                                      return isset($i['logic']) && $i['status1'] == $s1 && $i['status2'] == $s2;
                                   })
    ));
  }

  // FIXME: вместо двух функций getLogicForEvent и getConfirmActionForEvent и getErrorsForEvent
  // FIXME: сделать одну функцию getEvent
  // FIXME: А если разрешим несоклько событий с одними и теми же s1 и s2, только разные права и разные опции event-ов?
  public function getConfirmActionForEvent ($s1, $s2) {
    return $this->array_flat (array_map (
      function ($i) { return $i['confirm_action']; },
      array_filter ($this->events, function ($i) use ($s1, $s2) { 
                                      return isset($i['confirm_action']) && $i['status1'] == $s1 && $i['status2'] == $s2;
                                   })
    ));
  }

  public function getErrorsForEvent ($s1, $s2, & $focus) {
    require_once ('custom/include/Logic/LogicHook.php');

    $logics = $this->array_flat (array_map (
      function ($i) { return $i['logic']; },
      array_filter ($this->events, function ($i) use ($s1, $s2) { 
                                      return isset($i['logic']) && $i['logic']['type'] == 'check' &&
                                             $i['status1'] == $s1 && $i['status2'] == $s2;
                                   })
    ));

    $errors = array ();
    foreach ($logics as $l) if ($e = LogicBeforeSave::evaluateLogic ($l, $focus)) $errors[] = $e;

    return $errors;
  }

/**************************************
* Проверка допустимости действия
**************************************/

  public function isEventAllowed ($s1, $s2, $user_id) {
    $th = &$this;
// TODO: использовать getAllowedEvents
    return 
      count(array_filter($this->events, 
                        function ($i) use (&$th, $s1, $s2, $user_id) { 
                          return $th->hasAnyRole ($user_id, $i['confirm_roles'], 'confirm') && $i['status1'] == $s1 && $i['status2'] == $s2; 
                        }
      )) > 0;
  }

 public function isStatusStarting ($s, $user_id) {
   return in_array ($s, array_keys($this->getNewStatuses ('', $user_id)));
 }

 public function hasAnyRole ($user_id, $roles, $kind) {
   $th = &$this;
   $res = array_reduce ($roles, function ($r, $j) use (&$th, $user_id, $kind) { return $r || $th->hasRole($user_id, $j, $kind); }, FALSE); 
   return array_reduce ($roles, function ($r, $j) use (&$th, $user_id, $kind) { return $r || $th->hasRole($user_id, $j, $kind); }, FALSE); 
 }


 public function hasRole($user_id, $role, $kind) {
   $l = new WF_User ();
   $s = "wf_module='{$this->module}' AND wf_type='{$this->type}' AND kind='$kind' AND role = '$role' AND user_id = '$user_id'";
   $res = $l->get_full_list ('', $s);
   return count($res) > 0;
 } 

 public function getUsersForRole($role, $kind) {
   $l = new WF_User ();
   $s = "wf_module='{$this->module}' AND wf_type='{$this->type}' AND kind='$kind' AND role = '$role'";
   $res = $l->get_full_list ('', $s);
   $res = $this->array_flat (array_map (function ($i) { return array ($i->user_id => $i->user_name);}, $res));
return $res;
 }
/*************************************************
* Утилиты
*************************************************/

  // TODO в утилиты
  function array_flat ($a) { return array_reduce ($a, 'array_merge', array ()); }

function array_flat2 ($a) {
  $res = array ();
  foreach ($a as $e) 
    foreach ($e as $k => $v) $res[$k] = $v;
  return $res;
}
}


?>
