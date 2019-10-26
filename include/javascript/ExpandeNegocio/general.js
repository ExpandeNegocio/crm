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

function despliegoPliegoSector(nombreSector) {

    nombreSector = nombreSector.split(' ').join('_');

    CamposImput = document.getElementsByName(nombreSector);

    for (var i = 0; i < CamposImput.length; i++) {
        if (CamposImput[i].parentNode.style.display == '') {
            CamposImput[i].parentNode.style.display = 'none';
        } else {
            CamposImput[i].parentNode.style.display = null;
        }
    }
}