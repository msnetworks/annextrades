<?php 
include("includes/header.php"); 
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['button']))
{
$firstname=mysqli_real_escape_string($con, $_POST['fname']); 
$lastname=mysqli_real_escape_string($con, $_POST['lname']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$pass=mysqli_real_escape_string($con, $_POST['pass']); 
$country=mysqli_real_escape_string($con, $_POST['country1']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$user_type=mysqli_real_escape_string($con, $_POST['user_type']);
$newsletter=mysqli_real_escape_string($con, $_POST['newsletter']);
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
if($newsletter!="")
{
$newsletter1=0;

}
else
{
$newsletter1=1;
}
 $select_user="SELECT * FROM registration WHERE email='$email' "; 
$res_user=mysqli_query($con,$select_user);
$fetch_user=mysqli_fetch_array($res_user);
$email_address=$fetch_user['email'];
if($email_address=="")
{
//echo "INSERT INTO registration (firstname,lastname,email,password,country,state,usertype,newsletter_option,ip_address,added_date,userstatus) VALUES ('$firstname','$lastname','$email','$pass','$country','$state','$user_type','$newsletter1','$ip',NOW(),'1')"; exit;

$insert_qry="INSERT INTO registration (firstname,lastname,email,password,country,state,usertype,newsletter_option,ip_address,added_date,userstatus,lang_status) VALUES ('$firstname','$lastname','$email','$pass','$country','$state','$user_type','$newsletter1','$ip',NOW(),'1','$lang_status')"; 
$res_qry=mysqli_query($con,$insert_qry) or die("insert error");

$email_en=base64_encode($email);

header("location:register1.php?em=$email_en");

}
else
{
header("location:register.php?err");

}

}

?>
<style type="text/css">
.error{
	color: #FF0000;
	font-size:11px;
	font-weight:bold;
}
.success{
	color: #33CC00; 
	font-size:11px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
function validate1_form()
{
var fname=document.getElementById('fname').value;
if(fname=="")
{
alert("Enter The Firstname");
document.getElementById('fname').focus();
return false;
}
var lname=document.getElementById('lname').value;
if(lname=="")
{
alert("Enter The Lastname");
document.getElementById('lname').focus();
return false;
}
var email = document.getElementById('email').value;
if(email=="")
{
alert("Enter The Email");
document.getElementById('email').focus();
return false;
}
else
{
var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.getElementById('email').value)==false)
	{
	alert("Enter the Valid Email Address");
	document.getElementById('email').focus();
	//document.register.email.value = "";
	return false;
	}

}
var pass = document.getElementById('pass').value;
if(pass=="")
{
alert("Enter The Password");
document.getElementById('pass').focus();
return false;
}
var pass = document.getElementById('pass').value;
var cpass=document.getElementById('cpass').value;
if(pass!=cpass)
{
alert("Enter The same password");
document.getElementById('cpass').focus();
return false;
}
var country1 = document.getElementById('country1').value;
//var country = document.getElementById('country').value;
//alert(country1);
if(country1=="")
{
alert("Enter The Country");
document.getElementById('country1').focus();
return false;
}
var state = document.getElementById('state').value;
if(state=="")
{
alert("Enter The State");
document.getElementById('state').focus();
return false;
}
/*if(document.getElementById('user_type').value=="")
    {
    alert("Please select any one option buyer or seller or both");
	document.getElementById('user_type').focus();
	return false;
   }*/
if(document.register1_form.terms.checked=="")
    {
    alert("Please Select The Terms and Conditions");
	document.register1_form.terms.focus();
	return false;
   }
   

/*else
	{
	var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.register1_form.email.value)==false)
	{
	alert("Enter the Valid Email Address");
	document.register1_form.email.focus();
	//document.register.email.value = "";
	return false;
	}
	}*/



return true;
}



<!-- http://www.itechroom.com-->
function checkUserName(usercheck)
{
//alert("hai");
	$('#usercheck').html('<img src="images/ajax-loader.gif" />');
	$.post("checkuser.php", {user_name: usercheck} , function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {				   
				  $('#usercheck').html(data);	
			   }
          });
}
</script>
<script type="text/javascript">

function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=500,left = 150,top = 134');");
}

</script>

<div class="body-cont"> 

<div class="body-cont1"> 

<div class="register-cont"> 

<div class="register-top"><span class="point-heading" style="font-size:18px;"><?php echo $header; ?></span> <br/>  <span class="point-heading"><?php echo $free; ?>!</span></div>
<div class="register-bg">
<form name="register1_form" action="" method="post" onSubmit="return validate1_form();" >
  <table width="455" border="0" cellspacing="0" cellpadding="0">
   <tr><td>&nbsp;</td></tr><?php if(isset($_REQUEST['err'])) { ?>
   
   <tr><td>&nbsp;</td><td class="error"><?php echo $email_aready; ?></td></tr>
   <?php } ?>
	
	 <tr>
      <td align="left" valign="top"><?php echo $fname; ?> : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="fname" id="fname" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top"><?php echo $lname; ?> : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="lname" id="lname" class="txtfield2" /></td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $email; ?>  : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="email" id="email" class="txtfield2" onblur="checkUserName(this.value)" /><br /><span id="usercheck"  ></span></td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $pass; ?>:  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="password" name="pass" id="pass" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top"><?php echo $con_pass; ?> : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="password" name="cpass" id="cpass" class="txtfield2" /></td>
    </tr>
	
    <tr>
      <td align="left" valign="top"><?php echo $country;?> :  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><select name="country1" id="country1" class="listbox2">
        <option value="">---------- <?php echo $sel_con; ?> ----------</option>
		<?php 
		if($_SESSION['language']=='english')
		{
		$select_country="SELECT * FROM country";
		}
		else if($_SESSION['language']=='french')
		{
		$select_country="SELECT * FROM country_french";
		}
		else if($_SESSION['language']=='chinese')
		{
		$select_country="SELECT * FROM country_chinese";
		}
		else 
		{
		$select_country="SELECT * FROM country_spanish";
		}
		//$select_country="SELECT * FROM country";
		$res_country=mysqli_query($con,$select_country);
		while($fet_country=mysqli_fetch_array($res_country))
		{
		?>
		<option value="<?php echo $fet_country['country_id']; ?>"><?php echo $fet_country['country_name']; ?></option>
		<?php } ?>
      </select>      </td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $state;?> : <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="state" id="state" class="txtfield2" /></td>
    </tr>
	<tr>
      <td align="left" valign="top"><?php echo $user_type; ?> : <span class="mandory">*</span> </td>
      <td  valign="top"><input type="radio" name="user_type" id="user_type" value="1" checked="checked"/> <?php echo $buyer; ?> &nbsp; <input type="radio" name="user_type" value="2"/> <?php echo $seller; ?> &nbsp; <input type="radio" id="user_type" name="user_type" value="3"/> <?php echo $buyer_seller; ?></td>
    </tr>
	
    <!--<tr>
      <td align="left" valign="top">Telephone:  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield4" id="textfield4" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">Mobile / Cell Phone:  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield5" id="textfield5" class="txtfield2" /></td>
    </tr>
    
    <tr>
      <td align="left" valign="top">Type the code shown<br />
below :  <span class="mandory">*</span> </td>
      <td align="right" valign="top"><input type="text" name="textfield8" id="textfield8" class="txtfield2" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><img src="images/captcha.jpg" alt="" width="175" height="49" /></td>
    </tr>-->
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
      <td align="left" valign="top">&nbsp; </td>
      <td align="right" valign="top"><input type="checkbox" name="newsletter" id="newsletter" value="yes"/> <?php echo $newsletter; ?></td>
    </tr>
	
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><input type="checkbox" name="terms" id="terms" /></td>
		  <td align="left" valign="top"> &nbsp; <?php echo $agree; ?> <a href="javascript:popUp1('terms.php')" class="topics"><?php echo $terms_use; ?></a> <?php echo $stated; ?>. <br/> <br/></td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="bottom"><img src="images/spe4.jpg" alt="" width="455" height="1" /></td>
      </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="" class="create-acc" /></td>
      </tr>
	 
  </table>
  </form>
</div>
<div class="register-bot"> </div>

</div>



<div class="points-cont"> 
<div class="points-top"> </div>
<div class="points-bg"> <span class="point-heading"><?php echo $why_lower; ?> ? </span> 
<ul> 
<li><?php echo $instant; ?>!</li>
<li><?php echo $showcase; ?>!</li>
<li><?php echo $post_com; ?></li>
<li><?php echo $advertise_business; ?>! </li>
</ul>
<div class="points-bg2">
  <table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="173" align="left" valign="top"><strong><?php echo $alredy_account; ?>?</strong></td>
      <td width="164" rowspan="2" align="right" valign="middle"><a href="forgot.php"><?php echo $forgot; ?>?</a> | <a href="help.php"><?php echo $help; ?></a> </td>
    </tr>
    <tr>
      <td align="left" valign="top"><a href="login.php"><img src="images/signin.png" alt="" width="154" height="35" /></a></td>
    </tr>
  </table>
</div>
</div>
<div class="points-bot"> </div>

</div>


</div>
</div>


</div>

<?php include("includes/footer.php"); ?>
