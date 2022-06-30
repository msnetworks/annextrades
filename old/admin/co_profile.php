<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$uid=$_REQUEST['uid'];
	$result=mysqli_query($con,"select * from companyprofile where user_id='$uid'");
	$details=mysqli_fetch_array($result);
	
	$result_count=mysqli_num_rows($result);
	
	$com_status=$details['approval_status'];
	if($com_status==0){$status="Pending";}else if($com_status==3){$status="Editing Required";}else if($com_status==2){$status="Approved";}
	
	$country_name=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
	$num=mysqli_num_rows($result);
	
	if(isset($_REQUEST['submit']))
	{
		$id=$_REQUEST['id'];
		$uid=$_REQUEST['uid'];
		mysqli_query($con,"delete from companyprofile where id='$id' and user_id='$uid'");
		header("Location:membermanagement.php");
	}
	if(isset($_REQUEST['approve']))
	{
		$id=$_REQUEST['id'];
		$uid=$_REQUEST['uid'];
		mysqli_query($con,"update companyprofile set approval_status='2' where id='$id' and user_id='$uid'");
		header("Location:membermanagement.php");
	}
	if(isset($_REQUEST['editrequired']))
	{
		$id=$_REQUEST['id'];
		$uid=$_REQUEST['uid'];
		mysqli_query($con,"update companyprofile set approval_status='3' where id='$id' and user_id='$uid'");
		header("Location:membermanagement.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
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
		<header><h3 class="tabs_involved">Company Profile</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
						<?php 
						if($result_count>0)
						{
						?>
						<tr class="smallfont">
						<td colspan="5">
							<form name="profile" method="post" action="">
							<table width="457" align="center">
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr valign="top"><td width="175">Company Name</td>
							    <td width="3">:</td>
							    <td width="263"><?php echo ucfirst($details['companyname']);?><input type="hidden" name="cid" value="<?php echo $details['id'];?>" /></td>
								</tr>
								<tr valign="top"><td width="175">Company Logo</td>
							    <td width="3">:</td>
							    <td width="263">
								<?php
								$imgpath="../logo/".$details['companylogo'];
								if(file_exists($imgpath) && $details['companylogo']!='')
								{
								?>
								<img src="<?php echo $imgpath; ?>" border="0" width="98" height="86" />
								<?php
								}
								else
								{
								?>
								<img src="../blog_photo_thumbnail/img_noimg.jpg" width="98" height="86" />
								<?php
								}
								?></td>
								</tr>
								<tr valign="top"><td width="175">Bussiness Type</td>
							    <td width="3">:</td>
							    <td width="263"><?php echo ucwords($details['bussiness_type']);?></td>
								</tr>
								<tr valign="top"><td>Product Service</td>
								<td>:</td>
								<td><?php echo ucwords($details['P_service']);?></td></tr>
								<tr valign="top"><td>Company address</td>
								<td>:</td>
								<td><?php echo ucwords($details['company_address']);?></td>
								</tr>
								
								<tr valign="top"><td>Brand(s)</td>
								<td>:</td>
								<td><?php echo ucwords($details['brand']);?></td>
								</tr>
								<tr valign="top"><td>No. of Employees</td>
								<td>:</td>
								<td><?php echo $details['noofemployee'];?></td>
								</tr>
								<tr valign="top"><td>Url</td>
								<td>:</td>
								<td><?php echo $details['url'];?></td>
								</tr>
								<tr valign="top"><td>Detailed Company Introduction</td>
								<td>:</td>
								<td><?php echo $details['company_details'];?></td>
								</tr>
								<tr><td>Ownership & Capital</td></tr>
								<tr valign="top">
								  <td>Year of Established</td>
								  <td>:</td>
								<td><?php echo $details['year'];?></td>
								</tr>
								<tr valign="top"><td>Legal Representative / Bussiness Owner</td>
								<td>:</td>
								<td><?php echo $details['bussinessowner'];?></td>
								</tr>
								<tr valign="top"><td>Registered Capital</td>
								<td>:</td>
								<td><?php echo $details['registeredcapital'];?></td>
								</tr>
								<tr valign="top"><td>Ownership Type</td>
								<td>:</td>
								<td><?php echo $details['ownertype'];?></td>
								</tr>
								<tr><td>Trade & Market</td></tr>
								<tr valign="top">
								  <td>Main Markets</td>
								<td>:</td>
								<td><?php echo $details['mainmarkets'];?></td>
								</tr>
								<tr valign="top">
								  <td>Main Customer(s)</td>
								<td>:</td>
								<td><?php echo $details['maincustomer'];?></td>
								</tr>
								<tr valign="top"><td>Total Annual Sales Volume</td>
								<td>:</td>
								<td><?php echo $details['toannualsalesvolume'];?></td>
								</tr>
								<tr valign="top"><td>Export Percentage</td>
								<td>:</td>
								<td><?php echo $details['exportpercentage'];?></td>
								</tr>
								<tr valign="top"><td>Total Annual Purchase Volume</td>
								<td>:</td>
								<td><?php echo $details['toannualpurchasevolume'];?></td>
								</tr>
								<tr><td>Factory Information</td></tr>
								<tr valign="top"><td>Factory Size</td>
								<td>:</td>
								<td><?php echo $details['factorysize'];?></td>
								</tr>
								<tr valign="top"><td>Factory Location</td>
								<td>:</td>
								<td><?php echo $details['factorylocation'];?></td>
								</tr>
								<tr valign="top"><td>QA/QC</td>
								<td>:</td>
								<td><?php echo $details['qa/qc'];?></td>
								</tr>
								<tr valign="top"><td>No. of Production Lines</td>
								<td>:</td>
								<td><?php echo $details['noofprodlines'];?></td>
								</tr>
								<tr valign="top"><td>No. of R&D Staff</td>
								<td>:</td>
								<td><?php echo $details['noofr&dstaff'];?></td>
								</tr>
								<tr valign="top"><td>No. of QC Staff</td>
								<td>:</td>
								<td><?php echo $details['noofqcstaff'];?></td>
								</tr>
								<tr valign="top"><td>Management Certification</td>
								<td>:</td>
								<td><?php echo $details['mgmtcertification'];?></td>
								</tr>
								<tr valign="top"><td>Contact Manufacturing</td>
								<td>:</td>
								<td><?php echo $details['contactmant'];?><input type="hidden" name="id" value="<?php echo $details['id'];?>" />
								<input type="hidden" name="uid" value="<?php echo $uid;?>" />
								</td>
								</tr>
								<tr><td>Status</td><td>:</td><td><?php echo $status;?></td></tr>
								<tr><td colspan="3" align="center">
								<!--<input type="button" onclick="history.go(-1);" value="Back" />-->
									<input type="submit" value="Delete" name="submit" /> 
									<?php if($com_status!=2){?><input type="submit" value="Approve" name="approve" /> <input type="submit" value="Editing Required" name="editrequired" /><?php }?>
								</td></tr>
						  </table></form>
						 </td>
						</tr>
						<?php 
						}
						else
						{
						?>
						<tr>
						<td align="center" height="50">
						Company profile not yet updated
						</td>
						</tr>
						<?php
						}
						?>
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