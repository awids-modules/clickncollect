<?php
######################################################################################
# MODUL: 			Click&Collect (clickncollect)
# VERSION:			1.0.0
# RELEASE-DATE:		2021-04-22
# AUTHOR:			awids
# PLATFORM:			modified eCommerce Shopsoftware 2.0.6.x and higher
######################################################################################

if (defined('MODULE_SHIPPING_CLICKNCOLLECT_STATUS') && MODULE_SHIPPING_CLICKNCOLLECT_STATUS == 'True') {
	if ($checkout_position[$current_page] >= 2) {
	  if ($_SESSION['shipping']['id'] == 'clickncollect_clickncollect') {
	    if (empty($_SESSION['shipping']['collectDate']) || empty($_SESSION['shipping']['collectTime'])) {
		  if (empty($_SESSION['shipping']['collectDate'])) {
	        $messageStack->add_session('checkout_shipping', MODULE_SHIPPING_CLICKNCOLLECT_ERROR_DAY);
	      }
		  if (empty($_SESSION['shipping']['collectTime'])) {
	        $messageStack->add_session('checkout_shipping', MODULE_SHIPPING_CLICKNCOLLECT_ERROR_TIME);
	      }
	      xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
	    }
	  }
	}
}