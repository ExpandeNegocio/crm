function OcultarCreacionListado() {

	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Meetings&action=EditView&return_module=Meetings&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Meetings&return_module=Meetings&return_action=index']").hide();

}

function OcultarCreacionEdicion() {

	$('#create_link').hide();
	$('#create_image').hide();

	$("[href='index.php?module=Meetings&action=EditView&return_module=Meetings&return_action=DetailView']").hide();
	$("[href='index.php?module=Import&action=Step1&import_module=Meetings&return_module=Meetings&return_action=index']").hide();
	
	$( "#oportunidad_inmediata" ).click(function() {		
		if (document.getElementById('oportunidad_inmediata').checked){			
			alert( "Revisar el Rating de la solicitud asociada" );
		}  		
	});	
	deactivateModifiedName();
	
	$("#status").bind("change", function() {
		if (document.getElementById("status").value=='Could'){			
			//$("#date_start_label").hide();
			//$("#date_end_label").hide();	
			$("#date_start_date").parent().parent().hide();	
			$("#date_end_date").parent().parent().hide();					
		}else{
			$("#date_start_label").show();
			$("#date_end_label").show();
			$("#date_start_date").parent().parent().show();	
			$("#date_end_date").parent().parent().show();		
		}
	});
	
}

function deactivateModifiedName(){	
	$("#btn_modified_by_name").hide();
	$("#btn_clr_modified_by_name").hide();
	$("#modified_by_name").prop('disabled', true);
	
	getSkype();	
}

function getSkype() {
			
	var idGestion=$("#form_SubpanelQuickCreate_Meetings > table > tbody > tr > td.buttons > input[type='hidden']:nth-child(11)").val();

	url='index.php?entryPoint=recogeSkypeGestion&id=' + idGestion;
	$.ajax({
		type : "POST",
		url : url,
		data : "id=" + idGestion,
		success : function(data) {						
			$("#skype").val(data);				
		},
		error : function(jqXHR, textStatus, errorThrown) {					
		}
	});
}