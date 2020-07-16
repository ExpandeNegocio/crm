<?php
  require_once ('data/SugarBean.php');
  require_once('custom/include/AvisosAdmin.php');
  require_once('modules/Expan_Evento/Expan_Evento.php');

  class AccionesGuardadoEvento {

    protected static $fetchedRow = array();

    /**
     * Called as before_save logic hook to grab the fetched_row values
     * @param $bean
     * @param $event
     * @param $arguments
     */
    public function saveFetchedRow($bean, $event, $arguments) {
      if ($bean -> fetched_row) {
        self::$fetchedRow[$bean -> id] = $bean -> fetched_row;
      }
    }

    public function CreacionEventoD(&$bean, $event, $arguments) {
      if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {

        $bean->ignore_update_c = true;

        //Creacion de una nuevo Evento
        if (!isset(self::$fetchedRow[$bean->id])) {
          $AvisosAdmin= new AvisosAdmin();
          $AvisosAdmin->enviaCorreo(AvisosAdmin::CREACION_EVENTO,'',$bean->name,$bean->fecha_celebracion);
        //Modificacion
        }else {

        }
      }
    }

    function ActualizarRel(&$bean, $event, $arguments) {

      if (!isset($bean -> ignore_update_c) || $bean -> ignore_update_c === false) {
        //logic goes here;

        $fran= new Expan_Franquicia();
        $fran->retrieve($arguments[related_bean]->id);

        if ($fran->tipo_cuenta==1 || $fran->tipo_cuenta==2){
          $AvisosAdmin= new AvisosAdmin();
          $AvisosAdmin->enviaCorreo(AvisosAdmin::ACT_EVENTO,$fran->name,$bean->name,$bean->fecha_celebracion);
        }
      }
    }

  }
?>