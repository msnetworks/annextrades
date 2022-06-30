<?php 
session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$s_id=$_REQUEST['sid'];
	$result=mysqli_query($con,"select * from tbl_seller where seller_id='$s_id'");
	$details=mysqli_fetch_array($result);
	$imgpath = "../uploads/".$details['seller_photo'];	
	if(($details['seller_photo'] != '') && (file_exists($imgpath)))
	{
	 $image="../uploads/".$details['seller_photo'];
	}else{
	 $image="../uploads/img_noimg.jpg";
	}
	$product_category=$details['seller_category'];
	$subcategory=$details['seller_subcategory'];
	$country=$details['seller_country'];
	$stat=$details['status'];
	if($stat==0){$status="Expired";}else if($stat==1){$status="Pending";}else if($stat==2){$status="Approved";}else if($stat==3){$status="Editing Required";}
	
	$category_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$product_category'"));
	$subcat_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcategory'"));
	$country_name=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
	$num=mysqli_num_rows($result);
	
	if(isset($_REQUEST['Approve']))
	{
		$sid=$_REQUEST['sid'];
		mysqli_query($con,"update tbl_seller set status='2' where seller_id='$sid'");
		header("Location:sellingleadpending.php");
	}
	if(isset($_REQUEST['Disapprove']))
	{
		$sid=$_REQUEST['sid'];
		mysqli_query($con,"update tbl_seller set status='1' where seller_id='$sid'");
		header("Location:sellingleadpending.php");
	}
	if(isset($_REQUEST['editing']))
	{
		$sid=$_REQUEST['sid'];
		mysqli_query($con,"update tbl_seller set status='3' where seller_id='$sid'");
		header("Location:sellingleadpending.php");
	}
	if(isset($_REQUEST['delete']))
	{
		$sid=$_REQUEST['sid'];
		mysqli_query($con,"DELETE FROM `tbl_seller` WHERE `seller_id`='$sid'");
		header("Location:buyleadpending.php");
	}
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="sellingleadpending.php"><b>Selling Leads</b></a></article>
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
		<header><h3 class="tabs_involved">Selling Lead Details</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
						<tr class="smallfont">
						<td colspan="5">
							<form name="product" action="" method="post">
							<table width="457" align="center">
								<tr><td height="102" colspan="3" align="center">								
								<img src="<?php echo $image;?>" width="98" height="86" />								
								</td>
								</tr>
								<tr valign="top"><td width="138" height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Selling Lead Type</td>
							    <td width="15">:</td>
							    <td width="288" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo ucwords($details['seller_leadtype']);?></td>
								</tr>
								<tr valign="top"><td width="138" height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Name</td>
							    <td width="15">:</td>
							    <td width="288" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_subject'];?>
							      <input type="hidden" name="sid" value="<?php echo $details['seller_id'];?>" /></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Keywords</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_keyword'];?></td></tr>
								<tr valign="top"><td height="24" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Category</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $category_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="27" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Category</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $subcat_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Country</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $country_name['country_name'];?></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Brief Description</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_description'];?></td>
								</tr>
								<tr valign="top">
								  <td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Detailed Description</td>
								  <td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_detaildescription'];?></td>
								</tr>
								<tr valign="top"><td height="27" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Valid for</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_valid'];?> months</td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Seller Company Name</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_companyname'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Seller Bussiness Type</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_businesstype'];?></td>
								</tr>
								<tr valign="top">
								  <td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Seller Bussiness Range</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_businessrange'];?></td>
								</tr>
								<tr valign="top">
								  <td height="42" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Contact Address</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_address'].", ".$details['seller_city'];?><br />
									<?php echo $details['seller_state'].", ".$country_name['country_name'].", ".$details['seller_zip'];?>
								</td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Updated Date</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_updated_date'];?></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Expiry Date</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['seller_expired_date'];?></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Posted IP Address</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['post_ip'];?></td>
								</tr>
								<tr valign="top"><td height="27" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Status</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $status;?></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr><td colspan="3" align="center">
								<?php
								if($details['status']=='1')
								{
								?>
								<input type="submit" name="Approve" value="Approve" onclick="return confirm('Are you sure you wish to Approve this Record?');"/>
								<?php
								}
								else
								{
								?>
								<input type="submit" name="Disapprove" value="Dispprove" onclick="return confirm('Are you sure you wish to Disapprove this Record?');"/>
								&nbsp;&nbsp;
								<?php
								if($details['status']!='3')
								{
								?>
								<input type="submit" name="editing" value="Editing Required" onclick="return confirm('Are you sure you wish to Editing Required this Record?');"/>
								<?php
								}
								else{}
								}
								?>
								&nbsp;&nbsp;<input type="submit" name="delete" onclick="return confirm('Are you sure you wish to Delete this Record?');" value="Delete" />
								&nbsp;&nbsp;<!--<input type="button" onclick="javascript:history.back();" value="Back" />-->
								</td></tr>
						  </table>
						  </form>
						 </td>
						</tr>
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