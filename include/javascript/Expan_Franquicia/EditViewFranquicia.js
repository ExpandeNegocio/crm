$("#tipo_cuenta").change(function(){
		var valor=$(this).val();		
		
		if (valor==1 || valor==2){
			renderTab(true);
		}else{
			renderTab(false);
		}					
});

$('#busca_sector').keypress(function(e) {  
	var str= $('#busca_sector').val();
	limpiarSector();
	if (str.length>2){
		buscarSector(str);
	}	
	
      if (e.keyCode == '13') {
         e.preventDefault();
        
       }
 });                

$('#tags_empresa').keypress(function(e) {
              if (e.keyCode == '13') {
                 e.preventDefault();
                 //your code here
               }
            });
            
	$('#busca_motivosTagCheck').keypress(function(e) {
              if (e.keyCode == '13') {
                 e.preventDefault();
                 //your code here
               }
            });
                        
	$('#busca_habilidadTagCheck').keypress(function(e) {
              if (e.keyCode == '13') {
                 e.preventDefault();
                 //your code here
               }
            }); 

$("#tags_empresa").keyup(function(){//cuando pulses la caja de texto
		var campoF=$(this).val();	//valor del texto
		var arrayTag=campoF.split(","); //todas las franquicias separadas por comas en un array
		var tagHastaUlComa="";
		for(var i=0;i<arrayTag.length-1;i++){//construir las franquicias anteriores
			tagHastaUlComa=tagHastaUlComa+arrayTag[i]+",";
		}
		var longi=arrayTag.length;//cuantas hay
		
		var tag=arrayTag[longi-1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
		var tagSE=tag.trim(); //eliminar espacios en blanco
		
		
		if(tagSE.length>1){//solo se hace la llamada si se han escrito 3 caracteres
			
			var dataTag="tags="+tagSE+"&tipoTag=expan_tag_perfil";
		
			//llamada ajax
			$.ajax({
				type:"POST",
				url:"index.php?entryPoint=RecogeTags",
				data: dataTag,
				success: function(data){
					$('#sugerencias_tag_emp').fadeIn(500).html(data);
					$('.sug').live('click', function(){//cuando se pulsa una
						var tag=$(this).text();
						if(longi==1){//borrar todo y sustituir por el nuevo valor
							$('#tags_empresa').val(tag);//editar input
						}else{//poner las anteriores, y después la nueva
							$('#tags_empresa').val(tagHastaUlComa+tag);
						}
						
						$('#sugerencias_tag_emp').fadeOut(500);//quitar las sugerencias
					});
					
					$('#detailpanel_4').live('click', function(){//que se cierre el cuadro de sugerencias en caso de pulsar fuera
						$('#sugerencias_tag_emp').fadeOut(500);
					});
				}
			});
		}
	});

$("#busca_habilidadTagCheck").keyup(function(){//cuando pulses la caja de texto
		
		$(".habilidadTagCheck").parent().css( "background-color", "");
		
		var text= $(this).val();
		
		if (text.trim()==""){
			return;
		}		
		
		$(".habilidadTagCheck").each(function(){
			
			var id= $(this).attr('id').toLowerCase();
			
			var words = text.split(' '); 
			
			for (i=0;i<words.length;i++){
				var word=words[i];
				if (word.length>2){
					if (id.indexOf(word.toLowerCase())!=-1){
						$(this).parent().css( "background-color", "lightgreen");				
					}
				}
			}											
		}			
		);
			
	});
	
$("#busca_motivosTagCheck").keyup(function(){//cuando pulses la caja de texto
		
		$(".motivosTagCheck").parent().css( "background-color", "");
		
		var text= $(this).val();
		
		if (text.trim()==""){
			return;
		}		
		
		$(".motivosTagCheck").each(function(){
			
			var id= $(this).attr('id').toLowerCase();
			
			var words = text.split(' '); 
			
			for (i=0;i<words.length;i++){
				var word=words[i];
				if (word.length>2){
					if (id.indexOf(word.toLowerCase())!=-1){
						$(this).parent().css( "background-color", "lightgreen");				
					}
				}
			}											
		}			
		);
			
	});	

function inicio() {	
	document.getElementById("config_correo").disabled = true;
	cargarchecks("Sectorcheck", "sector");
	ocultarInicio();
	makeTabby();
	clean();

	var valor=$("#tipo_cuenta").val();	
	
	if (valor==1 || valor==2){
		renderTab(true);
	}else{
		renderTab(false);
	}		

}

function clean(){
	$("#proveedor_insert_label").hide();
	$("#proveedor_list_label").hide();
	$("#competidor_insert_label").hide();
	$("#competidor_list_label").hide();
	$("#mistery_insert_label").hide();
	$("#mistery_list_label").hide();
}

function makeTabby(){
		 
    $("textarea").each(function(){
    	   enableTab($(this).attr('id'));
    });

}

function enableTab(id) {
    var el = document.getElementById(id);
    el.onkeydown = function(e) {
        if (e.keyCode === 9) { // tab was pressed

            // get caret position/selection
            var val = this.value,
                start = this.selectionStart,
                end = this.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.value = val.substring(0, start) + '\t' + val.substring(end);

            // put caret at right position again
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            return false;

        }
    };
}


var tmrReady = setInterval(isPageFullyLoaded, 100);
 
function isPageFullyLoaded() {
     if (document.readyState == "loaded" || document.readyState == "complete") {
         subclassForms();
         clearInterval(tmrReady);
     }
 }
  
function submitDisabled(_form, currSubmit) {
     return function () {
         var mustSubmit = true;
         if (currSubmit != null)
             mustSubmit = currSubmit();
  
         var els = _form.elements;
         for (var i = 0; i < els.length; i++) {
             if (els[i].type == "submit")
                 if (mustSubmit)
                     els[i].disabled = true;
         }
         return mustSubmit;
     }
}
  
function subclassForms() {
    for (var f = 0; f < document.forms.length; f++) {
        var frm = document.forms[f];
        frm.onsubmit = submitDisabled(frm, frm.onsubmit);
    }
}

function despliegoPliegoSector(nombreSector){
	
	nombreSector=nombreSector.split(' ').join('_');
	
	CamposImput = document.getElementsByName(nombreSector);

	for (var i = 0; i < CamposImput.length; i++) {			
		if (CamposImput[i].parentNode.style.display==''){
			CamposImput[i].parentNode.style.display='none';
		}else{
			CamposImput[i].parentNode.style.display=null;
		}
	}
}

function pliegoSector(nombreSector){
	
	nombreSector=nombreSector.split(' ').join('_');
	
	CamposImput = document.getElementsByName(nombreSector);

	for (var i = 0; i < CamposImput.length; i++) {					
		CamposImput[i].parentNode.style.display='none';
	}
}

function cambiocheck(clase, id,act) {

	var checkboxes = document.getElementsByClassName(clase);
	var listaFran = document.getElementById(id);
	var listaSel = [];

	//Actualizamos las listas para que esten en conformidad con los checkboxes

	for (var j = 0; j < listaFran.length; j++) {
		listaFran[j].selected = false;
	}

	var numCheck = 0;
	for (var i = 0; i < checkboxes.length; i++) {

		if (checkboxes[i].checked) {
			
			listaSel[listaSel.length] = checkboxes[i].id;

			//Actualziamos la franquicia principal si no hay ninguna seleccionada ya
			if ($("#franquicia_principal :selected").text() == "" && clase == 'francheck') {
				$("#franquicia_principal option[label='" + checkboxes[i].id + "']").attr("selected", true);
			}			
			numCheck++;
		}

	}
	
	for (var k = 0; k < listaSel.length; k++) {
		for (var j = 0; j < listaFran.length; j++) {
			if (trim(listaSel[k]) == trim(listaFran[j].text)) {
				listaFran[j].selected = true;
			}
		}
	}
	
}

function cargarchecks(clase, id) {

	var checkboxes = document.getElementsByClassName(clase);
	var listaFran = document.getElementById(id);
	var listaSel = [];
	
	if (listaFran!=null){
		//Cargamos los cheks seleccionados
		for (var j = 0; j < listaFran.length; j++) {
			if (listaFran[j].selected) {
				var check = document.getElementById(listaFran[j].label);
				if (check != null) {
					check.checked = true;
					if (clase=='Sectorcheck'){
						despliegoSector(check.getAttribute("name"));
					}
				}
			}
		}			
	}
}

function activoDesSector(nombreSector){
	
	nombreSector=nombreSector.split(' ').join('_');
	
	CamposImput = document.getElementsByName(nombreSector);

	for (var i = 0; i < CamposImput.length; i++) {			
		CamposImput[i].checked = !CamposImput[i].checked ;
	}
	
	pintaFranFromSector();
}

function despliegoSector(nombreSector){	
	
	if (typeof nombreSector !== 'undefined'){	
		document.getElementById(nombreSector.split('_').join(' ')).checked=true;
		
		nombreSector=nombreSector.split(' ').join('_');
		
		
		CamposImput = document.getElementsByName(nombreSector);
	
		for (var i = 0; i < CamposImput.length; i++) {					
			CamposImput[i].parentNode.style.display=null;		
		}
	}
}

function ocultarInicio(){
	$("#sector_label").parent().hide();
	$("#habilidades").parent().parent().hide();
	$("#motivos_interes").parent().parent().hide();
	renderTab(false);	
	
}

function renderTab(estado){
	if (estado==true){
		$("#tab1").show();
		$("#tab2").show();
		$("#tab3").show();
		$("#tab4").show();
		$("#tab5").show();
		$("#tab6").show();
		$("#tab7").show();
		$("#tab8").show();
		$("#tab9").show();
		$("#tab10").show();
	}else{
		$("#tab1").hide();
		$("#tab2").hide();
		$("#tab3").hide();
		$("#tab4").hide();
		$("#tab5").hide();
		$("#tab6").hide();
		$("#tab7").hide();
		$("#tab8").hide();
		$("#tab9").hide();
		$("#tab10").hide();
	}	
}

function limpiarSector(){
	
	$(".Sectorcheck").each(function(){
		$(this).parent().css( "background-color", "");
    });
	
}

function buscarSector(nombreSector){
	
	$(".Sectorcheck").each(function(){
		str= $(this).attr('id');
		console.log(str);
		if (str.toUpperCase().lastIndexOf(nombreSector.toUpperCase())!=-1){
			$(this).parent().css( "background-color", "orange");
			//despliegoSector($(this).attr('name'));
			despliegoSector($(this).attr('name'));
		}else{
			pliegoSector($(this).attr('name'));
		}				
    });
	
}

function addProveedorEmpresa(idFranquicia){
		
	var idProveedor = $("#proveedor").val();		
	var tipo_proveedor=$("#tipo_proveedor").val();
	var ambito_act = $("#ambito_act").val();
	if ($("#chk_cotizado").attr( "checked" )){
		chk_cotizado=1;
	}else{
		chk_cotizado=0;
	}
	
	if ($("#chk_validado").attr( "checked" )){
		chk_validado=1;
	}else{
		chk_validado=0;
	}
	
	if ($("#chk_requiere_dosier").attr( "checked" )){
		chk_requiere_dosier=1;
	}else{
		chk_requiere_dosier=0;
	}

	var dosier_enviado=$("#dosier_enviado").val();
	var rappel_central=$("#rappel_central").val();
	var rappel_fdo=$("#rappel_fdo").val();
	var otras_condiciones=$("#otras_condiciones").val();
	var duracion_acuerdo=$("#duracion_acuerdo").val();
	var f_renovacion_acuerdo=$("#f_renovacion_acuerdo").val();
	var observaciones_proveedor_franq=$("#observaciones_proveedor_franq").val();
	var ofertas=$("#ofertas").val();
	var pedido_minimo=$("#pedido_minimo").val();
	var formas_pago=$("#formas_pago").val();
	var condiciones_portes=$("#condiciones_portes").val();
	var plazo_entrega=$("#plazo_entrega").val();
	var garantia_producto=$("#garantia_producto").val();
	var politica_devoluciones=$("#politica_devoluciones").val();	
	
	var nombre_contacto=$("#nombre_contacto").val();
	var cargo_contacto=$("#cargo_contacto").val();	
	var telefono_contacto=$("#telefono_contacto").val();
	var email_contacto=$("#email_contacto").val();
	
	if (idFranquicia==""){
		alert ("Es necesario seleccionar la franquicia");
		return null;
	}
	
	if (confirm("¿Quiere crear condiciones del proveedor para la franquicia?")) {

		url = 'index.php?entryPoint=consultarEmpresa';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=AltaProveedor&" +  
					"idEmpresa=" + idProveedor + "&" +
					"idFranquicia=" + idFranquicia + "&" +
					"tipo_proveedor=" + tipo_proveedor + "&" +
					"chk_cotizado=" + chk_cotizado + "&" +
					"chk_validado=" + chk_validado + "&" +
					"chk_requiere_dosier=" + chk_requiere_dosier + "&" +
					"dosier_enviado=" + dosier_enviado + "&" +
					"rappel_central=" + rappel_central + "&" +
					"rappel_fdo=" + rappel_fdo + "&" +
					"otras_condiciones=" + otras_condiciones + "&" +
					"duracion_acuerdo=" + duracion_acuerdo + "&" +
					"f_renovacion_acuerdo=" + f_renovacion_acuerdo + "&" +
					"observaciones_proveedor_franq=" + observaciones_proveedor_franq + "&" +
					"ofertas=" + ofertas + "&" +
					"pedido_minimo=" + pedido_minimo + "&" +
					"formas_pago=" + formas_pago + "&" +
					"condiciones_portes=" + condiciones_portes + "&" +
					"plazo_entrega=" + plazo_entrega + "&" +
					"garantia_producto=" + garantia_producto + "&" +
					"politica_devoluciones=" + politica_devoluciones + "&" +
					"nombre_contacto=" + nombre_contacto + "&" +
					"cargo_contacto=" + cargo_contacto + "&" +
					"telefono_contacto=" + telefono_contacto + "&" +
					"email_contacto=" + email_contacto + "&" +
					"ambito_act=" + ambito_act,
			
			success : function(data) {
				
				if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se ha podido guardar las condiciones");
                }

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido guardar las condiciones - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}
		
}

function deleteProveedor(id){
	
	if (confirm("¿Quiere borrar las condiciones del proveedor para la franquicia?")) {

		url = 'index.php?entryPoint=consultarEmpresa';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaEmpresaProveedor&" +  
					"id=" + id,
			
			success : function(data) {
				if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se ha podido guardar las condiciones");
                }
				
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}
	
}

function editProveedor(id){
		
	url = 'index.php?entryPoint=consultarEmpresa';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultaProveedor&" +  
				"id=" + id,
		
		success : function(data) {
			
			var json = JSON.parse(data);
			
			if (json[0].chk_cotizado==1){
				$("#chk_cotizado").prop('checked', true);
			}else{
				$("#chk_cotizado").prop('checked', false);
			}
			
			if (json[0].chk_validado==1){
				$("#chk_validado").prop('checked', true);
			}else{
				$("#chk_validado").prop('checked', false);
			}
			
			if (json[0].chk_requiere_dosier==1){
				$("#chk_requiere_dosier").prop('checked', true);
			}else{
				$("#chk_requiere_dosier").prop('checked', false);
			}
			
			$("#proveedor").val(json[0].proveedor_id);
			$("#tipo_proveedor").val(json[0].tipo_proveedor);
			$("#ambito_act").val(json[0].ambito_act);
			
			$("#dosier_enviado").val(json[0].dosier_enviado);
			$("#rappel_central").val(json[0].rappel_central);
			$("#rappel_fdo").text(json[0].rappel_fdo);
			$("#otras_condiciones").val(json[0].otras_condiciones);
			$("#duracion_acuerdo").val(json[0].duracion_acuerdo);
			$("#f_renovacion_acuerdo").val(json[0].f_renovacion_acuerdo);
			$("#observaciones_proveedor_franq").val(json[0].observaciones_proveedor_franq);
			$("#ofertas").val(json[0].ofertas);
			$("#pedido_minimo").val(json[0].pedido_minimo);
			$("#formas_pago").val(json[0].formas_pago);
			$("#condiciones_portes").val(json[0].condiciones_portes);
			$("#plazo_entrega").val(json[0].plazo_entrega);
			$("#garantia_producto").val(json[0].garantia_producto);
			$("#politica_devoluciones").val(json[0].politica_devoluciones);		
			$("#nombre_contacto").val(json[0].nombre_contacto);
			$("#cargo_contacto").val(json[0].cargo_contacto);
			$("#telefono_contacto").val(json[0].telefono_contacto);
			$("#email_contacto").val(json[0].email_contacto);		
		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

		}
	});
	
}

function addMisteryFranq(idFranquicia){
			
	var nom_entrevistado=$("#nom_entrevistado").val();
	var ubicacion=$("#ubicacion").val();
	var f_entrevista=$("#f_entrevista").val();
	var nom_mistery=$("#nom_mistery").val();
	var telefono_mistery=$("#telefono_mistery").val();
	var email_mistery=$("#email_mistery").val();
	var num_empleados=$("#num_empleados").val();
	var com_positivos=$("#com_positivos").val();
	var com_negativos=$("#com_negativos").val();

	if (confirm("¿Quiere crear condiciones del proveedor para la franquicia?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data :  "tipo=addMisteryFranq&" + 
					"nom_entrevistado=" + nom_entrevistado + "&" +
					"ubicacion=" + ubicacion + "&" +
					"f_entrevista=" + f_entrevista + "&" +
					"nom_mistery=" + nom_mistery + "&" +
					"telefono_mistery=" + telefono_mistery + "&" +
					"email_mistery=" + email_mistery + "&" +
					"num_empleados=" + num_empleados + "&" +
					"com_positivos=" + com_positivos + "&" +
					"com_negativos=" + com_negativos,
			
			success : function(data) {
				
				if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se ha podido guardar el mistery");
                }

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido guardar el mistery - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}	
}

function deleteMistery(id){
	
	if (confirm("¿Quiere eliminar el mistery seleccionado?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaMisteryFranq&" +  
					"id=" + id,
			
			success : function(data) {
				if ( data = "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se ha podido eliminar el mistery");
                }
				
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}
	
}

function editMistery(id){
		
	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultaMistery&" +  
				"id=" + id,
		
		success : function(data) {
			
			var json = JSON.parse(data);					
			
			$("#nom_entrevistado").val(json[0].nom_entrevistado);
			$("#ubicacion").val(json[0].ubicacion);
			$("#f_entrevista").val(json[0].f_entrevista);			
			$("#nom_mistery").val(json[0].nom_mistery);
			$("#telefono_mistery").val(json[0].telefono_mistery);
			$("#email_mistery").val(json[0].email_mistery);
			$("#num_empleados").val(json[0].num_empleados);
			$("#com_positivos").val(json[0].com_positivos);
			$("#com_negativos").val(json[0].com_negativos);
			
		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

		}
	});
	
}