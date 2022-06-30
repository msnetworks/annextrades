<?php
// Required if your environment does not handle autoloading
require '../Twilio/autoload.php';
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md


// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
/* $sid = "AC49042d3a1fb260ea8e08d7d5d7ab9368";
$token = "54e3a0bbea9ed9d313aa255557eaa024";
//exit('ok');
$twilio = new Client($sid, $token);

$message = $twilio->messages
->create("whatsapp:+917006422684", // to
        [
            "from" => "whatsapp:+13474108856",
            "body" => "You have a New Buyer Inquiry.  It is important to respond quickly to increase chance of conversion.  Please use the link below to login into your account and reply to your new request. "
        ]
);

print($message->sid."<br>");
print($message->error_message);

 */

//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'welcome@annextrades.com';                     //SMTP username
$mail->Password   = 'Annexis@123';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465; 
//Recipients
$mail->setFrom('welcome@annextrades.com', 'Annextrades');
$mail->addBCC('annexis.data@gmail.com');
//Optional name

//Content
$mail->isHTML(true);

$email ="mantu456sharma@gmail.com";
    // Set content-type header for sending HTML email
    $msg = "
            <!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 2.0//EN'>
            <html>
            <table style='width: 70%;'>
                <tr style='text-align: center;'>
                    <td style='text-align: left;'><a href='https://annextrades.com'><img src='https://annexis.net/templates/images/logo-wide.png' style='width: 200px;' alt='Annexis LLC'></a></td>
                    <td style='text-align: right;'><a href='https://annextrades.com/login.php'><button style='background-color: #1caceb; padding: 8px 25px; color: #fff; border: 0px; font-size: 18px;'>SIGN IN</button></a></td>
                </tr>
                <tr>
                    <td>
                        <h1>Payment Processed</h1>
                        <p>Dear Jacques,</p>
                        <p>Your payment for the monthly subscription <br> on the ANNEXTrades B2B Portal was successfully process.
                            <br><br>
                            Payment Amout: $9.99 <br>
                            Transaction ID: 6135132165 
                            <br><br>
                            <h2>Billing Information:</h2>
                            <br>
                            Full Name: Jacques Dieuvil <br>
                            Email: jack64bk@gmail.com <br>
                            Address: 121 SE Bella Strano <br>
                            City: Port St Luice <br>
                            country: United States <br>
                            State/Province: FL <br>
                            Zip/Postal Code: 180010 <br>
                            <br><br>
                            Kind Regards, <br><br>

                            <b style='color: #23afec;'>ANNEXIS Team.</b>
                        </p>
                    </td>
                </tr>
            </table>
            </html>
            ";
            $mail->CharSet = 'windows-1250';
            $mail->SetFrom ('welcome@annextrades.com', 'ANNEXTrades');
            $mail->AddBCC ( 'annexis.data@gmail.com', 'Reply ANNEXTrades');
            $mail->Subject = 'ANNEXTrades Company Registration - Approved';
            
            //$mail->ContentType = 'text/plain';
            
            $mail->IsHTML(true);
            
            $mail->Body = $msg; 
            
            // you may also use $mail->Body = file_get_contents('your_mail_template.html');
    
            $mail->AddAddress ($email);     
            
            // you may also use this format $mail->AddAddress ($recipient);
    
        if(!$mail->Send())
        {       echo "failed";
                $error_message = "Mailer Error: " . $mail->ErrorInfo;
                echo $error_message;
        } else 
        {
                $error_message = "Successfully sent!";
                echo $error_message;
        }



?>
