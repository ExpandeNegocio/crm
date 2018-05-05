<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Inicio' );

    $db = DBManagerFactory::getInstance();

    $nomFran=$_POST["nomFran"];
    $idFran=$_POST["idFran"];
    $nomSector=$_POST["nomSector"];
    $idFranquicias=$_POST["franquicias"];
    $evento=$_POST["evento"];
    $formato=$_POST["formato"];
    $estado=$_POST["estado"];
    $tipo=$_POST["tipo"];
    
    switch ($tipo) {
        case 'SectorFromFranq':
            
            $sectores=array();   
            $nomFran=str_replace(",","','",$nomFran);         
            $query="SELECT s.d_subsector sub, s.c_sector FROM expan_franquicia f, expan_m_sectores s ";
            $query=$query."WHERE replace(f.sector,'^','')=s.c_id AND f.deleted=0 AND f.name in  ('".$nomFran."');";
            
            $result = $db -> query($query, true);       
            while ($row = $db -> fetchByAssoc($result)) {
                if (!in_array($row['sub'],$sectores)){
                    $sectores[]=$row['sub'];
                }
                if (!in_array($row['c_sector'],$sectores)){
                    $sectores[]=$row['c_sector'];
                }               
            }              
            $salida= implode("|", $sectores);
            
            echo $salida;
            
            break;
        
        case 'FranqFromSector':
            
            $franquicias=array();
            $nomSector=str_replace(",","','",$nomSector);
            
    /*        $query = "SELECT f.name fran FROM expan_franquicia f, expan_m_sectores s ";
            $query=$query."WHERE replace(f.sector, '^', '') = s.c_id AND f.deleted=0 AND s.c_sector in ('".$nomSector."')"; */
            
            $query = "SELECT f.name fran FROM expan_franquicia f, expan_m_sectores s ";
            $query=$query."WHERE replace(f.sector, '^', '') = s.c_id AND f.tipo_cuenta in (1,2) AND f.deleted=0 AND s.c_sector in ('".$nomSector."')";
            
            $result = $db -> query($query, true);       
            while ($row = $db -> fetchByAssoc($result)) {
               $franquicias[]=$row['fran'];
            }              
            $salida= implode("|", $franquicias);
            
            echo $salida;
                        
            break;             
            
        case 'FranqEstadoEvento':
            
            //si el estado es a facturar o incluido, cambiarel origen etc
                        
            $listaFranquicias=str_replace("!","','",$idFranquicias);
            
            $query = "UPDATE expan_franquicia_expan_evento_c set participacion='".$estado."' ";
            $query=$query."WHERE expan_franquicia_expan_eventoexpan_evento_idb='".$evento."'";
            $query=$query."AND deleted=0 AND expan_franquicia_expan_eventoexpan_franquicia_ida in ('". $listaFranquicias."')";
            
            $result = $db -> query($query);
            
            if($estado=='1'||$estado=='2'){ //se pasa a facturar o incluido, hay que cambiar las gestiones asociadas
            
                $query="update expan_gestionsolicitudes g join (select g.id from expan_gestionsolicitudes g, expan_franquicia f where "; 
                $query=$query. " (g.evento_bk is not null and g.evento_bk<>'') and g.franquicia=f.id and g.franquicia in ('".$listaFranquicias."') ";
                $query=$query. " and g.evento_bk='".$evento."' ";
                $query=$query. " and g.deleted=0 and f.deleted=0) b on g.id=b.id set g.tipo_origen=3, g.expan_evento_id_c=g.evento_bk, g.evento_bk = null;";
                
                $result = $db -> query($query);
            }
            
            echo 'Ok';
                      
            break;
            
        case 'FranEventoFormato':
        
            $listaFranquicias=str_replace("!","','",$idFranquicias);
            
            $query = "UPDATE expan_franquicia_expan_evento_c set formato_participacion='".$formato."' ";
            $query=$query."WHERE expan_franquicia_expan_eventoexpan_evento_idb='".$evento."'";
            $query=$query."AND deleted=0 AND expan_franquicia_expan_eventoexpan_franquicia_ida in ('". $listaFranquicias."')";
            
            $result = $db -> query($query);
                 
            echo 'Ok';
        
            break;
            
        case 'FranqModeloNegocio':
            
            $query = "select modNeg1,modNeg2,modNeg3,modNeg4 from expan_franquicia where id='".$idFran."'";
 
            $result = $db -> query($query, true);
            
            while ($row = $db -> fetchByAssoc($result)) {
               $ModelosNeg=$row['modNeg1']."|";
               $ModelosNeg=$ModelosNeg.$row['modNeg2']."|";
               $ModelosNeg=$ModelosNeg.$row['modNeg3']."|";
               $ModelosNeg=$ModelosNeg.$row['modNeg4'];
            } 
            
            echo $ModelosNeg;
            
            break;            
        
        default:
            
            break;
    }

?>
