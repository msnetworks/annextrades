<?php
@session_start();
ob_start();
//session_register("provided");
//error_reporting(0);
error_reporting(E_DEPRECATED);

//echo $dbcon;
include_once "security/config.php";
include_once "security/project-security.php";


$con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');

// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}

/* if(!$db)
{
echo "database not Selected".mysqli_error($con);
} */

$timezone = "Asia/Calcutta"; 
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); 

mysqli_query($con,"SET SESSION time_zone = '+5:30'"); 


$res=mysqli_fetch_array(mysqli_query($con,"select * from generalsettings"));

/* $webname=$res['webname']; */

/* $webkeyword=$res['webkeyword']; */

/* $webdes=$res['webdes']; */

$mailurl=$res['admin_mailid'];

/* $logo=$res['logo']; */

/* $signin=$res['weburl'];
 $host_name=$res['host_name'];
 $host_user=$res['host_user'];
 $host_pass=$res['host_pass'];
$GetRec = mysqli_fetch_array(mysqli_query($con,"select * from b2b_cms"));
@extract($GetRec);
$paymail=mysqli_fetch_array(mysqli_query($con,"select * from paypalsettings"));

$paypalmail=$paymail['paypalsettings'];

$formaction = "https://www.sandbox.paypal.com/cgi-bin/webscr";
//$formaction = "https://www.paypal.com/cgi-bin/webscr";
//$buyerid = "padmapriya@i-netsolution.com";
//$buyerid = "alagirivimal@i-netsolution.com";
$paypalmail;
$success= $signin."success.php?pay=$pay";
//$success= "http://demo.2daytemplates.com/success.php?pay=$pay";
                
$fail = $signin."fail.php";
//$fail = "http://demo.2daytemplates.com/fail.php";
 */

$q11 = $con->query("SELECT * FROM product ");
$q12 = $con->query("SELECT * FROM product ");
?>