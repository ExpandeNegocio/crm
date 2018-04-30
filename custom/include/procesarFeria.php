<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaFranquicia]Inicio' );

    $db = DBManagerFactory::getInstance();
        
    $query = "select max(Nombre) Nombre, max(apellidos) Apellidos, max(telefono) Telefono, max(correo) Correo,max(provincia) Provincia, max(Franquicia) FranquiciaP, concat(\"^\",GROUP_CONCAT(Franquicia SEPARATOR \"^,^\"),\"^\") FranquiciaS ";
    $query=$query."from tablets_feria_2018  ";
    $query=$query."where Procesado=0 group by nombre,apellidos,telefono,correo,FranquiciaP ";

    
    $result = $db -> query($query, true);
            
    $return = array();
    $num=0;

    while ($row = $db -> fetchByAssoc($result)) {
        
     //   echo $row['Nombre']."-"; //.$row['Apellidos']."-".$row['Telefono']."-".$row['Correo']."-".$row['Provincia']."-".$row['FranquiciaP']."-".$row['FranquiciaS'];
        
    /*    if ($num>4){
            return "";
        }*/
        
        if (localizaSolicitudPoremail($row["Correo"])=="" &&
        localizaSolicitudPortelefono($row['Telefono'],'')==""){
            
           // echo "-No existe";
                    
            $solicitud=new Expan_Solicitud();                       
            
            $solicitud->first_name=$row['Nombre'];
            $solicitud->last_name=$row['Apellidos'];
            $solicitud->phone_mobile=$row['Telefono'];
                                                              
            $solicitud->provincia_apertura_1=$row['Provincia'];
            
            $solicitud->franquicia_principal=$row['FranquiciaP'];
            $solicitud->franquicias_secundarias=$row['FranquiciaS'];
            
            $solicitud->tipo_origen="^3^";
            $solicitud->expan_evento_id_c='9ce233f0-06f5-e02f-866e-5ad5cc69e41f';  
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////// CAMBIAR EL EVENTO ////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $solicitud->modified_user_id='1';
            $solicitud->created_by='1';
            $solicitud->assigned_user_id='1';
            
            $solicitud->ignore_update_c=false;
            $solicitud->save();                   
            
            $email = new SugarEmailAddress();                                       
            $email->addAddress($row['Correo'], true);
            $email->save($solicitud->id, "Expan_Solicitud");                
            $solicitud->emailAddress=$email;                                                                                                  
            
            $solicitud->ignore_update_c=true;
            $solicitud->save();
            
            echo "SOL ID-". $solicitud->id;
            echo "Email ID-". $email->id;
            
            marca($row);
        }   else {
           // echo "-Si Existe";
        }             
        echo "<BR>";
        $num++;
    }  
    
function marca($row){
    
    $db = DBManagerFactory::getInstance();
    
    $query="update tablets_feria_2018 set Procesado=1 where nombre='".$row['Nombre']."' AND apellidos='".$row['Apellidos']."'";
    
  //  echo $query."<BR>";
    
    $result = $db -> query($query);
    
}
                   
function localizaSolicitudPoremail($email) {

    $db = DBManagerFactory::getInstance();

    $query = "SELECT s.id ";
    $query = $query . "FROM   expan_solicitud s, email_addr_bean_rel r, email_addresses e ";
    $query = $query . "WHERE s.id = r.bean_id AND s.deleted=0 AND e.id = r.email_address_id AND lower(trim(e.email_address))='" . strtolower(trim($email)) . "'";

 //   echo $query . "<br>";

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
    $query = $query . "trim(skype)='" . trim($movil) . "' OR ";
    $query = $query . "trim(phone_home)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_mobile)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_other)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(phone_work)='" . trim($telefono) . "' OR ";
    $query = $query . "trim(skype)='" . trim($telefono) . "')";

    if (trim($telefono) == "") {
        $query = "SELECT s.id ";
        $query = $query . "FROM expan_solicitud s ";
        $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_mobile)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_other)='" . trim($movil) . "' OR ";
        $query = $query . "trim(skype)='" . trim($movil) . "' OR ";
        $query = $query . "trim(phone_work)='" . trim($movil) . "')";
    }

    if (trim($movil) == "") {
        $query = "SELECT s.id ";
        $query = $query . "FROM expan_solicitud s ";
        $query = $query . "WHERE deleted=0 AND (trim(phone_home)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_mobile)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_other)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(skype)='" . trim($telefono) . "' OR ";
        $query = $query . "trim(phone_work)='" . trim($telefono) . "')";
    }

  //  echo $query . "<br>";

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

?>