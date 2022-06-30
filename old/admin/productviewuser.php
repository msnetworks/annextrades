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
	$p_id=$_REQUEST['pid'];
	$result=mysqli_query($con,"select * from product where id='$p_id'");
	$details=mysqli_fetch_array($result);
	$image="../productlogo/".$details['p_photo'];
	$product_category=$details['p_category'];
	$subcategory=$details['p_subcategory'];
	$country=$details['country'];
	$stat=$details['status'];
	if($stat==0){$status="Expired";}else if($stat==1){$status="Pending";}else if($stat==2){$status="Approved";}else if($stat==3){$status="Editing Required";}
	
	$category_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$product_category'"));
	$subcat_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcategory'"));
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
		<header><h3 class="tabs_involved">Members Management</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0" >
				<tr align="center"><td>
					<?php include("productheaduser.php");?>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="457" align="center">
								<tr><td height="102" colspan="3" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>
								</tr>
								<tr valign="top"><td width="154" height="29">Product Name</td>
							    <td width="12">:</td>
							    <td width="275"><?php echo $details['p_name'];?>
							      <input type="hidden" name="pid" value="<?php echo $details['id'];?>" /></td>
								</tr>
								<tr valign="top"><td height="29">Keywords</td>
								<td>:</td>
								<td><?php echo $details['p_keyword'];?></td></tr>
								<tr valign="top"><td height="27">Product Category</td>
								<td>:</td>
								<td><?php echo $category_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="25">Product Category</td>
								<td>:</td>
								<td><?php echo $subcat_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="27">Country</td>
								<td>:</td>
								<td><?php echo $country_name['country_name'];?></td>
								</tr>
								<tr valign="top"><td height="27">Brief Description</td>
								<td>:</td>
								<td><?php echo $details['p_bdes'];?></td>
								</tr>
								<tr valign="top">
								  <td height="28">Detailed Description</td>
								  <td>:</td>
								<td><?php echo $details['p_ddes'];?></td>
								</tr>
								<tr valign="top"><td height="29">Price Range</td>
								<td>:</td>
								<td><?php echo $details['p_price']." ".$details['range1']." ".$details['range2'];?></td>
								</tr>
								<tr valign="top"><td height="29">Payment Terms</td>
								<td>:</td>
								<td><?php echo $details['paymenttype']." ".$details['range1']." ".$details['range2'];?></td>
								</tr>
								<tr valign="top"><td height="30">Minimum Order Quantity</td>
								<td>:</td>
								<td><?php echo $details['p_min_quanity']." ".$details['p_quanity_type'];?></td>
								</tr>
								<tr valign="top">
								  <td height="28">Production Capacity </td>
								<td>:</td>
								<td><?php echo $details['p_capaacity']." ".$details['p_ctype']." per ".$details['percapacity'];?></td>
								</tr>
								<tr valign="top">
								  <td height="30">Delivery Time </td>
								<td>:</td>
								<td><?php echo $details['p_delivertytime'];?></td>
								</tr>
								<tr valign="top"><td height="29">Packaging Details</td>
								<td>:</td>
								<td><?php echo $details['p_packingdetails'];?></td>
								</tr>
								<tr valign="top"><td height="28">Expiry Date</td>
								<td>:</td>
								<td><?php echo $details['expiredate'];?></td>
								</tr>
								<tr valign="top"><td height="30">Status</td>
								<td>:</td>
								<td><?php echo $status;?></td>
								</tr>
								<tr><td colspan="3" align="center"><input type="submit" onclick="history.go(-1);" value="Back" />
								</td></tr>
						  </table>
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