<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->SMTPDebug = false;                      // Enable verbose debug output
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'asha.pixlerlab@gmail.com';                     // SMTP username
$mail->Password   = 'YourPassword';                               // SMTP password
$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 465;

$mail->setFrom('amanjot.pixlerlab@gmail.com');
$mail->addReplyTo('amanjot.pixlerlab@gmail.com');

$mail->addAddress('amanjot.pixlerlab@gmail.com');

$mail->isHTML(true);

$mail->Subject = "PHPMailer SMTP test";
//$mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');
$mail->Body = 'testing mail file';
//$mail->AltBody = 'This is the plain text version of the email content';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
