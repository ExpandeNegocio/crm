<?php
    //create email template
    $buttonConfigs['default'] = array(
        'buttonConfig' => "code,help,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,forecolor,backcolor,separator,styleselect,formatselect,fontselect,fontsizeselect,",
       'buttonConfig2' => "cut,copy,paste,pastetext,pasteword,selectall,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,ltr,rtl,separator,undo,redo,separator, link,unlink,anchor,image,separator,sub,sup,separator,charmap,visualaid",
        'buttonConfig3' => "tablecontrols,separator,advhr,hr,removeformat,separator,insertdate,inserttime,separator,preview"
    );
    //Standard email compose
    $buttonConfigs['email_compose'] = array(
        'buttonConfig' => "code,help,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,forecolor,backcolor,separator,styleselect,formatselect,fontselect,fontsizeselect,",
       'buttonConfig2' => "cut,copy,paste,pastetext,pasteword,selectall,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,ltr,rtl,separator,undo,redo,separator, link,unlink,anchor,image,separator,sub,sup,separator,charmap,visualaid",
        'buttonConfig3' => "tablecontrols,separator,advhr,hr,removeformat,separator,insertdate,inserttime,separator,preview,separator,spellchecker"
    );
    //Quick email compose
    $buttonConfigs['email_compose_light'] = array(
        'buttonConfig' => "code,help,separator,bold,italic,underline,strikethrough,separator,bullist,numlist,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,forecolor,backcolor,separator,styleselect,formatselect,fontselect,fontsizeselect,",
        'buttonConfig2' => "", //empty
        'buttonConfig3' => "" //empty
    );
    
     $pluginsConfig = array(
    'email_compose_light' => 'insertdatetime,paste,directionality,safari,spellchecker',
    'email_compose' => 'advhr,insertdatetime,table,preview,paste,searchreplace,directionality,fullpage,spellchecker',
);  
// Add spellchecker to list of plugins
 $defaultConfig = array(
        //... other elements of array not shown
    'plugins' => 'advhr,insertdatetime,table,preview,paste,searchreplace,directionality,spellchecker',);
    
?>