<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$idd=$_REQUEST['id'];
if(isset($_REQUEST['Submit']))
{
$subject=$_REQUEST['subject'];
$messages=$_REQUEST['message'];

$sql=mysqli_fetch_array(mysqli_query($con,"select * from feedback where id='$idd'"));
$mail=$sql['email'];
 $from=$mailurl;
  $to  = $mail;
  $subject = $subject;
  $message = 
	
"<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #FE7903;\">
  <tr bgcolor=\"#FFEAC2\">
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
  
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">&nbsp;&nbsp;Detail Newsletter</span></td>
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
  	  
			//mail($to,$subject,$message,$headers);		
		if(mail($to,$subject,$message,$headers))
		{
	     	header("location:feedbackreplysuccess.php?err=1");
			exit; 	 
		}
		header("location:feedbackreplysuccess.php?err=1");
		
//header("location:forgotpassword.php?error=4");
}
/*echo"<script language='javascript'>
		opener.location.reload();
        self.close();
	</script>";
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validation()
{
if(document.feedback.subject.value=="")
{
alert("Please enter the Subject");
document.feedback.subject.focus();
return false;
}
if(document.feedback.subject.value.length < 10)
{
alert("Subject Should Be Atleast 10 Characters in Length");
document.feedback.subject.focus();
return false;
}
if(document.feedback.message.value=="")
{
alert("Please enter the Message");
document.feedback.message.focus();
return false;
}
if(document.feedback.message.value.length < 10)
{
alert("Message Should Be Atleast 10 Characters in Length");
document.feedback.message.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Feedback</b></a></article>
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
		<header><h3 class="tabs_involved">Feedback Reply</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="feedback" method="post" action="" onsubmit="return validation();">
          
		  <table width="85%" border="0" align="center" cellpadding="4" cellspacing="0">
            
			<?php
			$idd=$_REQUEST['id'];
			$res=mysqli_fetch_array(mysqli_query($con,"select * from feedback where id='$idd'"));
			?>
			<tr>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
			<tr>
              <td width="40%" align="left" class="normalbold" height="25">&nbsp;<span style="padding-left:120px;">To</span></td>
			  <td width="60%" class="gbold"><input type="text" readonly="true" style="background:#FFFFFF; width:200px; border:1px #7B9EBD solid;" value="<?php echo $res['email'];?>" /></td>
            </tr>
            <tr>
            <td height="25" align="left"><span class="redbold" style="padding-left:120px;">*</span><strong>Subject</strong></td>
			<td> <input type="text" style="width:300px;" name="subject" /></td>
            </tr>
            <tr>
              <td width="14%" class="left"><span class="redbold" style="padding-left:120px;">*</span><strong>Message</strong></td>
              <td width="60%" height="26"><textarea style="width:400px;" name="message" cols="25" rows="5"></textarea></td>
            </tr>
            <tr>
          <td height="33" colspan="2" align="center">
		  <!--<input name="Submit" type="submit" class="button2" value="Send">-->
		 <input name="Submit" type="submit" class="button2" value="Send">&nbsp;&nbsp;<input type="button" name="Submit2" value="Back" onclick="javascript:history.back();"/></td>
            </tr>
            <tr>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
          </table>
        </form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>