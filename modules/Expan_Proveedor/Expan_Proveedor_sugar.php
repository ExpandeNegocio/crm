<?php

    require_once('include/SugarObjects/templates/empresa/Empresa.php');
    
   class Expan_Proveedor_sugar extends Empresa
   {
       var $new_schema=true;
       var $module_dir='Expan_Proveedor';
       var $object_name='Expan_Proveedor';
       var $table_name='expan_proveedor';
       var $importable=false;
       var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
        
       function Expan_Proveedor_sugar()
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