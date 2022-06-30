<?php 
session_start();


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
$refurl = isset($_POST['refurl']) ? base64_decode($_POST['refurl']) : '';
if(!empty($refurl)){
header("Location: $refurl");
}
else{
    header("Location: index.php");
}
}
else
{
header("location:login.php?aerr");
} 

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

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <style>
        html, body {
            margin: 0;
            font-family: 'Montserrat';
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f8fafc;
        }
        .wrapper, body, html {
        min-height: 100%;
        }
        .bg-image {
            background-position: center center;
            background: linear-gradient(60deg, rgba(158, 189, 19, 0.12), rgba(0, 133, 82, 0.61)), url(images/bg-business.jpg) center no-repeat;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

            height: 100%; 
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            align-content: center;
            flex-direction: row;
            text-align: center;
        }
        @media (min-width: 768px){
        .d-md-flex {
            display: flex!important;
            }
        .d-none {
        /* display: none!important; */
            }
        }
        @media (min-width: 768px){
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            }
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        
        .login-form-1{
            text-align: center;
            
            padding: 6.5% 5%;
            /* box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19); */
        }
        .login-form-1 h3{
            text-align: center;
            color: #333;
        }
        .login-form-1 img{
            width:  10%;
            padding-bottom: 20px;
        }
        .login-container form{
            padding: 5% 15% 15% 15%;
        }
        .btnSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            border: none;
            cursor: pointer;
            outline: none;
        }
        .login-form-1 .btnSubmit{
            font-weight: 600;
            color: #fff;
            background-color: #0062cc;
        }
        .login-form-1 .ForgetPwd{
            color: #0062cc;
            font-weight: 600;
            text-decoration: none;
        }

        </style> -->
        <style>
                        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: 0.75rem;
            }

            .login,
            .image {
            min-height: 100vh;
            }

            .bg-image {
            background-image: url('https://source.unsplash.com/WEQbe2jBg40/600x1200');
            background-size: cover;
            background-position: center;
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
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image mx-auto">
                <img style="padding: 15px; width: 50%;" src="images/logo.png" alt="" />
                <h3 class="text-light" >your bridge to business expension and increase market share.</h3> 
            </div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto">
                                    <h3 class="login-heading mb-4">Welcome back!</h3>
                                    <form>
                                        <div class="form-label-group">
                                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                            <label for="inputEmail">Email address</label>
                                        </div>

                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                            <label for="inputPassword">Password</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                                        </div>
                                        <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                                        <div class="text-center">
                                            <a class="small" href="#">Forgot password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container-fluid login-container">
            <div class="row">
                <div class="col-md-6 d-none d-md-flex bg-image justify-content-center">
                    <img class="imgg" src="images/logo.png" alt="">
                    <h3 class="text-light" >your bridge to US expension</h3>
                </div>
                <div class="col-md-6 login-form-1">
                    <center><img src="images/annexis-emblem.png" alt=""></center>
                    <h3>Welcome! Please fill login Info</h3>
                    <?php if(isset($_REQUEST['scc'])) { ?>
                        <div class="error" style="color: green">
                            <h4>Login Success..!!</h4>
                        </div>
                        <?php } ?>
                        <?php if(isset($_REQUEST['succ'])) { ?>
                        <div class="error"><?php echo $confirmation_msg; ?>
                        </div>
                        <?php } ?>
                        <?php if(isset($_REQUEST['error'])) { ?>
                        <div class="error" style="color: red;"><h4>Invalid Email or Password..!!</h4><div>
                        <?php } ?>

                        <?php if(isset($_REQUEST['aerr'])) { ?>

                        <div class="error" style="color: red;"><?php echo $activate_error_msg; ?>
                        </div>
                    <?php } ?>
                    <form class="text-left" name="login_form" method="post" onsubmit="return validate();">
                        <div class="form-group">
                            <h5><b>Email *</b></h5>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Your Email *" /><br>
                        </div>
                        <div class="form-group">
                            <h5><b>Password *</b></h5>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Your Password *" />
                            <!--input type="hidden" name="refurl" value="< ?php echo base64_encode($_SERVER['HTTP_REFERER']); ?>" /--><br>
                        </div>
                        <div class="form-group">
                            <center><input type="submit" class="btnSubmit w-100" name="button" id="button" value="Login" /></center><br>
                        </div>
                        <div class="form-group">
                            <table class="w-100">
                                <tr>
                                    <td class="w-50 text-left">
                                        <a href="forgot.php" class="ForgetPwd pull-left" value="Login">Forget Password?</a>
                                    </td>
                                    <td class="w-50 text-right">
                                        <a href="register.php" class="ForgetPwd pull-right" value="Login">Join New</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form> 
                </div>
            </div>
        </div> -->
    </body>
</html>
