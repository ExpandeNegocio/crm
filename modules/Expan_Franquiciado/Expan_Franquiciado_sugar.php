<?php

require_once('include/SugarObjects/templates/person/Person.php');

   class Expan_Franquiciado_sugar extends Person
   {
       var $new_schema=true;
       var $module_dir='Expan_Franquiciado';
       var $object_name='Expan_Franquiciado';
       var $table_name='expan_franquiciado';
       var $importable=false;
       var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
        
       function Expan_Franquiciado_sugar()
       {
           parent::Person();
       }
       
       function bean_implements($interface){
           switch ($interface) {
               case 'ACL': return true;
           }
           return false;
       }
   }





?>