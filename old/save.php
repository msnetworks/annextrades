<?php 
ob_start();
session_start();
//$sess_id=$_SESSION['sess_id']; 
include "db-connect/notfound.php";

if($session_user=="")
	{
		header("location:login.php");
	}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
 
if(isset($_REQUEST['Submit_compose']))
{ 
//$From= $_REQUEST['from'];
$From= 'welcome@annextrades.com';
$sql_from=mysqli_query($con,"select * from  registration where email='$From'"); 
$row_from=mysqli_fetch_array($sql_from);
$User_id= $row_from['id']; 					   
 $To = $_REQUEST['to']; 
$TT=explode(",",$To);
for($i=0;$i<count($TT);$i++)
{
	 $Too=$TT[$i]; 
	if($Too!='')
	{
		$sql_to=mysqli_query($con,"select * from  registration where email='$Too'"); 
		$row_to=mysqli_fetch_array($sql_to);
		$receiver_id= $row_to['id']; 	
		
		//echo "select * from `add_contacts` where `user_id`='".$_SESSION['sess_id']."' and `contact_mail`='$To' and `status`=1 ";
		$sql_blockchk=mysqli_query($con,"select * from `add_contacts` where `user_id`='$session_user' and `contact_mail`='$To' and `status`=1 "); 
		 $row_bchk=mysqli_num_rows($sql_blockchk);
		
	//	$Stat = $row_bchk['status'];
		if($row_bchk > 0)
		{
			/*$Subject =$_REQUEST['subject'];
			$Message = $_REQUEST['message'];
			$Date= date("Y-m-d h:m:s");
			
			$insertsql =  "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`status`,`date`) 
			VALUES ('$User_id','$From','$Too' , '$Subject', '$Message','3','$Date')";
			$query=mysqli_query($con,$insertsql);	*/
			header("location:compose.php?err=1");
			exit;

	
		}
		else 
		{
			$Subject =$_REQUEST['subject'];
			$Message = $_REQUEST['message'];
			$Date= date("Y-m-d h:m:s");
			
			echo "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$User_id','$From','$Too' ,'$Subject', '$Message','$Date')"; 
			
			$insertsql =  "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$User_id','$From','$Too' ,'$Subject', '$Message','$Date')";
			$query=mysqli_query($con,$insertsql);				
			
			//$headers = $From;
			//$to      = $Too;
			/*$subject = $Subject;
			$message = $Message;
			$headers .= "MIME-Version: 1.0\r\n";
  			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  			$headers .= 'From:'.$From. "\r\n";
  			//$to      = $Email;	
*/

$mail = new PHPMailer();
require('smtpdetails.php');
$mail->setFrom($From);
$mail->addReplyTo($From);
$mail->addAddress($Too);
$mail->isHTML(true);
$mail->Subject = $Subject;
$mail->Body = $Message;


if(!$mail->Send()) {
        
       header("location:sentitems.php?del_msg"); 
      
     } else {
     	header("location:sentitems.php?success"); 
     }
			
			
		}
	 }
	}
}
//header("location:compose.php?success");

?>