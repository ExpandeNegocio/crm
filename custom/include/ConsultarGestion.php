<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('data/SugarBean.php');
require_once('custom/modules/Expan_GestionSolicitudes/metadata/CreateCxButtonsHelper.php');
require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');

$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
$GLOBALS['log']->info('[ExpandeNegocio][ConsultaFranquicia]Inicio');

$db = DBManagerFactory::getInstance();

$idGest = $_POST["gestId"];
$tipo = $_POST["tipo"];
$cx = $_POST["cx"];

switch ($tipo) {
  case 'RecogeDocumentosRecibidosGestion':

    $db = DBManagerFactory::getInstance();

    $return = array();

    $query = "SELECT concat('<a href=index.php?entryPoint=download&id=', n.id, '&type=Notes\">', n.name, '</a>') Documento, n.date_entered Fecha ";
    $query = $query . "FROM   expan_gestionsolicitudes g, emails e, notes n ";
    $query = $query . "WHERE  e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0 AND (e. ";
    $query = $query . "       status = 'read' OR e.status = 'unread') AND n.parent_id = e.id AND g.id='" . $idGest . "'";
    $query = $query . "order by  n.date_entered DESC; ";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $return[] = $row;
    }

    echo json_encode($return, JSON_FORCE_OBJECT);
    break;
  case 'RecogeAccionesMailingGestion':

    $db = DBManagerFactory::getInstance();

    $return = array();

    $query = "select accion,f_accion,t.name Plantilla,m.name Mailing, n.document_name Documento from ( ";
    $query=$query."select at.name accion, f_accion, id_template,c_doc,id_mailing ";
    $query=$query."from expan_mailing_actions a, expan_mailing_action_type at ";
    $query=$query."where gestion_id='$idGest' AND a.c_accion=at.id)b ";
    $query=$query."left join email_templates t on t.id=id_template ";
    $query=$query."left join expan_mailings m on m.id=id_mailing ";
    $query=$query."left join (select r.id rid, d.document_name FROM documents d, document_revisions r where d.id=r.document_id )n on n.rid= c_doc  ";
    $query=$query."order by f_accion; ";

    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $return[] = $row;
    }

    echo json_encode($return, JSON_FORCE_OBJECT);
    break;

  case 'RecogeDocumentosEnviadosGestion':

    $db = DBManagerFactory::getInstance();

    $return = array();

  /*  $query = "SELECT   DISTINCT concat('<a href=index.php?entryPoint=download&id=', nid, '&type=Notes\">', name, '</a>') Documento,date_format(fecha ,'%d/%m/%Y') Fecha,tipo    ";
    $query=$query."FROM     (SELECT n.id nid, n.name, e.date_sent fecha , 'Enviado' as tipo ";
    $query=$query."          FROM   expan_gestionsolicitudes g,  emails e, notes n   ";
    $query=$query."          WHERE e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0   ";
    $query=$query."                 AND (e.status = 'sent') AND n.parent_id = e.id AND g.id= '" . $idGest . "'   ";
    $query=$query."          UNION ALL  ";
    $query=$query."          SELECT n.id nid, n.name, e.date_sent fecha, 'Enviado' as tipo  ";
    $query=$query."          FROM   emails e, email_templates et, expan_gestionsolicitudes g, notes n  ";
    $query=$query."          WHERE  g.id = '" . $idGest . "' AND e.parent_id = g.id AND n.parent_id = et.id AND e.status = 'sent' AND e.deleted = 0 AND n  ";
    $query=$query."            .deleted = 0 AND (modeloneg IS NULL OR (modeloneg = 1 AND g.tiponegocio1 = 1) OR (modeloneg = 2 AND g.tiponegocio2 = 1) OR  ";
    $query=$query."            (modeloneg = 3 AND g.tiponegocio3 = 1) OR (modeloneg = 4 AND g.tiponegocio4 = 1)) AND e.name = replace(et.subject, \"'\", \"\") ";
    $query=$query."          UNION ALL ";
    $query=$query."          select dr.id , dr.filename , a.f_accion, 'Descargado' as tipo  ";
    $query=$query."          from expan_mailing_actions a,document_revisions dr  ";
    $query=$query."          where gestion_id='" . $idGest . "' and dr.id= a.c_doc and c_accion='DF' and deleted=0 group by gestion_id, c_doc                       ";
    $query=$query."       ) yy   ";
    $query=$query."ORDER BY fecha DESC   ";*/

    $query = "SELECT   DISTINCT concat('<a href=index.php?entryPoint=download&id=', nid, '&type=Notes\">', name, '</a>') Documento, date_format(fecha, '%d/%m/%Y') Fecha, tipo ";
    $query=$query."FROM     (SELECT n.id nid, n.name, e.date_sent fecha, 'Enviado' AS tipo ";
    $query=$query."          FROM   expan_gestionsolicitudes g, emails e, notes n ";
    $query=$query."          WHERE  e.parent_id = g.id AND e.deleted = 0 AND g.deleted = 0 AND n.deleted = 0 AND (e.status = 'sent') AND n.parent_id ";
    $query=$query."                 = ";
    $query=$query."                 e.id AND g.id = '$idGest' ";
    $query=$query."          UNION ALL ";
    $query=$query."          SELECT n.id nid, n.name, e.date_sent fecha, 'Enviado' AS tipo ";
    $query=$query."          FROM   emails e, expan_gestionsolicitudes g, notes n, adjuntos j ";
    $query=$query."          WHERE  g.id = '$idGest' AND e.parent_id = g.id AND j.id_note = n.id AND j.id_email = e.id ";
    $query=$query."                 AND e.status = ";
    $query=$query."                 'sent' AND e.deleted = 0 AND n.deleted = 0 ";
    $query=$query."          UNION ALL ";
    $query=$query."          SELECT   dr.id, dr.filename, a.f_accion, 'Descargado' AS tipo ";
    $query=$query."          FROM     expan_mailing_actions a, document_revisions dr ";
    $query=$query."          WHERE    gestion_id = '$idGest' AND dr.id = a.c_doc AND c_accion = 'DF' AND deleted = 0 ";
    $query=$query."          GROUP BY gestion_id, c_doc) yy ";
    $query=$query."ORDER BY fecha DESC; ";


    $result = $db->query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
      $return[] = $row;
    }

    echo json_encode($return, JSON_FORCE_OBJECT);
    break;

  case  'actDesBotonesReenvio':

    $gestion = new Expan_GestionSolicitudes();
    $gestion->retrieve($idGest);

    $franquicia = new Expan_Franquicia();
    $franquicia->retrieve($gestion->franquicia);

    $buttonHelper = new CreateCxButtonsHelper($gestion, $franquicia);
    echo $buttonHelper->cxActivo($cx);

    break;

  case 'colorBotonesReenvio':

    $gestion = new Expan_GestionSolicitudes();
    $gestion->retrieve($idGest);

    $franquicia = new Expan_Franquicia();
    $franquicia->retrieve($gestion->franquicia);

    $buttonHelper = new CreateCxButtonsHelper($gestion, $franquicia);
    echo $buttonHelper->calculateCxColor($cx);

    break;

  default:

    break;
}

?>