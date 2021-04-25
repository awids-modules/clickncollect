<?PHP
######################################################################################
# MODUL: Click&Collect (clickncollect)
# VERSION: 1.0.2
# RELEASE-DATE: 2021-04-25
# AUTHOR: awids
# PLATFORM: modified eCommerce Shopsoftware 2.0.x.x
######################################################################################

class clickncollect {
    var $code, $title, $description, $icon, $enabled;

    function __construct() {
        $this->code = 'clickncollect';
        $this->title = MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'shipping_clickncollect.png';
        $this->tax_class = ((defined('MODULE_SHIPPING_CLICKNCOLLECT_TAX_CLASS')) ? MODULE_SHIPPING_CLICKNCOLLECT_TAX_CLASS : '');
        $this->sort_order = ((defined('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER')) ? MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER : '');
        $this->enabled = ((defined('MODULE_SHIPPING_CLICKNCOLLECT_STATUS') && MODULE_SHIPPING_CLICKNCOLLECT_STATUS == 'True') ? true : false);

        if ($this->check() > 0) {
          if (!defined('MODULE_SHIPPING_CLICKNCOLLECT_TAX_CLASS')) {
            xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_TAX_CLASS', '0', '6', '0', 'xtc_get_tax_class_title', 'xtc_cfg_pull_down_tax_classes(', now())");
          }
        }
    }

    function quote($method = '') {
        global $PHP_SELF, $messageStack;
        
        $text_way_additional = '';
        if (basename($PHP_SELF) != FILENAME_SHOPPING_CART && MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME > 0) {
		  $preTime = ((MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME == 1) ? MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_ONE : MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME_MORE);
		  $text_way_additional = sprintf($preTime, MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME);
		}

        $errors = '';
        if (basename($PHP_SELF) != FILENAME_SHOPPING_CART) {
          if ($messageStack->size('checkout_shipping') > 0 && $this->version() < '2.0.6.0') {
		    $errors = '<div class="errormessage">'.$messageStack->output('checkout_shipping').'</div>';
		  }
		}
        
        $collect = '';
        if (basename($PHP_SELF) != FILENAME_SHOPPING_CART) {
          $collectDate = ((isset($_SESSION['shipping']['collectDate']) && !empty($_SESSION['shipping']['collectDate'])) ? $_SESSION['shipping']['collectDate'] : '');
          $collectTime = ((isset($_SESSION['shipping']['collectTime']) && !empty($_SESSION['shipping']['collectTime'])) ? $_SESSION['shipping']['collectTime'] : '');
          $collect = '<br>'.$errors.'<br>
	    		      <div class="highlightbox checkoutborder">
		    			'.MODULE_SHIPPING_CLICKNCOLLECT_TEXT_DAY.xtc_draw_input_field('collectDate', $collectDate, 'id="collectDate" style="width: 100px"').
		    			  MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TIME.xtc_draw_input_field('collectTime', $collectTime, 'id="collectTime" style="width: 60px"').'
	    		      </div>
	    		      <br>'.MODULE_SHIPPING_CLICKNCOLLECT_TEXT_ADDRESS;
		}

        $address_format = '';
        if (basename($PHP_SELF) != FILENAME_SHOPPING_CART) {
          $address = $this->address();
          if ($address !== false) {
            $address_format = '<span class="address_pickup" style="display:block;">'.xtc_address_format($address['format_id'], $address, true, ' ', '<br>').'</span>';
          }
        }
        
        $this->quotes = array(
            'id' => $this->code,
            'module' => MODULE_SHIPPING_CLICKNCOLLECT_TEXT_TITLE
        );

        $this->quotes['methods'] = array(array(
            'id'    => $this->code,
            'title' => MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY.$text_way_additional.$collect.$address_format,
            'cost'  => 0
        ));
       
        if(xtc_not_null($this->icon)) {
            $this->quotes['icon'] = xtc_image($this->icon, $this->title, '40', '40', 'style="float:left;margin: 0px 5px 5px 0px;"');
        }

        return $this->quotes;
    }
    
    function ignore_cheapest() {
        return true;
    }

    function display_free() {
        return true;
    }
    
    function address() {
        $address = false;
        
        if (defined('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY')
            && (int)MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY > 0
            )
        {
          $country_query =  xtc_db_query("SELECT *
                                            FROM ".TABLE_COUNTRIES." 
                                           WHERE countries_id = '".(int)MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY."'");
          $country = xtc_db_fetch_array($country_query);
        
          $address = array(
            'gender' => '',
            'firstname' => MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME,
            'lastname' => MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME,
            'company' => MODULE_SHIPPING_CLICKNCOLLECT_COMPANY,
            'street_address' => MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS,
            'suburb' => MODULE_SHIPPING_CLICKNCOLLECT_SUBURB,
            'city' => MODULE_SHIPPING_CLICKNCOLLECT_CITY,
            'postcode' => MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE,
            'zone_id' => -1,
            'country' => array(
              'id' => $country['countries_id'],
              'title' => $country['countries_name'],
              'iso_code_2' => $country['countries_iso_code_2'],
              'iso_code_3' => $country['countries_iso_code_3'],
            ),
            'country_id' => $country['countries_id'],
            'format_id' => $country['address_format_id'],
          );
        }
        
        return $address;
    }
    
    function session($method, $module, $quote) {
        if (isset($_POST['collectDate'])) {
            $_SESSION['shipping']['collectDate'] = $_POST['collectDate'];
        }
        if (isset($_POST['collectTime'])) {
            $_SESSION['shipping']['collectTime'] = $_POST['collectTime'];
        }
        $_SESSION['shipping']['title'] = $quote[0]['module'].((trim(MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY_CONFIRMATION) != '') ? ' ('.sprintf(MODULE_SHIPPING_CLICKNCOLLECT_TEXT_WAY_CONFIRMATION ,$_SESSION['shipping']['collectDate'], $_SESSION['shipping']['collectTime']).')' : '');
    }
    
    function check() {
        $check = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_SHIPPING_CLICKNCOLLECT_STATUS'");
        $check = xtc_db_num_rows($check);

        return $check;
    }

    function install()  {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_STATUS', 'True', '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED', '', '6', '2', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER', '0', '6', '3', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE', '01.01,01.05,03.10,24.12,25.12,26.12,31.12', '6', '4', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES', '08:00,08:15,08:30,08:45,09:00,09:15', '6', '4', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME', '0', '6', '4', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES', '0, 6', '6', '4', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_THEME', 'default', '6', '4', 'xtc_cfg_select_option(array(\'default\', \'dark\'), ', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME', '', '6', '5', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME', '', '6', '6', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_COMPANY', '', '6', '7', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_SUBURB', '', '6', '8', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS', '', '6', '9', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE', '', '6', '10', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_CITY', '', '6', '11', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY', '".STORE_COUNTRY."', '6', '12', 'xtc_get_country_name', 'xtc_cfg_pull_down_country_list(', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('MODULE_SHIPPING_CLICKNCOLLECT_TAX_CLASS', '0', '6', '13', 'xtc_get_tax_class_title', 'xtc_cfg_pull_down_tax_classes(', now())");
	    
	    // install own payment module 'cash_on_collect'
	    if (is_file(DIR_FS_CATALOG_MODULES . 'payment/cash_on_collect.php')) {
	      require_once(DIR_FS_CATALOG_MODULES . 'payment/cash_on_collect.php');
	      include_once(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/payment/cash_on_collect.php');
	      
	      $cash_on_collect = new cash_on_collect();
	      if ($cash_on_collect->check() < 1) {
	        $cash_on_collect->install();
	
	        require_once(DIR_FS_INC.'update_module_configuration.inc.php');
	        update_module_configuration('payment');
	      }
	    }
    }

    function remove() {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
		$keys = array();
	
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_STATUS';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_SORT_ORDER';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES';
	  	$keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE';
	  	$keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_THEME';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_ALLOWED';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_COMPANY';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_FIRSTNAME';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_LASTNAME';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_STREET_ADDRESS';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_SUBURB';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_POSTCODE';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_CITY';
	    $keys[] = 'MODULE_SHIPPING_CLICKNCOLLECT_COUNTRY';
		
		return $keys;
    }

    function version() {
      $check_query = xtc_db_query("SELECT version FROM ".TABLE_DATABASE_VERSION." ORDER BY id DESC LIMIT 1");
      $check = xtc_db_fetch_array($check_query);
	  return preg_replace('/[^0-9\.]/', '', $check['version']);;
    }
    
}
?>