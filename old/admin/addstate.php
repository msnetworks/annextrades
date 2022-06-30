<?php 
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if(isset($_REQUEST['add_sub']))
	{
	 $country=$_REQUEST['country'];
	 $state=$_REQUEST['state'];
	 $state=mysqli_real_escape_string($con, $_REQUEST['state']);
$state1=mysqli_real_escape_string($con, $_REQUEST['state1']);
$state2=mysqli_real_escape_string($con, $_REQUEST['state2']);
$state3=mysqli_real_escape_string($con, $_REQUEST['state3']);
	 //echo "insert into state (state_name, cou_id) values('$state','$country')";exit;
	 
	 mysqli_query($con,"insert into state (state_name, cou_id) values('$state','$country')");
	 
	 mysqli_query($con,"insert into state_french (state_name, cou_id) values('$state1','$country')");
	 
	 //mysqli_query($con,"insert into state_chinese (state_name, cou_id) values('$state2','$country')");
	 
	 mysqli_query($con,"insert into state_spanish (state_name, cou_id) values('$state3','$country')");
	 
	 header("location:state.php?catid=$country&suss");
	 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function addsubval()
{
if(document.addsubcat.country.value=="")
{
 alert("Please Select The Country");
 document.addsubcat.country.focus();
 return false;
}
if(document.addsubcat.state.value=="")
{
 alert("Plese Enter The State Name");
 document.addsubcat.state.focus();
 return false;
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="country.php"><b>Country Management</b></a></article>
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
		<header><h3 class="tabs_involved">Add New State</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="addsubcat" action="" method="post" onsubmit="return addsubval();">
					<table width="80%" height="254" align="center">
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Country Name</strong></td>
						  	<td width="179"><select name="country" id="country">
						  <option value="">Select Country</option>
						  <?PHP 
						  $cat=mysqli_query($con,"select * from country");
						  while($catresult=mysqli_fetch_array($cat))
						  {
						  ?>
						  <option value="<?PHP echo $catresult['country_id'];?>" <?php if($_REQUEST['cid']==$catresult['country_id']) {?> selected="selected" <?php } ?>><?PHP echo $catresult['country_name']; }?></option>
						  
						    </select></td>
						</tr>
						<tr>
						  <td height="52" class="inTxtNormal" style="font-size:12px;"><strong>State Name&nbsp;&nbsp;(English)</strong></td>
						  <td>
							<input name="state" type="text" id="state" />	
						</td></tr>
						<tr>
						  <td height="44" class="inTxtNormal" style="font-size:12px;"><strong>State Name&nbsp;&nbsp;(French)</strong></td>
						  <td>
							<input name="state1" type="text" id="state1" />	
						</td></tr>
						<?php /*?><tr>
						  <td height="47" class="inTxtNormal" style="font-size:12px;"><strong>State Name&nbsp;&nbsp;(Chinese)</strong></td>
						  <td>
							<input name="state2" type="text" id="state2" />	
						</td></tr><?php */?>
						<tr>
						  <td height="45" class="inTxtNormal" style="font-size:12px;"><strong>State Name&nbsp;&nbsp;(Spanish)</strong></td>
						  <td>
							<input name="state3" type="text" id="state3" />	
						</td></tr>
						<tr><td colspan="2" align="center"><input name="add_sub" type="submit" id="add_sub" value="Submit" /></td></tr>
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