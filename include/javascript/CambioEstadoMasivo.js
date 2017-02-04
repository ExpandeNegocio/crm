/**
 * @author Penlopjo
 */

    var modal;
 
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
                    
    function openModal(idPanel){
        var text="myModal"+idPanel;            
        modal = document.getElementById(text);
        modal.style.display = "block";                       
    }

	function recogeValCombo(idPanel){
	
		var posicion=document.getElementById('selector'+idPanel).options.selectedIndex;
		//alert(posicion);
		subestado=document.getElementById('selector'+idPanel).options[posicion].value;
		//alert(subestado);
		cambiarEstadoGestion(idPanel,subestado);
		
	}

	function cambiarEstadoGestion(estado,subestado) {
	    if (confirm("¿Esta seguro de que desea pasar al estado " + estado + " las gestiones seleccionadas?")) {
	       
	        //Recogemos la lista de gestiones a cambiar
	
	        var idGestiones="";
	
	        var lista=document.getElementsByClassName("checkbox");
	
	        for (i=0;i<lista.length;i++){
	
	            if (lista[i].checked==true && lista[i].name.indexOf("checkbox_display_prueba") > -1 ){                
	                idGestiones=idGestiones+"!"+lista[i].name.replace("checkbox_display_prueba-","");
	            }	
	        }
	
	        url = "index.php?entryPoint=cambioEstadoGestion&estado="+ estado + "&subestado=" + subestado + "&gestiones=" + idGestiones;
	        $.ajax({
	            type : "POST",
	            url : url,
	            data : "estado=" + estado + "&subestado=" + subestado + "&gestiones=" + idGestiones,
	            success : function(data) {
	                YAHOO.SUGAR.MessageBox.hide();
	                if ( data = "Ok") {
	                    document.location.reload();                 
	                } else {
	                    alert("No se han podido cambiar los estados " + estado);
	                }
	
	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	                alert("No se ha podido enviar la documentación - " + textStatus + " - " + errorThrown);
	
	            }
	        });
	
	    } else {
	        return false;
	    }                
	}
	

