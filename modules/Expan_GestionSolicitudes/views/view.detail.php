<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Expan_GestionSolicitudesViewDetail extends ViewDetail 
{		
	public function display() 
 	{	
		//the below line renders Project or the value of priority

		
 		echo $this->bean->module;

 	     parent::display();
		
	/*	echo "
		<script language=\"javascript\">
		window.onload=function() 
		{
            alert('Hola');
        
    		        		   	
    		var campo = document.getElementById(\"whole_subpanel_expan_gestionsolicitudes_calls_1\");
    		if (campo != null) {
    			campo.style.display = 'none';
    		}	
    		
    		var campo = document.getElementById(\"whole_subpanel_expan_gestionsolicitudes_meetings_1\");
    		if (campo != null) {
    			campo.style.display = 'none';
    		}	
    		
    		var campo = document.getElementById(\"whole_subpanel_expan_gestionsolicitudes_tasks_1\");
    		if (campo != null) {
    			campo.style.display = 'none';
    		}	
    		
    		$('#temp_modneg1').parent().parent().hide();
            $('#temp_modneg2').parent().parent().hide();
            $('#temp_modneg3').parent().parent().hide();
            $('#temp_modneg4').parent().parent().hide();

		}
		</script>";*/
 	} 	 	
}
?>
