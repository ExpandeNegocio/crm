$("#chk_es_proveedor").change(function () {
    renderProveedorTab();
});

$("#chk_proveedor_cliente").change(function () {
    renderProveedorTab();
});

$("#chk_es_competidor").change(function () {
    renderCompetidorTab();
});

$("#chk_es_cliente_potencial").change(function () {
    renderPropuestaTab();
    renderTrabajaConsultora();
});

$("#chk_alianza").change(function () {
    renderAlianzaTab();
});

$("#encaje_cliente").change(function () {
    renderMotivos();
});

$("#empresa_type").change(function () {
    renderTrabajaConsultora();
});

$("#estado_cp").change(function () {
    renderTipoPositivo();
});

$("#Expan_Empresa0emailAddress0").blur(function () {
    controlCorreos();
});

$("#name").blur(function () {
    controlNombre();
});

$("#noticias").bind("keyup", function () {
    if (window.event.keyCode == 13) {
        addFechaNoticias("");
    }
});

$("#chk_trabaja_consultora").change(function () {
    renderConsultora();
});

$("#provincia").change(function () {
    loadMunicipios();
});

$("#ccaa").change(function () {
    loadProvincias();
});

document.addEventListener("DOMContentLoaded", function (event) {
    renderProveedorTab();
    renderPropuestaTab();
    renderCompetidorTab();
    renderAlianzaTab();
    renderTrabajaConsultora();
    renderConsultora();
    renderTipoPositivo();
    marcarCamposImportantes();
    cargarchecks("Sectorcheck", "sector");
    fechaPrimerContactoHoy();
    renderMotivos();
    hide();
    refreshSn();
});

function renderMotivos() {
    if ($("#encaje_cliente option:selected").val() == "ne") {
        $("#motivo_no_encaja").parent().parent().show();
    } else {
        $("#motivo_no_encaja").parent().parent().hide();
    }

    if ($("#encaje_cliente option:selected").val() == "eng") {
        $("#motivo_no_gusta").parent().parent().show();
    } else {
        $("#motivo_no_gusta").parent().parent().hide();
    }
}

function hide() {
    $("#activities_correocandidato_button").hide();
    $("#sector_label").parent().hide();
    $("#mistery_list_fdo_label").hide();
    $("#mistery_list_central_label").hide();
    $("#mistery_insert_fdo_label").hide();
    $("#mistery_insert_central_label").hide();
}

function renderCompetidorTab() {
    if ($("#chk_es_competidor").is(':checked')) {
        $("a:contains('Datos competidor')").show();
    } else {
        $("a:contains('Datos competidor')").hide();
    }
}

function renderAlianzaTab() {
    if ($("#chk_alianza").is(':checked')) {
        $("a:contains('Datos alianza')").show();
    } else {
        $("a:contains('Datos alianza')").hide();
    }
}

function renderPropuestaTab() {
    if ($("#chk_es_cliente_potencial").is(':checked')) {
        $("a:contains('Propuesta')").show();
    } else {
        $("a:contains('Propuesta')").hide();
    }
}

function renderConsultora() {
    if ($("#chk_trabaja_consultora option:selected").text() == "Si") {
        $("#consultora_label").show();
        $("#consultora").parent().show();
    } else {
        $("#consultora_label").hide();
        $("#consultora").parent().hide();
    }
}

function renderTrabajaConsultora() {
    if ($("#empresa_type option:selected").text() == "Franquicia" ||
        $("#chk_es_cliente_potencial").is(':checked')) {
        $("#chk_trabaja_consultora_label").parent().show();
    } else {
        $("#chk_trabaja_consultora_label").parent().hide();
    }
}

function renderTipoPositivo() {
    if ($("#estado_cp option:selected").text() == "Positivo") {
        $("#positivo_cp").parent().show();
        $("#positivo_cp_label").show();
    } else {
        $("#positivo_cp").parent().hide();
        $("#positivo_cp_label").hide();
    }
}

function clean() {
    $("#proveedor_insert_label").hide();
    $("#proveedor_list_label").hide();
}

function validarEmpresa() {

    if ($("#estado_cp option:selected").text() == "Positivo" &&
        $("#positivo_cp option:selected").text() == "") {

        $("#positivo_cp").css("border", "2px solid red");
        alert("El motivo del positivo debe estar relleno");
        return false;
    } else {
        $("#positivo_cp").css("border", "#94c1e8 solid 1px");
    }

    if ($("#sector option:selected").text() == "") {
        alert("El Sector debe estar relleno");
        return false;
    }

    if ($("#chk_es_competidor").attr("checked")) {

        if ($("#web").val() == "") {
            $("#web").css("border", "2px solid red");
            alert("La web debe estar rellena");
            return false;
        } else {
            $("#web").css("border", "#94c1e8 solid 1px");
        }

        if ($("#poblacion").val() == "") {
            $("#poblacion").css("border", "2px solid red");
            alert("La poblacion debe estar rellena");
            return false;
        } else {
            $("#poblacion").css("border", "#94c1e8 solid 1px");
        }

        if ($("#provincia").val() == "") {
            $("#provincia").css("border", "2px solid red");
            alert("La provincia debe estar rellena");
            return false;
        } else {
            $("#provincia").css("border", "#94c1e8 solid 1px");
        }

        if ($("#codigo_postal").val() == "") {
            $("#codigo_postal").css("border", "2px solid red");
            alert("El código postal debe estar relleno");
            return false;
        } else {
            $("#codigo_postal").css("border", "#94c1e8 solid 1px");
        }

        if ($("#ccaa").val() == "") {
            $("#ccaa").css("border", "2px solid red");
            alert("La comunidad autónoma debe estar rellena");
            return false;
        } else {
            $("#ccaa").css("border", "#94c1e8 solid 1px");
        }

        if ($("#direccion").val() == "") {
            $("#direccion").css("border", "2px solid red");
            alert("La direccion debe estar rellena");
            return false;
        } else {
            $("#direccion").css("border", "#94c1e8 solid 1px");
        }

        if ($("#telefono_contacto_1").val() == "") {
            $("#telefono_contacto_1").css("border", "2px solid red");
            alert("El telefono de contacto debe estar relleno");
            return false;
        } else {
            $("#telefono_contacto_1").css("border", "#94c1e8 solid 1px");
        }

        if ($("#Expan_Empresa0emailAddress0").val() == "") {
            $("#Expan_Empresa0emailAddress0").css("border", "2px solid red");
            alert("El correo electronico de contacto debe estar relleno");
            return false;
        } else {
            $("#Expan_Empresa0emailAddress0").css("border", "#94c1e8 solid 1px");
        }

        if ($("#actividad_principal").val() == "") {
            $("#actividad_principal").css("border", "2px solid red");
            alert("La actividad principal debe estar rellena");
            return false;
        } else {
            $("#actividad_principal").css("border", "#94c1e8 solid 1px");
        }

        if ($("#estado_cp").val() == "" && $("#chk_es_cliente_potencial").is(':checked')) {
            $("#estado_cp").css("border", "2px solid red");
            alert("El estado debe estar relleno");
            return false;
        } else {
            $("#estado_cp").css("border", "#94c1e8 solid 1px");
        }

    }

    return check_form("EditView");
}

function marcarCamposImportantes() {

    $("#const_year").css("background-color", "	#FFFFCC");
    $("#num_locales_propios").css("background-color", "	#FFFFCC");
    $("#num_locales_extran").css("background-color", "	#FFFFCC");
    $("#sup_local_min").css("background-color", "	#FFFFCC");
    $("#num_locales_franquiciados").css("background-color", "	#FFFFCC");
    $("#poblacion_min").css("background-color", "	#FFFFCC");
    $("#productos_servicios").css("background-color", "	#FFFFCC");
    $("#inversion").css("background-color", "	#FFFFCC");
    $("#canon_entrada").css("background-color", "	#FFFFCC");
    $("#royalty_explotacion").css("background-color", "	#FFFFCC");
    $("#fondo_marketing").css("background-color", "	#FFFFCC");
    $("#personal_necesario").css("background-color", "	#FFFFCC");

}


function addProveedorEmpresa(idEmpresa) {

    var idFranquicia = $("#franquicias_proveedor").val();
    var tipo_proveedor = $("#tipo_proveedor").val();
    var ambito_act = $("#ambito_act").val();
    if ($("#chk_cotizado").attr("checked")) {
        chk_cotizado = 1;
    } else {
        chk_cotizado = 0;
    }

    if ($("#chk_validado").attr("checked")) {
        chk_validado = 1;
    } else {
        chk_validado = 0;
    }

    if ($("#chk_requiere_dosier").attr("checked")) {
        chk_requiere_dosier = 1;
    } else {
        chk_requiere_dosier = 0;
    }

    var dosier_enviado = $("#dosier_enviado").val();
    var rappel_central = $("#rappel_central").val();
    var rappel_fdo = $("#rappel_fdo").val();
    var otras_condiciones = $("#otras_condiciones").val();
    var duracion_acuerdo = $("#duracion_acuerdo").val();
    var f_renovacion_acuerdo = $("#f_renovacion_acuerdo").val();
    var observaciones_proveedor_franq = $("#observaciones_proveedor_franq").val();
    var ofertas = $("#ofertas").val();
    var pedido_minimo = $("#pedido_minimo").val();
    var formas_pago = $("#formas_pago").val();
    var condiciones_portes = $("#condiciones_portes").val();
    var plazo_entrega = $("#plazo_entrega").val();
    var garantia_producto = $("#garantia_producto").val();
    var politica_devoluciones = $("#politica_devoluciones").val();

    var nombre_contacto = $("#nombre_contacto").val();
    var cargo_contacto = $("#cargo_contacto").val();
    var telefono_contacto = $("#telefono_contacto").val();
    var email_contacto = $("#email_contacto").val();

    if (idFranquicia == "") {
        alert("Es necesario seleccionar la franquicia");
        return null;
    }

    if (confirm("¿Quiere crear condiciones del proveedor para la franquicia?")) {

        url = 'index.php?entryPoint=consultarEmpresa';
        $.ajax({
            type: "POST",
            url: url,
            data: "tipo=AltaProveedor&" +
                "idEmpresa=" + idEmpresa + "&" +
                "idFranquicia=" + idFranquicia + "&" +
                "tipo_proveedor=" + tipo_proveedor + "&" +
                "chk_cotizado=" + chk_cotizado + "&" +
                "chk_validado=" + chk_validado + "&" +
                "chk_requiere_dosier=" + chk_requiere_dosier + "&" +
                "dosier_enviado=" + dosier_enviado + "&" +
                "rappel_central=" + rappel_central + "&" +
                "rappel_fdo=" + rappel_fdo + "&" +
                "otras_condiciones=" + otras_condiciones + "&" +
                "duracion_acuerdo=" + duracion_acuerdo + "&" +
                "f_renovacion_acuerdo=" + f_renovacion_acuerdo + "&" +
                "observaciones_proveedor_franq=" + observaciones_proveedor_franq + "&" +
                "ofertas=" + ofertas + "&" +
                "pedido_minimo=" + pedido_minimo + "&" +
                "formas_pago=" + formas_pago + "&" +
                "condiciones_portes=" + condiciones_portes + "&" +
                "plazo_entrega=" + plazo_entrega + "&" +
                "garantia_producto=" + garantia_producto + "&" +
                "politica_devoluciones=" + politica_devoluciones + "&" +
                "nombre_contacto=" + nombre_contacto + "&" +
                "cargo_contacto=" + cargo_contacto + "&" +
                "telefono_contacto=" + telefono_contacto + "&" +
                "email_contacto=" + email_contacto + "&" +
                "ambito_act=" + ambito_act,

            success: function (data) {

                if (data == "Ok") {
                    document.location.reload();
                } else {
                    alert("No se ha podido guardar las condiciones");
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido guardar las condiciones - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

function deleteFranquicia(id) {

    if (confirm("¿Quiere crear condiciones del proveedor para la franquicia?")) {

        url = 'index.php?entryPoint=consultarEmpresa';
        $.ajax({
            type: "POST",
            url: url,
            data: "tipo=BajaEmpresaProveedor&" +
                "id=" + id,

            success: function (data) {
                if (data == "Ok") {
                    document.location.reload();
                } else {
                    alert("No se ha podido guardar las condiciones");
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

$('#busca_sector').keypress(function (e) {
    var str = $('#busca_sector').val();
    limpiarSector();
    if (str.length > 2) {
        buscarSector(str);
    }

    if (e.keyCode == '13') {
        e.preventDefault();

    }
});

function buscarSector(nombreSector) {

    $(".Sectorcheck").each(function () {
        str = $(this).attr('id');
        if (str.toUpperCase().lastIndexOf(nombreSector.toUpperCase()) != -1) {
            $(this).parent().css("background-color", "orange");
            despliegoSector($(this).attr('name'));
        }
    });

}

function limpiarSector() {

    $(".Sectorcheck").each(function () {
        $(this).parent().css("background-color", "");
    });

}

function editFranquicia(id) {

    url = 'index.php?entryPoint=consultarEmpresa';
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=ConsultaProveedor&" +
            "id=" + id,

        success: function (data) {

            var json = JSON.parse(data);

            if (json[0].chk_cotizado == 1) {
                $("#chk_cotizado").prop('checked', true);
            } else {
                $("#chk_cotizado").prop('checked', false);
            }

            if (json[0].chk_validado == 1) {
                $("#chk_validado").prop('checked', true);
            } else {
                $("#chk_validado").prop('checked', false);
            }

            if (json[0].chk_requiere_dosier == 1) {
                $("#chk_requiere_dosier").prop('checked', true);
            } else {
                $("#chk_requiere_dosier").prop('checked', false);
            }

            $("#franquicias_proveedor").val(json[0].empresa_id);
            $("#tipo_proveedor").val(json[0].tipo_proveedor);
            $("#ambito_act").val(json[0].ambito_act);

            $("#dosier_enviado").val(json[0].dosier_enviado);
            $("#rappel_central").val(json[0].rappel_central);
            $("#rappel_fdo").text(json[0].rappel_fdo);
            $("#otras_condiciones").val(json[0].otras_condiciones);
            $("#duracion_acuerdo").val(json[0].duracion_acuerdo);
            $("#f_renovacion_acuerdo").val(json[0].f_renovacion_acuerdo);
            $("#observaciones_proveedor_franq").val(json[0].observaciones_proveedor_franq);
            $("#ofertas").val(json[0].ofertas);
            $("#pedido_minimo").val(json[0].pedido_minimo);
            $("#formas_pago").val(json[0].formas_pago);
            $("#condiciones_portes").val(json[0].condiciones_portes);
            $("#plazo_entrega").val(json[0].plazo_entrega);
            $("#garantia_producto").val(json[0].garantia_producto);
            $("#politica_devoluciones").val(json[0].politica_devoluciones);
            $("#nombre_contacto").val(json[0].nombre_contacto);
            $("#cargo_contacto").val(json[0].cargo_contacto);
            $("#telefono_contacto").val(json[0].telefono_contacto);
            $("#email_contacto").val(json[0].email_contacto);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            YAHOO.SUGAR.MessageBox.hide();
            alert('No se ha podido borrar las condiciones - ' + textStatus + ' - ' + errorThrown);

        }
    });

}

function activoDesSector(nombreSector) {

    nombreSector = nombreSector.split(' ').join('_');

    CamposImput = document.getElementsByName(nombreSector);

    for (var i = 0; i < CamposImput.length; i++) {
        CamposImput[i].checked = !CamposImput[i].checked;
    }

    cambiocheck("Sectorcheck", "sector", true);

}

function cambiocheck(clase, id, act) {

    var checkboxes = document.getElementsByClassName(clase);
    var listaFran = document.getElementById(id);
    var listaSel = [];

    //Actualizamos las listas para que esten en conformidad con los checkboxes

    for (var j = 0; j < listaFran.length; j++) {
        listaFran[j].selected = false;
    }

    var numCheck = 0;
    for (var i = 0; i < checkboxes.length; i++) {

        if (checkboxes[i].checked) {

            listaSel[listaSel.length] = checkboxes[i].id;

            //Actualziamos la franquicia principal si no hay ninguna seleccionada ya
            if ($("#franquicia_principal :selected").text() == "" && clase == 'francheck') {
                $("#franquicia_principal option[label='" + checkboxes[i].id + "']").attr("selected", true);
            }
            numCheck++;
        }

    }

    for (var k = 0; k < listaSel.length; k++) {
        for (var l = 0; l < listaFran.length; l++) {
            if (trim(listaSel[k]) == trim(listaFran[l].text)) {
                listaFran[l].selected = true;
            }
        }
    }

}

function cargarchecks(clase, id) {

    var checkboxes = document.getElementsByClassName(clase);
    var listaFran = document.getElementById(id);
    var listaSel = [];

    if (listaFran != null) {
        //Cargamos los cheks seleccionados
        for (var j = 0; j < listaFran.length; j++) {
            if (listaFran[j].selected) {
                var check = document.getElementById(listaFran[j].label);
                if (check != null) {
                    check.checked = true;
                    if (clase == 'Sectorcheck') {
                        despliegoSector(check.getAttribute("name"));
                    }
                }
            }
        }
    }
}

function despliegoSector(nombreSector) {
    if (typeof nombreSector !== 'undefined') {

        document.getElementById(nombreSector.split('_').join(' ')).checked = true;

        nombreSector = nombreSector.split(' ').join('_');
        CamposImput = document.getElementsByName(nombreSector);

        for (var i = 0; i < CamposImput.length; i++) {
            CamposImput[i].parentNode.style.display = null;
        }
    }
}

function controlCorreos() {

    var idEmail = $("#Expan_Empresa0emailAddressId0").val();
    var email = $("#Expan_Empresa0emailAddress0").val();

    url = 'index.php?entryPoint=consultarEmpresa';
    $.ajax({
        type: "POST",
        url: url,
        data: 'tipo=ValidaCorreo&idEmail=' + idEmail + '&email=' + email,
        success: function (data) {
            if (data != '') {
                $("#Expan_Empresa0emailAddress0").css("border", "2px solid red");
                if (confirm("El correo ya esta asociado a otra empresa, \n¿Desea abrirla?")) {
                    //alert(data);
                    window.open('index.php?module=Expan_Empresa&action=EditView&record=' + data);
                }
                return false;
            } else {
                $("#Expan_Empresa0emailAddress0").css("border", "#94c1e8 solid 1px");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido controlar la existencia de correo repetido - ' + textStatus + ' - ' + errorThrown);
        }
    });

}

function controlNombre() {

    var nombre = $("#name").val();
    var idEmpresa = $('[name="record"]').val();

    url = 'index.php?entryPoint=consultarEmpresa';
    $.ajax({
        type: "POST",
        url: url,
        data: 'tipo=ValidaNombre&name=' + nombre + '&idEmpresa=' + idEmpresa,
        success: function (data) {
            if (data != '') {
                $("#name").css("border", "2px solid red");
                if (confirm("El nombre de la empresa ya existe, \n¿Desea abrirla?")) {
                    //alert(data);
                    window.open('index.php?module=Expan_Empresa&action=EditView&record=' + data);
                }
                return false;
            } else {
                $("#nombre").css("border", "#94c1e8 solid 1px");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido controlar la existencia de nombre repetido - ' + textStatus + ' - ' + errorThrown);
        }
    });

}

function hasEventListener(element, eventName, namespace) {
    var returnValue = false;
    var events = $(element).data("events");
    if (events) {
        $.each(events, function (index, value) {
            if (index == eventName) {
                if (namespace) {
                    $.each(value, function (index, value) {
                        if (value.namespace == namespace) {
                            returnValue = true;
                            return false;
                        }
                    });
                } else {
                    returnValue = true;
                    return false;
                }
            }
        });
    }
    return returnValue;
}

function Hoy() {
    var f = new Date();
    return pad(f.getDate(), 2) + "/" + pad(f.getMonth() + 1, 2) + "/" + f.getFullYear();
}

function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function fechaPrimerContactoHoy() {
    if ($("#fecha_contacto").val() == "") {
        $("#fecha_contacto").val(Hoy());
    }
}

function cambiarCompetidor(tipoComp) {

    if (confirm("¿Esta seguro de que quieres cambiar el tipo de competidor?")) {

        var idCompetidores = getListaCompetidores();
        var idEempresa = $("input[name$=\"record\"]").val();

        url = "index.php?entryPoint=consultarEmpresa";
        $.ajax({
            type: "POST",
            url: url,
            data: "tipo=CambioCompetidor" + "&tipoComp=" + tipoComp + "&idEmpresa=" + idEempresa + "&idCompetidores=" + idCompetidores,
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.toUpperCase() == "OK") {
                    document.location.reload();
                } else {
                    alert("No se han podido cambiar el tipo de los competidores seleccionados " + estado);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("No se han podido cambiar el tipo de los competidores seleccionados - " + textStatus + " - " + errorThrown);
            }
        });

    } else {
        return false;
    }

}

function cambiarCompPrincipal() {

    if (confirm("¿Esta seguro de que quieres cambiar el competidor principal?")) {

        var idCompetidores = getListaCompetidores();
        var idEempresa = $("input[name$=\"record\"]").val();

        url = "index.php?entryPoint=consultarEmpresa";
        $.ajax({
            type: "POST",
            url: url,
            data: "tipo=CompetidorPrincipal" + "&idEmpresa=" + idEempresa + "&idCompetidores=" + idCompetidores,
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

function addFechaNoticias(linTexto) {

    var texto = $("#noticias").val();

    var f = new Date();

    fecha = f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();
    texto = texto + ('\n' + fecha + ' : ' + linTexto);
    $("#noticias").val(texto);

}

function loadProvincias() {

    var ccaa;
    var valSelect;

    valSelect = $("#provincia").val();
    ccaa = $("#ccaa").val();

    url = 'index.php?entryPoint=consultarSolicitud';
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeProvincias&ccaa=" + ccaa,
        success: function (data) {

            $("#provincia").empty();
            var parse = JSON.parse(data);
            var listitems = '<option value=""></option>';

            for (var i in parse) {
                listitems += '<option value=' + parse[i].c_prov + '>' + parse[i].d_prov + '</option>';
            }
            $("#provincia").append(listitems);

            $("#poblacion option[value=" + valSelect + "]").attr("selected", true);

        },
        error: function (jqXHR, textStatus, errorThrown) {

            alert()
        }
    });

}


function loadMunicipios() {

    var provincia;
    var valSelect;

    provincia = $("#provincia").val();
    valSelect = $("#poblacion").val();

    url = 'index.php?entryPoint=consultarSolicitud';
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeMunicipios&provincia=" + provincia,
        success: function (data) {

            $("#poblacion").empty();
            var parse = JSON.parse(data);
            var listitems = '<option value=""></option>';

            for (var i in parse) {

                listitems += '<option value=' + parse[i].c_provmun + '>' + parse[i].d_municipio + '</option>';
            }
            $("#poblacion").append(listitems);

            $("#poblacion option[value=" + valSelect + "]").attr("selected", true);

        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });

}