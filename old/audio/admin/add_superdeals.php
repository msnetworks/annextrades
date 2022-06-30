<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['editid']))
	{
	$fetch=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM super_deals WHERE sd_id='".$_GET['editid']."'"));
	}
	
    if(isset($_POST['submit']))
	{
	$product_name=trim($_POST['product_name']);
	$product_name1=mysqli_real_escape_string($con, $_POST['product_name1']);
	$product_name2=mysqli_real_escape_string($con, $_POST['product_name2']);
	$product_name3=mysqli_real_escape_string($con, $_POST['product_name3']);
	$orginal_rate=trim($_POST['orginal_rate']);	
	$current_rate=trim($_POST['current_rate']);	
	$min_order=trim($_POST['min_order']);	
	$description=trim($_POST['description']);
	$description1=mysqli_real_escape_string($con, $_POST['description1']);
	$description2=mysqli_real_escape_string($con, $_POST['description2']);
	$description3=mysqli_real_escape_string($con, $_POST['description3']);
	$product_image=$_FILES['product_image']['name'];
	$tmp=$_FILES['product_image']['tmp_name'];
	$dir="superdeals_images/".time().$product_image;
	move_uploaded_file($tmp,$dir);
	
	mysqli_query($con,"INSERT INTO `super_deals` SET `product_name`='$product_name',`product_name_french`='$product_name1',`product_name_chinese`='$product_name2',`product_name_spanish`='$product_name3',`orginal_rate`='$orginal_rate',`current_rate`='$current_rate',`minimum_order`='$min_order',description='$description',description_french='$description1',description_chinese='$description2',description_spanish='$description3',image='$dir'");
		header("Location:admin_superdeals.php?added");
	}
 
   if(isset($_POST['update']))
	{
	$product_name=trim($_POST['product_name']);
	$product_name1=mysqli_real_escape_string($con, $_POST['product_name1']);
	$product_name2=mysqli_real_escape_string($con, $_POST['product_name2']);
	$product_name3=mysqli_real_escape_string($con, $_POST['product_name3']);
	$orginal_rate=trim($_POST['orginal_rate']);	
	$current_rate=trim($_POST['current_rate']);	
	$min_order=trim($_POST['min_order']);	
	$description=trim($_POST['description']);
	$description1=mysqli_real_escape_string($con, $_POST['description1']);
	$description2=mysqli_real_escape_string($con, $_POST['description2']);
	$description3=mysqli_real_escape_string($con, $_POST['description3']);
	$product_image=$_FILES['product_image']['name'];
	$tmp=$_FILES['product_image']['tmp_name'];
	$dir="superdeals_images/".time().$product_image;
	move_uploaded_file($tmp,$dir);
	
	if($product_image!=""){
	mysqli_query($con,"UPDATE `super_deals` SET `product_name`='$product_name',`product_name_french`='$product_name1',`product_name_chinese`='$product_name2',`product_name_spanish`='$product_name3',`orginal_rate`='$orginal_rate',`current_rate`='$current_rate',`minimum_order`='$min_order',description='$description',description_french='$description1',description_chinese='$description2',description_spanish='$description3',image='$dir' WHERE sd_id='".$_GET['editid']."' ");
	}
	else
	{
mysqli_query($con,"UPDATE `super_deals` SET `product_name`='$product_name',`product_name_french`='$product_name1',`product_name_chinese`='$product_name2',`product_name_spanish`='$product_name3',`orginal_rate`='$orginal_rate',`current_rate`='$current_rate',`minimum_order`='$min_order',description='$description',description_french='$description1',description_chinese='$description2',description_spanish='$description3' WHERE sd_id='".$_GET['editid']."' ");
	}
	header("Location:admin_superdeals.php?edited");
	}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validation()
{
var frm=document.frm_superdeals;
if(frm.product_name.value=="")
{
alert('Please Enter The Product Name');
frm.product_name.focus();
return false
}
var frm=document.frm_superdeals;
if(frm.product_name1.value=="")
{
alert('Please Enter The Product Name');
frm.product_name1.focus();
return false
}
var frm=document.frm_superdeals;
if(frm.product_name2.value=="")
{
alert('Please Enter The Product Name');
frm.product_name2.focus();
return false
}
if(frm.orginal_rate.value=="")
{
alert('Please Enter The orginal rate');
frm.orginal_rate.focus();
return false
}
if(frm.current_rate.value=="")
{
alert('Please Enter The current rate');
frm.current_rate.focus();
return false
}
if(frm.min_order.value=="")
{
alert('Please Enter The Minimun Orders');
frm.min_order.focus();
return false
}
if(frm.description.value=="")
{
alert('Please Enter The description');
frm.description.focus();
return false
}
if(frm.description1.value=="")
{
alert('Please Enter The description');
frm.description1.focus();
return false
}
if(frm.description2.value=="")
{
alert('Please Enter The description');
frm.description2.focus();
return false
}
/*if(frm.product_image.value=="")
{
alert('Please Enter Your Product Image');
frm.product_image.focus();
return false
}
else
{
		var where_is_mytool=document.getElementById('product_image').value;
		var total_len = where_is_mytool.length;
		var dot_pod=where_is_mytool.lastIndexOf(".");
		var ext=where_is_mytool.substr(dot_pod+1,total_len-dot_pod+1);
		var extlower=ext.toLowerCase();
		if((ext!='jpeg')&&(ext!='bmp')&&(ext!='jpg')&&(ext!='gif')&&(ext!='png'))
		{
		alert('Accepts only Image Files');
		frm.product_image.focus();
		return false;
		}
}
return true;*/
}
function updatevalidation()
{
var frm_add=document.frm_superdeals_update;

if(frm_add.product_name.value=="")
{
alert('Please Enter The Product Name');
frm_add.product_name.focus();
return false
}
if(frm_add.product_name1.value=="")
{
alert('Please Enter The Product Name');
frm_add.product_name1.focus();
return false
}

if(frm_add.product_name2.value=="")
{
alert('Please Enter The Product Name');
frm_add.product_name2.focus();
return false
}
if(frm_add.orginal_rate.value=="")
{
alert('Please Enter The orginal rate');
frm_add.orginal_rate.focus();
return false
}
if(frm_add.current_rate.value=="")
{
alert('Please Enter The current rate');
frm_add.current_rate.focus();
return false
}
if(frm_add.min_order.value=="")
{
alert('Please Enter The Minimun Orders');
frm_add.min_order.focus();
return false
}
if(frm_add.description.value=="")
{
alert('Please Enter The description');
frm_add.description.focus();
return false
}
if(frm_add.description1.value=="")
{
alert('Please Enter The description');
frm_add.description1.focus();
return false
}
if(frm_add.description2.value=="")
{
alert('Please Enter The description');
frm_add.description2.focus();
return false
}
if(frm_add.product_image.value != "")
{
		var where_is_mytool=document.getElementById('product_image').value;
		var total_len = where_is_mytool.length;
		var dot_pod=where_is_mytool.lastIndexOf(".");
		var ext=where_is_mytool.substr(dot_pod+1,total_len-dot_pod+1);
		var extlower=ext.toLowerCase();
		if((ext!='jpeg')&&(ext!='bmp')&&(ext!='jpg')&&(ext!='gif')&&(ext!='png'))
		{
		alert('Accepts only Image Files');
		frm_add.product_image.focus();
		return false;
		}
}

return true;

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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="admin_superdeals.php"><b>Super Deals</b></a></article>
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
		<header><h3 class="tabs_involved">Super Deals</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="99%"  cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
			<?php if(isset($_REQUEST['editid'])) { ?><form action="" method="post" name="frm_superdeals_update" enctype="multipart/form-data" onsubmit="return updatevalidation();"><table width="100%" height="133" cellpadding="3" cellspacing="0">
                <!--  <tr>
                <td colspan="7" class="sellerviewheading">Manage Selling Leads </td>
              </tr>-->
                <tr>
                  <td><!-- Table Begins-->
                      <table width="105%" border="0" cellpadding="3" cellspacing="0">
					  <tr><td colspan="4"></td></tr>
                        <tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name" type="text" value="<?php echo $fetch['product_name']; ?>" /></td>
                        </tr>
						 <tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name1" type="text" value="<?php echo $fetch['product_name_french']; ?>" /></td>
                        </tr>
						<?php /*?> <tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name2" type="text" value="<?php echo $fetch['product_name_chinese']; ?>" /></td>
                        </tr><?php */?>
						<tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name3" type="text" value="<?php echo $fetch['product_name_spanish']; ?>" /></td>
                        </tr>
						 <tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Orginal Rate</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="orginal_rate" type="text" value="<?php echo $fetch['orginal_rate']; ?>" /></td>
                        </tr>
						 <tr>
                          <td width="29%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Current Rate</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="current_rate" type="text" value="<?php echo $fetch['current_rate']; ?>" /></td>
                        </tr>
						 <tr>
                          <td width="29%" height="34" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Minimum Order</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="min_order" type="text" value="<?php echo $fetch['minimum_order']; ?>" /></td>
                        </tr>
						 <tr>
                          <td width="29%" height="49" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description"><?php echo $fetch['description']; ?></textarea>
                           </label></td>
                        </tr>
						<tr>
                          <td width="29%" height="49" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description1"><?php echo $fetch['description_french']; ?></textarea>
                           </label></td>
                        </tr>
					<?php /*?>	<tr>
                          <td width="29%" height="49" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description2"><?php echo $fetch['description_chinese']; ?></textarea>
                           </label></td>
                        </tr><?php */?>
						<tr>
                          <td width="29%" height="49" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description3"><?php echo $fetch['description_spanish']; ?></textarea>
                           </label></td>
                        </tr>
						 <tr>
                          <td width="29%" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Image</td>
                          <td width="1%">&nbsp;</td>
                          <td width="41%"><label>
                          <input type="file" name="product_image" id="product_image" />
                           </label></td>
                          <td width="29%">
						    <?php 
							 $imgpath = $fetch['image'];
							 if(($imgpath != '') && (file_exists($imgpath)))
							 {	?>
						      <img src="<?php echo $fetch['image']; ?>" width="50" height="50" alt=" " />
							 <?php } else { ?>
							  <img src="../images/img_noimg.jpg" width="50" height="50" alt=" " />
							 <?php } ?>
						  </td>
					    </tr>
                        <tr height="3">
                          <td></td>
                          <td></td>
                          <td colspan="2"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td colspan="2"><input type="submit" name="update" value="Update" />
                            &nbsp;&nbsp;<!--<input type="button" name="back" value="Back" onclick="javascript:history.back();"/>-->                          </td>
                        </tr>
                      </table>
                    <!-- Table Ends-->
                  </td>
                </tr>
            </table></form> <?php } else { ?> <form action="" method="post" name="frm_superdeals" enctype="multipart/form-data" onsubmit="return validation();"><table width="100%" height="133" cellpadding="3" cellspacing="0">
                <!--  <tr>
                <td colspan="7" class="sellerviewheading">Manage Selling Leads </td>
              </tr>-->
                <!--<tr height="30" bgcolor="#669966">
                  <td class="adminheading">Super Deals  </td>
                </tr>-->
                <tr>
                  <td><!-- Table Begins-->
                      <table width="105%" border="0" cellpadding="3" cellspacing="0">
					  <tr><td colspan="3"></td></tr>
                        <tr>
                          <td width="28%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name" type="text" /></td>
                        </tr>
						<tr>
                          <td width="28%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name1" type="text" /></td>
                        </tr>
						<?php /*?><tr>
                          <td width="28%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name2" type="text" /></td>
                        </tr><?php */?>
						<tr>
                          <td width="28%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Product Name&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="product_name3" type="text" /></td>
                        </tr>
						 <tr>
                          <td width="28%" height="32" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Orginal Rate</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="orginal_rate" type="text" /></td>
                        </tr>
						 <tr>
                          <td width="28%" height="33" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Curent Rate</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="current_rate" type="text" /></td>
                        </tr>
						 <tr>
                          <td width="28%" height="36" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Minimum Order</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="min_order" type="text" /></td>
                        </tr>
						 <tr>
                          <td width="28%" height="46" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description"></textarea>
                           </label></td>
                        </tr>
						<tr>
                          <td width="28%" height="46" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description1"></textarea>
                           </label></td>
                        </tr>
						<?php /*?><tr>
                          <td width="28%" height="46" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description2"></textarea>
                           </label></td>
                        </tr><?php */?>
						<tr>
                          <td width="28%" height="46" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><font color="#FF0000">*</font> Description&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                            <textarea name="description3"></textarea>
                           </label></td>
                        </tr>
						 <tr>
                          <td width="28%" height="37" align="right" class="seller" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Image</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><label>
                          <input type="file" name="product_image" id="product_image" />
                           </label></td>
                        </tr>
                        <tr height="3">
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><input type="submit" name="submit" value="Submit" />
                            &nbsp;&nbsp;<!--<input type="button" name="Submit" value="Back" onclick="javascript:history.back();"/>-->                          </td>
                        </tr>
                      </table>
                    <!-- Table Ends-->
                  </td>
                </tr>
            </table></form><?php } ?></td>
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