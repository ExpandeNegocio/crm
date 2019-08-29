<?php

class CreateCxButtonsHelper
{

  private $gestion = null;
  private $franquicia = null;

  private $blueColor = 'style="color:#0000FF;"';
  private $redColor = 'style="color:#FF0000;"';
  private $disabled = 'disabled';
  private $colorTag = '#colorCx#';
  private $titleTag = '#title#';
  private $cxTag = '#Cx#';
  private $enableTag = '#Enabled#';
  private $idTag = '#id#';

  private $tituloC1 = 'Reenvio documentación inicial (C1) (Cuestionario, dosier y multimedia)';
  private $tituloC2 = 'Reenvio información Adicional (C2) (Plan financiero)';
  private $tituloC3 = 'Reenvio borrador precontrato (C3)';
  private $tituloC4 = 'Reenvio borrador contrato (C4)';
  private $tituloC11 = 'Reenvio correo C1.1 (Provinvia Ocupada))';
  private $tituloC12 = 'Reenvio correo C1.2 (No puede abrir en la zona))';
  private $tituloC13 = 'Reenvio correo C1.3 (Agradecimiento cuestionario))';
  private $tituloC14 = 'Reenvio correo C1.4 (Reenvío C1 no cuestionario))';
  private $tituloC15 = 'Reenvio correo C1.5 (No telefono))';


  private $sendCxButton = '<input type="button" name="reenInfo" id="#id#" class="" #colorCx#
                        title="#title#" #Enabled#
                        onClick="reenvioInfoDetalle(\'#Cx#\',\'{$fields.id.value}\'); " value="Reenviar #Cx#">';

  public function CreateCxButtonsHelper($gestion, $franquicia)
  {
    $this->gestion = $gestion;
    $this->franquicia = $franquicia;
  }

  public function createCxButton($cx)
  {
    $color = $this->calculateCxColor($cx);
    $title = $this->getTitle($cx);
    $enable = $this->calculateEnable($cx);
    $id="reenvio".str_replace(".","_",$cx);

    $button = $this->sendCxButton;

    $button = str_replace($this->idTag, $id, $button);
    $button = str_replace($this->colorTag, $color, $button);
    $button = str_replace($this->titleTag, $title, $button);
    $button = str_replace($this->cxTag, $cx, $button);
    $button = str_replace($this->enableTag, $enable, $button);

    return $button;

  }

  public function calculateCxColor($c)
  {
    $val = $this->cxActivo($c);

    if ($val == 1) {
      return $this->blueColor;
    } else {
      return $this->redColor;
    }
  }

  public function cxActivo($c)
  {
    switch ($c) {
      case 'C1':
        $val = $this->franquicia->chk_c1;
        break;

      case 'C2':
        $val = $this->franquicia->chk_c2;
        break;

      case 'C3':
        $val = $this->franquicia->chk_c3;
        break;

      case 'C4':
        $val = $this->franquicia->chk_c4;
        break;

      case 'C1.1':
        $val = $this->franquicia->chk_c11;
        break;

      case 'C1.2':
        $val = $this->franquicia->chk_c12;
        break;

      case 'C1.3':
        $val = $this->franquicia->chk_c13;
        break;

      case 'C1.4':
        $val = $this->franquicia->chk_c14;
        break;

      case 'C1.5':
        $val = $this->franquicia->chk_c15;
        break;
    }
    return $val;
  }

  private function getTitle($c)
  {

    $val = null;

    switch ($c) {
      case 'C1':
        return $this->tituloC1;
        break;

      case 'C2':
        return $this->tituloC2;
        break;

      case 'C3':
        return $this->tituloC3;
        break;

      case 'C4':
        return $this->tituloC4;
        break;

      case 'C1.1':
        return $this->tituloC11;
        break;

      case 'C1.2':
        return $this->tituloC12;
        break;

      case 'C1.3':
        return $this->tituloC13;
        break;

      case 'C1.4':
        return $this->tituloC14;
        break;

      case 'C1.5':
        return $this->tituloC15;
        break;
    }

  }

  private function calculateEnable($c)
  {
    $val = $this->cxActivo($c);

    if ($val == 1) {
      return "";
    } else {
      return $this->disabled;
    }
  }

}

?>