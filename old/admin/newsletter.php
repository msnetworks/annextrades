<?php 
session_start();
	ob_start();
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination.php";
	if(isset($_REQUEST['send']))
{
$chk_list=$_REQUEST['chk_list'];
include ("../mailer/class.phpmailer.php");
foreach ($chk_list as $check)
{
$check;

//echo "select * from registration where id='$check'";

$res=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$check'"));

//ini_set("SMTP","mail.i-netsolution.com");

$to=$res['email'];
$messages=$_REQUEST['message'];
$from=$mailurl;
$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;

$subject="Admin News Letter";
$message=
"<table width='550' cellpadding='0' cellspacing='0' border='0' bgcolor='#F2F1F1' style='border:solid 10px #25ABC4;'>
  <tr bgcolor='#FFFFFF' height='25'>
    <td style='padding:10px;'><img src='$mail_url/images/$logo'  width='169' height='48' border='0' /></td>
  </tr>
  <tr bgcolor='#FFFFFF'>
    <td>&nbsp;</td>
  </tr>
<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>You're an $webname Member!</b></td>
  </tr>  
  
 <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Dear Members,</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Detail Newsletter</b></td>
  </tr>
  <tr bgcolor='#FFFFFF' height='30'>
    <td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>$messages</b></td>
  </tr>
  
   <tr bgcolor='#FFFFFF' height='35'>
    <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Please <a href='$mail_url/login.php'>Click here</a> to Signin This website.</td>
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

/*echo $to;
echo $subject;
echo $message;
echo $headers; exit;*/

/*$headers = 'From:'.$from."\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
mail($to,$subject,$message,$headers);*/

ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "info123";

	$mail->From = "$mailurl <".$mailurl.">";
	$mail->FromName = $webname;
	$mail->AddAddress($to);
	$mail->AddReplyTo($mailurl);
	$mail->AddCustomHeader('Return-path:'.$mailurl);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject;
	$mail->Body = $message;
	$mail->WordWrap = 50;
	$mail->Send(); 



}
header("location:successnewsletter.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
	{
		
		return;
	}
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
	{
		objCheckBoxes.checked = CheckValue;
		
	}
	else
	{
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		{
			objCheckBoxes[i].checked = CheckValue;
			}
	}
}

function checkbox()
{
var lengthcount=document.searchform.maxvalue.value;
 //alert(lengthcount);
var checkedcount=0;
   for(var i=0;i<lengthcount;i++)
    {
     var check_list="chk_list["+i+"]";
	 //alert(check_list);
     var ch=document.getElementById(check_list);
	 //alert(ch);
      if(ch.checked==true)
       {
	    checkedcount++;
	   }
	  
    }
	//alert(checkedcount);
    if(checkedcount < 1)
         {
	      alert("Select Atleast One Record")
	      return false;
	     }
		
    document.getElementById('10').value = document.getElementById("wysiwyg10").contentWindow.document.body.innerHTML;
	if(document.getElementById('10').value.replace("<br>","NULL")=="NULL")
	{
		alert("Please enter Message ");
		return false;
	}
          
}
function confirmdel()
{

var result=checkbox();
   if(result == false)
     {
	 return false;
	 }
	 else
	 {
	 document.searchform.submit();
	 }
}
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style>
BODY, TD {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>

<script language="javascript">
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			dateFormat: 'yy-mm-dd',
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/demos_ddd.css">
<script language="javascript">

		<script src="js/jquery-1.5.1.js"></script>
		<script src="js/jquery.ui.core.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js/jquery.ui.datepicker.js"></script>
		<script>
		$(function() {
				$( "#datepicker").datepicker();
			});
			
		$(function() {
				$( "#tospicker").datepicker();
			});
		</script>
</script>
</head>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Newsletter</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Newsletter</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="searchform" action="newsletter.php" method="post">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="129">
				 	
					<!--<table width="437" align="center">
						<tr class="normal"><td width="138" height="37">Keyword</td>
						<td width="3">:</td>
						<td width="280"><input type="text" name="keyword" /></td></tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style="font-size:12px">(Search in Firstname, Lastname, Email-id, Gender and Membership type only)</span></td></tr>
						<tr class="normal"><td height="26" colspan="3" align="center">
						<input type="submit" name="submit" value="Search" /></td>
						</tr>
				   </table>-->
				   
				   <table border="0" width="657">
				   	<tr align="right">
						<td width="12">&nbsp;</td>
						<td width="144" height="50">Name</td>
						<td width="7">:</td>
						<td width="165"><input type="text" name="firstname" value="<?php echo $_REQUEST['firstname']; ?>" /></td>
						
						<td width="125">Email</td>
						<td width="10">:</td>
					  <td width="164"><input type="text" name="email" value="<?php echo $_REQUEST['email']; ?>" /></td>
					</tr>
					
					<tr align="right">
						<td>&nbsp;</td>
						<td>Register From</td>
						<td>:</td>
						<td><input type="text" name="login_from" id="datepicker" value="<?php echo $_REQUEST['login_from']; ?>" /></td>
						
						<td>Register To</td>
						<td>:</td>
						<td><input type="text" name="login_to" id="tospicker" value="<?php echo $_REQUEST['login_to']; ?>" /></td>
					</tr>
					
					<tr class="normal"><td height="36" colspan="8" align="center">
						<input type="submit" name="submit" value="Search" /></td>
					</tr>
			      </table>
				   
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td valign="top">
				
			<table width="732" height="79" align="center" cellspacing="2" cellpadding="2" style="border:1px solid #99CCFF;">
						
			<tr bgcolor="#99CCFF">
			<td width="74" height="29">&nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('searchform','chk_list[]',true)" style="color:#000000;"><b>Select All</b></a> / &nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('searchform', 'chk_list[]', false)" style="color:#000000;"><b>Clear All</b></a></td>
			<td width="190" class="normalbold" align="center">&nbsp;User Name</td>
			<td width="186" class="normalbold" align="center">&nbsp;Added date</td>
			<td width="127" class="normalbold" align="center">&nbsp;Members</td>
			<td width="121" class="normalbold" align="center">&nbsp;IP Address</td>
		</tr>
<?php 
					
/*if(isset($_REQUEST['submit']))
{*/
/*{
$keyword=$_REQUEST['keyword'];
$str="";
if($keyword!="")
{
	if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp." firstname LIKE '%$keyword%' or email Like '%$keyword%' or gender Like '$keyword' or lastname Like '%$keyword%' or membershiptype Like '%$keyword%'";
}
if($str!="")
{
//echo "select * from registration where $str";

$select="select * from `registration` where  $str and newsletter_option=0";

}else{

$select="select * from `registration` where newsletter_option=0";

}
//$_SESSION['sql']=$select;				
}
else
{
$select="select * from `registration` where newsletter_option=0";
}*/

	
$name=$_REQUEST['firstname'];
$email=$_REQUEST['email'];

$fdate=$_REQUEST['login_from'];
$reg_from = date("Y-m-d",strtotime($_REQUEST['login_from']));
$reg_to = date("Y-m-d",strtotime($_REQUEST['login_to']));

if($name!="")
{
 $q1 = " AND registration.firstname like '%$name%' ";
}

if($email!="")
{
 $q2 = " AND registration.email like '%$email%' ";
}

if($fdate!="")
{
//$str_qry.=$temp_qry . "  and added_date between '$reg_from' and '$reg_to' ";
 $q3 = " AND registration.added_date between '$reg_from' and '$reg_to' ";
}

$query = $q1.$q2.$q3;
$query =substr($query, 5);

if($query!='')
{
	$select="select * from `registration` where  $query and newsletter_option=0";
}
else
{
	$select="select * from `registration` where newsletter_option=0";
}
 //$select=$_SESSION['sql'];
	 
	 		  $strget="submit=Submit&keyword=$keyword";
              $rowsPerPage =25;
              $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
              $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  
			  $count=mysqli_num_rows($query);
	                      
	                if($count > 0)
					{
					    $i=0;
						while($members=mysqli_fetch_array($query))
						{
							$memberid=$members['id'];
							
						?>
					
						<tr>
		<td align="center"><input type="checkbox" name="chk_list[]" value="<?php echo $members['id']; ?>" id="chk_list[<?php echo $i; ?>]"/></td>
					<td>&nbsp;<?php echo $members['firstname']; ?></td>
					<?php if($members['added_date']!="0000-00-00 00:00:00") { ?>
						<td>&nbsp;<?php echo date("Y-m-d",strtotime($members['added_date']));?></td>
					<?php } else { ?>	
					<td>&nbsp;<?php echo "0000-00-00"; ?></td>
					<?php } ?>
					<td>&nbsp;<?php echo $members['membershiptype'];?></td>
					<td>&nbsp;<?php echo $members['ip_address']; ?></td>
					<?php
					$i++;
						}
						?>
						<input name="maxvalue" type="hidden" value="<?php echo $i;?>" />
						<tr><td colspan="5" align="center"><?php echo $pagingLink;?></td></tr>
						<?php 
						}
						else
						{
						?>
				<tr><td colspan="5" align="center"><span class="style1">No Members Found</span></td>
				</tr>
					<?php
					 }
					 ?>
				  </table>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">Message&nbsp;&nbsp;
				<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script> 
				 <textarea name="message" rows="10" cols="50" ID="10" ></textarea>
				 <script language="JavaScript">
    		generate_wysiwyg('10');
        </script></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td align="center">
				<input type="submit" name="send" value="Submit" onclick="javascript:return confirmdel();"/></td></tr>
				<tr><td>&nbsp;</td></tr>
		  </table>
		  </form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>

