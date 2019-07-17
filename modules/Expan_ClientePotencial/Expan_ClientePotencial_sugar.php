<?php

    require_once('include/SugarObjects/templates/empresa/Empresa.php');
    
   class Expan_ClientePotencial_sugar extends Empresa
   {
       var $new_schema=true;
       var $module_dir='Expan_ClientePotencial';
       var $object_name='Expan_ClientePotencial';
       var $table_name='expan_clientepotencial';
       var $importable=false;
       var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
        
       function Expan_ClientePotencial_sugar()
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