<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/EditView/EditView2.php');
class MassGenerateDocument {

   var $sugarbean = NULL;
   var $where_clauses = NULL;
   var $searchFields = NULL;
   var $use_old_search = NULL;

   ///////////////////////////////////////////////////////////////////////////////////////////////////      
   function setSugarBean($sugar) {
      $this->sugarbean = $sugar;
   }
   
/**
 * @deprecated
 */     
   ///////////////////////////////////////////////////////////////////////////////////////////////////         
   function buildMassGenerateDocumentLink(){
      // [OBSOLETO]
      // Esta funcion sirve para añadir una entrada al menu de acciones del listview
      // A partir de la versión 6.5.0 usar la funcion buildMassGenerateDocumentLink_2
      
      global $app_strings;

      $html = "<a href='#massgeneratedocument_form' style='width: 150px' class='menuItem' onmouseover='hiliteItem(this,\"yes\");' onmouseout='unhiliteItem(this);' onclick=\"document.getElementById('massgeneratedocument_form').style.display = '';\">{$app_strings['LBL_GENERAR_DOCUMENTO']}</a>";

      return $html;
   }   
   
/**
 * @deprecated
 */     
   ///////////////////////////////////////////////////////////////////////////////////////////////////         
   function buildMassGenerateDocumentLink_2($loc = 'top'){
      // [OBSOLETO]
      // Esta funcion sirve para añadir una entrada al menu de acciones del listview
      // A partir de la versión 6.5.0 hay que usar ésta en lugar de buildMassGenerateDocumentLink
      
      global $app_strings;

      //$onClick = "document.getElementById('massgeneratedocument_form').style.display = ''; var yLoc = YAHOO.util.Dom.getY('massgeneratedocument_form'); scroll(0,yLoc);";
      $onClick = "showMassGenerateDocumentForm(); var yLoc = YAHOO.util.Dom.getY('massgeneratedocument_form'); scroll(0,yLoc);";
      $html = "<a href='#massgeneratedocument_form' id=\"massgeneratedocument_listview_". $loc ."\" onclick=\"$onClick\">{$app_strings['LBL_GENERAR_DOCUMENTO']}</a>";

      return $html;
   }
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////         
   function role_enabled_level($role_id){
      // Ver lista dha_plantillasdocumentos_enable_roles_dom
      
      $configurator = new Configurator();
      if (!isset($configurator->config['DHA_templates_enabled_roles'])) {
         return 'ALLOW_ALL';
      }
      elseif (!isset($configurator->config['DHA_templates_enabled_roles'][$role_id])) {
         return 'ALLOW_ALL';
      } 
      else {
         return $configurator->config['DHA_templates_enabled_roles'][$role_id];
      }      
   }   
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////         
   function current_user_enabled_level(){
      // If a User has multiple Roles assigned, we will use the more restrictive Role
      // If a User don't have any Role assigned or User is admin, the permission level will be 'All'

      // Ver lista dha_plantillasdocumentos_enable_roles_dom
      
      global $current_user, $db;
      
      if (empty($current_user)) {
         return 'ALLOW_NONE';
      }      

      if ($current_user->isAdmin()){
         return 'ALLOW_ALL';
      }      
      
      $roles = array();
      $sql = "SELECT acl_roles.id FROM acl_roles ".
             "INNER JOIN acl_roles_users ON ".
             "   acl_roles_users.user_id = '{$current_user->id}' AND acl_roles_users.role_id = acl_roles.id AND acl_roles_users.deleted = 0 ".
             "WHERE acl_roles.deleted = 0 ";
      $dataset = $db->query($sql);
      while ($row = $db->fetchByAssoc($dataset)) {
         $role_id = $row['id'];
         $roles[$role_id] = $this->role_enabled_level($role_id);
      }
      
      $permissions_weights = array (
        'ALLOW_ALL' => 100,
        'ALLOW_DOCX' => 75,  
        'ALLOW_PDF' => 25,
        'ALLOW_NONE' => 0,
      );       
      
      $user_enabled_level = 'ALLOW_ALL';
      foreach($roles as $role_id => $role_enabled_level) {
         if (isset($permissions_weights[$role_enabled_level]) && $permissions_weights[$role_enabled_level] < $permissions_weights[$user_enabled_level]) {
            $user_enabled_level = $role_enabled_level;
         }
      }
      
      return $user_enabled_level;
   }

   ///////////////////////////////////////////////////////////////////////////////////////////////////         
   function getMassGenerateDocumentForm() {

      // NOTA: las variables internas del formulario se rellenan desde javascript, y se envian como Post (ver modules\DHA_PlantillasDocumentos\MassGenerateDocument.js)
      // NOTA: Esta funcion se usa tanto en el ListView como en el DetailView
      
      global $app_strings, $app_list_strings, $db, $current_user, $sugar_config; 
    

      if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'DetailView'){
         $accion = 'DetailView';
      } elseif (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'index' || $_REQUEST['action'] == 'ListView')){
         $accion = 'ListView';
      } else {
         return '';
      }
      
      if($this->sugarbean->bean_implements('ACL') && !ACLController::checkAccess($this->sugarbean->module_dir, 'view', true)){
         return '';
      }
      
      $user_enabled_level = $this->current_user_enabled_level();
      if ($user_enabled_level == 'ALLOW_NONE') {
         return '';
      }       
      
      $permiso_ver_plantillas = true;
      if( ACLController::moduleSupportsACL('DHA_PlantillasDocumentos') && !ACLController::checkAccess('DHA_PlantillasDocumentos', 'view', true)){
         $permiso_ver_plantillas = false;
      }      
      
      $html = '';
      $html .= "<form action='index.php' method='post' name='MassGenerateDocument'  id='MassGenerateDocument'>\n";
      
      $field_count = 0;      
      $no_visible = "style='display:none;'";
            
      // Cabecera      
      $html .= "<div id='massgeneratedocument_form' {$no_visible}'>";
      $html .= "<br>";       
      $html .= "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='formHeader h3Row'><tr><td nowrap><h3><span>" . $app_strings['LBL_GENERAR_DOCUMENTO']."</h3></td></tr></table>";
      //$html .= "<h4>".translate('LBL_MODULE_NAME', 'DHA_PlantillasDocumentos')  .":</h4>";
      $html .= "<table cellpadding='0' cellspacing='1' border='0' width='100%' class='edit view' id='mass_update_table'>";
      $html .= "<thead align='left'>";
      $html .= "   <tr>";        
      $html .= "      <td width='40%'><b><u>".translate('LBL_NAME', 'DHA_PlantillasDocumentos')  ."</u></b></td>";
      $html .= "      <td width='10%'><b><u>".translate('LBL_FORMATO_PLANTILLA', 'DHA_PlantillasDocumentos')  ."</u></b></td>";
      $html .= "      <td width='10%'><b><u>".translate('LBL_IDIOMA_PLANTILLA', 'DHA_PlantillasDocumentos')  ."</u></b></td>";
      $html .= "      <td width='10%'><b><u>".translate('LBL_STATUS', 'DHA_PlantillasDocumentos')  ."</u></b></td>";
      $html .= "      <td width='30%'><b><u>".translate('LBL_DESCRIPTION', 'DHA_PlantillasDocumentos')  ."</u></b></td>";
      $html .= "   </tr>";  
      $html .= "</thead>";
      $html .= "<tbody>";
      
      // Variables internas
      $tablename = $this->sugarbean->getTableName();
      $modulename = $this->sugarbean->module_dir;
      
      $html .= "<input type='hidden' name='moduloplantilladocumento' value='{$modulename}'>\n"; // realmente este sería innecesario, se puede obtener a través de plantilladocumento_id
      $html .= "<input type='hidden' name='module' value='DHA_PlantillasDocumentos'>\n";
      $html .= "<input type='hidden' name='action' value='generatedocument'>\n";  // accion de Sugar, ver modules\DHA_PlantillasDocumentos\controller.php
      $html .= "<input type='hidden' name='mode' value=''>\n";     // este se rellena por el javascript (entire o selected)
      $html .= "<input type='hidden' name='enPDF' value='false'>\n";     // este se rellena por el javascript (true o false)
      if ($accion == 'ListView')       
         $html .= "<input type='hidden' name='uid' value=''>\n";   // este se rellena por el javascript (lista de las ids seleccionadas, a no ser que el mode sea igual a entire)
      if ($accion == 'DetailView') 
         $html .= "<input type='hidden' name='uid' value='{$this->sugarbean->id}'>\n";  // si estamos en el DetailView, no se rellena por javascript, ya sabemos su valor
          
      $current_query_by_page = base64_encode(serialize($_REQUEST));
      
      $html .= "<input type='hidden' name='current_query_by_page' value='{$current_query_by_page}' />\n";
      
      $order_by_name = $this->sugarbean->module_dir.'2_'.strtoupper($this->sugarbean->object_name).'_ORDER_BY' ;
      $request_order_by_name = isset($_REQUEST[$order_by_name])? $_REQUEST[$order_by_name] : "";    
      
      $html .= "<input type='hidden' name='{$order_by_name}' value='{$request_order_by_name}' />\n";
      
      // Recorrido por las plantillas
      $sql = "select * from dha_plantillasdocumentos where modulo = '{$modulename}' and filename is not null and deleted = 0 order by document_name";
      $result = $db->query($sql);
      while ($row = $db->fetchByAssoc($result)) {
         $field_count += 1;
         $nombre = $row['document_name'];
         $id = $row['id'];
         $idioma = '';
         if (isset($app_list_strings['dha_plantillasdocumentos_idiomas_dom'][$row['idioma']]))
            $idioma = $app_list_strings['dha_plantillasdocumentos_idiomas_dom'][$row['idioma']];
         $estado = '';
         if (isset($app_list_strings['dha_plantillasdocumentos_status_dom'][$row['status_id']]))
            $estado = $app_list_strings['dha_plantillasdocumentos_status_dom'][$row['status_id']];
         $descripcion = '';
         if (isset($row['description']))
            $descripcion = nl2br(wordwrap($row['description'],100,'<br>')); 

         $imagen_tipo = SugarThemeRegistry::current()->getImage($row['file_ext'].'_image_inline', '', null, null, '.gif');
         $formato = $imagen_tipo . '&nbsp;&nbsp;' . $row['file_ext'];     
            
         $checked = ''; 
         if($field_count == 1) 
            $checked = 'checked';         
            
         if ($field_count % 2) {   
           $html .= "<tr class='oddListRowS1'>";  
         } else {
           $html .= "<tr class='evenListRowS1'>";  
         }    


         if ($permiso_ver_plantillas) {         
            $html .= "<td width='40%'><input type='radio' name='plantilladocumento_id' value='{$id}' {$checked}>  <a target='_blank' href='index.php?module=DHA_PlantillasDocumentos&action=DetailView&record={$id}'>{$nombre}</a></td>";
         } else {
            $html .= "<td width='40%'><input type='radio' name='plantilladocumento_id' value='{$id}' {$checked}>  {$nombre}</td>";         
         }         
         
         $html .= "<td width='10%'>{$formato}</td>";
         $html .= "<td width='10%'>{$idioma}</td>";
         $html .= "<td width='10%'>{$estado}</td>";
         $html .= "<td width='30%'>{$descripcion}</td>";
         $html .= "</tr>";  
      }      
      $html .="</tbody></table>";
      
      // Botones (el boton de generar tiene javascript asociado que asigna variables internas y hace submit del form, ver modules\DHA_PlantillasDocumentos\MassGenerateDocument.js )
      $html .= "<table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td class='buttons'>";
      
      $show_docx_button = ($user_enabled_level == 'ALLOW_ALL' || $user_enabled_level == 'ALLOW_DOCX');      
      
      if ($show_docx_button) {   
         $html .= "<input type='button' id='MassGenerateDocument_button_{$accion}' name='MassGenerateDocument_button_{$accion}' value='{$GLOBALS['app_strings']['LBL_GENERAR_DOCUMENTO']}' class='button'>&nbsp";
      }
                
      $show_pdf_button =  (isset($sugar_config['DHA_OpenOffice_exe']) && $sugar_config['DHA_OpenOffice_exe'] && file_exists($sugar_config['DHA_OpenOffice_exe']) && is_readable($sugar_config['DHA_OpenOffice_exe']) ) ||
                          (!is_windows() && isset($sugar_config['DHA_OpenOffice_cde']) && $sugar_config['DHA_OpenOffice_cde'] && file_exists($sugar_config['DHA_OpenOffice_cde']) && is_readable($sugar_config['DHA_OpenOffice_cde']) );

      $show_pdf_button = ($show_pdf_button && ($user_enabled_level == 'ALLOW_ALL' || $user_enabled_level == 'ALLOW_PDF'));                            
                          
      if ($show_pdf_button){        
         $html .= "<input type='button' id='MassGenerateDocument_button_{$accion}_pdf' name='MassGenerateDocument_button_{$accion}_pdf' value='{$GLOBALS['app_strings']['LBL_GENERAR_DOCUMENTO_PDF']}' class='button'>&nbsp";      
      }      
                
      $html .= "<input onclick='javascript:hideMassGenerateDocumentForm();' type='button' id='cancel_MassGenerateDocument_button' name='cancel_MassGenerateDocument_button' value='{$GLOBALS['app_strings']['LBL_CANCEL_BUTTON_LABEL']}' class='button'>";                

      $html .= "</td></tr></table>";
      
      global $sugar_version;
      //$match_version = "6\.5\.*";
      //if(!preg_match("/$match_version/", $sugar_version)) {
      if (version_compare($sugar_version, '6.5.0', '<')) {      
         $html .= '<script type="text/javascript" src="' . getJSPath('modules/DHA_PlantillasDocumentos/librerias/jQuery/jquery.min.js') . '"></script>';
      }      
      $html .= '<script type="text/javascript" src="' . getJSPath('modules/DHA_PlantillasDocumentos/MassGenerateDocument.js') . '"></script>';       

      $javascript = <<<EOJS
<script>
   function hideMassGenerateDocumentForm(){
       document.getElementById('massgeneratedocument_form').style.display = 'none';
   }
   function showMassGenerateDocumentForm(){
      document.getElementById('massgeneratedocument_form').style.display = '';
   }    
</script>
EOJS;

      $html .= $javascript;
      if ($accion == 'DetailView')
         $html .= "<br><br><br><br><br><br><br><br><br><br><br><br>";  
      $html .= "</div></form>";      

      //$GLOBALS['log']->fatal("HTML ".$html);      
      
      if($field_count > 0) {
         return $html;
      } else {     
         // Si no hay registros de plantillas validas asociadas al modulo se presenta un texto informativo
         
         $permiso_editar_plantillas = true;
         if( ACLController::moduleSupportsACL('DHA_PlantillasDocumentos') && !ACLController::checkAccess('DHA_PlantillasDocumentos', 'edit', true)){
            $permiso_editar_plantillas = false;
         }            
         
         $html = '';
         $html .= "<div id='massgeneratedocument_form' {$no_visible}>";
         $html .= "<br>";   
         $html .= "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='formHeader h3Row'><tr><td nowrap><h3><span>" . $app_strings['LBL_GENERAR_DOCUMENTO']."</h3></td></tr></table>";       
         $html .= $app_strings['LBL_NO_HAY_PLANTILLAS_DISPONIBLES_PARA_GENERAR_DOCUMENTO'] . '.   ';
         if ($permiso_editar_plantillas) {         
            $html .= '<span style="white-space:nowrap;"><a target="_blank" href="index.php?module=DHA_PlantillasDocumentos&action=EditView&return_module=DHA_PlantillasDocumentos&return_action=DetailView">
            <img width="16" height="16" border="0" align="absmiddle" src="'.SugarThemeRegistry::current()->getImageURL("CreateDHA_PlantillasDocumentos.png", false).'">
            <span>'.translate('LNK_NEW_RECORD', 'DHA_PlantillasDocumentos').'</span>
            </a></span>';
         }
         $html .= $javascript;
         $html .= "<table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td class='buttons'>
                   <input onclick='javascript:hideMassGenerateDocumentForm();' type='button' id='cancel_MassGenerateDocument_button' name='cancel_MassGenerateDocument_button' value='{$GLOBALS['app_strings']['LBL_CANCEL_BUTTON_LABEL']}' class='button'>";                
         $html .= "</td></tr></table>";  
         if ($accion == 'DetailView')
            $html .= "<br><br><br><br><br><br><br><br><br>";          
         $html .= "</div>";         
         return $html;
      }
   }

   ///////////////////////////////////////////////////////////////////////////////////////////////////    
   function generateSearchWhere($module, $query) {

      require_once ("include/MassUpdate.php");
      $mass = new MassUpdate();
      $mass->setSugarBean($this->sugarbean);
      $mass->generateSearchWhere($module, $query);
      
      if (isset($mass->searchFields))
         $this->searchFields = $mass->searchFields;
      if (isset($mass->where_clauses))         
         $this->where_clauses = $mass->where_clauses;
      if (isset($mass->use_old_search))         
         $this->use_old_search = $mass->use_old_search;   

      unset($mass);         
   }
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////      
   function handleMassGenerateDocument(){
      
      global $db;
      
      static $boolean_false_values = array('off', 'false', '0', 'no');

      if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'selected' && !empty($_REQUEST['uid'])) {
         $_POST['MassGenerateDocument_ids'] = explode(',', $_REQUEST['uid']); // coming from listview
      }
      elseif(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'entire') {
         if(empty($order_by)) $order_by = '';
         $ret_array = create_export_query_relate_link_patch($_REQUEST['module'], $this->searchFields, $this->where_clauses);
         if(!isset($ret_array['join'])) {
            $ret_array['join'] = '';
         }
         $query = $this->sugarbean->create_export_query($order_by, $ret_array['where'], $ret_array['join']);
         $result = $db->query($query, true);
         $new_arr = array();
         while($val = $db->fetchByAssoc($result, -1, false)) {
            array_push($new_arr, $val['id']);
         }
         $_POST['MassGenerateDocument_ids'] = $new_arr;
      }
      
      $enPDF = false;
      if(isset($_REQUEST['enPDF']) && !in_array(strval($_REQUEST['enPDF']), $boolean_false_values)) 
         $enPDF = true;

      if(isset($_POST['MassGenerateDocument_ids']) && is_array($_POST['MassGenerateDocument_ids'])){
         require_once("modules/DHA_PlantillasDocumentos/Generate_Document.php");
         GenerateDocument ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
      }

   }   

}

?>