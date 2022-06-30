<?php 
session_start();
if($_SESSION['user_login'] == ""){
    include("db-connect/notfound.php");
    /* 
include "language/english/language.php";
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['button']))
{
$firstname=mysqli_real_escape_string($con, $_POST['fname']); 
$lastname=mysqli_real_escape_string($con, $_POST['lname']);
$gender=mysqli_real_escape_string($con, $_POST['gender']);
$companyname=mysqli_real_escape_string($con, $_POST['companyname']);
$address=mysqli_real_escape_string($con, $_POST['street']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$phone=mysqli_real_escape_string($con, $_POST['phone']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$pass=mysqli_real_escape_string($con, $_POST['pass']); 
$country=mysqli_real_escape_string($con, $_POST['country1']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$user_type=mysqli_real_escape_string($con, $_POST['acc_type']);
$newsletter=mysqli_real_escape_string($con, $_POST['newsletter']);
$lang_status='0';

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

$insert_qry="INSERT INTO registration (firstname,lastname,gender,companyname, street, city, zip, phonenumber, email,password,country,state,usertype,newsletter_option,ip_address,added_date,userstatus,lang_status,memberid) VALUES 
                                        ('$firstname','$lastname','$gender','$companyname','$address','$city','$zip','$phone','$email','$pass','$country','$state','$user_type','$newsletter1','$ip',NOW(),'1','$lang_status','Free')"; 
$res_qry=mysqli_query($con,$insert_qry) or die("insert error");

$email_en=base64_encode($email);

header("location:register1.php?em=$email_en");

}
else
{
header("location:register.php?err");

}

}
 */
?>
<html>
    <head>
<title>Register</title>
<link rel="icon" href="assets/images/annexis-emblem.png" type="image/png">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> -->

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

            #msform input, #msform select,
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
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-4 bg-image ">
                <div class="row justify-content-center text-center imm">
                    <div class="col-md-12 ">
                        <p><a href="/"><img style="padding-bottom: 15px; width:60%" src="assets/images/logo-white.png" alt="" /></a></p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-light" >Your Bridge to Expansion & Increased Market Share.</p>
                    </div> 
                </div>
            </div>
                <div class="col-md-8">
                    <div class="container">
                        <div class="login d-flex align-items-center py-5">
                            <div class="row justify-content-center">
                                <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-12 text-center p-0 mt-3 mb-2"> -->
                                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                        <h2 id="heading">Sign Up Your User Account</h2>
                                        <p>Fill all form field to go to next step</p>
                                        <div id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active" id="account"><strong>Account</strong></li>
                                                <li id="personal"><strong>Personal</strong></li>
                                                <li id="payment"><strong>Image</strong></li>
                                                <li id="confirm"><strong>Finish</strong></li>
                                            </ul>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> <br>
                                             <!-- fieldsets -->
                                            <fieldset id="2">
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Verify Information:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 2 - 4</h2>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-12">
                                                         Confirm your email to continue
                                                         <label class="fieldlabels">Card Holder Name</label> 
                                                    <input type="text" name="card_holder_name" accept="">   
                                                    </div>
                                                </div> 
                                                <input type="button" name="next" class="next action-button" value="Next" /> 
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Payment Information:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 3 - 4</h2>
                                                        </div>
                                                    </div> 
                                                    <label class="fieldlabels">Card Holder Name</label> 
                                                    <input type="text" name="card_holder_name" accept=""> 
                                                    <label class="fieldlabels">Credit Card Number</label> 
                                                    <input type="text" name="card_no" accept=""> 
                                                    <label class="fieldlabels">Expiration Date</label> 
                                                    <input type="text" name="valid_upto" accept="">
                                                    <label class="fieldlabels">Security Code</label> 
                                                    <input type="text" name="" accept="">
                                                    <label class="fieldlabels">Verification Code</label> 
                                                    <input type="text" name="" accept="">
                                                    
                                                </div> 
                                                <input type="button" name="next" class="next action-button" value="Submit" /> 
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(++current);
        });

        $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(--current);
        });

        function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
        }

        $(".submit").click(function(){
        return false;
        })

        });
</script>

<?php } 
    else{
        echo "<script>window.location='/';</script>";
    }

?>
