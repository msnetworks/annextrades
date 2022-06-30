<?php 
	include("includes/header.php");
	include("includes/pagination.php");
	
	if(isset($_REQUEST['send']))
	{
		$name=$_REQUEST['name'];
		$membership_type=$_REQUEST['membership_type'];
		$email=$_REQUEST['email'];
		$subject=$_REQUEST['subject'];
		$message=$_REQUEST['message'];
		$entrydate=date('Y-m-d');
		$con_ip=$_SERVER['REMOTE_ADDR'];
		
		if(!(empty($session_user)))
		{
		//$mailurl="nithya@i-netsolution.com";
			$memberid=$session_user;
			$qry_tmp=mysqli_query($con,"SELECT * FROM registration WHERE id='$memberid'") or die("Select registration error ".mysqli_error($con));
				$membdetail=mysqli_fetch_array($qry_tmp);
				if($membership_type == $membdetail['membershiptype'])
				{
					$insert=mysqli_query($con,"insert into feedback (yourname, memberid, membertype, email, subject, message, entrydate) values ('$name', '$memberid', '$membership_type', '$email', '$subject', '$message', '$entrydate')") or die("Feed back insert error ".mysqli_error($con));
		
		$ip = $_SERVER['REMOTE_ADDR'];			
		//$to=$mailurl;
		$Subject="$subject";
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
		
		/*$headers  .= 'MIME-Version: 1.0' . "\r\n";
	
		$headers .= 'From:' . $email ."\r\n";

		$headers .= 'To:' . $to ."\r\n";
		
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/

		$SendMessage = "<table width='450' border='0' cellpadding='0' cellspacing='0' style='border:solid 10px #25ABC4;'>
		<tr bgcolor='#FFFFFF' height='25'>
    		<td><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  		</tr>
		<tr bgcolor='#FFFFFF' height='30'>
    		<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $name,</b></td>
  		</tr>
		<tr>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; width:100px; color:#000000;'>Name</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; color:#000000;'>$name </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; width:100px; color:#000000;'>Memberid</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; color:#000000;'>$memberid </td>
		</tr>	
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Membership type</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$membership_type </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Email</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$email </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Subject</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$subject </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Message</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$message </td>
		</tr>
		<tr bgcolor='#FFFFFF'>
    	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
      ".$webname."<br>
    	</td>
 		</tr>
		 <tr height='40'>
    	 <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size:10px;
color:#000000;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
         </tr>	
		</table>";
		
		
		ini_set("SMTP","mail.inetmassmail.com");
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From:'.$mailurl."\n";
		
		include ("mailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "mail.inetmassmail.com"; // SMTP server
		$mail->SMTPAuth = true;
		$mail->Username = "info@inetmassmail.com";
		$mail->Password = "inetsol";
	
		$mail->From = "$email <".$email.">";
		$mail->FromName = $name;
		$mail->AddAddress($mailurl);
		$mail->AddReplyTo($email);
		$mail->AddCustomHeader('Return-path:'.$email);
		$mail->Sender = $email;
		$mail->Subject =$Subject;
		$mail->Body = $SendMessage;
		$mail->WordWrap = 50;
		$mail->Send(); 
		
		/*echo $mailurl;
		echo $email;
		echo $name;
		echo $Subject;
		echo $SendMessage; exit;*/
		
		/*$rsmail=mail($to,$Subject,$SendMessage,$headers);
		echo $to;
		echo $Subject;
		echo $SendMessage;
		echo $headers; exit;
		if($rsmail)
		{	
			//echo "huhuih";
			header("Location:send_contact.php?succ");
		}*/
		
		header("Location:send_contact.php");
			}
			else
			{
				header("Location:contact.php?error=$membership_type");
			}
		}
				else
				{
					header("Location:contact.php?error1");
				}
		}
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/help_side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<script type="text/javascript">

function validate(doc)
{
if(document.contact.name.value=="")
{
alert("Please enter Your name");
document.contact.name.focus();
return false;
}
if(document.contact.membership_type.value=="")
{
alert("Please select the Membership type");
document.contact.membership_type.focus();
return false;
}
if(document.contact.email.value=="")
{
alert("Please enter the Email");
document.contact.email.focus();
return false;
}
if(echeck(document.contact.email.value)==false)
{

document.contact.email.focus();
return false;
}
if(document.contact.subject.value=="")
{
alert("Please enter the subject ");
document.contact.subject.focus();
return false;
}
if(document.contact.message.value=="")
{
alert("Please enter the Message");
document.contact.message.focus();
return false;
}
}
function echeck(str) 
{
 var at="@"
 var dot="."
 var lat=str.indexOf(at)
 var lstr=str.length
 var ldot=str.indexOf(dot)
 if (str.indexOf(at)==-1) 
 {
   alert("Invalid E-mail ID")
   return false
 }
 if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(at,(lat+1))!=-1)
 {
  alert("Invalid E-mail ID")
  return false
  }
 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot,(lat+2))==-1)
 {
  alert("Invalid E-mail ID")
  return false
 }		
 if (str.indexOf(" ")!=-1)
 {
  alert("Invalid E-mail ID")
  return false
 }
 return true					
}
</script>

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb; height:25px; padding-top:7px;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $contactus; ?></b></div>
<div style="width:700px;">
<div style="color:#C55000; margin-left:10px; margin-top:15px; float:left; width:450px;" align="left"><b style="font-size:14px;"><?php echo $email_us; ?></b></div>
<div align="right" style="float:left; margin-top:15px; width:200px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $required_info; ?></div>
</div>
<table border="0" width="100%" style="margin-top:10px;">
<form name="contact" method="post" action="contact.php" onsubmit="return validate(this);">
	<?php if(isset($_REQUEST['error'])) { ?>
	<tr>
    	<td colspan="3" align="center"><font color="#FF0000" face="Arial, Helvetica, sans-serif">You are not <?php echo $_REQUEST['error']; ?>, <?php echo $contact_err; ?>.</font></td>
    </tr>
	<tr>
        <td colspan="3">&nbsp;</td>
    </tr>
	<?php } ?>
	<?php if(isset($_REQUEST['error1'])) { ?>
	<tr>
    	<td colspan="3" align="center"><font color="#FF0000" face="Arial, Helvetica, sans-serif"><?php echo $con_login_err; ?>.</font></td>
    </tr>
	<tr>
        <td colspan="3">&nbsp;</td>
    </tr>
	<?php } ?>
	<tr>
		<td width="22%" style="padding-left:50px; line-height:30px;"><b><span style="color:#FF0000;">*</span>&nbsp;<?php echo $name; ?></b></td>
		<td width="4%">&nbsp;</td>
		<td width="68%"><input type="text" name="name" style="width:250px; height:15px;" /></td>
	</tr>
	<tr>
		<td style="padding-left:50px; line-height:30px;"><b><span style="color:#FF0000;">*</span>&nbsp;<?php echo $memeber_type; ?></b></td>
		<td>&nbsp;</td>
		<td><select name="membership_type" id="membership_type" style="width:250px; font-size:11px;">
		<option value=""><?php echo $sel_member_type; ?></option>
		<option value="GoldSupplier"><?php echo $gole_member; ?></option>
        <option value="SilverSupplier"><?php echo $silver_member; ?></option>
        <option value="bronzeSupplier"><?php echo $bronze_member; ?></option>
		<option value="free"><?php echo $free_member; ?></option>
		</select></td>
	</tr>
	<tr>
		<td style="padding-left:50px; line-height:30px;"><b><span style="color:#FF0000;">*</span>&nbsp;<?php echo $email; ?></b></td>
		<td>&nbsp;</td>
		<td><input type="text" name="email" style="width:250px; height:15px;" /></td>
	</tr>
	<tr>
		<td style="padding-left:50px; line-height:30px;"><b><span style="color:#FF0000;">*</span>&nbsp;<?php echo $subject; ?></b></td>
		<td>&nbsp;</td>
		<td><input type="text" name="subject" style="width:250px; height:15px;" /></td>
	</tr>
	<tr>
		<td style="padding-left:50px; line-height:30px;"><b><span style="color:#FF0000;">*</span>&nbsp;<?php echo $message; ?></b></td>
		<td>&nbsp;</td>
		<td><textarea name="message" rows="3" cols="29"></textarea></td>
	</tr>
	<tr>
		<td align="center" colspan="3"><input type="submit" name="send" value="<?php echo $submit; ?>" class="search_bg" style="margin-top:20px; margin-bottom:20px;"/>&nbsp;&nbsp;&nbsp;<input type="submit" value="<?php echo $reset; ?>" class="search_bg" style="margin-top:20px; margin-bottom:20px;"/></td>
	</tr>
</form>
</table>

</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
