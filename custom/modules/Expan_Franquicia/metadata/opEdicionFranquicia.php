<?php
class opEdicionFranquicia {

	function cargaSectores() {
		
		global $current_user;
		global $app_list_strings;
		$nameFran=$app_list_strings['franquicia_list'][$current_user->franquicia];
		echo '<script language="javascript" type="text/JavaScript">function conControlUsuarioFran(){ControlUsuarioFran("'.$nameFran.'"); }; </script>';       

		//Inicializamos valores de los sectores
		$i = 0;
        echo '<img src="themes/Sugar5/images/searchMore.gif">'. "\n";
        echo '<input type="text" name="busca_sector" id="busca_sector" size="30" maxlength="255" value="" title=""> '. "\n";
        
		echo "<table style='width:100%'>" . "\n";

		//recogemos los sectores de la Base de datos
		$db = DBManagerFactory::getInstance();
		$query = "select * from expan_m_sectores where b_perfil=1 order by m_orden_act,m_orden_sector,d_subsector";

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
                echo "<input type='checkbox' onclick='despliegoPliegoSector(\"".$listaSectores[$j]."\",) ; activoDesSector(\"".$listaSectores[$j]."\",) ;'  >";
				echo "</tr>" . "\n" . "</td>";
				$sectorAnt = $listaSectores[$j];
			}

			if ($i % 2 == 0) {
				echo "<tr>" . "\n";
			}
			echo "<td style='display:none; font-weight:smaller;'>" . "\n";
			echo "<input type='checkbox' name=".str_replace(" ","_",$listaSectores[$j])." class='Sectorcheck' id='" . $listaSubSector[$j] . "' value='" . $listaSubSector[$j] . "' onclick='cambiocheck(\"Sectorcheck\",\"sector\",true);' style='margin-left:25px'>" . $listaSubSector[$j] . "\n";
			echo "</td>" . "\n";
			if ($i % 2 != 0) {
				echo "</tr>" . "\n";
			}

			$i++;

		}
		echo "</tr></table>" . "\n";
	}
	
    function recogerFranquicia($idFranquiciado) {
        
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas] Entra');
        
        $db = DBManagerFactory::getInstance();
        $query = "select franquicia from expan_franquiciado where id='".$idFranquiciado."' and deleted=0;";
        $GLOBALS['log']->info('[ExpandeNegocio][recogerFranContactadas]Id del franquiciado: '.$idFranquiciado);
   
        $result = $db -> query($query);
        while ($row = $db -> fetchByAssoc($result)) {
            $franq=$row["franquicia"];                                           
        }
        echo"<input type='text' name='franquicia' id='franquicia' size='30' maxlength='255' value='".$franq."'>";
    }
        
    public function showInterfazProveedorFraquicia($idEmpresa,$view){
        
        // -- FRANQUICIAS --------------
        
        echo '<table class="yui3-skin-sam edit view panelContainer">
             <tbody>';
        echo '<tr>';
        echo '<td>Proveedores</td>';        
        echo '<td><select name="proveedor[]" id="proveedor"  style="width: 250px" >';
        
                
        $query = "select id,name from expan_empresa where deleted=0 and chk_es_proveedor=1";        
        $options= $this->getOptions($query,"name","id");
    
        echo $options;
        echo '</select></td>';
        
        echo '</tr>';
        
        // -- TIPO PROVEEDOAR --------------
        
        echo '<tr><td>Tipo Proveedor</td>';
        
        echo '<td><select name="tipo_roveedor[]" id="tipo_proveedor"  style="width: 250px" >';
        echo '<option label="" value=""></option>';   
        echo '<option label="Interno" value="in">Interno</option>';         
        echo '<option label="Externo" value="ex">Externo</option>';                  
        echo '</select></td></tr>';
        
        echo '<tr><td>Cotizado</td> <td><input type="checkbox" id="chk_cotizado" name="chk_cotizado"></td></tr>';            
        echo '<tr><td>Validado</td> <td><input type="checkbox" id="chk_validado" name="chk_validado"></td></tr>';                  
        echo '<tr><td>Requiere dosier</td> <td><input type="checkbox" id="chk_requiere_dosier" name="chk_requiere_dosier"></td></tr>';  
        
        // --- FECHA DOSSIER ENVIADO
        
        echo '<tr><td><span class="dateTime">Fecha Dosier enviado</td>
            <td><input class="date_input" autocomplete="off" type="text" name="dosier_enviado" id="dosier_enviado" value="" title="" tabindex="0" size="11" maxlength="10">
            <img src="themes/Sugar5/images/jscalendar.gif?v=OTN-CzcWQRaVWQGC3FE9gg" alt="Introducir Fecha" style="position:relative; top:6px" border="0" id="dosier_enviado_trigger">
            </span></td></tr>';
            
        echo '<script type="text/javascript">
            Calendar.setup ({
            inputField : "dosier_enviado",
            form : "'.$view.'",
            ifFormat : "%d/%m/%Y %H:%M",
            daFormat : "%d/%m/%Y %H:%M",
            button : "dosier_enviado_trigger",
            singleClick : true,
            dateStr : "",
            startWeekday: 1,
            step : 1,
            weekNumbers:false
            }
            );
            </script>' ;  
       
       echo '<tr><td>Ambito Actuacion</td>';
        
        echo '<td><select name="ambito_act[]" id="ambito_act"  style="width: 250px" >';
        $options= $this->getOptionsByList("lst_ambito_actuacion_proveedor");   
        echo $options;        
        echo '</select></td></tr>'; 
       
       echo '<tr><td>Rappel a Central</td>';
       echo '<td><textarea id="rappel_central" name="rappel_central" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Rappel a Fcdo</td>';
       echo '<td><textarea id="rappel_fdo" name="rappel_fdo" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Otras condiciones</td>';
       echo '<td><textarea id="otras_condiciones" name="otras_condiciones" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Duración del acuerdo</td>';   
       echo '<td><input type="text" name="duracion_acuerdo" id="duracion_acuerdo" size="30" maxlength="200" value="" title=""></td></tr>';
     
      
      
        // --- FECHA RENOVACION ACUERDO -----
        
        echo '<tr><td><span class="dateTime">Fecha Renovacion del acuerdo
            <td><input class="date_input" autocomplete="off" type="text" name="f_renovacion_acuerdo" id="f_renovacion_acuerdo" value="" title="" tabindex="0" size="11" maxlength="10">
            <img src="themes/Sugar5/images/jscalendar.gif?v=OTN-CzcWQRaVWQGC3FE9gg" alt="Introducir Fecha" style="position:relative; top:6px" border="0" id="f_renovacion_acuerdo_trigger">
            </span></td></tr>';
            
        echo '<script type="text/javascript">
            Calendar.setup ({
            inputField : "f_renovacion_acuerdo",
            form : "'.$view.'",
            ifFormat : "%d/%m/%Y %H:%M",
            daFormat : "%d/%m/%Y %H:%M",
            button : "f_renovacion_acuerdo_trigger",
            singleClick : true,
            dateStr : "",
            startWeekday: 1,
            step : 1,
            weekNumbers:false
            }
            );
            </script>' ;    
            
       echo '<tr><td>Observaciones</td>';
       echo '<td><textarea id="observaciones_proveedor_franq" name="observaciones_proveedor_franq" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Ofertas</td>';
       echo '<td><textarea id="ofertas" name="ofertas" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Pedido Minimo</td>';
       echo '<td><textarea id="pedido_minimo" name="pedido_minimo" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Formas de Pago</td>';
       echo '<td><textarea id="formas_pago" name="formas_pago" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td><p>Condiciones Portes</p></td>';
       echo '<td><textarea id="condiciones_portes" name="condiciones_portes" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Plazos de entrega</td>';
       echo '<td><textarea id="plazo_entrega" name="plazo_entrega" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Garantía del producto</td>';
       echo '<td><input type="text" name="garantia_producto" id="garantia_producto" size="30" maxlength="200" value="" title=""></td></tr>'; 
       echo '<tr><td>Politica de devoluciones</td>';
       echo '<td><textarea id="politica_devoluciones" name="politica_devoluciones" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
       echo '<tr><td>Nombre del contacto</td>';
       echo '<td><input type="text" name="nombre_contacto" id="nombre_contacto" size="30" maxlength="150" value="" title=""></td></tr>';
       echo '<tr><td>Cargo del contacto</td>';
       echo '<td><input type="text" name="cargo_contacto" id="cargo_contacto" size="30" maxlength="150" value="" title=""></td></tr>';
       echo '<tr><td>Teléfono del contacto</td>';
       echo '<td><input type="text" name="telefono_contacto" id="telefono_contacto" size="30" maxlength="20" value="" title=""></td></tr>'; 
       echo '<tr><td>Email del contacto</td>';
       echo '<td><input type="text" name="email_contacto" id="email_contacto" size="30" maxlength="60" value="" title=""></td></tr>';
            
        
       echo '<tr><td><p><button type="button" onclick="addProveedorEmpresa(\''.$idEmpresa.'\')">Añadir</button></p></td></tr>';              
       
       echo '</tbody></table>';             
    }
    
    public function showListProveedores($idFranquicia){
        
        echo "<p>Listado de Proveedores</p>";
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                  <th></th><th></th><th>Proveedor</th>><th>Tipo</th><th>Cotizado</th><th>Validado</th><th>F Renovacion</th>
                </tr>
              </thead>
              <tbody>"; 
                     
                     
        $db = DBManagerFactory::getInstance();
        
        $query = "select ep.id epid, f.name, case WHEN ep.tipo_proveedor=\"in\" THEN \"Interno\" ELSE case WHEN ep.tipo_proveedor=\"ex\" THEN \"Externo\" else \"\" end END tipo_proveedor, ";
        $query=$query."case WHEN ep.chk_cotizado=1 THEN \"x\" ELSE \"\" END chk_cotizado, ";
        $query=$query."case WHEN ep.chk_validado=1 THEN \"x\" ELSE \"\" END chk_validado, ";
        $query=$query."DATE_FORMAT(ep.f_renovacion_acuerdo,\"%d/%m/%Y\") f_renovacion_acuerdo ";
        $query=$query." from     expan_empresa_proveedor ep, expan_franquicia f ";
        $query=$query." where  f.id= ep.empresa_id AND ep.empresa_id='".$idFranquicia."'";
        
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<tr>";
            echo "<td><button type='button' onclick='deleteProveedor(\"".$row["epid"]."\");'> -</button></td>";
            echo "<td><button type='button' onclick='editProveedor(\"".$row["epid"]."\");'> E</button></td>";
          
            echo "<td scope='row'>".$row["name"]."</td>";
            echo "<td scope='row'>".$row["tipo_proveedor"]."</td>";
            echo "<td scope='row'>".$row["chk_cotizado"]."</td>";
            echo "<td scope='row'>".$row["chk_validado"]."</td>";
            echo "<td scope='row'>".$row["f_renovacion_acuerdo"]."</td>";    
            echo "</tr>";                    
        }
        
        echo "</tbody>
        </table>";           
        
    }
    
     public function showListCompetidores($idFranquicia){
        
        echo "<p>Listado de Comperidores</p>";
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                  <th></th><th></th><th>Competidor</th>><th>Tipo Competidor</th><th>Competidor Principal</th>
                </tr>
              </thead>
              <tbody>"; 
                     
                     
        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT e.id, e.name, CASE WHEN a.tipo_competidor = 'CD' THEN 'Competidor Directo' ELSE 'Competidor Indirecto' END AS tipo_comp, CASE WHEN a.competidor_principal = 1 THEN 'x' ELSE '' END AS compt_principal ";
        $query=$query."FROM   (SELECT ec.competidor_id, ec.tipo_competidor, ec.competidor_principal ";
        $query=$query."        FROM   expan_empresa e, expan_empresa_competidores_c ec, expan_franquicia f ";
        $query=$query."        WHERE  ec.empresa_id = e.id AND e.id = f.empresa AND f.id = '".$idFranquicia."' AND ec.deleted = 0) a ";
        $query=$query."       LEFT JOIN expan_empresa e ON a.competidor_id = e.id; ";
        $query=$query." ";

        
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<tr>";            
            echo "<td><button type='button' onclick='window.open(\"index.php?module=Expan_Empresa&action=DetailView&record=".$row["id"]."\");'> V</button></td>";
          
            echo "<td scope='row'>".$row["name"]."</td>";
            echo "<td scope='row'>".$row["tipo_comp"]."</td>";
            echo "<td scope='row'>".$row["compt_principal"]."</td>";  
            echo "</tr>";                    
        }
        
        echo "</tbody>
        </table>";           
        
    }
    
     public function showInterfazMisteryFdo($idFranq){
                
        echo '<table class="yui3-skin-sam edit view panelContainer">
             <tbody>';
        echo '<tr>';
        echo '<td>Nombre del franquiciado entrevistado</td>';    
        echo '<td><input type="text" name="nom_entrevistado" id="nom_entrevistado" size="30" maxlength="200" value="" title=""></td></tr>'; 
        echo '<td>Ubicacion de la franquicia</td>';  
        echo '<td><textarea id="ubicacion" name="ubicacion" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
        
        echo '<tr><td><span class="dateTime">Fecha de la entrevista</td>
            <td><input class="date_input" autocomplete="off" type="text" name="f_entrevista" id="f_entrevista" value="" title="" tabindex="0" size="11" maxlength="10">
            <img src="themes/Sugar5/images/jscalendar.gif?v=OTN-CzcWQRaVWQGC3FE9gg" alt="Introducir Fecha" style="position:relative; top:6px" border="0" id="f_entrevista_trigger">
            </span></td></tr>';
            
        echo '<script type="text/javascript">
            Calendar.setup ({
            inputField : "f_entrevista",
            form : "'.$view.'",
            ifFormat : "%d/%m/%Y %H:%M",
            daFormat : "%d/%m/%Y %H:%M",
            button : "f_entrevista_trigger",
            singleClick : true,
            dateStr : "",
            startWeekday: 1,
            step : 1,
            weekNumbers:false
            }
            );
            </script>' ;  
            
        echo '<td>Nombre mistery</td>';    
        echo '<td><input type="text" name="nom_mistery" id="nom_mistery" size="30" maxlength="200" value="" title=""></td></tr>';          
        echo '<td>Telefono mistery</td>';    
        echo '<td><input type="text" name="telefono_mistery" id="telefono_mistery" size="30" maxlength="200" value="" title=""></td></tr>';  
        echo '<td>Email mistery</td>';    
        echo '<td><input type="text" name="email_mistery" id="email_mistery" size="30" maxlength="200" value="" title=""></td></tr>';  
            
        echo '<td>Numero de empleados</td>';    
        echo '<td><input type="text" name="num_empleados" id="num_empleados" size="30" maxlength="200" value="" title=""></td></tr>'; 
        echo '<td>Comentarios Positivos</td>';  
        echo '<td><textarea id="com_positivos" name="com_positivos" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
        echo '<td>Comentarios Negativos</td>';  
        echo '<td><textarea id="com_negativos" name="com_negativos" rows="4" cols="60" title="" tabindex="0"></textarea></td></tr>';
     
        echo '<tr><td><p><button type="button" onclick="addMisteryFranq(\''.$idFranq.'\')">Añadir</button></p></td></tr>';              
       
        echo '</tbody></table>';     
                       
    }

    public function showListMisteryFdo(){
        
        echo "<p>Listado de misterys a franquiciados</p>";
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                   <th></th><th></th><th>Nombre entrevistdo</th>><th>Fecha</th><th>Nombre mistery</th><th>Ubicacion</th>
                </tr>
              </thead>
              <tbody>"; 
                     
                     
        $db = DBManagerFactory::getInstance();
        
        $query = "select id, nom_entrevistado, case WHEN f_entrevista='00/00/0000' then '' else DATE_FORMAT(f_entrevista, '%d/%m/%Y') end as f_entrevista,nom_mistery,ubicacion,com_positivos,com_negativos  ";
        $query=$query."from expan_franquicia_mistery; ";

        
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<tr>";
            echo "<td><button type='button' onclick='deleteMistery(\"".$row["id"]."\");'> -</button></td>";
            echo "<td><button type='button' onclick='editMistery(\"".$row["id"]."\");'> E</button></td>";
          
            echo "<td scope='row'>".$row["nom_entrevistado"]."</td>";
            echo "<td scope='row'>".$row["f_entrevista"]."</td>";
            echo "<td scope='row'>".$row["nom_mistery"]."</td>";
            echo "<td scope='row'>".$row["ubicacion"]."</td>";             
            echo "</tr>";                    
        }
                              
         echo "</tbody>
        </table>";           
        
    } 
    
    

    public function getOptions ($query,$labelField,$valueField){
        
        $options='<option label="" value=""></option>';        
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $options=$options.'<option label="'.$row[$labelField].'" value="'.$row[$valueField].'">'.$row[$labelField];
            $options=$options.'</option>';
        }
        
        return $options;
        
    }

    public function getOptionsByList ($listName){
             
        $list= $GLOBALS['app_list_strings'][$listName];
        
        foreach ($list as $clave => $valor){
            $options=$options.'<option label="'.$valor.'" value="'.$clave.'">'.$valor;
            $options=$options.'</option>';  
        }                      
                   
        return $options;
        
    }
    
}
?>