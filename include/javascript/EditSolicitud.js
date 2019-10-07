 
	const USUARIO_RUBEN='71f40543-2702-4095-9d30-536f529bd8b6';
		
	$("#tab2").hide();
	$("#save_and_continue").hide();

	$("#historial_empresa").height(155);
	$("#empresa_temp").val($("#empresa").val());	
	
	$("#enviar_servicios_asesora").change(function(){
		var valor=$(this).val();
		
		if (valor==true){
			$("#Asesoramiento").prop("checked", true);
		}					
		
	});

	$("#historial_empresa").change(function(){		
    	actualizarHist();		
	}),
	
	$("#empresa").keyup(function(e){				
		$("#empresa_temp").val($("#empresa").val());	
	});
	
	$("#empresa_temp").keyup(function(e){		
    	$("#empresa").val($("#empresa_temp").val());
	});
	
	
	$("#pais_c").change(function(){
		var valor=$(this).val();
		if(valor!="SPAIN"){//es master
			$("#master").prop("checked", true);
			$("#master").prop('disabled', false);
			$("#provincia_residencia_label").parent().show();
		}else{
			$("#master").prop("checked", false);
			$("#provincia_residencia_label").parent().hide();
		}
		
	});
	
	$("#chk_entrevista_previa_EN").bind("click", function() {
		activarFecha("#chk_entrevista_previa_EN", "#f_entrevista_previa_EN");				
	});
	
	$("#chk_entrevista_previa_cliente").bind("click", function() {
		activarFecha("#chk_entrevista_previa_cliente", "#f_entrevista_previa_cliente");				
	});
	
	$('#tags_empresa').keyup(function(e) {
      if (e.keyCode == '13') {
         e.preventDefault();
         //your code here
       }
    });
            
    $('#franquicia_historicos').keyup(function(e) {
      if (e.keyCode == '13') {
         e.preventDefault();
         //your code here
       }
    });
            
	$('#busca_motivosTagCheck').keyup(function(e) {
      if (e.keyCode == '13') {
         e.preventDefault();
         //your code here
       }
    });
                        
	$('#busca_habilidadTagCheck').keyup(function(e) {
      if (e.keyCode == '13') {
         e.preventDefault();
         //your code here
       }
    }); 
    
    $('#busca_sector').keyup(function(e) {  
    	var str= $('#busca_sector').val();
    	limpiarSector();
    	if (str.length>2){
    		buscarSector(str);
    	}else{
			limpiaBuscarSector();
		}
    	
	      if (e.keyCode == '13') {
	         e.preventDefault();
	        
	       }
     });       
     
    $("#dispone_local").change(function(){
		renderLocal();
	});            
            
	$('#busca_sitPerTagCheck').keyup(function(e) {
              if (e.keyCode == '13') {
                 e.preventDefault();
                 //your code here
               }
            });                                     
	
	$("#provincia_residencia").change(function(){
		var valor=$(this).val();
		if(valor!="100"){
			$("#localidad_residencia").prop("disabled", true);
		}else{
			$("#localidad_residencia").prop("disabled", false);
		}
		
	});
	
	$("#localidad_apertura_1").focus(function(){
		loadMunicipios(1);
	});		
	
	$("#localidad_apertura_2").focus(function(){
		loadMunicipios(2);
	});	
	
	$("#localidad_apertura_3").focus(function(){
		loadMunicipios(3);
	});

	$("#franquicias_contactadas").keyup(function(){//cuando pulses la caja de texto
		var campoF=$(this).val();	//valor del texto
		var arrayFran=campoF.split(","); //todas las franquicias separadas por comas en un array
		var franqHastaUlComa="";
		for(var i=0;i<arrayFran.length-1;i++){//construir las franquicias anteriores
			franqHastaUlComa=franqHastaUlComa+arrayFran[i]+",";
		}
		var longi=arrayFran.length;//cuantas hay
		
		var franq=arrayFran[longi-1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
		var franqSE=franq.trim(); //eliminar espacios en blanco
		
		
		if(franqSE.length>2){//solo se hace la llamada si se han escrito 3 caracteres
			
			var dataFran="franquicias="+franqSE+"&tipo=franquicia";
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataFran,
			success: function(data){
				$('#sugerencias').fadeIn(500).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#franquicias_contactadas').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#franquicias_contactadas').val(franqHastaUlComa+fran);
					}
					
					$('#sugerencias').fadeOut(500);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias si se pulsa en otro sitio
					$('#sugerencias').fadeOut(500);
				});
			}
		});
		}
	});
	
	$("#franquicia_historicos").keyup(function(){//cuando pulses la caja de texto
		var campoF=$(this).val();	//valor del texto
		var arrayFran=campoF.split(","); //todas las franquicias separadas por comas en un array
		var franqHastaUlComa="";
		for(var i=0;i<arrayFran.length-1;i++){//construir las franquicias anteriores
			franqHastaUlComa=franqHastaUlComa+arrayFran[i]+",";
		}
		var longi=arrayFran.length;//cuantas hay
		
		var franq=arrayFran[longi-1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
		var franqSE=franq.trim(); //eliminar espacios en blanco
		
		
		if(franqSE.length>2){//solo se hace la llamada si se han escrito 3 caracteres
			
			var dataFran="franquicias="+franqSE+"&tipo=franquicia";
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataFran,
			success: function(data){
				$('#sugerencias_hist').fadeIn(500).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#franquicia_historicos').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#franquicia_historicos').val(franqHastaUlComa+fran);
					}
					
					$('#sugerencias_hist').fadeOut(500);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias si se pulsa en otro sitio
					$('#sugerencias_hist').fadeOut(500);
				});
			}
		});
		}
	});
	
	$("#sectores_historicos").keyup(function(){//cuando pulses la caja de texto
		var campoF=$(this).val();	//valor del texto
		var arrayFran=campoF.split(","); //todas las franquicias separadas por comas en un array
		var franqHastaUlComa="";
		for(var i=0;i<arrayFran.length-1;i++){//construir las franquicias anteriores
			franqHastaUlComa=franqHastaUlComa+arrayFran[i]+",";
		}
		var longi=arrayFran.length;//cuantas hay
		
		var franq=arrayFran[longi-1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
		var franqSE=franq.trim(); //eliminar espacios en blanco
		
		
		if(franqSE.length>2){//solo se hace la llamada si se han escrito 3 caracteres
			
			var dataSector="sectores="+franqSE+"&tipo=sector";
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataSector,
			success: function(data){
				$('#sugerencia_sectores_hist').fadeIn(500).html(data);
				$('.sug_sec').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#sectores_historicos').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#sectores_historicos').val(franqHastaUlComa+fran);
					}
					
					$('#sugerencia_sectores_hist').fadeOut(500);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias si se pulsa en otro sitio
					$('#sugerencia_sectores_hist').fadeOut(500);
				});
			}
		});
		}
	});
	
	
	$("#otras_franquicias").keyup(function(){//cuando pulses la caja de texto
		var campoF=$(this).val();	//valor del texto
		var arrayFran=campoF.split(","); //todas las franquicias separadas por comas en un array
		var franqHastaUlComa="";
		for(var i=0;i<arrayFran.length-1;i++){//construir las franquicias anteriores
			franqHastaUlComa=franqHastaUlComa+arrayFran[i]+",";
		}
		var longi=arrayFran.length;//cuantas hay
		
		var franq=arrayFran[longi-1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
		var franqSE=franq.trim(); //eliminar espacios en blanco
		
		
		if(franqSE.length>1){//solo se hace la llamada si se han escrito 3 caracteres
			
			var dataFran="franquicias="+franqSE+"&tipo=franquicia";
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataFran,
			success: function(data){
				$('#sugerenciasO').fadeIn(500).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#otras_franquicias').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#otras_franquicias').val(franqHastaUlComa+fran);
					}
					
					$('#sugerenciasO').fadeOut(500);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias en caso de pulsar fuera
					$('#sugerenciasO').fadeOut(500);
				});
			}
		});
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
	
	$("#busca_sitPerTagCheck").keyup(function(){//cuando pulses la caja de texto
		
		$(".sitPerTagCheck").parent().css( "background-color", "");
		
		var text= $(this).val();
		
		if (text.trim()==""){
			return;
		}		
		
		$(".sitPerTagCheck").each(function(){
			
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
	

	$("#chk_entrevista_previa_EN").bind("click", function() {
		activarFecha("#chk_entrevista_previa_EN", "#f_entrevista_previa_EN");
	});
	
	$("#chk_entrevista_previa_cliente").bind("click", function() {
		activarFecha("#chk_entrevista_previa_cliente", "#f_entrevista_previa_cliente");
	});
	
var refreshSn = function ()
{
	var refreshTime = 600000; // every 10 minutes in milliseconds
	window.setInterval( function() {
	    $.ajax({
	        cache: false,
	        type: "GET",
	        url: "refresh_session.php",
	        success: function(data) {	        		        	        
	        	
	        	var _form = document.getElementById('EditView');
				 _form.action.value='Save';
				 _form.return_action.value='EditView';  
				 if(check_form('EditView')){
				 	SUGAR.ajaxUI.submitForm(_form);
				 }
			  		
				 return false;	        	
	        }
	    });
	}, refreshTime );
};


function inicio() {
	//Ocultar los campos auxiliares	
	ocultarCampoAux();	

	//Ponemos de solo lectura el check de candidatur caliente
	document.getElementById("candidatura_caliente").disabled = true;
	document.getElementById("oportunidad_inmediata").disabled = true;
	document.getElementById("master").disabled = true;

	//Cargamos los sectores
	cargarchecks("Sectorcheck", "sectores_de_interes");
	cargarchecks("francheck", "franquicias_secundarias");
	cargarchecks("habilidadTagCheck","habilidades");
	cargarchecks("sitPerTagCheck","situacion_personal");
	cargarchecks("motivosTagCheck","motivos_interes");	
	
	//Incidencia #5488 la hemos eliminado por e momento
	//	ocultarCamposEdicion();
	
	pintaFranFromSector();

	$(document).bind("click", function() {

		if (hasEventListener($("#Expan_Solicitud0emailAddress0"), "blur") == false) {
			$("#Expan_Solicitud0emailAddress0").bind("blur", function() {

				controlCorreos();

			});
		}
	});

	var campo = document.getElementById("btn_created_by_name");
	if (campo != null) {
		campo.style.display = 'none';
	}
	var campo = document.getElementById("btn_clr_created_by_name");
	if (campo != null) {
		campo.style.display = 'none';
	}

	//Controlamos si estamos ante un usuario de una franquicia
	conControlUsuarioFran();
	
	//poner en amarillo los elementos que aunque no son obligatorios los marcamos	
	marcaCampos();	//'<hr size="10" style="color: #0056b2;" width="200%" />'
	cambioSeleccion();
	
	actualizarHist();
	
	cargaAccionesSol();
	refreshSn();
	renderLocal();
}

function renderLocal(){
	var valor=$("#dispone_local").val();
	if(valor!="" && valor!=0){
		$("#tab2").show();
	}else{
		$("#tab2").hide();
	}
}

function cargaAccionesSol(){
	var solId = $('[name="record"]').val();	
	addPanelAccionesPorHacerSolicitud(solId);	
}

function getUsuario(){

	url='index.php?entryPoint=herramientas';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getUser",
		success : function(data) {						
			return data;				
		},
		error : function(jqXHR, textStatus, errorThrown) {					
		}
	});
}

function loadMunicipios(numComboProv){
	
	var provincia;
	var $selectProv;
	var $selectMun;
	
	var valSelect;
	
	if (numComboProv==1) {
		$selectProv =$("#provincia_apertura_1");
		$selectMun = $("#localidad_apertura_1");
	}else if (numComboProv==2){
		$selectProv =$("#provincia_apertura_2");
		$selectMun = $("#localidad_apertura_2");
	}else if (numComboProv==3){
		$selectProv =$("#provincia_apertura_3");
		$selectMun = $("#localidad_apertura_3");
	}	
	
	provincia=$selectProv.val();	
	valSelect=$selectMun.val();
	
	url = 'index.php?entryPoint=consultarSolicitud';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeMunicipios&provincia=" + provincia,
		success : function(data) {								
			
			$selectMun.empty();
			var parse = JSON.parse(data);				
			var listitems = '<option value=""></option>';
			
			for(var i in parse) {
				
				 listitems += '<option value=' + parse[i].c_provmun + '>' + parse[i].d_municipio + '</option>';
			}
			
			
		/*	$.each(parse, function(key, value){
			    listitems += '<option value=' + key + '>' + value + '</option>';
			});*/
			$selectMun.append(listitems);				
			
			if (numComboProv==1) {
				$("#localidad_apertura_1 option[value="+ valSelect +"]").attr("selected",true);
			}else if (numComboProv==2){
				$("#localidad_apertura_2 option[value="+ valSelect +"]").attr("selected",true);
			}else if (numComboProv==3){
				$("#localidad_apertura_3 option[value="+ valSelect +"]").attr("selected",true);
			}		

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar los documntos Entrantes- ' + textStatus + ' - ' + errorThrown);
		}
	});	
	
}

function addPanelAccionesPorHacerSolicitud(solId){
	
	url = 'index.php?entryPoint=consultarSolicitud&tipo=RecogeAccionesPorHacer&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeAccionesPorHacer&solId=" + solId,
		success : function(data) {						
			
			if (data!=	'UsuarioFranquicia'){
				var parse = JSON.parse(data);				
				var array=tareasJsonToArray(parse);
				
				var div= $('<div/>',
			    {
			        id: 'ListadoTareas',        
			        class:'subpanelTabForm',
			        html:'<H3>Actividades</H3>',
			    });       
					
				tabla=generateTable(array);																					
				div.append(tabla);
				
				if ($('#EditView_tabs').length) {
	  				$("#EditView_tabs").after(div);	
				} else {
	  				$("#content").after(div);	
				}
				
				
				addPanelAccionesHistoricoSolicitud(solId);	
			}
		
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar tareas por realizar - ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function addPanelAccionesHistoricoSolicitud(solId){
	
	url = 'index.php?entryPoint=consultarSolicitud&tipo=RecogeAccionesHistorico&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeAccionesHistorico&solId=" + solId,
		success : function(data) {								
			
			var parse = JSON.parse(data);				
			var array=tareasJsonToArray(parse);
			
			var div= $('<div/>',
		    {
		        id: 'ListadoHistTareas',        
		        class:'subpanelTabForm H3',
		        html:'<H3>Historial</H3>',
		    });       
				
			tabla=generateTable(array);																					
			div.append(tabla);
			$("#ListadoTareas").after(div);		
			addPanelDocumentosRecibidosSolicitud(solId);		

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar los documntos Entrantes- ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function addPanelDocumentosRecibidosSolicitud(solId){
	
	url = 'index.php?entryPoint=consultarSolicitud&tipo=RecogeDocumentosRecibidosSolicitud&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeDocumentosRecibidosSolicitud&solId=" + solId,
		success : function(data) {								
			
			var parse = JSON.parse(data);				
			var array=documentosJsonToArray(parse);
			
			var div= $('<div/>',
		    {
		        id: 'DocumentosRecibidos',        
		        class:'subpanelTabForm H3',
		        html:'<H3>Documentos Recibidos</H3>',
		    });       
				
			tabla=generateTable(array);																					
			div.append(tabla);
			$("#ListadoHistTareas").after(div);	
			addPanelDocumentosEnviadosSolicitud(solId);			

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar tareas históricas - ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function addPanelDocumentosEnviadosSolicitud(solId){
	
	url = 'index.php?entryPoint=consultarSolicitud&tipo=RecogeDocumentosEnviados&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeDocumentosEnviados&solId=" + solId,
		success : function(data) {								
			
			var parse = JSON.parse(data);				
			var array=documentosJsonToArray(parse);
			
			var div= $('<div/>',
		    {
		        id: 'DocumentosEnviados',        
		        class:'subpanelTabForm H3',
		        html:'<H3>Documentos Enviados</H3>',
		    });       
				
			tabla=generateTable(array);																					
			div.append(tabla);
			$("#ListadoHistTareas").after(div);				

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar tareas históricas - ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function unescapeHTML(escapedHTML) {
	if (escapedHTML==null){
		return null;
	}else{
		return escapedHTML.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&').replace(/&quot;/g,'');
	}  
}

function documentosJsonToArray(Json){
	
	var array=[];
	
	var arrayInt=[];

	arrayInt.push('Fecha');
	arrayInt.push('Documento');
	arrayInt.push('');	
	array.push(arrayInt);
	
	for(var i in Json) {
		
		var arrayInt=[];
		
        arrayInt.push('<img src="themes/Sugar5/images/Documents.gif?v=1DGI1bi-PiFYhwpnWfZEfg" border="0" alt="Llamadas">');        				
		arrayInt.push(Json[i].Documento);
		arrayInt.push(Json[i].Fecha);		
		
		array.push(arrayInt);
	}
	
	return array;
	
}

function tareasJsonToArray(Json){
	
	var array=[];
	
	var arrayInt=[];

	arrayInt.push('Usuario Asignado');
	arrayInt.push('Fecha Programada');
	arrayInt.push('Fecha de Modificacion');	
	arrayInt.push('Fecha de Creacion');
	arrayInt.push('Franquicia');
	arrayInt.push('Estado');
	arrayInt.push('Tipo');
	arrayInt.push('');	
	array.push(arrayInt);
	
	for(var i in Json) {
		var arrayInt=[];
		
		switch(Json[i].icono) {
		    case 'llamada':
		        arrayInt.push('<img src="themes/Sugar5/images/Calls.gif?v=EN4Hi51G3rnoYYAGKHVP6A" border="0" alt="Llamadas">');
		        break;
		    case 'tarea':
		        arrayInt.push('<img src="themes/Sugar5/images/Tasks.gif?v=X2Oa2Xk7VqeGMsDrCw_Ovg" border="0" alt="Tareas">');
		        break;
		    case 'correo':
		        arrayInt.push('<img src="themes/Sugar5/images/Emails.gif?v=Nnh-cP0-Am9KpOzOv4vbgQ" border="0" alt="Emails">');
		        break;	
		   case 'reunion':
		        arrayInt.push('<img src="themes/Sugar5/images/Meetings.gif?v=dLmpNb-Z3DfXBNpmqxmq7w" border="0" alt="Reuniones">');
		        break;    		   	        
		    default:
		        arrayInt.push('');
		        break;
		}
				
		arrayInt.push(Json[i].tipo);
		arrayInt.push(Json[i].Estado);
		arrayInt.push(Json[i].franquicia);
		arrayInt.push(Json[i].fecha_creacion);	
		arrayInt.push(Json[i].date_modified);
		arrayInt.push(Json[i].date_start);
		arrayInt.push(Json[i].usuario_asignado);					
		
		array.push(arrayInt);
	}
	
	return array;
}

function generateTable(lista) {
	
	 var aTable =$('<table/>',
    {    	
    	cellpadding:'0',
    	cellspacing:'0',
    	width:'100%',
    	border:'0',
        id: 'tableTareas',        
        class:'list view',
    });
	
    var rowCount = lista.length;
    var colmCount = lista[0].length;

    // For loop for adding header .i.e th to our table
    for (var k = 0; k < 1; k++) {
        var fragTrow = $("<tr>", {
            "class": "trClass"
        }).appendTo(aTable);
        for (var j = 0; j < colmCount; j++) {
            $("<th>", {
                "class": "thClass"
            }).prependTo(fragTrow).html(unescapeHTML(lista[k][j]));
        }
    }

    //For loop for adding data .i.e td with data to our dynamic generated table
    for (var i = 1; i < rowCount; i < i++) {    	        	
        var fragTrow = $("<tr>", {
            "class": "oddListRowS1"
        }).appendTo(aTable);
        for (var j = 0; j < colmCount; j++) {
            $("<td>", {
               // "class": "tdClass",
                "scope": "row",
            }).appendTo(fragTrow).html(unescapeHTML(lista[i][j]));
        }
    }
    return aTable;
}

function controlRating(solId){
	
	if (esCreacion()){
		return;
	}
	
	var rating=$('#rating').val();
	
	url = 'index.php?entryPoint=controlSolicitudes&valida=pregRating&rating=' + rating + '&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "valida=pregRating&rating=" + rating + "&solId=" + solId,
		success : function(data) {
			if (data == 'true') {

				confirmar=confirm("Se ha cambiado el rating de la solicitud. ¿Desea que las gestiones asociadas cambien el rating al seleccionado?"); 
				if (confirmar){
					cambioRating(rating,solId);
				}
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido realizar control del Rating de la solicitud - ' + textStatus + ' - ' + errorThrown);
		}
	});
	
}

function cambioRating(rating,solId){
	
	url = 'index.php?entryPoint=controlSolicitudes&valida=modRating&rating=' + rating + '&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "valida=modRating&rating=" + rating + "&solId=" + solId,
		success : function(data) {
			
		},
		error : function(jqXHR, textStatus, errorThrown) {
			if (errorThrown!=''){
				alert('No se ha podido modificar los rating de las gestiones asociadas - ' + textStatus + ' - ' + errorThrown);				
			}
		}
	});
}
function validarSubOrigen() {	

	var Nombre= document.getElementById("first_name");
	var Apellidos= document.getElementById("last_name");
	
	var Origen = document.getElementById("tipo_origen");
	var optPortal = document.getElementById("portal");
	var optEvento = document.getElementById("expan_evento_id_c");
	var optExpande = document.getElementById("subor_expande");	
	var optCentral = document.getElementById("subor_central");
	var optMedios = document.getElementById("subor_medios");
	var franPrin = document.getElementById("franquicia_principal");
	var optRating = document.getElementById("rating");
	var txtPerfil = document.getElementById("perfil_profesional");
	var optCapital = document.getElementById("capital");
	var optMailing = document.getElementById("subor_mailing");
	var optSituacion_profesional = document.getElementById("situacion_profesional");
	var optPerfil_franquicia= document.getElementById("perfil_franquicia");
		
	var styleProps = $("#phone_mobile").css("border");
	if (styleProps=="2px solid rgb(255, 0, 0)"){
		alert("El teléfono movil corresponde con otra solicitud");		
		return false;
	}
	
    styleProps = $("#Expan_Solicitud0emailAddress0").css("border");
	if (styleProps=="2px solid rgb(255, 0, 0)"){
		alert("El correo corresponde con otra solicitud");		
		return false;
	}

	if (Nombre.value=="" && Apellidos.value==""){
		
		if (Nombre.value==""){
			$("#first_name").css("border", "2px solid red");
		}
		if (Apellidos.value==""){
			$("#last_name").css("border", "2px solid red");
		} 
		
		alert("El nombre o los apellidos deben de estar rellenos");
		return false;
	}else {
		$("#first_name").css("border", "#94c1e8 solid 1px");
		$("#last_name").css("border", "#94c1e8 solid 1px");
	}		

	//Comprobamos si la franquicia principal esta rellena
	if (franPrin.selectedIndex == 0){		
		$("#franquicia_principal").css("border", "2px solid red");
		alert("La franquicia principl esta vacia");			
		return false;
	}else {
		$("#franquicia_principal").css("border", "#94c1e8 solid 1px");
	}

	var rating="";
	if (optRating.selectedIndex != -1) {
		rating = optRating.options[optRating.selectedIndex].label;
	}
	
	var perfil=txtPerfil.value;

	var portal = "";
	if (optPortal.selectedIndex != -1) {
		portal = optPortal.options[optPortal.selectedIndex].label;
	}

	var evento = "";
	if (optEvento.selectedIndex != -1) {
		evento = optEvento.options[optEvento.selectedIndex].label;
	}
	
	var expande = "";
	if (optExpande.selectedIndex != -1) {
		expande = optExpande.options[optExpande.selectedIndex].label;
	}
	
	var central = "";
	if (optCentral.selectedIndex != -1) {
		central = optCentral.options[optCentral.selectedIndex].label;
	}
	var medios = "";
	if (optMedios.selectedIndex != -1) {
		medios = optMedios.options[optMedios.selectedIndex].label;
	}
	
	var mailing = "";
	if (optMailing.selectedIndex != -1) {
		mailing = optMailing.options[optMailing.selectedIndex].label;
	}
	
	var capital = "";
	if (optCapital.selectedIndex != -1) {
		capital = optCapital.options[optCapital.selectedIndex].label;
	}
	
	var situacion_profesional = "";
	if (optSituacion_profesional.selectedIndex != -1) {
		situacion_profesional = optSituacion_profesional.options[optSituacion_profesional.selectedIndex].label;
	}
	
	var perfilFran= "";
	if (optPerfil_franquicia.selectedIndex != -1) {
		perfilFran = optPerfil_franquicia.options[optPerfil_franquicia.selectedIndex].label;
	}

	for (var i = 0, l = Origen.options.length, o; i < l; i++) {
		o = Origen.options[i];

		if (o.selected == true && o.value == 2 && portal == "") {
			$("#portal").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es portal y no se ha seleccionado el mismo");			
			return false;
		} else {
			$("#portal").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 3 && evento == "") {
			$("#expan_evento_id_c").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es Evento y no se ha seleccionado el mismo");
			return false;
		}else {
			$("#expan_evento_id_c").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 3 && perfil == "" && esCreacion()) {
			$("#perfil_profesional").css("border", "2px solid red");
			alert("El perfil es obligatorio si el origen es evento");
			return false;
		}else {
			$("#perfil_profesional").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 3 && capital == "" && esCreacion()) {
			$("#capital").css("border", "2px solid red");
			alert("El capital a invertir es obligatorio si el origen es evento");
			return false;
		}else {
			$("#capital").css("border", "#94c1e8 solid 1px");
		}

		if (o.selected == true && o.value == 3 && $("#recursos_propios").val() == "" && esCreacion()) {
			$("#recursos_propios").css("border", "2px solid red");
			alert("El campo recursos propios obligatorio si el origen es evento");
			return false;
		}else {
			$("#recursos_propios").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 3 && situacion_profesional == "" && esCreacion()) {
			$("#situacion_profesional").css("border", "2px solid red");
			alert("La situacion profesional es obligatoria si el origen es evento");
			return false;
		}else {
			$("#situacion_profesional").css("border", "#94c1e8 solid 1px");
		}
				
		if (o.selected == true && o.value == 3 && rating == "" && esCreacion()) {
			$("#rating").css("border", "2px solid red");
			alert("El rating es obligatorio si el origen es evento");
			return false;
		}else {
			$("#rating").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 1 && expande == "" ) {
			$("#subor_expande").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es ExpandeNegocio y no se ha seleccionado el mismo");
			return false;
		}else {
			$("#rating").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 1 && $("#subor_expande").val()!=10 && rating == "" && esCreacion()) {
			$("#rating").css("border", "2px solid red");
			alert("El rating es obligatorio si el origen es expandenegocio");
			return false;
		}else {
			$("#rating").css("border", "#94c1e8 solid 1px");
		}

		if (o.selected == true && o.value == 1 && $("#subor_expande").val()==10 && rating == "") {
			$("#tags_empresa").css("border", "2px solid red");
			alert("Es obligatorio recoger tags si el origen es precandidato");
			return false;
		}else {
			$("#tags_empresa").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 3 && perfilFran == "" && esCreacion()) {
			$("#perfil_franquicia").css("border", "2px solid red");
			alert("El pefil de la franquicia es obligatorio si el origen es evento");
			return false;
		}else {
			$("#perfil_franquicia").css("border", "#94c1e8 solid 1px");
		}

		if (o.selected == true && o.value == 4 && central == "") {
			$("#subor_central").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es Central y no se ha seleccionado el mismo");			
			return false;
		}else {
			$("#subor_central").css("border", "#94c1e8 solid 1px");
		}

		if (o.selected == true && o.value == 5 && medios == "") {			
			$("#subor_medios").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es Medios y no se ha seleccionado el mismo");
			return false;
		}else {
			$("#subor_medios").css("border", "#94c1e8 solid 1px");
		}
		
		if (o.selected == true && o.value == 6 && mailing == "") {			
			$("#subor_mailing").css("border", "2px solid red");
			alert("Uno de los origenes de la solicitud es Mailing y no se ha seleccionado el mismo");
			return false;
		}else {
			$("#subor_mailing").css("border", "#94c1e8 solid 1px");
		}

	}	
	return check_form("EditView");
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
		
	if (clase=='Sectorcheck'){
		if (act==true){
			getFranqFromSector(listaSel.toString());
		}		
	}else if (clase=='francheck'){
		getSectorFromFranq(listaSel.toString());
		
		if (!esCreacion()){
			alert ("Revisar el origen");
		}
	} 
		
	// Si no esta ninguna activa desactivo la principal
	if (numCheck == 0 && clase == 'francheck' ) {
		$('#franquicia_principal').find('option').attr("selected", false);
	}

	for (var k = 0; k < listaSel.length; k++) {
		for (var j = 0; j < listaFran.length; j++) {
			if (listaSel[k] == listaFran[j].text) {
				listaFran[j].selected = true;
			}
		}
	}
}

function ocultarCampoAux() {

	var check=$("#master").prop("checked");
	if(!check){
		$("#provincia_residencia_label").parent().hide();
	}
	
	if($("#provincia_residencia").val()=="100"){
		$("#localidad_residencia").prop("disabled", false);
	}else{
		$("#localidad_residencia").prop("disabled", true);
	}
	
	//Ocultamos la lista
	var campo = document.getElementById("franquicias_secundarias_label").parentNode;

	campo.id = "franquicias_secundarias_label_ocul";

	if (campo != null) {
		campo.style.display = 'none';
	}
	
	$("#habilidades_label").parent().hide();
	$("#motivos_interes_label").parent().hide();
	
	if (getUsuario!=USUARIO_RUBEN){
		$("#delegado_label").parent().hide();
		
		
	}
}

function completoSector(nombreSector,desp,actualizo) {
	
	nombreSector=nombreSector.split(' ').join('_');
	
	$( "input[name*='"+nombreSector+"']" ).each(function() {
		if (desp==true){	
			$(this).parent().show();				
		}else{
			$(this).parent().hide();			
		}				
	});

	cambiocheck("Sectorcheck","sectores_de_interes",actualizo);
}

function ocultarCamposEdicion(){
	
	if (esCreacion()==false){
		
		var idSolicitud = $('[name="record"]').val();	
		//alert(idSolicitud);
	
		url = "index.php?entryPoint=controlSolicitudes&valida=controlTiempo&solId=" + idSolicitud;
		$.ajax({
			type : "POST",
			url : url,
			data : "valida=controlTiempo&solId=" + idSolicitud,
			success : function(data) {
				if (data == 'true') {
					$("#cuando_empezar").prop("disabled", true);
					$("#cuando_empezar_trigger").hide();
					$("#perfil_franquicia").prop("disabled", true);
					$("#capital").prop("disabled", true);
					$("#recursos_propios").prop("disabled", true);
				}
	
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido controlar la existencia de correo repetido - ' + textStatus + ' - ' + errorThrown);
			}
		});
							
	}
		
}

function despliegoPliegoSector(nombreSector){

	if (typeof nombreSector !== 'undefined') {
		nombreSector = nombreSector.split(' ').join('_');

		CamposImput = document.getElementsByName(nombreSector);

		for (var i = 0; i < CamposImput.length; i++) {
			if (CamposImput[i].parentNode.style.display == '') {
				CamposImput[i].parentNode.style.display = 'none';
			} else {
				CamposImput[i].parentNode.style.display = null;
			}
		}
	}
	pintaFranFromSector();
}

function activoDesSector(nombreSector){
	
	nombreSector=nombreSector.split(' ').join('_');
	
	CamposImput = document.getElementsByName(nombreSector);

	for (var i = 0; i < CamposImput.length; i++) {			
		CamposImput[i].checked = !CamposImput[i].checked ;
	}
	
	pintaFranFromSector();
	cambiocheck("Sectorcheck","sectores_de_interes",true);
}



function despliegoSector(nombreSector){	
	
	if (typeof nombreSector !== 'undefined'){
		document.getElementById(nombreSector.split('_').join(' ')).checked=true;
	
		nombreSector=nombreSector.split(' ').join('_');
		
		
		CamposImput = document.getElementsByName(nombreSector);
	
		for (var i = 0; i < CamposImput.length; i++) {					
			CamposImput[i].parentNode.style.display=null;		
		}
		
		pintaFranFromSector();
	}

}

function pintaFranFromSector(){
	
	var checkboxes = document.getElementsByClassName('SectorParentCheck'); 
	var listaSel = [];
	
	//alert(checkboxes.length);
	
	for (var i = 0; i < checkboxes.length; i++) {

		//alert( checkboxes[i].id&"-"&checkboxes[i].checked);
		if (checkboxes[i].checked) {			
			listaSel[listaSel.length] = checkboxes[i].id;
			
		}
	}
	//alert(listaSel.toString());
	getFranqFromSector(listaSel.toString());
	
}


function ControlUsuarioFran(franq) {

	if (franq != '') {

		//Checamos las franquicias
		var checks = document.getElementById(franq);	
		checks.checked = true;
		cambiocheck("francheck", "franquicias_secundarias",true);

		//Ocultamo los sectores de interes y las franquicias
		$("[id^=sectores_de_interes_label]").parent().hide();

		var campo = document.getElementById("sectores_de_interes_label");
		 if (campo != null) {
		 campo.style.display = 'none';
		 }	
		 
		/*var campo = document.getElementById("otras_franquicias_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}*/
		var campo = document.getElementById("franquicia_principal_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("observaciones_solicitud_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}				
		
		var campo = document.getElementById("tab3");
		if (campo != null) {
			campo.style.display = 'none';
		}
			
		var campo = document.getElementById("no_newsletter").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}		
						
		//Seleccionamos el origen (feria) y Suborigen (SIF VAlencia 2015)
		
		var campo = document.getElementById("tipo_origen");
		if (campo != null) {
			campo.value=3;
		}
				
		var campo = document.getElementById("save_and_continue");
		if (campo==null){
			$("#expan_evento_id_c option:eq(1)").prop("selected", "selected");			
		}			 							
		
		var campo = document.getElementById("subor_expande_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("portal_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
	/*	
		var campo = document.getElementById("expan_evento_id_c_label");
		if (campo != null) {
			campo.style.display = 'none';
		}*/
		
		var campo = document.getElementById("subor_medios_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("subor_central_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		//Ocultamos el campo de Envio de Servicios Asesoramiento
		var campo = document.getElementById('enviar_servicios_asesora');
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById('enviar_servicios_asesora_label');
		if (campo != null) {
			campo.style.display = 'none';
		}		

		var campo = document.getElementById("oportunidad_inmediata_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("oportunidad_inmediata");
		if (campo != null) {
			campo.style.display = 'none';
		}

		var campo = document.getElementById("candidatura_caliente_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById("candidatura_caliente");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("do_not_call_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById("do_not_call");
		if (campo != null) {
			campo.style.display = 'none';
		}

		var campo = document.getElementById("no_correos_c_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById("no_correos_c");
		if (campo != null) {
			campo.style.display = 'none';
		}

		var campo = document.getElementById("disp_contacto_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById("disp_contacto");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("created_by_name");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("created_by_name_label");
		if (campo != null) {
			campo.style.display = 'none';
		}

		var campo = document.getElementById("created_by_name");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("created_by_name_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("zona_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		var campo = document.getElementById("zona");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("recursos_propios");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("recursos_propios_label");
		if (campo != null) {
			campo.style.display = 'none';
		}
		
		var campo = document.getElementById("crearFranquiciado");
		if (campo != null) {
			campo.style.display = 'none';
		}	
		
		$("#rrss_label").hide();
		$("#rrss").hide();			
		$("#perfil_plurifranquiciado").hide();
		$("#perfil_plurifranquiciado_label").hide();
		$("#expan_evento_id_c").hide();
		$("#expan_evento_id_c_label").hide();
		
		$("#franquicia_historicos").parent().hide();		
		$("#inicio_franq_hst").parent().hide();
		$("#fin_franq_hst").parent().hide();
		$("#franquicia_satisfa").parent().hide();	
		$("#chk_empresa_prov").parent().hide();
		$("#chk_empresa_cli_potencial").parent().hide();
		$("#chk_empresa_competencia").parent().hide();
		$("#chk_empresa_alianza").parent().hide();				
					
		$("#chk_entrevista_previa_EN").parent().hide();
		$("#chk_entrevista_previa_EN_label").hide();
		
		$("#f_entrevista_previa_EN").parent().parent().hide();
		$("#f_entrevista_previa_EN_label").hide();
					
		$("#usuario_entrevista_previa_EN").parent().hide();
		$("#usuario_entrevista_previa_EN_label").hide();		
		
		$("#abrirFranquiciado").hide();
		$("#ampliarResumir").hide();				
		
		$("#historial_empresa").parent().hide();
		$("#historial_empresa_label").hide();
		
		// Elimmnamos la opcion de capital sin entrevistar
		$("#capital option[value='7']").remove();		
	}

}

function controlTelefono(telefono, solId) {

	url = 'index.php?entryPoint=controlSolicitudes&valida=telefono&telefono=' + telefono.value + '&solId=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "valida=telefono&telefono=" + telefono.value + "&solId=" + solId,
		success : function(data) {
			if (data != '') {
				$("#phone_mobile").css("border", "2px solid red");
				if (data.length==36 && data.indexOf("-")!=-1) {
					if (confirm("El telefono ya esta asociado a otra solicitud, \n¿Desea abrirla?")) {
						//alert(data);
						window.open('index.php?module=Expan_Solicitud&action=EditView&record=' + data);
					}
				} else {
					alert("El telefono se corresponde con uno de los telefonos de la empresa/franquicia - "+ data + " Puede ser un topo")
				}
				return false;
			} else {
				$("#phone_mobile").css("border", "#94c1e8 solid 1px");
			}

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function getSectorFromFranq(franList) {
	
/*	var config = { };
	config.title = "Actualizando Sectores";
	config.msg = "Espere por favor... ";
	YAHOO.SUGAR.MessageBox.show(config);
*/
	url = "index.php?entryPoint=consultarFranquicia&tipo=SectorFromFranq" + "&nomFran=" + franList;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=SectorFromFranq" + "&nomFran=" + franList,
		success : function(data) {
			//alert(data);
			activarSectores(data);			
		//	YAHOO.SUGAR.MessageBox.hide();	
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido recpger el sector - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function activarSectores(listaSectoreStr){
	
	var listaSectNue=listaSectoreStr.split("|");
	var listaSectAnt=[];			
	var checkboxes = document.getElementsByClassName("Sectorcheck");
	
	for (var i = 0; i < checkboxes.length; i++) {
		if (checkboxes[i].checked == true){
			listaSectAnt.push(checkboxes[i].getAttribute("id"));
		}
	}
	
	var listaAct = $(listaSectNue).not(listaSectAnt).get();	
	var listaDes = $(listaSectAnt).not(listaSectNue).get();
		
	for (i in listaAct){		
		$( "input[id='"+listaAct[i]+"']" ).prop('checked', true);	
		if (i==listaAct.length-1 && listaDes.length==0 ){
			completoSector(listaAct[i],true,true);	
		}else{
			completoSector(listaAct[i],true,false);	
		}
		
	}
			
	for (i in listaDes){		
		$( "input[id='"+listaDes[i]+"']" ).prop('checked', false);	
		if (i==listaDes.length-1){
			completoSector(listaDes[i],false,true);	
		}else{
			completoSector(listaDes[i],false,false);	
		}	
	}	
	
	pintaFranFromSector();
	
}	


function getFranqFromSector(sectorList) {

	url = "index.php?entryPoint=consultarFranquicia&tipo=FranqFromSector" + "&nomSector=" + sectorList;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=FranqFromSector" + "&nomSector=" + sectorList,
		success : function(data) {
			//alert(data);

			colorearFranquicias(data);	
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido recpger el sector - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function colorearFranquicias(listaFranqStr){
	var listaFranq=listaFranqStr.split("|");			
	var checkboxes = document.getElementsByClassName("francheck");
	
	//Quitamos primero el color
	for (var i = 0; i < checkboxes.length; i++) {
		checkboxes[i].parentNode.style.backgroundColor = "";
	}
		
	for (i in listaFranq){		
		$( "input[id='"+listaFranq[i]+"']" ).parent().css( "background-color", "lightgreen");			
	}
			
}

function controlCorreos() {

	var idEmail = $("#Expan_Solicitud0emailAddressId0").val();
	var email = $("#Expan_Solicitud0emailAddress0").val();

	url = 'index.php?entryPoint=controlSolicitudes&valida=correo&idEmail=' + idEmail + '&email=' + email;
	$.ajax({
		type : "POST",
		url : url,
		data : "valida=correo&idEmail=" + idEmail + "&email=" + email,
		success : function(data) {
			if (data != '') {
				$("#Expan_Solicitud0emailAddress0").css("border", "2px solid red");
				if (confirm ("El correo ya esta asociado a otra solicitud, \n¿Desea abrirla?")){
					//alert(data);
					window.open ('index.php?module=Expan_Solicitud&action=EditView&record='+data);
				}							
				return false;
			} else {
				$("#Expan_Solicitud0emailAddress0").css("border", "#94c1e8 solid 1px");
			}

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido controlar la existencia de correo repetido - ' + textStatus + ' - ' + errorThrown);
		}
	});

}

function hasEventListener(element, eventName, namespace) {
	var returnValue = false;
	var events = $(element).data("events");
	if (events) {
		$.each(events, function(index, value) {
			if (index == eventName) {
				if (namespace) {
					$.each(value, function(index, value) {
						if (value.namespace == namespace) {
							returnValue = true;
							return false;
						}
					});
				} else {
					returnValue = true;
					return false;
				}
			}
		});
	}
	return returnValue;
}

function cambioSeleccion() {
	
	ocultarSuborigenes();

	varx = document.getElementById('tipo_origen');
	for ( i = 0; opt = varx.options[i]; i++) {
		if (opt.selected) {
			mostrarSuborigenes(varx.options[i].value);
		}
	}
		
	marcaCampos();
}

function ocultarSuborigenes() {

	var campo = document.getElementById("subor_expande_label");
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("subor_expande").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("portal_label").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("expan_evento_id_c_label").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("subor_central_label").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("subor_medios_label").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}
	
	var campo = document.getElementById("subor_mailing_label").parentNode;
	if (campo != null) {
		campo.style.display = 'none';
	}
	
}

function ocultarHistoricos(){
	$("#franquicia_historicos").parent().parent().hide();
	$("#sectores_historicos").parent().parent().hide();
	$("#empresa_temp").parent().parent().hide();
	$("#inicio_franq_hst").parent().parent().hide();
	$("#fin_franq_hst").parent().parent().hide();
	$("#franquicia_satisfa").parent().parent().hide();	
	$("#chk_empresa_provee").parent().parent().hide();
	$("#chk_empresa_cli_potencial").parent().parent().hide();
	$("#chk_empresa_competencia").parent().parent().hide();
	$("#chk_empresa_alianza").parent().parent().hide();				
}

function mostrarHistoricosFraquicia(){
	$("#franquicia_historicos").parent().parent().show();
	$("#sectores_historicos").parent().parent().show();
	$("#inicio_franq_hst").parent().parent().show();
	$("#fin_franq_hst").parent().parent().show();
	$("#franquicia_satisfa").parent().parent().show();					
}

function mostrarEsEmpresa(){
	$("#empresa_temp").parent().parent().show();
	$("#sectores_historicos").parent().parent().show();
	$("#chk_empresa_provee").parent().parent().show();
	$("#chk_empresa_cli_potencial").parent().parent().show();
	$("#chk_empresa_competencia").parent().parent().show();
	$("#chk_empresa_alianza").parent().parent().show();		
}

function mostrarSector(){
	$("#sectores_historicos").parent().parent().show();
}

function mostrarHistoricosEmpresa(){	
	$("#sectores_historicos").parent().parent().show();										
}

function actualizarHist(){
	ocultarHistoricos();
		
	$("#historial_empresa").each(function(){			
			
		if ($(this).val().indexOf("EF")!=-1 || 
			$(this).val().indexOf("EM")!=-1 ||
			$(this).val().indexOf("FF")!=-1){
			mostrarHistoricosFraquicia();
		}
		
		if(	$(this).val().indexOf("EA")!=-1 ||
			$(this).val().indexOf("NF")!=-1 ||
			$(this).val().indexOf("EE")!=-1 ){
			mostrarEsEmpresa();
		}
		
		if(	$(this).val().indexOf("FA")!=-1 ||
			$(this).val().indexOf("FE")!=-1 ){
			mostrarSector();
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


function esCreacion(){
	
	var creacion=false;
	var x = document.getElementsByClassName("pointer");
	
	if (x.length==0){
		creacion=true;
	}
	return creacion;
}

function mostrarSuborigenes(i) {
	if (i == 1) {
		var campo = document.getElementById("subor_expande_label");
		if (campo != null) {
			campo.style.display = '';
		}

		var campo = document.getElementById("subor_expande").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}

	if (i == 2) {
		var campo = document.getElementById("portal_label").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}

	if (i == 3) {
		var campo = document.getElementById("expan_evento_id_c_label").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}

	if (i == 4) {
		var campo = document.getElementById("subor_central_label").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}
	if (i == 5) {
		var campo = document.getElementById("subor_medios_label").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}

	if (i == 6) {
		var campo = document.getElementById("subor_mailing_label").parentNode;
		if (campo != null) {
			campo.style.display = '';
		}
	}

}

function marcaCampos(narcarEnt){
	
	$("#rating").css( "background-color", "	#FFFFCC" );
	$("#observaciones_solicitud").css( "background-color", "	#FFFFCC" );
	$("#perfil_profesional").css( "background-color", "	#FFFFCC" );
	$("#perfil_plurifranquiciado").css( "background-color", "	#FFFFCC" );
	$("#provincia_apertura_1").css( "background-color", "	#FFFFCC" );
	$("#localidad_apertura_1").css( "background-color", "	#FFFFCC" );
		
	$("#capital").css( "background-color", "	#FFFFCC" );
	$("#recursos_propios").css( "background-color", "	#FFFFCC" );
	$("#cuando_empezar").css( "background-color", "	#FFFFCC" );
	$("#busca_sector").css( "background-color", "	#FFFFCC" );	
	$("#perfil_franquicia").css( "background-color", "	#FFFFCC" );
	$("#situacion_profesional").css( "background-color", "	#FFFFCC" );
	$("#expan_evento_id_c").css( "background-color", "	#FFFFCC" );	
	
	var origenEvento=3;	
		
	if (origenSel(origenEvento)){
		$("#f_entrevista_previa_cliente").css( "background-color", "	#FFFFCC" );
		$("#f_entrevista_previa_EN").css( "background-color", "	#FFFFCC" );
	}else{
		$("#f_entrevista_previa_cliente").css( "background-color", "	#FFFFFF" );
		$("#f_entrevista_previa_EN").css( "background-color", "	#FFFFFF" );
	}
	
}

var tmrReady = setInterval(isPageFullyLoaded, 100);

function origenSel(tipoOrigen){
	
	varx = document.getElementById('tipo_origen');
	for ( i = 0; opt = varx.options[i]; i++) {
		if (opt.selected && tipoOrigen==opt.value) {
			return true;
		}
	}
	
	return false;
}
 
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
     };
}
  
function subclassForms() {
    for (var f = 0; f < document.forms.length; f++) {
        var frm = document.forms[f];
        frm.onsubmit = submitDisabled(frm, frm.onsubmit);
    }
}

function pasoAFranquiciado(solicitud) {

	var fran='';

	if (confirm("¿Está seguro que desea crear un franquiciado con los datos de esta solicitud?")) {

		url = 'index.php?entryPoint=franquiciado&accion=1&id=' + solicitud;
		$.ajax({
			type : "POST",
			url : url,
			data : "accion=1&id="+solicitud,
			success : function(data) {
				if (data =='') {//error
					alert('Ya existe el franquiciado');
					return false;
				} else{
					
					url = 'index.php?entryPoint=franquiciado&accion=2&id=' + solicitud;
					$.ajax({
						type : "POST",
						url : url,
						data : "accion=2&id="+solicitud,
						success : function(data) {
							if ( data=='') {//No se ha creado el franquiciado
								alert('No se ha podido crear el franquiciado - \\n' + data);
							} else {
								alert('Se ha creado el franquiciado correctamente');
							}

						},
						error : function(jqXHR, textStatus, errorThrown) {
							alert('No se ha podido crear el franquiciado - ' + textStatus + ' - ' + errorThrown);

						}
					});	
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido crear el franquiciado - ' + textStatus + ' - ' + errorThrown);

			}
		});
	
	} else {
		return false;
	}	

}

function mostrarCalendario(){
	$("#calReunion").show();
}

function buscarSector(nombreSector){	
	$(".Sectorcheck").each(function(){
		str= $(this).attr('id');
		console.log(str);
		if (str.toUpperCase().lastIndexOf(nombreSector.toUpperCase())!=-1){
			$(this).parent().css( "background-color", "orange");
			despliegoSector($(this).attr('name'));
		}
    });	
}

function limpiaBuscarSector(){
	$(".Sectorcheck").each(function(){
		str= $(this).attr('id');
		console.log(str);
		despliegoPliegoSector($(this).attr('name'));
	});
}

function limpiarSector(){	
	$(".Sectorcheck").each(function(){
		$(this).parent().css( "background-color", "");
    });	
}

function procesarReunion(solId){
	if (confirm("¿Está seguro que desea marcar reunion para todas las gestiones de la solicitud?")) {
					
		var fecha= $("#calReunion").val();
		
		url = 'index.php?entryPoint=controlSolicitudes';
		$.ajax({
			type : "POST",
			url : url,
			data : "valida=marcarReunion&solId="+solId+"&fecha="+fecha,
			success : function(data) {
				alert('Se han marcado las reuniones con éxito');				
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido marcar la reunion - ' + textStatus + ' - ' + errorThrown);
			}
		});
		
		$("#calReunion").hide();
		
	}	
}

function abrirFranquiciado(solId){
	
	url = 'index.php?entryPoint=franquiciado&accion=2&id=' + solId;
	$.ajax({
		type : "POST",
		url : url,
		data : "accion=abrir&id="+solId,
		success : function(data) {
			if ( data=='') {//No se ha creado el franquiciado
				alert('No hay franquiciado asociado');
			} else {
				window.open ('index.php?module=Expan_Franquiciado&action=EditView&record='+data);
			}

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido crear el franquiciado - ' + textStatus + ' - ' + errorThrown);

		}
	});		
}

function alternarVistaAmpli(){
	
	if ($("#ampliarResumir").val()=="Informacion Reducida"){
		$("#ampliarResumir").val("Informacion Ampliada");
		vistaMini();
	}else{
		$("#ampliarResumir").val("Informacion Reducida");
		vistaMaxi();
	}
	
}

function vistaMini(){
	
	$("#empresa").parent().hide();
	$("#empresa_label").hide();
	
	$("#skype").parent().parent().hide();
	$("#phone_work").parent().parent().hide();
	$("#linkedin").parent().parent().hide();
	$("#no_correos_c").parent().parent().hide();
	$("#do_not_call").parent().parent().hide();
	
	$("#no_newsletter").parent().parent().hide();
	$("#disp_contacto").parent().parent().hide();
	
	$("#master").parent().parent().hide();	
	$("#check_puertas_abiertas").parent().parent().hide();
	
	$("#fecha_primer_contacto").parent().hide();
	$("#fecha_primer_contacto_label").hide();
	$("#fecha_primer_contacto_trigger").hide();
	
	$("#primary_address_fieldset").hide();
	$("#contacto_secundario").parent().parent().hide();
	$("#phone_other").parent().parent().hide();
	$("#oportunidad_inmediata").parent().parent().hide();
	
	$("#provincia_apertura_3").parent().parent().hide();
	
	$("#zona").parent().hide();
	$("#zona_label").hide();
	
	$("#chk_entrevista_previa_cliente").parent().parent().hide();
	$("#f_entrevista_previa_cliente").parent().parent().parent().hide();
	$("#usuario_entrevista_previa_cliente").parent().parent().hide();
	
	$("#historial_empresa_multiselect").parent().hide();
	$("#historial_empresa_label").hide();
	
	$("#rrss").parent().parent().hide();
	
	$("#recursos_propios").parent().parent().hide();
	
	$("#_label").hide();
	
	$("#direccion_local2").parent().parent().hide();
	$("#ubicacion_local2").parent().parent().hide();
	$("#descripcion_local2").parent().parent().hide();
	
	$("#direccion_local3").parent().parent().hide();
	$("#ubicacion_local3").parent().parent().hide();
	$("#descripcion_local3").parent().parent().hide();
	
	$("#direccion_local").parent().hide();
	$("#direccion_local_label").hide();
	
	$("#ubicacion_local1").parent().hide();
	$("#ubicacion_local1_label").hide();
	
	$("#tab3").hide();
		
}

function vistaMaxi(){
	
	$("#empresa").parent().show();
	$("#empresa_label").show();
	
	$("#skype").parent().parent().show();
	$("#phone_work").parent().parent().show();
	$("#linkedin").parent().parent().show();
	$("#no_correos_c").parent().parent().show();
	$("#do_not_call").parent().parent().show();
	
	$("#no_newsletter").parent().parent().show();
	$("#disp_contacto").parent().parent().show();
	
	$("#master").parent().parent().show();	
	$("#check_puertas_abiertas").parent().parent().show();
	
	$("#fecha_primer_contacto").parent().show();
	$("#fecha_primer_contacto_label").show();
	$("#fecha_primer_contacto_trigger").show();
	
	$("#primary_address_fieldset").show();
	$("#contacto_secundario").parent().parent().show();
	$("#phone_other").parent().parent().show();
	$("#oportunidad_inmediata").parent().parent().show();
	
	$("#provincia_apertura_3").parent().parent().show();
	
	$("#zona").parent().show();
	$("#zona_label").show();
	
	$("#chk_entrevista_previa_cliente").parent().parent().show();
	$("#f_entrevista_previa_cliente").parent().parent().parent().show();
	$("#usuario_entrevista_previa_cliente").parent().parent().show();
	
	$("#historial_empresa_multiselect").parent().show();
	$("#historial_empresa_label").show();
	
	$("#rrss").parent().parent().show();
	
	$("#recursos_propios").parent().parent().show();
	
	$("#_label").show();
	
	$("#direccion_local2").parent().parent().show();
	$("#ubicacion_local2").parent().parent().show();
	$("#descripcion_local2").parent().parent().show();
	
	$("#direccion_local3").parent().parent().show();
	$("#ubicacion_local3").parent().parent().show();
	$("#descripcion_local3").parent().parent().show();
	
	$("#direccion_local").parent().show();
	$("#direccion_local_label").show();
	
	$("#ubicacion_local1").parent().show();
	$("#ubicacion_local1_label").show();
	
	$("#tab3").show();
		
}

function activarFecha(check, fecha) {

	if ($(check).is(':checked')) {
		$(fecha).val(Hoy());

	} else {
		$(fecha).val("");
	}

}

function Hoy() {
	var f = new Date();
	return pad(f.getDate(), 2) + "/" + pad(f.getMonth() + 1, 2) + "/" + f.getFullYear();
}

function pad(n, width, z) {
	z = z || '0';
	n = n + '';
	return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
