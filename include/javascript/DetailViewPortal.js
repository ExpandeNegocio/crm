function addAltaFranquicia(portalId){
	
	var listaFran=[];
	
	var f_ini= $("#f_ini_contrata").val();
	var f_fin= $("#f_fin_contrata").val();
	var coste=  $("#coste_periodo").val();	
	
	var prueba= 0;	
	if ($('#chk_periodo_pruebas').attr('checked')){
		prueba=1;
	}
	
	 $("#franquicias option:selected").each(function(){
        if ($(this).val() != "" ){        
         	listaFran.push($(this).val());
        }
     });
     
     var listFranPak= listaFran.join();
     
     if (!validarDatos(listFranPak,f_ini,f_fin,coste)){     	
     	return null;
     }	
	
	url = 'index.php?entryPoint=operarPortales';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=AltaFranquicia&listaFran="+listFranPak +"&f_ini="+f_ini+"&f_fin="+f_fin+"&portal="+portalId+"&coste="+coste+"&prueba="+prueba,
		success : function(data) {
			if (data=='ok'){
				alert ("Datos de periodo insertados");
				location.reload();
			}else{
				alert ("ERROR - NO se han podido insertar los datos de periodo");
			}								
			
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido insertar el nuevo periodo - ' + textStatus + ' - ' + errorThrown);
		}
	});	
	
}

function deletePeriodo(pId){
	
	if(confirm("¿Esta seguro que desea eliminar el periodo?")){
		
		url = 'index.php?entryPoint=operarPortales';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaPeriodo&pId="+pId,
			success : function(data) {
				if (data=='ok'){
					alert ("El periodo se ha eliminado");
				}else{
					alert ("ERROR - El periodo no se ha podido eliminar");
				}											
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido insertar el nuevo periodo - ' + textStatus + ' - ' + errorThrown);
			}
		});	
	}
}

function changeCost(pId){

	var coste = prompt("Introduce el coste del periodo", "0");

	if (coste == null || !Number.isInteger(coste)){
		alert("El coste debe ser un número entero");
		return
	}

	url = 'index.php?entryPoint=operarPortales';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=changecost&pId="+pId +"&coste="+coste,
		success : function(data) {
			if (data=='ok'){
				alert ("Se ha cambiado el coste del periodo");
			}else{
				alert ("ERROR - El periodo no se ha podido cambiar");
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('El periodo no se ha podido cambiar - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function validarDatos(listFranPak, f_ini, f_fin, coste){
	
	if (listFranPak==""){
		alert("Es necesario seleccionar al menos una franquicia");
		return false;
	}
	
	if (f_ini==""){
		alert("Es necesario rellenar la fecha de incio del periodo");
		return false;
	}
	
	if (f_fin==""){
		alert("Es necesario rellenar la fecha de fin del periodo");
		return false;
	}
	
	if (coste==""){
		alert("Es necesario rellenar el coste del periodo");
		return false;
	}
	
	return true;
	
}

function periodosFilter(portalId){
    var year=$("#year").val();
    var fran=$("#franquicia_filter").val();


    url = 'index.php?entryPoint=operarPortales';
    $.ajax({
        type : "POST",
        url : url,
        data : "tipo=periodosFilter&portal="+portalId+"&year="+year+"&franquicia="+fran,
        success : function(data) {
            $("#ListaPeriodos").html(data);
            $("#year").val(year);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido insertar el nuevo periodo - ' + textStatus + ' - ' + errorThrown);
        }
    });
}