
<?php       session_start();
            if($_SESSION['super_adm'] != ""){
            include('../../controller/config.php');
            
            $ip=$_SERVER['REMOTE_ADDR'];
              $package=mysqli_real_escape_string($conn, $_POST['package']);
              $firstname=mysqli_real_escape_string($conn, $_POST['fname']); 
              $phone=mysqli_real_escape_string($conn, $_POST['phone']);
              $email=mysqli_real_escape_string($conn, $_POST['email']);
              $password=mysqli_real_escape_string($conn, $_POST['pass']);
              $user_type=mysqli_real_escape_string($conn, $_POST['user_type']);

                $email_code = rand(100000, 999999);
                $select_user="SELECT * FROM superadmin WHERE email='$email' "; 
                $res_user=mysqli_query($conn,$select_user);
                $fetch_user=mysqli_fetch_array($res_user);
                $email_address=$fetch_user['email'];

                $vndr = rand(000000, 999999);
                if($email_address == ""){ 
            
                   $insert_qry="INSERT INTO superadmin (name, phone, email, password, usertype, status) VALUES 
                    ('$firstname', '$phone', '$email', '$password', '$user_type', '0')"; 
                   
                  if(
                    $conn->query($insert_qry) === TRUE){
                    $response =  "user_list.php";
                    //$response = $conn->error."ok";
                    
                  }
                  else{
                    $response = $conn->error."fail";

                  }
                }else{
                    $response = "Email already exist";
                }
                echo json_encode($response);
            }else{
                echo "<script>location.href='../auth'</script>";
            }
?>