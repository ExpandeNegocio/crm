<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    
    $db = DBManagerFactory::getInstance();

    $query = "update expan_solicitud s join ( ";
    $query=$query."select distinct(s.id) id, s.perfil_profesional , tipoTag from expan_solicitud s, expan_tag_perfil t ";
    $query=$query."where s.perfil_profesional like concat('%',t.Tag,'%') ";
    $query=$query."and     instr(coalesce(tags_empresa,''),t.tipoTag)=0)a ";
    $query=$query."on s.id=a.id ";
    $query=$query."set s.tags_empresa=case when s.tags_empresa is null then a.tipoTag else concat(s.tags_empresa,',',tipoTag) end ";

    $result = $db -> query($query);;

?>