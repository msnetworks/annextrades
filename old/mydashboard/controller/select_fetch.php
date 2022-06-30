<?php 
//include("../admin_login/connect.php");
$query=mysqli_query($conn, "SELECT * FROM `student_record` WHERE std_registration_no='".$_SESSION['std_registration_no']."' ");
$row_adv=mysqli_fetch_array($query);

$std_sub = mysqli_query($conn, "SELECT DISTINCT subject FROM `student_subject` WHERE std_registration_no='".$_SESSION['std_registration_no']."' ");
$std_sub1 = mysqli_query($conn, "SELECT DISTINCT subject FROM `student_subject` WHERE std_registration_no='".$_SESSION['std_registration_no']."' ");



?>