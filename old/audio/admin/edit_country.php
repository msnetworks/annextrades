<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$cateid=$_REQUEST['catid'];
	//echo "select * from category where c_id='$cateid'";exit;
	$result=mysqli_query($con,"select * from country where country_id='$cateid'");
	$num=mysqli_num_rows($result);
	$final=mysqli_fetch_array($result);
	
	$result1=mysqli_query($con,"select * from country_french where country_id='$cateid'");
	$num1=mysqli_num_rows($result1);
	$fin=mysqli_fetch_array($result1);
	
	//$result2=mysqli_query($con,"select * from country_chinese where country_id='$cateid'");
	//$num2=mysqli_num_rows($result2);
	//$final2=mysqli_fetch_array($result2);
	
	$result3=mysqli_query($con,"select * from country_spanish where country_id='$cateid'");
	$num3=mysqli_num_rows($result3);
	$final3=mysqli_fetch_array($result3);
	
	$countryflags=$final['country_flag'];
	
if(isset($_REQUEST['Submit']))
{
$countryname=mysqli_real_escape_string($con, $_REQUEST['countryname']);
$countryname1=mysqli_real_escape_string($con, $_REQUEST['countryname1']);
$countryname2=mysqli_real_escape_string($con, $_REQUEST['countryname2']);
$countryname3=mysqli_real_escape_string($con, $_REQUEST['countryname3']);
$countrycode=$_REQUEST['countrycode'];
$countrycodenumber=$_REQUEST['countrycodenumber'];

	$filename=basename($_FILES['countryflag']['name']);
	$tmpfilename=$_FILES['countryflag']['tmp_name'];
	$uploadpath1="../flags/".$filename;
   	move_uploaded_file($tmpfilename,$uploadpath1); 		

if($filename!="")
{
$countryflag=$filename;
}
else
{
$countryflag=$countryflags;
}

//echo "update country set country_name='$countryname', country_code='$countrycode', country_codenumber='$countrycodenumber', country_flag='$countryflag' where country_id='$cateid'";exit;
$query="update country set country_name='$countryname',country_code='$countrycode',country_codenumber='$countrycodenumber', country_flag='$countryflag' where country_id='$cateid'";

$query1="update country_french set country_name='$countryname1',country_code='$countrycode',country_codenumber='$countrycodenumber', country_flag='$countryflag' where country_id='$cateid'";

//$query2="update country_chinese set country_name='$countryname2',country_code='$countrycode',country_codenumber='$countrycodenumber', country_flag='$countryflag' where country_id='$cateid'"; 

$query3="update country_spanish set country_name='$countryname3',country_code='$countrycode',country_codenumber='$countrycodenumber', country_flag='$countryflag' where country_id='$cateid'";

mysqli_query($con,$query);
mysqli_query($con,$query1);
mysqli_query($con,$query2);
mysqli_query($con,$query3);

header("location:country.php?edited");
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
 if(document.editcat.countryname.value=="")
 {
  alert("Please Enter The Country Name");
  document.editcat.countryname.focus();
  return false;
 }
if(document.editcat.countrycode.value=="")
 {
  alert("Please Enter The Country Code");
  document.editcat.countrycode.focus();
  return false;
 }
if(document.editcat.countryflag.value!="")
{
var str = document.editcat.countryflag.value.substring(document.editcat.country_flag.value.indexOf('.'));
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
		<header><h3 class="tabs_involved">Edit Country</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form action="" method="post" name="editcat" enctype="multipart/form-data" onsubmit="return validation();">
					<table width="80%" height="204" align="center">
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name &nbsp;&nbsp;(English)</strong></td>
						  	<td width="179"><input type="text" name="countryname" id="countryname" style="width:200px; height:18px;" value="<?PHP echo $final['country_name'];?>"/></td>
						</tr>
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name &nbsp;&nbsp;(French)</strong></td>
						  	<td width="179"><input type="text" name="countryname1" id="countryname1" style="width:200px; height:18px;" value="<?PHP echo $fin['country_name'];?>"/></td>
						</tr>
						<?php /*?><tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(Chinese)</strong></td>
						  	<td width="179"><input type="text" name="countryname2" id="countryname2" style="width:200px; height:18px;" value="<?PHP echo $final2['country_name'];?>"/></td>
						</tr><?php */?>
						<tr>
							<td width="108" height="37" class="inTxtNormal" style="font-size:12px;"><strong>Country Name&nbsp;&nbsp;(Spanish)</strong></td>
						  	<td width="179"><input type="text" name="countryname3" id="countryname3" style="width:200px; height:18px;" value="<?PHP echo $final3['country_name'];?>"/></td>
						</tr>
						<tr>
							<td width="108" height="43" class="inTxtNormal" style="font-size:12px;"><strong>Country Code</strong></td>
						  	<td width="179"><input type="text" name="countrycode" id="countrycode" style="width:200px; height:18px;" value="<?PHP echo $final['country_code'];?>"/></td>
						</tr>
						
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Country Code Number</strong></td>
						  	<td width="179"><input type="text" name="countrycodenumber" id="countrycodenumber" style="width:200px; height:18px;" value="<?PHP echo $final['country_codenumber'];?>"/></td>
						</tr>
						
						<tr>
							<td width="108" height="46" class="inTxtNormal" style="font-size:12px;"><strong>Country Flag Image</strong></td>
						  	<td width="179"><input type="file" name="countryflag" id="countryflag" value="<?PHP echo $final['country_flag'];?>" /></td>
						</tr>
						
						<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="Submit" /></td></tr>
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