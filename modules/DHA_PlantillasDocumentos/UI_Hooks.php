<?php
 
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function get_massDocForm(&$bean) {
      require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
      $massDoc = new MassGenerateDocument();      
      $massDoc->setSugarBean($bean);
      $massDocForm = $massDoc->getMassGenerateDocumentForm();
      unset($massDoc);
      
      // Modificación para corregir el error "javascript Syntax error : Unterminated string literal". 
      // Ver http://stackoverflow.com/questions/227552/common-sources-of-unterminated-string-literal
      $massDocForm = str_replace('"', "'", $massDocForm);
      $massDocForm = str_replace(array("\r", "\n"), '', $massDocForm);            
      $massDocForm = str_replace('</script>', '<\/script>', $massDocForm);
      //$GLOBALS['log']->fatal($massDocForm);
      
      return $massDocForm;
   }      

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook($event, $arguments) {
      // Este es el hook al que llamarán todos los módulos. Tiene dos partes, una para el detailview y otra para el ListView
      
      global $sugar_config, $app_strings;
      
      $controller = &$GLOBALS['app']->controller;
      $current_view = &$GLOBALS['current_view'];
      $bean = &$controller->bean;
      $user_id = $GLOBALS['current_user']->id;
      $action = strtolower($GLOBALS['action']);  //$controller->action;
      $module = $GLOBALS['module'];
      $record_id = $controller->record;

      if ($action == 'detailview') {
      
         if (!$bean->aclAccess("view")){
            return '';
         }

         $with_buttons = isset($sugar_config['enable_action_menu']) ? !$sugar_config['enable_action_menu'] : false;
         $with_buttons = ($with_buttons) ? 'true' : 'false';
         
         $massDocForm = get_massDocForm($bean);
         if (!$massDocForm) {
            return '';
         }         
         
         $module_div_id="{$module}_detailview_tabs";
         
         $javascript =  <<<EOHTML
      <script type="text/javascript" language="JavaScript"> 

         jQuery( document ).ready(function() {
            var massDocForm = "{$massDocForm}";
            jQuery('#{$module_div_id}').before(massDocForm);
         
            var action_code_list = '<li><a id="generate_document_button" onclick="showMassGenerateDocumentForm();">{$app_strings['LBL_GENERAR_DOCUMENTO']}</a></li>';
            var action_code_button = '<span> </span><input title="{$app_strings['LBL_GENERAR_DOCUMENTO']}" class="button" onclick="showMassGenerateDocumentForm();" type="button" id="generate_document_button" name="generate_document_button" value="{$app_strings['LBL_GENERAR_DOCUMENTO']}">';               

            if ({$with_buttons}) {
               jQuery('div.actionsContainer div.action_buttons div.clear').before(action_code_button);
            }
            else {
               //jQuery('#detail_header_action_menu li.sugar_action_button ul.subnav').append(action_code_list);  // esto tambien funciona
               jQuery("#detail_header_action_menu").sugarActionMenu('addItem',{item:jQuery(action_code_list)});               
            }
         });            
      </script>
EOHTML;
         
      //   echo $javascript;
         return '';
      }
      else if ($action == 'index' || $action == 'listview') {
         
         if ($bean->bean_implements('ACL') && !ACLController::checkAccess($module,'view',true)){
            return '';
         }
         
         $massDocForm = get_massDocForm($bean);
         if (!$massDocForm) {
            return '';
         }
         
         $action_code_list_top = "<a href=\"#massgeneratedocument_form\" id=\"massgeneratedocument_listview_top\" onclick=\"showMassGenerateDocumentForm(); var yLoc = YAHOO.util.Dom.getY(\'massgeneratedocument_form\'); scroll(0,yLoc);\">{$app_strings['LBL_GENERAR_DOCUMENTO']}</a>";
         $action_code_list_bottom = str_replace("massgeneratedocument_listview_top", "massgeneratedocument_listview_bottom", $action_code_list_top);  
         
         $javascript =  <<<EOHTML
      <script type="text/javascript" language="JavaScript"> 

         jQuery( document ).ready(function() {
            var massDocForm = "{$massDocForm}";
            //jQuery('#search_form').after(massDocForm);
            jQuery('#MassUpdate').after(massDocForm);
            
            var action_code_list_top = '<li>{$action_code_list_top}</li>';
            var action_code_list_bottom = '<li>{$action_code_list_bottom}</li>';

            jQuery("#actionLinkTop").sugarActionMenu('addItem',{item:jQuery(action_code_list_top)});
            jQuery("#actionLinkBottom").sugarActionMenu('addItem',{item:jQuery(action_code_list_bottom)});
         });            
      </script>
EOHTML;
         
         echo $javascript;
         return '';            
      }
   }
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_get_action_array($module_name) {
      $action_array = array(
         1002,
         'Document Templates after_ui_frame Hook',
         "custom/modules/{$module_name}/DHA_DocumentTemplatesHooks.php", 
         "DHA_DocumentTemplates{$module_name}Hook_class", 
         'after_ui_frame_method'
      );
      return $action_array;      
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_get_all_modules() {
      // Devuelve un array con todos los módulos que existen en el sistema. 
      // Aqui se pueden aplicar filtros por si no interesa que algún módulo esté disponible por defecto
      
      global $app_list_strings;
      require_once('modules/ModuleBuilder/Module/StudioBrowser.php');
      $browser = new StudioBrowser();
      $browser->loadModules();
      
      $modules = array();
      foreach ($browser->modules as $module_name => $def) {
         $modules[$module_name] = $def->name;
      }
      
      $aditional_modules = array('ProspectLists');  // No deben de estar Home, Calendar ni Emails
      foreach ($aditional_modules as $module_name) {
         if (!isset($modules[$module_name])) {
            $modules[$module_name] = (isset($app_list_strings['moduleList'][$module_name])) ? $app_list_strings['moduleList'][$module_name] : $module_name;
         }
      }

      return $modules;
   }     

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_enabled_modules() {
      // Devuelve un array con todos los módulos que tienen el hook instalado
      
      $modules = MailMergeReports_get_all_modules();
      $enabled_modules = array();
      foreach ($modules as $module_name => $module_label) {
         if (MailMergeReports_after_ui_frame_hook_module_enabled($module_name)) {
            $enabled_modules[$module_name] = $module_label;
         }
      }

      return $enabled_modules;
   }  

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_disabled_modules() {
      // Devuelve un array con todos los módulos permitidos que NO tienen el hook instalado
      
      $modules = MailMergeReports_get_all_modules();
      $enabled_modules = MailMergeReports_after_ui_frame_hook_enabled_modules();
      $disabled_modules = array();
      foreach ($modules as $module_name => $module_label) {
         if (!isset($enabled_modules[$module_name])) {
            $disabled_modules[$module_name] = $module_label;
         }
      }

      return $disabled_modules;
   }    
 
   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_module_enabled($module_name) {
      // Nos dice si un módulo tiene el hook instalado
      
      require_once('include/utils/logic_utils.php');   

      $OK = false;
      if (file_exists("custom/modules/{$module_name}/DHA_DocumentTemplatesHooks.php")) {
            $hook_array = get_hook_array($module_name);
            $action_array = MailMergeReports_after_ui_frame_hook_get_action_array ($module_name);
            $OK = check_existing_element($hook_array, 'after_ui_frame', $action_array);
      }
      return $OK;      
   }  

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_module_remove($module_name) {
      // Elimina el hook del módulo pasado como parámetro
      
      require_once('include/utils.php');   

      // Antes de eliminar comprobamos que realmente el hook está instalado para el módulo pasado como parámetro
      $enabled = MailMergeReports_after_ui_frame_hook_module_enabled ($module_name);
      if ($enabled) {
         $action_array = MailMergeReports_after_ui_frame_hook_get_action_array ($module_name);
         remove_logic_hook($module_name, 'after_ui_frame', $action_array);
      }
      
      $hook_file = "custom/modules/{$module_name}/DHA_DocumentTemplatesHooks.php";
      if (file_exists($hook_file)) {
         unlink ($hook_file);
      }
   }    
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_module_install($module_name) {
      // Instala el hook en el módulo pasado como parámetro
      
      require_once('include/utils.php');   
      require_once('include/utils/logic_utils.php');
      require_once('include/utils/file_utils.php');
      require_once('include/utils/sugar_file_utils.php');

      // Antes de instalar, intentamos quitar el hook que ya estuviera instalado y reinstalamos despues, por si hay cambios en el codigo.
      // La función de eliminación ya se encargará de comprobar si existía o no previamente el hook
      MailMergeReports_after_ui_frame_hook_module_remove ($module_name);
      
      // Nos aseguramos primero de que existe el directorio del módulo dentro de 'custom'
      $hook_file = "modules/{$module_name}/DHA_DocumentTemplatesHooks.php";
      $hook_file = create_custom_directory($hook_file);
      
      // Guardamos el fichero del codigo del hook
      $code = <<<EOHTML
<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class DHA_DocumentTemplates{$module_name}Hook_class {
      function after_ui_frame_method(\$event, \$arguments) {
         require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');
         MailMergeReports_after_ui_frame_hook (\$event, \$arguments);
      }
   }
?>      
EOHTML;

      $OK = sugar_file_put_contents_atomic($hook_file, $code);  // ver tambien write_array_to_file y sugar_file_put_contents
      
      // Si todo ha ido bien, instalamos el hook
      if ($OK) {
         $action_array = MailMergeReports_after_ui_frame_hook_get_action_array ($module_name);
         check_logic_hook_file($module_name, 'after_ui_frame', $action_array);
      }
   } 

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_install_all_modules() {
      // Instala el hook para todos los módulos
      
      $modules = MailMergeReports_get_all_modules();
      
      foreach ($modules as $module_name => $module_label) {
         MailMergeReports_after_ui_frame_hook_module_install($module_name);
      }
   }  

   ///////////////////////////////////////////////////////////////////////////////////////////////////
   function MailMergeReports_after_ui_frame_hook_remove_all_modules() {
      // Elimina el hook de todos los módulos
      
      $modules = MailMergeReports_get_all_modules();
      
      foreach ($modules as $module_name => $module_label) {
         MailMergeReports_after_ui_frame_hook_module_remove($module_name);
      }
   }     
 
?>