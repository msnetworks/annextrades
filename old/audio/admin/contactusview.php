<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['id']))
	{
	$id=$_REQUEST['id'];
	$sql=mysqli_query($con,"Select * FROM feedback WHERE id='$id'");
	$row=mysqli_fetch_assoc($sql);
	}
	
	if(isset($_REQUEST['btnsubmit']))
	{
		$toemail=$_REQUEST['txtto'];
		$sub=$_REQUEST['txtsub'];
		$mess=$_REQUEST['txtmessage'];
		
		 $headers  = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  $headers .= "From: $mailurl" . "\r\n";
	
	  
	  $message = 
			  
			  "<table width=\"450\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  style='border:solid 1px #31679a;background-color: #f7fdff; padding-top:20px;'>
			    <tr height='25' colspan=\"2\">
			<td style='background-color:#FFFFFF'><a href='".$signin."'><img src='".$signin."images/".$logo."' border='0' /></a></td>
		</tr>
	 <tr>
				<td colspan=\"2\" style='padding:8px;font-size:13px; font-family:trebuchet ms,arial; background-color:#31679a; color: #FFFFFF;' ><strong>
	Thanks For Contacting Us!</strong></td>
				</tr>
	 	
	  <tr>
				<td height=\"30\" colspan=\"2\" style='padding:8px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;' >Dear ,</td>
		
	
	  
	 <tr>
				<td height=\"30\"  style='padding:8px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;' colspan='2'>$mess </td>
		
	  </tr>
	  
	  
	 
	  <tr>
		<td height=\"30\"  style='padding:8px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;' colspan='2' align='justify'>Wishing you the very best of business,</td>
	  </tr>
	 
	  	<tr>
				<td style='padding:8px; font-family:Arial; font-size:11px; text-decoration:none; color:#000000;' colspan=2>Regards,</td>
				</tr>
	  <tr>
		<td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">$webname Service Team</span></td>
	  </tr>
	  <tr height='10'>
			<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #31679a;
color: #FFFFFF;'>&copy; Copyrights ".date("Y")." $webname.com </td>
		</tr>
	</table>";
			  
	mail($toemail,$sub,$message,$headers);
	header("Location:contactus.php?suc=1");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chkvalid()
{
	var frm=document.settings
	
	if(trim1(frm.txtto.value)=="")
	{
		alert("Please Enter The Receiver Email ID");
		frm.txtto.focus()
		return false
	}
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frm.txtto.value)))
	{
		alert("Invalid Email ID.Please Enter The Receiver EmailID Correctly ");
		frm.txtto.focus()
		return false
	}
	if(trim1(frm.txtsub.value)=="")
	{
		alert("Please Enter The Mail Subject");
		frm.txtsub.focus()
		return false
	}

	if(frm.txtmessage.value=="")
	{
		alert("Please Enter The Message To Send");
		frm.txtmessage.focus()
		return false
	}
	
}
function trim1(str)
{
                
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="contactus.php"><b>Contact Information</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['suc']) == 1 ) { ?>
		<h4 class="alert_success">Message sent successfully !...</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Message Details</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="settings" action="" method="post" >
					  <table width="494" height="228" align="center">
						<?php if(isset($_REQUEST['del'])){ ?>
						<tr><td height="28" colspan="8" align="center">&nbsp;</td>
						</tr>
						
						<?php } ?>
						<tr class="normal">
						  <td height="61" class="text" align="center"><strong style="color:#000099;">Subject</strong></td>
						  <td>:</td>
						  <td class="text"><?php echo $row['subject']; ?></td>
					    </tr>
						<tr class="normal">
						  <td width="167" height="65" class="text" align="center"><strong style="color:#000099;">Message</strong></td>
						  <td >:</td>
						  <td width="281" class="text"><?php echo $row['message']; ?></td>
						</tr>
						
					
						<tr><td height="34" colspan="8" align="center"><input type="button" onclick="document.getElementById('divreply').style.display='block';" value="Reply"  /></td>
						</tr>
						<tr>
					<td colspan="3"><div id="divreply" style="display:none">
					<table width="100%" border="0">
					<!--<tr class="normal">
						  <td height="61" class="text" align="center"><strong style="color:#000099;">Subject</strong></td>
						  <td>:</td>
						  <td class="text"><?php echo $row['subject']; ?></td>
					</tr>-->
					  <tr>
						<td width="18%" align="center" class="prodcuts_search"><span class="redbold">*</span>&nbsp;<strong style="color:#000099;">To</strong></td>
						<td width="2%">&nbsp;</td>
						<td class="text"><input type="text" name="txtto" value="<?php echo  $row['email'];?>" style="width:282px;" /></td>
					  </tr>
					  <tr>
					   
						<td class="prodcuts_search" width="18%"><span class="redbold">*</span>&nbsp;<strong style="color:#000099;">Subject</strong></td>
						<td>&nbsp;</td>
						<td><input type="text" name="txtsub" value="Re:<?php echo  $row['subject'];?>" style="width:282px;" /></td>
					  </tr>
				  <tr>
				   
					<td class="prodcuts_search" width="18%"><span class="redbold">*</span>&nbsp;<strong style="color:#000099;">Message</strong></td>
					<td>&nbsp;</td>
					<td><textarea name="txtmessage" rows="4" cols="33"></textarea></td>
				  </tr>
  <tr>
    <td colspan="4" align="center" valign="middle" ><input type="submit" name="btnsubmit" value="Send Reply" onclick="return chkvalid();" /></td>
  </tr>
</table>

					</div>
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