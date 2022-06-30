<?php 
session_start();
if($_SESSION['user_login'] == ""){

include("../db-connect/notfound.php");

$select_login="SELECT * FROM registration WHERE vendor_id='".$_GET['vendor_id']."'";

$res_login=mysqli_query($con,$select_login);
$num_login=mysqli_num_rows($res_login);
$fetch_login=mysqli_fetch_array($res_login);

$pkg = "Business Portal";
$pk = base64_encode($pkg);
//echo "package = ".$pk;
$vendor = $_GET['vendor_id'];
$bvendor = base64_encode($vendor);
//echo "vendor = ".$bvendor;
$email=$fetch_login['email'];
$bemail = base64_encode($email);
//echo "email = ".$bemail;
$firstname=$fetch_login['firstname'];
$bfirstname = base64_encode($firstname);
//echo "firstname = ".$bfirstname;
$lastname=$fetch_login['lastname'];
$blastname= base64_encode($lastname);
//echo "lastname = ".$blastname;
$street=$fetch_login['street'];
$bstreet= base64_encode($street);
//echo "street = ".$bstreet;
$city=$fetch_login['city'];
$bcity= base64_encode($city);
//echo "city = ".$bcity;
$state=$fetch_login['state'];
$bstate= base64_encode($state);
//echo "state = ".$bstate;
$zipcode=$fetch_login['zipcode'];
$bzipcode= base64_encode($zipcode);
//echo "zipcode = ".$bzipcode;

$qqq = $con->query("SELECT * FROM country where country_id= '".$fetch_login['country']."'");

$cntry = mysqli_fetch_array($qqq);

$country= $cntry['country_name'];
$bcountry= base64_encode($country);
//echo " country = ".$bcountry; 

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
        <title>Annex Trades | Payment Success</title>
        <link rel="icon" href="https://annextrades.com/assets/images/annexis-emblem.png" type="image/png">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
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
            background-image: url('https://annextrades.com/images/bg-business.jpg');
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
            #parent {
            display: flex;
            }
            #narrow {
            width: 30px;
            /* background: lightblue; */
            /* Just so it's visible */
            }
            #wide {
            flex: 1;
            /* Grow to rest of container */
            /* background: lightgreen; */
            /* Just so it's visible */
            }
            .main-div{
                left: 0%; 
                margin: 30px; 
                border: 1px solid #818192; 
                width: 100%;
            }
            @media only screen and (max-width: 600px) {
                .main-div{
                left: 23% !important; 
                margin: 30px; 
                border: 1px solid #818192; 
                width: 70% !important;
            }
            }

        </style>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div class="container">
            <div class="row no-gutter">
                <div class="d-none d-md-flex col-md-12 col-lg-12">
                    <div class="row imm">
                        <!-- <div class="col-md-12" style="padding: 30px;">
                            <p><a href="../"><img style="padding-bottom: 15px; width:250px;" src="https://annextrades.com/assets/images/logo.png" alt="" /></a></p>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="d-none d-md-flex col-md-12 col-lg-12">
                    <div class="col-md-12 justify-content-center text-center imm" style="padding-bottom: 30px;">
                        <div class="alert alert-success text-left alert-success" role="alert">
                            <strong style="color: #333;"> 
                                <i style="color: green;" class="fa fa-check"></i> &nbsp; Thank you for payment. Your account has been activated.
                            </strong>
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="d-none d-md-flex col-md-12 col-lg-12"> -->
                        <div class="col-md-12 d-flex d-md-flex imm text-center">
                            <div class="alert alert-light center main-div" role="alert">
                                <img src="https://annextrades.com/assets/images/thanku.jpg" style="width: 40%;" alt=""><br>
                                <h4 style="color: #4C0BD1; font-weight: 700; font-size: 34px; text-align: center;">Your trust means a lot to us.</h4>
                                <div style="font-size: 24px!important; line-height: 1.4;">
                                    <div class="text-center">Payment Successfully Processed. <br> Your account is now in <span style="color: #4C0BD1;">Active Status.</span></div>
                                    <div style="text-align: left !important;"><br>Note. New information submitted will be reviewed and posted live within 24 - 48 hours.
                                    <br><br><a href="../login.php" style="color: #ff7900;">Click here</a> to login.<br>
                                    <br>For questions, please contact Customer Services at 1(888) 614-2950 or <br> WhatsApp us at <a target="_blank" href="https://wa.me/+17728779454">1 (772) 877-9454</a><br></div>
                                </div>
                                <div  style="text-align: left !important; padding-top: 30px;">
                                    <a href="../"><img style="padding-bottom: 15px; width:250px;" src="https://annextrades.com/assets/images/logo.png" alt="" />
                                </div>
                                
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
    } 
    else{
        echo "<script>window.location='/';</script>";
    }
?>