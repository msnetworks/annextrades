<?php 
include("db-connect/notfound.php"); 

//$arr_user=array("itechroom", "trialuser");
$username=$_POST['user_name'];
 $select_email="SELECT * FROM registration WHERE email='$username'";
$res_email=mysqli_query($con,$select_email);
$num_email=mysqli_num_rows($res_email);
$fetch_email=mysqli_fetch_array($res_email);
 $email=$fetch_email['email'];

if($email!="") 
{
echo '<span class="error">Email already exists.</span>';
exit;
}

/*else if(strlen($username) < 6 || strlen($username) > 15){echo '<span class="error">Username must be 6 to 15 characters</span>';}*/
//$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
else if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $username)) 
{
       echo '<span class="success">Email is available.</span>';
} 
else 
{
      echo '<span class="error">Is not a valid email</span>';
}

?>