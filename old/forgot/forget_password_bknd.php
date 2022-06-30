<?php

include '../controller/config.php';

$email=$_POST['email'];
    $check=mysqli_query($conn, "select * from registration where email='".$email."'");
        $num=mysqli_num_rows($check);
            if($num){   
                
                    $sql=mysqli_query($conn, "SELECT * FROM registration where email='$email'");

                    $row=mysqli_fetch_assoc($sql);
                    $reg= $row['vendor_id'];
                    $fname= $row['firstname'];
                    


                    $link="http://annextrades.com/forgot/reset_password.php?reg=$reg&email=$email";

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                    $headers .= 'From: welcome@annextrades'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
                    
                    
                    $sub="A request made for a Password Reset.";
                    
                    $msg="
                        <br /><img src='https://annextrades.com/assets/images/logo.png' alt='' style='width: 20%; height: auto; margin: auto; text-align: left;'>
                        <br /><br /><br />
                        Hello $fname <br /><br />
                   
                        A request made for a Password Reset from your account.<br />

                        You can reset your Annexis password by clicking the link below or copying and pasting it into your browser. For increased security, this password reset link will expire 24 hours after it was sent. 
                        <br /><br />
                        If you did not make this request, we would suggest you update your password for increased security.   
                        <br /><br /><br />
                        Kind Regards, <br />
                        Annexis Team <br /><br />
                        
                        Please use the link below to reset password <br /><br />
                        <a href='$link'><button style='background: #237EDE; padding: 15px 30px; color: #fff; font-size: 20px; border: 0px; border-radius: 3px;'>Reset Your Password</button>
                        ";
                    //$headers = 'From: <welcome@annexis.net>';
                    
                    @mail($email, $sub, $msg, $headers);
                    
                    	print('<script>alert("A Reset Password Link has been sent to your email,  please verify.");</script>');
                    	print("<script>location.href='frgtpw_check_email.php?Success';</script>");
                    }   
                else{
                    print('<script>alert("There is no account associated with the email provided.  Please re-enter a valid email.  Thanks");</script>');
                    print("<script>location.href='forget_password.php?InvalidEmail';</script>");

                }

?>