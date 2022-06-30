<?php
//session_start();

include("../db-connect/notfound.php");

if(isset($_REQUEST['submit_x']))
{
//print_r($_REQUEST);
		
        $username=mysqli_real_escape_string($con, $_REQUEST['username']);
        $password=mysqli_real_escape_string($con, $_REQUEST['pass']);
        $exequery=mysqli_query($con,"select * from adminlogin where userid='$username' and password='$password'")or die("Error In Query".mysqli_error($con));
   if(mysqli_num_rows($exequery)){
    	$fetchdata=mysqli_fetch_array($exequery);
 	    $user=$fetchdata['userid'];
      $_SESSION['admin_user']=$user;
		
        header("location:dashboard.php");    
  }
  else{
     header("location:index.php?errmsg");
     
  }
  
}

if(isset($_SESSION['admin_user']))
{
header("location:dashboard.php");
}
$sel_general = mysqli_fetch_array(mysqli_query($con,"select * from generalsettings"));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin - Panel</title>
<script src="js/user_validate.js" type="text/javascript"></script>
<link href="css/login-box.css" rel="stylesheet" type="text/css" />
</head>
<script>
function validate()
{
if(document.getElementById('username').value=='')
{
alert("Please enter the username");
return false;
}

if(document.getElementById('pass').value=='')
{
alert("Please enter the password");
return false;
}
}

</script>
<body bgcolor="#FFFFFF">

<div style=" height:100px; width:100%;">
<?php
  if($logo=="")
  {
  $logo="logo.jpg";
  }
  else 
	 {
		if(file_exists("../images/".$logo))
		{
			$logo = $logo;
		}
		else{
			$logo = "logo.jpg";	
		}
	 }
  ?>
<table width="80%" border="0">
<tr>
<td width="22%"><span><img src="../images/<?php echo $logo ;?>" width="161" height="70" border="0" /></span></td>
<td width="100%" colspan="3" align="center" style="font-size:24px; color:#003399; font-weight:bold;">Admin Panel</td>
</tr>
</table>
<!--<div  style="float:left;"><span><img src="tmp/logo.gif" /></span></div>
<div style="float:left; width:70%; height:" > Admin Panel</div>

<br/>
 <hr/>--></div>
 <div style="width:100%;"> <hr/></div>
<div style="padding: 25px 0 0 250px;">


<div id="login-box">

<H2>Admin Login</H2>

<br />
	<?php 
	if(isset($_REQUEST['errmsg']))
	{
	?>
	<div class="error">
	<div class="error_inner">
	<span style=" color:#FFFF00; font-weight:bold;">Access Denied</span> | <span style=" color:#FFFF00; font-weight:bold;">User Name or Password Wrong</span>				</div>
	</div>
	<?php 
	}
	?>
	<br />
<form name="login" action="" method="post" onsubmit="return validate();">
<div id="login-box-name" style="margin-top:20px;">Username:</div><div id="login-box-field" style="margin-top:20px;"><input class="form-login" title="Username" name="username" id="username" value="" size="30" maxlength="2048" onblur="trim(this.id)" /></div>
<div id="login-box-name">Password:</div><div id="login-box-field"><input name="pass" id="pass" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" onblur="trim(this.id)" /></div>
<br />


<br />
<div align=""><input type="image" src="images/login-btn.png" style="margin-left:90px;" name="submit"  width="103" height="42" /></div>

<!--<a href="#"><img src="images/login-btn.png"  width="103" height="42" style="margin-left:90px;" /></a>-->

</form>
</div>

</div>
</body>
</html>
