<?php

require_once('service/v4_1/registry.php');

class registry_custom extends registry_v4_1
{
	public function __construct($serviceClass)
	{
		parent::__construct($serviceClass);
	}
	
	protected function registerFunction() 
	{
		parent::registerFunction();
		$this->serviceClass->registerFunction('zuckerreports_query', array('session'=>'xsd:string', 'sql'=>'xsd:string'), array('return'=>'tns:return_zuckerreports_resultset'));
	}
	
	protected function registerTypes()
	{
	    parent::registerTypes();

	    $this->serviceClass->registerType(
		   	 'return_zuckerreports_resultset',
		   	 'complexType',
		   	 'struct',
		   	 'all',
		  	  '',
			array(
				'columnnames_list' => array('name' =>'columnnames_list', 'type'=>'tns:zuckerreports_resultset_columnnames_list'),
				'rows_list' => array('name' =>'rows_list', 'type'=>'tns:zuckerreports_resultset_rows_list'),
			)
		);

		$this->serviceClass->registerType(
		    'zuckerreports_resultset_columnnames_list',
			'complexType',
		   	 'array',
		   	 '',
		  	  'SOAP-ENC:Array',
			array(),
		    array(
		        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'xsd:string[]')
		    ),
			'xsd:string'
		);

		$this->serviceClass->registerType(
		    'zuckerreports_resultset_rowvalues_list',
			'complexType',
		   	 'array',
		   	 '',
		  	  'SOAP-ENC:Array',
			array(),
		    array(
		        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'xsd:string[]')
		    ),
			'xsd:string'
		);
		
		$this->serviceClass->registerType(
		    'zuckerreports_resultset_rows_list',
			'complexType',
		   	 'array',
		   	 '',
		  	  'SOAP-ENC:Array',
			array(),
		    array(
		        array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:zuckerreports_resultset_rowvalues_list[]')
		    ),
			'tns:zuckerreports_resultset_rowvalues_list'
		);


	}	
	
}