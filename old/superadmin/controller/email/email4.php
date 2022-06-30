<?php    
        include('../../../controller/config.php');
                
            $ie='4';
            
            $qur1=mysqli_query($conn, "SELECT * FROM `registration`");

            $qur2=mysqli_query($conn, "SELECT * FROM `email_templates` WHERE id='$ie'");
            $eow = mysqli_fetch_array($qur2);

            WHILE($rqw = mysqli_fetch_array($qur1)){

                $ie= '4';
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

                            $message=   "
                            <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                            <tr>
                                    <td>
                                        <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img src='https://annextrades.com/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

                                <br>                                                </td>
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

                                        <br>
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size: 11pt;'><span style='font-family: 'Montserrat', sans-serif;'>Dear ". $rw['firstname'].",</span></span></strong></span></span></p>
                    
                                    <p style='text-align:center'>&nbsp;</p>
                    
                                    
                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Congratulations! <br> Your submission have been approved by the U.S. Team. &nbsp; Your account is now active on the ANNEXTrades&trade; Business Portal.</span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>The business portal link is:&nbsp;<a href='http://www.annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_self'>www.annextrades.com</a></span></span></span></span></span></p>

                                        <p>
                                        <span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>No further action is required at this time.</span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>If you have additional product or service you wish to upload to your account, from your user dashboard select 'Add Product' and enter the appropriate information such as name, description, images and technical support will assist you to complete your listing.</span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Please contact Customer Service after new submission has been posted and allow 24 - 48 hrs for the change to be updated to your account.</span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Customer Service can be contacted at&nbsp;<a href='tel:8001238632' style='color:#0563c1; text-decoration:underline' target='_blank'>+1 (888) 641-2950</a>, WhatsApp us <a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>+1 (772) 877-9454</a> or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Thanks again for being a valued&nbsp;<a href='http://annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_blank'>ANNEXTrades&trade;</a>&nbsp;family member!</span></span></span></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Kind Regards,</span></span></span></span></span></p>
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
                            mail($to, $subject, $message, $headers);
                        
                        //$message = stripslashes(html_entity_decode($body));
                        echo $message;
                        //echo $rw['vendor_id']."<br />";
                }
                else{
                    echo 'Already Send';
                } 
            }
?>