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
            $this->copyFranquicia($bean);
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
          $this->copyFranquicia($bean);
        }

      }
    }
  }

  private function copyFranquicia($bean)
  {

    $franq = new Expan_Franquicia();

    switch ($bean->positivo_cp) {
      case 'con':
        $franq->tipo_cuenta = 1;
        break;

      case 'int':
        $franq->tipo_cuenta = 2;
        break;

      case 'ssd':
        $franq->tipo_cuenta = 3;
        break;

      default:
        $franq->tipo_cuenta = 4;
        break;
    }

    $franq->name = $bean->name;
    $franq->empresa = $bean->id;
    $franq->sector = $bean->sector;
    $franq->phone_office = $bean->telefono_contacto_1;
    $franq->ignore_update_c = true;
    $franq->save();
  }

}
