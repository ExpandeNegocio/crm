<?php

//Definimos el receptor
require_once ('include/SugarPHPMailer.php');
require_once ('modules/Emails/Email.php');
require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
require_once ('modules/EmailTemplates/EmailTemplate.php');
require_once ('modules/Notes/Note.php');

class EnvioAutoCorreos {
    
    const MARC_NOMBRE = '#nombre#';
    const MARC_APELLIDO = '#apellidos#';
    const MARC_EMAIL = '#email#';
    const MARC_MOVIL = '#movil#';
    const MARC_GESTION= '#idgestion#';

    function sendMessage(&$bean, $gestion, $idTemp, $fran) {
        
        //Comprobamos si la solicitud es cerrda o positiva
        
        if ($gestion->estado_sol==Expan_GestionSolicitudes::ESTADO_POSITIVO &&
            $gestion->motivo_positivo==Expan_GestionSolicitudes::POSITIVO_FRANQUICIADO){
            return "Ya franquiciado"; 
        }
            
        if ($gestion->estado_sol==Expan_GestionSolicitudes::ESTADO_DESCARTADO){
            return "Descartado"; 
        }
        
        if ($bean->no_correos_c==1){
            return "No se puede enviar a esta solicitud"; 
        }

        //Recogemos el template

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Entra');

        $emailTemp = new EmailTemplate();
        $emailTemp -> disable_row_level_security = true;
        $emailTemp -> retrieve($idTemp);

        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> ClearAllRecipients();
        $mail -> ClearReplyTos();

        $rcpt_name = $bean -> first_name . ' ' . $bean -> last_name;

        /*Recorremos todas las direcciones de correo de la solicitud*/
        $sea = new SugarEmailAddress;

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]C' . $bean -> id . '-');
        $addresses = $sea -> getAddressesByGUID($bean -> id, 'Expan_Solicitud');

        foreach ($addresses as $address) {

            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Correo de recepcion - ' . $address['email_address']);

            $rcpt_email = $address['email_address'];

            $mail -> AddAddress($rcpt_email, $rcpt_name);
            //  $mail->AddBCC('crm@expandenegocio.com','CRM');
            $mail -> Subject = from_html($emailTemp -> subject);
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuerpo de la plantilla - ' . $emailTemp -> body_html);
            $mail -> Body_html = $this->modificaMarcas($bean,$gestion, from_html($emailTemp -> body_html));
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuerpo del correo - ' . $mail -> Body_html);
            
            $mail -> Body = wordwrap($this->modificaMarcas($bean, $gestion, from_html($emailTemp -> body_html)), 900);
            $mail -> IsHTML(true);
            //Omit or comment out this line if plain text

            //Attachments
            $note = new Note();
            $where = "notes.parent_id = '" . $idTemp . "'";
            $attach_list = $note -> get_full_list("", $where, true);
            //Get all Notes entries associated with email template

            $attachments = array();
            $attachments = array_merge($attachments, $attach_list);

            foreach ($attachments as $attached) {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Recoge Attach');

                $filename = $attached -> filename;
                $file_location = 'upload/' . $attached -> id;
                $mime_type = $attached -> file_mime_type;
                $mail -> AddAttachment($file_location, $filename, 'base64', $mime_type);
                //Attach each file to message
            }

            $mail -> FromName = $fran -> name;
            $mail -> IsHTML(true);

            //$mail->From=$fran->correo_envio;

            //Recogemos la cuenta con la que enviamos los correos
            global $current_user;
            $current_user = new User();
            $current_user -> getSystemUser();

            $cuentaCor = new OutboundEmail();
            $cuentaCor = $cuentaCor -> getMailerByName($current_user, $fran -> correo_envio);

            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo-' . $fran -> correo_envio);

            if ($cuentaCor == false) {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo no definida->Cuenta defecto');

            } else {
                $mail -> IsSMTP();
                $mail -> SMTPDebug = 1;
                $mail -> SMTPAuth = true;
                $mail -> From = $cuentaCor -> name;

                $mail -> Username = $cuentaCor -> mail_smtpuser;
                $mail -> Password = $cuentaCor -> mail_smtppass;
                $mail -> Host = $cuentaCor -> mail_smtpserver;
                $mail -> Port = $cuentaCor -> mail_smtpport;

                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Puerto:' . $cuentaCor -> mail_smtpport);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]tipoSSL:' . $cuentaCor -> mail_smtpssl);
                if ($cuentaCor -> mail_smtpssl == 1) {
                    $mail -> SMTPSecure = 'ssl';
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Es SSL');
                } else if ($cuentaCor -> mail_smtpssl == 2) {
                    $mail -> SMTPSecure = 'tls';
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Es TLS');
                }

                $mail -> prepForOutbound();

            }

            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]LLega aqui');

            if (!$mail -> Send()) {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]ERROR: El envio del correo ha fallado - ' . $mail -> ErrorInfo);
                return "Error";
            } else {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]El envio del correo ha funcionado');
                if ($gestion != '') {
                    $this -> almacenarCorreo($mail, $rcpt_email, $gestion, "Expan_GestionSolicitudes");
                }
                return "Ok";
            }
        }
    }
/*
    function preparaCorreosEvento($listaCorreos, $idFran,$cuerpo) {

        //Recogemos el objeto fraqnuicia

        $Fran = new Expan_Franquicia();
        $Fran -> retrieve($gestion -> $idFran);

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envios Evento Envio Correo] Nombre de la franquicia - ' . $Fran -> name);

        $db = DBManagerFactory::getInstance();

        //Creamos la consulta para localizar el id del template correspondiente

        $query = "select id from email_templates where type='" . $Fran -> name . "#EVENTO' AND deleted=0";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envios Evento Envio Correo] Query correo - ' . $query);
        $result = $db -> query($query, true);

        $idTeplate = "";

        while ($row = $db -> fetchByAssoc($result)) {
            $idTeplate = $row["id"];
        }

        if ($idTeplate != "") {
            $envioCorreos = new EnvioAutoCorreos();
            $envioCorreos -> sendMessage($listaCorreos, '', $idTeplate, $Fran);
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envios Evento Envio Correo] Enviando correo.');
        }
    }
*/

    function modificaMarcas($solicitud,$gestion, $texto){
        
       $text= str_replace(self::MARC_NOMBRE,$solicitud->first_name,$texto);
       $text= str_replace(self::MARC_APELLIDO,$solicitud->last_name,$text);
             
       $sea = new SugarEmailAddress;       
       $addresses = $sea -> getAddressesByGUID($solicitud -> id, 'Expan_Solicitud');
    
       $dir='';
        if (count($addresses)!=0){
            $dir=$addresses[0]['email_address'];
        }
    
       $text= str_replace(self::MARC_EMAIL,$dir,$text);
       
       $text= str_replace(self::MARC_MOVIL,$solicitud->phone_mobile,$text);
       $text= str_replace(self::MARC_GESTION, $gestion->id ,$text);
              
       return $text;
                
    }

    function envioCorreosMailing($listaCorreos, $idTemplate,$cuerpo,$idMailing) {               
        
        $mailing=new Expma_Mailing();
        $mailing-> retrieve($idMailing);
        
        $listaSalida=array();

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]ID Template-' . $idTemplate);

        $emailTemp = new EmailTemplate();
        $emailTemp -> disable_row_level_security = true;
        $emailTemp -> retrieve($idTemplate);

        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Tipo Temp-' . $emailTemp -> getFieldValue('type'));

        $idFran = $this -> recogeFranquiciaPorPlantilla($emailTemp -> type);
        
        //Marcamos las que sabemos que no podemos enviar por protocolo
        
        $this->marcadoProtocolo($idMailing,$idFran);

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]ID fran-' . $idFran);

        //Utilizamos la cuenta por defecto o la de la franquicia
        if ($idFran == null) {
            $mail -> From = $defaults['email'];
            $mail -> FromName = $defaults['name'];
        } else {

            $fran = new Expan_Franquicia();
            $fran -> retrieve($idFran);

            global $current_user;
            $current_user = new User();
            $current_user -> getSystemUser();

            $cuentaCor = new OutboundEmail();
            $cuentaCor = $cuentaCor -> getMailerByName($current_user, $fran -> correo_envio);

            if ($cuentaCor == false) {
                $mail -> From = $defaults['email'];
                $mail -> FromName = $defaults['name'];
            } else {
                $mail -> From = $cuentaCor -> name;
                $mail -> FromName = $fran -> name;

                $mail -> IsSMTP();
                $mail -> SMTPAuth = true;
                $mail -> Username = $cuentaCor -> mail_smtpuser;
                $mail -> Password = $cuentaCor -> mail_smtppass;
                $mail -> Host = $cuentaCor -> mail_smtpserver;
                $mail -> Port = $cuentaCor -> mail_smtpport;

                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Puerto:' . $cuentaCor -> mail_smtpport);
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]tipoSSL:' . $cuentaCor -> mail_smtpssl);
                if ($cuentaCor -> mail_smtpssl == 1) {
                    $mail -> SMTPSecure = 'ssl';
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Es SSL');
                } else if ($cuentaCor -> mail_smtpssl == 2) {
                    $mail -> SMTPSecure = 'tls';
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Es TLS');
                }

                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Direccion-' . $mail -> From);
            }
        }

        $mail -> ClearAllRecipients();
        $mail -> ClearReplyTos();

        /*Añadimos en copia oculta todas las direcciones recogidas*/

        //    $mail->AddBCC('crm@expandenegocio.com','CRM');

        $mail -> Subject = from_html($emailTemp -> subject);


        $tempFinal=str_replace('$body',$cuerpo,$emailTemp -> body_html);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuerpo-' . $cuerpo);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]templateAntes-' . $emailTemp -> body_html);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]templateDespues-' . $tempFinal);
        
        $mail -> Body_html = from_html($tempFinal);
        $mail -> Body = wordwrap($tempFinal, 900);
        $mail -> IsHTML(true);
        //Omit or comment out this line if plain text

        //Attachments
        $note = new Note();
        $where = "notes.parent_id = '" . $idTemp . "'";
        $attach_list = $note -> get_full_list("", $where, true);
        //Get all Notes entries associated with email template

        $attachments = array();
        $attachments = array_merge($attachments, $attach_list);

        foreach ($attachments as $attached) {
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Recoge Attach');

            $filename = $attached -> filename;
            $file_location = 'upload/' . $attached -> id;
            $mime_type = $attached -> file_mime_type;
            $mail -> AddAttachment($file_location, $filename, 'base64', $mime_type);
            //Attach each file to message
        }

        //Enviamos los correos en paquetes de 40
        $cont = 0;
        $arrayCorreos = array();
        $todosEnviados= false;
        foreach ($listaCorreos as $bccer) {
            $mail -> AddBCC($bccer);
            $arrayCorreos[]="'".strtoupper($bccer)."'";
            if ($cont == 10) {
                $mail -> prepForOutbound();
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]CorreoEnviado:' . $cuentaCor -> mail_smtpport);
                
                //Enviamos el correo
                if ($mail -> Send()) {                    
                    $this->marcarEnviadoMailing(implode(",",$arrayCorreos),$idMailing);
                    if ($mailing->guardar_correo==1){
                        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Entra Asociar Correo');
                        $textoMai=$mailing->texto_informe." - ".$mailing->name;
                        $this -> asociarCorreoSolicitudes(implode(",",$arrayCorreos),$fran,$mail,$textoMai);
                    }
                }else{
                    $this->marcarNoEnviadoMailing(implode(",",$arrayCorreos),$idMailing);
                }
                
                //limpiamos las variables
                $mail -> ClearBCCs();
                $cont = 0;
                $todosEnviados = true;
                unset($arrayCorreos);
                
            } else {
                $cont++;
                $todosEnviados = false;
            }
        }

        if ($todosEnviados == false) {
            $mail -> prepForOutbound();
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]CorreoEnviado:' . $cuentaCor -> mail_smtpport);
            sleep(4);
            
            //Enviamos el correo
            if ($mail -> Send()) {
                 $this->marcarEnviadoMailing(implode(",",$arrayCorreos),$idMailing);  
                if ($mailing->guardar_correo==1){
                    $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Entra Asociar Correo');
                    $textoMai=$mailing->texto_informe." - ".$mailing->name;
                    $this -> asociarCorreoSolicitudes(implode(",",$arrayCorreos),$fran,$mail,$textoMai);
                }
            }else{
                $this->marcarNoEnviadoMailing(implode(",",$arrayCorreos),$idMailing);
            }
        }
        
        $mailing->actualizarMailing();
        $mailing->ignore_update_c=true;
        $mailing->save();
        echo "Ok";
        // $mail->setMailerForSystem();

    }

    function marcarEnviadoMailing($listaMail,$idMailing){
        
        $db = DBManagerFactory::getInstance();
        
        $query = "UPDATE expma_mailing_expan_solicitud_c ";
        $query=$query."SET enviado = 1, motivo_no_envio=null ";
        $query=$query."WHERE ";
        $query=$query."   expma_mailing_expan_solicitudexpma_mailing_ida= '".$idMailing."' AND ";
        $query=$query."   expma_mailing_expan_solicitudexpan_solicitud_idb IN  ";
        $query=$query."    (SELECT r.bean_id ";
        $query=$query."    FROM email_addr_bean_rel r,email_addresses e ";
        $query=$query."    WHERE ";
        $query=$query."     e.id = r.email_address_id AND ";
        $query=$query."     e.email_address_caps in ( ".$listaMail.") and r.deleted=0); ";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]marcarEnviadoMailing:' . $query);
        
        $db -> query($query);
        
    }
    
    function marcarNoEnviadoMailing($listaMail,$idMailing){
        
        if ($listaMail!=''){

            $db = DBManagerFactory::getInstance();
            
            $query = "UPDATE expma_mailing_expan_solicitud_c ";
            $query=$query."SET enviado=0, motivo_no_envio = 'No se ha podido enviar' ";
            $query=$query."WHERE ";
            $query=$query."   expma_mailing_expan_solicitudexpma_mailing_ida= '".$idMailing."' AND ";
            $query=$query."   expma_mailing_expan_solicitudexpan_solicitud_idb IN  ";
            $query=$query."    (SELECT r.bean_id ";
            $query=$query."    FROM email_addr_bean_rel r,email_addresses e ";
            $query=$query."    WHERE ";
            $query=$query."     e.id = r.email_address_id AND e.deleted=0 AND ";
            $query=$query."     e.email_address_caps in ( ".$listaMail.") and r.deleted=0); ";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]marcarEnviadoMailing:' . $query);
            
            $db -> query($query);

        }
        
    }
    
    
    public function marcadoProtocolo($idMailing,$fran)
    {
        $db = DBManagerFactory::getInstance();
        
        if ($fran==null){
            $query = "UPDATE expma_mailing_expan_solicitud_c c ";
            $query=$query."       INNER JOIN ";
            $query=$query."       (SELECT s.id AS id ";
            $query=$query."        FROM   expma_mailing_expan_solicitud_c ms, expan_solicitud s, expan_solicitud_cstm cs ";
            $query=$query."        WHERE  ms.expma_mailing_expan_solicitudexpan_solicitud_idb = s.id AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = ";
            $query=$query."               '".$idMailing."' AND cs.id_c = s.id AND (s.cerrada = 1 OR s.positiva = 1 OR cs.no_correos_c = ";
            $query=$query."               1)) a ";
            $query=$query."         ON a.id = c.expma_mailing_expan_solicitudexpan_solicitud_idb ";
            $query=$query."SET    motivo_no_envio = 'Por protocolo' ";
            $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$idMailing."' AND ";
            $query=$query."       expma_mailing_expan_solicitudexpan_solicitud_idb; "; 
        }else{
                    
            $query = "UPDATE expma_mailing_expan_solicitud_c c  ";
            $query=$query."       INNER JOIN  ";
            $query=$query."       (SELECT s.id AS id ";
            $query=$query."FROM   expma_mailing_expan_solicitud_c ms, expan_solicitud s, expan_solicitud_cstm cs, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs ";
            $query=$query."WHERE  g.id = gs.expan_soli5dcccitudes_idb AND s.id = gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida AND ms. ";
            $query=$query."       expma_mailing_expan_solicitudexpan_solicitud_idb = s.id AND ms.expma_mailing_expan_solicitudexpma_mailing_ida = ";
            $query=$query."       '".$idMailing."' AND cs.id_c = s.id AND ";
            $query=$query."        (g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_DESCARTADO." OR ";
            $query=$query."         g.estado_sol = ".Expan_GestionSolicitudes::ESTADO_POSITIVO." OR cs.no_correos_c = 1)) a  ";
            $query=$query."         ON a.id = c.expma_mailing_expan_solicitudexpan_solicitud_idb  ";
            $query=$query."SET    motivo_no_envio = 'Por protocolo'  ";
            $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$idMailing."' AND  ";
            $query=$query."       expma_mailing_expan_solicitudexpan_solicitud_idb  ";                          
        }                     
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]marcadoProtocolo:' . $query);
        
        $db -> query($query);
        
    }

    function asociarCorreoSolicitudes($listaCorr,$fran,$mail,$texto) {
        
        $db = DBManagerFactory::getInstance();
        
        
        $query = "  SELECT g.id id,e.email_address em "; 
        $query=$query."FROM ";
        $query=$query."  expan_gestionsolicitudes g, ";
        $query=$query."  expan_solicitud_expan_gestionsolicitudes_1_c gs, ";
        $query=$query."  email_addr_bean_rel r, ";
        $query=$query."  email_addresses e ";
        $query=$query."WHERE ";
        $query=$query."  g.franquicia = '".$fran->id."' AND ";
        $query=$query."  gs.expan_soli5dcccitudes_idb = g.id AND ";
        $query=$query."  gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida =r.bean_id AND ";
        $query=$query."  e.id =r.email_address_id AND ";
        $query=$query."  e.email_address_caps IN (".$listaCorr.")";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]asociarCorreoSolicitudes:' . $query);   
        
        $resultSol = $db -> query($query, true);
    
        while ($rowSol = $db -> fetchByAssoc($resultSol)) {
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Entra bucle');

            //tenemos que recoger las gestiones asociadas
                                            
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($rowSol["id"]);
            
            $correo=$rowSol["em"];
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Gestion-' . $gestion -> id);
           
            $this -> almacenarCorreo($mail, $correo, $gestion, "Expan_GestionSolicitudes");  
            
            $gestion->addFechaObserva("[Mailing]".$texto,true);
            $gestion->ignore_update_c=true;
            $gestion->save();
        }
                   
        
    }

    function recogeFranquiciaPorPlantilla($namePlantilla) {

        $idFran = '';
        //Recogemos el id de la franquicia idFran#tipoPlant
        $GLOBALS['log'] -> info('[ExpandeNegocio][recogeFranquiciaPorPlantilla]NombrePlantilla-' . $namePlantilla);

        $lista = explode('#', $namePlantilla);
        if (count($lista) > 0) {
            $idFran = $lista[0];
        } else {
            return null;
        }

        return $idFran;

    }
/*
    function enviarCorreosEvento($listaCorreos, $idTemplate, $fran) {

        //Recogemos el template

        $emailTemp = new EmailTemplate();
        $emailTemp -> disable_row_level_security = true;
        $emailTemp -> retrieve($idTemplate);

        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> ClearAllRecipients();
        $mail -> ClearReplyTos();

        //Añadimos en copia oculta todas las direcciones recogidas

        //$mail->AddBCC('crm@expandenegocio.com','CRM');

        foreach ($listaCorreos as $bccer) {
            $mail -> AddBCC($bccer);
        }

        $mail -> Subject = from_html($emailTemp -> subject);

        $mail -> Body_html = from_html($emailTemp -> body_html);
        $mail -> Body = wordwrap($emailTemp -> body_html, 900);
        $mail -> IsHTML(true);
        //Omit or comment out this line if plain text

        //Attachments
        $note = new Note();
        $where = "notes.parent_id = '" . $idTemp . "'";
        $attach_list = $note -> get_full_list("", $where, true);
        //Get all Notes entries associated with email template

        $attachments = array();
        $attachments = array_merge($attachments, $attach_list);

        foreach ($attachments as $attached) {
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Recoge Attach');

            $filename = $attached -> filename;
            $file_location = 'upload/' . $attached -> id;
            $mime_type = $attached -> file_mime_type;
            $mail -> AddAttachment($file_location, $filename, 'base64', $mime_type);
            //Attach each file to message
        }

        $mail -> FromName = $fran -> name;
        $mail -> IsHTML(true);

        //$mail->From=$fran->correo_envio;

        //Recogemos la cuenta con la que enviamos los correos
        global $current_user;
        $current_user = new User();
        $current_user -> getSystemUser();

        $cuentaCor = new OutboundEmail();

        $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo' . $fran -> correo_envio);

        if ($cuentaCor == false) {
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo no definida->Cuenta defecto');

            //  $mail->prepForOutbound();
            //  $mail->setMailerForSystem();

        } else {
            $mail -> From = $cuentaCor -> name;

            $mail -> Username = $cuentaCor -> mail_smtpuser;
            $mail -> Password = $cuentaCor -> mail_smtppass;
            $mail -> Host = $cuentaCor -> mail_smtpserver;
            $mail -> Port = $cuentaCor -> mail_smtpport;
            if ($cuentaCor -> mail_smtpssl == 1) {
                $mail -> SMTPSecure = 'ssl';
            }
            $mail -> SMTPDebug = 2;
            $mail -> Mailer = "smtp";
            $mail -> IsSMTP();
            // telling the class to use SMTP
            $mail -> SMTPAuth = true;

            $mail -> prepForOutbound();

            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo' . $dirCor -> mail_smtpuser . '-');
            $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]Cuenta Correo' . $dirCor -> mail_smtppass);

            if (!$mail -> Send()) {
                $GLOBALS['log'] -> info('[ExpandeNegocio][Envio correos]ERROR: El envio del correo ha fallado');
            } else {
                $this -> almacenarCorreo($mail, $rcpt_email, $bean, "Expan_GestionSolicitudes");
            }

        }

    }
*/

    function almacenarCorreo($mail, $toAdd, $bean, $module) {

        $GLOBALS['log'] -> info('[ExpandeNegocio][Insercion Correos]Entra');

        $db = DBManagerFactory::getInstance();

        $emailUID = create_guid();

        //Debemos insertar el correo

        $GLOBALS['log'] -> info('[ExpandeNegocio][Insercion Correos]Antes consulta');

        $query = "Insert emails (id,date_entered,date_modified,assigned_user_id,modified_user_id,created_by,
                                    deleted,date_sent,name,type,status,intent,parent_type,parent_id)
                    VALUES ('" . $emailUID . "', date_add(NOW(), INTERVAL -1 HOUR),date_add(NOW(), INTERVAL -1 HOUR),'" 
                    . $GLOBALS['current_user'] -> id . "','" . $GLOBALS['current_user'] -> id . "','" 
                    . $GLOBALS['current_user'] -> id . "',0,date_add(NOW(), INTERVAL -1 HOUR),'" . str_replace("'","", $mail -> Subject) . "','archived','sent','pick','" . $module . "','" . $bean -> id . "')";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Insercion Correos]Insercion Correo-' . $query);

        $db -> query($query);

        //Debemos insertar el texto del correo
        $query = "Insert emails_text (email_id,from_addr,reply_to_addr,to_addrs,description,description_html,deleted) ";
        $query = $query. "VALUES ('" . $emailUID . "','" . 
                  $mail -> From . "','" . 
                  $mail -> From . "','" . 
                  $toAdd . "','" . 
                  mysql_real_escape_string($mail -> Body) . "','" . 
                  mysql_real_escape_string($mail -> Body_html) . 
                  "',0)";

        $GLOBALS['log'] -> info('[ExpandeNegocio][Insercion Correos]Insercion Correo Mensaje-' . $query);

        $db -> query($query);

    }

}
?>