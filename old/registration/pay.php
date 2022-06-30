<?php

require('pay_config.php');
require('vendor/autoload.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => 799 * 100, // 1 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}
$vendor_id = $_POST['vendor_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$email_code = $_POST['email_code'];
$phone = $_POST['phonenumber'];
$address = $_POST['address'];
$city = $_POST['city'];


$data = [ 
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "ANNEXTrades",
    "description"       => "Monthly Subscription",
    "image"             => "https://annextrades.com/assets/images/annexis-emblem.png",
    "prefill"           => [
    "name"              => $name,
    "vendor_id"         => $vendor_id,
    "email"             => $email,
    "contact"           => $phone,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "C64L1ue3eEWK97",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | ANNEXTrades</title>
    <link rel="icon" href="https://annextrades.com/assets/images/annexis-emblem.png" type="image/png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <style>
        .razorpay-payment-button{
            width: 100px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 60px 0px 10px 5px;
        }
    </style>
</head>
<body>
    <div style="margin: 30px; font-family: 'Montserrat';">
        <div class="row d-flex justify-content-center">
            <!-- Business Portal Package --> 
            <div class="col-md-6 border" style="padding: 30px;">
                <div class="pane" style="display:block">
                    <div class="form_container">
                        <div class="row text-center" style="padding: 30px;">
                            <div class="col-md-12">                            
                                <img style="width: 200px;" src="https://annextrades.com/assets/images/logo.png" alt="ANNEXTrades">
                            </div>
                        </div>
                        <div class="row">
                            <h4 style="padding: 15px; font-size: 30px;"><b>ANNEXTrades Monthly Membership</b> <br>
                        <font style="color: #1baceb; font-size: 22px;"><b>Billing Questions Call Customer Service: 1(888) 614-2950</b></font></h4>
                            <div class="col-md-8">
                                <h4 style="color: #ff7900; font-size: 20px;">Personal Detail</h4>
                                <p>
                                    <b><?php echo $name; ?><br>
                                    <?php echo $email; ?><br>
                                    <?php echo $phone; ?><br>
                                    </b>
                                </p>
                                
                            </div>
                            <div class="col-md-8">
                                <h4 style="color: #ff7900; font-size: 20px;">Membership Subscription</h4>
                                <p>Monthly fee. <!-- <b>₹ 749/-</b> --></p>
                                
                            </div>
                            <div class="col-md-4 text-right" style="margin-top: 10px;">
                                <h6>SHOW PRICE DETAILS <i class="fa fa-angle-down"></i></h6>
                                <h3><b>₹ 749/-</b></h3>
                            </div>
                        </div>
                        <div class="row" style="font-size: 12px; padding-left: 15px;">
                            <div class="col-md-12">
                                <div >
                                    <p class="pull-left text-left"><b>Processing Fees (estimated)</br>
                                        <font style="font-size: 14px;">Total amount you will be charged</font></b>
                                    </p>
                                    
                                </div>
                                <div class="">
                                    <p class="pull-right text-right"><b>₹ 50.00
                                        <br><font style="font-size: 14px;">₹ 799/-</font></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12" style="background: #ccc;">
                            <p style="padding-left: 15px; font-size: 18px;">Note. Statement will reflect: Annexis LLC</p>
                        </div>
                        <div class="col-ms-12">
                            <div style="padding: 30px 20px 0px 30px;">
                                <p><i style="color:green;" class="fa fa-check"></i><b><font style="color:#333; padding-left: 10;"> Provide a U.S. address for customer returns</font></b></p>
                                <p><i style="color:green;" class="fa fa-check"></i><b><font style="color:#333; padding-left: 10;"> Build confidence with Buyers</font></b></p>
                                <p><i style="color:green;" class="fa fa-check"></i><b><font style="color:#333; padding-left: 10;"> Mail handling for your business with mail scanning</font></b></p>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top: 15px;">
                            <div>
                                <h4 class="pull-left text-left"><b>Total Amount: <span style="font-weight: 600;">₹ 799/-</span> <!-- after trial --></b></h4>
                                <!-- <h4 class="h4ull-right text-right">₹ 749/-</h4> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php require("checkout/{$checkout}.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Business Portal Package -->
        </div>
    </div>
</body>
</html>