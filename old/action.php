<?php
session_start();
$session_user=$_SESSION['user_login'];
error_reporting(0);
include("db-connect/notfound.php");
$subcategory = $_POST['subcat'];
if($_REQUEST['submit'])
	{

		$leadtype = $_POST['leadtype'];
		$subject = $_POST['subject'];
		$keyword = $_POST['keyword'];
		$category = $_POST['p_cat'];
		$subcategory = $_POST['subcategory'];
		$description = $_POST['briefdescription'];
		
		$price=$_REQUEST['price'];
	    $cur_type=$_REQUEST['cur_type'];
		$del_type=$_REQUEST['del_type'];	
		$del_charge=$_REQUEST['del_charge'];
		$del_cur_type=$_REQUEST['del_cur_type'];
		
		
		$detaildescription = $_POST['detaileddescription'];
		$valid = $_POST['valid'];
		$photo = $_POST['uploadedfile'];
		$companyname = $_POST['companyname'];
		$businesstypepost = $_POST['businesstype']; 
		$businessrange = $_POST['businessrange'];
		$companyname = $_POST['companyname'];
		$address = $_POST['streetaddress'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		if($_SESSION['language']=='english')
{
$lang_status='0';

}
else if($_SESSION['language']=='french')
{
$lang_status='1';

}
else if($_SESSION['language']=='chinese')
{
$lang_status='2';
}
else
{
$lang_status='3';
}
		$q = mysqli_query($con,"select * from registration where id='$session_user'");
		$f = mysqli_fetch_array($q);
		 $country_sell=$f['country']; 
		 $user_id = $f['id'];
		//echo "viji";
		
		 $up_today=date("Y-m-d"); 
		
		 $es_today = date('Y-m-d',mktime(0,0,0, date("m") , date("d") , date("Y") + 1 ));
		
		
		$today=date("F j, Y");
		$expired = date("F j, Y", strtotime("+1 year"));

		//$today = date("Y-m-d");
		//$expiredmonth = date('Y-m-d',mktime(0,0,0, date("m") + 6 , date("d") , date("Y")));
		
		
		
		for($c = 0; $c < sizeof($businesstypepost); $c++)
			{
				$businesstype = implode(',',$_POST['businesstype']);
			}
			
		$filename=basename($_FILES['uploadedfile']['name']);
		$tmpfilename=$_FILES['uploadedfile']['tmp_name'];
		$uploadpath1="uploads/".$filename;
   		move_uploaded_file($tmpfilename,$uploadpath1); 									
			
			$uploadpath2="blog_photo_thumbnail/".$filename;
   		move_uploaded_file($tmpfilename,$uploadpath2); 							
	
	$post_id=$_SERVER['REMOTE_ADDR'];
	
  $sql = "INSERT INTO tbl_seller (
		user_id, 
		seller_leadtype, 
		seller_subject, 
		seller_keyword, 
		seller_category,
		seller_subcategory,  
		seller_description, 
		seller_detaildescription, 
		seller_valid, 
		seller_photo, 
		seller_companyname, 
		seller_businesstype, 
		seller_businessrange, 
		seller_address, 
		seller_city, 
		seller_state, 
		seller_country, 
		seller_zip,
		
		seller_updated_date,
		seller_expired_date,
		post_ip,
		status,lang_status,price,cur_type,delivery_type,delivery_charge,del_cur_type) VALUES (
		'$session_user', 
		'$leadtype', 
		'$subject', 
		'$keyword', 
		'$category',
		'$subcategory',  
		'$description', 
		'$detaildescription', 
		'$valid', 
		'$filename', 
		'$companyname', 
		'$businesstype', 
		'$businessrange', 
		'$address', 
		'$city', 
		'$state', 
		'$country_sell', 
		'$zip',
		'$today',
		'$expired',
		'$post_id',
		'1','$lang_status','$price','$cur_type','$del_type','$del_charge','$del_cur_type')"; 
		//echo $sql; exit;
		
	//echo "select * from trade_alert where keyword='$subject' or keyword='$keyword' and selectinfo='product'"; break;
include ("mailer/class.phpmailer.php");		
$selecttrade=mysqli_query($con,"select * from trade_alert where keyword='$subject' or keyword='$keyword' and selectinfo='product'");
while($rowfetch=mysqli_fetch_array($selecttrade))
{
$tradeuserid=$rowfetch['user_id'];
$selectreg=mysqli_query($con,"select * from registration where id='$tradeuserid'");
$fetchreg=mysqli_fetch_array($selectreg);
$em=$fetchreg['email'];
$Firstname=$fetchreg['firstname'];
$selectreg1=mysqli_query($con,"select * from registration where id='$session_user'");
$fetchreg1=mysqli_fetch_array($selectreg1);
$em1=$fetchreg1['email'];

$sub=$subject;
$msg=

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
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">I have already a member in $webname. And given below for the my detail description of Sales Requirement.</span> </td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
    
  </tr>
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">Detail description in my Selling leads</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $description</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\">$detaildescription</span></td>
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

ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$em1."\n";
	
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$em1 <".$em1.">";
	$mail->FromName = $webname;
	$mail->AddAddress($em);
	$mail->AddReplyTo($em1);
	$mail->AddCustomHeader('Return-path:'.$em1);
	$mail->Sender = $em1;
	$mail->Subject =$sub;
	$mail->Body = $msg;
	$mail->WordWrap = 50;
	$mail->Send(); 

/*$headers = 'From:' . $em1 ."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($em,$sub,$msg,$headers);*/

}
		
		 
  $result = mysqli_query($con,$sql); 

   header("Location:selling_leads.php"); 
  //echo "thanks";

	}

?>
