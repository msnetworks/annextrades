<?php 
session_start();
	ob_start();
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../db-connect/notfound.php");
	include("includes/header.php");
	$today=date('Y-m-d');$today1=date('Y.m.d');
	//get today's details
	$todaysell=mysqli_fetch_array(mysqli_query($con,"select count(*) from `tbl_seller` where `seller_updated_date`='$today'"));
	$todaybuy=mysqli_fetch_array(mysqli_query($con,"select count(*) from `buyingleads` where `update_date`='$today'"));
	$todayproduct=mysqli_fetch_array(mysqli_query($con,"select count(*) from `product` where `udate`='$today1'"));
	$todaycomp=mysqli_fetch_array(mysqli_query($con,"select count(*) from `companyprofile` where `add_date`='$today'"));
	$todaysignup=mysqli_fetch_array(mysqli_query($con,"select count(*) from `registration` where `date`='$today'"));
	
	//get yesterday's details
	$yesterday=date('Y-m-d', strtotime('-1 day'));
	$yest_sell=mysqli_fetch_array(mysqli_query($con,"select count(*) from `tbl_seller` where `seller_updated_date`='$yesterday'"));
	$yest_buy=mysqli_fetch_array(mysqli_query($con,"select count(*) from `buyingleads` where `update_date`='$yesterday'"));
	$yest_product=mysqli_fetch_array(mysqli_query($con,"select count(*) from `product` where `udate`='$yesterday'"));
	$yest_comp=mysqli_fetch_array(mysqli_query($con,"select count(*) from `companyprofile` where `add_date`='$yesterday'"));
	$yest_signup=mysqli_fetch_array(mysqli_query($con,"select count(*) from `registration` where `date`='$yesterday'"));
	
	//get last 7 days details
	$lastweek=date('Y-m-d', strtotime('-1 week'));
	$lastweek_sell=mysqli_fetch_array(mysqli_query($con,"select count(*) from `tbl_seller` where `seller_updated_date` between '$lastweek' and '$today'"));
	$lastweek_buy=mysqli_fetch_array(mysqli_query($con,"select count(*) from `buyingleads` where `update_date` between '$lastweek' and '$today'"));
	$lastweek_product=mysqli_fetch_array(mysqli_query($con,"select count(*) from `product` where `udate` between '$lastweek' and '$today'"));
	$lastweek_comp=mysqli_fetch_array(mysqli_query($con,"select count(*) from `companyprofile` where `add_date` between '$lastweek' and '$today'"));
	$lastweek_signup=mysqli_fetch_array(mysqli_query($con,"select count(*) from `registration` where `date` between '$lastweek' and '$today'"));
	
	//get last 1 month details
	$lastmonth=date('Y-m-d', strtotime('-1 month'));
	$lastmonth_sell=mysqli_fetch_array(mysqli_query($con,"select count(*) from `tbl_seller` where `seller_updated_date` between '$lastmonth' and '$today'"));
	$lastmonth_buy=mysqli_fetch_array(mysqli_query($con,"select count(*) from `buyingleads` where `update_date` between '$lastmonth' and '$today'"));
	$lastmonth_product=mysqli_fetch_array(mysqli_query($con,"select count(*) from `product` where `udate` between '$lastmonth' and '$today'"));
	$lastmonth_comp=mysqli_fetch_array(mysqli_query($con,"select count(*) from `companyprofile` where `add_date` between '$lastmonth' and '$today'"));
	$lastmonth_signup=mysqli_fetch_array(mysqli_query($con,"select count(*) from `registration` where `date` between '$lastmonth' and '$today'"));
	
	$totalmembers=mysqli_fetch_array(mysqli_query($con,"select count(*) from registration"));
	$totelsell=mysqli_fetch_array(mysqli_query($con,"select count(*) from tbl_seller"));
	$totalbuy=mysqli_fetch_array(mysqli_query($con,"select count(*) from buyingleads"));
	$totalproduct=mysqli_fetch_array(mysqli_query($con,"select count(*) from product"));
	$totalcompany=mysqli_fetch_array(mysqli_query($con,"select count(*) from companyprofile where bussiness_type!=''"));
?>

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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Site Statistics</a></article>
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
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved" style="font-family:'Times New Roman', Times, serif; font-size:16px;">Site Statistics</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td height="358" valign="middle">
					<form name="settings" action="" method="post" onsubmit="return validatesettings();">
				 	  <table width="100%">
					  		<tr>
								<td width="640">
									<table width="627" align="center">
										<tr><td height="33" colspan="6" class="normalbold" style="font-size:18px; font-family:'Times New Roman', Times, serif"><b>Recent Statistics</b></td>
										</tr>
										<tr class="seller" style="font-size:13px; font-family:'Times New Roman', Times, serif"><td width="98" height="31"><b>Posted/Type</b></td>
										<td width="87" align="center"><b>Sell Offers</b></td>
										<td width="91" align="center"><b>Buy Offers</b></td>
										<td width="124" align="center"><b>Product Catelogs</b></td>
											<td width="131" align="center"><b>Company Profiles</b></td>
											<td width="68" align="center"><b>Signups</b></td>
										</tr>
										<tr><td class="seller style2" style="color:#009966;">Today</td>
										<td align="center" class="normal"><span class="style2"><?php echo $todaysell[0];?></span></td>
										<td align="center" class="normal"><span class="style2"><?php echo $todaybuy[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $todayproduct[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $todaycomp[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $todaysignup[0];?></span></td>
										</tr>
										<tr><td class="seller style2" style="color:#009966;">Yesterday</td>
										<td align="center" class="normal"><span class="style2"><?php echo $yest_sell[0];?></span></td>
										<td align="center" class="normal"><span class="style2"><?php echo $yest_buy[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $yest_product[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $yest_comp[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $yest_signup[0];?></span></td>
										</tr>
										<tr><td class="seller style2" style="color:#009966;">Last 7 Days</td>
										<td align="center" class="normal"><span class="style2"><?php echo $lastweek_sell[0];?></span></td>
										<td align="center" class="normal"><span class="style2"><?php echo $lastweek_buy[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastweek_product[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastweek_comp[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastweek_signup[0];?></span></td>
										</tr>
										<tr><td class="seller style2" style="color:#009966;">Last 30 Days</td>
										<td align="center" class="normal"><span class="style2"><?php echo $lastmonth_sell[0];?></span></td>
										<td align="center" class="normal"><span class="style2"><?php echo $lastmonth_buy[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastmonth_product[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastmonth_comp[0];?></span></td>
											<td align="center" class="normal"><span class="style2"><?php echo $lastmonth_signup[0];?></span></td>
										</tr>
								  </table>
							  </td>
							</tr>
							
							<tr><td>&nbsp;</td></tr>
							<tr><td><table width="629" align="center">
								<tr style="font-size:18px; font-family:'Times New Roman', Times, serif"><td height="31" colspan="4" class="normalbold"><b>Site Statistics</b></td>
								</tr>
								<tr>
								  <td width="73">&nbsp;</td>
								  <td width="184" class="seller style2" style="color:#009966;">Total Members</td>
								<td width="3">:</td>
								<td width="349" class="normal"><span class="style2"><?php echo $totalmembers[0];?></span></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
							    <td class="seller style2" style="color:#009966;">Total Sell Offers</td>
							    <td>:</td><td class="normal"><span class="style2"><?php echo $totelsell[0];?></span></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
							    <td class="seller style2" style="color:#009966;">Total Buy Offers</td>
							    <td>:</td><td class="normal"><span class="style2"><?php echo $totalbuy[0];?></span></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
							    <td class="seller style2" style="color:#009966;">Total Product Catelogs</td>
							    <td>:</td><td class="normal"><span class="style2"><?php echo $totalproduct[0];?></span></td>
								</tr>
								<tr>
								  <td>&nbsp;</td>
							    <td class="seller style2" style="color:#009966;">Total Company Profiles</td>
							    <td>:</td><td class="normal"><span class="style2"><?php echo $totalcompany[0];?></span></td>
								</tr>
							</table></td></tr>
				 	  </table>
				  </form>
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