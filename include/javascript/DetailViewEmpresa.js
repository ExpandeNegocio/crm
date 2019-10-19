document.addEventListener("DOMContentLoaded", function(event) {
	coloreaSectores();
	renderConsultora();
});

renderProveedorTab();
renderPropuestaTab();
renderCompetidorTab();
renderAlianzaTab();

function renderProveedorTab() {
	if ($("#chk_es_proveedor").is(':checked')) {

		$("a:contains('Mistery')").show();
		$("a:contains('Datos Proveedor Generales')").show();
		if ($("#chk_proveedor_cliente").is(':checked')){
			$("a:contains('Datos Proveedor por Franquicia')").show();
		}else{
			$("a:contains('Datos Proveedor por Franquicia')").hide();
		}
	} else {
		$("a:contains('Mistery')").hide();
		$("a:contains('Datos Proveedor Generales')").hide();
		$("a:contains('Datos Proveedor por Franquicia')").hide();
	}
}

function renderCompetidorTab() {
	if ($("#chk_es_competidor").is(':checked')) {
		$("a:contains('Datos competidor')").show();
	} else {
		$("a:contains('Datos competidor')").hide();
	}
}

function renderAlianzaTab() {
	if ($("#chk_alianza").is(':checked')) {
		$("a:contains('Datos alianza')").show();
	} else {
		$("a:contains('Datos alianza')").hide();
	}
}

function renderPropuestaTab() {
	if ($("#chk_es_cliente_potencial").is(':checked')) {
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

function cambiarCompPrincipal() {

	if (confirm("¿Esta seguro de que quieres cambiar el competidor principal?")) {

		var idCompetidores = getListaCompetidores();
		var idEempresa = $("input[name$=\"record\"]").val();

		url = "index.php?entryPoint=consultarEmpresa";
		$.ajax({
			type: "POST",
			url: url,
			data: "tipo=CompetidorPrincipal" + "&idEmpresa=" + idEempresa + "&idCompetidores=" + idCompetidores,
			success: function (data) {
				YAHOO.SUGAR.MessageBox.hide();
				if (data.toUpperCase() == "OK") {
					document.location.reload();
				} else {
					alert("No se han podido cambiar el competidor principal " + estado);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("No se han podido cambiar el competidor principal - " + textStatus + " - " + errorThrown);
			}
		});

	} else {
		return false;
	}

}

function getListaCompetidores() {

	//Recogemos la lista de competidores a cambiar

	var lista = document.getElementsByClassName("checkbox");

	var idCompetidores = "";
	var prim = true;

	var CHK_STR = "checkbox_display_prueba-";

	for (i = 0; i < lista.length; i++) {
		if (lista[i].checked == true && lista[i].name.indexOf(CHK_STR) != -1) {
			if (prim == true) {
				idCompetidores = lista[i].name.replace(CHK_STR, "");
			} else {
				idCompetidores = idCompetidores + "#" + lista[i].name.replace(CHK_STR, "");
			}
			prim = false;
		}
	}

	return idCompetidores;
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