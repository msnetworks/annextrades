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
	if($_REQUEST['edit'])
	{
	$id=$_REQUEST['edit'];
	$sql=mysqli_query($con,"Select * FROM sitemap WHERE id='$id'");
	$row1=mysqli_fetch_assoc($sql);
	}
	
	if(isset($_REQUEST['submit']))
	{
	$name=$_REQUEST['name'];
		$link=$_REQUEST['link'];
		$cat=$_REQUEST['category'];
	if(!isset($_REQUEST['edit'])){
		
		$sql=mysqli_query($con,"INSERT INTO sitemap(`name`,`link`,`category_id`)value('$name','$link','$cat')");
		if($sql)
		{
		header("Location:sitemap.php?add=suc");
		}
	}
	else{
	$id=$_REQUEST['edit'];
	$sql=mysqli_query($con,"Update sitemap set `name`='$name',`link`='$link',`category_id`='$cat' WHERE `id`='$id'");
	if($sql)
	{
	header("Location:sitemap.php?add=suc");
	}
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
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	<script type="text/javascript">
function validation()
{
if(document.addsitemaplink.name.value=="")
{
alert('Enter name');
document.addsitemaplink.name.focus();
return false;
}
if(document.addsitemaplink.link.value=="")
{
alert('Enter Link');
document.addsitemaplink.link.focus();
return false;
}
if(document.addsitemaplink.category.value=="")
{
alert('Enter Category');
document.addsitemaplink.category.focus();
return false;
}
}
</script>
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Sitemap</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['add'])) { ?>
		<h4 class="alert_success">Added Sucessfully!</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['delete'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Site Map</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0" >
				<?php /*?><tr>
					<td height="137">
						<?php include("buyoffersearchhead.php");?>				  </td>
				</tr><?php */?>

				<tr align="center"><td height="42" valign="bottom">
					<?php include("sitemapheader.php");?>
				</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<form name="addsitemaplink" action="" method="post" onsubmit="return validation();">
					<table width="299" height="70" align="center" style="border:1px solid #E6E6E6;">
					
						<tr bgcolor="#E6E6E6">
						  <td colspan="3" height="20"><div align="center"><strong><?php if(isset($_REQUEST['edit'])) { ?> Edit SiteMap Link <?php  } else {?>Add Sitemap Link <?php } ?></strong> </div></td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td width="108"><b>Name</b></td>
						    <td width="179"><input type="text" name="name" value="<?php echo $row1['name']; ?>"/></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						  <td><b>Link</b></td>
						  <td><input type="text" name="link" value="<?php echo $row1['link']; ?>"/></td></tr>
						<tr>
						<td>&nbsp;</td>
						  <td><b>Category</b></td>
						  <td><label>
						    <select name="category">
							<option value="">Select</option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM sitecategory");
							 while($row=mysqli_fetch_assoc($sql)){ ?>
							<option value="<?php echo $row['id']; ?>" <?php if($row1['category_id']==$row['id']) { ?>  selected="selected" <?php } ?> ><?php echo $row['category']; ?></option>
							<?php } ?>
					      </select>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr><td colspan="3" align="center"><input type="submit" name="submit" value="Submit"  /></td></tr>
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