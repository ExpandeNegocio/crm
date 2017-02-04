<?PHP

require_once('modules/DHA_PlantillasDocumentos/DHA_PlantillasDocumentos_sugar.php');
require_once ('include/upload_file.php');

class DHA_PlantillasDocumentos extends DHA_PlantillasDocumentos_sugar {

   //additional fields.
   var $file_url;
   var $modulo_url;
   var $doc_url;
   var $doc_local_location;
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////      
   function DHA_PlantillasDocumentos(){
      parent::DHA_PlantillasDocumentos_sugar();
      
      // Rellenamos dinamicamente la lista de modulos (solo aquellos modulos a los que se tiene acceso y que estÃ©n habilitados) ...
      require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');
      global $app_list_strings, $current_user; 
      unset ($app_list_strings['dha_plantillasdocumentos_module_dom']);
      $app_list_strings['dha_plantillasdocumentos_module_dom'] = array();      
      $acl_modules = ACLAction::getUserActions($current_user->id);      
      //$enabled_modules = MailMergeReports_after_ui_frame_hook_enabled_modules();  // esto causa un error de recursiÃ³n
      foreach($acl_modules as $key => $mod){
         if($mod['module']['access']['aclaccess'] >= 0 && MailMergeReports_after_ui_frame_hook_module_enabled($key)){
          // $app_list_strings['dha_plantillasdocumentos_module_dom'][$key] = (isset($app_list_strings['moduleList'][$key])) ? $app_list_strings['moduleList'][$key] : $key;
         }
      }
      natcasesort($app_list_strings['dha_plantillasdocumentos_module_dom']);      
   }   
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function get_file_name($id, $file_ext) {
      global $sugar_config;
   
      //$template_dir = $sugar_config['upload_dir'];
      $template_dir = $sugar_config['DHA_templates_dir']; 

      $file_name = $template_dir . $id;      

      if ($file_ext) {
         $file_name = $file_name . '.' . $file_ext;
      }   

      return $file_name;     
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   // Ver \include\utils\sugar_file_utils.php  y   \include\utils\file_utils.php
   function asegurarDirectorios() { 
      global $sugar_config;
   
      $templates_dir = getcwd() . "/". $sugar_config['DHA_templates_dir'];
      
      if (!is_dir($templates_dir)) {
         sugar_mkdir($templates_dir, 0775); //mkdir($templates_dir);
      }         
   }     
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function save($check_notify = false) {
      global $mod_strings;
      
      // Bloqueo inicial, por el tipo de archivo
      if (isset($this->file_ext) && !empty($this->file_ext)) {
         if (!in_array($this->file_ext, array('docx', 'odt', 'docm'))) {
            sugar_die($mod_strings['MSG_ERROR_EXTENSION_FICHERO_NO_PERMITIDA']);
         }
      }      
      
      $plantilla = getcwd() . "/". $this->get_file_name($this->id, $this->file_ext);
      
      // Nota: la plantilla fisica se puede haber borrado en el detailview, por eso se pone esa condicion tambien
      if (empty($this->id) || $this->new_with_id || !is_file($plantilla)) {
         if (!empty($this->uploadfile)) {
            //Move file saved during populatefrompost
            $fichero_original = UploadFile :: get_url($this->filename, $this->id);            
            $fichero_destino = getcwd() . "/". $this->get_file_name($this->id, $this->file_ext);
            
            $this->asegurarDirectorios();
            $OK = rename($fichero_original, $fichero_destino); 

            if (!$OK) {
               $this->filename = '';
               $this->file_ext = '';
               $this->file_mime_type = '';
               $this->uploadfile = '';            
            }            
            
            //$this->process_save_dates=false; //make sure that conversion does not happen again.
         } else {
            $this->filename = '';
            $this->file_ext = '';
            $this->file_mime_type = '';
            $this->uploadfile = '';
         }         
      }
      
      return parent::save($check_notify);
   }
   
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function BorraArchivoPlantilla($id) { 
      // borrado de los ficheros de plantilla fisicos asociados
      $plantilla = getcwd() . "/". $this->get_file_name($id, $this->file_ext);
      
      // tambien borramos los datos relativos al fichero fisico de la tabla
      global $db;
      $SQL = " update dha_plantillasdocumentos set filename = null, file_ext = null, file_mime_type = null, uploadfile = null where id = '{$id}' ";
      $db->query($SQL);
      
      if (is_file($plantilla)) {
         return unlink ($plantilla);
      }
      return true;  // si el fichero no existe devolvemos un true      
   } 
   
   /////////////////////////////////////////////////////////////////////////////////////////////////// 
   public function deleteAttachment($isduplicate = "false") {
      // Para el boton de "Quitar" desde el Editview. Solo para version 6.4.0 y superiores. En versiones anteriores no se necesita
      
      if ($isduplicate == "true") {
         return true;
      }      
      
      return $this->BorraArchivoPlantilla($this->id);
   }    
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function mark_deleted($id) { 
      $this->BorraArchivoPlantilla($id);
      
      parent::mark_deleted($id);   
   }   
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function fill_in_additional_detail_fields() {
      global $mod_strings, $app_list_strings;
      
      parent::fill_in_additional_detail_fields(); 
      
      // Ver include\SugarObjects\templates\file\File.php ... puesto que para status_id en este modulo se usa dha_plantillasdocumentos_status_dom en lugar de document_status_dom, tenemos que tenerlo en cuenta aqui, ajustando el codigo original (nota: el codigo original de Sugar hará que se genere un Notice en el log de PHP cada vez que se llame a esta funcion)
      if(!empty($this->status_id)) {
         $this->status = $app_list_strings['dha_plantillasdocumentos_status_dom'][$this->status_id];
      }      
      
      $plantilla = getcwd() . "/". $this->get_file_name($this->id, $this->file_ext);
      if (is_file($plantilla)) {
         $ExistePlantilla = true;
      } else {
         $ExistePlantilla = false;
      }
      

      //ICONO Y LINK DE DESCARGA EN EL LISTVIEW ...
      $this->file_url = "";
      if ($ExistePlantilla) {  
         $img_name = '';
         $img_name_bare = '';
         if (!empty ($this->file_ext)) {
             $img_name = SugarThemeRegistry::current()->getImageURL(strtolower($this->file_ext)."_image_inline.gif", false);
             $img_name_bare = strtolower($this->file_ext)."_image_inline";
         }
         
         //set default file name.
         if (!empty ($img_name) && file_exists($img_name)) {
            $img_name = $img_name_bare;
         } else {
            $img_name = "def_image_inline";
         }
         
         if($this->ACLAccess('DetailView')){
            //$this->file_url = "<a href='index.php?entryPoint=download&id=".$this->id."&type=DHA_PlantillasDocumentos' target='_blank'>".SugarThemeRegistry::current()->getImage($img_name, 'alt="'.$mod_strings['LBL_LIST_VIEW_DOCUMENT'].'"  border="0"')."</a>";
            $this->file_url = "<a href='index.php?action=download&record=".$this->id."&module=DHA_PlantillasDocumentos' target='_blank'>".SugarThemeRegistry::current()->getImage($img_name, 'alt="'.$mod_strings['LBL_LIST_VIEW_DOCUMENT'].'"  border="0"')."</a>";
         } 
      }
      
      
      //ICONO Y LINK EN EL LISTVIEW DEL MODULO... 
      $this->modulo_url = '';      
      $img_name = SugarThemeRegistry::current()->getImageURL($this->modulo.".gif", false);
      if (!empty ($img_name) && file_exists($img_name)) {
         $this->modulo_url = '<img align="absmiddle" src="'.getJSPath($img_name).'">';
      } else {
         $img_name = SugarThemeRegistry::current()->getImageURL($this->modulo.".png", false);
         if (!empty ($img_name) && file_exists($img_name)) {
            $this->modulo_url = '<img align="absmiddle" src="'.getJSPath($img_name).'">';
         } 
      }      
      
      
      // Esto es para el entryPoint='download' (ver /download.php)
      if ($ExistePlantilla) {         
         $this->doc_local_location = $this->get_file_name($this->id, $this->file_ext);      
      } else {
         $this->doc_local_location = '';
      }      
      
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////    
   function fill_in_additional_list_fields() {
      $this->fill_in_additional_detail_fields();
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function get_list_view_data(){
      $temp_array = $this->get_list_view_array();
      
      $temp_array['DESCRIPTION'] = nl2br(wordwrap($this->description,100,'<br>'));      
      $temp_array['FILE_URL'] = $this->file_url;
      $temp_array['MODULO_URL'] = $this->modulo_url;
      
      return $temp_array;
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////   
   function create_new_list_query($order_by, $where,$filter=array(),$params=array(), $show_deleted = 0,$join_type='', $return_array = false,$parentbean=null, $singleSelect = false, $ifListForExport = false) {   
   
      // FILTRO DE LOS REGISTROS POR LOS MODULOS A LOS QUE TIENE ACCESO EL USUARIO. 
      // Fijarse que $app_list_strings['dha_plantillasdocumentos_module_dom'] se rellena dinamicamente en este mismo bean, al crearse
      
      require_once ('modules/DHA_PlantillasDocumentos/librerias/dharma_utils.php');
      global $app_list_strings; 
      
      
      $filtro_modulos = '';
      foreach($app_list_strings['dha_plantillasdocumentos_module_dom'] as $key => $mod){
         if ($key) {
            $filtro_modulos = dha_strconcat($filtro_modulos, '"'.$key.'"', ","); 
         }
      }
      if (!$filtro_modulos) {
         $filtro_modulos = "@";   
      };
      $filtro_modulos = ' modulo in (' . $filtro_modulos . ') ';
      $where = dha_strconcat($where, $filtro_modulos, ' and ');
   
   
      $ret_array = parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, true, $parentbean, $singleSelect, $ifListForExport);         
         
      if ( !$return_array )
         return  $ret_array['select'] . $ret_array['from'] . $ret_array['where']. $ret_array['order_by'];
      return $ret_array;   
   }     
   
}
?>