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
		for (var j = 0; j < listaFran.length; j++){
			if (listaSel[k]==listaFran[j].text){
				listaFran[j].selected = true;	
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
		for (var i=0; i < checkboxes.length; i++){
			if (listaSel[k]==checkboxes[i].name){
				checkboxes[i].checked=true;
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
				} else{
					alert('No se ha podido realizar el envío del correo, pero se ha creado la llamada - \\n '+data);
					return false;
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
