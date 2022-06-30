<?php include("includes/header.php"); 

 $sellid=$_REQUEST['id'];
	  $property=$_REQUEST['property'];  
	 //$name=$_REQUEST['test']; 
	//print_r($property);
	
	$sel_sql="select * from `product` where id='$sellid'";

	$res_sel=mysqli_query($con,$sel_sql);
	$result_sel=mysqli_fetch_array($res_sel);
	$userid=$result_sel['userid'];
	$sel_sql_re="select * from `registration` where id='$userid'";

	$res_sel_re=mysqli_query($con,$sel_sql_re);
	$result_sel_re=mysqli_fetch_array($res_sel_re);
	
	 $companyname=$result_sel_re['companyname'];
	  $useridd=$_SESSION['user_login'];
	
if(isset($_REQUEST['Submit_form_send']))
{

$get_sessid=$_SESSION['user_login'];
	$select_email="select * from registration where id='$get_sessid'";
	$res_email=mysqli_query($con,$select_email);
	$res_mailcount=mysqli_num_rows($res_email);
	$count_mail=mysqli_fetch_array($res_email);
	
	$ses_email=$count_mail['email'];
	$subject_send1=$_REQUEST['subject'];
	$message_send1=$_REQUEST['message'];
	$price=$_REQUEST['price'];
    $payment=$_REQUEST['payment'];
   	$orderquan=$_REQUEST['orderquan'];
	$terms=$_REQUEST['terms'];
	$today = date("F j, Y");
	$today1 = date('Y-m-d');
	   
	     //print_r($_SESSION);
		
        
		 $l=count($_SESSION);
		 for($h=0;$h<=$l;$h++)
		 {
		 $var=$_SESSION['sendid'.$h];
		 if($var!='')
		 {
		  $querycount=mysqli_query($con,"select * from product where id=$var");
		  $fetquery=mysqli_fetch_array($querycount);
		  $userid=$fetquery['userid'];
		  
		  $select_email_reg=mysqli_query($con,"select * from registration where id='$userid'");
		  $fet_reg=mysqli_fetch_array($select_email_reg);
		  $mail_reg=$fet_reg['email'];
		  $Firstname=$fet_reg['firstname'];
		  
		  	$from=$ses_email;
			$to=$mail_reg;
			 
			 $message=
"<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid ##29B1C9;\">
  <tr bgcolor=\"#FFEAC2\">
    <td colspan=\"2\"><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:##29B1C9; text-align:left; padding-bottom:10px; line-height:26px;text-align:center;\">
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
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">I have interested in your product.</span> </td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
    
  </tr>
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">Detail description</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $message_send1</span></td>
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
			 
		  $headers = 'From:' . $ses_email ."\r\n";
	      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		  mail($mail_reg,$subject_send1,$message,$headers);
		  
		  
	/*ini_set("SMTP","mail.inetmassmail.com");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'From:'.$webname."\n";
	
	include ("mailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.inetmassmail.com"; // SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = "info@inetmassmail.com";
	$mail->Password = "inetsol";

	$mail->From = "$ses_email <".$ses_email.">";
	$mail->FromName = $webname;
	$mail->AddAddress($mail_reg);
	$mail->AddReplyTo($ses_email);
	$mail->AddCustomHeader('Return-path:'.$mailurl);
	$mail->Sender = $mailurl;
	$mail->Subject =$subject_send1;
	$mail->Body = $message;
	$mail->WordWrap = 50;
	$mail->Send();*/
		  
		  
		  
		  
		  $viewcount=$fetquery['viewcount'];
		  $viewcount=$viewcount+1;
		  mysqli_query($con,"update product set viewcount='$viewcount' where id='$var'");
		  
		 $var1.="$var".",";
		 
		 $compose = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
			VALUES ('$useridd','$ses_email','$mail_reg','$subject_send1','$message_send1','$today1')";
			$coquery=mysqli_query($con,$compose);	
	
		 }
		 }
		
		
	
	mysqli_query($con,"INSERT INTO `productsend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$useridd', '$var1', '$subject_send1', '$message_send1', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");


   
	/*$from=$ses_email;
	$to=$ses_email;
	$Subject="$subject_send";
	$Message=$message_send;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers = 'From: User information ' ."\r\n";
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$rsmail=mail($to,$Subject,$Message,$headers);*/

// $joint_msg=$Subject .",".$Message.",". $ses_email;

//$_SESSION['value']=$joint_msg;

	//if($rsmail)
	//{
		header("location:productupload.php");
	//}
}


 ?>

<script language="JavaScript">
function openClosStatus(AAA) {
    if (
		document.getElementById(AAA).style.display == "block") {
        document.getElementById(AAA).style.display = "none";
       } 
	   else 
	   {
        document.getElementById(AAA).style.display = "block";
       }
}
function validate(doc)
{
	if(document.buying.subject.value=="")
	{
		alert("Please Enter the Subject");
		document.buying.subject.focus();
		return false;
	}
	if(document.buying.subject.value.length<=10)
	{
		alert("Please Enter the Subject Atleast More Than 10 Characters In Length");
		document.buying.subject.focus();
		return false;
	}
	if(document.buying.message.value=="")
	{
		alert("Please Enter the Message");
		document.buying.message.focus();
		return false;
	}
	if(document.buying.message.value.length<=10)
	{
		alert("Please Enter the Message Atleast More Than 10 Characters In Length");
		document.buying.message.focus();
		return false;
	}
	if(document.getElementById('reqHead').style.display=='block')
	{
	if(isNaN(document.buying.orderquan.value) )
	{
		alert("Please Enter the Intial Quantity in Numeric Form");
		document.buying.message.focus();
		return false;
	}
	if(document.buying.orderquan.value <=0 )
	{
		alert("Please Enter the Intial Quantity above Zero");
		document.buying.message.focus();
		return false;
	}
	}

}

function echeck(str) 
{
 var at="@"
 var dot="."
 var lat=str.indexOf(at)
 var lstr=str.length
 var ldot=str.indexOf(dot)
 if (str.indexOf(at)==-1) 
 {
   alert("Invalid E-mail ID")
   return false
 }
 if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(at,(lat+1))!=-1)
 {
  alert("Invalid E-mail ID")
  return false
  }
 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot,(lat+2))==-1)
 {
  alert("Invalid E-mail ID")
  return false
 }		
 if (str.indexOf(" ")!=-1)
 {
  alert("Invalid E-mail ID")
  return false
 }

 return true					
}


function dodisable()
{
document.buying.bpassword.readOnly=true;
}

function dodisable1()
{
document.buying.bpassword.readOnly=false;
}

</script>
<script type="text/javascript">
function valnew()
{
	if(document.getElementById('hiddivval').value=='')
	{
	document.getElementById('hiddivval').value='text';
	}
	else
	{
	document.getElementById('hiddivval').value='';
	}
	
}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>

</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span><strong> <?php echo $compose; ?></strong></span></div>
<div style="border: solid 1px #CFCFCF;">

<table width="80%" border="0" align="center"  cellpadding="0" cellspacing="0" >
                <form enctype="multipart/form-data" name="buying" action="" method="POST" onsubmit="return validate(this)">  <tr>
                    <td><input type="hidden" id="hiddivval" name="divval" value=""/>
                      <table width="100%" height="491"  border="0"  cellpadding="2" cellspacing="2">
                        <tr>
                          <td colspan="2"><table width="100%">
                            <tr>
                            <td align="right" ><span style="color:#FF0000">*</span><?php echo $required_info; ?></td>
                          </tr></table></td>
                          </tr>
                        <tr>
                          <td width="40%" height="34" align="left" class=""><strong><?php echo $to; ?></strong></td>
                          <td width="60%"><?php
						 $companyname;
						
						  $i=0;
						  foreach($_REQUEST['property'] as $array) 
						  {
													
							$i++;
							$array."<br>";
							$company=$array['seller_companyname'];
							$select="select * from product where id='$array'";
							$res=mysqli_query($con,$select);
							$count=mysqli_num_rows($res);
							$res_fetch=mysqli_fetch_array($res);
							$userid=$res_fetch['userid'];
							$re=mysqli_query($con,"select * from registration where id='$userid'");
							$re_fet=mysqli_fetch_array($re);
							$resultarray=$re_fet['companyname'];
							echo "$resultarray" . "<br>";
							$sendid=$res_fetch['id'];
						    $_SESSION['sendid'.$i]=$sendid;
								
 						 }
						 
  ?>  </td>
                        </tr>
                        <tr>
                          <td align="left" class=""><span style="color:#FF0000">* </span> <strong><?php echo $subject; ?></strong></td>
                          <td><label>
                            <input name="subject" type="text" class="textBox" id="subject" size="35" />
                          </label></td>
                        </tr>
                        <tr>
                          <td height="102" align="left" valign="top" class=""><span style="color:#FF0000">* </span> <strong><?php echo $message; ?></strong></td>
                          <td><label>
                            <textarea name="message" cols="30" rows="5" ></textarea>
                          </label></td>
                        </tr>
                        <tr>
                          <td align="left" class=""><div align="left"></div></td>
                          <td><label></label>
                              <input name="hiddenField" type="hidden"  value="Please Enter your Message&nbsp;" /></td>
                        </tr>
                        <tr>
                          <td align="left" class="" ><strong><?php echo $purchase_type; ?></strong>: 
						</td>
                          <td><label>
                            <input type="checkbox" name="checkbox" value="checkbox" />
                            <?php echo $urgent; ?></label></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="middle" class="text"><span class="bottomlink"><a href="javascript:openClosStatus('reqHead');"><?php echo $additional; ?></a><a href="javascript:openClosStatus('reqHead');" class="topics"></a><a href="javascript:openClosStatus('reqHead');" class="topics"> (</a></span><span class="bottomlink"><a href="javascript:openClosStatus('reqHead');"><?php echo $clickhere_to_more; ?>.</a><a href="javascript:openClosStatus('reqHead');" class="topics"></a></span><span class="topics"><a href="javascript:openClosStatus('reqHead');" class="topics">)</a></span>
                            <div id="reqHead" style="display:none">
						 &nbsp;&nbsp;<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <th width="20%" align="left"><strong><?php echo $price_terms; ?>:</strong></th>
   <td colspan="3">
    <table align="left" border="0" cellpadding="0" cellspacing="2" width="44%">
     <tr>
      <td width="25%" nowrap="nowrap"><strong><?php echo $Incoterm; ?></strong>
                <select name="price" >
                    <option value=""><?php  echo $sel; ?></option>
                    	<option value="FOB" ><?php echo $fob; ?></option>
                    		<option value="CIF" ><?php echo $cif; ?></option>
								<option value="CNF" ><?php echo $cnf; ?></option>

                    		<option value="Other" ><?php echo $OTHER; ?></option>
                </select>    </td>
        <td width="75%" nowrap="nowrap" style="padding-left: 10px;"><strong><?php echo $payment; ?> </strong>
                <select name="payment" >
                    <option value=""><?php echo $sel; ?></option>
                    <option value="L/C" ><?php echo lc; ?></option>

                    <option value="T/T" ><?php echo $tt; ?></option>
                    <option value="Escrow" ><?php echo $Escrow; ?></option>
                    <option value="Other" ><?php echo $OTHER; ?></option>
                </select>    </td>
    </tr>
</table></td>
</tr>
<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>
<tr>
<th  width="27%" align="left"><strong><?php echo $initial_order; ?>:</strong></th>
<td valign="middle">
    <input name="orderquan" id="orderQuantityClient" value=""  size="39" maxlength=100 onkeyDown="return attachEnter(event)"
    onFocus="javascript:showCurrentTips('egIoq')" /><span id="egIoq" >eg:10,000/pcs</span>
<div id="orderQuantityClient_info"  style="display:none"></div></td>
</tr>
<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>
<tr>
<th width="27%" align="left"><strong><?php echo $sample_terms; ?>:</strong></th>
<td colspan="3">
  <select name="terms">
    <option value=""><?php echo $sel; ?></option>
    <option value="Free sample" ><?php echo $free_sample; ?></option>
    <option value="Buyer pays shipping fee" ><?php echo $buyer_pay; ?></option>
    <option value="Seller pays shipping fee" ><?php echo $seller_pay_shipping; ?></option>
    <option value="Buyer pays sample fee" ><?php echo $buyers_pay_sample; ?></option>
    <option value="Seller pays sample fee" ><?php echo $seller_pay_sample; ?></option>
    <option value="Buyer pays both shipping and sample fee" ><?php echo $buyers_both; ?></option>
    <option value="Seller pays both shipping and sample fee" ><?php echo $seller_both; ?></option>
  </select></td>
</tr>
<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>

</table>
</div></td>
                        </tr>
                        <!--<tr>
                          <td colspan="2" valign="top" class="inTxtSHead"><p><b>Trade Alert</b></p>
                            <label>
                            <input type="checkbox" name="checkbox2" value="checkbox" />
                            Tell me by email when there are new products and suppliers for: <strong> <?php
						  /*echo $companyname;
						
						  $i=0;
						  foreach($_REQUEST['property'] as $array) 
						  {
													
							$i++;
							$array."<br>";
							$company=$array['p_name'];
							$select="select * from product where id='$array'";
							$res=mysqli_query($con,$select);
							$count=mysqli_num_rows($res);
							$res_fetch=mysqli_fetch_array($res);
							$resultarray=$res_fetch['p_name'];
							echo "$resultarray" . "<br>";
							$sendid=$res_fetch['id'];
						    $_SESSION['sendid'.$i]=$sendid;
								
 						 }*/
						 
  ?>  </strong></label></td>
                        </tr>-->
                        <tr>
                          <td height="64"  colspan="3" align="center"><input name="Submit_form_send" type="submit" class="search_bg" id="Submit_form_send"  value="<?php echo $submit; ?>" /></td>
                        </tr>
                      </table>
                   </td>
                  </tr>
                   </form>
                </table> 



</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>


