<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$s_id=$_REQUEST['sid'];
	$uid=$_REQUEST['uid'];
	$result=mysqli_query($con,"select * from tbl_seller where seller_id='$s_id'");
	$details=mysqli_fetch_array($result);
	$image="../uploads/".$details['seller_photo'];
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
		$uid=$_REQUEST['uid'];
		mysqli_query($con,"update tbl_seller set status='2' where seller_id='$sid'");
		header("Location:sellofferspending.php?uid=$uid");
	}
	if(isset($_REQUEST['editing']))
	{
		$sid=$_REQUEST['sid'];
		$uid=$_REQUEST['uid'];
		mysqli_query($con,"update tbl_seller set status='3' where seller_id='$sid'");
		header("Location:sellofferspending.php?uid=$uid");
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
		<header><h3 class="tabs_involved">Members Management</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0" >
				<tr align="center"><td>
					<?php include("sell_leadheaduser.php");?>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="732" height="157" align="center" cellspacing="0">
						<tr class="normalbold"><td width="141" height="32">Buying Lead Details</td>
					  </tr>
						<!--<tr class="smallfont">-->
						<tr>
						<td colspan="5">
							<form name="product" action="" method="post">
							<table width="457" align="center">
								<tr><td height="102" colspan="3" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>
								</tr>
								<tr valign="top"><td width="151" height="29"><b>Selling Lead Type</b></td>
							    <td width="13"><b>:</b></td>
							    <td width="277"><?php echo $details['seller_leadtype'];?>
							      <input type="hidden" name="uid" value="<?php echo $uid;?>" /></td>
								</tr>
								<tr valign="top"><td width="151" height="27"><b>Product Name</b></td>
							    <td width="13"><b>:</b></td>
							    <td width="277"><?php echo $details['seller_subject'];?>
							      <input type="hidden" name="sid" value="<?php echo $details['seller_id'];?>" /></td>
								</tr>
								<tr valign="top"><td height="30"><b>Keywords</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_keyword'];?></td></tr>
								<tr valign="top"><td height="30"><b>Product Category</b></td>
								<td><b>:</b></td>
								<td><?php echo $category_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Product Category</b></td>
								<td><b>:</b></td>
								<td><?php echo $subcat_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Country</b></td>
								<td><b>:</b></td>
								<td><?php echo $country_name['country_name'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Brief Description</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_description'];?></td>
								</tr>
								<tr valign="top">
								  <td height="29"><b>Detailed Description</b></td>
								  <td><b>:</b></td>
								<td><?php echo $details['seller_detaildescription'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>Valid for</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_valid'];?> months</td>
								</tr>
								<tr valign="top"><td height="28"><b>Seller Company Name</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_companyname'];?></td>
								</tr>
								<tr valign="top"><td height="28"><b>Seller Bussiness Type</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_businesstype'];?></td>
								</tr>
								<tr valign="top">
								  <td height="28"><b>Seller Bussiness Range</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_businessrange'];?></td>
								</tr>
								<tr valign="top">
								  <td height="44"><b>Contact Address</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_address'].", ".$details['seller_city'];?><br />
									<?php echo $details['seller_state'].", ".$country_name['country_name'].", ".$details['seller_zip'];?>
								</td>
								</tr>
								<tr valign="top"><td height="29"><b>Updated Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_updated_date'];?></td>
								</tr>
								<tr valign="top"><td height="27"><b>Expiry Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['seller_expired_date'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Status</b></td>
								<td><b>:</b></td>
								<td><?php echo $status;?></td>
								</tr>
								<tr><td colspan="3" align="center"><input type="submit" name="Approve" value="    Approve    " />&nbsp;&nbsp;
								<input type="submit" name="editing" value="Editing Required" />&nbsp;&nbsp;
								<!--<input type="submit" onclick="history.go(-1);" value="Back" />-->
								</td></tr>
						  </table>
						  </form>
						 </td>
						</tr>
						<tr><td></td></tr>
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