/**
 * @author Penlopjo
 */

const BORDE_NORMAL="#94c1e8 solid 1px";

		
		$("#pais_c").change(function(){
			var valor=$(this).val();
			if(valor!="SPAIN"){//es master
				$("#master").prop("checked", true);
				$("#provincia_residencia_label").parent().show();
			}else{
				$("#master").prop("checked", false);
				$("#provincia_residencia_label").parent().hide();
			}
			
		}),
		
		$("#provincia_residencia").change(function(){
			var valor=$(this).val();
			if(valor!="100"){
				$("#localidad_residencia").prop("disabled", true);
			}else{
				$("#localidad_residencia").prop("disabled", false);
			}
			
		}),
		

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
			
			var dataFran="franquicias="+franqSE;
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataFran,
			success: function(data){
				$('#sugerencias').fadeIn(1000).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#franquicias_contactadas').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#franquicias_contactadas').val(franqHastaUlComa+fran);
					}
					
					$('#sugerencias').fadeOut(1000);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias si se pulsa en otro sitio
					$('#sugerencias').fadeOut(1000);
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
			
			var dataFran="franquicias="+franqSE;
		
		//llamada ajax
		$.ajax({
			type:"POST",
			url:"index.php?entryPoint=RecogeSugerencias",
			data: dataFran,
			success: function(data){
				$('#sugerenciasO').fadeIn(1000).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#otras_franquicias').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#otras_franquicias').val(franqHastaUlComa+fran);
					}
					
					$('#sugerenciasO').fadeOut(1000);//quitar las sugerencias
				});
				
				$('#detailpanel_3').live('click', function(){//que se cierre el cuadro de sugerencias en caso de pulsar fuera
					$('#sugerenciasO').fadeOut(1000);
				});
			}
		});
		}
	});

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

	
}

function validarSubOrigen() {	
	
	
	var Nombre= document.getElementById("first_name");
	var Apellidos= document.getElementById("last_name");
	
	var Origen = document.getElementById("tipo_origen");
	var optPortal = document.getElementById("portal");
	var optEvento = document.getElementById("expan_evento_id_c");
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
		
		if (o.selected == true && o.value == 1 && rating == "" && esCreacion()) {
			$("#rating").css("border", "2px solid red");
			alert("El rating es obligatorio si el origen es expandenegocio");
			return false;
		}else {
			$("#rating").css("border", "#94c1e8 solid 1px");
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
			
		//Miramos si el estamos ante una consulta
		if ($("#btn_view_change_log")!=null){
			if ($("#btn_view_change_log").is(":visible")){
				alert ("Revisar el origen");
			}		
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
	
	pintaFranFromSector();
}

function despliegoSector(nombreSector){	
	
	document.getElementById(nombreSector.split('_').join(' ')).checked=true;
	
	nombreSector=nombreSector.split(' ').join('_');
	
	
	CamposImput = document.getElementsByName(nombreSector);

	for (var i = 0; i < CamposImput.length; i++) {					
		CamposImput[i].parentNode.style.display=null;		
	}
	
	pintaFranFromSector();
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
		
		//Seleccionamos el origen (feria) y Suborigen (SIF VAlencia 2015)
		
		var campo = document.getElementById("tipo_origen");
		if (campo != null) {
			campo.value=3;
		}
	/*	
		var campo = document.getElementById("expan_evento_id_c");
		if (campo != null) {
			campo.value='e83f0799-7be6-911d-5dd1-55fa79927f78';
		}
		
		
		var campo = document.getElementById("tipo_origen_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}
		
	
		var campo = document.getElementById("capital_observaciones_label").parentNode;
		if (campo != null) {
			campo.style.display = 'none';
		}*/
		
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
		
		var campo = document.getElementById("subor_medios_label").parentNode;
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
				if (confirm ("El telefono ya esta asociado a otra solicitud, \n¿Desea abrirla?")){
					//alert(data);
					window.open ('index.php?module=Expan_Solicitud&action=EditView&record='+data);
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
}

function ocultarSuborigenes() {

	var campo = document.getElementById("subor_expande_label");
	if (campo != null) {
		campo.style.display = 'none';
	}

	var campo = document.getElementById("subor_expande");
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

		var campo = document.getElementById("subor_expande");
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

function marcaCampos(){
	
	$("#rating").css( "background-color", "	#FFFFCC" );
	$("#observaciones_solicitud").css( "background-color", "	#FFFFCC" );
	$("#perfil_profesional").css( "background-color", "	#FFFFCC" );
	$("#perfil_plurifranquiciado").css( "background-color", "	#FFFFCC" );
	$("#provincia_apertura_1").css( "background-color", "	#FFFFCC" );
	$("#localidad_apertura_1").css( "background-color", "	#FFFFCC" );
	
	$("#perfil_franquicia").css( "background-color", "	#FFFFCC" );
	$("#situacion_profesional").css( "background-color", "	#FFFFCC" );
	$("#expan_evento_id_c").css( "background-color", "	#FFFFCC" );
	
}

function pasoAFranquiciado(solicitud) {

	var fran='';

	if (confirm("¿Está seguro que desea crear un franquiciado?")) {

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

