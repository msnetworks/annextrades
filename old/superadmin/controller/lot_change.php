<?php 

include('../../controller/config.php');

    $lot = 'Lot_2';
    $query = $conn->query("SELECT * FROM whatsapp WHERE lot = '$lot'");
    while ($a = mysqli_fetch_array($query)) {
        $query2 = $conn->query("SELECT phone FROM whatsapp_report WHERE phone = '".$a['phonenumber']."' ");
        //var_dump($query->);
        if (mysqli_num_rows($query2)== 0) {
        echo mysqli_num_rows($query2).'<br';
        $conn->query("UPDATE whatsapp SET lot = 'Lot_3'  WHERE phonenumber = '".$a['phonenumber']."'");
        }
    }
 ?>