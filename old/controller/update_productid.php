<? php 
    //include('config.php');
    $con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');
    $conn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'kingcommerce');
    $connn = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'product');
    $i = 1;
    

    $c = $connn->query("SELECT * FROM product");
    while ($a=mysqli_fetch_array($c)) {
        $d = $con->query("SELECT * FROM registration WHERE id = '".$a['userid']."'");

        while ($e = mysqli_fetch_array($d)) {

            $email = $e['email'];
            $f = $conn->query("SELECT * FROM users WHERE email = '$email'");
                while ($g = mysqli_fetch_array($f)) {

                    $connn->query("UPDATE product SET `new_userid` = '".$g['id']."', `old_companyname` = '".$a['companyname']."', `new_companyname` = '".$g['shop_name']."' WHERE userid = '".$a['userid']."'");
                    
                    echo $g['email']."(".$g['id'].")<br>";
                }
        }
        
        //echo $i;
        $i++;
    }

?>  