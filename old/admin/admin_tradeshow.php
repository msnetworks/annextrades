<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if(isset($_REQUEST['disapp']))
   {
		 $Id=$_REQUEST['disapp'];
		mysqli_query($con,"update  tbl_tradeshow  set status=2 where show_id='$Id' ");
	}
  if(isset($_REQUEST['approve']))
   {
		$Id=$_REQUEST['approve'];
		mysqli_query($con,"update  tbl_tradeshow set status=1 where show_id='$Id'");
	}
	
if(isset($_REQUEST['delid']))
 {
  $delid=$_REQUEST['delid'];
  mysqli_query($con,"delete from tbl_tradeshow where show_id='$delid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Trade Shows</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Category Deleted Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">New Category Added Successfully</h4>
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
		<header><h3 class="tabs_involved">Trade Show</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_tradeshow.php" style="color:#009900;">Add New Trade Shows</a></h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="687" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="47">S.No</th> 
    				<th width="109">EventName </th> 
					<th width="152">Event start Date</th> 
					<th width="130">Event End Date</th>
					<th width="101">View Show</th>
					<th width="134">Actions</th>
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="SELECT * FROM `tbl_tradeshow`";
			
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
			  $showid=$array_in['show_id']; 
			  ?>
				<tr>
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $i; ?></td>
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $array_in['show_name'];?></td>
							
                                <td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['events_fromdate'];?></td>
								
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?PHP echo $array_in['events_todate'];?></td>
								<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="view_show1.php?sid=<?PHP echo $showid;?>" class="news"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
								<td width="134" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="edit_tradeshow.php?editid=<?PHP echo $showid;?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a>
								<?php
								$St=$array_in['status'];								 
								?>
                          
							 <?php
							 $stroyid = $array_in['show_id'];
							 if($St==1)
								 {
							 ?>
                              <a href="admin_tradeshow.php?disapp=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to Approve this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; color:#000099;"><b>Disapprove</b></a>
								<?php 
								} 
								else
								{
								?>
								<a href="admin_tradeshow.php?approve=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to Disapprove this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; color:#000099;"><b>Approve</b></a>
								<?php } ?>								
                                <a href="admin_tradeshow.php?delid=<?PHP echo $showid;?>" onclick="return confirm('Are you sure you wish to Delete this Record?');">
                                  <input type="image" name="imageField2" src="../images1/delete.jpg" />
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