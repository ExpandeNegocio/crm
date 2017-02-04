<?php
// NOTE => Defining the field definition 
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');
class SugarFieldWysiwyg extends SugarFieldBase {

  function getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    return parent::getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    }

  function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
      require_once('include/SugarTinyMCE.php');
      global $json;
    
    if(empty($json)) {
      $json = getJSONobj();
    }
    $tiny = new SugarTinyMCE();
    $tiny->buttonConfigs['default']['buttonConfig2'] = "cut,copy,paste,pastetext,pasteword,selectall,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,ltr,rtl,separator,undo,redo,separator,link,unlink,anchor,separator,sub,sup,separator,charmap,visualaid";
    $tiny->buttonConfigs['default']['buttonConfig3'] = "tablecontrols,separator,advhr,hr,removeformat,separator,insertdate,inserttime,separator";
    $tiny->defaultConfig['apply_source_formatting']=false;
    $tiny->defaultConfig['cleanup_on_startup']=true;
    $tiny->defaultConfig['relative_urls']=false;
    $tiny->defaultConfig['convert_urls']=false;
    $tiny->defaultConfig['strict_loading_mode'] = true;
    $tiny->defaultConfig['width'] = '50%';
    $config = $tiny->defaultConfig;
    $config['elements'] = $vardefs['name'];
    $config['theme_advanced_buttons1'] = $tiny->buttonConfigs['default']['buttonConfig']; 
    $config['theme_advanced_buttons2'] = $tiny->buttonConfigs['default']['buttonConfig2']; 
    $config['theme_advanced_buttons3'] = $tiny->buttonConfigs['default']['buttonConfig3']; 
    $jsConfig = $json->encode($config);
    $initiate = '<script type="text/javascript" language="Javascript">tinyMCE.init('.$jsConfig.');</script>';
    $this->ss->assign("tiny", $initiate);
    return parent::getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    }
}
?>