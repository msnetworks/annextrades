<?php
    include('../.../controller/config.php');

    $cat = $conn->query("SELECT * FROM category WHERE parent_id = '".$_POST['category']."'");

    WHILE($subcat = mysqli_fetch_array($cat)){
       
        $response = "<option value='".$subcat['category']."'>".$subcat['category']."</option>";
    }
    echo json_encode($response);
?>