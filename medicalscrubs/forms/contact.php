<?php
session_start();
  $name = $_POST['name'];
  $companyname = $_POST['companyname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $product = $_POST['product'];
  $message = $_POST['message'];
  $to = "quotes@annextrades.com";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: welcome@annextrades.com' . "\r\n";
    //$headers .= 'Cc: annexis.data@gmail.com' . "\r\n";

		$emailbody = "<p>You have recieved a new message from the enquiries form on your MedicalScrub Site.</p>
                  <p><strong>Name: </strong> {$name} </p>
                  <p><strong>Company Name: </strong> {$companyname} </p>
                  <p><strong>Address: </strong> {$email} </p>
                  <p><strong>Phone: </strong> {$phone} </p>
                  <p><strong>Product: </strong> {$product} </p>
                  <p><strong>Message: </strong> {$message} </p> ";

    if (mail($to,"New Enquiry",$emailbody,$headers)) {
      $_SESSION['message'] = "Message Sent";
      echo $_SESSION['message'];
      echo "<script>location.href='../#contact'</script>";
    }else{
      echo "Messages Failed";
    }
  

    

?>
