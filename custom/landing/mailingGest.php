<?php

  $idGest=$_GET["idGest"];
  $accion=$_GET["accion"];
  $doc=$_GET["doc"];
  $idTemplate=$_GET["idTemplate"];
  $idMailing=$_GET["idMailing"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Inserccion Accion Mailing]-'.$idGest." - ".$accion);

  $db = DBManagerFactory::getInstance();

  $sql ="insert into expan_mailing_actions (id,f_accion,gestion_id,c_accion,c_doc,id_template,id_mailing) values (uuid(),now(),'$idGest','$accion','$doc','idTemplate','$idMailing')";
  $GLOBALS['log'] -> info('[ExpandeNegocio][Inserccion Accion Mailing]Consulta - '.$sql);

  $result = $db -> query($sql);

  echo $_GET['callback'] . '(' . "{'resp' : 'ok'}" . ')';
