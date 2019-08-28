<?php
$db = DBManagerFactory::getInstance();



$sql = "SELECT id as idF FROM expan_franquiciado f, ";
$sql = $sql . " (select phone_home as phf, phone_mobile as pmf from expan_solicitud where id='e169842f-3481-1f9c-0d37-5d64dd7f207e') b ";
$sql = $sql . " WHERE  (phone_home =phf OR phone_home=pmf OR phone_mobile =phf OR phone_mobile=pmf) AND deleted=0;";

echo $sql."<BR>";

$GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Franquiciado] Consulta'.$sql);

$result = $db -> query($sql, true);

while ($row = $db -> fetchByAssoc($result)) {
  $GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Franquiciado] Entra Bucle-'.$row["idF"]);
  echo $row["idF"];
}