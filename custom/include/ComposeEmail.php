<?php
    require_once ('data/SugarBean.php');    
    
    $accountId = $_POST['accountId'];
    $tipo = $_POST['tipo'];   
    
     $GLOBALS['log'] -> info('[ExpandeNegocio][composeEmail]Entra');
    
    switch ($tipo) {
        case 'getSing':
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][composeEmail]Entra');
            
            $db = DBManagerFactory::getInstance();
            $query = $query = "select * from inbound_email where id='".$accountId."'";

            $result = $db -> query($query, true);       
    
            while ($row = $db -> fetchByAssoc($result)) {
                $templateId=$row["template_id"];   
            }    
            
            echo $templateId;

            
            break;
        
        default:
            
            break;
    }
       
?>