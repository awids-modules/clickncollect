<?php 
######################################################################################
# MODUL: Click&Collect (clickncollect)
# VERSION: 1.0.2
# RELEASE-DATE: 2021-04-25
# AUTHOR: awids
# PLATFORM: modified eCommerce Shopsoftware 2.0.x.x
######################################################################################

if (defined('MODULE_SHIPPING_CLICKNCOLLECT_STATUS') && MODULE_SHIPPING_CLICKNCOLLECT_STATUS == 'True') {
	if (basename($PHP_SELF) == FILENAME_CHECKOUT_SHIPPING) { 
	  
	  function format4DateTimePicker($array, $isDate, $spacer) {
	    $array = str_replace(' ', '', $array);
	    $dates = explode(',', $array);
	    foreach ($dates as $date) {
		  if ($date != '') $output .= '"'.$date.(($isDate == true) ? '.'.date("Y") : '').'"'.((end($dates) == $date) ? '' : $spacer);
	    }
	    return $output;
	  }
	  
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
			        '.((!empty(MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE)) ? format4DateTimePicker(MODULE_SHIPPING_CLICKNCOLLECT_FEIERTAGE, true, ', ') : '').'
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
			      format:"H:i",
			      datepicker:false, 
			      timepicker:true, 
			      formatTime:"H:i",
			      theme:"'.MODULE_SHIPPING_CLICKNCOLLECT_THEME.'",
			      allowTimes: [
			        '.((!empty(MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES)) ? format4DateTimePicker(MODULE_SHIPPING_CLICKNCOLLECT_DAILY_TIMES, false, ', ') : '').'
			      ]
			    });
			  });
			</script>';
	}
}
?>
