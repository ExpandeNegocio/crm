$("#observaciones").bind("keyup", function () {
    if (window.event.keyCode == 13) {
        addFechaObserva("");
    }
});

function addFechaObserva(linTexto) {

    var texto = $("#observaciones").val();

    var f = new Date();

    fecha = f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();
    texto = texto + ('\n' + fecha + ' : ' + linTexto);
    $("#observaciones").val(texto);

}