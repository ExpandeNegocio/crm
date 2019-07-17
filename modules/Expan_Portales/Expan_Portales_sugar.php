<?php

   class Expan_Portales_sugar extends Basic
   {
       var $new_schema=true;
       var $module_dir='Expan_Portales';
       var $object_name='Expan_Portales';
       var $table_name='expan_portales';
       var $importable=false;
       var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
        
       function Expan_Portales_sugar()
       {
           parent::Basic();
       }
       
       function bean_implements($interface){
           switch ($interface) {
               case 'ACL': return true;
           }
           return false;
       }
   }

?>