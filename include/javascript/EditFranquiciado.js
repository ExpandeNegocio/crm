/**
 * @author Penlopjo
 */
$("#franquicia").keyup(function(){//cuando pulses la caja de texto
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
				$('#sugerencias').fadeIn(500).html(data);
				$('.sug').live('click', function(){//cuando se pulsa una
					var fran=$(this).text();
					if(longi==1){//borrar todo y sustituir por el nuevo valor
						$('#franquicia').val(fran);//editar input
					}else{//poner las anteriores, y después la nueva
						$('#franquicia').val(franqHastaUlComa+fran);
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