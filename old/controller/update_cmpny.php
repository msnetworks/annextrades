<?php 
    //include('config.php');
    $conn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'kingcommerce');
    $con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');
    $i = 1;
    

    $c = $conn->query("SELECT * FROM users");
    while ($a=mysqli_fetch_array($c)) {
        $d = $con->query("SELECT * FROM registration WHERE email = '".$a['email']."'");

        while ($e = mysqli_fetch_array($d)) {
            $address = $e['address']." ".$e['city']." ".$e['state'];
            $conn->query("UPDATE users SET `shop_name`='".$e['companyname']."', `shop_details`='".$e['company_des']."', `shop_address`='$address', `owner_name` ='".$e['firstname'].$e['lastname']."', `shop_number` = '$i' WHERE email='".$a['email']."' ");
            echo $e['email']."<br>";
        }
        
        echo $i;
        $i++;
    }

?>  