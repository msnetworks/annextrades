<?php include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$sqlget=mysqli_query($con,"SELECT * FROM helptopic_category");
	$row=mysqli_fetch_assoc($sqlget);
	
	if(isset($_REQUEST['editid']))
	{
	$id=$_REQUEST['editid'];
	$sqledit=mysqli_query($con,"SELECT * FROM helptopic_category WHERE id='$id'");
	$sqledit1=mysqli_query($con,"SELECT * FROM helptopic_category_french WHERE id='$id'");
	//$sqledit2=mysqli_query($con,"SELECT * FROM helptopic_category_chinese WHERE id='$id'");
	$sqledit3=mysqli_query($con,"SELECT * FROM helptopic_category_spanish WHERE id='$id'");
	$rowedit=mysqli_fetch_assoc($sqledit);
	$rowedit1=mysqli_fetch_assoc($sqledit1);
	$rowedit2=mysqli_fetch_assoc($sqledit2);
	$rowedit3=mysqli_fetch_assoc($sqledit3);
	}
	
	if(isset($_REQUEST['Submit']))
	{
	$category=mysqli_real_escape_string($con, $_POST['category']);
	$category1=mysqli_real_escape_string($con, $_POST['category1']);
	$category2=mysqli_real_escape_string($con, $_POST['category2']);
	$category3=mysqli_real_escape_string($con, $_POST['category3']);
	if(isset($_REQUEST['editid']))
	{
	$sql=mysqli_query($con,"UPDATE helptopic_category SET `category`='$category' WHERE id='$id'");
	$sql=mysqli_query($con,"UPDATE helptopic_category_french SET `category`='$category1' WHERE id='$id'");
	//$sql=mysqli_query($con,"UPDATE helptopic_category_chinese SET `category`='$category2' WHERE id='$id'");
	$sql=mysqli_query($con,"UPDATE helptopic_category_spanish SET `category`='$category3' WHERE id='$id'");
	}else
	{
	$sql=mysqli_query($con,"INSERT INTO helptopic_category(`category`)value('$category')");
	$sql=mysqli_query($con,"INSERT INTO helptopic_category_french(`category`)value('$category1')");
	//$sql=mysqli_query($con,"INSERT INTO helptopic_category_chinese(`category`)value('$category2')");
	$sql=mysqli_query($con,"INSERT INTO helptopic_category_spanish(`category`)value('$category3')");
	}
	header("Location:helptopic_category.php?add=suc");
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

if(document.addhelpcategory.category.value=="")
{
alert('Enter Category');
document.addhelpcategory.category.focus();
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
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['updated'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Help Topics</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0" >
				<tr align="center"><td height="42" valign="bottom">
					<?php include("helpheader.php");?>
				</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="98%" align="center" cellspacing="0">
				<tr>
					<td colspan="11">&nbsp;
						
					</td>
				</tr>
				<!--<tr>
				  <td height="27" align="center"><table width="738">
				    <tr>
				      <td width="59"><a href="help.php" class="gboldli">Posting selling  </a></td>
				      <td width="61"><a href="selling_over.php" class="gboldli">Selling Overview</a></td>
				      <td width="38"><a href="what.php" class="gboldli">What is b2b</a></td>
					  <td width="73"><a href="help_reg.php" class="gboldli">registration help</a></td>
					  <td width="61"><a href="buy_over.php" class="gboldli">Buy Overview</a></td>
					  <td width="61"><a href="post_buy_help.php" class="gboldli">Post Buying</a></td>
					  <td width="75"><a href="selling_tools.php" class="gboldli">selling tools</a></td>
					  <td width="76"><a href="messagecenter.php" class="gboldli">Message center</a></td>
					  <td width="75"><a href="help_questions.php" class="gboldli">Help Questions</a></td>
					  <td width="63"><a href="help_topics.php" class="gboldli">Help Topics</a></td>
					  <td width="48"><a href="faq.php" class="gboldli">Faq</a></td>
				    </tr></table></td>
				</tr>-->
				
				<tr><td valign="top">
					<form name="addhelpcategory" action="" method="post" onsubmit="return validation();">
					<table width="516" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="4" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					
						<tr bgcolor="#E6E6E6">
						  <td colspan="4" height="20"><div align="center"><strong>Edit Category</strong></div></td>
					  </tr>
						<tr>
						  <td width="55" class="gboldli">&nbsp;</td>
						  <td width="206"><a href="helptopic_category.php"></a></td>
						  <td width="200">&nbsp;</td>
						  <td width="35">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category Name &nbsp;&nbsp;(English)</td>
						  <td><label>
						    <input type="text" name="category" value="<?php echo $rowedit['category']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
					  <tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category Name &nbsp;&nbsp;(French)</td>
						  <td><label>
						    <input type="text" name="category1" value="<?php echo $rowedit1['category']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
					 <?php /*?> <tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category Name &nbsp;&nbsp;(Chinese)</td>
						  <td><label>
						    <input type="text" name="category2" value="<?php echo $rowedit2['category']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr><?php */?>
					  <tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category Name &nbsp;&nbsp;(Spanish)</td>
						  <td><label>
						    <input type="text" name="category3" value="<?php echo $rowedit3['category']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td colspan="4" align="center"><label>
						    <input type="submit" name="Submit" value="Submit" />
						  </label></td>
						</tr>
					</table>
				  </form>
				</td></tr>
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