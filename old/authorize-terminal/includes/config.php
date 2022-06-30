 <?php
/******************************************************************************
#                      PHP Authorize.net Payment Terminal v2.3
#******************************************************************************
#      Author:     CriticalGears
#      Email:      info@criticalgears.io
#      Website:    http://www.criticalgears.io
#
#
#      Version:    2.3
#      Copyright:  (c) 2012 - CriticalGears.io
# 
#*******************************************************************************/

$p = $p;
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require("functions.php");


//THIS IS TITLE ON PAGES
$title = "AnnexTrades | Payment Terminal v2.2"; //site title
//THIS IS ADMIN EMAIL FOR NEW PAYMENT NOTIFICATIONS.
$admin_email = "mantu456sharma@gmail.com"; //this email is for notifications about new payments


//IF YOU NEED TO ADD MORE SERVICES JUST ADD THEM THE SAME WAY THEY APPEAR BELOW.

/*  */
if (@$_POST['add_amt']=='375.91') {
	
	$p = "375.91";	
	
}
else{
	$p = '316.91';
} 
$services = array(
	array("Yearly Subscription", "$p"),
	/* array("Service 2", "149.99"),
	array("Service 3", "249.99"),
	array("Service 4", "349.99"), */
);


//NOW, IF YOU WANT TO ACTIVATE THE DROPDOWN WITH SERVICES ON THE TERMINAL
//ITSELF, CHANGE BELOW VARIABLE TO TRUE;			
$show_services = true;

// set  to   RECUR  - for recurring payments, ONETIME - for onetime payments
$payment_mode = "ONETIME";


//service name   |   price  to charge   | Billing period  "Day", "Week", "Month", "Year"   |  how many periods of previous field per billing period | trial period in days | Trial amount
$recur_services = array(
	array("Service 1 monthly WITH 30 DAYS TRIAL", "49.99", "Month", "1", "30", "24.99"),
	array("Service 1 monthly", "49.99", "Month", "1", "0", "0"),
	array("Service 1 quaterly", "149.99", "Month", "3", "0", "0"),
	array("Service 1 semi-annualy", "249.99", "Month", "6", "0", "0"),
	array("Service 1 annualy", "349.99", "Year", "1", "0", "0")
);
//IF YOU'RE GOING LIVE FOLLOWING VARIABLE SHOULD BE SWITCH TO true
// IT WILL AUTOMATICALLY REDIRECT ALL NON-HTTTPS REQUESTS TO HTTPS.
// MAKE SURE SSL IS INSTALLED ALREADY.
$redirect_non_https = false;
$liveMode = true;
date_default_timezone_set("US/Eastern"); // !!!IMPORTANT!!! PLEASE CHANGE THIS TO YOUR TIMEZONE - according to the list from here http://php.net/manual/en/timezones.php

if(!$liveMode){
//TEST MODE
	define('MERCHANT_LOGIN', '5p3aV4F2');
	define('MERCHANT_TRAN_KEY', '58G2EZmWqf6W949K');
	define('GATEWAY_URL', 'https://test.authorize.net/gateway/transact.dll');
	define('TEST_MODE', 'TRUE');
	define('ARBHOST', 'apitest.authorize.net');
	define('ARBPATH', '/xml/v1/request.api');
} else {
//LIVE MODE
	define('MERCHANT_LOGIN', '5p3aV4F2');
	define('MERCHANT_TRAN_KEY', '58G2EZmWqf6W949K');
	define('GATEWAY_URL', 'https://secure.authorize.net/gateway/transact.dll');
	define('TEST_MODE', 'FALSE');
	define('ARBHOST', 'api.authorize.net');
	define('ARBPATH', '/xml/v1/request.api');
}

$enableReCaptcha = false;
$reCaptcha_siteKey = "6LcWoLsZAAAAAD-NvAM2qF1pWbp7NEsIZkXbgQZP";
$reCaptcha_secretKey = "6LcWoLsZAAAAAGcx4obiNoZuCzPPt_QDK3dpDipN";

// redirect customer to specific url, after successful payment
$redirectAfterSuccessPayment=false;
$redirectURL='https://annextrades.com';


/*******************************************************************************************************
PAYPAL EXPRESS CHECKOUT CONFIGURATION VARIABLES
 ********************************************************************************************************/
$enable_paypal = true; //shows/hides paypal payment option from payment form.
$paypal_merchant_email = "your_paypal_merchant_email@here.com";
$paypal_success_url = "http://www.domain.com/path/to/authorize-payment-terminal/paypal_thankyou.php";
$paypal_cancel_url = "http://www.domain.com/path/to/authorize-payment-terminal/paypal_cancel.php";
$paypal_ipn_listener_url = "http://www.domain.com/path/to/authorize-payment-terminal/paypal_listener.php";
$paypal_custom_variable = "some_var";
$paypal_currency = "USD";
$sandbox = false; //if you want to test payments with your sandbox account change to true (you must have account at https://developer.paypal.com/ and YOU MUST BE LOGGED IN WHILE TESTING!)
if($liveMode){ $sandbox = false; } else { $sandbox = true; }


//DO NOT CHANGE ANYTHING BELOW THIS LINE, UNLESS SURE OF COURSE
define("PAYMENT_MODE",$payment_mode);
if(!$sandbox){
	define("PAYPAL_URL_STD","https://www.paypal.com/cgi-bin/webscr");
} else {
	define("PAYPAL_URL_STD","https://www.sandbox.paypal.com/cgi-bin/webscr");
}

//DO NOT CHANGE ANYTHING BELOW THIS LINE, UNLESS SURE OF COURSE
if($redirect_non_https){
	if ($_SERVER['SERVER_PORT']!=443) {
		$sslport=443; //whatever your ssl port is
		$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		header("Location: $url");
		exit();
	}
}
?>
