<?php
class Boton {
  
    function add()
    {
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
                    var botoncunopuntouno=$('<input type="button" name="reenviarcunopuntouno" id="reenviarcunopuntouno" class="button" style="margin-right:5px;" tittle="Reenviar C1.1" onclick="reenvioDoc(\'C1.1\');" value="Reenviar C1.1">');
                    var botoncunopuntodos=$('<input type="button" name="reenviarcunopuntodos" id="reenviarcunopuntodos" class="button" style="margin-right:5px;" tittle="Reenviar C1.2" onclick="reenvioDoc(\'C1.2\');" value="Reenviar C1.2">');
                    var botoncunopuntotres=$('<input type="button" name="reenviarcunopuntontres" id="reenviarcunopuntotres" class="button" style="margin-right:5px;" tittle="Reenviar C1.3" onclick="reenvioDoc(\'C1.3\');" value="Reenviar C1.3">');
                    var botoncunopuntocuatro=$('<input type="button" name="reenviarcunopuntocuatro" id="reenviarcunopuntocuatro" class="button" style="margin-right:5px;" tittle="Reenviar C1.4" onclick="reenvioDoc(\'C1.4\');" value="Reenviar C1.4">');
                    var botoncunopuntocinco=$('<input type="button" name="reenviarcunopuntocinco" id="reenviarcunopuntocinco" class="button" style="margin-right:5px;" tittle="Reenviar C1.5" onclick="reenvioDoc(\'C1.5\');" value="Reenviar C1.5">');
                    
                                        
                    $(".paginationActionButtons").append(botoncuno);
                    $(".paginationActionButtons").append(botoncdos);
                    $(".paginationActionButtons").append(botonctres);
                    $(".paginationActionButtons").append(botonccuatro);
                    $(".paginationActionButtons").append(botoncunopuntouno);
                    $(".paginationActionButtons").append(botoncunopuntodos);
                    $(".paginationActionButtons").append(botoncunopuntotres);
                    $(".paginationActionButtons").append(botoncunopuntocuatro);
                    $(".paginationActionButtons").append(botoncunopuntocinco);
         });
                </script>
EOQ;
                echo $button_code;
                break;
        }
    }
}