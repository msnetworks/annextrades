<?php 
    include('../../controller/config.php');

          
        $query = $conn->query("UPDATE registration SET companyname='".$_POST['companyname']."' WHERE vendor_id='".$_POST['id']."' ");

        $response = "Update Successfully.";
        
        echo json_encode($response);

?>  