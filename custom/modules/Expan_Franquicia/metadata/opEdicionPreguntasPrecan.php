<?php

  class opEdicionPreguntasPrecan
  {

    public function showInterfazPreguntasPre($idFranq)
    {
      echo '<table class="yui3-skin-sam edit view panelContainer">
  <tbody>';
      echo '<tr>';
      echo '<td>Pregunta</td>';
      echo '<td><textarea id="pregunta_precan" name="pregunta_precan" rows="2" cols="60" title="" tabindex="0"></textarea></td></tr>';

      echo '<tr><td><p><button type="button" onclick="addPreguntaPrecan(\'' . $idFranq . '\')">Añadir</button></p></td></tr>';

      echo '</tbody></table>';
    }

    public function showlistPreguntasPre($idFranquicia)
    {
      $cadena = "";

      $cadena .= "<p>Preguntas Precandidatos</p>";
      $cadena .= "<table cellpadding='0'cellspacing='0' border='0' id='tableTareas' class='list view' style='width: 100%;'>
  <thead>
  <tr class='trClass'>
    <th></th><th></th><th>Pregunta</th>
  </tr>
  </thead>
  <tbody>";

      $db = DBManagerFactory::getInstance();

      $query = "select id,pregunta ";
      $query = $query . "from expan_franquicia_pregunta_pre  ";
      $query = $query . "where franquicia_id='$idFranquicia'";

      $result = $db->query($query, true);
      while ($row = $db->fetchByAssoc($result)) {

        $cadena .= "<tr>";
        $cadena .= "<td style='width:25px'><button type='button' onclick='deletePrecanPregunta(\"" . $row["id"] . "\");'> -</button></td>";
        $cadena .= "<td style='width:25px'><button type='button' onclick='editPrecanPregunta(\"" . $row["id"] . "\");'> E</button></td>";

        $cadena .= "<td>" . $row["pregunta"] . "</td>";
        $cadena .= "</tr>";
      }

      $cadena .= "</tbody>
</table>";
      return $cadena;
    }
  }