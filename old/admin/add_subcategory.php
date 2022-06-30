<?php 
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$id=$_REQUEST['cat'];
	//echo $id; exit;
	if(isset($_REQUEST['add_sub']))
	{
		$cateid=$_REQUEST['catid'];
		$cid=$_REQUEST['cid'];
	    $category=mysqli_real_escape_string($con, $_REQUEST['cat']);
	    $subcat=mysqli_real_escape_string($con, $_REQUEST['subcat']);
	    $subcat1=mysqli_real_escape_string($con, $_REQUEST['subcat1']);
	    $subcat2=mysqli_real_escape_string($con, $_REQUEST['subcat2']);
		$subcat3=mysqli_real_escape_string($con, $_REQUEST['subcat3']);
		$count=mysqli_num_rows(mysqli_query($con,"select * from category where category='$subcat' and parent_id='$category'"));
		if($count>0)
		{
			header("location:sub_category.php?catid=$id&failed");
		} else {
	  //echo "insert into category (category,parent_id) values('$subcat','$category')";exit;
	 mysqli_query($con,"insert into category (category,parent_id) values('$subcat','$category')");
	  mysqli_query($con,"insert into category_french (category,parent_id) values('$subcat1','$category')");
	 //  mysqli_query($con,"insert into category_chinese (category,parent_id) values('$subcat2','$category')");
	   mysqli_query($con,"insert into category_spanish (category,parent_id) values('$subcat3','$category')");
	 //header("location:category.php?added");
	 header("location:sub_category.php?catid=$id&added");
		}
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
if(document.addsubcat.cat.value=="")
{
 alert("Please Select The Category");
 document.addsubcat.cat.focus();
 return false;
}
if(document.addsubcat.subcat.value=="")
{
 alert("Plese Enter The Subcategory Name");
 document.addsubcat.subcat.focus();
 return false;
}  
if(document.addsubcat.subcat1.value=="")
{
 alert("Plese Enter The Subcategory Name");
 document.addsubcat.subcat1.focus();
 return false;
}  
if(document.addsubcat.subcat2.value=="")
{
 alert("Plese Enter The Subcategory Name");
 document.addsubcat.subcat2.focus();
 return false;
} 
if(document.addsubcat.subcat3.value=="")
{
 alert("Plese Enter The Subcategory Name");
 document.addsubcat.subcat3.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="category.php"><b>Category</b></a></article>
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
		<header><h3 class="tabs_involved">Add New Sub Category</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="addsubcat" action="" method="post" onsubmit="return addsubval();">
					<input type="hidden" name="catid" id="catid" value="<?php echo $_REQUEST['catid']; ?>" />
					<table width="80%" height="188" align="center">
						<?php /*?><tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Category Name</strong></td>
						  	<td width="179"><select name="cat" id="cat" >
						  <option value="">Select Category</option>
						  <?PHP 
						  $cat=mysqli_query($con,"select * from category where parent_id=''");
						  while($catresult=mysqli_fetch_array($cat))
						  {
						  ?>
						  <option value="<?PHP echo $catresult['c_id'];?>"><?PHP echo $catresult['category']; }?></option>
						  </select></td>
						</tr><?php */?>
						<tr>
							<td width="108" class="inTxtNormal" style="font-size:12px;"><strong>Category Name</strong></td>
						  	<td width="179"><select name="cat" id="cat">
						  <option value="">Select Category</option>
						  <?php 
	                   $sel=mysqli_query($con,"SELECT * FROM category WHERE parent_id=''");
		
							while($array=mysqli_fetch_array($sel))
							{
						  ?>
						  <option value="<?php echo $array['c_id']; ?>" <?php if($_REQUEST['cat']==$array['c_id']) { ?> selected="selected"<?php } ?>><?php echo $array['category']; ?></option>
						  <?php } ?>
						  </select></td>
						</tr>
						
						<tr>
						  <td height="44" class="inTxtNormal" style="font-size:12px;"><strong>Subcategory Name&nbsp;&nbsp;(English)</strong></td>
						  <td>
							<input name="subcat" type="text" id="subcat" />
						</td></tr>
						<tr>
						  <td height="36" class="inTxtNormal" style="font-size:12px;"><strong>Subcategory Name&nbsp;&nbsp;(French)</strong></td>
						  <td>
							<input name="subcat1" type="text" id="subcat1" />
						</td></tr>
						
						<tr>
						  <td height="44" class="inTxtNormal" style="font-size:12px;"><strong>Subcategory Name&nbsp;&nbsp;(Spanish)</strong></td>
						  <td>
							<input name="subcat3" type="text" id="subcat3" />
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