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

function cambiarCompPrincipal(activo) {

    if (confirm("¿Esta seguro de que quieres cambiar el competidor principal?")) {

        var idCompetidores = getListaCompetidores();
        var idEempresa = $("input[name$=\"record\"]").val();

        url = "index.php?entryPoint=consultarEmpresa";
        $.ajax({
            type: "POST",
            url: url,
            data: "tipo=CompetidorPrincipal" + "&idEmpresa=" + idEempresa + "&idCompetidores=" + idCompetidores+ "&activo=" + activo,
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.toUpperCase() == "OK") {
                    document.location.reload();
                } else {
                    alert("No se han podido cambiar el competidor principal " + estado);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el competidor principal - " + textStatus + " - " + errorThrown);
            }
        });

    } else {
        return false;
    }

}