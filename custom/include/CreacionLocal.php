<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_Local/Expan_Local.php');

class AccionesGuardadoGestionLocal
{

  protected static $fetchedRow = array();

  /**
   * Called as before_save logic hook to grab the fetched_row values
   */
  public function saveFetchedRow($bean, $event, $arguments)
  {
    if ($bean->fetched_row) {
      self::$fetchedRow[$bean->id] = $bean->fetched_row;
    }
  }

  public function GuardadoLocal(&$bean, $event, $arguments)
  {

    if (!isset($bean->ignore_update_c) || $bean->ignore_update_c === false) {

      $bean->ignore_update_c = true;

      // Creacion de Local
      if (!isset(self::$fetchedRow[$bean->id])) {

        if ($bean->name == '' || $bean->name == null) {

          if ($bean->expan_solicitud_id != null) {
            $solicitud = new Expan_Solicitud();
            $solicitud->retrieve($bean->expan_solicitud_id);
            $name = $solicitud->first_name . ' ' . $solicitud->last_name . '-' . $GLOBALS['app_list_strings']['municipiosCC_list'][$bean->localidad];

          } else if ($bean->expan_solicitud_id != null) {
            $franquicia = new Expan_Franquicia();
            $franquicia->retrieve($bean->expan_solicitud_id);
            $name = $franquicia->name . "-" . $GLOBALS['app_list_strings']['municipiosCC_list'][$bean->localidad];
          }

          $num=$this->probarNombre($name);

          if ($num!=0){
            $num++;
            $name.= '-' .$num;
          }

          $bean->name = $name;
        }
        // Modificacion de Local
      } else {

      }
      $bean->ignore_update_c = true;
      $bean->save();
    }
  }

  private function probarNombre($name)
  {

    $name.= '%';

    $num=0;

    $query = "SELECT count(1) num from expan_local where name like  '$name'";

    $db = DBManagerFactory::getInstance();
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $num= $row['num'];
    }

    return $num;
  }

}