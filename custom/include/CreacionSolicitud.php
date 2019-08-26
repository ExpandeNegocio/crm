<?php

require_once('data/SugarBean.php');
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once('modules/Expan_Apertura/Expan_Apertura.php');
require_once('custom/include/CreacionGestionSolicitud.php');
require_once('include/utils/array_utils.php');


class AccionesGuardado
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

  function asignacionUsuario(&$bean, $event, $arguments)
  {

    global $current_user;

    //Comprobacion de bulce infinito
    if (!isset($bean->ignore_update_c) || $bean->ignore_update_c === false) {

      $bean->ignore_update_c = true;

      $this->limpiarTelefonos($bean);

      $this->crearEmpresa($bean);
      $this->PasoFranquiciado($bean);

      //Creacion de una nueva solicitud
      if (!isset(self::$fetchedRow[$bean->id])) {

        $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud]Asigno');

        $fechaHoy = new DateTime();
        $bean->fecha_primer_contacto = $fechaHoy->format('d/m/Y H:i');

        //Si no tiene franquicias hay que pasarselo al usuario de asesoramiento

        $pos = strrpos($bean->franquicias_secundarias, '380f0dc1-e38e-83e2-8c74-53df9ab90ac1');
        if ($pos === false && $bean->enviar_servicios_asesora == 1) {

          $valor = '380f0dc1-e38e-83e2-8c74-53df9ab90ac1';
          $this->crearGestion($valor, $bean);
        }

        //Comprobamos si estamos duplicndo la solicitud (Solo cuando se recoge desde una franquicia en
        //una feria o importando desde excel)

        if ($current_user->franquicia != null) {
          $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Entra en controlSolicitudRepetida');
          $this->controlSolicitudRepetidaFranquicia($bean);
        } else {
          if ($bean->from_import == 1) {
            $this->controlSolicitudRepetidaImport($bean);
          } else {
            $this->crearGestionDesdeGestionesSecundarias($bean);
          }

        }

      } else {

        // Entramos solo en edicion

        $bean->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
        $gestiones = $bean->expan_solicitud_expan_gestionsolicitudes_1->getBeans();

        $this->crearLLamadaAddTel($bean, $gestiones);

        //tenemos que ver si las gestiones estan creadas
        $this->buscarNuevasGestiones($bean);

        //controlamos si se pasa a rating posible topo

        if ($bean->rating == '5') {

          $db = DBManagerFactory::getInstance();

          $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT gs.expan_soli5dcccitudes_idb ";
          $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
          $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND s.id='" . $bean->id . "') s ";
          $query = $query . "on g.id= s.expan_soli5dcccitudes_idb ";
          $query = $query . "set estado_sol='" . Expan_GestionSolicitudes::ESTADO_DESCARTADO . "',motivo_descarte='" . Expan_GestionSolicitudes::DESCARTE_CANDIDATO_TOPO . "'; ";

          $db->query($query);
        }

        //Si modificamos el nombre de la solicitud cambiamos el de las gestiones asociadas
        //Control de campos mofificados
        $this->cambiosAHijos($bean);
        $this->cambiosEconomicosGestion($bean);
        $this->cambioLlamadas($bean);

        $bean = $this->limpiarSuborigen($bean);

        $this->activarMaster($bean);
        $this->actualizarResidencia($bean);
        $this->recogerEntPrevia($bean);
        $bean->assigned_user_id = $bean->created_by;
        $bean->ignore_update_c = true;
        $bean->save();
      }

      if ($bean->chk_entrevista_previa_EN == true || $bean->chk_entrevista_previa_cliente == true) {
        $bean->actualizarEntrevistaPrevia();
      }

      //Añadir los nuevos sectores de las franquicias contactadas y no contactadas
      $this->marcarSectores($bean->franquicias_contactadas, $bean->id); //Después del save(), porque si no no se guarda, se sobreecribe con lo anterior
      $this->marcarSectores($bean->otras_franquicias, $bean->id);

    }
  }

  function limpiarTelefonos(&$bean)
  {

    $bean->phone_mobile = str_replace(' ', '', $bean->phone_mobile);
    $bean->phone_work = str_replace(' ', '', $bean->phone_work);
    $bean->phone_home = str_replace(' ', '', $bean->phone_home);
    $bean->phone_other = str_replace(' ', '', $bean->phone_other);
  }

  function crearEmpresa($bean)
  {

    $empresas = $bean->franquicia_historicos . "," . $bean->empresa;

    $lstEmpresa = explode(",", $empresas);

    foreach ($lstEmpresa as $nomEmpresa) {

      if (trim($nomEmpresa) != "" &&
        !Expan_Empresa::existeEmpresaByName(trim($nomEmpresa))) {

        $empresa = new Expan_Empresa();

        if ($nomEmpresa == $bean->empresa) {
          $empresa->empresa_type = "oe";
        } else {
          $empresa->empresa_type = "fa";
        }

        $empresa->origen = "expande";
        $empresa->chk_es_cliente_potencial = $bean->chk_empresa_cli_potencial;
        $empresa->chk_es_proveedor = $bean->chk_empresa_provee;
        $empresa->chk_es_competidor = $bean->chk_empresa_competencia;
        $empresa->chk_alianza = $bean->chk_empresa_alianza;
        $empresa->name = $nomEmpresa;
        $empresa->contacto1 = $bean->first_name . " " . $bean->last_name;
        $empresa->telefono1 = $bean->phone_mobile;
        $empresa->email1 = $bean->email1;
        $empresa->email2 = $bean->email2;

        $empresa->ignore_update_c = true;
        $empresa->save();
      }
    }
  }

  function PasoFranquiciado($bean)
  {

    $franquicia_historicosAnt = self::$fetchedRow[$bean->id]['franquicia_historicos'];
    $franquicia_historicosrAct = $bean->franquicia_historicos;

    $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]Entra en paso a franquiciado');

    $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]$franquicia_historicosAnt-' . $franquicia_historicosAnt);
    $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]$franquicia_historicosrAct-' . $franquicia_historicosrAct);


    if ($franquicia_historicosAnt != $franquicia_historicosrAct && $franquicia_historicosrAct != "") {

      $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]Antes ver existe franquiciado');

      $franquiciadoId = Expan_Franquiciado::existeFranquiciado($bean->id);

      if ($franquiciadoId == false) {//se crea el franquiciado a partir de la solicitud, no existe
        $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]Antes creacion franquiciado');
        $franquiciado = Expan_Franquiciado::crearFranquiciado($bean, 2);
        $franquiciado->setAddress($bean);
      }else{
        $franquiciado= new Expan_Franquiciado();
        $franquiciado->retrieve($franquiciadoId);
      }

      $lista = explode(",", str_replace(";", ",", $franquicia_historicosrAct));

      foreach ($lista as $fran) {
        $GLOBALS['log']->info('[ExpandeNegocio][PasoFranquiciado]Franquicia-' . $fran);
        $fran = trim($fran);
        if ($fran != "") {
          if (!Expan_Apertura::existeApertura($bean->first_name . " " . $bean->last_name . " - " . $fran) &&
            Expan_Apertura::franquiciaNoApertura($bean->name) == false) {
            Expan_Apertura::crearAperturaOtraFran($fran, $franquiciado, $bean);
          }
        }
      }
    }
  }

  function crearGestion($idFranq, &$bean)
  {

    $franq = BeanFactory::getBean("Expan_Franquicia", $idFranq);

    $crearLLamadaFS = false;

    //Comprobamos que la franquicia esta dentro del flujo (tipo )

    if ($franq->tipo_cuenta == Expan_Franquicia::TIPO_FRAN_CONSULTORIA ||
      $franq->tipo_cuenta == Expan_Franquicia::TIPO_FRAN_INTERMEDIA ||
      $franq->tipo_cuenta == Expan_Franquicia::TIPO_FRAN_SERV_DIV ||
      $franq->tipo_cuenta == Expan_Franquicia::TIPO_FRAN_ENTRADA_INMINENTE) {

      //Controlamos el tipo de solicitud para pasarsela a un usuario diferente
      if ($bean->candidatura_caliente == true ||
        strpos($bean->tipo_origen, Expan_Solicitud::TIPO_ORIGEN_CENTRAL) !== false ||
        $bean->rating == 1 ||
        $bean->rating == 2 ||
        (strpos($bean->tipo_origen, Expan_Solicitud::TIPO_ORIGEN_EVENTOS) !== false &&
          $bean->assigned_user_id == $franq->assigned_user_id)
      ) {
        //Director de Cuenta
        $usuario_asg = $franq->assigned_user_id;
      } else {
        //Fltro o Ejecutivo Cuenta
        if ($franq->user_id1_c != '') {
          $usuario_asg = $franq->user_id1_c;
        } else {
          global $current_user;
          $usuario_asg = $current_user->id;
        }

      }

      //Creamos una nueva gestión de solicitud

      $gestion = new Expan_GestionSolicitudes();

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Crear Gestion - ' . TimeDate::getInstance()->nowDb());
      //  $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Solicitud] Crear Gestion - '.$gestion->date_modified);

      $gestion->date_entered = TimeDate::getInstance()->getNow()->asDb();

      $gestion->name = $bean->first_name . ' ' . $bean->last_name . ' - ' . $GLOBALS['app_list_strings']['franquicia_list'][$idFranq];
      $gestion->assigned_user_id = $usuario_asg;
      $gestion->franquicia = $franq->id;
      $gestion->cuando_empezar = $bean->cuando_empezar;
      $gestion->recursos_propios = $bean->recursos_propios;
      $gestion->inversion = $bean->capital;
      $gestion->papel = $bean->perfil_franquicia;
      $gestion->rating = $bean->rating;
      $gestion->perfil_ideoneo = null;

      //Calculamos el origen y suborigen de la gestion
      $origenAnt = self::$fetchedRow[$bean->id]['tipo_origen'];
      $gestion->setOrigenSuborigenFromSolicitud($bean, $origenAnt);

      //Si es un topo
      if ($bean->rating == '5') {

        $gestion->estado_sol = Expan_GestionSolicitudes::ESTADO_DESCARTADO;
        $gestion->motivo_descarte = Expan_GestionSolicitudes::DESCARTE_CANDIDATO_TOPO;
      }

      //Si viene de un evento y la franquicia no paga se la pasamos a ExpandeNegocio

      $isOrigenExpande = $gestion->pasoaOrigenExpandeFeria();
      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud]Paso Feria-' . $isOrigenExpande);
      if ($isOrigenExpande == true) {
        $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Entra a paso Expande');
        $gestion->tipo_origen = Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO;
        $gestion->evento_bk = $gestion->expan_evento_id_c;
        $gestion->subor_expande = Expan_GestionSolicitudes::TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO;
        $gestion->expan_evento_id_c = null;
      }

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Franquicia asignada - ' . $gestion->franquicia);
      $gestion->save();

      //Actualizamos la fecha de creacion
      $query = "UPDATE expan_gestionsolicitudes SET date_entered = UTC_TIMESTAMP() WHERE id = '" . $gestion->id . "'";
      $db = DBManagerFactory::getInstance();
      $result = $db->query($query);

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] despues de guardar');

      //Se la asignamos a la solicitud
      $bean->ignore_update_c = true;

      $bean->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
      $bean->expan_solicitud_expan_gestionsolicitudes_1->add($gestion->id);

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud]Franquicias secundarias Antes-' . $bean->franquicias_secundarias);

      //Añadimos la franquicia secundaria
      if (strrpos($bean->franquicias_secundarias, "^" . $idFranq . "^") === false) {

        if (strlen($bean->franquicias_secundaria) == 0) {
          $bean->franquicias_secundarias = $bean->franquicias_secundarias . ",^" . $idFranq . "^";
        } else {
          $bean->franquicias_secundarias = "^" . $idFranq . "^";
        }

        $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud]Franquicias secundarias-' . $bean->franquicias_secundarias);
      }

      $bean->save();

      if ($bean->rating != 5) {//no es topo, miramos si esta el check de la franquicia para pasar automaticamente a estado 2
        if ($franq->chk_c1 == 1) {//se puede pasar a estado 2
          $gestion->estado_sol = Expan_GestionSolicitudes::ESTADO_EN_CURSO;
          $gestion->ignore_update_c = false;
          $gestion->save();
        }
      }

      $prioridad = $gestion->calcularPrioridades();
      $gestion->prioridad = $prioridad;
      //$bean->prioridad=$prioridad;

      if ($crearLLamadaFS == true) {
        $telefono = $bean->recogerTelefono();
        $gestion->creaLlamada('[AUT]Confirmacion Asistencia', 'ConfAsis', 0);
      }
    }
  }

  function controlSolicitudRepetidaFranquicia($solicitud)
  {
    $idSol = $this->ControlIdsol($solicitud);

    // Si hemos encontrado que la solicitud ya existe debemos comprobar si ya existe la gestion o no
    if ($idSol != '') {

      global $current_user;

      $solAnt = new Expan_Solicitud();
      $solAnt->retrieve($idSol);
      $gestion = $solAnt->getGestionFromFranID($current_user->franquicia);

      if ($gestion == null) {
        if ($current_user->franquicia == null) {
          $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud][SolicitudRepetida] Crea gestion nueva para olicitud ya existente');
          $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud][SolicitudRepetida] SolAnt-' . $solAnt->id);
          $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud][SolicitudRepetida] SolNueva-' . $solicitud->id);
          $this->crearGestion($current_user->franquicia, $solAnt);
        } else {
          $this->buscarNuevasGestiones($solicitud);
        }
      } else {
        $gestion->chk_envio_documentacion = false;
        $gestion->estado_sol = Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO;
        $gestion->envio_documentacion = null;
        $gestion->ignore_update_c = true;
        $gestion->save();
      }

      $solAnt->expan_evento_id_c = $solicitud->expan_evento_id_c;

      //tenemos que recoger los valores que esten vacíos antes y recoger el nuevo valor
      if (1 == 1) {

      }
      $solAnt->perfil_profesional = $solicitud->perfil_profesional;
      $solAnt->assigned_user_id = $solAnt->created_by;
      $solAnt->ignore_update_c = true;
      $solAnt->save();

      $solicitud->removeSol();
    }
  }

  public function ControlIdsol($solicitud)
  {
    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Entra en ControlIdsol');

    $listaTel = $solicitud->getListaTelefono();
    $listaCorr = $solicitud->getCorreos();

    $idSol = $this->getRepeatedbyPhone($solicitud, $listaTel);
    if ($idSol == '') {
      $idSol = $this->getRepeatedbyEmail($solicitud, $listaCorr);
    }
    return $idSol;
  }

  function getRepeatedbyPhone($solicitud, $phoneList)
  {
    $idSol = '';
    $db = DBManagerFactory::getInstance();

    foreach ($phoneList as $telefono) {

      $telefono = str_replace(" ", "", $telefono);

      $sql = "SELECT id ";
      $sql = $sql . "FROM   expan_solicitud ";
      $sql = $sql . "WHERE  (phone_home = '" . $telefono . "' OR phone_mobile = '" . $telefono . "' OR phone_home = '" . $telefono . "') AND ";
      $sql = $sql . "deleted=0 AND id <>'" . $solicitud->id . "'";

      $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]Validadndo Telefono - Consulta - ' . $solicitud->id);

      $resultSol = $db->query($sql, true);
      while ($rowSol = $db->fetchByAssoc($resultSol)) {

        $idSol = $rowSol["id"];
        $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El telefono existe');
        return $idSol;
      }

    }

    return $idSol;

  }

  function getRepeatedbyEmail($solicitud, $emailList)
  {

    $idSol = '';
    $db = DBManagerFactory::getInstance();

    foreach ($emailList as $email) {

      $sql = "SELECT s.id,e.email_address,s.first_name,s.last_name ";
      $sql = $sql . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
      $sql = $sql . "WHERE s.id = r.bean_id AND s.deleted=0 AND e.id = r.email_address_id AND e.deleted=0 AND r.deleted=0 AND ";
      $sql = $sql . "e.email_address='" . $email . "' AND s.id <>'" . $solicitud->id . " and deleted=0'";

      $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]getRepeatedbyEmail - Consulta - ' . $sql);

      $resultSol = $db->query($sql, true);
      while ($rowSol = $db->fetchByAssoc($resultSol)) {
        $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El correo existe');
        $idSol = $rowSol["id"];
        return $idSol;
      }
    }
    return $idSol;
  }

  function buscarNuevasGestiones($bean)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Entro en buscarNuevasGestiones');

    $db = DBManagerFactory::getInstance();
    $textoFran = str_replace('^', "'", $bean->franquicias_secundarias);

    $query = "select * ";
    $query = $query . "from  (select * from expan_franquicia where id in (" . $textoFran . ")) f where id not in( ";
    $query = $query . "select g.franquicia from expan_gestionsolicitudes g ,expan_solicitud s ,expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "where g.id = gs.expan_soli5dcccitudes_idb AND ";
    $query = $query . "s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.deleted=0 AND ";
    $query = $query . "s.id = '" . $bean->id . "' )";

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud]Consulta -' . $query);

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Creo nueva gestion desde act -' . $row["id"]);
      $this->crearGestion($row["id"], $bean);
    }
  }

  function controlSolicitudRepetidaImport($solicitud)
  {

    $idSol = $this->ControlIdsol($solicitud);
    ($solicitud);
    $this->buscarNuevasGestiones($solicitud);

    // Si hemos encontrado que la solicitud ya existe debemos comprobar si ya existe la gestion o no
    if ($idSol != '') {

      $solAnt = new Expan_Solicitud();
      $solAnt->retrieve($idSol);

      $db = DBManagerFactory::getInstance();

      $query = "UPDATE ";
      $query = $query . " expan_solicitud_expan_gestionsolicitudes_1_c ";
      $query = $query . "SET ";
      $query = $query . " expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = '" . $solAnt->id . "' ";
      $query = $query . "WHERE ";
      $query = $query . " expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ='" . $solicitud->id . "' AND ";
      $query = $query . " concat(expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida,expan_soli5dcccitudes_idb) NOT IN ";
      $query = $query . "   (SELECT ";
      $query = $query . "     concat(expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida,expan_soli5dcccitudes_idb) ";
      $query = $query . "    FROM (SELECT * FROM expan_solicitud_expan_gestionsolicitudes_1_c) a ";
      $query = $query . "    WHERE expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida = ";
      $query = $query . "     '" . $solAnt->id . "'); ";

      $result = $db->query($query);

      $solAnt->franquicias_secundarias = $this->getFranSec($solAnt);

      $solAnt->assigned_user_id = $solAnt->created_by;

      $solAnt->ignore_update_c = true;
      $solAnt->save();

      $solicitud->deleted = 1;
      $solicitud->ignore_update_c = true;
      $solicitud->save();
    }
  }

  function getFranSec($solicitud)
  {
    $db = DBManagerFactory::getInstance();

    $query = "select franquicia from expan_gestionsolicitudes g , expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "where gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida='" . $solicitud->id . "' and g.deleted=0 and gs.deleted=0 ";

    $resultSol = $db->query($query, true);

    $listaFran = array();

    while ($rowSol = $db->fetchByAssoc($resultSol)) {
      $GLOBALS['log']->info('[ExpandeNegocio][ControlSolicitudes]El correo existe');
      $listaFran[] = $rowSol["franquicia"];
    }

    return encodeMultienumValue($listaFran);
  }

  function crearGestionDesdeGestionesSecundarias($bean)
  {

    $caracteres = explode(',', $bean->franquicias_secundarias);
    $bean->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

    $fran = null;
    $numFran = 0;

    foreach ($caracteres as $valor) {

      $valor = str_replace('^', '', $valor);

      if ($valor != '') {
        $this->crearGestion($valor, $bean);
        $fran = $valor;
        $numFran++;
      }
    }
  }

  function crearLLamadaAddTel($bean, $gestiones)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] crearLLamadaAddTel - Entra');
    $movAnt = self::$fetchedRow[$bean->id]['phone_mobile'];
    $movAct = $bean->phone_mobile;

    $mov2Ant = self::$fetchedRow[$bean->id]['phone_home'];
    $mov2Act = $bean->phone_home;

    $telOfAnt = self::$fetchedRow[$bean->id]['phone_work'];
    $telOfAct = $bean->phone_work;

    $telOtherAnt = self::$fetchedRow[$bean->id]['phone_other'];
    $telOtherAct = $bean->phone_other;

    if ($movAnt == "" && $mov2Ant == "" && $telOfAnt == "" && $telOtherAnt == "" &&
      ($movAnt != $movAct || $mov2Ant != $mov2Act ||
        $telOfAnt != $telOfAct || $telOtherAnt != $telOtherAct)) {

      $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] crearLLamadaAddTel - Dbe crear LLamadas');
      foreach ($gestiones as $gestion) {
        if ($gestion->estado_sol == 2) {
          $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] crearLLamadaAddTel - Dbe crear LLamadas # Gestion-' . $gestion->id);

          $gestion->creaLlamada('[AUT]Primera', 'Primera', 0);
        }
      }
    }
  }

  function cambiosAHijos($bean)
  {
    $nombreAnt = self::$fetchedRow[$bean->id]['first_name'];
    $nombreAct = $bean->first_name;

    $apellidoAnt = self::$fetchedRow[$bean->id]['last_name'];
    $apellidoAct = $bean->last_name;

    $movilAnt = self::$fetchedRow[$bean->id]['phone_mobile'];
    $movilAct = $bean->phone_mobile;

    $db = DBManagerFactory::getInstance();

    if ($nombreAnt != $nombreAct || $apellidoAnt != $apellidoAct) {

      //Cambiamos el nombre de las gestiones

      $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT gs.expan_soli5dcccitudes_idb , f.name fran ,s.first_name,s.last_name ";
      $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g, expan_franquicia f ";
      $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
      $query = $query . "  g.id= gs.expan_soli5dcccitudes_idb AND ";
      $query = $query . "  g.franquicia = f.id AND ";
      $query = $query . "  s.id='" . $bean->id . "') s  ";
      $query = $query . "on g.id= s.expan_soli5dcccitudes_idb  ";
      $query = $query . "set name=CONCAT(COALESCE(first_name,''),' ',COALESCE(last_name,''),' - ',COALESCE(fran,'')) ";

      $db->query($query);

      //Cambiamos el nombre de las llamadas

      $query = "UPDATE calls c JOIN (SELECT g.id, s.phone_mobile ";
      $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
      $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
      $query = $query . "  g.id= gs.expan_soli5dcccitudes_idb AND ";
      $query = $query . "  s.id='" . $bean->id . "') m  ";
      $query = $query . "on c.parent_id= m.id ";
      $query = $query . "set name=replace(name,'" . $nombreAnt . " " . $apellidoAnt . "','" . $nombreAct . " " . $apellidoAct . "')";

      $db->query($query);

      //Cambiamos el nombre de las tareas

      $query = "UPDATE tasks t JOIN (SELECT g.id, s.phone_mobile ";
      $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
      $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
      $query = $query . "  g.id= gs.expan_soli5dcccitudes_idb AND ";
      $query = $query . "  s.id='" . $bean->id . "') m  ";
      $query = $query . "on t.parent_id= m.id ";
      $query = $query . "set name=replace(name,'" . $nombreAnt . " " . $apellidoAnt . "','" . $nombreAct . " " . $apellidoAct . "')";

      $db->query($query);

    }

    if ($movilAnt != $movilAct) {

      $query = "UPDATE calls c JOIN (SELECT g.id, s.phone_mobile ";
      $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
      $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
      $query = $query . "  g.id= gs.expan_soli5dcccitudes_idb AND ";
      $query = $query . "  s.id='" . $bean->id . "') m  ";
      $query = $query . "on c.id= m.id ";
      $query = $query . "set telefono=m.phone_mobile; ";

      $db->query($query);
    }

  }

  function cambiosEconomicosGestion($bean)
  {

    $cuando_empezarAnt = self::$fetchedRow[$bean->id]['cuando_empezar'];
    $cuando_empezarAct = $bean->cuando_empezar;

    $perfil_franquiciaAnt = self::$fetchedRow[$bean->id]['perfil_franquicia'];
    $perfil_franquiciaAct = $bean->perfil_franquicia;

    $capitalAnt = self::$fetchedRow[$bean->id]['capital'];
    $capitalAct = $bean->capital;

    $recursos_propiosAnt = self::$fetchedRow[$bean->id]['recursos_propios'];
    $recursos_propiosAct = $bean->recursos_propios;

    $db = DBManagerFactory::getInstance();

    $cuerpoQuery = "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
    $cuerpoQuery = $cuerpoQuery . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND   ";
    $cuerpoQuery = $cuerpoQuery . "  g.id= gs.expan_soli5dcccitudes_idb AND   ";
    $cuerpoQuery = $cuerpoQuery . "  s.id='" . $bean->id . "') s   ";
    $cuerpoQuery = $cuerpoQuery . "on g.id= s.expan_soli5dcccitudes_idb ";

    if ($cuando_empezarAnt != $cuando_empezarAct) {
      $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT s.cuando_empezar,expan_soli5dcccitudes_idb ";
      $query = $query . $cuerpoQuery;
      $query = $query . "set g.cuando_empezar=s.cuando_empezar WHERE (g.cuando_empezar='' or g.cuando_empezar is null);";

      $db->query($query);
    }

    if ($perfil_franquiciaAnt != $perfil_franquiciaAct) {
      $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT perfil_franquicia,expan_soli5dcccitudes_idb ";
      $query = $query . $cuerpoQuery;
      $query = $query . "set papel=s.perfil_franquicia WHERE (papel='' or papel is null);";

      $db->query($query);
    }

    if ($capitalAnt != $capitalAct) {
      $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT capital,expan_soli5dcccitudes_idb ";
      $query = $query . $cuerpoQuery;
      $query = $query . "set inversion=s.capital WHERE (inversion='' or inversion is null);";

      $db->query($query);
    }

    if ($recursos_propiosAnt != $recursos_propiosAct) {
      $query = "UPDATE expan_gestionsolicitudes g JOIN (SELECT s.recursos_propios,expan_soli5dcccitudes_idb ";
      $query = $query . $cuerpoQuery;
      $query = $query . "set g.recursos_propios=s.recursos_propios WHERE (g.recursos_propios='' or g.recursos_propios is null);";

      $db->query($query);
    }
  }

  function cambioLlamadas($solicitud)
  {
    $dispContactoAnt = self::$fetchedRow[$solicitud->id]['disp_contacto'];
    $dispContactoAct = $solicitud->disp_contacto;

    if ($dispContactoAct != $dispContactoAnt) {

      $db = DBManagerFactory::getInstance();

      //Cambiamos la disponibilidad de las llamadas

      $query = "UPDATE calls c JOIN (SELECT g.id, s.phone_mobile ";
      $query = $query . "  FROM   expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_gestionsolicitudes g ";
      $query = $query . "  WHERE  s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
      $query = $query . "  g.id= gs.expan_soli5dcccitudes_idb AND ";
      $query = $query . "  s.id='" . $solicitud->id . "') m  ";
      $query = $query . "on c.parent_id= m.id ";
      $query = $query . "set disp_contacto='" . $dispContactoAct . "'";

      $GLOBALS['log']->info('[ExpandeNegocio][cambioLlamadas]Consulta-' . $query);

      $db->query($query);

    }
  }

  function limpiarSuborigen(&$bean)
  {

    $origenAnt = self::$fetchedRow[$bean->id]['tipo_origen'];
    $origenAnt = str_replace('^', '', $origenAnt);

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Origen Inicial - ' . self::$fetchedRow[$bean->id]['tipo_origen']);
    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Origen Ant - ' . $origenAnt);

    $listaAnt = explode(',', $origenAnt);

    $origenAct = str_replace('^', '', $bean->tipo_origen);
    $listaAct = explode(',', $origenAct);

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Origen Act - ' . $origenAct);

    $listaDif = array_diff($listaAnt, $listaAct);

    $origen = -1;

    foreach ($listaDif as $ori) {

      switch ($ori) {
        case Expan_Solicitud::TIPO_ORIGEN_EXPANDENEGOCIO:
          $bean->subor_expande = '';
          break;
        case Expan_Solicitud::TIPO_ORIGEN_PORTALES:
          $bean->portal = '';
          break;
        case Expan_Solicitud::TIPO_ORIGEN_EVENTOS:
          $bean->expan_evento_id_c = '';
          break;
        case Expan_Solicitud::TIPO_ORIGEN_CENTRAL:
          $bean->subor_central = '';
          break;
        case Expan_Solicitud::TIPO_ORIGEN_MEDIOS_COMUN:
          $bean->subor_medios = '';
          break;
        case Expan_Solicitud::TIPO_ORIGEN_MAILING:
          $bean->subor_mailing = '';
          break;
        default:

          break;
      }

    }
    return $bean;

  }

  function activarMaster(&$bean)
  {
    // cambiar check de master
    if ($bean->pais_c != "SPAIN") {
      $bean->master = true;
    } else {//es de spain por tanto no nos interesan estos campos
      $bean->localidad_residencia = '';
    }
  }

  function actualizarResidencia(&$bean)
  {

    if (trim($bean->pais_residencia) == "") {
      $bean->pais_residencia = $bean->pais_c;
    }

    if ($bean->pais_residencia != "SPAIN") {
      $bean->provincia_residencia = 100;
    } else {
      if (trim($bean->provincia_residencia) == "" || $bean->provincia_residencia==null) {
        $bean->provincia_residencia = $bean->provincia_apertura_1;
      }
    }
  }

  function recogerEntPrevia(&$bean)
  {

    global $current_user;

    if ($bean->chk_entrevista_previa_EN == 1 && $bean->usuario_entrevista_previa_EN == "") {
      $bean->usuario_entrevista_previa_EN = $current_user->first_name . " " . $current_user->last_name;
    }

    if ($bean->chk_entrevista_previa_cliente == 1 && $bean->usuario_entrevista_previa_cliente == "") {
      $bean->usuario_entrevista_previa_cliente = $current_user->first_name . " " . $current_user->last_name;
    }

  }

  /**
   * Actualiza los sectores de interés de una solicitud con los sectores a los que
   * perteneces cada una de las franquicias que se le pasa cómo argumento.
   */
  function marcarSectores($franquicias, $idSol)
  {

    $franC = explode(",", $franquicias);//obtiene el array,del string separado por comas

    $db = DBManagerFactory::getInstance();

    for ($i = 0; $i < count($franC); $i++) {//Recorrer todas las franquicias del array para actualizar los sectores de interes

      $numSec = "";

      //el valor (número) del sector de esta franquicia
      $query = "select substring(sector, 2, LENGTH(sector)-2) as s";
      $query = $query . " FROM expan_franquicia where name='" . $franC[$i] . "' and deleted=0;";
      $result = $db->query($query);
      while ($row = $db->fetchByAssoc($result)) {
        $numSec = $row["s"]; //sector
      }

      //sectores de interás de la solicitud
      $query = "select sectores_de_interes as s from expan_solicitud where id='" . $idSol . "'";
      $result = $db->query($query);
      $sect = "";
      while ($row = $db->fetchByAssoc($result)) {
        $sect = $row["s"]; //sectores de interés
      }

      if (strpos($sect, $numSec) === false) {//si no está ese sector ya en los sectores de interés, se añade

        $query = "UPDATE expan_solicitud INNER JOIN";
        $query = $query . " (select c_id FROM expan_m_sectores sec";
        $query = $query . " INNER JOIN (select substring(sector, 2, LENGTH(sector)-2) as s";
        $query = $query . " FROM expan_franquicia where name='" . $franC[$i] . "' and deleted=0) t";
        $query = $query . " ON sec.c_id=t.s) a";
        $query = $query . " SET sectores_de_interes = (CASE WHEN (sectores_de_interes='0' OR sectores_de_interes IS NULL)";
        $query = $query . " THEN CONCAT('^', CONCAT(a.c_id,'^'))";
        $query = $query . " ELSE CONCAT(sectores_de_interes, CONCAT(',^', CONCAT(a.c_id, '^')))";
        $query = $query . " END) WHERE id='" . $idSol . "' AND deleted=0;";
        $db->query($query); //ejecutar la consulta de actualización de los sectores

      }
    }
  }
}

?>