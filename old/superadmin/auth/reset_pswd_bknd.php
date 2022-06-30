<?php 
include'../../registration/config.php';

$reg=$_POST['reg'];
$password=$_POST['password'];

$sql=mysqli_query($con, "UPDATE registration SET password='$password' WHERE vendor_id='$reg' ");
//var_dump($conn, $sql);

if($sql){
    
	print('<script>alert("Your password is changed successfully.. !! Sign In Now");</script>');
	print("<script>location.href='./?Success';</script>");
}
else{
	print('<script>alert("Failed to submit your request..!! Try Again");</script>');
	print("<script>location.href='./?Failed';</script>");
}
?>