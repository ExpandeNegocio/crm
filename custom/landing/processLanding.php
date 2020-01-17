<?php

  $template=$_GET['template'];
  $idTemplate=$_GET['idTemplate'];
  $idMailing=$_GET['idMailing'];
  $idGest=$_GET['idGest'];

  // Recojo la plantilla

  $html_file='https://expandenegocio.com/sugarcrm/custom/landing/'.$template;

  $html=file_get_contents($html_file, true);

 // echo $html;


  // Proceso la plantilla

  const MARC_NOMBRE = '#nombre#';
  const MARC_APELLIDO = '#apellidos#';
  const MARC_EMAIL = '#email#';
  const MARC_MOVIL = '#movil#';
  const MARC_FRANQUICIA = '#franquicia#';
  const MARC_FRANQUICIA_ID = '#franquiciaid#';
  const MARC_GESTION_ID ='#gestionid#';
  const MARC_SOLICITUD_ID ='#solicitudid#';
  const MARC_TEMPLATE_ID ="#templateid#";
  const MARC_MAILING_ID ="#mailingid#";

  $first_name="";
  $last_name="";
  $email="";
  $telefono="";
  $franquicia="";
  $franquiciaId="";
  $solId="";

  $db = DBManagerFactory::getInstance();

  $query = "select s.first_name, s.last_name, s.phone_mobile, s.id as solId,g.franquicia as franquiciaId, f.name as franquicianame    ";
  $query=$query."from expan_solicitud s, expan_gestionsolicitudes g, expan_solicitud_expan_gestionsolicitudes_1_c gs, expan_franquicia f ";
  $query=$query."where g.id='$idGest' and s.id= gs.expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida and g.id=gs.expan_soli5dcccitudes_idb and f.id= g.franquicia ";
  $query=$query."and g.deleted=0 and s.deleted=0 and gs.deleted=0; ";

  $result = $db -> query($query, true);

  while ($row = $db -> fetchByAssoc($result)) {
    $first_name=$row["first_name"];
    $last_name=$row["last_name"];
    $telefono=$row["phone_mobile"];
    $franquiciaId=$row["franquiciaId"];
    $franquiciaName=$row["franquicianame"];
    $solId=$row["solId"];
    break;
  }

  $query ="select email_address from email_addresses e, email_addr_bean_rel er where er.email_address_id=e.id and er.bean_id='$solId' and e.deleted=0 and e.invalid_email=0 and bean_id<>''";

  $result = $db -> query($query, true);

  while ($row = $db -> fetchByAssoc($result)) {
    $email=$row["email_address"];
    break;
  }

  $html = str_replace(MARC_NOMBRE, $first_name, $html);
  $html = str_replace(MARC_APELLIDO, $last_name, $html);
  $html = str_replace(MARC_EMAIL, $email, $html);
  $html = str_replace(MARC_MOVIL, $telefono, $html);
  $html = str_replace(MARC_FRANQUICIA_ID, $franquiciaId, $html);
  $html = str_replace(MARC_FRANQUICIA, $franquicia, $html);
  $html = str_replace(MARC_GESTION_ID, $idGest, $html);
  $html = str_replace(MARC_SOLICITUD_ID, $solId, $html);
  $html = str_replace(MARC_TEMPLATE_ID, $idTemplate, $html);
  $html = str_replace(MARC_MAILING_ID, $idMailing, $html);

  echo $html;