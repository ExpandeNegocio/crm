<?php

  function deleteFiles($folder)
  {

    $files = glob($folder . '*'); // get all file names
    foreach ($files as $file) { // iterate files
      if (is_file($file)) {
        unlink($file); // delete file
      }
    }
  }

  function limpiaSectores()
  {

    $db = DBManagerFactory::getInstance();

    $query = "delete from w_sector";
    $db->query($query);

    $query = "SELECT id,  trim(BOTH ',' FROM concat(COALESCE(replace(otros_sectores,\"\",\",\"),\"\"),\",\",coalesce(replace(sectores_historicos,\"\",\",\"),\"\")))  sector_cont,    ";
    $query = $query . "      concat(first_name,' ', last_name) nombre   ";
    $query = $query . "    FROM   expan_solicitud   ";
    $query = $query . "    WHERE  NOT otros_sectores IS NULL OR NOT sectores_historicos IS NULL    ";
    $query = $query . "    AND deleted = 0  ";
    $query = $query . "UNION ";
    $query = $query . "SELECT id,trim(BOTH ',' FROM concat(COALESCE(replace(otros_sectores,\"\",\",\"),\"\"))) sector_cont, ";
    $query = $query . "  name nombre ";
    $query = $query . "  from expan_empresa ";
    $query = $query . "  where NOT otros_sectores IS NULL AND deleted=0 ";

    echo $query . "<br>";

    $result = $db->query($query, true);

    echo "Llega1<br>";

    while ($row = $db->fetchByAssoc($result)) {

      $lista = explode(",", $row["sector_cont"]);
      foreach ($lista as $value) {

        $value = trim($value);
        if ($value != "") {
          $query = "insert into w_sector (id_sol,name_sector) values ('" . $row["id"] . "','" . $value . "')";
          //   echo $query;
          //   echo "<br>";
          $result2 = $db->query($query);

        }
      }
    }
  }

  function limpiaFranquicia()
  {

    $db = DBManagerFactory::getInstance();

    $query = "delete from w_franq";
    $db->query($query);

    $query = "SELECT id,  trim(BOTH ',' FROM concat(COALESCE(replace(franquicias_contactadas,'',','),''),',',   ";
    $query = $query . "                                 coalesce(replace(otras_franquicias,'',','),''),',',   ";
    $query = $query . "                                 coalesce(replace(franquicia_historicos,'',','),'')))  franq_cont,    ";
    $query = $query . "            concat(coalesce(first_name,''),' ', coalesce(last_name,'')) nombre, 'Solicitud' Modulo,   ";
    $query = $query . "            case WHEN NOT franquicias_contactadas IS NULL THEN 'Franquicias contactadas' ";
    $query = $query . "                 WHEN NOT otras_franquicias IS NULL THEN 'Otras Franquicias' ";
    $query = $query . "                 WHEN NOT otras_franquicias IS NULL THEN 'Historico de franquicias' ";
    $query = $query . "              ELSE ''  ";
    $query = $query . "            END AS Campo ";
    $query = $query . "             ";
    $query = $query . "FROM   expan_solicitud   ";
    $query = $query . "WHERE  NOT franquicias_contactadas IS NULL OR NOT otras_franquicias IS NULL  OR NOT franquicia_historicos IS NULL AND deleted = 0   ";
    $query = $query . "UNION ALL  ";
    $query = $query . "select id ,trim(BOTH ',' FROM concat(COALESCE(replace(franq_apertura_desca,'',','),''),''))  franq_cont ,  ";
    $query = $query . "      name nombre,'Solicitud' Modulo, ";
    $query = $query . "      'Franquicia de apertura por descarte' as Campo ";
    $query = $query . "from expan_gestionsolicitudes  ";
    $query = $query . "WHERE  NOT franq_apertura_desca IS NULL and deleted = 0  ";


    $result = $db->query($query, true);

    echo "Llega1";

    while ($row = $db->fetchByAssoc($result)) {

      $lista = explode(",", $row["franq_cont"]);
      foreach ($lista as $value) {

        $value = trim($value);
        if ($value != "") {
          $query = "insert into w_franq (id,name_fran,modulo,campo) values ('" . $row["id"] . "','" . $value . "','" . $row["Modulo"] . "','" . $row["Campo"] . "')";
          echo "CONSULTA INSERCCION W_FRANQ - " . $query;
          echo "<br>";
          $result2 = $db->query($query);

        }
      }
    }
  }

  function InsertaConsulta($objPHPExcel, $consulta, $titulo)
  {

    $db = DBManagerFactory::getInstance();

    //  echo $consulta. "<BR><BR>";

    //Lanzamos la consulta
    $result = $db->query($consulta, true);

    $fil = 2;

    $objPHPExcel->createSheet();
    $pagina = $objPHPExcel->getSheetCount() - 2;

    $objPHPExcel->setActiveSheetIndex($pagina)->setTitle($titulo);

    while ($row = $db->fetchByAssoc($result)) {

      $col = 'A';

      foreach ($row as $clave => $valor) {

        //Escribimos la cabecera
        if ($fil == 2) {
          $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue($col . '1', $clave);
        }

        //Escribimos cada linea
        if ($valor == null) {
          $valor = 0;
        }

        $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue($col . $fil, $valor);
        $col++;

      }
      $fil++;
    }
  }

  function InsertarDescripcion($objPHPExcel, $descripcion, $nomPestaña)
  {

    echo "----------INICO INSERTA DESCRIPCION---------------------------<br>";

    $pagina = 0;
    $colPestaña = 'A';
    $colDescrip = 'B';

    $filaIni = BuscarFila($objPHPExcel, $pagina);

    $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue($colPestaña . $filaIni, $nomPestaña);

    $longitud = count($descripcion);


    for ($i = 0; $i < $longitud; $i++) {
      $fila = $i + $filaIni;
      $celda = $colDescrip . $fila;

      echo "Celda-" . $celda . "<BR>";
      $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue($colDescrip . $fila, $descripcion[$i]);
    }


    echo "----------FIN INSERTA DESCRIPCION---------------------------<br>";

  }

  function BuscarFila($objPHPExcel, $pagina)
  {

    $columna = 1;
    $fila = 1;

    while ($objPHPExcel->setActiveSheetIndex($pagina)->getCellByColumnAndRow($columna, $fila) != '') {
      echo "+++" . $objPHPExcel->setActiveSheetIndex($pagina)->getCellByColumnAndRow($columna, $fila) . "<BR>";

      $fila++;
    }

    return $fila;
  }

  function EnviarCorreo($emailAddr, $subject, $file, $body)
  {
    $GLOBALS['log']->info('[ExpandeNegocio][CorreoLlamadas][Envio correos]Entra');

    $mail = new SugarPHPMailer();

    $emailObj = new Email();
    $defaults = $emailObj->getSystemDefaultEmail();

    $mail->From = $defaults['email'];
    $mail->FromName = $defaults['name'];

    $mail->AddAddress($emailAddr, $emailAddr);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->IsHTML(TRUE);
    if ($file != null) {
      $mail->AddAttachment($file);
    }

    if (!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }

  }

  function esAdministracion($user_id)
  {

    /*   $current_user->id;
      $objACLRole = new ACLRole();
      $roles = $objACLRole->getUserRoles($user_id);

      foreach($roles as $rol){
        if($rol->id=='$ROL_ADMINISTRACION'){
           return true;
        }
      }
      */

    if ($user_id == '875daf39-76a9-4eb7-2fbc-53c7fa8dec18' ||
      $user_id == '71f40543-2702-4095-9d30-536f529bd8b6') {
      return true;
    }

    return false;
  }

  function CoprobarCandidatosCentral($numDias)
  {

    $db = DBManagerFactory::getInstance();

    $query = "SELECT   max(g.date_entered) last,f.name ";
    $query = $query . "FROM     expan_gestionsolicitudes g, expan_franquicia f ";
    $query = $query . "WHERE    g.franquicia = f.id AND tipo_origen = 4 AND f.tipo_cuenta in (1)  ";
    $query = $query . "  AND not( g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL " . $numDias . " DAY) AND CURDATE()) ";
    $query = $query . "GROUP BY f.name  ORDER BY last asc;";

    echo $query . "<BR>";

    //Lanzamos la consulta
    $result = $db->query($query, true);

    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    $message = $message . "<html>";
    $message = $message . "<head>";
    $message = $message . "</head>";
    $message = $message . "<body>";

    $message = $message . "<p>Listado de las franquicias de las que no se han recibido gestiones desde la central en los últimos " . $numDias . " días</p>";

    $message = $message . "<table style='width:80%'>";
    $message = $message . "<tr>";
    $message = $message . "<td><b>FRANQUICIA</b></td>";
    $message = $message . "<td><b>FECHA ULTIMA GESTION CENTRAL</b></td>";
    $message = $message . "</tr><tr>";

    $cont = 0;

    while ($row = $db->fetchByAssoc($result)) {

      $nameFran = $row["name"];
      $last = $row["last"];

      $message = $message . "<td><b>" . $nameFran . "</td></b>";
      $message = $message . "<td>" . $last . "</td>";
      $message = $message . "</tr><tr>";

      $cont++;

    }
    $message = $message . "</tr>";
    $message = $message . "</table>";
    $message = $message . "</body>";
    $message = $message . "</html>";

    echo $message;

    if ($cont == 0) {
      return "";
    } else {
      return $message;
    }

  }

  function CrearCuerpoCorreoEvento($listaEventos, $tipo)
  {

    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    $message = $message . "<html>";
    $message = $message . "<head>";
    $message = $message . "</head>";
    $message = $message . "<body>";

    $TIPO_EVENTO_ALTA = 'ALTA';
    $TIPO_EVENTO_INICIO = 'INICIO';
    $TIPO_EVENTO_FACTURCION = 'FACTURCION';

    switch ($tipo) {
      case $TIPO_EVENTO_INICIO:
        $message = $message . "<p>Listado de eventos queda un mes para su inicio.</p>";
        $message = $message . "<p>Es necesario validar los datos del mismo y añadir las franquicias asistentes.</p>";
        break;

      case $TIPO_EVENTO_ALTA:
        $message = $message . "<p>Listado de eventos que se han creado hoy.</p>";
        $message = $message . "<p>Es necesario validar los datos del mismo y añadir las franquicias asistentes.</p>";
        break;

      case $TIPO_EVENTO_FACTURCION:
        $message = $message . "<p>Listado de eventos a cuyos asistentes facturar (quedan 10 días para el inicio).</p>";
        $message = $message . "<p>Es necesario facturar a las franquicias asistentes.</p>";

    }

    $message = $message . "<table style='width:80%'>";
    $message = $message . "<tr>";
    $message = $message . "<td><b>EVENTO</b></td>";
    $message = $message . "</tr><tr>";

    foreach ($listaEventos as $value) {
      $message = $message . "<td><b>" . $value . "</td></b>";
      $message = $message . "</tr><tr>";
    }

    $message = $message . "</tr>";
    $message = $message . "</table>";
    $message = $message . "</body>";
    $message = $message . "</html>";

    echo "<br>-----MENSAJE CORREO-----------------------------------------------------------<br>";
    echo $message;

    return $message;
  }

  function controlAltaEvento()
  {

    $listaEventos = array();

    $db = DBManagerFactory::getInstance();

    $query = "select * from expan_evento where TIMESTAMPDIFF(DAY, DATE(date_entered), CURDATE()) < 1";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $listaEventos[] = $row["name"];
    }

    return $listaEventos;

  }

  function controlInicioEvento($dias)
  {

    $listaEventos = array();

    $db = DBManagerFactory::getInstance();

    $query = "select * from expan_evento where TIMESTAMPDIFF(DAY, DATE( fecha_celebracion), CURDATE()) =" . $dias . " AND fecha_celebracion > CURDATE();";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $listaEventos[] = $row["name"];
      echo "Evento-" . $row["name"];
    }

    return $listaEventos;

  }

  function createTask($nombre)
  {

    $tarea = new Task();

    $tarea->name = $nombre;

    $tarea->status = "Not Started";
    $tarea->task_type = "OTRO";

    $tarea->date_start = TimeDate::getInstance()->nowDb();
    $tarea->date_due = TimeDate::getInstance()->nowDb();

    $tarea->save();

  }

  function InsertaERM($objPHPExcel, $consulta, $titulo)
  {

    $fil = 2;

    $objPHPExcel->createSheet();
    $pagina = $objPHPExcel->getSheetCount() - 2;

    $objPHPExcel->setActiveSheetIndex($pagina)->setTitle($titulo);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $consulta);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/xml"
    ));

    $response = curl_exec($ch);

    curl_close($ch);

    $tareas = new SimpleXMLElement($response);

    $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('A1', 'ID');
    $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('B1', 'Nombre Tarea');
    $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('C1', 'Fecha Ultima Actualizacion');


    $fil = 2;

    foreach ($tareas as $tarea) {

      $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('A' . $fil, $tarea->id);
      $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('B' . $fil, $tarea->subject);
      $objPHPExcel->setActiveSheetIndex($pagina)->setCellValue('B' . $fil, $tarea->updated_on);

      $fil++;

      echo $tarea->id . " - " . $tarea->subject . "-" . $tarea->updated_on . "<BR>";
    }

  }