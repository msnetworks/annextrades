<?php 
include('controller/config.php');

$reg= base64_decode($_GET['vn_reg']);

$password=base64_encode($_GET['pass']);

$sql=mysqli_query($conn, "UPDATE registration SET password='$password' WHERE vendor_id='$reg' ");
//var_dump($conn, $sql);

if($sql){
    
	print('<script>alert("Your password changed successfully.");</script>');
	print("<script>location.href='login.php?msg=RSet_Success';</script>");
}
else{
	print('<script>alert("Failed to submit your request..!! Try Again");</script>');
	print("<script>location.href='https://annexis.net/mydashboard/auth/reset_password.php?reg=$reg&msg=RSetFailed';</script>");
}
?>