<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    
    $db = DBManagerFactory::getInstance();

  /*  $query = "update expan_solicitud s join ( ";
    $query=$query."select distinct(s.id) id, s.perfil_profesional , tipoTag from expan_solicitud s, expan_tag_perfil t ";
    $query=$query."where s.perfil_profesional like concat('%',t.Tag,'%') ";
    $query=$query."and     instr(coalesce(tags_empresa,''),t.tipoTag)=0)a ";
    $query=$query."on s.id=a.id ";
    $query=$query."set s.tags_empresa=case when s.tags_empresa is null then a.tipoTag else concat(s.tags_empresa,',',tipoTag) end ";

    $result = $db -> query($query);;*/

  $sql = "select * from expan_adjuntos";

  $result = $db -> query($sql, true);

  echo "Consulta<BR>";Documentos Enviados

  while ($row = $db -> fetchByAssoc($result)) {

   // echo $row["id"] . "-Fenvio-".$row["f_envio"]."<BR>";
    $rid=$row["id"];
    $note_id=$row["id_note"];
    $fecha=$row["f_envio"];

    $query = "SELECT dn.note_id,dr.id drid  ";
    $query=$query."FROM   document_revisions dr, documents_notes dn ";
    $query=$query."WHERE  dr.date_entered = (SELECT   max(date_entered) ";
    $query=$query."                          FROM     document_revisions dr ";
    $query=$query."                          WHERE    dr.document_id = (SELECT dn.document_id ";
    $query=$query."                                                     FROM   documents_notes dn ";
    $query=$query."                                                     WHERE  note_id = '$note_id') AND date_entered< DATE_ADD(STR_TO_DATE('$fecha', '%Y-%m-%d'),INTERVAL 1 DAY)";
    $query=$query."                          GROUP BY document_id) AND dn.docrev_id = dr.id; ";


      $result2 = $db -> query($query, true);

       echo $query."<BR>";

      while ($row2 = $db -> fetchByAssoc($result2)) {
        echo $row["id"] . "-Fenvio-".$row["f_envio"]."-drid-".$row2["drid"]."<BR>";

        $idNote=$row2["note_id"];
        $query2="update expan_adjuntos set id_note='$idNote' where id='$rid'";

      }
  }