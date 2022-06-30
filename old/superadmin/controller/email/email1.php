<?php    
        include('../../../controller/config.php');
                

                $ie= '1';
                $v_id='870072';
                //$v_id = $rqw['vendor_id'];
                $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='$v_id' ");
                $rw=mysqli_fetch_array($qur);

                $to = $rw['email'];
                //$to = mysqli_real_escape_string($conn, $_POST['email']);
                $subject='Welcome to ANNEXTrades Business Portal - Get Started Now!';
                
                //$body=htmlspecialchars($_POST['body'], ENT_QUOTES);


                $quro=$conn->query("SELECT vendor_id, email_id FROM email_report WHERE vendor_id='$v_id' and email_id='$ie' ");
                
                if(mysqli_num_rows($quro) == '0'){

                    $insert_qry=$conn->query("INSERT INTO email_report (vendor_id, email_id) VALUES ('$v_id', '$ie')");   
                    
                            $headers = "From: " . strip_tags('welcome@annextrades.com') . "\r\n";
                            $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
                            $headers .= "CC: annexis.data@gmail.com\r\n";
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                            $message = "
                                <div class='form-group'>
                                    
                                    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

                                    <br>
                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size: 11pt;'>ANNEXTrades.com B2B Business Portal </span></span></span></p>

                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size: 11pt;'>Give Your Business Immediate U.S. Exposure and Promotion </span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Dear ".$rw['firstname'] .",</span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Welcome to ANNEXTrades. </span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>This is an invitation to activate your account with <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span> USA based B2B Portal.&nbsp; Use the details below to login, add your company details and add your product or service information.<br />
                                    Our goal is to start promoting your Product or Service in the United States and give you access to U.S. Buyers. </span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong>Account Username: ".$rw['email']."</strong></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong>Click Here to login to </strong><br><span style='color:#0563c1'><u><strong><a href='http://www.annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></strong></u></span> </span></span></p><br>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'> ".$rw['firstname'] ." Please login, add your company & product or service details, and complete payment.<br/>
                                    You are permitted to add up to <strong>20 Products or Service</strong>. If possible, please add multiple images and a full description for each product for best results.</span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Remember, for best results, add multiple images of your product along with a clear, Full Description. U.S. Buyers need this as basic information in order to make purchase decisions. </span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>Select the Link below to learn how to Add your Product or Service Details: </span></span></span></p>

                                    <p style='margin-left:24px'><br />
                                    <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><a href='https://www.youtube.com/watch?v=gT0WRBmlPEk' style='color:#0563c1; text-decoration:underline' target='_blank'><span style='color:blue'><img src='https://annextrades.com/assets/images/mailimg/addingps.png' style='height:223px; width:265px' /></span></a></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our U.S.A. Team.</span></span></span></p>

                                    <p style='margin-left:24px'><br />
                                    <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'><img src='https://annextrades.com/assets/images/mailimg/webinar.png' style='height:191px; width:286px' /></a></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:#0563c1'><u><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'>ANNEXTrades Team Invites You&nbsp; - Zoom Meeting Invitation&nbsp; | Evite</a></u></span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Please take a look at this short video to learn how our process works. </span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Introduction (English).</span></span></p>

                                    <p style='margin-left:24px'><br />
                                    <span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>
                                    <a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline' target='_blank'>
                                    <span style='color:blue'>
                                    <img src='https://annextrades.com/assets/images/mailimg/watchvid.jpg' style='width: 285px;' alt=''></span></a></span></span></p>
                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Presentation: 
                                    <span style='color:#0563c1'><u><a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline'>https://www.youtube.com/watch?v=Mx4fOu7I6aw</a></u></span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'>
                                    <span style='font-size:11pt; font-family: 'Montserrat', sans-serif;'>
                                    <img src='https://annextrades.com/assets/images/mailimg/howannex.png' style='width: 80%;'></span></p>
                                    <br><br>
                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='color:#00b0f0'>Benefit 1 -</span></strong> <strong>ANNEXTrades B2B Business Portal: </strong></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be promoted through Social &amp; Digital Media Marketing giving you direct access to customers. A User Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will have access to our wonderful Customer Service Teams based in both the United States and India for support. </span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='color:#00b0f0'>Benefit 2 -</span></strong> <strong>U.S. Business Address</strong></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>A U.S. location for Customer Returns.<br />
                                    Mail handling for your Business address with Mail Scanning.</span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='color:#00b0f0'>Benefit 3 -</span></strong> <strong>U.S. Business Telephone Number (optional)</strong></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Be more accessible to potential customers with Auto Attendant and Call Forwarding features.<br />
                                    Your own Local or Toll-Free Phone number with advanced features &amp; voice over recordings for personalized messaging.</span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='color:#00b0f0'>Benefit 4 -</span></strong> <strong>Live Receptionist</strong> <strong>(optional)</strong></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>Never miss out on sales opportunities due to time differences or language barriers.<br />
                                    A Live receptionist will answer for you when you cannot. </span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                    <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>
                                    <span style='color:black'>Visit us at: </span>
                                    <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong>Your Bridge to Expansion and Increased Market Share, </strong></span></span></p>

                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong>Establishing Companies in the United States</strong> </span></span></p>

                                    <p>&nbsp;</p> 
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
                                    </table><br>
                                </div>";
                            
                            $date = $rw['activate_date'];
                            $time = time()-strtotime($rw['activate_date'])>900;
                            echo $time;
                            mail($to, $subject, $message, $headers);     
                        //$message = stripslashes(html_entity_decode($body));
                        echo $message;
                        echo $rw['vendor_id']."<br />";
                }
                else{
                    echo 'Already Send';
                } 
            //}
?>