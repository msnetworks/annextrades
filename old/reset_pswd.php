<?php 
include('controller/config.php');

$reg=$_GET['reg'];
echo $reg;
$password=base64_decode($_GET['pass']);
echo $password;
$sql=$conn->query("UPDATE registration SET password='$password' WHERE email='$reg' ");
//var_dump($conn, $sql);

if($sql){
    echo $conn->error;
	print('<script>alert("Your password changed successfully.");</script>');
	print("<script>location.href='login.php?msg=RSet_Success';</script>");
}
else{
	print('<script>alert("Failed to submit your request..!! Try Again");</script>');
	print("<script>location.href='https://annexis.net/mydashboard/auth/reset_password.php?reg=$reg&msg=RSetFailed';</script>");
}
?>