<?php 
//session_start();
	ob_start();
	
    include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination1.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	
	$strget="";
	$rowsPerPage = '4';
	$sql="select * from registration order by id desc";
	$result=mysqli_query($con,getPagingQuery1($sql, $rowsPerPage,$strget)) or die(mysqli_error($con));
	$pagingLink = getPagingLink1($sql, $rowsPerPage,$strget); 
	if(isset($_REQUEST['page']))
	{
		$i=(($_REQUEST['page'] -1) *4 )+1;
	}
	else
	{
		$i=1;
	}	
	$count = mysqli_num_rows(mysqli_query($con,$sql));
	
	/*$strget="";
	$rowsPerPage =4;
	$sql="select * from registration order by id desc";
	$result=mysqli_query($con,getPagingQuery($sql, $rowsPerPage,$strget));
	$pagingLink = getPagingLink($sql, $rowsPerPage,$strget);
	$num=mysqli_num_rows(mysqli_query($con,$sql));*/
	
	if(isset($_REQUEST['mode']))
	{
		$mode=$_REQUEST['mode'];
		$id=$_REQUEST['id'];
		if($mode=="deact")
		{
			mysqli_query($con,"update registration set memberstatus='1' where id='$id'");
			header("Location:membermanagement.php");
		}
		else if($mode=="act")
		{
			mysqli_query($con,"update registration set memberstatus='0' where id='$id'");
			header("Location:membermanagement.php");
		}
		else if($mode=="delete")
		{
			mysqli_query($con,"delete from registration where id='$id'");
			header("Location:membermanagement.php?delete");
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
function trimAll(sString){
	while (sString.substring(0,1) == ' '){
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' '){
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function validatesettings()
{
	var freepost=document.settings.freepost.value;
	if(trimAll(freepost)=="")
	{
		alert("Enter Free Post count");
		document.settings.freepost.value='';
		document.settings.freepost.focus();
		return false;
	}
}
</script>
<script type="text/javascript">
function validate()
{
if(document.settings.paypalsettings.value=="")
{
alert("Please Enter the Paypal Email-Id");
document.settings.paypalsettings.focus();
return false;
}
if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.settings
		.paypalsettings.value)))
		{
		alert("Invalid E-mail Address! ");
		document.settings.paypalsettings.value="";
		document.settings.paypalsettings.focus();
		return false;
		} 

}
</script>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Members Management</b></a></article>
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
		<?php if(isset($_REQUEST['delete'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Members Management</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<!--<tr>
				<td height="27" bgcolor="#669966" class="adminheading" colspan="2">&nbsp;&nbsp;Member Management</span></td>
				</tr>-->
				<tr><td width="51%" height="129">
					<form name="searchform" action="membersearch.php" method="post">
					<table width="95%" align="right" cellpadding="0" cellspacing="0" border="0">
						<tr class="normal"><td width="84" height="37">&nbsp;&nbsp;&nbsp;&nbsp;Keyword</td>
						<td width="7">:</td>
						<td width="272"><input type="text" name="keyword" /></td></tr>
						<tr class="normal">
						  <td width="84" height="37">&nbsp;&nbsp;&nbsp;&nbsp;Type</td>
						  <td width="7">:</td>
						  <td width="272">
						    <input name="membershiptype" type="radio" value="GoldSupplier" />
						  
						    Gold
						    
						    <input name="membershiptype" type="radio" value="SilverSupplier" />
						    
						    Silver
						    
						    <input name="membershiptype" type="radio" value="BronzeSupplier" />
						    
						    Bronze
						    <label>
						    <input name="membershiptype" type="radio" value="free" />
						    </label>
						    Free</td>
						</tr>
						<tr class="normal"><td height="34">&nbsp;&nbsp;&nbsp;&nbsp;Search in</td>
						<td>:</td><td><input type="radio" name="searchin" value="username" checked="checked" />Name/Username
							<input type="radio" name="searchin" value="company" />Company Name
						</td></tr>
						<tr class="normal"><td height="26" colspan="3" align="center"><input type="submit" name="submit" value="Search" /></td>
						</tr>
				  </table></form>
				</td>
				<td width="49%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr><td height="25"><strong>Report</strong></td>
				</tr>
				<?php
				$acreg=mysqli_query($con,"select * from registration where memberstatus='0'");
				$actnum=mysqli_num_rows($acreg);
				$dareg=mysqli_query($con,"select * from registration where memberstatus='1'");
				$datnum=mysqli_num_rows($dareg);
				$freereg=mysqli_query($con,"select * from registration where membershiptype='free' or membershiptype=''");
				$freenum=mysqli_num_rows($freereg);
				$goldreg=mysqli_query($con,"select * from registration where membershiptype='GoldSupplier'");
				$goldnum=mysqli_num_rows($goldreg);
				$silverreg=mysqli_query($con,"select * from registration where membershiptype='SilverSupplier'");
				$silvernum=mysqli_num_rows($silverreg);
				$bronzereg=mysqli_query($con,"select * from registration where membershiptype='BronzeSupplier'");
				$bronzenum=mysqli_num_rows($bronzereg);
				?>
				<tr><td class="normal" height="25">No. Active Members  : <?php echo $actnum;?></td><td width="47%" class="normal">Free Members : <?php echo $freenum;?></td></tr>
				<tr><td class="normal" height="25">No. Deactive Members: <?php echo $datnum;?></td><td class="normal">Gold Members : <?php echo $goldnum;?></td></tr>
				<tr><td class="normal" height="25"><a href="memexcl.php" class="news">Export This Members</a></td><td class="normal">Silver Members : <?php echo $silvernum;?></td></tr>
				<tr><td>&nbsp;</td><td class="normal">Bronze Members : <?php echo $bronzenum;?></td></tr>
				</table>
				</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td height="358" valign="top" colspan="2">
					<table width="732" height="79" align="center" cellspacing="0" style="border:1px solid #fff; ">
						<tr bgcolor="#D8F1E4">
					  <td height="29" align="left" bgcolor="#99CCFF" colspan="3">&nbsp;&nbsp;<strong>All Members</strong></td>
					  
					  </tr>
						<?php while($members=mysqli_fetch_array($result)){
							$memberid=$members['id'];
							$country=$members['country'];
							$countryname=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
							//sell offers count
							$sellcount=mysqli_fetch_array(mysqli_query($con,"select count(*) from tbl_seller where user_id='$memberid'"));
							//buy offers count
							$buycount=mysqli_fetch_array(mysqli_query($con,"select count(*) from buyingleads where id='$memberid'"));
							//product post count
							$productcount=mysqli_fetch_array(mysqli_query($con,"select count(*) from product where userid='$memberid'"));
							//company profile
							$com_profile=mysqli_fetch_array(mysqli_query($con,"select bussiness_type from companyprofile where user_id='$memberid'"));
							if($com_profile[0]==""){$profile="No";}else{$profile="Yes";}
						?>
						<tr class="smallfont">
						  <td>
							  <table width="100%" style="border-bottom:1px solid #99CCFF;">
								  <tr><td width="252">&nbsp;<strong><?php echo $members['email'];?></strong></td>
								    <td width="154"><strong><?php echo $members['firstname'];?></strong></td>
									<td width="152"><strong>Currently <font color="#339966"><?php echo $members['membershiptype'];?></font></strong></td>
									<td width="150"><strong>Offers Posted</strong></td>
								</tr>
								<tr>
									<td>&nbsp;Join Date :  <?php echo $members['added_date'];?></td>
									<td><?php echo $members['firstname']." ".$members['lastname'];?></td>
									<td>Company Name: <?php echo $members['companyname'];?></td>
									<td>Sell Offers: &nbsp;&nbsp;&nbsp;&nbsp;<a href="sellofferspending.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;"><?php echo $sellcount[0];?></a><br />Buy Offers: &nbsp;&nbsp;&nbsp;&nbsp;<a href="buyofferspending.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;"><?php echo $buycount[0];?></a></td>
								</tr>
								<tr>
									<td>&nbsp;Last Access Date : <?php echo $members['last_visit_date'];?></td>
									<td>Phone Number :<br /><?php echo "+".$members['countrycode']." - ".$members['areacode']." - ".$members['phonenumber'];?>
									</td>
									<td><?php if($members['jobtitle']!='')
									{ ?>
									Job Title: <?php echo $members['jobtitle'];
									}?>
									</td>
									<td>Product Catalog: &nbsp;<a href="prod_approved.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;"><?php echo $productcount[0];?></a><br />Company Profile: <a href="co_profile.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;"><?php echo $profile;?></a></td>
								</tr>
								<tr><td colspan="4">&nbsp;<a href="profileview.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;">[View Profile]</a>&nbsp;&nbsp;<?php ?><a href="editprofile.php?uid=<?php echo $members['id'];?>" class="sellertextsmall" style="color:#047AB6;">[Edit]</a>&nbsp;&nbsp;<a href="" onclick="javascript:if(confirm('Are you sure to delete this account'))href='membermanagement.php?id=<?php echo $members['id'];?>&mode=delete';else return false;" class="sellertextsmall" style="color:#047AB6;">[Delete]</a>&nbsp;&nbsp;<?php if($members['memberstatus']==0){?><a href="" onclick="javascript:if(confirm('Are you sure to deactivate this account'))href='membermanagement.php?id=<?php echo $members['id'];?>&mode=deact';else return false;" class="sellertextsmall" style="color:#047AB6;">[Deactivate]</a><?php }else if($members['memberstatus']==1){?><a href="" onclick="javascript:if(confirm('Are you sure to activate this account'))href='membermanagement.php?id=<?php echo $members['id'];?>&mode=act';else return false;" class="sellertextsmall" style="color:#047AB6;">[Activate]</a><?php }?><?php ?>
									&nbsp;&nbsp;<!--<a href="messages.php" class="sellertextsmall">[Messages]</a>-->
								</td>
								</tr>
								<tr><td colspan="4">&nbsp;</td></tr>
								
					  		</table>
						  </td>
						</tr>
						<?php } ?>
						
						<?php if($count>$rowsPerPage){?><tr><td colspan="3" align="center"><?php echo $pagingLink;?></td></tr><?php }?>   
						<tr><td colspan="3" align="center" height="35"><a href="memexcl.php" class="news">Export This Members</a></td></tr>
						<?php if($count<=0){?>
						<tr><td colspan="3" align="center"><span class="style1">No Members Found</span></td>
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