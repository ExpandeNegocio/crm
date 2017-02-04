<?php

class procesarCandidaturas {
    
    function procesarCandidaturas(){
        
         $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][General]Inicia proceso");
        
    }

    function procesarFranquiciaNet() {

        $CORREOPORTAL = "Franquicia.net <leads@contactosfranquicia.net>";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Inicio");

        $db = DBManagerFactory::getInstance();

        //Recorremos los correos
        $result = $db -> query($this -> crearSQLConsultaCorreos($CORREOPORTAL), true);

        $j = 1;

        while ($row = $db -> fetchByAssoc($result)) {

            $contenido = $row["description"];

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Descripcion-" . $contenido);

            $lista = explode("\t", $contenido);

            //creamos la solicitud
            $solicitud = new Expan_Solicitud();

            $i = 0;
            foreach ($lista as $palabra) {

                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Palabra - " . $i . "-" . $palabra);

                //Tenemos claro que llegan desde portal Guardar el portal

                switch ($i) {
                    case 2 :
                        // Nombre
                        $solicitud -> first_name = $palabra;
                        break;
                    case 4 :
                        //Correo
                        $solicitud -> emailAddress -> addAddress($palabra);
                        break;
                    case 6 :
                        //telefono
                        $solicitud -> phone_mobile = $palabra;
                        break;
                    case 8 :
                        //Municipio
                        $solicitud -> localidad_apertura_1 = $palabra;
                        break;
                    case 10 :
                        //provincia
                        if ($this -> recogeProv($palabra) != -1) {
                            $solicitud -> provincia_apertura_1 = $this -> recogeProv($palabra);
                        }
                        break;
                    case 12 :
                        // Inversion
                        if (is_numeric($palabra)) {
                            $solicitud -> capital = $this -> recogeCapital(floatval($palabra));
                        } else {
                            $solicitud -> capital_observaciones = $palabra;
                        }
                        break;
                }

                $i++;
            }

            $franquicia = $this -> recogeFranquicia($row["to_addrs"]);
            if ($franquicia != -1) {
                $solicitud -> franquicias_secundarias = "^" . $franquicia . "^";
                $solicitud -> franquicia_principal = $franquicia;
                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Franquicia" . $franquicia);
            }

            $solicitud -> zona = -1;
            $solicitud -> tipo_origen = "^2^";
            $solicitud -> portal = "8";

            $solicitud -> save();
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Insercion numero" . $j);
            $j++;
        }

        //Debemos de marcar los procesados
        $this ->cierraCorreos($CORREOPORTAL);

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][Procesar franquicia.net]Termina de Procesar");
    }

    function procesarFranquiciaDirecta() {

        $CORREOPORTAL = "Franquicia Directa Lead <leads@franquiciadirecta.com>";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFranquiciaDirecta]Inicio");

        $db = DBManagerFactory::getInstance();

        //Recorremos los correos
        $result = $db -> query($this -> crearSQLConsultaCorreos($CORREOPORTAL), true);

        $j = 1;

        while ($row = $db -> fetchByAssoc($result)) {

            $contenido = $row["description"];

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Descripcion-" . $contenido);

            $lista = explode("\r\n", $contenido);

            //creamos la solicitud
            $solicitud = new Expan_Solicitud();

            $i = 0;
            foreach ($lista as $palabra) {

                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Palabra - " . $i . "-" . $palabra);

                switch ($i) {
                    case 7 :
                        // Nombre y apellidos
                        $solicitud -> first_name = str_replace('Nombre y Apellidos: ','',$palabra);
                        break;
                    case 9 :
                        //Correo
                        $solicitud -> emailAddress -> addAddress(str_replace('E-mail: ','',$palabra));
                        break;
                    case 15 :
                        //telefono
                        $solicitud -> phone_mobile = str_replace('Teléfono: ','',$palabra);
                        break;
                    case 11 :
                        //Municipio 
                        $solicitud -> localidad_apertura_1 = str_replace('Ubicación deseada: ','',$palabra);
                        if ($this -> recogeProv(str_replace('Ubicación deseada: ','',$palabra)) != -1) {
                            $solicitud -> provincia_apertura_1 = $this -> recogeProv(str_replace('Ubicación deseada: ','',$palabra));
                        }
                        break;
                    case 13 :
                        // Inversion                                             
                        if (is_numeric(str_replace('Capital disponible (eur): ','',$palabra))) {
                            $solicitud -> capital = $this -> recogeCapital(floatval(str_replace('Capital disponible (eur): ','',$palabra)));
                        } else {
                            $solicitud -> capital_observaciones = str_replace('Capital disponible (eur): ','',$palabra);
                        }
                        break;
                }
                
                $i++;
            }

            $franquicia = $this -> recogeFranquicia($row["to_addrs"]);
            if ($franquicia != -1) {
                $solicitud -> franquicias_secundarias = "^" . $franquicia . "^";
                $solicitud -> franquicia_principal = $franquicia;
                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Franquicia" . $franquicia);
            }

            $solicitud -> zona = -1;
            $solicitud -> tipo_origen = "^2^";
            $solicitud -> portal = "4";


            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Nombre-" . $solicitud -> first_name);
           // $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Correo-" . $solicitud -> emailAddress);
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Telefono-" . $solicitud -> phone_mobile );
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Localidad-" . $solicitud -> localidad_apertura_1 );
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Provincia-" . $solicitud -> provincia_apertura_1 );
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Capital-" . $solicitud -> capital );
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.CapitalObservaciones-" . $solicitud -> capital_observaciones );
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Solicitud.Franquicia-" . $solicitud -> franquicias_secundarias );


            //  $solicitud -> save();
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Insercion numero" . $j);
            $j++;
        }

        //Debemos de marcar los procesados
        $this -> actualizarCorreos($CORREOPORTAL);

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesarFranquiciaDirecta]Termina de Procesar");

    }

    function crearSQLConsultaCorreos($correoPortal) {

        //Buscamos los correos que vienen del correo seleccionado y que no han sido procesaros (flagged ==Null)
        $query = "SELECT * ";
        $query = $query . "FROM emails e, emails_text t ";
        $query = $query . "WHERE t.email_id = e.id AND flagged is null AND from_addr = '" . $correoPortal . "'";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][crearSQLConsultaCorreos]consulta-" . $query);

        return $query;
    }

    function comprobarEmail($correo) {

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][comprobarEmail]Inicio");

        $db = DBManagerFactory::getInstance();

        $query = "SELECT * ";
        $query = $query . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
        $query = $query . "WHERE  s.id = r.bean_id AND e.id = r.email_address_id and e.email_address_caps= UCASE(" . $correo . ") ";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][comprobarEmail]consulta-" . $query);

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            return true;
        }

        return false;
    }

    function cierraCorreos($correoPortal) {

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][actualizarCorreos]Inicio");

        $db = DBManagerFactory::getInstance();

        $query = $query . "update  emails e ";
        $query = $query . "join emails_text t ";
        $query = $query . "on  t.email_id = e.id ";
        $query = $query . "set flagged=1 ";
        $query = $query . "where from_addr = '" . $correoPortal . "'";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][actualizarCorreos]consulta-" . $query);

        $db -> query($query);
    }

    function procesa() {
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesa]Inicia");
      //  $this -> procesarFranquiciaNet();
        $this -> procesarFranquiciaDirecta();

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][procesa]Fin-");
    }

    function recogeProv($nombreprov) {

        $db = DBManagerFactory::getInstance();

        $query = "SELECT * from expan_m_provincia where ucase(d_prov)=ucase('" . $nombreprov . "')";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][recogeProv]consulta-" . $query);

        $result = $db -> query($query, true);

        $cprov = -1;

        while ($row = $db -> fetchByAssoc($result)) {
            $cprov = $row["c_prov"];
        }

        return $cprov;

    }

    function recogeFranquicia($correo) {

        $db = DBManagerFactory::getInstance();

        $query = "SELECT * from expan_franquicia where ucase(correo_envio)=ucase('" . $correo . "')";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarCandidaturas][recogeFranquicia]consulta-" . $query);

        $result = $db -> query($query, true);
        $franq = -1;

        while ($row = $db -> fetchByAssoc($result)) {
            $franq = $row["id"];
        }
        return $franq;

    }

    function recogeCapital($capital) {

        if ($capital < 20000) {
            return 1;
        } elseif ($capital >= 20000 && $capital <= 50000) {
            return 2;
        } elseif ($capital >= 50000 && $capital <= 90000) {
            return 3;
        } elseif ($capital >= 90000 && $capital <= 150000) {
            return 4;
        } elseif ($capital >= 150000) {
            return 5;
        }

    }

}
?>