




function controlarDuplicados(){
	
	
	var provincia=$("#provincia_apertura").val()+"";	
	var franquicia=$("#franquicia").val()+"";
	var otra_franquicia=$("#otra_franquicia").val()+"";
	
	var salida=true;
	
	if (provincia!="" && (franquicia!="" || otra_franquicia!="")){
	
		url = "index.php?entryPoint=consultarApertura";                                           
		$.ajax({
		    type : "POST",
		    url : url,
		    async:false,
		    data : "tipo=duplicados&provincia="+provincia+"&franquicia="+franquicia+"&otra_franquicia="+otra_franquicia,
		    success : function(data) {
		    	if (data=='true'){
					var r = confirm("Ya existe una apertura para esa franquicia en esa provincia. ¿Realmente desea crear la apertura?");
					if (r == true) {
					  salida=true; 
					} else {
					  salida=false; 
					} 
		    	}

		    },
		    error : function(jqXHR, textStatus, errorThrown) {
		        alert("No se han podido cambiar el estado a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
		    }
		});
	}
	
	return salida;
	
}