<?PHP
######################################################################################
# MODUL: 			Click&Collect (clickncollect)
# VERSION:			1.0.0
# RELEASE-DATE:		2021-04-22
# AUTHOR:			awids
# PLATFORM:			modified eCommerce Shopsoftware 2.0.6.x and higher
######################################################################################

define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TITLE', 'Click&amp;Collect');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DESCRIPTION', 'Lassen Sie Ihre Kunden die bestellte Ware zu einer angegebenen Wunschzeit in Ihrer Gesch&auml;ftsstelle zur Abholung bereitlegen.');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY', 'Wir stellen Ihnen Ihren Einkauf bis zur angegebenen Wunschzeit zusammen und halten ihn zur Abholung f&uuml;r Sie bereit.');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY_CONFIRMATION', 'Abholzeit: %s - %s Uhr');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DAY', 'Abhol-Datum:&nbsp;');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TIME', '&nbsp;Abhol-Uhrzeit:&nbsp;');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_ADDRESS', '<strong>Abholadresse:</strong>');
define('MODULE_SHIPPING_CLICKNCOLLECT_ERROR_DAY', 'Bitte geben Sie ein Abhol-Datum an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_ERROR_TIME', 'Bitte geben Sie eine Abhol-Zeit an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_TITLE', 'Vorlaufzeit');
define('MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_DESC', 'Wie viele Tage Vorlaufzeit ben&ouml;tigen Sie, um die Bestellung abholfertig zu machen?');
define('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE_TITLE', 'Feiertage');
define('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE_DESC', 'Geben Sie hier im vorgeschlagenen Format an, an welchem Datum keine Abholung aufgrund eines Feiertages m&ouml;glich sein soll. (Ist das Input leer, werden Feiertage nicht ber&uuml;cksichtigt.)');
define('MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES_TITLE', 'Wochentage verbieten?');
define('MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES_DESC', 'Geben Sie hier an, an welchen Tagen keine Abholung m&ouml;glich sein soll. (Ist das Input leer, kann eine Bestellung an jedem Wochentag abgeholt werden.)<br><br>0 = Sonntag | 1 = Montag | 2 = Dienstag | 3 = Mittwoch | 4 = Donnerstag | 5 = Freitag | 6 = Samstag');
define('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES_TITLE', 'T&auml;gliche Abholzeiten');
define('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES_DESC', 'Geben Sie die t&auml;glichen Abholzeiten im vorgeschlagenen Format an. (Ist das Input leer, werden alle vollen Stunden angezeigt.)');
define('MODULE_SHIPPING_CLICKNCOLLECT_THEME_TITLE', 'Theme');
define('MODULE_SHIPPING_CLICKNCOLLECT_THEME_DESC', 'W&auml;hlen Sie hier das Theme f&uuml;r den Date-/Timer-Picker aus.');
define('MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED_TITLE' , 'Erlaubte Zonen');
define('MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED_DESC' , 'Geben Sie <b>einzeln</b> die Zonen an, in welche ein Versand m&ouml;glich sein soll. (z.B. AT,DE (lassen Sie dieses Feld leer, wenn Sie alle Zonen erlauben wollen))');
define('MODULE_SHIPPING_CLICKNCOLLECT_STATUS_TITLE', 'Selbstabholung aktivieren');
define('MODULE_SHIPPING_CLICKNCOLLECT_STATUS_DESC', 'M&ouml;chten Sie Selbstabholung anbieten?');
define('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER_TITLE', 'Sortierreihenfolge');
define('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER_DESC', 'Reihenfolge der Anzeige');
define('MODULE_SHIPPING_CLICKNCOLLECT_COMPANY_TITLE', 'Firmenname');
define('MODULE_SHIPPING_CLICKNCOLLECT_COMPANY_DESC', 'Geben Sie den Firmennamen an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME_TITLE', 'Vorname');
define('MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME_DESC', 'Geben Sie den Vornamen an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME_TITLE', 'Nachname');
define('MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME_DESC', 'Geben Sie den Nachnamen an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS_TITLE', 'Stra&szlig;e/Nr.');
define('MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS_DESC', 'Geben Sie die Stra&szlig;e und Hausnummer an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_SUBURB_TITLE', 'Adresszusatz');
define('MODULE_SHIPPING_CLICKNCOLLECT_SUBURB_DESC', 'Geben Sie den Adresszusatz an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE_TITLE', 'Postleitzahl');
define('MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE_DESC', 'Geben Sie die Postleitzahl an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_CITY_TITLE', 'Ort');
define('MODULE_SHIPPING_CLICKNCOLLECT_CITY_DESC', 'Geben Sie den Ort an.');
define('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY_TITLE', 'Land');
define('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY_DESC', 'Geben Sie das Land an.');

// older shop versions
$version_query = xtc_db_query("SELECT version FROM database_version WHERE id = 1");
$version_result = xtc_db_fetch_array($version_query);
$version = str_replace('MOD_', '', $version_result['version']);
if ($version < '2.0.6.0') {
  // FEIERTAGE
  // Geben Sie hier im vorgeschlagenen Format an, an welchem Datum keine Abholung aufgrund eines Feiertages möglich sein soll. 
  // Ist die Definition leer, werden Feiertage nicht berücksichtigt.
  defined('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE') or define('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE', '"24.12.2021", "25.12.2021", "26.12.2021", "31.12.2021", "01.01.2022"');
  // ABHOL-UHRZEITEN
  // Geben Sie die täglichen Abholzeiten im vorgeschlagenen Format an. 
  // Ist die Definition leer, werden alle vollen Stunden angezeigt.
  defined('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES') or define('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES', '"08:00", "08:15", "08:30", "08:45", "09:00", "09:15"');
}
?>