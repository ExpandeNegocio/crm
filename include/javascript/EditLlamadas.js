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
		case "4H":
			valorFechaTermino = valorFecha + (4* 60 * 60 * 1000 );
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
					window.open('index.php?module=Expan_GestionSolicitudes&action=DetailView&record=' + gestiones[i]);
				
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
				window.open('index.php?module=Expan_Solicitud&action=DetailView&record=' + data);
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

			window.open('index.php?module=Expan_GestionSolicitudes&action=DetailView&record=' + gestion);
			window.open('index.php?module=Expan_Solicitud&action=DetailView&record=' + data);

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
	
	$("#status").on('change',cambioEstado);
	
	cambioEstado();
	
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
	
	getFechaRetraso();
	addDelayButtons();
			
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
	modificarComboTipoLlamada();
	
	
}
function modificarComboTipoLlamada(){
	var url=window.location.href;
	var el=document.getElementById('call_type').textContent;
	var nombres=el.split("[");
	var indice;
	
	if(url.indexOf("Expan_Franquicia")>-1){//si es de modulo franquicias
		indice="FRAN";
	}else{// gestiones
		indice="GEST";
		
	}
	
	for(i=1; i<nombres.length; i++){
		
		var cadena=nombres[i].trim();
		if(cadena.indexOf(indice)){//si es de franquicia se borra
			$("#call_type option[label='["+cadena+"']").remove();
		}
		
	}
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

	url='index.php?entryPoint=recogeTelefonoGestion&idGest=' + idGestion+'&tipo=numTelefono';
	$.ajax({
		type : "POST",
		url : url,
		data : "idGest=" + idGestion + '&tipo=numTelefono',
		success : function(data) {						
			$("#telefono").val(data);	
			var titulo=$('div.moduleTitle').children('h2').children('a').text();
			if(titulo.indexOf("Skype")!=-1&&$("#telefono").val()==''){
			$('#telefono').val("0");
	}				
		},
		error : function(jqXHR, textStatus, errorThrown) {					
		}
	});
}

function getFechaRetraso(){
	
	var idCall=$("#EditView > table > tbody > tr > td.buttons > input[type='hidden']:nth-child(2)").val();	

	url='index.php?entryPoint=recogeTelefonoGestion&idCall=' + idCall+'&tipo=fechaRetraso';
	$.ajax({
		type : "POST",
		url : url,
		data : "idCall=" + idCall +'&tipo=fechaRetraso',
		success : function(data) {						
					
			vectFechaHora=data.split("-");
			
			Fecha=("0" + vectFechaHora[2]).slice(-2)+"/"+("0" + vectFechaHora[1]).slice(-2)+"/"+vectFechaHora[0];
			if (vectFechaHora[4] >= 53 && vectFechaHora[4] <= 59){
				Hora=3+vectFechaHora[3];
			}else{
				Hora=2+vectFechaHora[3];
			}
			HoraForm=("0" + Hora).slice(-2);			
			Minutos=calcularMinutosFormat(vectFechaHora[4]);		
			
			$('#date_delayed_date').val(Fecha);
			$('#date_delayed_hours > option[value="' + HoraForm + '"]').attr('selected', 'selected');
			$('#date_delayed_minutes > option[value="' + Minutos + '"]').attr('selected', 'selected');
						
			combo_date_delayed.update(); 
				
		},
		error : function(jqXHR, textStatus, errorThrown) {					
		}
	});
		
}

function addTime(hours){
	
	var now= new Date();			
	var nowAdded=new Date(now.getTime() + (hours*60*60*1000));
	
	Fecha=("0" + nowAdded.getDate()).slice(-2)+"/"+("0" + nowAdded.getMonth()).slice(-2)+"/"+nowAdded.getYear();
	if (nowAdded.getMinutes() >= 53 && nowAdded.getMinutes() <= 59){
		Hora=1+nowAdded.getHours();
	}else{
		Hora=nowAdded.getHours();
	}
	HoraForm=("0" + Hora).slice(-2);			
	Minutos=calcularMinutosFormat(nowAdded.getMinutes());		
	
	$('#date_delayed_date').val(Fecha);
	$('#date_delayed_hours > option[value="' + HoraForm + '"]').attr('selected', 'selected');
	$('#date_delayed_minutes > option[value="' + Minutos + '"]').attr('selected', 'selected');
	
	combo_date_delayed.update();	
						 	
}


function calcularMinutosFormat(Minutos){
	
	if (Minutos >= 0 && Minutos <= 7) {
		minFor='00';
	} else if (Minutos >= 8 && Minutos <= 22) {
		minFor='15';
	} else if (Minutos >= 23 && Minutos <= 36) {		
		minFor='30';
	} else if (Minutos >= 37 && Minutos <= 52) {		
		minFor='45';
	} else if (Minutos >= 53 && Minutos <= 59) {
		minFor='00';
	}
	
	return minFor;
	
}

function addDelayButtons(){
	
	var div= $('<button/>',
    {
        id: 'add_time_buttons',        
    });
	
	var H1 = $('<button/>',
    {
        text: '+1H',
        click: function () { addTime(1); return false;}
    });
    
	 var H4 = $('<button/>',
    {
        text: '+4H',
        click: function () { addTime(4); return false;}
    });
    
 	var D1 = $('<button/>',
    {
        text: '+1D',
        click: function () { addTime(24); return false;}
    });
	
 	var D3 = $('<button/>',
    {
        text: '+3D',
        click: function () { addTime(24*3); return false;}
    });
    
 	var D7 = $('<button/>',
    {
        text: '+7D',
        click: function () { addTime(24*7); return false;}
    });
    
    div.hide();
		
	div.append(H1);
	div.append(H4);
	div.append(D1);
	div.append(D3);
	div.append(D7);
	
	$("#date_delayed_time_section").append(div);
	
}

function limpiarNuevoInicio(){
	$("#date_delayed_date").val('');
	$('#date_delayed_hours').val('');
	$('#date_delayed_minutes').val('');	
}

function cambioEstado(){
		
	if ($("#status").val()=='Not Held'){
		$("#date_delayed_date").parent().show();	
		$("#date_delayed_hours").parent().show();	
		$("#add_time_buttons").show();
		
		$("#date_delayed_label").text("Nuevo Inicio:");	
		getFechaRetraso();		
				
	}else{
		$("#date_delayed_date").parent().hide();
		$("#date_delayed_hours").parent().hide();
		$("#add_time_buttons").hide();
		$("#date_delayed_label").text("");
		limpiarNuevoInicio();
		
	}	
	
}
