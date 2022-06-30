<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
if(!isset($_SESSION['admin_user']))
{
	header("Location:index.php");
}
if($_REQUEST['buy_id'])
{
	$buy_id=$_REQUEST['buy_id'];
	mysqli_query($con,"delete from buyingleads where buy_id='$buy_id'");
	header("location:buyleadpending.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Buying Leads</b></a></article>
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
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Buying Leads</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td><form name="searchform" method="post" action="buyleadpending.php">
						<table width="75%" align="center" style="border:1px solid #99CCFF;">
							<tr><td width="249" height="27" colspan="2" align="center" class="adminheaderlink">Search</td>
							</tr>
							<tr>
							  <td height="31" align="right" class="normal">Product Name &nbsp;&nbsp; </td>
				<td><input type="text" name="keyword" /><input type="hidden" name="uid" value="<?php echo $uid;?>">&nbsp;<span style="font-size:12px">(Search in Product name, Keyword and Description only)</span></td></tr>
							  <tr>
							  <td height="31" align="right" class="normal">Shows </td>
								<td><select name="show">
				                    <option value="">Select</option>
									<option value="Approval Pending">Approval Pending</option>
									<option value="Editing Required">Editing Required</option>
									<option value="Approved">Approved</option>
									<option value="Expired">Expired</option>
									<option value="All">All</option>
				  					</select>
								</td></tr>
			<tr><td height="34" colspan="2" align="center"><input type="submit" name="search" value="Search" /></td></tr>
			<tr><td height="34" colspan="2" align="center"><a href="buyingexcl.php?key=<?php echo $keyword;?>&show=<?php echo $show;?>" class="news"><span style="font-size:13px">Export Buyers list in Excel Format</span></a></td></tr>
					  </table>
					  </form></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">
					<?php //include("buyingleadhead.php");?>
					<?php if(isset($_REQUEST['upd'])) { ?>
					<span style="color:#006600; font-weight:bold;">Updated successfully</span>
					<?php } ?>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="100%" align="center" cellspacing="0" style="border:1px solid #99CCFF;">
						<tr bgcolor="#99CCFF">
						<td width="21%" class="normalbold" height="25">&nbsp;&nbsp;Product Name</td>
						<td width="21%" class="normalbold">&nbsp;&nbsp;Posted By</td>
						<td width="15%" class="normalbold">&nbsp;&nbsp;Updated Date</td>
						<td width="8%" class="normalbold">&nbsp;&nbsp;Detail</td>
						<td width="16%" class="normalbold">&nbsp;&nbsp;Status</td>
						<td width="11%" class="normalbold">&nbsp;&nbsp;Posted IP</td>					
						<td width="8%" class="normalbold" align="center">&nbsp;&nbsp;Action</td>
					  </tr>
<?php 
				
if(isset($_REQUEST['search']))
{
$keyword=$_REQUEST['keyword'];
$show=$_REQUEST['show'];

$str="";
if($keyword!="")
{
	if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp." ((subject LIKE '%$keyword%' or keyword Like '%$keyword%') or (keyword1 Like '$keyword%' or keyword2 Like '$keyword') or (detdes Like '$keyword' or briefdes Like '$keyword'))";
}
if($show!="")
{

if($show=='Approval Pending')
{
if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp."(status='1')";
}

if($show=='Editing Required')
{
if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp."(status='3')";
}

if($show=='Approved')
{
if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp."(status='2')";
}
if($show=='Expired')
{
if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp."(status='0')";
}
if($show=='All')
{
if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp."(status ='0' or status='1' or status='2' or status='3')";
}				
}

if($str!="")
{
//echo "select * from buyingleads where $str";

$select="SELECT *,buyingleads.country as countyid,registration.id as regid from buyingleads,registration,category where $str and category.c_id=buyingleads.category and registration.companyname!='' and registration.id=buyingleads.id order by buy_id desc";


}else{

$select="SELECT *,buyingleads.country as countyid,registration.id as regid from buyingleads,registration,category where category.c_id=buyingleads.category and registration.companyname!='' and registration.id=buyingleads.id order by buy_id desc";

}

}
else
{
$select="SELECT *,buyingleads.country as countyid,registration.id as regid from buyingleads,registration,category where category.c_id=buyingleads.category and registration.companyname!='' and registration.id=buyingleads.id order by buy_id desc";
}
			  $strget="search=Submit&keyword=$keyword&show=$show";
              $rowsPerPage =20;
              //$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
			  $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
              //$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
			  $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  $count=mysqli_num_rows($query);
			  
	                if($count > 0)
					{
					    $i=0;
						
						?>
						
						<?php 
							while($leads=mysqli_fetch_array($query))
							{
							$image="../uploads/".$leads['photo'];
							$memberid=$leads['id'];
							$st=$leads['status'];
							if($st=='0')
							{
							$status="Expired";
							}
							if($st=='1')
							{
							$status="Approval Pending";
							}
							if($st=='2')
							{
							$status="Approved";
							}
							if($st=='3')
							{
							$status="Editing Required";
							}
							$name=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$memberid'"));
						?>
						<tr>
						<td colspan="7">
							<table width="100%">
							  <tr>
							  <td width="21%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;">&nbsp;<?php echo $leads['subject'];?></td>
							  <td width="21%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $name['firstname']." ".$name['lastname'];?></td>
							  <td width="16%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $leads['update_date'];?></td>
							  <td width="9%" valign="top" style="font-family:'Times New Roman', Times, serif"><a href="buyleadshow.php?bid=<?php echo $leads['buy_id'];?>" class="bluebold"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
							  <td width="16%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $status;?></td>
							  <td width="9%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $leads['post_ip'];?></td>
							  <td width="8%" valign="top" align="center">
							  <a href="buylead_edit.php?bid=<?php echo $leads['buy_id'];?>" style="float:left;"><img src="../images1/edit.png" alt="Delete" title="Edit" border="0" /></a><a href="buyleadpending.php?buy_id=<?php echo $leads['buy_id'];?>" onclick="return confirm('Are you sure want to delete this record?');" style="float:left; text-decoration:none;">&nbsp;&nbsp;<img src="../images1/delete.jpg" alt="Delete" title="Delete" border="0" /></a></td>
						 	</tr></table>
						 </td>
						</tr>
						<tr><td></td></tr>
						<?php }?>
					
						<tr><td colspan="7" align="center"><?php echo $pagingLink;?></td></tr>
						<tr><td colspan="7" align="center" height="40"><a href="buyingexcl.php?key=<?php echo $keyword;?>&show=<?php echo $show;?>" class="news">Export Buyers list in Excel Format</a></td></tr>
						<tr><td colspan="7" align="center">&nbsp;</td></tr>
						<?php }else{?>
					
						<tr>
						  <td colspan="7" align="center" class="redboldlink" height="25">No Buying Leads Found</td>
						</tr>
						<?php }?>
				  </table>
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