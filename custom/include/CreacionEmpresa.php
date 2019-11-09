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

        $query = "select * from expan_empresa_competidores_c where empresa_id='" . $arguments["related_id"] . " and competidor=" . $arguments["id"] . "' and deleted=0";

        $result = $db->query($query, true);

        $existeRel = false;

        while ($row = $db->fetchByAssoc($result)) {
          $existeRel = true;
        }

        if (!$existeRel) {

          global $timedate;
          $time_now = TimeDate::getInstance()->nowDb();

          $query = " insert  into expan_empresa_competidores_c ";
          $query = $query . "(id,deleted,date_modified,empresa_id,competidor_id,tipo_competidor,competidor_principal) values ";
          $query = $query . "(uuid(),0,'" . $time_now . "','" . $arguments["related_id"] . "','" . $arguments["id"] . "',null,0)";

          $db->query($query);
        }

        $this->cloneFranquicia($bean);

      }
    }

    private function CloneFranquicia($bean)
    {

      $franquicia = $bean->getFranquicia();

      if ($franquicia != null) {

        if (self::$fetchedRow[$bean->id]['chk_es_cliente_potencial'] != $bean->chk_es_cliente_potencial && $bean->chk_es_cliente_potencial != "") {
          $franquicia->chk_es_cliente_potencial = $bean->chk_es_cliente_potencial;
        }
        if (self::$fetchedRow[$bean->id]['chk_es_proveedor'] != $bean->chk_es_proveedor && $bean->chk_es_proveedor != "") {
          $franquicia->chk_es_proveedor = $bean->chk_es_proveedor;
        }
        if (self::$fetchedRow[$bean->id]['chk_es_competidor'] != $bean->chk_es_competidor && $bean->chk_es_competidor != "") {
          $franquicia->chk_es_competidor = $bean->chk_es_competidor;
        }
        if (self::$fetchedRow[$bean->id]['chk_alianza'] != $bean->chk_alianza && $bean->chk_alianza != "") {
          $franquicia->chk_alianza = $bean->chk_alianza;
        }
        if (self::$fetchedRow[$bean->id]['cif'] != $bean->cif && $bean->cif != "") {
          $franquicia->cif = $bean->cif;
        }
        if (self::$fetchedRow[$bean->id]['razon_social'] != $bean->razon_social && $bean->razon_social != "") {
          $franquicia->razon_social = $bean->razon_social;
        }
        if (self::$fetchedRow[$bean->id]['regmarca'] != $bean->regmarca && $bean->regmarca != "") {
          $franquicia->regmarca = $bean->regmarca;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_1'] != $bean->telefono_contacto_1 && $bean->telefono_contacto_1 != "") {
          $franquicia->telefono_contacto_1 = $bean->telefono_contacto_1;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_observa1'] != $bean->telefono_contacto_observa1 && $bean->telefono_contacto_observa1 != "") {
          $franquicia->telefono_contacto_observa1 = $bean->telefono_contacto_observa1;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_2'] != $bean->telefono_contacto_2 && $bean->telefono_contacto_2 != "") {
          $franquicia->telefono_contacto_2 = $bean->telefono_contacto_2;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_observa2'] != $bean->telefono_contacto_observa2 && $bean->telefono_contacto_observa2 != "") {
          $franquicia->telefono_contacto_observa2 = $bean->telefono_contacto_observa2;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_3'] != $bean->telefono_contacto_3 && $bean->telefono_contacto_3 != "") {
          $franquicia->telefono_contacto_3 = $bean->telefono_contacto_3;
        }
        if (self::$fetchedRow[$bean->id]['telefono_contacto_observa3'] != $bean->telefono_contacto_observa3 && $bean->telefono_contacto_observa3 != "") {
          $franquicia->telefono_contacto_observa3 = $bean->telefono_contacto_observa3;
        }
        if (self::$fetchedRow[$bean->id]['contacto1'] != $bean->contacto1 && $bean->contacto1 != "") {
          $franquicia->persona_contacto = $bean->contacto1;
        }
        if (self::$fetchedRow[$bean->id]['contacto2'] != $bean->contacto2  && $bean->contacto2 != "") {
          $franquicia->contacto_general_2 = $bean->contacto2;
        }
        if (self::$fetchedRow[$bean->id]['telefono1'] != $bean->telefono1 && $bean->telefono1 != "") {
          $franquicia->phone_office = $bean->telefono1;
        }
        if (self::$fetchedRow[$bean->id]['telefono2'] != $bean->telefono2 && $bean->telefono2 != "") {
          $franquicia->telefono_contacto_2 = $bean->telefono2;
        }
        if (self::$fetchedRow[$bean->id]['movil1'] != $bean->movil1 && $bean->movil1 != "") {
          $franquicia->movil_general = $bean->movil1;
        }
        if (self::$fetchedRow[$bean -> id]['movil2']!=$bean->movil2 && $bean->movil2!=""){
          $franquicia->movil_general_2= $bean->movil2;
        }
        if (self::$fetchedRow[$bean->id]['email_con_1'] != $bean->email_con_1 && $bean->email_con_1 != "") {
          $franquicia->correo_general = $bean->email_con_1;
        }
        if (self::$fetchedRow[$bean->id]['email_con_2'] != $bean->email_con_2 && $bean->email_con_2 != "") {
          $franquicia->correo_contacto_2 = $bean->email_con_2;
        }
        if (self::$fetchedRow[$bean->id]['observacion_con_1'] != $bean->observacion_con_1 && $bean->observacion_con_1 != "") {
          $franquicia->observacion_con_1 = $bean->observacion_con_1;
        }
        if (self::$fetchedRow[$bean->id]['observacion_con_2'] != $bean->observacion_con_2 && $bean->observacion_con_2 != "") {
          $franquicia->observacion_con_2 = $bean->observacion_con_2;
        }
        if (self::$fetchedRow[$bean->id]['direccion'] != $bean->direccion && $bean->direccion != "") {
          $franquicia->direccion_direccion = $bean->direccion;
        }
        if (self::$fetchedRow[$bean->id]['provincia'] != $bean->provincia && $bean->provincia != "") {
          $franquicia->direccion_provincia = $bean->provincia;
        }
        if (self::$fetchedRow[$bean->id]['ccaa'] != $bean->ccaa && $bean->ccaa != "") {
          $franquicia->ccaa = $bean->ccaa;
        }
        if (self::$fetchedRow[$bean->id]['pais'] != $bean->pais && $bean->pais != "") {
          $franquicia->pais = $bean->pais;
        }
        if (self::$fetchedRow[$bean->id]['codigo_postal'] != $bean->codigo_postal && $bean->codigo_postal != "") {
          $franquicia->direccion_codigo_postal = $bean->codigo_postal;
        }
        if (self::$fetchedRow[$bean->id]['web'] != $bean->web && $bean->web != "") {
          $franquicia->website = $bean->web;
        }
      }
      $franquicia->ignore_update_c = true;
      $franquicia->save();
    }

    public function BorrarEmpresa(&$bean, $event, $arguments)
    {

      $db = DBManagerFactory::getInstance();

      $query = "update expan_franquicia set deleted=1 where empresa_id='" . $bean->id . "'";

      $db->query($query);

    }

  }
