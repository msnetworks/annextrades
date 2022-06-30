<?PHP
ob_start();
//session_start();
include "db-connect/notfound.php";

$pay1=$_REQUEST['pay'];
$_SESSION['pay']=$pay1;
$pay=$_SESSION['pay'];
$sess_id=$_SESSION['user_login']; 
/*if(isset($_REQUEST['demo']))
{
	//echo $pay;exit;
	header("Location:success.php?pay=$pay");
	exit;
}
*/

$user=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$sess_id'"));

$user_name=$user['firstname'];
$user_email=$user['email'];

$mem=mysqli_query($con,"select * from membersettings");
$fetchmem=mysqli_fetch_array($mem);
$produ=$fetchmem['gold_year'];
$sillver_year=$fetchmem['sillver_year'];
$bronze_year=$fetchmem['bronze_year'];
$gold_amount=$fetchmem['gold_amount'];
$silver_amount=$fetchmem['silver_amount'];
$bronze_amount=$fetchmem['bronze_amount'];

if($pay1=='1')
{
$amount="$gold_amount";
$membership_type='GoldSupplier';
}
else if($pay1=='2')
{
$amount="$silver_amount";
$membership_type='SilverSupplier';
}
else if($pay1=='3')
{
$amount="$bronze_amount";
$membership_type='BronzeSupplier';
}
else
{}

  
$random_id_length = 5;
$rnd_id = crypt(uniqid(rand(),1));
$rnd_id = strip_tags(stripslashes($rnd_id));
$rnd_id = str_replace(".","",$rnd_id);
$rnd_id = strrev(str_replace("/","",$rnd_id));
$rnd_id = substr($rnd_id,0,$random_id_length);
$today = date("dmy");
$random_req_id=("$today$rnd_id");
$ip_addr=$_SERVER['REMOTE_ADDR'];


$sel_ord=mysqli_num_rows(mysqli_query($con,"select * from member_order where order_userid='$sess_id' and order_status=0"));

//echo "select * from member_order where order_userid='$sess_id' and order_status=0"; 

//echo $sel_ord; exit;
if($sel_ord==0)
{

$ins_ord=mysqli_query($con,"insert into member_order (order_refid,order_userid,order_packid,order_name,order_email,order_price,order_date,order_ip) values ('$random_req_id','$sess_id','$pay','$user_name','$user_email','$amount',NOW(),'$ip_addr')");
//"insert into member_order (order_refid,order_userid,order_packid,order_packname,order_name,order_email,order_price,order_date,order_ip,payment_status) values ('$random_req_id','$sess_id','$pay','$membership_type','$user_name','$user_email','$amount',NOW(),'$ip_addr','0')";
//$ins_reg=mysqli_query($con,"update registration set memberid='$membership_type' where id='$_SESSION[user_login]'");
}
else
{
	
$up_ord=mysqli_query($con,"update member_order set order_refid='$random_req_id',order_packid='$pay',order_name='$user_name',order_email='$user_email',order_price='$amount',order_date=NOW(),order_ip='$ip_addr' where order_userid='$sess_id'");

//"update member_order set order_refid='$random_req_id',order_packid='$pay',order_packname='$membership_type',order_name='$user_name',order_email='$user_email',order_price='$amount',order_date=NOW(),order_ip='$ip_addr',payment_status='0' where order_userid='$sess_id'";

}


 $return_url=$signin."success.php?pay=$pay&ord_refid=$random_req_id";


?>
 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $website_title;  ?></title>
</head>
<script>
function FormSubmit()
{
document.paypal.submit();	
}
</script>

<body onload="Javascript:FormSubmit();">
<table width="100%" height="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  align="center" valign="middle">
<form action="<?php echo $formaction; ?>" name="paypal" method="post">
<center>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">Processing &nbsp;<img src="images/bigLoader.gif" border="0" alt="loading" />&nbsp; Transaction . . . </font></center>
<input type="hidden" name="cmd" value="_xclick" />
<table>
	<tr><td>
<!-- Owner Paypal Id -->
<input type="hidden" name="business" value="<?php echo $paypalmail; ?>" />
</td></tr>
<tr><td>
<!-- Product Name -->
<input type="hidden" name="item_name" value="<?PHP echo $membership_type; ?>" />
</td></tr>
<tr><td>
<!-- Product Amount -->
<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
</td></tr>
<tr><td>
<input type="hidden" name="no_note" value="2" />
</td></tr>
<tr><td>
<!-- Amount Currency -->
<input type="hidden" name="currency_code" value="USD" />
</td></tr>
<tr><td>
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
</td></tr>
<tr><td>
<!-- Success Return Path -->
<input type="hidden" name="notify_url" value="<?php echo $return_url; ?>">
<input type="hidden" name="return" value="<?php echo $return_url; ?>">
</td></tr>
<tr><td>
<!-- Failure Return Path -->
<input type="hidden" name="cancel_return" value="<?php echo $fail; ?>" />
</td></tr>

<!--<input type="image" src="loader.gif" border="0" width="150" height="52" />-->

</form>		 
</body></html>
