function cargaEditor(idUsuario) {
		
	if (idUsuario!=1){
				
		$('#consulta').hide();
		$('#consulta_label').hide();
		$('#SAVE_HEADER').hide();
		$('#SAVE_FOOTER').hide();
		$('#btn_view_change_log').hide();
		$('#save_and_continue').hide();
		$('#create_image').hide();
		$('#create_link').hide();
		$('#name').prop('disabled', true);
		$('#description').prop('disabled', true);
				
	}
}

function generarInformes(idConsulta) {
	
	fIni=$('#fecha_inicio').val();
	fFin=$('#fecha_fin').val();
	nombre=$('#name').val().replace(" ","_");
	

	if (confirm("¿Esta seguro de que desea lanzar el informe?")) {
		
		var config = { };
    	config.title = "Generando Informe";
    	config.msg = "Espere por favor... ";
    	YAHOO.SUGAR.MessageBox.show(config);
		
		
		var f = new Date();
     	var fecha= f.getFullYear().toString() + ('0' + (f.getMonth()+1)).slice(-2).toString() +('0' + f.getDate()).slice(-2).toString(); 

		var idFich = nombre+fecha+"-"+generateUUID().slice(0,8);				
						
		str_json = JSON.stringify({
			"idConsulta" : idConsulta,
			"idFich" : idFich
		});
		$.ajax({
			
			type : "POST",
			url : 'index.php?entryPoint=lanzarInforme&idConsulta=' + idConsulta +'&fIni='+fIni+'&fFin='+fFin+ '&idFich=' + idFich,
			//data : str_json,
			data : "idConsulta="+idConsulta	+	"idFich=" + idFich,
			//datatype : "json",
			success : function(output) {
				YAHOO.SUGAR.MessageBox.hide();
				document.location.href = 'tmp/'+idFich+'.xlsx';
				
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido lanzar el informe - ' + textStatus + ' - ' + errorThrown);
			}
		});

	} else {
		return false;
	}
}

function generateUUID() {
	var d = new Date().getTime();
	var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
		var r = (d + Math.random() * 16) % 16 | 0;
		d = Math.floor(d / 16);
		return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
	});
	return uuid;
};