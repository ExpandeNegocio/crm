<?php
class opEdicionEvento {

	function cargaPositivos($idEvento) {
	    
        $db = DBManagerFactory::getInstance();
        $query = "SELECT tp.Nombre name_pos, num_pos ";
        $query=$query."FROM   (SELECT   motivo_positivo, count(1) num_pos ";
        $query=$query."        FROM     expan_gestionsolicitudes ";
        $query=$query."        WHERE    estado_sol = 5 AND expan_evento_id_c = '".$idEvento."' ";
        $query=$query."        GROUP BY motivo_positivo) a ";
        $query=$query."       LEFT JOIN tipo_positivo tp ON tp.id = a.motivo_positivo; ";

        $GLOBALS['log']->info('[ExpandeNegocio][RecogerPositivas por evento]Id del evento: '.$idEvento);
   
        
        echo "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
              <thead>
                <tr class='trClass'>
                  <th>Tipo Positivo</th><th>Nº Positivos</th>
                </tr>
              </thead>
              <tbody>";   
   
        $result = $db -> query($query);
        while ($row = $db -> fetchByAssoc($result)) {
            echo "<td scope='row' style='text-align: left;'>".$row["name_pos"]."</td>";
            echo "<td scope='row' style='text-align: left;'>".$row["num_pos"]."</td>";                                              
        }	
		echo "</tr></tbody></table>" . "\n";
	}    
}
?>