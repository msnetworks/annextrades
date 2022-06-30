<?php    
        include('../../../controller/config.php');
                
            $ie='6';
            
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


                       
                            $message = "
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

                                                
                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img style='width: 285px;' src='https://annextrades.com/assets/images/mailimg/webinar.png' alt=''>
                                                
                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Link: </span></span><span style='color:#0563c1'><u><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'>ANNEXTrades Team Invites You - Zoom Meeting Invitation | Evite</a></u></span></span></span></p>
                                                    
                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size: 11pt;'><span style='font-family: 'Montserrat', sans-serif;'>Dear ". $rw['firstname'].",</span></span></strong></span></span></p>

                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:10.0pt'><span style='background-color:white'><span style='font-family:Arial,sans-serif'><span style='color:#2e3136'>Please join us on a Free Webinar to learn what buyer are looking for and need from you to make a purchase request. What to do and say to convert your leads into sales.&nbsp; </span></span></span></span></span></span></p>

                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:10.0pt'><span style='background-color:white'><span style='font-family:Arial,sans-serif'><span style='color:#2e3136'>Do you have any question about how our process work or how to get the best results?<br />
                                                Ask your questions directly to the USA Team. </span></span></span></span></span></span></p>

                                                <p style='text-align:center'>&nbsp;</p>

                                                <p style='text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Use the Link Below to RSVP and Reserve You Spot.&nbsp; </span></span></span></span></p>

                                                <p style='text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFYAAAAuCAMAAACF+R5pAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAIKUExURf////7+/v39/fz8/Ojo6NDQ0KysrJSUlK2trbi4uKioqKWlpaKiopOTk4CAgH5+fn19fZGRkaOjo6ampre3t8PDw8nJydvb2+Pj4+3t7fj4+Pv7+/f3983NzWhoaD4+PjMzMzExMTAwMDIyMjQ0NDo6Ok5OTo6Ojt3d3dfX11VVVTY2NtnZ2UFBQTc3N0xMTIeHh9TU1Ovr6/X19fr6+vn5+fT09Ofn57u7u1tbWy8vL0NDQ/Dw8PLy8vHx8erq6uDg4NbW1ry8vIuLi2BgYEJCQjU1NV5eXoqKimlpadjY2Pb29rOzszk5OUtLS5aWlm5ubjg4OHV1dUBAQDw8PJqamkhISHNzc6qqqsvLy7CwsD8/P8HBwT09PWxsbGdnZ29vb+/v7+zs7NPT08LCwq+vr+bm5k1NTVBQUMjIyDs7O1dXV+7u7qurq0pKSmRkZNzc3J2dnVxcXF1dXV9fX9/f3/Pz85mZmd7e3mNjY5iYmGFhYUlJSampqURERLa2tk9PT1NTU1paWnt7e5CQkKSkpL6+vpeXl6CgoFJSUunp6Z+fny4uLnh4eC0tLW1tbdra2tXV1bGxseHh4Zubm0dHR7S0tLW1tYKCgqGhoczMzJycnGVlZYmJiZKSkrm5uUZGRoGBgXBwcMDAwMTExL+/v5WVlYODg3p6etLS0nZ2dkVFRYSEhAAAAMCWfIcAAACudFJOU///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////APxmpecAAAAJcEhZcwAAIdUAACHVAQSctJ0AAALMSURBVFhH7ZZLkqwgEEVrKQ4JRw5ZCjM3wJwZO5AFsNp3b2aiFGWXVkVHvEmfrtaUT5o/wMcff/xXYg1LWoL3KSQImwERDd776ly0oXep61RKmYjdDuS5sF2G5MXZpAtqFlWHulExQZv+cCnBZr7BySwaEeljjH7mzDw4HNHjnF/mTMWztf7IRhPWwa/AF1mbvEtFA71X9vLdyeSe1ULNiK7WdoAOk06JnGnygJc4ajhfXL5QC1uziUrvbco5b6FSv0R9x0Prqwc7EVX11I2GaRtSJS55pCvW6sOyatW8Mxbjn22VSE/roLgyEPw7OEsYZ7Fc6gzvtGlHSmCq9iREpg20yxpe/BGclh5HveQixoSuMoN1C7JYMSw5Ep8jPLJQoeodypVVJa8z8LDSPut+D21dk3dpKtZiqK4DaORL7ml9wAS5Y43KvQEvcn3yMwaacGMDIFPRZYUpcm9Ag0kdXDAmvicWC2keyuvcXV+GUP2Am4p6OlqbX+sN7Fa8J/pi2sbYouwnKSycEIem1IZfsBcAVqoKRtZaZv6l0HKicjxq9wWodxWQeRUAVp2UExW3f5ZtwqB7lbBbi61JBQGR3UwkNc1q9M0YPEIb6J5S1Kq5hzvgWRrPqK0S4Ha3p5yXV7g8Xhq7kVDbTUG54Qistbrafw6cOXHOnoSpdNFEOTOQ7aJlwDF31ZY28mk9tOzzQiAgREiEtwFXYI4KS5czzIeB2FJJTahp2LwiZ/eWLkDhqjZEeTelL2IFLTT9zspVek+tSWqpy5TAAfe1MqYNhlm1ydO0+a4M9k3pFpEnLn+4IOvcfDl705QJ6gSW4Qdqe6i5ZFsVfuVuw/rSiOJJ2r/AYy+gZnwvagO+CvGdDCHivO93iQ+JPFwZjilvODixyBw+X1hh3enxVTAcvkYNWWMmz19GtsfJB7FppOnLz0o/fx328y9d/k0ej3/DGR6vFtterAAAAABJRU5ErkJggg==' style='height:20px; width:37px' /><span style='color:#0563c1'><u><a href='http://evite.me/6dWxc4gd34' style='color:#0563c1; text-decoration:underline'>ANNEXTrades Team Invites You - Zoom Meeting Invitation | Evite</a></u></span></span></span></p>

                                                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Regards, </span></span></span></span></p>
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