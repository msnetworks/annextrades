<?php 
include("includes/header.php");

session_start();
$sess_id=$_SESSION['user_login']; 
$pay=$_SESSION['pay'];
$mem=mysqli_query($con,"select * from membersettings");
$fetchmem=mysqli_fetch_array($mem);
$produ=$fetchmem['gold_year'];
$sillver_year=$fetchmem['sillver_year'];
$bronze_year=$fetchmem['bronze_year'];
$gold_amount=$fetchmem['gold_amount'];
$silver_amount=$fetchmem['silver_amount'];
$bronze_amount=$fetchmem['bronze_amount'];
if($pay=='1')
{
 $expiredate = date("Y-m-d", strtotime("+$produ year"));
$membership_types='GoldSupplier';
$amount="$gold_amount";
}
else if($pay=='2')
{
 $expiredate = date("Y-m-d", strtotime("+$sillver_year year"));
 $membership_types='SilverSupplier';
$amount="$silver_amount";
}
else if($pay=='3')
{
 $expiredate = date("Y-m-d", strtotime("+$bronze_year year"));
 $membership_types='bronzeSupplier';
$amount="$bronze_amount";
}

$select_sql=mysqli_query($con,"select * from registration where id='$sess_id'");
$select_fetch=mysqli_fetch_array($select_sql);

$country=$select_fetch['country'];
$user_id=$select_fetch['id'];
$currentdate=date("Y-m-d");

/*if($country=='95')
{
$membership_type='GoldSupplier';
}
elses
{
$membership_type='TrustPass';

}*/

 //"update payment_tbl  set membershiptype ='$membership_type',paystatus='1',from_date='$currentdate',expired_date='$expiredate' where userid='$sess_id'";
//$update=mysqli_query($con,"update payment_tbl  set membershiptype ='$membership_type',paystatus='1',from_date='$currentdate',expired_date='$expiredate' where userid='$sess_id'");

$res=mysqli_query($con,"update registration set membershiptype='$membership_types' where id='$sess_id'");



 $payment_status=strtolower($_REQUEST['payment_status']);


$txn_id=$_REQUEST['txn_id'];

$tax_value=$_REQUEST['tax'];

$gross_amt=$_REQUEST['mc_gross'];

$ord_refid=$_REQUEST['ord_refid'];

//echo $item_id; exit;
//$item_id="1807120Fttv";

/*if(isset($_REQUEST['payment_status']) && ($payment_status=='completed' || $payment_status=='pending'))
{
$pay_status=1;
}
else
{
$pay_status=0;
}*/
$pay_status=1;
 $membership_types; 
if(isset($_REQUEST['pay']))
{
$upqry=mysqli_query($con,"UPDATE member_order SET `order_packname`='$membership_types',`order_transid`='$txn_id',`order_exp_date`='$expiredate',`payment_status`='1' WHERE `order_refid`='$ord_refid'");
if($upqry)
{
	//echo "error".mysqli_error($con);
	unset($_SESSION['pay']);
	echo "<script>window.location='success.php';</script>";
}
}

$sel_order=mysqli_fetch_array(mysqli_query($con,"select * from member_order where order_refid='$ord_refid'"));
$orderdate=date('d-m-Y',strtotime($sel_order['order_date']));
$order_email=$sel_order['order_email'];
$order_name=$sel_order['order_name'];
$order_packname=$sel_order['order_packname'];
$order_exp_date=$sel_order['order_exp_date'];
$order_txnid=$sel_order['order_transid'];
$order_amount=$sel_order['order_price'];
//$fullpath = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]);

$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;

if($pay_status==1)
{
$subject="$website_team Package Order Details";


$msg =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
 <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  
	 <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Dear $order_name</b></td>
  </tr>
  
	<tr bgcolor='#FFFFFF'>
			 <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
Thank you for your order. We have attached herewith your invoice which contains your order details. To ensure the most prompt and efficient service, please always refer to your order number when contacting us Payment Information.</td>
		</tr>

	<tr bgcolor='#FFFFFF' > 
	
	 <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
			     
			     <tr><td> <b>Package Name</b> </td> <td>:</td> <td>$order_packname</td> </tr>
			       <tr><td> <b>Package Price</b> </td> <td>:</td> <td>$order_amount <span>$</span></td> </tr>
		             <tr><td> <b>Package expirydate</b> </td> <td>:</td> <td>$order_exp_date</td> </tr>
					 
					<tr><td><b>Order date</b></td> <td>:</td> <td>$orderdate</td></tr>
			
					<tr><td><b>Transaction ID</b></td> <td>:</td> <td>$order_txnid</td></tr> 	
					
					<tr><td><b>Payment status</b></td> <td>:</td> <td>success</td></tr>	
		</table>
		</td>
	
		
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
include ("mailer/class.phpmailer.php");
ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$mailurl";
	$mail->FromName = "$webname";
	$mail->AddAddress($order_email);
	$mail->AddReplyTo($mailurl);
	$mail->AddCustomHeader('Return-path:'.$mailurl);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 

	
       		  //  $headers  = 'MIME-Version: 1.0' . "\r\n";
				//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				//$headers .= "From:$website_team	< $website_admin >" . "\r\n";
				       
//$userto=$sel_order['pack_temail'];	
/*$userto='sheik.inet@gmail.com';*/
//echo $userto;
//echo $subject;
//echo $msg;
//echo $headers;exit;
	   			
//mail($userto,$subject,$msg,$headers);




$msg1 =" 		
<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
 <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
<b>Package Order Details.</b></td>
		</tr>

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>User name</b> : $order_name
		
		</td> 
	</td>
		
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Email ID</b> : $order_email	
		
		</td> 
	</td>
		
	</tr>
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order date</b> : $orderdate	
		
		</td> 
	</td>
		
	</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Transaction ID</b> : $order_txnid 	
		
		</td> 
	</td>
		
	</tr>
	<tr bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'> 
	
	<b>Package Name</b> : $order_packname
	
	</td> 
	</tr>
	
	
	 <tr  bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
	 
	 <b>Package Price</b>  : $order_amount <span>$</span>
	 
	</td> 
	 </tr>
	
	
	
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Success	
		
		</td> 
	</td>
		
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
	//$headers1  = "MIME-Version: 1.0\r\n";
	//$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers1 .= 'From:'.$webname."\n";
	
	//include ("mailer/class.phpmailer.php");
	$mail1 = new PHPMailer();
	$mail1->IsSMTP();
	$mail1->Host = "mail.inetmassmail.com"; // SMTP server
	$mail1->SMTPAuth = true;
	$mail1->Username = "info@inetmassmail.com";
	$mail1->Password = "inetsol";

	$mail1->From = "$order_email";
	$mail1->FromName = $webname;
	$mail1->AddAddress($mailurl);
	$mail1->AddReplyTo($order_email);
	$mail1->AddCustomHeader('Return-path:'.$order_email);
	$mail1->Sender = $order_email;
	$mail1->Subject =$subject;
	$mail1->Body = $msg1;
	$mail1->WordWrap = 50;
	$mail1->Send(); 

	
       		   // $headers1  = 'MIME-Version: 1.0' . "\r\n";
				//$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers1 .= "From:$website_team	< $website_admin >" . "\r\n";
/*$adminto='mohaideen@i-netsolution.com';		*/			       
//$adminto=$website_admin;	

	   			
//echo $adminto;
//echo $subject;
//echo $msg1;
//echo $headers1;exit;
/*if(mail($adminto,$subject,$msg1,$headers1))
{
header("location:order_complete.php?suss");
}*/

//mail($adminto,$subject,$msg1,$headers1);

header("location:membership.php?pay_succ");



}

else
{
$subject="$website_team Transaction failed";

$msg =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
 <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear $sel_order[order_name], </b> 	
		
		</td> 
	</td>
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Your transaction has been failed. Please try again .</td>
		</tr>

	

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Transaction ID</b> : $order_txnid 	
		
		</td> 
	</td>
		
	</tr>

		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Failed	
		
		</td> 
	</td>
		
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
	//$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers .= 'From:'.$webname."\n";
	
	include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$mailurl";
	$mail->FromName = "$webname";
	$mail->AddAddress($order_email);
	$mail->AddReplyTo($mailurl);
	$mail->AddCustomHeader('Return-path:'.$mailurl);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 

	
       		    //$headers  = 'MIME-Version: 1.0' . "\r\n";
				//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				//$headers .= "From:$website_team	< $website_admin >" . "\r\n";
				       

/*$to='sheik.inet@gmail.com';	*/
//$to=$sel_order['pack_temail'];	
	   			
//echo $order_email;
//echo $subject;
//echo $msg;
//echo $headers;exit;

//mail($to,$subject,$msg,$headers);

header("location:membership.php?pay_err");



}


unset($_SESSION['pay']);

 ?>

 
<?php
if(isset($_REQUEST['succ'])) { ?><style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > Confirmation Mail Sent To Your Email </div>
<?php } ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><strong> </strong></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                      <td align="center"><table width="95%" border="0" cellspacing="1" cellpadding="3" >
                          <tr>
                            <td  align="center" valign="middle">&nbsp;</td>
                          </tr>
                          <tr>
                            <td  align="center" valign="middle" height="30"><div align="center"><strong><?php echo $success_payment; ?></strong></div></td>
                          </tr>
                        
                          <tr>
                            <td align="center" height="30"><?php echo $amount_success; ?>.</td>
                          </tr>
                          <tr>
                            <td align="center"><label class="asterisk"></label></td>
                          </tr>
                         
                        </table>
                         </td>
                    </tr>
                  </table>

<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
