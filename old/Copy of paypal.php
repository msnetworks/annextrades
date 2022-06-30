<?PHP
ob_start();
session_start();
include "db-connect/notfound.php";

$pay1=$_REQUEST['pay'];
$_SESSION['pay']=$pay1;
$pay=$_SESSION['pay'];

if(isset($_REQUEST['demo']))
{
	//echo $pay;exit;
	header("Location:success.php?pay=$pay");
	exit;
}


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

?>


<form action="<?php echo $formaction; ?>" name="paypal" method="post">

<input type="hidden" name="cmd" value="_xclick" />

<!-- Owner Paypal Id -->
<input type="hidden" name="business" value="<?php echo $paypalmail; ?>" />

<!-- Product Name -->
<input type="hidden" name="item_name" value="<?PHP echo $membership_type; ?>" />

<!-- Product Amount -->
<input type="hidden" name="amount" value="<?php echo $amount; ?>" />

<input type="hidden" name="no_note" value="2" />

<!-- Amount Currency -->
<input type="hidden" name="currency_code" value="USD" />

<input type="hidden" name="bn" value="PP-BuyNowBF" />

<!-- Success Return Path -->
<input type="hidden" name="return" value="<?php echo $success; ?>">

<!-- Failure Return Path -->
<input type="hidden" name="cancel_return" value="<?php echo $fail; ?>" />

<!--<input type="image" src="loader.gif" border="0" width="150" height="52" />-->

</form>		 
 
 <script language="javascript" type="text/javascript">
  document.paypal.submit();
 </script>