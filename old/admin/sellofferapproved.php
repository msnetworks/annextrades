<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$uid=$_REQUEST['uid'];
	$strget="";
	$rowsPerPage = '20';
	$sql="select * from tbl_seller where status='2' and user_id='$uid' ";
	$result=mysqli_query($con,getPagingQuery1($sql, $rowsPerPage,$strget));
	$pagingLink = getPagingLink1($sql, $rowsPerPage,$strget); 
	$count = mysqli_num_rows(mysqli_query($con,$sql));
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Members Management</b></a></article>
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
		<?php if(isset($_REQUEST['delete'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Buying Leads</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0" >
				<?php /*?><tr>
					<td height="137">
						<?php include("selloffersearchhead.php");?>				  </td>
				</tr><?php */?>

				<tr align="center"><td height="42" valign="bottom">
					<?php include("sell_leadheaduser.php");?>
				</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="732" height="172" align="center" cellspacing="0">
						<tr bgcolor="#E6E6E6" class="normalbold"><td width="141" height="25">Photo</td>
						<td width="172">Product Name</td>
						<td width="162">Posted By</td>
						<td width="163">Updated Date</td>
						<td width="82">Details</td>
					  </tr>
						
						<?php while($product=mysqli_fetch_array($result)){
							$image="../uploads/".$product['seller_photo'];
							$memberid=$product['user_id'];
							$name=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$memberid'"));
						?>
						<tr>
						<td colspan="5">
							<table width="734" bgcolor="#FFFFFF">
							  <tr>
							  <td width="134" height="102" ><img src="<?php echo $image;?>" width="98" height="86" /></td>
							  <td width="172" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $product['seller_subject'];?></td>
							  <td width="160" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $name['firstname']." ".$name['lastname'];?></td>
							  <td width="160" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $product['seller_updated_date'];?></td>
							  <td width="78" valign="top"><a href="sell_leadviewuser.php?sid=<?php echo $product['seller_id'];?>&uid=<?php echo $uid;?>"><img src="images/view4.png" style="width:20px; height:20px;" /></a>
							  <?php /*?><td width="78" valign="top"><a href="sell_leadviewuser.php?sid=<?php echo $product['seller_id'];?>&uid=<?php echo $uid;?>">Show</a><?php */?>
							  </td>
						 	</tr></table>
						 </td>
						</tr>
						<tr><td></td></tr>
						<?php }?>
						<?php if($count>$rowsPerPage){?>
						<tr><td colspan="5" align="center"><?php echo $pagingLink;?></td></tr>
						<?php }?>
						<?php if($count<=0){?>
						<tr>
						  <td colspan="5" align="center" class="redboldlink">No Products Found</td>
						</tr>
						<?php }?>
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