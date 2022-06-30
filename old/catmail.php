<?php include("includes/header.php");

	$sellid=$_REQUEST['id'];
	$sess_id=$_SESSION['sess_id']; 
	$buy = $_REQUEST['buyid'];
	
	//echo "select * from registration where id='$buy'";


  $s = "select * from buyingleads where buy_id='$buy'";
	$q = mysqli_query($con,$s);
	$f = mysqli_fetch_array($q);
	$rid=$f['id'];
	$res=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$rid'"));
	$companyname = $f['companyname'];
	$em=$res['email'];
	$Firstname=$res['firstname'];
	
if(isset($_REQUEST['Submit_form_send']))
{
	$get_sessid=$_SESSION['user_login'];
	$select_email="select * from registration where id='$get_sessid'";
	$res_email=mysqli_query($con,$select_email);
	$res_mailcount=mysqli_num_rows($res_email);
	$count_mail=mysqli_fetch_array($res_email);
	$ses_email=$count_mail['email'];
	$subject_send=$_REQUEST['subject'];
	$message_send=$_REQUEST['message'];
	$price=$_REQUEST['price'];
    $payment=$_REQUEST['payment'];
   	$orderquan=$_REQUEST['orderquan'];
	$terms=$_REQUEST['terms'];
	$today = date("F j, Y");
	$today1 = date('Y-m-d');
	
	//echo "INSERT INTO `buyingsend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )VALUES ('$userid', '$buy', '$subject_send', '$message_send', '$today', '', '$price', '$payment', '$orderquan', '$terms', '')";
	
	mysqli_query($con,"INSERT INTO `buyingsend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$sess_id', '$buy', '$subject_send', '$message_send', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");

$compose = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$sess_id','$ses_email','$em','$subject_send','$message_send','$today1')";
			$coquery=mysqli_query($con,$compose);	
	
	$to_send=$_REQUEST['to'];
    $subject_send=$_REQUEST['subject'];
    $message_send=$_REQUEST['message'];
   
   
   
	$from=$ses_email;
	$to=$em;
	$Subject=$subject_send;
	
	$headers.='MIME-Version: 1.0' . "\r\n";
	$headers.='From:'.$from."\r\n";
	$headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$message=
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
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Dear $Firstname,</span></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">I have interested in your product Requirement.</span> </td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
    
  </tr>
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">Detail description</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $message_send</span></td>
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
  
	
	/* mail($to,$Subject,$message,$headers);*/
	
	ini_set("SMTP","mail.inetmassmail.com");
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

	$mail->From = "$ses_email <".$ses_email.">";
	$mail->FromName = $webname;
	$mail->AddAddress($to);
	$mail->AddReplyTo($ses_email);
	$mail->AddCustomHeader('Return-path:'.$ses_email);
	$mail->Sender = $ses_email;
	$mail->Subject =$Subject;
	$mail->Body = $message;
	$mail->WordWrap = 50;
	$mail->Send(); 


 $joint_msg=$Subject .",".$message.",". $to_send;

$_SESSION['value']=$joint_msg;

	
		header("location:mailsend.php");
	
}

 ?>
<style type="text/css">
.redbold
{
color:#FF0000;
}
</style>
<script language="javascript">
function ValidateForm()
{
 var subject=document.sellermail.subject.value; 
var message=document.sellermail.message.value; 

/*if(document.sellermail.to.value=="")
	{
		alert("Please Enter To address");
		document.sellermail.to.focus();
		return false
	}*/

if(subject=="")
	{
		alert("Please Enter Subject");
		document.sellermail.subject.focus();
		return false
	}
	if(document.sellermail.subject.value.length<=10)
	{
		alert("Please Enter the Subject Atleast More Than 10 Characters In Length");
		document.sellermail.subject.focus();
		return false;
	}
if(message=="")
	{
		alert("Please Enter the Message");
		document.sellermail.message.focus();
		return false
	}
		if(document.sellermail.message.value.length<=10)
	{
		alert("Please Enter the Message Atleast More Than 10 Characters In Length");
		document.sellermail.message.focus();
		return false;
	}
	
 return true;

}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> Browse Category </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>

<?php
$pro=$_REQUEST['id'];
$res="select * from buyingleads where buy_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
//$id=$result['user_id'];
$id=$result['id'];
$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];
?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span>Send Message</span></div>
<div style="border: solid 1px #CFCFCF;">




 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr></tr>
                                  <tr>
                                    <td><form method="post" enctype="multipart/form-data" name="sellermail" id="sellermail" onsubmit="return ValidateForm()">
                                      <table width="100%"  border="0"  cellpadding="2" cellspacing="2">
                                        <tr>
                                          <td colspan="3"><table width="100%">
                                              <tr>
                                                <td align="right" colspan="3"><div align="right"><font color="#FF0000">*&nbsp;</font>Required Information</div></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td width="32%" align="right" class=""><div align="left" class="seller"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>To:</strong></div></td>
                                          <td width="68%" class=""><?php 
						  if($companyname=="")
						  {
						  echo $em;
						  }else{
						  echo $companyname;
						  }
						  ?>
                                              <!--<input name="to" type="text" value="<?php echo $companyname;?>" class="textBox" id="to" size="53" width="390"/>-->
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="37">&nbsp;</td>
                                          <td align="left" class=""><span class="redbold">*</span><strong>Subject:</strong></td>
                                          <td><label>
                                            <input name="subject" type="text" class="textBox" id="subject" size="40" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td height="96" align="left" valign="top" class=""><span class="redbold">*</span> <span class="seller"><strong> Message : </strong></span></td>
                                          <td valign="top"><label>
                                            <textarea name="message" cols="40" rows="5" id="message"></textarea>
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td height="23" align="left" class="blackBo"></td>
                                          <td><label></label>
                                              <input name="hiddenField" type="hidden"  value="<?php echo $catmail_plsentr;?>" /></td>
                                        </tr>
                                        <tr>
                                          <td height="40"  colspan="3" align="center"><input name="Submit_form_send" type="submit" id="Submit_form_send" class="search_bg"  value="Submit"></td>
                                        </tr>
                                      </table>
                                    </form></td>
                                  </tr>
                              </table>  




</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>


