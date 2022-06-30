<?php session_start();
require_once('../../admin_login/connect.php');
if(@$_SESSION['std_registration_no']!=''){
        //$pass = 'admin';
        $pass = $conn->real_escape_string($_POST['old_pass']);
        //$password = sha1('$pass');
        $confirm_password = $_POST['cfm_pass'];
        
        //$curr = 'admin';
        $curr = $conn->real_escape_string($_POST['new_pass']);
       //$currpass = sha1($curr);
        //echo $currpass ."</br>";
        //echo $curr ."</br>";
        //echo $password ."</br>";
        //echo $pass;
        $check=mysqli_query($conn, "select * from student_record where std_registration_no='".$_SESSION['std_registration_no']."' and password='".$pass."' ");
		$num=mysqli_num_rows($check);
		if($num){
		
		$curr = $conn->real_escape_string($_POST['new_pass']);
		//$password = sha1('$pass');
        if($curr != $confirm_password){
            print('<script>alert("Confirm Password does not match..!! \n Try Again");</script>');
		    print('<script>location.href="../changepassword.php?status=ConfirmPasswordNotMatch"; </script>');
            
        }
        else{
        $query=mysqli_query($conn,"update student_record set password='".$curr."' where std_registration_no='".$_SESSION['std_registration_no']."' ");
        $num=mysqli_affected_rows($conn);
        //exit;
        if($num=='1'){
            print('<script>alert("Password Change Successfully..!");</script>');
        	echo "<script>location.href'../changepassword.php?status=success';</script>";
        }else{
            
        		echo "<script>location.href'../changepassword.php?status=fail';</script>";
        }
		}
		}else{
		    print('<script>alert("Current Password is Incorrect..!! \n Try Again");</script>');
		    print('<script>location.href="../changepassword.php?status=CurrentPasswordIncorrect"; </script>');
        }
        
}
else{
    echo "<script>location.href'../auth/';</script>";
    
}

?>