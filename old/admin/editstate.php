<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$mcat=$_REQUEST['mcat'];
	$subcat=$_REQUEST['scat'];
	
	$result=mysqli_query($con,"select * from state where s_id='$subcat'");
	$num=mysqli_num_rows($result);
	$final=mysqli_fetch_array($result);
	$categoryname=$final['state_name'];
	$cid=$final['cou_id'];
	
if(isset($_REQUEST['editcat']))
{
$cat=$_REQUEST['cat'];
$subcategory=$_REQUEST['category'];

//echo "update state set cou_id='$cat', state_name='$subcategory' where s_id='$subcat'";exit;

mysqli_query($con,"update state set cou_id='$cat', state_name='$subcategory' where s_id='$subcat'");

header("location:state.php?catid=$mcat&edited");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function editval()
{
if(document.editcat.cat.value=="")
{
 alert("Please Select The Country");
 document.editcat.cat.focus();
 return false;
}
if(document.editcat.category.value=="")
{
 alert("Plese Enter The State");
 document.editcat.category.focus();
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
		<header><h3 class="tabs_involved">Edit State</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form action="" method="post" name="editcat" onsubmit="return editval();">
					<table width="80%" height="147" align="center">
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Country Name</strong></td>
						  	<td width="179"><select name="cat" id="cat">
                            <option value="">Select Country</option>
                          <?PHP 
					      $res=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$cid'"));
						  $catname=$res['country_name'];
						  $cat=mysqli_query($con,"select * from country");
						  while($catresult=mysqli_fetch_array($cat))
						  {
						
						  ?><option value="<?PHP echo $catresult['country_id'];?>" <?PHP if($catname==$catresult['country_name']) { ?> selected="selected" <?PHP } ?>> <?PHP echo $catresult['country_name'];  } ?></option>
                          </select></td>
						</tr>
						<tr>
						  <td height="71" class="inTxtNormal" style="font-size:12px;"><strong>State Name</strong></td>
						  <td>
							<input type="text" name="category" value="<?PHP echo $categoryname;?>"/>	
						</td></tr>
						<tr><td colspan="2" align="center"><input type="submit" name="editcat" value="Submit"  /></td></tr>
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