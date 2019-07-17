<?php

    require_once('include/SugarObjects/templates/empresa/Empresa.php');
    
   class Expan_Empresa_sugar extends Empresa
   {
       var $new_schema=true;
       var $module_dir='Expan_Empresa';
       var $object_name='Expan_Empresa';
       var $table_name='expan_empresa';
       var $importable=true;
       var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
        
       function Expan_Empresa_sugar()
       {
           parent::Empresa();
       }
       
       function bean_implements($interface){
           switch ($interface) {
               case 'ACL': return true;
           }
           return false;
       }
   }

?>