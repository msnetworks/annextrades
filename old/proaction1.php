<?php include("includes/header.php"); 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


	$property=$_REQUEST['property']; 
	//$uid=$_REQUEST['uid'];
    if(isset($_REQUEST['uid'])) 
	{
	$userid=$_REQUEST['uid'];
	}
	if(isset($_REQUEST['id']))
	{	
	$sellid=$_REQUEST['id'];
	$sel_sql="select * from `product` where id='$sellid'";
	$res_sel=mysqli_query($con,$sel_sql);
	$result_sel=mysqli_fetch_array($res_sel);
   // echo '<pre>';
    //print_r($result_sel);
    //echo '</pre>';
	$userid=$result_sel['userid'];
    $product_name_c = $result_sel['p_name'];
	}
	
	$sel_sql_re="select * from `registration` where id='$userid'";

	$res_sel_re=mysqli_query($con,$sel_sql_re);
	$result_sel_re=mysqli_fetch_array($res_sel_re);
	$resmail=$result_sel_re['email'];
	$Firstname=$result_sel_re['firstname'];
     $companyname=$result_sel_re['companyname'];
	 $useridd=$_SESSION['user_login'];
    
     

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];



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
	//$today1=time("g:i a");
	$today1=date('Y-m-d');
	$fromm=$ses_email;
	$too=$resmail;
    
    $querycount=mysqli_query($con,"select * from product where id=$sellid");
    $fetquery=mysqli_fetch_array($querycount);
    $viewcount=$fetquery['viewcount'];
    $viewcount=$viewcount+1;
    mysqli_query($con,"update product set viewcount='$viewcount' where id='$sellid'");
  
mysqli_query($con,"INSERT INTO `productsend` (`userid` , `productid` , `subject` , `message` , `enterdate` , `entertime` , `price` , `payment` , `quantity` , `sample` , `request` )
VALUES ('$useridd', '$sellid', '$subject_send1', '$message_send1', '$today', '', '$price', '$payment', '$orderquan', '$terms', ''
)
");

    $composemsg = "INSERT INTO `messages` (`user_id`,`from_mail`, `to_mail` ,`subject` , `message`,`date`) 
        VALUES ('$useridd','$ses_email','$resmail','$subject_send1','$message_send1','$today1')";
        $coquery=mysqli_query($con, $composemsg);

      $messageId = mysqli_insert_id($con);

      $clickHereLink = $url."/inboxmsg.php?view=".$messageId;

	$messagemail=
        "<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #29B1CA; \">
            <tr bgcolor=\"#FFEAC2\" style=\"padding: 15px\">
                <td><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#29B1CA; text-align:left; padding-bottom:10px; padding-top:10px; line-height:26px;text-align:center;\">
                    Dear ANNEXTrades Member<br>
                    </div>
                </td>
                
            </tr>
            <tr>
                <td><div style=\"padding: 15px;\"><span style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><b>Dear $Firstname,</b></span></div></td>
                
                <tr>
                <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">You have a new message from an interested customer. Please <a href='".$clickHereLink."'>click here</a> to login and view your message and reply using your member dashboard. It is best to respond within 24 hours . </span> </div></td>
                </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><div style=\"padding: 15px;\"><b><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">ANNEXTrades Service Team</span></b></div></td>
            </tr>
        </table>";
$mail = new PHPMailer();

require('smtpdetails.php');

$ses_email = "welcome@annextrades.com";

$mail->setFrom("welcome@annextrades.com", "ANNEXTrades");
$mail->addReplyTo('annexis.data@gmail.com', 'AnnexTrades');
$mail->AddCC($resmail);
//$mail->addAddress($resmail);

$mail->isHTML(true);

$mail->Subject = $subject_send1;
$mail->Body = $messagemail;
 
//-------notification mail-----------
$m1 = 'annexis.data@gmail.com';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= "From: ".$m1."\r\n"."Reply-To: annexis.data@gmail.com"."\r\n" ."X-Mailer: PHP/" . phpversion();

$notification = "<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #29B1CA; \">
                    <tr bgcolor=\"#FFEAC2\" style=\"padding: 15px\">
                        <td><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#29B1CA; text-align:left; padding-bottom:10px; padding-top:10px; line-height:26px;text-align:center;\">
                            Dear ANNEXTrades Member<br>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td><div style=\"padding: 15px;\"><span style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><b>Dear $Firstname,</b></span></div></td>
                    </tr>  
                    <tr>
                        <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">You have a new message from an interested customer. Please <a href='".$clickHereLink."'>click here</a> to login and view your message and reply using your member dashboard. It is best to respond within 24 hours . </span> </div></td>
                    </tr>
                    <tr>
                        <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">Mail From: ".$_SESSION['email']." </span> </div></td>
                    </tr>
                    <tr>
                        <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">Mail To: $resmail </span> </div></td>
                    </tr>
                    <tr>
                        <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">Subject: $subject_send1 </span> </div></td>
                    </tr>
                    <tr>
                        <td><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\"><div style=\"padding: 15px;\">Subject: $message_send1 </span> </div></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div style=\"padding: 15px;\"><b><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">ANNEXTrades Service Team</span></b></div></td>
                    </tr>
                </table>";

@mail($m1, $subject_send1, $notification, $headers);


if (!$mail->send()) {
    //echo 'Message could not be sent.';
    $sentmessageerror ='*Your message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    ?>

    <script>
  setTimeout(function(){
    document.getElementById('info-message-error').style.display = 'none';
    
  }, 7000);
</script>
<style>
	#info-message-error {
    color: red;
    font-size: 18px;
    font-weight: bold;
}
	</style>

    <?php
} else {
   // echo 'Message has been sent';
    $sentmessagesuccess ="*Your message has been sent";

    ?>


    <script>
  setTimeout(function(){
    document.getElementById('info-message-success').style.display = 'none';
   
  }, 7000);
</script>
<style>
	#info-message-success {
    color: green;
    font-size: 18px;
    font-weight: bold;
}
	</style>
    <?php
}



}





 ?>

<script language="JavaScript">
function openClosStatus(AAA) {
    if (
        document.getElementById(AAA).style.display == "block") {
        document.getElementById(AAA).style.display = "none";
    } else {
        document.getElementById(AAA).style.display = "block";
    }
}

function validate(doc) {
    if (document.buying.subject.value == "") {
        alert("Please Enter the Subject");
        document.buying.subject.focus();
        return false;
    }
    if (document.buying.subject.value.length <= 10) {
        alert("Please Enter the Subject Atleast More Than 10 Characters In Length");
        document.buying.subject.focus();
        return false;
    }
    if (document.buying.message.value == "") {
        alert("Please Enter the Message");
        document.buying.message.focus();
        return false;
    }
    if (document.buying.message.value.length <= 10) {
        alert("Please Enter the Message Atleast More Than 10 Characters In Length");
        document.buying.message.focus();
        return false;
    }
    if (document.getElementById('reqHead').style.display == 'block') {
        if (isNaN(document.buying.orderquan.value)) {
            alert("Please Enter the Intial Quantity in Numeric Form");
            document.buying.message.focus();
            return false;
        }
        if (document.buying.orderquan.value <= 0) {
            alert("Please Enter the Intial Quantity above Zero");
            document.buying.message.focus();
            return false;
        }
    }

}

function echeck(str) {
    var at = "@"
    var dot = "."
    var lat = str.indexOf(at)
    var lstr = str.length
    var ldot = str.indexOf(dot)
    if (str.indexOf(at) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at, (lat + 1)) != -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot, (lat + 2)) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(" ") != -1) {
        alert("Invalid E-mail ID")
        return false
    }

    return true
}


function dodisable() {
    document.buying.bpassword.readOnly = true;
}

function dodisable1() {
    document.buying.bpassword.readOnly = false;
}
</script>
<script type="text/javascript">
function valnew() {
    if (document.getElementById('hiddivval').value == '') {
        document.getElementById('hiddivval').value = 'text';
    } else {
        document.getElementById('hiddivval').value = '';
    }

}
</script>


<div class="body-cont">

    <div class="body-cont1">
        <div class="body-leftcont">
            <div class="cate-cont">
                <div class="cate-heading"> <?php echo $browse; ?></div>
                <?php include("includes/sidebar.php"); ?>



            </div>

            <?php // include("includes/innerside1.php"); ?>

        </div>





        <div class="body-right">

            <?php include("includes/menu.php"); ?>
 <p id="info-message-success"><?php echo $sentmessagesuccess; ?></p>
 <p id="info-message-error"><?php echo $sentmessageerror; ?></p>
            <div class="products-cate-cont">

                <div class="headinggg"> <span><strong> <?php echo $compose; ?></strong></span></div>
               

                <div style="background: #f9f9f9">

                    <div class="p-2">
                        <form enctype="multipart/form-data" name="buying" action="" method="POST"
                            onsubmit="return validate(this)">
                            <input type="hidden" id="hiddivval" name="divval" value="" />

                            <div class="input-group">
                                <label><span style="color:#FF0000">*</span><span>Required information</span>
                                </label>
                            </div>
                            <div class="input-group">
                                <h6><?php echo $to; ?></h6>
                                <div><?php echo  $companyname;?> </div>
                            </div>
                            <div class="input-group">
                                <h6><span style="color:#FF0000">* </span><?php echo $subject; ?></h6>

                                <input name="subject" type="text" class="textBox" id="subject" value="<?php echo $product_name_c ?>" size="35" />
                            </div>
                            <div class="input-group">
                                <h6><span style="color:#FF0000">* </span><?php echo $message; ?></h6>

                                <textarea name="message" cols="30" rows="5"></textarea>

                            </div>
                            <div class="input-group">
                                <input name="hiddenField" type="hidden" value="Please Enter your Message&nbsp;" />
                            </div>
                            <div class="input-group">
                                <h6><?php echo $purchase_type; ?></h6>
                                <div><label>
                                        <input type="checkbox" name="checkbox" value="checkbox" />
                                        <?php echo $urgent; ?></label></div>
                            </div>
                            <div class="mb-3">
                                <div class="text">
									<span class="bottomlink"><a
                                            href="javascript:openClosStatus('reqHead');"><?php echo $additional; ?></a><a
                                            href="javascript:openClosStatus('reqHead');" class="topics"></a><a
                                            href="javascript:openClosStatus('reqHead');" class="topics">
                                            (</a></span><span class="bottomlink"><a
                                            href="javascript:openClosStatus('reqHead');"><?php echo $clickhere_to_more; ?>.</a><a
                                            href="javascript:openClosStatus('reqHead');" class="topics"></a></span><span
                                        class="topics"><a href="javascript:openClosStatus('reqHead');"
                                            class="topics">)</a></span>
                                    <div id="reqHead" style="display:none">

                                        <div class="input-group">
                                            <h5><?php echo $price_terms; ?></h5>
                                        </div>
                                        <div class="input-group">

                                            <h6><?php echo $Incoterm; ?></h6>
                                            <select name="price">
                                                <option value=""><?php  echo $sel; ?>
                                                </option>
                                                <option value="FOB"><?php echo $fob; ?>
                                                </option>
                                                <option value="CIF"><?php echo $cif; ?>
                                                </option>
                                                <option value="CNF"><?php echo $cnf; ?>
                                                </option>

                                                <option value="Other">
                                                    <?php echo $OTHER; ?></option>
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <h6><?php echo $payment; ?> </h6>
                                            <select name="payment">
                                                <option value=""><?php echo $sel; ?>
                                                </option>
                                                <option value="L/C"><?php echo lc; ?>
                                                </option>

                                                <option value="T/T"><?php echo $tt; ?>
                                                </option>
                                                <option value="Escrow">
                                                    <?php echo $Escrow; ?></option>
                                                <option value="Other">
                                                    <?php echo $OTHER; ?></option>
                                            </select>
                                        </div>


                                        <div class="input-group">
                                            <h6><?php echo $initial_order; ?>:</h6>

                                            <input name="orderquan" id="orderQuantityClient" value="" size="39"
                                                maxlength=100 onkeyDown="return attachEnter(event)"
                                                onFocus="javascript:showCurrentTips('egIoq')" /><span
                                                id="egIoq" class="info">eg:10,000/pcs</span>
                                            <div id="orderQuantityClient_info" style="display:none">
                                            </div>
                                        </div>



                                        <div class="input-group">

                                            <h6><?php echo $sample_terms; ?></h6>

                                            <select name="terms">
                                                <option value=""><?php echo $sel; ?></option>
                                                <option value="Free sample">
                                                    <?php echo $free_sample; ?></option>
                                                <option value="Buyer pays shipping fee">
                                                    <?php echo $buyer_pay; ?></option>
                                                <option value="Seller pays shipping fee">
                                                    <?php echo $seller_pay_shipping; ?></option>
                                                <option value="Buyer pays sample fee">
                                                    <?php echo $buyers_pay_sample; ?></option>
                                                <option value="Seller pays sample fee">
                                                    <?php echo $seller_pay_sample; ?></option>
                                                <option value="Buyer pays both shipping and sample fee">
                                                    <?php echo $buyers_both; ?></option>
                                                <option value="Seller pays both shipping and sample fee">
                                                    <?php echo $seller_both; ?></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <input name="Submit_form_send" type="submit" class="search_bg" id="Submit_form_send"
                                    value="<?php echo $submit; ?>" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <?php include("includes/innerside2.php"); ?>

        </div>
    </div>
</div>


</div>

<?php include("includes/footer.php"); ?>