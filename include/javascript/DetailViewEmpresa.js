

coloreaSectores();

function coloreaSectores(){
	
	url='index.php?entryPoint=herramientas';
	$.ajax({
		type : "POST",
		url : url,
		data : "tipo=getSectorComp&tipoComp=CD",
		success : function(data) {	
			
			if (data!=''){								
				
				data=data.replace("^","");			
				var listSector=data.split(",");	
				
				for (var i=0; i < listSector.length; i++) {
					var sector=listSector[i] ;
					$('li').filter(function() { return $.text([this]) === sector; }).css("background-color","green");
   				} 

			}				
		},
		error : function(jqXHR, textStatus, errorThrown) {			
			alert ('Error pintando sectores');			
		}
	});
	

}