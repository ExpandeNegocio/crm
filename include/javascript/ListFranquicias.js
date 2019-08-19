/**
 * @author Penlopjo
 */

elemento = document.getElementById('InicioDocumentos');

if (elemento==null){

	renderSectores();
	addSearchAct();

	var div= $('<div/>',
    {
        id: 'InicioDocumentos',
        class:'subpanelTabForm',
    });

    $("#content").after(div);

	addPanelListaDocumentos();
}

function addPanelListaDocumentos(){

	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ListaDocumentos",
		success : function(data) {

			//alert (data);

			var parse = JSON.parse(data);
			var array=documentosJsonToArray(parse);
			var tabla=generateTable(array);

			elemento = document.getElementById('ListadoDocumentos');

			var div= $('<div/>',
		    {
		        id: 'ListadoDocumentos',
		        class:'subpanelTabForm',
		        html:'<H3>Documentos</H3>',
		    });

		    $("#content").after(div);

			div.append(tabla);
			addPanelListaValidacionPlantillas();

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar el panel de documentos - ' + textStatus + ' - ' + errorThrown);
		}
	});
}

function addPanelListaValidacionPlantillas(){

	url = 'index.php?entryPoint=consultarFranquicia&tipo=ValidacionPlantillas';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ValidacionPlantillas",
		success : function(data) {

			//alert (data);

			var parse = JSON.parse(data);
			var array=documentosJsonToArray(parse);
			var tabla=generateTable(array);

			elemento = document.getElementById('ListadoValidacionPlantillas');

			var div= $('<div/>',
		    {
		        id: 'ListadoValidacionPlantillas',
		        class:'subpanelTabForm',
		        html:'<H3>Validacion de plantillas</H3>',
		    });

		    $("#InicioDocumentos").after(div);

			div.append(tabla);

		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar el panel de validacion de plantillas - ' + textStatus + ' - ' + errorThrown);
		}
	});
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


function documentosJsonToArray(Json){

	var array=[];

	var arrayInt=[];

	arrayInt.push('Documentos C4');
	arrayInt.push('Documentos C3');
	arrayInt.push('Documentos C2');
	arrayInt.push('Documentos C1');
	arrayInt.push('Modelo Negocio');
	arrayInt.push('Franquicia');
	array.push(arrayInt);

	for(var i in Json) {

		var arrayInt=[];

		if (Json[i].ModeloNegocio==''){
			arrayInt.push('<b>'+Json[i].Franquicia+'</b>');
		}else{
			 arrayInt.push('');
		}
		/*arrayInt.push(Json[i].ModeloNegocio);
		if (Json[i].ValidadoC1==1){
			arrayInt.push('<p style="color:green;">'+Json[i].C1+'</p>');
		}else{
			arrayInt.push('<p style="color:red;">'+Json[i].C1+'</p>');
		}
		if (Json[i].ValidadoC2==1){
			arrayInt.push('<p style="color:green;">'+Json[i].C2+'</p>');
		}else{
			arrayInt.push('<p style="color:red;">'+Json[i].C2+'</p>');
		}
		if (Json[i].ValidadoC3==1){
			arrayInt.push('<p style="color:green;">'+Json[i].C3+'</p>');
		}else{
			arrayInt.push('<p style="color:red;">'+Json[i].C3+'</p>');
		}
		if (Json[i].ValidadoC2==1){
			arrayInt.push('<p style="color:green;">'+Json[i].C4+'</p>');
		}else{
			arrayInt.push('<p style="color:red;">'+Json[i].C4+'</p>');
		}		*/

		arrayInt.push(Json[i].ModeloNegocio);
		if (Json[i].ValidadoC1==1){
			arrayInt.push(Json[i].C1.replace(/###/g,"green"));
		}else{
			arrayInt.push(Json[i].C1.replace(/###/g,"red"));
		}
		if (Json[i].ValidadoC2==1){
			arrayInt.push(Json[i].C2.replace(/###/g,"green"));
		}else{
			arrayInt.push(Json[i].C2.replace(/###/g,"red"));
		}
		if (Json[i].ValidadoC3==1){
			arrayInt.push(Json[i].C3.replace(/###/g,"green"));
		}else{
			arrayInt.push(Json[i].C3.replace(/###/g,"red"));
		}
		if (Json[i].ValidadoC2==1){
			arrayInt.push(Json[i].C4.replace(/###/g,"green"));
		}else{
			arrayInt.push(Json[i].C4.replace(/###/g,"red"));
		}

		array.push(arrayInt);
	}

	return array;
}

function plantillasValidasJsonToArray(Json){

	var array=[];

	var arrayInt=[];

	arrayInt.push('Validacion C4');
	arrayInt.push('Validacion C3');
	arrayInt.push('Validacion C2');
	arrayInt.push('Validacion C1');
	arrayInt.push('Modelo Negocio');
	arrayInt.push('Franquicia');
	array.push(arrayInt);

	for(var i in Json) {

		var arrayInt=[];

		if (Json[i].ModeloNegocio==''){
			arrayInt.push('<b>'+Json[i].Franquicia+'</b>');
		}else{
			 arrayInt.push('');
		}

		arrayInt.push(Json[i].ModeloNegocio);

		arrayInt.push(Json[i].C1);
		arrayInt.push(Json[i].C2);
		arrayInt.push(Json[i].C3);
		arrayInt.push(Json[i].C4);
		array.push(arrayInt);
	}

	return array;
}


function unescapeHTML(escapedHTML) {
	if (escapedHTML==null){
		return null;
	}else{
		return escapedHTML.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&').replace(/&quot;/g,'');
	}
}

function renderSectores(){

	$("#sector_advanced").hide();

	url = 'index.php?entryPoint=consultarSectores';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getSectores",
		success : function(data) {
			var div= $('<div/>',
				{
					id: 'Sectores_div',
				});

			$("#sector_advanced").after(div);

			div.append(data);

			},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('No se ha podido cargar el panel de validacion de plantillas - ' + textStatus + ' - ' + errorThrown);
		}
	});
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
}

function cambiocheck(clase, id,act) {

	var checkboxes = document.getElementsByClassName(clase);
	var listaFran = document.getElementById("sector_advanced");
	var listaSel = [];

	//Actualizamos las listas para que esten en conformidad con los checkboxes

	for (var j = 0; j < listaFran.length; j++) {
		listaFran[j].selected = false;
	}

	for (var i = 0; i < checkboxes.length; i++) {

		if (checkboxes[i].checked) {
			listaSel[listaSel.length] = checkboxes[i].id;
		}

	}

	for (var k = 0; k < listaSel.length; k++) {
		for (var j = 0; j < listaFran.length; j++) {
			if (listaSel[k] == listaFran[j].text) {
				listaFran[j].selected = true;
			}
		}
	}
}
