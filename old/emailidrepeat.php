<?php
include_once ("db-connect/notfound.php");


$id=$_GET['email'];
 if( substr(basename($_SERVER['HTTP_REFERER']),0,18)=='change_emailid.php')
	 {
$select_sql="SELECT * FROM `registration` WHERE `email`='$id' and `id`!='".$_SESSION['sess_id']."' ";
}
else
	 {
$select_sql="SELECT * FROM `registration` WHERE `email`='$id'  ";
}

$select_query=mysqli_query($con,$select_sql);
$select_count=mysqli_num_rows($select_query);
if($select_count > 0)
 {
 
	 if(substr(basename($_SERVER['HTTP_REFERER']),0,18)=='change_emailid.php')
	 {
	 	echo "<span style='font-size:12px'><font color=red>Email ID Already Exists</font></span>";
		echo "<input type='hidden' value='1' name='ename1'>";
	 }
	 else
	 {
		echo "<span style='font-size:12px'><font color=red>Email ID Already Exists</font></span><a href=\"#\" onclick=\"show123('addcomments')\" class=\"news\">&nbsp;&nbsp;Forgotpassword</a>";
		echo "<input type='hidden' value='1' name='ename1'>";
	 }
 }
else
{
$email=$_GET['email'];
if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
{
echo "<span style='font-size:12px'><font color=red>Invalid email, Give Correct Format</font></span>";
echo "<input type='hidden' value='2' name='ename1'>";
}else{
echo "<span style='font-size:12px'><font color=green>Valid Email</font></span>";
echo "<input type='hidden' value='2' name='ename1'>";
}
} 


?>


