
$("#btn_view_change_log").hide();
$("#save").hide();
$("#delete_button").hide();
$( document ).ready(function() {
	ocultarOrigenes();
});


const USUARIO_VW_RUBEN='71f40543-2702-4095-9d30-536f529bd8b6';

getUsuario();
getFranquicia();


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
				$("#tab3").hide();
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


