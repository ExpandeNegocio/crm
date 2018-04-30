function generarMailing(pidMailing,ptemplate,pporFranquicia) {
	
 	//alert ("ID-"+pidMailing+" - Template-"+ptemplate+" - porFranquicia-"+pporFranquicia);
	
	if (confirm("¿Esta seguro de que desea lanzar el mailing?")) {
		
		//var url='http://expandenegocio.com:8111/sugarcrm/index.php?entryPoint=lanzarMailing&idMailing='+pidMailing +'&template='+ptemplate+'&porFranquicia='+pporFranquicia;
		 var url='index.php?entryPoint=lanzarMailing&idMailing='+pidMailing +'&template='+ptemplate+'&porFranquicia='+pporFranquicia;
		
		var config = { };
	    config.title = "Enviando Correo";
	    config.msg = "Espere por favor... ";
	    YAHOO.SUGAR.MessageBox.show(config);
		
		$.ajax({
			type : "GET",
			dataType: "text",
			crossDomain: true,
			url : (url),
			data : {idMailing: pidMailing,
					template: ptemplate,
					porFranquicia: pporFranquicia,
			},
			success : function(output) {
				YAHOO.SUGAR.MessageBox.hide();
				if (output.substr(output.length-2)=="Ok"){
					alert('El mailing se ha lanzado correctamente');
				}else{
					alert('Ha habido un error en el envío de los correos');
				}
				  window.location='index.php?module=Expma_Mailing&action=DetailView&record=' + pidMailing;
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
			//	alert('El mailing se ha lanzado correctamente');
				alert('No se ha podido reinicializar el mailing - ' + textStatus + ' - ' + errorThrown);
				window.location='index.php?module=Expma_Mailing&action=DetailView&record=' + pidMailing;
			}
		});

	} else {
		return false;
	}
}

function reinicializarMailing (pidMailing){
	
	if (confirm("¿Esta seguro de que desea reiniciar el mailing?")) {
		
		var url='index.php?entryPoint=reiniciarMailing'; //&idMailing='+pidMailing +'&template='+ptemplate+'&porFranquicia='+pporFranquicia;
		
		var config = { };
	    config.title = "Reinicializando Mailing";
	    config.msg = "Espere por favor... ";
	    YAHOO.SUGAR.MessageBox.show(config);
		
		$.ajax({
			type : "GET",
			url : (url),
			data : {idMailing: pidMailing,					
			},
			success : function(output) {
				YAHOO.SUGAR.MessageBox.hide();
				if (output.substr(output.length-2)=="Ok"){
					alert('El mailing se ha reiniciado correctamente');
				}else{
					alert('Ha habido un error al reiniciado el mailing');
				}
				  window.location='index.php?module=Expma_Mailing&action=DetailView&record=' + pidMailing;
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido reinicializar el mailing - ' + textStatus + ' - ' + errorThrown);
				window.location='index.php?module=Expma_Mailing&action=DetailView&record=' + pidMailing;
			}
		});

	} else {
		return false;
	}
	
}
