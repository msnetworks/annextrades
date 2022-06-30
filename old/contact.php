<?php 
	include("includes/header.php");
	include("includes/pagination.php");
	
	if(isset($_REQUEST['send']))
	{
		$name=$_REQUEST['name'];
		$membership_type=$_REQUEST['membership_type'];
		$email=$_REQUEST['email'];
		$subject=$_REQUEST['subject'];
		$message=$_REQUEST['message'];
		$entrydate=date('Y-m-d');
		$con_ip=$_SERVER['REMOTE_ADDR'];
		
		if(!(empty($session_user)))
		{
		 include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_REQUEST['reg_answer']);

  if($valid == true) {
		
			$memberid=$session_user;
			$qry_tmp=mysqli_query($con,"SELECT * FROM registration WHERE id='$memberid'") or die("Select registration error ".mysqli_error($con));
				$membdetail=mysqli_fetch_array($qry_tmp);
				
					$insert=mysqli_query($con,"insert into feedback (yourname, memberid, membertype, email, subject, message, entrydate) values ('$name', '$memberid', '$membership_type', '$email', '$subject', '$message', '$entrydate')") or die("Feed back insert error ".mysqli_error($con));
		
		$ip = $_SERVER['REMOTE_ADDR'];			
		
		$Subject="$subject";
		$mail_url = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]) ;
		
		
		$SendMessage = "<table width='450' border='0' cellpadding='0' cellspacing='0' style='border:solid 10px #25ABC4;'>
		<tr bgcolor='#FFFFFF' height='25'>
    		<td><img src='$mail_url/images/$site_logo'  width='169' height='48' border='0' /></td>
  		</tr>
		<tr bgcolor='#FFFFFF' height='30'>
    		<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Hi $name,</b></td>
  		</tr>
		<tr>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; width:100px; color:#000000;'>Name</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; color:#000000;'>$name </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; width:100px; color:#000000;'>Memberid</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:20px; text-decoration:none; color:#000000;'>$memberid </td>
		</tr>	
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Membership type</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$membership_type </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Email</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$email </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Subject</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$subject </td>
		</tr>
		<tr bgcolor='#FFFFFF' height='35'>  
    	<td style='padding-left:80px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; width:100px; color:#000000;'>Message</td>
		<td style='padding-left:5px; font-family:Arial; font-size:11px; line-height:15px; text-decoration:none; color:#000000;'>$message </td>
		</tr>
		<tr bgcolor='#FFFFFF'>
    	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
      ".$webname."<br>
    	</td>
 		</tr>
		 <tr height='40'>
    	 <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size:10px;
color:#000000;'>&copy; Copyright " .date("Y")."&nbsp;". $webname."</td>
         </tr>	
		</table>";
		
		
		ini_set("SMTP","mail.inetmassmail.com");
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From:'.$mailurl."\n";
		
		include ("mailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "mail.inetmassmail.com"; // SMTP server
		$mail->SMTPAuth = true;
		$mail->Username = "info@inetmassmail.com";
		$mail->Password = "inetsol";
	
		$mail->From = "$email <".$email.">";
		$mail->FromName = $name;
		$mail->AddAddress($mailurl);
		$mail->AddReplyTo($email);
		$mail->AddCustomHeader('Return-path:'.$email);
		$mail->Sender = $email;
		$mail->Subject =$Subject;
		$mail->Body = $SendMessage;
		$mail->WordWrap = 50;
		$mail->Send(); 
		
		/*echo $mailurl;
		echo $email;
		echo $name;
		echo $Subject;
		echo $SendMessage; exit;*/
		
		/*$rsmail=mail($to,$Subject,$SendMessage,$headers);
		echo $to;
		echo $Subject;
		echo $SendMessage;
		echo $headers; exit;
		if($rsmail)
		{	
			//echo "huhuih";
			header("Location:send_contact.php?succ");
		}*/
		
		header("Location:send_contact.php");
		unset($_SESSION['tmp_name']);
		unset($_SESSION['tmp_membership_type']);
		unset($_SESSION['tmp_email']);
		unset($_SESSION['tmp_subject']);
		unset($_SESSION['tmp_message']);
		
			}
			else
			{
			  $_SESSION['tmp_name']=$name;
		      $_SESSION['tmp_membership_type']=$membership_type;
		      $_SESSION['tmp_email']=$email;
		      $_SESSION['tmp_subject']=$subject;
		      $_SESSION['tmp_message']=$message;
			  header("Location:contact.php?cap_err");
			}
			
		
			
		}
				else
				{
					header("Location:contact.php?error1");
				}
		}
?>
<div class="body-cont">

    <div class="body-cont1">
		<div class="body-leftcont">
			<?php include("includes/help_side_menu.php"); ?>
		</div>        
        <div class="body-right">

            <?php include("includes/menu.php"); ?>

            <script type="text/javascript">
            function validate(doc) {
                if (document.contact.name.value == "") {
                    alert("Please enter Your name");
                    document.contact.name.focus();
                    return false;
                }

                if (document.contact.email.value == "") {
                    alert("Please enter the Email");
                    document.contact.email.focus();
                    return false;
                }
                if (echeck(document.contact.email.value) == false) {

                    document.contact.email.focus();
                    return false;
                }
                if (document.contact.subject.value == "") {
                    alert("Please enter the subject ");
                    document.contact.subject.focus();
                    return false;
                }

                if (document.contact.message.value == "") {
                    alert("Please enter the Message");
                    document.contact.message.focus();
                    return false;
                }

                if (document.contact.reg_answer.value == "") {
                    alert("Please enter the security code");
                    document.contact.reg_answer.focus();
                    return false;
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
            </script>

            <div class="tabs-cont" style="margin-top:0">
                <div class="left">
                    <div class="p-2" style="padding-top:0">
                        <div class="products-cate-heading"><h5><?php echo $contactus; ?></h5>
                        </div>
                        <div style="width:700px;">
                            <!--<div style="color:#C55000; margin-left:50px; margin-top:15px; float:left; width:450px;" align="left"><b style="font-size:14px;"><?php echo $email_us; ?></b></div>-->
                            <div class="input-group"><span
                                    style="color:#FF0000">*</span>&nbsp;<?php echo $required_info; ?></div>
                        </div>
                        <div class="">
                            <form name="contact" method="post" action="contact.php" onsubmit="return validate(this);">
                                <?php if(isset($_REQUEST['error'])) { ?>                                
                                    <div class="input-group">
                                        <font color="#FF0000">You are not
                                            <?php echo $_REQUEST['error']; ?>, <?php echo $contact_err; ?>.</font>
                                    </div>                                                                
                                <?php } ?>
                                <?php if(isset($_REQUEST['cap_err'])) { ?>
                                
                                    <div class="input-group">
                                        <font color="#FF0000">Captcha error, Try
                                            Again!!!</font>
                                    </div>
                                                                
                                <?php } ?>

                                <?php if(isset($_REQUEST['error1'])) { ?>
                                
                                    <div class="input-group">
                                        <font color="#FF0000">
                                            <?php echo $con_login_err; ?>.</font>
                                    </div>
                                
                                
                                <?php } ?>
                                <div class="input-group">
                                    <h6><span style="color:#FF0000;">*</span>&nbsp;<?php echo $name; ?></h6>                                    
                                    <input type="text" name="name"
                                            value="<?php if(isset($_SESSION['tmp_name'])) { echo  $_SESSION['tmp_name']; } ?>"/>
                                </div>
                                <div class="input-group">
                                    <h6><span
                                                style="color:#FF0000;">*</span>&nbsp;<?php echo $memeber_type; ?></h6>
                                    <select name="membership_type" id="membership_type"
                                            >
                                            <option value=""><?php echo $sel_member_type; ?></option>
                                            <option value="GoldSupplier"><?php echo $gole_member; ?></option>
                                            <option value="SilverSupplier"><?php echo $silver_member; ?></option>
                                            <option value="bronzeSupplier"><?php echo $bronze_member; ?></option>
                                            <option value="free"><?php echo $free_member; ?></option>
                                        </select>
                                </div>
                                <div class="input-group">
                                    <h6><span
                                                style="color:#FF0000;">*</span>&nbsp;<?php echo $email; ?></h6>
                                    <input type="text" name="email"
                                            value="<?php if(isset($_SESSION['tmp_email'])) { echo  $_SESSION['tmp_email']; } ?>"
                                             />
                                </div>
                                <div class="input-group">
                                    <h6><span
                                                style="color:#FF0000;">*</span>&nbsp;<?php echo $subject; ?></h6>
                                    <input type="text" name="subject"
                                            value="<?php if(isset($_SESSION['tmp_subject'])) { echo  $_SESSION['tmp_subject']; } ?>"
                                             />
                                </div>
                                <div class="input-group">
                                    <h6><span
                                                style="color:#FF0000;">*</span>&nbsp;<?php echo $message; ?></h6>
                                    <textarea name="message" rows="3"
                                            cols="29"><?php if(isset($_SESSION['tmp_message'])) { echo  $_SESSION['tmp_message']; } ?></textarea>
                                    
                                </div>


                                <div class="input-group">
                                    <h6><?php echo $code; ?></h6>
                                    

                                        <div>
                                            <div style="float:left; ">
                                                <img id="siimage" align="left" style="padding-right: 5px; border: 0"
                                                    src="securimage_show.php?sid=<?php echo md5(time()) ?>" /></div>
                                            <div style="float:left;">
                                                <div>
                                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                                                        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0"
                                                        width="19" height="19" id="SecurImage_as3" align="middle">
                                                        <param name="allowScriptAccess" value="sameDomain" />
                                                        <param name="allowFullScreen" value="false" />
                                                        <param name="movie"
                                                            value="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" />
                                                        <param name="quality" value="high" />

                                                        <param name="bgcolor" value="#ffffff" />
                                                        <embed
                                                            src="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5"
                                                            quality="high" bgcolor="#ffffff" width="19" height="19"
                                                            name="SecurImage_as3" align="middle"
                                                            allowScriptAccess="sameDomain" allowFullScreen="false"
                                                            type="application/x-shockwave-flash"
                                                            pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                                    </object>
                                                </div>
                                                <div>

                                                    <!-- pass a session id to the query string of the script to prevent ie caching -->
                                                    <a tabindex="-1" style="border-style: none" href="#"
                                                        title="Refresh Image"
                                                        onClick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img
                                                            src="images/refresh.gif" alt="Reload Image" border="0"
                                                            onClick="this.blur()" align="bottom" /></a>
                                                </div>
                                            </div>

                                        </div>

                                </div>

                                <div class="input-group">

                                    <h6><span style="color:#FF0000;">*</span><?php echo $enter_code; ?></h6>
                                    <input name="reg_answer" id="reg_answer" type="text"
                                            autocomplete="OFF" />

                                </div>

                                <div class="input-group">
                                    <input type="submit" name="send"
                                            value="<?php echo $submit; ?>" class="themeBtn"
                                            style="margin-top:20px; margin-bottom:20px;" />&nbsp;&nbsp;&nbsp;<input
                                            type="submit" value="<?php echo $reset; ?>" class="themeBtn"
                                            style="margin-top:20px; margin-bottom:20px;" />
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="body-cont4">

        </div>

    </div>


</div>


</div>

<?php include("includes/footer.php"); ?>