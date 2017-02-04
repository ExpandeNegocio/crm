<?php

class procesarFormularios {

    const CADENA_LIMP_INI = "&lt;/tr&gt; &lt;tr&gt;&lt;td&gt;&lt;b&gt;";

    const CADENA_LIMP_INTER = "&lt;/b&gt;&lt;/td&gt;&lt;td&gt;";

    const CADENA_LIMP_POS = "&lt;/td&gt;";
    const SEPA = "b&gt;";

    function lanzar() {

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][lanzar]Inicio");

        //Recojo todos los correos que provengan de formularios@expandenegocio.com

        $db = DBManagerFactory::getInstance();

        $query = "SELECT * ";
        $query = $query . "FROM emails e, emails_text t ";
        $query = $query . "WHERE t.email_id = e.id AND flagged is null AND from_addr = 'formularios@expandenegocio.com'";

        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {

            //Procesamos formulario
            $idCorreo = $row["id"];
            $contenido = $row["description"];

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][lanzar]Contenido-" . $contenido);

            $correo = $this -> localizaCorreoEnvio($contenido);

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][lanzar]Correo-" . $correo);

            if ($correo != "") {

                //recgemos las solicitud

                $idSol = $this -> localizaSolicitud($correo);

                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][lanzar]idSolicitud-" . $idSol);

                if ($idSol != "") {

                    $solicitud = new Expan_Solicitud();
                    $solicitud -> retrieve($idSol);

                    //actualizamos solicitud
                    $this -> actualizarSolicitud($solicitud, $contenido);
                    //  $solicitud -> save();
                }

            }

        }
        $this -> cierraCorreos();

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][lanzar]Fin");
    }

    function localizaSolicitud($email) {

        $db = DBManagerFactory::getInstance();

        $query = "SELECT s.id ";
        $query = $query . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
        $query = $query . "WHERE s.id = r.bean_id AND r.bean_id AND e.id = r.email_address_id AND e.email_address='" . $email . "'";

        $result = $db -> query($query, true);
        $idSol = "";

        while ($row = $db -> fetchByAssoc($result)) {
            $idSol = $row["id"];
        }

        return $idSol;
    }

    function localizaGestion($solicitud) {

    }

    function localizaCorreoEnvio($contenido) {

        $correo = "";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarSolicitud]EntraCorreo");

        $lista = explode("\r\n", $contenido);
        foreach ($lista as $palabra) {

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarSolicitud]Palabra-" . $palabra);

            //Miramos si localizamos la cadena "Correo electrónico"
            if (stripos($palabra, "Correo electrónico") !== false) {

                $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarSolicitud]Localiza Correo");
                $correo = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Correo electrónico" . CADENA_LIMP_INTER, "", $palabra)));
            }

        }
        return $correo;
    }

    function actualizarSolicitud(&$solicitud, $contenido) {

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarSolicitud]correo-" . $contenido);

        $lista = explode("\r\n", $contenido);
        foreach ($lista as $palabra) {

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarSolicitud]linea-" . $palabra);

            ///Nombre
            if (stripos($palabra, SEPA . "Nombre") !== false) {
                $nombre = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Nombre" . CADENA_LIMP_INTER, "", $palabra)));
                if ($nombre != "") {
                    $solicitud -> first_name = $nombre;
                }
            }
            //Apellidos
            if (stripos($palabra, SEPA . "Apellidos") !== false) {
                $nombre = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Apellidos" . CADENA_LIMP_INTER, "", $palabra)));
                if ($apellidos != "") {
                    $solicitud -> last_name = $apellidos;
                }
            }
            //Móvil
            if (stripos($palabra, SEPA . "Móvil") !== false) {
                $movil = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Móvil" . CADENA_LIMP_INTER, "", $palabra)));
                if ($movil != "") {
                    $solicitud -> phone_mobile = $movil;
                }
            }

            //Telefono ::
            if (stripos($palabra, SEPA . "Teléfono") !== false) {
                $telefono = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Teléfono" . CADENA_LIMP_INTER, "", $palabra)));
                if ($telefono != "") {
                    $solicitud -> phone_work = $telefono;
                }
            }

            //Localidad ::
            if (stripos($palabra, SEPA . "Localidad") !== false) {
                $localidad = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Localidad" . CADENA_LIMP_INTER, "", $palabra)));
                if ($localidad != "") {
                    $solicitud -> localidad_apertura_1 = $movil;
                }
            }

            //Provincia
            if (stripos($palabra, SEPA . "Provincia") !== false) {
                $provNom = trim(str_ireplace(CADENA_LIMP_POS, "", str_ireplace(CADENA_LIMP_INI . "Provincia" . CADENA_LIMP_INTER, "", $palabra)));
                if ($provNom != "") {
                    $codProv = recogeProv($provNom);
                    if ($codProv != -1) {
                        $solicitud -> provincia_apertura_1 = $codProv;
                    }
                }
            }

            //Observaciones ::

        }
    }

    function cierraCorreos() {

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarCorreos]Inicio");

        $db = DBManagerFactory::getInstance();

        $query = "update  emails e ";
        $query = $query . "join emails_text t ";
        $query = $query . "on  t.email_id = e.id ";
        $query = $query . "set flagged=1 ";
        $query = $query . "where from_addr = 'formularios@expandenegocio.com'";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarFormularios][actualizarCorreos]consulta-" . $query);

        $db -> query($query);

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

}
?>
