<?PHP
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes_sugar.php');
require_once('custom/include/EnvioAutoCorreos.php');

class Expan_GestionSolicitudes extends Expan_GestionSolicitudes_sugar
{

  const ESTADO_PRECANDIDATO = '0';
  const ESTADO_NO_ATENDIDO = '1';
  const ESTADO_EN_CURSO = '2';
  const ESTADO_PARADO = '3';
  const ESTADO_DESCARTADO = '4';
  const ESTADO_POSITIVO = '5';

  const TIPO_SUBORIGEN_EXPANDENEGOCIOEVENTO = '7';

  const TIPO_ORIGEN_CENTRAL = '4';
  const TIPO_ORIGEN_EXPANDENEGOCIO = '1';
  const TIPO_ORIGEN_EVENTOS = '3';
  const TIPO_ORIGEN_PORTALES = '2';
  const TIPO_ORIGEN_MAILING = '6';
  const TIPO_ORIGEN_MEDIOS_COMUN = '5';

  const TIPO_SUBORIGEN_CENTRAL_BB_ANT = '8';
  const TIPO_SUBORIGEN_EXPANDE_BB_ANT = '10';

  const PARADA_POR_PROTOCOLO = '1';

  const PARADA_ZONA_NO_INTERES = '51';
  const PARADA_ENESPERA = '52';
  const PARADA_NO_LOCALIZADO = '53';
  const PARADA_DATOS_ERRORNEOS = '54';
  const PARADA_HASTA_NUEVO_CONTACTO = '57';

  const PARADA_CANDIDATO_PERSONAL = '11';
  const PARADA_CANDIDATO_NEGOCIO = '12';
  const PARADA_CANDIDATO_FINANCIACION = '13';
  const PARADA_CANDIDATO_LOCAL = '14';

  const DESCARTE_CANDIDATO_TOPO = '5';
  const DESCARTE_PERSONAL = '14';
  const DESCARTE_FRANQUICIA_MISMO_SECTOR = '26';
  const DESCARTE_FRANQUICIA_OTRO_SECTOR = '27';
  const DESCARTE_FRANQUICIA_CAIDA_COLABORA = '29';
  const DESCARTE_OTROS = '99';

  const POSITIVO_PRECONTRATO = 'Pre';
  const POSITIVO_CONTRATO = 'Cont';
  const POSITIVO_COLABORACION = 'Col';
  const POSITIVO_CAI_CONTRATO = 'CaiCon';

  const SUBESTADO_ = '';
  const SUBESTADO_CENTRAL = 'Visita Central';
  const SUBESTADO_ENVIO_CONTRATO = 'Envio Contrato';
  const SUBESTADO_VISITA_LOCAL = 'Informacion local';
  const SUBESTADO_PRECONTRATO = 'Precontrato';
  const SUBESTADO_VISITA_FRANQ = 'Visita franquiciado';
  const SUBESTADO_ENTREVISTA = 'Entrevista';
  const SUBESTADO_INFOR_ADICIO = 'Informacion Adicional';
  const SUBESTADO_CUESTIONARIO = 'Cuestionario';
  const SUBESTADO_PRI_DUDAS = 'Primeras Dudas';
  const SUBESTADO_SOL_AMP = 'Solicitud info';
  const SUBESTADO_RESPON_C1 = 'Responde C1';
  const SUBESTADO_ENVIO_DOC = 'Envio Doc';


  function Expan_GestionSolicitudes()
  {
    parent::Expan_GestionSolicitudes_sugar();
  }

  function archivarLLamadas()
  {

    //archivamos todas las llamadas de una gestion
    $db = DBManagerFactory::getInstance();

    $query = " update calls c JOIN (SELECT c.id ";
    $query = $query . " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs ";
    $query = $query . " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '" . $this->id . "' ";
    $query = $query . " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Planned' and g.deleted=0) t ";
    $query = $query . " ON c.id = t.id set c.status='Archived'; ";

    $result = $db->query($query);

  }

  function archivarTareas()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update tasks t join (select t.id FROM tasks t, expan_gestionsolicitudes g, expan_gestionsolicitudes_tasks_1_c gt where ";
    $query = $query . " t.id=gt.expan_gestionsolicitudes_tasks_1tasks_idb and ";
    $query = $query . " gt.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida=g.id and g.id='" . $this->id . "' and ";
    $query = $query . " (t.status  in ('Not Started','Pending Input','In Progress','Paused')) and t.deleted=0) b on t.id=b.id set t.status='Deferred';";

    $result = $db->query($query);

  }

  function archivarReuniones()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update meetings m join (select m.id from expan_gestionsolicitudes g, expan_gestionsolicitudes_meetings_1_c gm, meetings m ";
    $query = $query . " where g.id=gm.expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida and ";
    $query = $query . " gm.expan_gestionsolicitudes_meetings_1meetings_idb=m.id and g.id='" . $this->id . "' and ";
    $query = $query . " (m.status='Planned' or m.status='Could') and m.deleted = 0 ";
    $query = $query . " ) b on m.id=b.id set m.status='Archived';";

    $result = $db->query($query);

  }

  function pausarLLamadas()
  {

    //archivamos todas las llamadas de una gestion
    $db = DBManagerFactory::getInstance();

    $query = " update calls c JOIN (SELECT c.id ";
    $query = $query . " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs ";
    $query = $query . " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '" . $this->id . "' ";
    $query = $query . " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Planned' and g.deleted=0) t ";
    $query = $query . " ON c.id = t.id set c.status='Paused'; ";

    $result = $db->query($query);

  }

  function pausarTareas()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update tasks t join (select t.id FROM tasks t, expan_gestionsolicitudes g, expan_gestionsolicitudes_tasks_1_c gt where ";
    $query = $query . " t.id=gt.expan_gestionsolicitudes_tasks_1tasks_idb and ";
    $query = $query . " gt.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida=g.id and g.id='" . $this->id . "' and ";
    $query = $query . " (t.status='Not Started') and t.deleted=0) b on t.id=b.id set t.status='Paused';";

    $result = $db->query($query);

  }

  function pausarReuniones()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update meetings m join (select m.id from expan_gestionsolicitudes g, expan_gestionsolicitudes_meetings_1_c gm, meetings m ";
    $query = $query . " where g.id=gm.expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida and ";
    $query = $query . " gm.expan_gestionsolicitudes_meetings_1meetings_idb=m.id and g.id='" . $this->id . "' and ";
    $query = $query . " (m.status='Not Started' or m.status='Could') and m.deleted = 0 ";
    $query = $query . " ) b on m.id=b.id set m.status='Paused';";

    $result = $db->query($query);

  }

  function restartLLamadas()
  {

    //archivamos todas las llamadas de una gestion
    $db = DBManagerFactory::getInstance();

    $query = " update calls c JOIN (SELECT c.id ";
    $query = $query . " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs ";
    $query = $query . " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '" . $this->id . "' ";
    $query = $query . " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Paused' and g.deleted=0) t ";
    $query = $query . " ON c.id = t.id set c.status='Planned'; ";

    $result = $db->query($query);

  }

  function restartTareas()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update tasks t join (select t.id FROM tasks t, expan_gestionsolicitudes g, expan_gestionsolicitudes_tasks_1_c gt where ";
    $query = $query . " t.id=gt.expan_gestionsolicitudes_tasks_1tasks_idb and ";
    $query = $query . " gt.expan_gestionsolicitudes_tasks_1expan_gestionsolicitudes_ida=g.id and g.id='" . $this->id . "' and ";
    $query = $query . " (t.status='Paused') and t.deleted=0) b on t.id=b.id set t.status='Not Started';";

    $result = $db->query($query);

  }

  function restartReuniones()
  {

    $db = DBManagerFactory::getInstance();

    $query = "update meetings m join (select m.id from expan_gestionsolicitudes g, expan_gestionsolicitudes_meetings_1_c gm, meetings m ";
    $query = $query . " where g.id=gm.expan_gestionsolicitudes_meetings_1expan_gestionsolicitudes_ida and ";
    $query = $query . " gm.expan_gestionsolicitudes_meetings_1meetings_idb=m.id and g.id='" . $this->id . "' and ";
    $query = $query . " m.status='Paused' and m.deleted = 0 ";
    $query = $query . " ) b on m.id=b.id set m.status='Not Started';";

    $result = $db->query($query);

  }

  function eliminarLLamadas($status)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][Eliminar LLamadas] Entra 1');

    $this->load_relationship('expan_gestionsolicitudes_calls_1');

    $GLOBALS['log']->info('[ExpandeNegocio][Eliminar LLamadas] Entra 2');

    foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {

      $GLOBALS['log']->info('[ExpandeNegocio][Eliminar LLamadas] LLamada -' . $llamada->id);
      if ($llamada->status == $status) {
        $llamada->deleted = 1;
        $llamada->save();
      }
    }

  }

  function eliminarTodasLLamadas()
  {
    $GLOBALS['log']->info('[ExpandeNegocio][Eliminar Todas LLamadas] Gestion-' . $this->id);

    $this->load_relationship('expan_gestionsolicitudes_calls_1');

    foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {
      $llamada->deleted = 1;
      $llamada->save();
    }
  }

  function eliminarTodasTareas()
  {
    $GLOBALS['log']->info('[ExpandeNegocio][Eliminar Todas LLamadas] Gestion-' . $this->id);

    $this->load_relationship('expan_gestionsolicitudes_tasks_1');

    foreach ($this->expan_gestionsolicitudes_tasks_1->getBeans() as $tareas) {
      $tareas->deleted = 1;
      $tareas->save();
    }
  }

  function tieneLlamadasPendientes()
  {

    $llamadasAbiertas = false;

    $db = DBManagerFactory::getInstance();
    $query = "select * from calls where status='Planned' AND deleted=0 AND parent_id='" . $this->id . "'";
    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $llamadasAbiertas = true;
    }

    return $llamadasAbiertas;
  }

  function tieneTareasPendientes()
  {

    $tareasAbiertas = false;

    $db = DBManagerFactory::getInstance();
    $query = "select * from tasks where status='Planned' AND parent_id='" . $this->id . "'";
    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $tareasAbiertas = true;
    }

    return $tareasAbiertas;
  }

  function tieneLlamadasRealizadas()
  {

    $llamadasAbiertas = false;

    $db = DBManagerFactory::getInstance();
    $query = "select * from calls where status='Held' AND deleted=0 AND parent_id='" . $this->id . "'";
    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $llamadasAbiertas = true;
    }

    return $llamadasAbiertas;
  }

  //Elimina todas las llamadas de la gestión con determinado status

  function tieneReunionesRealizadas()
  {

    $reunionesRealizadas = false;

    $db = DBManagerFactory::getInstance();
    $query = "select * from meetings where status='Held' AND deleted=0 AND parent_id='" . $this->id . "'";
    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][TieneLlamadasPendientes]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $reunionesRealizadas = true;
    }

    return $reunionesRealizadas;
  }

  function asignarGestor()
  {

    //asignamos el usuario Gestor a la gestion y a todo lo que cuelga
    $Fran = $this->GetFranquicia();
    $this->assigned_user_id = $Fran->assigned_user_id;
    $this->asignarAccionesUsuario($Fran->assigned_user_id);
  }

  function GetFranquicia()
  {

    $franquicia = null;
    if ($this->franquicia != null) {
      $franquicia = new Expan_Franquicia();
      $franquicia->retrieve($this->franquicia);
    }
    return $franquicia;
  }

  function asignarAccionesUsuario($user)
  {
    $this->asociarLLamadas("Planned", $user);
    $this->asociarTareas("Not Started", $user);
    $this->asociarReuniones("Planned", $user);
    $this->asociarReuniones("Could", $user);
  }

  function asociarLLamadas($status, $user)
  {

    $this->load_relationship('expan_gestionsolicitudes_calls_1');

    foreach ($this->expan_gestionsolicitudes_calls_1->getBeans() as $llamada) {

      $GLOBALS['log']->info('[ExpandeNegocio][Asociar LLamadas] LLamada -' . $llamada->id);
      if ($llamada->status == $status) {
        $llamada->assigned_user_id = $user;
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar LLamadas] Usuario-' . $user);
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar LLamadas] Antes de guardar');
        $llamada->ignore_update_c = true;
        $llamada->save();
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar LLamadas] Despues de guardar');
      }
    }

  }

  function asociarTareas($status, $user)
  {
    //  echo "Entra Asociar Tareas" ."<br>";

    $this->load_relationship('expan_gestionsolicitudes_tasks_1');

    //    echo "Entra Asociar Tareas" ."<br>";

    foreach ($this->expan_gestionsolicitudes_tasks_1->getBeans() as $tarea) {

      $GLOBALS['log']->info('[ExpandeNegocio][Asociar Tareas] Tarea -' . $tarea->id);
      if ($tarea->status == $status) {
        $tarea->assigned_user_id = $user;
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Tareas] Usuario-' . $user);
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Tareas] Antes de guardar');
        $tarea->save();
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Tareas] Despues de guardar');
      }
    }

  }

  function asociarReuniones($status, $user)
  {

    $this->load_relationship('expan_gestionsolicitudes_meetings_1');

    foreach ($this->expan_gestionsolicitudes_meetings_1->getBeans() as $reunion) {

      $GLOBALS['log']->info('[ExpandeNegocio][Asociar Reuniones] Reunion -' . $reunion->id);
      if ($reunion->status == $status) {
        $reunion->assigned_user_id = $user;
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Reuniones] Usuario-' . $user);
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Reuniones] Antes de guardar');
        $reunion->save();
        $GLOBALS['log']->info('[ExpandeNegocio][Asociar Reuniones] Despues de guardar');
      }
    }

  }

  function asignarFiltro()
  {
    //asignamos el usuario Filtro a la gestion y a todo lo que cuelga
    $Fran = $this->GetFranquicia();
    $this->assigned_user_id = $Fran->filtro_solicitudes;
    $this->asignarAccionesUsuario($Fran->filtro_solicitudes);
  }

  public function fill_in_additional_list_fields()
  {
    parent::fill_in_additional_list_fields();

    $db = DBManagerFactory::getInstance();

    $query = "SELECT s.provincia_apertura_1,g.rating,s.phone_mobile,g.motivo_parada,g.motivo_descarte,g.motivo_positivo, ";
    $query = $query . "g.portal,g.expan_evento_id_c,g.subor_mailing,g.subor_central,g.subor_expande,g.subor_medios ";
    $query = $query . "FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND  ";
    $query = $query . "g.id ='" . $this->id . "'";

    $result = $db->query($query, true);

    $parada = '';
    $descarte = '';
    $positivo = '';
    $portal = '';
    $evento = '';
    $mailing = '';
    $central = '';
    $expande = '';
    $medios = '';

    while ($row = $db->fetchByAssoc($result)) {
      $this->provincia_apertura_1 = $row['provincia_apertura_1'];
      $this->rating = $row['rating'];
      $this->telefono = $row['phone_mobile'];
      $parada = $row['motivo_parada'];
      $descarte = $row['motivo_descarte'];
      $positivo = $row['motivo_positivo'];
      $portal = $GLOBALS["app_list_strings"]["portal_list"][$row['portal']];
      $evento = $GLOBALS["app_list_strings"]["eventos_list"][$row['expan_evento_id_c']];
      $mailing = $GLOBALS["app_list_strings"]["subor_mailing_list"][$row['subor_mailing']];
      $central = $GLOBALS["app_list_strings"]["subor_central_list"][$row['subor_central']];
      $expande = $GLOBALS["app_list_strings"]["subor_expande_list"][$row['subor_expande']];
      $medios = $GLOBALS["app_list_strings"]["subor_medios_list"][$row['subor_medios']];
    }

    //Calculamos los subestados
    if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_NO_ATENDIDO) {
      $this->subestado = "";
    } else if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO) {

      if ($this->chk_visita_central == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_CENTRAL;
      } else if ($this->chk_envio_contrato == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_ENVIO_CONTRATO;
      } else if ($this->chk_visita_local_label == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_VISITA_LOCAL;
      } else if ($this->chk_envio_precontrato == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_PRECONTRATO;
      } else if ($this->chk_visitado_fran == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_VISITA_FRANQ;
      } else if ($this->chk_entrevista == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_ENTREVISTA;
      } else if ($this->chk_informacion_adicional == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_INFOR_ADICIO;
      } else if ($this->chk_recepcio_cuestionario == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_CUESTIONARIO;
      } else if ($this->chk_resolucion_dudas == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_PRI_DUDAS;
      } else if ($this->chk_sol_amp_info == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_SOL_AMP;
      } else if ($this->chk_responde_C1 == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_RESPON_C1;
      } else if ($this->chk_envio_documentacion == true) {
        $this->subestado = Expan_GestionSolicitudes::SUBESTADO_ENVIO_DOC;
      }

    } else if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO) {
      $this->subestado = $GLOBALS["app_list_strings"]["motivo_parada_list"][$parada];
    } else if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO) {
      $this->subestado = $GLOBALS["app_list_strings"]["motivo_descarte_list"][$descarte];
    } else if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO) {
      $this->subestado = $GLOBALS["app_list_strings"]["motivo_positivo_list"][$positivo];
    }

    //Calculamos los suborigenes

    switch ($this->tipo_origen) {
      case Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL:
        $this->suborigen = $central;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS:
        $this->suborigen = $evento;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO:
        $this->suborigen = $expande;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MAILING:
        $this->suborigen = $mailing;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MEDIOS_COMUN:
        $this->suborigen = $medios;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES:
        $this->suborigen = $portal;
        break;
    }
  }

  public function getSuborigenDesc()
  {

    $portal = $GLOBALS["app_list_strings"]["portal_list"][$this->portal];
    $evento = $GLOBALS["app_list_strings"]["eventos_list"][$this->expan_evento_id_c];
    $mailing = $GLOBALS["app_list_strings"]["subor_mailing_list"][$this->subor_mailing];
    $central = $GLOBALS["app_list_strings"]["subor_central_list"][$this->subor_central];
    $expande = $GLOBALS["app_list_strings"]["subor_expande_list"][$this->subor_expande];
    $medios = $GLOBALS["app_list_strings"]["subor_medios_list"][$this->subor_medios];

    switch ($this->tipo_origen) {
      case Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL:
        return $central;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS:
        return $evento;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO:
        return $expande;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MAILING:
        return $mailing;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MEDIOS_COMUN:
        return $medios;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES:
        return $portal;
        break;
    }

    return '';

  }

  public function getSuborigenId()
  {

    switch ($this->tipo_origen) {
      case Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL:
        return $this->subor_central;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS:
        return $this->expan_evento_id_c;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_EXPANDENEGOCIO:
        return $this->subor_expande;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MAILING:
        return $this->subor_mailing;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_MEDIOS_COMUN:
        return $this->subor_medios;
        break;

      case Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES:
        return $this->portal;
        break;
    }

    return '';

  }

  //Comprobamos si hay una llamada el tipo y el estado que se indican

  public function isDescartadoNosotros()
  {

    $db = DBManagerFactory::getInstance();

    $query = "select * from tipo_descarte where Desc_Nosotros=1";
    $result = $db->query($query, true);

    $myArraydescartes[''] = '';
    while ($row = $db->fetchByAssoc($result)) {
      $myArraydescartes[$row['id']] = 1;
    }

    if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO &&
      in_array($this->motivo_descarte, $myArraydescartes)) {
      return true;
    } else {
      return false;
    }
  }

  public function isParadoCandidato()
  {

    $db = DBManagerFactory::getInstance();

    $query = "select * from tipo_parada where nombre like'POR CANDIDATO%'";

    $result = $db->query($query, true);

    $myArrayPadara[''] = '';
    while ($row = $db->fetchByAssoc($result)) {
      $myArrayPadara[$row['id']] = 0;
    }

    if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_PARADO &&
      in_array($this->motivo_parada, $myArrayPadara)) {
      return true;
    } else {
      return false;
    }

  }

  public function calcAvanzado()
  {

    if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO &&
      ($this->chk_resolucion_dudas == true ||
        $this->chk_recepcio_cuestionario == true ||
        $this->chk_informacion_adicional == true ||
        $this->chk_autoriza_central ||
        $this->chk_entrevista == true ||
        $this->chk_propuesta_zona == true)) {
      $this->candidatura_avanzada = true;
    } else {

      $reuniones = $this->comprobarReuniones();
      if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO && $reuniones == true) {
        $this->candidatura_avanzada = true;
      } else {
        $this->candidatura_avanzada = false;
      }
    }
  }

  public function comprobarReuniones()
  {
    //mirar si tienes reuniones planificadas
    $db = DBManagerFactory::getInstance();
    $query = "select count(*) as reuniones FROM meetings where parent_id='" . $this->id . "' and status='Planned' and deleted=0; ";
    $result = $db->query($query, true);
    while ($row = $db->fetchByAssoc($result)) {
      if ($row["reuniones"] != 0) {
        return true;
      }
    }
    return false;
  }

  public function calcCaliente()
  {

    if (($this->estado_sol == Expan_GestionSolicitudes::ESTADO_EN_CURSO &&
        ($this->chk_visitado_fran == true ||
          $this->chk_envio_precontrato == true ||
          $this->chk_visita_local == true ||
          $this->chk_operacion_autorizada == true ||
          $this->chk_envio_precontrato_personal == true ||
          $this->chk_precontrato_firmado == true ||
          $this->chk_envio_plan_financiero_personal == true ||
          $this->chk_aprobacion_local == true ||
          $this->chk_envio_contrato == true ||
          $this->chk_visita_central == true ||
          $this->chk_posible_colabora == true ||
          $this->chk_envio_contrato_personal ||
          $this->chk_contrato_firmado == true
        ))
      ||
      ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO &&
        $this->motivo_positivo == Expan_GestionSolicitudes::POSITIVO_PRECONTRATO)) {

      $this->candidatura_caliente = true;
    } else {
      $this->candidatura_caliente = false;
    }
  }

  public function creaReunion($texto, $tipo, $días)
  {

    $fecha = date("Y-m-d H:i:s", $this->addBusinessDays($días));

    $reunion = new Meeting();
    $reunion->parent_id = $this->id;
    $reunion->parent_type = "Expan_GestionSolicitudes";

    $reunion->meeting_type = $tipo;
    $reunion->status = 'Planned';
    $reunion->name = $this->name . ' - ' . $texto;
    $reunion->date_start = $fecha;
    $reunion->assigned_user_id = $this->assigned_user_id;
    $reunion->duration_minutes = $reunion->asignarTiempo($tipo);

    $reunion->ignore_update_c = true;
    $reunion->save();

    //enlazamos con la gestión
    $this->load_relationship('expan_gestionsolicitudes_meetings_1');
    $this->expan_gestionsolicitudes_meetings_1->add($reunion->id);
    $this->ignore_update_c = true;
    $this->save();

    $prioridad = $this->calcularPrioridades();
    $this->prioridad = $prioridad;

  }

  private function addBusinessDays($days, $dateTime = null)
  {
    date_default_timezone_set('europe/madrid');

    $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] fecha - ' . time());

    $dateTime = is_null($dateTime) ? time() : $dateTime;
    $_day = 0;
    $_direction = $days == 0 ? 0 : intval($days / abs($days));
    $_day_value = (60 * 60 * 24);

    $max = 4;
    $i = 0;

    while ($_day !== $days) {
      $dateTime += $_direction * $_day_value;
      $_day_w = date("w", $dateTime);
      if ($_day_w > 0 && $_day_w < 6) {
        $_day += $_direction * 1;
      }
      //Para no entrar en posible bucle infinito
      $i++;
      if ($i == $max) {
        break;
      }
    }

    $dateTime = is_null($dateTime) ? time() : $dateTime;

    return $dateTime - (2 * 3600);
  }

  function calcularPrioridades()
  {

    $db = DBManagerFactory::getInstance();

    $GLOBALS['log']->info('[ExpandeNegocio][calcularPrioridades] Iniciamos calculo');

    //Actualizamos las prioridadesde la gestion

    $query = "  update expan_gestionsolicitudes g ";
    $query = $query . "  inner join (SELECT g.id,ra.sid, ";
    $query = $query . "       g.name,       ";
    $query = $query . "       CASE WHEN estado_sol='" . Expan_GestionSolicitudes::POSITIVO_PRECONTRATO . "' THEN 200 ";
    $query = $query . "       WHEN estado_sol='" . Expan_GestionSolicitudes::POSITIVO_COLABORACION . "' THEN 100 ";
    $query = $query . "       WHEN estado_sol='" . Expan_GestionSolicitudes::POSITIVO_CONTRATO . "' THEN 100 ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_contrato_personal = 1 THEN 130  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_visita_central = 1 THEN 120  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_contrato = 1 THEN 110  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_plan_financiero_personal = 1 THEN 100  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_precontrato_personal = 1 THEN 90  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_precontrato = 1 THEN 80  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_visitado_fran = 1 THEN 70  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_entrevista = 1 THEN 60  ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_informacion_adicional = 1 THEN 50   ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_recepcio_cuestionario = 1 THEN 40   ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_resolucion_dudas = 1 THEN 30   ";
    $query = $query . "       WHEN estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_responde_C1 = 1 THEN 20   ";
    $query = $query . "       when estado_sol=" . Expan_GestionSolicitudes::ESTADO_EN_CURSO . " AND chk_envio_documentacion = 1 THEN 10          ";
    $query = $query . "       ELSE 0 END +IFNULL(ra.punt, 0) + IFNULL(lla.puntLLamada, 0) + IFNULL(co.puntCorreo, 0) final ";
    $query = $query . " FROM   expan_gestionsolicitudes g ";
    $query = $query . "       LEFT JOIN ";
    $query = $query . "                 (SELECT   g.id, g.rating,s.id sid, ";
    $query = $query . "                           SUM(CASE WHEN g.rating = 1 THEN 50 WHEN g.rating = 2 THEN 30 WHEN g.rating = 3 THEN 10 ELSE 0 END) punt ";
    $query = $query . "                  FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "                  WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id='" . $this->id . "' ";
    $query = $query . "                  GROUP BY g.id) ra ";
    $query = $query . "                   ON g.id = ra.id  ";
    $query = $query . "       LEFT JOIN (SELECT   g.id, ";
    $query = $query . "                           SUM(CASE WHEN c.direction = 'Inbound' THEN 5 WHEN c.direction = 'Outbound' THEN 1 ELSE 0 END) puntLlamada ";
    $query = $query . "                  FROM     expan_gestionsolicitudes g, calls c ";
    $query = $query . "                  WHERE    c.parent_id = g.id AND c.status = 'Held' AND g.id='" . $this->id . "' ";
    $query = $query . "                  GROUP BY g.id) lla ";
    $query = $query . "         ON g.id = lla.id ";
    $query = $query . "       LEFT JOIN (SELECT   g.id, SUM(3) puntCorreo ";
    $query = $query . "                  FROM     expan_gestionsolicitudes g, emails e ";
    $query = $query . "                  WHERE    e.parent_id = g.id AND e.type = 'inbound' AND e.parent_type = 'Expan_GestionSolicitudes' AND g.id='" . $this->id . "' ";
    $query = $query . "                  GROUP BY g.id) co  ";
    $query = $query . "         ON g.id = co.id) op ";
    $query = $query . "  on g.id='" . $this->id . "' AND op.id=g.id   ";
    $query = $query . "  set g.prioridad=op.final, g.date_modified=now(); ";
    $result = $db->query($query, true);

    //Actualizo las solicitudes

    $query = "  update expan_solicitud s inner join (SELECT s.id, max(g.prioridad) as prio ";
    $query = $query . " FROM     expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . " WHERE g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
    $query = $query . " AND g.deleted= 0 and s.id= (SELECT s.id ";
    $query = $query . " FROM expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . " WHERE g.id='" . $this->id . "' and g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
    $query = $query . " AND g.deleted= 0)) p on s.id=p.id set s.prioridad=p.prio;";

    $GLOBALS['log']->info('[ExpandeNegocio][calcularPrioridades] Actualizamos solicitudes');

    $result = $db->query($query, true);

    //Actualizo llamadas
    $query = "  update calls c ";
    $query = $query . "  inner join expan_gestionsolicitudes g ";
    $query = $query . "  on g.id=c.parent_id AND g.id='" . $this->id . "' ";
    $query = $query . "  set c.prioridad=g.prioridad; ";

    $GLOBALS['log']->info('[ExpandeNegocio][calcularPrioridades] Actualizamos llamadas');

    $result = $db->query($query, true);

    //Actualizo tareas
    $query = "  update tasks t ";
    $query = $query . "  inner join expan_gestionsolicitudes g ";
    $query = $query . "  on g.id=t.parent_id AND g.id='" . $this->id . "' ";
    $query = $query . "  set t.prioridad=g.prioridad; ";

    $result = $db->query($query, true);

    $GLOBALS['log']->info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las tareas');

    //Actualizo reuniones
    $query = "  update meetings m ";
    $query = $query . "  inner join expan_gestionsolicitudes g ";
    $query = $query . "  on g.id=m.parent_id AND g.id='" . $this->id . "' ";
    $query = $query . "  set m.prioridad=g.prioridad; ";

    $result = $db->query($query, true);

    $GLOBALS['log']->info('[ExpandeNegocio][Expan_GestionSolicitudes]Se han calculado las prioridades de las reuniones');

    $query = "select g.prioridad as prior from expan_gestionsolicitudes g where g.id='" . $this->id . "';";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return $row["prior"];
    }
  }

  public function creaLlamada($texto, $tipo, $retraso)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] Creamos la llamada');

    //Retraso en días
    if (!isset($retraso)) {
      $retraso = 0;
    }

    $solicitud = $this->GetSolicitud();

    if ($solicitud == null) {
      return;
    }

    $telefono = $solicitud->recogeTelefono();

    if ($telefono == "") {
      if ($solicitud->skype == "") {
        return;
      } else {//tiene skype y no telefono
        $telefono = "";
        $texto = $texto . " - Skype";
      }
    }

    $Fran = $this->GetFranquicia();

    $this->archivarLLamadasPrevias();

    if ($this->existeLlamada($tipo, "Planned") == true) {
      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] NO se puede añadir llamada por repetida');
      return;
    }

    //No se llama si solo viene de portales
    if (($solicitud->do_not_call == 0 && $this->tipo_origen != Expan_Solicitud::TIPO_ORIGEN_PORTALES) ||
      ($solicitud->do_not_call == 0 && $this->tipo_origen == Expan_Solicitud::TIPO_ORIGEN_PORTALES && $tipo != 'Primera') ||
      ($solicitud->do_not_call == 0 && $this->tipo_origen == Expan_Solicitud::TIPO_ORIGEN_PORTALES && $tipo == 'Primera' && $Fran->llamar_todos == true) ||
      ($solicitud->do_not_call == 0 && $tipo == 'SolCorreo')) {

      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] Se puede añadir llamada');

      $numDias = $this->calcularDias($tipo);

      //Creo la llamada
      $llamada = new Call();

      //Doy atributos
      if ($this->assigned_user_id == null) {
        global $current_user;
        $llamada->assigned_user_id = $current_user->id;
      } else {
        $llamada->assigned_user_id = $this->assigned_user_id;
      }

      $llamada->duration_minutes = 15;
      $llamada->date_entered = TimeDate::getInstance()->getNow()->asDb();

      $llamada->status = 'Planned';
      //$llamada->description='Una descripcion';
      $llamada->parent_id = $this->id;
      $llamada->parent_type = 'Expan_GestionSolicitudes';
      $llamada->reminder_time = -1;
      $llamada->direction = 'Outbound';
      $llamada->telefono = $telefono;
      $llamada->call_type = $tipo;
      $llamada->created_by = 1;
      $llamada->franquicia = $this->franquicia;
      $llamada->disp_contacto = $solicitud->disp_contacto;
      $llamada->origen = $this->tipo_origen;

      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] NumDias - ' . $numDias);

      if ($texto == '[AUT]De seguimiento') { //la llamada es para dentro de 15 dias
        date_default_timezone_set('europe/madrid');
        $dateTime = time() - 3600;
        $llamada->date_start = date("Y-m-d H:i:s", $dateTime + (15 * 24 * 3600));

      } else {
        if ($texto == '[AUT]Puertas abiertas') {
          $llamada->date_start = TimeDate::getInstance()->getNow()->modify('+1 hour')->asDb();
          //date_default_timezone_set('europe/madrid');
          //$dateTime = time()+3600;
          //$llamada->date_start=date("Y-m-d H:i:s", $dateTime);

        } else {
          $fecha = date("Y-m-d H:i:s", $this->addBusinessDays($numDias) + ($retraso * 3600 * 24));
          $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] fecha - ' . $fecha);
          $llamada->date_start = $fecha;
        }

      }

      //Si es agrupada la marcamos

      if ($solicitud == null) {
        $numgest = 0;
      } else {
        $numgest = $solicitud->NumGestionesEstado(Expan_GestionSolicitudes::ESTADO_EN_CURSO);
      }

      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] NumGestiones - ' . $numgest);
      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] tipo llamada - ' . $llamada->call_type);


      if ($numgest > 1 && ($llamada->call_type == 'Primera' ||
          $llamada->call_type == 'SolCorreo' ||
          $llamada->call_type == 'InformacionAdicional')) {

        $llamada->gestion_agrupada = true;
        $llamada->name = $solicitud->name . ' - Gestion Agrupada - ' . $texto;
        $solicitud->AgruparLLamadas('Planned', $tipo);
      } else {
        $llamada->gestion_agrupada = false;
        $llamada->name = $this->name . ' - ' . $texto;
      }

      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada]Nombre llamada - ' . $llamada->name);
      $llamada->ignore_update_c = true;
      $llamada->save();

      //Actualizamos la fecha de creacion
      $query = "UPDATE calls SET date_entered = UTC_TIMESTAMP() WHERE id = '" . $llamada->id . "'";
      $db = DBManagerFactory::getInstance();
      $result = $db->query($query);

      //enlazamos con la gestión
      $this->load_relationship('expan_gestionsolicitudes_calls_1');
      $this->expan_gestionsolicitudes_calls_1->add($llamada->id);
      $this->ignore_update_c = true;
      $this->save();

      $prioridad = $this->calcularPrioridades();
      $this->prioridad = $prioridad;
    } else {
      $GLOBALS['log']->info('[ExpandeNegocio][Creaion de llamada] NO se puede añadir llamada or las condiciones impuestas');
    }


  }

  function GetSolicitud()
  {

    $this->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

    $solicitud = null;
    foreach ($this->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $sol) {
      $solicitud = $sol;
      return $solicitud;
    }

    return $solicitud;
  }

  function archivarLLamadasPrevias()
  {
    //archivamos todas las llamadas de una gestion que se crean de forma automática

    $db = DBManagerFactory::getInstance();

    $query = " update calls c JOIN (SELECT c.id ";
    $query = $query . " FROM   calls c, expan_gestionsolicitudes g, expan_gestionsolicitudes_calls_1_c gs ";
    $query = $query . " WHERE  g.id = gs.expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida AND g.id = '" . $this->id . "' ";
    $query = $query . " AND gs.expan_gestionsolicitudes_calls_1calls_idb =c.id and c.status = 'Planned' and (c.call_type='Primera' or ";
    $query = $query . " c.call_type='ResPriDuda' or c.call_type='InformacionAdicional' or c.call_type='Cuestionario' or c.call_type='VisitaF' or ";
    $query = $query . " c.call_type='SegPre' or c.call_type='Locales' or c.call_type='Contrato') and g.deleted=0) t ";
    $query = $query . " ON c.id = t.id set c.status='Archived'; ";

    $result = $db->query($query);

  }

  function existeLlamada($tipo, $estado)
  {

    $db = DBManagerFactory::getInstance();

    //Actualizo tareas
    $query = "SELECT id ";
    $query = $query . "FROM   calls ";
    $query = $query . "WHERE  parent_id = '" . $this->id . "' AND deleted = 0 AND status = '" . $estado . "' AND call_type = '" . $tipo . "' ";

    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][existeLlamada]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }
    return false;
  }

  private function calcularDias($tipo)
  {
    $dias = 0;
    if ($tipo == 'Primera') {
      switch ($this->tipo_origen) {
        case Expan_GestionSolicitudes::TIPO_ORIGEN_CENTRAL :
          $dias = 1;
          break;
        case Expan_GestionSolicitudes::TIPO_ORIGEN_MEDIOS_COMUN :
          $dias = 2;
          break;
        case Expan_GestionSolicitudes::TIPO_ORIGEN_PORTALES :
          $dias = 4;
          break;
        case Expan_GestionSolicitudes::TIPO_ORIGEN_EVENTOS :
          $dias = 3;
          break;
        default :
          $dias = 3;
          break;
      }
    } else if ($tipo == 'InformacionAdicional') {
      $dias = 3;
    } else if ($tipo == 'ResPriDuda') {
      $dias = 0;
    } else {
      $dias = 2;
    }

    return $dias;
  }

  public function addFechaObserva($texto, $permiteRepetido)
  {

    if ($texto == "") {
      return;
    }

    $pos = strpos($this->observaciones_informe, $texto);

    if ($permiteRepetido == true || $pos === false) {
      $posDescartado = strpos($this->observaciones_informe, ": Descartado por");
      $posParado = strpos($this->observaciones_informe, ": Parado por");
      if ($posDescartado === false && $posParado === false) {
        $fecha = date("d/m/Y", time());
        $this->observaciones_informe = $this->observaciones_informe . '
' . $fecha . ' : ' . $texto;        //NO AÑADIR ESPACIOS AL INICIO DE LA LINEA

      }
    }
  }

  function peparaEnvioFichaAuto()
  {

    $franquicia = $this->GetFranquicia();

    if ($franquicia->reporte_alta_cliente == 1) {

      $GLOBALS['log']->info('[ExpandeNegocio][Expande_GestionSolicitudes][peparaEnvioFichaAuto] Entra envio');

      $solicitud = $this->GetSolicitud();

      $addresses = array('0' => array('email_address' => ''));
      $addresses['0']['email_address'] = $franquicia->correo_general;
      $rcp_name = $franquicia->name;


      $GLOBALS['log']->info('[ExpandeNegocio][Expande_GestionSolicitudes][peparaEnvioFichaAuto] Antes rellenar ficha');

      $envioAutoCorreos = new EnvioAutoCorreos();

      $envioAutoCorreos->rellenacorreoFicha("FA", $rcp_name, $addresses, $solicitud, $franquicia, $this);
    }

  }

  function preparaCorreo($envio)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] Inicio.');

    //Recogemos la franquica
    $franquicia = $this->GetFranquicia();

    if ($franquicia->parada_temp_envios == true) {
      return "La franquicia tiene el envío de correos automáticos bloqueado";
    }

    $solicitud = $this->GetSolicitud();

    if ($solicitud == null) {
      $GLOBALS['log']->info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] No se puede enviar correo no existe la solicitud.');
      return "No existe la solicutd";
    }

    if ($solicitud->no_correos_c == false) {

      $GLOBALS['log']->info('[ExpandeNegocio][Expande_GestionSolicitudes][preparaCorreo] Entra.');

      if ($this->franquicia != '' &&
        $this->chk_envio_auto == 1 &&
        $this->isDescartadoUsuario() == false) {

        $db = DBManagerFactory::getInstance();

        //Creamos la consulta para localizar el id del template correspondiente

        if ($envio == "LA") {
          $query = "select id,type,modeloneg from email_templates where type='" . $envio . "' AND deleted=0";
        } else {
          $query = "select id,type,modeloneg from email_templates where franquicia='" . $this->franquicia . "' AND type='" . $envio . "' AND deleted=0";
        }


        $GLOBALS['log']->info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] Query correo - ' . $query);
        $result = $db->query($query, true);

        $enviado = true;
        $idTemplate = "";
        $salida = "";

        while ($row = $db->fetchByAssoc($result)) {
          $idTemplate = $row["id"];
          $typeTemplate = $row["type"];
          $modnegTemplate = $row["modeloneg"];

          $GLOBALS['log']->info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] ModeloNegocioTemplate - ' . $modnegTemplate);
          $GLOBALS['log']->info('[ExpandeNegocio][Modificacion GestionSolicitud Envio Correo] TipoNegocio - ' .
            $this->tiponegocio1 . "-" . $this->tiponegocio2 . "-" . $this->tiponegocio3 . "-" . $this->tiponegocio4 . "-");

          //Si no tiene modelo de negocio o encaja con el modelo de negocio
          if ($modnegTemplate == null || ($modnegTemplate == 1 && $this->tiponegocio1 == 1)
            || ($modnegTemplate == 2 && $this->tiponegocio2 == 1)
            || ($modnegTemplate == 3 && $this->tiponegocio3 == 1)
            || ($modnegTemplate == 4 && $this->tiponegocio4 == 1)) {

            //Comprobamos que el está validada la plantilla

            $Fran = $this->GetFranquicia();

            if ($this->plantillaValida($Fran, $typeTemplate) == true &&
              $Fran->tipo_cuenta != Expan_Franquicia::TIPO_FRAN_CLIENTE_PARADO) {

              $envioCorreos = new EnvioAutoCorreos();
              $resp= $envioCorreos->rellenaCorreoCx($idTemplate, $solicitud, $franquicia, $this);
              if ($resp == 'Ok') {
                $salida = "Ok";
              } elseif($resp == "SinCorreoValido") {
                $salida = "Ninguno de los correos del candidato es válido";
              } else {
                $salida = "Alguno de los correos no han sido enviados. Posiblemente el correo no sea válido.";
              }
            } else {

              $incidencia = new Expan_IncidenciaCorreo();
              $incidencia->RellenoGestion($this, $envio);
              $salida = "La plantilla de envío no está validada";
            }

          }
        }

        if ($salida != "") {
          return $salida;
        }

        //Si no tenemos plantilla
        if ($idTemplate == "") {
          $this->crearTarea("INTPlantilla");
          $incidencia = new Expan_IncidenciaCorreo();
          $incidencia->RellenoGestion($this, $envio);
          return "Alguno de los correos no han sido enviados. La plantilla no existe";
        }
      } else {
        return "No se debe enviar correo";
      }
    } else {
      return "Los correos no se han enviado porque el usuario no quería recibirlos.";
    }
  }

  public function isDescartadoUsuario()
  {

    $db = DBManagerFactory::getInstance();

    $query = "select * from tipo_descarte where Desc_Nosotros=0";

    $result = $db->query($query, true);

    $myArraydescartes[''] = '';
    while ($row = $db->fetchByAssoc($result)) {
      $myArraydescartes[$row['id']] = 0;
    }

    if ($this->estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO &&
      in_array($this->motivo_descarte, $myArraydescartes)) {
      return true;
    } else {
      return false;
    }

  }

  function plantillaValida($Fran, $typeTemplate)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][plantillaValida] ID Plantilla - ' . $typeTemplate);
    $GLOBALS['log']->info('[ExpandeNegocio][plantillaValida] check franquicia - ' . $Fran->chk_c1);
    $GLOBALS['log']->info('[ExpandeNegocio][plantillaValida] nombre franquicia - ' . $Fran->name);

    if ($typeTemplate == "C1") {
      if ($Fran->chk_c1 == true) {
        return true;
      }
    } else if ($typeTemplate == "C1.1") {
      if ($Fran->chk_c11 == true) {
        return true;
      }
    } else if ($typeTemplate == "C1.2") {
      if ($Fran->chk_c12 == true) {
        return true;
      }
    } else if ($typeTemplate == "C1.3") {
      if ($Fran->chk_c13 == true) {
        return true;
      }
    } else if ($typeTemplate == "C1.4") {
      if ($Fran->chk_c14 == true) {
        return true;
      }
    } else if ($typeTemplate == "C1.5") {
      if ($Fran->chk_c15 == true) {
        return true;
      }
    } else if ($typeTemplate == "C2") {
      if ($Fran->chk_c2 == true) {
        return true;
      }
    } else if ($typeTemplate == "C3") {
      if ($Fran->chk_c3 == true) {
        return true;
      }
    } else if ($typeTemplate == "C4") {
      if ($Fran->chk_c4 == true) {
        return true;
      }
    }

    $this->crearTarea("INTPlantilla");
    return false;
  }

  function crearTarea($tipoTarea)
  {

    $tarea = new Task();
    if (array_key_exists($tipoTarea, $GLOBALS['app_list_strings']['tipo_tarea_list'])) {
      $tarea->name = $this->name . " - " . $GLOBALS['app_list_strings']['tipo_tarea_list'][$tipoTarea];
    } else {
      $tarea->name = $this->name . " - " . $tipoTarea;
    }

    $tarea->status = "Not Started";
    $tarea->task_type = $tipoTarea;

    $tarea->date_start = TimeDate::getInstance()->nowDb();
    $tarea->date_due = TimeDate::getInstance()->nowDb();

    $franquicia = $this->GetFranquicia();

    if ($tipoTarea == "INTPlantilla") {

      if ($franquicia->existeTarea($tipoTarea, "Not Started") == true) {
        $GLOBALS['log']->info('[ExpandeNegocio][Creaion de tarea]NO se crea la tarea, ya existe otra igual para la franquicia');
        return;
      }

      $tarea->parent_id = $franquicia->id;
      $tarea->parent_type = 'Expan_Franquicia';
      $tarea->assigned_user_id = $franquicia->user_id1_c;

      $tarea->ignore_update_c = true;
      $tarea->save();

      $franquicia->load_relationship('expan_franquicia_tasks_1');
      $franquicia->expan_franquicia_tasks_1->add($tarea->id);
      $franquicia->ignore_update_c = true;
      $franquicia->save();
    } else {

      if ($this->existeTarea($tipoTarea, "Not Started") == true) {
        $GLOBALS['log']->info('[ExpandeNegocio][Creaion de tarea]NO se crea la tarea, ya existe otra igual para a gestion');
        return;
      }

      $tarea->parent_id = $this->id;
      $tarea->parent_type = 'Expan_GestionSolicitudes';

      //Si es creacion de precontrato se le asigna a JULIA
      if ($tipoTarea == "DOCUPerPre") {
        $tarea->assigned_user_id = 'd36aa4a1-0a9c-15a3-d2a8-577a18132b8c';
      } else {
        $tarea->assigned_user_id = $this->assigned_user_id;
      }
      $tarea->ignore_update_c = true;
      $tarea->save();
      //enlazamos con la gestión
      $this->load_relationship('expan_gestionsolicitudes_tasks_1');
      $this->expan_gestionsolicitudes_tasks_1->add($tarea->id);
      $this->ignore_update_c = true;
      $this->save();
    }

    $prioridad = $this->calcularPrioridades();
    $this->prioridad = $prioridad;


  }

  private function existeTarea($tipo, $estado)
  {

    $db = DBManagerFactory::getInstance();

    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][existeTarea]ID-' . $this->id);
    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][existeTarea]ID-' . $tipo);

    //Actualizo tareas
    $query = "SELECT id ";
    $query = $query . "FROM   tasks ";
    $query = $query . "WHERE  parent_id = '" . $this->id . "' AND deleted = 0 AND status = '" . $estado . "' AND task_type = '" . $tipo . "' ";

    $GLOBALS['log']->info('[ExpandeNegocio][Expan_Solicitud][existeTarea]query-' . $query);
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }
    return false;
  }

  function calcularOportunidadInmediata($inmediata)
  {

    //Pasamos el parámetro de inmediata porque cuando la creamos de nueva
    //no está bien guardada llamada/gestion/reunion

    if ($inmediata ||
      $this->llamadasOportunidadInmediata("Planned") ||
      $this->tareasOportunidadInmediata("Not Started") ||
      $this->reunionesOportunidadInmediata("Planned")) {

      $this->oportunidad_inmediata = true;
    } else {
      $this->oportunidad_inmediata = false;
    }

    $this->ignore_update_c = true;
    $this->save();

  }

  function llamadasOportunidadInmediata($estado)
  {

    $db = DBManagerFactory::getInstance();
    $query = "select oportunidad_inmediata from calls where parent_id='" . $this->id . "' and deleted=0 and status='" . $estado . "'";

    $result = $db->query($query, true);

    $opIn = false;

    while ($row = $db->fetchByAssoc($result)) {
      if ($row["oportunidad_inmediata"] == 1) {
        return true;
      }
    }
    return $opIn;
  }

  function tareasOportunidadInmediata($estado)
  {

    $db = DBManagerFactory::getInstance();
    $query = "select oportunidad_inmediata from tasks where parent_id='" . $this->id . "' and deleted=0 and status='" . $estado . "'";

    $result = $db->query($query, true);

    $opIn = false;

    while ($row = $db->fetchByAssoc($result)) {
      if ($row["oportunidad_inmediata"] == 1) {
        return true;
      }
    }
    return $opIn;
  }

  function reunionesOportunidadInmediata($estado)
  {

    $db = DBManagerFactory::getInstance();
    $query = "select oportunidad_inmediata from meetings where parent_id='" . $this->id . "' and deleted=0 and status='" . $estado . "'";

    $result = $db->query($query, true);

    $opIn = false;

    while ($row = $db->fetchByAssoc($result)) {
      if ($row["oportunidad_inmediata"] == 1) {
        return true;
      }
    }
    return $opIn;
  }

  public function pasoaOrigenExpandeFeria()
  {

    if ($this->tipo_origen == $this::TIPO_ORIGEN_EVENTOS ||
      $this->tipo_origen == null) {

      $db = DBManagerFactory::getInstance();

      //Creamos la consulta para ver el tipo de participacion en el evento
      $query = "SELECT * ";
      $query = $query . "FROM expan_franquicia_expan_evento_c ";
      $query = $query . "WHERE expan_franquicia_expan_eventoexpan_franquicia_ida ='" . $this->franquicia . "' AND ";
      $query = $query . "  expan_franquicia_expan_eventoexpan_evento_idb = '" . $this->expan_evento_id_c . "' AND deleted=0; ";

      $GLOBALS['log']->info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Consulta-' . $query);

      $result = $db->query($query, true);

      $numElem = 0;

      while ($row = $db->fetchByAssoc($result)) {

        $GLOBALS['log']->info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Entra');
        $numElem++;

        if ($row['participacion'] == '3' || $row['participacion'] == null || $row['participacion'] == '') {
          $GLOBALS['log']->info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Sale por 3 null o 0');
          return true;
        };
      }
      //Si no hay franquicia asociada pero el origen es evento. Se lo pasamos a Expande
      if ($numElem == 0) {
        $GLOBALS['log']->info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Sale por 0');
        return true;
      }
    }
    $GLOBALS['log']->info('[ExpandeNegocio][pasoaOrigenExpandeFeria]Sale al final');
    return false;

  }

  function getEmail()
  {

    $solicitud = $this->GetSolicitud();
    if ($solicitud !== null) {
      $listaCorreos = $solicitud->getCorreos();
      return current($listaCorreos);
    } else {
      return null;
    }

  }

  function getEmailPrincipal()
  {
    $solicitud = $this->GetSolicitud();
    if ($solicitud !== null) {
      $listaCorreos = $solicitud->getCorreoPrincipal();
      return current($listaCorreos);
    } else {
      return null;
    }

  }

  function getTemplate($tipo)
  {

    $db = DBManagerFactory::getInstance();
    $query = "select id from email_templates where franquicia='" . $this->franquicia . "' AND type='" . $tipo . "' AND deleted=0";

    $result = $db->query($query, true);

    $template = new EmailTemplate();

    while ($row = $db->fetchByAssoc($result)) {
      $template->retrieve($row["id"]);
    }
    return $template;
  }

  function setOrigenSuborigenFromSolicitud($solicitud, $origenAnt)
  {
    //Calculamos el origen y suborigen de la gestion
    $origen = $solicitud->getNewOrigen($origenAnt);
    $this->tipo_origen = $origen;

    $GLOBALS['log']->info('[ExpandeNegocio][Creacion Solicitud] Origen de la gestion - ' . $this->tipo_origen);

    if ($origen == Expan_Solicitud::TIPO_ORIGEN_EXPANDENEGOCIO) {
      $this->subor_expande = $solicitud->subor_expande;
    } else if ($origen == Expan_Solicitud::TIPO_ORIGEN_PORTALES) {
      $this->portal = $solicitud->portal;
    } else if ($origen == Expan_Solicitud::TIPO_ORIGEN_EVENTOS) {
      $this->expan_evento_id_c = $solicitud->expan_evento_id_c;

      $evento = new Expan_Evento();
      $evento->retrieve($solicitud->expan_evento_id_c);

      //Si el origen es un evento de tipo franquishp debemos crear llamada
      if ($evento->tipo_evento == "FShop") {
        $crearLLamadaFS = true;
      }

    } else if ($origen == Expan_Solicitud::TIPO_ORIGEN_CENTRAL) {
      $this->subor_central = $solicitud->subor_central;
    } else if ($origen == Expan_Solicitud::TIPO_ORIGEN_MEDIOS_COMUN) {
      $this->subor_medios = $solicitud->subor_medios;
    } else if ($origen == Expan_Solicitud::TIPO_ORIGEN_MAILING) {
      $this->subor_mailing = $solicitud->subor_mailing;
    }
  }

  function procesarObservaciones()
  {

    $this->preguntas_mn_t = $this->addFechaObservacion($this->preguntas_mn_t);
    $this->objeciones_mn = $this->addFechaObservacion($this->objeciones_mn);
    $this->solicitudes_candidato = $this->addFechaObservacion($this->solicitudes_candidato);
    $this->informacion_competencia = $this->addFechaObservacion($this->informacion_competencia);
    $this->mejoras = $this->addFechaObservacion($this->mejoras);
    $this->concesiones = $this->addFechaObservacion($this->concesiones);
    $this->preg_en_central = $this->addFechaObservacion($this->preg_en_central);
    $this->notas_argumentario = $this->addFechaObservacion($this->notas_argumentario);

  }

  function addFechaObservacion($observaciones)
  {

    //Secogemos cada párrafo

    $listaParr = explode("\r\n", $observaciones);

    $output = "";
    $cont = 0;

    foreach ($listaParr as $par) {
      if ($par != "") {
        $parConFecha = $par;

        if ($this->validateDate(substr($par, 0, 10)) == false && !(strpos($par, " ") === 0) && !(substr($par, 0, 1) == "\t") && !(strpos($par, "-") === 0)) {

          $parConFecha = '' . date('d/m/Y') . ' - ' . $parConFecha;
          if ($cont != count($listaParr)) {
            $parConFecha = $parConFecha;
          }
        }
        $output = $output . $parConFecha . "\r\n";
      } else {
        if ($cont != count($listaParr) - 1) {
          $output = $output . "\r\n";
        }
      }
      $cont = $cont + 1;
    }
    return $output;
  }

  function validateDate($date, $format = 'd/m/Y')
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

  function cambiaCorreoDefecto()
  {

    global $current_user;

    $franquiciaId = $this->franquicia;
    $franquicia = $this->GetFranquicia();

    $outbound_id = "";
    $signature_id = "";


    $db = DBManagerFactory::getInstance();
    $query = "select * from inbound_email where group_id='" . $current_user->id . "' AND email_user='" . $franquicia->correo_envio . "' and deleted=0";
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $outbound_id = $row["id"];
    }

    if ($outbound_id != "") {
      $ie = new InboundEmail();
      $ie->setUsersDefaultOutboundServerId($current_user, $outbound_id);
    }

    $query = "select * from users_signatures where user_id='" . $current_user->id . "' AND name like '%" . $franquicia->name . "%' AND deleted=0";
    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $signature_id = $row["id"];
    }
    if ($signature_id != "") {
      $current_user->setPreference('signature_default', $signature_id);
    }

  }

  public function ActChekByDate()
  {
    if ($this->f_aprobacion_local != null && $this->chk_aprobacion_local == 0) {
      $this->chk_aprobacion_local = 1;
    }
    if ($this->f_autoriza_central != null && $this->chk_autoriza_central == 0) {
      $this->chk_autoriza_central = 1;
    }
    if ($this->f_contrato_firmado != null && $this->chk_contrato_firmado == 0) {
      $this->chk_contrato_firmado = 1;
    }
    if ($this->f_entrevista != null && $this->chk_entrevista == 0) {
      $this->chk_entrevista = 1;
    }
    if ($this->f_envio_contrato != null && $this->chk_envio_contrato == 0) {
      $this->chk_envio_contrato = 1;
    }
    if ($this->f_envio_contrato_personal != null && $this->chk_envio_contrato_personal == 0) {
      $this->chk_envio_contrato_personal = 1;
    }
    if ($this->f_envio_plan_financiero_personal != null && $this->chk_envio_plan_financiero_personal == 0) {
      $this->chk_envio_plan_financiero_personal = 1;
    }
    if ($this->f_envio_precontrato != null && $this->chk_envio_precontrato == 0) {
      $this->chk_envio_precontrato = 1;
    }
    if ($this->f_envio_precontrato_personal != null && $this->chk_envio_precontrato_personal == 0) {
      $this->chk_envio_precontrato_personal = 1;
    }
    if ($this->f_informacion_adicional != null && $this->chk_informacion_adicional == 0) {
      $this->chk_informacion_adicional = 1;
    }
    if ($this->f_operacion_autorizada != null && $this->chk_operacion_autorizada == 0) {
      $this->chk_operacion_autorizada = 1;
    }
    if ($this->f_posible_colabora != null && $this->chk_posible_colabora == 0) {
      $this->chk_posible_colabora = 1;
    }
    if ($this->f_precontrato_firmado != null && $this->chk_precontrato_firmado == 0) {
      $this->chk_precontrato_firmado = 1;
    }
    if ($this->f_propuesta_zona != null && $this->chk_propuesta_zona == 0) {
      $this->chk_propuesta_zona = 1;
    }
    if ($this->f_resolucion_dudas != null && $this->chk_resolucion_dudas == 0) {
      $this->chk_resolucion_dudas = 1;
    }
    if ($this->f_responde_C1 != null && $this->chk_responde_C1 == 0) {
      $this->chk_responde_C1 = 1;
    }
    if ($this->f_sol_amp_info != null && $this->chk_sol_amp_info == 0) {
      $this->chk_sol_amp_info = 1;
    }
    if ($this->f_visita_central != null && $this->chk_visita_central == 0) {
      $this->chk_visita_central = 1;
    }
    if ($this->f_visita_local != null && $this->chk_visita_local == 0) {
      $this->chk_visita_local = 1;
    }
    if ($this->f_visitado_fran != null && $this->chk_visitado_fran == 0) {
      $this->chk_visitado_fran = 1;
    }

  }

  public function crearTablaEntregaCuentaPrecontrato($esAdmin)
  {

    $GLOBALS['log']->info('[ExpandeNegocio][crearTablaEntregaCuentaPrecontrato] EsAdmin - ' . $esAdmin);

    if ($esAdmin == true) {
      $campos = array(
        "Nombre" => "<b>Nombre</b>",
        "Apellidos" => "<b>Apellidos</b>",
        "Franquicia" => "<b>Franquicia</b>",
        "ImporteEnt" => "<b>Importe Entregado</b>",
        "FEnt" => "<b>Fecha de la Entrega</b>"
      );
    } else {
      $campos = array(
        "Nombre" => "<b>Nombre</b>",
        "Apellidos" => "<b>Apellidos</b>",
        "Provincia" => "<b>Provincia</b>",
        "FEnt" => "<b>Fecha de la Entrega</b>",
      );
    }


    $query = "SELECT first_name Nombre, last_name Apellidos, f.name franquicia, prov.d_prov Provincia, f_entrega_cuenta_pre FEnt, entrega_cuenta ImporteEnt ";
    $query = $query . "FROM   (SELECT s.first_name, s.last_name, g.franquicia, g.provincia_apertura_pre, g.f_entrega_cuenta_pre, g.entrega_cuenta ";
    $query = $query . "        FROM   expan_gestionsolicitudes g, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "        WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ";
    $query = $query . "               g.id = '" . $this->id . "') a ";
    $query = $query . "       LEFT JOIN expan_m_provincia prov ON a.provincia_apertura_pre = prov.c_prov ";
    $query = $query . "       LEFT JOIN expan_franquicia f ON f.id = a.franquicia; ";


    $db = DBManagerFactory::getInstance();

    $result = $db->query($query, true);
    $tabla = '<table border="1">
                <tbody>';

    while ($row = $db->fetchByAssoc($result)) {
      foreach ($campos as $key => $value) {
        $tabla = $tabla . "<tr>";
        $tabla = $tabla . "<td>" . $value . "</td>";
        $tabla = $tabla . "<td>" . $row[$key] . "</td>";
        $tabla = $tabla . "</tr>";
      }
    }

    $tabla = $tabla . "</tbody>
        </table>";
    return $tabla;
  }

  public function crearTablaFichaConsultor()
  {

    $GLOBALS['log']->info('[ExpandeNegocio][crearTablaFichaConsultor]Entra');

    $campos = array(
      "Nombre" => "<b>Nombre</b>",
      "Apellidos" => "<b>Apellidos</b>",
      "Telefono" => "<b>Teléfono</b>",
      "email_address" => "<b>Correo</b>",
      "Provincia" => "<b>Provincia</b>",
      "Localidad" => "<b>Localidad</b>",
      "rol" => "<b>Rol en el proyecto</b>",
      "perfil_profesional" => "<b>Perfil Profesional</b>",
      "situacion_profesional" => "<b>Situacion Profesional</b>",
      "historial_empresa" => "<b>Perfil de Empresario</b>",
      "fechaApertura" => "<b>Inicio Actividad Previsto</b>",
      "capital" => "<b>Inversión máxima prevista</b>",
      "recursos_propios" => "<b>Recursos Propios disponibles</b>",
      "Observaciones" => "<b>Gestiones relacionadas</b>",
      "rrss" => "<b>Datos extraídos RRSS</b>",
      " " => "<b>Hitos de avances en gestión</b>",
      "CU" => "&emsp;&emsp;&emsp;Cuestionario",
      "IA" => "&emsp;&emsp;&emsp;Informacion ampliada",
      "PR" => "&emsp;&emsp;&emsp;Envío Precontrato",
      "CON" => "&emsp;&emsp;&emsp;Envío Contrato",
      "lnk" => "&emsp;&emsp;&emsp;Enlace al cuestionario",
      "otras_fran" => "Otras Franquicias",
      "Fecha_Creacion" => "Fecha de Creación",
      "observa_expande" => "Observaciones ExpandeNegocio"

    );

    $db = DBManagerFactory::getInstance();

    $query = "SELECT   nombres Nombre ";
    $query = $query . "         , Ape Apellidos ";
    $query = $query . "         , a.Telefono ";
    $query = $query . "         , ea.email_address ";
    $query = $query . "         , mun.d_municipio AS Localidad ";
    $query = $query . "         , prov.d_prov Provincia ";
    $query = $query . "         , COALESCE(obs,'') AS 'Observaciones' ";
    $query = $query . "         , rrss ";
    $query = $query . "         , Cuestionario AS 'CU', ";
    $query = $query . "         InfoAmpliada AS 'IA', ";
    $query = $query . "         Precontrato AS 'PR', ";
    $query = $query . "         Contrato AS 'CON', ";
    $query = $query . "         EnlaceCuestionario as 'lnk', ";
    $query = $query . "         case when papel=1 then 'Autoempleo' when papel=2 then 'Gestor' when papel=3 then 'Inversor' when papel=4 then 'corner' when papel=5 then 'Colaborador' else '' end as rol, ";
    $query = $query . "         perfil_profesional, ";
    $query = $query . "         case when situacion_profesional=1 then 'Cuenta Ajena' when situacion_profesional=2 then 'Cuenta propia' when situacion_profesional=3 then 'En busqueda' end as situacion_profesional, ";
    $query = $query . "         replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(historial_empresa,'^FA^','Fue autonomo'),'^FE^','Fue Empresario'),'^FF^','Fue Franquiciado'),'^EA^','Es Autonomo'),'^EE^','Es Empresario'),'^EF^','Es Franquiciado'), ";
    $query = $query . "    '^EM^','Es Multifranquiciado'),'^EB^','En Búsqueda'),'^NE^','Nunca ha tenido empresa'),'^NF^','Trabajo en negocio familiar'),'^^','') as historial_empresa, ";
    $query = $query . "         fechaApertura, ";
    $query = $query . "         case When capital=1 then 'menos de 20.000 €' when capital=2 then'20.000 - 50 000 €' when capital=3  then '50.000 - 90.000 €' when capital=4 then '90.000 - 150.000 €'  when capital=5 then 'más de 150.000 €' when capital=6 then 'Otros' when capital='7' then ";
    $query = $query . "    'Pendiente Confirmar en Reunión' ";
    $query = $query . "    end as capital, ";
    $query = $query . "         case when recursos_propios=1 then '100% de la inversion' when recursos_propios=11 then '75% de inversión' when recursos_propios=2 then '50% de inversion' when recursos_propios=3 then '25% de inversion' end as recursos_propios , ";
    $query = $query . "         Fecha_Creacion, ";
    $query = $query . "         observa_expande, ";
    $query = $query . "         tf.otras_fran ";
    $query = $query . "FROM     (SELECT   s.first_name nombres, ";
    $query = $query . "                   s.last_name Ape, ";
    $query = $query . "                   s.phone_mobile as Telefono, ";
    $query = $query . "                   g.tipo_origen AS ori, ";
    $query = $query . "                   g.portal AS portal, ";
    $query = $query . "                   g.observaciones_informe obs, ";
    $query = $query . "                   s.perfil_profesional perfil, ";
    $query = $query . "                   s.rrss, ";
    $query = $query . "                   g.papel, ";
    $query = $query . "                   g.recursos_propios, ";
    $query = $query . "                   g.cuando_empezar as fechaApertura, ";
    $query = $query . "                   date_format(g.envio_documentacion,'%e/%m/%Y') AS Dossier, ";
    $query = $query . "                   date_format(g.f_recepcion_cuestionario,'%e/%m/%Y') AS Cuestionario, ";
    $query = $query . "                   date_format(g.f_informacion_adicional,'%e/%m/%Y') AS InfoAmpliada, ";
    $query = $query . "                   date_format(g.f_envio_precontrato,'%e/%m/%Y') AS Precontrato, ";
    $query = $query . "                   date_format(g.f_envio_contrato,'%e/%m/%Y') AS Contrato, ";
    $query = $query . "                   g.lnk_cuestionario as EnlaceCuestionario, ";
    $query = $query . "                   CASE WHEN g.tiponegocio1 = 1 THEN f.modNeg1 ELSE '' END AS Negocio1, ";
    $query = $query . "                   CASE WHEN g.tiponegocio2 = 1 THEN f.modNeg2 ELSE '' END AS Negocio2, ";
    $query = $query . "                   CASE WHEN g.tiponegocio3 = 1 THEN f.modNeg3 ELSE '' END AS Negocio3, ";
    $query = $query . "                   CASE WHEN g.tiponegocio4 = 1 THEN f.modNeg3 ELSE '' END AS Negocio4, ";
    $query = $query . "                   g.cuando_empezar, ";
    $query = $query . "                   s.localidad_apertura_1 , ";
    $query = $query . "                   s.provincia_apertura_1 prov, ";
    $query = $query . "                   s.perfil_profesional, ";
    $query = $query . "                   s.situacion_profesional, ";
    $query = $query . "                   s.historial_empresa, ";
    $query = $query . "                   g.inversion as capital , ";
    $query = $query . "                   g.id AS id, ";
    $query = $query . "                   s.id as sid,                   ";
    $query = $query . "                   date_format(g.date_entered,'%e/%m/%Y') as Fecha_Creacion, ";
    $query = $query . "                   s.observaciones_solicitud as observa_expande ";
    $query = $query . "          FROM     expan_gestionsolicitudes g, expan_solicitud s, ";
    $query = $query . "                   expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f ";
    $query = $query . "          WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id = ";
    $query = $query . "                     gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id='" . $this->id . "' AND f.id = ";
    $query = $query . "                     g.franquicia ";
    $query = $query . "          ORDER BY f.name) AS a ";
    $query = $query . "         LEFT JOIN tipo_origen AS t ON t.id = a.ori ";
    $query = $query . "         LEFT JOIN portales p ON portal = p.id ";
    $query = $query . "         LEFT JOIN calls c ON c.parent_id = a.id ";
    $query = $query . "         LEFT JOIN emails em ON em.parent_id = a.id ";
    $query = $query . "         LEFT JOIN (select ea.email_address, bean_id from email_addresses ea, email_addr_bean_rel er ";
    $query = $query . "                    where er.email_address_id= ea.id ) ea ON ea.bean_id= a.sid ";
    $query = $query . "         LEFT JOIN (SELECT   GROUP_CONCAT(f.name) as otras_fran,s.id ";
    $query = $query . "                    FROM     expan_gestionsolicitudes g, expan_franquicia f, expan_solicitud s, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
    $query = $query . "                    WHERE    g.franquicia = f.id AND g.id = gs.expan_soli5dcccitudes_idb AND s.id = ";
    $query = $query . "                             gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida ";
    $query = $query . "                    GROUP BY s.id) tf on sid= tf.id                                      ";
    $query = $query . "         LEFT JOIN expan_m_inversion inv ON inv.id = a.recursos_propios ";
    $query = $query . "         LEFT JOIN expan_m_perfil_fran pf ON pf.id = a.papel ";
    $query = $query . "         LEFT JOIN expan_m_provincia prov ON a.prov = prov.c_prov ";
    $query = $query . "         LEFT JOIN expan_m_municipios mun on a.localidad_apertura_1= mun.c_provmun ";
    $query = $query . "GROUP BY a.id ";
    $query = $query . "ORDER BY Provincia,nombre, Apellidos; ";


    $GLOBALS['log']->info('[ExpandeNegocio][crearTablaFichaConsultor]Consulta-' . $query);


    $solicitud = $this->GetSolicitud();


    $result = $db->query($query, true);
    $tabla = '<table border="1">
                <tbody>';

    while ($row = $db->fetchByAssoc($result)) {
      foreach ($campos as $key => $value) {
        $tabla = $tabla . "<tr>";
        $tabla = $tabla . "<td>" . $value . "</td>";
        $tabla = $tabla . "<td>" . $row[$key] . "</td>";
        $tabla = $tabla . "</tr>";
      }
    }

    $query = "SELECT   DISTINCT concat(DATE_FORMAT(Fecha,'%e/%m/%Y'),' - ', name  ) doc  ";
    $query = $query . "FROM     (SELECT n.id nid, n.name, e.date_sent fecha   ";
    $query = $query . "          FROM   expan_gestionsolicitudes g, emails e, notes n    ";
    $query = $query . "          WHERE   e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0    ";
    $query = $query . "                 AND (e.status = 'sent') AND n.parent_id = e.id AND g.id='" . $this->id . "'   ";
    $query = $query . "UNION    ";
    $query = $query . "SELECT n.id nid, n.name, e.date_sent fech   ";
    $query = $query . "FROM   emails e, email_templates et, expan_gestionsolicitudes g, notes n   ";
    $query = $query . "WHERE   g.id='" . $this->id . "' AND e.parent_id = g.id AND n.parent_id = et.id AND e.status = 'sent' AND e.deleted = 0 AND n   ";
    $query = $query . "       .deleted = 0 AND (modeloneg IS NULL OR (modeloneg = 1 AND g.tiponegocio1 = 1) OR (modeloneg = 2 AND g.tiponegocio2 = 1) OR   ";
    $query = $query . "       (modeloneg = 3 AND g.tiponegocio3 = 1) OR (modeloneg = 4 AND g.tiponegocio4 = 1)) AND e.name = replace(et.subject, \"'\", \"\")) yy    ";
    $query = $query . "ORDER BY fecha DESC ";


    $result = $db->query($query, true);

    $documentos = "";

    while ($row = $db->fetchByAssoc($result)) {
      $documentos = $documentos . $row["doc"] . "<BR>";
    }
    $tabla = $tabla . "<tr>";
    $tabla = $tabla . "<td width='200px'>Documentos</td>";
    $tabla = $tabla . "<td width='400px'>" . $documentos . "</td>";
    $tabla = $tabla . "</tr>";

    $tabla = $tabla . "</tbody>
        </table>";

    return $tabla;

  }

  public function crearTablaFichaFranquicia()
  {

    $GLOBALS['log']->info('[ExpandeNegocio][crearTablaFichaFranquicia]Entra');

    $campos = array(
      "Nombre" => "<b>Nombre</b>",
      "Apellidos" => "<b>Apellidos</b>",
      "Telefono" => "<b>Teléfono</b>",
      "email_address" => "<b>Correo</b>",
      "Provincia" => "<b>Provincia</b>",
      "Localidad" => "<b>Localidad</b>",
      "rol" => "<b>Rol en el proyecto</b>",
      "perfil_profesional" => "<b>Perfil Profesional</b>",
      "situacion_profesional" => "<b>Situacion Profesional</b>",
      "historial_empresa" => "<b>Perfil de Empresario</b>",
      "fechaApertura" => "<b>Inicio Actividad Previsto</b>",
      "capital" => "<b>Inversión máxima prevista</b>",
      "recursos_propios" => "<b>Recursos Propios disponibles</b>",
      "Observaciones" => "<b>Gestiones relacionadas</b>",
      "rrss" => "<b>Datos extraídos RRSS</b>",
      " " => "<b>Hitos de avances en gestión</b>",
      "CU" => "&emsp;&emsp;&emsp;Cuestionario",
      "IA" => "&emsp;&emsp;&emsp;Informacion ampliada",
      "PR" => "&emsp;&emsp;&emsp;Envío Precontrato",
      "CON" => "&emsp;&emsp;&emsp;Envío Contrato",
      "lnk" => "&emsp;&emsp;&emsp;Enlace al cuestionario"

    );

    $db = DBManagerFactory::getInstance();

    $query = "SELECT   nombres Nombre    ";
    $query = $query . "         , Ape Apellidos    ";
    $query = $query . "         , a.Telefono ";
    $query = $query . "         , ea.email_address ";
    $query = $query . "         , mun.d_municipio AS Localidad    ";
    $query = $query . "         , prov.d_prov Provincia                    ";
    $query = $query . "         , COALESCE(obs,'') AS 'Observaciones'    ";
    $query = $query . "         , rrss   ";
    $query = $query . "         , Cuestionario AS 'CU',    ";
    $query = $query . "         InfoAmpliada AS 'IA',              ";
    $query = $query . "         Precontrato AS 'PR',   ";
    $query = $query . "         Contrato AS 'CON',  ";
    $query = $query . "         EnlaceCuestionario as 'lnk',  ";
    $query = $query . "         case when papel=1 then 'Autoempleo' when papel=2 then 'Gestor' when papel=3 then 'Inversor' when papel=4 then 'corner' when papel=5 then 'Colaborador' else '' end as rol,    ";
    $query = $query . "         perfil_profesional,    ";
    $query = $query . "         case when situacion_profesional=1 then 'Cuenta Ajena' when situacion_profesional=2 then 'Cuenta propia' when situacion_profesional=3 then 'En busqueda' end as situacion_profesional,    ";
    $query = $query . "         replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(historial_empresa,'^FA^','Fue Autonomo'),'^FE^','Fue Empresario'),'^FF^','Fue Franquiciado'),'^EA^','Es Autonomo'),'^EE^','Es Empresario'),'^EF^','Es Franquiciado'),'^EM^','Es Multifranquiciado'),'^EB^','En Búsqueda'),'^NE^','Nunca ha tenido empresa'),'^NF^','Trabajo en negocio familiar'),'^^','')as historial_empresa,    ";
    $query = $query . "         fechaApertura,    ";
    $query = $query . "         case When capital=1 then 'menos de 20.000 €' when capital=2 then'20.000 - 50 000 €' when capital=3  then '50.000 - 90.000 €' when capital=4 then '90.000 - 150.000 €'  when capital=5 then 'más de 150.000 €' when capital=6 then 'Otros' when capital='7' then 'Pendiente Confirmar en Reunión'   end as capital,    ";
    $query = $query . "         case when recursos_propios=1 then '100% de la inversion' when recursos_propios=11 then '75% de inversión' when recursos_propios=2 then '50% de inversion' when recursos_propios=3 then '25% de inversion' end as recursos_propios   ";
    $query = $query . "FROM     (SELECT   s.first_name nombres,    ";
    $query = $query . "                   s.last_name Ape,   ";
    $query = $query . "                   s.phone_mobile as Telefono, ";
    $query = $query . "                   g.tipo_origen AS ori,    ";
    $query = $query . "                   g.portal AS portal,    ";
    $query = $query . "                   g.observaciones_informe obs,    ";
    $query = $query . "                   s.perfil_profesional perfil,   ";
    $query = $query . "                   s.rrss,  ";
    $query = $query . "                   g.papel,    ";
    $query = $query . "                   g.recursos_propios,    ";
    $query = $query . "                   g.cuando_empezar as fechaApertura,    ";
    $query = $query . "                   date_format(g.envio_documentacion,'%e/%m/%Y') AS Dossier,    ";
    $query = $query . "                   date_format(g.f_recepcion_cuestionario,'%e/%m/%Y') AS Cuestionario,  ";
    $query = $query . "                   date_format(g.f_informacion_adicional,'%e/%m/%Y') AS InfoAmpliada,      ";
    $query = $query . "                   date_format(g.f_envio_precontrato,'%e/%m/%Y') AS Precontrato,                        ";
    $query = $query . "                   date_format(g.f_envio_contrato,'%e/%m/%Y') AS Contrato,    ";
    $query = $query . "                   g.lnk_cuestionario as EnlaceCuestionario,  ";
    $query = $query . "                   CASE WHEN g.tiponegocio1 = 1 THEN f.modNeg1 ELSE '' END AS Negocio1,    ";
    $query = $query . "                   CASE WHEN g.tiponegocio2 = 1 THEN f.modNeg2 ELSE '' END AS Negocio2,    ";
    $query = $query . "                   CASE WHEN g.tiponegocio3 = 1 THEN f.modNeg3 ELSE '' END AS Negocio3,    ";
    $query = $query . "                   CASE WHEN g.tiponegocio4 = 1 THEN f.modNeg3 ELSE '' END AS Negocio4,    ";
    $query = $query . "                   g.cuando_empezar,    ";
    $query = $query . "                   s.localidad_apertura_1 ,    ";
    $query = $query . "                   s.provincia_apertura_1 prov,    ";
    $query = $query . "                   s.perfil_profesional,    ";
    $query = $query . "                   s.situacion_profesional,    ";
    $query = $query . "                   s.historial_empresa,    ";
    $query = $query . "                   g.inversion as capital ,    ";
    $query = $query . "                   g.id AS id, ";
    $query = $query . "                   s.id as sid ";
    $query = $query . "          FROM     expan_gestionsolicitudes g, expan_solicitud s,    ";
    $query = $query . "                   expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f    ";
    $query = $query . "          WHERE    g.id = gs.expan_soli5dcccitudes_idb AND s.id =    ";
    $query = $query . "                     gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id='" . $this->id . "' AND f.id =    ";
    $query = $query . "                     g.franquicia    ";
    $query = $query . "          ORDER BY f.name) AS a    ";
    $query = $query . "         LEFT JOIN tipo_origen AS t ON t.id = a.ori    ";
    $query = $query . "         LEFT JOIN portales p ON portal = p.id    ";
    $query = $query . "         LEFT JOIN calls c ON c.parent_id = a.id    ";
    $query = $query . "         LEFT JOIN emails em ON em.parent_id = a.id    ";
    $query = $query . "         LEFT JOIN (select ea.email_address, bean_id from email_addresses ea, email_addr_bean_rel er ";
    $query = $query . "                    where er.email_address_id= ea.id )  ea ON ea.bean_id= a.sid ";
    $query = $query . "         LEFT JOIN expan_m_inversion inv ON inv.id = a.recursos_propios    ";
    $query = $query . "         LEFT JOIN expan_m_perfil_fran pf ON pf.id = a.papel    ";
    $query = $query . "         LEFT JOIN expan_m_provincia prov ON a.prov = prov.c_prov    ";
    $query = $query . "         LEFT JOIN expan_m_municipios mun on a.localidad_apertura_1= mun.c_provmun             ";
    $query = $query . "GROUP BY a.id    ";
    $query = $query . "ORDER BY Provincia,nombre, Apellidos";

    $solicitud = $this->GetSolicitud();

    $GLOBALS['log']->info('[ExpandeNegocio][crearTablaFichaFranquicia]Consulta-' . $query);


    $result = $db->query($query, true);
    $tabla = '<table border="1">
                <tbody>';

    while ($row = $db->fetchByAssoc($result)) {
      foreach ($campos as $key => $value) {
        $tabla = $tabla . "<tr>";
        $tabla = $tabla . "<td>" . $value . "</td>";
        $tabla = $tabla . "<td>" . $row[$key] . "</td>";
        $tabla = $tabla . "</tr>";
      }
    }

    $query = "SELECT   DISTINCT concat(DATE_FORMAT(Fecha,'%e/%m/%Y'),' - ', name  ) doc  ";
    $query = $query . "FROM     (SELECT n.id nid, n.name, e.date_sent fecha   ";
    $query = $query . "          FROM   expan_gestionsolicitudes g, emails e, notes n    ";
    $query = $query . "          WHERE   e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0    ";
    $query = $query . "                 AND (e.status = 'sent') AND n.parent_id = e.id AND g.id='" . $this->id . "'   ";
    $query = $query . "UNION    ";
    $query = $query . "SELECT n.id nid, n.name, e.date_sent fech   ";
    $query = $query . "FROM   emails e, email_templates et, expan_gestionsolicitudes g, notes n   ";
    $query = $query . "WHERE   g.id='" . $this->id . "' AND e.parent_id = g.id AND n.parent_id = et.id AND e.status = 'sent' AND e.deleted = 0 AND n   ";
    $query = $query . "       .deleted = 0 AND (modeloneg IS NULL OR (modeloneg = 1 AND g.tiponegocio1 = 1) OR (modeloneg = 2 AND g.tiponegocio2 = 1) OR   ";
    $query = $query . "       (modeloneg = 3 AND g.tiponegocio3 = 1) OR (modeloneg = 4 AND g.tiponegocio4 = 1)) AND e.name = replace(et.subject, \"'\", \"\")) yy    ";
    $query = $query . "ORDER BY fecha DESC ";


    $result = $db->query($query, true);

    $documentos = "";

    while ($row = $db->fetchByAssoc($result)) {
      $documentos = $documentos . $row["doc"] . "<BR>";
    }
    $tabla = $tabla . "<tr>";
    $tabla = $tabla . "<td width='200px'>Documentos</td>";
    $tabla = $tabla . "<td width='400px'>" . $documentos . "</td>";
    $tabla = $tabla . "</tr>";

    $tabla = $tabla . "</tbody>
        </table>";

    return $tabla;

  }


  public function tieneApertura()
  {

    $db = DBManagerFactory::getInstance();
    $query = "select * from expan_apertura where gestion='" . $this->id . "' and deleted=0";
    $result = $db->query($query, true);

    $GLOBALS['log']->info('[ExpandeNegocio][tieneApertura]Consulta-' . $query);

    while ($row = $db->fetchByAssoc($result)) {
      return true;
    }

    return false;
  }

  public function getApertura()
  {
    $db = DBManagerFactory::getInstance();
    $query = "select id from expan_apertura where gestion='" . $this->id . "' and deleted=0";
    $result = $db->query($query, true);

    $GLOBALS['log']->info('[ExpandeNegocio][tieneApertura]Consulta-' . $query);

    while ($row = $db->fetchByAssoc($result)) {
      return $row["id"];
    }

    return '';
  }

  public function crearTablaRespuesta()
  {

    $tabla = '<br><br><p>Una vez acabada la reunión, le solicitamos que nos comunique en un plazo de 24 horas los detalles más relevantes 
      			de la reunión/conversación para que podamos seguir gestionando al candidato lo antes posible. Para ello le rogamos 
      			nos reenvíe este correo contestando estos asuntos que necesitamos saber: (EN el caso de que el campo no 
      			haya sido cumplimentado, entendemos que no hay nada relevante a ese respecto)</p><br>      			            	
      	<table border="1">
                <tbody>';

    $tabla = $tabla . '<tr><td width="40%">1. Percepción del perfil del franquiciado ¿Te encaja como franquiciado?</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">2. Otros aspectos a tener en cuenta del candidato relevantes no presentes en la ficha.</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">3. Percepción del grado de interés del candidato (% de posibilidad de apertura</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">4. Fecha de apertura aproximada (si la hubiese)</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">5. Preguntas pendientes de resolver (Por central o ExpandeNegocio).</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">6. Solicitudes o concesiones (concedidas o no).</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">7. Objeciones del candidato al modelo de negocio.</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%">8. EN que se ha quedado con el candidato</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%" style="padding-left: 4em;">Tareas para central</td><td width="60%"></td></tr>';
    $tabla = $tabla . '<tr><td width="40%" style="padding-left: 4em;">Tareas para ExpandeNegocio</td><td width="60%"></td></tr>';


    $tabla = $tabla . "</tbody>
        </table>";

    return $tabla;
  }
}

?>