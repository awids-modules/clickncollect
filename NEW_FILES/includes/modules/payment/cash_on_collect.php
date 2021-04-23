<?php
######################################################################################
# MODUL: Click&Collect (clickncollect)
# VERSION: 1.0.2
# RELEASE-DATE: 2021-04-25
# AUTHOR: awids
# PLATFORM: modified eCommerce Shopsoftware 2.0.x.x
######################################################################################

class cash_on_collect {
  var $code, $title, $description, $enabled;

  function __construct() {
    global $order;

    $this->code = 'cash_on_collect';
    $this->title = MODULE_PAYMENT_CASH_ON_COLLECT_TEXT_TITLE;
    $this->description = MODULE_PAYMENT_CASH_ON_COLLECT_TEXT_DESCRIPTION;
    $this->sort_order = ((defined('MODULE_PAYMENT_CASH_ON_COLLECT_SORT_ORDER')) ? MODULE_PAYMENT_CASH_ON_COLLECT_SORT_ORDER : '');
    $this->enabled = ((defined('MODULE_PAYMENT_CASH_ON_COLLECT_STATUS') && MODULE_PAYMENT_CASH_ON_COLLECT_STATUS == 'True') ? true : false);
    $this->info = MODULE_PAYMENT_CASH_ON_COLLECT_TEXT_INFO;
    if ($this->check() > 0) {
      if ((int) MODULE_PAYMENT_CASH_ON_COLLECT_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_CASH_ON_COLLECT_ORDER_STATUS_ID;
      }
    }
    if (is_object($order)) {
      $this->update_status();
    }
    $this->email_footer = MODULE_PAYMENT_CASH_ON_COLLECT_TEXT_EMAIL_FOOTER;
  }

  function update_status() {
    global $order;

    if (!isset($_SESSION['shipping'])
        || !is_array($_SESSION['shipping'])
        || (array_key_exists('id', $_SESSION['shipping']) 
            && $_SESSION['shipping']['id'] != 'clickncollect_clickncollect'
            )
        )
    {
      $this->enabled = false;
    }

    if (($this->enabled == true) && ((int) MODULE_PAYMENT_CASH_ON_COLLECT_ZONE > 0)) {
      $check_flag = false;
      $check_query = xtc_db_query("select zone_id from ".TABLE_ZONES_TO_GEO_ZONES." where geo_zone_id = '".MODULE_PAYMENT_CASH_ON_COLLECT_ZONE."' and zone_country_id = '".$order->billing['country']['id']."' order by zone_id");
      while ($check = xtc_db_fetch_array($check_query)) {
        if ($check['zone_id'] < 1) {
          $check_flag = true;
          break;
        }
        elseif ($check['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }

  function javascript_validation() {
    return false;
  }

  function selection() {
    return array ('id' => $this->code, 'module' => $this->title, 'description' => $this->info);
  }

  function pre_confirmation_check() {
    return false;
  }

  function confirmation() {
    return array ('title' => MODULE_PAYMENT_CASH_ON_COLLECT_TEXT_DESCRIPTION);
  }

  function process_button() {
    return false;
  }

  function before_process() {
    return false;
  }

  function after_process() {
    global $insert_id;
    
    if (isset($this->order_status) && $this->order_status) {
      xtc_db_query("UPDATE ".TABLE_ORDERS." SET orders_status='".$this->order_status."' WHERE orders_id='".$insert_id."'");
      xtc_db_query("UPDATE ".TABLE_ORDERS_STATUS_HISTORY." SET orders_status_id='".$this->order_status."' WHERE orders_id='".$insert_id."'");
    }
  }

  function get_error() {
    return false;
  }

  function check() {
    if (!isset ($this->_check)) {
      $check_query = xtc_db_query("select configuration_value from ".TABLE_CONFIGURATION." where configuration_key = 'MODULE_PAYMENT_CASH_ON_COLLECT_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function install() {
    xtc_db_query("insert into ".TABLE_CONFIGURATION." ( configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_CASH_ON_COLLECT_STATUS', 'True', '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now());");
    xtc_db_query("insert into ".TABLE_CONFIGURATION." ( configuration_key, configuration_value,  configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_CASH_ON_COLLECT_ALLOWED', '',   '6', '0', now())");
    xtc_db_query("insert into ".TABLE_CONFIGURATION." ( configuration_key, configuration_value,  configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_CASH_ON_COLLECT_SORT_ORDER', '0', '6', '0', now())");
    xtc_db_query("insert into ".TABLE_CONFIGURATION." ( configuration_key, configuration_value,  configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_PAYMENT_CASH_ON_COLLECT_ZONE', '0',  '6', '2', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");
    xtc_db_query("insert into ".TABLE_CONFIGURATION." ( configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, use_function, date_added) values ('MODULE_PAYMENT_CASH_ON_COLLECT_ORDER_STATUS_ID', '0', '6', '0', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");
  
    // install clickncollect
    if (is_file(DIR_FS_CATALOG_MODULES . 'shipping/clickncollect.php')) {
      require_once(DIR_FS_CATALOG_MODULES . 'shipping/clickncollect.php');
      include_once(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/shipping/clickncollect.php');
      
      $clickncollect = new clickncollect();
      if ($clickncollect->check() < 1) {
        $clickncollect->install();

        require_once(DIR_FS_INC.'update_module_configuration.inc.php');
        update_module_configuration('shipping');
      }
    }
  }

  function remove() {
    xtc_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '", $this->keys())."')");
  }

  function keys() {
    return array ('MODULE_PAYMENT_CASH_ON_COLLECT_STATUS', 'MODULE_PAYMENT_CASH_ON_COLLECT_ALLOWED', 'MODULE_PAYMENT_CASH_ON_COLLECT_ZONE', 'MODULE_PAYMENT_CASH_ON_COLLECT_ORDER_STATUS_ID', 'MODULE_PAYMENT_CASH_ON_COLLECT_SORT_ORDER');
  }
}
?>