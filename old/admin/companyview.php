<?php 
//session_start();
	//ob_start();
		include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}

	$idd=$_REQUEST['id'];
		$rid=$_REQUEST['idd'];
	
if(isset($_REQUEST['act']))
{
if($_REQUEST['act']=='active')
{
$idd=$_REQUEST['id'];
$rdd=$_REQUEST['idd'];

$sql=mysqli_query($con,"update companyprofile set approval_status='0' where id='$idd'");

header("location:companyview.php?id=$idd&idd=$rdd");
}
}

if(isset($_REQUEST['act']))
{
if($_REQUEST['act']=='deactive')
{
$idd=$_REQUEST['id'];
$rdd=$_REQUEST['idd'];

$sql=mysqli_query($con,"update companyprofile set approval_status='1' where id='$idd'");

header("location:companyview.php?id=$idd&idd=$rdd");
}
}
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="companyprofile.php"><b>Company Profile</b></a></article>
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
		<header><h3 class="tabs_involved">Company Profile</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" border="0" align="right" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="inbg2"><form action="" method="post" name="mycompanydetails" id="form1">
                    <table width="100%" border="0" cellpadding="3" cellspacing="2">
                      
                      <?php
					 
						    $sql=(mysqli_query($con,"select * from  registration where id='$rid'"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							//echo $row['email'];
							$rowid=$row['id'];
	                        $cou=$row['country'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];
						  ?>
						  
						  <?php 
						 
						     $sql_cp=(mysqli_query($con,"select * from  companyprofile where id='$idd'"));
							 $count_cp=mysqli_num_rows($sql_cp);
							 $row_cp=mysqli_fetch_array($sql_cp);
							
							 $iddd = $row_cp['id'];
						  ?>
						 <!-- <tr>
                          <td colspan="3" class="inTxtSHead"><div align="left" class="inTxtHead">Company Details</div></td>
                          </tr>-->
                      <tr>
                        <td align="right" class="blackBo">Country</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_country['country_name']; ?></td>
                      </tr>
                      <tr>
                        <td width="46%" align="right" class="blackBo">Company Name </td>
                        <td width="3%" align="center" class="blackBo">:</td>
                        <td width="51%" class="inTxtNormal"><?php  echo $row_cp['companyname']; ?></td>
                      </tr>
                      	
                      <tr>
                        <td align="right" class="blackBo">Bussiness Mail </td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row['email']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Bussiness Type </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Bty= $row_cp['bussiness_type']; if($Bty==""){ $BTY="No Records";} else{$BTY=$Bty;} ?>
                        <td class="inTxtNormal"><?php echo $BTY; //echo $row_cp['bussiness_type'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Product Service </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Pser= $row_cp['P_service']; if($Pser==""){ $PSER="No Records";} else{$PSER=$Pser;} ?>
                        <td class="inTxtNormal"><?php  echo $PSER; //echo $row_cp['P_service'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Company Address </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Ads= $row_cp['company_address']; if($Ads==""){ $ADS="No Records";} else{$ADS=$Ads;} ?>
                        <td class="inTxtNormal"><?php echo $ADS; //echo $row_cp['company_address'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Company Logo </td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal">
						<?php 
						 $imgpath = "../logo/".$row_cp['companylogo'];
						if (($row_cp['companylogo'] != "") && (file_exists($imgpath)))  {
						$Photo = "../logo/".$row_cp['companylogo'];
						 } else { $Photo="../blog_photo_thumbnail/img_noimg.jpg";  } ?>
                            <img src="<?php echo $Photo; ?>" width="50" height="50" /></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Company Website URL </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Url= $row_cp['url']; if($Url==""){ $URL="No Records";} else{$URL=$Url;} ?>
                        <td class="inTxtNormal"><?php  echo $URL; //echo $row_cp['url'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Detailed Company Introduction </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Cdts= $row_cp['company_details']; if($Cdts==""){ $CDTS="No Records";} else{$CDTS=$Cdts;} ?>
                        <td class="inTxtNormal"><?php echo $CDTS; //echo $row_cp['company_details'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Year Established </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Yr= $row_cp['year']; if($Yr==""){ $YR="No Records";} else{$YR=$Yr;} ?>
                        <td class="inTxtNormal"><?php echo $YR; //echo $row_cp['year'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Management Certification </td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Mgt= $row_cp['mgmtcertification']; if($Mgt==""){ $MGMT="No Records";} else{$MGMT=$Mgt;} ?>
                        <td class="inTxtNormal"><?php echo $MGMT; //echo $row_cp['mgmtcertification'];?></td>
                      </tr>
                      <tr>
                        <td align="right" class="blackBo">Brand(s)</td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Bd= $row_cp['brand']; if($Bd==""){ $BRD="No Records";} else{$BRD=$Bd;} ?>
                        <td class="inTxtNormal"><?php echo $BRD; //echo $row_cp['brand'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Legal Representative / Bussiness Owner</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['bussinessowner'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Registered Capital</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['registeredcapital'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Ownership Type</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['ownertype'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Main Markets</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['mainmarkets'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Main Customer(s)</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['maincustomer'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Total Annual Sales Volume</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['toannualsalesvolume'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Export Percentage</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['exportpercentage'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Total Annual Purchase Volume</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['toannualpurchasevolume'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Factory Size</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['factorysize'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Factory Location</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['factorylocation'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">QA/QC</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['qa/qc'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">No. of Production Lines</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['noofprodlines'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">No. of R&D Staff</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['noofr&dstaff'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">No. of QC Staff</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['noofqcstaff'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Management Certification</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['mgmtcertification'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo">Contact Manufacturing</td>
                        <td align="center" class="blackBo">:</td>
                        <td class="inTxtNormal"><?php echo $row_cp['contactmant'];?></td>
                      </tr>
					  <tr>
                        <td align="right" class="blackBo" colspan="3">&nbsp;</td>
                       </tr>
					  <table>
							<tr>
								<td style="padding-left:200px;"><b>Edit</b></td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td style="padding-left:30px;"><a href="editcompany.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>" class="news"><img src="images/EDIT.PNG" /></a></td>
								
								<td style="padding-left:50px;"><b>Status</b></td>
								<td style="padding-left:30px;"><b>:</b></td>
								<td align="center" colspan="3">
						<?php
						if($row_cp['approval_status']=='1')
						{
						$memberid=$row_cp['id'];
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="companyview.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>&act=active" onclick="return confirm('Are you sure you wish to Active this Record?');" class="news"><span style="font-size:13px"><img src="images/inact.png" /></span><!--<input type="submit" name="Submit" value="Active" onclick="javascript:active();"/>--></a>
						<?php
						}else{
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="companyview.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>&act=deactive" onclick="return confirm('Are you sure you wish to Deactive this Record?');" class="news"><span style="font-size:13px"><img src="images/act.png" /></span><!--<input type="submit" name="Submit" value="Deactive" />--></a>
						<?php
						}
						?>
						</td>
									
							</tr>
						</table>
					  
                    </table>
                  </form></td>
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