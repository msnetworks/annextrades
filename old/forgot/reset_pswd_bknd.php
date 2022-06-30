<?php 
include('../controller/config.php');

$reg=$_POST['vendor_id'];
$password=$_POST['password'];
$vn_reg = base64_encode($reg);
$pass = base64_encode($password);

$sql1=mysqli_query($conn, "UPDATE registration SET password='$password' WHERE vendor_id='$reg' ");


if($sql1){
		$sql=mysqli_query($conn, "SELECT * FROM registration where vendor_id='$reg'");

		$row=mysqli_fetch_assoc($sql);
		$email= $row['email'];
		$fname= $row['firstname'];
		$link="https://annextrades.com/forgot/reset_password.php?reg=$reg&email=$email";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From: welcome@annextrades.com'."\r\n".'Reply-To: annexis.data@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
		
		
		$sub="A request made for a Password Reset.";
		
		$msg="
			<br /><img src='https://annextrades.com/assets/images/logo.png' alt='' style='width: 20%; height: auto; margin: auto; text-align: left;'>
			<br /><br /><br />
			Hello $fname <br /><br />
		
			A password update request was	 completed.<br />

			If you did not make this request, we would suggest you update your password for increased security. <br /><br />
 
			<br />
			Kind Regards, <br />
			Annexis Team <br /><br />
			
			Please use the link below to reset password <br /><br />
			<a href='$link'><button style='background: #237EDE; padding: 15px 30px; color: #fff; font-size: 20px; border: 0px; border-radius: 3px;'>Reset Your Password</button>
			";
		
		@mail($email, $sub, $msg, $headers);

	print('<script>alert("Your password is changed successfully. Sign In Now");</script>');
	print("<script>location.href='../login.php?ResetSuccess';</script>");
	//print("<script>location.href='https://annextrades.com/reset_pswd.php?reg=$vn_reg&pass=$pass';</script>");
}
else{
	print('<script>alert("Failed to submit your request. Try Again");</script>');
	print("<script>location.href='../login.php?ResetFailed';</script>");
}
?>