var ACTIVATE = "AC";
var BAJA_EXPANDE = "BE";
var BAJA_FRANQUICIA = "BF";
var DESCARGA_FICHERO = "DF";
var OPEN_LANDING = "OL";

function registerAction(idGest,accion,doc,idTemplate,idMailing){
    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=mailingGest&idGest='+ idGest +
        '&accion=' + accion + '&doc='+ doc +   "&idTemplate=" + idTemplate + "&idMailing" + idMailing ;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "idGest="+ idGest + "&" +
            "accion=" + accion + "&" +
            "doc=" +doc + "&" +
            "idTemplate=" + idTemplate + "&" +
            "idMailing" + idMailing,
    });
}
function cargaLanding(idGest) {
    registerAction(idGest,OPEN_LANDING,"");
}

function acceptPrivPolitics(idDoc,idGest){

    if ($("#chkAccept").prop('checked')){
        downloadfile(idDoc,idGest);
    }else{
        alert("Para poder descargar el dossier es necesario aceptar las condiciones");
    }

    return false;
}

function acceptPrivPoliticsURL(url,idGest){

    if ($("#chkAccept").prop('checked')){
        window.open(url);
    }else{
        alert("Para poder acceder a la web es necesario aceptar las condiciones");
    }

    return false;
}

function downloadfile(idDoc,idGest,idTemplate,idMailing){

    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=downloadDoc&idDoc='+ idDoc + '&' +
    'idGest=' + idGest
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "idDoc="+ idDoc + "&" +
            "idGest=" + idGest,

        success : function(data) {

            if ( data.resp != "") {
                registerAction(idGest,DESCARGA_FICHERO,data.resp,idTemplate,idMailing);
                window.location = "https://www.expandenegocio.com/sugarcrm/upload/"+data.resp;
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido descargar el documento - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

function activate(idGest,idTemplate,idMailing){

    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=activateGest&idGest='+ idGest;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "idGest="+ idGest ,

        success : function(data) {

            if ( data.resp != "") {
                registerAction(idGest,ACTIVATE,"",idTemplate,idMailing);
               // alert("Se ha reactivado susolicitud");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
        }
    });
}

function unsubscribe(gestId){

    var sel=false;

    if ($("#chkExpande").prop('checked')){
        registerAction(gestId,BAJA_EXPANDE,"");
        sel=true;
    }
    if ($("#chkFranquicia").prop('checked')){
        registerAction(gestId,BAJA_FRANQUICIA,"");
        sel=true;
    }

    if (sel){
        url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=unsubscribeEmail&tipo=gestionid&gestId='+ gestId;
        $.ajax({
            type : "GET",
            url : url,
            dataType: 'jsonp',
            crossDomain: true,
            data : "tipo=gestionid&gestId="+ gestId,

            success : function(data) {

                if ( data.resp != "") {
                    alert("La solicitud de baja se ha procesado con exito");
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert('No se ha podido dar de baja el usuario - ' + textStatus + ' - ' + errorThrown);
            }
        });
    }else{
        alert('Es necesario seleccionar alguno de las opciones para dar de baja la cuenta de correo');
    }
}

function unsubscribeEmail(){

    var correo=$("#email").val();

    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=unsubscribeEmail&tipo=email&email='+ correo;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "tipo=email&email="+ correo,

        success : function(data) {

            if ( data.resp != "") {
                alert("El correo " + correo +" se ha dado de baja con exito");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido dar de baja el usuario - ' + textStatus + ' - ' + errorThrown);
        }
    });

}