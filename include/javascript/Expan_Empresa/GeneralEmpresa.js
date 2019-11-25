function getListaCompetidores() {

    //Recogemos la lista de competidores a cambiar

    var lista = document.getElementsByClassName("checkbox");

    var idCompetidores = "";
    var prim = true;

    var CHK_STR = "checkbox_display_prueba-";

    for (i = 0; i < lista.length; i++) {
        if (lista[i].checked == true && lista[i].name.indexOf(CHK_STR) != -1) {
            if (prim == true) {
                idCompetidores = lista[i].name.replace(CHK_STR, "");
            } else {
                idCompetidores = idCompetidores + "#" + lista[i].name.replace(CHK_STR, "");
            }
            prim = false;
        }
    }

    return idCompetidores;
}

function renderProveedorTab() {
    if ($("#chk_es_proveedor_detailblock").is(':checked')) {

        $("a:contains('Datos Proveedor Generales')").show();
        if ($("#chk_proveedor_cliente").is(':checked')){
            $("a:contains('Datos Proveedor por Franquicia')").show();
        }else{
            $("a:contains('Datos Proveedor por Franquicia')").hide();
        }
    } else {
        $("a:contains('Datos Proveedor Generales')").hide();
        $("a:contains('Datos Proveedor por Franquicia')").hide();
    }
}