<?php

  $idDoc=$_GET["idDoc"];
  $idGest=$_GET["idGest"];

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

  $GLOBALS['log'] -> info('[ExpandeNegocio][Descarga Documentos]Inicio');

  $db = DBManagerFactory::getInstance();

  // https://www.expandenegocio.com/sugarcrm/upload/edbb0f99-9802-9314-478a-5a6998f3287f  -> id de la ultima revision
  // documento

  $query ="select * from document_revisions where document_id='$idDoc' and deleted=0 order by revision desc";

  $id="";

  $result = $db -> query($query, true);

  while ($row = $db -> fetchByAssoc($result)) {
    $id=$row["id"];
    break;
  }

  $GLOBALS['log'] -> info('[ExpandeNegocio][Descarga Documentos]Link Documento -'.$data);

  echo $_GET['callback'] . '(' . "{'resp' : '$id'}" . ')';
