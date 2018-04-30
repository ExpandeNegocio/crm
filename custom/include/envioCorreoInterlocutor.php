<?php
    require_once ('data/SugarBean.php');
    require ('lib/PHPExcel/PHPExcel.php');
    require_once ('include/SugarPHPMailer.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][correoInterlocutor]Inicio' );

    $idGest = $_POST['id'];
    
    $gestion=new Expan_GestionSolicitudes();
    $gestion->retrieve($idGest);
    
    $solicitud=new Expan_Solicitud();
    $solicitud=$gestion->GetSolicitud();
    
    $franquicia=new Expan_Franquicia();
    $franquicia->retrieve($gestion-> franquicia);
    
    $correoEnvio=$franquicia->correo_general;    
    
    if($correoEnvio!=""){//Tenemos correo de la franquicia
      //  if($cuestionario!=""){//Tenemos cuestionario
            EnviarCorreo($correoEnvio,$gestion, $solicitud);
       // }else{
       //     echo 'no existe el link del cuestionario';
       // }
       
    }else{
        echo "no existe el correo de la franquicia";
    }
    
    function EnviarCorreo($emailAddr,$gestion,$solicitud){
    
        $GLOBALS['log'] -> info('[ExpandeNegocio][CorreoInterlocutor][Envio correos]Entra');
         
        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();              

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> AddAddress($emailAddr, $emailAddr);
        $mail -> IsHTML(TRUE);
        $mail -> Subject = from_html("Información de candidato");
        $cuerpo="<html>\n<head><title>Información de candidato</title></head>";
        $cuerpo=$cuerpo."<body>";
        $cuerpo=$cuerpo."<div id='cuerpo'>";
        $cuerpo=$cuerpo."<h3>Le pasamos el contacto y el resumen de las gestiones que hemos estado realizando con dicho candidato para que conozcas mejor su situación.

Además, adjuntamos en enlace al cuestionario que nos ha rellenado para que puedas conocer mejor su perfil y características del candidato.

Ante cualquier duda estamos a su disposición,</h3>";
        $cuerpo=$cuerpo."<TABLE>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Nombre</TD>";
        $cuerpo=$cuerpo."<TD>".$solicitud->firstName."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Apellidos</TD>";
        $cuerpo=$cuerpo."<TD>".$solicitud->lastName."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Provincia Apertura</TD>";
        $cuerpo=$cuerpo."<TD>".$solicitud->provincia_apertura_1."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Localidad Apertura</TD>";
        $cuerpo=$cuerpo."<TD>".$solicitud->localidad_apertura_1."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Origen de la solicitud</TD>";
        $cuerpo=$cuerpo."<TD>".$app_list_strings['tipo_origen_list'][$gestion->origen_sol]."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Suborigen de la solicitud</TD>";
        $cuerpo=$cuerpo."<TD>".$gestion->getSuborigenDesc()."</TD>";
        $cuerpo=$cuerpo."</TR>";
        $cuerpo=$cuerpo."<TR>";
        $cuerpo=$cuerpo."<TD>Trámites destacados</TD>";
        $cuerpo=$cuerpo."<TD>".$gestion->observaciones_informe."</TD>";
        $cuerpo=$cuerpo."</TR>";                              
        $cuerpo=$cuerpo."</TABLE>";           
        $cuerpo=$cuerpo."<a href='".$gestion->lnk_cuestionario."'>Enlace al formulario</p>";
        $cuerpo=$cuerpo."</div></body></html>";
        echo $cuerpo;
                
        $mail -> Body=$cuerpo;
        
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;            
        } else {
            
            echo "Ok";
        }
               
    }
?>