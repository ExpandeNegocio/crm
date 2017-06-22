function cambiaModeloNeg(data){		
	
	var i=1;
	
	var negocios=data.split("|");
	
	$('#modeloneg').empty();
	
	$('#modeloneg').append($('<option/>', {
	        value: '',
	        text : '' 
	    }));
	
	$.each(negocios, function (index, value) {	
		if (value!=''){
		    $('#modeloneg').append($('<option/>', {     	    
		        value: i,
		        text : value 
		    }));
		    i++;
		}	

	});
	
}


function recogelistaNegocios(franquicia,modNeg){
	
	url = 'index.php?entryPoint=consultarFranquicia&idFran=' + franquicia +"&tipo=FranqModeloNegocio";
	$.ajax({
		type : "POST",
		url : url,
		data : "idFran=" + franquicia +"&tipo=FranqModeloNegocio",
		success : function(data) {

			if (data!=null){
				cambiaModeloNeg(data);
				if (modNeg!=null){
					$('#modeloneg').val(modNeg);
				}
			}			

		},
		error : function(jqXHR, textStatus, errorThrown) {
			return null;
		}
	});
	
}

/*
function cargaNegocio(franquicia,modNeg){
	url = 'index.php?entryPoint=consultarFranquicia&idFran=' + franquicia +"&tipo=FranqModeloNegocio";
	$.ajax({
		type : "POST",
		url : url,
		data : "idFran=" + franquicia +"&tipo=FranqModeloNegocio",
		success : function(data) {

			if (data!=null){
				cambiaModeloNeg(data);
				alert (modNeg);
				$('#modeloneg').val(modNeg);
			}			

		},
		error : function(jqXHR, textStatus, errorThrown) {
			return null;
		}
	});
}*/
