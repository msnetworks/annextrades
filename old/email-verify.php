<?php 

    include('controller/config.php');
    $vendor_id = mysqli_real_escape_string($conn, $_GET['vendor_id']);
    $email_code = mysqli_real_escape_string($conn, $_GET['verify_code']);
    $package = $_GET['package'];
    echo $package;
    $query = mysqli_query($conn, "SELECT * FROM registration WHERE vendor_id = '$vendor_id' and email_verify = '$email_code'");
    $match  = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $fname = $row['firstname'];
    $email = $row['email'];
    $phone = $row['phonenumber'];
    $email_verify = $row['email_verify']; 
    if ( $match ) {
        
        $email_update = mysqli_query($conn, "UPDATE registration SET email_verify = 'Verified', userstatus = '0' WHERE vendor_id = '$vendor_id'");
        if ($email_update) {
        
        echo "<script>alert('Your Email Has Been Verify Successfully.');</script>";

         $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= 'From: welcome@annexis.net'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
        //$a=" $firstname Thanks for registering at AnnexTrades..!!";
        $subject = "Congratulations ".$fname."..";
          $msg="<body style='background: #f9f9f9; align-items: center;' class='justify-content-center w-100'>";
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
                                <img src='https://annextrades.com/assets/images/logo.png' alt='' style='width: 40%; max-width: 600px; height: auto; margin: auto; display: block;'>
                              </td>
                            </tr>  
                            <tr>
                              <td class='logo' style='text-align: center;'>
                              </td>
                            </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td valign='middle' class='hero bg_white' style='padding: 3em 0 2em 0;'>
                            <img src='https://annextrades.com/assets/images/congo.png' alt='' style='width: 100%; max-width: 600px; height: auto; margin: auto; display: block;'>
                          </td>
                        </tr>
                        <tr>
                          <td valign='middle' class='hero bg_white' style='padding: 2em 0 4em 0;'>
                            <div class='text left' style='padding: 0 2.5em; text-align: left; font-size: 15px !important;'>
                              

                              <p><span style='color: red;'>Congratulations </span><b> ".$fname."</b>, for taking your first step towards business expansion in the United States of America! <br />

                              On behalf of our whole AnnexTrades™ team, I extend to you, a wholehearted welcome from the AnnexTrades<superscript>™</superscript> family.  <br />
                              Together, we will work to help you grow your business in the U.S.A.<br />

                              AnnexTrades<superscript>™</superscript> platform has been specially designed to provide forward thinking businessmen like yourself with the infrastructure to launch 
                              and expand your business in the U.S.A.  
                              We are confident that AnnexTrades<superscript>™</superscript> will help you gain exposure and a 
                              healthy client base in the U.S.A. market.<br />

                              If you have not done so already, please remember that it is essential for you to complete your
                              company profile and add your product or service details in order to become active in the market. <br />

                              Please proceed to login to our marketplace business portal: <a href='https://annextrades.com'>www.annextrades.com</a>, 
                              and access your user dashboard to take full advantage of your 30-day free trial period. 
                              Use the username and password used to create your account to <a href='https://annextrades.com/login.php'>Sign In</a>.<br /><br />

                              <a href='https://youtu.be/gT0WRBmlPEk'>https://youtu.be/gT0WRBmlPEk</a> <br /><br />

                              During entry, if your product category is not found as an option, please notify 
                              Customer Support and we will add your category to our system in order for
                               your information to be properly found by potential buyers. <br />

                              After completing your Product or Service upload, please notify Customer Support that your account is now ready
                               for review and approval. If you are having difficulty uploading your Product or Service, 
                               please notify Customer Support for assistance. <br />

                              <b>Contact the Customer Support team at 1-800-123-8632 </b><br />
                            </p>
                              <br /><br />Kind Regards,<br /> <a href='https://annextrades.com'>AnnexTrades<superscript>™</superscript></a>
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
        $re_email = 'annexis.data@gmail.com';
        $a1 ="$fname verified their email";
        $msg1 = "
        $fname verified their email <br />
          Vendor ID : $vendor_id <br />
          Name : $fname $lname <br />
          E-mail : $email <br />
          Phone Number : $phone <br /><br />
          E-mail Verificatation is Successfully Completed. <br /><br />
        ";
        @mail($email,$subject,$msg,$headers);
        @mail($re_email, $a1, $msg1, $headers); 

        header("location: https://annexis.net/registration/?vendor_id=$vendor_id&package=$package");

        //header("location: https://annextrades.com/register-new.php?vendor_id=$vendor_id");
        exit();
        }
        else{
            echo "<script>alert('The url is either invalid or you already have verified your email..');</script>";
            echo "<script>location.href='/'</script>";
        }
    }
    else{
            $query1 = mysqli_query($conn, "SELECT * FROM registration WHERE vendor_id = '$vendor_id' and payment = 'No'");
            $match1  = mysqli_num_rows($query1);
            $row1 = mysqli_fetch_array($query1);

            if( $match1 ){

            $email_verify = $row['email_verify'];
            echo "<script>alert('Your email is already verifiedn/. \n\n Proceed to Payment and complete your registration.!!');</script>";
            echo "<script>location.href=' https://annexis.net/registration/?vendor_id=$vendor_id&package=$package'</script>";
            //echo "<script>location.href=' https://annextrades.com/register-new.php?vendor_id=$vendor_id'</script>";

            }

            else {
                echo "<script>alert('Your Registration is Already Completed.');</script>";
                echo "<script>location.href=' https://annexis.net/'</script>";
            }

    }
    
?>