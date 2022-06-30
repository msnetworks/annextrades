<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$result=mysqli_query($con,"delete from featureproducts where bstatus='banner' and id='$id'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Banner View</a></article>
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
		<header><h3 class="tabs_involved">Banner View</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="createbanner.php" style="color:#009900;">Add New Banner</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="searchform" action="" method="post" enctype="multipart/form-data">
			<table width="100%" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<!--<th width="33">S.No</th> -->
    				<th width="70">Image</th> 
					<th width="80">Product</th> 
					<th width="74">Company</th>
					<th width="147">Country</th>
					<th width="69">City</th>
					<th width="76">Actions</th>
				</tr> 
			</thead> 
			<tbody> 
			
			<?php
				  $sr=mysqli_query($con,"select * from featureproducts where bstatus='banner'");
				  if(mysqli_num_rows($sr)>0) {
				  while($fetch=mysqli_fetch_array($sr))
				  {
				  $cou=$fetch['country'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];
				  ?>
				<tr>
                                <?php /*?><td><?php echo $i; ?></td><?php */?>
                                <td>
								  <?php 
					 if($fetch['f_pdt_images'] != '')
					 {
					    $filename = "picture/".$fetch['f_pdt_images'] ;
					    if(!file_exists($filename))
						{ ?>
						<img src="<?php echo "../images1/nobanner.png";?>" border="0" alt="No Banner" title="No Banner" width="75" height="75" />
					 <?php	}else{ ?>
						<img src="<?php echo "picture/".$fetch['f_pdt_images'];?>" border="0" width="75" height="75" />
					<?php	}
					  
					 }else{
					 
					 }					
					?> 
								</td>
							
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $fetch['f_pdt_name'];?></td>
								
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $fetch['companyname'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $row_country['country_name'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $fetch['city'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
								<!--<a href=""><img src="images/view4.png" style="width:20px; height:20px;" /></a>-->
								<a href="banneredit.php?id=<?php echo $fetch['id'];?>" class="news"><img src="images/images.jpg" style="width:17px; height:17px;" /></a>
								<a href="bannerview.php?id=<?php echo $fetch['id'];?>" class="news" onclick="return confirm('Are you sure you wish to Delete this Record?');">
                                 <img  src="../images1/delete.jpg" name="imageField2" border="0" />
                                </a></td>
              </tr> 
				
				 <?php
				 } } else {
				 ?>
                  <tr>
				<td class="redbold" align="center" colspan="6">No Banners Found</td>
				</tr>
				<?php } ?>
				<tr align="right"> 
   					
					<td colspan="8" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px;"><?php echo  $pagingLink;?></div></td> 
    				
				</tr>   
			</tbody> 
			</table>
			</form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>

</html>