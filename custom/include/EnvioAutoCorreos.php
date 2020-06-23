<?php
//Definimos el receptor
require_once('include/SugarPHPMailer.php');
require_once('modules/Emails/Email.php');
require_once('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once('modules/EmailTemplates/EmailTemplate.php');
require_once('modules/Notes/Note.php');

class EnvioAutoCorreos
{

  const MARC_NOMBRE = '#nombre#';
  const MARC_APELLIDO = '#apellidos#';
  const MARC_EMAIL = '#email#';
  const MARC_MOVIL = '#movil#';
  const MARC_FRANQUICIA = '#franquicia#';
  const MARC_FRANQUICIA_ID = '#franquiciaid#';
  const MARC_TABLA = '#tabla#';
  const MARC_BODY = '#body#';
  const MARC_GESTION_ID ='#gestionid#';
  const MARC_SOLICITUD_ID ='#solicitudid#';

  const USUARIOS_POR_CORREO = 1;

  function rellenaCorreoCx($idTemp, $solicitud, $fran, $gestion)
  {
    if ($gestion->estado_sol == Expan_GestionSolicitudes::ESTADO_POSITIVO &&
      $gestion->motivo_positivo == Expan_GestionSolicitudes::POSITIVO_CONTRATO) {
      return "Ya franquiciado";
    }

    if ($gestion->estado_sol == Expan_GestionSolicitudes::ESTADO_DESCARTADO) {
      return "Descartado";
    }

    $rcpt_name = $solicitud->first_name . ' ' . $solicitud->last_name;

    $sea = new SugarEmailAddress;
    $addresses = $sea->getAddressesByGUIDClean($solicitud->id, 'Expan_Solicitud');

    if ( $solicitud->contacto_secundario|= null &&  $solicitud->contacto_secundario!=''){
      $addresses[$solicitud->correo_secundario] = $solicitud->contacto_secundario;
    }

    if (count($addresses)==0){
      return "SinCorreoValido";
    }

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Num Direcciones de correo-' . count($addresses));

    $emailTemp = new EmailTemplate();
    $emailTemp->disable_row_level_security = true;
    $emailTemp->retrieve($idTemp);

    $subject = $this->modificaMarcas($solicitud, $gestion, '', from_html($emailTemp->subject));
    $body = $this->modificaMarcas($solicitud, $gestion, '', from_html($emailTemp->body_html));

    $fromName = $fran->name;

    global $current_user;
    $current_user = new User();
    $current_user->getSystemUser();
    $cuentaCor = new OutboundEmail();
    $cuentaCor = $cuentaCor->getMailerByName($current_user, $fran->correo_envio);

    $mail = $this->sendMessageV2($rcpt_name, $addresses, $subject, $body, $fromName, $cuentaCor, $idTemp);

    if (!$mail->Send()) {
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]ERROR: El envio del correo ha fallado - ' . $mail->ErrorInfo);
      return "Error";
    } else {
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]El envio del correo ha funcionado');
      if ($gestion != '') {
        $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Almacena el correo-' . $gestion->id);
        foreach ($addresses as $key => $value) {
          $rcpt_email = $addresses[$key]['email_address'];
        }
        $this->almacenarCorreo($mail, $rcpt_email, $gestion, "Expan_GestionSolicitudes");
      }
      return "Ok";
    }
  }

  function modificaMarcas($solicitud, $gestion, $tabla, $text)
  {
    $text = str_replace("%23","#",  $text);
    $text = str_replace(self::MARC_GESTION_ID, $gestion->id, $text);
    $text = str_replace(self::MARC_SOLICITUD_ID, $solicitud->id, $text);
    $text = str_replace(self::MARC_NOMBRE, $solicitud->first_name ?: '', $text);
    $text = str_replace(self::MARC_APELLIDO, $solicitud->last_name ?: '', $text);
    $text = str_replace(self::MARC_MOVIL, $solicitud->phone_mobile ?: '', $text);
    $text = str_replace(self::MARC_TABLA, $tabla, $text);

    $sea = new SugarEmailAddress();
    $addresses = $sea->getAddressesByGUIDClean($solicitud->id, 'Expan_Solicitud');

    $dir = '';
    if (count($addresses) != 0) {
      $dir = $addresses[0]['email_address'];
    }
    $text = str_replace(self::MARC_EMAIL, $dir, $text);

    $franquicia = new Expan_Franquicia();
    $franquicia->retrieve($gestion->id);

    $text = str_replace(self::MARC_FRANQUICIA_ID, $franquicia->id, $text);
    $text = str_replace(self::MARC_FRANQUICIA, $franquicia->name, $text);

    return $text;
  }

  function sendMessageV2($rcpt_name, $addresses, $subject, $body, $fromName, $cuentaCor, $idTemp)
  {
    $mail = new SugarPHPMailer();
    $emailObj = new Email();
    $defaults = $emailObj->getSystemDefaultEmail();
    $mail->From = $defaults['email'];
    $mail->FromName = $defaults['name'];
    $mail->ClearAllRecipients();
    $mail->ClearReplyTos();

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Antes recorres Adreses');

    foreach ($addresses as $key => $value) {
      $rcpt_email = $addresses[$key]['email_address'];
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Correo envío-' . $rcpt_email);
      $mail->AddAddress($rcpt_email, $rcpt_name);
    }
    $mail->Subject = $subject;
    $mail->Body_html = $body;
    $mail->Body = wordwrap($body, 900);
    $mail->IsHTML(true);
    //Omit or comment out this line if plain text

    //Attachments
    $note = new Note();

    $where = "notes.parent_id = '" . $idTemp . "'";
    $attach_list = $note->get_full_list("", $where, true);
    //Get all Notes entries associated with email template
    $attachments = array();
    if (count($attach_list) > 0) {
      $attachments = array_merge($attachments, $attach_list);
    }

    foreach ($attachments as $attached) {
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Recoge Attach');
      $filename = $attached->filename;
      $file_location = 'upload/' . $attached->id;
      $mime_type = $attached->file_mime_type;
      $mail->AddAttachment($file_location, $filename, 'base64', $mime_type);
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Id del email-'.$emailObj->id);

      //Attach each file to message
    }
    $mail->notes=$attachments;

    $mail->FromName = $fromName;

    if ($cuentaCor == null) {
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Cuenta Correo no definida->Cuenta defecto');
    } else {
      $mail->IsSMTP();
      $mail->SMTPDebug = 1;
      $mail->SMTPAuth = true;
      $mail->From = $cuentaCor->name;
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]From:' . $cuentaCor->name);

      $mail->AddReplyTo = $cuentaCor->name;
      $mail->Username = $cuentaCor->mail_smtpuser;
      $mail->Password = $cuentaCor->mail_smtppass;
      $mail->Host = $cuentaCor->mail_smtpserver;
      $mail->Port = $cuentaCor->mail_smtpport;
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Puerto:' . $cuentaCor->mail_smtpport);
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]tipoSSL:' . $cuentaCor->mail_smtpssl);
      if ($cuentaCor->mail_smtpssl == 1) {
        $mail->SMTPSecure = 'ssl';
        $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Es SSL');
      } else if ($cuentaCor->mail_smtpssl == 2) {
        $mail->SMTPSecure = 'tls';
        $GLOBALS['log']->info('[ExpandeNegocio][Envio correosV2]Es TLS');
      }
      $mail->prepForOutbound();
    }

    return $mail;
  }

  function  almacenarCorreo($mail, $toAdd, $bean, $module)
  {
    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]Entra');
    $db = DBManagerFactory::getInstance();
    $emailUID = create_guid();
    //Debemos insertar el correo
    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]Antes consulta');
    $query = "Insert emails (id,date_entered,date_modified,assigned_user_id,modified_user_id,created_by,
                                    deleted,date_sent,name,type,status,intent,parent_type,parent_id)
                    VALUES ('" . $emailUID . "', '" . TimeDate::getInstance()->nowDb() . "','" . TimeDate::getInstance()->nowDb() . "','"
      . $GLOBALS['current_user']->id . "','" . $GLOBALS['current_user']->id . "','"
      . $GLOBALS['current_user']->id . "',0,'" . TimeDate::getInstance()->nowDb() . "','" . str_replace("'", "", $mail->Subject) . "','archived','sent','pick','" . $module . "','" . $bean->id . "')";
    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]Insercion Correo-' . $query);
    $db->query($query);
    //Debemos insertar el texto del correo
    $query = "Insert emails_text (email_id,from_addr,reply_to_addr,to_addrs,description,description_html,deleted) ";
    $query = $query . "VALUES ('" . $emailUID . "','" .
      $mail->From . "','" .
      $mail->From . "','" .
      $toAdd . "','" .
      $db->quote($mail->Body) . "','" .
      $db->quote($mail->Body_html) .
      "',0)";
    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]Insercion Correo Mensaje-' . $query);
    $db->query($query);

    $attachments=$mail->notes;

    foreach ($attachments as $attached) {
      $this->registrarAdjuntos($emailUID,$attached->id);
    }

    return $emailUID;
  }

  function registrarAdjuntos($id_email,$id_note){
    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]Entra');
    $db = DBManagerFactory::getInstance();
    $adjuntolUID = create_guid();
    $date = TimeDate::getInstance()->nowDb();

    $query="insert into expan_adjuntos (id,id_email,id_note,f_envio) values ('$adjuntolUID','$id_email','$id_note','$date')";

    $GLOBALS['log']->info('[ExpandeNegocio][Insercion Correos]registrarAdjuntos-'.$query);

    $db->query($query);
  }

  function rellenacorreoFicha($tempType, $tipoEnv, $rcpt_name, $addresses, $solicitud, $fran, $gestion, $apertura)
  {
    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Entrada funcion');

    $idTemp = $this->getTemplateID($tempType, "");

    $emailTemp = new EmailTemplate();
    $emailTemp->disable_row_level_security = true;
    $emailTemp->retrieve($idTemp);

    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]idTemp-' . $idTemp);
    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]idTemp-' . $emailTemp->body_html);

    switch ($tempType) {

      case "FA":
        if ($tipoEnv == "franq") {
          $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Envio a Franquicia');
          $tabla = $gestion->crearTablaFichaFranquicia();
        }else if ($tipoEnv =="intermedia"){
          $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Envio a Franquicia');
          $tabla = $gestion->crearTablaFichaIntermedia();
        } else {
          $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Envio a Consultor');
          $tabla = $gestion->crearTablaFichaConsultor();
        }
        break;
      case "FR":
        if ($tipoEnv == "franq") {
          $tabla = $gestion->crearTablaFichaFranquicia();
        }else if ($tipoEnv =="intermedia"){
          $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Envio a Franquicia');
          $tabla = $gestion->crearTablaFichaIntermedia();
        } else {
          $tabla = $gestion->crearTablaFichaConsultor();
        }
        break;
      case "FPC":
        $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Correo Envio-' . $rcpt_name);
        $tabla = $gestion->crearTablaEntregaCuentaPrecontrato($rcpt_name == "Administracion ExpandeNegocio");
        break;
      case "FC":
        $tabla = $apertura->crearTablaEntregaCuentaContrato($rcpt_name == "Administracion ExpandeNegocio");
        break;
    }

    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]idTemp-' . $emailTemp->body_html);

    $subject = $this->modificaMarcas($solicitud, $gestion, '', from_html($emailTemp->subject));
    $body = $this->modificaMarcas($solicitud, $gestion, $tabla, from_html($emailTemp->body_html));

    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Body' . $body);

    $GLOBALS['log']->info('[ExpandeNegocio][Rellenar Correos Ficha]Antes Envío mensaje' . $addresses['email_address']);

    $current_user = new User();
    $current_user->getSystemUser();
    $cuentaCor = new OutboundEmail();
    $cuentaCor = $cuentaCor->getMailerByName($current_user, $fran->correo_envio);

    $mail = $this->sendMessageV2($rcpt_name, $addresses, $subject, $body, "info@expandenegocio.com", $cuentaCor, $idTemp);

    if (!$mail->Send()) {
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]ERROR: El envio del correo ha fallado - ' . $mail->ErrorInfo);
      return "Error";
    } else {
      foreach ($addresses as $key => $value) {
        $rcpt_email = $addresses[$key]['email_address'];
        $this->almacenarCorreo($mail, $rcpt_email, $gestion, "Expan_GestionSolicitudes");
      }
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Todo Ok');
      return "Ok";
    }
  }

  function getTemplateID($tipoTemplate, $franquicia)
  {
    $db = DBManagerFactory::getInstance();

    if ($franquicia != '') {
      $query = "select id from email_templates where deleted=0 AND type='" . $tipoTemplate . "' AND franquicia='" . $franquicia . "' AND deleted=0";
    } else {
      $query = "select id from email_templates where deleted=0 AND type='" . $tipoTemplate . "' AND deleted=0";
    }

    $result = $db->query($query, true);

    $tempId = "";

    while ($row = $db->fetchByAssoc($result)) {
      $tempId = $row['id'];
    }
    return $tempId;
  }

  function envioCorreosMailing($listaCorreos,$listaSol, $idTemplate, $cuerpo, $idMailing)
  {
    $mailing = new Expma_Mailing();
    $mailing->retrieve($idMailing);

    $listaSalida = array();
    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]ID Template-' . $idTemplate);

    global $current_user;
    $current_user = new User();
    $current_user->getSystemUser();

    $emailTemp = new EmailTemplate();
    $emailTemp->disable_row_level_security = true;
    $emailTemp->retrieve($idTemplate);

    $idFran = $emailTemp->franquicia;
    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]ID fran-' . $idFran);

    $arrayCorreos = array();

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Num correos-' . count($listaCorreos));

    for ($i=0; $i<count($listaCorreos);++$i){

      $bccer = $listaCorreos[$i];
      $idSol = $listaSol[$i];

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]$bccer-' . $bccer);
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]iDsOL-' . $idSol);

      $solicitud= new Expan_Solicitud();
      $solicitud->retrieve($idSol);
      $gestion=$solicitud->getGestionFromFranID($idFran);

      $subject = $this->modificaMarcas($solicitud, $gestion, '', from_html($emailTemp->subject));
      $tempFinal = $this->modificaMarcas($solicitud, $gestion, $tabla, from_html($emailTemp->body_html));

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Tipo Temp-' . $emailTemp->getFieldValue('type'));

      if ($this->noLanzaMailingModNegocio(strtoupper($bccer)) == true) {
        continue;
      }

      $mail = new SugarPHPMailer();
      $emailObj = new Email();
      $defaults = $emailObj->getSystemDefaultEmail();

      //Utilizamos la cuenta por defecto o la de la franquicia
      if ($idFran == null) {
        $mail->From = $defaults['email'];
        $mail->FromName = $defaults['name'];
      } else {
        $fran = new Expan_Franquicia();
        $fran->retrieve($idFran);
        $cuentaCor = new OutboundEmail();
        $cuentaCor = $cuentaCor->getMailerByName($current_user, $fran->correo_envio);
        if ($cuentaCor == false) {
          $mail->From = $defaults['email'];
          $mail->FromName = $defaults['name'];
        } else {
          $mail->From = $cuentaCor->name;
          $mail->FromName = $fran->name;
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPDebug = true;
          $mail->AddReplyTo = $cuentaCor->name;
          $mail->Username = $cuentaCor->mail_smtpuser;
          $mail->Password = $cuentaCor->mail_smtppass;
          $mail->Host = $cuentaCor->mail_smtpserver;
          $mail->Port = $cuentaCor->mail_smtpport;
          $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Puerto:' . $cuentaCor->mail_smtpport);
          $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]tipoSSL:' . $cuentaCor->mail_smtpssl);
          if ($cuentaCor->mail_smtpssl == 1) {
            $mail->SMTPSecure = 'ssl';
            $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Es SSL');
          } else if ($cuentaCor->mail_smtpssl == 2) {
            $mail->SMTPSecure = 'tls';
            $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Es TLS');
          }
          $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Direccion-' . $mail->From);
        }
      }
      $mail->ClearAllRecipients();
      $mail->ClearReplyTos();
      /*Añadimos en copia oculta todas las direcciones recogidas*/
      //    $mail->AddBCC('crm@expandenegocio.com','CRM');
      $mail->Subject = $subject;

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Cuerpo-' . $cuerpo);
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]templateAntes-' . $emailTemp->body_html);
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]templateDespues-' . $tempFinal);

      $mail->Body_html = from_html($tempFinal);
      $mail->Body = wordwrap($tempFinal, 900);
      $mail->IsHTML(true);
      //Omit or comment out this line if plain text
      //Attachments
      $note = new Note();
      $where = "notes.parent_id = '" . $idTemplate . "'";
      $attach_list = $note->get_full_list("", $where, true);
      //Get all Notes entries associated with email template
      $attachments = array();
      $attachments = array_merge($attachments, $attach_list);
      foreach ($attachments as $attached) {
        $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Recoge Attach');
        $filename = $attached->filename;
        $file_location = 'upload/' . $attached->id;
        $mime_type = $attached->file_mime_type;
        $mail->AddAttachment($file_location, $filename, 'base64', $mime_type);
        //Attach each file to message
      }
      $mail->notes=$attachments;

      $mail->AddBCC($bccer);
      $arrayCorreos[] = "'" . strtoupper($bccer) . "'";

      $mail->prepForOutbound();
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]CorreoEnviado:' . $cuentaCor->mail_smtpport);

      //Enviamos el correo
      if ($mail->Send()) {
        $this->marcarEnviadoMailing(implode(",", $arrayCorreos), $idMailing);
        if ($mailing->guardar_correo == 1) {
          $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Entra Asociar Correo');
          $textoMail = $mailing->texto_informe . " - " . $mailing->name;
          $this->asociarCorreoSolicitudes(implode(",", $arrayCorreos), $fran, $mail, $textoMail);
        }
      } else {
        $this->marcarNoEnviadoMailing(implode(",", $arrayCorreos), $idMailing);
      }

      //limpiamos las variables
      $mail->ClearBCCs();
      unset($arrayCorreos);
      //Guardamos los datos del email

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Antes Guardar Mailing');
      $mailing->actualizarMailing();
      $mailing->ignore_update_c = true;
      $mailing->save();
      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Después Guardar Mailing');
    }

    echo "Ok";
    // $mail->setMailerForSystem();
  }

  public function marcadoProtocolo($idMailing)
  {
    $db = DBManagerFactory::getInstance();

    $mailing= new Expma_Mailing();
    $mailing->retrieve($idMailing);

    if ($mailing->envio_todos==true){
      $query = "UPDATE expma_mailing_expan_solicitud_c c   ";
      $query = $query . "       INNER JOIN   ";
      $query = $query . "       (SELECT s.id AS id  ";
      $query = $query . "FROM expma_mailing_expan_solicitud_c ms,  ";
      $query = $query . "     expan_solicitud s,  ";
      $query = $query . "     expan_solicitud_cstm cs,  ";
      $query = $query . "     expma_mailing m, ";
      $query = $query . "     email_templates et ";
      $query = $query . "WHERE     ms.expma_mailing_expan_solicitudexpan_solicitud_idb = s.id  ";
      $query = $query . "      AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = '" . $idMailing . "'  ";
      $query = $query . "      AND m.plantilla=et.id ";
      $query = $query . "      AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = m.id  ";
      $query = $query . "      AND cs.id_c = s.id  ";
      $query = $query . "      AND (cs.no_correos_c = 1 OR (coalesce(et.franquicia,null,'')!='' AND s.positiva = 1))) a   ";
      $query = $query . "         ON a.id = c.expma_mailing_expan_solicitudexpan_solicitud_idb   ";
      $query = $query . "SET    motivo_no_envio = 'Por protocolo'   ";
      $query = $query . "WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '" . $idMailing . "' ; ";
    }else{

      $query = "UPDATE expma_mailing_expan_solicitud_c c   ";
      $query = $query . "       INNER JOIN   ";
      $query = $query . "       (SELECT s.id AS id  ";
      $query = $query . "FROM expma_mailing_expan_solicitud_c ms,  ";
      $query = $query . "     expan_solicitud s,  ";
      $query = $query . "     expan_solicitud_cstm cs,  ";
      $query = $query . "     expma_mailing m, ";
      $query = $query . "     email_templates et ";
      $query = $query . "WHERE     ms.expma_mailing_expan_solicitudexpan_solicitud_idb = s.id  ";
      $query = $query . "      AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = '" . $idMailing . "'  ";
      $query = $query . "      AND m.plantilla=et.id ";
      $query = $query . "      AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = m.id  ";
      $query = $query . "      AND cs.id_c = s.id  ";
      $query = $query . "      AND (cs.no_correos_c = 1 OR ";
      $query = $query . "          (tipo_origen like '%4%' AND s.franquicia_principal!=et.franquicia) OR ";
      $query = $query . "          (coalesce(et.franquicia,null,'')!='' AND s.positiva = 1) OR ";
      $query = $query . "          (coalesce(et.franquicia,null,'')!='' AND s.cerrada = 1))) a   ";
      $query = $query . "         ON a.id = c.expma_mailing_expan_solicitudexpan_solicitud_idb   ";
      $query = $query . "SET    motivo_no_envio = 'Por protocolo'   ";
      $query = $query . "WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '" . $idMailing . "' ; ";

    }

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]marcadoProtocolo:' . $query);

    $db->query($query);
  }

  public function marcadoNovalido($idMailing){
    $db = DBManagerFactory::getInstance();

    $query = "UPDATE expma_mailing_expan_solicitud_c  ";
    $query=$query."SET enviado=0, motivo_no_envio = 'Correo no valido/Rehusado'  ";
    $query=$query."WHERE  ";
    $query=$query."   expma_mailing_expan_solicitudexpma_mailing_ida= '" . $idMailing . "' AND  ";
    $query=$query."   expma_mailing_expan_solicitudexpan_solicitud_idb IN   ";
    $query=$query."    (SELECT r.bean_id  ";
    $query=$query."    FROM email_addr_bean_rel r,email_addresses e  ";
    $query=$query."    WHERE  ";
    $query=$query."     e.id = r.email_address_id AND e.deleted=0 AND (e.invalid_email=1 OR e.opt_out=1) AND ";
    $query=$query."     e.deleted=0 AND r.deleted=0) ; ";


    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]marcadoNovalido:' . $query);

    $db->query($query);
  }

  public function marcarDummies($idMailing)
  {
    $db = DBManagerFactory::getInstance();

    $query = "UPDATE expma_mailing_expan_solicitud_c  ";
    $query = $query . "SET enviado=0, motivo_no_envio = 'Dummie'  ";
    $query = $query . "WHERE  ";
    $query = $query . "   expma_mailing_expan_solicitudexpma_mailing_ida= '" . $idMailing . "' AND  ";
    $query = $query . "   expma_mailing_expan_solicitudexpan_solicitud_idb IN   ";
    $query = $query . "    (SELECT id FROM expan_solicitud WHERE dummie=1) ";

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]marcadoDummies:' . $query);

    $db->query($query);
  }

  function noLanzaMailingModNegocio($mail)
  {
    $db = DBManagerFactory::getInstance();

    $query = "SELECT nomail_modNeg1,nomail_modNeg2,nomail_modNeg3,nomail_modNeg4 ";
    $query = $query . "FROM   email_addresses ea, email_addr_bean_rel er, expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f ";
    $query = $query . "WHERE  ea.id = er.email_address_id AND s.id = er.bean_id AND s.id = ";
    $query = $query . "         gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND g.id = gs.expan_soli5dcccitudes_idb AND g.deleted = ";
    $query = $query . "       0 AND g.franquicia = f.id AND ea.email_address_caps = '" . $mail . "'";

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos][lanzaMailingModNegocio]Consulta-' . $query);

    $result = $db->query($query, true);

    $resp = false;

    while ($row = $db->fetchByAssoc($result)) {

      if ($row["nomail_modNeg1"] == 1 || $row["nomail_modNeg2"] == 1 ||
        $row["nomail_modNeg3"] == 1 || $row["nomail_modNeg4"] == 1) {
        $resp = true;
      }

    }
    return $resp;
  }

  function marcarEnviadoMailing($listaMail, $idMailing)
  {
    $db = DBManagerFactory::getInstance();

    $query = "UPDATE expma_mailing_expan_solicitud_c ";
    $query = $query . "SET enviado = 1, motivo_no_envio=null ";
    $query = $query . "WHERE ";
    $query = $query . "   expma_mailing_expan_solicitudexpma_mailing_ida= '" . $idMailing . "' AND ";
    $query = $query . "   expma_mailing_expan_solicitudexpan_solicitud_idb IN  ";
    $query = $query . "    (SELECT r.bean_id ";
    $query = $query . "    FROM email_addr_bean_rel r,email_addresses e ";
    $query = $query . "    WHERE ";
    $query = $query . "     e.id = r.email_address_id AND motivo_no_envio is NULL AND ";
    $query = $query . "     e.email_address_caps in ( " . $listaMail . ") and e.deleted=0 AND r.deleted=0); ";

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]marcarEnviadoMailing:' . $query);

    $db->query($query);
  }

  function asociarCorreoSolicitudes($listaCorr, $fran, $mail, $texto)
  {
    $db = DBManagerFactory::getInstance();

    $query = "  SELECT g.id id,e.email_address em ";
    $query = $query . "FROM ";
    $query = $query . "  expan_gestionsolicitudes g, ";
    $query = $query . "  expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
    $query = $query . "  email_addr_bean_rel r, ";
    $query = $query . "  email_addresses e ";
    $query = $query . "WHERE ";
    $query = $query . "  g.franquicia = '" . $fran->id . "' AND ";
    $query = $query . "  gs.expan_soli5dcccitudes_idb = g.id AND ";
    $query = $query . "  gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida =r.bean_id AND ";
    $query = $query . "  e.id =r.email_address_id AND e.deleted=0 AND r.deleted=0 AND g.deleted=0 and gs.deleted=0  AND ";
    $query = $query . "  e.email_address_caps IN (" . $listaCorr . ")";

    $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]asociarCorreoSolicitudes:' . $query);

    $resultSol = $db->query($query, true);

    while ($rowSol = $db->fetchByAssoc($resultSol)) {

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Entra bucle');
      //tenemos que recoger las gestiones asociadas

      $gestion = new Expan_GestionSolicitudes();
      $gestion->retrieve($rowSol["id"]);

      $correo = $rowSol["em"];

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]Gestion-' . $gestion->id);

      $emailId=$this->almacenarCorreo($mail, $correo, $gestion, "Expan_GestionSolicitudes");

      $gestion->addFechaObserva("[Mailing]" . $texto, true);
      $gestion->ignore_update_c = true;
      $gestion->save();
    }
  }

  function marcarNoEnviadoMailing($listaMail, $idMailing)
  {
    if ($listaMail != '') {
      $db = DBManagerFactory::getInstance();

      $query = "UPDATE expma_mailing_expan_solicitud_c ";
      $query = $query . "SET enviado=0, motivo_no_envio = 'No se ha podido enviar' ";
      $query = $query . "WHERE ";
      $query = $query . "   expma_mailing_expan_solicitudexpma_mailing_ida= '" . $idMailing . "' AND ";
      $query = $query . "   expma_mailing_expan_solicitudexpan_solicitud_idb IN  ";
      $query = $query . "    (SELECT r.bean_id ";
      $query = $query . "    FROM email_addr_bean_rel r,email_addresses e ";
      $query = $query . "    WHERE ";
      $query = $query . "     e.id = r.email_address_id AND e.deleted=0 AND ";
      $query = $query . "     e.email_address_caps in ( " . $listaMail . ") and e.deleted=0 AND r.deleted=0); ";

      $GLOBALS['log']->info('[ExpandeNegocio][Envio correos]marcarNoEnviadoMailing:' . $query);

      $db->query($query);
    }
  }
}