 <?php
    echo "Inicia proceso<BR>";
    
    $db = DBManagerFactory::getInstance();
    
    $query="SHOW FULL PROCESSLIST";
    $result = $db -> query($query, true);
    
    $myArrayProcess=array();
    $i=0;

    while ($row = $db -> fetchByAssoc($result)) {
                              
        if (  $row["Time"] > 100 && 
        $row["Command"]=='Sleep') {
            
            $myArrayProcess[$i]=$row["Id"];
            echo $row["Id"].$row["Command"].'<BR>';
            $i++;
        }
    }
    
    foreach ($myArrayProcess as $clave => $valor) {
        $sql='kill '.$myArrayProcess[$clave];
        $result = $db -> query($sql);
       echo $clave."-". $sql.'<BR>';
    }
    
    echo "Proceso terminado";
?>