<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$subcategory=$_POST['ddlcategory'];
	$cateid=$_REQUEST['catid'];
	//$id=$_REQUEST['catid'];
	
	if($_REQUEST['cid']!="")
	{
		$cateid=$_REQUEST['catid'];
		$cid=$_REQUEST['cid'];
		//echo "select * from category where parent_id='$cateid' order by category $cid";exit;
		$select="select * from category where parent_id='$cateid' order by category $cid";
	}
	else
	{
		//echo "select * from category where parent_id='$cateid' order by category asc";exit;
		$select="select * from category where parent_id='$cateid' order by category asc";
	}
	 /*$strget="catid=$cateid&cid=$cid";
              $rowsPerPage =15;
              $query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
              $pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
			  $num=mysqli_num_rows($query);*/
	
	if($_REQUEST['id'])
	{
	  $cidd=$_REQUEST['cid'];
	  $delid=$_REQUEST['id'];
	  $delse=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$delid'"));
	  $paid=$delse['parent_id'];
	 // echo "delete from category where c_id='$delid'";exit;
	  mysqli_query($con,"delete from category where c_id='$delid'");
	  header("location:sub_category.php?catid=$paid&cid=$cidd");
	}
	
	if(isset($_REQUEST['delete']))
	{
		$del=$_REQUEST['delete'];
		$delete=mysqli_query($con,"delete from category where c_id='$del' ");
		$delete=mysqli_query($con,"delete from category_french where c_id='$del' ");
		//$delete=mysqli_query($con,"delete from category_chinese where c_id='$del' ");
		$delete=mysqli_query($con,"delete from category_spanish where c_id='$del' ");
		if($delete)
		{
			header("location:category.php?deleted");
			//header("location:sub_category.php?catid=$cateid&deleted");
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
function confirm_delete()
{
	if(confirm('Are you sure want to delete this record?'))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div><a href="category.php">Category</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Sub Category Deleted Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">New Sub Category Added Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['failed'])) { ?>
		<h4 class="alert_success">Sub Category Already Exist</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Category Edited Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['deactive'])) { ?>
		<h4 class="alert_success">User Deactivated Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['active'])) { ?>
		<h4 class="alert_success">User Activated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<?php 
			$sel=mysqli_query($con,"select * from category where c_id='$cateid' ");
			$array=mysqli_fetch_array($sel);
		?>
		<header><h3 class="tabs_involved"><?php echo $array['category']; ?></h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_subcategory.php?cat=<?php echo $_REQUEST['catid']; ?>" style="color:#009900;">New Sub Category</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="431" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="62" height="35">S.No</th> 
    				<th width="217">Sub Category Name</th> 
					<th width="144">Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="select * from category where parent_id='$cateid' order by category asc";
			
			$strget="";

$result=mysqli_query($con,getPagingQuery1($sql, $rowsPerPage,$strget)) or die(mysqli_error($con));
$pagingLink = getPagingLink1($sql, $rowsPerPage,$strget); 


 if(isset($_REQUEST['page']))
					{
						$i=(($_REQUEST['page'] -1) *20 )+1;
					}
					else
					{
						
						$i=1;
					}	
$count = mysqli_num_rows($result);
if($count>0)
{
			
			  while($sel_cou = mysqli_fetch_array($result))
			  {
			  ?>
				<tr> 
   					<td height="43"><?php echo $i; ?></td>
					<td nowrap="nowrap"><b><?php echo $sel_cou['category']; ?></b></td>
					<td nowrap="nowrap"><a href="edit_subcategory.php?mcat=<?php echo $cateid; ?>&scat=<?php echo $sel_cou['c_id']; ?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a>
					&nbsp;&nbsp;<a href="sub_category.php?delete=<?php echo $sel_cou['c_id']; ?>" onclick="return confirm_delete();"><img src="images/delete2.jpg" /></a></td>
				</tr> 
				
				<?php $i++; } } 
				else { 
				?> 
				<tr> 
   					<td colspan="8" align="center" style="color:#000099;"><b>No records found....</b></td> 
    				
				</tr> 
				
				<?php } ?>
				<tr align="right"> 
   					
					<td colspan="8" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px;"><?php echo  $pagingLink;?></div></td> 
    				
				</tr>
				<tr><td colspan="3" align="center"><a href="javascript:history.back(-1);"><input type="submit" name="submit" value="Back"  /></a></td></tr>   
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>

</html>