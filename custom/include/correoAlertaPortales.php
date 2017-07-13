<?php
    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
    require_once ('modules/Expan_Solicitud/Expan_Solicitud.php');
    require ('lib/PHPExcel/PHPExcel.php');
    require_once ('include/SugarPHPMailer.php');
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][correoAlertaPortales]Inicio' );

    $db = DBManagerFactory::getInstance();
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][correoAlertaPortales] Iniciamos calculo');
    
    $query = "SELECT name FROM ( ";
    $query=$query."SELECT   f.name,  ";
    $query=$query."          sum(CASE WHEN g.tipo_origen=2 and g.date_entered BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND CURDATE() THEN 1 ELSE 0 END) \"creadasPortales\" ";
    $query=$query."FROM     expan_gestionsolicitudes g, expan_franquicia f ";
    $query=$query."WHERE    g.deleted = 0 AND  ";
    $query=$query."         f.id = g.franquicia AND  ";
    $query=$query."         tipo_cuenta IN (1, 2) ";
    $query=$query."GROUP BY franquicia ";
    $query=$query."ORDER BY f.name) a where a.creadasPortales=0; ";
    
    $result = $db -> query($query, true);
    $listaFranquicias=array();
    
    while($row = $db -> fetchByAssoc($result)){
        $listaFranquicias[$row["name"]]=$row["name"];//nombre de la franquicia para la cual pasa esto
        
    }
    if(count($listaFranquicias)!=0){//hay franquicias que cumplen la condición, por tanto se envia el correo
        EnviarCorreo('administracion@expandenegocio.com', $listaFranquicias);
    }
    
    echo "Finalizado proceso";


function EnviarCorreo($emailAddr,$listaFranquicias){
    
        $GLOBALS['log'] -> info('[ExpandeNegocio][CorreoLlamadas][Envio correos]Entra');
         
        $mail = new SugarPHPMailer();

        $emailObj = new Email();
        $defaults = $emailObj -> getSystemDefaultEmail();

        $mail -> From = $defaults['email'];
        $mail -> FromName = $defaults['name'];

        $mail -> AddAddress($emailAddr, $emailAddr);
        $mail -> IsHTML(TRUE);
        $mail -> Subject = from_html("Cuentas que no han recibido gestiones de portales en los últimos 4 días");
        $cuerpo='<html>
                    <head>
                        <title>No se han recibido solicitudes de portales en los 4 últimos días de: </title>
                    </head>
                        <body>
                            <div id="cuerpo"> 
                                ';
                    foreach($listaFranquicias as $fran){
                        
                        $cuerpo=$cuerpo." <p>".$fran."</p> 
                                          ";
                    }
                    
        $cuerpo=$cuerpo. '     </div>
                             </body>
                           </html>';
        $mail -> Body=$cuerpo;
        
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;            
        } else {
            
            echo "Message sent!";
        }
               
}
?>    