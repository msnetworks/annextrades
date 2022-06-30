<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$selcontact = mysqli_fetch_object(mysqli_query($con,"select * from contact"));
	
	if(isset($_REQUEST['submit']))
	{
		$cname=$_REQUEST['cname'];
		$caddress=$_REQUEST['caddress'];
		$cemail=$_REQUEST['cemail'];
		$cphone=$_REQUEST['cphone'];
		$cmobile=$_REQUEST['cmobile'];
			
			$num_rows=mysqli_num_rows(mysqli_query($con,"select * from `contact` "));
			
			if($num_rows > 0) 
			{
			
			mysqli_query($con,"update contact set c_name='$cname',c_address='$caddress', c_email='$cemail', c_phone='$cphone',c_mobile='$cmobile' where c_id=".$_REQUEST['id']);
			
			}
			else
			{
				mysqli_query($con,"INSERT INTO `contact` (`c_name`,`c_address`,`c_email`,`c_phone`,`c_mobile`) VALUES ('$cname','$caddress','$cemail','$cphone','$cmobile') ");
			}
			header("Location:contact.php?msg=ch");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function valid()
{
  var frm=document.changepass;
	if(frm.cname.value=="")
	{
		alert("Please Enter Contact Name")
		frm.cname.focus()
		return false
	}
	
	if(frm.caddress.value=="")
	{
		alert("Please Enter Contact Address ");
		frm.caddress.focus()
		return false
	}
	
	if(frm.cemail.value=="")
	{
		alert("Please Enter Contact email");
		frm.cemail.focus()
		return false
	}
	
	//if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))if(frm.
	
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frm.cemail.value)))
	{
	alert("Please Enter Valid Contact Email");
	frm.cemail.focus()
	return false
	}
	
	
	if(frm.cphone.value=="")
	{
		alert("Please Enter COntact Number");
		frm.cphone.focus()
		return false
	}
	
	if(frm.cmobile.value=="")
	{
		alert("Please Enter Mobile Number")
		frm.cmobile.focus()
		return false
	}
}
</script>
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="contact.php"><b>Contact Us</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['suc'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Contact Us</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="changepass" action="" method="post">
					<table width="299" height="235" align="center">
						<tr>
							<td width="108" height="33" style="font-size:12px;"><b>Company Name</b></td>
						    <td width="179"><input type="text" name="cname" id="cname" value="<?php echo $selcontact->c_name; ?>" /></td>
						</tr>
						<tr>
						  <td height="49" style="font-size:12px;"><b>Address</b></td>
						  <td><textarea name="caddress" id="caddress"><?php echo $selcontact->c_address; ?></textarea></td></tr>
						<tr>
						  <td height="33" style="font-size:12px;"><b>Email</b></td>
						  <td><input type="text" name="cemail" value="<?php echo $selcontact->c_email; ?>"/></td></tr>
						  <tr>
						  <td height="34" style="font-size:12px;"><b>Phone</b></td>
						  <td><input type="text" name="cphone" value="<?php echo $selcontact->c_phone; ?>"/></td></tr>
						  <tr>
						  <td height="34" style="font-size:12px;"><b>Mobile</b></td>
						  <td><input type="text" name="cmobile" value="<?php echo $selcontact->c_mobile; ?>"/></td></tr>
						<tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit" onclick="return valid();"  /></td></tr>
					
					</table>
				  </form>
				</td></tr>
		  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>