document.addEventListener("DOMContentLoaded", function(event) {
    renderSectores();
});

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
    var listaFran = document.getElementsByName("sector_advanced[]")[0];
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
        for (var l = 0; l < listaFran.length; l++) {
            if (listaSel[k] == listaFran[l].text) {
                listaFran[l].selected = true;
            }
        }
    }
}