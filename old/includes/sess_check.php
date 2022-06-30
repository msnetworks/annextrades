<?php 
$session_user=$_SESSION['user_login'];

if($session_user=="")
{
header("location:login.php");

}



?>