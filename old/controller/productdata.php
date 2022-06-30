<?php
include('config.php');
        $query1=mysqli_query($conn, "SELECT * FROM product order by id desc");
            WHILE($row_adv1=mysqli_fetch_array($query1)){
                $id = $row_adv1['id'];
                $p_name = $row_adv1['p_name'];
                $price = $row_adv1['range1']." - ".$row_adv1['range2'];
                $photo = "https://annextrades.com/productlogo/".$row_adv1['p_photo'];
            $data[] = array('id' => $id, 'name' => $p_name, 'price' => $price, 'image' => $photo);
    } 
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, X-Custom-Header');

//$data = "Working MS";
echo json_encode($data);


?>