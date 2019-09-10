<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    require_once ('custom/modules/Expan_Portales/metadata/opEdicionFranquicia.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][OperarPortales]Inicio' );

    $db = DBManagerFactory::getInstance();

    $tipo=$_POST["tipo"];
    $pId=$_POST["pId"];
    $listaFranPak=$_POST["listaFran"];
    $portal=$_POST["portal"];
    $prueba=$_POST["prueba"];
    $f_ini=$_POST["f_ini"];
    $f_fin=$_POST["f_fin"];
    $coste=$_POST["coste"];
    $year=$_POST["year"];
    $soloEN=$_POST["soloEN"];
        
    switch ($tipo) {
        case 'AltaFranquicia':                    
            
            $listaFran = explode(',', $listaFranPak);
            
            foreach ($listaFran as $franquicia){
                $query="insert into expan_portales_periodos (id,portal,franquicia,coste,f_inicio,f_fin) values ";
                $query=$query." (UUID(),'".$portal."','".$franquicia."',".$coste.",STR_TO_DATE('".$f_ini."', '%d/%m/%Y'),STR_TO_DATE('".$f_fin."', '%d/%m/%Y'))";            
                $result = $db -> query($query); 
            }        
            
            echo 'ok';
            break;
        
        case 'BajaPeriodo':     
        
            $query="delete from expan_portales_periodos where id='".$pId."'";            
            $result = $db -> query($query); 
        
            echo 'ok';
            break;
            
        case 'ChangeYear':
            
            $op=new opEdicionFranquicia();
            $codigo=$op->listaFranquicias($portal,$year);
            echo $codigo;
            
            break;

        case 'getFran':

            $return = array();

            if ($soloEN=='true'){
              $query = "select id,name from expan_franquicia where deleted=0 and tipo_cuenta in (1,2,3) order by name ";
            }else{
              $query = "select id,name from expan_franquicia where deleted=0 and tipo_cuenta in (1,2,3,4,5) order by name ";
            }

            $result = $db->query($query, true);

            while ($row = $db->fetchByAssoc($result)) {
              $return[] = $row;
            }

            echo json_encode($return, JSON_FORCE_OBJECT);

            break;
        
        default:
            
            break;
    }
    
    
    function existeTramo($franquicia,$portal,$f_ini,$f_fin){
        
        $db = DBManagerFactory::getInstance();
         
        $query="select count(1) num from expan_portales_periodos where ";
   
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $cont = $row["num"];
        }
        
        return $cont;
    }
    
?>