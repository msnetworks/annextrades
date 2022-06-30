<?php 
session_start();
include("includes/header.php");

if(isset($_POST['button']))
{
$email=$_POST['email'];
$pass=$_POST['pass'];

//echo "SELECT * FROM registration WHERE email='$email'"; exit;

$select_login="SELECT * FROM registration WHERE email='$email'";
$res_login=mysqli_query($con,$select_login);
$num_login=mysqli_num_rows($res_login);
if($num_login>0)
{
$fetch_login=mysqli_fetch_array($res_login);
$firstname=$fetch_login['firstname'];
$password=$fetch_login['password'];

$ip = $_SERVER['REMOTE_ADDR'];
$mail_url = "https://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
      	$subject="Forgot Password $webname"; 
		
	$msg  = "<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='https://annextrades.com/assets/images/logo.png'  width='200'  border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $firstname</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>
      Your Login Details :</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Email : $email</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Password : $password</td>
  </tr>
  
  <tr bgcolor='#FFFFFF'>
    <td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
      ".$webname."<br>
    </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
  </tr>
</table>";
				
	/*ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$mailurl <".$mailurl.">";
	$mail->FromName = $webname;
	$mail->AddAddress($email);
	$mail->AddReplyTo($mailurl);
	$mail->AddCustomHeader('Return-path:'.$mailurl);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); */
	
	ini_set("SMTP","mail.inetmassmail.com");
  $mailurl = 'welcome@annextrades.com';
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'From:'.$mailurl. "\r\n";
  			//$to      = $Email;	
			
$to=$email;
if(mail($to,$subject,$msg,$headers))
	{
	header("location:forgot.php?succ"); 
	
	}


else
{
header("location:login.php?error");
}
}
}
 ?>
<script type="text/javascript">
function validate()
{
var email = document.getElementById('email').value;
if(email=="")
{
alert("Enter The Email");
document.getElementById('email').focus();
return false;
}
else
{
var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.getElementById('email').value)==false)
	{
	alert("Enter the Valid Email Address");
	document.getElementById('email').focus();
	//document.register.email.value = "";
	return false;
	}
}
var b=document.getElementById('pass').value;
if(b=="") {

alert("Enter the Password");
document.getElementById('pass').focus();
return false;
}

}

</script>

<div class="body-cont"> 

<div class="body-cont1"> 

<div class="signin-cont"> 

<div class="signin-top"></div>
<div class="signin-bg">
<form name="login_form" method="post" onsubmit="return validate();">
  <table width="325" border="0" cellspacing="0" cellpadding="0">
  <?php if(isset($_REQUEST['scc'])) { ?>
   
   <tr><td align="left" style="color: #009900; font-weight:bold;"><?php echo $activated_success_msg; ?></td></tr>
   <?php } ?>
   
  
	
    <tr>
      <td align="left" valign="top" class="signin-heading"><?php echo $fffor; ?></td>
    </tr>
	<?php if(isset($_REQUEST['error'])) { ?>
   
   <tr><td style="color:#FF0000; font-weight:bold;"><?php echo $correct_email_error; ?></td></tr>
   <?php } ?>
   
   <?php if(isset($_REQUEST['aerr'])) { ?>
   
   <tr><td align="left" style="color:#FF0000; font-weight:bold;"><?php echo $activate_error_msg; ?></td></tr>
   <?php } ?>
   
     <?php if(isset($_REQUEST['succ'])) { ?>
   
   <tr><td align="left" style="color: #009900; font-weight:bold;"><?php echo $password_success_msg; ?></td></tr>
   <?php } ?>
    <tr>
      <td align="left" valign="top"><strong><?php echo $email_id; ?> </strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="text" name="email" id="email" class="txtfield2" /></td>
    </tr>
   <!-- <tr>
      <td align="left" valign="top"><strong>Password</strong></td>
    </tr>-->
    <!--<tr>
      <td align="left" valign="top"><input type="password" name="pass" id="pass" class="txtfield2" /></td>
    </tr>-->
    <!--<tr>
      <td align="left" valign="top"><a href="forgot.php">Forgot Password?</a> <br/> <br/></td>
    </tr>-->
    <tr>
      <td align="center" valign="top"><input type="submit" name="button" id="button" value="" class="signin" /></td>
    </tr>
  </table></form>
</div>
<div class="signin-bot"> </div>

</div>



<div class="joinpoints"> <p class="point-heading2"><?php echo $not_on_lower; ?>? </p> 
<ul> 
<li><?php echo $instant; ?>!</li>
<li><?php echo $showcase; ?>!</li>
<li><?php echo $post_com; ?>!</li>
<li><?php echo $advertise_business; ?>! </li>
</ul> 

<div class="points-bg2">
  <table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="173" align="center" valign="top"><p><a href="register.php"><img src="images/joinfree.png" alt="" width="154" height="35" /></a></p></td>
      </tr>
  </table>
</div></div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>
