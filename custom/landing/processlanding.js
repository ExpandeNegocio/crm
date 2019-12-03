
function registerAction(idGest,accion,doc){
    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=mailingGest&idGest='+ idGest +
        '&accion=' + accion + '&doc='+ doc ;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "idGest="+ idGest + "&" +
            "accion=" + accion,
    });
}
function cargaLanding(idGest) {
    registerAction(idGest,"OL","");
}

function acceptPrivPolitics(idDoc,idGest){

    if ($("#chkAccept").prop('checked')){
        downloadfile(idDoc,idGest);
    }else{
        alert("Para poder descargar el dossier es necesario aceptar las condiciones");
    }

    return false;
}

function downloadfile(idDoc,idGest){

    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=downloadDoc&idDoc='+ idDoc + '&' +
    'idGest=' + idGest;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "idDoc="+ idDoc + "&" +
            "idGest=" + idGest,

        success : function(data) {

            if ( data.resp != "") {
                registerAction(idGest,"DF",data.resp);
                window.location = "https://www.expandenegocio.com/sugarcrm/upload/"+data.resp;
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido descargar el documento - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

function unsubscribe(gestId){

    var sel=false;

    if ($("#chkExpande").prop('checked')){
        registerAction(gestId,"BE","");
        sel=true;
    }
    if ($("#chkFranquicia").prop('checked')){
        registerAction(gestId,"BF","");
        sel=true;
    }

    if (sel){
        url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=unsubscribeEmail&gestId='+ gestId;
        $.ajax({
            type : "GET",
            url : url,
            dataType: 'jsonp',
            crossDomain: true,
            data : "gestId="+ gestId,

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