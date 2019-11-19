

$("#provincia").change(function () {
    loadMunicipios();
});

function CargaProvMun(){

    var prov= $("#provincia_apertura_1_detailblock").text().trim();
    var localidad=$("#localidad_apertura_1_detailblock").text().trim();

    $("#provincia option").each(function () {
        if ($(this).html() == prov) {
            $(this).attr("selected", "selected");
            return;
        }
    });

    $("#localidad option").each(function () {
        if ($(this).html() == localidad) {
            $(this).attr("selected", "selected");
            return;
        }
    });

 /*   $("#provincia option:contains(" + prov + ")").attr('selected', 'selected');
    $("#localidad option:contains(" + localidad + ")").attr('selected', 'selected');*/
}

function loadMunicipios() {

    var provincia;

    var valSelect;

    provincia = $("#provincia").val();
    valSelect = $("#localidad").val();

    url = 'index.php?entryPoint=consultarSolicitud';
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeMunicipios&provincia=" + provincia,
        success: function (data) {

            $("#localidad").empty();
            var parse = JSON.parse(data);
            var listitems = '<option value=""></option>';

            for (var i in parse) {
                listitems += '<option value=' + parse[i].c_provmun + '>' + parse[i].d_municipio + '</option>';
            }

            $("#localidad").append(listitems);

            $("#localidad[value=" + valSelect + "]").attr("selected", true);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('No se ha podido cargar los documntos Entrantes- ' + textStatus + ' - ' + errorThrown);
        }
    });

}