<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
if(!isset($_SESSION['admin_user']))
{
	header("Location:index.php");
}
if(isset($_REQUEST['inactid']))
   {
		 $Id=$_REQUEST['inactid'];
		mysqli_query($con,"update  featureproducts set status=1 where id='$Id' ");
	}
	
  if(isset($_REQUEST['actid']))
   {
		 $Id=$_REQUEST['actid'];
		mysqli_query($con,"update  featureproducts set status=0 where id='$Id' ");
	}
	
	if($_REQUEST['delid'])
    {
	$delid=$_REQUEST['delid'];
	mysqli_query($con,"delete from featureproducts where id='$delid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Featured Products</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['added'])) { ?>
		<h4 class="alert_success">Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Feature Products</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="feature_submit.php" style="color:#009900;">Add New Feature products</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="358" valign="top"><table width="100%" border="0">
                  <tr>
                    <td><table width="100%" border="0">
                        <!--<tr>
                          <td width="40%" align="left">&nbsp;&nbsp;<a href="feature_submit.php" class="gboldli">Add New Feature products </a></td>
                          <td width="60%" align="right">&nbsp;</td>
                        </tr>-->
						<tr>
                          <td colspan="2" align="center">
				<form action="" method="post" enctype="multipart/form-data" name="feature" onsubmit="return feature();">
                            <table width="83%" border="0">
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="gbold" align="right">Product Name </td>
                                <td class="gbold" align="center">:</td>
                                <td><input name="productname" type="text" id="productname" /></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="6" align="center"><input name="feature_search" type="submit" id="feature_search" value="Search" /></td>
                              </tr>
                            </table>
                                                    </form></td>
                        </tr>
						
                        <tr>
                          <td colspan="2" align="center">
						  <table width="95%" border="0" style="border:1px solid #99CCFF;">
                              <tr bgcolor="#99CCFF">
                                
                                <td width="24%" align="center" height="35"><strong>Feature Product List </strong></td>
                                <td width="22%" align="center"><strong>Product Images </strong></td>
                                <td width="19%" align="center" class="normalbold">View Product </td>
                                <td width="15%" align="center"><strong>Status</strong></td>
                                <td width="9%" align="center"><strong>Delete</strong></td>
                                <td width="11%" align="center" class="normalbold">Edit</td>
                                <!--<td width="12%" class="normalbold">Edit</td>-->
                              </tr>
                              <?php 
									
$pdtname=$_REQUEST['productname'];			
if(isset($_REQUEST['feature_search']))
{
	$sql="select * from featureproducts where f_pdt_name like '%$pdtname%'";
		
}
else
{
	$sql="select * from featureproducts";
}
	$strget="";
        $rowsPerPage =10;
        $query=mysqli_query($con,getPagingQuery1($sql, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
        $pagingLink = getPagingLink1($sql,$rowsPerPage,$strget); 
 
  	if(mysqli_num_rows($query)>0) {
									while($array_in=mysqli_fetch_array($query))
				                     { 						 
			                  ?><tr>
                                
                                <td class="gbold" style="font-family:'Times New Roman', Times, serif; font-size:13px;">&nbsp;&nbsp;&nbsp;<?php echo $array_in['f_pdt_name'];?></td>
								<?php 
								 $imgpath = "picture/".$array_in['f_pdt_images'];
								 if(($array_in['f_pdt_images'] != '') && (file_exists($imgpath)))
								 {
									$FeatureProducts="picture/".$array_in['f_pdt_images'];
								 } else {
								   $FeatureProducts = "../images/img_noimg.jpg";
								 }
								?>
								 
                                <td align="center"><img src="<?php echo $FeatureProducts; ?>" width="50" height="50" /></td>
								
								<td align="center"><a href="feature_pdtview.php?viewid=<?PHP echo $array_in['id'];?>" class="news"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
								<?php $St = $array_in['status'];
								 
								?>
                             <td align="center">
							 <?php
							 if($St ==0)
								 {
							 ?>
                              <a href="featureproductss.php?inactid=<?php echo $array_in['id'];?>"  onclick="if( confirm('Are you sure you want to activate this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; >" class="news"><img src="images/inact.png" /></a>
								<?php } 
								if($St == 1)
								{
								?>
								<a href="featureproductss.php?actid=<?php echo $array_in['id'];?>"  onclick="if( confirm('Are you sure you want to De-activate this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; >" class="bluebold"><img src="images/act.png" /></a>
								<?php } ?>								</td>
                                <td align="center"><a href="featureproductss.php?delid=<?PHP echo $array_in['id']?>" class="redboldlink" onclick="return confirm('Are you sure you wish to Delete this Record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
                                <td align="center"><a href="edit_feature.php?editid=<?PHP echo $array_in['id'];?>"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
                                <!--<td align="center"><a href="edit_feature.php"><input type="image" name="imageField" src="../images/edit_f2.png" /></a></td>-->
                              </tr>
							  <?php }?>
                              <tr>
                                <td colspan="8" align="center"><?PHP echo $pagingLink;
     echo "<br>";?></td>
                              </tr>
							  <?php }  else { ?>
							   <tr>
                                <td colspan="8" align="center" class="redbold">No Featured Products Found </td>
                              </tr>
							  <?php } ?>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
				</tr>
		  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>