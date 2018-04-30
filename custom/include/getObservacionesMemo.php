<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][getObservacionesMemo]Inicio' );
    
    header("Content-type: text/xml");
    
    $idFranq=$_POST["idFranqui"];
    
    $db = DBManagerFactory::getInstance();

    $query = "SELECT * ";
    $query = $query . "FROM expan_gestionsolicitudes ";
    $query = $query . "WHERE preguntas_mn_t is not null";
                                    
                                    
    $result = $db -> query($query, true);
    
    $xml = new SimpleXMLElement('<xml></xml>');
    
    while ($row = $db -> fetchByAssoc($result)) {
        
        $gestion=$xml->addChild('expan_gestionsolicitud');
        $gestion->addChild('id',$row['id']);
        $gestion->addChild('preguntas_mn_t',$row['preguntas_mn_t']);       
        $gestion->addChild('objeciones_mn',$row['objeciones_mn']);
        $gestion->addChild('solicitudes_candidato',$row['solicitudes_candidato']);
        $gestion->addChild('informacion_competencia',$row['informacion_competencia']);  
        $gestion->addChild('mejoras',$row['mejoras']);           
        $gestion->addChild('concesiones',$row['concesiones']);            
    }                                    
    
    echo $xml->asXML();
    
?>