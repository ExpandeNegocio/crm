<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Expan_SolicitudViewDetail extends ViewDetail 
{		
	public function display() 
 	{	
		//the below line renders Project or the value of priority

		
 		echo $this->bean->module;

 	     parent::display();
         
          echo '<script type="text/javascript">onload=cargaAccionesSol();</script>';	                    
                   
 	} 	 	
}
?>
