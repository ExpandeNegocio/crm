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