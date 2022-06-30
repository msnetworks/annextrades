<?php 
session_start();
if($_SESSION['user_login'] == ""){
    include("config.php");
    
    /* header('Content-Type: application/json'); */
?>
<html>
    <head>
        <title>Register</title>
        <link rel="icon" href="https://annextrades.com/assets/images/annexis-emblem.png" type="image/png">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?fallback=true'" async defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/basic.min.css" rel="stylesheet" />
        <script>
        /* function onSubmit(token) {
            document.getElementById("user-form").submit();
        } */
        function onSubmit(token) {
                return new Promise(function (resolve, reject) {

                    if (grecaptcha.getResponse() !== "") {
                        $('#user-form').submit();
                    }
                    grecaptcha.reset();

                });
            }
            Dropzone.autoDiscover = false;
            jQuery(document).ready(function() {

                $("div#my-awesome-dropzone").dropzone({
                url: "/controller/company_imgsave.php?<?php echo $_GET['vendor_id']; ?>"
                });

            });
        </script>
        <style>
            article, aside, figure, footer, header, hgroup, 
            menu, nav, section { display: block; }
        </style>
        <style>
            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }
        </style>
        <style>
            .dropzone.dz-clickable {
                width: 180px;
                height: 180px; 
            }
        </style>
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
            max-height: 100vh;
            background-image: url('https://annextrades.com/images/bg-business.jpg');
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

            /* #progressbar li {
                list-style-type: none;
                font-size: 15px;
                width: 25%;
                float: left;
                position: relative;
                font-weight: 400
            } */

            #progressbar #account:before {
                font-family: FontAwesome;
                content: "\f13e"
            }

            #progressbar #personal:before {
                font-family: FontAwesome;
                content: "\f0e0"
            }

            #progressbar #payment:before {
                font-family: FontAwesome;
                content: "\f0c0"
            }

            #progressbar #confirm:before {
                font-family: FontAwesome;
                content: "\f093"
            }

            #progressbar #product:before {
                font-family: FontAwesome;
                content: "\f07a"
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
        <style>
            #captcha-wrap{
                border:solid #870500 1px;
                width:270px;
                -webkit-border-radius: 10px;
                float:left;
                -moz-border-radius: 10px;
                border-radius: 10px;
                background:#870500;
                text-align:left;
                padding:3px;
                margin-top:3px;
                height:100px;
                margin-left:80px;
            }
            #captcha-wrap .captcha-box{
                -webkit-border-radius: 7px;
                background:#fff;
                -moz-border-radius: 7px;
                border-radius: 7px;
                text-align:center;
                border:solid #fff 1px;
            }
            #captcha-wrap .text-box{
                -webkit-border-radius: 7px;
                background:#ffdc73;
                -moz-border-radius: 7px;
                width:140px;
                height:43px;
                float:left;
                margin:4px;
                border-radius: 7px;
                text-align:center;
                border:solid #ffdc73 1px;
            }
            
            #captcha-wrap .text-box input{ width:120px;}
            #captcha-wrap .text-box label{
                color:#000000;
                font-family: helvetica,sans-serif;
                font-size:12px;	
                width:150px;
                padding-top:3px; 
                padding-bottom:3px; 
            }
            #captcha-wrap .captcha-action{
                float:right; width:117px; 
                background:url(logos.jpg) top right no-repeat; 
                height:44px; margin-top:3px;
            }
            #captcha-wrap  img#captcha-refresh{
                margin-top:9px;
                border:solid #333333 1px;
                margin-right:6px;
                cursor:pointer;
            }
        </style>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body id="body">
        <?php 

            if ($_GET['vendor_id'] != '' ){
                $email_verify = mysqli_query($con, "SELECT * FROM registration Where vendor_id='".$_GET['vendor_id']."' ");
                $row = mysqli_fetch_array($email_verify);
                if ($_GET['productinfo'] == "Success") { ?>
                    <script>
                        $(window).on('load', function(){
                        var b1 = $("#save-form1"); 
                        var b2 = $("#next2");
                        b1.click();
                        b2.click();
                        var b3 = $("#save-form4");
                        b3.click();
                    });
                    </script>
                <?php }else{
                if ($row['email_verify'] == 'Verified') { ?>
                <script>
                    $(window).on('load', function(){
                    var b1 = $("#save-form1"), b2 = $("#next2")
                    b1.add(b2).click();
                    });
                </script> 
                <?php   
                }elseif ($row['email_verify'] != "Verified" or $row['email_verify'] == 'Verified') { ?>
                    <script>
                        $(window).on('load', function(){
                            $('#save-form1').click();
                        });
                    </script>
                <?php
                }
            }
        }
        ?>
        <div class="container-fluid" id="container-fluid">
            <div class="row no-gutter">
                <!-- <div class="d-none d-md-flex col-md-4 col-lg-4 bg-image ">
                    <div class="row justify-content-center text-center imm">
                        <div class="col-md-12 ">
                            <p><a href="/"><img style="padding-bottom: 15px; width:60%" src="../templates/images/logo-wide.png" alt="" /></a></p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-light" >Your Bridge to Expansion & Increased Market Share.</p>
                        </div> 
                    </div>
                </div> -->
                <?php
                    $res_id = "<div id='vndr_id'></div>";
                    echo $res_id;
                    if (@$_GET['vendor_id'] != '') {
                        $vndr_id = @$_GET['vendor_id'];
                        //echo "<script>alert('Your Email Has Been Verify Successfully.');</script>";
                    }
                    elseif($res_id != ""){
                        $vndr_id = $res_id;
                    }
                    else{
                        $vndr_id = '';
                    }
                    $vndr_id = $vndr_id;
                    if($vndr_id != "")
                    {   
                        
                        $q = mysqli_query($con, "SELECT * FROM registration WHERE vendor_id = '$vndr_id' ");
                        $r = mysqli_fetch_array($q);
                        $c = mysqli_query($con, "SELECT * FROM country WHERE country_id = '".$r['country']."' ");
                        $cn = mysqli_fetch_array($c);
                        $countryy = $cn['country_name'];
                        ?>
                        <?php
                    }
                    
                ?>
                <div class="col-md-12" style="/* max-height: 100vh; overflow: scroll; */">
                    <div class="container" id="container">
                        <div class="login d-flex align-items-center">
                                <div class="row col-12 col-sm-12 col-md-12 col-lg-10 col-xl-12 text-center p-0 mt-3 mb-2">
                                    <div class="card col-12 px-0 pt-4 pb-0 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <a class="text-left" href="https://annextrades.com"><img style="padding-bottom: 15px; width:40% " src="https://annextrades.com/assets/images/logo.png" alt="" /></a>
                                        </div>

                                        <?php 
                                            
                                        if (@$_GET['vendor_id'] == '' OR  $vndr_id == "") {

                                        ?>
                                        <div class="col-md-6 text-right">
                                            <h6 id="heading">Already have an account</h6>
                                            <a style="color: #fff;" href="https://annextrades.com/login.php"><button class="action-button"  style="padding: 5 10; background: #ff7900; border:0; color:#fff;">Sign In</button></a>
                                            <a href="../mydashboard/auth/forget_password.php">Forgot Password</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <h2 id="heading">Sign Up For Your User Account</h2>
                                        </div>

                                        <!-- < ?php 
                                            
                                        if (@$_GET['vendor_id'] == '' OR  $vndr_id == "") {

                                        ?>
                                        <div class="col-md-6 text-right">
                                            <h6 id="heading">Already have an account?</h6>
                                            <a style="color: #fff;" href="../mydashboard/"><button class="action-button"  style="padding: 5 10; background: #ff7900; border:0; color:#fff;">Sign In</button></a>
                                            <a href="../mydashboard/auth/forget_password.php">Forgot your password?</a>
                                        </div>
                                        < ?php } ?> -->
                                        
                                    </div>
                                        <div id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active" id="account"><strong>Account</strong></li>
                                                <li id="personal"><strong>Verification</strong></li>
                                                <?php if ($r['usertype'] != "Buyer") {
                                                    
                                                ?>
                                                <style>
                                                    #progressbar li {
                                                        list-style-type: none;
                                                        font-size: 15px;
                                                        width: 20%;
                                                        float: left;
                                                        position: relative;
                                                        font-weight: 400
                                                    }
                                                </style>
                                                <li id="payment"><strong>Company</strong></li>
                                                <?php if ($r['type'] == 'Service') { ?>
                                                    <li id="product"><strong>Service</strong></li>

                                                <?php }else{ ?>
                                                        <li id="product"><strong>Product</strong></li>
                                                <?php } ?>
                                                <li id="confirm"><strong>Finish</strong></li>
                                                <?php }else{ ?>
                                                    <style>
                                                        #progressbar li {
                                                            list-style-type: none;
                                                            font-size: 15px;
                                                            width: 33.33%;
                                                            float: left;
                                                            position: relative;
                                                            font-weight: 400
                                                        }
                                                    </style>
                                                    <li id="confirm"><strong>Finish</strong></li>
                                                <?php } ?>

                                            </ul>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> <br> 
                                            <!-- fieldsets -->

                                            <fieldset>
                                                <img src="images/Ask-yourself.jpg" style="width: 100%; padding-bottom: 15px;" alt="">
                                                <?php if ($row['payment'] == 'Yes' && $row['email_verify'] == 'Verified') { } else{?>
                                                <p style="padding-top: 15; text-align: left;">Complete all required fields to go to the next step. Please use tablet or computer for best results.</p>
                                                <?php } ?>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Account Information:</h2>
                                                        </div>
                                                        <?php if($r['usertype'] != 'Buyer'){ ?>
                                                            <div class="col-5">
                                                                <h2 class="steps">Step 1 - 5</h2>
                                                            </div>
                                                        <?php }else{ ?>
                                                            <div class="col-5">
                                                                <h2 class="steps">Step 1 - 3</h2>
                                                            </div>
                                                        <?php } ?>
                                                    </div> 
                                                    <?php if(isset($_REQUEST['err'])) { ?>
                                                        <div class="error"><?php echo $email_aready; ?></div>
                                                    <?php } ?><!-- onSubmit="return validate1_form();"  onsubmit="return validateForm()"-->
                                                    
                                                    <form id="user-form" name="myForm"  action="register-submit.php"   method="POST">
                                                        <div class="row ">
                                                            <div class="col-md-6">
                                                                <div class="ss-item-required">
                                                                    <div class="form-label-group">
                                                                        <input type="text" name="package" id="package" value="<?php echo $_GET['package']; ?>" hidden/>
                                                                        <input type="text" name="source_url" id="source_url" value="<?php echo $_GET['source']; ?>" hidden/>
                                                                        <input type="text" name="fname" id="fname" value="<?php echo $r['firstname']; ?>" class="control-form" placeholder="First Name: *" <?php if($r['firstname'] != ''){echo 'readonly';}?> />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="ss-item-required">
                                                                    <div class="form-label-group">
                                                                        <input type="text" name="lname" id="lname" value="<?php echo $r['lastname']; ?>" class="form-control" placeholder="Last Name *" <?php if($r['firstname'] != ''){echo 'readonly';}?>/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="companyname" id="companyname" value="<?php echo $r['companyname']; ?>" placeholder="Company Name *" <?php if($r['companyname'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div><!-- 
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="checkPan"></span>
                                                                    <input type="text" name="pan_no" id="pan_no" value="<?php echo $r['pan_no']; ?>" placeholder="PAN/GST/Tax ID " <?php if($r['pan_no'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div> -->
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="phone" id="phone" maxlength="10" minlenght="10" value="<?php echo $r['phonenumber']; ?>" placeholder="Phone *" <?php if($r['phonenumber'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <!-- <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="checkEmail"></span> -->

                                                                    <input type="email" name="email" id="email" value="<?php echo $r['email']; ?>"  placeholder="Email Id *" <?php if($r['email'] != ''){echo 'readonly';}?> autocomplete="off"/>
                                                                    <span id="checkEmail"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="password" id="pass" placeholder="Enter password" name="pass" <?php if($r['password'] != ''){ echo  'value="********"readonly';}?>>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="CheckPasswordMatch"></span>
                                                                <input type="password" id="cpass" placeholder="Confirm Password" name="cpass" <?php if($r['password'] != ''){ echo  'value="********"readonly';}?>>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div style="border: 1px solid #ccc; font-size: 16px; background-color: #ECEFF1; padding: 8px 15px 8px 15px; margin-bottom: 25;">
                                                                    <label for="gender" style="padding-right: 20px;  margin-bottom: 0;"><b>Account Type*</b></label>
                                                                    <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type" value="Seller" class="w-auto m-0" <?php if($r['usertype'] == 'Seller'){echo 'readonly checked';}?>/> &nbsp;Seller:&nbsp; <b> Sell My Products or Services</b></label>
                                                                    <?php
                                                                        //if (@$_GET['package'] == 'BusinessPortal' & @$_GET['source'] != NULL) {
                                                                    ?>       
                                                                    <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type1" value="Buyer" class="w-auto m-0" <?php if($r['usertype'] == 'Buyer'){echo 'readonly checked';}?>>&nbsp; Buyer:&nbsp;<b> Buy Products and Services </b></label>
                                                                    <?php
                                                                    //}
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 input-group">
                                                                <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;">
                                                                    <input type="checkbox" name="terms" class="w-auto" id="terms" <?php if($r['vendor_id'] != ''){echo 'readonly checked';}?>/> I agree to all <!-- Annexis --> <a href="https://www.annexis.net/terms-amp-condition/" target="_blank">Terms & Condition</a> and
                                                                    <a href="https://www.annexis.net/privacy-policy/" target="_blank">Privacy Policy</a>
                                                                </label>
                                                                <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;">
                                                                    <input type="checkbox" name="newsletter" class="w-auto" id="newsletter" value="yes" <?php if($r['newsletter_option'] == 'yes'){echo 'readonly checked';}?>/>
                                                                    I would like to receive newsletters and directory magazines.
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6 input-group">
                                                                <!-- <label>Captcha</label> 
                                                                <span id="captcha-info" class="info"></span><br/>
                                                                <input type="text" name="captcha" id="captcha" class="demoInputBox"  required><br> -->
                                                                <!-- <div style="width: 200px; height: 50px; background: #967ac8; text-align: center; font-size: 22px; padding: 10px; letter-spacing: 5px;"><?php echo $_SESSION['captcha_code']; ?></div>
                                                                 -->
                                                                <!-- <img id="captcha_code" src="captcha_code.php" style="width: 200px; height: 50px;" /> -->

                                                                <!-- <button class="btnRefresh" onClick="refreshCaptcha();">Refresh Captcha</button> -->
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- <input type="button" name="submit" id="save-form2" class="next action-button"  value="NEXT" data-sitekey="6LcWoLsZAAAAAD-NvAM2qF1pWbp7NEsIZkXbgQZP" data-callback='onSubmit' data-action='submit'/> -->

                                                    <?php if(@$_GET['vendor_id'] == ''){ ?>
                                                        <button type="submit" name="submit"  id="save-form"  style="font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 18%; font-size: 19px;" class="action-button" >REGISTER</button>
                                                    <?php }else{ ?>
                                                        <button type="button" name="submit" id="save-form1" class="next action-button" style="font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px;"  value="NEXT" ><b>NEXT</b></button>
                                                    <?php } ?>
                                                </form>
                                                <button type="Button"   id="save-form1" class="Next action-button"  style="font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px; display:none;" value="NEXT" ><b>NEXT</b></button>
                                            </fieldset>

                                            <fieldset <?php if($_GET['productinfo']=="Success"){ echo "style='display: none!important;'"; } ?>>
                                                <div class="form-card" <?php if($_GET['productinfo']=="Success"){ echo "style='display: none;'"; } ?>>
                                                    <?php 
                                                        $email_verify = mysqli_query($con, "SELECT * FROM registration Where vendor_id='".@$_GET['vendor_id']."' ");
                                                        $row = mysqli_fetch_array($email_verify);
                                                        $email_status = $row['email_verify'];
                                                        if (@$email_status == "Verified") { 
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Email Verification:</h2>
                                                        </div>
                                                        <?php if($r['usertype'] != 'Buyer'){ ?>
                                                            <div class="col-5">
                                                                <h2 class="steps">Step 2 - 5</h2>
                                                            </div>
                                                        <?php }else{ ?>
                                                            <div class="col-5">
                                                                <h2 class="steps">Step 2 - 3</h2>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <h3 class="text-center" style="color: #28a745!important;"><strong>Email Verification Successfully Completed.</strong></h3> <br>
                                                    <div class="row justify-content-center">
                                                        <div class=""> <img src="https://annextrades.com/assets/images/loading2.gif" class="w-100"> </div>
                                                    </div> <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                            <h5 class="purple-text text-center">Proceed to complete registration.</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="next2" class="next action-button" style="<?php if($_GET['productinfo']=="Success"){ echo "style='display: none!important;'"; } ?>font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px;"  value="NEXT" ><b>NEXT</b></button>
                                                <?php } else{ ?>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h2 class="fs-title">
                                                        <a target="_blank" href="https://mail.google.com"><img style="" src="images/gmail-logo.png"></a>&nbsp;&nbsp;
                                                        <a target="_blank" href="https://login.yahoo.com/"><img style="height: 65px;" src="images/yahoo-mail.png"></a>&nbsp;&nbsp;
                                                        <a target="_blank" href="https://outlook.com"><img style="height: 65px;" src="images/outlook-logo.png"></a>&nbsp;&nbsp;
                                                        <a target="_blank" href="https://login.aol.com/"><img style="height: 65px;" src="images/aol-logo.png"></a>&nbsp;&nbsp;
                                                        <a target="_blank" href="https://mail.rediff.com"><img style="height: 65px;" src="images/rediff-logo.png"></a>
                                                        
                                                        </h2>
                                                    </div>
                                                    <div class="col-5">
                                                        <h2 class="steps">Step 2 - 4</h2>
                                                    </div>
                                                </div>
                                                <h6 class="text-center" style="font-size: 20px; color:#616161; padding-top: 30px;">Please use the email account you provided in Step 1 to complete the Verification Process.
                                                <br> Select the <span style="color: #ff7900;">Verify Email</span> button to continue and complete the verification step.</h6>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="images/gm-logo.gif" class="w-100">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="row justify-content-center" style="padding-top: 30px;">
                                                        <h3 class="purple-text text-center"><strong>Email Verification Is Pending.</strong></h3>
                                                            <img src="https://annextrades.com/assets/images/loading3.gif" class="w-75" style="padding: 30px;">
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-12 text-center">
                                                                <p style="font-size: 18px;" class="purple-text text-center">Trouble locating Email? <br> Remember to check both Inbox and Spam folders</p> <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <!-- <input type="button" name="submit" id="save-form3" class="next action-button"  value="Bye Pass" /> -->
                                                </div>
                                                <button type="button" style="font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px; opacity: 5;" onclick="alert('Please Verify Email.');"  class="action-button" value="NEXT" disabled><b>NEXT</b></button>

                                                <!-- <input type="button" name="previous" id="back2" class="previous action-button-previous" value="Previous" /> -->
                                                <?php } ?>
                                                <!-- <input type="button" name="previous" id="back2" class="previous action-button-previous" value="Previous" /> -->
                                            </fieldset>
                                            <?php if ($r['usertype'] != "Buyer") { ?>
                                            <fieldset>
                                                <div class="form-card" >
                                                    <form action="controller/companyinfo.php" name="company-form" enctype="multipart/form-data" method="POST" id="company-info">
                                                        <div class="row">
                                                            <div class="col-3" style="display: inline !Important;">
                                                                <h2 class="fs-title">Company Information:</h2>
                                                            </div>
                                                            <div class="col-6" style="display: inline !Important;"><center>
                                                                <h3>
                                                                    <div style=" /*  background-color: #ECEFF1; */ padding: 0px 15px 0px 15px;">
                                                                        <label for="gender" class="purple-text" style="padding-right: 20px;"><b>Type:</b></label>
                                                                        <label style="padding-right: 20px; font-weigth: 100;" for="product"><input type="radio" class="w-auto m-0" name="type" value="Product" style="height: 1em;" id="product" onchange="chngpro(this);" <?php if($r['type'] == 'Product'){echo 'readonly checked';}?> required>&nbsp; Product</label>&nbsp; &nbsp;
                                                                        <label style="padding-right: 20px; font-weigth: 100;" for="service"><input type="radio" class="w-auto m-0" name="type" value="Service" style="height: 1em;" id="service" onchange="chngser(this);"<?php if($r['type'] == 'Service'){echo 'readonly checked';}?> required>&nbsp; Service</label>
                                                                    </div>
                                                                </center></h3>
                                                            </div>
                                                            <div class="col-3">
                                                                <h2 class="steps">Step 3 - 5</h2>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="vendor_id"  value="<?php echo $_GET['vendor_id']; ?>" hidden/>
                                                                    <input type="text" name="companyname" id="company_name" value="<?php echo $r['companyname']; ?>" placeholder="Company Name *" <?php if($r['companyname'] != ''){echo 'readonly';}?> required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="street" id="street" value="<?php echo $r['street']; ?>" <?php if($r['street'] != ''){echo 'readonly';}?> placeholder="Address *" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="city" id="city" value="<?php echo $r['city']; ?>" placeholder="City *" <?php if($r['city'] != ''){echo 'readonly';}?> required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="state" id="state" value="<?php echo $r['state']; ?>" placeholder="State *" <?php if($r['state'] != ''){echo 'readonly';}?> required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group"  <?php if($r['country'] != ''){echo 'readonly';}?> >
                                                                    <select name="country1" id="country1" required>
                                                                    <!-- < ?php if($r[country != '']){ ?>
                                                                        <option value="< ?php echo $r['country']; ?>"> < ?php echo $countryy; ?></option>
                                                                    < ?php }else{ ?> -->
                                                                    <option value="95">India</option>
                                                                    <?php 
                                                                        $select_country="SELECT * FROM country";
                                                                        $res_country=mysqli_query($con,$select_country);
                                                                        while($fet_country=mysqli_fetch_array($res_country))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $fet_country['country_id']; ?>"><?php echo $fet_country['country_name']; ?></option>
                                                                    <?php }/* } */ ?>
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="number" name="zip" id="zip" minlength="6" value="<?php echo $r['zipcode']; ?>" placeholder="Zip Code *" <?php if($r['zipcode'] != ''){echo 'readonly';}?> required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <style>
                                                                        .ck-editor__editable_inline {
                                                                            min-height: 150px;
                                                                            max-height: 300px;
                                                                        }
                                                                    </style>
                                                                    <textarea type="text" name="company_des" id="company-des" placeholder="Company Description *" <?php if($r['company_des'] != ''){echo 'readonly';}?> ><?php echo html_entity_decode($r['company_des'], ENT_QUOTES); ?></textarea>
                                                                    <!-- < ?php if ($r['company_des'] != '') { ?>
                                                                    <script>
                                                                            ClassicEditor.create( document.querySelector('#company-des' ) )
                                                                                .then(editor => { 
                                                                                    editor.isReadOnly = true; // make the editor read-only right after initialization
                                                                                } ) .catch( error => { 
                                                                                } );
                                                                    </script>
                                                                        < ?php }else{ ?> -->
                                                                    <script>
                                                                        ClassicEditor
                                                                            .create( document.querySelector( '#company-des' ) )
                                                                            .catch( error => { 
                                                                                console.error( error );
                                                                            } );
                                                                    </script>
                                                                    <!-- < ?php } ?> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12"><br></div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <!-- < ?php if($r['photo'] != ""){ ?>
                                                                    < ?php }else{ ?> -->
                                                                    <input type="text" name="img" value="<?php echo $r['photo']; ?>" hidden/>
                                                                    <!-- <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div> -->
                                                                    <input type='file' id="clogo" name="photo" class="inputfile" onchange="readURL(this);" />
                                                                    <label for="clogo" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                    <img id="blah" src="../company_images/<?php echo $r['photo']; ?>" style="height: 149px; width: 149px;" title="Add Company Logo" /></label>
                                                                    <script>
                                                                        function readURL(input) {
                                                                            if (input.files && input.files[0]) {
                                                                                var reader = new FileReader();
                                                                                reader.onload = function (e) {
                                                                                    $('#blah')
                                                                                        .attr('src', e.target.result)
                                                                                        .width(149)
                                                                                        .height(149);
                                                                                };
                                                                                reader.readAsDataURL(input.files[0]);
                                                                                //$("#c_txt").style.display = "none";
                                                                            }
                                                                        }
                                                                    </script>
                                                                    <?php /* } */ ?>
                                                                </div>
                                                            </div>
                                                </div>
                                                    </div>
                                                    <?php if($r['company_des'] != '' && $r['street'] && $r['city'] != '' && $r['state'] != '' && $r['country'] != '' && $r['zipcode'] != ''){
                                                    ?>
                                                    <?php if ($r['type'] != 'Product') { ?>
                                                        </form>
                                                        <button name="submit" id="save-form4" class="next pull-right bbtn" style="display: block; background: #fff; border: 0; vertical-align: bottom; outline: none; text-align: right;" ><img  style='width: 200px; padding-top: 15px;padding-top: 15px;' src='https://annextrades.com/assets/images/next.gif' alt=''>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 14px;"><img  style='width: 80px;' src='https://annextrades.com/assets/images/addser.png' alt=''><br> <font align="right">ADD SERVICE</font></b></button>
                                                        <!-- <button name="submit" id="save-formd" class="next pull-right bbtn" style="display: none; background: #fff; border: 0; vertical-align: bottom; outline: none;"><br><b style="font-size: 14px;"><img  style="width: 80px;" src="https://annextrades.com/assets/images/prods.png" alt=""> <br> ADD PRODUCT</b></button> -->
                                                        </form>
                                                    <?php }else{ ?>
                                                        </form>
                                                        <!-- 
                                                        <button name="submit" id="save-form4" class="next pull-right bbtn" style="display: none; background: #fff; border: 0; vertical-align: bottom; outline: none;"><img  style='width: 200px; padding-top: 15px;padding-top: 15px;' src='https://annextrades.com/assets/images/next.gif' alt=''>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 14px;"><img  style='width: 80px;' src='https://annextrades.com/assets/images/addser.png' alt=''><br> ADD SERVICE</b></button> -->
                                                        <button name="submit" id="save-form4" class="next pull-right bbtn" style="display: block; background: #fff; border: 0; vertical-align: bottom; outline: none; text-align: right;"><img  style='width: 200px; padding-top: 15px;padding-top: 15px;' src='https://annextrades.com/assets/images/next.gif' alt=''>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 14px;"><img  style="width: 80px;" src="https://annextrades.com/assets/images/prods.png" alt=""> <br> ADD PRODUCT</b></button>
                                                        <!-- <button type="submit" name="submit" id="save-companyinfo" style="display: block;font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px;" class="action-button" value="NEXT" ><b>NEXT</b></button> -->
                                                    
                                                    <?php }  ?>
                                                    <?php }else{ ?>
                                                    <button type="SUBMIT" class="action-button" style="font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 12%; font-size: 19px;" ><b>SAVE</b></button>
                                                    </form>
                                                    <?php } ?>
                                                    <script>
                                                    /* function chngpro(){
                                                            document.getElementById("save-form4").style.display = "none";
                                                            document.getElementById("save-formd").style.display = "block"; 
                                                            //document.getElementById("title-ser").style.display = "none"; 
                                                            //document.getElementById("title-pro").style.display = "block";
                                                            //document.getElementById("pro-serial").innerHTML = 'Product';
                                                            
                                                        }
                                                        function chngser(){
                                                            document.getElementById("save-formd").style.display = "none";
                                                            document.getElementById("save-form4").style.display = "block"; 
                                                            //document.getElementById("title-pro").style.display = "none"; 
                                                            //document.getElementById("title-ser").style.display = "block";
                                                            //document.getElementById("pro-serial").innerHTML = 'Service';

                                                        } */
                                                    </script>
                                                <script>
                                                    /* document.getElementById('service').onclick = function() {
                                                        document.getElementById("save-formd").style.display = "block";
                                                        document.getElementById("service").style.display = "none"; 
                                                    } */
                                                    /* $("#company-info").on('submit', function(ss){
                                                        ss.preventDefault();
                                                        //var data = $(this).serialize();
                                                        var form = $('#company-info')[0]; // You need to use standard javascript object here
                                                        var formData = new FormData(form);
                                                        console.log(formData);
                                                        $.ajax({
                                                        url: 'controller/companyinfo.php',
                                                        data: formData,
                                                        dataType: 'json',
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        method: 'POST',
                                                        //type: 'POST', // For jQuery < 1.9
                                                        success: function(response){
                                                            
                                                            alert(response);
                                                            //$(".bbtn").click(); 
                                                            
                                                        }
                                                    });

                                                    }); */
                                                </script>
                                            </fieldset>
                                            <fieldset id="pro-service">
                                                   <!--  <span style="position: absolute;"><img src="images/editloader.gif" width="100%" alt=""></span> -->
                                                <div class="form-card">
                                                    <div class="row">
                                                            <div class="col-7">
                                                                <?php /* if ($r['type'] == 'Service') { */ ?>
                                                                <h2 class="fs-title" id="title-ser" style="<?php if ($r['type'] != 'Product') { ?>display: block;<?php }else{ echo "display: none;"; } ?>">Add Service Information</h2>
                                                                <?php /* } */ ?>
                                                                <h2 class="fs-title" id="title-pro" style="<?php if ($r['type'] == 'Product') { ?>display: block;<?php }else{ echo "display: none;"; } ?>">Add Product Information</h2>
                                                            </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 4 - 5</h2>
                                                        </div>
                                                    </div> 
                                                        <?php
                                                            $pq = $con->query("SELECT userid FROM product_temp WHERE vendor_id = '".$r['userid']."'");
                                                            $pnum = mysqli_num_rows($pq);
                                                            //echo $pnum;
                                                            if ($pnum == "0") {
                                                                /* if ($r['type'] == 'Service') { */ ?>
                                                                    <form action="controller/proinfo.php" enctype="multipart/form-data" name="product-form" method="POST" id="product-info">
                                                                        <div class="row" class="field_wrapper" id="p1">
                                                                            <div class="col-12">
                                                                            <?php if ($r['type'] != 'Service') {?>
                                                                                <div class="col-12">
                                                                                    <h3 class="text-center"><font id="pro-serial">Product</font> 1 of 20</h3>
                                                                                </div>
                                                                            <?php }else{ ?>
                                                                                <div class="col-12">
                                                                                    <h3 class="text-center"><font id="pro-serial">Service </font> 1 of 20</h3>
                                                                                </div>
                                                                            <?php } ?>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="int" name="vendor_id" value="<?php echo $r['vendor_id']; ?>" hidden/>
                                                                                    <input type="int" name="usr_id" value="<?php echo $r['id']; ?>" hidden/>
                                                                            <input type="text" name="p_name[]" id="p_name" placeholder="<?php if ($r['type'] != 'Product') {?>Service Name *<?php }else{ ?>Product Name<?php } ?>" required/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-label-group">
                                                                                    <input type="text" name="p_unit[]" id="p_unit"  value="USD ($)" readonly >
                                                                                </div>
                                                                            </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-label-group">
                                                                                        <input type="number" name="p_price[]" id="p_price"  placeholder="Price Range From: $ *"  required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-label-group">
                                                                                        <input type="number" name="p_price1[]" id="p_price1"  placeholder="Price Range To: $ *" >
                                                                                    </div>
                                                                                </div>
                                                                            <?php if ($r['type'] != 'Service') {?>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-label-group">
                                                                                        <input type="number" name="quantity[]" id="quantity" placeholder="Min quantity *" required/>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-12">
                                                                                <div class="form-label-group">
                                                                                    <style>
                                                                                        .ck-editor__editable_inline {
                                                                                            min-height: 150px;
                                                                                            max-height: 300px;
                                                                                        }
                                                                                    </style>
                                                                                    <textarea type="text" name="product_des[]" id="product-des" style="max-height: 200px;" placeholder="<?php if ($r['type'] != 'Product') {?>Service Description * *<?php }else{ ?>Product Description *<?php } ?>" ></textarea>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12"><br></div>
                                                                            <style>
                                                                                #logo {
                                                                                    width: 200px;
                                                                                    height: 50px;
                                                                                    position: relative;
                                                                                    border: dashed 1px black;
                                                                                    overflow: hidden;
                                                                                    }

                                                                                    #logo input[type="file"]
                                                                                    {
                                                                                    margin: 0;
                                                                                    opacity: 0;   
                                                                                    font-size: 100px;
                                                                                    }
                                                                            </style>
                                                                            <div class="col-md-12">
                                                                                
                                                                                <!-- <small>Service Image 1*</small> -->
                                                                                <input type='file' name="photo[]" id="slogo1" class="inputfile" onchange="readURL1(this);" required/>
                                                                                <label for="slogo1" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                                <img id="blah1" src="" alt="Add Image 1" /></label>
                                                                                <script>
                                                                                    function readURL1(input) {
                                                                                        if (input.files && input.files[0]) {
                                                                                            var reader = new FileReader();

                                                                                            reader.onload = function (e) {
                                                                                                $('#blah1')
                                                                                                    .attr('src', e.target.result)
                                                                                                    .width(149)
                                                                                                    .height(149);
                                                                                            };

                                                                                            reader.readAsDataURL(input.files[0]);
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                        
                                                                                <!-- <small>Service Image 2</small> -->
                                                                                <input type='file' name="photo1[]" id="slogo2" class="inputfile" onchange="readURL2(this);" />
                                                                                <label for="slogo2" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                                <img id="blah2" src="" alt="Add Image 2" /></label>
                                                                                <script>
                                                                                    function readURL2(input) {
                                                                                        if (input.files && input.files[0]) {
                                                                                            var reader = new FileReader();

                                                                                            reader.onload = function (e) {
                                                                                                $('#blah2')
                                                                                                    .attr('src', e.target.result)
                                                                                                    .width(149)
                                                                                                    .height(149);
                                                                                            };

                                                                                            reader.readAsDataURL(input.files[0]);
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                        
                                                                                <!-- <small>Service Image 3</small> -->
                                                                                <input type='file' name="photo2[]" id="slogo3" class="inputfile" onchange="readURL3(this);"/>
                                                                                <label for="slogo3" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                                <img id="blah3" src="" alt="Add Image 3" /></label>
                                                                                <script>
                                                                                    function readURL3(input) {
                                                                                        if (input.files && input.files[0]) {
                                                                                            var reader = new FileReader();

                                                                                            reader.onload = function (e) {
                                                                                                $('#blah3')
                                                                                                    .attr('src', e.target.result)
                                                                                                    .width(149)
                                                                                                    .height(149);
                                                                                            };

                                                                                            reader.readAsDataURL(input.files[0]);
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                        
                                                                        
                                                                                <input type='file' name="photo3[]" id="slogo4" class="inputfile" onchange="readURL4(this);"/>
                                                                                <label for="slogo4" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                                <img id="blah4" src="" alt="Add Image 4" /></label>
                                                                                <script>
                                                                                    function readURL4(input) {
                                                                                        if (input.files && input.files[0]) {
                                                                                            var reader = new FileReader();

                                                                                            reader.onload = function (e) {
                                                                                                $('#blah4')
                                                                                                    .attr('src', e.target.result)
                                                                                                    .width(149)
                                                                                                    .height(149);
                                                                                            };

                                                                                            reader.readAsDataURL(input.files[0]);
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                        
                                                                                <!-- <small>Service Image 5</small> -->
                                                                                <input type='file' name="photo4[]" id="slogo5" class="inputfile" onchange="readURL5(this);"/>
                                                                                <label for="slogo5" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                                <img id="blah5" src="" alt="Add Image 5" /></label>
                                                                                <script>
                                                                                    function readURL5(input) {
                                                                                        if (input.files && input.files[0]) {
                                                                                            var reader = new FileReader();

                                                                                            reader.onload = function (e) {
                                                                                                $('#blah5')
                                                                                                    .attr('src', e.target.result)
                                                                                                    .width(149)
                                                                                                    .height(149);
                                                                                            };

                                                                                            reader.readAsDataURL(input.files[0]);
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                                
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-label-group">
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="copied"></div>
                                                                        <div class="row">    
                                                                            <div class="col-md-6">
                                                                            <div class="form-label-group">
                                                                                <div class="btn-success" style="background: #fff; color: #673ab7;" id="add_next"><img  style="width: 80px;" src="https://annextrades.com/assets/images/addm.png" alt=""><b style="font-size: 14px;">ADD MORE <!-- < ?php if ($r['type'] == "Service") { echo "SERVICE"; }else{ ?>PRODUCT< ?php } ?> --></b></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-label-group">
                                                                                <button class="action-button" type="submit" style="background: #2baae1; border-radius: 50px; padding: 17px; width: 25%; font-size: 19px;"><b>PREVIEW</b></button>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                                </div>
                                                        <?php  } else { ?>
                                                            
                                                            <form id="formp" name="formp" action="controller/update_product.php" method="POST" enctype="multipart/form-data" >
                                                            <input type="int" name="vendor_id" value="<?php echo $_GET['vendor_id']; ?>" hidden/>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="pull-right" id="edit<?php echo $i; ?>" style="display: block; border: 0px; background: #fff;  right: 0%;"><i style="font-size: 40px;" class="fa fa-edit "></i><br><b>EDIT</b></button>
                                                                    <button type="submit" class="pull-right" name="submit" id="save<?php echo $i; ?>" style="display: none; border: 0px; background: #fff; right: 0%;" ><i style="font-size: 40px;" class="fa fa-save"></i><br><b>SAVE</b></button>
                                                                </div>
                                                            </div>
                                                            <?php $i = 1;
                                                            $pq1 = $con->query("SELECT * FROM product WHERE userid = '".$r['userid']."'");
                                                            WHILE($ft = mysqli_fetch_array($pq1)){
                                                                ?> 
                                                            <div class="row">
                                                                <?php if ($r['type'] != 'Service') {?>
                                                                    <div class="col-6">
                                                                        <h3 class="text-left"><font id="pro-serial">Product</font> <?php echo $i; ?> of 20</h3>
                                                                    </div>
                                                                    <?php }else{ ?>
                                                                        <div class="col-6">
                                                                            <h3 class="text-left"><font id="pro-serial">Service</font> <?php echo $i; ?> of 20</h3>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <div class="col-md-6">
                                                                            </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-label-group">
                                                                            <input type="int" name="usr_id[]" value="<?php echo $ft['id']; ?>" hidden/>
                                                                            <div id="pname<?php echo $i; ?>"><input type="text" name="p_name[]" id="p_name<?php echo $i; ?>" <?php echo "value='".$ft['p_name']."' readonly"; ?>  placeholder="Product Name *" required/></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-label-group">
                                                                            <input type="text"  id="unit<?php echo $i; ?>"   value="USD ($) *" disabled/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-label-group">
                                                                            <input type="number" name="p_price[]" id="p_price<?php echo $i; ?>" <?php echo "value='".$ft['range']."' readonly"; ?>  placeholder="Price Range From: $ *" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-label-group">
                                                                            <input type="number" name="p_price1[]" id="p_price1<?php echo $i; ?>" <?php echo "value='".$ft['range2']."' readonly"; ?>  placeholder="Price Range To: $ *" required>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($r['type'] != 'Service') {
                                                                    ?>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label-group">
                                                                            <input type="number" name="quantity[]"  id="quantity<?php echo $i; ?>" <?php echo "value='".$ft['p_min_quantity']."' readonly"; ?> placeholder="Min quantity *" required/>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <div class="col-md-12">
                                                                        <div class="form-label-group">
                                                                            <style>
                                                                                .ck-editor__editable_inline {
                                                                                    min-height: 150px;
                                                                                    max-height: 300px;
                                                                                }
                                                                            </style>
                                                                            <textarea type="text" name="product_des[]" id="<?php echo "aa".$i; ?>" style="max-height: 200px;" requied><?php echo html_entity_decode(htmlspecialchars($ft['product_des'])); ?></textarea>
                                                                            
                                                                            <script>
                                                                                ClassicEditor.create( document.querySelector('#<?php echo "aa".$i; ?>' ) )
                                                                                    .then(editor => { 
                                                                                    } ) .catch( error => { 
                                                                                } );
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12"><br></div>
                                                                    <div class="col-md-12 justify-content-center">
                                                                        <?php if($ft['photo'] != ""){ ?>
                                                                            <input type='text' name="p[]" value="<?php echo $ft['photo']; ?>" hidden/>
                                                                            <input type='file' id="s<?php echo $i; ?>logo1" name="photo[]" class="inputfile" onchange="<?php echo "rll".$i; ?>(this);" />
                                                                            <label for="s<?php echo $i; ?>logo1" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                            <img id="blaha<?php echo $i; ?>" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $ft['photo']; ?>" alt="Add Image 1" /></label>
                                                                            <script>
                                                                                function <?php echo "rll".$i; ?>(input) {
                                                                                    if (input.files && input.files[0]) {
                                                                                        var reader = new FileReader();

                                                                                        reader.onload = function (e) {
                                                                                            $('#blaha<?php echo $i; ?>')
                                                                                                .attr('src', e.target.result)
                                                                                                .width(149)
                                                                                                .height(149);
                                                                                        };
                                                                                        reader.readAsDataURL(input.files[0]);
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        <?php } ?>
                                                                        <?php if($ft['photo1'] != ""){ ?>
                                                                            <input type='text' name="p1[]" value="<?php echo $ft['photo1']; ?>" hidden/>
                                                                            
                                                                            <input type='file' id="s<?php echo $i; ?>logo2" name="photo1[]" class="inputfile" onchange="<?php echo "rlla".$i; ?>(this);" />
                                                                            <label for="s<?php echo $i; ?>logo2" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                            <img id="blahb<?php echo $i; ?>" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $ft['photo1']; ?>" alt="Add Image 2" /></label>
                                                                            <script>
                                                                            
                                                                                function <?php echo "rlla".$i; ?>(input) {
                                                                                    if (input.files && input.files[0]) {
                                                                                        var reader = new FileReader();

                                                                                        reader.onload = function (e) {
                                                                                            $('#blahb<?php echo $i; ?>')
                                                                                                .attr('src', e.target.result)
                                                                                                .width(149)
                                                                                                .height(149);
                                                                                        };
                                                                                        reader.readAsDataURL(input.files[0]);
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        <?php } ?>
                                                                        <?php if($ft['photo2'] != ""){ ?>
                                                                            <input type='text' name="p2[]" value="<?php echo $ft['photo2']; ?>" hidden/>
                                                                            <input type='file' id="s<?php echo $i; ?>logo7" name="photo2[]" class="inputfile" onchange="<?php echo "rl2".$i; ?>(this);" />
                                                                            <label for="s<?php echo $i; ?>logo7" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                            <img id="blahc<?php echo $i; ?>" style="width: 149px; height: 149px;"  src="../productlogo/<?php echo $ft['photo2']; ?>" alt="Add Image 3" /></label>
                                                                            <script>
                                                                                function <?php echo "rl2".$i; ?>(input) {
                                                                                    if (input.files && input.files[0]) {
                                                                                        var reader = new FileReader();

                                                                                        reader.onload = function (e) {
                                                                                            $('#blahc<?php echo $i; ?>')
                                                                                                .attr('src', e.target.result)
                                                                                                .width(149)
                                                                                                .height(149);
                                                                                        };
                                                                                        reader.readAsDataURL(input.files[0]);
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        <?php } ?>
                                                                        <?php if($ft['photo3'] != ""){ ?>
                                                                            <input type='text' name="p3[]" value="<?php echo $ft['photo3']; ?>" hidden/>
                                                                            
                                                                            <input type='file' id="s<?php echo $i; ?>logo3" name="photo3[]" class="inputfile" onchange="<?php echo "rl3".$i; ?>(this);" />
                                                                            <label for="s<?php echo $i; ?>logo3" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                            <img id="blahd<?php echo $i; ?>" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $ft['photo3']; ?>" alt="Add Image 4" /></label>
                                                                            <script>
                                                                                function <?php echo "rl3".$i; ?>(input) {
                                                                                    if (input.files && input.files[0]) {
                                                                                        var reader = new FileReader();

                                                                                        reader.onload = function (e) {
                                                                                            $('#blahd<?php echo $i; ?>')
                                                                                                .attr('src', e.target.result)
                                                                                                .width(149)
                                                                                                .height(149);
                                                                                        };
                                                                                        reader.readAsDataURL(input.files[0]);
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        <?php } ?>
                                                                        <?php if($ft['photo4'] != ""){ ?>
                                                                            <input type='text' name="p4[]" value="<?php echo $ft['photo4']; ?>" hidden/>
                                                                            <input type='file' id="s<?php echo $i; ?>logo4" name="photo4[]" class="inputfile" onchange="<?php echo "rl4".$i; ?>(this);" />
                                                                            <label for="s<?php echo $i; ?>logo4" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                                            <img id="blahe<?php echo $i; ?>"  style="width: 149px; height: 149px;" src="../productlogo/<?php echo $ft['photo4']; ?>" alt="Add Image 5" /></label>
                                                                            <script>
                                                                                function <?php echo "rl4".$i; ?>(input) {
                                                                                    if (input.files && input.files[0]) {
                                                                                        var reader = new FileReader();

                                                                                        reader.onload = function (e) {
                                                                                            $('#blahe<?php echo $i; ?>')
                                                                                                .attr('src', e.target.result)
                                                                                                .width(149)
                                                                                                .height(149);
                                                                                        };
                                                                                        reader.readAsDataURL(input.files[0]);
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-12"><br></div>
                                                                    <div class="col-md-1"><br></div>
                                                                    
                                                                    <div class="col-md-12"><br><br></div>
                                                                </div>
                                                        <?php $i= $i+1; }  ?>
                                                        <script>
                                                            document.getElementById('edit').onclick = function() {
                                                                $('input').attr('readonly', false); 
                                                                document.getElementById("save").style.display = "block";
                                                                document.getElementById("edit").style.display = "none"; 
                                                                document.getElementById("save-form5").style.display = "none";
                                                            }
                                                            $("#formp").on('submit', function(p){
                                                                
                                                                p.preventDefault();
                                                                //var data = $(this).serialize();
                                                                var form = $('#formp')[0]; // You need to use standard javascript object here
                                                                var formData = new FormData(form);
                                                                console.log(formData);
                                                                jQuery.ajax({
                                                                url: 'controller/update_product.php',
                                                                data: formData,
                                                                cache: false,
                                                                dataType: 'json',
                                                                contentType: false,
                                                                processData: false,
                                                                method: 'POST',
                                                                type: 'POST', // For jQuery < 1.9
                                                                complete: function(response){
                                                                    
                                                                    alert("Updated Successfully");
                                                                    $('input').attr('readonly', true); 
                                                                    document.getElementById("save").style.display = "none";
                                                                    document.getElementById("edit").style.display = "block"; 
                                                                    document.getElementById("save-form5").style.display = "block";
                                                                    return true;
                                                                }
                                                            });
    
                                                            });
                                                        </script>          
                                                    </form>
                                                    </div>
                                                        <button type="button" name="submit" id="save-form5" class="next action-button" style="border-radius: 50px; padding: 17px; width: 16%; font-size: 19px;"><b>SUBMIT</b></button>
                                                    <?php } ?>
                                                </form>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Finish:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 5 - 5</h2>
                                                        </div>
                                                    </div>
                                                    <h2 class="purple-text text-center" style="font-size: 50px; font-weight: 900;">Congratulations.</h2><br><br>
                                                    <center><h3>Thank you for submitting your details. <br> A review and approval of your information will <br> be performed within 24 to 48 hours. <br> Upon approval, your details will be made active for public viewing.</h3></center>
                                                                    <!-- <h4 class="purple-text text-center" style="font-size:30px;">Thank you for submitting your < ?php if($r['type'] == 'Service'){ echo "service";}else{ ?>product< ?php } ?>.<br>
                                                    <h4 class="purple-text text-center" style="font-size:30px;">Your < ?php if($r['type'] == 'Service'){ echo "service";}else{ ?>product< ?php } ?> has been sent for review.
                                                    </h4> --> <br>
                                                    <!-- <h4 class="text-center" style="color: black; font-size:25px;">Select The <span class="purple-text"><b>FINISH</b></span> button 
                                                    to Sign-In using email and <br> password used to create account and access your user dashboard.
                                                    </h4> <br> -->
                                                </div>
                                                <button class="action-button" style="border-radius: 50px; padding: 17px; width: 16%; font-size: 19px;" ><a style="color:#fff;" href="https://annextrades.com/registration/controller/congrats_email.php?vendor_id=<?php echo $_GET['vendor_id']; ?>"><b>FINISH</b></a></button>
                                            </fieldset>
                                            <?php }else{ ?>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Finish:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 3 - 3</h2>
                                                        </div>
                                                    </div>
                                                    <h4 class="purple-text text-center" style="font-size:30px; ">You will now be re-routed to our Business Portal Site <br>
                                                    <span style="color: #ff7900;">www.ANNEXTrades.com</span> to add your <br> Company & Product or Service Details
                                                    </h4> <br>
                                                    <h4 class="text-center" style="color: black; font-size:25px; ">Select The <span class="purple-text"><b>Finish</b></span> button 
                                                    to Sign-In using email and <br> password used to create account and access your user dashboard.
                                                    </h4> <br>
                                                </div>
                                                <button class="action-button" style="color:#fff; font-weight: 800 !important; outline: 0px;  border-radius: 50px; padding: 17px; width: 16%; font-size: 19px; ><a href="https://annextrades.com/login.php?source=Finish">Finish</a></button>
                                            </fieldset>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
        </body>
    </html>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<?php if ($r['type'] != 'Service') { ?>

<script>
    var counter = 1 ;
   
   $(document).ready(function() {

       $("#add_next").click(function(){
        let valid = true;
                $('[required]').each(function() {
                    if ($(this).is(':invalid') || !$(this).val()) valid = false;
                })
                if (valid) 
                {
                     counter++; 
                $("#count"+counter).html(counter);
                    
                }
           
       });

   });
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $("#p1"); //Fields wrapper
        var add_button      = $("#add_next"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input b
                /* let valid = true;
                $('[required]').each(function() {
                    if ($(this).is(':invalid') || !$(this).val()) valid = false;
                })
                if (valid) 
                { */
                e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++;
                        let valid = true;
                        $('[required]').each(function() {
                            if ($(this).is(':invalid') || !$(this).val()) valid = false;
                        })
                        if (valid) 
                        {
                         //text box increment
                        $(wrapper).append(`
                        <div class="row" id="p1`+counter+`">
                            <div class="col-md-12"><br><br></div>
                            <div class="col-12">
                                <h3 class="text-center">Product <font id="count`+counter+`">`+counter+` of 20</font></h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="int" name="vendor_id" value="<?php echo $r['vendor_id']; ?>" hidden/>
                                    <input type="int" name="usr_id" value="<?php echo $r['id']; ?>" hidden/>
                                    <input type="text" name="p_name[]" id="p_name`+counter+`" placeholder="Product Name *" required/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-label-group">
                                    <input type="text" name="p_unit[]" id="p_unit`+counter+`"  value="USD ($)" readonly >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" name="p_price[]" id="p_price`+counter+`"  placeholder="Price Range From: $ *" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" name="p_price1[]" id="p_price1`+counter+`"  placeholder="Price Range To: $ *" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-label-group">
                                    <input type="number" name="quantity[]" id="quantity`+counter+`" placeholder="Min quantity *" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <style>
                                        .ck-editor__editable_inline {
                                            min-height: 150px;
                                            max-height: 300px;
                                        }
                                    </style>
                                    <textarea type="text" name="product_des[]" id="product-des`+counter+`" style="max-height: 200px;" placeholder="Service Description *" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12"><br></div>
                            <style>
                                #logo {
                                    width: 200px;
                                    height: 50px;
                                    position: relative;
                                    border: dashed 1px black;
                                    overflow: hidden;
                                    }

                                    #logo input[type="file"]
                                    {
                                    margin: 0;
                                    opacity: 0;   
                                    font-size: 100px;
                                    }
                            </style>
                        </div>
                        <div class="col-md-12">
                            <div class="form-label-group"> 
                                <input type='file' id="sslogo`+counter+`" name="photo[]" class="inputfile" required/>
                                <label for="sslogo`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                <img id="spp`+counter+`" src="" alt="Add Image 1" /></label>

                                <input type='file' id="sslogo1`+counter+`" name="photo1[]" class="inputfile" onchange="ssa`+counter+`(this);"/>

                                <label for="sslogo1`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                <img id="spp2`+counter+`" src="" alt="Add Image 2" /></label>
                                
                                <input type='file' id="sslogo2`+counter+`" name="photo2[]" class="inputfile" onchange="ssb`+counter+`(this);"/>
                                <label for="sslogo2`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                <img id="spp3`+counter+`" src="" alt="Add Image 3" /></label>
                                
                                <input type='file' id="sslogo3`+counter+`" name="photo3[]" class="inputfile" onchange="ssc`+counter+`(this);"/>
                                <label for="sslogo3`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                <img id="spp4`+counter+`" src="" alt="Add Image 4" /></label>

                                <input type='file' id="sslogo4`+counter+`" name="photo4[]" class="inputfile" onchange="ssd`+counter+`(this);"/>
                                <label for="sslogo4`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                <img id="spp5`+counter+`" src="" alt="Add Image 5" /></label>
                            </div>
                        </div>
                        <div class="col-md-12"><br><br></div>
                        `);
                        $('#sslogo'+counter).on('change', function(input) {
                            //alert('okk');
                            var fff = $('#sslogo'+counter).prop('files')[0];
                            if (fff) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#spp'+counter)
                                        .attr('src', e.target.result)
                                        .width(149)
                                        .height(149);
                                };
                                //var file = _('file1').files[0];
                                reader.readAsDataURL(fff);
                            }
                        });
                        $('#sslogo1'+counter).on('change', function(input) {
                            //alert('okk');
                            var fff = $('#sslogo1'+counter).prop('files')[0];
                            if (fff) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#spp2'+counter)
                                        .attr('src', e.target.result)
                                        .width(149)
                                        .height(149);
                                };
                                //var file = _('file1').files[0];
                                reader.readAsDataURL(fff);
                            }
                        });
                        $('#sslogo2'+counter).on('change', function(input) {
                            //alert('okk');
                            var fff = $('#sslogo2'+counter).prop('files')[0];
                            if (fff) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#spp3'+counter)
                                        .attr('src', e.target.result)
                                        .width(149)
                                        .height(149);
                                };
                                //var file = _('file1').files[0];
                                reader.readAsDataURL(fff);
                            }
                        });
                        $('#sslogo3'+counter).on('change', function(input) {
                        //alert('okk');
                            var fff = $('#sslogo3'+counter).prop('files')[0];
                            if (fff) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#spp4'+counter)
                                        .attr('src', e.target.result)
                                        .width(149)
                                        .height(149);
                                };
                                //var file = _('file1').files[0];
                                reader.readAsDataURL(fff);
                            }
                        });
                        $('#sslogo4'+counter).on('change', function(input) {
                            //alert('okk');
                            var fff = $('#sslogo4'+counter).prop('files')[0];
                            if (fff) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#spp5'+counter)
                                        .attr('src', e.target.result)
                                        .width(149)
                                        .height(149);
                                };
                                //var file = _('file1').files[0];
                                reader.readAsDataURL(fff);
                            }
                        });
                        ClassicEditor
                        .create( document.querySelector( '#product-des'+counter ) )
                        .catch( error => {
                        } );
                        }else { 
                            alert("error please fill all fields!"); 
                        }
                    
                        
                        
                    
                    }
                    /* }
                    else { 
                        alert("error please fill all fields!"); 
                    } */
            });
        });




</script>
<?php }else{ ?>
<script>
    var counter = 1 ;
   
   $(document).ready(function() {

       $("#add_next").click(function(){
        let valid = true;
            $('[required]').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) valid = false;
            })
            if (valid) {
                counter++;
                $("#count"+counter).html(counter);
            }
           
       });

   });
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $("#p1"); //Fields wrapper
        var add_button      = $("#add_next"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add i
            
            

            /* if (p_name != "" && p_price != "" && product_des != "" && logo != "" ) {
             */    
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    let valid = true;
                    $('[required]').each(function() {
                        if ($(this).is(':invalid') || !$(this).val()) valid = false;
                    })
                    if (valid) 
                    {
                    $(wrapper).append(`
                        <div class="row" id="p1`+counter+`">
                        <div class="col-md-12"><br><br></div>

                            <div class="col-12">
                                <h3 class="text-center">Service <font id="count`+counter+`">`+counter+` of 20</font></h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="int" name="vendor_id" value="<?php echo $r['vendor_id']; ?>" hidden/>
                                    <input type="int" name="usr_id" value="<?php echo $r['id']; ?>" hidden/>
                                    <input type="text" name="p_name[]" id="p_name`+counter+`" placeholder="Service Name *" required/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-label-group">
                                    <input type="text" name="p_unit[]" id="p_unit`+counter+`"  value="USD ($)" readonly >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" name="p_price[]" id="p_price`+counter+`"  placeholder="Price Range From: $ *" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-label-group">
                                    <input type="number" name="p_price1[]" id="p_price1`+counter+`"  placeholder="Price Range To: $ *" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <style>
                                        .ck-editor__editable_inline {
                                            min-height: 150px;
                                            max-height: 300px;
                                        }
                                    </style>
                                    <textarea type="text" name="product_des[]" id="product-des`+counter+`" style="max-height: 200px;" placeholder="Service Description *" ></textarea>
                                
                                </div>
                            </div>
                            <div class="col-md-12"><br></div>
                            <style>
                                #logo {
                                    width: 200px;
                                    height: 50px;
                                    position: relative;
                                    border: dashed 1px black;
                                    overflow: hidden;
                                    }

                                    #logo input[type="file"]
                                    {
                                    margin: 0;
                                    opacity: 0;   
                                    font-size: 100px;
                                    }
                            </style>
                            <div class="col-md-12">
                                <div class="form-label-group"> 
                                    <input type='file' id="sslogo`+counter+`" name="photo[]" class="inputfile"/>
                                    <label for="sslogo`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                    <img id="spp`+counter+`" src="" alt="Add Image 1" /></label>

                                    <input type='file' id="sslogo1`+counter+`" name="photo1[]" class="inputfile" onchange="ssa`+counter+`(this);"/>

                                    <label for="sslogo1`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                    <img id="spp2`+counter+`" src="" alt="Add Image 2" /></label>
                                    
                                    <input type='file' id="sslogo2`+counter+`" name="photo2[]" class="inputfile" onchange="ssb`+counter+`(this);"/>
                                    <label for="sslogo2`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                    <img id="spp3`+counter+`" src="" alt="Add Image 3" /></label>
                                    
                                    <input type='file' id="sslogo3`+counter+`" name="photo3[]" class="inputfile" onchange="ssc`+counter+`(this);"/>
                                    <label for="sslogo3`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                    <img id="spp4`+counter+`" src="" alt="Add Image 4" /></label>

                                    <input type='file' id="sslogo4`+counter+`" name="photo4[]" class="inputfile" onchange="ssd`+counter+`(this);"/>
                                    <label for="sslogo4`+counter+`" style="height: 151px; width: 151px; border: 1px solid #333;">
                                    <img id="spp5`+counter+`" src="" alt="Add Image 5" /></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"><br></div>
                            <div class="col-md-12"><br><br></div>
                    `);
                    
                    ClassicEditor
                    .create( document.querySelector( '#product-des'+counter ) )
                    .catch( error => {
                    } );
                    
                    $('#sslogo'+counter).on('change', function(input) {
                        //alert('okk');
                        var fff = $('#sslogo'+counter).prop('files')[0];
                        if (fff) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#spp'+counter)
                                    .attr('src', e.target.result)
                                    .width(149)
                                    .height(149);
                            };
                            //var file = _('file1').files[0];
                            reader.readAsDataURL(fff);
                        }
                    });
                    $('#sslogo1'+counter).on('change', function(input) {
                        //alert('okk');
                        var fff = $('#sslogo1'+counter).prop('files')[0];
                        if (fff) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#spp2'+counter)
                                    .attr('src', e.target.result)
                                    .width(149)
                                    .height(149);
                            };
                            //var file = _('file1').files[0];
                            reader.readAsDataURL(fff);
                        }
                    });
                    $('#sslogo2'+counter).on('change', function(input) {
                        //alert('okk');
                        var fff = $('#sslogo2'+counter).prop('files')[0];
                        if (fff) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#spp3'+counter)
                                    .attr('src', e.target.result)
                                    .width(149)
                                    .height(149);
                            };
                            //var file = _('file1').files[0];
                            reader.readAsDataURL(fff);
                        }
                    });
                    $('#sslogo3'+counter).on('change', function(input) {
                       //alert('okk');
                        var fff = $('#sslogo3'+counter).prop('files')[0];
                        if (fff) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#spp4'+counter)
                                    .attr('src', e.target.result)
                                    .width(149)
                                    .height(149);
                            };
                            //var file = _('file1').files[0];
                            reader.readAsDataURL(fff);
                        }
                    });
                    $('#sslogo4'+counter).on('change', function(input) {
                        //alert('okk');
                        var fff = $('#sslogo4'+counter).prop('files')[0];
                        if (fff) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#spp5'+counter)
                                    .attr('src', e.target.result)
                                    .width(149)
                                    .height(149);
                            };
                            //var file = _('file1').files[0];
                            reader.readAsDataURL(fff);
                        }
                    });
                    }else { 
                        alert("error please fill all fields!"); 
                    }
                }
            }); 
        });
        
        /* for(i = 1; i < 20 ; i++){

            
      
        } */
</script>
<?php } ?>
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
<script>
    if(!$("#captcha").val()) {
	$("#captcha-info").html("(required)");
	$("#captcha").css('background-color','#FFFFDF');
	valid = false;
    }
    function refreshCaptcha() {
        $("#captcha_code").attr('src','captcha_code.php');
    }
</script>
<script>
    $(document).ready(function () {
        $("#cpass").keyup(checkPasswordMatch);
    });
    function checkPasswordMatch() {
        var password = $("#pass").val();
        var confirmPassword = $("#cpass").val();
        if (password == confirmPassword)
            $("#CheckPasswordMatch").html("Password match.");
        else
            $("#CheckPasswordMatch").html("Password does not match!");
    } 
</script>
<script>
    /* function validateForm(){ */
        $("#user-form").on('submit', function(e){
            e.preventDefault();
            var data = $(this).serialize();

        var x = document.forms["myForm"]["fname"].value;
        if (x == "") {
            alert("First Name must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["lname"].value;
        if (x == "") {
            alert("Last Name must be filled out");
            return false;
        }/* 
        var x = document.forms["myForm"]["gender"].value;
        if (x == "") {
            alert("Gender required");
            return false;
        } */
        var x = document.forms["myForm"]["companyname"].value;
        if (x == "") {
            alert("Company Name must be filled out");
            return false;
        }
        /* var x = document.forms["myForm"]["pan_no"].value; 
        if (x == ""){
            alert("PAN Number must be filled out");
            return false;
        } */
        
        var x = document.forms["myForm"]["phone"].value;
        var filter = /^\d*(?:\.\d{10})?$/;
        if (x == "") {
            alert("Phone Number must be filled out");
            return false;
        }
        if (filter.test(x) == false) {
            alert("Please Enter 10digit Valid Phone Number");
            return false;
        }
        if (x.length != 10) {
            alert("Please Enter 10digit Valid Phone Number");
            return false;
        }
        var x = document.forms["myForm"]["email"].value;
        if (x == "") {
            alert("Enter The Email");
            document.getElementById('email').focus();
            return false;
        } else {

            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (re.test(document.forms["myForm"]["email"].value) == false) {

                alert("Enter the Valid Email Address");
                document.forms["myForm"]["email"].focus();
                return false;
                
            }

        }
            var x = document.forms["myForm"]["pass"].value;
            var re = /^[a-zA-Z0-9]+$/;
            if (x == "") {
                alert("Password must be filled out");
                return false;
            }
            if (x.length < 8) {
                alert("Password Require Minimum 8 Characters.");
                return false;
            }
            /* if(re.test(x) == false){
                alert("Password Require Atleast 1 Number.");
                return false;
            } */

            var x = document.forms["myForm"]["cpass"].value;
            if (x == "") {
                alert("Confirm Password must be filled out");
                return false;
            }
            var x = document.forms["myForm"]["cpass"].value;
            var y = document.forms["myForm"]["pass"].value;
            if (x != y) {
                alert("Confirm Password must be same as password");
                return false;
            }
            var x = document.forms["myForm"]["user_type"].value;
            if (x == "") {
                alert("Choose Account Type");
                return false;
            }
            if (document.forms["myForm"]["terms"].checked == "") {
                alert("Please Select The Terms and Conditions");
                document.forms["myForm"]["terms"].focus();
                return false;
            }
            /* var response = grecaptcha.getResponse();
            if(response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<br><span style="color:red; font-weight: bold;">reCAPTHCHA required.</span>';
                return false;
            } */
            //console.log(data);
            $.ajax({
                method: 'POST',
                url: 'register-submit.php',
                crossDomain: true,
                data: data,
                dataType: 'json',
                success: function ( response ){ 
                        console.log(response);
                    if(response != ''){
                        if(response == "Failed to Registration"){
                            alert('Failed to Registration');
                        }
                        else{   

                                /* if (response == 'PAN/GST already exist') {
                                    alert('PAN/GST already exist');
                                }
                                else{ */
                                if(response == 'Email already exist'){
                                    alert('Email already exist');
                                }
                                else{
                                alert('Registration Success. Please Verify Your Email.');
                                //window.location.href = response;
                                console.log(response);
                                $('#save-form').attr("disabled","disabled");
                                $('#user-form').css("opacity",".5");
                                $('#save-form1').click();

                                document.getElementById('save-form').style.display = 'none';
                                document.getElementById('save-form1').style.display = 'block'; 
                                
                               /*  } */
                                }
                        }
                    } 
                }
            }); 
            
        });

</script>
<!-- <script>
    $("#company-info").on('submit', function(f){
        f.preventDefault();
        var data = $(this).serialize();
        var x = document.forms["company-form"]["type"].value;
        if (x == "") {
        alert("Select Product/Service Type");
        return false;
        }
        var x = document.forms["company-form"]["company_name"].value;
        if (x == "") {
            alert("Company Name must be filled out");
            return false;
        }
        var x = document.forms["company-form"]["street"].value;
        if (x == "") {
            alert("Address must be filled out");
            return false;
        }
        var x = document.forms["company-form"]["state"].value;
        if (x == "") {
            alert("State must be filled out");
            return false;
        }
        var x = document.forms["company-form"]["country1"].value;
        if (x == "") {
            alert("Country must be filled out");
            return false;
        }
        var x = document.forms["company-form"]["zip"].value;
        if (x == "") {
            alert("Zip Code must be filled out");
            return false;
        }
        var x = document.forms["company-form"]["company-des"].value;
        if (x == "") {
            alert("Company Description must be filled out");
            return false;
        }
        
    }/* ,
    submitHandler: function(f) {
        form.submit(); 
    } */ );
</script> -->
<script>
    $("#product-info").on('submit', function(g){
        g.preventDefault();
        var data = $(this).serialize();
        var x = document.forms["product-form"]["name"].value;
        if (x == "") {
        alert("Product/Service Name must be filled out");
        return false;
        }
        var x = document.forms["product-form"]["description"].value;
        if (x == "") {
            alert("Company Description must be filled out");
            return false;
        }
        var x = document.forms["product-form"]["price"].value;
        if (x == "") {
            alert("Price must be filled out");
            return false;
        }
        var x = document.forms["product-form"]["min-quantity"].value;
        if (x == "") {
            alert("Minimum Quantity must be filled out");
            return false;
        }
        var x = document.forms["product-form"]["photo"].value;
        if (x == "") {
            alert("Product Image Required.");
            return false;
        }
        
        
    },
    submitHandler: function(g) {
        form.submit();
    });
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#product-des' ) )
        .catch( error => {
            
        } );
</script>
<?php } 
    else{
        echo "<script>window.location='/';</script>";
    }

?>
