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
	$catid=$_REQUEST['catid'];
	$subcatid=$_REQUEST['subcatid'];
	if(isset($_REQUEST['delid']))
	{
	$delid=$_REQUEST['delid'];
	$delete=mysqli_query($con,"DELETE FROM faq_answers WHERE id='$delid'");
	$delete=mysqli_query($con,"DELETE FROM faq_answers_french WHERE id='$delid'");
	//$delete=mysqli_query($con,"DELETE FROM faq_answers_chinese WHERE id='$delid'");
	$delete=mysqli_query($con,"DELETE FROM faq_answers_spanish WHERE id='$delid'");
	header("Location:related_answers.php?catid=$catid&subcatid=$subcatid&del=suc");
	}
	$sqlget=mysqli_query($con,"SELECT * FROM faq_answers WHERE belong_id='$subcatid'");
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
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function validation()
{
tinyMCE.triggerSave();
if(document.buy_overview.buy_over.value=="")
{
alert('Enter Content');
document.buy_overview.buy_over.focus();
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
		<?php if(isset($_REQUEST['del'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['upd'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">FAQ</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
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
					<form name="buy_overview" action="" method="post" onsubmit="return validation();">
					<table width="564" height="70" align="center" style="border:1px solid #E6E6E6;">
						<tr bgcolor="#E6E6E6">
						  <td colspan="2" height="20"><div align="center"><strong> Answers </strong></div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="448" align="right"><a href="addnewans.php?catid=<?php echo $_REQUEST['catid']; ?>&subcatid=<?php echo $_REQUEST['subcatid']; ?>" class="gboldli" style="color:#000099;"><b>Add new</b></a></td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <!--<?php //while($row=mysqli_fetch_assoc($sqlget)) { ?>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><?php //echo $row['answer']; ?></td>
					  </tr>
					  <?php //} ?>-->
						<tr><td class="gboldli">&nbsp;</td>
						  <td><table width="98%" border="0" cellspacing="2" cellpadding="2">
                            <tr>
                              <td width="75%"><strong>Answers</strong></td>
                              <td width="9%"><strong>Edit</strong></td>
                              <td width="16%"><strong>Delete</strong></td>
                            </tr>
							<?php 
							
							if(mysqli_num_rows($sqlget)>0) {
							while($row=mysqli_fetch_assoc($sqlget)) { ?>
                            <tr>
                              <td><?php echo $row['answer']; ?></td>
                              <td><a href="addnewans.php?catid=<?php echo $catid; ?>&subcatid=<?php echo $subcatid; ?>&editid=<?php echo $row['id']; ?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
                              <td><a href="related_answers.php?catid=<?php echo $catid; ?>&subcatid=<?php echo $subcatid; ?>&delid=<?php echo $row['id']; ?>&del=suc" onclick="return confirm('Are you sure do you want to delete this record');"><img src="../images1/delete.jpg" alt="delete" title="delete" border="0" /></a></td>
                            </tr>
							 <?php }  } else {?>
							 <tr>
						  <td colspan="3" align="center" class="redbold">No Answers Found</td>
						</tr>
						<?php } ?>
                          </table></td>
						</tr>
						<tr>
						  <td colspan="2" align="center">&nbsp;</td>
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