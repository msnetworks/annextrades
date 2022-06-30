<?php
/******************************************************************************
#                      PHP Authorize.net Payment Terminal v2.3
#******************************************************************************
#      Author:     CriticalGears
#      Email:      info@criticalgears.io
#      Website:    http://www.criticalgears.io
#
#
#      Version:    2.3
#      Copyright:  (c) 2012 - CriticalGears.io
#      
#*******************************************************************************/
	
	//REQUIRE CONFIGURATION FILE
	require ("includes/config.php"); //important file. Don't forget to edit it!
    require ("includes/authorizenet.class.php");
    $subid = (!empty($_REQUEST["subid"]))?strip_tags(str_replace("'","`",$_REQUEST["subid"])):'';
    $iagree = (!empty($_REQUEST["iagree"]))?strip_tags(str_replace("'","`",$_REQUEST["iagree"])):'';
    $mess = "";
    $error=0;
    if(isset($_POST["process"]) && !empty($_POST["process"]) && $_POST["process"]=="yes"){
        if(!empty($iagree) && $iagree=="yes"){
            $arb_request =
                "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
                "<ARBCancelSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
                "<merchantAuthentication>".
                "<name>" . MERCHANT_LOGIN . "</name>".
                "<transactionKey>" . MERCHANT_TRAN_KEY . "</transactionKey>".
                "</merchantAuthentication>" .
                "<subscriptionId>" . $subid . "</subscriptionId>".
                "</ARBCancelSubscriptionRequest>";
            $arb_response = send_request_via_curl(ARBHOST,ARBPATH,$arb_request);
            //if curl is unavilable you can try using fsockopen
            //$arb_response = send_request_via_fsockopen(ARBHOST,ARBPATH,$arb_request);
            //if the connection and send worked $response holds the return from Authorize.net
            if ($arb_response)
            {
                    /*
                a number of xml functions exist to parse xml results, but they may or may not be avilable on your system
                please explore using SimpleXML in php 5 or xml parsing functions using the expat library
                in php 4
                parse_return is a function that shows how you can parse though the xml return if these other options are not avilable to you
                */
                list ($resultCode, $code, $text, $subscriptionId) =parse_return($arb_response);

                if(strtolower(substr($code,0,1))=="e"){

                    $my_status="<div>Cancellation Un-successful!<br/>";
                    $my_status .=$subscriptionId."<br />";
                    //$my_status .="Response Code: ".$resultCode."<br />";
                    $my_status .="Response Reason Code: ".$code."<br />";
                    $my_status .="Response Text: ".$text."<br /><br />";
                    $error=0;
                    $mess = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">'.$my_status.'</div></div><br />';

                } else {

                    $my_status="<br/><div>Subscription Cancelled!<br/>";
                    $my_status .="Subscripton ID ".$subid." is now cancelled.<br /><br />";
                    $my_status .="Gateway Response:<br />";
                    //$my_status .="Response Code: ".$resultCode."<br />";
                    $my_status .="Response Reason Code: ".$code."<br />";
                    $my_status .="Response Text: ".$text."<br /><br />";
                    $my_status .= "<a href='index.php'>Return to payment page</a></div><br/>";
                    $error=1;
                    $mess = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">'.$my_status.'</div></div><br />';

                }

            }   else    {
                $my_status="<div>Cancellation Un-successful!<br/>";
                $my_status .="There was an error with your subscription cancellation.<br/>Please contact us directly to cancel your subscription<br/>";
                $error=0;
                $mess = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">'.$my_status.'</div></div><br />';
            }
        } else {
            $my_status="<div>Error!<br/>";
            $my_status .="You need to put a checkmark next to confirmation checkbox in order to proceed with cancellation.<br/>";
            $error=0;
            $mess = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">'.$my_status.'</div></div><br />';
        }
        
    }

    if(empty($subid)){
        $my_status="<div>Empty subscription ID!<br/>";
        $my_status .="There was an error with your subscription cancellation.<br/>You did not pass subscription ID to this page<br/>";
        $error=1;
        $mess = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">'.$my_status.'</div></div><br />';
    }

    //REQUIRE SITE HEADER TEMPLATE
	require "includes/site.header.php";
?>
<div align="center" class="wrapper">
    <div class="form_container">
    	<h1>Authorize.net Payment Terminal</h1>
        <form id="ff1" name="ff1" method="post" action="" enctype="multipart/form-data"  class="pppt_form">
            <input type="hidden" value="yes" name="process" />
            <input type="hidden" value="<?php echo $subid?>" name="subid" />
            <?php echo $mess; ?>
            <div id="accordion">
                <!-- we're not showing form for this one -->
                <?php if((empty($mess) && !empty($subid)) || $error==0){?>
                <div class="pane">
                    <p>Subscription ID: <?php echo $subid?></p>
                    <input type="checkbox" name="iagree" value="yes"/> I understand that clicking submit will cancel above mentioned service
                    <div class="submit-btn"><input src="images/btn_submit.jpg" type="image" name="submit" /></div>
                </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>
<?php require "includes/site.footer.php"; ?>