<?php 
    include('../../controller/config.php');

    $chkemail = $conn->query("SELECT email FROM registration WHERE email = '".$_POST['email']."' ");

    if (mysqli_num_rows($chkemail) == NULL) {
          
        $query = $conn->query("UPDATE registration SET email='".$_POST['email']."' WHERE vendor_id='".$_POST['id']."' ");

        $response = "Update Successfully.";

    }else{
        $response = "Email Alreay Exist.";
    }

    echo json_encode($response);

?>  