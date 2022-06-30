<?php    
        include('../../../controller/config.php');
                
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

                        $message ="
                                <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                            
                                <tr>

                                <td colspan='2'>
                                    <p style='text-align:center'>&nbsp;</p>
                    
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>USA Distributor:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['companyname']."</span></span></span></span></p>
                    
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['vendor_id']."</span></span></span></span></p>
                    
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['firstname']." ". $rw['lastname']."</span></span></span></span></p>
                    
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Email ID: </strong>". $rw['email']."</span></span></span></span></p>
                    
                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Contact Number: </strong>". $rw['phonenumber']."</span></span></span></span></p>
                    
                                    <p style='text-align:center'>&nbsp;</p>
                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-family:Verdana,sans-serif'>This is your notice that we received your payment and your account status is 'Active' </span></span></span></p>


                                    <p style='margin-left:24px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='color:black'>Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                    <span style='color:#0563c1'><u><a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>https://wa.me/17728779454</a></u></span> </span></span></p>

                                    <p style='margin-left:24px'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'>
                                    <span style='color:black'>Visit us at: </span>
                                    <span style='color:#0563c1'><u><a href='http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM' style='color:#0563c1; text-decoration:underline' target='_blank'>www.annextrades.com</a></u></span></span></span></p>

                                    <p style='margin-left:24px'>&nbsp;</p>

                                </td>
                            </tr>
                            </table>
                                ";
                            
                        echo $message;
                        //echo $rw['vendor_id']."<br />";
                }
                else{
                    echo 'Already Send';
                } 
            }
?>