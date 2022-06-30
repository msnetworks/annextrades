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
        </style>
        <style>
            * {
                margin: 0;
                padding: 0
            }

            html {
                height: 100%
            }

            p {
                color: grey
            }

            #heading {
                text-transform: uppercase;
                color: #673AB7;
                font-weight: normal
            }

            #msform {
                text-align: center;
                position: relative;
                margin-top: 20px
            }

            #msform fieldset {
                background: white;
                border: 0 none;
                border-radius: 0.5rem;
                box-sizing: border-box;
                width: 100%;
                margin: 0;
                padding-bottom: 20px;
                position: relative
            }

            .form-card {
                text-align: left
            }

            #msform fieldset:not(:first-of-type) {
                display: none
            }

            #msform input,
            #msform textarea {
                padding: 8px 15px 8px 15px;
                border: 1px solid #ccc;
                border-radius: 0px;
                margin-bottom: 25px;
                margin-top: 2px;
                width: 100%;
                box-sizing: border-box;
                font-family: montserrat;
                color: #2C3E50;
                background-color: #ECEFF1;
                font-size: 16px;
                letter-spacing: 1px
            }

            #msform input:focus,
            #msform textarea:focus {
                -moz-box-shadow: none !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                border: 1px solid #673AB7;
                outline-width: 0
            }

            #msform .action-button {
                width: 100px;
                background: #673AB7;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 0px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 0px 10px 5px;
                float: right
            }

            #msform .action-button:hover,
            #msform .action-button:focus {
                background-color: #311B92
            }

            #msform .action-button-previous {
                width: 100px;
                background: #616161;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 0px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 5px 10px 0px;
                float: right
            }

            #msform .action-button-previous:hover,
            #msform .action-button-previous:focus {
                background-color: #000000
            }

            .card {
                z-index: 0;
                border: none;
                position: relative
            }

            .fs-title {
                font-size: 25px;
                color: #673AB7;
                margin-bottom: 15px;
                font-weight: normal;
                text-align: left
            }

            .purple-text {
                color: #673AB7;
                font-weight: normal
            }

            .steps {
                font-size: 25px;
                color: gray;
                margin-bottom: 10px;
                font-weight: normal;
                text-align: right
            }

            .fieldlabels {
                color: gray;
                text-align: left
            }

            #progressbar {
                margin-bottom: 30px;
                overflow: hidden;
                color: lightgrey
            }

            #progressbar .active {
                color: #673AB7
            }

            #progressbar li {
                list-style-type: none;
                font-size: 15px;
                width: 25%;
                float: left;
                position: relative;
                font-weight: 400
            }

            #progressbar #account:before {
                font-family: FontAwesome;
                content: "\f13e"
            }

            #progressbar #personal:before {
                font-family: FontAwesome;
                content: "\f007"
            }

            #progressbar #payment:before {
                font-family: FontAwesome;
                content: "\f030"
            }

            #progressbar #confirm:before {
                font-family: FontAwesome;
                content: "\f00c"
            }

            #progressbar li:before {
                width: 50px;
                height: 50px;
                line-height: 45px;
                display: block;
                font-size: 20px;
                color: #ffffff;
                background: lightgray;
                border-radius: 50%;
                margin: 0 auto 10px auto;
                padding: 2px
            }

            #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: lightgray;
                position: absolute;
                left: 0;
                top: 25px;
                z-index: -1
            }

            #progressbar li.active:before,
            #progressbar li.active:after {
                background: #673AB7
            }

            .progress {
                height: 20px
            }

            .progress-bar {
                background-color: #673AB7
            }

            .fit-image {
                width: 100%;
                object-fit: cover
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
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                        <h2 id="heading">Sign Up Your User Account</h2>
                                        <p>Fill all form field to go to next step</p>
                                        <form id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active" id="account"><strong>Account</strong></li>
                                                <li id="personal"><strong>Personal</strong></li>
                                                <li id="payment"><strong>Image</strong></li>
                                                <li id="confirm"><strong>Finish</strong></li>
                                            </ul>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> <br> <!-- fieldsets -->
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Account Information:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 1 - 4</h2>
                                                        </div>
                                                    </div> <label class="fieldlabels">Email: *</label> <input type="email" name="email" placeholder="Email Id" /> <label class="fieldlabels">Username: *</label> <input type="text" name="uname" placeholder="UserName" /> <label class="fieldlabels">Password: *</label> <input type="password" name="pwd" placeholder="Password" /> <label class="fieldlabels">Confirm Password: *</label> <input type="password" name="cpwd" placeholder="Confirm Password" />
                                                </div> <input type="button" name="next" class="next action-button" value="Next" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Personal Information:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 2 - 4</h2>
                                                        </div>
                                                    </div> <label class="fieldlabels">First Name: *</label> <input type="text" name="fname" placeholder="First Name" /> <label class="fieldlabels">Last Name: *</label> <input type="text" name="lname" placeholder="Last Name" /> <label class="fieldlabels">Contact No.: *</label> <input type="text" name="phno" placeholder="Contact No." /> <label class="fieldlabels">Alternate Contact No.: *</label> <input type="text" name="phno_2" placeholder="Alternate Contact No." />
                                                </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Image Upload:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 3 - 4</h2>
                                                        </div>
                                                    </div> <label class="fieldlabels">Upload Your Photo:</label> <input type="file" name="pic" accept="image/*"> <label class="fieldlabels">Upload Signature Photo:</label> <input type="file" name="pic" accept="image/*">
                                                </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Finish:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 4 - 4</h2>
                                                        </div>
                                                    </div> <br><br>
                                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                                    </div> <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                            <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
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