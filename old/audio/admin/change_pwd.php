<?php 
include "includes/header.php";
include "../includes/functions.php";
include("../db-connect/notfound.php");

if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
$sel_admin = mysqli_fetch_array(mysqli_query($con,"select * from adminlogin"));
$sel_general = mysqli_fetch_array(mysqli_query($con,"select * from generalsettings"));
if(isset($_REQUEST['update']))
{
				$userid = $_REQUEST['uid'];
				$uname    = $_REQUEST['uname'];
				$cpass    = $_REQUEST['cpass'];
				$newpass  = $_REQUEST['newpass'];
				$newcpass = $_REQUEST['newcpass'];
				
				//echo "select * from adminlogin where password='$cpass'"; exit;
				
				$sel_pass = mysqli_num_rows(mysqli_query($con,"select * from adminlogin where password='$cpass'"));
				
				/*if($sel_pass==0)
				{
				header("location:change_pass.php?error");
				//exit;			
				}*/
				
				if($sel_pass==0) { ?><script>
				window.location="change_pwd.php?error";
				</script><?php }
				
				else if($newpass!=$newcpass)
				{
				header("location:change_pwd.php?err");			
				}
				/*else
				{				
				mysqli_query($con,"UPDATE adminlogin SET userid='$uname',password='$newcpass' WHERE id = '3'");
				header("location:change_pass.php?succ");			
				}*/
				
				else { 
				mysqli_query($con,"UPDATE adminlogin SET userid='$uname',password='$newcpass' WHERE id = '3'");
				?><script>
				window.location="change_pwd.php?succ";
				</script><?php } 
				
}

?>
<script type="text/javascript">
function validate()
{
	if(document.form.uname.value=='')
	{
	alert('Please enter the username');
	document.form.uname.focus();
	return false;
	}
	if(document.form.cpass.value=='')
	{
	alert('Please Enter The Current Password');
	document.form.cpass.focus();
	return false;
	}	
	if(document.form.newpass.value=='')
	{
	alert('Please Enter The New Password');
	document.form.newpass.focus();
	return false;
	}
	if(document.form.newcpass.value=='')
	{
	alert('Please Enter The Confirm Password');
	document.form.newcpass.focus();
	return false;
	}
	if(document.form.newpass.value!=document.form.newcpass.value)
	{
	alert('Please enter correct password');
	document.form.newcpass.focus();
	return false;
	}
	
}
</script>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title"><!--dashboard--></h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Password Change</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
			<section id="main" class="column">	
			<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Password Changed Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['error'])) { ?>
		<h4 class="alert_success">Enter Correct Current Password</h4>
		<?php } ?>
				
				<div class="module width_3_quarter" style="width:95%;">
		<header><h3 class="tabs_involved"> Password Change  </h3>
		
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content" style="width:800px;">
			<form name="form" action="" method="post" onsubmit="return validate();">
				<input type="hidden" name="uid" value="<?php echo $u_id ?>" />
					<div class="de_lft" style="height:35px;">Username </div><div class="de_lft" style="width:400px;">: 
					
			<input type="text" name="uname" value="<?php echo $sel_admin['userid']; ?>" />
					
					</div>
					<div style="clear:both;"></div>
					<div class="de_lft" style="height:35px;">Current Password </div><div class="de_lft">: 
					
			<input type="password" name="cpass"  />
					
					</div>
					<div style="clear:both;"></div>
						<div class="de_lft" style="height:35px;">New Password </div><div class="de_lft">: 
			<input type="password" name="newpass"  />
					</div>
					<div style="clear:both;"></div>
					
					<div style="clear:both;"></div>
						<div class="de_lft" style="height:35px;">Confirm Password </div><div class="de_lft">: 
			<input type="password" name="newcpass" />
					</div>
					<div style="clear:both;"></div>
				
					
			<div class="de_lft" style="height:35px;"></div><div class="de_lft">
			&nbsp;
			<input type="submit" value="Update" name="update" class="alt_btn">
					</div>
		</form>
			</div>
			
		
			
		</div>
		
		</div>
		  </div>
		</div>
		<div class="de_lft">&nbsp;</div>
		
</section>

</body>

</html>