<?php
require_once('data/SugarBean.php');
require_once('modules/Expan_Empresa/Expan_Empresa.php');
require_once('modules/Expan_Franquicia/Expan_Franquicia.php');

class AccionesGuardadoEmpresa
{
  protected static $fetchedRow = array();

  /**
   * Called as before_save logic hook to grab the fetched_row values
   * @param $bean
   * @param $event
   * @param $arguments
   */
  public function saveFetchedRow($bean, $event, $arguments)
  {
    if ($bean->fetched_row) {
      self::$fetchedRow[$bean->id] = $bean->fetched_row;
    }
  }

  public function ModificacionEmpresa(&$bean, $event, $arguments)
  {
    if (!isset($bean->ignore_update_c) || $bean->ignore_update_c === false) {
      $bean->ignore_update_c = true;

      //Creacion de una nueva Empresa
      if (!isset(self::$fetchedRow[$bean->id])) {

        $fechaHoy = new DateTime();
        $bean->fecha_contacto = $fechaHoy->format('d/m/Y H:i');

        $bean->name = trim($bean->name);
        $bean->save();

        switch ($bean->empresa_type) {
          case 'fa':
            $bean->copyFranquicia($bean);
            break;

          default:

            break;
        }

        //Modificamos los datos de la Empresa
      } else {

        $estadoCPAnt = self::$fetchedRow[$bean->id]['estado_cp'];
        $estadoCPAct = $bean->estado_cp;

        $empresa_typeAnt = self::$fetchedRow[$bean->id]['empresa_type'];
        $empresa_typeAct = $bean->empresa_type;

        if (($estadoCPAct != $estadoCPAnt && $estadoCPAct == "pos") ||
          ($empresa_typeAnt != $empresa_typeAct && $empresa_typeAct = "fa")) {
          $bean->copyFranquicia($bean);
        }

      }
    }
  }

  function ActualizarRel(&$bean, $event, $arguments)
  {
    if (!isset($bean->ignore_update_c) || $bean->ignore_update_c === false) {

      $db = DBManagerFactory::getInstance();

      $query="select * from expan_empresa_competidores_c where empresa_id='".$arguments["related_id"]." and competidor=".$arguments["id"]."' and deleted=0";

      $result = $db -> query($query, true);

      $existeRel = false;

      while ($row = $db -> fetchByAssoc($result)) {
        $existeRel=true;
      }

      if (!$existeRel){

        global $timedate;
        $time_now=TimeDate::getInstance()->nowDb();

        $query=" insert  into expan_empresa_competidores_c ";
        $query=$query."(id,deleted,date_modified,empresa_id,competidor_id,tipo_competidor,competidor_principal) values ";
        $query=$query."(uuid(),0,'".$time_now."','".$arguments["related_id"]."','".$arguments["id"]."',null,0)";

        $db -> query($query);
      }

    }
  }

}
