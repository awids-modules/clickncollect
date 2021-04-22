<?PHP
######################################################################################
# MODUL: 			Click&Collect (clickncollect)
# VERSION:			1.0.0
# RELEASE-DATE:		2021-04-22
# AUTHOR:			awids
# PLATFORM:			modified eCommerce Shopsoftware 2.0.6.x and higher
######################################################################################

define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TITLE', 'Click&amp;Collect');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DESCRIPTION', 'Let your customers have the goods they have ordered ready for collection at your store at a specified time.');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY', 'We will put your purchase together for you by the specified time and keep it ready for you to pick up.');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY_CONFIRMATION', 'Pick-Up time: %s - %s');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DAY', 'Pick-Up date:&nbsp;');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TIME', '&nbsp;Pick-Up time:&nbsp;');
define('MODULE_SHIPPING_CLICKNCOLLECT_TEXT_ADDRESS', '<strong>Pick-Up address:</strong>');
define('MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_TITLE', 'Lead time');
define('MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_DESC', 'How many days lead time do you need to get the order ready for collection?');
define('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE_TITLE', 'Public holidays');
define('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE_DESC', 'Enter here in the suggested format the date on which collection should not be possible due to a public holiday. (If the input is empty, holidays are not taken into account.)');
define('MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES_TITLE', 'Forbid days of the week?');
define('MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES_DESC', 'Specify here the days on which collection should not be possible. (If the input is empty, an order can be picked up on any day of the week.)<br><br>0 = Sunday | 1 = Monday | 2 = Tuesday | 3 = Wednesday | 4 = Thursday | 5 = Friday | 6 = Saturday');
define('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES_TITLE', 'Daily pick-up times');
define('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES_DESC', 'Include the daily pick-up times in the suggested format. (If the input is empty, all full hours are displayed.)');
define('MODULE_SHIPPING_CLICKNCOLLECT_THEME_TITLE', 'Theme');
define('MODULE_SHIPPING_CLICKNCOLLECT_THEME_DESC', 'Select the theme for the date / timer picker here.');
define('MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED_TITLE' , 'Allowed Zones');
define('MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED_DESC' , 'Please enter the zones <b>separately</b> which should be allowed to use this modul (e. g. AT,DE (leave empty if you want to allow all zones))');
define('MODULE_SHIPPING_CLICKNCOLLECT_STATUS_TITLE', 'Enable Self Pickup');
define('MODULE_SHIPPING_CLICKNCOLLECT_STATUS_DESC', 'Do you want to offer pickup by the customer?');
define('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER_DESC', 'Sort order of display.');
define('MODULE_SHIPPING_CLICKNCOLLECT_COMPANY_TITLE', 'Company');
define('MODULE_SHIPPING_CLICKNCOLLECT_COMPANY_DESC', 'Enter the company.');
define('MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME_TITLE', 'Firstname');
define('MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME_DESC', 'Enter the firstname.');
define('MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME_TITLE', 'Lastname');
define('MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME_DESC', 'Enter the lastname.');
define('MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS_TITLE', 'Street/No.');
define('MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS_DESC', 'Enter the street/no.');
define('MODULE_SHIPPING_CLICKNCOLLECT_SUBURB_TITLE', 'Addition to address');
define('MODULE_SHIPPING_CLICKNCOLLECT_SUBURB_DESC', 'Enter the addition to address.');
define('MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE_TITLE', 'Postcode');
define('MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE_DESC', 'Enter the postcode.');
define('MODULE_SHIPPING_CLICKNCOLLECT_CITY_TITLE', 'City');
define('MODULE_SHIPPING_CLICKNCOLLECT_CITY_DESC', 'Enter the city.');
define('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY_TITLE', 'Country');
define('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY_DESC', 'Enter the country.');

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