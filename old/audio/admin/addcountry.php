<?php include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$result=mysqli_query($con,"select * from forumheading where parentid='0'");
	
	if(isset($_REQUEST['country']))
	{
	  $countryname=mysqli_real_escape_string($con, $_REQUEST['countryname']);
	  $countryname1=mysqli_real_escape_string($con, $_REQUEST['countryname1']);
	  $countryname2=mysqli_real_escape_string($con, $_REQUEST['countryname2']);
	  $countryname3=mysqli_real_escape_string($con, $_REQUEST['countryname3']);
	  $countrycode=$_REQUEST['country_code'];
	  $countrycodenumber=$_REQUEST['country_codenumber'];
	  $countryflag=$_REQUEST['country_flag'];
	  
	  $filename=basename($_FILES['country_flag']['name']);
	  $tmpfilename=$_FILES['country_flag']['tmp_name'];
	  $uploadpath1="../flags/".$filename;
   	  move_uploaded_file($tmpfilename,$uploadpath1); 		
	  
	  //echo "insert into country (country_code, country_codenumber, country_name, country_flag) values('$countrycode','$countrycodenumber', '$countryname', '$filename')";
	  
	  mysqli_query($con,"insert into country (country_code, country_codenumber, country_name, country_flag) values('$countrycode','$countrycodenumber', '$countryname', '$filename')");
	  
	  mysqli_query($con,"insert into country_french (country_code, country_codenumber, country_name, country_flag) values('$countrycode','$countrycodenumber', '$countryname1', '$filename')");
	  
	  //mysqli_query($con,"insert into country_chinese (country_code, country_codenumber, country_name, country_flag) values('$countrycode','$countrycodenumber', '$countryname2', '$filename')");
	  
	  mysqli_query($con,"insert into country_spanish (country_code, country_codenumber, country_name, country_flag) values('$countrycode','$countrycodenumber', '$countryname3', '$filename')");
	 
	 header("location:country.php?added");
	 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validation()
{
 if(document.addcountry.countryname.value=="")
 {
  alert("Please Enter The Country Name");
  document.addcountry.countryname.focus();
  return false;
 }
if(document.addcountry.country_code.value=="")
 {
  alert("Please Enter The Country Code");
  document.addcountry.country_code.focus();
  return false;
 }
if(document.addcountry.country_flag.value!="")
{
var str = document.addcountry.country_flag.value.substring(document.addcountry.country_flag.value.indexOf('.'));
if(str=='.jpg'||str=='.gif' || str=='.jpeg'){
return true;
}else{
alert("Upload only jpg, jpeg and gif");
//document.photo.attachfile1.value="";
//document.photo.attachfile1.focus();
return false;
}
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
		<header><h3 class="tabs_involved">Add New Country</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="addcountry" action="" method="post" enctype="multipart/form-data" onsubmit="return validation();">
					<table width="80%" height="204" align="center">
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(English)</strong></td>
						  	<td width="179"><input type="text" name="countryname" id="countryname" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(French)</strong></td>
						  	<td width="179"><input type="text" name="countryname1" id="countryname1" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<?php /*?><tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="179"><input type="text" name="countryname2" id="countryname2" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr><?php */?>
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="179"><input type="text" name="countryname3" id="countryname3" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						<tr>
							<td width="108" height="43" class="inTxtNormal" style="font-size:12px;"><strong>Country Code</strong></td>
						  	<td width="179"><input type="text" name="country_code" id="country_code" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Country Code Number</strong></td>
						  	<td width="179"><input type="text" name="country_codenumber" id="country_codenumber" class="inTxtNormal" style="width:200px; height:18px;"/></td>
						</tr>
						
						<tr>
							<td width="108" height="46" class="inTxtNormal" style="font-size:12px;"><strong>Country Flag Image</strong></td>
						  	<td width="179"><input type="file" name="country_flag" id="country_flag" /></td>
						</tr>
						
						<tr><td colspan="2" align="center"><input type="submit" name="country" value="Submit" /></td></tr>
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