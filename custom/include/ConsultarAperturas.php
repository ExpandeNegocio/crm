<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    require_once ('data/SugarBean.php');
    require_once ('modules/Expan_Apertura/Expan_Apertura.php');

    $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaApertura]Inicio' );

    $db = DBManagerFactory::getInstance();

    $tipo=$_POST["tipo"];
    $provincia=$_POST["provincia"];
    $franquicia=$_POST["franquicia"];
    $otra_franquicia=$_POST["otra_franquicia"];
    $aperturaId=$_POST["aperturaId"];
    
    $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultarAperturas]Consulta-'.$query);

    switch ($tipo) {
        case 'duplicados':
            $Apertura= new Expan_Apertura();
            $repetida=$Apertura->aperturaRepetida($provincia,$franquicia,$otra_franquicia,$aperturaId);
            
            $GLOBALS['log'] -> info('[ExpandeNegocio][ConsultaApertura]EsRepetida' );
            
            if ($repetida==true){
                echo 'true';
            }else{
                echo 'false';
            }

            break;

        default:

            break;
    }

?>
