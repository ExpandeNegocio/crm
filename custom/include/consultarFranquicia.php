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
    $idFranquicia=$_POST["idFranquicia"];
    $evento=$_POST["evento"];
    $formato=$_POST["formato"];
    $estado=$_POST["estado"];
    $tipo=$_POST["tipo"];
    $valor=$_POST["valor"];
    $pregunta=$_POST["pregunta"];
        
    $empresa_id=$_POST["empresa_id"];
    $id=$_POST["id"];

    $nom_central=$_POST["nom_central"];
    $ubicacion=$_POST["ubicacion"];
    $f_entrevista=$_POST["f_entrevista"];
    $correo_central=$_POST["correo_central"];
    $cargo_central=$_POST["cargo_central"];
    $telefono_central=$_POST["telefono_central"];
    $nom_utilizado=$_POST["nom_utilizado"];
    $correo_utilizado=$_POST["correo_utilizado"];
    $telefono_utilizado=$_POST["telefono_utilizado"];
    $catalogos=$_POST["catalogos"];
    $usuario=$_POST["usuario"];
    $informacion_obtenida=$_POST["informacion_obtenida"];

    $nom_entrevistado = $_POST["nom_entrevistado"];
    $telefono_entrevistado = $_POST["telefono_entrevistado"];
    $tipo_entrevista_fdo = $_POST["tipo_entrevista_fdo"];
    $tipo_entrevista_central = $_POST["tipo_entrevista_central"];
    $email_entrevistado = $_POST["email_entrevistado"];
    $year_fran = $_POST["year_fran"];
    $nivel_satisfaccion = $_POST["nivel_satisfaccion"];
    $informacion_proporcionada = $_POST["informacion_proporcionada"];

    $chk_central=$_POST["chk_central"];
    $chk_fdo=$_POST["chk_fdo"];

    $numPreg=$_POST["numPreg"];

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
                $query=$query. " and g.deleted=0 and f.deleted=0) b on g.id=b.id set g.tipo_origen=3, g.subor_expande=null, g.expan_evento_id_c=g.evento_bk, g.evento_bk = null;";

                $GLOBALS['log'] -> info('[ExpandeNegocio][FranqEstadoEvento] cONSULTA Paso a 1-2 -'.$query);

                $result = $db -> query($query);
            }
            
            if ($estado=='3'){
                    
                $query = "UPDATE ";
                $query=$query." expan_gestionsolicitudes g ";
                $query=$query." JOIN (SELECT ";
                $query=$query."        g.id ";
                $query=$query."       FROM ";
                $query=$query."        expan_gestionsolicitudes g, ";
                $query=$query."        expan_franquicia f ";
                $query=$query."       WHERE ";
                $query=$query."        g.franquicia = f.id AND ";
                $query=$query."        g.franquicia IN ('".$listaFranquicias."') AND ";
                $query=$query."        g.expan_evento_id_c = '".$evento."' AND ";
                $query=$query."        g.deleted = 0 AND ";
                $query=$query."        f.deleted = 0) b ";
                $query=$query."   ON g.id = b.id ";
                $query=$query."SET ";
                $query=$query." g.tipo_origen       = 1, ";
                $query=$query." g.subor_expande = 7, ";
                $query=$query." g.expan_evento_id_c = NULL, ";
                $query=$query." g.evento_bk         = expan_evento_id_c; ";
                
                $GLOBALS['log'] -> info('[ExpandeNegocio][FranqEstadoEvento] cONSULTA Paso a 3 -'.$query);
                        
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

        case 'GastoAsociado':

            $listaFranquicias=str_replace("!","','",$idFranquicias);

            $query = "UPDATE expan_franquicia_expan_evento_c set gastos_asociados=".$valor." ";
            $query=$query."WHERE expan_franquicia_expan_eventoexpan_evento_idb='".$evento."'";
            $query=$query."AND deleted=0 AND expan_franquicia_expan_eventoexpan_franquicia_ida in ('". $listaFranquicias."')";

            $result = $db -> query($query);

            echo 'Ok';

            break;

        case 'CosteAccion':

            $listaFranquicias=str_replace("!","','",$idFranquicias);

            $query = "UPDATE expan_franquicia_expan_evento_c set coste_accion=".$valor." ";
            $query=$query."WHERE expan_franquicia_expan_eventoexpan_evento_idb='".$evento."'";
            $query=$query."AND deleted=0 AND expan_franquicia_expan_eventoexpan_franquicia_ida in ('". $listaFranquicias."')";

            $result = $db -> query($query);

            echo 'Ok';

            break;
            
        case 'ListaDocumentos':
            
            $query = "select Franquicia, ModeloNegocio,    ";
            $query=$query."  chk_c1 as ValidadoC1,   ";
            $query=$query."  max(case when type= 'C1' THEN doc ELSE '' END) as C1,   ";
            $query=$query."  chk_c2 as ValidadoC2,   ";
            $query=$query."  max(case when type= 'C2' THEN doc ELSE '' END) as C2,    ";
            $query=$query."  chk_c3 as ValidadoC3,   ";
            $query=$query."  max(case when type= 'C3' THEN doc ELSE '' END) as C3,   ";
            $query=$query."  chk_c4 as ValidadoC4,   ";
            $query=$query."  max(case when type= 'C4' THEN doc ELSE '' END) as C4    ";
            $query=$query."from (    ";
            $query=$query."    select f.name as Franquicia,    ";
            $query=$query."      chk_c1,chk_c2,chk_c3,chk_c4,   ";
            $query=$query."     case WHEN modeloneg=1 THEN coalesce(f.modNeg1,null,'')    ";
            $query=$query."          WHEN modeloneg=2 THEN coalesce(f.modNeg2,null,'')    ";
            $query=$query."          WHEN modeloneg=3 THEN coalesce(f.modNeg3,null,'')    ";
            $query=$query."          WHEN modeloneg=4 THEN coalesce(f.modNeg4,null,'') ELSE  '' END as ModeloNegocio,     ";
            $query=$query."     type,    ";
            $query=$query."     GROUP_CONCAT(DISTINCT concat('<a style=\"color:###;\" href=\"index.php?entryPoint=download&type=Notes&id=',n.id,'\">',n.filename,' (',DATE_FORMAT(n.date_entered,'%d/%m/%Y'),')-',u.first_name,'</a>')   ";
            $query=$query."                          ORDER BY filename DESC SEPARATOR '<BR>') doc    ";
            $query=$query."    from expan_franquicia f, email_templates t, notes n, users u, documents_notes dn ";
            $query=$query."    where f.id=t.franquicia    ";
            $query=$query."    AND dn.note_id= n.id ";
            $query=$query."    AND n.parent_id=t.id    ";
            $query=$query."    AND f.tipo_cuenta  in (1,2)    ";
            $query=$query."    AND f.deleted=0 and t.deleted=0 and n.deleted=0    ";
            $query=$query."    AND type in ('C1','C2','C3','C4')    ";
            $query=$query."    AND n.modified_user_id=u.id ";
            $query=$query."    group by franquicia,modeloneg, t.type     ";
            $query=$query."    order by franquicia,modeloneg) a    ";
            $query=$query."group by franquicia, modelonegocio; ";

           $result = $db -> query($query, true);
            
            $return = array();

            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }     
                                  
            echo json_encode($return,JSON_FORCE_OBJECT);
                    
            break;
            
        case 'ValidacionPlantillas':
        
            $query = "SELECT   Franquicia, ModeloNegocio,  ";
            $query=$query."max(CASE WHEN type = 'C1' THEN doc ELSE '' END) AS C1,  ";
            $query=$query."max(CASE WHEN type = 'C2' THEN doc ELSE '' END) AS C2,  ";
            $query=$query."max(CASE WHEN type = 'C3' THEN doc ELSE '' END) AS C3,  ";
            $query=$query."max(CASE WHEN type = 'C4' THEN doc ELSE '' END) AS C4 ";
            $query=$query."FROM     (SELECT   f.name AS Franquicia, chk_c1, chk_c2, chk_c3, chk_c4,  ";
            $query=$query."CASE WHEN modeloneg = 1 THEN f.modNeg1 WHEN modeloneg = 2 THEN f.modNeg2 WHEN modeloneg = 3 THEN f.modNeg3 WHEN modeloneg = 4 THEN f.modNeg4 ELSE '' END AS ModeloNegocio,  ";
            $query=$query."type, GROUP_CONCAT(DISTINCT trim(concat( coalesce(u.first_name,\"\") , \" \" , coalesce(u.last_name,\"\") ,  ' - ',coalesce(t.f_revision,\"\"))  ) SEPARATOR '<BR>') doc ";
            $query=$query."          FROM     expan_franquicia f, email_templates t, users u ";
            $query=$query."          WHERE    f.id = t.franquicia  AND f.tipo_cuenta IN (1, 2) AND f.deleted = 0 ";
            $query=$query."                   AND t.deleted = 0  AND type IN ('C1', 'C2', 'C3', 'C4') AND t.revisedby_user_id = u.id ";
            $query=$query."          GROUP BY franquicia, modeloneg, t.type ";
            $query=$query."          ORDER BY franquicia, modeloneg) a ";
            $query=$query."GROUP BY franquicia, modelonegocio ";
                    
            $result = $db -> query($query, true);
            
            $return = array();

            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }     
                                  
            echo json_encode($return,JSON_FORCE_OBJECT);
                    
            break;                 
            
		    case 'user':
            
            global $current_user;     
            echo $current_user->id;
            
            break; 
            
        case 'addMisteryFranqFdo':

            $uuid=getUuid();

            //Guardamos datos de franquiciado
            $query = "INSERT INTO expan_empresa_mistery_fdo  ";
            $query=$query."(id,franquicia_id,empresa_id,nom_entrevistado,telefono_entrevistado,correo_entrevistado,ubicacion,f_entrevista,id_usuario,nom_utilizado,email_utilizado,telefono_utilizado,tipo_entrevista,year_fran,nivel_satisfaccion,informacion_proporcionada,informacion_obtenida)   ";
            $query=$query."VALUES   ";
            $query=$query."('$uuid','$idFranquicia','$empresa_id','$nom_entrevistado','$telefono_entrevistado','$email_entrevistado','$ubicacion',STR_TO_DATE('$f_entrevista','%d/%m/%Y'),'$usuario','$nom_utilizado','$correo_utilizado','$telefono_utilizado','$tipo_entrevista_fdo','$year_fran','$nivel_satisfaccion','$informacion_proporcionada','$informacion_obtenida'); ";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta Insercion mistery-'.$query);

            $result = $db -> query($query);

            //Guardamos preguntas

            if ($numPreg>0){

                for ($i=0;$i<$numPreg;$i++){
                    $idPreg=$_POST["idpreg".$i];
                    $respuesta=$_POST["respuesta".$i];
                    if ($respuesta!=''){
                        $query = "INSERT INTO expan_franquicia_resp_mis (id, id_pregunta, id_mistery, date_entered,respuesta) values  ";
                        $query=$query."(UUID(),'$idPreg','$uuid',now(),'$respuesta')";
                        $result = $db -> query($query);
                    }
                }
            }

            echo "Ok";

            break;

        case 'addMisteryFranqCentral':

            $query = "INSERT INTO expan_empresa_mistery_central ";
            $query=$query."(id,franquicia_id,empresa_id,nom_central,correo_central,cargo_central,telefono_central,nom_utilizado,id_usuario,correo_utilizado,telefono_utilizado,f_entrevista,catalogos,ubicacion,informacion_obtenida,tipo_entrevista)  ";
            $query=$query."VALUES  ";
            $query=$query."(UUID(),'$idFranquicia','$empresa_id','$nom_central','$correo_central','$cargo_central','$telefono_central','$nom_utilizado','$usuario','$correo_utilizado','$telefono_utilizado',STR_TO_DATE('$f_entrevista', '%d/%m/%Y'),'$catalogos','$ubicacion','$informacion_obtenida'.'$tipo_entrevista_central')";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta Insercion mistery-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;

        case 'BajaMisteryFranqFdo':
        
            $query = "delete from expan_empresa_mistery_fdo where id='".$id."'";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta baja mistery-'.$query);
        
            $result = $db -> query($query);         
        
            echo "Ok";
        
            break;

        case 'BajaMisteryFranqCentral':

            $query = "delete from expan_empresa_mistery_central where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta baja mistery-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;

        case 'ConsultarPreguntasMistery':

            $query = "select * from expan_franquicia_resp_mis where id_mistery='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta preguntas mistery-'.$query);

            $return = array();

            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
                $return[] = $row;
            }

            echo json_encode($return,JSON_FORCE_OBJECT);

            break;
            
        case 'ConsultaMisteryFdo':
        
            $query = "select * from expan_empresa_mistery_fdo where id='".$id."'";
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta mistery-'.$query);
           
            $return = array();
            
            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {                   
                $return[] = $row;
            }     
                                  
            echo json_encode($return,JSON_FORCE_OBJECT);
                    
            break;

        case 'ConsultaMisteryCentral':

            $query = "select * from expan_empresa_mistery_central where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta mistery-'.$query);

            $return = array();

            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
                $return[] = $row;
            }

            echo json_encode($return,JSON_FORCE_OBJECT);

            break;

        case 'ConsultaMisteryPregunta':

            $query = "select * from expan_franquicia_pregunta_mis where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta mistery-'.$query);

            $return = array();

            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
                $return[] = $row;
            }

            echo json_encode($return,JSON_FORCE_OBJECT);

            break;

        case 'BajaMisteryFranqPregunta':

            $query = "delete from expan_franquicia_pregunta_mis where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta baja mistery-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;


        case 'addMisteryFranqPregunta':

            $query = "INSERT INTO expan_franquicia_pregunta_mis ";
            $query=$query."(id,date_entered,franquicia_id,pregunta,chk_central,chk_fdo)  ";
            $query=$query."VALUES  ";
            $query=$query."(UUID(), now(),'$idFranquicia','$pregunta',$chk_central,$chk_fdo)";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta Insercion pregunta mistery-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;

        case 'addPrecanFranqPregunta':

            $query = "INSERT INTO expan_franquicia_pregunta_pre ";
            $query=$query."(id,date_entered,franquicia_id,pregunta)  ";
            $query=$query."VALUES  ";
            $query=$query."(UUID(), now(),'$idFranquicia','$pregunta')";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta Insercion pregunta pre-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;

        case'BajaPrecanFranqPregunta':
            $query = "delete from expan_franquicia_pregunta_pre where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta baja pregunta pre-'.$query);

            $result = $db -> query($query);

            echo "Ok";

            break;

        case 'ConsultaPrecanPregunta':

            $query = "select * from expan_franquicia_pregunta_pre where id='".$id."'";

            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Consulta precandidatos-'.$query);

            $return = array();

            $result = $db -> query($query, true);

            while ($row = $db -> fetchByAssoc($result)) {
              $return[] = $row;
            }

            echo json_encode($return,JSON_FORCE_OBJECT);

            break;

        default:

            break;
    }

    function getUuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0x0fff) | 0x4000,
          mt_rand(0, 0x3fff) | 0x8000,
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

?>
