<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if($_REQUEST['delid'])
    {
		$delid=$_REQUEST['delid'];
		mysqli_query($con,"delete from messagesend where msg_id='$delid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Sellers Enquiry</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['delid'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">Country Added Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Country Edited Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['deactive'])) { ?>
		<h4 class="alert_success">User Deactivated Successfully</h4>
		<?php } ?>
		
		<?php if(isset($_REQUEST['active'])) { ?>
		<h4 class="alert_success">User Activated Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Sellers Enquiry</h3>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="100%" cellspacing="0"> 
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="33">S.No</th> 
    				<th width="99">User Name</th> 
					<th width="101">User Mail</th>
					<th width="75">Product Name</th>
					<th width="70">Subject</th>
					<th width="50">Reply</th>
					<th width="56">Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php
			$pdtname=$_REQUEST['productname'];			
			if(isset($_REQUEST['feature_search']))
			{
				$sql="select * from messagesend where f_pdt_name like '%$pdtname%'";
			}
			else
			{
				$sql="select * from messagesend";
			}
			
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
			  	$uid=$sel_cou['userid'];
				$res=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$uid'")); 						                $proid=$sel_cou['productid'];
				$exproid=explode(",",$proid);
				foreach($exproid as $pid)
				{
					if($pid!="")
					{
			  		?>
			  
				<tr> 
   					<td style="margin: 0; padding-left:10px; border-bottom: 1px dotted #ccc; "><?php echo $i; ?></td>
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $res['firstname'];?></b></a></td>
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="enquiryreply.php?id=<?php echo $sel_cou['userid'];?>" style="color:#000099;"><b><?php echo $res['email'];?></b></a></td>
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
						<?php
							$pselect=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where seller_id='$pid'"));
							echo "select * from tbl_seller where seller_id='$pid'";
							echo $sub=$pselect['seller_subject'];
						?>
					</td>	
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['subject'];?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="enquiryreply.php?id=<?php echo $sel_cou['userid'];?>" ><img src="images/reply2.jpeg" style="width:25px; height:25px;" /></a></td>
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="enquiryview.php?seller&id=<?php echo $sel_cou['msg_id'];?>" class="news"><img src="images/view4.png" style="width:20px; height:20px;" /></a>
					<a href="sellerenquiry.php?delid=<?PHP echo $sel_cou['msg_id'];?>" class="redboldlink" onclick="return confirm('Are you sure want to delete this record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
				</tr> 
				
				<?php $i++; } } } }
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
