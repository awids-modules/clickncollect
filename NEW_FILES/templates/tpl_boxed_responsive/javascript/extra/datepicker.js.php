<?php 
######################################################################################
# MODUL: 			Click&Collect (clickncollect)
# VERSION:			1.0.0
# RELEASE-DATE:		2021-04-22
# AUTHOR:			awids
# PLATFORM:			modified eCommerce Shopsoftware 2.0.6.x and higher
######################################################################################

if (defined('MODULE_SHIPPING_CLICKNCOLLECT_STATUS') && MODULE_SHIPPING_CLICKNCOLLECT_STATUS == 'True') {
	if (basename($PHP_SELF) == FILENAME_CHECKOUT_SHIPPING) { 
	  $vorlaufzeit = '+'.MODULE_SHIPPING_CLICKNCOLLECT_PRE_TIME.' days';
	  $min_date = date("d.m.Y", strtotime($vorlaufzeit));
	  echo '<script type="text/javascript">
			  $(document).ready(function(){
			    $.datetimepicker.setLocale("'.$_SESSION['language_code'].'");    
			    $("#collectDate").datetimepicker({
			      dayOfWeekStart:1,
	 		      datepicker:true, 
			      timepicker:false, 
			      disabledDates: [
			        '.MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE.'
			      ],
			      formatDate:"d.m.Y",
			      format:"d.m.Y",
			      minDate:"'.$min_date.'",
			      theme:"'.MODULE_SHIPPING_CLICKNCOLLECT_THEME.'",
			      disabledWeekDays: [
			        '.MODULE_SHIPPING_CLICKNCOLLECT_WEEKLY_TIMES.'
			      ]
			    });
			    $("#collectTime").datetimepicker({
			      dayOfWeekStart:1,
			      datepicker:false, 
			      timepicker:true, 
			      format:"H:i",
			      minDate:0,
			      theme:"'.MODULE_SHIPPING_CLICKNCOLLECT_THEME.'",
			      allowTimes: [
			        '.MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES.'
			      ]
			    });
			  });
			</script>';
	}
}
?>