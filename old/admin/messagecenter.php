<?php 
session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$sqlget=mysqli_query($con,"SELECT `messagecenter` FROM general");
	$sqlget1=mysqli_query($con,"SELECT `messagecenter` FROM general_french");
	//$sqlget2=mysqli_query($con,"SELECT `messagecenter` FROM general_chinese");
	$sqlget3=mysqli_query($con,"SELECT `messagecenter` FROM general_spanish");
	
	$row=mysqli_fetch_assoc($sqlget);
	$row1=mysqli_fetch_assoc($sqlget1);
	$row2=mysqli_fetch_assoc($sqlget2);
	$row3=mysqli_fetch_assoc($sqlget3);
	
	if(isset($_REQUEST['submit']))
	{
		//$messagecenter = addslashes($_POST['messagecenter']);
		$messagecenter=mysqli_real_escape_string($con, $_POST['messagecenter']);
		$messagecenter1=mysqli_real_escape_string($con, $_POST['messagecenter1']);
		$messagecenter2=mysqli_real_escape_string($con, $_POST['messagecenter2']);
		$messagecenter3=mysqli_real_escape_string($con, $_POST['messagecenter3']);
		
		$sqll=mysqli_query($con,"SELECT messagecenter FROM general");
		$sqll1=mysqli_query($con,"SELECT messagecenter FROM general_french");
		//$sqll2=mysqli_query($con,"SELECT messagecenter FROM general_chinese");
		$sqll3=mysqli_query($con,"SELECT messagecenter FROM general_spanish");
		
		$check=mysqli_num_rows($sqll);
		$check1=mysqli_num_rows($sqll1);
		$check2=mysqli_num_rows($sqll2);
		$check3=mysqli_num_rows($sqll3);
		
		/*if($check > 0){
			$sql=mysqli_query($con,"UPDATE general SET messagecenter = '$messagecenter'");
		}else{
			$sql=mysqli_query($con,"INSERT INTO general(messagecenter) values ('$messagecenter')");
		}*/
		
		if(($check > 0) && ($check1 > 0) && ($check2 > 0) && ($check3 > 0)){
			$sql=mysqli_query($con,"UPDATE general SET `messagecenter`='$messagecenter'");
			$sql=mysqli_query($con,"UPDATE general_french SET `messagecenter`='$messagecenter1'");
			//$sql=mysqli_query($con,"UPDATE general_chinese SET `messagecenter`='$messagecenter2'");
			$sql=mysqli_query($con,"UPDATE general_spanish SET `messagecenter`='$messagecenter3'");
			}else{
			$sql=mysqli_query($con,"INSERT INTO general(`messagecenter`)value('$messagecenter')");
			$sql=mysqli_query($con,"INSERT INTO general_french(`messagecenter`)value('$messagecenter1')");
			//$sql=mysqli_query($con,"INSERT INTO general_chinese(`messagecenter`)value('$messagecenter2')");
			$sql=mysqli_query($con,"INSERT INTO general_spanish(`messagecenter`)value('$messagecenter3')");
			}
		header("Location:messagecenter.php?updated");
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
tinyMCE.triggerSave();
if(document.message_center.messagecenter.value=="")
{
alert('Enter Content');
document.message_center.messagecenter.focus();
return false;
}
}

	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,indent,blockquote,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		/*theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",*/
		/*theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",*/
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

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
		<?php if(isset($_REQUEST['updated'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Message Center</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
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
					<form name="message_center" action="" method="post" onsubmit="return validation();">
					<table width="299" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="2" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					  <div><strong>English</strong></div>
						<tr bgcolor="#E6E6E6">
						  <td colspan="2" height="20"><div align="center"><strong>Message Center</strong></div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="265">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						    <textarea name="messagecenter"><?php echo $row['messagecenter']; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>-->
					</table>
                    
                    <table width="299" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="2" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					  <br />
					  <div><strong>French</strong></div>
						<tr bgcolor="#E6E6E6">
						  <td colspan="2" height="20"><div align="center"><strong>Message Center</strong></div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="265">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						    <textarea name="messagecenter1"><?php echo $row1['messagecenter']; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>-->
					</table>
                    
                    <table width="299" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="2" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					  <br />
					 <?php /*?> <div><strong>Chinese</strong></div>
						<tr bgcolor="#E6E6E6">
						  <td colspan="2" height="20"><div align="center"><strong>Message Center</strong></div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="265">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						    <textarea name="messagecenter2"><?php echo $row2['messagecenter']; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>-->
					</table><br />
					
					<table width="299" height="70" align="center" style="border:1px solid #E6E6E6;">
						<?php if(isset($_REQUEST['add'])=="suc"){ ?>
						<tr>
						  <td colspan="2" align="center" class="style1">Added Sucessfully!</td>
					  </tr>
					  <?php } ?>
					  <br /><?php */?>
					  <div><strong>Spanish</strong></div>
						<tr bgcolor="#E6E6E6">
						  <td colspan="2" height="20"><div align="center"><strong>Message Center</strong></div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="265">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						    <textarea name="messagecenter3"><?php echo $row3['messagecenter']; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<!--<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>-->
					</table><br />
                    <tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
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