<?php

  $gestId=$_GET["gestId"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Baja de correo]Inicio');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Baja de correo]Gestion-'.gestId);

  // Recogemos el id de solicitud
  $gestion=new Expan_GestionSolicitudes();
  $gestion->retrieve($gestId);
  $solicitud=$gestion->GetSolicitud();
  $solId=$solicitud->id;

  $db = DBManagerFactory::getInstance();

  $query = "UPDATE email_addresses ";
  $query=$query."SET    email_addresses.opt_out = 1 ";
  $query=$query."WHERE  id IN (SELECT e.id ";
  $query=$query."              FROM   email_addresses e, email_addr_bean_rel er ";
  $query=$query."              WHERE  er.email_address_id = e.id AND er.bean_id = '$solId' AND e.deleted = 0 AND e.invalid_email = 0 AND bean_id <> '')";

  $db -> query($query, true);

  $query = "update expan_solicitud set no_newsletter=1 where id='$solId'; ";
  $db -> query($query, true);

  $query = "update expan_solicitud_cstm set no_correos_c=1 where id_c='$solId'; ";
  $db -> query($query, true);

  $solicitud=new Expan_Solicitud();
  $solicitud->retrieve($solId);

  $solicitud->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

    //Pasamos a descartadas las gestiones
  foreach ($solicitud->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
    $gestion->estado_sol= Expan_GestionSolicitudes::ESTADO_DESCARTADO;
    $gestion->motivo_descarte=Expan_GestionSolicitudes::DESCARTE_CORREO;

    $gestion->save();
  }

  echo $_GET['callback'] . '(' . "{'resp' : 'ok'}" . ')';