<?php
function formatPrice($price=0)
{
    return number_format($price,2,".","");
}

function format_phone($country, $phone) {
    $function = 'format_phone_' . $country;
    if(function_exists($function)) {
      return $function($phone);
    }
    return $phone;
  }
   
  function format_phone_us($phone) {
    // note: making sure we have something
    if(!isset($phone[3])) { return ''; }
    // note: strip out everything but numbers 
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);
    switch($length) {
    case 7:
      return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
    break;
    case 10:
     return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
    break;
    case 11:
    return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
    break;
    default:
      return $phone;
    break;
    }
  }
?>