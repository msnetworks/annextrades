<?php 
session_start();
include("includes/header.php");

$active_id=$_REQUEST['acc_id'];
$pro_id = $_REQUEST['id'];

if($active_id!="")
{
$update_qry="UPDATE registration SET userstatus=0 WHERE id='$active_id'";
$res_qry=mysqli_query($con,$update_qry);
header("location:login.php?scc");

}

if((isset($_POST['button'])) || (isset($_REQUEST['dlogin'])))
{
if(isset($_REQUEST['dlogin']))
{
$email=base64_decode($_REQUEST['username']);
$pass=base64_decode($_REQUEST['password']);
}
else {
$email=$_POST['email'];
$pass=$_POST['pass'];
}
if($_SESSION['language']=='english')
{
$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' AND lang_status='0' and memberstatus='0'";
}
else if($_SESSION['language']=='french')
{
$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' AND lang_status='1' and memberstatus='0'";
}
else if($_SESSION['language']=='chinese')
{
$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' AND lang_status='2' and memberstatus='0'";
}
else 
{
$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' AND lang_status='3' and memberstatus='0'";
}

$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' and memberstatus='0'";
//echo "SELECT * FROM registration WHERE email='$email' AND password='$pass'";  exit;

$res_login=mysqli_query($con,$select_login);
$num_login=mysqli_num_rows($res_login);
if($num_login>0)
{
$fetch_login=mysqli_fetch_array($res_login);
$email=$fetch_login['email'];
$pass=$fetch_login['password'];
$user_id=$fetch_login['id']; 
$status=$fetch_login['userstatus']; 

if($status=="0"){

$_SESSION['user_login']=$user_id;
$session_user=$_SESSION['user_login'];
header("Location: proaction1.php?id=$pro_id");

}
else
{
header("location:login-page.php?aerr");
} 

}
else
{
header("location:login-page.php?error");
}
}

 ?>
<script type="text/javascript">
function validate() {
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
    var b = document.getElementById('pass').value;
    if (b == "") {

        alert("Enter the Password");
        document.getElementById('pass').focus();
        return false;
    }

}
</script>

<div class="body-cont">

    <div class="body-cont1">

        <div class="signin-cont">
            <div class="signin-bg">

                <figure>
                    <img src="images/logo.png" alt="">
                </figure>
                <form name="login_form" method="post" onsubmit="return validate();">

                    <div class="entry__form">
                        <h5>Sign In</h5>


                        <?php if(isset($_REQUEST['scc'])) { ?>

                        <div class="error" style="color: green">
                            <?php echo $activated_success_msg; ?>
                        </div>
                        <?php } ?>

                        <?php if(isset($_REQUEST['succ'])) { ?>

                        <div class="error"><?php echo $confirmation_msg; ?>
                        </div>
                        <?php } ?>


                        <?php if(isset($_REQUEST['error'])) { ?>

                        <div class="error" style="color: red;"><?php echo $invalid_login; ?><div>
                                <?php } ?>

                                <?php if(isset($_REQUEST['aerr'])) { ?>

                                <div class="error" style="color: red;"><?php echo $activate_error_msg; ?>
                                </div>
                                <?php } ?>

                                <div class="input-group">
                                    <input type="text" name="email" id="email" class="txtfield2" placeholder="Email" />
                                </div>

                                <div class="input-group">
                                    <input type="password" name="pass" id="pass" class="txtfield2"
                                        placeholder="Password" />
                                </div>
                                <input type="hidden" name="refurl" value="<?php echo base64_encode($_SERVER['HTTP_REFERER']); ?>" />


                                <div class="input-group d-flex justify-between">
                                    <input type="submit" name="button" id="button" value="Sign In" class="themeBtn" />
                                    <a href="forgot.php"><?php echo $forgot; ?>?</a>
                                </div>

                                <div class="input-group" style="padding-top: 20px;">
                                    <div class="float-right">
                                        Not a member? &nbsp; &nbsp; <a href="register.php" class="themeBtn btn-sm">Register</a>
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>

<?php include("includes/footer.php"); ?>