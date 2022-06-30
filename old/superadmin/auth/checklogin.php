<?php session_start();
require_once('../../controller/config.php'); ?>
<?php
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
//$password = sha1('$pass');

    $query=mysqli_query($conn,"select * from superadmin where email='".$email."' and password='".$password."' and status='0'");
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_array($query);
    if($num>=1){
            $_SESSION['super_id']=$row['id'];
            $_SESSION['super_type']=$row['usertype'];
            $_SESSION['super_name']=$row['name'];
            $_SESSION['super_adm']=$row['email'];
                header("location:../");
    }
    else {
    header('location: ./?msg=InvalidUsr;');
    }
?>