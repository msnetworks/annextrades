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

$insert_qry="INSERT INTO registration (firstname,lastname,email,password,country,state,usertype,newsletter_option,ip_address,added_date,userstatus,lang_status,memberid) VALUES ('$firstname','$lastname','$email','$pass','$country','$state','$user_type','$newsletter1','$ip',NOW(),'1','$lang_status','Free')"; 
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
.error {
    color: #FF0000;
    font-size: 11px;
    font-weight: bold;
}

.success {
    color: #33CC00;
    font-size: 11px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
function validate1_form() {
    var fname = document.getElementById('fname').value;
    if (fname == "") {
        alert("Enter The Firstname");
        document.getElementById('fname').focus();
        return false;
    }
    var lname = document.getElementById('lname').value;
    if (lname == "") {
        alert("Enter The Lastname");
        document.getElementById('lname').focus();
        return false;
    }
    var email = document.getElementById('email').value;
    if (email == "") {
        alert("Enter The Email");
        document.getElementById('email').focus();
        return false;
    } else {
        var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (re.test(document.getElementById('email').value) == false) {
            alert("Enter the Valid Email Address");
            document.getElementById('email').focus();
            //document.register.email.value = "";
            return false;
        }

    }
    var pass = document.getElementById('pass').value;
    if (pass == "") {
        alert("Enter The Password");
        document.getElementById('pass').focus();
        return false;
    }
    var pass = document.getElementById('pass').value;
    var cpass = document.getElementById('cpass').value;
    if (pass != cpass) {
        alert("Enter The same password");
        document.getElementById('cpass').focus();
        return false;
    }
    var country1 = document.getElementById('country1').value;
    //var country = document.getElementById('country').value;
    //alert(country1);
    if (country1 == "") {
        alert("Enter The Country");
        document.getElementById('country1').focus();
        return false;
    }
    var state = document.getElementById('state').value;
    if (state == "") {
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
    if (document.register1_form.terms.checked == "") {
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
function checkUserName(usercheck) {
    //alert("hai");
    $('#usercheck').html('<img src="images/ajax-loader.gif" />');
    $.post("checkuser.php", {
        user_name: usercheck
    }, function(data) {
        if (data != '' || data != undefined || data != null) {
            $('#usercheck').html(data);
        }
    });
}
</script>
<script type="text/javascript">
function popUp1(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id +
        "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=500,left = 150,top = 134');"
    );
}
</script>

<div class="body-cont">

    <div class="body-cont1">
        <div class="register-cont">
            <form name="register1_form" action="" method="post" onSubmit="return validate1_form();">
                <div class="entry__form">
                  <h5>Register</h5>
                    <?php if(isset($_REQUEST['err'])) { ?>
                    <div class="error"><?php echo $email_aready; ?></div>
                    <?php } ?>
                    <div class="input-group">
                        <input type="text" name="fname" id="fname" class="txtfield2" placeholder="FIRST NAME *" />
                    </div>
                    <div class="input-group">
                        <input type="text" name="lname" id="lname" class="txtfield2" placeholder="LAST NAME *" />
                    </div>
                    <div class="input-group">
                        <input type="text" name="email" id="email" class="txtfield2" placeholder="EMAIL *"
                            onblur="checkUserName(this.value)" /><br /><span id="usercheck"></span>
                    </div>
                    <div class="input-group">
                        <input type="password" name="pass" id="pass" class="txtfield2" placeholder="PASSWORD *" />
                    </div>
                    <div class="input-group">
                        <input type="password" name="cpass" id="cpass" class="txtfield2"
                            placeholder="CONFIRM PASSWORD *" />
                    </div>
                    <div class="input-group">
                        <select name="country1" id="country1" class="listbox2">
                            <option value="">COUNTRY</option>
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
                            <option value="<?php echo $fet_country['country_id']; ?>">
                                <?php echo $fet_country['country_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" name="state" id="state" class="txtfield2" placeholder="STATE *" />
                    </div>
                    <div class="input-group member__type">
                        <strong>MEMBER TYPE *</strong>
                        <label><input type="radio" name="user_type" id="user_type" value="1" checked="checked" />
                            <?php echo $buyer; ?></label>
                        <label>
                            <input type="radio" name="user_type" value="2" />
                            <?php echo $seller; ?>
                        </label>
                        <label>
                            <input type="radio" id="user_type" name="user_type" value="3" />
                            Both
                        </label>
                    </div>
                    <div class="input-group">
                        <label>
                            <input type="checkbox" name="terms" id="terms" /> I agree to all
                            annexisbusinessdirectory.com <a href="terms.php" target="_blank">terms & condition</a> and
                            <a href="privacy_policy.php" target="_blank">privacy policy</a>
                        </label>
                    </div>
                    <div class="input-group">
                        <label>
                            <input type="checkbox" name="newsletter" id="newsletter" value="yes" />
                            Please include me to receive newsletter and Directory Mangzine subscription.
                        </label>
                    </div>
                    <div class="input-group">
                        <input type="submit" name="button" id="button" value="Create Account" class="themeBtn" />
                    </div>
                </div>
            </form>
        </div>


        <div class="entry__right">
            <h5><?php echo $alredy_account; ?>?</h5>
            <div class="d-flex">
                <a href="login.php" class="themeBtn btn-sm">Sign In</a>
                <a href="forgot.php"><?php echo $forgot; ?>?</a>
            </div>
            <div class="how__benefits">
                <h2>ANNEXIS Business Directory Benefits</h2>
                <ul>
                    <li>
                        <div class="benefit__box">
                            <figure><img src="images/icon-1.png" alt=""></figure>
                            <div>
                                <h4>Long Term Partnerships </h4>
                                <p>ANNEXIS Business Directory provides the platform for consumers and suppliers to be
                                    introduced and forge long term partnerships; assisting thousands of companies in
                                    finding
                                    reliable, cost conscious and valuable business solutions. </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="benefit__box">
                            <figure><img src="images/icon-2.png" alt=""></figure>
                            <div>
                                <h4>Variety of Products & Services </h4>
                                <p>One spot to access manufacturers, OEMs, exporters, suppliers, wholesalers, retailers,
                                    and
                                    service providers. Also gain access to pertinent info to assist in your decision
                                    making
                                    during your expansion search, such as details on supplier experience and reputation,
                                    customer reviews and proper vetting of government registration.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="benefit__box">
                            <figure><img src="images/icon-3.jpg" alt=""></figure>
                            <div>
                                <h4>Direct Communication </h4>
                                <p>Many platforms restrict direct communication between supplier and service providers.
                                    We
                                    promote healthy relationship building and provide the technology to reach your
                                    interest
                                    via email or direct calling.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- <div class="points-cont">
            <div class="points-bg">
                <div class="points-bg2">
                    <table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="173" align="left" valign="top">
                            </td>
                            <td width="164" rowspan="2" align="right" valign="middle"> | <a
                                    href="help.php">< ?php echo $help; ?></a> </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> -->


    </div>
</div>


</div>

<?php include("includes/footer.php"); ?>
