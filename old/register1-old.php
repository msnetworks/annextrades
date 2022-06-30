<?php 
include("includes/header.php"); 

$email_add=base64_decode($_REQUEST['em']);
$select_user="SELECT * FROM registration WHERE email='$email_add' "; 
$res_user=mysqli_query($con,$select_user);
$fetch_user=mysqli_fetch_array($res_user);
$userid=$fetch_user['id'];
$firstname=$fetch_user['firstname'];
$lastname=$fetch_user['lastname'];
$password=$fetch_user['password'];
//$url = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
 //$fullpath=$url .'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $server = $_SERVER['DOCUMENT_ROOT'];
$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
if(isset($_POST['button']))
{
$gender=mysqli_real_escape_string($con, $_POST['gender']); 
$address=mysqli_real_escape_string($con, $_POST['address']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$zip_code=mysqli_real_escape_string($con, $_POST['zip_code']); 
$ph_no=mysqli_real_escape_string($con, $_POST['ph_no']);
$mbile_no=mysqli_real_escape_string($con, $_POST['mble_no']);
$fax_no=mysqli_real_escape_string($con, $_POST['fax_no']);
$cmpny_name=mysqli_real_escape_string($con, $_POST['cmpny_name']);
$msg = "";
//echo trim(strtolower($_REQUEST['captcha']));
/*echo $_SESSION['captcha'];
exit;*/
if(($gender == "") || ($address == "") || ($city == "") || ($zip_code == "") || ($ph_no == "") || ($cmpny_name == "")) 
{
$msg = "Please Enter the Mandatory Feild";
}

if(($_SESSION['captcha']!="") && trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha'])
	{  
	
	$_SESSION['gender'] = $gender;
		$_SESSION['address'] = $address;
		$_SESSION['city'] = $city;
		$_SESSION['zip_code'] = $zip_code;
		$_SESSION['ph_no'] = $ph_no;
		$_SESSION['mbile_no'] = $mbile_no;
		$_SESSION['fax_no'] = $fax_no;
		$_SESSION['cmpny_name'] = $cmpny_name;
$msg="Captcha Error.. Try again!"; 

}


/*if(($gender == "") || ($address == "") || ($city == "") || ($zip_code == "") || ($ph_no == "") || ($cmpny_name == "")) 
{
$msg = "Please Enter the Mandatory Feild";
}

if($msg != "")
	{
		$_SESSION['gender'] = $gender;
		$_SESSION['address'] = $address;
		$_SESSION['city'] = $city;
		$_SESSION['zip_code'] = $zip_code;
		$_SESSION['ph_no'] = $ph_no;
		$_SESSION['mbile_no'] = $mbile_no;
		$_SESSION['fax_no'] = $fax_no;
		$_SESSION['cmpny_name'] = $cmpny_name;
		
		$msg="The Validation code does not match!";
		//header("Location:feedback.php?$error");
	}
*/
else
{

		unset($_SESSION['gender']);
		unset($_SESSION['address']);
		unset($_SESSION['city']);
		unset($_SESSION['zip_code']);
		unset($_SESSION['ph_no']);
		unset($_SESSION['mbile_no']);
		unset($_SESSION['fax_no']);
		unset($_SESSION['cmpny_name']);

$select_user="SELECT * FROM registration WHERE email='$email' "; 
$res_user=mysqli_query($con,$select_user);
$fetch_user=mysqli_fetch_array($res_user);
$email_address=$fetch_user['email'];

 $update_reg="UPDATE registration SET gender='$gender', street='$address', city='$city', zipcode='$zip_code', phonenumber='$ph_no', mobile='$mbile_no', faxnumber='$fax_no', companyname='$cmpny_name' WHERE email='$email_add' ";  
$ip = $_SERVER['REMOTE_ADDR'];
      	$subject="Confirmation $title"; 
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
						$msg  = "<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $firstname</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Thank You For Registering This Website. Your Account Created Successfully.<br>Your Login Details :</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Email : $email_add</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Password : $password</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Please <a href='$mail_url/login.php?acc_id=$userid'>Click here</a> to Activate Your Account</td>
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
				
//	ini_set("SMTP","mail.inetmassmail.com");
//	$headers  = "MIME-Version: 1.0\r\n";
//	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//	$headers .= 'From:'.$webname."\n";
//	
//	include ("mailer/class.phpmailer.php");
//	$mail = new PHPMailer();
//	$mail->IsSMTP();
//	$mail->Host = "mail.inetmassmail.com"; // SMTP server
//	$mail->SMTPAuth = true;
//	$mail->Username = "info@inetmassmail.com";
//	$mail->Password = "inetsol";
//
//	$mail->From = "$mailurl <".$mailurl.">";
//	$mail->FromName = $webname;
//	$mail->AddAddress($email_add);
//	$mail->AddReplyTo($mailurl);
//	$mail->AddCustomHeader('Return-path:'.$mailurl);
//	$mail->Sender = $mailurl;
//	$mail->Subject =$subject;
//	$mail->Body = $msg;
//	$mail->WordWrap = 50;
//	


$res_update=mysqli_query($con,$update_reg);
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= 'From:'.$mailurl. "\r\n";
  			//$to      = $Email;	
			
$to=$email_add;
if(mail($to,$subject,$msg,$headers))
{
header("location:login.php?succ");
}
else
{
header("location:register1.php?mail-not-sent");
}
}
/*if($email_address=="")
{
$insert_qry="INSERT INTO registration (firstname,lastname,email,password,country,state,usertype) VALUES ('$firstname','$lastname','$email','$pass','$country','$state','$user_type')";
$res_qry=mysqli_query($con,$insert_qry) or die("insert error");
$email_en=base64_encode($email);
header("location:register1.php?em=$email_en");

}
else
{
header("location:register.php?err");

}
*/
}

?>
<style type="text/css">
.error{
	color: #FF0000;
	font-size:11px;
}
.success{
	color: #33CC00; 
	font-size:11px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
function validate1_form()
{
var gender=document.getElementById('gender').value;
if(gender=="")
{
alert("Select The Gender");
document.getElementById('gender').focus();
return false;
}
var address=document.getElementById('address').value;
if(address=="")
{
alert("Enter The Address");
document.getElementById('address').focus();
return false;
}
var city = document.getElementById('city').value;
if(city=="")
{
alert("Enter The City");
document.getElementById('city').focus();
return false;
}
/*else
{
var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.getElementById('email').value)==false)
	{
	alert("Enter the Valid Email Address");
	document.getElementById('email').focus();
	//document.register.email.value = "";
	return false;
	}

}*/
var zip_code = document.getElementById('zip_code').value;
if(zip_code=="")
{
alert("Enter The Zip code");
document.getElementById('zip_code').focus();
return false;
}
//var pass = document.getElementById('pass').value;
var ph_no=document.getElementById('ph_no').value;
if(ph_no=="")
{
alert("Enter The Phone Number");
document.getElementById('ph_no').focus();
return false;
}
else
{
if(isNaN(document.getElementById('ph_no').value))
{
alert("Phone Number Can accept Number Only");
document.getElementById('ph_no').focus();
return false;
}

}
var cmpny_name = document.getElementById('cmpny_name').value;
if(cmpny_name=="")
{
alert("Enter The Company Name");
document.getElementById('cmpny_name').focus();
return false;
}
var letters_code = document.getElementById('captcha-form').value;
if(letters_code=="")
{
//alert(letters_code);
alert("Enter The Security Code");
document.getElementById('captcha-form').focus();
return false;
}
/*var state = document.getElementById('state').value;
if(state=="")
{
alert("Enter The State");
document.getElementById('state').focus();
return false;
}*/
/*if(document.getElementById('user_type').value=="")
    {
    alert("Please select any one option buyer or seller or both");
	document.getElementById('user_type').focus();
	return false;
   }*/
/*if(document.register1_form.terms.checked=="")
    {
    alert("Please Select The Terms and Conditions");
	document.register1_form.terms.focus();
	return false;
   }*/
   

/*else
	{
	var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.register1_form.email.value)==false)
	{
	alert("Enter the Valid Email Address");
	document.register1_form.email.focus();
	//document.register.email.value = "";
	return false;
	}
	}*/

return true;

}



<!-- http://www.itechroom.com-->
function checkUserName(usercheck)
{
//alert("hai");
	$('#usercheck').html('<img src="images/ajax-loader.gif" />');
	$.post("checkuser.php", {user_name: usercheck} , function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {				   
				  $('#usercheck').html(data);	
			   }
          });
}
</script>

<div class="body-cont"> 

<div class="body-cont1"> 

<div class="register-cont"> 

<div class="register-top"><span class="point-heading" style="font-size:18px;"><?php echo $registe_step; ?> ?</span> <br/>  <span class="point-heading"><?php echo $free; ?>!</span></div>
<div class="register-bg">
<form name="register1_form" action="" method="post" onSubmit="return validate1_form();" >
  <table width="455" border="0" cellspacing="0" cellpadding="0">
   <tr><td>&nbsp;</td></tr><?php if(isset($msg)){?>
   
   <tr><td>&nbsp;</td><td width="354" class="error"><?php echo $msg; ?></td>
   </tr>
   <?php } ?>
	
	 <!--<tr>
      <td align="left" valign="top">First Name : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="fname" id="fname" value="<?php echo $firstname; ?>" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">Last Name : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="lname" id="lname" value="<?php echo $lastname; ?>" class="txtfield2" /></td>
    </tr>-->
	<tr>
      <td align="left" valign="top" width="101"><?php echo $gender; ?> : <span class="mandory">*</span> </td>
      <td  valign="top" style="padding-left:31px;"><input type="radio" name="gender" id="gender" value="Male" checked="checked"/> <?php echo $male; ?> &nbsp; <input type="radio" name="gender" value="Female"/> <?php echo $female; ?> <br /> <br /></td>
    </tr>
	
	<tr>
      <td align="left" valign="top"><?php echo $address; ?>  : <span class="mandory">*</span> </td>
      <td  valign="top" style="padding-left:31px;"><textarea name="address" id="address" class="txtarea1" ><?php echo $_SESSION['address']; ?></textarea><!--<input type="text" name="email" id="email" class="txtfield2" onBlur="checkUserName(this.value)" /><br /><span id="usercheck"  ></span>--></td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $city; ?> :  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="city" id="city" class="txtfield2" value="<?php echo $_SESSION['city']; ?>" /></td>
    </tr>
    <tr>
      <td align="left" valign="top"><?php echo $zip_code; ?> : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="zip_code" id="zip_code" class="txtfield2" value="<?php echo $_SESSION['zip_code']; ?>" /></td>
    </tr>
	
	 <tr>
      <td align="left" valign="top"><?php echo $phone_number; ?>:<span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="ph_no" id="ph_no" class="txtfield2" value="<?php echo $_SESSION['ph_no']; ?>" /></td>
    </tr>
	
	<tr>
      <td align="left" valign="top"><?php echo $mbile_number; ?> : <!--<span class="mandory">*</span>--> </td>
      <td align="right" valign="top"><input type="text" name="mble_no" id="mble_no" class="txtfield2" value="<?php echo $_SESSION['mbile_no']; ?>" /></td>
    </tr>
	
	<tr>
      <td align="left" valign="top"><?php echo $fax_number; ?> : <!--<span class="mandory">*</span>--> </td>
      <td align="right" valign="top"><input type="text" name="fax_no" id="fax_no" class="txtfield2" value="<?php echo $_SESSION['fax_no']; ?>" /></td>
    </tr>
	
	<tr>
      <td align="left" valign="top"><?php echo $company_name; ?>:<span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="cmpny_name" id="cmpny_name" class="txtfield2" value="<?php echo $_SESSION['cmpny_name']; ?>" /></td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $verification; ?>:<span class="mandory">*</span> </td>
      <td  valign="top" style="padding-left:31px;"><img src="captcha.php" id="captcha" />&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="
    document.getElementById('captcha').src='captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image"><img src="images/refe.png" width="20" /></a> &nbsp;&nbsp;<span style="padding-top:10px;">
	<input type="text" name="captcha" id="captcha-form" autocomplete="off" class="text_box" style="padding-top:10px;"  onblur="trim(this.id)" /></span>
       <!-- <input id="6_letters_code" name="6_letters_code" type="text" class="txtfield_new">--></td>
    </tr>
	
	<!--<tr>
      <td align="left" valign="top">verification Code:<span class="mandory">*</span> </td>
      <td valign="top" align="right" style="padding-left:31px;"><img src="captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'>&nbsp;&nbsp;&nbsp;<a href='javascript: refreshCaptcha();'><img src="images/refe.png" width="20" /></a> &nbsp;&nbsp;
        <input id="6_letters_code" name="6_letters_code" type="text" class="txtfield_new">
        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh </p>
       </td>
    </tr>-->
	
    <!--<tr>
      <td align="left" valign="top">Country :  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><select name="country" id="country" class="listbox2">
        <option value="">---------- Select Country ----------</option>
		<?php 
		$select_country="SELECT * FROM country";
		$res_country=mysqli_query($con,$select_country);
		while($fet_country=mysqli_fetch_array($res_country))
		{
		?>
		<option value="<?php echo $fet_country['country_id']; ?>"><?php echo $fet_country['country_name']; ?></option>
		<?php } ?>
      </select>      </td>
    </tr>
	<tr>
      <td align="left" valign="top">State : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="state" id="state" class="txtfield2" /></td>
    </tr>-->
	
	
    <!--<tr>
      <td align="left" valign="top">Telephone:  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield4" id="textfield4" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">Mobile / Cell Phone:  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield5" id="textfield5" class="txtfield2" /></td>
    </tr>
    
    <tr>
      <td align="left" valign="top">Type the code shown<br />
below :  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield8" id="textfield8" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><img src="images/captcha.jpg" alt="" width="175" height="49" /></td>
    </tr>-->
    
    <!--<tr>
      <td align="right" valign="top"><input type="checkbox" name="terms" id="terms" /></td>
      <td align="left" valign="top"> &nbsp; Yes, I agree to all the <a href="#">Terms of Use</a> stated herein. <br/> <br/></td>
    </tr>-->
    <tr>
      <td colspan="2" align="left" valign="bottom"><img src="images/spe4.jpg" alt="" width="455" height="1" /></td>
      </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="" class="create-acc" /></td>
      </tr>
	 
  </table>
  </form>
</div>
<div class="register-bot"> </div>

</div>



<div class="points-cont"> 
<div class="points-top"> </div>
<div class="points-bg"> <span class="point-heading"><?php echo $why_lower; ?> ? </span> 
<ul> 
<li><?php echo $instant; ?>!</li>
<li><?php echo $showcase; ?>!</li>
<li><?php echo $post_com; ?>!</li>
<li><?php echo $advertise_business; ?>! </li>
</ul>
<div class="points-bg2">
  <table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="173" align="left" valign="top"><strong><?php echo $alredy_account; ?>?</strong></td>
      <td width="164" rowspan="2" align="right" valign="middle"><a href="forgot.php"><?php echo $forgot; ?>?</a> | <a href="#"><?php echo $help; ?></a> </td>
    </tr>
    <tr>
      <td align="left" valign="top"><a href="login.php"><img src="images/signin.png" alt="" width="154" height="35" /></a></td>
    </tr>
  </table>
</div>
</div>
<div class="points-bot"> </div>

</div>


</div>
</div>


</div>
<script type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<?php include("includes/footer.php"); ?>
