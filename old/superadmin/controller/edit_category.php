<?php 
    include('../../controller/config.php');

    $c_id = $_GET['c_id'];
    $p_id = $_GET['p_id'];
    $category_name = ['category'];

    $udate = $conn->query("UPDATE category SET category = '$category_name' WHERE c_id = '$c_id'");
    
    if($udate){
        echo "<script>location.href='../category_list.php?c_id=$c_id&p_id=$p_id&msg=success'</script>";
    }
    else{
        echo "<script>location.href='../category_list.php?c_id=$c_id&p_id=$p_id&msg=failed'</script>";
    }
?>