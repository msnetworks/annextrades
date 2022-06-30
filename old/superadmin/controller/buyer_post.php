
<?php       session_start();
            if($_SESSION['super_adm'] != ""){
            include('../../controller/config.php');
            
            $ip=$_SERVER['REMOTE_ADDR'];
              $name=mysqli_real_escape_string($conn, $_POST['name']); 
              $companyname=mysqli_real_escape_string($conn, $_POST['companyname']);
              $video=mysqli_real_escape_string($conn, $_POST['video']);
              $user_type=mysqli_real_escape_string($conn, $_POST['user_type']);
              $description=htmlspecialchars($_POST['description'], ENT_QUOTES);
              $added_by=mysqli_real_escape_string($conn, $_POST['added_by']);

                
            $insert_qry="INSERT INTO landing_post (`name`,`companyname`, `video`, `description`, `user_type`, `added_by`, `status`) VALUES 
            ('$name','$companyname', '$video', '$description', '$user_type', '$added_by', '0')"; 
            
            if(
            $conn->query($insert_qry) === TRUE){
                $_SESSION['msg'] = 'success';
                echo "<script>location.href='../post_buyer.php'</script>";
            }
            else{
                $_SESSION['msg'] = 'failed';
                echo "<script>location.href='../post_buyer.php'</script>";
            }
            //echo var_dump($insert_qry);
            echo $conn->error;
    }else{
        echo "<script>location.href='../auth'</script>";
    }
?>