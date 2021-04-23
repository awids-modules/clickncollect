# MODUL: Click&Collect (clickncollect)
<img src="https://raw.githubusercontent.com/awids-modules/clickncollect/main/images/clickncollect.png" alt="Click&Collect" />

VERSION: 1.0.1 / RELEASE-DATE: 2021-04-22 / AUTHOR: awids / PLATFORM: modified eCommerce Shopsoftware 2.0.x.x and higher


## I N F O R M A T I O N 

### Unterschiede bei Shopversionen von 2.0.0.0 bis 2.0.5.1

1. Da Shopversionen vor 2.0.6.0 in der /checkout_shipping.php noch keine Ausgabe für Error-Messages haben, greift hier ein Fallback, der die Error-Message bei Nicht-Ausfüllen der Datums-/Uhrzeit-Auswahl direkt in den Tab der Versandweise einblendet.
2. Shopversionen 2.0.0.0 bis 2.0.4.2 haben noch keinen extra-Ordner im Javascript-Verzeichnis. Der Inhalt muss daher an anderer Stelle eingefügt werden. (Siehe    Schritt 4 in der Installationsanleitung!)
3. Siehe Schritt 4 in der Installations-Anleitung! Wegen dem Umwandeln der Werte in HTML-Entitäten (aus Anführungszeichen wird z. B. <code>&quot;</code>) müssen diese  bei Shopversion unter 2.0.6.0 manuell in die Sprachdateien eingefügt werden.

### Neue Dateien

- /images/icons/shipping_clickncollect.png (v1.0.1)
- /includes/modules/shipping/clickncollect.php (v1.0.0)
- /includes/modules/payment/cash_on_collect.php (v1.0.2)
- /includes/extra/checkout/checkout_requirements/99_clickncollect.php (v1.0.0)
- /lang/english/extra/clickncollect.php (v1.0.0)
- /lang/english/modules/shipping/clickncollect.php (v1.0.0)
- /lang/english/modules/payment/cash_on_collect.php (v1.0.2)
- /lang/german/extra/clickncollect.php (v1.0.0)
- /lang/german/modules/shipping/clickncollect.php (v1.0.0)
- /lang/german/modules/payment/cash_on_collect.php (v1.0.2)
- /templates/tpl_modified/css/jquery.datetimepicker.css (v1.0.1)
- /templates/tpl_modified/javascript/extra/datepicker.js.php (v1.0.1)
- /templates/tpl_modified/javascript/jquery.datetimepicker.full.min.js (v1.0.1)
- /templates/tpl_modified_responsive/css/jquery.datetimepicker.css (v1.0.0)
- /templates/tpl_modified_responsive/javascript/extra/datepicker.js.php (v1.0.0)
- /templates/tpl_modified_responsive/javascript/jquery.datetimepicker.full.min.js (v1.0.0)
- /templates/tpl_boxed_responsive/css/jquery.datetimepicker.css (v1.0.1)
- /templates/tpl_boxed_responsive/javascript/extra/datepicker.js.php (v1.0.1)
- /templates/tpl_boxed_responsive/javascript/jquery.datetimepicker.full.min.js (v1.0.1)


## I N S T A L L A T I O N

1. Lade alle Dateien aus dem Ordner NEW_FILES anhand der vorgegebenen Ordner-Struktur hoch. Es werden dabei keine Dateien ueberschrieben.
2. Fuehre die Schritte gemaess der nachfolgenden Einbauanleitung durch.
3. Installiere das Modul "Click&Collect" im Backend unter Module > Versand Module und nimm die erforderlichen Einstellungen im Modul vor.
4. <b>NUR Shopversionen 2.0.0.0 - 2.0.4.2:</b>
   Trage den Inhalt der Datei:
   
   - /templates/dein_template/javascript/extra/datepicker.js.php
   
   ganz unten in die:
   
   - /templates/dein_template/javascript/general_bottom.js.php
   
   ein.
   
   <b>NUR Shopversionen 2.0.0.0 - 2.0.5.1:</b>
   Trage Feiertage und gewünschte Abholzeiten ganz unten in den Dateien:

   - /lang/english/modules/shipping/clickncollect.php
   - /lang/german/modules/shipping/clickncollect.php

   ein. Der Format ist schon vorgegeben. Lässt du die Definitionen leer, erfolgt keine
   Einschränkung im jeweiligen Bereich.


## E I N B A U A N L E I T U N G

### /templates/tpl_modified_responsive/css/general_bottom.css.php

Füge nach:

    DIR_TMPL_CSS.'cookieconsent.css',

folgendes ein:

    DIR_TMPL_CSS.'jquery.datetimepicker.css',


### /templates/tpl_modified_responsive/javascript/general_bottom.js.php

Füge nach:

    DIR_TMPL_JS.'jquery.sidebar.min.js',

folgendes ein:

    DIR_TMPL_JS.'jquery.datetimepicker.full.min.js',
    
