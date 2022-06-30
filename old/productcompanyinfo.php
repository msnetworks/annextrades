<?php
$pagename = "Product Detail";
include("includes/new/header-inner-pages.php");
include("Zoomer/link.php");
require 'Twilio/autoload.php';
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/OAuth.php';
 
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'welcome@annextrades.com';                     //SMTP username
$mail->Password   = 'Justdoit17$$';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;
//include('smtpdetails.com');

$http = $_SERVER['REQUEST_SCHEME'];
$host = $_SERVER['HTTP_HOST'];
$base_dir  = __DIR__;
$doc_root  = ($_SERVER["DOCUMENT_ROOT"]);
$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir);
$directoryUrl = $http . "://" . $host . $base_url . "/company_images/";

$directoryUrl = str_replace('/admin', '', $directoryUrl);
define('directoryUrl', $directoryUrl);


if ($_GET['insertReview'] == "yes") {
    $reviewAddedText = "You review has been added.";
} elseif ($_GET['insertReview'] == "no") {
    $reviewAddedText = "You review has not been added.";
    /* var_dump($con, $insertReview); */
}

if (isset($_REQUEST['id'])) {
    $reviewQuery = mysqli_query($con, "SELECT * FROM rating_reviews, registration WHERE pid = " . $_REQUEST['id'] . " 
    AND rating_reviews.userid = registration.id ");

    $reviewAvgQuery = @mysqli_fetch_object(mysqli_query($con, "SELECT AVG(rating_reviews.rating) as productRating FROM rating_reviews WHERE pid = " . $_REQUEST['id']));
    $reviewAvg = ceil($reviewAvgQuery->productRating);
}


$catname = @mysqli_fetch_object(mysqli_query($con, "select * from category where c_id=" . $_REQUEST['cid']));
$subcatname = @mysqli_fetch_object(mysqli_query($con, "select * from category where c_id=" . $_REQUEST['scid']));

if (isset($_REQUEST['id'])) {
    $pro = $_REQUEST['id'];
    $prouser = mysqli_query($con, "select * from product where id='$pro' and status='2'");
    $prouser_fetch = mysqli_fetch_array($prouser);
    $prouerid = $prouser_fetch['userid'];

    $res1 = "select * from product where userid='$prouerid' and `id`='$pro' and status='2'";
} else {
    $prouerid = $_REQUEST['uid'];
    $res1 = "select * from product where userid='$prouerid' and status='2'";
}

$cid = $_REQUEST['cid'];
$sid = $_REQUEST['scid'];
$res = "select * from product where userid='$prouerid' and status='2'";
$strget = "uid=$prouerid&cid=$cid&scid=$sid";
$rowsPerPage = 1;

$query = mysqli_query($con, $res1) or die(mysqli_error($con));

// $res3 = mysqli_query($con, "select * from country where country_id=".$result['country']);
// $result1 = mysqli_fetch_array($res3);


$pro = $sess_id;
$res = "select * from registration where id='$sess_id'";
$res1 = mysqli_query($con, $res);
$result1 = mysqli_fetch_array($res1);
$gemail = $result1['email'];
$companyname = $result1['companyname'];
$phonenumber = $result1['phonenumber'];
$sender_vendor_id = $result1['vendor_id'];

$userInfoAsCompany = (mysqli_query($con, "select *, LPAD(vendor_id,6,'0') AS vendor_id from registration where id='$prouerid'"));
$userInfoAsCompanyCount = mysqli_num_rows($userInfoAsCompany);
$userInfoAsCompanyData = mysqli_fetch_array($userInfoAsCompany);
$fname = $userInfoAsCompanyData['firstname'];


if (isset($_REQUEST['submit_quote'])) {

    $name = $_REQUEST['name']; // Get Name value from HTML Form
    $mobile = $_REQUEST['phone'];  // Get Mobile No
    $vendor_id = $_REQUEST['vendor_id'];  // Get Email Value
    $message = $_REQUEST['message']; // Get Message Value
    $emailadd = $_REQUEST['youremail'];
    $rec_vendor_id = $userInfoAsCompanyData['vendor_id'];

    $qury = @$con->query("INSERT INTO getquote SET sender_vendor_id = '$sender_vendor_id', rec_vendor_id = '$rec_vendor_id', reply_by = '$sender_vendor_id', product_id = '" . $_GET['id'] . "', quote = '$message', status = '1' ");

    // Set content-type header for sending HTML email
    $mail->CharSet = 'windows-1250';
    $mail->SetFrom ('welcome@annextrades.com', 'ANNEXTrades');
    $mail->AddBCC ( 'annexis.data@gmail.com', 'Reply ANNEXTrades');
    $mail->AddAddress ($userInfoAsCompanyData['email']);
    $mail->IsHTML(true);

    $mail->Subject = "Get Quote Request"; // This is your subject
    $subject = "You have a Quote Request";
    $msg = "
            <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#fff' style='border:1px solid #ff7900;'>
                <tr><img src='https://annextrades.com/assets/images/mailimg/newmessage.jpg' style='width: 100%;'></tr>
                <tr bgcolor='#FFF' style='padding: 15px border-top: 1px; border-color: #ff7900;'>
                    <td>
                        <div style='font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#29B1CA; text-align:left; padding-bottom:10px; padding-top:10px; line-height:26px;text-align:center;\">
                            <span style='font-family:Arial, Helvetica, sans-serif; font-size:15px;'>
                                <div style='padding: 15px;'>
                                    <b>Dear $fname</b><br>
                                    <p>You have a new Quote Request from a potential buyer.</p>

                                    <p>Message: $message</p>

                                    <p>Please login to you user dashboard and respond as soon as possible.  Remember, fast response increases your chance to win sales. 
                                        </p>
                                    <p>Please login to: <a href='https://annextrades.com/login.php'>https://annextrades.com/login.php</a></p><br>
                                </div>
                            </span> 
                        </div>
                    </td>
                </tr>
            </table>
            ";
    $mail->Body    = $msg;
    // Find your Account SID and Auth Token at twilio.com/console
    // and set the environment variables. See http://twil.io/secure
    $sid = "AC49042d3a1fb260ea8e08d7d5d7ab9368";
    $token = "54e3a0bbea9ed9d313aa255557eaa024";
    //exit('ok');
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
    ->create("whatsapp:+91$mobile", // to
            [
                "from" => "whatsapp:+13474108856",
                "body" => "You have a New Buyer Inquiry.  It is important to respond quickly to increase chance of conversion.  Please use the link below to login into your account and reply to your new request. "
            ]
    );

    //print $message->sid;
    
    if (!$mail->send()) {
        //echo 'Message could not be sent.';
        $sentmessageerror = '*Your message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
?>

        <style>
            #info-message-error {
                color: red;
                font-size: 18px;
                font-weight: bold;
            }
        </style>

        <script>
            setTimeout(function() {
                document.getElementById('info-message-error').style.display = 'none';

            }, 7000);
        </script>


    <?php
    } else {
        // echo 'Message has been sent';
        $sentmessagesuccess = "*Your message has been sent";

    ?>

        <style>
            #info-message-success {
                color: green;
                font-size: 18px;
                font-weight: bold;
            }
        </style>
        <script>
            setTimeout(function() {
                document.getElementById('info-message-success').style.display = 'none';

            }, 7000);
        </script>

<?php
    }
}

?>


<div class="prod-single-wrapper">
    <div class="container">
        <div class="page-breadcrumb">
            <ul class="list-unstyled">
                <li><b><a href="products.php">Products</a> > </b></li>
                <?php if (!empty($catname->category)) : ?><li><a href="#"><?= $catname->category ?></a> > </li> <?php endif; ?>
                <li><b><?= $subcatname->category ?></b></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <?php if (isset($reviewAddedText)) : ?>
            <div class="alert alert-success"><?= $reviewAddedText ?></div>
        <?php endif; ?>
        <?php if (mysqli_num_rows($query) > 0) : ?>
            <?php while ($result = mysqli_fetch_array($query)) : ?>
                <?php
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                //exit;
                ?>
                <script>
                    function showImage(imgName) {
                        var curImage = document.getElementById('currentImg');
                        var thePath = 'productlogo/';
                        var theSource = thePath + imgName;
                        curImage.src = theSource;
                        curImage.alt = imgName;
                        curImage.title = imgName;
                    }
                </script>
                <?php


                /* $userInfoAsCompany = (mysqli_query($con, "select *, LPAD(vendor_id,6,'0') AS vendor_id from registration where id='$prouerid'"));
                    $userInfoAsCompanyCount = mysqli_num_rows($userInfoAsCompany);
                    $userInfoAsCompanyData = mysqli_fetch_array($userInfoAsCompany); */
                // echo '<pre>';
                // echo print_r($userInfoAsCompanyData);

                $added_date = explode(" ", $userInfoAsCompanyData['added_date']);
                $added_date = $added_date[0];
                $added_date = date("m-d-Y", strtotime($added_date));
                $vendor_id = $userInfoAsCompanyData['vendor_id'];
                $bdes = $result['p_bdes'];
                ?>
                <div class="row padding-0">
                    <div class="col-md-9 single-section-1">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 15px;">
                                <h3 style="font-size: 24px!important;"><b><?php echo $result['p_name']; ?></b><br>
                                    <font style="font-size: 20px ;">by
                                        <font style="color: #2baae1;">

                                            <a STYLE="color: #ff7900 ;" id="abt" href="#about">
                                                <?php if ($userInfoAsCompanyData['companyname'] != '') {
                                                    echo $userInfoAsCompanyData['companyname'];
                                                } ?></a>

                                        </font>
                                    </font>
                                </h3>
                            </div>
                            <div class="col-md-5 single-section-1-left">
                                <?php include('zoom/index.php'); ?>
                                <section id="magnific">
                                    <div class="row1">
                                        <div class="col-md-12">
                                            <div class="xzoom-container">
                                                <img class="xzoom5" id="xzoom-magnific" src="<?php echo "productlogo/" . $result['photo1']; ?>" xoriginal="<?php echo "productlogo/" . $result['photo1']; ?>" />
                                                <div class="xzoom-thumbs ro">
                                                    <a href="<?php echo "productlogo/" . $result['photo1']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo "productlogo/" . $result['photo1']; ?>" xpreview="<?php echo "productlogo/" . $result['photo1']; ?>" title="<?php echo $result['p_name']; ?>"></a>
                                                    <?php if ((file_exists("productlogo/" . $result['photo2'])) && ($result['photo2']) != '') { ?>
                                                        <a href="<?php echo "productlogo/" . $result['photo2']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo "productlogo/" . $result['photo2']; ?>" title="The description goes here"></a>
                                                    <?php } ?>

                                                    <?php if ((file_exists("productlogo/" . $result['photo3'])) && ($result['photo3']) != '') { ?>
                                                        <a href="<?php echo "productlogo/" . $result['photo3']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo "productlogo/" . $result['photo3']; ?>" title="The description goes here"></a>
                                                    <?php } ?>

                                                    <?php if ((file_exists("productlogo/" . $result['photo4'])) && ($result['photo4']) != '') { ?>
                                                        <a href="<?php echo "productlogo/" . $result['photo4']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo "productlogo/" . $result['photo4']; ?>" title="The description goes here"></a>
                                                    <?php } ?>

                                                    <?php if ((file_exists("productlogo/" . $result['photo5'])) && ($result['photo5']) != '') { ?>
                                                        <a href="<?php echo "productlogo/" . $result['photo5']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo "productlogo/" . $result['photo5']; ?>" title="The description goes here"></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="large-12 column"></div>
                                </section>
                                <!-- <div class="row">        
                                        <div class="col-md-12 full-preview-image w-100 padding-0">
                                            < ?php if (isset($result['photo1'])) { ?>
                                                < ?php if ((file_exists("productlogo/" . $result['photo1'])) && ($result['photo1']) != '') { ?>
                                                    <img id="currentImg" src="< ?php echo "productlogo/" . $result['photo1']; ?>" /></a>< ?php } else { ?><img src="productlogo/img_noimg.jpg" />
                                                < ?php } ?>
                                            < ?php } ?>
                                        </div>
                                        <ul class="w-100 list-unstyled thumbs-wrap" style="margin: 8 0 0 0;">
                                            < ?php if (isset($result['photo1'])) { ?>
                                                <li class="w-20">< ?php if ((file_exists("productlogo/" . $result['photo1'])) && ($result['photo1']) != '') { ?><img src="< ?php echo "productlogo/" . $result['photo1']; ?>" title="< ?php echo $result['photo1'];?>" onclick="showImage('< ?php echo $result['photo1'];  ?>');"/>< ?php } ?></li>
                                            
                                            < ?php } if (isset($result['photo2'])) { ?>                                

                                                <li class="w-20">< ?php if ((file_exists("productlogo/" . $result['photo2'])) && ($result['photo2']) != '') { ?><img src="< ?php echo "productlogo/" . $result['photo2']; ?>" title="< ?php echo $result['photo2'];?>" onclick="showImage('< ?php echo $result['photo2'];  ?>');"/>< ?php } ?></li>

                                            < ?php } if (isset($result['photo3'])) { ?>
                                                <li class="w-20">< ?php if ((file_exists("productlogo/" . $result['photo3'])) && ($result['photo3']) != '') { ?><img src="< ?php echo "productlogo/" . $result['photo3'];?>" title="< ?php echo $result['photo3'];?>" onclick="showImage('< ?php echo $result['photo3']; ?>');" />< ?php } ?></li>

                                            < ?php  } if (isset($result['photo4'])) { ?>
                                                <li class="w-20">< ?php if ((file_exists("productlogo/" . $result['photo4'])) && ($result['photo4']) != '') { ?><img src="< ?php echo "productlogo/" . $result['photo4'];?>" title="< ?php echo $result['photo4'];?>" onclick="showImage('< ?php echo $result['photo4']; ?>');" />< ?php }?></li>

                                            < ?php  } if (isset($result['photo5'])) { ?>
                                                <li class="w-20">< ?php if ((file_exists("productlogo/" . $result['photo5'])) && ($result['photo5']) != '') { ?><img src="< ?php echo "productlogo/" . $result['photo5'];?>" title="< ?php echo $result['photo5'];?>" onclick="showImage('< ?php echo $result['photo5']; ?>');" />< ?php }?></li>
                                            < ?php }?>
                                        </ul>
                                    </div>    -->
                            </div>

                            <div class="col-md-7 single-section-1-right" style="padding: 0px 0px;  margin: 0 25 0 15;">
                                <div class="rating-wrap">
                                    <img class="star-rating" src="./assets/images/stars-<?= $reviewAvg ?>.png" alt=""> <span style="verticle-align: bottom;"><?= $reviewAvg ?> <a style="color: #ff7900;" href="#rating">Rating</a></span>
                                </div>
                                <h5>Product Details</h5>
                                <style>
                                    h3 {
                                        font-size: 15px !important;
                                    }
                                </style>
                                <div class="text3" style="/* height: 100px; overflow:hidden; */">
                                    <div class="text-justify">
                                        <p>
                                            <?php echo html_entity_decode($bdes) . "..."; ?>
                                        </p>
                                    </div><br>
                                </div>
                                <div class="read-more-btn pull-right"><a id="moreinfo" href="#about"><b>More Info <i class="fa fa-long-arrow-right" aria-hidden="true"></i></b></a></div>
                                <br>
                                <br>
                                <ul class="list-unstyled col-three row" style="padding: 0px 15px;">
                                    <li class="col-md-5 text-left">
                                        <b><?php echo (($result['p_price'] == 'USD' || $result['p_price'] == '') ? '$' : $result['p_price']) . "" . formatPrice($result['range1']) . " - " . formatPrice($result['range2']); ?>/ Unit</b>
                                        <?php if (isset($result['p_min_quanity']) && !empty($result['p_min_quanity'])) : ?><p class="m-0"><?php echo $result['p_min_quanity']; ?> Pieces (Min. Order)</p><?php endif; ?>
                                    </li>
                                    <li class="col-md-3 text-center">
                                        <p class="m-0">Delivery Time</p>
                                        <b><?php echo $result['p_delivertytime']; ?></b>
                                    </li>
                                    <li class="col-md-4 text-right">
                                        <p class="m-0">Vendor ID</p>
                                        <b><?= $vendor_id ?></b>
                                    </li>
                                </ul>

                                <h5>Supplier Information</h5>
                                <ul class="list-unstyled col-three row" style="padding: 0px 15px;">
                                    <li class="col-md-5 text-left">
                                        <p class="m-0">Registered Name</p>
                                        <b><?php if ($userInfoAsCompanyData['companyname'] != '') {
                                                echo $userInfoAsCompanyData['companyname'];
                                            } ?></b>
                                    </li>
                                    <li class="col-md-3 text-center">
                                        <p class="m-0">Member Since</p>
                                        <b> <?php if ($userInfoAsCompanyData['added_date'] != '') {
                                                echo $added_date;
                                            } else {
                                                echo "-";
                                            } ?></b>
                                    </li>
                                    <!-- <li class="col-md-4 text-right">
                                            <p class="m-0">Company Tel.</p>
                                            <b>< ?php if ($userInfoAsCompanyData['phonenumber'] != '') {
                                                    echo format_phone('us', $userInfoAsCompanyData['phonenumber']);
                                                } else {
                                                    echo "-";
                                                } ?></b>
                                        </li> -->
                                </ul>
                                <?php if (isset($sess_id)) { ?><a class="theme-btn" href="proaction1.php?id=<?php echo $result['id']; ?>">CONTACT NOW</a> <?php } else { ?><a class="theme-btn" href="login.php?id=<?php echo $result['id']; ?>">CONTACT NOW</a> <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 single-section-2-right" style="background: #f1f1f1; padding: 15 15 0 15;">
                        <p id="info-message-success"><?php echo $sentmessagesuccess; ?></p>
                        <p id="info-message-error"><?php echo $sentmessageerror; ?></p>
                        <h2 class="tab-title text-center">Request Quote</h2>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="Name" value="<?php echo $companyname; ?>" class="form-control" name="name" required readonly>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" Placeholder="Email" value="<?php echo $gemail; ?>" name="youremail" required readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" placeholder="Number" value="<?php echo $phonenumber; ?>" class="form-control" name="phone" required readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" value="Subject: <?php echo $result['p_name']; ?>" class="form-control" name="vendor_id" required readonly>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="form-grouptext-center">
                                <div id="rating"></div>
                                <div class="text-center" style="/* display: inline; */ font-size: 12;">
                                    <label for="concent"><input type="checkbox" id="concent" required>&nbsp; By sending a request, you accept our <br><a target="_blank" href="terms_of_use.php">Terms of Use</a> and <a target="_blank" href="privacy_policy.php">Privacy policy</a></label>
                                </div>
                            </div>
                            <?php
                                if ($_SESSION['user_login'] == '') {
                            ?>
                            </form>
                            <?php } ?>
                            <div class="form-group text-center">
                                <?php
                                    if ($_SESSION['user_login'] == '') {
                                ?>
                                    <button style="outline: none;" id="gq" class="theme-btn text-center">GET QUOTE</button>
                                    <script>
                                        $(document).ready(function(){
                                            $("#gq").click(function(){
                                                alert("Please login to get quote.");
                                            });
                                        });
                                    </script>
                                <?php } else{ ?>
                                    <input type="submit" name="submit_quote" style="outline: none;" class="theme-btn text-center" value="GET QUOTE" />
                                    </form>
                                <?php } ?>
                            </div>
                            <?php
                                if ($_SESSION['user_login'] != '') {
                            ?>
                                </form>
                            <?php } ?>
                    </div>
                </div>



                <div class="single-section-2">
                    <div class="single-section-2-left">
                        <div class="reviews-wrapper">

                            <div class="reviews-header">
                                <h4>Rating & Reviews</h4>
                                <?php
                                if ($_SESSION['user_login'] == '') {
                                ?>
                                    <button class="write-review-btn" id="rvw_lgn">Write a review</button>
                                <?php
                                } else {
                                ?>
                                    <button class="write-review-btn" data-target="#add-review-modal" data-toggle="modal">Write a review</button>
                                <?php } ?>
                            </div>

                            <div class="reviews-body">
                                <div id="about"></div>
                                <?php if (mysqli_num_rows($reviewQuery) > 0) : ?>
                                    <?php while ($reviewData = mysqli_fetch_array($reviewQuery)) : ?>
                                        <div class="review-row">
                                            <h6><?= $reviewData['firstname'] . " " . $reviewData['lastname'] ?></h6>
                                            <div class="rating-wrap">
                                                <img class="star-rating" src="./assets/images/stars-<?= $reviewData['rating'] ?>.png" alt="">
                                                <?php
                                                $created_at = strtotime($reviewData['created_at'])
                                                ?>
                                                <span><?= date('d M Y', $created_at) ?></span>
                                            </div>
                                            <p><?= $reviewData['review'] ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <div class="alert alert-warning my-3">No reviews found!</div>
                                <?php endif; ?>
                            </div>
                            <!-- <div class="review-pagination">
                                    <div class="page-pagination">
                                        <button class="navi-item navi-prev navi-disable">
                                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.44187 0.183056C5.68595 0.42713 5.68595 0.822853 5.44187 1.06693L1.50886 4.99994L5.44187 8.93294C5.68595 9.17702 5.68595 9.57274 5.44187 9.81681C5.1978 10.0609 4.80207 10.0609 4.558 9.81681L0.183056 5.44187C-0.0610186 5.1978 -0.0610186 4.80207 0.183056 4.558L4.558 0.183056C4.80207 -0.0610186 5.1978 -0.0610186 5.44187 0.183056Z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button class="navi-item">1</button>
                                        <button class="navi-item active">2</button>
                                        <button class="navi-item">3</button>
                                        <button class="navi-item navi-next">
                                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.183007 9.81682C-0.061068 9.57275 -0.061068 9.17702 0.183007 8.93295L4.11601 4.99994L0.183008 1.06694C-0.0610673 0.82286 -0.0610672 0.427138 0.183008 0.183063C0.427082 -0.0610118 0.822805 -0.0610117 1.06688 0.183063L5.44182 4.55801C5.6859 4.80208 5.6859 5.1978 5.44182 5.44188L1.06688 9.81682C0.822804 10.0609 0.427081 10.0609 0.183007 9.81682Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div> -->
                        </div>

                        <div class="company-tabs-wrapper">
                            <ul class="nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="product-detail-tab" data-toggle="tab" href="#product-detail" role="tab" aria-controls="product-detail" aria-selected="true">Product Detail</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="about-company-tab" data-toggle="tab" href="#about-company" role="tab" aria-controls="about-company" aria-selected="true">About Company</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="company-details-tab" data-toggle="tab" href="#company-details" role="tab" aria-controls="company-details" aria-selected="false">Company Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="company-images-tab" data-toggle="tab" href="#company-images" role="tab" aria-controls="company-images" aria-selected="false">Images</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="company-video-tab" data-toggle="tab" href="#company-video" role="tab" aria-controls="company-video" aria-selected="false">Company Video</a>
                                </li>
                            </ul>
                            <?php
                            $rescom = "SELECT * FROM companyprofile WHERE user_id='$prouerid'";
                            $rescom1 = mysqli_query($con, $rescom);
                            $resultcom = mysqli_fetch_array($rescom1);
                            // echo '<pre>';
                            //print_r($resultcom);
                            // echo '</pre>';

                            ?>

                            <?php
                            $companyQuery = mysqli_query($con, "SELECT * FROM companyprofile WHERE user_id='$prouerid'");
                            $companyInfoCount = mysqli_num_rows($companyQuery);
                            $companyInfo =  mysqli_fetch_object($companyQuery);
                            ?>
                            <div class="tab-content" style="/* background: #f5f5f5; */ padding: 15px;">
                                <div class="tab-pane fade show active" id="product-detail" role="tabpanel">
                                    <!-- <h2 class="tab-title">Product Detail</h2> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <?php
                                                if (!empty($result['p_bdes'])) {
                                                    /* echo htmlspecialchars_decode(html_entity_decode($bdes));  */
                                                    echo html_entity_decode($bdes);
                                                    /* echo ltrim($bdd, "<p> </p>, <p> &nbsp;</p>, <p> &amp</p>" ); */
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-md-12" style="padding-top: 15px;">
                                            <p>
                                                <?php
                                                $pdd = $result['p_ddes'];
                                                if (!empty($result['p_ddes'])) {
                                                    echo html_entity_decode($pdd);
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?>

                                            </p>
                                            <!-- <div class="col-ms-12" style="padding-top: 15px;">
                                                    <h2><b>More Images:</b></h2>
                                                    <!- - 3. Have fun! - ->
                                                    < ?php if ((file_exists("productlogo/" . $result['photo1'])) && ($result['photo1']) != '') { ?>
                                                        <a data-fancybox="gallery" href="< ?php echo "productlogo/" . $result['photo1']; ?>"><img style="width: 150px; height: 150px; margin: 15px 15px 15px 0px; padding: 2px; border: 1px solid #4e4a4a; " src="< ?php echo "productlogo/" . $result['photo1']; ?>"></a>
                                                    < ?php } ?>
                                                    < ?php if ((file_exists("productlogo/" . $result['photo2'])) && ($result['photo2']) != '') { ?>
                                                        <a data-fancybox="gallery" href="< ?php echo "productlogo/" . $result['photo2']; ?>"><img style="width: 150px; height: 150px; margin: 15px 15px 15px 0px; padding: 2px; border: 1px solid #4e4a4a; " src="< ?php echo "productlogo/" . $result['photo2']; ?>"></a>
                                                    < ?php } ?>
                                                    < ?php if ((file_exists("productlogo/" . $result['photo3'])) && ($result['photo3']) != '') { ?>
                                                        <a data-fancybox="gallery" href="< ?php echo "productlogo/" . $result['photo3']; ?>"><img style="width: 150px; height: 150px; margin: 15px 15px 15px 0px; padding: 2px; border: 1px solid #4e4a4a; " src="< ?php echo "productlogo/" . $result['photo3']; ?>"></a>
                                                    < ?php } ?>
                                                    < ?php if ((file_exists("productlogo/" . $result['photo4'])) && ($result['photo4']) != '') { ?>
                                                        <a data-fancybox="gallery" href="< ?php echo "productlogo/" . $result['photo4']; ?>"><img style="width: 150px; height: 150px; margin: 15px 15px 15px 0px; padding: 2px; border: 1px solid #4e4a4a; " src="< ?php echo "productlogo/" . $result['photo4']; ?>"></a>
                                                    < ?php } ?>
                                                    < ?php if ((file_exists("productlogo/" . $result['photo5'])) && ($result['photo5']) != '') { ?>
                                                        <a data-fancybox="gallery" href="< ?php echo "productlogo/" . $result['photo5']; ?>"><img style="width: 150px; height: 150px; margin: 15px 15px 15px 0px; padding: 2px; border: 1px solid #4e4a4a; " src="< ?php echo "productlogo/" . $result['photo5']; ?>"></a>
                                                    < ?php } ?>
                                                </div>  -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="about-company" role="tabpanel">
                                    <h2 class="tab-title">About Company</h2>
                                    <p>
                                        <?php
                                        if (!empty($resultcom['company_details'])) {

                                            echo html_entity_decode($resultcom['company_details']);
                                        } else {
                                            echo "N/A";
                                        } ?>

                                    </p>

                                </div>

                                <div class="tab-pane fade" id="company-details" role="tabpanel">
                                    <h2 class="tab-title">Company Details</h2>
                                    <div class="col-two-wrap">
                                        <ul class="list-unstyled col-two">
                                            <?php if ($companyInfoCount) : ?>
                                                <li>
                                                    <p class="m-0">Registered Name</p>
                                                    <strong>
                                                        <?php if (!empty($companyInfo->companyname)) {
                                                            echo $companyInfo->companyname;
                                                        } else {
                                                            echo "N/A";
                                                        } ?>
                                                    </strong>
                                                </li>

                                                <li>
                                                    <p class="m-0">Year Establshed</p>
                                                    <strong><?= (isset($companyInfo->year) && !empty($companyInfo->year)) ? $companyInfo->year : "N/A" ?></strong>
                                                </li>

                                                <li>
                                                    <p class="m-0">Number of Employees</p>
                                                    <strong>
                                                        <?php if (!empty($companyInfo->noofemployee)) {
                                                            echo $companyInfo->noofemployee;
                                                        } else {
                                                            echo "N/A";
                                                        } ?>
                                                    </strong>

                                                </li>

                                                <li>
                                                    <p class="m-0">Company Website URL</p>
                                                    <strong><?= (isset($companyInfo->url) && !empty($companyInfo->url)) ? $companyInfo->url : "N/A" ?></strong>
                                                </li>

                                                <!-- <li>
                                                        <p class="m-0">Company Tel.</p>
                                                        <strong>< ?php if ($userInfoAsCompanyData['phonenumber'] != '') {
                                                                    echo format_phone('us', $userInfoAsCompanyData['phonenumber']);
                                                                } else {
                                                                    echo "-";
                                                                } ?></strong>
                                                    </li> -->

                                                <li>
                                                    <p class="m-0">Business Type</p>
                                                    <strong><?= (isset($companyInfo->bussiness_type) && !empty($companyInfo->bussiness_type)) ? $companyInfo->bussiness_type : "N/A" ?></strong>

                                                </li>

                                                <li>
                                                    <p class="m-0">Main Office</p>
                                                    <strong><?= (isset($companyInfo->company_address) && !empty($companyInfo->company_address)) ? $companyInfo->company_address : "N/A" ?></strong>
                                                </li>


                                                <!--  <li>
                                                        <p class="m-0">Business Email</p>
                                                        <strong><?= (isset($companyInfo->mailid) && !empty($companyInfo->mailid)) ? $companyInfo->mailid : "N/A" ?></strong>
                                                    </li> -->

                                                <li>
                                                    <p class="m-0">Brand Name</p>
                                                    <strong><?= (isset($companyInfo->brand) && !empty($companyInfo->brand)) ? $companyInfo->brand : "N/A" ?></strong>
                                                </li>
                                            <?php else : ?>
                                                <li>
                                                    <div class="alert alert-warning">Company information is not available.</div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                                <?php


                                $companyId = $companyInfo->id;
                                $companyQuery = mysqli_query($con, "SELECT * FROM company_images WHERE company_id=" . $companyId);
                                ?>


                                <div class="tab-pane fade" id="company-images" role="tabpanel">
                                    <h2 class="tab-title">Company Images</h2>
                                    <div class="company-images-wrap">
                                        <ul class="list-unstyled">
                                            <?php if (mysqli_num_rows($companyQuery)) { ?>
                                                <?php
                                                while ($row = mysqli_fetch_array($companyQuery)) :
                                                ?>
                                                    <li><img src="<?= directoryUrl ?>/<?= $row['image'] ?>" alt=""></li>
                                                <?php
                                                endwhile;
                                                ?>
                                            <?php } else { ?>
                                                <li>
                                                    <div class="alert alert-warning">No images found!</div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php $videos = (!empty($companyInfo->videos)) ? explode(",", $companyInfo->videos) : array(); ?>

                                <div class="tab-pane fade" id="company-video" role="tabpanel">
                                    <h2 class="tab-title">Company Video</h2>
                                    <?php
                                    if (count($videos) > 0) {
                                        foreach ($videos as $video) {
                                    ?>
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning">No videos found!</div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert alert-warning">No product found!</div>
        <?php endif; ?>
    </div>
</div>
<!-- Weekly Deels -->
<style>
    figure {
        margin: 0px !important;
    }
</style>
<?php include "includes/new/weekly_deals_section.php"; ?>
<!-- Review Modal -->
<div class="modal fade" id="add-review-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="controller/productreview.php?id=<?php echo $_GET['id']; ?>&amp;cid=<?php echo $_GET['cid']; ?>&amp;scid=<?php echo $_GET['scid']; ?>&amp;type=product" id="reviewForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                    <input type="hidden" name="pid" value="<?= $_REQUEST['id'] ?>">
                    <div class="form-group">
                        <label>Rating</label>

                        <!-- Rating Stars Box -->
                        <div class='rating-stars'>
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                <!-- <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> -->
                                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                <!-- <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> -->
                                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                <!-- <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> -->
                                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                <!-- <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> -->
                                <input type="radio" id="star1" name="rating" value="1" checked /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                <!-- <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> -->
                            </fieldset>
                        </div>

                        <div style="display: none;">
                            <div class="form-check form-check-inline">
                                <!-- <input type="hidden" name="rating" id="rating" value="1"> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Review</label>
                        <textarea style="height: 150px;" class="form-control" required name="add_review" placeholder="Add Review"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addReviewBtn" value="addReviewBtn" class="btn btn-primary">Add Review</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    /* Rating Star Widgets Style */
    .rating-stars ul {
        list-style-type: none;
        padding: 0;

        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
        display: inline-block;
        responseMessage
    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
        font-size: 2.5em;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
        color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
        color: #FF912C;
    }
</style>
<script>
    $(document).ready(function() {
        $('#abt').on('click', function() {
            document.getElementById("about").style.display = "block";
            document.getElementById("about-company-tab").click();
        });
    });
    $(document).ready(function() {
        $('#moreinfo').on('click', function() {
            document.getElementById("product-detail-tab").click();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#rvw_lgn').on('click', function() {
            alert('Login Required For Review!');
        });
    });
</script>
<script>
    $(document).ready(function() {
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });
        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });

        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }

            $('#rating').val(ratingValue);

        });


    });
</script>
<?php /* echo "productlogo/1-500x500.jpg" . $result['photo1']; */ ?>
<!-- <script>
    jQuery(document).ready(function(){
        jQuery.mouseOverZoomTiles({
            axZmPath: "Zoomer/axZm/", // path to /axZm directory, e.g. /test/axZm/ or "auto" (auto might not always work)
            mapDivID: "mouseOverTilesMapContainer", // ID of the container for mouseover element
            galleryDivID: "mouseOverTilesGallery", // ID of the container where thumbnails will be inserted into
            images: {
                1: {img: "productlogo/1-500x500.jpg", title: "test_fashion1.png"},
                2: {img: "productlogo/1-500x500.jpg", title: "test_fashion2.png"},
                3: {img: "productlogo/1-500x500.jpg", title: "test_fashion3.png"},
                4: {img: "productlogo/1-500x500.jpg", title: "test_fashion4.png"},
                5: {img: "productlogo/1-500x500.jpg", title: "test_portrait1.png"}
            },
                firstImageToLoad: 1,
                mediaQueryFullWidth: 900,
                thumbWidth: 86, // width of the thumbnail image
                thumbHeight: 86, // height of the thumbnail image
                galleryAxZmThumbSlider: true, // use $.axZmThumbSlider for the gallery. If false a different Ul->LI structure will be applied without scrolling capeability
                heightRatio: "1.0|+140", // Instantly adjust the height of the parent contaoner for mouseover image (defined as "mapDivID" option) depending on its width which can be responsive
                disableTouchMouseover: true, // Disable mouseover for touch devices.
                zoomWidth: ".rightLayer", // max width of the image that will be shown in the zoom window
                zoomHeight: "#mouseOverTilesMapContainer|+105", // max height of the image that will be shown in the zoom window
                adjustX: 20, // space between mouse over zoom ("mapDivID") and flyout window to the right
                adjustY: 0, // vertical shift of the flyout window
                mapSelSmoothDrag: false, // activate smooth drag
                mapSelSmoothDragSpeed: 500, // speed of the dragging
                scrollZoom: 16, // prc zoom on mouse scroll
                fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode, possible on modern browsers
                axZmCallBacks: {}  // callbacks which can be passed to AJAX-ZOOM
        });
    });
</script> -->


<?php include "includes/new/footer.php"; ?>