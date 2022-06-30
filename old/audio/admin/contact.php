<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$rowsPerPage = '20';
if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	if(isset($_REQUEST['delete']))
	{
		$del=$_REQUEST['delete'];
		$delete=mysqli_query($con,"delete from forumheading where id = '$del' ");
		if($delete)
		{
			header("location:forummanagement.php?deleted");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Contact Information</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['msg'])) { ?>
		<h4 class="alert_success"><?php if($_GET['msg']=="ch"){?>Contact us Details Updated Successfully<?php }?></h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Contact Information</h3>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="settings" action="" method="post" onsubmit="return validatesettings();">
			<table width="100%" cellspacing="0">
			<thead> 
				<tr style="height: 34px;
background: url(../images/table_sorter_header.png) repeat-x;
text-align: left;
text-indent: 5px;
cursor: pointer;"> 
   					<th width="76">Name</th> 
    				<th width="79">Address</th> 
					<th width="91">Email</th> 
					<th width="90">Phone</th> 
    				<th width="91">Mobile</th> 
					<th width="94">Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			
			<?php //$sql="SELECT * FROM movies order by movie_name ";
			$sql="SELECT * FROM contact";
			
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
   					<td height="36" style="margin: 0; padding-left:5px; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['c_name']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['c_address']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['c_email']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['c_phone']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><?php echo $sel_cou['c_mobile']; ?></td>
					<td style="margin: 0; padding: 0; border-bottom: 1px dotted #ccc; "><a href="contactupd.php?id=<?php echo $sel_cou['c_id'];?>" ><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
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
			</form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>

</html>