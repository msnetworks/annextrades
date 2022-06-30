<?php 
session_start();

session_destroy();
unset($_SESSION['user_login']);

$_SESSION['user_login']='';

header("location:index.php");

?>