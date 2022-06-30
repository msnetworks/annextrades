                <?php 
                    include('../../controller/config.php');
                    $id_no=mysqli_query($conn, "SELECT * FROM registration WHERE vendor_id = '".$_GET['vendor_id']."'");
                    $pro_no=mysqli_query($conn, "SELECT * FROM product_temp WHERE vendor_id = '".$_GET['vendor_id']."'");
                    $row_sno=mysqli_fetch_array($id_no);
                    
                    $email = $row_sno['email'];
                    $type = $row_sno['type'];

                    $vendor_id= $row_sno['vendor_id'];
                    $firstname = $row_sno['firstname'];
                    $lastname = $row_sno['lastname'];
                    $verify_code = $row_sno['email_verify'];
                    
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                    $headers .= 'From: welcome@annextrades.com'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
                    $a=" $firstname Thanks for Complete your registration.";
                    $msg="<body style='background: #f9f9f9; align-items: center; width: 100%; class='justify-content-center'>";
                    $msg.="
                        <div class='col-12' style='padding: 30px 15px; '>
                            <center>
                                <div style='width: 50%; background-color: #fff; border: 2px solid #ff7900;'>
                                    <div style='max-width: 600px; margin: 0 auto;' class='email-container'>
                                        <!-- BEGIN BODY -->
                                        
                                        <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='align-items: center !important;'>
                                            <tr>
                                                <td valign='top' class='bg_white' style='padding: 1em 1em 0 1em;'>
                                                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                                <td valign='middle' class='hero bg_white' style='padding: 3em 0 2em 0;'>
                                                <img src='https://annextrades.com/assets/images/logo.png' alt='' style='width: 50%; max-width: 600px; height: auto; margin: auto; display: block;'>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td class='logo' style='text-align: center;'><br>
                                                    <h2 style='text-align: left;'>Dear $firstname,</h2> <br>

                                                    <p>This is a confirmation that we have received $type details for review and approval.</p>
                                                
                                                    <p style='text-align: left;'>Summary of submission:</br></br><ol style='text-align: left;'>";
                                                    WHILE($row_p=mysqli_fetch_array($pro_no)){
                                            $msg .= "<li>".$row_p['p_name']."</li>"; }
                                            $msg .="</ol></p>
                                                    <br>
                                                    <p style='text-align: left;'>
                                                        A review and approval of your submitted details will be performed within 24 to 48 hours.  Please allow this time before your product will be viewed and active on our portal. </br></br>
                                                        Have a question? Please feel free to call us Toll Free at: 1(800)123-8632 or email Customer Support at support@annextrades.com.  Visit us at: www.annextrades.com
                                                    </p>
                                                </td>
                                            </tr>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='middle' class='hero bg_white' style='padding: 2em 0 4em 0;'>
                                            <div class='text center' style='padding: 0 2.5em; text-align: center;'>
                                                
                                            </div>
                                            </td>
                                        </tr><!-- end tr -->
                                        </table>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </body>
                ";
                      
                    @mail($email, $a, $msg, $headers);
      
                    $from1="annexis.data@gmail.com";
                    $from2="brookjack2@yahoo.com";

                    $a1=" $firstname completed their Registration.";
                   /*  $msg1='<html><body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">';
                    $msg1.="</body></html>"; */
                  
                    /* $msg1 = "
                      $firstname has complete their registration Annextrades <br /><br />

                      Vendor ID : $vendor_id <br />
                      Name : $firstname $lastname <br />
                      E-mail : $email <br />
                      Phone Number : $phone <br /><br />
                      E-mail Verificatation is Pending. <br />
                    "; */
                    @mail($from1, $a1, $msg, $headers);
                    @mail($from2, $a1, $msg, $headers);
                    echo $msg;
                    header("location:../../");
                  