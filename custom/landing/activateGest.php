<?php

  $idGest=$_GET["idGest"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Reactivacion de la gestion]-'.$idGest);

  $db = DBManagerFactory::getInstance();

  $sql ="update expan_gestionsolicitudes set estado_sol=2 where id='$idGest'";
  $GLOBALS['log'] -> info('[ExpandeNegocio][Reactivacion de la gestion]Consulta - '.$sql);

  $result = $db -> query($sql);

  echo $_GET['callback'] . '(' . "{'resp' : 'ok'}" . ')';