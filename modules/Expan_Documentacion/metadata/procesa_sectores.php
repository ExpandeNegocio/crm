<?php

   echo 'Probando<br/>';   
   echo 'id Docu - '.$_GET['id'].'<br/>';
   echo 'Campo - '. $fields->name->value;

   echo 'LLega-1<br/>';  

   require_once "SugarSoap.php";
   echo 'LLega0<br/>';   
	$soap=new SugarSoap('http://www.expandenegocio.com/sugarcrm_des/soap.php?wsdl'); // we automatically log in

	echo 'LLega1<br/>';   

	$result=$soap->getContacts(" contacts.email1<>'' ",5," contacts.last_name desc");
	if($result['result_count']>0){  
	    foreach($result['entry_list'] as $record){
	        $array= $soap->nameValuePairToSimpleArray($record['name_value_list']);
	        echo $array['first_name'] . " " . $array['last_name'] . " - " . $array['email1']. "<br>";               
	    }
	} else {
	    echo "No contacts found";
	}  

	function getContacts($query='',$maxnum=0,$orderby=' contacts.last_name asc'){
	    $result = $this->proxy->get_entry_list(
	        $this->sess,
	        'Contacts',
	        $query,
	        $orderby,
	        0,
	        array(
	            'id',
	            'first_name',
	            'last_name',
	            'account_name',
	            'account_id',
	            'email1',
	            'phone_work',
	        ),
	        $maxnum,
	        false
	    );
	    return $result;
	}               
	 


 ?>