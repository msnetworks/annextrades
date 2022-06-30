<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['addcat']))
	{
	 include("includes/resize-class.php");
	 $category=$_REQUEST['category'];
	 $category1=$_REQUEST['category_french'];
	 //$category2=$_REQUEST['category_chinese'];
	 $category3=$_REQUEST['category_spanish'];
	 $cat_image=$_FILES['user_logo']['name'];
	

	  if($cat_image == "") 
	{
		if($_REQUEST['logo1'] != "") 
		{
			
			$cat_image = $_REQUEST['logo1'];
		}
		
	}
	
	else
    {
		$img_size = filesize($_FILES['user_logo']['tmp_name']);
		if($img_size > 1048576) //1048576 = 1MB
		{
			header("Location:addcategory.php?largeimage");
			exit;
		}
		else
		{
		 $split_name = explode(".",$cat_image);
		
	
			
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') || ($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
				$cat_image = "set_small".date("dmY")."-".rand("100","999").".".$split_name[1];
				$image_path = "category_images/"; 
				move_uploaded_file($_FILES['user_logo']['tmp_name'],"category_images/".$cat_image);
				$resizeObj = new resize("category_images/".$cat_image);
				$resizeObj -> resizeImage(600, 150, 'exact');
				$resizeObj -> saveImage($image_path.$cat_image, 100);
			}
			else
			{
				header("Location:addcategory.php?not-a-image");
				exit;
			}
		}
	}  
	
	
	
	
	/*echo "insert into category (category,parent_id,cat_image) values('$category','','$cat_image')";
	echo "insert into  category_french (category,parent_id,cat_image) values('$category1','','$cat_image1')";
	echo "insert into category_chinese (category,parent_id,cat_image) values('$category2','','$cat_image2')";
	 exit;*/
	 mysqli_query($con,"insert into category (category,parent_id,cat_image) values('$category','','$cat_image')");
	 
	 mysqli_query($con,"insert into  category_french (category,parent_id,cat_image) values('$category1','','$cat_image')");
	 
	// mysqli_query($con,"insert into category_chinese (category,parent_id,cat_image) values('$category2','','$cat_image')");
	 
	 mysqli_query($con,"insert into category_spanish (category,parent_id,cat_image) values('$category3','','$cat_image')");
	 
	 header("location:category.php?added");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function val()
{
 if(document.addcategory.category.value=="")
 {
  alert("Please Enter The Category Name");
  document.addcategory.category.focus();
  return false;
 }

 if(document.addcategory.category_french.value=="")
 {
  alert("Please Enter The Category Name");
  document.addcategory.category_french.focus();
  return false;
 }

 if(document.addcategory.category_chinese.value=="")
 {
  alert("Please Enter The Category Name");
  document.addcategory.category_chinese.focus();
  return false;
 }
 if(document.addcategory.category_spanish.value=="")
 {
  alert("Please Enter The Category Name");
  document.addcategory.category_spanish.focus();
  return false;
 }
}  
</script>
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
	<header id="header">
		<hgroup>
			<style type="text/css">
<!--
.style2 {
	color: #000000;
	font-size: 36px;
}
-->
            </style>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="category.php"><b>Category</b></a></article>
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
		
		<header><h3 class="tabs_involved">Add New Category</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="addcategory" action="" method="post" onsubmit="return val();" enctype="multipart/form-data"> 
					<table width="80%" height="217" align="center">
					
						<tr>
							<td width="235" height="43" class="inTxtNormal"><strong>Category Name&nbsp;&nbsp;(English)</strong></td>
						  	<td width="501"><input name="category" type="text" id="category" /></td>
						</tr>
						<tr>
							<td width="235" height="41" class="inTxtNormal"><strong>Category Name&nbsp;&nbsp;(French)</strong></td>
						  	<td width="501"><input name="category_french" type="text" id="category_french" /></td>
						</tr>
						<!--<tr>
							<td width="235" height="44" class="inTxtNormal"><strong>Category Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="501"><input name="category_chinese" type="text" id="category_chinese" /></td>
						</tr>-->
						<tr>
							<td width="235" height="44" class="inTxtNormal"><strong>Category Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="501"><input name="category_spanish" type="text" id="category_spanish" /></td>
						</tr>
						
						<tr>
							<td width="235" height="46" class="inTxtNormal"><strong>Category Image</strong></td>
						  	<td width="501"><input type="file" name="user_logo" id="user_logo" /></td>
						</tr>
						
						<tr>
						<td>&nbsp;&nbsp;</td>
						<td ><input type="submit" name="addcat" value="Submit"  /></td></tr>
					</table>
				</form>
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