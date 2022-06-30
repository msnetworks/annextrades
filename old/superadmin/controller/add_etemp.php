
<?php       session_start();
            if($_SESSION['super_adm'] != ""){
            include('../../controller/config.php');
            
              $subject=mysqli_real_escape_string($conn, $_POST['subject']);
              $body=htmlspecialchars($_POST['body'], ENT_QUOTES);
                if ($_GET['action'] != 'update') {
                  
                  $insert_qry="INSERT INTO email_template (subject, body) VALUES 
                    ('$subject', '$body')"; 
                   
                   if($conn->query($insert_qry) === TRUE){
                     //echo $conn->error;
                     echo "<script>location.href='../email_template.php'</script>";                    
                    }
                    else{
                      echo $conn->error."fail";
                    }
                  }
                  else{
                  $insert_qry="UPDATE email_template SET subject='$subject', body='$body' WHERE id = '".$_GET['i']."'"; 
                   
                   if($conn->query($insert_qry) === TRUE){
                     //echo $conn->error;
                     echo "<script>location.href='../email_template.php?i=".$_GET['i']."&v_id=".$_GET['v_id']."'</script>";                    
                    }
                    else{
                      echo $conn->error."fail";
                    }
                  }
            }else{
                echo "<script>location.href='../auth'</script>";
            }
?>