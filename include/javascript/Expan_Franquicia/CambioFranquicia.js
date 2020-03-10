var NO_CLIENTE=4;
$("#_detailblock").hide();

noShowNoCliente();

function noShowNoCliente() {

	if ($("#tipo_cuenta").val()==NO_CLIENTE){
		if ($("#chk_es_proveedor").is(':checked')==false &&
			$("#chk_es_cliente_potencial").is(':checked')==false &&
			$("#chk_es_competidor").is(':checked')==false){
			ocultaNoCLiente();
		} else{
			ocultaNoCLienterel();
		}
	}else{
		muestraCliente();
	}


}

function muestraCliente(){
	$("#tab0").show();
	$("#tab1").show();
	$("#tab7").show();

	$("#tab2").show();
	$("#tab3").show();
	$("#tab4").show();
	$("#tab5").show();
	$("#tab6").show();
	$("#tab8").show();
	$("#tab9").show();
	$("#tab10").show();
	$("#tab11").show();
	$("#tab12").show();
	$("#tab13").show();
	$("#tab14").show();
	$("#tab15").show();
}

function ocultaNoCLiente(){

	$("#tab0").show();
	$("#tab1").show();
	$("#tab7").show();

	$("#tab2").hide();
	$("#tab3").hide();
	$("#tab4").hide();
	$("#tab5").hide();
	$("#tab6").hide();
	$("#tab8").hide();
	$("#tab9").hide();
	$("#tab10").hide();
	$("#tab11").hide();
	$("#tab12").hide();
	$("#tab13").hide();
	$("#tab14").hide();
	$("#tab15").hide();
}

function ocultaNoCLienterel(){

	$("#tab0").show();
	$("#tab1").show();
	$("#tab7").show();

	$("#tab2").hide();
	$("#tab3").hide();
	$("#tab4").hide();
	$("#tab5").hide();
	$("#tab6").hide();
	$("#tab8").hide();
	$("#tab9").hide();
	$("#tab10").hide();
	$("#tab11").hide();
	$("#tab12").show();
	$("#tab13").show();
	$("#tab14").show();
	$("#tab15").show();
}

function cambiocheck()
{

	var checkboxes = document.getElementsByClassName("francheck");
	var listaFran = document.getElementById("fran_buenas");
	var listaSel=[];

	//Actualizamos las listas para que esten en conformidad con los checkboxes

	for (var j = 0; j < listaFran.length; j++){
			listaFran[j].selected = false;
	}

	for (var i=0; i < checkboxes.length; i++){

		if (checkboxes[i].checked) {
			listaSel[listaSel.length]=checkboxes[i].name;
		}

	}

	for (var k = 0; k < listaSel.length; k++){
		for (var l = 0; j < listaFran.length; l++){
			if (trim(listaSel[k])==trim(listaFran[l].text)){
				listaFran[l].selected = true;
			}
		}
	}
}	

function display(){


	//Ocultamos la lista

	var campo=document.getElementById("fran_buenas_label");

	if (campo!=null){
		campo.parentNode.style.display='none';
	}


	var listaFran = document.getElementById("fran_buenas");
	var checkboxes = document.getElementsByClassName("francheck");
	var listaSel=[];

	//Limpiamos los Check Boxes
	
	for (var i=0; i < checkboxes.length; i++){
		checkboxes[i].checked=false;

	}

	//Recogemos los valores seleccionados
	for (var j = 0; j < listaFran.length; j++){
		
		if (listaFran[j].selected){
			listaSel[listaSel.length]=listaFran[j].text;
		}
	}

	for (var k = 0; k < listaSel.length; k++){
		for (var l=0; i < checkboxes.length; i++){
			if (listaSel[k]==checkboxes[l].name){
				checkboxes[l].checked=true;
			}
		}
	}

}
function envioPuertasAbiertas(franquicia){
	//estoy aqui
	var fran='';

	if (confirm("¿Está seguro que desea realizar el envío de puertas abiertas?")) {

		url = 'index.php?entryPoint=envioPuertasAbiertas&idFran=' + franquicia;
		$.ajax({
			type : "POST",
			url : url,
			data : "idFran="+franquicia,
			success : function(data) {
				if (data.indexOf('Ok')!=-1) {//error
					alert('Se ha realizado el envío correctamente');
					return false;
				} else
				{
					if(data==''){
						alert('No existen interesados a los que no se les haya enviado el mensaje - \\n '+data);
						return false;
					}else{
						alert('No se ha podido realizar el envío del correo, pero se ha creado la llamada - \\n '+data);
					return false;
					}
				}

			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('No se ha podido realizar el envío de correo, pero se ha creado la llamada - ' + textStatus + ' - ' + errorThrown);

			}
		});
	
	} else {
		return false;
	}
	
}

function abrirEmpresa(franquicia){
	url = 'index.php?entryPoint=consultarFranquicia';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=ConsultarEmpresa&" +
			"id=" + franquicia,
		success : function(data) {
			if (data!=""){
				window.open('index.php?module=Expan_Empresa&action=DetailView&record=' + data);
			}else{
				alert("No hay empresa asociada a la franquicia");
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
			alert('Np se ha podido abrir la empresa - ' + textStatus + ' - ' + errorThrown);
		}
	});
	return false;
}
