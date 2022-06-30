<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['del']))
	{
		$id=$_REQUEST['del'];
		$sql=mysqli_query($con,"DELETE FROM sitemap WHERE id='$id'");
		header("Location:sitemapview.php?deleted");
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
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Edited Sucessfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['deleted'])) { ?>
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
					<table width="90%" border="0" style="border:1px solid #E6E6E6;" align="center">
                              <tr bgcolor="#E6E6E6">
                                <td width="26%" align="center" height="30"><strong class="normalbold">&nbsp;Link Name </strong></td>
                                <td width="24%" align="center"><strong class="normalbold">&nbsp;Actions</strong></td>
                              </tr>
                              <?php
							  	$select="SELECT * FROM sitemap";
								$strget="";
								$rowsPerPage =10;
								$query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
								$pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
									while($array_in=mysqli_fetch_array($query))
									{
										$stroyid=$array_in['test_id'];
										$St=$array_in['status'];
								?>
								
								<tr>
									<td  style="font-family:'Times New Roman', Times, serif; font-size:14px; text-align:center;">&nbsp;<?php echo $array_in['name'];?></td>
									<td align="center"><a href="sitemap_edit.php?edit=<?php echo $array_in['id']; ?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a>
									
					<a href="sitemapview.php?del=<?php echo $array_in['id'];?>" onclick="return confirm('Are you sure want to delete this record?');"><img src="../images1/delete.jpg" alt="Delete" title="Delete" border="0" /></a>					</td>
                              </tr>
							  <?php }?>
                              <tr>
                                <td colspan="7" align="center"><?PHP echo $pagingLink;
     echo "<br>";?></td>
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