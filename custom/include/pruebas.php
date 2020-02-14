<?php
  require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');

  $gestion= new Expan_GestionSolicitudes();
  $gestion->retrieve("840d24f8-f38c-43c2-6b60-5dfb42f923dc");
  $gestion->crearTablaEntregaCuentaPrecontrato(true);