<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$p_id=$_REQUEST['viewid'];
	$result=mysqli_query($con,"select * from featureproducts where id='$p_id'");
	$details=mysqli_fetch_array($result);
	$imgpath = "picture/".$details['f_pdt_images'];
	if(($details['f_pdt_images'] != '') && (file_exists($imgpath)))
	{
	$image="picture/".$details['f_pdt_images'];
	} else {
	$image = "../images/img_noimg.jpg";
	}
	$product_category=$details['p_category'];
	$subcategory=$details['p_subcategory'];
	$country=$details['country'];
	$stat=$details['status'];
	
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
<script type="text/javascript">
function active()
{
alert("Are you sure you wish to Active this Record?");
window.location.href="companyview.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>&act=active";
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="featureproductss.php"><b>Featured Products</b></a></article>
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
		<header><h3 class="tabs_involved">Feature Product View</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="358" valign="top">
					<table width="732" height="157" align="center" cellspacing="0">
						<tr class="smallfont">
						<td colspan="5">
							<form name="product" action="" method="post">
							<table width="457" class="gbold" align="center">
								<tr>
									<td height="109" colspan="3" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>
								</tr>
								<tr valign="top">
									<td width="35%" height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Name</td>
							    <td width="4%">:</td>
							    <td width="61%" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['f_pdt_name'];?>
							      <input type="hidden" name="pid" value="<?php echo $details['id'];?>" /></td>
								</tr>
								<tr valign="top">
								  <td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Company Name </td>
								  <td>:</td>
								  <td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['companyname'];?></td>
							  </tr>
								<tr valign="top">
								  <td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Company Email </td>
								  <td>:</td>
								  <td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['companyemail'];?></td>
							  </tr>
								<tr valign="top">
								  <td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Company Established On </td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['company_start'];?></td></tr>
								<tr valign="top">
								  <td height="24" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Country</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $country_name['country_name'];?></td>
								</tr>
								<tr valign="top"><td height="23" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Address</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['address'];?></td>
								</tr>
								<tr valign="top"><td height="25" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Price</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['price']." ".$details['range1']." ~ ".$details['range2'];?></td>
								</tr>
								<tr valign="top"><td height="24" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Payment Terms</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['payment_terms'];?></td>
								</tr>
								<tr valign="top">
								  <td height="24" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Minimum Order Quantity</td>
								  <td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['minimum_quantity'];?></td>
								</tr>
								<tr valign="top"><td height="27" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Quantity</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['pdt_quantity'];?></td>
								</tr>
								<tr valign="top"><td height="24" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Capacity</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['pdt_capacity'];?></td>
								</tr>
								<tr valign="top"><td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Minimum Order Quantity</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['deliverytime'];?></td>
								</tr>
								<tr valign="top">
								  <td height="26" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Production Capacity </td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['capacity'];?></td>
								</tr>
								
								<tr valign="top"><td height="28" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Packaging Details</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['pakage_details'];?></td>
								</tr>
								<tr valign="top"><td height="28" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Expiry Date</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $details['f_pdt_exp_date'];?></td>
								</tr>
								<!--<tr><td colspan="3" align="center" height="40"><input type="button" name="back" value="Back" onclick="javascript:history.back();"/></td></tr>-->
						  </table>
						  </form>						 </td>
						</tr>
						<tr><td width="141"></td></tr>
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