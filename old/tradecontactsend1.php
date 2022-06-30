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
$mail="praveena.inet@gmail.com";
$contact_person=$result['contact_person'];
if(isset($_REQUEST['submit']))
{
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$businessmail=$_REQUEST['businessmail']; 

$_SESSION['value']=$businessmail;

 $messages = "<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
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

	$mail->AddAddress($mail);
	$mail->AddReplyTo($businessmail);
	$mail->AddCustomHeader('Return-path:'.$businessmail);
	$mail->Sender = $businessmail;
	$mail->Subject =$subject;
	$mail->Body = $message;
	$mail->WordWrap = 50;
	$mail->Send();

header("location:tradecontactsuccess.php?id=$sid");


}
			  ?>
                                <form id="tradecontact" name="tradecontact" method="post" action="">
                                  <tr>
                                    <td valign="top" ><table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td colspan="2" align="center" ><table width="100%" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td colspan="4" height="35" align="left" class="normalbold">&nbsp;<strong><?php echo $contact_organizer; ?> : &nbsp;<span class="bluebold"><?php echo ucfirst($result['show_name']);?></span></strong></td>
                                              </tr>
                                              <tr>
                                                <td width="4%">&nbsp;</td>
                                                <td height="30" align="left" class="seller" >&nbsp;&nbsp;<span class="redbold">*</span> <?php echo $mail_to; ?></td>
                                                <td colspan="3" class="prodcuts_search" align="left"><?PHP echo $mail;?></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td width="34%" height="30" align="left" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $subject; ?></td>
                                                <td colspan="3" align="left"><input type="text" name="subject" size="30"/></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" valign="top" class="seller" >&nbsp;&nbsp;<span class="redbold">*</span> <?php echo $message; ?>:</td>
                                                <td colspan="3" align="left"><textarea name="message" cols="35" rows="4"></textarea></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4" height="35" align="left" class="normalbold">&nbsp;<?php echo $your_contact_info; ?>:</td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td height="30" align="left" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $name; ?>:</td>
                                                <td class="seller"><?php echo $fname; ?>: </td>
                                                <td class="seller">&nbsp;<?php echo $lname; ?>:</td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left">&nbsp;</td>
                                                <td width="30%" height="30" align="left"><input type="text" name="firstname" /></td>
                                                <td width="32%" align="left"><input type="text" name="lastname" /></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td height="30" align="left" class="seller">&nbsp;&nbsp;<span class="redbold">*</span><?php echo $your_bussiness_email; ?>:</td>
                                                <td colspan="2" align="left"><input type="text" name="businessmail" class="textBox"/></td>
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