<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$id=$_REQUEST['id'];
	
	$reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$id'"));
	$email=$reg['email'];
	
	if(isset($_REQUEST['submit']))
	{
	$subject=$_REQUEST['subject'];
	$messages=$_REQUEST['message'];
	
	ini_set("SMTP",'mail.i-netsolution.com');
	
 	$from=$mailurl;
  	$to=$email;
  	$subject = $subject;
  	$message = 
	
"<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #FE7903;\"><tr bgcolor=\"#FFEAC2\">
    <td colspan=\"2\"><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#ff7300; text-align:left; padding-bottom:10px; line-height:26px;text-align:center;\">
You're an $webname Member!<br>
</div></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Dear Members,</span></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">&nbsp;&nbsp;Detail Enquiry Reply</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $messages</span></td>
  </tr>
  
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<a href=\"$signin\">Sign in now!</a></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
    
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Wishing you the very best of business,</span></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">$webname Service Team</span></td>
  </tr>
</table>";

  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= 'From:'.$from. "\r\n";
  	
	/*echo $to;
	echo $subject;
	echo $message;
	echo $headers; exit;*/
	  		//mail($to,$subject,$message,$headers);
		if(mail($to,$subject,$message,$headers))
		{
			header("location:enquiryreplysuccess.php?err=1");
			exit;
		}
		header("location:enquiryreplysuccess.php?err=1");
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
if(document.enquiry.subject.value=="")
{
alert("Please Enter the Subject");
document.enquiry.subject.focus();
return false;
}
if(document.enquiry.message.value=="")
{
alert("Please Enter the Message");
document.enquiry.message.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="buyerenquiry.php"><b>Buyer Enquiry</b></a></article>
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
		<header><h3 class="tabs_involved">Enquiry Reply</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="enquiry" action="" method="post" onsubmit="return validate();">
					<table width="80%" height="147" align="center">
					<?php if(isset($_REQUEST['err'])){$err=$_REQUEST['err']?>
						<tr><td colspan="5" align="center"><?php if($err=="1"){?>
			    		<span class="style2" style="color:#996666;"><b>Your Message Has Been Sent Successfully</b></span>
			  		<?php }else{?>
			  			<span class="style2">Added Successfully</span>			  <?php }?></td>
						</tr>
					<?php } ?>
					<tr><td height="35"><strong style="color:#000099;">To</strong></td>
						<td>:</td><td>&nbsp;&nbsp;&nbsp;
						  <?php echo $email;?>
						  </td>
					</tr>
					
					<tr><td height="32"><strong style="color:#000099;">Subject</strong></td>
						<td>:</td><td>&nbsp;&nbsp;&nbsp;
						  <input type="text" name="subject" />
						  </td>
					</tr>
					
					<tr><td height="32"><strong style="color:#000099;">Message</strong></td>
						<td>:</td><td>&nbsp;&nbsp;&nbsp;
						  <textarea name="message" cols="25" rows="6"></textarea>
						  </td>
					</tr>
					
					<tr><td height="34" colspan="3" align="center"><input type="submit" name="submit" value="Send"  />
					</td></tr>
						  
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