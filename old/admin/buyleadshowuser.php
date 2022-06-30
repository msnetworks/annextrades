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
		header("Location:buyofferspending.php?uid=$uid");
	}
	if(isset($_REQUEST['editing']))
	{
		$buyid=$_REQUEST['buy_id'];
		mysqli_query($con,"update buyingleads set status='3' where buy_id='$buyid'");
		header("Location:buyofferspending.php?uid=$uid");
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
					<?php include("buyingleadheaduser.php");?>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="732" height="157" align="center" cellspacing="0">
						<tr class="normalbold"><td width="141" height="32">Buying Lead Details</td>
					  </tr>
						<!--<tr class="smallfont">-->
						<tr>
						<td colspan="5">
							<form name="buylead" action="" method="post">
							<table width="457" align="center">
								<tr><td height="102" colspan="3" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>
								</tr>
								<tr valign="top"><td width="154" height="32"><b>Product Name</b></td>
							    <td width="15"><b>:</b></td>
							    <td width="272"><?php echo $details['subject'];?>
							      <input type="hidden" name="buy_id" value="<?php echo $details['buy_id'];?>" /></td>
								</tr>
								<tr valign="top"><td height="63"><b>Keywords</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['keyword'];?><br />
								  <?php echo $details['keyword1'];?><br /><?php echo $details['keyword2'];?></td></tr>
								<tr valign="top"><td height="29"><b>Product Category</b></td>
								<td><b>:</b></td>
								<td><?php echo $category_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="28"><b>Product Category</b></td>
								<td><b>:</b></td>
								<td><?php echo $subcat_name['category'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>Brief Description</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['briefdes'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Additional Description</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['detdes'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>My contact preference</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['mycontact'];?></td>
								</tr>
								<tr valign="top"><td height="30"><b>Price Range</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['price']." ".$details['range1']." ".$details['range2'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>Minimum Order Quantity</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['miniquantity']." ".$details['quantity'];?></td>
								</tr>
								<tr valign="top"><td height="27"><b>Certification Requirement</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['certificate'];?></td>
								</tr>
								<tr valign="top"><td height="27"><b>Expire Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $details['expiredate'];?></td>
								</tr>
								<tr valign="top"><td height="29"><b>Status</b></td>
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