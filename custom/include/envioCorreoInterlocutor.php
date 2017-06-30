<?php
    require_once ('data/SugarBean.php');
    require ('lib/PHPExcel/PHPExcel.php');
    require_once ('include/SugarPHPMailer.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][correoInterlocutor]Inicio' );

    $idGest = $_POST['id'];
    
    $gestion=new Expan_GestionSolicitudes();
    $gestion->retrieve($idGest);
    
    $franquicia=new Expan_Franquicia();
    $franquicia->retrieve($gestion-> franquicia);
    
    $correoEnvio=$franquicia->correo_general;
    $cuestionario=$gestion->lnk_cuestionario;
    
    if($correoEnvio!=""){//Tenemos correo de la franquicia
        if($cuestionario!=""){//Tenemos cuestionario
            EnviarCorreo($correoEnvio, $cuestionario);
        }else{
            echo 'no existe el link del cuestionario';
        }
       
    }else{
        echo "no existe el correo de la franquicia";
    }
    
function EnviarCorreo($emailAddr,$cuestionario){
    
        $GLOBALS['log'] -> info('[ExpandeNegocio][CorreoInterlocutor][Envio correos]Entra');
         
        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> AddAddress($emailAddr, $emailAddr);
        $mail -> IsHTML(TRUE);
        $mail -> Subject = from_html("Información de candidato");
        $cuerpo='<html>
                    <head>
                        <title>Información de candidato</title>
                    </head>
                        <body>
                            <div id="cuerpo"> 
                                <h3>En el siguiente enlace se encuentra el cuestionario rellenado por el candidato: </h3>
                                ';
                                 
        $cuerpo=$cuerpo."       <p>".$cuestionario."</p> 
                                          ";
        $cuerpo=$cuerpo.'   </div>
                       </body>
                </html>';
                
        $mail -> Body=$cuerpo;
        
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;            
        } else {
            
            echo "Ok";
        }
               
}
?>