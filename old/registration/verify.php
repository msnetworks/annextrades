<?php

require('pay_config.php');

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->SMTPDebug = 1;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'welcome@annextrades.com';                     //SMTP username
$mail->Password   = 'Justdoit17$$';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;


require('vendor/autoload.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
$vendor_id = $_POST['vendor_id'];
$email = $_POST['email'];
//$email = 'jus37222@gmail.com';
$email_code = $_POST['email_code'];
$name = $_POST['name'];
$address= $_POST['address'];
$error = "Payment Failed";
$verify_link="http://annextrades.com/registration/email-verification.php?vendor_id=$vendor_id&verify_code=$email_code&package=Basic";

echo $email.$verify_link;
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             echo $html;
             
                                
        $msg ="
            <table style='width: 70%;'>
                <tr style='text-align: center;'>
                    <td style='text-align: left;'><a href='https://annextrades.com'><img src='https://annexis.net/templates/images/logo-wide.png' style='width: 200px;' alt='Annexis LLC'></a></td>
                    <td style='text-align: right;'><a href='https://annextrades.com/login.php'><button style='background-color: #1caceb; padding: 8px 25px; color: #fff; border: 0px; font-size: 18px;'>SIGN IN</button></a></td>
                </tr>
                <tr>
                    <td>
                        <h1>Payment Processed</h1>
                        <p>Dear ".$name.",</p>
                        <p>Your payment for the monthly subscription <br> on the ANNEXTrades B2B Portal was successfully process.
                            <br><br>
                            Payment Amout: Rs. 799/- <br>
                            Transaction ID:  " . $_POST['razorpay_payment_id'] ."
                            <br><br>
                            <h2>Billing Information:</h2>
                            <br>
                            Full Name: " . $name . "<br>
                            Email: " . $email . " <br>
                            <!--Address: " . $address . " --><br><br>

                            <button style='background-color: #1caceb; padding: 8px 25px; color: #fff; border: 0px; font-size: 18px;'><a style='color: #fff;' href='".$verify_link."'>CLICK HERE TO VERIFY</a></button><br><br>

                            <br><br>
                            Kind Regards, <br><br>

                            <b style='color: #23afec;'>ANNEXIS Team.</b>
                        </p>
                    </td>
                </tr>
            </table>
        ";
        //echo $msg;
        $mail->CharSet = 'windows-1250';
        $mail->SetFrom ('welcome@annextrades.com', 'ANNEXTrades');
        $mail->AddBCC ( 'annexis.data@gmail.com', 'Reply ANNEXTrades');
        $mail->Subject = 'ANNEXTrades Payment Receipt!';
        
        //$mail->ContentType = 'text/plain';
        
        $mail->IsHTML(true);
        
        $mail->Body = $msg; 
        
        // you may also use $mail->Body = file_get_contents('your_mail_template.html');

        $mail->AddAddress ($email);     
        
        // you may also use this format $mail->AddAddress ($recipient);

    if(!$mail->Send())
    {      // echo "failed";
            $error_message = "Mailer Error: " . $mail->ErrorInfo;
           // echo $error_message;
    } else 
    {
            $error_message = "Successfully sent!";
            echo $error_message;
        }
    echo "<script>location.href ='../controller/payment_cnf.php?vendor_id=$vendor_id'</script>"; 
             
             
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
             echo $html;
    echo "<script>location.href ='../controller/payment_cnf.php?vendor_id=$vendor_id'</script>"; 
}
