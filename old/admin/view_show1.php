<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$showid=$_REQUEST['sid'];	
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="admin_tradeshow.php"><b>Trade Shows</b></a></article>
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
		<header><h3 class="tabs_involved">Trade Show Full Details View</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="358" valign="top"><table width="90%" border="0" align="center">
                  <tr>
                    <td><table width="90%" height="157" align="center" cellspacing="0">
                      <?PHP
					  //echo "select * from tbl_tradeshow where show_id='$showid'";exit;
					  $showqur=mysqli_fetch_array(mysqli_query($con,"select * from tbl_tradeshow where show_id='$showid'")); 
					   ?>
                      <tr class="smallfont">
                        <td colspan="5"><form action="" method="post" name="product" id="product">
                            <table width="557" align="center">
                              <tr>
                                <td colspan="3" align="center">
								<?php
								 $imgpath = "../uploads/".$showqur['image'];
								 if(($showqur['image'] != '') && (file_exists($imgpath)))
								 {
								?>
								<img src="<?PHP echo "../uploads/".$showqur['image'];?>" border="0" height="75" width="75"/>                  
                                <?php } else { ?>        
								<img src="<?PHP echo "../uploads/img_noimg.jpg";?>" border="0" height="75" width="75"/>
                                <?php } ?>		
								 </td>		
							  </tr>
                              <tr valign="top">
                                <td width="221" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Name&nbsp;&nbsp;(English)</td>
                                <td width="13">:</td>
                                <td width="307" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['show_name'];?>                                </td>
                              </tr>
							   <tr valign="top">
                                <td width="221" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Name&nbsp;&nbsp;(French)</td>
                                <td width="13">:</td>
                                <td width="307" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['show_name_french'];?>                                </td>
                              </tr>
							  <?php /*?> <tr valign="top">
                                <td width="221" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Name&nbsp;&nbsp;(Chinese)</td>
                                <td width="13">:</td>
                                <td width="307" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['show_name_chinese'];?>                                </td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td width="221" class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Name&nbsp;&nbsp;(Spanish)</td>
                                <td width="13">:</td>
                                <td width="307" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['show_name_spanish'];?>                                </td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Event Starting Date</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['events_fromdate'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Event End Date</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['events_todate'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Start Time </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['from_time'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show End Time </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['to_time'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Venue&nbsp;&nbsp;(English)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['venue'];?></td>
                              </tr>
							   <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Venue&nbsp;&nbsp;(French)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['venue_french'];?></td>
                              </tr>
							   <?php /*?><tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Venue&nbsp;&nbsp;(Chinese)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['venue_chinese'];?></td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Venue&nbsp;&nbsp;(Spanish)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['venue_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Address&nbsp;&nbsp;(English)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['address'];?></td>
                              </tr>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Address&nbsp;&nbsp;(French)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['address_french'];?></td>
                              </tr>
							<?php /*?>  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Address&nbsp;&nbsp;(Chinese)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['address_chinese'];?></td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Address&nbsp;&nbsp;(Spanish)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['address_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Location </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['location'];?></td>
                              </tr>
                              
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Exhibitors </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['exhibitors_no']." - ".$showqur['exhibitors_year'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Exhibition Floor Size(sqm):Capacity </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['exhibition_no']." - ".$showqur['exhibition_year'];?></td>
                              </tr>
                              <tr valign="top">
                                <td colspan="3" class="normalbold" style="color:#000099"><b>Show Information</b></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Summary&nbsp;&nbsp;(English)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['summary'];?></td>
                              </tr>
							   <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Summary&nbsp;&nbsp;(French)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['summary_french'];?></td>
                              </tr>
							  <?php /*?> <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Summary&nbsp;&nbsp;(Chinese)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['summary_chinese'];?></td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Summary&nbsp;&nbsp;(Spanish)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['summary_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">General Information&nbsp;&nbsp;(English) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['general_information'];?></td>
                              </tr>
							   <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">General Information&nbsp;&nbsp;(French) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['general_information_french'];?></td>
                              </tr>
                              
							  <?php /*?> <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">General Information &nbsp;&nbsp;(Chinese)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['general_information_chinese'];?></td>
                              </tr><?php */?>
                              
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">General Information &nbsp;&nbsp;(Spanish)</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['general_information_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Industry Focus</td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['industry_focus'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Focus&nbsp;&nbsp;(English) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['productsfocus'];?></td>
                              </tr>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Focus&nbsp;&nbsp;(French) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['productsfocus_french'];?></td>
                              </tr>
							 <?php /*?> <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Focus&nbsp;&nbsp;(Chinese) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['productsfocus_chinese'];?></td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Product Focus&nbsp;&nbsp;(Spanish) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['productsfocus_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td colspan="3"><span class="normalbold" style="color:#000099"><b>Organizer Contact Information</b></span></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Show Organizer </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['show_organizer'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Contact Person </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['contact_person'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Job Title </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['job_title'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Business Email </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['business_email'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Business Address&nbsp;&nbsp;(English) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['business_address'];?></td>
                              </tr>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Business Address&nbsp;&nbsp;(French) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['business_address_french'];?></td>
                              </tr>
							 <?php /*?> <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Business Address&nbsp;&nbsp;(Chinese) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['business_address_chinese'];?></td>
                              </tr><?php */?>
							  <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Business Address&nbsp;&nbsp;(Spanish) </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['business_address_spanish'];?></td>
                              </tr>
                              <tr valign="top">
                                <td class="normal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">Organizer Country </td>
                                <td>:</td>
                                <td style="font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $showqur['organizer_country'];?></td>
                              </tr>
							  <tr><td colspan="3">&nbsp;</td></tr>
                              <tr>
                                <td colspan="3" align="center"><!--<input name="button" type="button" onclick="history.go(-1);" value="Back" />-->                                </td></tr>
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
				<tr><td>&nbsp;</td></tr>
		  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>