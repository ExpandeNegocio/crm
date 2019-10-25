<?php

  $solId=$_GET["solId"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Baja de correo]Inicio');


  $GLOBALS['log'] -> info('[ExpandeNegocio][Baja de correo]Solicitud-'.$solId);

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

  echo $_GET['callback'] . '(' . "{'resp' : 'ok'}" . ')';