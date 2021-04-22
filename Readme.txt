######################################################################################
MODUL: 			Click&Collect (clickncollect)
VERSION:		1.0.0
RELEASE-DATE:	2021-04-22
AUTHOR:			awids
PLATFORM:		modified eCommerce Shopsoftware 2.0.6.x and higher
######################################################################################

######################################################################################
I N F O R M A T I O N 
######################################################################################

################
# Neue Dateien #
################

- /includes/modules/shipping/clickncollect.php
- /includes/extra/checkout/checkout_requirements/99_clickncollect.php
- /lang/english/extra/clickncollect.php
- /lang/english/modules/shipping/clickncollect.php
- /lang/german/extra/clickncollect.php
- /lang/german/modules/shipping/clickncollect.php
- /templates/tpl_modified_responsive/css/jquery.datetimepicker.css
- /templates/tpl_modified_responsive/javascript/extra/datepicker.js.php
- /templates/tpl_modified_responsive/javascript/jquery.datetimepicker.full.min.js


######################################################################################
I N S T A L L A T I O N
######################################################################################

1. Lade alle Dateien aus dem Ordner NEW_FILES anhand der vorgegebenen Ordner-Struktur
   hoch. Es werden dabei keine Dateien ueberschrieben.
2. Fuehre die Schritte gemaess der nachfolgenden Einbauanleitung durch.
3. Installiere das Modul "Click&Collect" im Backend unter Module > Versand Module und
   nimm die erforderlichen Einstellungen im Modul vor.


######################################################################################
E I N B A U A N L E I T U N G
######################################################################################

#################################################################
# /templates/tpl_modified_responsive/css/general_bottom.css.php #
#################################################################

Fuege nach:

    DIR_TMPL_CSS.'cookieconsent.css',

folgendes ein:

    DIR_TMPL_CSS.'jquery.datetimepicker.css',

#######################################################################
# /templates/tpl_modified_responsive/javascript/general_bottom.js.php #
#######################################################################

Fuege nach:

    DIR_TMPL_JS.'jquery.sidebar.min.js',

folgendes ein:

    DIR_TMPL_JS.'jquery.datetimepicker.full.min.js',
    
