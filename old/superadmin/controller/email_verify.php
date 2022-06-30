<?php 

    include('../../controller/config.php');
    $vendor_id = mysqli_real_escape_string($conn, $_GET['vendor_id']);
    $email_code = mysqli_real_escape_string($conn, $_GET['verify_code']);
    
        $email_update = mysqli_query($conn, "UPDATE registration SET email_verify = 'Verified', userstatus = '0' WHERE vendor_id = '$vendor_id'");
        
        echo "<script>alert('Your Email Has Been Verify Successfully.');</script>";
       

        echo "<script>location.href='../user_profile.php?vendor_id=$vendor_id&msg=Success';</script>";
?>