<?php

include '../../registration/config.php';

$email=$_POST['email'];
    $check=mysqli_query($con, "select * from registration where email='".$email."'");
        $num=mysqli_num_rows($check);
            if($num){   
                
                    $sql=mysqli_query($con, "SELECT * FROM registration where email='$email'");

                    $row=mysqli_fetch_assoc($sql);
                    $reg= $row['vendor_id'];
                    
                    $link="http://annexis.net/mydashboard/auth/reset_password.php?reg=$reg&email=$email";
                    
                    $sub="Annexis Business Solutions: Forgot Password";
                    
                    $msg="Dear Vendor
                    Annexis Business Solutions !!!
                    
                    Thank you for interacting with Annexis Business Solutions Online Services.
                    
                    A request was made by you to change the password password for your account. Your details are as follows:
                    
                    Email : $email
                    
                    Click the below link to reset your password.
                    
                    $link
                    
                    May the choicest blessings for better health of Annexis Business Solutions Service be always with all of us.
                    
                    Annexis Business Solutions !!!";
                    
                    $headers = 'From: <welcome@annexis.net>';
                    
                    @mail($email, $sub, $msg, $headers);
                    
                    	print('<script>alert("A reset password link is sended to your registered email !!");</script>');
                    	print("<script>location.href='frgtpw_check_email.php?Success';</script>");
                    }   
                else{
                    print('<script>alert("E-mail not exist..!! \n Check you email");</script>');
                    print("<script>location.href='forget_password.php?InvalidEmail';</script>");
                }

?>