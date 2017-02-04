<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class DHA_PlantillasDocumentosViewDetail extends ViewDetail{


   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   protected function _displayJavascript() {  
      parent::_displayJavascript(); 
      
      // Modificamos la url que genera Sugar para el campo de tipo 'file'
      
      $url = "index.php?action=download&record=".$this->bean->id."&module=DHA_PlantillasDocumentos";
      
      global $sugar_version;
      $javascript_jQuery = '';
      if (version_compare($sugar_version, '6.5.0', '<')) {
         $javascript_jQuery = '<script type="text/javascript" src="' . getJSPath('modules/DHA_PlantillasDocumentos/librerias/jQuery/jquery.min.js') . '"></script>';
      }        
      
      $javascript =  <<<EOHTML
   {$javascript_jQuery}
   <script type="text/javascript" language="JavaScript">
      jQuery( document ).ready(function() {
         jQuery("span#uploadfile a.tabDetailViewDFLink").attr("href", "{$url}"); 
      });            
   </script>
EOHTML;

      echo $javascript;
   } 
   
   //////////////////////////////////////////////////////////////////////////
   public function preDisplay() {
      parent::preDisplay();
   }

   //////////////////////////////////////////////////////////////////////////
   function display(){
      parent::display();
   }
}

?>