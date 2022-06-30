<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$cid= addslashes(mysqli_real_escape_string($con, $_REQUEST['cid']));
	if(isset($_REQUEST['delete']))
	{
		$del=$_REQUEST['delete'];
		$delete=mysqli_query($con,"delete from forumheading where id='$del' ");
		$delete=mysqli_query($con,"delete from forumheading_french where id='$del' ");
		//$delete=mysqli_query($con,"delete from forumheading_chinese where id='$del' ");
		$delete=mysqli_query($con,"delete from forumheading_spanish where id='$del' ");
		if($delete)
		{
			header("location:forumsubcategory.php?cid=$cid&deleted");
		}
	}
?>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="forummanagement.php">Forum Category</a></article>
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
		
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Sub Category Details Edited Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['deactive'])) { ?>
		<h4 class="alert_success">User Deactivated Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['active'])) { ?>
		<h4 class="alert_success">User Activated Successfully</h4>
		<?php } ?>
		<?php
			$f=mysqli_fetch_array(mysqli_query($con,"select * from forumheading where id='$cid'"));
		?>
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved"><?php echo $f['mainheading'];?> Forum Subcategory</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="subcategory_add.php?cid=<?php echo $_REQUEST['cid']; ?>" style="color:#009900;">New Sub Category</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="700" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="79">S.No</th> 
    				<th width="290">Category</th> 
					<th width="190">Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php 
			$sql="select * from forumheading where parentid='$cid' order by mainheading asc";
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
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $i; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['mainheading']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="editforumsubcategory.php?cid=<?php echo $sel_cou['id']; ?>&id=<?php echo $_REQUEST['cid']; ?>"><img src="images/images (1).jpg" style="width:17px; height:17px;" /></a>
					&nbsp;&nbsp;<a href="forumsubcategory.php?delete=<?php echo $sel_cou['id']; ?>&cid=<?php echo $_REQUEST['cid']; ?>" onclick="return confirm_delete();"><img src="images/delete2.jpg" /></a></td>
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