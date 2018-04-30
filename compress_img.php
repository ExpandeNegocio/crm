<?php
    
    $bytesCodificados = base64_encode(file_get_contents("logoENClaim.png"));
    echo $bytesCodificados;
?>