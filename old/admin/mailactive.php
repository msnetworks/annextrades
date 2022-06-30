<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$today=date('Y-m-d');$today1=date('Y.m.d');
	//get today's details
	if(isset($_REQUEST['ok']))
{
 $accepted=$_REQUEST['mailact'];
   if($accepted=='on')
 {
 $update=mysqli_query($con,"update mailaccept set mailstatus='1'");
  header("location:mailactive.php?on123");
 }
 else
  {
  $update=mysqli_query($con,"update mailaccept set mailstatus='0'");
  header("location:mailactive.php?off123");
  }
}
?>

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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Mail Activation Method</a></article>
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
		<header><h3 class="tabs_involved">Mail Activation Method</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td height="150" valign="middle">
					<form name="chmail">
  <table width="98%" style="border:1px solid #fff;" align="right">
  <tr>
  <td></td>
  </tr>
  <tr>
  <td colspan="2" align="center" class="redbold"></td>
  </tr>
  <?php
  
  $fetch_st=mysqli_fetch_array(mysqli_query($con,"select * from `mailaccept`")); ?>
  <tr>
  <td width="36%" height="49" align="" class="gbold"><b>Enable Mail Activation</b></td>
  <td width="64%" class="text1"><input type="radio" name="mailact" <?php if($fetch_st['mailstatus']==1) { ?> checked="checked" <?php } ?>  value="on" />
  Yes
    <input type="radio" name="mailact" <?php if($fetch_st['mailstatus']==0) { ?> checked="checked" <?php } ?> value="off" />
    No
  </td>
  </tr>
  <tr>
  <td colspan="2" align="left" style="padding-left:300px" ><input type="submit" name="ok" value="Accept" class="but_PostProject" onclick="javascript:return checkvalidation();" /></td>
  </tr>
  <tr>
  <td height="21" align="left" class="gbold"><b>Mail Activation Status</b></td>
  <td  align="left" class="redbold" style="color:#FF0000;"><b>
  <?php 
  $sql_acc=mysqli_query($con,"select * from mailaccept");
  $sqlacc_fetch=mysqli_fetch_array($sql_acc);
   if($sqlacc_fetch['mailstatus']=='1')
   {
  ?>
  <span  style="color:#093;">Now Mail is activated</span>
  <?php } else {  ?>
  Now Mail is deactivated
  <?php } ?></b>
  </td>
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