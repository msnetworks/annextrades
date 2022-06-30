<?php include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$sqlget=mysqli_query($con,"SELECT * FROM helptopic_category");
	$sqlget1=mysqli_query($con,"SELECT * FROM helptopic_category_french");
	//$sqlget2=mysqli_query($con,"SELECT * FROM helptopic_category_chinese");
	$sqlget3=mysqli_query($con,"SELECT * FROM helptopic_category_spanish");
	
	if(isset($_REQUEST['editid']))
	{
	$id=$_REQUEST['editid'];
	$sqledit=mysqli_query($con,"SELECT * FROM helptopic WHERE id='$id'");
	
	$sqledit1=mysqli_query($con,"SELECT * FROM helptopic_french WHERE id='$id'");
	
	//$sqledit2=mysqli_query($con,"SELECT * FROM helptopic_chinese WHERE id='$id'");
	
	$sqledit3=mysqli_query($con,"SELECT * FROM helptopic_spanish WHERE id='$id'");
	
	$rowedit=mysqli_fetch_assoc($sqledit);
	$rowedit1=mysqli_fetch_assoc($sqledit1);
	$rowedit2=mysqli_fetch_assoc($sqledit2);
	$rowedit3=mysqli_fetch_assoc($sqledit3);
	}
	
	if(isset($_REQUEST['Submit']))
	{
	$topicname=mysqli_real_escape_string($con, $_POST['topicname']);
	$topiclink=mysqli_real_escape_string($con, $_POST['topiclink']);
	$category=mysqli_real_escape_string($con, $_POST['category']);
	
	$topicname1=mysqli_real_escape_string($con, $_POST['topicname1']);
	$topiclink1=mysqli_real_escape_string($con, $_POST['topiclink1']);
	$category1=mysqli_real_escape_string($con, $_POST['category1']);
	
	$topicname2=mysqli_real_escape_string($con, $_POST['topicname2']);
	$topiclink2=mysqli_real_escape_string($con, $_POST['topiclink2']);
	$category2=mysqli_real_escape_string($con, $_POST['category2']);
	
	$topicname3=mysqli_real_escape_string($con, $_POST['topicname3']);
	$topiclink3=mysqli_real_escape_string($con, $_POST['topiclink3']);
	$category3=mysqli_real_escape_string($con, $_POST['category3']);
	
	if(isset($_REQUEST['editid']))
	{
	$sql=mysqli_query($con,"UPDATE helptopic SET `topicname`='$topicname',`topic_link`='$topiclink',`category_id`='$category' WHERE id='$id'");
	
	$sql=mysqli_query($con,"UPDATE helptopic_french SET `topicname`='$topicname1',`topic_link`='$topiclink1',`category_id`='$category1' WHERE id='$id'");
	
	//$sql=mysqli_query($con,"UPDATE helptopic_chinese SET `topicname`='$topicname2',`topic_link`='$topiclink2',`category_id`='$category2' WHERE id='$id'");
	
	$sql=mysqli_query($con,"UPDATE helptopic_spanish SET `topicname`='$topicname3',`topic_link`='$topiclink3',`category_id`='$category3' WHERE id='$id'");
	
	header("Location:help_topics.php?upd=suc");
	}else
	{
	$sql=mysqli_query($con,"INSERT INTO helptopic(`topicname`,`topic_link`,`category_id`)value('$topicname','$topiclink','$category')");
	
	$sql=mysqli_query($con,"INSERT INTO helptopic_french(`topicname`,`topic_link`,`category_id`)value('$topicname1','$topiclink1','$category1')");
	
	//$sql=mysqli_query($con,"INSERT INTO helptopic_chinese(`topicname`,`topic_link`,`category_id`)value('$topicname2','$topiclink2','$category2')");
	
	$sql=mysqli_query($con,"INSERT INTO helptopic_spanish(`topicname`,`topic_link`,`category_id`)value('$topicname3','$topiclink3','$category3')");
	
	header("Location:help_topics.php?add=suc");
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
					<table width="500" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="4" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					<div><strong>English</strong></div><br />
						<tr bgcolor="#E6E6E6">
						  <td colspan="4" height="20"><div align="center"><strong>Add Topic</strong></div></td>
					  </tr>
						<tr>
						  <td width="57" class="gboldli">&nbsp;</td>
						  <td width="135"><a href="helptopic_category.php"></a></td>
						  <td width="270">&nbsp;</td>
						  <td width="18">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Name </td>
						  <td><label>
						    <input type="text" name="topicname" value="<?php echo $rowedit['topicname']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Link </td>
						  <td><label>
						    <input type="text" name="topiclink" value="<?php echo $rowedit['topic_link']; ?>" style="width:200px;"/>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category</td>
						  <td><label>
						    <select name="category">
							<?php while($row=mysqli_fetch_assoc($sqlget)){ ?>
							<option value="<?php echo $row['id']; ?>" <?php if($rowedit['category_id']==$row['id']){ ?>selected="selected" <?php } ?> ><?php echo $row['category']; ?></option>
							<?php } ?>
					      </select>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr>
						  <td colspan="4" align="center"><label>
						    <input type="submit" name="Submit" value="Submit"  />
						  </label></td>
						</tr>-->
					</table>
					
					
					
					<table width="500" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="4" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					 <br />
					<div><strong>French</strong></div><br />
						<tr bgcolor="#E6E6E6">
						  <td colspan="4" height="20"><div align="center"><strong>Add Topic</strong></div></td>
					  </tr>
						<tr>
						  <td width="57" class="gboldli">&nbsp;</td>
						  <td width="135"><a href="helptopic_category.php"></a></td>
						  <td width="270">&nbsp;</td>
						  <td width="18">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Name </td>
						  <td><label>
						    <input type="text" name="topicname1" value="<?php echo $rowedit1['topicname']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Link </td>
						  <td><label>
						    <input type="text" name="topiclink1" value="<?php echo $rowedit1['topic_link']; ?>" style="width:200px;"/>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category</td>
						  <td><label>
						    <select name="category1">
							<?php while($row1=mysqli_fetch_assoc($sqlget1)){ ?>
							<option value="<?php echo $row1['id']; ?>" <?php if($rowedit1['category_id']==$row1['id']){ ?>selected="selected" <?php } ?> ><?php echo $row1['category']; ?></option>
							<?php } ?>
					      </select>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr>
						  <td colspan="4" align="center"><label>
						    <input type="submit" name="Submit" value="Submit"  />
						  </label></td>
						</tr>-->
					</table>
					
					
					
					
					<table width="500" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="4" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					<br />
					<?php /*?><div><strong>Chinese</strong></div>
					<br />
						<tr bgcolor="#E6E6E6">
						  <td colspan="4" height="20"><div align="center"><strong>Add Topic</strong></div></td>
					  </tr>
						<tr>
						  <td width="57" class="gboldli">&nbsp;</td>
						  <td width="135"><a href="helptopic_category.php"></a></td>
						  <td width="270">&nbsp;</td>
						  <td width="18">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Name </td>
						  <td><label>
						    <input type="text" name="topicname2" value="<?php echo $rowedit2['topicname']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Link </td>
						  <td><label>
						    <input type="text" name="topiclink2" value="<?php echo $rowedit2['topic_link']; ?>" style="width:200px;"/>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category</td>
						  <td><label>
						    <select name="category2">
							<?php while($row2=mysqli_fetch_assoc($sqlget2)){ ?>
							<option value="<?php echo $row2['id']; ?>" <?php if($rowedit2['category_id']==$row2['id']){ ?>selected="selected" <?php } ?> ><?php echo $row2['category']; ?></option>
							<?php } ?>
					      </select>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						
					</table>
					
					
					
					<table width="500" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="4" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					<br /><?php */?>
					<div><strong>Spanish</strong></div>
					<br />
						<tr bgcolor="#E6E6E6">
						  <td colspan="4" height="20"><div align="center"><strong>Add Topic</strong></div></td>
					  </tr>
						<tr>
						  <td width="57" class="gboldli">&nbsp;</td>
						  <td width="135"><a href="helptopic_category.php"></a></td>
						  <td width="270">&nbsp;</td>
						  <td width="18">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Name </td>
						  <td><label>
						    <input type="text" name="topicname3" value="<?php echo $rowedit3['topicname']; ?>" style="width:200px;"/>
						  </label></td>
						  <td><label></label></td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Topic Link </td>
						  <td><label>
						    <input type="text" name="topiclink3" value="<?php echo $rowedit3['topic_link']; ?>" style="width:200px;"/>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td>Category</td>
						  <td><label>
						    <select name="category3">
							<?php while($row3=mysqli_fetch_assoc($sqlget3)){ ?>
							<option value="<?php echo $row3['id']; ?>" <?php if($rowedit3['category_id']==$row3['id']){ ?>selected="selected" <?php } ?> ><?php echo $row3['category']; ?></option>
							<?php } ?>
					      </select>
						  </label></td>
						  <td>&nbsp;</td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						
					</table>
					<tr>
						  <td colspan="4" align="center"><label>
						    <input type="submit" name="Submit" value="Submit"  />
						  </label></td>
						</tr>
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