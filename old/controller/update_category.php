<?php 
    //include('config.php');
    $con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');
    $conn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'kingcommerce');
    $connn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'product');
    $i = 1;
    

    $c = $connn->query("SELECT * FROM product");
    while ($a=mysqli_fetch_array($c)) {
        $d = $con->query("SELECT * FROM category WHERE c_id = '".$a['p_category']."'");

        while ($e = mysqli_fetch_array($d)) {

            $name = $e['category'];
            $f = $conn->query("SELECT * FROM categories WHERE name = '$name'");
            while ($g = mysqli_fetch_array($f)) {
                    $connn->query("UPDATE product SET `new_category` = '".$g['id']."', `category_name` = '".$g['name']."' WHERE userid = '".$a['userid']."'");
                    
                    echo $g['name']."(".$g['id'].")<br>";
                }
        }
        
        //echo $i;
        $i++;
    }

?>  