<?php

class utilidades {
        
    static function canSend($idgest,$tipoEnvio){

        $db = DBManagerFactory::getInstance();
        
        $query = "SELECT chk_".$tipoEnvio." chk FROM expan_franquicia f, expan_gestionsolicitudes g ";
        $query = $query . "WHERE g.franquicia=f.id AND g.id='" . $idgest . "' AND g.deleted=0 AND f.deleted=0";        
        
       // echo $query;
        
        $result = $db -> query($query, true);
        
        $template= new EmailTemplate();

        while ($row = $db -> fetchByAssoc($result)) {
            $isCheck = $row["chk"];
        }  
        
        if ($isCheck==1){
            return '';
        }   else{
            return 'disabled';
        }     
    
    }   
    
}

?>
    