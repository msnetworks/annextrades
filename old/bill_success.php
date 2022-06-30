<?php //session_start();
include("includes/header.php");
 extract($_REQUEST); 


$sess_id=$_SESSION['user_login']; 

//echo print_r($_REQUEST); exit;

if(isset($_REQUEST['pay']))
{
	
	
$pay=$_REQUEST['pay'];

 $tran_id=$_REQUEST['txn_id']; 

$payment_status=strtolower($_REQUEST['payment_status']);
 if(isset($_REQUEST['payment_status']) && ($payment_status=='completed' || $payment_status=='pending'))
{
$pay_status=1;
}
else
{
$pay_status=0;
}

	
//echo "update orders set trans_id='$tran_id',payment_status='$pay_status' where order_id='$pay'"; exit;
$order_update=mysqli_query($con,"update orders set trans_id='$tran_id',payment_status='$pay_status' where order_id='$pay'");
//mysqli_query($con,$order_update);
$up_reg=mysqli_query($con,"update registration set payad_status='$pay_status',payad_transid='$tran_id' where pay_ordid='$pay' ");
$sel_user=mysqli_query($con,"update tbl_seller set payad_status='1',pay_status='$pay_status',payad_transid='$tran_id' where pay_ordid='$pay'");




$con_detail=mysqli_fetch_array(mysqli_query($con,"select * from billing_address where order_id='$pay'"));
$con_sell=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where pay_ordid='$pay'"));
$sell_con=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$con_sell[user_id]'"));
$ord_det=mysqli_fetch_array(mysqli_query($con,"select * from orders where order_id='$pay' "));

if($pay_status==1)
{

$subject="$website_team Order Details";

$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;

$msg  = "<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
		  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
		
			<b>Dear $con_detail[fname], </b> 	
		
		</td> 
	
		
	</tr>	
	
	
	  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
	
Thank you for your order. We have attached herewith your invoice which contains your order details. To ensure the most prompt and efficient service, please always refer to your order number when contacting us Payment Information.</td>
		</tr>

	  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>
	
	
		
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
		            <tr><td><b>Price</b></td> <td>:</td> <td>$ord_det[trans_id]</td></tr> 
			    
					<tr><td><b>Price</b></td> <td>:</td> <td>$ord_det[net_amount]</td></tr> 
					
					<tr><td><b>Order ID</b></td> <td>:</td> <td>$ord_det[order_id]</td></tr> 	
					
					<tr><td><b>Payment status</b></td> <td>:</td> <td>success</td></tr>	
		</table>
		</td> 
	
		
	</tr>
	
	

	 </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
  </tr>
</table>";	
	
       		    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:$webname	< $mailurl >" . "\r\n";
				       
$userto=$con_detail['email'];	
/*$userto='sheik.inet@gmail.com';*/
//echo $userto;
//echo $subject;
//echo $msg;
//echo $headers;exit;
//	   			
mail($userto,$subject,$msg,$headers);





$msg1 =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
<b>your product order details</b></td>
		</tr>

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Buyer name</b> : $con_detail[fname]
		
		</td> 
	</td>
		
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Email ID</b> : $con_detail[email]	
		
		</td> 
	</td>
		
	</tr>
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Mobile</b> : $con_detail[ph_no]	
		
		</td> 
	</td>
		
	</tr>
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Address</b> : $con_detail[address]	
		
		</td> 
	</td>
		
	</tr>
	
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order date</b> : $ord_det[date]	
		
		</td> 
	</td>
		
	</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order ID</b> : $ord_det[order_id]	
		
		</td> 
	</td>
		
	</tr>
	
	
	
	
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
		
			<b>Payment status</b> : Success	
		
		</td> 
	</td>
		
	</tr>
	
	

	 </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
  </tr>
</table>";	
	
       		    $headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= "From:$webname	< $mailurl >" . "\r\n";
/*$adminto='mohaideen@i-netsolution.com';		*/			       
$sellto=$sell_con['email'];	
	   			
/*echo $userto;
echo $subject;
echo $msg1;
echo $headers1;exit;*/
/*if(mail($adminto,$subject,$msg1,$headers1))
{
header("location:order_complete.php?suss");
}*/
mail($sellto,$subject,$msg1,$headers1);


$msg2 =" 		
	<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
	
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
<b>$con_detail[fname] buy the product to $sell_con[firstname]</b></td>
		</tr>

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Buyer name</b> : $con_detail[fname]
		
		</td> 
	</td>
		
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Email ID</b> : $con_detail[email]	
		
		</td> 
	</td>
		
	</tr>
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Mobile</b> : $con_detail[ph_no]	
		
		</td> 
	</td>
		
	</tr>
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Address</b> : $con_detail[address]	
		
		</td> 
	</td>
		
	</tr>
	
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order date</b> : $ord_det[date]	
		
		</td> 
	</td>
		
	</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order ID</b> : $ord_det[order_id]	
		
		</td> 
	</td>
		
	</tr>
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Success	
		
		</td> 
	</td>
		
	</tr>
	
	

	 </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
  </tr>
</table>";	
	
       		    $headers2  = 'MIME-Version: 1.0' . "\r\n";
				$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers2 .= "From:$webname	< $con_detail[email] >" . "\r\n";
/*$adminto='mohaideen@i-netsolution.com';		*/			       
$admin_to=$mailurl;	

mail($admin_to,$subject,$msg2,$headers2);

//header("location:user_order.php?pay_suss");



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
		
			<b>Dear $con_detail[fname], </b> 	
		
		</td> 
	</td>
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
Your transaction has been failed. Please try again .</td>
		</tr>

	

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
		
			<b>Order ID</b> : $ord_det[order_id] 	
		
		</td> 
	</td>
		
	</tr>
	

		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Failed	
		
		</td> 
	</td>
		
	</tr>


	 </tr>
  <tr height='40'>
    <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #25ABC4;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
  </tr>
</table>";	
	
       		    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:$webname	< $mailurl >" . "\r\n";
				       

/*$to='sheik.inet@gmail.com';	*/
$to=$con_detail['email'];	
	   			
/*echo $userto;
echo $subject;
echo $msg;
echo $headers;exit;*/
mail($to,$subject,$msg,$headers);

header("location:bill_success.php?pay_err");



}


}

 ?>

<?php 
if(isset($_REQUEST['submit']))
{

header("location:payment_history.php");
}

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
<div class="headinggg"><strong> <?php echo $success;?></strong></div>
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
					<form action="bill_success.php" name="bil" id="bil">
					<tr>
					<td align="center">
					<input type="submit" name="submit" value="<?php echo $close; ?>" />
					</td>
					</tr>
					</form>
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
