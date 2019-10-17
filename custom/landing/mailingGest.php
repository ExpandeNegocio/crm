<?php

  $idGest=$_GET["idGest"];
  $accion=$_GET["accion"];
  $doc=$_GET["doc"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Inserccion Accion Mailing]-'.$idGest." - ".$accion);

  $db = DBManagerFactory::getInstance();

  $sql ="insert into expan_mailing_actions (id,f_accion,gestion_id,c_accion,c_doc) values (uuid(),now(),'$idGest','$accion','$doc')";
  $GLOBALS['log'] -> info('[ExpandeNegocio][Inserccion Accion Mailing]Consulta - '.$sql);

  $result = $db -> query($sql);

  echo $_GET['callback'] . '(' . "{'resp' : 'ok'}" . ')';
