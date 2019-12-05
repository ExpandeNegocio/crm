
$("#btn_view_change_log").hide();
$("#save").hide();
$("#delete_button").hide();
$( document ).ready(function() {
	ocultarOrigenes();
	actualizarHistDetalle();
});


const USUARIO_VW_RUBEN='71f40543-2702-4095-9d30-536f529bd8b6';

getUsuario();
getFranquicia();

//muestraLocal();

function getUsuario(){

	url='index.php?entryPoint=herramientas&tipo=getUser';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getUser",
		success : function(data) {	
			if (data!=USUARIO_VW_RUBEN){
				$("#delegado_detailblock").parent().parent().hide();		
			}									
		},
		error : function(jqXHR, textStatus, errorThrown) {	
		}				
	});
}

function getFranquicia(){

	url='index.php?entryPoint=herramientas&tipo=getFran';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getFran",
		success : function(data) {	
			if (data!=''){	
				$("#crearFranquiciado").hide();		
				$("#marcarReunion").hide();			
				$("#tab2").hide();
			}				
		},
		error : function(jqXHR, textStatus, errorThrown) {						
		}
	});
}

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

function ocultarOrigenes(){
	
	if ($("#portal").val()==''){
		$("#portal").parent().parent().parent().hide();
	}
	
	if ($("#expan_evento_id_c").val()==''){
		$("#expan_evento_id_c").parent().parent().parent().hide();
	}
	
	if ($("#subor_central").val()==''){
		$("#subor_central").parent().parent().parent().hide();
	}
	
	if ($("#subor_medios").val()==''){
		$("#subor_medios").parent().parent().parent().hide();
	}
	
	if ($("#subor_mailing").val()==''){
		$("#subor_mailing").parent().parent().parent().hide();
	}
	
	$("#first_name_detailblock").css("Font-Weight","Bold");	
}

function muestraLocal(){

	var valor=$("#dispone_local_detailblock").val();
	if(valor!="" && valor!=0){
		$("#tab2").show();
	}else{
		$("#tab2").hide();
	}
}

function actualizarHistDetalle() {
	ocultarHistoricos();

	if ($("#historial_empresa_detailblock").text().indexOf("Es Franquiciado") != -1 ||
		$("#historial_empresa_detailblock").text().indexOf("Es MultiFranquiciado") != -1 ||
		$("#historial_empresa_detailblock").text().indexOf("Fue Franquiciado") != -1) {
		mostrarHistoricosFraquicia();
	}

	if ($("#historial_empresa_detailblock").text().indexOf("Es Autonomo") != -1 ||
		$("#historial_empresa_detailblock").text().indexOf("Trabaja en negocio familiar") != -1 ||
		$("#historial_empresa_detailblock").text().indexOf("Es Empresario") != -1) {
		mostrarEsEmpresa();
	}

	if ($("#historial_empresa_detailblock").text().indexOf("Fue Autonomo") != -1 ||
		$("#historial_empresa_detailblock").text().indexOf("Fue Empresario") != -1) {
		mostrarSector();
	}

}

function ocultarHistoricos() {
	$("#franquicia_historicos_detailblock").parent().parent().hide();
	$("#sectores_historicos_detailblock").parent().parent().hide();
	$("#empresa_temp_detailblock").parent().parent().hide();
	$("#inicio_franq_hst_detailblock").parent().parent().hide();
	$("#fin_franq_hst_detailblock").parent().parent().hide();
	$("#franquicia_satisfa_detailblock").parent().parent().hide();
	$("#chk_empresa_provee_detailblock").parent().parent().hide();
	$("#chk_empresa_cli_potencial_detailblock").parent().parent().hide();
	$("#chk_empresa_competencia_detailblock").parent().parent().hide();
	$("#chk_empresa_alianza_detailblock").parent().parent().hide();
}

function mostrarHistoricosFraquicia() {
	$("#franquicia_historicos_detailblock").parent().parent().show();
	$("#sectores_historicos_detailblock").parent().parent().show();
	$("#inicio_franq_hst_detailblock").parent().parent().show();
	$("#fin_franq_hst_detailblock").parent().parent().show();
	$("#franquicia_satisfa_detailblock").parent().parent().show();
}

function mostrarEsEmpresa() {
	$("#empresa_temp_detailblock").parent().parent().show();
	$("#sectores_historicos_detailblock").parent().parent().show();
	$("#chk_empresa_provee_detailblock").parent().parent().show();
	$("#chk_empresa_cli_potencial_detailblock").parent().parent().show();
	$("#chk_empresa_competencia_detailblock").parent().parent().show();
	$("#chk_empresa_alianza_detailblock").parent().parent().show();
}

function mostrarSector() {
	$("#sectores_historicos_detailblock").parent().parent().show();
}

function mostrarHistoricosEmpresa() {
	$("#sectores_historicos_detailblock").parent().parent().show();
}