<?php 
	//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$cateid=$_REQUEST['catid'];
	//echo "select * from category where c_id='$cateid'";exit;
	$result=mysqli_query($con,"select * from category where c_id='$cateid'");
	$result1=mysqli_query($con,"select * from category_french where c_id='$cateid'");
	//$result2=mysqli_query($con,"select * from category_chinese where c_id='$cateid'");
	$result3=mysqli_query($con,"select * from category_spanish where c_id='$cateid'");
	$num=mysqli_num_rows($result);
	$final=mysqli_fetch_array($result);
	$final1=mysqli_fetch_array($result1);
	$final2=mysqli_fetch_array($result2);
	$final3=mysqli_fetch_array($result3);
	if(isset($_REQUEST['editcat']))
	{
	
		
		include("includes/resize-class.php");
	$catname=$_REQUEST['category'];
	$catname1=$_REQUEST['category1'];
	$catname2=$_REQUEST['category2'];
	$catname3=$_REQUEST['category3'];
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
			header("Location:category.php?largeimage");
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
				$resizeObj -> resizeImage(200, 150, 'exact');
				$resizeObj -> saveImage($image_path.$cat_image, 100);
			}
			else
			{
				header("Location:category.php?not-a-image");
				exit;
			}
		}
		mysqli_query($con,"update category set cat_image ='".$cat_image."' where `category`.`c_id`='$cateid' ");
		mysqli_query($con,"update category_french set cat_image ='".$cat_image."' where `category_french`.`c_id`='$cateid' ");
		//mysqli_query($con,"update category_chinese set cat_image ='".$cat_image."' where `category_chinese`.`c_id`='$cateid' ");
		mysqli_query($con,"update category_spanish set cat_image ='".$cat_image."' where `category_spanish`.`c_id`='$cateid' ");
	}  
	//mysqli_query($con,"update banner set title='".$_REQUEST['title']."' where `banner`.`id`='$id' ");
	//header("location:banner.php?action=2");
	
		mysqli_query($con,"update category set category='$catname' where c_id='$cateid'");
		mysqli_query($con,"update category_french set category='$catname1' where c_id='$cateid'");
		//mysqli_query($con,"update category_chinese set category='$catname2' where c_id='$cateid'");
		mysqli_query($con,"update category_spanish set category='$catname3' where c_id='$cateid'");
		header("location:category.php?edited");
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
	var category3=document.category.category.value;
	if(trimAll(category3)=="")
	{
		alert("Enter Category Name");
		document.category.category3.value='';
		document.category.category3.focus();
		return false;
	}
	var category1=document.category.category1.value;
	if(trimAll(category1)=="")
	{
		alert("Enter Category Name");
		document.category.category1.value='';
		document.category.category1.focus();
	return false;
	}	
	var category2=document.category.category2.value;
	if(trimAll(category2)=="")
	{
		alert("Enter Category Name");
		document.category.category2.value='';
		document.category.category2.focus();
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
		<header><h3 class="tabs_involved">Edit Category</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form action="" method="post" name="category" enctype="multipart/form-data" onsubmit="return validatecategory()">
					<table width="80%" height="224" align="center">
					
						<tr>
							<td width="108" height="43" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(English)</strong></td>
						  	<td width="179"><input type="text" name="category" value="<?PHP echo $final['category'];?>"/></td>
						</tr>
						<tr>
							<td width="108" height="43" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(French)</strong></td>
						  	<td width="179"><input type="text" name="category1" value="<?PHP echo $final1['category'];?>"/></td>
						</tr>
						<?php /*?><tr>
							<td width="108" height="49" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="179"><input type="text" name="category2" value="<?PHP echo $final2['category'];?>"/></td>
						</tr><?php */?>
						<tr>
							<td width="108" height="49" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="179"><input type="text" name="category3" value="<?PHP echo $final3['category'];?>"/></td>
						</tr>
						<tr>
							<td width="235" height="49" class="inTxtNormal"><strong>Category Image</strong></td>
						  	<td width="501"><input type="file" name="user_logo" id="user_logo" /></td>
						</tr>
						
						<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="editcat" value="Submit"   /></td>
						</tr>
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