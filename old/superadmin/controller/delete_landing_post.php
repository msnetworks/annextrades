<?php session_start();
    $p_id = $_GET['product_id'];
    $cm_id = $_GET['id'];
    if ($_SESSION['super_type'] == 'superadmin') {
        
    include('../../controller/config.php');
        $update = $conn->query("DELETE FROM landing_post WHERE id='".$_GET['id']."'");
        $_SESSION['msg']='delete';
        echo "<script>location.href ='../landing_postlist.php'</script>";
    }else{
        $_SESSION['msg']='Failed';
    echo "<script>location.href ='../landing_postlist.php'</script>";
    }
?>