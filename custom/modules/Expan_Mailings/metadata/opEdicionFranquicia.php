<?php
class opEdicionFranquicia {
        
    public function showInterfaz($idPortal,$view){        
        
        echo '<p>Franquicias</p>';
        
        echo '<select name="franquicias[]" id="franquicias" size="12" style="width: 250px" multiple="true">';
                
        $query = "select id,name from expan_franquicia where deleted=0 and tipo_cuenta in (1,2,5,8,3) ";
        $options= $this->getOptions($query,"name","id");
    
        echo $options;
        echo '</select>';
        
        echo '<div><p><span class="dateTime">Fecha Inicio:
            <input class="date_input" autocomplete="off" type="text" name="f_ini_contrata" id="f_ini_contrata" value="" title="" tabindex="0" size="11" maxlength="10">
            <img src="themes/Sugar5/images/jscalendar.gif?v=OTN-CzcWQRaVWQGC3FE9gg" alt="Introducir Fecha" style="position:relative; top:6px" border="0" id="f_ini_contrata_trigger">
            </span></p>';
            
        echo '<script type="text/javascript">
            Calendar.setup ({
            inputField : "f_ini_contrata",
            form : "'.$view.'",
            ifFormat : "%d/%m/%Y %H:%M",
            daFormat : "%d/%m/%Y %H:%M",
            button : "f_ini_contrata_trigger",
            singleClick : true,
            dateStr : "",
            startWeekday: 1,
            step : 1,
            weekNumbers:false
            }
            );
            </script>' ;   
            
        echo '<p><span class="dateTime">Fecha Fin:
            <input class="date_input" autocomplete="off" type="text" name="f_fin_contrata" id="f_fin_contrata" value="" title="" tabindex="0" size="11" maxlength="10">
            <img src="themes/Sugar5/images/jscalendar.gif?v=OTN-CzcWQRaVWQGC3FE9gg" alt="Introducir Fecha" style="position:relative; top:6px" border="0" id="f_fin_contrata_trigger">
            </span></p>';
            
        echo '<script type="text/javascript">
            Calendar.setup ({
            inputField : "f_fin_contrata",            
            form : "'.$view.'",
            ifFormat : "%d/%m/%Y %H:%M",
            daFormat : "%d/%m/%Y %H:%M",
            button : "f_fin_contrata_trigger",
            singleClick : true,
            dateStr : "",
            startWeekday: 1,
            step : 1,
            weekNumbers:false
            }
            );
            </script>' ;   
            
        echo '<p>Periodo de Pruebas<input type="checkbox" id="chk_periodo_pruebas" name="chk_periodo_pruebas"></p>';                     
        
        echo '<p>Coste Periodo Mensual<input type="text" name="coste_periodo" id="coste_periodo" size="30" maxlength="255" title="Coste Periodo Mensual">';

        echo '<p><button type="button" onclick="addAltaFranquicia(\''.$idPortal.'\')">Añadir</button></p>';
        
        echo '</div>';  
        
    }
    
    public function getOptions ($query,$labelField,$valueField){
        
        $options='';        
                   
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $options=$options.'<option label="'.$row[$labelField].'" value="'.$row[$valueField].'">'.$row[$labelField];
            $options=$options.'</option>';
        }
        
        return $options;
        
    }

    public function listaFranquicias($idportal,$year){
        
        $query = "select fid,pid,Franquicia,f_inicio,f_fin, max(Enero) Enero,max(Febrero) Febrero, ";
        $query=$query."max(Marzo) Marzo,max(Abril) Abril, ";
        $query=$query."max(Mayo) Mayo,max(Junio) Junio, ";
        $query=$query."max(Julio) Julio,max(Agosto) Agosto, ";
        $query=$query."max(Septiembre) Septiembre,max(Octubre) Octubre, ";
        $query=$query."max(Noviembre) Noviembre,max(Diciembre)Diciembre,max(b_prueba) b_prueba from (select f.id fid,  p.id pid, f.name Franquicia,   ";
        $query=$query."date_format(f_inicio,'%d/%m/%Y') f_inicio, ";
        $query=$query."date_format(f_fin,'%d/%m/%Y') f_fin, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/1/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/1/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Enero,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('28/2/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/2/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Febrero,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/3/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/3/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Marzo,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/4/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/4/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Abril,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/5/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/5/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Mayo,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/6/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/6/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Junio,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/7/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/7/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Julio,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/8/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/8/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Agosto,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/9/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/9/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Septiembre,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/10/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/10/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Octubre,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/11/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/11/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Noviembre,  ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/12/2019', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/12/2019', '%d/%m/%Y')  THEN case when p.coste is null then \"\" else p.coste end ELSE \"\" END Diciembre,  ";
        $query=$query."b_prueba  ";
        $query=$query."from expan_portales_periodos p, expan_franquicia f  ";
        $query=$query."where p.franquicia = f.id AND p.portal='1'   ";
        $query=$query."order by f.name) a  ";
        $query=$query."group by fid; ";
        
 
        
        echo "<p>Listado de meses</p>";
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                  <th></th><th>Franquicia</th><th>F. Inicio</th><th>F. Fin</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
                </tr>
              </thead>
              <tbody>";   
                       
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                           
        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<tr>";
            echo "<td><button type='button' onclick='deletePeriodo(\"".$row["pid"]."\");'> -</button></td>";
            echo "<td style='width: 60px;' scope='row'><b>".$row["Franquicia"]."</b></td>";            
            
            echo "<td scope='row'>".$row["f_inicio"]."</td>";
            echo "<td scope='row'>".$row["f_fin"]."</td>";
            
            foreach($meses as $mes){
                if ($row["b_prueba"]==1 && $row[$mes]!=null ){
                    $style="style='background:red'";               
                }else{
                    $style=""; 
                }
                echo "<td scope='row' ".$style.">".$row[$mes]."</td>";            
            }
            echo "</tr>";
        }            
        
        echo "</tbody>
        </table>";           
        
    }  
           
}
?>
 