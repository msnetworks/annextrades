<?php 

    include_once '../../controller/config.php';
        $lotQuery = "SELECT * FROM whatsapp_tem_add ORDER BY id ASC LIMIT 12008";
        $lotResult = $conn->query($lotQuery);
    $i = '1';
        while ($q = mysqli_fetch_array($lotResult)) {
            $a = $conn->query("DELETE FROM whatsapp_tem_add WHERE phone = '".$q['phone']."'");
            if ($a) {
                # code...
                echo $q['phone'].' - '.$i.'<br>';
            }
            $i++;
    }

?>