<?php
/******************************************************************************
 * #                      PHP Authorize.net Payment Terminal v2.3
 * #******************************************************************************
 * #      Author:     CriticalGears
 * #      Email:      info@criticalgears.io
 * #      Website:    http://www.criticalgears.io
 * #
 * #
 * #      Version:    2.3
 * #      Copyright:  (c) 2012 - CriticalGears.io
 * #
 * #*******************************************************************************/

//REQUIRE CONFIGURATION FILE
require( "includes/config.php" ); //important file. Don't forget to edit it!
//DEFAULT PARAMETERS FOR FORM [!DO NOT EDIT!]
$show_form = 1;
$mess      = "";
//REQUEST VARIABLES
$item_description     = ( ! empty( $_REQUEST["item_description"] ) ) ? esc_str( $_REQUEST["item_description"] ) : '';
$amount               = doubleval( $_REQUEST["amount"] );
$fname                = ( ! empty( $_REQUEST["fname"] ) ) ? esc_str( $_REQUEST["fname"] ) : '';
$lname                = ( ! empty( $_REQUEST["lname"] ) ) ? esc_str( $_REQUEST["lname"] ) : '';
$email                = ( ! empty( $_REQUEST["email"] ) ) ? esc_str( $_REQUEST["email"] ) : '';
$address              = ( ! empty( $_REQUEST["address"] ) ) ? esc_str( $_REQUEST["address"] ) : '';
$city                 = ( ! empty( $_REQUEST["city"] ) ) ? esc_str( $_REQUEST["city"] ) : '';
$country              = ( ! empty( $_REQUEST["country"] ) ) ? esc_str( $_REQUEST["country"] ) : 'US';
$state                = ( ! empty( $_REQUEST["state"] ) ) ? esc_str( $_REQUEST["state"] ) : '';
$zip                  = ( ! empty( $_REQUEST["zip"] ) ) ? esc_str( $_REQUEST["zip"] ) : '';
$service              = intval( $_REQUEST['service'] );
$g_recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? esc_str( $_POST['g-recaptcha-response'] ) : "0";

//FORM SUBMISSION PROCESSING
if ( ! empty( $_POST["process"] ) && $_POST["process"] == "yes" ) {
	$captcha = false;
	if ( $enableReCaptcha ) {
		$ch = curl_init();

		curl_setopt_array($ch, [
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' => $reCaptcha_secretKey,
				'response' => $g_recaptcha_response,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			],
			CURLOPT_RETURNTRANSFER => true
		]);

		$output = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($output, true);
		if ( $response["success"] === true ) {
			$captcha = true;

		} else {
			$mess = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error!</strong> Incorrect captcha entered</p></div></div><br />';
		}
	} else {
		$captcha = true;
	}
	if ( $captcha ) {
		require( "includes/form.processing.php" );
	}
}
//REQUIRE SITE HEADER TEMPLATE
require "includes/site.header.php";
?>
<?php if ( $enableReCaptcha ) { ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>

<?php
    require "../db-connect/notfound.php";
    $query = mysqli_query($con, "SELECT * FROM registration WHERE vendor_id = '".$_POST['vndor']."'");
    $fetch = mysqli_fetch_array($query);
    
    $cntry = mysqli_query($con, "SELECT * FROM country WHERE country_id = '".$fetch[country]."' ");
    $cunty = mysqli_fetch_array($cntry);
    $country = $cunty['country_name'];
?>

<!-- <h1>Authorize.net Payment Terminal</h1> -->
        <div class="container-fluid">            
            <div class="row">
                <div class="col-md-6 m-30">
                    <div align="center" class="wrapper">
                        <?php include "includes/javascript.validation.php"; ?>
                            <div class="form_container">
                                <a href="https://annextrades.com"><img style="width: 50%; margin-bottom:30px;"  src="../assets/images/logo.png" alt="AnnexTrdes"></a>
                                <?php echo $mess; ?>
                                <form id="ff1" name="ff1" method="post" action="" enctype="multipart/form-data"
                                onsubmit="return <?php if($enableReCaptcha){?> false <?php }else{?>checkForm();<?php } ?>"
                                class="pppt_form">
                                <div id="accordion">
                                    <?php if ( $show_form ) { ?>
                                        <!-- PAYMENT BLOCK -->
                                        <h2 class="current">Payment Information</h2>
                                        <div class="pane" style="display:block">
                                            <?php if ( $show_services || $payment_mode == "RECUR" ) {
                                                echo "<label>Price ($): </label>"; ?>
                                                <input name="service" id="item_description" type="text" class="long-field"
                                                    value="<?php echo sanitize('1'); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                                <?php
                                                /* <select name='service' id='service' class='long-field' onchange='checkFieldBack(this)' readonly/>";
                                                switch ( $payment_mode ) {

                                                    case"ONETIME":
                                                        //IF services specified in config file - we show services.
                                                        foreach ( $services as $k => $v ) {
                                                            echo "<option value='" . $k . "' " . ( $service == $k ? "selected" : "" ) . ">" . $v[0] . " ($" . number_format( $v[1], 2 ) . ")" . "</option>";
                                                        }
                                                        echo "</select><div class='clr'></div>";
                                                        break;
                                                    case"RECUR":
                                                        //IF services specified in config file - we show services.

                                                        foreach ( $recur_services as $k => $v ) {
                                                            echo "<option value='" . $k . "' " . ( $service == $k ? "selected" : "" ) . ">" . $v[0] . " ($" . number_format( $v[1], 2 ) . ")" . "</option>";
                                                        }
                                                        echo "</select><div class='clr'></div>";

                                                        break;
                                                } */ ?>
                                            
                                            <?php } else { ?>
                                                <label>Description:</label>
                                                <input name="item_description" id="item_description" type="text" class="long-field"
                                                    value="<?php echo sanitize( $item_description ); ?>"
                                                    onkeyup="checkFieldBack(this);"/>
                                                <div class="clr"></div>
                                                <label>Amount:</label>
                                                <input name="amount" id="amount" type="text" class="small-field"
                                                    value="<?php echo $amount; ?>" onkeyup="checkFieldBack(this);noAlpha(this);"
                                                    onkeypress="noAlpha(this);"/>
                                                <div class="clr"></div>
                                            <?php } ?>
                                        </div>
                                        <!-- PAYMENT BLOCK -->


                                        <!-- BILLING BLOCK -->
                                        <h2>Billing Information</h2>
                                        <div class="pane">
                                            <label>First Name:</label>
                                            <input name="fname" id="fname" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['firstname'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <label>Last Name:</label>
                                            <input name="lname" id="lname" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['lastname'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <label>Address:</label>
                                            <input name="address" id="address" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['street'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <label>City:</label>
                                            <input name="city" id="city" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['city'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <label>Country:</label>
                                            <input name="country" id="country" type="text" class="long-field"
                                                value="<?php echo sanitize( $country ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <!-- <label>Country:</label>
                                            
                                            <!- - <div class="clr"></div> -->
                                            
                                            <label>State/Province:</label>
                                            <input name="state" id="state" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['state'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>
                                            
                                            <div class="clr"></div>
                                            <label>ZIP/Postal Code:</label>
                                            <input name="zip" id="zip" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['zipcode'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>

                                            <label>E-mail:</label>
                                            <input name="email" id="email" type="text" class="long-field"
                                                value="<?php echo sanitize( $fetch['email'] ); ?>" onkeyup="checkFieldBack(this);" readonly/>
                                            <div class="clr"></div>
                                        </div>
                                        <!-- BILLING BLOCK -->


                                        <!-- CREDIT CARD BLOCK -->
                                        <h2>Credit Card Information</h2>
                                        <div class="pane">
                                            <label> I have:</label>
                                            <span class="card-cont">
                                        <input name="cctype" type="radio" value="V" class="lft-field"/> <img src="images/ico_visa.jpg"
                                            align="absmiddle" class="lft-field cardhide V"/>
                                        </span>
                                            <span class="card-cont">
                                        <input name="cctype" type="radio" value="M" class="lft-field"/> <img src="images/ico_mc.jpg"
                                            align="absmiddle" class="lft-field cardhide M"/>
                                        </span>
                                                <span class="card-cont">
                                        <input name="cctype" type="radio" value="A" class="lft-field"/> <img src="images/ico_amex.jpg"
                                            align="absmiddle"
                                        class="lft-field cardhide A"/>
                                        </span>
                                                <span class="card-cont">
                                        <input name="cctype" type="radio" value="D" class="lft-field"/> <img src="images/ico_disc.jpg"
                                            align="absmiddle"
                                        class="lft-field cardhide D"/>
                                        </span>
                                            <?php if ( $enable_paypal ) { ?>
                                                <span class="card-cont">
                                        <input name="cctype" type="radio" value="PP" class="lft-field isPayPal"/> <img
                                            src="images/ico_paypal.png" width="37" height="11" align="absmiddle"
                                        class="lft-field paypal cardhide PP"/>
                                        </span>
                                            <?php } ?>
                                            <div class="clr"></div>
                                            <div class="ccinfo">
                                                <label>Card Number:</label>
                                                <input name="ccn" id="ccn" type="text" class="long-field"
                                                    onkeyup="checkNumHighlight(this.value);checkFieldBack(this);noAlpha(this);"
                                                    value=""
                                                    onkeypress="checkNumHighlight(this.value);noAlpha(this);"
                                                    onblur="checkNumHighlight(this.value);"
                                                    onchange="checkNumHighlight(this.value);" maxlength="16"/>
                                                <span class="ccresult"></span>
                                                <div class="clr"></div>

                                                <label>Name on Card:</label>
                                                <input name="ccname" id="ccname" type="text" class="long-field"
                                                    onkeyup="checkFieldBack(this);"/>
                                                <div class="clr"></div>

                                                <label>Expiration Date:</label>
                                                <select name="exp1" id="exp1" class="small-field" onchange="checkFieldBack(this);">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <select name="exp2" id="exp2" class="small-field" onchange="checkFieldBack(this);">
                                                    <?php echo getActualYears(); ?>
                                                </select>
                                                <div class="clr"></div>

                                                <label>CVV:</label>
                                                <input name="cvv" id="cvv" type="text" maxlength="5" class="small-field"
                                                    onkeyup="checkFieldBack(this);noAlpha(this);"/>
                                                <a href="hint.php" rel="hint" class="noscriptCase">
                                                    <img src="images/ico_question.jpg" align="absmiddle" border="0"/></a>
                                                <noscript>
                                                    <a href="hint.php" target="_blank"><img src="images/ico_question.jpg"
                                                                                            align="absmiddle" border="0"/></a>
                                                </noscript>
                                                <div class="clr"></div>
                                            </div>


                                            <?php if ( $enableReCaptcha ) { ?>
                                                <div class="g-recaptcha" data-sitekey="<?php echo( $reCaptcha_siteKey ) ?>"
                                                    data-callback="checkCaptcha"></div>
                                            <?php } ?>

                                            <div class="submit-btn">
                                                <input src="images/btn_submit.jpg" type="image" name="submit"
                                                    <?php if ( $enableReCaptcha ){ ?>disabled<?php } ?>/>
                                            </div>
                                            <input type="hidden" name="process" value="yes"/>
                                        </div>
                                        <!-- CREDIT CARD BLOCK -->
                                    <?php } ?>

                                </div>
                            </form>
                        </div>    
                    </div>
                </div>    
                <div class="col-md-6" style="padding: 30px;">
                    <div class="form_container">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 style="color: #ff7900;">Membership Subscription</h3>
                                <p>Yearly fee.</p>
                                
                            </div>
                            <div class="col-md-4 text-right" style="margin-top: 10px;">
                                <h6>SHOW PRICE DETAILS <i class="fa fa-angle-down"></i></h6>
                                <h3><b>$298.97</b></h3>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="">
                                <p class="pull-right text-right">
                                    <p style="font-size: 12px;"><b>Taxes & Fees (estimated)</br><font style="font-size: 14px;">Total amount of your booking</font></b></p>
                                    </font>
                                    <div class="">
                                        <p class="pull-right text-right">
                                            <b>$17.94<br><font style="font-size: 14px;">$316.91</font></b>
                                        </p></font>
                                    </div>
                                </p>
                            </div>
                        </div> -->
                        <div class="row" style="font-size: 12px; padding-left: 15px;">
                            <div class="col-md-12">
                                <div >
                                    <p class="pull-left text-left"><b>Taxes & Fees (estimated)</br>
                                        <font style="font-size: 14px;">Total amount of your booking</font></b>
                                    </p>
                                    
                                </div>
                                <div class="">
                                    <p class="pull-right text-right"><b>$17.94
                                        <br><font style="font-size: 14px;">$316.91</font></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="background: #ccc;">
                            <p style="padding-left: 15px; font-size: 18px;">Payment will be processed after the 30 Day Trail Period</p>
                        </div>
                        <div class="col-md-12 p-0" style="margin-bottom: 15px;">
                            <a href="#">
                                <font style="display: inline; color: #ff7900;">
                                    <img style="width:20px;" src="images/security-icon.png" alt=""> 
                                    Add an U.S. Address (recommended)
                                </font>
                            </a>
                        </div>
                        <form id="my_radio_box" name="prc" >
                        <div class="col-md-12 p-0" style="background: #ff790042;">
                            <label style="padding-left: 15px; font-size: 18px; display: inline;">
                                <input type="radio" name="add_amt" id="add_amt" onclick="newrate(this)" value="59"> Yes, add an U.S. Address = $59/mo
                            </label>
                            
                        </div>  
                        <div class="col-ms-12">
                            <div style="padding: 30px 20px 0px 30px; font-family: 'Montserrat';">
                                <p><i style="color:green;" class="fa fa-check"><b><font style="font-family: 'Montserrat'; color:#333; padding-left: 10;"> Provide a U.S. address for customer returns</font></i></b></p>
                                <p><i style="color:green;" class="fa fa-check"><b><font style="font-family: 'Montserrat'; color:#333; padding-left: 10;"> Build confidence with Buyers</font></i></b></p>
                                <p><i style="color:green;" class="fa fa-check"><b><font style="font-family: 'Montserrat'; color:#333; padding-left: 10;"> Mail handling for your business with mail scanning</font></b></i></p>
                            </div>
                        </div>
                        <div class="col-md-12 p-0" style="">
                            <label style="padding-left: 15px; display: inline;">
                                <input type="radio" name="add_amt" value="0" id=""> No, I decline protection and accept responsibility for damage.
                            </label>
                        </div>
                        <div class="col-md-12" style="padding-top: 15px;">
                            <div>
                                <h4 class="pull-left text-left"><b>Total Amount after Trail:</b></h4>
                                <h4 class="h4ull-right text-right">$<input type="text"  name="rate" value="316.91"  id="newrate" style="border: 0; text-align: right; outline: none; width: 70px;" readonly></h4>
                            </div>
                        </div>
                        <div class="col-12" style="padding-top: 15px; background: #f5f5f5;">
                            <h5 style="color:#ff7900;">Important things to note:</h5>
                            <ul style="padding-inline-start: 15px;">
                                <li>
                                    Only a verification will be performed for security and identify purposes at this time.
                                </li>
                                <li>
                                    Payment listed above will be charge to your credit or debit card at the completion of the trail period automatically.
                                </li>
                                <li>
                                    You may cancel this subscription at any time prior to trail period without penalty.
                                </li>
                            </ul>
                            <p>By clicking Submit, I acknowledge that I have read and accept the 
                                <a style="color:#ff7900;" href="#">Terms of Use</a> and <a style="color:#ff7900;" href="#">Privacy Policy.</a> I also my receive
                                 notifications about other services and benefits available of AnnexTrades.com</p>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
			
            function newrate(){
                var x = document.getElementById('add_amt').value;
                        if (x == '316.91') {
                            document.getElementById('newrate').value = '375.91';
                        } else {
                            
                        }
                    }
                /* $('#my_radio_box').change(function(){
                    selected_value = $("input[name='add_amt']:checked").val();
                    alert(selected_value);
                    document.forms['ff1']['service'].value('366.91');
                });
            
            }); */
        
        </script>


<?php /* require "includes/site.footer.php" */; ?>
