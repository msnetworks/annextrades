<?php    

        use PHPMailer\PHPMailer\PHPMailer;
        require '../../../PHPMailer/src/Exception.php';
        require '../../../PHPMailer/src/PHPMailer.php';
        require '../../../PHPMailer/src/SMTP.php';
        require '../../../PHPMailer/src/OAuth.php';

        $mail = new PHPMailer();

        include('../../../smtpdetails.com');

        include('../../../controller/config.php');
                $tms= date("Y-m-d H:i:s");
                

            $ie= '9';
            
            $qur1=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='400005'");

            $qur2=mysqli_query($conn, "SELECT * FROM `email_templates` WHERE id='$ie'");
            $eow = mysqli_fetch_array($qur2);

            WHILE($rqw = mysqli_fetch_array($qur1)){
                
                //$v_id=$_GET['v_id'];
                $v_id = $rqw['vendor_id'];
                $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='$v_id' ");
                $rw=mysqli_fetch_array($qur);
                                   

                $to = $rw['email'];
                //$to = mysqli_real_escape_string($conn, $_POST['email']);
                $subject=$eow['subject'];
                
                //$body=htmlspecialchars($_POST['body'], ENT_QUOTES);

                    // Declare and define two dates 
                    $date1 = strtotime($rw['date']);  
                    $date2 = strtotime($tms);  
                    
                    // Formulate the Difference between two dates 
                    $diff = abs($date2 - $date1);  
                    
                    
                    // To get the year divide the resultant date into 
                    // total seconds in a year (365*60*60*24) 
                    $years = floor($diff / (365*60*60*24));  
                    
                    
                    // To get the month, subtract it with years and 
                    // divide the resultant date into 
                    // total seconds in a month (30*60*60*24) 
                    $months = floor(($diff - $years * 365*60*60*24) 
                                                / (30*60*60*24));  
                    
                    
                    // To get the day, subtract it with years and  
                    // months and divide the resultant date into 
                    // total seconds in a days (60*60*24) 
                    $days = floor(($diff - $years * 365*60*60*24 -  
                                $months*30*60*60*24)/ (60*60*24)); 
                    
                    
                    // To get the hour, subtract it with years,  
                    // months & seconds and divide the resultant 
                    // date into total seconds in a hours (60*60) 
                    $hours = floor(($diff - $years * 365*60*60*24  
                        - $months*30*60*60*24 - $days*60*60*24) 
                                                    / (60*60));  
                    
                    
                    // To get the minutes, subtract it with years, 
                    // months, seconds and hours and divide the  
                    // resultant date into total seconds i.e. 60 
                    $minutes = floor(($diff - $years * 365*60*60*24  
                            - $months*30*60*60*24 - $days*60*60*24  
                                            - $hours*60*60)/ 60);  
                    
                    
                    // To get the minutes, subtract it with years, 
                    // months, seconds, hours and minutes  
                    $seconds = floor(($diff - $years * 365*60*60*24  
                            - $months*30*60*60*24 - $days*60*60*24 
                                    - $hours*60*60 - $minutes*60));  
                    
                    // Print the result 
                    //printf("%d years, %d months, %d days, %d hours, ". "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds, "<br />");  

                    

                $pro=mysqli_query($conn, "SELECT userid FROM `product` WHERE userid='".$rw['id']."' ");
                
                $quro=$conn->query("SELECT vendor_id, email_id FROM email_report WHERE vendor_id='$v_id' and email_id='$ie' ");

                if(mysqli_num_rows($quro) == '0' && mysqli_num_rows($pro) == '0' && $years == '0' && $months == '1' && $days == '0'){

                        $insert_qry=$conn->query("INSERT INTO email_report (vendor_id, email_id) VALUES ('$v_id', '$ie')");   
                        
                        $message ="
                            <p style='text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:24.0pt'><span style='font-family:Calibri,sans-serif'>NOTICE OF SERVICE INTERRUPTION </span></span></strong></span></span></p>

                            <p style='text-align:center'>&nbsp;</p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>USA Distributor:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['companyname']."</span></span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['vendor_id']."</span></span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['firstname']." ". $rw['lastname']."</span></span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Email ID: </strong>". $rw['email']."</span></span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Contact Number: </strong>". $rw['phonenumber']."</span></span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-family: 'Montserrat', sans-serif;'>Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>
                            
                                        
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Dear ". $rw['firstname']." at ". $rw['companyname'].",</span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>​</span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Your monthly subscription has expired. This letter is to notify you that some of your account activity will be restricted due to non-payment. </span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>You can no longer access your user dashboard or respond to buyers through the ANNEXTrades portal. </span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-family:Verdana,sans-serif'>Please Note.&nbsp; In cases where buyer contact us on your behalf, we will also notify them that you are no longer an active member of our network of distributor and we will direct them to someone else.&nbsp; </span></span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>As you already know, the United States is experiencing an exciting new International trend in Trading. The U.S. is depending less on China and is seeking more suppliers from India.</span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades will continue to provide Indian businesses exposure as preferred suppliers of Goods or Services to the United States. We want to keep you as a valued Client and support you to grow your business.</span></span></p>
                            
                            <p><br />
                            <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-family:Calibri,sans-serif'>To reactivate your account contact, Customer Service at ANNEXTrades </span></strong></span></span></p>
                            
                            <p>&nbsp;</p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:#0600ff'>ANNEXTrades Membership Include:</span></span></span></p>
                            
                            <ol>
                                <li><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></li>
                                <li><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Virtual Store with Catalogue &ndash; Convert Buyers</span></span></li>
                                <li><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></li>
                                <li><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Consultancy Add-On Services &ndash; Know Your Market</span></span></li>
                            </ol>
                            
                            <p><br />
                            <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>
                            <img src='https://annextrades.com/assets/images/mailimg/monsubs.png' width='300px' alt=''>
                            <p style='text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></p>
                            
                            <p><br />
                            <br />
                            <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>
                            <img src='https://annextrades.com/assets/images/mailimg/cntimg.png' style='width: 200px;' alt=''>
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>How to Reach Us?<br />
                            Email: support@annextrades.com<br />
                            Call: +1 (888)641-2950. </span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>WhatsApp: <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>
                            
                            <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Visit: <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>
                            
                            <p style='margin-left:48px'>&nbsp;</p>
                            
                            
                            
                            
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
                        $mail->Subject = 'Notice of Service Interruption - Please be advised';
                        
                        //$mail->ContentType = 'text/plain';
                        
                        $mail->IsHTML(true);
                        
                        $mail->Body = $message; 
                        
                        // you may also use $mail->Body = file_get_contents('your_mail_template.html');

                        $mail->AddAddress ($to);     
                        
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
                        echo $message;
                        //echo $years." ".$months." ".$days." ".$hours." "."<br><br />";

                    }else{
                        //echo "Already Added Products";
                    }
                
            }
            
?>