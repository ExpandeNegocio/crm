<?php

$GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Entra");

echo "Entra" . "<br>";
require_once ('custom/include/CreacionGestionSolicitud.php');
procesar();

function procesar() {

    echo "Entra1" . "<br>";

    //Recogemos los valores que nos pasa el formulario
    $idFran = $_POST['idFran'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $movil = $_POST['movil'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $localidad = $_POST['localidad'];
    $provNom = $_POST['provincia'];
    $disponibilidad = $_POST['disponibilidad'];
    $situacion = $_POST['situacion'];
    $experiencia = $_POST['experiencia'];
    $franContac = $_POST['franContac'];
    $local = $_POST['local'];
    $localPropio = $_POST['localPropio'];
    $localSup = $_POST['localSup'];
    $localDesc = $_POST['localDesc'];
    $inversion = $_POST['inversion'];
    $recursos = $_POST['recursos'];
    $inicio = $_POST['inicio'];
    $papel = $_POST['papel'];
    $idCuestionario = $_POST['idresp'];
   

    $GLOBALS['log'] -> info("[ExpandeNegocio][][Pruebas]IdFranq-" . $idFran);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Nombre-" . $nombre);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Apellidos-" . $apellidos);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Telefono movil-" . $movil);
    $GLOBALS['log'] -> info("[ExpandeNegocio][pprocesarGoogleFormsrocesarGoogleForms][Pruebas]Telefono-" . $telefono);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Email-" . $email);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Localidad-" . $localidad);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Provincia-" . $provNom);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]ID-" . $idCuestionario);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]disponibilidad-" . $disponibilidad);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]situacion-" . $situacion);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]experiencia-" . $experiencia);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]franContac-" . $franContac);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]local-" . $local);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]localPropio-" . $localPropio);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]localSup-" . $localSup);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]localDesc-" . $localDesc);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]inversion-" . $inversion);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]recursos-" . $recursos);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]inicio-" . $inicio);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]papel-" . $papel);
    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Dir Cuestionario-" . $idCuestionario);

    echo "Entra2" . "<br>";

    echo "Nombre-" . $nombre . "<br>";
    echo "Apellidos-" . $apellidos . "<br>";
    echo "Email-" . $email . "<br>";
    echo "Telefono-" . $telefono . "<br>";

    $idSol = localizaSolicitudPoremail($email);

    if ($idSol == "") {
        $idSol = localizaSolicitudPortelefono($movil, $telefono);
    }

    echo "Entra3" . "<br>";

    if ($idSol != "") {

        echo "Tiene Solicitud-" .$idSol. "<br>";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Tenemos la solicitud");

        $solicitud = new Expan_Solicitud();
        $solicitud -> retrieve($idSol);

        if ($solicitud == null) {
            return;
        }
        
        echo "Tiene Solicitud-" .$solicitud->first_name. "<br>";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Nombre de la solicitud-" . $solicitud -> first_name);

        if ($nombre != "") {
            $solicitud -> first_name = $nombre;
        }

        if ($apellidos != "") {
            $solicitud -> last_name = $apellidos;
        }

        if ($movil != "") {
            $solicitud -> phone_mobile = $movil;
        }

        if ($telefono != "") {
            $solicitud -> phone_work = $telefono;
        }

        if ($provNom != "") {
            $solicitud -> provincia_apertura_1 = recogeProv($provNom);
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Provincia Sol-" . $solicitud -> provincia_apertura_1);

        if ($localidad != "") {
            $solicitud -> localidad_apertura_1 = $localidad;
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Provincia Localidad-" . $solicitud -> localidad_apertura_1);

        if ($disponibilidad != "") {
            $solicitud -> disp_contacto = $disponibilidad;
        }

        echo "Antes Situacion" . "<br>";

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Disponibilidad-" . $solicitud -> disp_contacto);

        if ($situacion != "") {

            switch ($situacion) {

                case "Cuenta ajena" :
                    $solicitud -> situacion_profesional = 1;
                    break;

                case "Cuenta propia" :
                    $solicitud -> situacion_profesional = 2;
                    break;

                case "En búsqueda" :
                    $solicitud -> situacion_profesional = 3;
                    break;
            }

        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Situacion-" . $solicitud -> situacion_profesional);

        if ($experiencia != "") {
            $solicitud -> perfil_profesional = $solicitud -> perfil_profesional . $experiencia;            
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Perfil-" . $solicitud -> perfil_profesional);
        
        echo "Antes fran Contacto" . "<br>";

        if ($franContac != "") {
            if ( $solicitud -> franquicias_contactadas ==''){
                $solicitud -> franquicias_contactadas = $franContac;
            }else{
               $solicitud -> franquicias_contactadas = $solicitud -> franquicias_contactadas.",".$franContac; 
            }
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Otras Franq-" . $solicitud -> otras_franquicias);

        if ($local != "") {
            if ($local == "Si") {
                $solicitud -> dispone_local = 1;
            } else if ($local == "No") {
                $solicitud -> dispone_local = 0;
            }

        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Local-" . $solicitud -> dispone_local);

        if ($localSup != "") {
            $solicitud -> superficie_local = $localSup;
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Sup Local-" . $solicitud -> superficie_local);

        $infoLocal = "";

        echo "Antes Local" . "<br>";

        if ($localPropio != "") {
            if ($localPropio == "Si") {
                $infoLocal = "Local Propio";
            } else if ($localPropio == "No") {
                $infoLocal = "Local No Propio";
            }
        }

        if ($localDesc != "") {
            $infoLocal = $infoLocal . ". " . $localDesc;
        }

        if ($localPropio != "" && $localDesc != "") {
            $solicitud -> descripcion_local = $infoLocal;
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Desc Local-" . $solicitud -> descripcion_local);

        $obsFinanci = "";

        if ($inversion != "") {
            $obsFinanci = $inversion;
        }

        if ($recursos != "") {
            $obsFinanci = $obsFinanci . ". " . $recursos;

        }
        
        echo "Antes Financia" . "<br>";

        if ($obsFinanci != "" && $solicitud->$obsFinanci="") {
            $solicitud -> capital_observaciones =$solicitud -> capital_observaciones .'. '. $obsFinanci;
        }

        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Antes coger gestion");
        
        echo "Antes de la gestion idfran-".$idFran ."<br>";

        $gestion = $solicitud -> getGestionFromFranID($idFran);
              
        echo "Gestion - " . $gestion->id ."<br>";

        if ($gestion != null) {

            $gestion -> lnk_cuestionario = $idCuestionario;

            $GLOBALS['log'] -> info("[ExpandeNegocio]   -" . $gestion -> name);
            //ACTUALIZAR EL NOMBRE DE LA GESTION POR SI HA PUESTO OTRO NOMBRE EN EL CUESTIONARIO
             $nomApe=substr($gestion->name, 0, strpos($gestion -> name, "-"));
             $substN=substr($gestion->name, 0, strpos($gestion -> name, " "));
             $substA=substr($nomApe, strpos($nomApe, " ") + 1);
             $substfran=substr($gestion->name, strpos($gestion->name, "-"));
             
             echo "Pasa Gestion1 " ."<br>";
            
            if($nombre!=$substN|$apellidos!=$substA){//si se ha cambiado el nombre o el apellido
                $nombreNuevo=$nombre." ".$apellidos." ".$substfran;
                $gestion-> name=$nombreNuevo;//cambiar el nombre    
            }
            
            echo "Pasa Gestion2 " ."<br>";
            
            $gestion -> chk_recepcio_cuestionario = 1;
            $gestion -> f_recepcion_cuestionario = TimeDate::getInstance()->nowDb();
            $gestion -> candidatura_avanzada=true;
            
            echo "Pasa Gestion22 " ."<br>";                      
                                   
            $gestion -> estado_sol = '2';
            
            echo "Pasa Gestion23 " ."<br>";
            
            $gestion -> asignarUsuarioGestor();
            
            echo "Pasa Gestion3 " ."<br>";
                
            switch ($papel) {

                case "Quiero dedicarme en exclusiva a este proyecto" :
                    $gestion->papel=1;
                    break;
                    
                case "Pretendo compaginar este proyecto con mi trabajo actual" :
                    $gestion->papel=2;
                    break;
                    
                case "Aporto el capital de la inversión del proyecto" :
                    $gestion->papel=3;
                    break;
                    
                case "Pretende ser un complemento dentro de actual negocio" :                    
                    $gestion->papel=4;
                    break;                                                           
            }                               
            
            switch ($recursos) {

                case "100% fondos propios" :
                    $gestion->recursos_propios=1;
                    break;
                
                case "Fondos propios + Financiación" :
                    $gestion->recursos_propios=2;
                    break;
                
                case "100% financiado por entidad bancaria" :
                    $gestion->recursos_propios=3;
                    break;                       
            }                
            
             switch ($inicio) {       
                
                 case "Menos de 4 meses" :
                    $gestion->cuando_empezar=1;
                    break;
                    
                 case "Entre 4-12 meses" :
                    $gestion->cuando_empezar=4;
                    break;
                    
                 case "Más de 12 meses" :
                    $gestion->cuando_empezar=5;
                    break;                   
                                    
             }
                 
            $telefono = $solicitud -> recogeTelefono();

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Tenemos telefono-" . $telefono);

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]PrevioEnvios");

            //Creamos Las llamadas y las tareas
            $gestion -> creaLlamada('[AUT]Recepcion cuestionario', 'Cuestionario');
            $gestion -> crearTarea( "DOCURevCu");

            //Enviamos un correo con plantilla 1.3
            $gestion -> preparaCorreo("C1.3");

            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]PostEnvios");
            $gestion -> ignore_update_c = true;
            $gestion -> save();
            $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Guardamos Gestion");
        }

        $solicitudCaliente = $bean -> candidatura_caliente;
        $solicitudAvanzada = $bean -> candidatura_avanzada;
        $solicitud -> load_relationship('expan_solicitud_expan_gestionsolicitudes_1');   

        foreach ($solicitud->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestionHermana) {
            if ($gestionHermana->id!=$bean->id){
                if ($gestionHermana -> candidatura_caliente == true) {
                    $solicitudCaliente = true;
                }
                if ($gestionHermana -> candidatura_avanzada == true) {
                    $solicitudAvanzada = true;
                }                              
            }                    
        }

        $solicitud -> candidatura_caliente = $solicitudCaliente;
        $solicitud -> candidatura_avanzada = $solicitudAvanzada;               

        $solicitud -> ignore_update_c = true;        
        $solicitud -> save();

        if ($gestion != null) {
            $prioridad=$gestion -> calcularPrioridades();
            $gestion -> prioridad=$prioridad;
            //$solicitud -> prioridad=$prioridad;
            
        }
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][Pruebas]Guardamos Solicitud");
    }

    echo "Finaliza" . "<br>";

}

function localizaSolicitudPoremail($email) {

    $db = DBManagerFactory::getInstance();

    $query = "SELECT s.id ";
    $query = $query . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
    $query = $query . "WHERE s.id = r.bean_id AND s.deleted=0 AND e.id = r.email_address_id AND lower(trim(e.email_address))='" . strtolower(trim($email)) . "'";

    echo $query . "<br>";

    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Consulta-" . $query);

    $result = $db -> query($query, true);
    $idSol = "";

    while ($row = $db -> fetchByAssoc($result)) {

        $idSol = $row["id"];
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Bucle ENtra-" . $idSol);
    }

    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]idSol-" . $idSol);

    return $idSol;
}

function localizaSolicitudPortelefono($movil, $telefono) {

    $db = DBManagerFactory::getInstance();

    if (trim($telefono) == "" && trim($movil) == "") {
        return "";
    }

    $query = "SELECT s.id ";
    $query = $query . "FROM expan_solicitud s ";
    $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($movil) . "' OR ";
    $query = $query . "trim(phone_mobile)='" . trim($movil) . "' OR ";
    $query = $query . "trim(phone_other)='" . trim($movil) . "' OR ";
    $query = $query . "trim(phone_work)='" . trim($movil) . "' OR ";
    $query = $query . "trim(phone_home)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_mobile)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_other)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_work)='" . trim($telefono) . "')";

    if (trim($telefono) == "") {
        $query = "SELECT s.id ";
        $query = $query . "FROM expan_solicitud s ";
        $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_mobile)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_other)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_work)='" . trim($movil) . "')";
    }

    if (trim($movil) == "") {
        $query = "SELECT s.id ";
        $query = $query . "FROM expan_solicitud s ";
        $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_mobile)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_other)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_work)='" . trim($telefono) . "')";
    }

    echo $query . "<br>";

    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Consulta-" . $query);

    $result = $db -> query($query, true);
    $idSol = "";

    while ($row = $db -> fetchByAssoc($result)) {

        $idSol = $row["id"];
        $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]Bucle ENtra-" . $idSol);
    }

    $GLOBALS['log'] -> info("[ExpandeNegocio][procesarGoogleForms][localizaSolicitud]idSol-" . $idSol);

    return $idSol;
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
?>