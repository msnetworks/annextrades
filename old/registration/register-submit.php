
<?php       
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;
            require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require '../vendor/phpmailer/phpmailer/src/Exception.php';
            require '../vendor/phpmailer/phpmailer/src/SMTP.php';
            
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'welcome@annextrades.com';                     //SMTP username
            $mail->Password   = 'Annexis@123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            include('config.php');
            
            $userIP = $_SERVER['REMOTE_ADDR'];
            
                //your site secret key
                $secretAPIkey = '6LcWoLsZAAAAAGcx4obiNoZuCzPPt_QDK3dpDipN';
                //get verify response data
                $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                $response = json_decode($verify);
                if($response->success)
                {
               $response = "reCAPTCHA Verify";
              echo $response;
              
            /* include "language/english/language.php"; */
            $ip=$_SERVER['REMOTE_ADDR'];
                /* if(isset($_POST['submit']))
                  {     */
              $package=mysqli_real_escape_string($con, $_POST['package']);
              $firstname=mysqli_real_escape_string($con, $_POST['fname']); 
              $lastname=mysqli_real_escape_string($con, $_POST['lname']);
              $companyname=mysqli_real_escape_string($con, $_POST['companyname']);
              //$pan_no=mysqli_real_escape_string($con, $_POST['pan_no']);
              $phone=mysqli_real_escape_string($con, $_POST['phone']);
              $email=mysqli_real_escape_string($con, $_POST['email']);
              $password=mysqli_real_escape_string($con, $_POST['pass']);
              $user_type=mysqli_real_escape_string($con, $_POST['user_type']);
              @$newsletter=mysqli_real_escape_string($con, $_POST['newsletter']);
              $source_url=mysqli_real_escape_string($con, $_POST['source_url']);
              $lang_status='0';

                if($newsletter!="")
                {
                  $newsletter1=0;
                }
                else
                {
                  $newsletter1=1;
                }
                $email_code = rand(100000, 999999);
                $select_user="SELECT * FROM registration WHERE email='$email' "; 
                $res_user=mysqli_query($con,$select_user);
                $fetch_user=mysqli_fetch_array($res_user);
                $email_address=$fetch_user['email'];

                 /* $q = $con->query("SELECT pan_no FROM registration WHERE pan_no='$pan_no' ");
                if (mysqli_num_rows($q  ) == '0') { */ 
                $vndr = rand(000000, 999999);
                if($email_address == ""){ 
                $date = date('Y-m-d H:i:s');
                
                   $insert_qry="INSERT INTO registration (vendor_id, firstname, lastname, phonenumber, pan_no, companyname, email, email_verify,package, password, usertype, newsletter_option, ip_address, added_date, date, userstatus, lang_status, memberid, view) VALUES 
                    ('$vndr', '$firstname', '$lastname', '$phone', '$pan_no', '$companyname', '$email', $email_code,'$package', '$password', '$user_type', '$newsletter1', '$ip', NOW() , '$date', '1', '$lang_status', 'Free', '1')"; 
                   
                  if(
                    $con->query($insert_qry) === TRUE){
                    $email_en=base64_encode($email);
                    $id_no=mysqli_query($con, "SELECT * FROM registration WHERE email = '$email'");
                    $row_sno=mysqli_fetch_array($id_no);
                    $vendor_id= $row_sno['vendor_id'];
					          $verify_code = $row_sno['email_verify'];
                    $response = "$vendor_id";
                    $verify_link="http://annextrades.com/registration/email-verification.php?vendor_id=$vendor_id&verify_code=$verify_code&package=$package";
                    /* $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                    $headers .= 'From: welcome@annextrades.com'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
                     */
                    
                    $a=" $firstname Thanks for registering at AnnexTrades.";
                    $mail->CharSet = 'windows-1250';
                    $mail->setFrom('welcome@annextrades.com', 'ANNEXTrades');
                    $mail->addBCC('annexis.data@gmail.com');
                    $mail->AddAddress ($email);
                    $mail->IsHTML(true);

                    $mail->Subject = $a;
                    
                    $msg="<body style='background: #f9f9f9; align-items: center;' class='justify-content-center'>";
                    $msg.="
                      <div class='row'>
                        <div class='col-3 m-100'>&nbsp;</div>
                          <div class='col-6' style='padding: 30px 15px;'>
                            <center style='width: 100%; background-color: #fff; border: 2px solid #ff7900;'>
                              <div style='display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;  mso-hide: all; font-family: sans-serif;'>
                              </div>
                              <div style='max-width: 600px; margin: 0 auto;' class='email-container'>
                                <!-- BEGIN BODY -->
                                
                                <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='align-items: center !important;'>
                                  <tr>
                                    <td valign='top' class='bg_white' style='padding: 1em 2.5em 0 2.5em;'>
                                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                          <td valign='middle' class='hero bg_white' style='padding: 3em 0 2em 0;'>
                                            <img src='https://annextrades.com/assets/images/logo.png' alt='' style='width: 80%; max-width: 600px; height: auto; margin: auto; display: block;'>
                                          </td>
                                        </tr>  
                                        <tr>
                                          <td class='logo' style='text-align: center;'>
                                            <h1><a href='#'>e-Verify</a></h1>
                                          </td>
                                        </tr>
                                    </table>
                                  </td>
                                  </tr>
                                  <tr>
                                    <td valign='middle' class='hero bg_white' style='padding: 2em 0 4em 0;'>
                                      <div class='text center' style='padding: 0 2.5em; text-align: center;'>
                                        <h2>Please verify your email</h2>
                                        <a href='$verify_link' target='_blank' class='btn btn-primary'><button style='color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;'>Verify Email Address</button></a></br>
                                        <h3>Your Bridge to Expansion & Increased Market Share.</h3>
                                      </div>
                                    </td>
                                  </tr><!-- end tr -->
                                <!-- 1 Column Text + Button : END -->
                                </table>
                              </div>
                            </center>
                          </div>
                        <div class='col-3 m-100'>&nbsp;</div>
                      </div>
                      </body>
                    ";
                      
                    //@mail($email, $a, $msg, $headers);
                    $mail->Body    = $msg;

                   // $mail->send();
                    $from1="annexis.data@gmail.com";
                    $from2="brookjack2@yahoo.com";

                    $a1=" $firstname registered to AnnexTrades.";
                   /*  $msg1='<html><body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">';
                    $msg1.="</body></html>"; */
                  
                    $msg1 = "
                      $firstname Registered in Annextrades <br /><br />

                      Vendor ID : $vendor_id <br />
                      Name : $firstname $lastname <br />
                      E-mail : $email <br />
                      Phone Number : $phone <br /><br />
                      E-mail Verificatation is Pending. <br />
                    ";
                    @mail($from1, $a1, $msg1, $headers);
                    @mail($from2, $a1, $msg1, $headers);

                    
                    $response = "index.php?vendor_id=$vendor_id";
                    echo "<script>location.href='index.php?vendor_id=$vendor_id'</script>";
                    echo json_encode($response);
                  }
                  else{
                      //$response = 'Failed To Insert Data';
                      //echo $response;
                      echo "<script>location.href='index.php?Failed'</script>";
                        $response = $con->error;
                        echo json_encode($response);  

                  }
                }else{
                    $response = "Email already exist";
                    echo json_encode($response);
                    echo "<script>location.href='index.php?EmailExist'</script>";
                }
          } else {
            $response = "reCaptcha verification failed";
            echo "<script>location.href='index.php?RecaptchaFailed'</script>";
            
            //echo "Verification failed";
            echo json_encode($response);
        }
?>