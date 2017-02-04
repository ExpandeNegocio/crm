<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('custom/include/CreacionGestionSolicitud.php');
    
    $id = $_POST['id'];
    
    $bean = new Expan_GestionSolicitudes();
    $bean -> retrieve($id);
    $bean -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
    
    $solicitud = null;
    foreach ($bean->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $sol) {
        $solicitud = $sol;
    }
    
    $cadena = "";
    
    $solicitud -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');
    
    foreach ($solicitud->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
        $cadena = $cadena . $gestion -> id . "#";
    }
    
    echo $cadena;
?>