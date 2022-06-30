<?php 
session_start();
	ob_start();
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
	$s_id=$_REQUEST['sid'];
	
	$result=mysqli_query($con,"select * from orders where id='$s_id'");
    $details=mysqli_fetch_array($result);
	$user=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$details[user_id]'"));
	$product=mysqli_fetch_array(mysqli_query($con,"select * from product where id='$details[product_id]'"));
	$sell=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$product[userid]'"));
	
	
	if(isset($_REQUEST['delete']))
	{
		$sid=$_REQUEST['sid'];
		$del=mysqli_query($con,"update orders set order_status=2 where id='$sid'");
	
	if($del)
	{
	header("location:transaction.php?del");
	}
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="sellingleadpending.php"><b>Transaction Details</b></a></article>
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
		<header><h3 class="tabs_involved">Transaction Details</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
						<tr class="smallfont">
						<td colspan="5">
							<form name="product" action="" method="post">
							<table width="457" align="center">
								<!--<tr><td height="102" colspan="3" align="center">								
								<img src="<?php /*?><?php echo $image;?><?php */?>" width="98" height="86" />								
								</td>
								</tr>-->
								<tr valign="top"><td width="138" height="26" style="font-size:13px;">Order Id</td>
							    <td width="15">:</td>
							    <td width="288" style="font-size:13px;"><?php echo $details['order_id'];?></td>
								</tr>
								
								
								<tr valign="top"><td width="138" height="26" style="font-size:13px;">Transaction Id</td>
							    <td width="15">:</td>
							    <td width="288" style="font-size:13px;">
								<?php if($details['trans_id'] != "") { echo $details['trans_id']; } else { echo "Nil"; }?>
							      <input type="hidden" name="sid" value="<?php echo $details['seller_id'];?>" /></td>
								</tr>
								
								
								
								<tr valign="top"><td height="26" style="font-size:13px;">Seller Name</td>
								<td>:</td>
								<td style="font-size:13px;"><?php echo $sell['firstname'];?></td></tr>
								
								
								
								<tr valign="top"><td height="24" style="font-size:13px;">Buyer Name</td>
								<td>:</td>
								<td style="font-size:13px;"><?php echo $user['firstname'];?></td>
								</tr>
								
								
								<tr valign="top"><td height="27" style=" font-size:13px;">Product Name</td>
								<td>:</td>
								<td style="font-size:13px;"><?php echo $product['p_name'];?></td>
								</tr>
								
								
								
								<tr valign="top"><td height="26" style="font-size:13px;">Date</td>
								<td>:</td>
								<td style="font-size:13px;">
								<?php echo date("d-m-Y",strtotime($details['date']));?></td>
								</tr>
								
								
								<tr valign="top"><td height="26" style="font-size:13px;">Amount</td>
								<td>:</td>
								<td style="font-size:13px;"><?php echo $details['net_amount'];?>$</td>
								</tr>
								
								<tr valign="top">
								  <td height="25" style="font-size:13px;">Payment status</td>
								  <td>:</td>
								<td style="font-size:13px;">
								<?php  if($details['order_status'] == '1') {
								 echo "Paid";
								 }
								 else 
								 {
								 echo "Pending";
								 }
								 ?></td>
								</tr>
								
							
							
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr><td colspan="3" align="center">
								
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