<?php 
    //include('config.php');
    $c onn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'kingcommerce');
    $i = 20;
    $c = $conn->query("SELECT * FROM products WHERE slug='anx00873903'");

    while ($a=mysqli_fetch_array($c)) {
        $slug = 'anx00'.rand(0, 999999);
        $conn->query("UPDATE products SET slug = '$slug' WHERE slug = 'anx00873903' ");
        echo $a['name'].'<br>';
    }

?>      