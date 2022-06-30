<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['submit'])) 
	{
		$buss_type=mysqli_real_escape_string($con, $_REQUEST['buss_type']);
		$buss_type1=mysqli_real_escape_string($con, $_REQUEST['buss_type1']);
		$buss_type2=mysqli_real_escape_string($con, $_REQUEST['buss_type2']);
		$buss_type3=mysqli_real_escape_string($con, $_REQUEST['buss_type3']);
		//echo "insert into business_type(buss_type,buss_added_date) values ('$buss_type',NOW())"; exit;
		$insert=mysqli_query($con,"insert into business_type(buss_type,buss_added_date) values ('$buss_type',NOW())");
		$insert=mysqli_query($con,"insert into business_type_french(buss_type,buss_added_date) values ('$buss_type1',NOW())");
		//$insert=mysqli_query($con,"insert into business_type_chinese(buss_type,buss_added_date) values ('$buss_type2',NOW())");
		$insert=mysqli_query($con,"insert into business_type_spanish(buss_type,buss_added_date) values ('$buss_type3',NOW())");
		if($insert)
		{
			header("location:view_bussiness_type.php?added");
		}
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
	var username=document.category.buss_type.value;
	if(trimAll(username)=="")
	{
		alert("Enter Business Type");
		document.category.buss_type.value='';
		document.category.buss_type.focus();
		return false;
	}
	var username1=document.category.buss_type1.value;
	if(trimAll(username1)=="")
	{
		alert("Enter Business Type");
		document.category.buss_type1.value='';
		document.category.buss_type1.focus();
		return false;
	}
	var username2=document.category.buss_type2.value;
	if(trimAll(username2)=="")
	{
		alert("Enter Business Type");
		document.category.buss_type2.value='';
		document.category.buss_type2.focus();
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
		<header><h3 class="tabs_involved">Add New Business Type</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="category" action="" method="post" onsubmit="return validatecategory();">
					<table width="80%" height="147" align="center">
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Business Type&nbsp;&nbsp;(English)</strong></td>
						  	<td width="179"><input type="text" name="buss_type" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Business Type&nbsp;&nbsp;(French)</strong></td>
						  	<td width="179"><input type="text" name="buss_type1" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<?php /*?><tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Business Type&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="179"><input type="text" name="buss_type2" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr><?php */?>
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Business Type&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="179"><input type="text" name="buss_type3" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Save"  /></td></tr>
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