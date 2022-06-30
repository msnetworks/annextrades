<?php 
  
  include('config.php');
    $q = $con->query("SELECT email FROM registration WHERE email='".$_GET['email']."' ");
    if (mysqli_num_rows($q) == '0') {
        $resp = "available";
    }
    else {
        $resp = "exist";
    }
    echo json_encode($resp);

?>