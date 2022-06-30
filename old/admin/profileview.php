<?php 
//session_start();
	ob_start();
		include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}

	$uid=$_REQUEST['uid'];
	$result=mysqli_query($con,"select * from registration where id='$uid'");
	$details=mysqli_fetch_array($result);
	$utype=$details['usertype'];
	$gender=$details['gender'];
	$country=$details['country'];
	$department=$details['department'];
	$stat=$details['memberstatus'];
	if($utype==1){$usertype="Buyer";}else if($utype==2){$usertype="Seller";}else if($utype==3){$usertype="Both Buyer and Seller";}
	if($gender==1){$genderr="Male";}else if($gender==2){$genderr="Femail";}
	if($department==1){$dept="Engineer";}else if($department==2){$dept="CEO";}
	if($stat==0){$status="Activate";}else if($stat==1){$status="Deactivate";}
	
	$country_name=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
	$num=mysqli_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function edit()
{
	window.location.href="editprofile.php?uid=<?php echo $uid;?>";
}
</script>
</head>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="membermanagement.php"><b>Members Management</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Members Management</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
			<!--<td height="29" align="left" bgcolor="#99CCFF" colspan="3">&nbsp;&nbsp;<strong>All Members</strong></td>-->
						<tr class="normalbold"><td height="25" style="padding-left:15px;"><?php echo $details['firstname'];?>'s Account Details</td>
					  </tr>
						<!--<tr class="smallfont">-->
						<td colspan="5">
							<table width="457" align="center" style="margin-top:15px;">
								<tr valign="top"><td width="149" height="30"><b>User Type</b></td>
							    <td width="19"><b>:</b></td>
							    <td width="273"><?php echo $usertype;?>
							      <input type="hidden" name="pid" value="<?php echo $details['id'];?>" /></td>
								</tr>
								<tr valign="top"><td width="149" height="30"><b>Membership Type</b></td>
							    <td width="19"><b>:</b></td>
							    <td width="273"><?php echo $details['membershiptype'];?></td>
								</tr>
								<tr valign="top"><td height="28"><b>Firstname or Username</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['firstname'];?></td></tr>
								<tr valign="top"><td height="29"><b>Last Name</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['lastname'];?></td>
								</tr>
								<tr valign="top"><td height="31"><b>Bussiness Email</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['email'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>Gender</b></td>
								<td><b>:</b></td>
								<td><?php echo $gender;?></td>
								</tr>
								<tr valign="top"><td><b>Contact Address</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['street'].", ".$details['location'].", ".$details['city']?><br />
								<?php echo $details['state'].", ".$country_name['country_name']." - ".$details['zipcode'];?></td>
								</tr>
								<tr valign="top"><td height="34"><b>Phone Number</b></td>
								<td><b>:</b></td>
								<td><?php echo "+".$details['countrycode']."-".$details['areacode']."-".$details['phonenumber'];?></td>
								</tr>
								<tr valign="top">
								  <td height="33"><b>Fax Number</b></td>
								  <td><b>:</b></td>
								<td><?php echo $details['faxnumber'];?></td>
								</tr>
								<tr valign="top"><td height="28"><b>Mobile</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['mobile'];?></td>
								</tr>
								<tr valign="top"><td height="33"><b>Company Name</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['companyname'];?></td>
								</tr>
								<!--<tr valign="top"><td>Department</td>
								<td>:</td>
								<td><?php echo $dept;?></td>
								</tr>
								<tr valign="top">
								  <td>Job Title </td>
								<td>:</td>
								<td><?php echo $details['jobtitle'];?></td>
								</tr>-->
								<tr valign="top">
								  <td height="32"><b>Joined Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['date'];?></td>
								</tr>
								<tr valign="top"><td height="31"><b>Last Access Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['last_visit_date'];?></td>
								</tr>
								<tr valign="top"><td height="35"><b>Status</b></td>
								<td><b>:</b></td>
								<td><?php echo $status;?></td>
								</tr>
								<tr><td colspan="3" align="center"><input type="submit" onclick="history.go(-1);" value="Back" />
						&nbsp;&nbsp;<input type="submit" name="Submit" value="Edit" onclick="javascript:edit();"/>
								</td>
								</tr>
						  </table>
						 </td>
						<!--</tr>-->
						<tr><td></td></tr>
				  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>