<?php 
include("includes/header.php");
if(isset($_POST['submit']))
{
$current_pass=mysqli_real_escape_string($con, $_POST['current_pass']);
$pass=mysqli_real_escape_string($con, $_POST['pass']);
$re_pass=mysqli_real_escape_string($con, $_POST['cpass']);

$select_pass="SELECT * FROM registration WHERE password='$current_pass' AND id='$session_user' ";
$res_pass=mysqli_query($con,$select_pass);
 $num_pass=mysqli_num_rows($res_pass); 

if($num_pass>0)
{
$update_pass="UPDATE registration SET password='$pass' WHERE id='$session_user'"; 
$res_pass=mysqli_query($con,$update_pass);
header("location:changepass.php?succ");
}
else
{
header("location:changepass.php?error");
}

/*$udate_user=mysqli_query($con,"UPDATE registration SET usertype='$user_type', firstname='$fname',lastname='$lname',gender='$gender', phonenumber='$ph_no', mobile='$mble_no', faxnumber='$fax_no', street='$address', city='$city', state='$state', country='$country', zipcode='$zip_code',  companyname='$cmpny_name' WHERE id='$session_user'");

header("location:myprofile.php?suc");*/
}

 ?>
<script type="text/javascript">
function validate1_form() {
    var current_pass = document.getElementById('current_pass').value;
    if (current_pass == "") {
        alert("Enter The Current Password");
        document.getElementById('current_pass').focus();
        return false;
    }
    var pass = document.getElementById('pass').value;
    if (pass == "") {
        alert("Enter The Password");
        document.getElementById('pass').focus();
        return false;
    } else {
        if (pass.length < 6) {
            alert("Minimum 6 Letters ");
            document.getElementById('pass').focus();
            return false;
        }
    }
    if (current_pass == pass) {
        alert("Your Current password and New password are same so enter another password");
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
    return true;
}
</script>

<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo$change_pss_success; ?> </div>
<?php } ?>

<?php
if(isset($_REQUEST['error'])) { ?>
<div style="padding-left:300px; color: #FF0000; font-weight:bold;"> <?php echo $change_pass_err; ?> </div>
<?php } ?>



<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>



            <div class="body-right">

                <?php include("includes/menu.php") ?>

                <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
                <?php 
$user_type=$fetch_log['usertype']; 
if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
//$user_type=$fetch_log['gender']; 
//if($gender==1) { $gen="";
?>
                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                            <form action="" name="profile_form" method="post" onSubmit="return validate1_form();">

                                <div class="p-2">
                                    <div class="input-group">
                                        <h6><?php echo $current_password; ?></h6>
                                        <input type="password" name="current_pass" id="current_pass"
                                            class="txtfield2" />
                                    </div>

                                    <div class="input-group">
                                        <h6><?php echo $new_pass; ?> </h6>
                                        <input type="password" name="pass" id="pass" class="txtfield2" />
                                    </div>

                                    <div class="input-group">
                                        <h6><?php echo $re_type_pass; ?></h6>
                                        <input type="password" name="cpass" id="cpass" class="txtfield2" />
                                    </div>
                                    <div class="input-group">
                                        <input type="submit" name="submit" value="<?php echo $submit; ?>">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>