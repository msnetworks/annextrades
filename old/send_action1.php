<?php include("includes/header.php");

	 $sellid=$_REQUEST['id'];
	  $property=$_REQUEST['property'];  
	//print_r($property);
	$sel_sql="select * from `tbl_seller` where seller_id='$sellid'";
	$res_sel=mysqli_query($con,$sel_sql);
	$result_sel=mysqli_fetch_array($res_sel);
	$com_res=$result_sel['seller_companyname'];
	$user=$result_sel['user_id'];
    $userid=$_SESSION['user_login'];
	  $res_select="select * from registration where id='$user'";
	$res_query=mysqli_query($con,$res_select);
	$res_fetch=mysqli_fetch_array($res_query);
	$res_mail=$res_fetch['email']; //comented for demo  'ramkumar@i-netsolution.com';
	$Firstname=$res_fetch['firstname'];
	
if(isset($_REQUEST['Submit_form_send']))
{
	$get_sessid=$_SESSION['user_login'];
	
	$select_email="select * from registration where id='$get_sessid'";
	$res_email=mysqli_query($con,$select_email);
	$res_mailcount=mysqli_num_rows($res_email);
	$count_mail=mysqli_fetch_array($res_email);
	$ses_email=$count_mail['email'];
	$subject_send1=$_REQUEST['subject'];
	$message_send1=$_REQUEST['message'];
	$price=$_REQUEST['price'];
    $payment=$_REQUEST['payment'];
   	$orderquan=$_REQUEST['orderquan'];
	$terms=$_REQUEST['terms'];
	$today = date("F j, Y");
	$today1=date('Y-m-d');
	$comp1=$_SESSION['sendid1'];
	$comp2=$_SESSION['sendid2'];
	$comp3=$_SESSION['sendid3']; 
	
	if($comp1!="")
	{
		  $querycount=mysqli_query($con,"select * from tbl_seller where seller_id='$comp1'");
		  $fetquery=mysqli_fetch_array($querycount);
		  $userid=$fetquery['user_id'];
//		  $select_email_reg=mysqli_query($con,"select * from registration where id='$userid'");
		  $fet_reg=mysqli_fetch_array($select_email_reg);
		  $mail_reg=$fet_reg['email'];
		  $Firstname=$fet_reg['firstname'];
		  
		$ip = $_SERVER['REMOTE_ADDR'];
      	$subject=$subject_send1; 
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
		  
		  $message_mail="<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $firstname</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'> I have interested in your product.<br>Your Login Details :</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none;'><strong style='color:#27B1C9;'>Detail description</strong>   <br>$message_send1 </td>
  </tr>

  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$mail_url/login.php'>Sign in Now </a> </td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Wishing you the very best of business, </td>
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
		  
	ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.sjayan.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "mail@sjayan.com";
	$mail->Password = "inetsol";

	$mail->From = "$session_email <".$session_email.">";
	$mail->FromName = $webname;
	$mail->AddAddress($mail_reg);
	$mail->AddReplyTo($session_email);
	$mail->AddCustomHeader('Return-path:'.$session_email);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 	  
		  
	mysqli_query($con,"INSERT INTO `messagesend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$userid', '$sellid', '$subject_send1', '$message_send1', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");

$compose = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$userid','$ses_email','$res_mail','$subject_send1','$message_send1','$today1')";
			$coquery=mysqli_query($con,$compose);		  
	
	}
	if($comp2!="")
	{
	$querycount=mysqli_query($con,"select * from tbl_seller where seller_id='$comp2'");
		  $fetquery=mysqli_fetch_array($querycount);
		  $userid=$fetquery['user_id'];
		  
		  $select_email_reg=mysqli_query($con,"select * from registration where id='$userid'");
		  $fet_reg=mysqli_fetch_array($select_email_reg);
		 echo $mail_reg=$fet_reg['email'];
		  $Firstname=$fet_reg['firstname'];
		  
		$ip = $_SERVER['REMOTE_ADDR'];
      	$subject=$subject_send1; 
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
		  
		  $message_mail="<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $firstname</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'> I have interested in your product.<br>Your Login Details :</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none;'><strong style='color:#27B1C9;'>Detail description</strong>   <br>$message_send1 </td>
  </tr>

  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$mail_url/login.php'>Sign in Now </a> </td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Wishing you the very best of business, </td>
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
		  
	ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	//include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$session_email <".$session_email.">";
	$mail->FromName = $webname;
	$mail->AddAddress($mail_reg);
	$mail->AddReplyTo($session_email);
	$mail->AddCustomHeader('Return-path:'.$session_email);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 
	mysqli_query($con,"INSERT INTO `messagesend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$userid', '$sellid', '$subject_send1', '$message_send1', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");

$compose = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$userid','$ses_email','$res_mail','$subject_send1','$message_send1','$today1')";
			$coquery=mysqli_query($con,$compose);	
	
	}
	if($comp3!="")
	{
		$querycount=mysqli_query($con,"select * from tbl_seller where seller_id='$comp3'");
		  $fetquery=mysqli_fetch_array($querycount);
		  $userid=$fetquery['user_id'];
		  
		  $select_email_reg=mysqli_query($con,"select * from registration where id='$userid'");
		  $fet_reg=mysqli_fetch_array($select_email_reg);
		  $mail_reg=$fet_reg['email'];
		  $Firstname=$fet_reg['firstname'];
		  
		$ip = $_SERVER['REMOTE_ADDR'];
      	$subject=$subject_send1; 
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
		  
		  $message_mail="<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $firstname</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'> I have interested in your product.<br>Your Login Details :</td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none;'><strong style='color:#27B1C9;'>Detail description</strong>   <br>$message_send1 </td>
  </tr>

  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$mail_url/login.php'>Sign in Now </a> </td>
  </tr>
  <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Wishing you the very best of business, </td>
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
		  
	ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	//include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$session_email <".$session_email.">";
	$mail->FromName = $webname;
	$mail->AddAddress($mail_reg);
	$mail->AddReplyTo($session_email);
	$mail->AddCustomHeader('Return-path:'.$session_email);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 
	
	mysqli_query($con,"INSERT INTO `messagesend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$userid', '$sellid', '$subject_send1', '$message_send1', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");

$compose = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$userid','$ses_email','$res_mail','$subject_send1','$message_send1','$today1')";
			$coquery=mysqli_query($con,$compose);	
	
	}
	
	
	
	//$today1=time("g:i a");
/*
	 "INSERT INTO `messagesend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$userid', '$sellid', '$subject_send', '$message_send', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
";
*/	

		  



/*echo $from=$ses_email;
echo "<br>";
echo $to=$res_mail;
	$Subject="$subject_send";
	$Message=$message_send;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
echo	$headers = 'From:' . $from . "\r\n";
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($to,$Subject,$Message,$headers);

exit;
*/// $joint_msg=$Subject .",".$Message.",". $ses_email;

//$_SESSION['value']=$joint_msg;

	//if($rsmail)
	//{
		header("location:productupload.php");
		//header("location:newmessage.php?cid=$sellid");
	//}
}

 ?>
<style type="text/css">
.bluebold{
font-family:tahoma,Arial, Helvetica, sans-serif; 
font-size:11px; 
font-weight:bold; 
color:#386DA3; 
text-decoration:none;}
</style>
<script language="JavaScript">
function openClosStatus(AAA) {
    if (
		document.getElementById(AAA).style.display == "block") {
        document.getElementById(AAA).style.display = "none";
       } 
	   else 
	   {
        document.getElementById(AAA).style.display = "block";
       }
}
function validate(doc)
{
	if(document.buying.subject.value=="")
	{
		alert("Please Enter the Subject");
		document.buying.subject.focus();
		return false;
	}
		if(document.buying.subject.value.length<=10)
	{
		alert("Please Enter the Subject Atleast More Than 10 Characters In Length");
		document.buying.subject.focus();
		return false;
	}
	if(document.buying.message.value=="")
	{
		alert("Please Enter the Message");
		document.buying.message.focus();
		return false;
	}
	if(document.buying.message.value.length<=10)
	{
		alert("Please Enter the Message Atleast More Than 10 Characters In Length");
		document.buying.message.focus();
		return false;
	}
		
	if(isNaN(document.buying.orderquan.value) )
	{
		alert("Please Enter the Intial Quantity in Numeric Form");
		document.buying.message.focus();
		return false;
	}
	if(document.buying.orderquan.value <=0 )
	{
		alert("Please Enter the Intial Quantity above Zero");
		document.buying.message.focus();
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


function dodisable()
{
document.buying.bpassword.readOnly=true;
}

function dodisable1()
{
document.buying.bpassword.readOnly=false;
}

</script>
<script type="text/javascript">
function valnew()
{
	if(document.getElementById('hiddivval').value=='')
	{
	document.getElementById('hiddivval').value='text';
	}
	else
	{
	document.getElementById('hiddivval').value='';
	}
	
}

function demo_msg()
{
	if(confirm("This is demo version, so this mail send to 2daybiz.com.\n do you want to continue this mail?"))
	{
		return true;
	}
	else
	{
		return false;
	}
	
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





<div class="body-right"> 

<?php include("includes/menu.php"); 

$pro=$_REQUEST['id'];

$res="select * from tbl_seller where seller_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
$id=$result['user_id'];

$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];

?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <?php echo ucfirst($result['seller_subject']);?></div>
<div style="border: solid 1px #CFCFCF;">


 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr></tr>
                                  <tr>
                                    <td><form action="" method="post" enctype="multipart/form-data" name="buying" id="buying" onsubmit="return validate(this)">
                                      <input type="hidden" id="hiddivval" name="divval" value=""/>
                                      <table width="100%" height="457"  border="0"  cellpadding="2" cellspacing="2" align="center">
                                        <tr>
                                          <td colspan="2"><table width="100%">
                                              <tr>
                                                <td align="right" ><div align="right"><span style="color:#FF0000">*</span><?php echo $required_info; ?></div></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td width="35%" height="30" align="right" style="padding-right:10px;"><span class="bluebold"><?php echo $to; ?> :</span> </td>
                                          <td width="74%">
										  <?php 
										  $i=0;
						  foreach($_REQUEST['property'] as $array) 
						  {
													
							$i++;
							$array."<br>";
							$company=$array['seller_companyname'];
							$select="select * from tbl_seller where seller_id ='$array'";
							$res=mysqli_query($con,$select);
							$count=mysqli_num_rows($res);
							$res_fetch=mysqli_fetch_array($res);
							$userid=$res_fetch['user_id'];
							$re=mysqli_query($con,"select * from registration where id='$userid'");
							$re_fet=mysqli_fetch_array($re);
							$resultarray=$re_fet['companyname'];
							echo "$resultarray" . "<br>";
							$sendid=$res_fetch['seller_id'];
						    $_SESSION['sendid'.$i]=$sendid;
								
 						 }?> 
						 </td>
                                        </tr>
                                        <tr>
                                          <td height="53" align="right" style="padding-right:10px;"><font class="redbold">*</font><span class="bluebold"><?php echo $subject; ?> :</span> </td>
                                          <td><label>
                                            <input name="subject" type="text" class="textBox" id="subject" size="40" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td height="98" align="right" valign="top" style="padding-right:10px;"><font class="redbold">* </font><span class="bluebold"> <?php echo $message; ?> </span><strong>:</strong></td>
                                          <td><label>
                                            <textarea name="message" cols="35" rows="5" id="message"></textarea>
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td align="left" class=""><div align="left"></div></td>
                                          <td><label></label>
                                              <input name="hiddenField" type="hidden"  value="Please Enter your Message&nbsp;" /></td>
                                        </tr>
                                        <tr>
                                          <td align="right" style="padding-right:10px;" ><span class="bluebold"><?php echo $purchase_type; ?> : </span></td>
                                          <td><label>
                                            <input type="checkbox" name="checkbox" value="checkbox" />
                                            <?php echo $urgent; ?></label></td>
                                        </tr>
										
                                        <tr>
                                          <td colspan="2" valign="middle" class="">
										  	<a href="javascript:openClosStatus('reqHead');" class="topics2"><?php echo $pro_info; ?><?php //echo $senda_addinfo;?></a>
											<a href="javascript:openClosStatus('reqHead');" class=""> (</a>
											<a href="javascript:openClosStatus('reqHead');" class=""><?php echo $click_here;?><?php //echo $senda_clkreq;?></a>
											<a href="javascript:openClosStatus('reqHead');" class="">)</a>
                                              <div id="reqHead" style="display:none"> &nbsp;&nbsp;
                                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                      <th width="35%" valign="top" align="right" style="padding-right:10px; padding-top:8px;"><span class="bluebold"><?php echo $price_terms; ?>:</span></th>
                                                      <td width="74%">
													  	<table align="left" border="0" cellpadding="0" cellspacing="2" width="44%">
                                                          <tr>
                                                            <td height="30" nowrap="nowrap"><span class="bluebold"><?php echo $Incoterm; ?></span>
                                                                <select name="price" style="width:139px;">
                                                                  <option value=""><?php echo $sel; ?></option>
                                                                  <option value="FOB" ><?php echo $fob; ?></option>
                                                                  <option value="CIF" ><?php echo $cif; ?></option>
                                                                  <option value="CNF" ><?php echo $cnf; ?></option>
                                                                </select>
                                                            </td>
														</tr>
														<tr>
                                                            <td height="30" nowrap="nowrap"><span class="bluebold"><?php echo payment; ?>  </span>
                                                                <select name="payment" style="width:139px;">
                                                                  <option value=""><?php echo $sel; ?></option>
                                                                  <option value="L/C" ><?php echo $lc; ?></option>
                                                                  <option value="T/T" ><?php echo $tt; ?></option>
                                                                  <option value="Escrow" ><?php echo $Escrow; ?></option>
                                                                </select>
                                                            </td>
                                                          </tr>
                                                      </table>
													 </td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <th align="right" valign="top" style="padding-right:10px;"><font class="redbold">* </font><span class="bluebold"><?php echo $initial_order; ?>  : </span></th>
                                                      <td valign="middle">
													  	<input name="orderquan" id="orderQuantityClient" value=""  size="28" maxlength="100" onkeydown="return attachEnter(event)" onfocus="javascript:showCurrentTips('egIoq')" />
                                                          <?php echo $senda_egpcs;?>
                                                          <div id="orderQuantityClient_info"  style="display:none"></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <th align="right" style="padding-right:10px;"><span class="bluebold">Sample Terms:</span></th>
                                                      <td colspan="3">
													  <select name="terms" style="width:290px;">
                                                          <option value=""><?php echo $sel; ?></option>
                                                          <option value="Free sample" ><?php echo $free_sample; ?></option>
                                                          <option value="Buyer pays shipping fee" ><?php echo $buyer_pay; ?></option>
                                                          <option value="Seller pays shipping fee" ><?php echo $seller_pay_shipping; ?></option>
                                                          <option value="Buyer pays sample fee" ><?php echo $buyers_pay_sample; ?></option>
                                                          <option value="Seller pays sample fee" ><?php echo $seller_pay_sample; ?></option>
                                                          <option value="Buyer pays both shipping and sample fee" ><?php echo $buyers_both; ?></option>
                                                          <option value="Seller pays both shipping and sample fee" ><?php echo $seller_both; ?></option>
                                                      </select></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                  </table>
                                              </div></td>
                                        </tr>
                                        <?php
						$sel_sql="select * from `tbl_seller` where seller_id='$sellid'";
	$res_sel=mysqli_query($con,$sel_sql);
	$result_sel=mysqli_fetch_array($res_sel);
						?>
                                        <!--<tr>
                          <td colspan="2" valign="top" class="inTxtSHead"><p><b>Trade Alert</b></p>
                           
                            <input type="checkbox" name="checkbox2" value="checkbox" />
                            Tell me by email when there are new products and suppliers for: <?php //echo $result_sel['seller_subject']; ?></td>
                        </tr>-->
                                        <tr>
                                          <td height="64"  colspan="3" align="center"><input name="Submit_form_send" type="submit" class="search_bg" id="Submit_form_send"  value="Submit">
                                          </td>
                                        </tr>
                                      </table>
                                    </form>
                                    </td>
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