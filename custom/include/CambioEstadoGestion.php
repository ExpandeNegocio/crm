<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    
    $ids = $_POST['gestiones'];
    $estado = $_POST['estado'];
    $subestado = $_POST['subestado'];
    $listaGest = split('!', $ids);
    
    foreach ($listaGest as $idGest) {
    
        if ($idGest != "") {
    
            $GLOBALS['log'] -> info('[ExpandeNegocio][Cambio estado Gestion]idGeston-' . $idGest);
    
            $gestion = new Expan_GestionSolicitudes();
            $gestion -> retrieve($idGest);
    
            $GLOBALS['log'] -> info('[ExpandeNegocio][Cambio estado Gestion]Nombre Gestion-' . $gestion -> name);
    
            $gestion -> estado_sol = $estado;
    
            if ($estado == Expan_GestionSolicitudes::ESTADO_PARADO) {
                $gestion -> motivo_parada = $subestado;
            }
            if ($estado == Expan_GestionSolicitudes::ESTADO_DESCARTADO) {
                $gestion -> motivo_descarte = $subestado;
            }
            if ($estado == Expan_GestionSolicitudes::ESTADO_POSITIVO) {
                $gestion -> motivo_positivo = $subestado;
            }
    
            $gestion -> save();
        }
    }
    
    echo 'Ok';
?>