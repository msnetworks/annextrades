<?php
session_start();
include("config/error.php");
include("config/db_configue.php");
// Include Functions
include("functions.php");

//Database Connection
// Check if paypal request or response

	//echo print_r($_REQUEST); 
	 $payment_status=$_REQUEST['payment_status'];

$txn_id=$_REQUEST['txn_id']; 

$tax_value=$_REQUEST['tax'];

$gross_amt=$_REQUEST['mc_gross'];

 echo $ord_refid=$_SESSION['or_id']; 

//echo $item_id; exit;
//$item_id="1807120Fttv";

if(isset($_REQUEST['payment_status']) && ($payment_status=='Completed' || $payment_status=='Pending'))
{
$pay_status=1;
}
else
{
$pay_status=0;
}

//echo $pay_status;
 
// echo "update class_order set payment_status=$pay_status,trans_id='$txn_id' where classified_order_id='$ord_refid'"; exit;
 
$upqry=mysqli_query($con,"update class_order set payment_status=$pay_status,trans_id='$txn_id' where classified_order_id='$ord_refid'");

//echo "update skill_pack_order set pay_status=$pay_status, pack_transid='$txn_id' where pack_order_refid='$item_id'"; exit;
//$upqry1=mysqli_query($con,"update wed_users set pay_status=$pay_status where user_id='$_SESSION[user_id]'");
//echo "select * from class_order where classified_order_id='$ord_refid'"; 
$sel_order=mysqli_fetch_array(mysqli_query($con,"select * from class_order where classified_order_id='$ord_refid'"));
$sel_cost=mysqli_fetch_array(mysqli_query($con,"select * from class_costing where cost_id = '$sel_order[ad_type]'"));
$membership_type=$sel_cost['ad_type'];
$orderdate=date('d-m-Y',strtotime($sel_order['date']));
$order_email=$sel_order['user_email'];
$firstname=$sel_order['user_name'];
$amount=$sel_order['amount'];
$expiredate=$sel_order['exp_date'];
//$fullpath = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]);

$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;

if($pay_status==1)
{
$subject="$website_title Transaction Details";


$msg =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
 <td style='padding:10px;'><img src='$site_link/admin/uploads/$site_loggo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  
	 <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Dear $firstname</b></td>
  </tr>
  
	<tr bgcolor='#FFFFFF'>
			 <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
Thank you for your order. We have attached herewith your invoice which contains your order details. To ensure the most prompt and efficient service, please always refer to your order number when contacting us Payment Information.</td>
		</tr>

	<tr bgcolor='#FFFFFF' > 
	
	 <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
			     
			     <tr><td> <b>Ad Name</b> </td> <td>:</td> <td>$membership_type</td> </tr>
			       <tr><td> <b>Ad Price</b> </td> <td>:</td> <td>$amount $</td> </tr>
		             <tr><td> <b>Ad expirydate</b> </td> <td>:</td> <td>$expiredate</td> </tr>
					 
					<tr><td><b>Order date</b></td> <td>:</td> <td>$orderdate</td></tr>
			
					<tr><td><b>Order ID</b></td> <td>:</td> <td>$ord_refid</td></tr> 	
					
					<tr><td><b>Payment status</b></td> <td>:</td> <td>success</td></tr>	
		</table>
		</td>
	
		
	</tr>


  <tr bgcolor='#FFFFFF'>
    <td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
      ".$website_title."<br>
    </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $website_title."</td>
  </tr>
</table>";	

//echo $subject."<br>"; 
//echo $msg."<br>"; 
//echo $smtp_server."<br>"; 
//echo $smtp_username."<br>"; 
//echo $smtp_password."<br>"; 
//echo $order_email."<br>"; 
//echo $website_title."<br>"; 
//echo $adminmail."<br>";  exit;

include ("mailer/class.phpmailer.php");
ini_set("SMTP","$smtp_server");
	//$headers  = "MIME-Version: 1.0\r\n";
//	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//	$headers .= 'From:'.$site_team."\n";
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "$smtp_server"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "$smtp_username";
	$mail->Password = "$smtp_password";

	$mail->From = "$adminmail";
	$mail->FromName = "$website_title";
	$mail->AddAddress($order_email);
	$mail->AddReplyTo($adminmail);
	$mail->AddCustomHeader('Return-path:'.$adminmail);
	$mail->Sender = $adminmail;
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
 <td style='padding:10px;'><img src='$site_link/admin/uploads/$site_loggo'  width='169' height='48' border='0' /></td>
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
		
			<b>User name</b> : $sel_order[user_name]
		
		</td> 
	</td>
		
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Email ID</b> : $sel_order[user_email]	
		
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
		
			<b>Order ID</b> : $ord_refid 	
		
		</td> 
	</td>
		
	</tr>
	<tr bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'> 
	
	<b>Ad Name</b> : $membership_type
	
	</td> 
	</tr>
	
	
	 <tr  bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
	 
	 <b>Ad Price</b>  : $amount $
	 
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
      ".$website_title."<br>
    </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $website_title."</td>
  </tr>
</table>";	

ini_set("SMTP","$smtp_server");
	//$headers1  = "MIME-Version: 1.0\r\n";
	//$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers1 .= 'From:'.$site_team."\n";
	
	//include ("mailer/class.phpmailer.php");
	$mail1 = new PHPMailer();
	$mail1->IsSMTP();

	$mail1->Host = "$smtp_server"; // SMTP server
	$mail1->SMTPAuth = true;
	$mail1->Username = "$smtp_username";
	$mail1->Password = "$smtp_password";

	$mail1->From = "$order_email";
	$mail1->FromName = "$website_title";
	$mail1->AddAddress($adminmail);
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

header("location:merchant.php?pay_succ");
unset($_SESSION['ad_type']);
unset($_SESSION['or_id']);


}

else
{
$subject="$website_title Transaction failed";

$msg =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
 <td style='padding:10px;'><img src='$site_link/admin/uploads/$site_loggo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear $sel_order[user_name], </b> 	
		
		</td> 
	</td>
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Your transaction has been failed. Please try again .</td>
		</tr>

	

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order ID</b> : $ord_refid 	
		
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
      ".$website_title."<br>
    </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $website_title."</td>
  </tr>
</table>";	

ini_set("SMTP","$smtp_server");
	//$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//$headers .= 'From:'.$webname."\n";
	
	include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "$smtp_server"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "$smtp_username";
	$mail->Password = "$smtp_password";

	$mail->From = "$adminmail";
	$mail->FromName = "$website_title";
	$mail->AddAddress($order_email);
	$mail->AddReplyTo($adminmail);
	$mail->AddCustomHeader('Return-path:'.$adminmail);
	$mail->Sender = $adminmail;
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

header("location:postclassified.php?pay_err");

unset($_SESSION['ad_type']);
unset($_SESSION['or_id']);

}



?>