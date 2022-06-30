
<?php       session_start();
            if($_SESSION['super_adm'] != ""){
            include('../../controller/config.php');
            
            $ip=$_SERVER['REMOTE_ADDR'];
              $name=mysqli_real_escape_string($conn, $_POST['name']); 
              $companyname=mysqli_real_escape_string($conn, $_POST['companyname']); 
              $order_price=mysqli_real_escape_string($conn, $_POST['order_price']);
              $order_quantity=mysqli_real_escape_string($conn, $_POST['order_quantity']);
              $video=mysqli_real_escape_string($conn, $_POST['video']);
              $user_type=mysqli_real_escape_string($conn, $_POST['user_type']);
              $description=htmlspecialchars($_POST['description'], ENT_QUOTES);
              $added_by=mysqli_real_escape_string($conn, $_POST['added_by']);

                
            $update_query="UPDATE landing_post SET `name`= '$name',`companyname`= '$companyname', video='$video', `description`='$description', user_type='$user_type', added_by='$added_by', status='0' WHERE id='".$_GET['id']."'"; 
            if(
            $conn->query($update_query) === TRUE){
                $_SESSION['msg'] = 'success';
                //echo 'success';
                echo "<script>location.href='../landing_postlist.php'</script>";
            }
            else{
                echo $conn->error;
                $_SESSION['msg'] = 'failed';
                echo "<script>location.href='../edit_buyerpost.php?id=".$_GET['id']."'</script>";
            }
            //echo var_dump($update_query);
            echo $conn->error;
    }else{
        echo "<script>location.href='../auth'</script>";
    }
?>