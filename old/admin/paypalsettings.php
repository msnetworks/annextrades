<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$result=mysqli_query($con,"select * from `paypalsettings`");
	$details=mysqli_fetch_array($result);
	$id=$details['pay_id'];
	$count=mysqli_num_rows($result);
	
	if(isset($_REQUEST['submit']))
	{
		$paypal=$_REQUEST['paypalsettings'];
		
		if($count>0)
		{
			mysqli_query($con,"update `paypalsettings` set `paypalsettings`='$paypal' where `pay_id`='$id'");
			header("Location:paypalsettings.php?msg=upd");
		}
		else
		{
			mysqli_query($con,"insert into `paypalsettings`(`paypalsettings`) values('$paypal')");
			header("Location:paypalsettings.php?msg=ins");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Paypal Settings</b></a></article>
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
		<header><h3 class="tabs_involved">Paypal Payment Settings</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="settings" action="" method="post">
					<table width="80%" height="147" align="center">
					<?php if(isset($_REQUEST['msg'])){$msg=$_REQUEST['msg']?>
						<tr><td height="28" colspan="3" align="center"><span class="style1" style="color:#FF0000;"><?php if($msg=="upd"){?><b>Updated Successfully</b><?php }else{?>Added Successfully<?php }?></span></td>
						</tr>
					<?php }?>
						<tr>
							<td width="180" class="inTxtNormal" style="font-size:12px;"><strong> Paypal Id</strong></td>
						  	<td width="556"><input type="text" name="paypalsettings" value="<?php echo $details['paypalsettings'];?>" style="width:300px; height:18px;"/></td>
						</tr>
						
						<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Save" /></td></tr>
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