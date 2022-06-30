<?php 
	//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$fid=$_REQUEST['edit'];
	$query=mysqli_query($con,"select * from forums where fid='$fid' ");
	$topic=mysqli_fetch_array($query);
	
	$query1=mysqli_query($con,"select * from forums_french where fid='$fid' ");
	$topic1=mysqli_fetch_array($query1);
	
	//$query2=mysqli_query($con,"select * from forums_chinese where fid='$fid' ");
	//$topic2=mysqli_fetch_array($query2);
	
	$query3=mysqli_query($con,"select * from forums_spanish where fid='$fid' ");
	$topic3=mysqli_fetch_array($query3);
	
	if(isset($_REQUEST['update']))
	{
	$topic=mysqli_real_escape_string($con, $_REQUEST['topic']);
		$topic1=mysqli_real_escape_string($con, $_REQUEST['topic1']);
		$topic2=mysqli_real_escape_string($con, $_REQUEST['topic2']);
		$topic3=mysqli_real_escape_string($con, $_REQUEST['topic3']);
		$update=mysqli_query($con,"update forums set topic='$topic' where fid='".$_REQUEST['fid']."' ");
		
		$update=mysqli_query($con,"update forums_french set topic='$topic1' where fid='".$_REQUEST['fid']."' ");
		
		//$update=mysqli_query($con,"update forums_chinese set topic='$topic2' where fid='".$_REQUEST['fid']."' ");
		
		$update=mysqli_query($con,"update forums_spanish set topic='$topic3' where fid='".$_REQUEST['fid']."' ");
		
		if($update)
		{
			header("location:topics.php?edited");
		}
		else
		{
			die("Error".mysqli_error($con));
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
	var topic=document.category.topic.value;
	if(trimAll(topic)=="")
	{
		alert("Enter Topic Name");
		document.category.topic.value='';
		document.category.topic.focus();
		return false;
	}
	var topic1=document.category.topic1.value;
	if(trimAll(topic1)=="")
	{
		alert("Enter Topic Name");
		document.category.topic1.value='';
		document.category.topic1.focus();
		return false;
	}
	var topic2=document.category.topic3.value;
	if(trimAll(topic2)=="")
	{
		alert("Enter Topic Name");
		document.category.topic3.value='';
		document.category.topic3.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="articlemanagement.php"><b>Topic Category</b></a></article>
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
					<form name="category" action="" method="post" onsubmit="return validatecategory();">
					<input type="hidden" name="fid" value="<?php echo $topic['fid'];?>" />
					<table width="80%" height="147" align="center">
						<tr>
							<td width="190" class="inTxtNormal" style="font-size:12px;"><strong>Topic Name&nbsp;&nbsp;(English)</strong></td>
						  	<td width="546"><input type="text" name="topic" value="<?php echo $topic['topic'];?>"/></td>
						</tr>
						<tr>
							<td width="190" class="inTxtNormal" style="font-size:12px;"><strong>Topic Name&nbsp;&nbsp;(French)</strong></td>
						  	<td width="546"><input type="text" name="topic1" value="<?php echo $topic1['topic'];?>"/></td>
						</tr>
				<?php /*?>		<tr>
							<td width="190" class="inTxtNormal" style="font-size:12px;"><strong>Topic Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="546"><input type="text" name="topic2" value="<?php echo $topic2['topic'];?>"/></td>
						</tr><?php */?>
						<tr>
							<td width="190" class="inTxtNormal" style="font-size:12px;"><strong>Topic Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="546"><input type="text" name="topic3" value="<?php echo $topic3['topic'];?>"/></td>
						</tr>
						<tr><td colspan="2" align="center"><input type="submit" name="update" value="Save"  /></td></tr>
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