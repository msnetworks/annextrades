<?php session_start();
    $p_id = $_GET['product_id'];
    $cm_id = $_GET['id'];
    if ($_SESSION['super_type'] == 'superadmin') {
        # code...
    
    include('../../controller/config.php');
        $update = $conn->query("DELETE FROM product WHERE id='".$_GET['product_id']."'");
        echo "<script>location.href ='../product_list.php?msg=Deleted'</script>";
    }else{
    echo "<script>location.href ='../edit_newproduct.php?product_id=$p_id&id=$cm_id&msg=Editing'</script>";
    }
?>