<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if($_REQUEST['action']=="del")
 {
  $delid=$_REQUEST['delid'];
  mysqli_query($con,"delete from super_deals where sd_id='$delid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Super Deals</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Category Deleted Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">Added Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Edited Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['deactive'])) { ?>
		<h4 class="alert_success">User Deactivated Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['active'])) { ?>
		<h4 class="alert_success">User Activated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Super Deals</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_superdeals.php" style="color:#009900;">Add New Super Deals</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="673" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="60" height="36">S.No</th> 
    				<th width="111">Product Image </th> 
					<th width="104">Product Name</th> 
					<th width="101">Orginal Rate</th>
					<th width="104">Current Rate</th>
					<th width="85">Min Order</th>
					<th width="92">Actions</th>
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="SELECT * FROM `super_deals` order by sd_id desc ";
			
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
			
			  while($array_in = mysqli_fetch_array($result))
			  {
			  $sdid=$array_in['sd_id'];
			  ?>
				<tr>
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $i; ?></td>
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
								  <?php if((file_exists($array_in['image'])) && ($array_in['image'] !='')) {?>
								  <img src="<?php echo $array_in['image'];?>" width="50" height="50" />
								   <?php } else {?>
								   <img src="../images/img_noimg.jpg" width="50" height="50" />
								   <?php }?>
								</td>
							
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['product_name'];?></td>
								
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['orginal_rate'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['current_rate'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['minimum_order'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
								<!--<a href=""><img src="images/view4.png" style="width:20px; height:20px;" /></a>-->
								<a href="add_superdeals.php?editid=<?PHP echo $sdid;?>"><img src="images/images.jpg" style="width:17px; height:17px;" /></a>
								<a href="admin_superdeals.php?action=del&delid=<?PHP echo $sdid;?>" onclick="javascript:if(confirm('Are you sure you wish to Delete this Record?')) { return true; } else { return false; };">
                                 <img  src="../images1/delete.jpg" name="imageField2" border="0" />
                                </a></td>
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