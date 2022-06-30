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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

            #progressbar li {
                list-style-type: none;
                font-size: 15px;
                width: 33.33%;
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
                content: "\f0e0"
            }

            #progressbar #payment:before {
                font-family: FontAwesome;
                content: "\f0d6"
            }

            #progressbar #confirm:before {
                font-family: FontAwesome;
                content: "\f093"
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
        <?php 

            if (@$_GET['vendor_id'] != '' ){
                $email_verify = mysqli_query($con, "SELECT * FROM registration Where vendor_id='".@$_GET['vendor_id']."' ");
                $row = mysqli_fetch_array($email_verify);
                
                if ($row['email_verify'] == 'Verified') { ?>
                <script>
                    window.onload=function(){
                    var b1 = $("#save-form1"), b2 = $("#next2"), b3 = $("#next3");
                    b1.add(b2).click();
                    };
                </script> 
                <?php
                }elseif ($row['email_verify'] != "Verified" or $row['email_verify'] == 'Verified') { ?>
                    <script>
                    window.onload=function(){
                        $('#save-form1').click();
                };
                </script>
                <?php
             }
            }
        ?>
        <div class="container-fluid">
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
                        <!-- <script>
                            $(document).ready(function(){
                            $('#save-form1').click();
                            });
                        </script> -->
                        <?php
                    }
                    
                ?>
                <div class="col-md-12" style="/* max-height: 100vh; overflow: scroll; */">
                    <div class="container">
                        <div class="login d-flex align-items-center">
                            <!-- <div class="row col-12  justify-content-center"> -->
                                <div class="row col-12 col-sm-12 col-md-12 col-lg-10 col-xl-12 text-center p-0 mt-3 mb-2">
                                    <div class="card col-12 px-0 pt-4 pb-0 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <a class="text-left" href="/"><img style="padding-bottom: 15px; width:40% " src="https://annextrades.com/assets/images/logo.png" alt="" /></a>
                                        </div>

                                        <?php 
                                            
                                        if (@$_GET['vendor_id'] == '' OR  $vndr_id == "") {

                                        ?>
                                        <div class="col-md-6 text-right">
                                            <h6 id="heading">Already have an account</h6>
                                            <a style="color: #fff;" href="../mydashboard/"><button class="action-button" style="padding: 5 10; background: #ff7900; border:0; color:#fff;">Sign In</button></a>
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
                                            <a style="color: #fff;" href="../mydashboard/"><button class="action-button" style="padding: 5 10; background: #ff7900; border:0; color:#fff;">Sign In</button></a>
                                            <a href="../mydashboard/auth/forget_password.php">Forgot your password?</a>
                                        </div>
                                        < ?php } ?> -->
                                    </div>
                                        <div id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar">
                                                <li class="active" id="account"><strong>Account</strong></li>
                                                <li id="personal"><strong>Verification</strong></li>
                                                <!-- <li id="payment"><strong>Payment</strong></li> -->
                                                <li id="confirm"><strong>Publish</strong></li>
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
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 1 - 3</h2>
                                                        </div>
                                                    </div> 
                                                    <?php if(isset($_REQUEST['err'])) { ?>
                                                        <div class="error"><?php echo $email_aready; ?></div>
                                                    <?php } ?><!-- onSubmit="return validate1_form();"  onsubmit="return validateForm()"-->
                                                    
                                                    <form id="user-form" name="myForm">
                                                        <div class="row ">
                                                            <div class="col-md-6">
                                                                <div class="ss-item-required">
                                                                    <div class="form-label-group">
                                                                        <input type="text" name="package" id="package" value="<?php echo "BusinessPortal"; ?>" hidden/>
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
                                                            <div class="col-md-12" style="font-size: 16px;">
                                                                <div style="border: 1px solid #ccc; background-color: #ECEFF1; padding: 8px 15px 8px 15px; margin-bottom: 25;">
                                                                    <label for="gender" style="padding-right: 20px;  margin-bottom: 0;"><b>Gender*</b></label>
                                                                    <label style="padding-right: 20px;  margin-bottom: 0;" for="gender-male"><input type="radio" class="w-auto m-0" name="gender" value="Male" id="gender-male" <?php if($r['gender'] == 'Male'){echo 'readonly checked';}?>>&nbsp; Male</label>&nbsp; &nbsp;
                                                                    <label style="padding-right: 20px;  margin-bottom: 0;" for="gender-female"><input type="radio" class="w-auto m-0" name="gender" value="Female" id="gender-female" <?php if($r['gender'] == 'Female'){echo 'readonly checked';}?>>&nbsp; Female</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="companyname" id="companyname" value="<?php echo $r['companyname']; ?>" placeholder="Company Name *" <?php if($r['companyname'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="checkPan"></span>
                                                                    <input type="text" name="pan_no" id="pan_no" value="<?php echo $r['pan_no']; ?>" placeholder="PAN/GST *" <?php if($r['pan_no'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <textarea type="text" name="street" id="street"  placeholder="Address *" <?php if($r['street'] != ''){echo 'readonly';}?>><?php echo $r['street']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="city" id="city" value="<?php echo $r['city']; ?>" placeholder="City *"  <?php if($r['city'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="state" id="state" value="<?php echo $r['state']; ?>" placeholder="State *"  <?php if($r['state'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <select name="country1" id="country1"  <?php if($r['country'] != ''){echo 'readonly';}?>>
                                                                    <?php if($r[country != '']){ ?>
                                                                        <option value="<?php echo $r['country']; ?>"> <?php echo $countryy; ?></option>
                                                                    <?php }else{ ?>
                                                                    <option value="">Country</option>
                                                                    <?php 
                                                                        $select_country="SELECT * FROM country";
                                                                        $res_country=mysqli_query($con,$select_country);
                                                                        while($fet_country=mysqli_fetch_array($res_country))
                                                                        {
                                                                    ?>
                                                                    <option value="<?php echo $fet_country['country_id']; ?>">
                                                                        <?php echo $fet_country['country_name']; ?></option>
                                                                    <?php }} ?>

                                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group">
                                                                    <input type="int" name="zip" id="zip" value="<?php echo $r['zipcode']; ?>" placeholder="Zip Code *"  <?php if($r['zipcode'] != ''){echo 'readonly';}?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="phone" id="phone" value="<?php echo $r['phonenumber']; ?>" placeholder="Phone *" <?php if($r['phonenumber'] != ''){echo 'readonly';}?>/>
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
                                                                    <!--?php
                                                                        if (@$_GET['package'] == 'BusinessPortal' & @$_GET['source'] != 'BusinessPortal') {
                                                                    ?-->       
                                                                    <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type1" value="Buyer" class="w-auto m-0" <?php if($r['usertype'] == 'Buyer'){echo 'readonly checked';}?>>&nbsp; Buyer:&nbsp;<b> Buy Products and Services </b></label>
                                                                    <!--?php
                                                                        }
                                                                    ?-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 input-group">
                                                                <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;">
                                                                    <input type="checkbox" name="terms" class="w-auto" id="terms" <?php if($r['vendor_id'] != ''){echo 'readonly checked';}?>/> I agree to all <!-- Annexis --> <a href="https://www.annexis.net/terms-amp-condition/" target="_blank">Terms & Condition</a> and
                                                                    <a href="https://www.annexis.net/privacy-policy/" target="_blank">Privacy Policy</a>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12 input-group">
                                                                <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;">
                                                                    <input type="checkbox" name="newsletter" class="w-auto" id="newsletter" value="yes" <?php if($r['newsletter_option'] == 'yes'){echo 'readonly checked';}?>/>
                                                                    I would like to receive newsletters and directory magazines.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if(@$_GET['vendor_id'] == ''){ ?>
                                                        <input type="submit" name="submit"  id="save-form" class="action-button" value="REGISTER" />
                                                    <?php }else{ ?>
                                                        <!-- <script>
                                                            window.onload=function(){
                                                                $('#save-form1').click();
                                                            };
                                                        </script> -->
                                                        <input type="button" name="submit" id="save-form1" class="next action-button" value="NEXT" />
                                                    <?php } ?>
                                                </form>
                                                <input type="Button"   id="save-form1" class="Next action-button" style="display:none;" value="NEXT" />
                                            </fieldset>
                                            
                                            <fieldset>
                                                <div class="form-card">
                                                    
                                                        <?php 
                                                            $email_verify = mysqli_query($con, "SELECT * FROM registration Where vendor_id='".@$_GET['vendor_id']."' ");
                                                            $row = mysqli_fetch_array($email_verify);
                                                            $email_status = $row['email_verify'];
                                                            if (@$email_status == "Verified") { ?>
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <h2 class="fs-title">Email Verification:</h2>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h2 class="steps">Step 2 - 3</h2>
                                                                    </div>
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
                                                            <input type="button" name="nexsubmitt" id="next2" class="next action-button" value="NEXT" />
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
                                                                    <h2 class="steps">Step 2 - 3</h2>
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
                                                        </div> 

                                                        <input type="button" name="nexsubmitt" style="opacity: 5;" onclick="alert('Please Verify Email.');"  class="action-button" value="NEXT" disabled/>

                                                        <!-- <input type="button" name="previous" id="back2" class="previous action-button-previous" value="Previous" /> -->
                                                    <?php } ?>
                                                <!-- <input type="button" name="previous" id="back2" class="previous action-button-previous" value="Previous" /> -->
                                            </fieldset>
                                            <!-- <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Payment Information:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 3 - 4</h2>
                                                        </div>
                                                    </div>
                                                
                                                    <?php if ($row['payment'] == 'No') { ?>
                                                    <form action="../authorize-terminal/?package=<?php echo $_GET['package'];?>" method="POST" name="myform1">
                                                        <div class="row" style="padding: 30px;">
                                                            <div class="col-12" style="align-items: center;">
                                                                <center>
                                                                    <div style="height: 100; width: 60%; margin-bottom:25px;">
                                                                        <label for="authorize">
                                                                            <img src="https://annextrades.com/assets/images/imageaut.jpg" style="width:60%" id="authorize" alt="Annexis Payment">
                                                                            <input type="radio" id="authorize" style="height: 25px;" value="authorize" name="payment" required>
                                                                        </label>
                                                                    </div>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                        
                                                        <input type="text" name="vndor" value="<?php echo @$_GET['vendor_id']; ?>" hidden/><br><br>
                                                        <input type="submit" Value="Payment"  class="action-button">
                                                        <!- - <input type="button" name="previous" id="back3" class="previous action-button-previous" value="Previous" /> - ->
                                                    </form>
                                                    <?php }else{?>
                                                        <h4 class="text-center" style="color: #28a745!important;"><strong>Payment Info Successfully Completed</strong></h4> <br>
                                                        <div class="row justify-content-center">
                                                            <div class=""> <img src="https://annextrades.com/assets/images/loading2.gif" class="w-75"> </div>
                                                        </div>
                                                        <h4 class="text-center" style="color: black;"><strong><font style="font-size:24px;">You're almost done, Keep up the good work...</font> 
                                                        <br><font style="font-size: 19px;">Select <span style="color:#673AB7;">NEXT</span> to now add your Company and Product Detail.</font></strong></h4> <br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-7 text-center">
                                                                <h5 class="purple-text text-center"></h5>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    <input type="button" name="next3" id="next3" class="next action-button" value="NEXT" />
                                                    <?php } ?>
                                                <!- - <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> - ->
                                            </fieldset> -->
                                            <fieldset>
                                                <div class="form-card">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="fs-title">Publish:</h2>
                                                        </div>
                                                        <div class="col-5">
                                                            <h2 class="steps">Step 3 - 3</h2>
                                                        </div>
                                                    </div> <br><br>
                                                    <h4 class="purple-text text-center" style="font-size:30px;">You will now be re-routed to our Business Portal Site <br>
                                                    <span style="color: #ff7900;">www.ANNEXTrades.com</span> to add your <br> Company & Product or Service Details
                                                    </h4> <br>
                                                    <h4 class="text-center" style="color: black; font-size:25px;">Select The <span class="purple-text"><b>PUBLISH</b></span> button 
                                                    to Sign-In using email and <br> password used to create account and access your user dashboard.
                                                    </h4> <br>
                                                    <!-- <div class="row justify-content-center">
                                                        <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                                    </div> <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                            <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                                            <h5 class="purple-text text-center"><a style="color: #ff7900;" href="../mydashboard/">Click Here For Login</a></h5>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <button class="action-button" ><a style="color:#fff;" href="https://annextrades.com/login.php?source=publish">PUBLISH</a></button>
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
        <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

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
        }
        var x = document.forms["myForm"]["gender"].value;
        if (x == "") {
            alert("Gender required");
            return false;
        }
        var x = document.forms["myForm"]["companyname"].value;
        if (x == "") {
            alert("Company Name must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["pan_no"].value;
        if (x == "") {
            /* $.ajax({
                method: 'GET',
                url: 'check_pan.php',
                data: 'pan_no='+x,
                dataType: 'json',
                success: function ( resp ){ 
                    if(resp == "exist"){
                        alert("PAN Number already exist.");
                        return false;
                        console.log(resp);
                    }
                }
                });
            
        }
        else { */
            alert("PAN Number must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["street"].value;
        if (x == "") {
            alert("Address must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["state"].value;
        if (x == "") {
            alert("State must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["country1"].value;
        if (x == "") {
            alert("Country must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["zip"].value;
        if (x == "") {
            alert("Zip Code must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["phone"].value;
        if (x == "") {
            alert("Phone Number must be filled out");
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
                /* $.ajax({
                method: 'GET',
                url: 'check_email.php',
                data: 'email='+x,
                dataType: 'json',
                success: function ( resp ){ 
                    if(resp == "exist"){
                        //$("#checkEmail").html("Email already exist.");
                        alert("Email already exist.");
                        //colsole.log(resp);
                        return false;
                    }
                }
                }); */
            }
            /* else{
            alert("Enter the Valid Email Address");
            document.forms["myForm"]["email"].focus();
            return false;
            } */


        }
            var x = document.forms["myForm"]["pass"].value;
            if (x == "") {
                alert("Password must be filled out");
                return false;
            }
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
            //console.log(data);
            $.ajax({
                method: 'POST',
                url: 'register-submit.php',
                data: data,
                dataType: 'json',
                success: function ( response ){ 
                    if(response != ''){
                        console.log(response);
                        if(response == "failed"){
                            alert('Failed to Registration');
                        }
                        else{ 
                            if (response != 'PAN/GST already exist') {
                             
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
                                
                                }
                            }else{
                                alert('PAN/GST already exist');
                            }    
                        }
                    } 
                }
            }); 
            
        });

</script>

<?php } 
    else{
        echo "<script>window.location='/';</script>";
    }

?>
