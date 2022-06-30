<?php
ob_start();
session_start();
include_once ("db-connect/notfound.php");
//$sess_id=$_SESSION['sess_id']; 
$session_user=$_SESSION['user_login'];

if(isset($_REQUEST['cmail']))
{
$cmail=$_REQUEST['cmail'];
$res=mysqli_query($con,"select * from add_contacts where contact_mail='$cmail' and user_id='$session_user'");
$num=mysqli_num_rows($res);

if($num > 0)
{
echo "$cmail Already exit";
}
else
{

if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $cmail))
{
echo "<span style=font-size:12px><font color=red>$cmail Invalid email</font></span>";
}else{
echo "<span style=font-size:12px><font color=green> $cmail Valid Email</font></span>";
}
} 
}
?> 