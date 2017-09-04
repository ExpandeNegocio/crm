/**
 * @author Penlopjo
 */
function ocultarCheck() {

	/*	$(document).on({
	 ajaxStart: function() { alert('Entra Ajax');   },
	 ajaxStop: function() { alert('Cierra Ajax'); }
	 });*/
	estado = document.getElementById("estado_sol").value;
	document.getElementById("oportunidad_inmediata").disabled = true;
	document.getElementById("candidatura_avanzada").disabled = true;
	document.getElementById("candidatura_caliente").disabled = true;	
	document.getElementById("lnk_cuestionario").disabled = true;

	if (estado != 2) {

		document.getElementById("chk_envio_documentacion").disabled = true;
		document.getElementById("chk_resolucion_dudas").disabled = true;
		document.getElementById("chk_recepcio_cuestionario").disabled = true;
		document.getElementById("chk_informacion_adicional").disabled = true;
		document.getElementById("chk_sol_amp_info").disabled = true;
		
		document.getElementById("chk_entrevista").disabled = true;
		document.getElementById("chk_propuesta_zona").disabled = true;
		
		document.getElementById("chk_visitado_fran").disabled = true;
		document.getElementById("chk_envio_precontrato").disabled = true;
		document.getElementById("chk_visita_local").disabled = true;

		document.getElementById("chk_envio_contrato").disabled = true;
		document.getElementById("chk_visita_central").disabled = true;
		document.getElementById("chk_posible_colabora").disabled = true;

		document.getElementById("chk_responde_C1").disabled = true;
		
		document.getElementById("chk_envio_contrato_personal").disabled = true;
		document.getElementById("chk_envio_precontrato_personal").disabled = true;
		document.getElementById("chk_envio_plan_financiero_personal").disabled = true;

	} else {
		document.getElementById("chk_envio_documentacion").disabled = false;
		document.getElementById("chk_resolucion_dudas").disabled = false;
		document.getElementById("chk_recepcio_cuestionario").disabled = false;
		document.getElementById("chk_informacion_adicional").disabled = false;
		document.getElementById("chk_sol_amp_info").disabled = false;

		document.getElementById("chk_entrevista").disabled = false;
		document.getElementById("chk_propuesta_zona").disabled = false;
		
		document.getElementById("chk_visitado_fran").disabled = false;
		document.getElementById("chk_envio_precontrato").disabled = false;
		document.getElementById("chk_visita_local").disabled = false;

		document.getElementById("chk_envio_contrato").disabled = false;
		document.getElementById("chk_visita_central").disabled = false;
		document.getElementById("chk_posible_colabora").disabled = false;
		
		document.getElementById("chk_responde_C1").disabled = false;
		document.getElementById("chk_envio_contrato_personal").disabled = false;
		document.getElementById("chk_envio_precontrato_personal").disabled = false;
		document.getElementById("chk_envio_plan_financiero_personal").disabled = false;

	}

	//Candidatura Caliente de solo lectura

	//activarCanCaliente();

	//Añadimos los eventos de check para fechas

	$("#chk_envio_documentacion").bind("click", function() {
		activarFecha("#chk_envio_documentacion", "#envio_documentacion");
	});

	$("#chk_responde_C1").bind("click", function() {
		activarFecha("#chk_responde_C1", "#f_responde_C1");		
		//activarCanCaliente();
	});
	
	$("#lnk_cuestionario_detailblock").bind("click", function() {
		alert("Hola");
	});
	
	$("#chk_resolucion_dudas").bind("click", function() {
		activarFecha("#chk_resolucion_dudas", "#f_resolucion_dudas");
		if (!$("#chk_resolucion_dudas").is(':checked')){
			return;
		}	
		textoObs="Se le resuelven principales dudas del modelo de negocio.Pendiente de reunión";
		if (existeTextoObserva(textoObs)==false){
			//addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});

	$("#chk_recepcio_cuestionario").bind("click", function() {
		activarFecha("#chk_recepcio_cuestionario", "#f_recepcion_cuestionario");
		if (!$("#chk_recepcio_cuestionario").is(':checked')){
			return;
		}
		textoObs="Recibido cuestionario Ampliado, perfil validado. Pendiente fecha de nueva reunion.";	
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}	
		//activarCanCaliente();
	});

	$("#chk_informacion_adicional").bind("click", function() {
		activarFecha("#chk_informacion_adicional", "#f_informacion_adicional");
		if (!$("#chk_informacion_adicional").is(':checked')){
			return;
		}
		textoObs="Analizada la informacion Financiera. Le surgen dudas de …";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});
	
	$("#chk_sol_amp_info").bind("click", function() {
		activarFecha("#chk_sol_amp_info", "#f_sol_amp_info");
		if (!$("#chk_sol_amp_info").is(':checked')){
			return;
		}
		textoObs="Se le resuelven principales dudas del modelo de negocio.Pendiente de reunión";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});	

	$("#chk_entrevista").bind("click", function() {
		activarFecha("#chk_entrevista", "#f_entrevista");
		//activarCanCaliente();
	});
	
	$("#chk_propuesta_zona").bind("click", function() {
		activarFecha("#chk_propuesta_zona", "#f_propuesta_zona");		
	});
		
	$("#chk_envio_precontrato_personal").bind("click", function() {
		activarFecha("#chk_envio_precontrato_personal", "#f_envio_precontrato_personal");		
	});
	$("#chk_envio_contrato_personal").bind("click", function() {
		activarFecha("#chk_envio_contrato_personal", "#f_envio_contrato_personal");		
	});
	$("#chk_envio_plan_financiero_personal").bind("click", function() {
		activarFecha("#chk_envio_plan_financiero_personal", "#f_envio_plan_financiero_personal");		
	});

	$("#chk_visitado_fran").bind("click", function() {
		activarFecha("#chk_visitado_fran", "#f_visitado_fran");
		if (!$("#chk_visitado_fran").is(':checked')){
			return;
		}
		textoObs="Visita presencial de centro franquiciado";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});

	$("#chk_envio_precontrato").bind("click", function() {
		activarFecha("#chk_envio_precontrato", "#f_envio_precontrato");
		if (!$("#chk_envio_precontrato").is(':checked')){
			return;
		}
		textoObs="Pendiente de respuesta a la firma de precontrato";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});

	$("#chk_visita_local").bind("click", function() {
		activarFecha("#chk_visita_local", "#f_visita_local");
		if (!$("#chk_visita_local").is(':checked')){
			return;
		}
		textoObs="Analizando locales";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});

	$("#chk_envio_contrato").bind("click", function() {
		activarFecha("#chk_envio_contrato", "#f_envio_contrato");
		if (!$("#chk_envio_contrato").is(':checked')){
			return;
		}
		textoObs="Revisando clausulas del contrato";
		if (existeTextoObserva(textoObs)==false){
		//	addFechaObserva(textoObs);
		}
		//activarCanCaliente();
	});

	$("#chk_visita_central").bind("click", function() {
		activarFecha("#chk_visita_central", "#f_visita_central");
		//activarCanCaliente();
	});

	//Activamos el cambio de texto en 
	$("#observaciones_informe").bind("keyup", function() {
		if (window.event.keyCode==13){
			addFechaObserva("");
		}
	});
	
	$("#chk_posible_colabora").bind("click", function() {
		activarFecha("#chk_posible_colabora", "#f_posible_colabora");
	});
	
	
	$("#observaciones_informe").bind("click", function() {
		//alert ($("#observaciones_informe").val());
		if ($("#observaciones_informe").val().length==0){			
			addFechaObserva("");
		}
		
	});
	
	$("#motivo_parada").bind("change", function() {
		if (estado==3){
			mensaje="Parado por "+$("#motivo_parada option:selected").text();
			if ($("#observaciones_informe").val().indexOf(mensaje) == -1 && $("#motivo_parada option:selected").text()!=""){
				addFechaObserva(mensaje);
			}						
		}	
	})
	.change();
	
	$("#motivo_descarte").bind("change", function() {
		if (estado==4){
			mensaje="Descartado por "+$("#motivo_descarte option:selected").text();
			if ($("#observaciones_informe").val().indexOf(mensaje) == -1 && $("#motivo_descarte option:selected").text()!=""){
				addFechaObserva(mensaje);
			}
		}			
	})
	.change();
	
	$("#motivo_descarte").bind("change",organizarMotivos()).change();
		
	var texto1=document.getElementById("chk_responde_C1_label");
	var texto2=document.getElementById("chk_recepcio_cuestionario_label");
	
	ocultamosSuborigen();
	mostrarSuborigen();
	cambiarNombreTipoNeg();
	deactivateModifiedName();
	ocultarModelosNegocio();
	colorearAvanzado();
	colorearCaliente();
	cambiarAGris(texto1);
	cambiarAGris(texto2);
	
}

/**
 *Oculta el encabezado de los modelos de negocio cuando no los hay 
 */
function ocultarModelosNegocio(){
	
	var tipoN1=document.getElementById("tiponegocio1_label").innerHTML;
	var tipoN2=document.getElementById("tiponegocio2_label").innerHTML;
	var tipoN3=document.getElementById("tiponegocio3_label").innerHTML;
	var tipoN4=document.getElementById("tiponegocio4_label").innerHTML;
	
	if(tipoN2==""&&tipoN1==""&&tipoN3==""&&tipoN4==""){
		//no hay modelos de negocio
		document.getElementById("ModelosDeNegocio").style.display='none';
	}
}

function ocultamosSuborigen(){
	$("#portal").parent().parent().hide();
	$("#subor_medios").parent().parent().hide();
	$("#subor_central").parent().parent().hide();
	$("#subor_expande").parent().parent().hide();
	$("#subor_mailing").parent().parent().hide();
	
	$("#expan_evento_id_c").parent().parent().hide();
	
}

function deactivateModifiedName(){	
	$("#btn_modified_by_name").hide();
	$("#btn_clr_modified_by_name").hide();
	$("#modified_by_name").prop('disabled', true);
}

function cambiarNombreTipoNeg(){
	
	$("#tiponegocio1_label").text($("#temp_modneg1").val());	
	$("#tiponegocio2_label").text($("#temp_modneg2").val());
	$("#tiponegocio3_label").text($("#temp_modneg3").val());
	$("#tiponegocio4_label").text($("#temp_modneg4").val());
	
    $("#chkvalNeg11_label").text("--"+$("#temp_valNeg11").val());
    $("#chkvalNeg12_label").text("--"+$("#temp_valNeg12").val());
    $("#chkvalNeg13_label").text("--"+$("#temp_valNeg13").val());
    $("#chkvalNeg14_label").text("--"+$("#temp_valNeg14").val());
    $("#chkvalNeg15_label").text("--"+$("#temp_valNeg15").val());
    $("#chkvalNeg21_label").text("--"+$("#temp_valNeg21").val());
    $("#chkvalNeg22_label").text("--"+$("#temp_valNeg22").val());
    $("#chkvalNeg23_label").text("--"+$("#temp_valNeg23").val());
    $("#chkvalNeg24_label").text("--"+$("#temp_valNeg24").val());
    $("#chkvalNeg25_label").text("--"+$("#temp_valNeg25").val());
    $("#chkvalNeg31_label").text("--"+$("#temp_valNeg31").val());
    $("#chkvalNeg32_label").text("--"+$("#temp_valNeg32").val());
    $("#chkvalNeg33_label").text("--"+$("#temp_valNeg33").val());
    $("#chkvalNeg34_label").text("--"+$("#temp_valNeg34").val());
    $("#chkvalNeg35_label").text("--"+$("#temp_valNeg35").val());
    $("#chkvalNeg41_label").text("--"+$("#temp_valNeg41").val());
    $("#chkvalNeg42_label").text("--"+$("#temp_valNeg42").val());
    $("#chkvalNeg43_label").text("--"+$("#temp_valNeg43").val());
    $("#chkvalNeg44_label").text("--"+$("#temp_valNeg44").val());
    $("#chkvalNeg45_label").text("--"+$("#temp_valNeg45").val());
  
	
	$("#temp_modneg1").parent().parent().hide();
	$("#temp_modneg2").parent().parent().hide();
	$("#temp_modneg3").parent().parent().hide();
	$("#temp_modneg4").parent().parent().hide();
	
	$("#temp_valNeg11_label").parent().hide();
    $("#temp_valNeg12_label").parent().hide();
    $("#temp_valNeg13_label").parent().hide();
    $("#temp_valNeg14_label").parent().hide();
    $("#temp_valNeg15_label").parent().hide();
    $("#temp_valNeg21_label").parent().hide();
    $("#temp_valNeg22_label").parent().hide();
    $("#temp_valNeg23_label").parent().hide();
    $("#temp_valNeg24_label").parent().hide();
    $("#temp_valNeg25_label").parent().hide();
    $("#temp_valNeg31_label").parent().hide();
    $("#temp_valNeg32_label").parent().hide();
    $("#temp_valNeg33_label").parent().hide();
    $("#temp_valNeg34_label").parent().hide();
    $("#temp_valNeg35_label").parent().hide();
    $("#temp_valNeg41_label").parent().hide();
    $("#temp_valNeg42_label").parent().hide();
    $("#temp_valNeg43_label").parent().hide();
    $("#temp_valNeg44_label").parent().hide();
    $("#temp_valNeg45_label").parent().hide();

	
	if ($("#tiponegocio1_label").text()==""){
		$("#tiponegocio1_label").parent().hide();
	}
	if ($("#tiponegocio2_label").text()==""){
		$("#tiponegocio2_label").parent().hide();
	}	
	if ($("#tiponegocio3_label").text()==""){
		$("#tiponegocio3_label").parent().hide();
	}
	if ($("#tiponegocio4_label").text()==""){
		$("#tiponegocio4_label").parent().hide();
	}
	
	if ($("#chkvalNeg11_label").text()=="--"){
        $("#chkvalNeg11_label").hide();
        $("#chkvalNeg11").hide();
    }
    if ($("#chkvalNeg12_label").text()=="--"){
        $("#chkvalNeg12_label").hide();
        $("#chkvalNeg12").hide();
    }
    if ($("#chkvalNeg13_label").text()=="--"){
        $("#chkvalNeg13_label").hide();
        $("#chkvalNeg13").hide();
    }
    if ($("#chkvalNeg14_label").text()=="--"){
        $("#chkvalNeg14_label").hide();
        $("#chkvalNeg14").hide();
    }
    if ($("#chkvalNeg15_label").text()=="--"){
        $("#chkvalNeg15_label").hide();
        $("#chkvalNeg15").hide();
    }
    if ($("#chkvalNeg21_label").text()=="--"){
      $("#chkvalNeg21_label").hide();
      $("#chkvalNeg21").hide();
    }
    if ($("#chkvalNeg22_label").text()=="--"){
      $("#chkvalNeg22_label").hide();
      $("#chkvalNeg22").hide();
    }
    if ($("#chkvalNeg23_label").text()=="--"){
      $("#chkvalNeg23_label").hide();
      $("#chkvalNeg23").hide();
    }
    if ($("#chkvalNeg24_label").text()=="--"){
      $("#chkvalNeg24_label").hide();
      $("#chkvalNeg24").hide();
    }
    if ($("#chkvalNeg25_label").text()=="--"){
      $("#chkvalNeg25_label").hide();
      $("#chkvalNeg25").hide();
    }
    if ($("#chkvalNeg31_label").text()=="--"){
      $("#chkvalNeg31_label").hide();
      $("#chkvalNeg31").hide();
    }
    if ($("#chkvalNeg32_label").text()=="--"){
      $("#chkvalNeg32_label").hide();
      $("#chkvalNeg32").hide();
    }
    if ($("#chkvalNeg33_label").text()=="--"){
      $("#chkvalNeg33_label").hide();
      $("#chkvalNeg33").hide();
    }
    if ($("#chkvalNeg34_label").text()=="--"){
      $("#chkvalNeg34_label").hide();
      $("#chkvalNeg34").hide();
    }
    if ($("#chkvalNeg35_label").text()=="--"){
      $("#chkvalNeg35_label").hide();
      $("#chkvalNeg35").hide();
    }
    if ($("#chkvalNeg41_label").text()=="--"){
      $("#chkvalNeg41_label").hide();
      $("#chkvalNeg41").hide();
    }
    if ($("#chkvalNeg42_label").text()=="--"){
      $("#chkvalNeg42_label").hide();
      $("#chkvalNeg42").hide();
    }
    if ($("#chkvalNeg43_label").text()=="--"){
      $("#chkvalNeg43_label").hide();
      $("#chkvalNeg43").hide();
    }
    if ($("#chkvalNeg44_label").text()=="--"){
      $("#chkvalNeg44_label").hide();
      $("#chkvalNeg44").hide();
    }
    if ($("#chkvalNeg45_label").text()=="--"){
      $("#chkvalNeg45_label").hide();
      $("#chkvalNeg45").hide();
    }
}

function detailCambiarTipoNegocio(){

/*	
	$("body *").html(function(buscayreemplaza, reemplaza) {
        return reemplaza.replace('LBL_TIPONEG1', 'Hola');
    });*/
	
	
}

function mostrarSuborigen(){
	
	var origen=$("#tipo_origen").val();

	ocultamosSuborigen();
	
    if (origen==1){		
		$("#subor_expande_label").parent().parent().show();
		$("#subor_expande").parent().parent().show();
	}else if (origen==2){
		$("#portal_label").parent().parent().show();
		$("#portal").parent().parent().show();	
	}else if (origen==3){
		$("#expan_evento_id_c_label").parent().parent().show();
		$("#expan_evento_id_c").parent().parent().show();		
	}else if (origen==4){
		$("#subor_central_label").parent().parent().show();
		$("#subor_central").parent().parent().show();	
	}else if (origen==5){
		$("#subor_medios_label").parent().parent().show();
		$("#subor_medios").parent().parent().show();	
	}else if (origen==6){
		$("#subor_mailing_label").parent().parent().show();
		$("#subor_mailing").parent().parent().show();	
	}
	
}
 

function reenvioInfo(tipoEnvio, id) {

	if (confirm("¿Esta seguro de que desea reenviar la documentacion " + tipoEnvio + " para la Gestion actual?")) {

		var config = { };
		config.title = "Enviando Correo";
		config.msg = "Espere por favor... ";
		YAHOO.SUGAR.MessageBox.show(config);

		url = 'index.php?entryPoint=reenvioDoc&id=' + id + '&tipoEnvio=' + tipoEnvio;
		$.ajax({
			type : "POST",
			url : url,
			data : "id=" + id + "&tipoEnvio=" + tipoEnvio,
			success : function(data) {
				YAHOO.SUGAR.MessageBox.hide();
				if ( data.indexOf('Ok')!=-1) {
					alert('Se ha reenviado la documentacion de tipo ' + tipoEnvio);
					location.reload(true);
				} else {
					alert('No se ha podido reenviar la información - \\n' + data);
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}

}

function envioCorreoInterlocutor(id) {

	if (confirm("¿Esta seguro de que desea enviar el correo con el cuestionario  a la franquicia?")) {

		var config = { };
		config.title = "Enviando Correo";
		config.msg = "Espere por favor... ";
		YAHOO.SUGAR.MessageBox.show(config);

		url = 'index.php?entryPoint=envioCorreoInterlocutor&id=' + id;
		$.ajax({
			type : "POST",
			url : url,
			data : "id=" + id,
			success : function(data) {
				YAHOO.SUGAR.MessageBox.hide();
				if ( data.indexOf('Ok')!=-1) {
					alert('Se ha enviado el correo de interlocutor correctamente');
				} else {
					alert('No se ha podido enviar el correo, ' + data);
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido enviar el correo - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}

}

function reenvioDoc(tipoEnvio) {

	if (confirm("¿Esta seguro de que desea reenviar la documentacion " + tipoEnvio + " para las Gestiones actuales?")) {

		var config = { };
		config.title = "Enviando Correos";
		config.msg = "Espere por favor... ";
		YAHOO.SUGAR.MessageBox.show(config);
		
		var idGests="";
		var lista=document.getElementsByClassName("checkbox");
		
		for(i=0; i<lista.length; i++){
			if(lista[i].checked==true&& lista[i].name.indexOf("mass[]")>-1){//coger los checkbox que interesan
				idGests=idGests+"!"+lista[i].value;
			}
		}

		url = 'index.php?entryPoint=reenvioDocGestiones&gestiones=' + idGests + '&tipoEnvio=' + tipoEnvio;
		$.ajax({
			type : "POST",
			url : url,
			data : "gestiones=" + idGests + "&tipoEnvio=" + tipoEnvio,
			success : function(data) {
				YAHOO.SUGAR.MessageBox.hide();
				if ( data.indexOf('No se ha podido')==-1) {
					alert('Se ha reenviado la documentacion de tipo ' + tipoEnvio + ' para las gestiones seleccionadas');
				} else {
					alert(data);
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}

}

function abrirHermanas(id) {

	url = 'index.php?entryPoint=gestionesHermanas&id=' + id;
	$.ajax({
		type : "POST",
		url : url,
		data : "id=" + id,
		success : function(data) {

			var gestionesId = data.split("#");

			for ( i = 0; i < gestionesId.length; i++) {
				if (gestionesId[i] != id && gestionesId[i] != "") {
					//alert (gestionesId[i]);
					window.open('index.php?module=Expan_GestionSolicitudes&action=EditView&record=' + gestionesId[i]);
				}
			}
			//alert(data);
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se han podido abrir las gestiones hermanas - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function irSolicitud(solicitud) {

	window.open ('index.php?module=Expan_Solicitud&action=EditView&record=' + solicitud);
	//window.location.href = 'index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Solicitud%26action%3DEditView%26record%3D' + solicitud;

}

function Hoy() {
	var f = new Date();
	return pad(f.getDate(), 2) + "/" + pad(f.getMonth() + 1, 2) + "/" + f.getFullYear();
}

function pad(n, width, z) {
	z = z || '0';
	n = n + '';
	return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function activarFecha(check, fecha) {

	if ($(check).is(':checked')) {
		$(fecha).val(Hoy());

	} else {
		$(fecha).val("");
	}

}

function addFechaObserva(linTexto){
	
	var texto=$("#observaciones_informe").val();
	
	var f = new Date();
	
	fecha=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();		
	texto=texto+('\n'+fecha+' : '+linTexto);
	$("#observaciones_informe").val(texto);
	
}

function existeTextoObserva(texto){
	
	var observa=$("#observaciones_informe").val();
	
	if (observa.search(texto)==-1){
		return false;
	}else{
		return true;
	}
}

/*
function activarCanCaliente() {	
	
	var caliente= document.getElementById("candidatura_caliente").checked;

	//Controlamos si se le puee poner a mano el check caliente o no 
	if (document.getElementById("chk_resolucion_dudas").checked == true ||
		document.getElementById("chk_responde_C1").checked == true ||
		document.getElementById("chk_sol_amp_info").checked == true ||	
		document.getElementById("chk_entrevista").checked == true
		) 
	{
		if (document.getElementById("chk_recepcio_cuestionario").checked == true ||
		document.getElementById("chk_informacion_adicional").checked == true ||	
				
		document.getElementById("chk_visitado_fran").checked == true ||
		document.getElementById("chk_envio_precontrato").checked == true ||
		document.getElementById("chk_visita_local").checked == true ||
		document.getElementById("chk_envio_contrato").checked == true ||
		document.getElementById("chk_visita_central").checked == true 	
		){ 
			document.getElementById("candidatura_caliente").disabled = true;
		}
		else{
			document.getElementById("candidatura_caliente").disabled = false;
		}
		
	} else {
		document.getElementById("candidatura_caliente").disabled = true;	
	}
	
	//Contralamos que la candidatura caliente esa checkeada o no
	
	if (document.getElementById("chk_recepcio_cuestionario").checked == true ||
		document.getElementById("chk_informacion_adicional").checked == true ||
		document.getElementById("chk_sol_amp_info").checked == true ||
		document.getElementById("chk_entrevista").checked == true ||
		document.getElementById("chk_visitado_fran").checked == true ||
		document.getElementById("chk_envio_precontrato").checked == true ||
		document.getElementById("chk_visita_local").checked == true ||
		document.getElementById("chk_envio_contrato").checked == true ||
		document.getElementById("chk_visita_central").checked == true 	
	){
		document.getElementById("candidatura_caliente").checked=true;
	}else{
		if (caliente==true){
			document.getElementById("candidatura_caliente").checked=true;
		}else{
			document.getElementById("candidatura_caliente").checked=false;
		}
	}

}
*/

function eliminarAlertaCuestionario(gestion){
	url = 'index.php?entryPoint=eliminarTareasCuestionario&gestionid=' + gestion;
		$.ajax({
			type : "POST",
			url : url,
			data : "gestionid=" + gestion,
			success : function(data) {
				//alert('Ok');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se han podido eliminar las tareas - ' + textStatus + ' - ' + errorThrown);
			}
		});
}


function abrirGestionConsulta(gestion) {
	window.open('index.php?module=Expan_GestionSolicitudes&action=DetailView&record=' + gestion);
}

function abrirSolicitudLlamadas(gestion, solicitud) {

	window.open('index.php?module=Expan_Solicitud&action=DetailView&record=' + solicitud);
	if (confirm("¿Desea abrir las llamadas asociadas?")) {
		url = 'index.php?entryPoint=recogellamadasGestion&gestionid=' + gestion;
		$.ajax({
			type : "POST",
			url : url,
			data : "gestionid=" + gestion,
			success : function(data) {
				var llamadasId = data.split("#");				
				for ( i = 0; i < llamadasId.length; i++) {					
					if (llamadasId[i] != "") {
						window.open('index.php?module=Calls&action=EditView&record=' + llamadasId[i]);
					}
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se han podido abrir las gestiones hermanas - ' + textStatus + ' - ' + errorThrown);
			}
		});
		
	}
}

function validarEdicion(){
	
	if (//validarEstadoNoAt()==false ||
		//validarEstadoCurso()==false ||
		validarMotivoDescarte()==false ||
		validarMotivoParada()==false ||
		validarMotivoPositivo()||
		validarModeloDeNegocio()==false){
		return false;
	}
	
	return check_form("EditView");
		
}

/**
 * Se comprueba si hay modelos de negocio, si los hay se valida que haya uno seleccionado
 */
function validarModeloDeNegocio(){
	
	var tipoN1=document.getElementById("tiponegocio1_label").innerHTML;
	var tipoN2=document.getElementById("tiponegocio2_label").innerHTML;
	var tipoN3=document.getElementById("tiponegocio3_label").innerHTML;
	var tipoN4=document.getElementById("tiponegocio4_label").innerHTML;
	
	if(tipoN2==""&&tipoN1==""&&tipoN3==""&&tipoN4==""){
		//no hay modelos de negocio
		
	}else{
		
		if(document.getElementById("tiponegocio1").checked==false&&document.getElementById("tiponegocio2").checked==false&&document.getElementById("tiponegocio3").checked==false&&document.getElementById("tiponegocio4").checked==false){
			//ninguno chekeado y hay modelo de negocio
			alert("Se debe seleccionar un modelo de negocio");
			//poner en rojo los modelos de negocio
			document.getElementById("tiponegocio1_label").style.color="red";
			document.getElementById("tiponegocio2_label").style.color="red";
			document.getElementById("tiponegocio3_label").style.color="red";
			document.getElementById("tiponegocio4_label").style.color="red";
			return false;
		}
		
	}
}

function validarEstadoNoAt(){
	
	if (($("#estado_sol option:selected").val()==1) && 
		$("#motivo_descarte option:selected").val()!=""){	
			alert ("El motivo de descarte debe estar vacío si el estado de la gestion es 1-No Atendido");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==1) && 
		$("#motivo_parada option:selected").val()!=""){	
			alert ("El motivo de parada debe estar vacío si el estado de la gestion es 1-No Atendido");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==1) && 
		$("#motivo_positivo option:selected").val()!=""){	
			alert ("El motivo positivo debe estar vacío si el estado de la gestion es 1-No Atendido");	
			return false;		
	}	
	
}

function validarEstadoCurso(){
	
	if (($("#estado_sol option:selected").val()==2) && 
		$("#motivo_descarte option:selected").val()!=""){	
			alert ("El motivo de descarte debe estar vacío si el estado de la gestion es 2-En Curso");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==2) && 
		$("#motivo_parada option:selected").val()!=""){	
			alert ("El motivo de parada debe estar vacío si el estado de la gestion es 2-En Curso");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==2) && 
		$("#motivo_positivo option:selected").val()!=""){	
			alert ("El motivo positivo debe estar vacío si el estado de la gestion es 2-En Curso");	
			return false;		
	}	
	
}

function validarMotivoDescarte(){	
		
	if (($("#estado_sol option:selected").val()==4) && 
		$("#motivo_descarte option:selected").val()==""){	
			alert ("El motivo de descarte no puede ser vacío si el estado de la gestion es 4-Descartado");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==4) && 
		$("#motivo_parada option:selected").val()!=""){	
			alert ("El motivo de parada debe estar vacío si el estado de la gestion es 4-Descartado");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==4) && 
		$("#motivo_positivo option:selected").val()!=""){	
			alert ("El motivo positivo debe estar vacío si el estado de la gestion es 4-Descartado");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==4) && 
	(	$("#motivo_descarte option:selected").val()<6 ||
		$("#motivo_descarte option:selected").val()==13 || 
	    $("#motivo_descarte option:selected").val()==14))
	{
		alert ("Si el candidato ha montado otro negocio, indícalo en la gestión");
	}
	
}

function validarMotivoParada(){	
		
	if (($("#estado_sol option:selected").val()==3) && 
		$("#motivo_descarte option:selected").val()!=""){	
			alert ("El motivo de descarte debe estar vacío si el estado de la gestion es 3-Parado");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==3) && 
		$("#motivo_parada option:selected").val()==""){	
			alert ("El motivo de parada no puede ser vacío si el estado de la gestion es 3-Parado");	
			return false;		
	}

	if (($("#estado_sol option:selected").val()==3) && 
		$("#motivo_positivo option:selected").val()!=""){	
			alert ("El motivo positivo debe estar vacío si el estado de la gestion es 3-Parado");	
			return false;		
	}	
	
}

function validarMotivoPositivo(){	
	
	if (($("#estado_sol option:selected").val()==5) && 
		$("#motivo_descarte option:selected").val()!=""){	
			alert ("El motivo de descarte debe estar vacío si el estado de la gestion es 5-Positivo");	
			return false;		
	}	
	
	if (($("#estado_sol option:selected").val()==5) && 
		$("#motivo_parada option:selected").val()!=""){	
			alert ("El motivo de parada debe estar vacío si el estado de la gestion es 5-Positivo");	
			return false;		
	}
		
	if (($("#estado_sol option:selected").val()==5) && 
		$("#motivo_positivo option:selected").val()==""){	
			alert ("El tipo de positivo no puede ser vacío si el estado de la gestion es 5-Positivo");	
			return false;		
	}
	
}

function ModPaginaLista(){
	
	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Expan_GestionSolicitudes&action=EditView&return_module=Expan_GestionSolicitudes&return_action=DetailView']").hide();
	//alert("Llega a la js");		
}

function organizarMotivos(){
	estado = document.getElementById("estado_sol").value;
	
	switch(estado) {
    case "3":    
    	$("#motivo_parada_label").parent().show();	
    	$("#motivo_descarte_label").parent().hide();
    	$("#motivo_positivo_label").parent().hide();
    	
		$("#motivo_descarte").val('');
		$("#motivo_positivo").val('');
    	    
        break;
    case "4":
    	$("#motivo_parada_label").parent().hide();	
    	$("#motivo_descarte_label").parent().show();
    	$("#motivo_positivo_label").parent().hide();  
    	
    	$("#motivo_parada").val('');	
		$("#motivo_positivo").val('');      
        break;
    case "5":
    	$("#motivo_parada_label").parent().hide();	
    	$("#motivo_descarte_label").parent().hide();
    	$("#motivo_positivo_label").parent().show();     
    	
    	$("#motivo_parada").val('');
		$("#motivo_descarte").val('');
    	break;
    default:
    	$("#motivo_parada_label").parent().hide();	
    	$("#motivo_descarte_label").parent().hide();
    	$("#motivo_positivo_label").parent().hide();
    	$("#motivo_parada").val('');
		$("#motivo_descarte").val('');
		$("#motivo_positivo").val(''); 
        break;
}
	
}

function colorearAvanzado(){			
	var cdudas = document.getElementById("chk_resolucion_dudas");
	var ccuestionario = document.getElementById("chk_recepcio_cuestionario");
	var cadicional = document.getElementById("chk_informacion_adicional");
	var centrevista = document.getElementById("chk_entrevista");
	var czona = document.getElementById("chk_propuesta_zona");
	var cavanzada = document.getElementById("candidatura_avanzada");
	var cavanzadal = document.getElementById("candidatura_avanzada");
	$(cavanzadal).css( "background-color", "rgb(236,234,234)");	
	
	var lista = new Array (cdudas, ccuestionario, cadicional, centrevista, czona, cavanzada);
	
	//Quitamos primero el color
	for (var i = 0; i < lista.length; i++) {
		lista[i].parentNode.style.backgroundColor = "";
	}
	
	for (i in lista){
		$(lista[i]).parent().css( "background-color", "rgb(236,234,234)");			
	}
}
function colorearCaliente(){			
	var cvisitado = document.getElementById("chk_visitado_fran");
	var cprecontrato= document.getElementById("chk_envio_precontrato");
	var clocal = document.getElementById("chk_visita_local");
	var cprecontratop = document.getElementById("chk_envio_precontrato_personal");
	var cplanpersonal = document.getElementById("chk_envio_plan_financiero_personal");
	var ccontrato = document.getElementById("chk_envio_contrato");
	var cvisita = document.getElementById("chk_visita_central");
	var ccolabora = document.getElementById("chk_posible_colabora");
	var ccontratop = document.getElementById("chk_envio_contrato_personal");
	var ccaliente = document.getElementById("candidatura_caliente");
	var ccalientel = document.getElementById("candidatura_caliente");
	$(ccalientel).css( "background-color", "rgb(219,217,217)");	
	
	var lista = new Array (cvisitado, cprecontrato, clocal, cprecontratop, cplanpersonal, ccontrato, cvisita, ccolabora, ccontratop, ccaliente);
	
	//Quitamos primero el color
	for (var i = 0; i < lista.length; i++) {
		lista[i].parentNode.style.backgroundColor = "";
	}
	
	for (i in lista){
		$(lista[i]).parent().css( "background-color", "rgb(219,217,217)");			
	}
}
	function cambiarAGris(texto){
		
		$(texto).css("color", "rgb(152,152,152)");
	}


