<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$idd=$_REQUEST['id'];
	$sql=mysqli_fetch_array(mysqli_query($con,"select * from feedback where id='$idd'"));
	
	if(isset($_REQUEST['delid']))
	{
	$delid=$_REQUEST['delid'];
	
	$del=mysqli_query($con,"delete from feedback where id='$delid'");
	
	header("location:feedback.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 150,top = 234');");
}

function nextpage()
{
window.location.href="feedbackreplys.php?id=<?php echo $idd;?>";
}

function delpage()
{
var flag = confirm("Are you sure you wish to delete this Record?");
if(flag == true)
{
window.location.href="feedbackview.php?delid=<?php echo $idd;?>";
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Feedback</b></a></article>
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
		<header><h3 class="tabs_involved">Feedback View</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="searchform" action="" method="post">
			<table width="75%" align="center" cellspacing="0">
				
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td width="20%" height="28">&nbsp;</td><td width="12%">&nbsp;&nbsp;Name</td>
				<td width="68%" class="gbold"><b>:</b> <?php echo $sql['yourname'];?></td>
				</tr>
				<tr><td height="25">&nbsp;</td>
				<td>&nbsp;&nbsp;Email</td><td class="gbold"><b>:</b> <?php echo $sql['email'];?></td></tr>
				<tr><td height="25">&nbsp;</td>
				<td>&nbsp;&nbsp;Subject</td><td class="gbold"><b>:</b> <?php echo $sql['subject'];?></td></tr>
				<tr><td height="28">&nbsp;</td>
				<td>&nbsp;&nbsp;Message</td><td class="gbold"><b>:</b> <?php echo $sql['message'];?></td></tr>
				<tr><td>&nbsp;</td><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="3" align="center">
				<?php /*   <!--<a href="javascript:popUp1('feedbackreply.php?id=<?php //echo $idd;?>')"> --><input type="button" name="Submit" value="Reply" onclick="javascript:nextpage();"/> <!-- </a>   --> */?>
			  <!--<a href="javascript:popUp1('feedbackreply.php?id=<?php echo $idd;?>')">--><input type="button" name="Submit" value="Reply" onclick="javascript:nextpage();"/><!--</a>-->
			<!--<a href="feedbackview.php?delid=<?php echo $idd;?>" onclick="return confirm('Are you sure you wish to delete this Record?');">--><input type="button" name="Submit2" value="Delete" onclick="javascript:delpage();"/><!--</a>--> 
				 
				  <input type="button" name="Submit3" value="Back" onclick="javascript:history.back();"/></td></tr>
				  <tr><td colspan="3">&nbsp;</td></tr>
		  </table>
		  </form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>