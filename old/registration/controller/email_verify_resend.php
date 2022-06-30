<?php
  include('../../controller/config.php');

  $id_no=mysqli_query($conn, "SELECT * FROM registration WHERE email = '".$_GET['email']."'");
  $email = $_GET['email'];
  $row_sno=mysqli_fetch_array($id_no);
  $vendor_id= $row_sno['vendor_id'];
  $verify_code = $row_sno['email_verify'];
  $firstname = $row_sno['firstname'];
  $lastname = $row_sno['lastname'];
  $phone = $row_sno['phonenumber'];
  //echo $verify_code.$vendor_id.$firstname.$lastname.$phone;
  $verify_link="http://annextrades.com/registration/email-verification.php?vendor_id=$vendor_id&verify_code=$verify_code";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
  $headers .= 'From: welcome@annextrades.com'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
  $a=" $firstname Thanks for registering at AnnexTrades.";
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
                      <a href='$verify_link' target='_blank' class='btn btn-primary'><button style='color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;'>VERIFY EMAIL ADDRESS</button></a></br>
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
    
  @mail($email, $a, $msg, $headers);

  $from1="annexis.data@gmail.com";
  $from2="brookjack2@yahoo.com";

  $a1="Resend Email Verification to $firstname.";
  /*  $msg1='<html><body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">';
  $msg1.="</body></html>"; */

  $msg1 = "
    $firstname Registered is in Annextrades <br /><br />

    Vendor ID : $vendor_id <br />
    Name : $firstname $lastname <br />
    E-mail : $email <br />
    Phone Number : $phone <br /><br />
    E-mail Verificatation is Pending. <br />
  ";
  @mail($from1, $a1, $msg1, $headers);
  @mail($from2, $a1, $msg1, $headers);

  //@header("location:https://annextrades.com/register-submit.php?vendor_id=$vendor_id&firstname=$firstname&lastname=$lastname&gender=$gender&pan_no=$pan_no&companyname=$companyname&street=$companyname&city=$city&zipcode=$zip&phonenumber=$phone&email=$email&email_verify=$email_code&package=$package&pky=$password&country=$country&state=$state&user_type=$user_type&newsletter_option=$newsletter1&ip_address=$ip&lang_status=$lang_status&source_url=$source_url", true);
  //header("location:./?vendor_id=$vendor_id&package=$package");
  echo "<script>location.href='../?vendor_id=$vendor_id&msg=Resend';</script>";
?>