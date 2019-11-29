<?php
class opEdicionEmpresa {  

    public function showInterfazProveedorEmpresa($idEmpresa,$view){
        
        // -- FRANQUICIAS --------------
        
        echo '<table class="yui3-skin-sam edit view panelContainer">
             <tbody>';
        echo '<tr>';
        echo '<td>Franquicia</td>';        
        echo '<td><select name="franquicias_proveedor[]" id="franquicias_proveedor"  style="width: 250px" >';
        
                
        $query = "select id,name from expan_franquicia where deleted=0 and tipo_cuenta in (1,2) ";        
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
    
    public function showListFranqucia($idProveedor){
        
        echo "<p>Listado de Franquicias</p>";
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                   <th></th><th></th><th>Franquicia</th>><th>Tipo</th><th>Cotizado</th><th>Validado</th><th>F Renovacion</th>
                </tr>
              </thead>
              <tbody>"; 
                     
                     
        $db = DBManagerFactory::getInstance();
        
        $query = "select ep.id epid, f.name, case WHEN ep.tipo_proveedor=\"in\" THEN \"Interno\" ELSE case WHEN ep.tipo_proveedor=\"ex\" THEN \"Externo\" else \"\" end END tipo_proveedor, ";
        $query=$query."case WHEN ep.chk_cotizado=1 THEN \"x\" ELSE \"\" END chk_cotizado, ";
        $query=$query."case WHEN ep.chk_validado=1 THEN \"x\" ELSE \"\" END chk_validado, ";
        $query=$query."DATE_FORMAT(ep.f_renovacion_acuerdo,\"%d/%m/%Y\") f_renovacion_acuerdo ";
        $query=$query." from     expan_empresa_proveedor ep, expan_franquicia f ";
        $query=$query." where  f.id= ep.empresa_id AND ep.proveedor_id='".$idProveedor."'";
        
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<tr>";
            echo "<td><button type='button' onclick='deleteFranquicia(\"".$row["epid"]."\");'> -</button></td>";
            echo "<td><button type='button' onclick='editFranquicia(\"".$row["epid"]."\");'> E</button></td>";
          
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

    public function getchecks($idEmpresa){

      $empresa= new Expan_Empresa();
      $empresa->retrieve($idEmpresa);

      $potencial="";
      if ($empresa->chk_es_cliente_potencial){
        $potencial="checked";
      }

      $proveedor="";
      if ($empresa->chk_es_proveedor){
        $proveedor="checked";
      }

      $competidor="";
      if ($empresa->chk_es_competidor){
        $competidor="checked";
      }

      $alianza="";
      if ($empresa->chk_alianza){
        $alianza="checked";
      }

      echo '<tr hidden><td></td> <td><input type="checkbox" id="chkPotencial" name="chkPotencial" '.$potencial.' ></td></tr>';
      echo '<tr hidden><td></td> <td><input type="checkbox" id="chkProveedor" name="chkProveedor" '.$proveedor.' ></td></tr>';
      echo '<tr hidden><td></td> <td><input type="checkbox" id="chkCompetidor" name="chkCompetidor" '.$competidor.' ></td></tr>';
      echo '<tr hidden><td></td> <td><input type="checkbox" id="chkAlianza" name="chkAlianza" '.$alianza.' ></td></tr>';

    }

    public function getOptionsByList ($listName){
             
        $list= $GLOBALS['app_list_strings'][$listName];

        $options='';

        foreach ($list as $clave => $valor){
          $options=$options.'<option label="'.$valor.'" value="'.$clave.'">'.$valor;
            $options=$options.'</option>';  
        }                      
                   
        return $options;
    }
}
?>