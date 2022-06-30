<?php 
session_start();
if($_SESSION['user_login'] == ""){

include("db-connect/notfound.php");

$active_id=$_REQUEST['acc_id'];

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
$select_login="SELECT * FROM registration WHERE email='$email' AND password='$pass' and memberstatus='0'";

$res_login=mysqli_query($con,$select_login);
$num_login=mysqli_num_rows($res_login);
$fetch_login=mysqli_fetch_array($res_login);
$email=$fetch_login['email'];
$pass=$fetch_login['password'];
$user_id=$fetch_login['id']; 
$status=$fetch_login['userstatus']; 
$email_verify=$fetch_login['email_verify'];
$payment = $fetch_login['payment'];
$package = $fetch_login['package'];
$vendor_id = $fetch_login['vendor_id'];

    if($num_login>0)
    {
        $ckpro = $con->query("SELECT userid FROM product WHERE userid = '$user_id'");
        
        if($email_verify == "Verified"){
            if($status=="0"){
            if ($fetch_login['usertype'] == 'Buyer') {
                $_SESSION['user_login']=$user_id;
                $_SESSION['email']=$email;
                $session_user=$_SESSION['user_login'];
                if (@$_GET['source']=='publish') {
                    header("Location: add_company.php");
                }else{
                    header("location:/");
                }
            }
            else{
            if(mysqli_num_rows($ckpro) > 0){
            /* if ($payment == 'Yes') { */
                $_SESSION['user_login']=$user_id;
                $_SESSION['email']=$email;
                $session_user=$_SESSION['user_login'];
                if (@$_GET['source']=='publish') {
                    header("Location: add_company.php");
                }else{
                    header("location:/");
                }
                /* if ($row['expiry_date'] >= date('Y-m-d H:i:s')) { 
                 }
                else{
                    header("location: mydashboard/trail_expire.php?msg=TrailExp");
                    echo "<script>'alert('Your free trail has been Expired.! \n Please payment and continue your service.')';</script>";
                    //header("location: ../../registration/?package=$package&vendor_id=$vendor_id&msg=TrailExp");
                } */
                /* }
                    else { ?>
                        <script>
                            alert('Email Verification Is Pending! \n\n Please check your Mail Inbox and verify your account!');
                        </script>
                    <?php
                    header("location: https://annexis.net/registration/?package=$package&vendor_id=$vendor_id&msg=PaymentPending");
                } */
            }else{
                header("location: https://annextrades.com/registration/?vendor_id=$vendor_id");
            }
            
        }
        }else{
               
                ?>
            <!-- <script>
                alert('Your account has been deactivated! \n\n Please make payment to restart the services. \n\n (If already make the payment please contact customer service.)');
            </script> -->
           
        <?php 
            header("location: deactivatemsg.php?vendor_id=$vendor_id");
        }
        }
        else
        { ?>
            <script>
                alert('Email Verification Is Pending. \n\n Please check your Mail Inbox and verify your account.');
            </script>
        <?php header("location: https://annextrades.com/registration/?vendor_id=$vendor_id"); } 

    }
    else
        {
            header("location:login.php?error");
        }
    }

 ?>
 <script type="text/javascript">
function validate() {
    var email = document.getElementById('email').value;
    if (email == "") {
        alert("Please Enter Email Address..!");
        document.getElementById('email').focus();
        return false;
    } else {
        var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (re.test(document.getElementById('email').value) == false) {
            alert("Enter the Valid Email Address..!");
            document.getElementById('email').focus();
            //document.register.email.value = "";
            return false;
        }
    }
    var b = document.getElementById('pass').value;
    if (b == "") {

        alert("Please Enter Password..!");
        document.getElementById('pass').focus();
        return false;
    }

}
</script>
<html>
    <head>  
        <title>Annex Trades | Login</title>
        <link rel="icon" href="assets/images/annexis-emblem.png" type="image/png">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <style>
                        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: 0.75rem;
                font-family: 'Montserrat';
            }

            .login,
            .image {
            min-height: 100vh;
            }

            .bg-image {
            background-image: url('images/bg-business.jpg');
            background-size: cover;
            background-position: center;
            align-items: flex-end;
            justify-content: flex-center;
            align-items: center;
            }

            .login-heading {
            font-weight: 300;
            }

            .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            border-radius: 2rem;
            }

            .form-label-group {
            position: relative;
            margin-bottom: 1rem;
            }

            .form-label-group>input,
            .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
            height: auto;
            border-radius: 2rem;
            }

            .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            cursor: text;
            /* Match the input under the label */
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
            }
            .imm{
                align-items: center;
            }

            .form-label-group input::-webkit-input-placeholder {
            color: transparent;
            }

            .form-label-group input:-ms-input-placeholder {
            color: transparent;
            }

            .form-label-group input::-ms-input-placeholder {
            color: transparent;
            }

            .form-label-group input::-moz-placeholder {
            color: transparent;
            }

            .form-label-group input::placeholder {
            color: transparent;
            }

            .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
            }

            .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
            }

            /* Fallback for Edge
            -------------------------------------------------- */

            @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
            }

            /* Fallback for IE
            -------------------------------------------------- */

            @media all and (-ms-high-contrast: none),
            (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
            }
            
        </style>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image ">
                <div class="row justify-content-center text-center imm">
                    <div class="col-md-12 ">
                        <p><a href="/"><img style="padding-bottom: 15px; width:60%" src="assets/images/logo-white.png" alt="" /></a></p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-light" >Your Bridge to Expansion & Increased Market Share.</p>
                    </div> 
                </div>
            </div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto">
                                    <center><a href="/"><img style="width: 10%; padding-bottom: 20px;" src="images/annexis-emblem.png" alt=""></a></center>
                                    <h3 class="login-heading mb-4 text-center">Welcome back</h3>
                                        
                                    <?php if(isset($_REQUEST['scc'])) { ?>
                                        <div class="error" style="color: green">
                                            <h4>Login Success..!!</h4>
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($_REQUEST['deactivate'])) { ?>
                                        <div class="error text-center" style="color: red">
                                            <h6>Your account has been deactivated! <br> Please make payment to restart the services. <br> (If already made the payment please contact customer services <a href="tel: 18001238632"> 1800 123 8632</a>.)</h6>
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($_REQUEST['succ'])) { ?>
                                        <div class="error text-center"><?php echo $confirmation_msg; ?>
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($_REQUEST['error'])) { ?>
                                        <div class="error text-center" style="color: red;"><h4>Invalid Email or Password..!!</h4><div>
                                        <?php } ?>
                                        <?php if(isset($_REQUEST['aerr'])) { ?>
                                        <div class="error text-center" style="color: red;"><?php echo $activate_error_msg; ?>
                                        </div>
                                        <?php } 
                                            if(isset($_REQUEST['evp'])) { ?>
                                                <div class="error text-center" style="color: red;"><h4><center>Email Verification is Pending!</center></h4><div>
                                        <?php } ?>
                                        <?php if(isset($_REQUEST['alreadyregsiter'])) { ?>
                                        <div class="error text-center" style="color: green;">
                                            <h6>This account is already registered.</h6>
                                        </div>
                                        <?php } ?>

                                    <form name="login_form" method="post" onsubmit="return validate();">
                                        <div class="form-label-group">
                                            <input type="email" id="email" name="email" class="form-control"  placeholder="Email address" required autofocus>
                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-label-group">
                                            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                                            <label for="pass">Password</label>
                                        </div>
                                        <!-- <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                                        </div> -->
                                        <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" name="button" id="button" type="submit">Sign in</button>
                                        <table class="w-100">
                                            <tr>
                                                <td class="w-50">
                                                    <div class="text-left">
                                                        <a class="small" style="font-size: 12px!important;" href="forgot/forget_password.php">Forgot Password</a>
                                                    </div>
                                                </td>   
                                                <td class="w-50">
                                                    <div class="text-right" style="font-size: 12px!important;">
                                                        Not a member <a class="small" href="https://annextrades.com/registration/" style="font-size: 12px!important;">Register Now</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php } 
    else{
        echo "<script>window.location='/';</script>";
    }

?>