<?php 
    include('../../controller/config.php');

    
    $query = $conn->query("UPDATE registration SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."' WHERE vendor_id='".$_POST['id']."' ");
      $response = "Update Success";
      echo json_decode($response);

?>  