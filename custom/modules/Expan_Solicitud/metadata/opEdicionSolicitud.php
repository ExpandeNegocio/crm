<?php
class opEdicionSolicitud {

	function cargaSectores() {
		
		global $current_user;
		global $app_list_strings;
		$nameFran=$app_list_strings['franquicia_list'][$current_user->franquicia];
		echo '<script language="javascript" type="text/JavaScript">function conControlUsuarioFran(){ControlUsuarioFran("'.$nameFran.'"); }; </script>';

		//Inicializamos valores de los sectores
		$i = 0;
		echo "<table style='width:100%'>" . "\n";

		//recogemos los sectores de la Base de datos
		$db = DBManagerFactory::getInstance();
		$query = "select * from expan_m_sectores order by m_orden_sector, d_subsector";

		$result = $db -> query($query, true);

		$listaSectores = array();
		$listaGrupoAct = array();
		$listaSubSector = array();

		//pasamos a arrays los resultados de la consulta
		while ($row = $db -> fetchByAssoc($result)) {
			$listaSectores[] = $row["c_sector"];
			$listaSubSector[] = $row["d_subsector"];
			$listaGrupoAct[] = $row["c_grupo_act"];
		}

		$sectorAnt = '';
		$grupoActAnt = '';

		for ($j = 0; $j < count($listaSectores); $j++) {

			//Iniciamos grupo de actividad
			if ($listaGrupoAct[$j] != $grupoActAnt) {
				echo "<tr>" . "\n" . "<td>";

				echo "<p style='margin-top: 15px;background-color:powderblue;'><b>" . $listaGrupoAct[$j] . "</b></p>";
				echo "</tr>" . "\n" . "</td>";
				$grupoActAnt = $listaGrupoAct[$j];
			}

			//Iniciamos Sector
			if ($listaSectores[$j] != $sectorAnt) {
				echo "<tr>" . "\n" . "<td>";
				//echo "<p style='margin-left: 15px;'>" . $listaSectores[$j] . "</p>";
				echo "<input type='checkbox' class='Sectorcheck SectorParentCheck' id='" . $listaSectores[$j] . "' value='" . $listaSectores[$j] . "' onclick='despliegoPliegoSector(\"".$listaSectores[$j]."\");' style='margin-left:15px'><label for='".$listaSectores[$j]."' class='css-label'>" . $listaSectores[$j]. "</label>". "\n";
				echo "</tr>" . "\n" . "</td>";
				$sectorAnt = $listaSectores[$j];
			}

			if ($i % 2 == 0) {
				echo "<tr>" . "\n";
			}
			echo "<td style='display:none; font-weight:smaller;'>" . "\n";
			echo "<input type='checkbox' name=".str_replace(" ","_",$listaSectores[$j])." class='Sectorcheck' id='" . $listaSubSector[$j] . "' value='" . $listaSubSector[$j] . "' onclick='cambiocheck(\"Sectorcheck\",\"sectores_de_interes\",true);' style='margin-left:25px'>" . $listaSubSector[$j] . "\n";
			echo "</td>" . "\n";
			if ($i % 2 != 0) {
				echo "</tr>" . "\n";
			}

			$i++;

		}
		echo "</tr></table>" . "\n";
	}

    private function pintaFranquicia($key,$value,$tipoCuenta){
        if ($tipoCuenta==1){
            echo "<b><input type='checkbox' class='francheck' id='" . $value . "' value='" . $key. "' onclick='cambiocheck(\"francheck\",\"franquicias_secundarias\",true);'   style='margin-left:15px' >" . $value . "</b><br/>";
        }else{
            echo "<input type='checkbox' class='francheck' id='" . $value . "' value='" . $key . "' onclick='cambiocheck(\"francheck\",\"franquicias_secundarias\",true);'   style='margin-left:15px' >" . $value . "<br/>";
        }
    }
    
    private function creaFiltro($grupo){
        
        $db = DBManagerFactory::getInstance();
        $query = "select * from expan_m_sectores where c_grupo_act='".$grupo."'";       
                              
        $result = $db -> query($query, true);
        
        $listaFil=array();               
        
        while ($row = $db -> fetchByAssoc($result)) {
            $sector=$row["c_id"];
            $listaFil[]="sector like concat('%^',".$sector.",'^%')";                                            
        }
       $filtro="";
       if (count($listaFil)!=0){
           $filtro="(";
           $filtro = $filtro. implode(" OR ", $listaFil);
           $filtro = $filtro. ")";
       }
       
       return $filtro;
    }

	function cargaFranquicias() {
	    
        echo "<input type='checkbox' class='francheck' id='Asesoramiento' value='380f0dc1-e38e-83e2-8c74-53df9ab90ac1' onclick='cambiocheck(\"francheck\",\"franquicias_secundarias\",true);' style='margin-left:15px;' > Asesoramiento<br/>";
		echo "<table style='width:100%; margin-top:8px;' border='1'>" . "\n";
		echo "<tr>\n<td>\n";
		
		echo "</td>\n</tr>\n";

		//recogemos los sectores de la Base de datos
		$db = DBManagerFactory::getInstance();
            
            $listaFran=array();     
            $listaTipoCuenta=array();               
            
            $query = "select * from expan_franquicia where  (tipo_cuenta=2 OR  tipo_cuenta=1 OR tipo_cuenta=9) AND ";
            $query = $query . " id <> '380f0dc1-e38e-83e2-8c74-53df9ab90ac1' AND deleted=0 ";  
            $query = $query . "order by name;";
       
            $resultFran = $db -> query($query, true);
       
            while ($rowFran = $db -> fetchByAssoc($resultFran)) {
                                
                $listaFran[$rowFran["id"]]=$rowFran["name"];     
                $listaTipoCuenta[$rowFran["id"]]=$rowFran["tipo_cuenta"];                                     
                                             
            }          
        
            $desp=intval(count($listaFran)/2);
            
            if($desp*2!=count($listaFran)){//Si son impares se le suma uno para que entre en el último elemento de la lista
                $desp=$desp+1;
            }
            

            for ($i=0; $i <$desp ; $i++) {
                             
                //1º Columna             
                             
                $keys=array_keys($listaFran);
                $values=array_values($listaFran);
                $valuesTipoCuenta=array_values($listaTipoCuenta);
                             
                $key=$keys[$i];
                $value=$values[$i];     
                $tipoCuenta=$valuesTipoCuenta[$i];       
                                         
                echo "<tr>" . "\n";                
                echo "<td>" . "\n";
                
                $this->pintaFranquicia($key,$value,$tipoCuenta);                                 
                
                //Segunda Columna                
                $key=$keys[$i+$desp];
                $value=$values[$i+$desp];          
                $tipoCuenta=$valuesTipoCuenta[$i+$desp];                        
                
                echo "<td>" . "\n";                           
                if ($value!=""){
                    $this->pintaFranquicia($key,$value,$tipoCuenta);
                }
                                                   
                echo "</td>" . "\n";                
                echo "</tr>" . "\n";
                
            }      
		

		echo "</tr></table>" . "\n";

	}

function recogerFranContactadas($idSol) {
        
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas] Entra');
        
        $db = DBManagerFactory::getInstance();
        $query = "select franquicias_contactadas from expan_solicitud where id='".$idSol."' and deleted=0;";
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas]Id de la solicitud: '.$idSol);
   
        $result = $db -> query($query);
        while ($row = $db -> fetchByAssoc($result)) {
            $franq=$row["franquicias_contactadas"];                                           
        }
        echo"<input type='text' name='franquicias_contactadas' id='franquicias_contactadas' size='30' maxlength='255' value='".$franq."'>";
}
function recogerFranNoContactadas($idSol) {
        
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas] Entra');
        
        $db = DBManagerFactory::getInstance();
        $query = "select otras_franquicias from expan_solicitud where id='".$idSol."' and deleted=0;";
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas]Id de la solicitud: '.$idSol);
   
        $result = $db -> query($query, true);
        while ($row = $db -> fetchByAssoc($result)) {
            $franq=$row["otras_franquicias"];                                           
        }
        echo"<input type='text' name='otras_franquicias' id='otras_franquicias' size='30' maxlength='255' value='".$franq."'>";
}
}
?>