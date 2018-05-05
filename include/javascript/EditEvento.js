/**
 * @author Penlopjo
 */
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
        
        var idEvento = $("input[name$=\"record\"]" ).val();
        
        url = "index.php?entryPoint=consultarFranquicia";                                           
        $.ajax({
            type : "POST",
            url : url,
            data : "tipo=FranqEstadoEvento" + "&estado=" + estado + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
            success : function(data) {
                YAHOO.SUGAR.MessageBox.hide();
                if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se han podido cambiar el estado y/o las gestiones asociadas  " + estado);
                }            
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el estado y/o las gestiones asociadas - " + textStatus + " - " + errorThrown);            
            }
        });

    }else {
        return false;
    }                            
} 

function cambiarFormatoFranquiciaEvento(formato) {
     if (confirm("¿Esta seguro de que quieres cambiar el formato a las franquicias seleccionadas?")) {
       
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
        
        var idEvento = $("input[name$=\"record\"]" ).val();
        
        url = "index.php?entryPoint=consultarFranquicia";                                           
        $.ajax({
            type : "POST",
            url : url,
            data : "tipo=FranEventoFormato&formato=" + formato + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
            success : function(data) {
                YAHOO.SUGAR.MessageBox.hide();
                if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se han podido cambiar el formato y/o las gestiones asociadas  " + formato);
                }            
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el formato y/o las gestiones asociadas - " + textStatus + " - " + errorThrown);            
            }
        });

    }else {
        return false;
    }                            
}