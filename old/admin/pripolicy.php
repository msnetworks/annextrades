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
	$sqlget=mysqli_query($con,"SELECT * FROM general");
	$row=mysqli_fetch_assoc($sqlget);
	if(isset($_REQUEST['mode']))
	{
		$mode = $_REQUEST['mode'];
	}
	
	if($mode == "privacy"){
		$title = "Privacy Policy";
		$name = "policy";
		$content = stripslashes($row['pripolicy']);
		
	}else if($mode == "terms"){
		$title = "Terms of Use";
		$name = "terms";
		$content = stripslashes($row['terms']);
		
	}else if($mode == "about"){
		$title = "About Us";
		$name = "about";
		$content = stripslashes($row['about']);
		
		
	}else{
		$title = "Privacy Policy";
		$name = "policy";
		$content = stripslashes($row['pripolicy']);
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
if(document.pripolicy.policy.value=="")
{
alert('Enter Content');
document.pripolicy.policy.focus();
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
					<table width="98%" align="center" cellspacing="0" style="border:solid 1px #669966;">
				<tr>
				  <td height="27" bgcolor="#669966" class="adminheading">&nbsp;&nbsp;<strong>Add <?php echo $title;?></strong> </td>
				</tr>
				<?php
					if($mode == "privacy"){
				?>
				<tr>
				  <td height="27" align="center"><table width="256">
				    <tr><td><a href="pripolicy.php" class="gboldli">privacy policy</a></td><td><a href="protecting_help.php" class="gboldli">protecting</a></td></tr></table></td>
				</tr>
				<?php
					}
				?>
				<tr><td valign="top">
					<form name="pripolicy" action="./contentpro.php?mode=<?php echo $mode;?>" method="POST" onsubmit="return validation();">
					<table width="299" height="70" align="center" style="border:1px solid #D8F1E4;">
						<?php if($_SESSION['suc_cont'] != ""){ ?>
						<tr>
						  <td colspan="2" align="center" class="style1">
						  	<?php
								echo $_SESSION['suc_cont'];
								$_SESSION['suc_cont'] = "";
						  	?>
						  </td>
					  </tr>
					  <?php } ?>
					
						<tr bgcolor="#D8F1E4">
						  <td colspan="2"><div align="center"><strong> <?php echo $title;?> </strong> </div></td>
					  </tr>
						<tr>
						  <td width="22" class="gboldli">&nbsp;</td>
						  <td width="265">&nbsp;</td>
					  </tr>
						
						<tr>
						  <td class="gboldli">&nbsp;</td>
						  <td><label>
						    <textarea name="<?php echo $name;?>"><?php echo $content; ?></textarea>
						  </label></td>
					  </tr>
						<tr><td class="gboldli">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr><td colspan="2" align="center"><input type="submit" name="mode" value="Submit" /></td></tr>
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