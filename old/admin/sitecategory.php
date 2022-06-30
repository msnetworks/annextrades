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
	if(isset($_REQUEST['submit']))
	{
	if(!isset($_REQUEST['edit'])){
	$category=$_POST['category'];
	$sql=mysqli_query($con,"INSERT INTO sitecategory(`category`)value('$category')");
	header("Location:sitecategory.php?&add=suc");
	}else{
	$category=$_POST['category'];
	$id=$_REQUEST['edit'];
	$sql=mysqli_query($con,"Update sitecategory set category='$category' WHERE id='$id'");
	header("Location:sitecategory.php?add=suc");
	}
	}
	
	if(isset($_REQUEST['edit']))
	{
	$id=$_REQUEST['edit'];
	$sql=mysqli_query($con,"SELECT * FROM sitecategory WHERE id='$id'");
	$row=mysqli_fetch_assoc($sql);
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
if(document.addcategory.category.value=="")
{
document.addcategory.category.value=="";
alert("Please enter the category");
document.addcategory.category.focus();
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
					<form name="addcategory" action="" method="post" onsubmit="return validation();">
					<table width="299" height="70" align="center" style="border:solid 1px #E6E6E6;">
						  <tr bgcolor="#E6E6E6">
						    <td colspan="3" align="center" height="20"><strong><?php if(isset($_REQUEST['edit'])){echo "Edit Category";}else{echo "Add Category";} ?></strong></td>
				      </tr>
					    <tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td width="108"><b>Category</b></td>
						    <td width="179"><input type="text" name="category" value="<?php echo $row['category'] ?>" /></td>
						</tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						
						<tr><td colspan="3" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
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