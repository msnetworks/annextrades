<?php include("includes/header.php");
$sess_id = isset($_SESSION['user_login']) ? $_SESSION['user_login']:'';
//print_r($_REQUEST['property']);



 ?>
 <style type="text/css">
 .redbold
 {
 color:#FF0000;
 }
 
 </style>
 
 <script type="text/javascript">
 function val_trade()
 {
 //alert("hello");
 if(document.getElementById('subject').value=="")
 {
 alert("Enter the subject");
 document.getElementById('subject').focus();
 return false;
 }
 
 if(document.getElementById('message').value=="")
 {
 alert("Enter the message");
 document.getElementById('message').focus();
 return false;
 }
 
 if(document.getElementById('firstname').value=="")
 {
 alert("Enter the firstname");
 document.getElementById('firstname').focus();
 return false;
 }
 
 if(document.getElementById('lastname').value=="")
 {
 alert("Enter the lastname");
 document.getElementById('lastname').focus();
 return false;
 }
 
  if(document.getElementById('businessmail').value=="")
 {
 alert("Enter the business email");
 document.getElementById('businessmail').focus();
 return false;
 }
 
  if(document.getElementById('reg_answer').value=="")
 {
 alert("Enter the security code");
 document.getElementById('reg_answer').focus();
 return false;
 }
 
 }
 
 </script>
 
 
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span><strong> <?php echo $contact_info; ?></strong> </span></div>
<div style="border: solid 1px #CFCFCF;">

 
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                               
                                <?php
$pro=$_REQUEST['id'];
$res="select * from tbl_tradeshow where show_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
$sid=$result['show_id'];
//$mail=$result['business_email'];
$mail="elakkiya.inet@gmail.com";
$contact_person=$result['contact_person'];
if(isset($_REQUEST['submit']))
{
$mailtoo=$_REQUEST['mail_to'];
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$businessmail=$_REQUEST['businessmail']; 
$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
$_SESSION['value']=$businessmail;
 include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_REQUEST['reg_answer']);
/*$valid="true";*/
  if($valid == true) {

 $messages = "<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$site_logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $contact_person</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>You have Received The cotact mail from $firstname</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email : $businessmail</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Message : $message</td>
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
/*
$from=$businessmail;
$to=$mail;

$headers = 'From:' . $from ."\r\n";
	      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
		  //@mail($mail,$subject,$messages,$headers);
		  
$from=$businessmail;
//$to=$res_mail;		  
		  $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:$webname<$businessmail>" . "\r\n";
				
$to=$res_mail;		  
		 require_once("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	 $mail->Host = "mail.inetmassmail.com"; // SMTP server 
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = $businessmail;
	$mail->FromName = $webname;

	$mail->AddAddress($mailtoo);
	$mail->AddReplyTo($businessmail);
	$mail->AddCustomHeader('Return-path:'.$businessmail);
	$mail->Sender = $businessmail;
	$mail->Subject =$subject;
	$mail->Body = $messages;
	$mail->WordWrap = 50;
	$mail->Send();

header("location:tradecontactsuccess.php?id=$sid");
unset($_SESSION['tmp_subject']);
unset($_SESSION['tmp_message']);
unset($_SESSION['tmp_firstname']);
unset($_SESSION['tmp_lastname']);
unset($_SESSION['tmp_businessmail']);

}
else 
{
$_SESSION['tmp_subject']=$subject;
$_SESSION['tmp_message']=$message;
$_SESSION['tmp_firstname']=$firstname;
$_SESSION['tmp_lastname']=$lastname;
$_SESSION['tmp_businessmail']=$businessmail; 
header("location:tradecontactsend.php?id=$sid&cap_err");
}

 
}
			  ?>
 <form id="tradecontact" name="tradecontact" method="post" action="" onsubmit="return val_trade();">
<tr>
<td valign="top" ><table width="100%" cellspacing="0" cellpadding="0"> 
<tr>
				   <?php
if(isset($_REQUEST['cap_err']))
{
?>
<td colspan="4" align="center" style="color:#FF0000; font-weight:bold; font-size:12px;">Captcha Error, Try again !!!</td>
<?php }

 ?></tr>
<tr>
<td colspan="2" align="center" ><table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td colspan="4" height="35" style="padding-left:100px;" class="normalbold">&nbsp;<strong><?php echo $contact_organizer; ?> : &nbsp;<span class="bluebold"><?php echo ucfirst($result['show_name']);?></span></strong></td>
</tr>



<tr>
<td width="4%">&nbsp;</td>
<td height="30" align="right" class="seller" >&nbsp;&nbsp;<span class="redbold">*</span> <?php echo $mail_to; ?> : </td>
<td colspan="3" class="prodcuts_search">&nbsp;&nbsp;<?PHP echo $mail;?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td width="34%" height="30" align="right" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $subject; ?> : </td>
<td colspan="3" >&nbsp;&nbsp;<input type="text" name="subject" id="subject" size="30" value="<?php if(isset($_SESSION['tmp_subject'])) {  echo  $_SESSION['tmp_subject']; } ?>"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right" valign="top" class="seller" >&nbsp;&nbsp;<span class="redbold">*</span> <?php echo $message; ?> : </td>
<td colspan="3"> &nbsp;&nbsp;<textarea name="message" id="message" cols="35" rows="4"><?php if(isset($_SESSION['tmp_message'])) {  echo $_SESSION['tmp_message']; } ?></textarea></td>
</tr>
<tr>
<td colspan="4" height="35" style="padding-left:100px;" class="normalbold">&nbsp;<strong><?php echo $your_contact_info; ?> :</strong> </td>
</tr>
<tr>
<td>&nbsp;</td>
<td height="30" align="right" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $name; ?> : </td>
<td class="seller">&nbsp;&nbsp;<?php echo $fname; ?>: </td>
<td class="seller">&nbsp;&nbsp;<?php echo $lname; ?>:</td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">&nbsp;</td><?php $sql=mysqli_query($con,"select * from registration where id='$sess_id'");
$res=mysqli_fetch_array($sql);
 ?>
<td width="30%" height="30" >&nbsp;&nbsp;<input type="text" name="firstname" id="firstname" value="<?php echo $res['firstname']; ?>" /></td>
<td width="32%" >&nbsp;&nbsp;<input type="text" name="lastname" id="lastname" value="<?php echo $res['lastname']; ?>" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td height="30" align="right" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $your_bussiness_email; ?> : </td>
<td colspan="2"> &nbsp;&nbsp;<input type="text" name="businessmail" id="businessmail" class="textBox" value="<?php if(isset($_SESSION['tmp_businessmail'])) {  echo  $_SESSION['tmp_businessmail']; } ?>"/></td>
</tr>

<tr>
<td>&nbsp;</td>
<td height="25" align="right" ><em style="color:#FF0000;">*</em><?php echo $code; ?>:</td>
<td colspan="3">
	
	<div>
	<div style="float:left; ">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="securimage_show.php?sid=<?php echo md5(time()) ?>" /></div>
        <div style="float:left;">
		<div>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
			    <param name="allowScriptAccess" value="sameDomain" />
			    <param name="allowFullScreen" value="false" />
			    <param name="movie" value="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" />
			    <param name="quality" value="high" />
			
			    <param name="bgcolor" value="#ffffff" />
			    <embed src="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			  </object>
</div>
  <div>      
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a>
</div>
</div>

</div>

</td>

  </tr>
  

  <tr>
  <td>&nbsp;</td>
    <td align="right"><?php echo $enter_code; ?>:</td>
  
<td colspan="3" style="padding-left:6px;"><input name="reg_answer" id="reg_answer" type="text" style="width:163px;" autocomplete="OFF"/></td>

  </tr>
  
  <tr>
  <td colspan="2">&nbsp;</td>
  </tr>

<tr>
<td colspan="4" align="center" height="30"><input type="submit" name="submit" value="<?php echo $submit; ?>" class="search_bg" onclick="return checking(this);"/></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr> </tr>
<tr>
<td><img src="images/spacer.gif" width="1" height="10" /></td>
</tr>
</form>
<tr>
<td >&nbsp;</td>
</tr>
<tr> </tr>
</table>  


</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>