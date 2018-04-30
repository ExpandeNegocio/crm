<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Expan_GestionSolicitudesViewDetail extends ViewDetail 
{		
	public function display() 
 	{	
		//the below line renders Project or the value of priority

		
 		echo $this->bean->module;

 	     parent::display();
		
 	} 	 	
}
?>
