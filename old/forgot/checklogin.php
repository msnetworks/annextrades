<?php session_start();
require_once('../../registration/config.php'); ?>
<?php
$email = $con->real_escape_string($_POST['email']);
$password = $con->real_escape_string($_POST['password']);
//$password = sha1('$pass');

    $query=mysqli_query($con,"select * from registration where email='".$email."' and password='".$password."' and userstatus='0'");
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_array($query);
    $package = $row['package'];
    $vendor_id = $row['vendor_id'];
if($num>=1){
    
    /* $query1=mysqli_query($con,"select * from registration where email='".$email."' and userstatus='0'");
    $num1=mysqli_num_rows($query1); */
    /* if ($row['payment']=='Yes' ) { */
        
            $_SESSION['vendor_id']=$row['vendor_id'];
            /* $_SESSION['user_login']=$row['vendor_id']; */
            $_SESSION['user_login']=$row['id'];
            $session_user=$_SESSION['user_login'];
            
            /* if ($row['expiry_date'] >= date('Y-m-d H:i:s')) {  */
                header("location:../");
             /* }
            else{
                header("location: ../trail_expire.php?msg=TrailExp");
                echo "<script>'alert('Your free trail has been Expired.! \n Please payment and continue your service.')';</script>";
                //header("location: ../../registration/?package=$package&vendor_id=$vendor_id&msg=TrailExp");
            } */
    /* }
    
     elseif($row['payment']=='No')
    
    { 
        echo "<script>'alert('Your Payment Pending.! \n Please Payment and Continue.')'</script>"; 
        header("location: ../../registration/?package=$package&vendor_id=$vendor_id&msg=PaymentPending");
       
    }  */
}
else {
    header('location: ./?msg=InvalidUsr;');
}
    ?>