// **************************************//
// How to start                          //
// **************************************//

For all enabled modules, there is a new "Generate Document" action in ListView (need at least one record selected) and  new "Generate Document" button in DetailView.
To enable/disable MailMerge Reports for a specific module, go to config interface in Administration module.

Some example templates will be installed by default for the Opportunities module. Please, open MailMerge Reports ListView to see them. 
Then go to Opportunities module (ListView or DetailView) to run some of the examples.

Go to MailMerge Reports module, and click on "Available variables list & Generate basic template" menu. 
Then select one module and select some fields to create a basic template.
Once basic template is created, you can modify it according to your needs.


// **************************************//
// Basic version limitations             //
// **************************************//

The following features are limited in basic version:

  - Related and subpanel modules fields (parent modules and subpanel modules). 
  - Custom fields (created in Studio)
  - MailMerge Reports calculated fields (see "Calculated Fields" section)
  - Limited to 30 records per report  
  - Roles-based permissions to access templates
  - Attach generated documents to Email 
  - Attach generated documents to Note
  
  
// **************************************//
// Premium version notes                 //
// **************************************//  

Related and subpanel module list:
  - Only link fields with 'reportable' = true will be listed in link modules list. The ‘reportable’ default value is true (i.e. if 'reportable' is not defined, 'reportable' will be true)
  - If link field is defined as 'reportable' = false, it will not be listed.
  - If related field is defined as 'ext2' = 'ModuleX' instead 'link' => 'LinkX', the relation will not be listed in module list.  

    
// **************************************//
// Compatibility                         //
// **************************************//

Starting from version 2.0, the component is compatible with SugarCRM PRO, but ...
- MailMerge Reports is not compatible with Sugar On-Demand
- MailMerge Reports can not be installed on SugarCRM with ModuleScanner activated ($sugar_config['moduleInstaller']['packageScan'] = true;)
  

// **************************************//
// Troubleshooting                       //
// **************************************//

Sometimes, specially in Sugar 6.4.X, Opportunities template examples installed by default don't work the first time (the button "Generate Document" doesn't do anything). 
When this occurs, try to refresh Opportunities ListView (click on menu "View Opportunities") or try first to generate basic template through "Available variables list & Generate basic template".

If some labels are missing in interfaces (or value lists) or some PHP warnings about "invalid argument in foreach" then 
try "Quick Repair and Rebuild"  (in SugarCRM Admin->Repair->Quick Repair and Rebuild) and "Rebuild Javascript Languages" (in SugarCRM Admin->Repair->Rebuild Javascript Languages).

If the component doesn't work, try the following:

  - Try "Quick Repair and Rebuild"  (in SugarCRM Admin->Repair->Quick Repair and Rebuild) and "Rebuild Javascript Languages" (in SugarCRM Admin->Repair->Rebuild Javascript Languages)
  
  - Uninstall the component and change the following SugarCRM config.php variables:
         'dir_mode' => 1533,    (Sugar default is 1528)
         'file_mode' => 436,    (Sugar default is 432)
    Then reinstall the component.
  
  - In Linux, check that the file system have the appropriate rights. Try to execute the following commands if needed (substitute SUGARDIR for SugarCRM installation dir, and APACHEUSER for webserver system user) ...
         find SUGARDIR -type d -exec chmod 775 {} \;
         find SUGARDIR -type f -exec chmod 664 {} \;
         chmod 644 SUGARDIR/index.php
         chmod 755 SUGARDIR
         chown -R APACHEUSER:APACHEUSER SUGARDIR
    If more rights are required, change 775 to 777 and 664 to 666 (don't change 644 for index.php)   
    

// **************************************//
// Config Variables                      //
// **************************************//

The following config variables will be created in config_override.php after install (you can go to config interface in Administration module to modify them):

  - $sugar_config['DHA_templates_default_lang']
      Default language for templates. It will affect to dates, numbers and boolean fields format. See Languages section for available options
      
  - $sugar_config['DHA_templates_dir']
      Template files folder. The default value is 'document_templates/'  (slash character included). It must be inside SugarCrm folders structure.
      
  - $sugar_config['DHA_OpenOffice_exe']
      For pdf export. Full path to LibreOffice or Apache OpenOffice exe. 
      Examples :
         [WINDOWS] 'C:\Program Files (x86)\LibreOffice 3.5\program\swriter.exe'     
         [LINUX] '/usr/lib/libreoffice/program/soffice'
         
  - $sugar_config['DHA_OpenOffice_cde']
      For pdf export (Only for Linux). Full path to LibreOffice cde-package (download from http://www.sigisoftware.com/downloads ). 
      Useful for web hosting services where you can't install LibreOffice or Apache OpenOffice.
      Examples :
         [LINUX] '/home/USER_NAME/cde-libreoffice-pdf/libreoffice.cde'   
         [LINUX] '/var/www/vhosts/DOMAIN_NAME/httpdocs/cde-libreoffice-pdf/libreoffice.cde'
         
  - $sugar_config['DHA_OpenOffice_HOME']
      LibreOffice working directory (Only for Linux). Required for PDF generation if HOME system environment variable does not point to a directory that has write permission for the user that runs the web server  
      Example :
         [LINUX] '/tmp'   
         
  - $sugar_config['DHA_templates_historical_enabled_modules']  (array)
      Used only when reinstall component. This parameter not define which modules are enabled, only which modules will be enabled when component is reinstalled.
      If this parameter is not set, when install/reinstall component all modules will be enabled. 
      
  - $sugar_config['DHA_templates_enabled_roles']  (array)  
      Used to store roles-based permissions. Array key is the Role id.
      If this parameter is not set, Roles will have 'ALLOW_ALL' permissions. 
      If a User has multiple Roles assigned, we will use the more restrictive Role. 
      If a User do not have any Role assigned or User is admin, the permission level will be 'ALLOW_ALL'.
      Examples :
         $sugar_config['DHA_templates_enabled_roles']['ea07afb0-a405-3a54-5e67-501666fa4fbf'] = 'ALLOW_ALL';
         $sugar_config['DHA_templates_enabled_roles']['c2350435-9b4c-aac4-814e-4cf6141e08a0'] = 'ALLOW_DOCX';
         $sugar_config['DHA_templates_enabled_roles']['7bea0520-2932-f002-9cad-524c4b2f88ab'] = 'ALLOW_PDF';
         $sugar_config['DHA_templates_enabled_roles']['dead1fdd-b76a-bba0-3ff6-524c4bfada4c'] = 'ALLOW_NONE';
   
Note: 'DHA_OpenOffice_exe' config variable have preference over 'DHA_OpenOffice_cde', so leave empty 'DHA_OpenOffice_exe' if you plan to use 'DHA_OpenOffice_cde'.     

  
// **************************************//
// Languages                             //
// **************************************//

The language selected for templates will affect to dates, numbers and boolean fields format.
There is a global default language ("DHA_templates_default_lang" config variable), but each template will have its own associated language.

Available options:

  'es' => 'Spanish',
  'ca' => 'Catalan',
  'es_AR' => 'Spanish (Argentina)',
  'es_MX' => 'Spanish (Mexico)',  
  'en_US' => 'English (United States)',
  'en_GB' => 'English (United Kingdom)',
  'de' => 'German',
  'fr' => 'French',
  'fr_BE' => 'French (Belgium)',
  'it_IT' => 'Italian',
  'pt_BR' => 'Portuguese (Brazil)',  
  'nl' => 'Dutch',
  'dk' => 'Danish',
  'ru' => 'Russian',
  'sv' => 'Swedish',
  'pl' => 'Polish',
  'bg' => 'Bulgarian',
  'hu_HU' => 'Hungarian',
  'cs' => 'Czech',
  'et' => 'Estonian',
  'lt' => 'Lithuanian',
  'tr_TR' => 'Turkish',
  'he' => 'Hebrew (Israel)',
  'id' => 'Indonesian',
  'sk_SK' => 'Slovak',

If you need to add a new language, follow this steps:
  - Add a new item to 'dha_plantillasdocumentos_idiomas_dom' global list
  - Add a new item in $lang_format_config (in 'modules/DHA_PlantillasDocumentos/lang_format_config.php' file or create new 'custom/modules/DHA_PlantillasDocumentos/lang_format_config.php').

If you need to modify output format in some language, edit 'modules/DHA_PlantillasDocumentos/lang_format_config.php' file or create new 'custom/modules/DHA_PlantillasDocumentos/lang_format_config.php'.

The php date function manual can help you with date formats: http://php.net/manual/en/function.date.php


// **************************************//
// Calculated Fields                     //
// **************************************//

(*) Premium version only

You can create calculated fields for each module by creating a file called 'DHA_DocumentTemplatesCalculatedFields.php' in module folder or in custom/modules folder.
The class name for this files will be "MODULENAME_DocumentTemplatesCalculatedFields" or "CustomMODULENAME_DocumentTemplatesCalculatedFields" (substitute MODULENAME). 
This class can be customized too (custom directory).
All calculated fields will be prefixed with "cf_" automatically.
To create some calculated field, you must override "SetCalcFieldsDefs" and "CalcFields" functions.
With calculated fields class you can undefine some fields too (use "UndefFieldsDefs" function), order rows (use "OrderRows" or "BeforeMergeBlock") or filter rows (use "ShowRow" function) ... even change data before the report is generated (use "BeforeMergeBlock").

See examples in 'custom/modules/Opportunities/DHA_DocumentTemplatesCalculatedFields.php'


// **************************************//
// PDF Documents                         //
// **************************************//

Option 1
-----------
Install LibreOffice (http://libreoffice.org ) or Apache OpenOffice (http://www.openoffice.org ) and set 'DHA_OpenOffice_exe' config variable (see "Config Variables" section) if you want PDF document generation. 
If everything is correctly configured, a new button "Generate PDF Document" will appear beside the "Generate Document" button.

Option 2 (Only for Linux)
-----------
In web hosting services where you can't install LibreOffice or Apache OpenOffice, download LibreOffice cde-package (from http://www.sigisoftware.com/downloads ). 
Unpack tar file anywhere and set 'DHA_OpenOffice_cde' config variable (see "Config Variables" section).
If everything is correctly configured, a new button "Generate PDF Document" will appear beside the "Generate Document" button.
This command will unpack tar file in current directory:
   tar xvzf cde-libreoffice-odt_docx_export_pdf.tar.gz
If pdf generation does not work, try this command to change the owner and group of the cde-package folder to the Apache server user (or any server you are using). 
Substitute APACHE_SERVER_USER and APACHE_SERVER_GROUP to real Apache user and group.
   chown -R APACHE_SERVER_USER:APACHE_SERVER_GROUP cde-libreoffice-pdf
   
Important: cde-package don't work with virtualized servers

Note: 'DHA_OpenOffice_exe' config variable have preference over 'DHA_OpenOffice_cde', so leave empty 'DHA_OpenOffice_exe' if you plan to use 'DHA_OpenOffice_cde'.
Note: Set 'DHA_OpenOffice_HOME' if HOME system environment variable does not point to a directory that has write permission for the user that runs the web server.  


// **************************************//
// Libraries                             //
// **************************************//

MailMerge Reports makes use of these libraries:

   JAVASCRIPT - jQuery 1.7.2 (http://jquery.com) - Only needed until SugarCrm 6.5.0
   JAVASCRIPT - TableSorter 2.0.3 (http://tablesorter.com)
   PHP - TinyButStrong 3.8.1 (http://www.tinybutstrong.com)
   PHP - OpenTBS 1.7.6 (http://www.tinybutstrong.com/plugins)
   ICONS - Fugue Icons (http://p.yusukekamiyamane.com) 

   
// **************************************//
// Contact                               //
// **************************************//

Izertis
soportesigi@izertis.com
www.sigisoftware.com

