<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class DHA_PlantillasDocumentosViewEdit extends ViewEdit{

   //////////////////////////////////////////////////////////////////////////
   function DHA_PlantillasDocumentosViewEdit(){
      parent::ViewEdit();
      
      $this->useForSubpanel = true; 
   }
   
   //////////////////////////////////////////////////////////////////////////   
   function display(){
   
      if (isset($this->bean->id)) {
         $this->ss->assign("FILE_OR_HIDDEN", "hidden");
         if (empty($_REQUEST['isDuplicate']) || $_REQUEST['isDuplicate'] == 'false') {
            $this->ss->assign("DISABLED", "disabled");
         }
      } else {
         $this->ss->assign("FILE_OR_HIDDEN", "file");
      }
      
      parent::display();
      
      // Modificamos la url que genera Sugar para el campo de tipo 'file' (si se trata de una edicion)
      if ($this->bean->id && $this->ev->view == 'EditView'){
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
            jQuery("span#uploadfile_old a.tabDetailViewDFLink").attr("href", "{$url}"); 
         });            
      </script>
EOHTML;

         echo $javascript; 
      }        
   }
}

?>