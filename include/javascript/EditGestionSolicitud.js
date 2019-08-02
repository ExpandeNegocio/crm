/*
 * @author Penlopjo
 */
function ocultarCheck(gestionID) {

    /*	$(document).on({
     ajaxStart: function() { alert('Entra Ajax');   },
     ajaxStop: function() { alert('Cierra Ajax'); }
     });*/
    estado = document.getElementById("estado_sol").value;
    document.getElementById("oportunidad_inmediata").disabled = true;
    document.getElementById("candidatura_avanzada").disabled = true;
    document.getElementById("candidatura_caliente").disabled = true;
    document.getElementById("lnk_cuestionario").disabled = true;
    document.getElementById("otras_preguntas_formulario").disabled = true;
    document.getElementById("fecha_precontrato_minima").disabled = true;

    document.getElementById("usuario_entrevista_previa").disabled = true;
    document.getElementById("chk_entrevista_previa").disabled = true;


    if (estado != 2) {

        document.getElementById("chk_envio_documentacion").disabled = true;
        document.getElementById("chk_resolucion_dudas").disabled = true;
        document.getElementById("chk_recepcio_cuestionario").disabled = true;
        document.getElementById("chk_informacion_adicional").disabled = true;
        document.getElementById("chk_sol_amp_info").disabled = true;

        document.getElementById("chk_entrevista").disabled = true;
        document.getElementById("chk_propuesta_zona").disabled = true;

        document.getElementById("chk_visitado_fran").disabled = true;
        document.getElementById("chk_envio_precontrato").disabled = true;
        document.getElementById("chk_visita_local").disabled = true;

        document.getElementById("chk_posible_colabora").disabled = true;

        document.getElementById("chk_responde_C1").disabled = true;
        document.getElementById("chk_envio_precontrato_personal").disabled = true;
        document.getElementById("chk_autoriza_central").disabled = true;
        document.getElementById("chk_operacion_autorizada").disabled = true;

        if (estado == 5) {
            document.getElementById("chk_envio_contrato_personal").disabled = false;
            document.getElementById("chk_contrato_firmado").disabled = false;
            document.getElementById("chk_visita_central").disabled = false;
            document.getElementById("chk_envio_plan_financiero_personal").disabled = false;
            document.getElementById("chk_aprobacion_local").disabled = false;
            document.getElementById("chk_precontrato_firmado").disabled = false;
            document.getElementById("chk_envio_contrato").disabled = false;
        } else {
            document.getElementById("chk_envio_contrato_personal").disabled = true;
            document.getElementById("chk_contrato_firmado").disabled = true;
            document.getElementById("chk_visita_central").disabled = true;
            document.getElementById("chk_envio_plan_financiero_personal").disabled = true;
            document.getElementById("chk_aprobacion_local").disabled = true;
            document.getElementById("chk_precontrato_firmado").disabled = true;
            document.getElementById("chk_envio_contrato").disabled = true;
        }

    } else {
        document.getElementById("chk_envio_documentacion").disabled = false;
        document.getElementById("chk_resolucion_dudas").disabled = false;
        document.getElementById("chk_recepcio_cuestionario").disabled = false;
        document.getElementById("chk_informacion_adicional").disabled = false;
        document.getElementById("chk_sol_amp_info").disabled = false;

        document.getElementById("chk_entrevista").disabled = false;
        document.getElementById("chk_propuesta_zona").disabled = false;

        document.getElementById("chk_visitado_fran").disabled = false;
        document.getElementById("chk_envio_precontrato").disabled = false;
        document.getElementById("chk_visita_local").disabled = false;

        document.getElementById("chk_envio_contrato").disabled = false;
        document.getElementById("chk_visita_central").disabled = false;
        document.getElementById("chk_posible_colabora").disabled = false;

        document.getElementById("chk_responde_C1").disabled = false;
        document.getElementById("chk_envio_contrato_personal").disabled = false;
        document.getElementById("chk_envio_precontrato_personal").disabled = false;
        document.getElementById("chk_envio_plan_financiero_personal").disabled = false;

        document.getElementById("chk_autoriza_central").disabled = false;
        document.getElementById("chk_operacion_autorizada").disabled = false;
        document.getElementById("chk_precontrato_firmado").disabled = false;
        document.getElementById("chk_aprobacion_local").disabled = false;
        document.getElementById("chk_contrato_firmado").disabled = false;

    }


    addEvents();
    makeTabby();

    var texto1 = document.getElementById("chk_responde_C1_label");
    var texto2 = document.getElementById("chk_recepcio_cuestionario_label");

    //Hacemos que las


    ocultamosSuborigen();
    mostrarSuborigen();
    cambiarNombreTipoNeg();
    deactivateModifiedName();
    ocultarModelosNegocio();
    colorearAvanzado();
    colorearCaliente();
    colorearPositivo();
    colorearCamposDocumentos();
    cambiarAGris(texto1);
    cambiarAGris(texto2);
    addDelayFechareactButtons();
    addDelayFechaInicioButtons();
    boldCentral();
    refreshSn();
    cargarDocumentos();
    //abrirSolicitud(gestionID,"EditView");

}

function openParent(idParent, parentModule) {
    if (parentModule !="undefined") {
        window.open('index.php?module=' + parentModule + '&action=EditView&record=' + idParent, idParent);
    }
}

function boldCentral() {
    if ($("#chk_gestionado_central").is(':checked')) {
        $("#chk_gestionado_central_label").css("font-weight", "Bold");
    } else {
        $("#chk_gestionado_central_label").css("font-weight", "");
    }
}

function makeTabby() {

    $("textarea").each(function () {
        enableTab($(this).attr('id'));
    });

}

function enableTab(id) {
    var el = document.getElementById(id);
    el.onkeydown = function (e) {
        if (e.keyCode === 9) { // tab was pressed

            // get caret position/selection
            var val = this.value,
                start = this.selectionStart,
                end = this.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.value = val.substring(0, start) + '\t' + val.substring(end);

            // put caret at right position again
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            return false;

        }
    };
}

function addEvents() {

    $("#chk_envio_documentacion").bind("click", function () {
        activarFecha("#chk_envio_documentacion", "#envio_documentacion");
    });

    $("#chk_responde_C1").bind("click", function () {
        activarFecha("#chk_responde_C1", "#f_responde_C1");
        //activarCanCaliente();
    });

    $("#chk_sol_amp_info").bind("click", function () {
        activarFecha("#chk_sol_amp_info", "#f_sol_amp_info");
        if (!$("#chk_sol_amp_info").is(':checked')) {
            return;
        }
        textoObs = "Se le resuelven principales dudas del modelo de negocio.Pendiente de reunión";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_gestionado_central").bind("click", function () {
        activarFecha("#chk_gestionado_central", "#f_gestionado_central");
        boldCentral();
    });

    $("#chk_resolucion_dudas").bind("click", function () {
        activarFecha("#chk_resolucion_dudas", "#f_resolucion_dudas");
        if (!$("#chk_resolucion_dudas").is(':checked')) {
            return;
        }
        textoObs = "Se le resuelven principales dudas del modelo de negocio.Pendiente de reunión";
        if (existeTextoObserva(textoObs) == false) {
            //addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_recepcio_cuestionario").bind("click", function () {
        activarFecha("#chk_recepcio_cuestionario", "#f_recepcion_cuestionario");
        if (!$("#chk_recepcio_cuestionario").is(':checked')) {
            return;
        }
        textoObs = "Recibido cuestionario Ampliado, perfil validado. Pendiente fecha de nueva reunion.";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_autoriza_central").bind("click", function () {
        activarFecha("#chk_autoriza_central", "#f_autoriza_central");
        //activarCanCaliente();
    });

    $("#chk_informacion_adicional").bind("click", function () {
        activarFecha("#chk_informacion_adicional", "#f_informacion_adicional");
        if ($("#chk_informacion_adicional").is(':checked')) {

            if ($("#inversion").val() == '') {
                alert("Debes rellenar el campo 'Capacidad de Inversión'");
                return;
            }
            if ($("#cuando_empezar").val() == '') {
                alert("Debes rellenar el campo 'Inicio de actividad previsto'");
                return;
            }

            if ($("#papel").val() == '') {
                alert("Debes rellenar el campo 'Rol en el proyecto'");
                return;
            }

            if ($("#observaciones_informe").val() == '') {
                alert("Debes rellenar el campo 'Observaciones estado candidatura'");

            }

        }

    });

    $("#chk_entrevista").bind("click", function () {
        activarFecha("#chk_entrevista", "#f_entrevista");
        //activarCanCaliente();
    });

    $("#chk_propuesta_zona").bind("click", function () {
        activarFecha("#chk_propuesta_zona", "#f_propuesta_zona");
    });

    $("#chk_visitado_fran").bind("click", function () {
        activarFecha("#chk_visitado_fran", "#f_visitado_fran");
        if (!$("#chk_visitado_fran").is(':checked')) {
            return;
        }
        textoObs = "Visita presencial de centro franquiciado";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_envio_precontrato").bind("click", function () {

        activarFecha("#chk_envio_precontrato", "#f_envio_precontrato");
        if (!$("#chk_envio_precontrato").is(':checked')) {
            return;
        } else {
            validarEnvio("C3");
        }
        textoObs = "Pendiente de respuesta a la firma de precontrato";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_visita_local").bind("click", function () {
        activarFecha("#chk_visita_local", "#f_visita_local");
        if (!$("#chk_visita_local").is(':checked')) {
            return;
        }
        textoObs = "Analizando locales";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_operacion_autorizada").bind("click", function () {
        activarFecha("#chk_operacion_autorizada", "#f_operacion_autorizada");
    });

    $("#chk_envio_precontrato_personal").bind("click", function () {
        activarFecha("#chk_envio_precontrato_personal", "#f_envio_precontrato_personal");
    });

    $("#chk_precontrato_firmado").bind("click", function () {
        activarFecha("#chk_precontrato_firmado", "#f_precontrato_firmado");
    });

    $("#chk_envio_contrato").bind("click", function () {
        activarFecha("#chk_envio_contrato", "#f_envio_contrato");
        if (!$("#chk_envio_contrato").is(':checked')) {
            return;
        } else {
            validarEnvio("C4");
        }
        textoObs = "Revisando clausulas del contrato";
        if (existeTextoObserva(textoObs) == false) {
            //	addFechaObserva(textoObs);
        }
        //activarCanCaliente();
    });

    $("#chk_envio_plan_financiero_personal").bind("click", function () {
        activarFecha("#chk_envio_plan_financiero_personal", "#f_envio_plan_financiero_personal");
    });

    $("#chk_aprobacion_local").bind("click", function () {
        activarFecha("#chk_aprobacion_local", "#f_aprobacion_local");
    });

    $("#chk_visita_central").bind("click", function () {
        activarFecha("#chk_visita_central", "#f_visita_central");
        //activarCanCaliente();
    });

    $("#chk_posible_colabora").bind("click", function () {
        activarFecha("#chk_posible_colabora", "#f_posible_colabora");
    });

    $("#chk_envio_contrato_personal").bind("click", function () {
        activarFecha("#chk_envio_contrato_personal", "#f_envio_contrato_personal");
    });

    $("#chk_contrato_firmado").bind("click", function () {
        activarFecha("#chk_contrato_firmado", "#f_contrato_firmado");
    });


    $("#observaciones_informe").bind("click", function () {
        //alert ($("#observaciones_informe").val());
        if ($("#observaciones_informe").val().length == 0) {
            addFechaObserva("");
        }

    });

    //Activamos el cambio de texto en
    $("#observaciones_informe").bind("keyup", function () {
        if (window.event.keyCode == 13) {
            addFechaObserva("");
        }
    });

    $("#motivo_parada").bind("change", function () {
        if (estado == 3) {
            mensaje = "Parado por " + $("#motivo_parada option:selected").text();
            if ($("#observaciones_informe").val().indexOf(mensaje) == -1 && $("#motivo_parada option:selected").text() != "") {
                addFechaObserva(mensaje);
            }
        }
    })
        .change();

    $("#motivo_descarte").bind("change", function () {
        if (estado == 4) {
            mensaje = "Descartado por " + $("#motivo_descarte option:selected").text();
            if ($("#observaciones_informe").val().indexOf(mensaje) == -1 && $("#motivo_descarte option:selected").text() != "") {
                addFechaObserva(mensaje);
            }
        }
    })
        .change();

    $("#motivo_descarte").bind("change", organizarMotivos()).change();


    $("#franq_apertura_desca").keyup(function () {//cuando pulses la caja de texto
        var campoF = $(this).val();	//valor del texto
        var arrayFran = campoF.split(","); //todas las franquicias separadas por comas en un array
        var franq_apertura_desca = "";
        for (var i = 0; i < arrayFran.length - 1; i++) {//construir las franquicias anteriores
            franqHastaUlComa = franqHastaUlComa + arrayFran[i] + ",";
        }
        var longi = arrayFran.length;//cuantas hay

        var franq = arrayFran[longi - 1];//la ultima franquicia, que es sobre la que se quiere hacer la consulta
        var franqSE = franq.trim(); //eliminar espacios en blanco


        if (franqSE.length > 2) {//solo se hace la llamada si se han escrito 3 caracteres

            var dataFran = "franquicias=" + franqSE + "&tipo=franquicia";

            //llamada ajax
            $.ajax({
                type: "POST",
                url: "index.php?entryPoint=RecogeSugerencias",
                data: dataFran,
                success: function (data) {
                    $('#sugerencias_franq_apertura_desca').fadeIn(500).html(data);
                    $('.sug').live('click', function () {//cuando se pulsa una
                        var fran = $(this).text();
                        if (longi == 1) {//borrar todo y sustituir por el nuevo valor
                            $('#franq_apertura_desca').val(fran);//editar input
                        } else {//poner las anteriores, y después la nueva
                            $('#franquicia_historicos').val(franqHastaUlComa + fran);
                        }

                        $('#sugerencias_franq_apertura_desca').fadeOut(500);//quitar las sugerencias
                    });

                    $('#detailpanel_3').live('click', function () {//que se cierre el cuadro de sugerencias si se pulsa en otro sitio
                        $('#sugerencias_franq_apertura_desca').fadeOut(500);
                    });
                }
            });
        }
    });


}

var refreshSn = function () {
    var refreshTime = 600000; // every 10 minutes in milliseconds
    window.setInterval(function () {
        $.ajax({
            cache: false,
            type: "GET",
            url: "refresh_session.php",
            success: function (data) {

                var _form = document.getElementById('EditView');
                _form.action.value = 'Save';
                _form.return_action.value = 'EditView';
                if (check_form('EditView')) {
                    SUGAR.ajaxUI.submitForm(_form);
                }

                return false;

            }
        });
    }, refreshTime);
};


$("#iit_validado").bind("change", function () {
    colorearCamposDocumentos();
}).change();

$("#pf_validado").bind("change", function () {
    if ($('#pf_validado').is(':checked')) {

    } else {

    }
}).change();

function colorearCamposDocumentos() {

    //Recogida desde CRM -- ROJO --


    var iit_aporta_local = document.getElementById("iit_aporta_local");
    var iit_direccion_local = document.getElementById("iit_direccion_local");
    var iit_localidad_local = document.getElementById("iit_localidad_local");
    var iit_superficie_local = document.getElementById("iit_superficie_local");
    var iit_superficie_escapa_local = document.getElementById("iit_superficie_escapa_local");
    var iit_superficie_almacen_local = document.getElementById("iit_superficie_almacen_local");
    var iit_instalaciones_local = document.getElementById("iit_instalaciones_local");
    var iit_visitado_local = document.getElementById("iit_visitado_local");
    var iit_aprobado_local = document.getElementById("iit_aprobado_local");
    var iit_mod_neg_recomendado = document.getElementById("iit_mod_neg_recomendado");
    var iit_localidad_recomendado = document.getElementById("iit_localidad_recomendado");

    var iit_zona_implantacion = document.getElementById("iit_zona_implantacion");

    var iit_acuerdo_exclusividad = document.getElementById("iit_acuerdo_exclusividad");
    var iit_acuerdo_economico = document.getElementById("iit_acuerdo_economico");
    var iit_inversion_inicial_est = document.getElementById("iit_inversion_inicial_est");
    var iit_canon_entrada = document.getElementById("iit_canon_entrada");
    var iit_royalty_explota = document.getElementById("iit_royalty_explota");
    var iit_royalty_mkt = document.getElementById("iit_royalty_mkt");
    var iit_duracion_contrato = document.getElementById("iit_duracion_contrato");
    var iit_year_renovado = document.getElementById("iit_year_renovado");
    var iit_max_estableci_zona = document.getElementById("iit_max_estableci_zona");


    var listaR = [iit_acuerdo_exclusividad, iit_acuerdo_economico, iit_inversion_inicial_est, iit_canon_entrada, iit_royalty_explota, iit_royalty_mkt, iit_duracion_contrato, iit_year_renovado, iit_max_estableci_zona];

    var listaV = [iit_aporta_local, iit_direccion_local, iit_localidad_local, iit_superficie_local, iit_superficie_escapa_local,
        iit_superficie_almacen_local, iit_instalaciones_local, iit_visitado_local, iit_aprobado_local, iit_visitado_local, iit_aprobado_local, iit_mod_neg_recomendado];

    var listaA = [iit_zona_implantacion, iit_direccion_local, iit_localidad_recomendado, iit_direccion_local];

    var lista = listaR.concat(listaV);
    lista = lista.concat(listaA);

    //Quitamos primero el color
    for (var i in lista) {
        $(lista[i]).css("color", "rgb(0,0,0)");
    }

    if ($('#iit_validado').is(':checked') == false) {
        for (var j in lista) {
            $(lista[j]).css("color", "rgb(255,0,0)");
        }
    }

}

function validarSubOrigen() {

    var Origen = document.getElementById("tipo_origen");
    var optPortal = document.getElementById("portal");
    var optEvento = document.getElementById("expan_evento_id_c");
    var optCentral = document.getElementById("subor_central");
    var optMedios = document.getElementById("subor_medios");
    var franPrin = document.getElementById("franquicia_principal");
    var optRating = document.getElementById("rating");
    var txtPerfil = document.getElementById("perfil_profesional");
    var optCapital = document.getElementById("capital");
    var optMailing = document.getElementById("subor_mailing");

    var styleProps = $("#phone_mobile").css("border");
    if (styleProps == "2px solid rgb(255, 0, 0)") {
        alert("El teléfono movil corresponde con otra solicitud");
        return false;
    }

    styleProps = $("#Expan_Solicitud0emailAddress0").css("border");
    if (styleProps == "2px solid rgb(255, 0, 0)") {
        alert("El correo corresponde con otra solicitud");
        return false;
    }

    if (Nombre.value == "" && Apellidos.value == "") {

        if (Nombre.value == "") {
            $("#first_name").css("border", "2px solid red");
        }
        if (Apellidos.value == "") {
            $("#last_name").css("border", "2px solid red");
        }

        alert("El nombre o los apellidos deben de estar rellenos");
        return false;
    } else {
        $("#first_name").css("border", "#94c1e8 solid 1px");
        $("#last_name").css("border", "#94c1e8 solid 1px");
    }

    //Comprobamos si la franquicia principal esta rellena
    if (franPrin.selectedIndex == 0) {
        $("#franquicia_principal").css("border", "2px solid red");
        alert("La franquicia principl esta vacia");
        return false;
    } else {
        $("#franquicia_principal").css("border", "#94c1e8 solid 1px");
    }


    var rating = "";
    if (optRating.selectedIndex != -1) {
        rating = optRating.options[optRating.selectedIndex].label;
    }

    var perfil = txtPerfil.value;

    var portal = "";
    if (optPortal.selectedIndex != -1) {
        portal = optPortal.options[optPortal.selectedIndex].label;
    }

    var evento = "";
    if (optEvento.selectedIndex != -1) {
        evento = optEvento.options[optEvento.selectedIndex].label;
    }

    var central = "";
    if (optCentral.selectedIndex != -1) {
        central = optCentral.options[optCentral.selectedIndex].label;
    }
    var medios = "";
    if (optMedios.selectedIndex != -1) {
        medios = optMedios.options[optMedios.selectedIndex].label;
    }

    var mailing = "";
    if (optMailing.selectedIndex != -1) {
        mailing = optMailing.options[optMailing.selectedIndex].label;
    }

    var capital = "";
    if (optCapital.selectedIndex != -1) {
        capital = optCapital.options[optCapital.selectedIndex].label;
    }

    var situacion_profesional = "";
    if (optSituacion_profesional.selectedIndex != -1) {
        situacion_profesional = optSituacion_profesional.options[optSituacion_profesional.selectedIndex].label;
    }

    var perfilFran = "";
    if (optPerfil_franquicia.selectedIndex != -1) {
        perfilFran = optPerfil_franquicia.options[optPerfil_franquicia.selectedIndex].label;
    }

    for (var i = 0, l = Origen.options.length, o; i < l; i++) {
        o = Origen.options[i];

        if (o.selected == true && o.value == 2 && portal == "") {
            $("#portal").css("border", "2px solid red");
            alert("Uno de los origenes de la solicitud es portal y no se ha seleccionado el mismo");
            return false;
        } else {
            $("#portal").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 3 && evento == "") {
            $("#expan_evento_id_c").css("border", "2px solid red");
            alert("Uno de los origenes de la solicitud es Evento y no se ha seleccionado el mismo");
            return false;
        } else {
            $("#expan_evento_id_c").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 3 && rating == "" && esCreacion()) {
            $("#rating").css("border", "2px solid red");
            alert("El rating es obligatorio si el origen es evento");
            return false;
        } else {
            $("#rating").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 1 && rating == "" && esCreacion()) {
            $("#rating").css("border", "2px solid red");
            alert("El rating es obligatorio si el origen es expandenegocio");
            return false;
        } else {
            $("#rating").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 3 && perfilFran == "" && esCreacion()) {
            $("#perfil_franquicia").css("border", "2px solid red");
            alert("El pefil de la franquicia es obligatorio si el origen es evento");
            return false;
        } else {
            $("#perfil_franquicia").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 4 && central == "") {
            $("#subor_central").css("border", "2px solid red");
            alert("Uno de los origenes de la solicitud es Central y no se ha seleccionado el mismo");
            return false;
        } else {
            $("#subor_central").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 5 && medios == "") {
            $("#subor_medios").css("border", "2px solid red");
            alert("Uno de los origenes de la solicitud es Medios y no se ha seleccionado el mismo");
            return false;
        } else {
            $("#subor_medios").css("border", "#94c1e8 solid 1px");
        }

        if (o.selected == true && o.value == 6 && mailing == "") {
            $("#subor_mailing").css("border", "2px solid red");
            alert("Uno de los origenes de la solicitud es Mailing y no se ha seleccionado el mismo");
            return false;
        } else {
            $("#subor_mailing").css("border", "#94c1e8 solid 1px");
        }

    }
    return check_form("EditView");
}


/**
 *Oculta el encabezado de los modelos de negocio cuando no los hay
 */
function ocultarModelosNegocio() {

    var tipoN1 = document.getElementById("tiponegocio1_label").innerHTML;
    var tipoN2 = document.getElementById("tiponegocio2_label").innerHTML;
    var tipoN3 = document.getElementById("tiponegocio3_label").innerHTML;
    var tipoN4 = document.getElementById("tiponegocio4_label").innerHTML;

    if (tipoN2 == "" && tipoN1 == "" && tipoN3 == "" && tipoN4 == "") {
        //no hay modelos de negocio
        document.getElementById("ModelosDeNegocio").style.display = 'none';
    }
}

function ocultamosSuborigen() {
    $("#portal").parent().parent().hide();
    $("#subor_medios").parent().parent().hide();
    $("#subor_central").parent().parent().hide();
    $("#subor_expande").parent().parent().hide();
    $("#subor_mailing").parent().parent().hide();

    $("#expan_evento_id_c").parent().parent().hide();

}

function deactivateModifiedName() {
    $("#btn_modified_by_name").hide();
    $("#btn_clr_modified_by_name").hide();
    $("#modified_by_name").prop('disabled', true);
}

function cambiarNombreTipoNeg() {

    $("#tiponegocio1_label").text($("#temp_modneg1").val());
    $("#tiponegocio2_label").text($("#temp_modneg2").val());
    $("#tiponegocio3_label").text($("#temp_modneg3").val());
    $("#tiponegocio4_label").text($("#temp_modneg4").val());

    $("#chkvalNeg11_label").text("--" + $("#temp_valNeg11").val());
    $("#chkvalNeg12_label").text("--" + $("#temp_valNeg12").val());
    $("#chkvalNeg13_label").text("--" + $("#temp_valNeg13").val());
    $("#chkvalNeg14_label").text("--" + $("#temp_valNeg14").val());
    $("#chkvalNeg15_label").text("--" + $("#temp_valNeg15").val());
    $("#chkvalNeg21_label").text("--" + $("#temp_valNeg21").val());
    $("#chkvalNeg22_label").text("--" + $("#temp_valNeg22").val());
    $("#chkvalNeg23_label").text("--" + $("#temp_valNeg23").val());
    $("#chkvalNeg24_label").text("--" + $("#temp_valNeg24").val());
    $("#chkvalNeg25_label").text("--" + $("#temp_valNeg25").val());
    $("#chkvalNeg31_label").text("--" + $("#temp_valNeg31").val());
    $("#chkvalNeg32_label").text("--" + $("#temp_valNeg32").val());
    $("#chkvalNeg33_label").text("--" + $("#temp_valNeg33").val());
    $("#chkvalNeg34_label").text("--" + $("#temp_valNeg34").val());
    $("#chkvalNeg35_label").text("--" + $("#temp_valNeg35").val());
    $("#chkvalNeg41_label").text("--" + $("#temp_valNeg41").val());
    $("#chkvalNeg42_label").text("--" + $("#temp_valNeg42").val());
    $("#chkvalNeg43_label").text("--" + $("#temp_valNeg43").val());
    $("#chkvalNeg44_label").text("--" + $("#temp_valNeg44").val());
    $("#chkvalNeg45_label").text("--" + $("#temp_valNeg45").val());


    $("#temp_modneg1").parent().parent().hide();
    $("#temp_modneg2").parent().parent().hide();
    $("#temp_modneg3").parent().parent().hide();
    $("#temp_modneg4").parent().parent().hide();

    $("#temp_valNeg11_label").parent().hide();
    $("#temp_valNeg12_label").parent().hide();
    $("#temp_valNeg13_label").parent().hide();
    $("#temp_valNeg14_label").parent().hide();
    $("#temp_valNeg15_label").parent().hide();
    $("#temp_valNeg21_label").parent().hide();
    $("#temp_valNeg22_label").parent().hide();
    $("#temp_valNeg23_label").parent().hide();
    $("#temp_valNeg24_label").parent().hide();
    $("#temp_valNeg25_label").parent().hide();
    $("#temp_valNeg31_label").parent().hide();
    $("#temp_valNeg32_label").parent().hide();
    $("#temp_valNeg33_label").parent().hide();
    $("#temp_valNeg34_label").parent().hide();
    $("#temp_valNeg35_label").parent().hide();
    $("#temp_valNeg41_label").parent().hide();
    $("#temp_valNeg42_label").parent().hide();
    $("#temp_valNeg43_label").parent().hide();
    $("#temp_valNeg44_label").parent().hide();
    $("#temp_valNeg45_label").parent().hide();


    if ($("#tiponegocio1_label").text() == "") {
        $("#tiponegocio1_label").parent().hide();
    }
    if ($("#tiponegocio2_label").text() == "") {
        $("#tiponegocio2_label").parent().hide();
    }
    if ($("#tiponegocio3_label").text() == "") {
        $("#tiponegocio3_label").parent().hide();
    }
    if ($("#tiponegocio4_label").text() == "") {
        $("#tiponegocio4_label").parent().hide();
    }

    if ($("#chkvalNeg11_label").text() == "--") {
        $("#chkvalNeg11_label").hide();
        $("#chkvalNeg11").hide();
    }
    if ($("#chkvalNeg12_label").text() == "--") {
        $("#chkvalNeg12_label").hide();
        $("#chkvalNeg12").hide();
    }
    if ($("#chkvalNeg13_label").text() == "--") {
        $("#chkvalNeg13_label").hide();
        $("#chkvalNeg13").hide();
    }
    if ($("#chkvalNeg14_label").text() == "--") {
        $("#chkvalNeg14_label").hide();
        $("#chkvalNeg14").hide();
    }
    if ($("#chkvalNeg15_label").text() == "--") {
        $("#chkvalNeg15_label").hide();
        $("#chkvalNeg15").hide();
    }
    if ($("#chkvalNeg21_label").text() == "--") {
        $("#chkvalNeg21_label").hide();
        $("#chkvalNeg21").hide();
    }
    if ($("#chkvalNeg22_label").text() == "--") {
        $("#chkvalNeg22_label").hide();
        $("#chkvalNeg22").hide();
    }
    if ($("#chkvalNeg23_label").text() == "--") {
        $("#chkvalNeg23_label").hide();
        $("#chkvalNeg23").hide();
    }
    if ($("#chkvalNeg24_label").text() == "--") {
        $("#chkvalNeg24_label").hide();
        $("#chkvalNeg24").hide();
    }
    if ($("#chkvalNeg25_label").text() == "--") {
        $("#chkvalNeg25_label").hide();
        $("#chkvalNeg25").hide();
    }
    if ($("#chkvalNeg31_label").text() == "--") {
        $("#chkvalNeg31_label").hide();
        $("#chkvalNeg31").hide();
    }
    if ($("#chkvalNeg32_label").text() == "--") {
        $("#chkvalNeg32_label").hide();
        $("#chkvalNeg32").hide();
    }
    if ($("#chkvalNeg33_label").text() == "--") {
        $("#chkvalNeg33_label").hide();
        $("#chkvalNeg33").hide();
    }
    if ($("#chkvalNeg34_label").text() == "--") {
        $("#chkvalNeg34_label").hide();
        $("#chkvalNeg34").hide();
    }
    if ($("#chkvalNeg35_label").text() == "--") {
        $("#chkvalNeg35_label").hide();
        $("#chkvalNeg35").hide();
    }
    if ($("#chkvalNeg41_label").text() == "--") {
        $("#chkvalNeg41_label").hide();
        $("#chkvalNeg41").hide();
    }
    if ($("#chkvalNeg42_label").text() == "--") {
        $("#chkvalNeg42_label").hide();
        $("#chkvalNeg42").hide();
    }
    if ($("#chkvalNeg43_label").text() == "--") {
        $("#chkvalNeg43_label").hide();
        $("#chkvalNeg43").hide();
    }
    if ($("#chkvalNeg44_label").text() == "--") {
        $("#chkvalNeg44_label").hide();
        $("#chkvalNeg44").hide();
    }
    if ($("#chkvalNeg45_label").text() == "--") {
        $("#chkvalNeg45_label").hide();
        $("#chkvalNeg45").hide();
    }
}

function detailCambiarTipoNegocio() {

    /*
        $("body *").html(function(buscayreemplaza, reemplaza) {
            return reemplaza.replace('LBL_TIPONEG1', 'Hola');
        });*/

}

function mostrarSuborigen() {

    var origen = $("#tipo_origen").val();

    ocultamosSuborigen();

    if (origen == 1) {
        $("#subor_expande_label").parent().parent().show();
        $("#subor_expande").parent().parent().show();
    } else if (origen == 2) {
        $("#portal_label").parent().parent().show();
        $("#portal").parent().parent().show();
    } else if (origen == 3) {
        $("#expan_evento_id_c_label").parent().parent().show();
        $("#expan_evento_id_c").parent().parent().show();
    } else if (origen == 4) {
        $("#subor_central_label").parent().parent().show();
        $("#subor_central").parent().parent().show();
    } else if (origen == 5) {
        $("#subor_medios_label").parent().parent().show();
        $("#subor_medios").parent().parent().show();
    } else if (origen == 6) {
        $("#subor_mailing_label").parent().parent().show();
        $("#subor_mailing").parent().parent().show();
    }

}


function reenvioInfoEdicion(tipoEnvio, id) {

    if (confirm("¿Esta seguro de que desea reenviar la documentacion " + tipoEnvio + " para la Gestion actual?")) {

        var config = {};
        config.title = "Enviando Correo";
        config.msg = "Espere por favor... ";
        YAHOO.SUGAR.MessageBox.show(config);

        url = 'index.php?entryPoint=reenvioDoc&id=' + id + '&tipoEnvio=' + tipoEnvio;
        $.ajax({
            type: "POST",
            url: url,
            data: "id=" + id + "&tipoEnvio=" + tipoEnvio + "&estadoEdicion=Detalle",
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.indexOf('Ok') != -1) {
                    alert('Se ha reenviado la documentacion de tipo ' + tipoEnvio);
                    switch (tipoEnvio) {
                        case 'C1':
                            $('#chk_envio_documentacion').attr('checked', true);
                            activarFecha("#chk_envio_documentacion", "#envio_documentacion");
                            break;
                        case 'C2':
                            $('#chk_informacion_adicional').attr('checked', true);
                            activarFecha("#chk_informacion_adicional", "#f_informacion_adicional");
                            break;
                        case 'C3':
                            $('#chk_envio_precontrato').attr('checked', true);
                            activarFecha("#chk_envio_precontrato", "#f_envio_precontrato");
                            break;
                        case 'C4':
                            $('#chk_envio_contrato').attr('checked', true);
                            activarFecha("#chk_envio_contrato", "#f_envio_contrato");
                            break;
                    }
                } else {
                    alert('No se ha podido reenviar la información - \\n' + data);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

function reenvioInfoDetalle(tipoEnvio, id) {

    if (confirm("¿Esta seguro de que desea reenviar la documentacion " + tipoEnvio + " para la Gestion actual?")) {

        var config = {};
        config.title = "Enviando Correo";
        config.msg = "Espere por favor... ";
        YAHOO.SUGAR.MessageBox.show(config);

        url = 'index.php?entryPoint=reenvioDoc&id=' + id + '&tipoEnvio=' + tipoEnvio;
        $.ajax({
            type: "POST",
            url: url,
            data: "id=" + id + "&tipoEnvio=" + tipoEnvio + "&estadoEdicion=Detalle",
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.indexOf('Ok') != -1) {
                    alert('Se ha reenviado la documentacion de tipo ' + tipoEnvio);
                    location.reload(true);
                } else {
                    alert('No se ha podido reenviar la información - \\n' + data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

function irAperturas(solicitud) {

    var lista = solicitud.split(" - ");

    var url = "index.php?searchFormTab=basic_search&module=Expan_Apertura&action=index&query=true&orderBy=&sortOrder=&name_basic=" +
        lista[0] + "&current_user_only_basic=0&button=Buscar";
    var win = window.open(url);

}

function envioCorreoInterlocutor(id, tipoEnv) {

    if (confirm("¿Esta seguro de que desea enviar el correo con el cuestionario al consultor?")) {

        var config = {};
        config.title = "Enviando Correo";
        config.msg = "Espere por favor... ";
        YAHOO.SUGAR.MessageBox.show(config);

        url = 'index.php?entryPoint=envioCorreoInterlocutor';
        $.ajax({
            type: "POST",
            url: url,
            data: "id=" + id + "&tipoEnv=" + tipoEnv,
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.indexOf('Ok') != -1) {
                    alert('Se ha enviado el correo de interlocutor correctamente');
                } else {
                    alert('No se ha podido enviar el correo, ' + data);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido enviar el correo - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

function envioCorreoFicha(id, tipoEnv) {

    url = 'index.php?entryPoint=envioCorreoInterlocutor';
    $.ajax({
        type: "POST",
        url: url,
        data: "id=" + id + "&tipoEnv=" + tipoEnv,
        success: function (data) {

        },
        error: function (jqXHR, textStatus, errorThrown) {

            return false;

        }
    });

    return true;
}

function reenvioDoc(tipoEnvio) {

    if (confirm("¿Esta seguro de que desea reenviar la documentacion " + tipoEnvio + " para las Gestiones actuales?")) {

        var config = {};
        config.title = "Enviando Correos";
        config.msg = "Espere por favor... ";
        YAHOO.SUGAR.MessageBox.show(config);

        var idGests = "";
        var lista = document.getElementsByClassName("checkbox");

        for (i = 0; i < lista.length; i++) {
            if (lista[i].checked == true && lista[i].name.indexOf("mass[]") > -1) {//coger los checkbox que interesan
                idGests = idGests + "!" + lista[i].value;
            }
        }

        url = 'index.php?entryPoint=reenvioDocGestiones&gestiones=' + idGests + '&tipoEnvio=' + tipoEnvio;
        $.ajax({
            type: "POST",
            url: url,
            data: "operacion=reenvio&gestiones=" + idGests + "&tipoEnvio=" + tipoEnvio,
            success: function (data) {
                YAHOO.SUGAR.MessageBox.hide();
                if (data.indexOf('No se ha podido') == -1) {
                    alert('Se ha reenviado la documentacion de tipo ' + tipoEnvio + ' para las gestiones seleccionadas');
                } else {
                    alert(data);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                YAHOO.SUGAR.MessageBox.hide();
                alert('No se ha podido enviar la documentación - ' + textStatus + ' - ' + errorThrown);

            }
        });

    } else {
        return false;
    }

}

function envioFicha(tipoEnvio) {
    if (confirm("¿Esta seguro de que desea enviar la ficha a " + tipoEnvio + " para las Gestiones actuales?")) {

        var config = {};
        var enviado;
        config.title = "Enviando Correos";
        config.msg = "Espere por favor... ";
        YAHOO.SUGAR.MessageBox.show(config);

        var idGests = "";
        var lista = document.getElementsByClassName("checkbox");

        for (i = 0; i < lista.length; i++) {
            if (lista[i].checked == true && lista[i].name.indexOf("mass[]") > -1) {//coger los checkbox que interesan
                idGests=lista[i].value;
                enviado = envioCorreoFicha(idGests, tipoEnvio);
            }
        }

        YAHOO.SUGAR.MessageBox.hide();
        if (enviado) {
            alert('Se ha enviado el correo de interlocutor correctamente');
        } else {
            alert('No se ha podido enviar el correo, ' + data);
        }

    } else {
        return false;
    }
}

function validarEnvio(tipoEnvio) {

    var idGests = $('[name="record"]').val();

    url = 'index.php?entryPoint=reenvioDocGestiones';
    $.ajax({
        type: "POST",
        url: url,
        data: "operacion=valida&gestiones=" + idGests + "&tipoEnvio=" + tipoEnvio,
        success: function (data) {

            if (data == 0) {
                alert('No esta validada la plantilla de tipo ' + tipoEnvio +
                    '\n Active el envio personalizado y envielo a traves del correo');
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido evaluar si el template de tipo ' + tipoEnvio + "\n" + textStatus + ' - ' + errorThrown);
        }
    });

}


function abrirHermanas(id) {

    url = 'index.php?entryPoint=gestionesHermanas&id=' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: "id=" + id,
        success: function (data) {

            var gestionesId = data.split("#");

            for (i = 0; i < gestionesId.length; i++) {
                if (gestionesId[i] != id && gestionesId[i] != "") {
                    //alert (gestionesId[i]);
                    window.open('index.php?module=Expan_GestionSolicitudes&action=EditView&record=' + gestionesId[i], gestionesId[i]);
                }
            }
            //alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se han podido abrir las gestiones hermanas - ' + textStatus + ' - ' + errorThrown);
        }
    });

}

function irSolicitud(solicitud) {

    window.open('index.php?module=Expan_Solicitud&action=EditView&record=' + solicitud, solicitud).focus();
    //window.location.href = 'index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DExpan_Solicitud%26action%3DEditView%26record%3D' + solicitud;

}

function irFranquicia(franquicia) {
    window.open('index.php?module=Expan_Franquicia&action=DetailView&record=' + franquicia, franquicia).focus();
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

function activarFecha(check, fecha) {

    if ($(check).is(':checked')) {
        $(fecha).val(Hoy());

    } else {
        $(fecha).val("");
    }
}

function addFechaObserva(linTexto) {

    var texto = $("#observaciones_informe").val();

    var f = new Date();

    fecha = f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();
    texto = texto + ('\n' + fecha + ' : ' + linTexto);
    $("#observaciones_informe").val(texto);

}

function existeTextoObserva(texto) {

    var observa = $("#observaciones_informe").val();

    if (observa.search(texto) == -1) {
        return false;
    } else {
        return true;
    }
}

/*
function activarCanCaliente() {	
	
	var caliente= document.getElementById("candidatura_caliente").checked;

	//Controlamos si se le puee poner a mano el check caliente o no 
	if (document.getElementById("chk_resolucion_dudas").checked == true ||
		document.getElementById("chk_responde_C1").checked == true ||
		document.getElementById("chk_sol_amp_info").checked == true ||	
		document.getElementById("chk_entrevista").checked == true
		) 
	{
		if (document.getElementById("chk_recepcio_cuestionario").checked == true ||
		document.getElementById("chk_informacion_adicional").checked == true ||	
				
		document.getElementById("chk_visitado_fran").checked == true ||
		document.getElementById("chk_envio_precontrato").checked == true ||
		document.getElementById("chk_visita_local").checked == true ||
		document.getElementById("chk_envio_contrato").checked == true ||
		document.getElementById("chk_visita_central").checked == true 	
		){ 
			document.getElementById("candidatura_caliente").disabled = true;
		}
		else{
			document.getElementById("candidatura_caliente").disabled = false;
		}
		
	} else {
		document.getElementById("candidatura_caliente").disabled = true;	
	}
	
	//Contralamos que la candidatura caliente esa checkeada o no
	
	if (document.getElementById("chk_recepcio_cuestionario").checked == true ||
		document.getElementById("chk_informacion_adicional").checked == true ||
		document.getElementById("chk_sol_amp_info").checked == true ||
		document.getElementById("chk_entrevista").checked == true ||
		document.getElementById("chk_visitado_fran").checked == true ||
		document.getElementById("chk_envio_precontrato").checked == true ||
		document.getElementById("chk_visita_local").checked == true ||
		document.getElementById("chk_envio_contrato").checked == true ||
		document.getElementById("chk_visita_central").checked == true 	
	){
		document.getElementById("candidatura_caliente").checked=true;
	}else{
		if (caliente==true){
			document.getElementById("candidatura_caliente").checked=true;
		}else{
			document.getElementById("candidatura_caliente").checked=false;
		}
	}

}
*/

function eliminarAlertaCuestionario(gestion) {
    url = 'index.php?entryPoint=eliminarTareasCuestionario&gestionid=' + gestion;
    $.ajax({
        type: "POST",
        url: url,
        data: "gestionid=" + gestion,
        success: function (data) {
            //alert('Ok');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se han podido eliminar las tareas - ' + textStatus + ' - ' + errorThrown);
        }
    });
}


function abrirGestionConsulta(gestion) {
    window.open('index.php?module=Expan_GestionSolicitudes&action=DetailView&record=' + gestion, gestion).focus();
}

function abrirSolicitudLlamadas(gestion, solicitud) {

    window.open('index.php?module=Expan_Solicitud&action=DetailView&record=' + solicitud, solicitud);
    if (confirm("¿Desea abrir las llamadas asociadas?")) {
        url = 'index.php?entryPoint=recogellamadasGestion&gestionid=' + gestion;
        $.ajax({
            type: "POST",
            url: url,
            data: "gestionid=" + gestion,
            success: function (data) {
                var llamadasId = data.split("#");
                for (i = 0; i < llamadasId.length; i++) {
                    if (llamadasId[i] != "") {
                        window.open('index.php?module=Calls&action=EditView&record=' + llamadasId[i], llamadasId[i]);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('No se han podido abrir las gestiones hermanas - ' + textStatus + ' - ' + errorThrown);
            }
        });

    }
}

function validarEdicion(idGestion) {

    if (//validarEstadoNoAt()==false ||
    //validarEstadoCurso()==false ||
        validarMotivoDescarte() == false ||
        validarRating(idGestion) == false ||
        validarMotivoParada() == false ||
        validarMotivoPositivo() == false ||
        validarModeloDeNegocio() == false ||
        validarPrecontrato() == false) {
        return false;
    }

    return check_form("EditView");

}

function validarPrecontrato() {


    if (document.getElementById("pre_fir1_first_name").value != "") {

        var valida = true;

        if (document.getElementById("pre_fir1_last_name").value == "") {
            $("#pre_fir1_last_name").css("border", "2px solid red");
            valida = false;
        } else {
            $("#pre_fir1_last_name").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("pre_fir1_NIF").value == "") {
            $("#pre_fir1_NIF").css("border", "2px solid red");
            valida = false;
        } else {
            $("#pre_fir1_NIF").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("pre_fir1_vecino").value == "") {
            $("#pre_fir1_vecino").css("border", "2px solid red");
            valida = false;
        } else {
            $("#pre_fir1_vecino").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("pre_fir1_domicilio").value == "") {
            $("#pre_fir1_domicilio").css("border", "2px solid red");
            valida = false;
        } else {
            $("#pre_fir1_domicilio").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("provincia_apertura_pre").value == "") {
            $("#provincia_apertura_pre").css("border", "2px solid red");
            valida = false;
        } else {
            $("#provincia_apertura_pre").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("f_precontrato_firma").value == "") {
            $("#f_precontrato_firma").css("border", "2px solid red");
            valida = false;
        } else {
            $("#f_precontrato_firma").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("entrega_cuenta").value == "") {
            $("#entrega_cuenta").css("border", "2px solid red");
            valida = false;
        } else {
            $("#entrega_cuenta").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("canon_entrada").value == "") {
            $("#canon_entrada").css("border", "2px solid red");
            valida = false;
        } else {
            $("#canon_entrada").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("f_entrega_cuenta_pre").value != "" &&
            document.getElementById("entrega_cuenta").value == "") {
            $("#entrega_cuenta").css("border", "2px solid red");
            valida = false;
        } else {
            $("#entrega_cuenta").css("border", "#94c1e8 solid 1px");
        }

        if (document.getElementById("f_entrega_cuenta_pre").value != "" &&
            document.getElementById("canon_entrada").value == "") {
            $("#canon_entrada").css("border", "2px solid red");
            valida = false;
        } else {
            $("#canon_entrada").css("border", "#94c1e8 solid 1px");
        }

        if (valida == false) {
            alert("No se han rellenado todos los valores del precontrato necesarios");
            return false;
        }
    }

    return true;
}

/**
 * Se comprueba si hay modelos de negocio, si los hay se valida que haya uno seleccionado
 */
function validarModeloDeNegocio() {

    var tipoN1 = document.getElementById("tiponegocio1_label").innerHTML;
    var tipoN2 = document.getElementById("tiponegocio2_label").innerHTML;
    var tipoN3 = document.getElementById("tiponegocio3_label").innerHTML;
    var tipoN4 = document.getElementById("tiponegocio4_label").innerHTML;

    if (tipoN2 == "" && tipoN1 == "" && tipoN3 == "" && tipoN4 == "") {
        //no hay modelos de negocio

    } else {

        if ($("#estado_sol").val() == 2 &&
            document.getElementById("tiponegocio1").checked == false &&
            document.getElementById("tiponegocio2").checked == false &&
            document.getElementById("tiponegocio3").checked == false &&
            document.getElementById("tiponegocio4").checked == false) {
            //ninguno chekeado y hay modelo de negocio
            alert("Se debe seleccionar un modelo de negocio");
            //poner en rojo los modelos de negocio
            document.getElementById("tiponegocio1_label").style.color = "red";
            document.getElementById("tiponegocio2_label").style.color = "red";
            document.getElementById("tiponegocio3_label").style.color = "red";
            document.getElementById("tiponegocio4_label").style.color = "red";
            return false;
        }

    }
}

function validarEstadoNoAt() {

    if (($("#estado_sol option:selected").val() == 1) &&
        $("#motivo_descarte option:selected").val() != "") {
        alert("El motivo de descarte debe estar vacío si el estado de la gestion es 1-No Atendido");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 1) &&
        $("#motivo_parada option:selected").val() != "") {
        alert("El motivo de parada debe estar vacío si el estado de la gestion es 1-No Atendido");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 1) &&
        $("#motivo_positivo option:selected").val() != "") {
        alert("El motivo positivo debe estar vacío si el estado de la gestion es 1-No Atendido");
        return false;
    }

}

function validarEstadoCurso() {

    if (($("#estado_sol option:selected").val() == 2) &&
        $("#motivo_descarte option:selected").val() != "") {
        alert("El motivo de descarte debe estar vacío si el estado de la gestion es 2-En Curso");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 2) &&
        $("#motivo_parada option:selected").val() != "") {
        alert("El motivo de parada debe estar vacío si el estado de la gestion es 2-En Curso");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 2) &&
        $("#motivo_positivo option:selected").val() != "") {
        alert("El motivo positivo debe estar vacío si el estado de la gestion es 2-En Curso");
        return false;
    }

}

function validarMotivoDescarte() {

    if (($("#estado_sol option:selected").val() == 4) &&
        $("#motivo_descarte option:selected").val() == "") {
        alert("El motivo de descarte no puede ser vacío si el estado de la gestion es 4-Descartado");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 4) &&
        $("#motivo_parada option:selected").val() != "") {
        alert("El motivo de parada debe estar vacío si el estado de la gestion es 4-Descartado");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 4) &&
        $("#motivo_positivo option:selected").val() != "") {
        alert("El motivo positivo debe estar vacío si el estado de la gestion es 4-Descartado");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 4) &&
        ($("#motivo_descarte option:selected").val() < 6 ||
            $("#motivo_descarte option:selected").val() == 13 ||
            $("#motivo_descarte option:selected").val() == 14)) {
        alert("Si el candidato ha montado otro negocio, indícalo en la gestión");
    }

    if ($("#estado_sol option:selected").val() == 4 && $("#franq_apertura_desca").val() == "" &&
        ($("#motivo_descarte option:selected").val() == 26 ||
            $("#motivo_descarte option:selected").val() == 27)) {
        alert("Si el candidato ha montado otra franquicia, indicar cual");
        return false;
    }

    if ($("#estado_sol option:selected").val() == 4) {
        return true;
    }

}

function validarMotivoParada() {

    if (($("#estado_sol option:selected").val() == 3) &&
        $("#motivo_descarte option:selected").val() != "") {
        alert("El motivo de descarte debe estar vacío si el estado de la gestion es 3-Parado");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 3) &&
        $("#motivo_parada option:selected").val() == "") {
        alert("El motivo de parada no puede ser vacío si el estado de la gestion es 3-Parado");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 3) &&
        $("#motivo_positivo option:selected").val() != "") {
        alert("El motivo positivo debe estar vacío si el estado de la gestion es 3-Parado");
        return false;
    }

}

function validarMotivoPositivo() {

    if (($("#estado_sol option:selected").val() == 5) &&
        $("#motivo_descarte option:selected").val() != "") {
        alert("El motivo de descarte debe estar vacío si el estado de la gestion es 5-Positivo");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 5) &&
        $("#motivo_parada option:selected").val() != "") {
        alert("El motivo de parada debe estar vacío si el estado de la gestion es 5-Positivo");
        return false;
    }

    if (($("#estado_sol option:selected").val() == 5) &&
        $("#motivo_positivo option:selected").val() == "") {
        alert("El tipo de positivo no puede ser vacío si el estado de la gestion es 5-Positivo");
        return false;
    }

}

function validarRating(idGestion) {

    url = 'index.php?entryPoint=validarGestion&gestionid=' + idGestion + '&tipo=ValidaRating';

    var resp = true;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: "gestionid=" + idGestion + '&tipo=ValidaRating',

        success: function (data) {

            if (data == 1 &&
                $("#rating option:selected").text() == "") {
                alert("El Rating no puede estar vacío si ya se ha contactado ");
                resp = false;
            }
            var evento = $("#expan_evento_id_c option:selected").text();

            if ($("#tipo_origen option:selected").val() == 3 &&
                esFranquiShop(evento) &&
                $("#expan_evento_id_c option:selected").text() == "") {
                alert("El Rating no puede estar vacío si viene de un evento");
                resp = false;
            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se han podido abrir las gestiones hermanas - ' + textStatus + ' - ' + errorThrown);
        }
    });
    return resp;

}

function esFranquiShop(texto) {

    texto = texto.toUpperCase();
    if (texto.indexOf("FRANQUISHOP") == -1) {
        return false;
    } else {
        return true;
    }
}

function ModPaginaLista() {

    $('#create_link').hide();
    $('#create_image').hide();

    $("[href='index.php?module=Expan_GestionSolicitudes&action=EditView&return_module=Expan_GestionSolicitudes&return_action=DetailView']").hide();
    //alert("Llega a la js");
}

function organizarMotivos() {
    estado = document.getElementById("estado_sol").value;

    switch (estado) {
        case "3":
            $("#motivo_parada_label").parent().show();
            $("#f_reactivacion_parado_label").parent().show();
            $("#motivo_descarte_label").parent().hide();
            $("#motivo_positivo_label").parent().hide();

            $("#motivo_descarte").val('');
            $("#motivo_positivo").val('');

            break;
        case "4":
            $("#motivo_parada_label").parent().hide();
            $("#f_reactivacion_parado_label").parent().hide();

            $("#motivo_descarte_label").parent().show();
            $("#motivo_positivo_label").parent().hide();

            $("#f_reactivacion_parado_label").val('');
            $("#motivo_parada").val('');
            $("#motivo_positivo").val('');
            break;
        case "5":
            $("#motivo_parada_label").parent().hide();
            $("#f_reactivacion_parado_label").parent().hide();
            $("#motivo_descarte_label").parent().hide();
            $("#motivo_positivo_label").parent().show();

            $("#f_reactivacion_parado_label").val('');
            $("#motivo_parada").val('');
            $("#motivo_descarte").val('');
            break;
        default:
            $("#motivo_parada_label").parent().hide();
            $("#f_reactivacion_parado_label").parent().hide();
            $("#motivo_descarte_label").parent().hide();
            $("#motivo_positivo_label").parent().hide();

            $("#f_reactivacion_parado_label").val('');
            $("#motivo_parada").val('');
            $("#motivo_descarte").val('');
            $("#motivo_positivo").val('');
            break;
    }

}

function colorearAvanzado() {

    var cdudas = document.getElementById("chk_resolucion_dudas");
    var ccuestionario = document.getElementById("chk_recepcio_cuestionario");
    var cadicional = document.getElementById("chk_informacion_adicional");
    var cautocentral = document.getElementById("chk_autoriza_central");
    var centrevista = document.getElementById("chk_entrevista");
    var czona = document.getElementById("chk_propuesta_zona");
    var cavanzada = document.getElementById("candidatura_avanzada");
    var cavanzadal = document.getElementById("candidatura_avanzada");
    $(cavanzadal).css("background-color", "rgb(236,234,234)");

    var lista = [cdudas, ccuestionario, cadicional, cautocentral, centrevista, czona, cavanzada];

    //Quitamos primero el color
    for (var i = 0; i < lista.length; i++) {
        lista[i].parentNode.style.backgroundColor = "";
    }

    for (i in lista) {
        $(lista[i]).parent().css("background-color", "rgb(236,234,234)");
    }
}

function colorearCaliente() {
    var cvisitado = document.getElementById("chk_visitado_fran");
    var cprecontrato = document.getElementById("chk_envio_precontrato");
    var clocal = document.getElementById("chk_visita_local");
    var copautoriza = document.getElementById("chk_operacion_autorizada");
    var cprecontratop = document.getElementById("chk_envio_precontrato_personal");
    var ccolabora = document.getElementById("chk_posible_colabora");
    var ccaliente = document.getElementById("candidatura_caliente");
    var ccalientel = document.getElementById("candidatura_caliente");
    $(ccalientel).css("background-color", "rgb(219,217,217)");

    var lista = [cvisitado, cprecontrato, clocal, copautoriza, cprecontratop, ccaliente, ccolabora]; // ,
    //	caprobalocal, ccontrato, cvisita, ccolabora, ccontratop, ccontratofirma, );

    //Quitamos primero el color
    for (var i = 0; i < lista.length; i++) {
        lista[i].parentNode.style.backgroundColor = "";
    }

    for (i in lista) {
        $(lista[i]).parent().css("background-color", "rgb(219,217,217)");
    }
}

function colorearPositivo() {

    var ccontratop = document.getElementById("chk_envio_contrato_personal");
    var ccontratofirma = document.getElementById("chk_contrato_firmado");
    var cvisita = document.getElementById("chk_visita_central");
    var cplanpersonal = document.getElementById("chk_envio_plan_financiero_personal");
    var caprobalocal = document.getElementById("chk_aprobacion_local");
    var ccontrato = document.getElementById("chk_envio_contrato");
    var cprefirmado = document.getElementById("chk_precontrato_firmado");

    var lista = [ccontratop, ccontratofirma, cvisita, cplanpersonal, caprobalocal, ccontrato, cprefirmado];

    //Quitamos primero el color
    for (var i = 0; i < lista.length; i++) {
        lista[i].parentNode.style.backgroundColor = "";
    }

    for (i in lista) {
        $(lista[i]).parent().css("background-color", "rgb(128,128,128)");
    }

}

function cambiarAGris(texto) {

    $(texto).css("color", "rgb(152,152,152)");
}

function addDelayFechareactButtons() {

    var div = $('<button/>',
        {
            id: 'add_time_f_react_buttons',
        });

    var M3 = $('<button/>',
        {
            text: '+3M',
            click: function () {
                addTime(3 * 30 * 24, 'f_reactivacion_parado');
                return false;
            }
        });

    var M6 = $('<button/>',
        {
            text: '+6M',
            click: function () {
                addTime(6 * 30.5 * 24, 'f_reactivacion_parado');
                return false;
            }
        });

    var Y1 = $('<button/>',
        {
            text: '+1Y',
            click: function () {
                addTime(365 * 24, 'f_reactivacion_parado');
                return false;
            }
        });

    div.append(M3);
    div.append(M6);
    div.append(Y1);

    $("#f_reactivacion_parado_trigger").parent().append(div);

}

function addDelayFechaInicioButtons() {

    var div = $('<button/>',
        {
            id: 'add_time_f_inicio_buttons',
        });

    var M3 = $('<button/>',
        {
            text: '+3M',
            click: function () {
                addTime(3 * 30 * 24, 'cuando_empezar');
                return false;
            }
        });

    var M6 = $('<button/>',
        {
            text: '+6M',
            click: function () {
                addTime(6 * 30.5 * 24, 'cuando_empezar');
                return false;
            }
        });

    var Y1 = $('<button/>',
        {
            text: '+1Y',
            click: function () {
                addTime(365 * 24, 'cuando_empezar');
                return false;
            }
        });

    div.append(M3);
    div.append(M6);
    div.append(Y1);

    $("#cuando_empezar_trigger").parent().append(div);

}


function addTime(hours, tipo) {

    var now = new Date();
    var nowAdded = new Date(now.getTime() + (hours * 60 * 60 * 1000));

    Fecha = ("0" + nowAdded.getDate()).slice(-2) + "/" + ("0" + (nowAdded.getMonth() + 1)).slice(-2) + "/" + nowAdded.getFullYear();

    if (tipo == "f_reactivacion_parado") {
        $('#f_reactivacion_parado').val(Fecha);
    } else {
        $('#cuando_empezar').val(Fecha);
    }

}

function cargarDocumentos() {
    var gestId = $('[name="record"]').val();
    addPanelDocumentosEnviadosGestion(gestId);
}

function addPanelDocumentosRecibidosGestion(gestId) {

    url = 'index.php?entryPoint=consultarGestion&tipo=RecogeDocumentosRecibidosGestion&gestId=' + gestId;
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeDocumentosRecibidosGestion&gestId=" + gestId,
        success: function (data) {
            var parse = JSON.parse(data);
            var array = documentosGestionJsonToArray(parse);

            var div = $('<div/>',
                {
                    id: 'DocumentosRecibidos',
                    class: 'subpanelTabForm H3',
                    html: '<H3>Documentos Recibidos</H3>',
                });

            tabla = generateTable(array);
            div.append(tabla);
            $("#DocumentosEnviados").after(div);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido cargar documentos recibidos - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

function addPanelDocumentosEnviadosGestion(gestId) {

    url = 'index.php?entryPoint=consultarGestion&tipo=RecogeDocumentosEnviadosGestion&gestId=' + gestId;
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeDocumentosEnviadosGestion&gestId=" + gestId,
        success: function (data) {
            var parse = JSON.parse(data);
            var array = documentosGestionJsonToArray(parse);

            var div = $('<div/>',
                {
                    id: 'DocumentosEnviados',
                    class: 'subpanelTabForm H3',
                    html: '<H3>Documentos Enviados</H3>',
                });

            tabla = generateTable(array);
            div.append(tabla);
            $("#whole_subpanel_history").after(div);
            addPanelDocumentosRecibidosGestion(gestId);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido cargar documentos enviados - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

function documentosGestionJsonToArray(Json) {

    var array = [];

    var arrayIntIni = [];

    arrayIntIni.push('Fecha');
    arrayIntIni.push('Documento');
    arrayIntIni.push('');
    array.push(arrayIntIni);

    for (var i in Json) {

        var arrayInt = [];

        arrayInt.push('<img src="themes/Sugar5/images/Documents.gif?v=1DGI1bi-PiFYhwpnWfZEfg" border="0" alt="Llamadas">');
        arrayInt.push(Json[i].Documento);
        arrayInt.push(Json[i].Fecha);

        array.push(arrayInt);
    }

    return array;

}

function generateTable(lista) {

    var aTable = $('<table/>',
        {
            cellpadding: '0',
            cellspacing: '0',
            width: '100%',
            border: '0',
            id: 'tableTareas',
            class: 'list view',
        });

    var rowCount = lista.length;
    var colmCount = lista[0].length;

    // For loop for adding header .i.e th to our table
    for (var k = 0; k < 1; k++) {
        var fragTrow = $("<tr>", {
            "class": "trClass"
        }).appendTo(aTable);
        for (var j = 0; j < colmCount; j++) {
            $("<th>", {
                "class": "thClass"
            }).prependTo(fragTrow).html(unescapeHTML(lista[k][j]));
        }
    }

    //For loop for adding data .i.e td with data to our dynamic generated table
    for (var i = 1; i < rowCount; i < i++) {
        var fragTrowi = $("<tr>", {
            "class": "oddListRowS1"
        }).appendTo(aTable);
        for (var l = 0; l < colmCount; l++) {
            $("<td>", {
                // "class": "tdClass",
                "scope": "row",
            }).appendTo(fragTrowi).html(unescapeHTML(lista[i][l]));
        }
    }
    return aTable;
}

function unescapeHTML(escapedHTML) {
    if (escapedHTML == null) {
        return null;
    } else {
        return escapedHTML.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&').replace(/&quot;/g, '');
    }
}

function abrirSolicitud(gestion, mode) {

    url = 'index.php?entryPoint=recogeSolicitud&gestion=' + gestion;
    $.ajax({
        type: "POST",
        url: url,
        data: "gestion=" + gestion,
        success: function (data) {
            if (data != "") {//se trata de una gestion
                window.open('index.php?module=Expan_Solicitud&action=' + mode + '&record=' + data, data);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se han podido abrir para edidion la solicitud y la gestion asociada - ' + textStatus + ' - ' + errorThrown);
        }
    });
}

/*
var tmrReady = setInterval(isPageFullyLoaded, 100);
 
function isPageFullyLoaded() {
     if (document.readyState == "loaded" || document.readyState == "complete") {
         subclassForms();
         clearInterval(tmrReady);
     }
 }
  
function submitDisabled(_form, currSubmit) {
     return function () {
         var mustSubmit = true;
         if (currSubmit != null)
             mustSubmit = currSubmit();
  
         var els = _form.elements;
         for (var i = 0; i < els.length; i++) {
             if (els[i].type == "submit")
                 if (mustSubmit)
                     els[i].disabled = true;
         }
         return mustSubmit;
     }
}
  
function subclassForms() {
    for (var f = 0; f < document.forms.length; f++) {
        var frm = document.forms[f];
        frm.onsubmit = submitDisabled(frm, frm.onsubmit);
    }
}*/

