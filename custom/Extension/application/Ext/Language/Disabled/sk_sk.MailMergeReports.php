
<?php

$app_list_strings['moduleList']['DHA_PlantillasDocumentos'] = 'Mail Merge Reports';

$app_strings['LBL_YES'] = 'Áno';
$app_strings['LBL_NO'] = 'Nie';
$app_strings['LBL_CURRENCY_ID'] = 'ID meny';
$app_strings['LBL_CURRENCY_NAME'] = 'Názov meny';
$app_strings['LBL_CURRENCY_SYMBOL'] = 'Symbol meny';
$app_strings['LBL_CURRENCY_CODE'] = 'Kód meny';
$app_strings['LBL_CURRENCY_NAME_BASE'] = 'Názov meny (BC)';
$app_strings['LBL_CURRENCY_SYMBOL_BASE'] = 'Symbol meny (BC)';
$app_strings['LBL_CURRENCY_CODE_BASE'] = 'Kód meny (BC)';
$app_strings['LBL_CURRENT_DATE'] = 'Aktuálny dátum';
$app_strings['LBL_CURRENT_WEEKDAY'] = 'Aktuálny deň v týždni';
$app_strings['LBL_DIRECCION_COMPLETA'] = 'Adresa';
$app_strings['LBL_DIRECCION_ALTERNATIVA_COMPLETA'] = 'Alternatívna adresa';
$app_strings['LBL_EN_LETRAS'] = 'slovom';
$app_strings['LBL_GENERAR_DOCUMENTO'] = 'Generovať Dokument';
$app_strings['LBL_GENERAR_DOCUMENTO_PDF'] = 'Generovať PDF Dokument';
$app_strings['LBL_ADJUNTAR_DOCUMENTO_GENERADO_A_EMAIL'] = 'Pripojiť k Email-u';
$app_strings['LBL_ADJUNTAR_DOCUMENTO_GENERADO_A_NOTA'] = 'Pripojiť k poznámke (Note)';
$app_strings['LBL_NO_HAY_PLANTILLAS_DISPONIBLES_PARA_GENERAR_DOCUMENTO'] = 'Nie sú dostupné žiadne šablóny pre Vygenerovanie dokumentu';


$app_list_strings['dha_boolean_list']=array (
  '' => '',  
  '1' => 'Áno',
  '0' => 'Nie',
);

$app_list_strings['dha_plantillasdocumentos_status_dom']=array (
  '' => '',
  'Active' => 'Aktívny',
  'Draft' => 'Koncept',
  'Under Review' => 'V revízii',
  'Pending' => 'Očakávaný',    
  'Expired' => 'Vypršaný',
  'Canceled' => 'Zrušený',
);

$app_list_strings['dha_plantillasdocumentos_category_dom']=array (
  '' => '',
  'VENTAS' => 'Obchod',
  'MARKETING' => 'Marketing',  
  'ACTIVIDADES' => 'Aktivity',
  'CALLCENTER' => 'Callcentrum',
  'JURIDICO' => 'Právne',
  'ADMINISTRACION' => 'Administratíva',
  'COLABORACION' => 'Spolupráca',  
  'CONFIGURACION' => 'Nastavenia', 
  'SOPORTE' => 'Podpora', 
  'OTROS' => 'Ostatné', 
);

$app_list_strings['dha_plantillasdocumentos_subcategory_dom']=array (
  '' => '',
);

// Note: esta lista se rellenará dinamicamente
$app_list_strings['dha_plantillasdocumentos_module_dom']=array (
  '' => '',
);

// Nota: esta lista se rellenará dinamicamente
$app_list_strings['dha_plantillasdocumentos_roles_dom']=array (
  '' => '',
);


$app_list_strings['dha_plantillasdocumentos_idiomas_dom']=array (
  'es' => 'Španielsky',
  'ca' => 'Katalánsky',
  'es_AR' => 'Španielsky (Argentína)',
  'es_MX' => 'Španielsky (Mexiko)',  
  'en_US' => 'Anglicky (USA)',
  'en_GB' => 'Anglicky (Veľká Británia)',
  'de' => 'Nemecky',
  'fr' => 'Francúzsky',
  'fr_BE' => 'Francúzsky (Belgicko)',
  'it_IT' => 'Taliansky',
  'pt_BR' => 'Portugalsky (Brazília)',  
  'nl' => 'Holandsky',
  'dk' => 'Dánsky',
  'ru' => 'Rusky',
  'sv' => 'Švédsky',
  'pl' => 'Poľsky',
  'bg' => 'Bulharsky',
  'hu_HU' => 'Maďarsky',
  'cs' => 'Česky',
  'et' => 'Estónsky',
  'lt' => 'Litovsky',
  'tr_TR' => 'Turecky',
  'he' => 'Hebrejsky (Izrael)',
  'id' => 'Indonézsky',
  'sk_sk' => 'Slovensky', // Slovak (Slovakia)
);

$app_list_strings['dha_plantillasdocumentos_formatos_ficheros_dom']=array (
  'DOCX' => 'Office Open XML (.docx)',
  'ODT' => 'OpenDocument (.odt)',
  'DOCM' => 'Office Open XML Macros Enabled (.docm)',  
);

$app_list_strings['dha_plantillasdocumentos_enable_roles_dom']=array (
  'ALLOW_ALL' => 'Všetky',
  'ALLOW_DOCX' => 'Iba DOCX/ODT',  
  'ALLOW_PDF' => 'Iba PDF',
  'ALLOW_NONE' => 'Žiadne',
);
