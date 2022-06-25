<?php
session_start();
  $name = $_POST['name'];
  $companyname = $_POST['companyname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $location = $_POST['location'];
  $product = $_POST['product'];
  $specification = $_POST['specification'];
  $quantity = $_POST['quantity'];
  $message = $_POST['message'];
  $to = "quotes@annextrades.com";
		$headers = "From: welcome@annextrades.com" . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$emailbody = "<p>You have recieved a new message from the enquiries form on your Themal Paper Site.</p>
                  <p><strong>Name: </strong> {$name} </p>
                  <p><strong>Company Name: </strong> {$companyname} </p>
                  <p><strong>Address: </strong> {$email} </p>
                  <p><strong>Phone: </strong> {$phone} </p>
                  <p><strong>Location: </strong> {$location} </p>
                  <p><strong>Product: </strong> {$product} </p>
                  <p><strong>Specification: </strong> {$specification} </p>
                  <p><strong>Quantity: </strong> {$quantity} </p>
                  <p><strong>Message: </strong> {$message} </p> ";

    mail($to,"New Enquiry",$emailbody,$headers);

    $_SESSION['message'] = "Message Sent";

    echo "<script>location.href='../#contact'</script>";

?>
