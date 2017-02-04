<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

// letrium yura

require_once("include/JSON.php");
$json = getJSONobj();

global $beanList,$beanFiles;
$class_name = $beanList[$_REQUEST['current_module']];
require_once($beanFiles[$class_name]);
$focus = new $class_name();
$focus->retrieve($_REQUEST['record']);
$field = $_REQUEST['field'];

$multienums = array();
foreach($focus->field_defs as $f=>$def) {
	$type = !empty($def['custom_type']) ? $def['custom_type'] : $def['type'];
	if($type == "multienum")
		$multienums[$f] = $focus->$f;
}

require_once('include/formbase.php');
$focus = populateFromPost('', $focus);

if(!$focus->ACLAccess('Save')){		
		ob_clean();
		$result = array(
			'field' => $_REQUEST['field'],
			'success' => 'no_access',
		);
		echo $json->encodeReal($result);
		die;
}

foreach($focus->field_defs as $f=>$def) {
	$type = !empty($def['custom_type']) ? $def['custom_type'] : $def['type'];
	if($type == "multienum")
		if(!isset($_REQUEST[$f]) && $field != $f)
			$focus->$f = $multienums[$f];	
}

if($_REQUEST['current_module'] == 'Contacts' && $field == 'sync_contact'){	
		if(!empty($_REQUEST['sync_contact']))
			 $focus->contacts_users_id = $GLOBALS['current_user']->id;		
		else{
			if (!isset($focus->users))			
	      	  	$focus->load_relationship('user_sync');			
	      	$focus->contacts_users_id = null;
			$focus->user_sync->delete($focus->id, $GLOBALS['current_user']->id);
		}
}


$focus->save();
$focus->retrieve($_REQUEST['record']);





if( 1 ){


	$oType = "";
	$displayParams = array();
	$customCode = "";

	$GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], $_REQUEST['current_module']);

	$ss = new Sugar_Smarty();
	$ss->assign('MOD', $GLOBALS['mod_strings']);
	$ss->assign('APP', $GLOBALS['app_strings']);
	$ss->left_delimiter = '{{';
	$ss->right_delimiter = '}}';
	$tpl = "include/DetailView/enhanced_DetailViewField.tpl";

	$view = 'DetailView';


	foreach($focus->toArray() as $name => $value){
		$fieldDefs[$name] = $focus->field_defs[$name];

		if(empty($fieldDefs[$name]['value'])){
	     	$fieldDefs[$name]['value'] = $value;
	     }
	}

		

	$value = $focus->$field;

	$valueFormatted = false;
	$fieldDefs[$field] = $focus->field_defs[$field];				
				
	foreach(array("formula", "default", "comments", "help") as $toEscape){
		if (!empty($fieldDefs[$field][$toEscape])){
			$fieldDefs[$field][$toEscape] = htmlentities($fieldDefs[$field][$toEscape], ENT_QUOTES, 'UTF-8');
		}
	}
	if(isset($fieldDefs[$field]['options']) && isset($app_list_strings[$fieldDefs[$field]['options']])) {
		$fieldDefs[$field]['options'] = $app_list_strings[$fieldDefs[$field]['options']]; 
	} 
	if(isset($fieldDefs[$field]['function'])) {
		$function = $fieldDefs[$field]['function'];
		if(is_array($function) && isset($function['name'])){
			$function = $fieldDefs[$field]['function']['name'];
		}else{
			$function = $fieldDefs[$field]['function'];
		}
		if(!empty($fieldDefs[$field]['function']['returns']) && $fieldDefs[$field]['function']['returns'] == 'html'){
			if(!empty($fieldDefs[$field]['function']['include'])){
				require_once($fieldDefs[$field]['function']['include']);
			}
			$value = $function($focus, $field, $value, $view);
			$valueFormatted = true;
		}else{
			$fieldDefs[$field]['options'] = $function($focus, $field, $value, $view);
		}
	}

	/*
	if(isset($fieldDefs[$field]['type']) && $fieldDefs[$field]['type'] == 'function' && isset($fieldDefs[$field]['function_name'])){
		$value = $this->callFunction($fieldDefs[$field]);
		$valueFormatted = true;
	}*/


	if(!$valueFormatted){
		$value = isset($focus->$field) ? $focus->$field : '';
	}  

	if(empty($fieldDefs[$field]['value'])){
		$fieldDefs[$field]['value'] = $value;
	}


	if(in_array($field,array('primary_address_street','alt_address_street','billing_address_street','shipping_address_street'))){
		$oType = "address";
		$displayParams['key'] = str_replace('_address_street','',$field);
	}else if($field == 'parent_name' && isset($focus->parent_type) && !empty($focus->parent_type)){
		$parent_class = $beanList[$focus->parent_type];
		require_once($beanFiles[$parent_class]);
		$p = new $parent_class();
		$p->retrieve($focus->parent_id);
		$fieldDefs['parent_name']['value'] = $p->name;		
	}else if($field == 'duration_hours'){
		$customCode = '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV}&nbsp;';
		
	}else if($fieldDefs[$field]['type'] == "fullname"){
		// letrium v
		// change vCard type on button and add submit function
		$customCode = '{$fields.fullname.value} <button onclick="this.form.to_pdf.value=\'true\'; this.form.action.value=\'vCard\';  this.form.submit();" type="button" name="vCardButton" id="btn_vCardButton" value="vCard" title="vCard" class="button"><img src="index.php?entryPoint=getImage&imageName=edv_vcard.png"></button>';
		$fieldDefs['fullname']['value'] = $focus->full_name;	
	}else if($_REQUEST['current_module'] == 'Calls' && $field == "direction"){
		$customCode = '{$fields.direction.options[$fields.direction.value]} {$fields.status.options[$fields.status.value]}';
		$fieldDefs['status']['options'] = $app_list_strings[$fieldDefs['status']['options']];
	}


	if(!empty($customCode)){
		$ss->assign('customCode', true);
		$fieldDefs[$field]['customCode'] = $customCode;
		$ss->assign('colData', array('field'=>$fieldDefs[$field]));
	}
	
	$ss->assign('field_name', $field);
	$ss->assign('fields', $fieldDefs);
	if(!empty($oType))
		$ss->assign('type', $oType);
	$ss->assign('displayParams', $displayParams);


	$content = $ss->fetch($tpl);
	$content = preg_replace('/\{\*[^\}]*?\*\}/', '', $content);
	


	$ss->left_delimiter = '{';
	$ss->right_delimiter = '}';		
	$tpl = "include/DetailView/enhanced_DetailViewBuffer.tpl";
	$ss->assign('buffer', $content);
	$content = $ss->fetch($tpl);

	$content = str_replace("id='".$field."'","id='".$field."_span'",$content);
	$content = str_replace('id="'.$field.'"','id="'.$field.'_span"',$content);
	
	
	if ($focus->field_defs[$field]['type'] == 'relate') {		
		$sField = $focus->field_defs[$field]['id_name'];
		$content = str_replace("id=\"".$sField."\"", "id=\"".$sField."_span\"", $content);	
	}	
	
	if($oType == "address"){
		$content = str_replace('id="'.$displayParams['key'].'_address_city"','id="'.$displayParams['key'].'_address_city_span"',$content);
		$content = str_replace('id="'.$displayParams['key'].'_address_state"','id="'.$displayParams['key'].'_address_state_span"',$content);	
		$content = str_replace('id="'.$displayParams['key'].'_address_postalcode"','id="'.$displayParams['key'].'_address_postalcode_span"',$content);
		$content = str_replace('id="'.$displayParams['key'].'_address_country"','id="'.$displayParams['key'].'_address_country_span"',$content);
	}

	$content .= "&nbsp";

}

$result = array(
	'field' => $_REQUEST['field'],
	'success' => 'ok',
	'content' => $content,	
);
ob_clean();
echo $json->encodeReal($result);

?>
