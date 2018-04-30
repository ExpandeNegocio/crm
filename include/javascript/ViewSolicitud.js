
$("#btn_view_change_log").hide();
$("#save").hide();
$("#delete_button").hide();


function cambiarEstadoGestion(estado) {


	if (confirm("¿Esta seguro de que desea pasar al estado " + estado + " las gestiones seleccionadas?")) {
		
		
		//Recogemos la lista de gestiones a cambiar
		
		var idGestiones="";
		
		var lista=document.getElementsByClassName("checkbox");
		
		for (i=0;i<lista.length;i++){

			if (lista[i].checked==true){				
				idGestiones=idGestiones+"!"+lista[i].name.replace('checkbox_display_prueba-','');
			}

		}

		url = 'index.php?entryPoint=cambioEstadoGestion&estado=' + estado + '&gestiones=' + idGestiones;
		$.ajax({
			type : "POST",
			url : url,
			data : 'estado=' + estado + '&gestiones=' + idGestiones,
			success : function(data) {
				YAHOO.SUGAR.MessageBox.hide();
				if ( data.substr(id.length - 2) == 'Ok') {
					document.location.reload();					
				} else {
					alert('No se han podido cambiar los estados ' + estado);
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}

}