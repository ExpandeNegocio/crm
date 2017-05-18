/**
 * @author Penlopjo
 */
function retrasarLlamada(tipoRetraso, id) {

	/*if (confirm("¿Esta seguro de que desea retrasar " + tipoRetraso + " la llamada actual?")) {

	 url='index.php?entryPoint=retrasarLlamadas&id=' + i + '&retraso=' + tipoRetraso;
	 $.ajax({
	 type : "POST",
	 url : url,
	 data : "id=" + id + "&retraso=" + tipoRetraso,
	 success : function(data) {
	 document.EditView.action.value='Save';
	 document.EditView.return_action.value='DetailView';
	 formSubmitCheck();
	 alert('Se ha retrasado la llamada ' + tipoRetraso);
	 },
	 error : function(jqXHR, textStatus, errorThrown) {
	 alert('No se ha podido realizar la acción - ' + textStatus + ' - ' + errorThrown);
	 }
	 });

	 } else {
	 return false;
	 }*/

	var f = new Date();

	var year = f.getFullYear();
	var mes = f.getMonth();
	var dia = f.getDate();
	var hora = f.getHours();
	var minutos = f.getMinutes();

	var segundos = 0;
	var retraso = 0;
	var valorFechaTermino = 0;

	var fechaInicial = new Date(year, mes, dia, hora, minutos, segundos);
	valorFecha = fechaInicial.valueOf();
	
	switch(tipoRetraso){
		case "1H":
			valorFechaTermino = valorFecha + (60 * 60 * 1000 );
			break;
		case "1D":
			valorFechaTermino = valorFecha + (24 * 60 * 60 * 1000 );
			break;
		case "3D":
			valorFechaTermino = valorFecha + (3 * 24 * 60 * 60 * 1000 );
			break;
		case "7D":
			valorFechaTermino = valorFecha + (7 * 24 * 60 * 60 * 1000 );
			break;
	}

	fechaTermino = new Date(valorFechaTermino);

	//Calculamos los minutos y si pasamos de hora
	var sumaHor = 0;
	var min = "00";

	if (fechaTermino.getMinutes() >= 0 && fechaTermino.getMinutes() <= 7) {
		$('#date_start_minutes > option[value="00"]').attr('selected', 'selected');
	} else if (fechaTermino.getMinutes() >= 8 && fechaTermino.getMinutes() <= 22) {
		$('#date_start_minutes > option[value="15"]').attr('selected', 'selected');
		min = "15";
	} else if (fechaTermino.getMinutes() >= 23 && fechaTermino.getMinutes() <= 36) {
		$('#date_start_minutes > option[value="30"]').attr('selected', 'selected');
		min = "30";
	} else if (fechaTermino.getMinutes() >= 37 && fechaTermino.getMinutes() <= 52) {
		$('#date_start_minutes > option[value="45"]').attr('selected', 'selected');
		min = "45";
	} else if (fechaTermino.getMinutes() >= 53 && fechaTermino.getMinutes() <= 59) {
		$('#date_start_minutes > option[value="00"]').attr('selected', 'selected');
		sumaHor = 1;
	}

	var horas = fechaTermino.getHours() + sumaHor;
	var meridi = "";

	if (horas >= 0 && horas <= 12) {
		//document.getElementById('date_start_hours').value=horas;
		meridi = "am";
	} else {
		//document.getElementById('date_start_hours').value=horas-12;
		horas = horas - 12;
		meridi = "pm";
	}
	var horasFor = ("0" + horas).slice(-2);
	$('#date_start_hours > option[value="' + horasFor + '"]').attr('selected', 'selected');
	$('#date_start_meridiem > option[value="' + meridi + '"]').attr('selected', 'selected');

	//document.getElementById('date_start_date').text=trim(("0" + fechaTermino.getDate()).slice(-2)+"/"+("0" + (fechaTermino.getMonth() + 1)).slice(-2)+"/"+(fechaTermino.getYear()+1900))+ " "+horasFor+":"+min+meridi;

	$("#date_start_date").val(("0" + fechaTermino.getDate()).slice(-2) + "/" + ("0" + (fechaTermino.getMonth() + 1)).slice(-2) + "/" + (fechaTermino.getYear() + 1900));

	combo_date_start.update();
	SugarWidgetScheduler.update_time();

	//	document.EditView.return_action.value='DetailView';
	//	formSubmitCheck();

}

function abrirGestionesAgrupadas(llamada){
	
	url = 'index.php?entryPoint=recogeGestion&llamada=' + llamada+"&tipo=AgrupadasFromLLamada";
	$.ajax({
		type : "POST",
		url : url,
		data : "llamada=" + llamada+"&tipo=AgrupadasFromLLamada",
		success : function(data) {

			if(data!=""){//se trata de gestiones
				var gestiones=data.split(",");
				for (var i=0;i<gestiones.length;i++){
					window.open('index.php?module=Expan_GestionSolicitudes&action=EditView&record=' + gestiones[i]);
				
				}
			}

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se han podido abrir para edidion la solicitud y la gestion asociada - ' + textStatus + ' - ' + errorThrown);
		}
	});
	
	
}

function abrirSolicitudEdicion(gestion) {

	url = 'index.php?entryPoint=recogeSolicitud&gestion=' + gestion;
	$.ajax({
		type : "POST",
		url : url,
		data : "gestion=" + gestion,
		success : function(data) {	
			if(data!=""){//se trata de una gestion
				window.open('index.php?module=Expan_Solicitud&action=EditView&record=' + data);
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se han podido abrir para edidion la solicitud y la gestion asociada - ' + textStatus + ' - ' + errorThrown);
		}
	});
}

function abrirSolicitudGestionEdicion(gestion) {

	url = 'index.php?entryPoint=recogeSolicitud&gestion=' + gestion;
	$.ajax({
		type : "POST",
		url : url,
		data : "gestion=" + gestion,
		success : function(data) {

			window.open('index.php?module=Expan_GestionSolicitudes&action=EditView&record=' + gestion);
			window.open('index.php?module=Expan_Solicitud&action=EditView&record=' + data);

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se han podido abrir para edidion la solicitud y la gestion asociada - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function abrirLlamadaEdicion(Llamada) {
	window.open('index.php?module=Calls&action=EditView&record=' + Llamada);
}

function abrirGestionEdicion(gestion) {
	window.open('index.php?module=Expan_GestionSolicitudes&action=EditView&record=' + gestion);
}

function carga(gestion) {
	alert(gestion);
}

function crearLlamada(gestionid) {

	url = 'index.php?entryPoint=recogeGestion&gestionid=' + gestionid+"&tipo=FromId";
	$.ajax({
		type : "POST",
		url : url,
		data : "gestionid=" + gestionid+"&tipo=FromId",
		success : function(data) {
			window.open('index.php?module=Calls&action=EditView&gestion=' + data);
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido crear una nueva llamada - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function crearTarea(gestionid) {

	url = 'index.php?entryPoint=recogeGestion&gestionid=' + gestionid+"&tipo=FromId";
	$.ajax({
		type : "POST",
		url : url,
		data : "gestionid=" + gestionid+"&tipo=FromId",
		success : function(data) {
			window.open('index.php?module=Tasks&action=EditView&gestion=' + data);
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido crear una nueva tarea - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function DesactivarGS() {
	
	if (document.getElementById("expan_gestionsolicitudes_calls_1_name") != null) {
		var campo = document.getElementById("expan_gestionsolicitudes_calls_1_name").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
			$("#expan_gestionsolicitudes_calls_1_name_label").hide();
		}
	}

	if (document.getElementById("duration_hours_label") != null) {
		var campo = document.getElementById("duration_hours_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
	}

	if (document.getElementById("reminder_time_label") != null) {
		var campo = document.getElementById("reminder_time_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
	}
	if (document.getElementById("parent_type") != null) {
		var campo = document.getElementById("parent_type").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
	}
	
	if (document.getElementById("expan_franquicia_calls_1_name_label") != null) {
		var campo = document.getElementById("expan_franquicia_calls_1_name_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}		
	}
	
	var campo = document.getElementById("parent_name_label");
	if (campo != null) {
		campo.style.display = 'none';
	}
	
	var campo = document.getElementById("create_link");
	if (campo != null) {
		campo.style.display = 'none';
	}


	var campo = document.getElementById("create_image");
	if (campo != null) {
		campo.style.display = 'none';
	}	
	
	var campo = document.getElementById("create_image");
	if (campo != null) {
		campo.style.display = 'none';
	}	
	
	if ($("#telefono").val()==''){
		getTelefono();
	}	
			
	$("[href='index.php?module=Calls&action=EditView&return_module=Calls&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Calls&return_module=Calls&return_action=index']").hide();
	$("[href='index.php?module=Tasks&action=EditView&return_module=Tasks&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Tasks&return_module=Tasks&return_action=index']").hide();

	//AL CAMPO
	
	$( "#oportunidad_inmediata" ).click(function() {		
		if (document.getElementById('oportunidad_inmediata').checked){			
			alert( "Revisar el Rating de la solicitud asociada" );
		}  		
	});

	deactivateModifiedName();
	
	
}

function ModPaginaLista() {

	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Calls&action=EditView&return_module=Calls&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Calls&return_module=Calls&return_action=index']").hide();
	//alert("Llega a la js");

}

function deactivateModifiedName(){	
	$("#btn_modified_by_name").hide();
	$("#btn_clr_modified_by_name").hide();
	$("#modified_by_name").prop('disabled', true);
}

function Avisar() {
	if ($('#status option:selected').val() == "Held") {
		alert("Revisar checks y volcar informe de estado en observaciones del informe (Si es necesario)");
	}
}

function getTelefono() {
	
	var idGestion=$("#form_SubpanelQuickCreate_Calls > table > tbody > tr > td.buttons > input[type='hidden']:nth-child(7)").val();

	url='index.php?entryPoint=recogeTelefonoGestion&id=' + idGestion;
	$.ajax({
		type : "POST",
		url : url,
		data : "id=" + idGestion,
		success : function(data) {						
			$("#telefono").val(data);				
		},
		error : function(jqXHR, textStatus, errorThrown) {					
		}
	});
}

