<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][getObservacionesMemo]Inicio' );
    
    header("Content-type: text/xml");
    
    $idFranq=$_GET["idFranqui"];
    
    $db = DBManagerFactory::getInstance();
    
    
    $query = "SELECT g.id gid, preguntas_mn_t,objeciones_mn,solicitudes_candidato,informacion_competencia,mejoras,concesiones ";
    $query=$query."FROM expan_gestionsolicitudes g, expan_franquicia f  ";
    $query=$query."WHERE ( not((preguntas_mn_t is null or trim(replace(preguntas_mn_t,'\r\n',''))='') ";
    $query=$query."            AND (objeciones_mn is null or trim(replace(objeciones_mn,'\r\n',''))='')  ";
    $query=$query."            AND (solicitudes_candidato is null or trim(replace(solicitudes_candidato,'\r\n',''))='')  ";
    $query=$query."            AND (informacion_competencia is null or trim(replace(informacion_competencia,'\r\n',''))='')  ";
    $query=$query."            AND (mejoras is null or trim(replace(mejoras,'\r\n',''))='')  ";
    $query=$query."            AND (concesiones is null or trim(replace(concesiones,'\r\n',''))=''))) ";
    $query=$query."and g.deleted=0 and f.id=g.franquicia  ";
    $query=$query."AND f.name='".$idFranq."'";                                   
                                    
    $result = $db -> query($query, true);
    
    $xml = new SimpleXMLElement('<xml></xml>');
    
    while ($row = $db -> fetchByAssoc($result)) {
        
        $gestion=$xml->addChild('expan_gestionsolicitud');
        $gestion->addChild('gid',$row['id']);
        $gestion->addChild('preguntas_mn_t',$row['preguntas_mn_t']);       
        $gestion->addChild('objeciones_mn',$row['objeciones_mn']);
        $gestion->addChild('solicitudes_candidato',$row['solicitudes_candidato']);
        $gestion->addChild('informacion_competencia',$row['informacion_competencia']);  
        $gestion->addChild('mejoras',$row['mejoras']);           
        $gestion->addChild('concesiones',$row['concesiones']);            
    }                                    
    
    echo $xml->asXML();
    
?>