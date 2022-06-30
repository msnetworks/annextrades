<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'welcome@annextrades.com';                     //SMTP username
    $mail->Password   = 'Justdoit17$$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;

    include('config.php');

        $vendor_id=$_GET['vendor_id'];
        $dateStart= date('Y-m-d H:i:s');
        $dateExpired = date('Y-m-d H:i:s', strtotime($dateStart. ' + 30 days'));
        echo $dateExpired;
        $qrs = @$conn->query("UPDATE registration SET `payment`='Yes', `activate_date`= '$dateStart', `expiry_date` = '$dateExpired' WHERE vendor_id='$vendor_id' ");
        $verify_link="http://annextrades.com/registration/email-verification.php?vendor_id=$vendor_id&verify_code=$verify_code";
        /* if ($qrs) { */
                $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='$vendor_id' ");
                $rw=mysqli_fetch_array($qur);

                $to = $rw['email'];

                    $subject = "Registration Complete - Account Under Final Review";
                    $msg = "
                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                        <tr>
                                <td>
                                    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

                                <br>                                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <p style='text-align:center'>&nbsp;</p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>USA Distributor:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['companyname']."</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['vendor_id']."</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['firstname']." ". $rw['lastname']."</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Email ID: </strong>". $rw['email']."</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Contact Number: </strong>". $rw['phonenumber']."</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                                                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-family: 'Montserrat', sans-serif;'>Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size: 11pt;'><span style='font-family: 'Montserrat', sans-serif;'>Dear ". $rw['firstname'].",</span></span></strong></span></span></p>
                
                                <p style='text-align:center'>&nbsp;</p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>This is a confirmation that we have received Product / Service details for review and approval.</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Summary of submission:</span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>A review and approval of your submitted details will be performed within 24 to 48 hours. Please allow this time before your product will be viewed and active on our portal. Have a question? Please feel free to call us Toll Free at: +1 (888)641-2950 or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></p>
                
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        </table>
                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                            <tbody>
                                <tr>
                                    <td style='width:140px; padding:0; text-align:center; vertical-align:middle;' valign='middle' width='140'>
                                        <img alt='photograph' width='100' height='100' border='0' style='width:100px; height:100px; border-radius:50px; border:0;'  src='http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png'>
                                    </td>
                                    <td style='border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;' valign='top'> 
                                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                            <tbody>
                                                <tr>
                                                    <td style='font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;' valign='top'>
                                                        <strong><span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;'>ANNEXTrades Teams</span></strong><br>    
                                                        <span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;'>Customer Support</span> 
                                                    </td>     
                                                </tr>     
                                                <tr>     
                                                    <td style='font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>email: welcome@annextrades.com<br> </span>    
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>phone: +1 (888)614-2950<span style='font-family:Verdana, sans-serif; font-size:10pt;'> | </span></span> 
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'></span> 
                                                    </td>
                                                </tr>
                                                <tr>     
                                                    <td style='font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'> </span> 
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>110 SE 6th Street Suite 1700</span> 
                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>Ft. Lauderdale, Florida 33301</span>      
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>         
                                    </td> 
                                </tr>
                                <tr>
                                    <td style='font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;' valign='middle' width='140'> 
                                        <span><a href='https://www.facebook.com/Annexis.net/' target='_blank' rel='noopener'><img border='0' width='16' alt='facebook icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png'></a>&nbsp;</span><span><a href='https://twitter.com/annexisbusiness' target='_blank' rel='noopener'><img border='0' width='16' alt='twitter icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png'></a>&nbsp;</span><span><a href='https://www.linkedin.com/company/annexis-business-solutions' target='_blank' rel='noopener'><img border='0' width='16' alt='linkedin icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png'></a>&nbsp;</span><span><a href='https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm' target='_blank' rel='noopener'><img border='0' width='16' alt='google plus icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png'></a>&nbsp;</span>
                                    </td>
                                    <td style='padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;' valign='middle'>
                                        <a href='http://www.annextrades.com' target='_blank' rel='noopener' style=' text-decoration:none;'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'>www.annextrades.com</span></span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                ";
                $mail->CharSet = 'windows-1250';
                $mail->SetFrom ('welcome@annextrades.com', 'ANNEXTrades');
                $mail->AddBCC ( 'annexis.data@gmail.com', 'Reply ANNEXTrades');
                $mail->Subject = 'ANNEXTrades Company Registration - Approved';
                
                //$mail->ContentType = 'text/plain';
                
                $mail->IsHTML(true);
                
                $mail->Body = $msg; 
                
                // you may also use $mail->Body = file_get_contents('your_mail_template.html');

                $mail->AddAddress ($to);     
                
                // you may also use this format $mail->AddAddress ($recipient);

                if(!$mail->Send())
                {       echo "failed";
                        $error_message = "Mailer Error: " . $mail->ErrorInfo;
                    // echo $error_message;
                } else 
                {
                        $error_message = "Successfully sent!";
                        //echo $error_message;
                }
                echo "success";
                echo "<script>location.href ='../registration/?vendor_id=$vendor_id'</script>";
            //echo "<script>location.href ='congrats.php'</script>";
    /* }else{
        echo "failed";
        var_dump($conn, $qrs);
        echo $conn->error_reporting;
       echo "<script>location.href ='../registration/?vendor_id=$vendor_id'</script>";
    } */

?>