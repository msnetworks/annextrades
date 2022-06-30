<?php
/* use PHPMailer\PHPMailer\PHPMailer;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/OAuth.php';

$mail = new PHPMailer();
    require('../smtpdetails.php');
    $email ="mantu456sharma@gmail.com";
    // Set content-type header for sending HTML email
    $msg = "<table style='width: 70%;'>
                <tr style='text-align: center;'>
                    <td style='text-align: left;'><a href='https://annextrades.com'>MS<img src='https://annexis.net/templates/images/logo-wide.png' style='width: 200px;' alt='Annexis LLC'></a></td>
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
            </table>";
    $mail->CharSet = 'windows-1250';
    $mail->SetFrom ('welcome@annextrades.com', 'ANNEXTrades');
    $mail->AddBCC ( 'annexis.data@gmail.com', 'Reply ANNEXTrades');
    
    $mail->Subject = "Payment Receipt";
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


    echo $mail->Body;

 */
?>
<?php
$to      = 'mantu456sharma@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: welcome@annexis.net' . "\r\n" .
    'Reply-To: annexis.data@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="width: 70%;">
        <tr style="text-align: center;">
            <td style="text-align: left;"><a href="https://annextrades.com"><img src="https://annexis.net/templates/images/logo-wide.png" style="width: 200px;" alt="Annexis LLC"></a></td>
            <td style="text-align: right;"><a href="https://annextrades.com/login.php"><button style="background-color: #1caceb; padding: 8px 25px; color: #fff; border: 0px; font-size: 18px;">SIGN IN</button></a></td>
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

                    <b style="color: #23afec;">ANNEXIS Team.</b>
                </p>
            </td>
        </tr>
    </table>
</body>
</html> -->