<?php
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	 if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['editid']))
	{
	$editid=$_REQUEST['editid'];
	$sqlgettoedit=mysqli_query($con,"SELECT * FROM faq_answers WHERE id='$editid'");
	$answer=mysqli_fetch_assoc($sqlgettoedit);
	
	$sqlgettoedit1=mysqli_query($con,"SELECT * FROM faq_answers_french WHERE id='$editid'");
	$answer1=mysqli_fetch_assoc($sqlgettoedit1);
	
	//$sqlgettoedit2=mysqli_query($con,"SELECT * FROM faq_answers_chinese WHERE id='$editid'");
	//$answer2=mysqli_fetch_assoc($sqlgettoedit2);
	
	$sqlgettoedit3=mysqli_query($con,"SELECT * FROM faq_answers_spanish WHERE id='$editid'");
	$answer3=mysqli_fetch_assoc($sqlgettoedit3);
	}
	$catid=$_REQUEST['catid'];
	$subcatid=$_REQUEST['subcatid'];
	if(isset($_REQUEST['submit']))
	{
	$answer=mysqli_real_escape_string($con, $_POST['answer']);
	$answer1=mysqli_real_escape_string($con, $_POST['answer1']);
	$answer2=mysqli_real_escape_string($con, $_POST['answer2']);
	$answer3=mysqli_real_escape_string($con, $_POST['answer3']);
	
	if(isset($_REQUEST['editid'])){
	$sql=mysqli_query($con,"UPDATE faq_answers SET `answer`='$answer' WHERE id='$editid'");
	
	$sql=mysqli_query($con,"UPDATE faq_answers_french SET `answer`='$answer1' WHERE id='$editid'");
	
	//$sql=mysqli_query($con,"UPDATE faq_answers_chinese SET `answer`='$answer2' WHERE id='$editid'");
	
	$sql=mysqli_query($con,"UPDATE faq_answers_spanish SET `answer`='$answer3' WHERE id='$editid'");
	
	header("Location:related_answers.php?catid=$catid&subcatid=$subcatid&upd=suc");
	}else{
	$sql=mysqli_query($con,"INSERT INTO faq_answers(`answer`,`belong_id`)value('$answer','$subcatid')");
	
	$sql=mysqli_query($con,"INSERT INTO faq_answers_french(`answer`,`belong_id`)value('$answer1','$subcatid')");
	
	//$sql=mysqli_query($con,"INSERT INTO faq_answers_chinese(`answer`,`belong_id`)value('$answer2','$subcatid')");
	
	$sql=mysqli_query($con,"INSERT INTO faq_answers_spanish(`answer`,`belong_id`)value('$answer3','$subcatid')");
	
	header("Location:related_answers.php?catid=$catid&subcatid=$subcatid&add=suc");
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
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function validation()
{

if(document.buy_overview.answer.value=="")
{
alert('Please Enter Answer');
document.buy_overview.answer.focus();
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
					<table width="344" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="3" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					
						<tr bgcolor="#E6E6E6">
						  <td colspan="3" height="20"><div align="center"><strong><?php if(isset($_REQUEST['editid'])){ ?> Edit Answer <?php } else { ?> Add Answer <?php } ?> </strong></div></td>
					  </tr>
						<tr>
						  <td width="61" class="gboldli">&nbsp;</td>
						  <td width="40" class="gboldli">&nbsp;</td>
						  <td width="227"><a href="addnewfaq.php"></a> </td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						   <td class="gboldli">&nbsp;</td>
						  <td style="padding-left:100px;"><label>
						   <?php if(isset($_REQUEST['editid'])){ ?> Edit Answer <?php } else { ?> Add Answer <?php } ?> 
						    </label></td>
					  </tr>
						<tr>
						  <td height="46" class="gboldli">English</td>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						  <textarea name="answer" rows="5" cols="35"><?php echo $answer['answer']; ?></textarea>
						  </label></td>
					  </tr>
					  <tr>
						  <td class="gboldli">French</td>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						  <textarea name="answer1" rows="5" cols="35"><?php echo $answer1['answer']; ?></textarea>
						  </label></td>
					  </tr>
					  <!--<tr>
						  <td class="gboldli">Chinese</td>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						  <textarea name="answer2" rows="5" cols="35"><?php echo $answer2['answer']; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>-->
						<tr>
						  <td class="gboldli">Spanish</td>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						  <textarea name="answer3" rows="5" cols="35"><?php echo $answer3['answer']; ?></textarea>
						  </label></td>
					  </tr>
						
						<td colspan="3" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
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