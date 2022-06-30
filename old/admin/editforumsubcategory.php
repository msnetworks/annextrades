<?php 
	//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$forum=$_REQUEST['id'];
	//echo $forum; exit;
	$cid=$_REQUEST['cid'];
	if(isset($_REQUEST['cid']))
	{
		$id=$_REQUEST['cid'];
		$catdetail=mysqli_fetch_array(mysqli_query($con,"select * from forumheading where id='$id'"));
		
		$catdetail1=mysqli_fetch_array(mysqli_query($con,"select * from forumheading_french where id='$id'"));
		
		//$catdetail2=mysqli_fetch_array(mysqli_query($con,"select * from forumheading_chinese where id='$id'"));
		
		$catdetail3=mysqli_fetch_array(mysqli_query($con,"select * from forumheading_spanish where id='$id'"));
	}
	$result=mysqli_query($con,"select * from forumheading where parentid='0'");
	
	if(isset($_REQUEST['submit']))
	{
		$catid=$_REQUEST['catid'];
		$categoryname=mysqli_real_escape_string($con, $_REQUEST['categoryname']);
		$categoryname1=mysqli_real_escape_string($con, $_REQUEST['categoryname1']);
		//$categoryname2=mysqli_real_escape_string($con, $_REQUEST['categoryname2']);
		$categoryname3=mysqli_real_escape_string($con, $_REQUEST['categoryname3']);
		$maincategory=mysqli_real_escape_string($con, $_REQUEST['parentcategory']);
		mysqli_query($con,"update forumheading set mainheading='$categoryname', parentid='$maincategory', date=NOW() where id='$catid'");
		
		mysqli_query($con,"update forumheading_french set mainheading='$categoryname1', parentid='$maincategory', date=NOW() where id='$catid'");
		
		//mysqli_query($con,"update forumheading_chinese set mainheading='$categoryname2', parentid='$maincategory', date=NOW() where id='$catid'");
		
		mysqli_query($con,"update forumheading_spanish set mainheading='$categoryname3', parentid='$maincategory', date=NOW() where id='$catid'");
		
		header("Location:forumsubcategory.php?cid=$forum&edited");
		//header("Location:forumsubcategory.php?$_REQUEST[catid]&edited");
		//header("Location:forummanagement.php?edited");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="forummanagement.php"><b>Forum Category</b></a></article>
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
		<header><h3 class="tabs_involved">Edit Forum Category</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="category" action="" method="post" onsubmit="return validatecategory();">
					<input type="hidden" name="catid" value="<?php echo $catdetail['id'];?>" />
					<table width="80%" height="233" align="center">
						<tr>
							<td width="108" height="50" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(English)</strong></td>
						  	<td width="179"><input type="hidden" name="catid" value="<?php echo $catdetail['id'];?>" /><input type="text" name="categoryname" value="<?php echo $catdetail['mainheading'];?>" style="width:200px;"/></td>
						</tr>
						<tr>
							<td width="108" height="47" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(French)</strong></td>
						  	<td width="179"><input type="hidden" name="catid1" value="<?php echo $catdetail1['id'];?>" /><input type="text" name="categoryname1" value="<?php echo $catdetail1['mainheading'];?>" style="width:200px;"/></td>
						</tr>
					<?php /*?>	<!--<tr>
							<td width="108" height="50" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="179"><input type="hidden" name="catid2" value="<?php echo $catdetail2['id'];?>" /><input type="text" name="categoryname2" value="<?php echo $catdetail2['mainheading'];?>" style="width:200px;"/></td>
						</tr>--><?php */?>
						<tr>
							<td width="108" height="50" class="inTxtNormal" style="font-size:12px;"><strong>Category Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="179"><input type="hidden" name="catid2" value="<?php echo $catdetail3['id'];?>" /><input type="text" name="categoryname3" value="<?php echo $catdetail3['mainheading'];?>" style="width:200px;"/></td>
						</tr>
						<tr>
						  <td height="46" class="inTxtNormal" style="font-size:12px;"><strong>Parent Category</strong></td>
						  <td>
							<select name="parentcategory" style="width:200px;">
								<option <?php if($catdetail['parentid']=='0'){?> selected="selected" <?php }?> value="0">root</option>
								<?php
								while($category=mysqli_fetch_array($result))
								{
								?>
								<option <?php if($catdetail['parentid']==$category['id']){?> selected="selected" <?php }?> value="<?php echo $category['id'];?>"><?php echo $category['mainheading'];?></option>
								<?php }?>
							</select>
						</td></tr>
						<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Save" onclick="return validatecategory();"/></td></tr>
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