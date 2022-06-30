<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	//$category=$_REQUEST['ddlcategory'];
	$cid=$_REQUEST['cid'];
	
	if($_REQUEST['cid']!="")
	{
		$cid=$_REQUEST['cid'];
		$select="select * from category where parent_id='' order by category $cid";
	}
	else
	{
		$select="select * from category where parent_id='' order by category asc";
	}	
	/*$strget="cid=$cid";
              $rowsPerPage =15;
              $query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
              $pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
			  $num=mysqli_num_rows($query);*/
	
	/*if(isset($_GET['del']))
	{
		$cid=$_REQUEST['catid'];
		mysqli_query($con,"delete from category where c_id='$cid'");
		header("location:category.php");
	}*/
	
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Manage Category</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Category Deleted Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">Category Added Successfully</h4>
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
		<header><h3 class="tabs_involved">Category Management</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="addcategory.php" style="color:#009900;">New Category</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="500" cellspacing="0" class="tablesorter"> 
			<thead> 
				<tr> 
   					<th width="46">S.No</th> 
    				<th width="202">Category Name</th> 
					<th width="125">Image</th>
					<th width="125">Subcategory</th>
					<th width="117">Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="select * from category where parent_id='' order by category asc";
			
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
			  $cid=$sel_cou['c_id'];
			  ?>
				<tr> 
					<?php /*?><td>
								  <?php if((file_exists($array_in['image'])) && ($array_in['image'] !='')) {?>
								  <img src="<?php echo $array_in['image'];?>" width="50" height="50" />
								   <?php } else {?>
								   <img src="../images/img_noimg.jpg" width="50" height="50" />
								   <?php }?>
								</td><?php */?>
								
								<?php /*?><tr >
							<?php 
								if($details['sell_image'] == "")
								{ ?>
								
								<td align="left" style="padding-left:15px;" ><img src="upload/no_image/no_image.jpeg" width="120" height="89" style="margin-top:20px;" /></td>
								
							<?php } else {?>
                              <td align="left" style="padding-left:15px;" ><img src="upload/site_image/<?php echo $details['sell_image']; ?>" width="120" height="89" style="margin-top:20px;" /></td>
							<?php } ?>
                            </tr><?php */?>
							
   					<td><?php echo $i; ?></td>
					<?php /*?><td nowrap="nowrap"><a href="forumsubcategory.php?cid=<?php echo $sel_cou['id'];?>" style="color:#009900;"><b><?php echo $sel_cou['mainheading']; ?></b></a></td><?php */?>
					<td nowrap="nowrap"><a href="sub_category.php?catid=<?php echo $cid; ?>"><b style="color:#000099;"><?php echo $sel_cou['category']; ?></b></a></td>
					<?php if($sel_cou['cat_image'] == "") { ?>
					<td><img src="../images/img_noimg.jpg" width="50" height="50" /></td>
					<?php } else { ?>
					<td><img src="category_images/<?php echo $sel_cou['cat_image']; ?>" width="50" height="50" /></td>
					<?php } ?>
					<td nowrap="nowrap"><a href="sub_category.php?catid=<?php echo $cid; ?>"><b style="color:#047AB6;">Subcategory</b></a></td>
					<td nowrap="nowrap"><a href="edit_category.php?catid=<?php echo $cid; ?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a>
					&nbsp;&nbsp;<a href="category.php?delete=<?php echo $sel_cou['c_id']; ?>" onclick="return confirm_delete();"><img src="images/delete2.jpg" /></a></td>
				</tr> 
				
				<?php $i++; } } 
				else { 
				?> 
				<tr> 
   					<td colspan="8" align="center">No records found....</td> 
				</tr> 
				
				<?php } ?>
				<tr align="right"> 
   					
					<td colspan="8" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px;"><?php echo  $pagingLink;?></div></td> 
    				
				</tr>   
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