<?php    
        include('../../controller/config.php');
                
            $ie=$_GET['i'];
            
            $qur1=mysqli_query($conn, "SELECT * FROM `registration`");

            $qur2=mysqli_query($conn, "SELECT * FROM `email_templates` WHERE id='$ie'");
            $eow = mysqli_fetch_array($qur2);

            WHILE($rqw = mysqli_fetch_array($qur1)){

                //$ie= '5';
                //$v_id=$_GET['v_id'];
                $v_id = $rqw['vendor_id'];
                $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='$v_id' ");
                $rw=mysqli_fetch_array($qur);

                $to = $rw['email'];
                //$to = mysqli_real_escape_string($conn, $_POST['email']);
                $subject=mysqli_real_escape_string($conn, $_POST['subject']);
                
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


                        if ($ie=='1') {
                            $message= "<p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:18.0pt'>ANNEXTrades.com B2B Business Portal </span></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:18.0pt'>Give Your Business Immediate U.S. Exposure and Promotion </span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Dear ".$rw['firstname'].",</span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Welcome to ANNEXTrades. </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>This is your invitation to start your Free 14-Day Trial with <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span> USA based B2B Portal.&nbsp; Use the details below to login, add your company details and add your product or service information.<br />
                                Our goal is to start promoting your Product or Service in the United States and give you access to U.S. Buyers. </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Account Username: ".$rw['email']."</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Click Here to login to </strong><span style='color:#0563c1'><u><strong><a href='http://www.annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></strong></u></span> </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Trial Period Start Date: </strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Trial Period End Date:</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>".$rw['firstname']." please login and add your Company and Product details.<br />
                                You are permitted to add up to <strong>20 Products or Service</strong>. If possible, please add multiple images and a full description for each product for best results.</span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Remember, for best results, add multiple images of your product along with a clear, Full Description. U.S. Buyers need this as basic information in order to make purchase decisions. </span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Select the Link below to learn how to Add your Product or Service Details: </span></span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='https://www.youtube.com/watch?v=gT0WRBmlPEk' style='color:#0563c1; text-decoration:underline' target='_blank'><span style='color:blue'><img src='https://annextrades.com/assets/images/mailimg/addingps.png' style='height:223px; width:265px' /></span></a></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our U.S.A. Team.</span></span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'><img src='https://annextrades.com/assets/images/mailimg/webinar.png' style='height:191px; width:286px' /></a></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:#0563c1'><u><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'>ANNEXTrades Team Invites You&nbsp; - Zoom Meeting Invitation&nbsp; | Evite</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Please take a look at this short video to learn how our process works. </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>ANNEXTrades Introduction (English).</span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline' target='_blank'>
                                <span style='color:blue'>
                                <img src='https://annextrades.com/assets/images/mailimg/watchvid.jpg' style='width: 285px;' alt=''></span></a></span></span></p>
                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Presentation: 
                                <span style='color:#0563c1'><u><a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline'>https://www.youtube.com/watch?v=Mx4fOu7I6aw</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'>
                                <span style='font-size:11pt; font-family:Calibri,sans-serif'>
                                <img src='https://annextrades.com/assets/images/mailimg/howannex.png' style='width: 80%;'></span></p>
                                
                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 1 -</span></strong> <strong>ANNEXTrades B2B Business Portal: </strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be promoted through Social &amp; Digital Media Marketing giving you direct access to customers. A User Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will have access to our wonderful Customer Service Teams based in both the United States and India for support. </span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 2 -</span></strong> <strong>U.S. Business Address</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>A U.S. location for Customer Returns.<br />
                                Mail handling for your Business address with Mail Scanning.</span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 3 -</span></strong> <strong>U.S. Business Telephone Number (optional)</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Be more accessible to potential customers with Auto Attendant and Call Forwarding features.<br />
                                Your own Local or Toll-Free Phone number with advanced features &amp; voice over recordings for personalized messaging.</span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 4 -</span></strong> <strong>Live Receptionist</strong> <strong>(optional)</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Never miss out on sales opportunities due to time differences or language barriers.<br />
                                A Live receptionist will answer for you when you cannot. </span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Toll Free at: 1(800)123-8632. WhatsApp us at: </span>
                                <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <span style='color:black'>Visit us at: </span>
                                <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Your Bridge to Expansion and Increased Market Share, </strong></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Establishing Companies in the United States</strong> </span></span></p>

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
                                </table>";
                            
                        }
                        elseif ($ie=='2') {
                            $message= "    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:18.0pt'>ANNEXTrades.com B2B Business Portal </span></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:18.0pt'>Give Your Business Immediate U.S. Exposure and Promotion </span></span></span></p>

                                                                        
                                <p>&nbsp;</p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:10.5pt'><span style='background-color:white'><span style='font-family:&quot;Arial&quot;,sans-serif'><span style='color:#33475b'>Immediate Action Required - Please Upload Your Details and Complete Your Registration</span></span></span></span></span></span></p>

                                <p>&nbsp;</p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['companyname']."</span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['vendor_id']."</span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['firstname']." ".$rw['lastname']." </span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ".$rw['email']."</span></span></strong></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number: ".$rw['phonenumber']."</span></span></strong></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:</span></span></strong> </span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/mailimg/starrating.png' style='width: 150px;' alt=''></span></span></p>
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. Earn your next Star Rating by adding your Company Details and Product or Service info.</span></span></span></p>

                                <p>&nbsp;</p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Dear ".$rw['firstname']." ".$rw['lastname']."​,</span></span></span></span></p>

                                <p>&nbsp;</p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:#0e101a'>We want to thank you for taking the first step toward your USA Business Expansion.&nbsp;<br />
                                We urge you to take full advantage of all of your 14-Day Free USA Exposure.&nbsp; This is an important notification that there has been no activity on your ANNEXTrades account for some time. Please take immediate action to begin your journey and become an active seller in an exciting U.S. Market. </span></span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:#0e101a'>Complete your registration by login into your account and enter your Company &amp; Product or Service details. </span></span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:#0e101a'>We periodically send an email blast to introduce new suppliers such as yourself to interested U.S. buyers. If your product is not uploaded on our portal you will not be included in our introductions. It is imperative that you complete your registration and get active to benefit from the exciting opportunity to sell your products or services in the USA Market.</span></span></span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:#0e101a'>To complete, please Sign-In using: </span></span></span><u><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:blue'><a href='https://annextrades.com/login.php' style='color:#0563c1; text-decoration:underline' target='_self'><span style='color:blue'>Annex Trades | Login</span></a></span></span></span></u></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'><span style='color:#0e101a'>Follow the simple steps outline to submit the necessary details to complete your registration.</span></span></span></span></span></p>

                                <p>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Select the Link below to learn how to Add your Product or Service Details: </span></span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='https://www.youtube.com/watch?v=gT0WRBmlPEk' style='color:#0563c1; text-decoration:underline' target='_blank'><span style='color:blue'><img src='https://annextrades.com/assets/images/mailimg/addingps.png' style='height:223px; width:265px' /></span></a></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our U.S.A. Team.</span></span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'><img src='https://annextrades.com/assets/images/mailimg/webinar.png' style='height:191px; width:286px' /></a></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:#0563c1'><u><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'>ANNEXTrades Team Invites You&nbsp; - Zoom Meeting Invitation&nbsp; | Evite</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Please take a look at this short video to learn how our process works. </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>ANNEXTrades Introduction (English).</span></span></p>

                                <p style='margin-left:24px'><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline' target='_blank'>
                                <span style='color:blue'>
                                <img src='https://annextrades.com/assets/images/mailimg/watchvid.jpg' style='width: 285px;' alt=''></span></a></span></span></p>
                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Presentation: 
                                <span style='color:#0563c1'><u><a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline'>https://www.youtube.com/watch?v=Mx4fOu7I6aw</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'>
                                <span style='font-size:11pt; font-family:Calibri,sans-serif'>
                                <img src='https://annextrades.com/assets/images/mailimg/howannex.png' style='width: 80%;'></span></p>
                                
                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 1 -</span></strong> <strong>ANNEXTrades B2B Business Portal: </strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be promoted through Social &amp; Digital Media Marketing giving you direct access to customers. A User Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will have access to our wonderful Customer Service Teams based in both the United States and India for support. </span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 2 -</span></strong> <strong>U.S. Business Address</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>A U.S. location for Customer Returns.<br />
                                Mail handling for your Business address with Mail Scanning.</span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 3 -</span></strong> <strong>U.S. Business Telephone Number (optional)</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Be more accessible to potential customers with Auto Attendant and Call Forwarding features.<br />
                                Your own Local or Toll-Free Phone number with advanced features &amp; voice over recordings for personalized messaging.</span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='color:#00b0f0'>Benefit 4 -</span></strong> <strong>Live Receptionist</strong> <strong>(optional)</strong></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Never miss out on sales opportunities due to time differences or language barriers.<br />
                                A Live receptionist will answer for you when you cannot. </span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Toll Free at: 1(800)123-8632. WhatsApp us at: </span>
                                <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <span style='color:black'>Visit us at: </span>
                                <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                <p style='margin-left:24px'>&nbsp;</p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Your Bridge to Expansion and Increased Market Share, </strong></span></span></p>

                                <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong>Establishing Companies in the United States</strong> </span></span></p>

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
                                </table><br>";
                        }elseif ($ie=='3') {
                            $message = "
                            <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td>
                                        <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <p style='text-align:center'>&nbsp;</p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['companyname']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['vendor_id']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['firstname']." ".$rw['lastname']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ".$rw['email']."</span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:".$rw['phonenumber']."</span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:18.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Dear Client First Name,</span></span></strong></span></span></p>
                        
                                        <p style='text-align:center'>&nbsp;</p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>This is a confirmation that we have received Product / Service details for review and approval.</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Summary of submission:</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>A review and approval of your submitted details will be performed within 24 to 48 hours. Please allow this time before your product will be viewed and active on our portal. Have a question? Please feel free to call us Toll Free at: 1(800)123-8632 or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></p>
                        
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
                        }elseif ($ie=='4') {
                            $message=   "<table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td>
                                                    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'>
                                                    <p style='text-align:center'>&nbsp;</p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['companyname']." </span></span></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['vendor_id']." </span></span></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['firstname']."  ".$rw['lastname']." </span></span></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ".$rw['email']." </span></span></strong></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:".$rw['phonenumber']." </span></span></strong></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                                    
                                                    <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:18.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Dear ".$rw['firstname']." ,</span></span></strong></span></span></p>
                                    
                                                    <p style='text-align:center'>&nbsp;</p>
                                    
                                    
                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Congratulations! For your 14-Day Free Trial with ANNEXTrades&trade;, your Products have been approved by the U.S. Team, your account is now active, and it is available for you to view on the ANNEXTrades&trade; Business Portal.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>The Business Portal Link is:&nbsp;<a href='http://www.annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_self'>www.annextrades.com</a></span></span></span></span></span></p>

                                                    <p><br />
                                                    <span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>No further action by you is required at this time.&nbsp;You will receive an email with further instructions regarding your FREE 14-Day Trial soon.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>If you have any additional Products or Services that you would like to upload to your account in the Business Portal, please enter their Name, Description, and upload their Images as you did when you initially established your account.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Then, please contact Customer Service and notify them that you have added additional Products or Services, so that they can go through the review and approval process.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Customer Service can be contacted at&nbsp;1<a href='tel:8001238632' style='color:#0563c1; text-decoration:underline' target='_blank'>(800)123-8632</a> or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Thanks again for being a valued&nbsp;<a href='http://annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_blank'>ANNEXTrades&trade;</a>&nbsp;family member!</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Kind Regards,</span></span></span></span></span></p>
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
                                        </table>";
                        }elseif ($ie=='5') {
                            $message = "
                            <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td>
                                        <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <p style='text-align:center'>&nbsp;</p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['companyname']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['vendor_id']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['firstname']." ".$rw['lastname']."</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ".$rw['email']."</span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:".$rw['phonenumber']."</span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:18.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Dear ".$rw['firstname'].",</span></span></strong></span></span></p>
                        
                                        <p style='text-align:center'>&nbsp;</p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>This is a confirmation that we have received Product / Service details for review and approval.</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Summary of submission:</span></span></span></span></p>
                        
                                        <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>A review and approval of your submitted details will be performed within 24 to 48 hours. Please allow this time before your product will be viewed and active on our portal. Have a question? Please feel free to call us Toll Free at: 1(800)123-8632 or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></p>
                        
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>
                            </table>https://annextrades.com/productlogo/13403WhatsApp20Image202021-01-2020at%209.58.17%20PM.jpeg
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
                        }elseif ($ie=='6') {
                            $message="<table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                        <tr>
                                                <td>
                                                    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/mailimg/nextexit.png' style='width:300px' /></span></span></p>
                                                </td>
                                        </tr>
                                    <tr>

                                        <td colspan='2'>
                                            <p style='text-align:center'>&nbsp;</p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>".$rw['companyname']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>".$rw['vendor_id']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>".$rw['firstname']." ".$rw['lastname']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID:".$rw['email']." </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:".$rw['phonenumber']." </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                                            
                                            <p style='text-align:center'>&nbsp;</p>
                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Congratulations".$rw['firstname']."  at".$rw['companyname']." , for reaching your halfway milestone. </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>We thank you for being a valued ANNEXTrades Member. We hope that you are enjoying your 14-Day Free Trial and have successfully uploaded your product or service pictures, descriptions, and company information. </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Take advantage of ANNEXTrades Portal and the exciting U.S. Market today! </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>By now your product details have been viewed by several USA buyers and you have been contacted by with any potential interest and you are surely on your way to completing you first sale.&nbsp; Please take every opportunity to respond as soon as possible to every inquiry.&nbsp; Quick responses build the right confidence on buyer and leads to long term relationships.&nbsp; </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>As a Special Offer, remit payment now to get 10% OFF your Annual Membership. (Originally $299)</span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Offer Ends in 3 Days</span></span></span></p>

                                            <p style='margin-left:24px; text-align:center'><br />
                                            <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <img src='https://annextrades.com/assets/images/mailing/annualsub.png' alt=''></span></span>
                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Start Benefiting Today!</span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:#0600ff'>ANNEXTrades Annual Membership Include:</span></span></strong></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Virtual Store with Catalogue &ndash; Convert Buyers</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Consultancy Add-On Services &ndash; Know Your Market</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Click </span></span><u><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:#0600ff'>Here</span></span></u><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'> to get started today and save...</span></span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Still need help?</span></span></span></span></p>
                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Please follow the link below for step-by-step instructions.</span></span></span></p>
                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Select the Link below to learn how to Add your Product or Service Details </span></span></span></p>

                                            <p style='margin-left:24px'><br />
                                            <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='https://www.youtube.com/watch?v=gT0WRBmlPEk' style='color:#0563c1; text-decoration:underline' target='_blank'><span style='color:blue'><img src='https://annextrades.com/assets/images/mailimg/addingps.png' style='height:223px; width:265px' /></span></a></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Please reply to this email to RSVP for the Next Webinar and Speak Directly to USA Team</span></span></span></p>

                                            <p style='margin-left:24px'><br />
                                            <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'><img src='https://annextrades.com/assets/images/mailimg/webinar.png' style='height:191px; width:286px' /></a></span></span></p>
                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Select Link Below to View A Short Video to Learn How ANNEXTrades Work and FAQs</span></span></p>

                                            <p style='margin-left:24px'><br />
                                            <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <a href='https://www.youtube.com/watch?v=Mx4fOu7I6aw' style='color:#0563c1; text-decoration:underline' target='_blank'>
                                            <span style='color:blue'>
                                            <img src='https://annextrades.com/assets/images/mailimg/watchvid.jpg' style='width: 285px;' alt=''></span></a></span></span></p>
                                            
                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Toll Free at: 1(800)123-8632. WhatsApp us at: </span>
                                            <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <span style='color:black'>Visit us at: </span>
                                            <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>


                                            

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
                                </table>";
                        }elseif ($ie=='7') {
                            $message="
                                <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                    <tr>
                                            <td>
                                                <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img src='https://annextrades.com/assets/images/mailimg/milestone.png' style='width:300px' /></span></span></p>
                                            </td>
                                    </tr>
                                    <tr>

                                        <td colspan='2'>
                                            <p style='text-align:center'>&nbsp;</p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ". $rw['companyname']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ". $rw['vendor_id']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ". $rw['firstname']."  ". $rw['lastname']." </span></span></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ". $rw['email']." </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:". $rw['phonenumber']." </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                            
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                                            
                                            <p style='text-align:center'>&nbsp;</p>
                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Congratulations ". $rw['firstname']."  at ". $rw['companyname']."  for remaining focused on your journey to financial freedom. <br>Now that you are becoming an established brand with products visible to many U.S. Buyers,</span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>we encourage you to take advantage of our ANNEXTrades Annual Membership. <br>Continue to give your company access to the exciting U.S. Market and grow your business to its' full potential.</span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Your 14-Day Free Trial is coming to an end. You now only have 72-hours remaining. <br>Don’t Miss Out - Act Now and get your Annual Membership Subscription.</span></span></span></p>
                                            
                                            <p style='margin-left:24px; text-align:center'><br />
                                            <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <img src='https://annextrades.com/assets/images/mailing/annsub.png' alt=''></span></span>
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>As a reminder, when your trial expires, you will no longer be able to access your Company's Dashboard and respond to buyers who wish to do business with you or have important questions about your products or services.

                                            <br>
                                            Please Note.  In cases where buyer contact us on your behalf, we will also notify them that you are no longer part of our network of Distributors. </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Start Benefiting Today!</span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:#0600ff'>ANNEXTrades Annual Membership Include:</span></span></strong></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Virtual Store with Catalogue &ndash; Convert Buyers</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>&bull; Consultancy Add-On Services &ndash; Know Your Market</span></span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Click </span></span><u><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:#0600ff'>Here</span></span></u><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'> to get started today and save...</span></span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <img src='https://annextrades.com/assets/images/mailimg/paynow.png' style='width: 200px;' alt='ANNEXTrades'>
                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Act Now and avoid service interruptions and Reactivation Fee.</span></span></span></span></p>

                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Annual Subscription - $299</span></span><br />
                                            <span style='font-family:&quot;Verdana&quot;,sans-serif'><span style='color:black'>Reactivation Fee - $50 </span></span></span></span></p>

                                            <p>&nbsp;</p>

                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>To keep your account active, simply <u><span style='color:#0600ff'>click</span></u> below to complete your Annual Subscription. </span></span></span></p>

                                            <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <img src='https://annextrades.com/assets/images/mailimg/annsubs.png' style='width: 250px;' alt=''>
                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:black'>Toll Free at: 1(800)123-8632. WhatsApp us at: </span>
                                            <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                            <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                            <span style='color:black'>Visit us at: </span>
                                            <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                            <p style='margin-left:24px'>&nbsp;</p>
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
                        }elseif ($ie=='8') {
                            $message = "
                                <p style='text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:24.0pt'><span style='font-family:&quot;Calibri&quot;,sans-serif'>NOTICE OF DEACTIVATION </span></span></strong></span></span></p>

                                <p style='text-align:center'>&nbsp;</p>
                            
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>USA Distributor:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ".$rw['companyname']." </span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ". $rw['vendor_id']." </span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'> ". $rw['firstname']." ". $rw['lastname']." </span></span></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Email ID: ".$rw['email']." </span></span></strong></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>Contact Number:".$rw['phonenumber']." </span></span></strong></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-size:12.0pt'><span style='font-family:&quot;Times New Roman&quot;,serif'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><img style='width: 150px;' src='https://annextrades.com/assets/images/mailimg/2starrating.png' alt=''>
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Times New Roman&quot;,serif'>Note. You will Earn your next Star Rating when You Sign-Up for Annual Membership or Complete your 1<sup>st</sup> Sale Transaction</span></span></span></p>
                                            

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Dear ". $rw['firstname']."  at ". $rw['companyname']." ,</span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>​</span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>We are sorry to see you go. Your 14-Day Trial has expired, and this letter serve as notice that your account has been placed in a Deactivated Status for Non-Payment. </span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>You can no longer access your user dashboard or respond to buyers through the ANNEXTrades portal. </span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='font-family:&quot;Verdana&quot;,sans-serif'>Please Note.&nbsp; In cases where buyer contact us on your behalf, we will also notify them that you are no longer part of our network of Distributors.&nbsp; </span></span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>As you already know, the United States is experiencing an exciting new International trend in Trading. The U.S. is depending less on China and is seeking more suppliers from India.</span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>ANNEXTrades will continue to provide Indian businesses exposure as preferred suppliers of Goods or Services to the United States. We want to keep you as a valued Client and support you to grow your business.</span></span></p>

                                <p><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><strong><span style='font-family:&quot;Calibri&quot;,sans-serif'>To reactivate your account contact, Customer Service at ANNEXTrades </span></strong></span></span></p>

                                <p>&nbsp;</p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'><span style='color:#0600ff'>ANNEXTrades Annual Membership Include:</span></span></span></p>

                                <ol>
                                    <li><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></li>
                                    <li><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Virtual Store with Catalogue &ndash; Convert Buyers</span></span></li>
                                    <li><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></li>
                                    <li><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Consultancy Add-On Services &ndash; Know Your Market</span></span></li>
                                </ol>

                                <p><br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <img src='https://annextrades.com/assets/images/mailimg/pynow.png' width='300px' alt=''>
                                <p style='text-align:center'><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></p>

                                <p><br />
                                <br />
                                <span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>
                                <img src='https://annextrades.com/assets/images/mailimg/cntimg.png' style='width: 200px;' alt=''>
                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>How to Reach Us?<br />
                                Email: support@annextrades.com<br />
                                Call: 1(800)123-8632. </span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>WhatsApp: <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                <p><span style='font-size:11pt'><span style='font-family:Calibri,sans-serif'>Visit: <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

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
                        }
                            $date = $rw['activate_date'];
                            $time = time()-strtotime($rw['activate_date'])>900;
                            echo $time;
                                        
                        //$message = stripslashes(html_entity_decode($body));
                        //echo $message;
                        echo $rw['vendor_id']."<br />";
                }
                else{
                    echo 'Already Send';
                } 
            }
?>