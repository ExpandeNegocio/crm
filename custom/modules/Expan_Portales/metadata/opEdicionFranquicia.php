<?php
class opEdicionFranquicia {
        
    public function showInterfaz($idPortal,$view){        
        
        echo '<h2>Franquicias</h2>';
        echo '<br>';

        echo '<p>Mostrar solo Fraquicias EN<input type="checkbox" id="chk_franquicias_EN" name="chk_franquicias_EN" checked></p>';

        echo '<select name="franquicias[]" id="franquicias" size="12" style="width: 250px" multiple="true">';
                
        $query = "select id,name from expan_franquicia where deleted=0 and tipo_cuenta in (1,2,3) order by name ";
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

    public function listaFranquicias($idportal,$year,$franquicia){
        
        $output="";
 
        $output=$output. "<div id='ListaPeriodos'>"; 
        $output=$output."<p>Año <select name='select' id='year' onchange='periodosFilter(\"".$idportal."\")'>";

        $thisYear= date('Y');
        
        for ($i=-2;$i<10;$i++){
            if ($i==0){
                $output=$output. "<option value='".($thisYear+$i)."' selected>".($thisYear+$i)."</option>";
            }else{
                $output=$output. "<option value='".($thisYear+$i)."'>".($thisYear+$i)."</option>";
            }
        }
        $output=$output. "</select></p>";



        $output=$output."<p>Franquicia <select name='select' id='franquicia_filter' onchange='periodosFilter(\"".$idportal."\")'>";

        $query = "SELECT * FROM   expan_franquicia ";
        $query=$query."WHERE  tipo_cuenta IN (1, 2) AND deleted = 0 order by name; ";

        $output=$output. "<option value=''></option>";

        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);
        while ($row = $db -> fetchByAssoc($result)) {
          $idfran=$row["id"];
          $nomfran=$row["name"];
          if ($idfran==$franquicia){
              $output=$output. "<option value='$idfran' selected>$nomfran</option>";
          }else{
              $output=$output. "<option value='$idfran'>$nomfran</option>";
          }

        }

        $output=$output. "</select></p>";

        $output=$output. "<br>";
        $output=$output. "<h2>Listado de meses</h2>";
        $output=$output. "<br>";
        $output=$output. "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                  <th></th><th></th><th>Franquicia</th><th>F. Inicio</th><th>F. Fin</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
                </tr>
              </thead>
              <tbody>";   
                       
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $query = "select p.id pid, f.name Franquicia,  ";
        $query=$query."date_format(f_inicio,'%d/%m/%Y') f_inicio,";
        $query=$query."date_format(f_fin,'%d/%m/%Y') f_fin,";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/1/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/1/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Enero, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('28/2/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/2/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Febrero, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/3/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/3/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Marzo, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/4/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/4/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Abril, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/5/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/5/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Mayo, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/6/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/6/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Junio, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/7/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/7/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Julio, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/8/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/8/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Agosto, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/9/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/9/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Septiembre, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/10/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/10/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Octubre, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('30/11/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/11/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Noviembre, ";
        $query=$query."case WHEN f_inicio < STR_TO_DATE('31/12/".$year."', '%d/%m/%Y') and f_fin>STR_TO_DATE('1/12/".$year."', '%d/%m/%Y')  THEN case when p.b_prueba=1 then 'P' else case when p.coste is null then '' else p.coste end end end Diciembre, ";        $query=$query."b_prueba ";
        $query=$query."from expan_portales_periodos p, expan_franquicia f ";
        $query=$query."where p.franquicia = f.id AND p.portal='".$idportal."'  and f_inicio <  STR_TO_DATE('31/12/".$year."', '%d/%m/%Y') AND   f_fin>   STR_TO_DATE('1/1/".$year."', '%d/%m/%Y') ";
        if (!$franquicia==""){
            $query=$query." AND franquicia='$franquicia' ";
        }
        $query=$query."order by f.name; ";

        $db = DBManagerFactory::getInstance();
        $result = $db -> query($query, true);     
        while ($row = $db -> fetchByAssoc($result)) {
            $output=$output. "<tr>";
            $output=$output. "<td><button type='button' onclick='deletePeriodo(\"".$row["pid"]."\");'> -</button></td>";
            $output=$output. "<td><button type='button' onclick='changeCost(\"".$row["pid"]."\");'> €</button></td>";
            $output=$output. "<td style='width: 60px;' scope='row'><b>".$row["Franquicia"]."</b></td>";            
            
            $output=$output. "<td scope='row'>".$row["f_inicio"]."</td>";
            $output=$output. "<td scope='row'>".$row["f_fin"]."</td>";
            
            foreach($meses as $mes){
                if ($row["b_prueba"]==1 && $row[$mes]!=null ){
                    $style="style='background:red'";               
                }else{
                    $style=""; 
                }
                $output=$output. "<td scope='row' ".$style.">".$row[$mes]."</td>";            
            }
            $output=$output. "</tr>";
        }            
        
        $output=$output. "</tbody>
        </table>
        </div>";           
        
        return $output;
    }  
           
}
?>
 