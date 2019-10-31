/**
 * @author Penlopjo
 */

colorearAvanzado();
colorearCaliente();
colorearPositivo();
cargarDocumentos();
coloreaBotonesCx();
activarDesBotonesCx();
//boldCentral();

var gestionID=getSearchParams('record');
//abrirSolicitud(gestionID,"DetailView");

function getSearchParams(k){
 var p={};
 decodeURIComponent(location.href).replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v});
 return k?p[k]:p;
}

function boldCentral(){
	if ($("#chk_gestionado_central_span").is(':checked')){
		$("#chk_gestionado_central_span").parent().css("font-weight","Bold");
		alert("Entra Negrita");
	}else{
		$("#chk_gestionado_central_span").parent().css("font-weight","Bold");
		alert("Entra Limpio");
	}	
}

function colorearAvanzado(){			
	
	var cdudas = document.getElementById("chk_resolucion_dudas_detailblock");	
	var ccuestionario = document.getElementById("chk_recepcio_cuestionario_detailblock");
	var cadicional = document.getElementById("chk_informacion_adicional_detailblock");
	var cautocentral = document.getElementById("chk_autoriza_central_detailblock");	
	var centrevista = document.getElementById("chk_entrevista_detailblock");
	var czona = document.getElementById("chk_propuesta_zona_detailblock");
	var cavanzada = document.getElementById("candidatura_avanzada_detailblock");
	var cavanzadal = document.getElementById("candidatura_avanzada_detailblock");
	$(cavanzadal).css( "background-color", "rgb(236,234,234)");	
	
	var lista = new Array (cdudas, ccuestionario, cadicional, cautocentral, centrevista, czona, cavanzada);
	
	//Quitamos primero el color
	for (var i = 0; i < lista.length; i++) {
		$(lista[i]).parent().css( "background-color", "");
	}
	
	for (i in lista){
		$(lista[i]).parent().css( "background-color", "rgb(236,234,234)");			
	}
}

function colorearCaliente(){			
	var cvisitado = document.getElementById("chk_visitado_fran_detailblock");
	var cprecontrato= document.getElementById("chk_envio_precontrato_detailblock");
	var clocal = document.getElementById("chk_visita_local_detailblock");
	var copautoriza = document.getElementById("chk_operacion_autorizada_detailblock");	
	var cprecontratop = document.getElementById("chk_envio_precontrato_personal_detailblock");
	var cprefirmado = document.getElementById("chk_precontrato_firmado_detailblock");	
	var cplanpersonal = document.getElementById("chk_envio_plan_financiero_personal_detailblock");
	var caprobalocal = document.getElementById("chk_aprobacion_local_detailblock");
	var cvisita = document.getElementById("chk_visita_central_detailblock");
	var ccolabora = document.getElementById("chk_posible_colabora_detailblock");	
	var ccaliente = document.getElementById("candidatura_caliente_detailblock");
	var ccalientel = document.getElementById("candidatura_caliente_detailblock");
	
	$(ccalientel).css( "background-color", "rgb(219,217,217)");	
	
	var lista = new Array (cvisitado, cprecontrato, clocal, copautoriza, cprecontratop, 
		cprefirmado, cplanpersonal, caprobalocal, cvisita, ccolabora, ccaliente);
	
	//Quitamos primero el color
	for (var i = 0; i < lista.length; i++) {
		$(lista[i]).parent().css( "background-color", "");
	}
	
	for (i in lista){
		$(lista[i]).parent().css( "background-color", "rgb(219,217,217)");			
	}
}

function colorearPositivo(){
	
	var ccontratop = document.getElementById("chk_envio_contrato_personal_detailblock");
	var ccontratofirma = document.getElementById("chk_contrato_firmado_detailblock");
	var cvisita = document.getElementById("chk_visita_central_detailblock");
	var cplanpersonal = document.getElementById("chk_envio_plan_financiero_personal_detailblock");
	var caprobalocal = document.getElementById("chk_aprobacion_local_detailblock");
	var ccontrato = document.getElementById("chk_envio_contrato_detailblock");
	var cprefirmado = document.getElementById("chk_precontrato_firmado_detailblock");
	
	var lista = new Array (ccontratop,ccontratofirma,cvisita,cplanpersonal,caprobalocal,ccontrato,cprefirmado);
	
	//Quitamos primero el color
	for (var i = 0; i < lista.length; i++) {
		$(lista[i]).parent().css( "background-color", "");
	}
	
	for (i in lista){
		$(lista[i]).parent().css( "background-color", "rgb(128,128,128)");			
	}
	
}

function cargarDocumentos(){
	var gestId = $('[name="record"]').val();	
	addPanelDocumentosEnviadosGestion(gestId);	
}

function addPanelDocumentosRecibidosGestion(gestId){
	
	url = 'index.php?entryPoint=consultarGestion&tipo=RecogeDocumentosRecibidosGestion&gestId=' + gestId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeDocumentosRecibidosGestion&gestId=" + gestId,
		success : function(data) {								
			var parse = JSON.parse(data);				
			var array=documentosGestionJsonToArray(parse);
			
			var div= $('<div/>',
		    {
		        id: 'DocumentosRecibidos',        
		        class:'subpanelTabForm H3',
		        html:'<H3>Documentos Recibidos</H3>',
		    });       
				
			tabla=generateTable(array);																					
			div.append(tabla);
			$("#DocumentosEnviados").after(div);		

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar documentos recibidos - ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function addPanelDocumentosEnviadosGestion(gestId){
	
	url = 'index.php?entryPoint=consultarGestion&tipo=RecogeDocumentosEnviadosGestion&gestId=' + gestId;
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=RecogeDocumentosEnviadosGestion&gestId=" + gestId,
		success : function(data) {		
			var parse = JSON.parse(data);				
			var array=documentosGestionJsonToArray(parse);
			
			var div= $('<div/>',
		    {
		        id: 'DocumentosEnviados',        
		        class:'subpanelTabForm H3',
		        html:'<H3>Documentos Enviados</H3>',
		    });       
				
			tabla=generateTable(array);																					
			div.append(tabla);
			$("#whole_subpanel_history").after(div);	
			addPanelDocumentosRecibidosGestion(gestId);		

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar documentos enviados - ' + textStatus + ' - ' + errorThrown);
		}
	});	
}

function documentosGestionJsonToArray(Json, contipo) {

	var array = [];

	var arrayIntIni = [];

	if (contipo) {
		arrayIntIni.push('Tipo');
	}
	arrayIntIni.push('Fecha');
	arrayIntIni.push('Documento');


	arrayIntIni.push('');
	array.push(arrayIntIni);

	for (var i in Json) {
		var arrayInt = [];

		arrayInt.push('<img src="themes/Sugar5/images/Documents.gif?v=1DGI1bi-PiFYhwpnWfZEfg" border="0" alt="Llamadas">');
		arrayInt.push(Json[i].Documento);
		arrayInt.push(Json[i].Fecha);
		if (contipo){
			arrayInt.push(Json[i].tipo);
		}

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

function unescapeHTML(escapedHTML) {
	if (escapedHTML==null){
		return null;
	}else{
		return escapedHTML.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&').replace(/&quot;/g,'');
	}  
}

function abrirSolicitud(gestion,mode) {

	url = 'index.php?entryPoint=recogeSolicitud&gestion=' + gestion;
	$.ajax({
		type : "POST",
		url : url,
		data : "gestion=" + gestion,
		success : function(data) {	
			if(data!=""){//se trata de una gestion				
				window.open('index.php?module=Expan_Solicitud&action='+mode+'&record=' + data,data);
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se han podido abrir para edidion la solicitud y la gestion asociada - ' + textStatus + ' - ' + errorThrown);
		}
	});
}

function coloreaBotonesCx(){
	var cxs=["C1","C2","C3","C4","C1.1","C1.2","C1.3","C1.4","C1.5"];

	var gestId = $('[name="record"]').val();
	url = 'index.php?entryPoint=consultarGestion';

	cxs.forEach(function (valor) {
		$.ajax({
			type: "POST",
			url: url,
			data: "tipo=colorBotonesReenvio&cx="+valor+"&gestId=" + gestId,
			success: function (data) {
				if (data=='style="color:#0000FF;"'){
					$("#reenvio"+valor.replace(".","_")).css("color","blue");
				}else{
					$("#reenvio"+valor.replace(".","_")).css("color","red");
				}
			},
		});
	})
}

function activarDesBotonesCx(){
	var cxs=["C1","C2","C3","C4","C1.1","C1.2","C1.3","C1.4","C1.5"];

	var gestId = $('[name="record"]').val();
	url = 'index.php?entryPoint=consultarGestion';

	cxs.forEach(function (valor) {
		$.ajax({
			type: "POST",
			url: url,
			data: "tipo=actDesBotonesReenvio&cx="+valor+"&gestId=" + gestId,
			success: function (data) {
				if (data==0){
					$("#reenvio"+valor.replace(".","_")).prop( "disabled", true )
				}else{
					$("#reenvio"+valor.replace(".","_")).prop( "disabled", false )
				}
			},
		});
	})
}