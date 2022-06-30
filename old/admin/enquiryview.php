<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function trimAll(sString){
	while (sString.substring(0,1) == ' '){
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' '){
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function validatecategory()
{
	var username=document.category.categoryname.value;
	if(trimAll(username)=="")
	{
		alert("Enter Category Name");
		document.category.categoryname.value='';
		document.category.categoryname.focus();
		return false;
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="buyerenquiry.php"><b>Buyer Enquiry</b></a></article>
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
		<header><h3 class="tabs_involved">Enquiry View</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<?php
				if(isset($_REQUEST['buyer']))
				{
					$buyenid=$_REQUEST['id'];
					$buyer=mysqli_fetch_array(mysqli_query($con,"select * from buyingsend where msg_id='$buyenid'"));
					$userid=$buyer['userid'];
					$pid=$buyer['productid'];
					$reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
					$product=mysqli_fetch_array(mysqli_query($con,"select * from buyingleads where buy_id='$pid'"));
					$prouserid=$product['id'];
					$regs=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$prouserid'"));
				?>
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="buylead" action="" method="post">
							<table width="457" align="center" style="margin-top:20px;">
								
								<tr class="gbold" valign="top">
								<td width="97" height="28" style="color:#047AB6;"><b>Username</b></td>
							    <td width="17"><b>:</b></td>
							  <td width="327"><?php echo $reg['firstname'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="30" style="color:#047AB6;"><b>From Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php echo $reg['email'];?></td></tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>To Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php echo $regs['email'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Subject</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['subject'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Message</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['message'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="27" style="color:#047AB6;"><b>Enquiry Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['enterdate'];?></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								</tr>
						  </table>
						  </form>
				</td></tr>
		  </table>
		  <table>
							<tr>
								<td style="padding-left:150px;"><b>Delete</b></td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="buyerenquiry.php?delid=<?PHP echo $buyer['msg_id'];?>" class="redboldlink" onclick="return confirm('Are you sure want to delete this record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
								
								<td style="font-weight:bold; padding-left:50px;">Reply</td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="enquiryreply.php?id=<?php echo $buyer['userid'];?>" ><img src="images/reply2.jpeg" style="width:25px; height:25px;" /></a></td>
							</tr>
						</table>
		  <?php } 
		  if(isset($_REQUEST['seller']))
		  {
			$buyenid=$_REQUEST['id'];
			$buyer=mysqli_fetch_array(mysqli_query($con,"select * from messagesend where msg_id='$buyenid'"));
			$userid=$buyer['userid'];
			$pid=$buyer['productid'];
			$reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		  ?>
		  <table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="buylead" action="" method="post">
							<table width="457" align="center" style="margin-top:20px;">
								
								<tr class="gbold" valign="top"><td width="101" height="27" style="color:#047AB6;"><b>Username</b></td>
							    <td width="20"><b>:</b></td>
							  <td width="320"><?php echo $reg['firstname'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="27" style="color:#047AB6;"><b>From Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php echo $reg['email'];?></td></tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>To Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php 
								$pid=$buyer['productid'];
								$expid=explode(",", $pid);
								foreach($expid as $forid)
								{
								$product=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where seller_id='$forid'"));
								$prouserid=$product['user_id'];

								$regs=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$prouserid'"));
	
								echo $regs['email']."<br>";
								}
								?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>Subject</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['subject'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Message</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['message'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="26" style="color:#047AB6;"><b>Enquiry Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['enterdate'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Price & Terms</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['price'];?>&nbsp;&nbsp;<?php echo $buyer['payment'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>Order Quantity</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['quantity'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="30" style="color:#047AB6;"><b>Sample Terms</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['sample'];?></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
						  </table>
						  </form>
				</td></tr>
		  </table>
		  <table>
							<tr>
								<td style="padding-left:150px;"><b>Delete</b></td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="sellerenquiry.php?delid=<?PHP echo $buyer['msg_id'];?>" class="redboldlink" onclick="return confirm('Are you sure want to delete this record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
								
								<td style="font-weight:bold; padding-left:50px;">Reply</td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="enquiryreply.php?id=<?php echo $buyer['userid'];?>" ><img src="images/reply2.jpeg" style="width:25px; height:25px;" /></a></td>
							</tr>
						</table>
		  <?php } 
		  	if(isset($_REQUEST['product']))
			{
				$buyenid=$_REQUEST['id'];
				$buyer=mysqli_fetch_array(mysqli_query($con,"select * from productsend where msg_id='$buyenid'"));
				$userid=$buyer['userid'];
				$pid=$buyer['productid'];
				$reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		  ?>
		  <table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="buylead" action="" method="post">
							<table width="457" align="center" style="margin-top:20px;">
								
								<tr class="gbold" valign="top"><td width="101" height="27" style="color:#047AB6;"><b>Username</b></td>
							    <td width="20"><b>:</b></td>
							  <td width="320"><?php echo $reg['firstname'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="27" style="color:#047AB6;"><b>From Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php echo $reg['email'];?></td></tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>To Mail-Id</b></td>
								<td><b>:</b></td>
								<td><?php 
								$pid=$buyer['productid'];
								$expid=explode(",", $pid);
								foreach($expid as $forid)
								{
								$product=mysqli_fetch_array(mysqli_query($con,"select * from product where id='$forid'"));
								$prouserid=$product['userid'];
								$regs=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$prouserid'"));
								echo $regs['email']."<br>";
								}
								?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>Subject</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['subject'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Message</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['message'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="26" style="color:#047AB6;"><b>Enquiry Date</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['enterdate'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="28" style="color:#047AB6;"><b>Price & Terms</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['price'];?>&nbsp;&nbsp;<?php echo $buyer['payment'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="29" style="color:#047AB6;"><b>Order Quantity</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['quantity'];?></td>
								</tr>
								<tr class="gbold" valign="top"><td height="30" style="color:#047AB6;"><b>Sample Terms</b></td>
								<td><b>:</b></td>
								<td><?php echo $buyer['sample'];?></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
						  </table>
						  </form>
				</td></tr>
		  </table>
		  
		  <table>
							<tr>
								<td style="padding-left:150px;"><b>Delete</b></td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="productenquiry.php?delid=<?PHP echo $buyer['msg_id'];?>" class="redboldlink" onclick="return confirm('Are you sure want to delete this record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
								
								<td style="font-weight:bold; padding-left:50px;">Reply</td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="enquiryreply.php?id=<?php echo $buyer['userid'];?>" ><img src="images/reply2.jpeg" style="width:25px; height:25px;" /></a></td>
							</tr>
						</table><?php } ?>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>