<?php


                    if (isset($_REQUEST['submit_quote'])) {

                        $name = $_REQUEST['name']; // Get Name value from HTML Form
                        $mobile = $_REQUEST['phone'];  // Get Mobile No
                        $vendor_id = $_REQUEST['vendor_id'];  // Get Email Value
                        $message = $_REQUEST['message']; // Get Message Value
                        $emailadd =$_REQUEST['youremail'];


                        $mail = new PHPMailer();
                        require('smtpdetails.php');                      
                        //$mail->From->$email;
                        $mail->setFrom($emailadd);
                        $mail->addReplyTo($emailadd);
                       // $mail->FromName = $name;
                        //$mail->AddAddress("smiley18asha@gmail.com"); // On which email id you want to get the message
                        $mail->addAddress('smiley18asha@gmail.com');

                        // $mail->AddCC ($email);

                        $mail->IsHTML(true);
                        $mail->AllowEmpty = true;

                        $mail->Subject = "Get Quote Request"; // This is your subject

                        $mail->Body    = "Following are the details entered by the visitor:<br/><br/>
        Name: $name<br/>
        Mobile : $phone<br/>
        Vendor Id: $vendor_id<br/>
        Message: $message<br/>
        Email: $emailadd
        " ;
if (!$mail->send()) {
    //echo 'Message could not be sent.';
    $sentmessageerror ='*Your message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    ?>

    <style>
    #info-message-error {
    color: red;
    font-size: 18px;
    font-weight: bold;
}
    </style>

    <script>
  setTimeout(function(){
    document.getElementById('info-message-error').style.display = 'none';
    
  }, 7000);
</script>


    <?php
} else {
   // echo 'Message has been sent';
    $sentmessagesuccess ="*Your message has been sent";

    ?>

<style>
    #info-message-success {
    color: green;
    font-size: 18px;
    font-weight: bold;
}
    </style>
    <script>
  setTimeout(function(){
    document.getElementById('info-message-success').style.display = 'none';
   
  }, 7000);
</script>

    <?php
}
}
    ?>

<div class="single-section-2-right">
                        <p id="info-message-success"><?php echo $sentmessagesuccess; ?></p>
                        <p id="info-message-error"><?php echo $sentmessageerror; ?></p>
                        <h2 class="tab-title">Get Quote</h2>
                        <form action="" method="post" >
                            <div class="form-group">
                                <input type="text" placeholder="Enter your name" class="form-control" name="name" required>
                            </div>
                           
                            <div class="form-group">
                    <input type="email" placeholder="Enter your Email" class="form-control" value="<?php echo $gemail; ?>" name="youremail" required>
                            </div>
                        
                            <div class="form-group">
                                <input type="text" placeholder="Enter your mobile number" class="form-control" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" placeholder="Vendor ID" class="form-control" name="vendor_id" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit_quote" class="theme-btn" value="SEND ME A QUOTE" />

                            </div>
                        </form>
                        <div class="text-center note-msg">By sending a request, you accept our <a href="#">Terms of Use</a> and <a href="">Privacy policy</a></div>

                        <div class="ad-set-wrapper pt-4">
                            <div><img src="./assets/images/ad.jpg" class="w-100" alt=""></div>
                        </div>
                    </div>
