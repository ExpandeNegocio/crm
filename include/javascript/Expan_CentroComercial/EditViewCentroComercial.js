$("#provincia_apertura").change(function () {
    loadMunicipios();
});

function loadMunicipios() {

    var provincia;
    var valSelect;

    provincia = $("#provincia_apertura").val();
    valSelect = $("#localidad_apertura").val();

    url = 'index.php?entryPoint=consultarSolicitud';
    $.ajax({
        type: "POST",
        url: url,
        data: "tipo=RecogeMunicipios&provincia=" + provincia,
        success: function (data) {

            $("#localidad_apertura").empty();
            var parse = JSON.parse(data);
            var listitems = '<option value=""></option>';

            for (var i in parse) {

                listitems += '<option value=' + parse[i].c_provmun + '>' + parse[i].d_municipio + '</option>';
            }
            $("#localidad_apertura").append(listitems);

            $("#poblacion option[value=" + valSelect + "]").attr("selected", true);

        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}