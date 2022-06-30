<?php 
  
  include('config.php');
    $q = $con->query("SELECT pan_no FROM registration WHERE pan_no='".$_GET['pan_no']."' ");
    if (mysqli_num_rows($q) == '0') {
        $resp = "available";
    }
    else {
        $resp = "exist";
    }
    echo json_encode($resp);

?>