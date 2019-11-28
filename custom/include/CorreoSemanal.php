<?php

  require_once('data/SugarBean.php');
  require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
  require_once('modules/Expan_Solicitud/Expan_Solicitud.php');
  require('lib/PHPExcel/PHPExcel.php');
  require_once('include/SugarPHPMailer.php');
  require_once ('custom/include/ComunInformes.php');

  $ROL_ADMINISTRACION = 'd3986de5-b388-658b-c656-5392fbb0c529';
  $CORREO_RUBEN = 'ruben@expandenegocio.com';
  $NUM_DIAS_MAX_CENTRAL = 15;
  $NUM_DIAS_ANTES_EVENTO_ALTA_FRANQUICIA = 30;
  $NUM_DIAS_ANTES_EVENTO_FACTURACION = 10;
  $TIPO_EVENTO_ALTA = 'ALTA';
  $TIPO_EVENTO_INICIO = 'INICIO';
  $TIPO_EVENTO_FACTURCION = 'FACTURCION';

  $DIR = 'tmp/';

  $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
  $GLOBALS['log']->info('[ExpandeNegocio][Envio de correo Semanal]Inicio');


  deleteFiles($DIR);

  echo "Despues eliminar Fich";


  $db = DBManagerFactory::getInstance();

  //No se muestran ni los de las franquicias ni los que no show_on_employees=1
  $query = "SELECT u.id, u.user_name, e.email_address ";
  $query = $query . "FROM   users u, email_addr_bean_rel r, email_addresses e ";
  $query = $query . "WHERE  r.bean_id = u.id AND e.id = r.email_address_id AND u.status = 'Active' AND e.deleted=0 AND r.deleted=0 AND ";
  $query = $query . "u.deleted = 0 AND show_on_employees=1 AND u.franquicia IS NULL; ";

  $result = $db->query($query, true);

  //Recorremos los usuarios
  while ($row = $db->fetchByAssoc($result)) {

    $usuario = $row['user_name'];
    $user_id = $row['id'];
    $idFich = 'Informe semanal-' . $usuario . '-' . date('d-n-Y');
    $filePath = $DIR . $idFich . '.xlsx';
    echo $filePath . "<br>";
    CreaFicheroEnvioSemanal($filePath, $user_id);

    EnviarCorreo($row['email_address'], from_html("Informe semanal " . date('d-n-Y')), $filePath, '');

    echo "Terminado<BR>";
    echo "---------------------------------------------------------------------------------<BR><BR>";
  }

  echo 'Finaliza<BR>';


  function CreaFicheroEnvioSemanal($filePath, $user_id)
  {

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    echo "Inicia Creacion Fichero<br>";

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("ExpandeNegocio") //Autor
    ->setLastModifiedBy("ExpandeNegocio") //Ultimo usuario que lo modificó
    ->setTitle("Reporte Excel con PHP y MySQL")
      ->setSubject("Reporte Excel con PHP y MySQL")
      ->setDescription("Informe Expandenegocio")
      ->setKeywords("ExpandeNegocio")
      ->setCategory("Reporte excel");

    $titulo = 'Ayuda';
    $pagina = 0;

    if ($objPHPExcel->setActiveSheetIndex($pagina)->getTitle() != $titulo) {
      $objPHPExcel->createSheet();
      $objPHPExcel->setActiveSheetIndex($pagina)->setTitle($titulo);

      echo "Crea nueva pestaña<br>";
    }

    //Listado de franquicias no dadas de alta
    limpiaFranquicia();

    $query = "select s.first_name Nombre, s.last_name Apellido, w.name_fran Franquicia, 'Solicitud' Modulo, w.campo , s.date_entered ";
    $query = $query . "from w_franq w , expan_solicitud s  ";
    $query = $query . "where w.id=s.id and w.name_fran not in (select name from expan_franquicia where deleted=0) AND  ";
    $query = $query . "ucase(w.name_fran) not in (select ucase (franq_excep) from w_fran_excep)  ";
    $query = $query . "UNION ALL ";
    $query = $query . "select name Nombre, '' Apellido, w.name_fran Franquicia, 'Gestion' Modulo, w.campo , g.date_entered ";
    $query = $query . "from w_franq w , expan_gestionsolicitudes g  ";
    $query = $query . "where w.id=g.id and w.name_fran not in (select name from expan_franquicia where deleted=0) AND  ";
    $query = $query . "ucase(w.name_fran) not in (select ucase (franq_excep) from w_fran_excep)";

    InsertaConsulta($objPHPExcel, $query, 'Franquicias no dadas de alta');

    $descripcion = array("Listado de franquicias recogidas en los campos de franquicias_contactadas y otras franquicias que no están dadas de alta en franquicias");
    InsertarDescripcion($objPHPExcel, $descripcion, 'Franquicias no dadas de alta');

    //Listado de sectores no dados de alta
    limpiaSectores();

    $query = "SELECT s.first_name Nombre, s.last_name Apellido, 'Solicitud' Modulo, DATE_FORMAT(s.date_entered, '%d/%m/Y') Fecha, w.name_sector Sector ";
    $query = $query . "FROM   w_sector w, expan_solicitud s ";
    $query = $query . "WHERE  w.id_sol = s.id AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(d_subsector) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(c_sector) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(c_grupo_act) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase (sector_excep) FROM w_sector_excep) ";
    $query = $query . "UNION ALL ";
    $query = $query . "SELECT e.name Nombre, '' Apellido, 'Empresa' Modulo, DATE_FORMAT(e.date_entered, '%d/%m/Y') Fecha, w.name_sector Sector ";
    $query = $query . "FROM   w_sector w, expan_empresa e ";
    $query = $query . "WHERE  w.id_sol = e.id AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(d_subsector) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(c_sector) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase(c_grupo_act) FROM expan_m_sectores) AND  ";
    $query = $query . "  ucase(w.name_sector) NOT IN (SELECT ucase (sector_excep) FROM w_sector_excep); ";
    $query = $query . " ";

    echo $query . "<br>";

    InsertaConsulta($objPHPExcel, $query, 'Sectores no dados de alta');

    $descripcion = array("Listado de sectores recogidos en los campos de otros_sectores y otras sectores que no están dados de alta en sectores");
    InsertarDescripcion($objPHPExcel, $descripcion, 'Sectores no dados de alta');

    //Criterios de competidor por franquicia
    $query = "SELECT  f.name Franquicia, ";
    $query = $query . "cd_sector as Sector, ";
    $query = $query . "cd_subsector as Subsector, ";
    $query = $query . "cd_acttividad as Actividad, ";
    $query = $query . "cd_inversion as Inversion, ";
    $query = $query . "cd_opera_inter as \"Opera internacionamente\", ";
    $query = $query . "cd_num_centros as \"Nº Centros\", ";
    $query = $query . "cd_perfil_franquiciado as \"Perfil\", ";
    $query = $query . "cd_oferta_comercial as \"Oferta comercial\", ";
    $query = $query . "cd_modal_negocio as \"Modalidades de negocio\", ";
    $query = $query . "cd_canon as Canon, ";
    $query = $query . "cd_royaltys as Royalties, ";
    $query = $query . "cd_pobl_minima as \"Poblacion minima\", ";
    $query = $query . "cd_caract_local as \"Caracteríaticas del local\", ";
    $query = $query . "cd_estruct_personal as \"Estructura personal\" ";
    $query = $query . "                FROM   expan_franquicia f ";
    $query = $query . "                WHERE   tipo_cuenta IN (1, 2) and deleted=0 order by f.name; ";

    // echo "<BR>".$query."<BR>";

    InsertaConsulta($objPHPExcel, $query, 'Criterios competidor');

    $descripcion = array("Criterios para que se considere un competidor de la franquicia",
      "Se ordena por nombre");

    InsertarDescripcion($objPHPExcel, $descripcion, 'Fq sin Gest de Central');


    //Franquicias sin gestiones de la central
    $query = "SELECT   fmax AS 'Fecha último', name AS Nombre, fq as 'Fq sin gestiones de Central' ";
    $query = $query . "FROM     (SELECT   max(g.date_entered) fmax, f.name, DATEDIFF(CURDATE(), max(g.date_entered)) AS fq ";
    $query = $query . "          FROM     expan_gestionsolicitudes g, expan_franquicia f ";
    $query = $query . "          WHERE    g.franquicia = f.id AND tipo_origen = 4 AND f.tipo_cuenta IN (1) ";
    $query = $query . "          GROUP BY f.name) c ";
    $query = $query . "WHERE    NOT (fmax BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE()) ";
    $query = $query . "ORDER BY fq DESC; ";

    // echo "<BR>".$query."<BR>";

    InsertaConsulta($objPHPExcel, $query, 'Fq sin Gest de Central');

    $descripcion = array("Número de dias que un franquicia lleva sin que se crea una gestión proviniente de la central",
      "Se ordena por número de dias que han pasado desde el último alta");

    InsertarDescripcion($objPHPExcel, $descripcion, 'Fq sin Gest de Central');

    //listado de competidores por franquicia
    $query = "SELECT (select name from expan_empresa where id=c.empresa_id) as Franquicia,e.name as Competidor, c.tipo_competidor, c.competidor_principal ";
    $query = $query . "FROM   expan_empresa e, expan_empresa_competidores_c c ";
    $query = $query . "WHERE e.id= c.competidor_id and c.empresa_id  IN (SELECT e.id ";
    $query = $query . "                FROM   expan_franquicia f, expan_empresa e ";
    $query = $query . "                WHERE  f.empresa_id = e.id AND f.tipo_cuenta IN (1, 2) and f.deleted=0) ";
    $query = $query . "                order by franquicia,e.name; ";

    // echo "<BR>".$query."<BR>";

    InsertaConsulta($objPHPExcel, $query, 'Competidores');

    $descripcion = array("listado de competidores por franquicia",
      "Se ordena por nombre de la franquicia");

    InsertarDescripcion($objPHPExcel, $descripcion, 'Competidores');



    // Formularios recibidos

    $query = "SELECT   f.name as Franquicia,   ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Ultimos 7 dias\",  ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND DATE_SUB(CURDATE(), INTERVAL 8 DAY) THEN 1 ELSE 0 END) \"-1 semana\",  ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 21 DAY) AND DATE_SUB(CURDATE(), INTERVAL 15 DAY) THEN 1 ELSE 0 END) \"-2 semana\",  ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND DATE_SUB(CURDATE(), INTERVAL 22 DAY) THEN 1 ELSE 0 END) \"-3 semana\",                                          ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Este mes\",  ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 60 DAY) AND DATE_SUB(CURDATE(), INTERVAL 31 DAY) THEN 1 ELSE 0 END) \"-1 Mes\", ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 90 DAY) AND DATE_SUB(CURDATE(), INTERVAL 61 DAY) THEN 1 ELSE 0 END) \"-2 Mes\", ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 120 DAY) AND DATE_SUB(CURDATE(), INTERVAL 91 DAY) THEN 1 ELSE 0 END) \"-3 Mes\", ";
    $query=$query."          sum(CASE WHEN g.chk_recepcio_cuestionario = 1 AND g.f_recepcion_cuestionario BETWEEN DATE_SUB(CURDATE(), INTERVAL 150 DAY) AND DATE_SUB(CURDATE(), INTERVAL 121 DAY) THEN 1 ELSE 0 END) \"-4 Mes\" ";
    $query=$query."FROM     expan_gestionsolicitudes g, expan_franquicia f  ";
    $query=$query."WHERE    g.deleted = 0 AND   ";
    $query=$query."         f.id = g.franquicia AND   ";
    $query=$query."         tipo_cuenta IN (1, 2)  ";
    $query=$query."GROUP BY franquicia  ";
    $query=$query."ORDER BY tipo_cuenta, f.name  ";

// echo "<BR>".$query."<BR>";

    InsertaConsulta($objPHPExcel, $query, 'Formularios recibidos');

    $descripcion = array("listado de formularios recibidos por franquicia",
      "Se ordena por nombre de la franquicia");

    InsertarDescripcion($objPHPExcel, $descripcion, 'Formularios recibidos');


    // Número de bajas

    $query = "SELECT   f.name as Franquicia ,        ";
    $query=$query."        sum(CASE WHEN ma.c_accion='BE' and ma.f_accion BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Num Bajas Expande\", ";
    $query=$query."        sum(CASE WHEN ma.c_accion='BF' and ma.f_accion BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"Num Bajas Franquicia\" ";
    $query=$query."FROM     expan_gestionsolicitudes g, expan_franquicia f , (select gestion_id,c_accion, min(f_accion) f_accion from expan_mailing_actions group by gestion_id, c_accion) ma ";
    $query=$query."WHERE    f.id = g.franquicia AND   ";
    $query=$query."         g.id=ma.gestion_id AND          ";
    $query=$query."         tipo_cuenta IN (1, 2) AND ";
    $query=$query."         g.deleted = 0 AND           ";
    $query=$query."         f.deleted = 0           ";
    $query=$query."GROUP BY franquicia  ";
    $query=$query."ORDER BY tipo_cuenta, f.name ; ";

// echo "<BR>".$query."<BR>";

    InsertaConsulta($objPHPExcel, $query, 'Bajas de envios');

    $descripcion = array("listado debajas de las franquicias o de expandenegocio",
      "Se ordena por nombre de la franquicia");

    InsertarDescripcion($objPHPExcel, $descripcion, 'Bajas de envios');


    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $writer->save($filePath);
  }

