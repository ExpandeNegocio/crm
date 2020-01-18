<?php
    if (!defined('sugarEntry') || !sugarEntry)
        die('Not A Valid Entry Point');
    
    require_once ('data/SugarBean.php');
    require_once ('modules/Expma_Mailing/Expma_Mailing.php');    
    
    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ReiniciarMailing]Inicio reinicio de  mailing');
    
    $idMailing = rawurldecode($_GET['idMailing']);
    
    $query = "UPDATE expma_mailing_expan_solicitud_c ";
    $query=$query."SET    enviado = 0, motivo_no_envio=null ";
    $query=$query."WHERE  expma_mailing_expan_solicitudexpma_mailing_ida = '".$idMailing."'";
    
    $db = DBManagerFactory::getInstance();
    
    $result = $db -> query($query);  
    
    $query = "UPDATE expma_mailing SET correos_ok=0, correos_ko=0, correos_protocolo=0 WHERE id='$idMailing' and deleted=0 ;";
    $result = $db -> query($query);

    $query = "update expan_mailings set correos_enviados=0 where envio='$idMailing'; ";
    $result = $db -> query($query);

    
    echo "Ok";
    
?>