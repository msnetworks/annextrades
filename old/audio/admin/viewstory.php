<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$storyid=$_REQUEST['sid'];	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function active()
{
alert("Are you sure you wish to Active this Record?");
window.location.href="companyview.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>&act=active";
}
</script>
</head>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="success_story.php"><b>Success Stories</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Success Story Views</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="289" valign="top"><table width="100%" border="0">
                  <tr>
                    <td><table width="751" height="157" align="center" cellspacing="0">
					  <?PHP
					  //echo "select * from tbl_tradeshow where show_id='$showid'";exit;
					  $showqur=mysqli_fetch_array(mysqli_query($con,"select * from  testimonials where test_id='$storyid'")); 
					   ?>
                      <tr class="smallfont">
                        <td colspan="5"><form action="" method="post" name="product" id="product">
                            <table width="457" align="center">
                             <?php
							 if($showqur['photo']!="") { ?> <tr>
                                <td colspan="3" align="center">
								<img src="<?PHP echo "../blog_photo_thumbnail/".$showqur['photo'];?>" width="75" height="75" />
								</td>                  
                              </tr>
							  <?php } ?>
                              <tr valign="top">
                                <td width="136" height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Name</td>
                                <td width="14" height="30">:</td>
                                <td width="291" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testname'];?>                                </td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Email</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testemail'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Contact Number</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testphone'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">city</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testcity'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Country </td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testcountry'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Company Name</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testcompany'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Story</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testnote'];?></td>
                              </tr>
                              <tr valign="top">
                                <td height="30" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Permission To Display</td>
                                <td height="30">:</td>
                                <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['testrelease'];?></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="3" align="center"><!--<input name="button" type="button" onclick="history.go(-1);" value="Back" />-->                                </td></tr>
                            </table>
                        </form></td>
                      </tr>
                      <tr>
                        <td></td>
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