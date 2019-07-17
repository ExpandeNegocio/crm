<?php
$GLOBALS['app_list_strings']['departamento_list']=array (
  '' => '',
  1 => 'Intermediacion',
  2 => 'Marqueting',
  3 => 'Direccion',
);
$GLOBALS['app_list_strings']['cuando_empezar_list']=array (
  '' => '',
  1 => 'inmediatamente',
  2 => 'en 6 meses',
  3 => 'en 1 año o más',
  4 => 'a largo plazo',
);

$GLOBALS['app_list_strings']['poblacion_minima_list']=array (
  '' => '',
  1 => 'sin minimo',
  3 => '5.000',
  4 => '10.000',
  5 => '15.000',
  6 => '20.000',
  7 => '25.000',
  8 => '40.000',
  9 => '50.000',
  10 => '75.000',
  11 => '100.000',
  12 => '150.000',
  13 => '200.000',
  14 => '> 200.000',
);
$GLOBALS['app_list_strings']['situacion_profesional_list']=array (
  '' => '',
  1 => 'Por cuenta ajena',
  2 => 'Por cuenta propia',
  3 => 'En busqueda',
);
$app_strings['LBL_GROUPTAB5_1402072762'] = 'ExpandeNegocio';

$GLOBALS['app_list_strings']['provincias_list']=array (
  2 => 'Albacete',
  3 => 'Alicante',
  4 => 'Almeria',
  1 => 'Álava',
  33 => 'Asturias',
  5 => 'Ávila',
  6 => 'Badajoz',
  7 => 'Baleares',
  8 => 'Barcelona',
  48 => 'Bizkaia',
  9 => 'Burgos',
  10 => 'Cáceres',
  11 => 'Cádiz',
  39 => 'Cantabria',
  12 => 'Castellón/Castelló',
  51 => 'Ceuta',
  13 => 'Ciudad Real',
  14 => 'Córdoba',
  15 => 'La Coruña',
  16 => 'Cuenca',
  20 => 'Gipuzkoa',
  17 => 'Girona',
  18 => 'Granada',
  19 => 'Guadalajara',
  21 => 'Huelva',
  22 => 'Huesca',
  23 => 'Jaén',
  24 => 'León',
  25 => 'Lleida',
  27 => 'Lugo',
  28 => 'Madrid',
  29 => 'Málaga',
  52 => 'Melilla',
  30 => 'Murcia',
  31 => 'Navarra',
  32 => 'Ourense',
  34 => 'Palencia',
  35 => 'Las Palmas',
  36 => 'Pontevedra',
  26 => 'La Rioja',
  37 => 'Salamanca',
  38 => 'Santa Cruz de Tenerife',
  40 => 'Segovia',
  41 => 'Sevilla',
  42 => 'Soria',
  43 => 'Tarragona',
  44 => 'Teruel',
  45 => 'Toledo',
  46 => 'Valencia',
  47 => 'Valladolid',
  49 => 'Zamora',
  50 => 'Zaragoza',
);
$GLOBALS['app_list_strings']['perfil_fran_list']=array (
  '' => '',
  1 => 'Autoempleo',
  2 => 'Gestor',
  3 => 'Inversor',
  4 => 'Corner',
  5 => 'Colaborador',
);

$GLOBALS['app_list_strings']['tipo_mailing_list']=array (
  '' => '',
  'crm' => 'Desde CRM',
  'ext' => 'Desde herramienta externa',
  'mdf' => 'Medio de franquicias',
  'mds' => 'Medio sectorial',
  'fer' => 'Ferias',  
);

// Recojo valores de Franquicias *********/
$db =  DBManagerFactory::getInstance();
$query = "select id,name,tipo_cuenta from expan_franquicia ";
$query = $query."where deleted=0 AND "; 
$query = $query."(tipo_cuenta=1 OR  tipo_cuenta=2 OR tipo_cuenta=9) "; 
$query = $query."order by name";
 
// Realizo consulta para obtener los datos de mi lista desplegable
$result = $db->query($query, true);
 
// Agrego valor por defecto
$myArrayFran[''] = '';
$myArrayTempla[''] = '';
 
// Agrego entradas a la lista
while ($row = $db->fetchByAssoc($result)){   
    $myArrayFran[$row['id']] = $row['name'];
    if ($row['tipo_cuenta']==1 || $row['tipo_cuenta']==2){
        $myArrayTempla[$row['id'].'#1']=$row['name'].'-Correo 1';
        $myArrayTempla[$row['id'].'#2']=$row['name'].'-Correo 2';
        $myArrayTempla[$row['id'].'#3']=$row['name'].'-Correo 3';
    }
}
 
// Defino lista desplegable de franquicas y templates
$GLOBALS['app_list_strings']['franquicia_list']=$myArrayFran;
$GLOBALS['app_list_strings']['emailTemplates_type_list']=$myArrayTempla;
$GLOBALS['app_list_strings']['emailTemplates_type_list_no_workflow']=$myArrayTempla;
/******************************/

//Recojo los eventos
$myArrayEvento[''] = '';
$db =  DBManagerFactory::getInstance();
$query = "select id,name from expan_evento where deleted=0";

$result = $db->query($query, true);

while ($row = $db->fetchByAssoc($result)){       
    $myArrayEvento[$row['id']] = $row['name'];    
}

$GLOBALS['app_list_strings']['eventos_list']=$myArrayEvento;
/**************************/
    
$GLOBALS['app_list_strings']['capital_list']=array (
  '' => '',
  1 => 'menos de 20.000 €',
  2 => '20.000 - 50 000 €',
  3 => '50.000 - 90.000 €',
  4 => '90.000 - 150.000 €',
  5 => 'más de 150.000 €',
  6 => 'otros',
);
$GLOBALS['app_list_strings']['estado_sol_list']=array (
  '' => '',
  1 => '1-No Atendido',
  2 => '2-En curso',
  3 => '3-Parado por el candidato',
  4 => '4-No localizado',
  5 => '5-Zona de no interés',
  6 => '6-Datos erroneos',
  7 => '7-Descartado por nosotros',
  8 => '8-Descartado por el candidato',
  9 => '9-Colaboración con central',
  10 => '10-Franquiciado',
);

$GLOBALS['app_list_strings']['portal_list']=array (
  1 => 'Veonegocio.com',
  2 => '100franquicias',
  3 => 'Franquiciasaldia',
  4 => 'FarnquiciaDirecta',
  5 => 'InfoFranquicias',
  6 => 'TopFranquicias',
  7 => 'ForoFranquicias',
  8 => 'Franquicia.net',
  9 => 'Franquicias y Negocios',
  10 => 'ZonaFranquicias',
  '' => '',
);

$GLOBALS['app_list_strings']['papel_list']=array (
  1 => 'Quiero dedicarme en exclusiva a este proyecto',
  2 => 'Pretendo compaginar este proyecto con mi trabajo actual',
  3 => 'Aporto el capital de la inversión del proyecto',
  4 => 'Pretende ser un complemento dentro de actual negocio',
  '' => '',
);




