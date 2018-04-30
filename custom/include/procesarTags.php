<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    
    $db = DBManagerFactory::getInstance();
    
    $query = "select tag from expan_tag_perfil";
    
    $result = $db -> query($query, true);
    
    //Recorremos los usuarios
    while ($row = $db -> fetchByAssoc($result)) {
    
        $tag = $row["tag"];
        $query2 = "select id from expan_solicitud where perfil_profesional like '%" . $tag . "%'; ";
    
        $result2 = $db -> query($query2, true);
    
        while ($row2 = $db -> fetchByAssoc($result2)) {
    
            $solicitud = new Expan_Solicitud();
            $solicitud -> retrieve($row2["id"]);
    
            $pakTag = "^" . $tag . "^";
    
            $pos = strpos($solicitud -> tags_empresa, $pakTag);
    
            if ($pos === false) {
                if ($solicitud -> tags_empresa == "" || $solicitud -> tags_empresa === null) {
                    $solicitud -> tags_empresa = $pakTag;
                } else {
                    $solicitud -> tags_empresa = $solicitud -> tags_empresa . "," . $pakTag;
                }
            }
        }
    }
?>