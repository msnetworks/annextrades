<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$buy_id=$_REQUEST['bid'];
	$result=mysqli_query($con,"select * from buyingleads where buy_id='$buy_id'");
	$details=mysqli_fetch_array($result);
	$image="../".$details['photo'];
	$product_category=$details['category'];
	$subcategory=$details['subcategory'];
	$stat=$details['status'];
	if($stat==0){$status="Expired";}else if($stat==1){$status="Pending";}else if($stat==2){$status="Approved";}else if($stat==3){$status="Editing Required";}
	
	$category_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$product_category'"));
	$subcat_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcategory'"));
	$num=mysqli_num_rows($result);
	
	if(isset($_REQUEST['Approve']))
	{
		$buyid=$_REQUEST['buy_id'];
		mysqli_query($con,"update buyingleads set status='2' where buy_id='$buyid'");
		//mail sending
		$details=mysqli_fetch_array(mysqli_query($con,"select * from buyingleads where buy_id='$buyid'"));
		$userid=$details['id'];
		$userdetails=mysqli_fetch_array(mysqli_query($con,"select email, firstname from registration where id='$userid'"));
		
		$tomail=$userdetails['email'];
		$subject="Approval confirmation for product.....";
		$message="Hi ".$userdetails['firstname'].",<br><br>
		
					You posted a product ".$details['subject']." with us.  Admin approved this product to show our site.<br>
					Visit our site. Thank you for using our service.<br>
					
					Thanks & Regards<br>
					$webname Team.";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		
		$headers .= "From: $mailurl " . "\r\n";
		//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		
		// Mail it
		
		mail($tomail,$subject,$message,$headers);
		
		header("Location:buyleadpending.php");
	}
	
	if(isset($_REQUEST['Disapprove']))
	{
		$buyid=$_REQUEST['buy_id'];
		mysqli_query($con,"update buyingleads set status='1' where buy_id='$buyid'");
		//mail sending
		$details=mysqli_fetch_array(mysqli_query($con,"select * from buyingleads where buy_id='$buyid'"));
		$userid=$details['id'];
		$userdetails=mysqli_fetch_array(mysqli_query($con,"select email, firstname from registration where id='$userid'"));
		
		$tomail=$userdetails['email'];
		$subject="Dis Approval confirmation for product.....";
		$message="Hi ".$userdetails['firstname'].",<br><br>
		
					Your posted a product ".$details['subject']." with us some problem this product.  Admin Dis approved this product to show our site.<br>
					and try next up your new product Visit our site. Thank you for using our service.<br>
					
					Thanks & Regards<br>
					$webname Team.";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		
		$headers .= "From: $mailurl " . "\r\n";
		//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		
		// Mail it
		
		mail($tomail,$subject,$message,$headers);
		
		header("Location:buyleadpending.php");
	}
	
	if(isset($_REQUEST['editing']))
	{
		$buyid=$_REQUEST['buy_id'];
		mysqli_query($con,"update buyingleads set status='3' where buy_id='$buyid'");
		header("Location:buyleadpending.php");
	}
	if(isset($_REQUEST['delete']))
	{
		$buyid=$_REQUEST['buy_id'];
		mysqli_query($con,"DELETE FROM `buyingleads` WHERE `buy_id`='$buyid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="buyleadpending.php"><b>Buying Leads</b></a></article>
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
		<header><h3 class="tabs_involved">Buying Lead Details</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
						<tr class="smallfont">
						<td colspan="5">
							<form name="buylead" action="" method="post">
							<table width="457" align="center">
								<tr><td height="102" colspan="3" align="center">
								<?php
								 
								 $imgpath = "../blog_photo_thumbnail/".$details['photo'];
								 
								 if(file_exists($imgpath) && $details['photo'] != '' )
								 {
								 
								 ?>
								 <img src="<?php echo "../blog_photo_thumbnail/".$details['photo'];?>" width="98" height="86" />
								 <?php
								 }
								 else
								 {
								 ?>
								 <img src="../blog_photo_thumbnail/img_noimg.jpg" width="98" height="86" />
								 <?php
								 }?>
								</td>
								</tr>
								<tr valign="top"><td width="150" height="23" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Name</td>
							    <td width="13">:</td>
							    <td width="278" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['subject'];?>
							      <input type="hidden" name="buy_id" value="<?php echo $details['buy_id'];?>" /></td>
								</tr>
								<tr valign="top"><td height="62" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Keywords</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['keyword'];?><br />
								  <?php echo $details['keyword1'];?><br /><?php echo $details['keyword2'];?></td></tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Category</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $category_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Category</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $subcat_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Brief Description</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['briefdes']; ?></td>
								<?php /*?><td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['briefdes'];?></td><?php */?>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Additional Description</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['detdes'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">My contact preference</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['mycontact'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Price Range</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['price']." ".$details['range1']." ".$details['range2'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Minimum Order Quantity</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['miniquantity']." ".$details['quantity'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Certification Requirement</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['certificate'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Expire Date</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['expiredate'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Posted IP Address</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['post_ip'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Status</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $status;?></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td colspan="3" align="center">
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
								<input type="submit" name="Disapprove" value="Disapprove" onclick="return confirm('Are you sure you wish to Disapprove this Record?');"/>
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
						
				  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>