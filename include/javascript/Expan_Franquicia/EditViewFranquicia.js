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
	$("#mistery_list_fdo_label").hide();
	$("#mistery_list_central_label").hide();
	$("#mistery_insert_fdo_label").hide();
	$("#mistery_insert_central_label").hide();
	$("#mistery_list_preguntas_label").hide();
	$("#mistery_insert_preguntas_label").hide();
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
		for (var l = 0; l < listaFran.length; l++) {
			if (trim(listaSel[k]) == trim(listaFran[l].text)) {
				listaFran[l].selected = true;
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
		$("#tab11").show();
		$("#tab12").show();
		$("#tab13").show();
		$("#tab14").show();
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
		$("#tab11").hide();
		$("#tab12").hide();
		$("#tab13").hide();
		$("#tab14").hide();
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
				
				if ( data == "Ok") {
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
				if ( data == "Ok") {
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

function addMisteryFranqCentral(idFranquicia){
			
	var nom_central=$("#nom_central").val();
	var ubicacion=$("#ubicacion").val();
	var f_entrevista=$("#f_entrevista_central").val();
	var correo_central=$("#correo_central").val();
	var cargo_central=$("#cargo_central").val();
	var telefono_central=$("#telefono_central").val();
	var nom_utilizado=$("#nom_utilizado").val();
	var correo_utilizado=$("#correo_utilizado").val();
	var telefono_utilizado=$("#telefono_utilizado").val();
	var catalogos=$("#catalogos").val();
	var usuario=$("#usuario").val();
	var informacion_obtenida=$("#informacion_obtenida").val();

	var preguntas=createPreguntasPost("chk_fdo");

	if (confirm("¿Quiere añadir el mistery?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data :  "tipo=addMisteryFranqCentral&" +
					"idFranquicia=" + idFranquicia + "&" +
					"nom_central=" + nom_central + "&" +
					"ubicacion=" + ubicacion + "&" +
					"f_entrevista=" + f_entrevista + "&" +
					"correo_central=" + correo_central + "&" +
					"cargo_central="+ cargo_central + "&" +
					"telefono_central=" + telefono_central + "&" +
					"nom_utilizado=" + nom_utilizado + "&" +
					"correo_utilizado=" + correo_utilizado + "&" +
					"telefono_utilizado=" + telefono_utilizado + "&" +
					"catalogos=" + catalogos + "&" +
					"informacion_obtenida=" + informacion_obtenida + "&" +
					"usuario=" + usuario + preguntas,
			success : function(data) {
				if ( data == "Ok") {
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

function createPreguntasPost(tipo){
	var preguntasParam="";
	var numPreg=0;

	$(".preguntas_"+tipo).each(function(){
		preguntasParam=preguntasParam+"&idpreg"+numPreg+"="+ $(this).attr('id') +"&respuesta"+numPreg+"="+$(this).val()
		numPreg++;
	});

	if (numPreg==0){
		preguntasParam= "";
	}else{
		preguntasParam=preguntasParam+"&numPreg="+numPreg;
	}
	return preguntasParam;
}

function getPreguntas(idFranquiciado){
	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultarPreguntasMistery&" +
			"id=" + idFranquiciado,

		success : function(data) {

			var json = JSON.parse(data);

			for (var i in json) {
				$(".preguntas").each(function(){
					if ($(this).attr('id')==json[i].id_pregunta){
						$(this).val(json[i].respuesta);
					}
				});
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido cargar el mistery de la central - ' + textStatus + ' - ' + errorThrown);
		}
	});
}

function addMisteryFranqFdo(idFranquicia){

	var nom_entrevistado=$("#nom_entrevistado_fdo").val();
	var telefono_entrevistado=$("#telefono_entrevistado_fdo").val();
	var email_entrevistado=$("#email_entrevistado_fdo").val();
	var ubicacion=$("#ubicacion_fdo").val();

	var f_entrevista=$("#f_entrevista_fdo").val();
	var usuario=$("#usuario_fdo").val();
	var nom_utilizado=$("#nom_utilizado_fdo").val();
	var correo_utilizado=$("#correo_utilizado_fdo").val();
	var telefono_utilizado=$("#telefono_utilizado_fdo").val();
	var tipo_entrevista=$("#tipo_entrevista_fdo").val();
	var year_fran=$("#year_fran_fdo").val();
	var nivel_satisfaccion=$("#nivel_satisfaccion_fdo").val();
	var informacion_proporcionada=$("#informacion_proporcionada_fdo").val();
	var informacion_obtenida=$("#informacion_obtenida_fdo").val();

	var preguntas=createPreguntasPost("chk_fdo");

	if (confirm("¿Quiere añadir el mistery?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data :  "tipo=addMisteryFranqFdo&" +
				"idFranquicia=" + idFranquicia + "&" +
				"nom_entrevistado=" + nom_entrevistado + "&" +
				"telefono_entrevistado=" + telefono_entrevistado + "&" +
				"email_entrevistado=" + email_entrevistado + "&" +
				"ubicacion=" + ubicacion + "&" +
				"f_entrevista=" + f_entrevista + "&" +
				"nom_utilizado=" + nom_utilizado + "&" +
				"correo_utilizado=" + correo_utilizado + "&" +
				"telefono_utilizado=" + telefono_utilizado + "&" +
				"tipo_entrevista=" + tipo_entrevista + "&" +
				"year_fran=" + year_fran + "&" +
				"nivel_satisfaccion=" + nivel_satisfaccion + "&" +
				"informacion_proporcionada=" + informacion_proporcionada + "&" +
				"informacion_obtenida=" + informacion_obtenida + "&" +
				"usuario=" + usuario + preguntas,
			success : function(data) {

				if ( data == "Ok") {
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

function deleteMisteryCentral(id){

	if (confirm("¿Quiere eliminar el mistery seleccionado?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaMisteryFranqCentral&" +
				"id=" + id,

			success : function(data) {
				if ( data == "Ok") {
					document.location.reload();
				} else {
					alert("No se ha podido eliminar el mistery");
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido borrar el mistery seleccionado - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}

}

function deleteMisteryFdo(id){
	
	if (confirm("¿Quiere eliminar el mistery seleccionado?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaMisteryFranqFdo&" +
					"id=" + id,
			
			success : function(data) {
				if ( data == "Ok") {
                    document.location.reload();                 
                } else {
                    alert("No se ha podido eliminar el mistery");
                }
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido borrar el mistery seleccionado - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}
	
}

function editMisteryCentral(id){
		
	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultaMisteryCentral&" +
				"id=" + id,
		
		success : function(data) {
			
			var json = JSON.parse(data);

			$("#nom_central").val(json[0].nom_central);
			$("#ubicacion").val(json[0].ubicacion);
			$("#f_entrevista_fdo").val(json[0].f_entrevista);
			$("#correo_central").val(json[0].correo_central);
			$("#cargo_central").val(json[0].cargo_central);
			$("#telefono_central").val(json[0].telefono_central);
			$("#nom_utilizado").val(json[0].nom_utilizado);
			$("#correo_utilizado").val(json[0].correo_utilizado);
			$("#telefono_utilizado").val(json[0].telefono_utilizado);
			$("#catalogos").val(json[0].catalogos);
			$("#usuario").val(json[0].usuario);
			$("#informacion_obtenida").val(json[0].informacion_obtenida);
			
		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido cargar el mistery de la central - ' + textStatus + ' - ' + errorThrown);

		}
	});
}

function editMisteryFdo(id){

	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultaMisteryFdo&" +
			"id=" + id,

		success : function(data) {

			var json = JSON.parse(data);

			$("#nom_entrevistado_fdo").val(json[0].nom_entrevistado);
			$("#telefono_entrevistado_fdo").val(json[0].telefono_entrevistado);
			$("#email_entrevistado_fdo").val(json[0].correo_entrevistado);
			$("#ubicacion_fdo").val(json[0].ubicacion);

			$("#f_entrevista_fdo").val(json[0].f_entrevista);
			$("#usuario_fdo").val(json[0].id_usuario);
			$("#nom_utilizado_fdo").val(json[0].nom_utilizado);
			$("#correo_utilizado_fdo").val(json[0].email_utilizado);
			$("#telefono_utilizado_fdo").val(json[0].telefono_utilizado);
			$("#tipo_entrevista_fdo").val(json[0].tipo_entrevista);
			$("#year_fran_fdo").val(json[0].year_fran);
			$("#nivel_satisfaccion_fdo").val(json[0].nivel_satisfaccion);
			$("#informacion_proporcionada_fdo").val(json[0].informacion_proporcionada);
			$("#informacion_obtenida_fdo").val(json[0].informacion_obtenida);

			getPreguntas(id);

		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido cargar el mistery fdo - ' + textStatus + ' - ' + errorThrown);

		}
	});

}

function addPreguntaMistery(idFranquicia){

	var pregunta=$("#pregunta_mistery").val();

	var chk_fdo=0;
	var chk_central=0;

	if ($("#chk_fdo").attr( "checked" )){
		chk_fdo=1;
	}

	if ($("#chk_central").attr( "checked" )){
		chk_central=1;
	}

	if (confirm("¿Quiere añadir la pregunta?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data :  "tipo=addMisteryFranqPregunta&" +
				"idFranquicia=" + idFranquicia + "&" +
				"pregunta=" + pregunta + "&" +
				"chk_fdo=" + chk_fdo + "&" +
				"chk_central=" + chk_central,
			success : function(data) {

				if ( data == "Ok") {
					document.location.reload();
				} else {
					alert("No se ha podido guardar la pregunta");
				}
				return true;
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido guardar la pregunta - ' + textStatus + ' - ' + errorThrown);
			}
		});
	} else {
		return false;
	}
}

function editMisteryPregunta(id){

	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultaMisteryPregunta&" +
			"id=" + id,

		success : function(data) {

			var json = JSON.parse(data);

			$("#pregunta_mistery").val(json[0].pregunta);

			if (json[0].chk_fdo==1){
				$("#chk_fdo").prop('checked', true);
			}else{
				$("#chk_fdo").prop('checked', false);
			}

			if (json[0].chk_central==1){
				$("#chk_central").prop('checked', true);
			}else{
				$("#chk_central").prop('checked', false);
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			YAHOO.SUGAR.MessageBox.hide();
			alert('No se ha podido recoger los datos de la pregunta - ' + textStatus + ' - ' + errorThrown);
		}
	});
}

function deleteMisteryPregunta(id){

	if (confirm("¿Quiere eliminar la pregunta?")) {

		url = 'index.php?entryPoint=consultarFranquicia';
		$.ajax({
			type : "POST",
			url : url,
			data : "tipo=BajaMisteryFranqPregunta&" +
				"id=" + id,

			success : function(data) {
				if ( data == "Ok") {
					document.location.reload();
				} else {
					alert("No se ha podido eliminar el mistery");
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				YAHOO.SUGAR.MessageBox.hide();
				alert('No se ha podido borrar el mistery seleccionado - ' + textStatus + ' - ' + errorThrown);

			}
		});

	} else {
		return false;
	}
}