<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
//$cid=$_REQUEST['cid'];
	
	if(isset($_REQUEST['del']))
	{
	$del=$_REQUEST['del'];
	$del_qry=mysqli_query($con,"delete from member_order where order_id=$del");
	
	if($del_qry)
	{
	header("location:orders.php?deleted");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Manage Orders</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Order Deleted Successfully</h4>
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
		<header><h3 class="tabs_involved">Order Management</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="addcountry.php" style="color:#009900;">Add New Country</a>--></h2>
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
   					<th width="38">S.No</th> 
    				<th width="84">Order_refid</th> 
					<th width="95">Package name</th>
					<th width="74">Customer name</th>
					<th width="39">Price</th>
					<th width="125">Txn Id </th>
					<th width="62">Order date</th>
					<th width="67">Expired date</th>
					<th width="67">Payment Status</th>
					<th width="55" >Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="select * from member_order order by order_id asc";
			
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
			  $mem=mysqli_query($con,"select * from membersettings");
$fetchmem=mysqli_fetch_array($mem);

if($sel_cou['order_packid']=='1')
{
$amount="$gold_amount";
$membership_type='GoldSupplier';
}
else if($sel_cou['order_packid']=='2')
{
$amount="$silver_amount";
$membership_type='SilverSupplier';
}
else if($sel_cou['order_packid']=='3')
{
$amount="$bronze_amount";
$membership_type='BronzeSupplier';
}
else
{}


			//  $cid=$sel_cou['country_id'];
			  ?>
				<tr> 
   					<td height="44" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; " align="center"><?php echo $i; ?></td>
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><b style="color:#000099;"><?php echo $sel_cou['order_refid']; ?></b></td>
					
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<b style="color:#047AB6;"><b style="color:#000099;"><?php echo $membership_type; ?></b>
					</td>
					
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<b style="color:#000099;"><?php echo $sel_cou['order_name']; ?></b>
					</td>
					
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<?php echo $sel_cou['order_price']."$"; ?>
					</td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<?php echo $sel_cou['order_transid']; ?>
					</td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<?php echo $sel_cou['order_date']; ?>
					</td>
					
					
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<?php echo $sel_cou['order_exp_date']; ?>
					</td>
					
					<td align="center" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					<?php 
					if($sel_cou['payment_status']=="0")
					{
					echo "pending";
					}
					else
					{
					echo "Paid";
					}
					
					 ?>
					</td>
					
					<td nowrap="nowrap" style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; ">
					&nbsp;&nbsp;<a href="orders.php?del=<?php echo $sel_cou['order_id']; ?>" onclick="return confirm_delete();"><img src="images/delete2.jpg" /></a></td>
				</tr> 
				
				<?php $i++; } } 
				else { 
				?> 
				<tr> 
   					<td colspan="10" align="center">No records found....</td> 
				</tr> 
				
				<?php } ?>
				<tr align="right"> 
   					
					<td colspan="10" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px;"><?php echo  $pagingLink;?></div></td> 
    				
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
