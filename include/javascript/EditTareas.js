function OcultarCreacionListado() {

	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Tasks&action=EditView&return_module=Tasks&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Tasks&return_module=Tasks&return_action=index']").hide();
	
	$( "#oportunidad_inmediata" ).click(function() {		
		if (document.getElementById('oportunidad_inmediata').checked){			
			alert( "Revisar el Rating de la solicitud asociada" );
		}  		
	});
}