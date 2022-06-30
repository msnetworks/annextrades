<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$keyword=$_REQUEST['keyword'];
$show=$_REQUEST['show'];
if(!isset($_SESSION['admin_user']))
{
	header("Location:index.php");
}
if($_REQUEST['prod_id'])
	{
		$prod_id=$_REQUEST['prod_id'];
		mysqli_query($con,"delete from product where id='$prod_id'");
		header("location: productpending.php");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Products</b></a></article>
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
		<header><h3 class="tabs_involved">Products</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td><form name="searchform" method="post" action="productpending.php">
						<table width="75%" align="center" style="border:1px solid #99CCFF;">
							<tr><td width="249" height="27" colspan="2" align="center" class="adminheaderlink">Search</td>
							</tr>
							<tr>
							  <td height="31" align="right" class="normal">Product Name &nbsp;&nbsp; </td>
				<td><input type="text" name="keyword"/>&nbsp;<span style="font-size:12px">(Search in Product name, Keyword and Description only)</span></td></tr>
							  <tr>
							  <td height="31" align="right" class="normal">Shows</td>
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
			<tr><td height="34" colspan="2" align="center"><a href="productexcl.php?key=<?php echo $keyword;?>&show=<?php echo $show;?>" class="news"><span style="font-size:13px">Export Products list in Excel Format</span></a></td></tr>
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
					<table width="100%" align="center" cellspacing="0">
						<tr bgcolor="#99CCFF" class="normalbold">
						<!--<td width="141">&nbsp;Photo</td>-->						
						<td width="229">&nbsp;Product Name</td>
						<td width="182">Posted By</td>
						<td width="148">Updated Date</td>
						<td width="83">Details</td>
						<td width="94">Status</td>
						<td width="88">Expire in(Days)</td>
						<td width="95" class="normalbold" align="center">&nbsp;&nbsp;Action</td>
						
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
$str.= $temp." ((p_name LIKE '%$keyword%' or p_keyword Like '%$keyword%') or (p_bdes Like '$keyword%' or p_ddes Like '$keyword'))";
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
//$str.= $temp."(status ='1')";
}				
}

if($str!="")
{
$select="SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $str and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}else{
$select="SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
}
else
{
 $select="SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
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
							while($product=mysqli_fetch_array($query)){
							$image="../productlogo/".$product['p_photo'];
							
							$st=$product['status'];
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
							$memberid=$product['userid'];
							$name=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$memberid'"));
						?>
						<tr>
						<td colspan="7">
							<table width="100%">
							  <tr>
			<!--<td width="134" height="102" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>-->
						
							  <td width="175" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;">&nbsp;<?php echo $product['p_name'];?></td>
							  <td width="150" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $name['firstname']." ".$name['lastname'];?></td>
							  <td width="110" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $product['udate'];?></td>
							  <td width="50" valign="top"><a href="productshow.php?pid=<?php echo $product['proid'];?>" class="bluebold"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
							 <td width="122" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><?php echo $status;?></td>
							 <td width="50" align="right">
 <?php 
$expdate = str_replace(".","-",$product['expiredate']);	
$curdate = date("Y-m-d");
if($product['status'] != 0){	
$days = (strtotime($expdate) - strtotime($curdate)) / (60 * 60 * 24);
if(substr($days,0,1) == "-") echo "0"; else echo round($days);
}else { echo "0"; }
							 ?></td>
							 <td width="75" valign="top" align="center"><a href="productpending.php?prod_id=<?php echo $product['proid'];?>" onclick="return confirm('Are you sure you wish to delete this record?');"><img src="../images1/delete.jpg" alt="Delete" title="Delete" border="0" /></a></td>
						 	</tr></table>
						 </td>
						</tr>
						<tr><td></td></tr>
						<?php }?>
					
						<tr><td colspan="7" align="center"><?php echo $pagingLink;?></td></tr>
						<tr><td colspan="7" align="center" height="40"><a href="productexcl.php?key=<?php echo $keyword;?>&show=<?php echo $show;?>" class="news">Export Products list in Excel Format</a></td></tr>
						<tr><td colspan="7" align="center">&nbsp;</td></tr>
						<?php }else{?>
					
						<tr>
						  <td colspan="7" align="center" class="redboldlink" height="25">No Products Found</td>
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