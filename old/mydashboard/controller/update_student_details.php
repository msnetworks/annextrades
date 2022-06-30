<?php session_start();?>
<?php if(@$_SESSION['std_registration_no']!=''){
      
      include("../../admin_login/connect.php");
    
      //------Details-----------
        $dob = $_POST['dob'];
        $school= $_POST['school'];
        $class= $_POST['class'];
        $roll= $_POST['roll'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pin = $_POST['pin'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $date = $_POST['date'];
          
      //------ End Details-----------
     
          
    $query=mysqli_query($conn, "UPDATE student_record SET dob='$dob', school='$school', class='$class', roll_no='$roll', address='$address', 
    district='$district', state='$state', pin='$pin', email='$email', contact='$contact', date_of_entry='$date' 
    WHERE std_registration_no='".$_SESSION['std_registration_no']."'");
	//var_dump($conn, $query);
	if($query)
	{
      print('<script>alert("Update Record Successfully");</script>');
       print('<script>location.href="../student_profile.php?Success"; </script>');
      //echo 'success';
      }
      else{
      echo 'failed';
        //echo "<script> location.href='contact.php?failed'></script>";
        
        print('<script>alert("Failed To Update Record..!!");</script>');
        print('<script>location.href="../student_profile.php?Failed"; </script>');
      }
    } 
            else{ 
              print('<script>location.href="../auth/"; </script>');
                } 
    ?> 