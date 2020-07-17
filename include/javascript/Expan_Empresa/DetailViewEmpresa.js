


	coloreaSectores();
	renderConsultora();
	renderProveedorTab();
	renderPropuestaTab();
	renderCompetidorTab();
	renderMotivos();
	renderAlianzaTab();
	hide();


function hide(){
	$("#activities_correocandidato_button").hide();
}

function renderMotivos(){
	if ($("#encaje_cliente option:selected").text() == "ne") {
		$("#motivo_no_encaja_label").show();
		$("#motivo_no_encaja").parent().show();
	} else {
		$("#motivo_no_encaja_label").hide();
		$("#motivo_no_encaja").parent().hide();
	}

	if ($("#encaje_cliente option:selected").text() == "eng") {
		$("#motivo_no_gusta_label").show();
		$("#motivo_no_gusta").parent().show();
	} else {
		$("#motivo_no_gusta_label").hide();
		$("#motivo_no_gusta").parent().hide();
	}
}

function renderCompetidorTab() {
	if ($("#chkCompetidor").is(':checked') &&
		$("#empresa_type_detailblock").text().trim() =="Franquicia") {
		$("a:contains('Datos competidor')").show();
	} else {
		$("a:contains('Datos competidor')").hide();
	}
}

function renderAlianzaTab() {

	if ($("#chkAlianza").is(':checked')) {
		$("a:contains('Datos alianza')").show();
	} else {
		$("a:contains('Datos alianza')").hide();
	}
}

function renderPropuestaTab() {

	if ($("#chkPotencial").is(':checked') ) {
		$("a:contains('Propuesta')").show();
	} else {
		$("a:contains('Propuesta')").hide();
	}
}

function coloreaSectores(){
	
	url='index.php?entryPoint=herramientas';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getSectorComp&tipoComp=CD",
		success : function(data) {	
			
			if (data!=''){								
				
				data=data.replace("^","");			
				var listSector=data.split(",");	
				
				for (var i=0; i < listSector.length; i++) {
					var sector=listSector[i] ;
					$('li').filter(function() { return $.text([this]) === sector; }).css("background-color","green");
   				}
			}				
		},
		error : function(jqXHR, textStatus, errorThrown) {			
			alert ('Error pintando sectores');			
		}
	});
}

function renderConsultora() {
	if ($("#chk_trabaja_consultora option:selected").text() == "Si") {
		$("#consultora_label").show();
		$("#consultora").parent().show();
	} else {
		$("#consultora_label").hide();
		$("#consultora").parent().hide();
	}
}

function renderTrabajaConsultora() {
	if ($("#empresa_type_detailblock").text() == "Franquicia" ||
		$("chk_es_cliente_potencial_detailblock").is(':checked'))  {
		$("#chk_trabaja_consultora_detailblock").parent().parent().show();
	} else {
		$("#chk_trabaja_consultora_detailblock").parent().parent().hide();
	}
}



function cambiarCompetidor(tipoComp) {

	if (confirm("¿Esta seguro de que quieres cambiar el tipo de competidor?")) {

		var idCompetidores = getListaCompetidores();
		var idEempresa = $("input[name$=\"record\"]").val();

		url = "index.php?entryPoint=consultarEmpresa";
		$.ajax({
			type: "POST",
			url: url,
			data: "tipo=CambioCompetidor" + "&tipoComp=" + tipoComp + "&idEmpresa=" + idEempresa + "&idCompetidores=" + idCompetidores,
			success: function (data) {
				YAHOO.SUGAR.MessageBox.hide();
				if (data.toUpperCase() == "OK") {
					document.location.reload();
				} else {
					alert("No se han podido cambiar el tipo de los competidores seleccionados " + estado);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("No se han podido cambiar el tipo de los competidores seleccionados - " + textStatus + " - " + errorThrown);
			}
		});

	} else {
		return false;
	}

}

function renderProveedorTab() {
	if ($("#chk_es_cliente_potencial_span").is(':checked')) {

		$("a:contains('Datos Proveedor Generales')").show();
		if ($("#chkProveedor").is(':checked')){
			$("a:contains('Datos Proveedor por Franquicia')").show();
		}else{
			$("a:contains('Datos Proveedor por Franquicia')").hide();
		}
	} else {
		$("a:contains('Datos Proveedor Generales')").hide();
		$("a:contains('Datos Proveedor por Franquicia')").hide();
	}
}

function irFranquicia(franquicia) {
	window.open('index.php?module=Expan_Franquicia&action=DetailView&record=' + franquicia, franquicia).focus();
}