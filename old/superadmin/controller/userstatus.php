<?php 
    include('../../controller/config.php');
    $vendor_id = $_GET['vendor_id'];
    $status = $_GET['status'];

        $update = $conn->query("UPDATE registration SET userstatus = '".$_GET['status']."' WHERE vendor_id='".$_GET['vendor_id']."'");
        if ($_GET['status']=='0') {
            echo "<script>location.href ='../user_profile.php?vendor_id=$vendor_id&msg=Activate'</script>";
        }else{
            echo "<script>location.href ='../user_profile.php?vendor_id=$vendor_id&msg=Deactivate'</script>";
        }

?>