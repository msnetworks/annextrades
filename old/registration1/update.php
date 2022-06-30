<?php 
    include('config.php');


    $c = $con->query("SELECT * FROM registration");
    while ($a=mysqli_fetch_array($c)) {
        $con->query("UPDATE registration SET package='BusinessPortal' WHERE package=''");
        echo $a['email']."\n\n";
    }

?>