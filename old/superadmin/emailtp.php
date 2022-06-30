<?php 

    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `email_template` WHERE id='8' ");
        $row_adv2=mysqli_fetch_array($query2);
        echo html_entity_decode($row_adv2['body']);
        ?>