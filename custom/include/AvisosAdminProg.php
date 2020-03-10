  <?php
    require_once ('data/SugarBean.php');

    $NUM_DIAS_VENCIMIENTO=15;
    $NUM_DIAS_VENCIMIENTO_AVISO2=7;

    $AvisosAdmin= new AvisosAdmin();
    $db = DBManagerFactory::getInstance();

    //Envio aviso 15 dias antes de que finalice el periodo
    $query = "select f.name franquicia, p.name portal,pp.f_fin fecha from expan_portales_periodos pp, expan_portales p, expan_franquicia f ";
    $query=$query."where pp.portal=p.id and pp.franquicia=f.id and (TIMESTAMPDIFF(DAY, f_fin, CURDATE())= $NUM_DIAS_VENCIMIENTO ";
    $query=$query." or TIMESTAMPDIFF(DAY, f_fin, CURDATE())= $NUM_DIAS_VENCIMIENTO_NUM_DIAS_VENCIMIENTO_AVISO2) and  ";
    $query=$query."f_fin>curdate() ";

    $result = $db -> query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
        $AvisosAdmin->enviaCorreo( AvisosAdmin::SALIDA_PORTAL,$row["franquicia"],$row["portal"],$row["fecha"]);
    }

    //Envio aviso 15 dias antes de que sea la feria
    $query = "select name,fecha_celebracion from expan_evento  ";
    $query=$query."where (TIMESTAMPDIFF(DAY, fecha_celebracion, CURDATE())= 15 ";
    $query=$query." or TIMESTAMPDIFF(DAY, fecha_celebracion, CURDATE())= 7)  ";
    $query=$query."and fecha_celebracion>curdate(); ";

    $result = $db -> query($query, true);

    while ($row = $db->fetchByAssoc($result)) {
        $AvisosAdmin->enviaCorreo( AvisosAdmin::FACT_EVENTO,'',$row["name"],$row["fecha_celebracion"]);
    }

