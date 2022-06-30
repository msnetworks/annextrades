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
		mysqli_query($con,"update featurepartner set status=0 where id='$Id'");
	}
	
  if(isset($_REQUEST['actid']))
   {
	   $Id=$_REQUEST['actid'];
		mysqli_query($con,"update featurepartner set status=1 where id='$Id'");
	}
	
if($_REQUEST['action']=="del")
 {
  $delid=$_REQUEST['delid'];
  mysqli_query($con,"delete from featurepartner where id='$delid'");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Featured Partner</b></a></article>
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
		<header><h3 class="tabs_involved">Featured Partner</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td valign="top"><table width="100%" border="0">
                  <tr>
                    <td><table width="100%" border="0">
                        <tr>
                          <td align="center"><strong>Featured Partner Lists Of B2B Potal </strong></td>
                        </tr>
                        <tr>
                          <td align="center"><form action="featureproductaction.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                                    </form></td>
                        </tr>
                        <tr>
                          <td align="center">
						  <table width="99%" border="0" style="border:1px solid #99CCFF;">
                              <tr bgcolor="#99CCFF">
                                
                                <td width="15%" align="center" height="30"><strong class="normalbold">&nbsp;Member Name </strong></td>
                                <td width="29%" align="center"><strong class="normalbold">&nbsp;Email-id</strong></td>
								 <td width="21%" align="center" class="normalbold">&nbsp;Companyname</td>
                                <td width="13%" align="center" class="normalbold">&nbsp;Status</td>
                                <td width="12%" align="center" class="normalbold">&nbsp;View Show </td>
                                <td width="10%" align="center" class="normalbold">&nbsp;Delete</td>
                                
                              </tr>
                              <?php 
									
		$select="SELECT * FROM `featurepartner`";
		
		$strget="";
        $rowsPerPage =10;
        $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
        $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
                           $num=mysqli_num_rows($query);
                          if($num > 0)
						  {
									while($array_in=mysqli_fetch_array($query))
				                     {
									 $stroyid=$array_in['id']; 	
									 $St=$array_in['status'];					 
			                  ?><tr>
                                
                                <td align="left" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php echo $array_in['name'];?></td>
							
                                 <td width="29%" align="left" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php echo $array_in['email'];?></td>
								  <td width="21%" align="left" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php echo $array_in['companyname'];?></td>
								
								<td align="left" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php
							 if($St==0)
							{
							 ?>
 <a href="featuredpartner.php?actid=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to Approve this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; &gt;" class="news">Disapprove</a>
                                  <?php } 
								else
								{
								?>
                                  <a href="featuredpartner.php?inactid=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to Disapprove this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; &gt;" class="bluebold">Approve</a>
                                  <?php } ?></td>
								<td align="center">&nbsp;<a href="featurepartnerview.php?sid=<?PHP echo $stroyid;?>" class="menulinkadmin"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
								<?php
								$St=$array_in['status'];								 
								?>
                             <!--<td align="center">
							 <?php
							 if($St==1)
								 {
							 ?>
                              <a href="success_story.php?disapp=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to disapprove this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; >">Disapprove</a>
								<?php 
								} 
								else
								{
								?>
								<a href="success_story.php?approve=<?php echo $stroyid;?>"  onclick="if( confirm('Are you sure you want to Approve this Record?') )
								{
								return true;
								}
								else
								{
								return false; 
								}" style="text-decoration:none; >">Approve</a>
								<?php } ?>								</td>-->
                                <td align="center">&nbsp;<a href="featuredpartner.php?action=del&delid=<?PHP echo $stroyid;?>" class="menulinkadmin" onclick="return confirm('Are you sure you wish to Delete this Record?');"><img src="../images1/delete.jpg" border="0" /></a></td>
                              </tr>
							  <?php }?>
                              <tr>
                                <td colspan="7" align="center"><?PHP echo $pagingLink;
     echo "<br>";?></td>
                              </tr><?php
							  }else{
							  ?>
							  <tr><td align="center" colspan="7" class="inTxtNormal">
							  No Records found
							  </td></tr>
							  <?php
							  }
							  ?>
                          </table></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
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