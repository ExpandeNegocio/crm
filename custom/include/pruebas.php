<?php
require_once ('modules/Expan_Franquiciado/Expan_Franquiciado.php');

$db = DBManagerFactory::getInstance();

$sql = "SELECT id as idF FROM expan_franquiciado f ";

$GLOBALS['log'] -> info('[ExpandeNegocio][Creacion Franquiciado] Consulta'.$sql);

$result = $db -> query($sql, true);

while ($row = $db -> fetchByAssoc($result)) {
  echo $row["idF"]."-Actualizado<BR>";

  $expan_franquiciado= new Expan_Franquiciado();
  $expan_franquiciado->retrieve($row["idF"]);
  $expan_franquiciado ->estado= $expan_franquiciado->getEstado();
  $expan_franquiciado->save();
}