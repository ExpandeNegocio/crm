/**
 * @author Penlopjo
 */

estadisticasReadOnly()

function estadisticasReadOnly(){
	$("#total_empresas_parti").prop("disabled",true);
	$("#total_empresas_con_stand").prop("disabled",true);
	$("#total_empresas_compartido").prop("disabled",true);
	$("#total_empresas_corner").prop("disabled",true);
	$("#total_empresas_mesa_inde").prop("disabled",true);
	$("#total_empresas_mesa_compa").prop("disabled",true);
	$("#total_gestiones").prop("disabled",true);
	$("#total_gest_EN").prop("disabled",true);
	$("#total_gest_fran_part").prop("disabled",true);
	$("#total_gest_Cliente").prop("disabled",true);
	$("#total_gest_fran_nopart").prop("disabled",true);
	$("#total_gest_tablet").prop("disabled",true);
	$("#total_solicitudes").prop("disabled",true);
	$("#total_rating_orig_a_plus").prop("disabled",true);
	$("#total_rating_real_a_plus").prop("disabled",true);
	$("#total_rating_orig_a").prop("disabled",true);
	$("#total_rating_real_a").prop("disabled",true);
	$("#total_rating_orig_b").prop("disabled",true);
	$("#total_rating_real_b").prop("disabled",true);
	$("#total_rating_orig_c").prop("disabled",true);
	$("#total_rating_real_c").prop("disabled",true);
	$("#total_rating_orig_topo").prop("disabled",true);
	$("#total_rating_real_topo").prop("disabled",true);
	$("#total_rating_orig_norating").prop("disabled",true);
	$("#total_rating_real_norating").prop("disabled",true);
	$("#sol_unicas").prop("disabled",true);
	$("#empresas_ratio_sg").prop("disabled",true);
	$("#ratio_medio_formato").prop("disabled",true);

	$("#citas_solicitadas").prop("disabled",true);
	$("#citas_realizadas_con_cita").prop("disabled",true);
	$("#citas_realizadas_sin_cita").prop("disabled",true);
	$("#citas_canceladas").prop("disabled",true);
	$("#citas_no_acuden").prop("disabled",true);
}

function ocultaAdministracion(){
	
	url = "index.php?entryPoint=consultarFranquicia";                                           
	$.ajax({
	    type : "POST",
	    url : url,
	    data : "tipo=user",
	    success : function(data) {
	        YAHOO.SUGAR.MessageBox.hide();
	        if ( data != '875daf39-76a9-4eb7-2fbc-53c7fa8dec18' && data !='71f40543-2702-4095-9d30-536f529bd8b6') {
				$("#tab2").hide();  			
	        }            
	    },
	    error : function(jqXHR, textStatus, errorThrown) {
	        alert("No se han podido cambiar el estado a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
	    }
	});
	
}

function envioCorreosEvento(id) {

	if (confirm("¿Esta seguro de que desea enviar la invitacion al evento a todos los usuarios relacionados?")) {
		
	var config = { };
    config.title = "Enviando Correos";
    config.msg = "Espere por favor... ";
    YAHOO.SUGAR.MessageBox.show(config);
		
	url='index.php?entryPoint=envioCorreosEvento&id=' + id;
		$.ajax({
			type : "POST",
			url : url,
			data : "id=" + id,
			success : function(data) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('Se ha reenviado los documentos');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido enviar los correos del evento - ' + textStatus + ' - ' + errorThrown);
			}
		});

	} else {
		return false;
	}
}

function cambiarEstadoFranquiciaEvento(estado) {
     if (confirm("¿Esta seguro de que quieres cambiar el estado las franquicias seleccionadas?")) {
       
        var idFranquicias = getListaFranquicias();                               
        var idEvento = $("input[name$=\"record\"]" ).val();
        
        url = "index.php?entryPoint=consultarFranquicia";                                           
        $.ajax({
            type : "POST",
            url : url,
            data : "tipo=FranqEstadoEvento" + "&estado=" + estado + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
            success : function(data) {
                YAHOO.SUGAR.MessageBox.hide();
                if ( data == "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se han podido cambiar el estado a las franquicias seleccionadas  " + estado);
                }            
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el estado a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
            }
        });

    }else {
        return false;
    }                            
} 

function cambiarFormatoFranquiciaEvento(formato) {
     if (confirm("¿Esta seguro de que quieres cambiar el formato a las franquicias seleccionadas?")) {
       
        var idFranquicias = getListaFranquicias();                           
        var idEvento = $("input[name$=\"record\"]" ).val();
        
        url = "index.php?entryPoint=consultarFranquicia";                                           
        $.ajax({
            type : "POST",
            url : url,
            data : "tipo=FranEventoFormato&formato=" + formato + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
            success : function(data) {
                YAHOO.SUGAR.MessageBox.hide();
                if ( data == "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se han podido cambiar el formato a las franquicias seleccionadas  " + formato);
                }            
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el formato a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
            }
        });

    }else {
        return false;
    }                            
}

function cambiarGastosAsociadosFranquiciaEvento(){
	
	var txt;
    var valor = prompt("Indica el gasto asociado de las Franquicias Seleccionadas:", "0");
    if (!(valor == null || valor == "")) {      
		if(validarSiNumero(valor)){
						
			var idFranquicias = getListaFranquicias();	
			var idEvento = $("input[name$=\"record\"]" ).val();
        
	        url = "index.php?entryPoint=consultarFranquicia";                                           
	        $.ajax({
	            type : "POST",
	            url : url,
	            data : "tipo=GastoAsociado&valor=" + valor + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
	            success : function(data) {
	                YAHOO.SUGAR.MessageBox.hide();
	                if ( data == "Ok") {
	                    document.location.reload();                 
	                } else {
	                    alert("No se han podido cambiar el gasto asociado a las franquicias seleccionadas");
	                }            
	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	                alert("No se han podido cambiar el gasto asociado a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
	            }
	        });
			
		}else{
			alert ("No es un numero");

		}
    }
	
}

function cambiarCosteAccionFranquiciaEvento(){
	
	var txt;
    var valor = prompt("Indica el gasto asociado de las Franquicias Seleccionadas:", "0");
    if (!(valor == null || valor == "")) {      
		if(validarSiNumero(valor)){
						
			var idFranquicias = getListaFranquicias();	
			var idEvento = $("input[name$=\"record\"]" ).val();
        
	        url = "index.php?entryPoint=consultarFranquicia";                                           
	        $.ajax({
	            type : "POST",
	            url : url,
	            data : "tipo=CosteAccion&valor=" + valor + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
	            success : function(data) {
	                YAHOO.SUGAR.MessageBox.hide();
	                if ( data == "Ok") {
	                    document.location.reload();                 
	                } else {
	                    alert("No se han podido cambiar el gasto asociado a las franquicias seleccionadas");
	                }            
	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	                alert("No se han podido cambiar el gasto asociado a las franquicias seleccionadas - " + textStatus + " - " + errorThrown);            
	            }
	        });
			
		}else{
			alert ("No es un numero");
		}
    }
	
}

function validarSiNumero(numero){
    if (!/^([0-9])*$/.test(numero)){
    	return false;
    }else{
    	return true;
    }        
}

function getListaFranquicias(){
	
	//Recogemos la lista de gestiones a cambiar
                                                                      
    var lista=document.getElementsByClassName("checkbox");

    var idFranquicias="";
    var prim=true;
    
    for (i=0;i<lista.length;i++){    
        if (lista[i].checked==true){
            if (prim==true){
                idFranquicias=lista[i].name.replace("checkbox_display_prueba-","");    
            }else{
                idFranquicias=idFranquicias+"!"+lista[i].name.replace("checkbox_display_prueba-","");
            }   
            prim=false;                                                                     
        }                        
    }
    
    return idFranquicias;
	
}