<?php
class Boton {
  
    function add()
    {
        // Based on what action we're in, add some buttons!
        switch ($GLOBALS['app']->controller->action) 
        {
            case "listview": // Add buttons to List View
                $button_code = <<<EOQ
                <script type="text/javascript">
                    $(document).ready(function(){
                    var botoncuno=$('<input type="button" name="reenviarcuno" id="reenviarcuno" class="button" style="margin-right:5px;" tittle="Reenviar C1" onclick="reenvioDoc(\'C1\');" value="Reenviar C1">');
                    var botoncdos=$('<input type="button" name="reenviarcdos" id="reenviarcdos" class="button" style="margin-right:5px;" tittle="Reenviar C2" onclick="reenvioDoc(\'C2\');" value="Reenviar C2">');
                    var botonctres=$('<input type="button" name="reenviarctres" id="reenviarctres" class="button" style="margin-right:5px;" tittle="Reenviar C3" onclick="reenvioDoc(\'C3\');" value="Reenviar C3">');
                    var botonccuatro=$('<input type="button" name="reenviarcuatro" id="reenviarccuatro" class="button" style="margin-right:5px;" tittle="Reenviar C4" onclick="reenvioDoc(\'C4\');" value="Reenviar C4">');
                    
                    $(".paginationActionButtons").append(botoncuno);
                    $(".paginationActionButtons").append(botoncdos);
                    $(".paginationActionButtons").append(botonctres);
                    $(".paginationActionButtons").append(botonccuatro);
         });
                </script>
EOQ;
                echo $button_code;
                break;
        }
    }
}