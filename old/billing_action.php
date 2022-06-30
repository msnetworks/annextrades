<?php
include("db-connect/notfound.php");
$sesssss_id=$_SESSION['seeess_id']; 
$session_user=$_SESSION['user_login'];

 $prot_id=$_REQUEST['prod_id']; 
//echo $date=date('dymhis'); break;
$today=date('Y-m-d');

if(isset($_REQUEST['address_submit']))
{
extract($_POST);

$random_generation=rand(0,900);
$ORDER_ID="UIM".$date.$random_generation;

//echo "INSERT INTO billing_address (user_id, fname, lname, email, address, ph_no,order_id)  VALUES  ('$session_user','$fname','$lname','$email','$address','$ph_no','$ORDER_ID')"; exit;


$insert_billing_address="INSERT INTO billing_address (user_id, fname, lname, email, address, ph_no,order_id)  VALUES  ('$session_user','$fname','$lname','$email','$address','$ph_no','$ORDER_ID')  ";
mysqli_query($con,$insert_billing_address);

}

//echo "INSERT INTO orders (user_id, net_amount, payment_status, date,order_id) VALUES ('$session_user','$net_amount','0','$today','$ORDER_ID') "; exit;

//$prods=$_REQUEST['pro_id'];

if($_SESSION['language']=='english')
{
//echo "SELECT * FROM `tbl_seller` where status='2' AND trash!='1' AND lang_status='0' order by seller_id desc"; exit;
$selectt = "SELECT * FROM `tbl_seller` where (seller_id='$prot_id' and status='2') AND (trash!='1' AND lang_status='0') order by seller_id desc";
}
else if($_SESSION['language']=='french')
{
$selectt = "SELECT * FROM `tbl_seller` where (seller_id='$prot_id' and status='2') AND (trash!='1' AND lang_status='1') order by seller_id desc";
}
else if($_SESSION['language']=='chinese')
{
$selectt = "SELECT * FROM `tbl_seller` where (seller_id='$prot_id' and status='2') AND (trash!='1' AND lang_status='2') order by seller_id desc";
}
else
{
$selectt = "SELECT * FROM `tbl_seller` where (seller_id='$prot_id' and status='2') AND (trash!='1' AND lang_status='3') order by seller_id desc";
}

$fetch_details=mysqli_fetch_array(mysqli_query($con,$selectt));

$total_pro_amount=($fetch_details['price']*1);

$total=$fetch_details['delivery_charge'];

$net_amount=$total+$total_pro_amount; 

$cur_tyype=$fetch_details['cur_type'];


$user_pay=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$fetch_details[user_id]'"));

//$sell_pay=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where id='$session_user'"));

$formaction = "https://www.sandbox.paypal.com/cgi-bin/webscr";
//$formaction = "https://www.paypal.com/cgi-bin/webscr";

 $paypal_email=$user_pay['paypal_id']; 


$order_insert="INSERT INTO orders (user_id, product_id,net_amount, payment_status, date,order_id) VALUES ('$session_user','$prot_id','$net_amount','0','$today','$ORDER_ID')";
mysqli_query($con,$order_insert);

$orderrrr_insert_id=mysqli_insert_id();

$up_reg=mysqli_query($con,"update registration set pay_ordid='$ORDER_ID' where id='$session_user' ");
$sel_user=mysqli_query($con,"update tbl_seller set pay_ordid='$ORDER_ID' where seller_id='$prot_id'");

$return_url=$signin."bill_success.php?pay=$ORDER_ID";

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
document.frm_process.submit();	
}
</script>

<body onload="Javascript:FormSubmit();">
<table width="100%" height="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  align="center" valign="middle">
	
    <form name="frm_process" method="get" action="<?php echo $formaction; ?>">
<center>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">Processing &nbsp;<img src="images/bigLoader.gif" border="0" alt="loading" />&nbsp; Transaction . . . </font></center>
<input type="hidden" name="cmd" value="_xclick" />
<table>
	<tr><td>
<!-- Owner Paypal Id -->
<input type="hidden" name="business" value="<?php echo $paypal_email; ?>" />
</td></tr>
<tr><td>
<!-- Product Name -->
<input type="hidden" name="item_id" value="<?PHP echo $prot_id; ?>" />

</td></tr>
<tr><td>
<!-- Product Amount -->
<input type="hidden" name="amount" value="<?php echo $net_amount; ?>" />
</td></tr>
<tr><td>
<input type="hidden" name="no_note" value="2" />
<input type="hidden" name="rm" value="2" />
</td></tr>
<tr><td>
<!-- Amount Currency -->
<input type="hidden" name="currency_code" value="<?php echo $cur_tyype; ?>" />
</td></tr>
<tr><td>
<input type="hidden" name="bn" value="PP-BuyNowBF" />
<input type="hidden" name="item_number" value="<?php echo $ORDER_ID; ?>">
</td></tr>
<tr><td>
<input type="hidden" name="notify_url" value="<?php echo $return_url; ?>">
<!-- Success Return Path -->
<input type="hidden" name="return" value="<?php echo $return_url; ?>">
</td></tr>
<tr><td>
<!-- Failure Return Path -->
<input type="hidden" name="cancel_return" value="<?php echo $fail; ?>" />
</td></tr>
<tr><td>

</td></tr>
<tr><td></td>
</form>
    </td>
  </tr>
</table>

</body>
</html>