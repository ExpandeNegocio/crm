<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Franquicia/Expan_Franquicia.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][CrearLlamadaRecorFranquicia]Inicio' );

    $db = DBManagerFactory::getInstance();
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][CrearLlamadaRecorFranquicia] Consulta con las franquicias');
    
    $query= "select id from ";
    $query=$query." expan_franquicia where id not in (select distinct parent_id from calls where parent_type='Expan_Franquicia' ";
    $query=$query." AND TIMESTAMPDIFF (day, DATE(date_start), curdate())<15 AND deleted=0) and tipo_cuenta=1 and deleted=0;";
   
    //ejecución consulta
    $result = $db -> query($query);

    $row = $db -> fetchByAssoc($result);
    //recorrer todas las franquicias de la respuesta
    while ($row = $db -> fetchByAssoc($result)) {
        
        $idFran = $row['id'];
        
        $fran = new Expan_Franquicia();
        $fran -> retrieve($idFran);
        
          $fran -> creaLlamadaRecor("[AUT]De seguimiento", "FRANSeg");
        
    }
    
    echo "Finalizada la creación de llamadas de recordatorio";

?>    