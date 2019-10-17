
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
        registerAction(idGest,"DF",idDoc);
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
                window.location = "https://www.expandenegocio.com/sugarcrm/upload/"+data.resp;
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido descargar el documento - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

function unsubscribe(solId){
    url = 'https://www.expandenegocio.com/sugarcrm/index.php?entryPoint=unsubscribeEmail&solId='+ solId;
    $.ajax({
        type : "GET",
        url : url,
        dataType: 'jsonp',
        crossDomain: true,
        data : "solId="+ solId,

        success : function(data) {

            if ( data.resp != "") {
                window.location = "https://www.expandenegocio.com/sugarcrm/upload/"+data.resp;
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            alert('No se ha podido descargar el documento - ' + textStatus + ' - ' + errorThrown);
        }
    });
}